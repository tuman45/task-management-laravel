<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;

class TaskController extends Controller
{
    public function showDetail(Board $board, Task $task)
    {
        return view('detail', [
            "title" => "Detail",
            "board" => $board,
            "details" => $task
        ]);
    }
}
