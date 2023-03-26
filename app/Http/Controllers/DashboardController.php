<?php

namespace App\Http\Controllers;

use App\Entity\Task\Task;
use App\Repository\TaskRepository;
use App\Service\Row\RowService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private TaskRepository $taskRepository,
        private RowService $rowService,
    ) {
    }

    public function dashboard(Task $currentTask): View
    {
        return view('page.dashboard', [
            'tasks' => $this->taskRepository->findAll(),
            'currentTask' => $currentTask,
            'rows' => $this->rowService->get($currentTask),
        ]);
    }
}
