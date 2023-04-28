<?php

namespace App\Http\Controllers;

use App\Entity\Task\Task;
use App\Repository\RowRepository;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private TaskRepository $taskRepository,
        private RowRepository $rowRepository,
    ) {
    }

    public function dashboard(Request $request, ?Task $currentTask = null): View
    {
        return view('page.dashboard', [
            'tasks' => $this->taskRepository->getTasks(),
            'currentTask' => $currentTask,
            'rowPaginator' => $currentTask
                ? $this->rowRepository->getRows($currentTask, $request->query('page', 1))
                : [],
        ]);
    }
}
