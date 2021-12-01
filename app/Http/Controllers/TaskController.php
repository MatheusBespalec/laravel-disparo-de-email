<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Mail\NewTaskMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->paginate(10);
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user_id != auth()->user()->id) {
            return view('responses.access-danied');
        }
        $task = Task::create($request->all());
        Mail::to(auth()->user()->email)->send(new NewTaskMail($task));
        return redirect()->route('tasks.show', ['task' => $task]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($task->user_id != auth()->user()->id) {
            return view('responses.access-danied');
        }
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if ($task->user_id != auth()->user()->id) {
            return view('responses.access-danied');
        }
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id != auth()->user()->id) {
            return view('responses.access-danied');
        }
        $task->update($request->all());
        return redirect()->route('tasks.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->user_id != auth()->user()->id) {
            return view('responses.access-danied');
        }
        $task->delete();
        return back();
    }
}
