<?php

namespace App\Http\Controllers;

use App\Entity\Task\Task;
use App\Repository\RowRepository;
use App\Repository\TaskRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private TaskRepository $taskRepository,
        private RowRepository $rowRepository,
    ) {
    }

    public function dashboard(?Task $currentTask = null): View
    {
        return view('page.dashboard', [
            'tasks' => $this->taskRepository->findAll(),
            'currentTask' => $currentTask,
            'rows' => $currentTask ? $this->rowRepository->findBy(['task' => $currentTask]) : [],
        ]);
    }
}
