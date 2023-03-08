<?php

namespace App\Http\Controllers;

use App\Entity\Task;
use App\Form\TaskFormType;
use App\Service\RefreshTaskService;
use Barryvdh\Form\CreatesForms;
use Barryvdh\Form\ValidatesForms;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use LaravelDoctrine\ORM\Facades\EntityManager;

class TaskController extends Controller
{
    use ValidatesForms, CreatesForms;

    public function __construct(
        private RefreshTaskService $refreshTaskService,
    ) {
    }

    public function task(Request $request, Task $task): View
    {
        $form = $this->createForm(TaskFormType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            EntityManager::persist($task);
            EntityManager::flush();
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
}
