<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all tasks
        $tasks = Task::all();

        // Return the tasks
        return response()->json([
            'data' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Create a new task
        $task = Task::create($request->all());

        // Return the task with a message
        return response()->json([
            'data' => $task,
            'message' => 'Task created!'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        //find task

        $task = Task::findOrFail($id);

        // update task
        $task->update($request->all());

        // Return the task with a message
        return response()->json([
            'message' => 'Task updated!',
            'data' => $task
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find task
        $task = Task::findOrFail($id);

        //delete task
        $task->delete();

        // Return the task with a message
        return response()->json([
            'message' => 'Task deleted!'
        ], 200);
    }
}
