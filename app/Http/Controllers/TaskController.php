<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Paginator;
use Illuminate\View\View;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $tasks = Task::latest()->paginate(2);
        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        //Required fields in the form
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // dd($request->all()); prints all the information coming from the form

        /*A new record is created in the database, using the form data from the HTTP 
        request (here it contains all the field data).
        coming from the HTTP request, (here it contains all the field data).*/

        // Task::create($request->all());
        Task::create($request->all());


        // Redirect the user to the tasks list page.
        // The `route('tasks.index')` function generates the URL for the route named 'tasks.index',
        // which is defined in the 'routes/web.php' file and corresponds to the action
        // that displays the list of tasks. After the redirection, the user will see
        // the page with the updated list of tasks.
        return redirect()->route('task.index')->with('success', 'New task successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        // dd($task);
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $task->update($request->all());
        return redirect()->route('task.index')->with('success', 'Task successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        // dd($task);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task successfully eliminated');
    }
}
