<?php

namespace App\Message;

use App\Service\RefreshTaskService;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Service\Exception as GoogleServiceException;

class TaskMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Держим эти значения в синхроне с Horizon (или уберите их, если хотите, чтобы рулил Horizon)
    public int $timeout = 120;
    public int $tries   = 10;
    public array|int $backoff = [10, 30, 60, 120]; // экспоненциально + джиттер ниже

    public function __construct(
        public int $taskId
    ) {
    }

    public function handle(RefreshTaskService $refreshTaskService): void
    {
        try {
            $refreshTaskService->handle($this->taskId);

            // Временные ошибки Google API
        } catch (GoogleServiceException $e) {
            if (in_array($e->getCode(), [429, 500, 503], true)) {
                $this->release($this->nextDelay());
                return;
            }
            throw $e;

            // Сетевые проблемы — пробуем позже
        } catch (ConnectException $e) {
            $this->release($this->nextDelay());
            return;

            // HTTP-ошибки из Guzzle — ретраим только временные
        } catch (RequestException $e) {
            $code = $e->getResponse()?->getStatusCode();
            if ($code && in_array($code, [429, 500, 503], true)) {
                $this->release($this->nextDelay());
                return;
            }
            throw $e;
        }
    }

    public function retryUntil(): \DateTimeInterface
    {
        // Ограничим общее окно ретраев
        return now()->addHour();
    }

    protected function nextDelay(): int
    {
        // Берём пресет из $backoff по номеру попытки и добавляем небольшой джиттер
        $attempt = max(1, $this->attempts()); // 1,2,3...
        $preset = is_array($this->backoff)
            ? $this->backoff[min($attempt - 1, count($this->backoff) - 1)]
            : (int) $this->backoff;

        $jitter = (int) random_int(0, (int) round($preset * 0.3));
        return $preset + $jitter;
    }
}
