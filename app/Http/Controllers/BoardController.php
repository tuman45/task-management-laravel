<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BoardController extends Controller
{
    public function index()
    {
        return view('board', [
            "title" => "Board",
            "boards" => Board::where('user_id', 0)->get()
        ]);
    }

    public function show(Board $board)
    {
        return view('board', [
            "title" => "Board",
            "boards" => $board
        ]);
    }
}
