<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Board_list;
use App\Models\Task;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($board_slug)
    {
        // Retrieve the board based on the provided slug
        $board = Board::where('board_slug', $board_slug)->firstOrFail();

        // Retrieve tasks and board_lists related to the board
        $tasks = Task::with(['board', 'board_list'])->where('board_id', $board->id)->get();
        $groupedTasks = $tasks->groupBy('board_list_id');
        $boardLists = Board_list::where('board_id', $board->id)->orderBy('order')->get();

        return view('tasks', [
            "title" => "Tasks",
            "board" => $board,
            "groupedTasks" => $groupedTasks,
            "boardLists" => $boardLists,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($board_slug, $taskSlug)
    {
        // Ambil board berdasarkan board_slug
        $board = Board::where('board_slug', $board_slug)->firstOrFail();

        // Ambil task berdasarkan task_slug dan board_id
        $task = Task::where('task_slug', $taskSlug)
            ->where('board_id', $board->id)
            ->first();

        if (!$task) {
            abort(404); // Task tidak ditemukan
        }

        return view('detail', [
            'title' => 'Detail',
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
