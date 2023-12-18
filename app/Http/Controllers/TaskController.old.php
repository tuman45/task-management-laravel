<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Board_list;
use App\Models\Task;

class TaskController extends Controller
{
    public function showTask(Board $board)
    {
        // Get all tasks related to the board
        $tasks = Task::with(['board', 'board_list'])->where('board_id', $board->id)->get();

        // Group tasks by board_list_id
        $groupedTasks = $tasks->groupBy('board_list_id');

        // Get board_lists in the desired order
        $boardLists = Board_list::where('board_id', $board->id)->orderBy('order')->get();

        return view('tasks', [
            "title" => "Tasks",
            "board" => $board,
            "groupedTasks" => $groupedTasks,
            "boardLists" => $boardLists,
        ]);
    }
    public function showDetail(Board $board, Task $task)
    {
        return view('detail', [
            "title" => "Detail",
            "board" => $board,
            "details" => $task
        ]);
    }
}
