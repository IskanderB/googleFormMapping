<?php

namespace App\Http\Controllers;

use App\Entity\Task\Task;
use App\Repository\TaskRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    public function dashboard(Task $currentTask): View
    {
        return view('page.dashboard', [
            'tasks' => $this->taskRepository->findAll(),
            'currentTask' => $currentTask,
        ]);
    }
}
