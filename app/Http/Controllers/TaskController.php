<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //START "GET" methods
    /**
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('tasks.index');
    }

    /**
     * @return View|Application|Factory|FoundationApplication
     */
    public function list(): View|Application|Factory|FoundationApplication
    {
        return view('index', [
            'tasks' => Task::latest()->paginate(10),
        ]);
    }

    /**
     * @param  Task  $task
     * @return View|Application|Factory|FoundationApplication
     */
    public function single(Task $task): View|Application|Factory|FoundationApplication
    {
        return view('show', ['task' => $task]);
    }

    /**
     * @param  Task  $task
     * @return View|Application|Factory|FoundationApplication
     */
    public function edit(Task $task): View|Application|Factory|FoundationApplication
    {
        return view('edit', [
            'task' => $task
        ]);
    }
    //END GET methods

    //START POST methods
    /**
     * @param  TaskRequest  $request
     * @return RedirectResponse
     */
    public function create(TaskRequest $request): RedirectResponse
    {
        return TaskService::getInstance()->create($request);
    }
    //END POST methods

    //START PUT methods
    /**
     * @param  Task  $task
     * @param  TaskRequest  $request
     * @return RedirectResponse
     */
    public function update(Task $task, TaskRequest $request): RedirectResponse
    {
        return TaskService::getInstance()->update($task, $request);
    }

    /**
     * @param  Task  $task
     * @return RedirectResponse
     */
    public function complete(Task $task): RedirectResponse
    {
        return TaskService::getInstance()->compete($task);
    }
    //END PUT methods

    //START DELETE methods
    /**
     * @param  Task  $task
     * @return RedirectResponse
     */
    public function delete(Task $task): RedirectResponse
    {
        return TaskService::getInstance()->delete($task);
    }
    //END DELETE methods
}
