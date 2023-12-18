<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Board_list;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = Board::latest()->where('user_id', auth()->user()->id)->get();

        return view('boards.index', [
            'title' => 'Board',
            'user' => auth()->user(),
            'boards' => $boards,
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
        $validatedData = $request->validate([
            'board_name' => 'required',
            'board_slug' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        try {
            DB::beginTransaction();

            $board = Board::create($validatedData);
            $order = 1;
            $list_names = ['To Do', 'Doing', 'Done'];

            foreach ($list_names as $list_name) {
                Board_list::create([
                    'board_id' => $board->id,
                    'user_id' => auth()->user()->id,
                    'list_name' => $list_name,
                    'order' => $order,
                ]);
                $order++;
            }

            DB::commit();

            return redirect('/')->with('success', 'New board successfully created');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/')->with('error', 'Failed to create board ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        $boardLists = Board_list::where('board_id', $board->id)->get();
        $tasks = Task::where('board_id', $board->id)->get();
        $groupedTasks = $tasks->groupBy('board_list_id');

        $title = 'Tasks';
        return view('boards.show', compact('board', 'boardLists', 'groupedTasks', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board)
    {
        $validatedData = $request->validate([
            'board_name' => 'required',
            'board_slug' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Board::where('id', $board->id)->update($validatedData);

        return redirect('/boards/' . $validatedData['board_slug'])->with('success', 'Board successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        if (!$board) {
            abort(404, 'Board not found.');
        }

        try {
            DB::beginTransaction();
            Task::where('board_id', $board->id)->delete();

            Board_list::where('board_id', $board->id)->delete();
            $board->delete();

            DB::commit();

            return redirect('/')->with('success', 'Board successfully deleted');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/')->with('error', 'Failed to delete board: ' . $e->getMessage());
        }
    }

    public function checkSlug(Request $request)
    {
        $user = auth()->user()->username;
        $slug = SlugService::createSlug(Board::class, 'board_slug', $user . '-' . $request->board_name);
        return response()->json(['slug' => $slug]);
    }
}
