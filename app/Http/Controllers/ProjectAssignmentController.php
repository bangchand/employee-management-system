<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Models\EmployeeDetail;
use App\Models\Project;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;

class ProjectAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProjectAssignment::query();

        // Pencarian
        $search = $request->input('search');
        if ($search) {
            $query->search($search); // Menggunakan scope search dari model
        }

        // Sorting
        $sortBy = $request->get('sortBy', 'created_at'); // Kolom default yang valid
        $sortDirection = $request->get('sortDirection', 'asc'); // Arah default
        $query->orderBy($sortBy, $sortDirection);

        $project = Project::all();
        $employee = EmployeeDetail::all();
        $projectAssignment = $query->paginate(5);
        $projectAssignment->appends($request->all());

        return view('projectAssignments.index', compact('project', 'employee', 'projectAssignment', 'sortBy', 'sortDirection', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentRequest $request)
    {
        ProjectAssignment::create($request->validated());
        return redirect()->route('projectAssignments.index')->with('success', 'Berhasil menambah data');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignmentRequest $request, ProjectAssignment $projectAssignment)
    {
        $projectAssignment->update($request->validated());
        return redirect()->route('projectAssignments.index')->with('success', 'Project berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectAssignment $projectAssignment)
    {
        $projectAssignment->delete();
        return redirect()->route('projectAssignments.index')->with('danger', 'Data berhasil dihapus');
    }
}
