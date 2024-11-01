<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all tasks from the database
        $tasks = Task::all();

        // Return a view and pass the tasks data
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view for creating a new task
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        // Create a new task using the validated data from the request
        Task::create($request->validated());

        // Redirect to the tasks index with a success message
        return redirect()->route('index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Return a view to show the specific task details
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Return a view to edit the specific task
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Update the task using the validated data from the request
        $task->update($request->validated());

        // Redirect to the tasks index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the specified task
        $task->delete();

        // Redirect to the tasks index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
