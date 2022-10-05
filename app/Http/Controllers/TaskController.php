<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()->isAdmin() ? Task::query() : $request->user()->tasks();

        return view('tasks.index', [
            'tasks' => $tasks->orderBy('expire_at', 'DESC')->get(),
        ]);
    }

    public function create()
    {
        return view('tasks.show', [
            'task' => new Task(),
            'statuses' => TaskStatus::all(),
        ]);
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::query()->create($request->validated());

        $task->users()->attach($request->user());

        return response()->json(['tasks' => $task]);
    }

    public function show(Task $task)
    {
        return $this->edit($task);
    }

    public function edit(Task $task)
    {
        return view('tasks.show', [
            'task'     => $task,
            'statuses' => TaskStatus::all(),
        ]);
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json(['tasks' => $task]);
    }
}
