<?php

namespace App\Http\Controllers;

use App\Entity\File\Layout;
use App\Entity\Task\Task;
use App\Form\TaskFormType;
use App\Service\LayoutRemoveService;
use App\Service\RefreshTaskService;
use App\Service\StoreTaskService;
use Barryvdh\Form\CreatesForms;
use Barryvdh\Form\ValidatesForms;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Form\FormInterface;

class TaskController extends Controller
{
    use ValidatesForms, CreatesForms;

    public function __construct(
        private RefreshTaskService $refreshTaskService,
        private StoreTaskService $storeTaskService,
        private LayoutRemoveService $layoutRemoveService,
    ) {
    }

    public function task(Request $request, Task $task): View
    {
        $form = $this->createForm(TaskFormType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->storeTask($task, $form);
        }

        return view('page.task', [
            'form' => $form->createView(),
        ]);
    }

    public function refresh(Task $task): JsonResponse
    {
        $this->refreshTaskService->refresh($task);

        return response()->json([
            'success' => true,
        ]);
    }

    public function removeLayout(Task $currentTask, Layout $layout): JsonResponse
    {
        $this->layoutRemoveService->removeLayout(
            layout: $layout,
            task: $currentTask,
        );

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
