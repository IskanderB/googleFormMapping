<?php

namespace App\Http\Controllers;

use App\Entity\File\Layout;
use App\Entity\Task\Task;
use App\Form\TaskFormType;
use App\Service\LayoutRemoveService;
use App\Service\Lock\LockService;
use App\Service\RefreshTaskService;
use App\Service\RemoveTaskService;
use App\Service\StoreTaskService;
use Barryvdh\Form\CreatesForms;
use Barryvdh\Form\ValidatesForms;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\Form\FormInterface;

class TaskController extends Controller
{
    use ValidatesForms, CreatesForms;

    public function __construct(
        private RefreshTaskService $refreshTaskService,
        private StoreTaskService $storeTaskService,
        private LayoutRemoveService $layoutRemoveService,
        private RemoveTaskService $removeTaskService,
        private LockService $lockService,
    ) {
    }

    public function task(Request $request, Task $task)
    {
        $form = $this->createForm(TaskFormType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->lockService->isUnlocked($task->getLock())) {
            $this->storeTask($task, $form);

            return new RedirectResponse(route('task', ['task' => $task->getId()]));
        }

        return view('page.task', [
            'form' => $form->createView(),
        ]);
    }

    public function refresh(Task $task): JsonResponse
    {
        if ($this->lockService->isUnlocked($task->getLock())) {
            $this->refreshTaskService->refresh($task);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function remove(Task $currentTask): JsonResponse
    {
        if ($this->lockService->isUnlocked($currentTask->getLock())) {
            $this->removeTaskService->remove($currentTask);
        }

        return response()->json([
            'success' => true,
            'redirectUrl' => route('dashboard'),
        ]);
    }

    public function removeLayout(Task $currentTask, Layout $layout): JsonResponse
    {
        if ($this->lockService->isUnlocked($currentTask->getLock())) {
            $this->layoutRemoveService->removeLayout(
                layout: $layout,
                task: $currentTask,
            );
        }

        return response()->json([
            'success' => true,
        ]);
    }

    private function storeTask(Task $task, FormInterface $form): void
    {
        $this->storeTaskService->store(
            task: $task,
            layoutFiles: $form->get('layouts')->getData(),
        );
    }
}
