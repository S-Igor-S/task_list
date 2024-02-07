<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\RedirectResponse;

class TaskService
{
    private static ?self $instances = null;
    protected function __construct() {}

    protected function __clone() {}

    /**
     * @throws Exception
     */
    public function __wakeup() {
        throw new Exception("Singleton is using");
    }

    public static function getInstance(): TaskService|static
    {
        if (null === self::$instances) {
            self::$instances = new static();
        }

        return self::$instances;
    }

    /**
     * @param  TaskRequest  $request
     * @return RedirectResponse
     */
    public function create(TaskRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());
        return redirect()->route('tasks.show', ['task' => $task])
            ->with('success', 'Task created successfully!');
    }

    /**
     * @param  Task  $task
     * @param  TaskRequest  $request
     * @return RedirectResponse
     */
    public function update(Task $task, TaskRequest $request): RedirectResponse
    {
        $task->update($request->validated());
        return redirect()->route('tasks.show', ['task' => $task])
            ->with('success', 'Task updated successfully!');
    }

    /**
     * @param  Task  $task
     * @return RedirectResponse
     */
    public function compete(Task $task): RedirectResponse
    {
        $task->toggleComplete();
        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    /**
     * @param  Task  $task
     * @return RedirectResponse
     */
    public function delete (Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}
