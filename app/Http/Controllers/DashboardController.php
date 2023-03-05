<?php

namespace App\Http\Controllers;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\RefreshTaskService;
use Illuminate\View\View;
class DashboardController extends Controller
{
    public function __construct(
        private TaskRepository $taskRepository,
        private RefreshTaskService $refreshTaskService
    ) {
    }

    public function dashboard(Task $currentTask): View
    {
//        $this->refreshTaskService->refresh($currentTask);

        return view('page.dashboard', [
            'tasks' => $this->taskRepository->findAll(),
            'currentTask' => $currentTask,
        ]);
    }
}
