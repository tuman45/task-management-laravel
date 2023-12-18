<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Board_list;
use App\Models\Task;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BoardTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Board $board)
    {
        // Retrieve tasks and board_lists related to the board
        $tasks = Task::with(['board', 'board_list'])->where('board_id', $board->id)->get();
        $groupedTasks = $tasks->groupBy('board_list_id');
        $boardLists = Board_list::where('board_id', $board->id)->orderBy('order')->get();
        return view('boards.show', [
            "title" => "Tasks",
            "board" => $board,
            "groupedTasks" => $groupedTasks,
            "boardLists" => $boardLists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Board $board)
    {
        return view('tasks.create', [
            'title' => 'Create New Task',
            'board' => $board,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Board $board)
    {
        $validatedData = $request->validate([
            'task_slug' => 'required',
            'task_title' => 'required|string|max:255',
            'task_desc' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['board_id'] = $board->id;

        $board_list = Board_list::where('board_id', $board->id)->where('user_id', $validatedData['user_id'])->where('order', 1)->first();
        $validatedData['board_list_id'] = $board_list->id;

        $task = Task::create($validatedData);
        if ($task) {
            return redirect('/boards/' . $board->board_slug . '/tasks')->with('success', 'New task successfully created');
        } else {
            return redirect('/boards/' . $board->board_slug . '/tasks')->with('error', 'New task failed to created');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board, Task $task)
    {
        $list = Board_list::where('board_id', $board->id)->where('user_id', auth()->user()->id)->where('id', $task->board_list_id)->first();
        $lastList = Board_list::where('board_id', $board->id)->where('user_id', auth()->user()->id)->max('order');

        $done = $list && $list->order == $lastList;
        $almostDone = $list && $list->order == $lastList - 1;

        return view('tasks.show', [
            'title' => 'Detail',
            'task' => $task,
            'board' => $board,
            'done' => $done,
            'almost' => $almostDone,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board, Task $task)
    {
        return view('tasks.edit', [
            'title' => 'Edit Task',
            'task' => $task,
            'board' => $board,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board, Task $task)
    {
        $validatedData = $request->validate([
            'task_slug' => 'required',
            'task_title' => 'required|string|max:255',
            'task_desc' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        $user_id = auth()->user()->id;
        $affectedRows = Task::where('id', $task->id)->where('board_id', $board->id)->where('user_id', $user_id)->update($validatedData);
        if ($affectedRows > 0) {
            return redirect('/boards/' . $board->board_slug . '/tasks/' . $validatedData['task_slug'])->with('success', 'Task successfully updated');
        } else {
            return redirect('/boards/' . $board->board_slug . '/tasks/' . $task->task_slug)->with('error', 'Task failed to be updated');
        }
    }

    public function moveToNextList(Board $board, Task $task)
    {
        $list = Board_list::where('board_id', $board->id)->where('user_id', auth()->user()->id)->where('id', $task->board_list_id)->first();
        $plus = $list->order + 1;
        $nextList = Board_list::where('board_id', $board->id)->where('user_id', auth()->user()->id)->where('order', $plus)->first();

        if ($nextList) {
            Task::where('id', $task->id)->update([
                'board_list_id' => $nextList->id,
            ]);

            return redirect('/boards/' . $board->board_slug . '/tasks/' . $task->task_slug)->with('success', 'Task moved to ' . $nextList->list_name);
        } else {
            return redirect('/boards/' . $board->board_slug . '/tasks/' . $task->task_slug)->with('error', 'No next list available');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board, Task $task)
    {
        $deleteTask = Task::where('id', $task->id)->where('board_id', $board->id)->where('user_id', auth()->user()->id)->delete();
        if ($deleteTask > 0) {
            return redirect('/boards/' . $board->board_slug)->with('success', 'Task successfully deleted');
        } else {
            return redirect('/boards/' . $board->board_slug)->with('error', 'Task failed to be deleted');
        }
    }

    public function checkSlug(Request $request)
    {
        $user = auth()->user()->username;
        $slug = SlugService::createSlug(Task::class, 'task_slug', $user . '-' . $request->task_title);
        return response()->json(['slug' => $slug]);
    }
}
