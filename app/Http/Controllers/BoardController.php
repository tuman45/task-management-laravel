<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BoardController extends Controller
{
    public function index()
    {
        return view('boards', [
            "title" => "Board",
            "boards" => Board::where('user_id', auth()->user()->id)->get()
        ]);
    }
}
