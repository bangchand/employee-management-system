<?php

namespace App\Http\Controllers;

use App\Http\Requests\KanbanBoardRequest;
use App\Models\KanbanBoard;
use App\Models\KanbanTask;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class KanbanBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kanbanboardID = $request->id ?  $request->id : 1;

        $kanbanboards = KanbanBoard::all(); // Perbaikan nama variabel 
        $todo = KanbanTask::where('kanban_boards_id', $kanbanboardID)
            ->where('status', 'todo')
            ->get();
        $progress = KanbanTask::where('kanban_boards_id', $kanbanboardID)
            ->where('status', 'progress')
            ->get();
        $done = KanbanTask::where('kanban_boards_id', $kanbanboardID)
            ->where('status', 'done')
            ->get();
        $users = User::whereHas('employeeDetails', function ($query) {
            $query->where('status', 'approve');
        })->with('employeeDetails')->get();

        $kanbanboard = KanbanBoard::where('id', $kanbanboardID)->first();
        return view('kanbanboard.index', compact('kanbanboards', 'kanbanboard', 'todo', 'progress', 'done', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KanbanBoardRequest $request)
    {
        KanbanBoard::create($request->validated());
        return redirect()->route('kanbanboard.index')->with('status', 'KanbanBoard berhasil disimpan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KanbanBoardRequest $request, KanbanBoard $kanbanboard)
    {
        $kanbanboard->update($request->validated());
        return redirect()->route('kanbanboard.index')->with('status', 'KanbanBoard berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KanbanBoard $kanbanboard)
    {
        $kanbanboard->delete();
        return redirect()->route('kanbanboard.index')->with('status', 'KanbanBoard berhasil dihapus.');
    }
}
