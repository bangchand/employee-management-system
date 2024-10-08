<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KanbanBoard;
use App\Models\Project;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class ProjectController extends Controller
{
    public function getAllProject()
    {
        // Get the currently logged-in user
        $user = Auth::guard('sanctum')->user();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        // Get the employee ID from the logged-in user's employee detail
        $employeeId = $user->employee_detail->id;

        // Get the list of projects assigned to the employee associated with the logged-in user
        $assignedProjects = ProjectAssignment::where('employee_id', $employeeId)
            ->with(['project.kanban_board.kanbantasks' => function ($query) use ($employeeId) {
                // Load only the Kanban tasks assigned to the employee
                $query->where('employee_id', $employeeId);
            }])
            ->get();

        // Extract the Kanban boards associated with the assigned projects
        $projects = $assignedProjects->map(function ($assignment) {
            return $assignment->project->kanban_board;
        })->filter()->unique()->values(); // Remove null values and unique Kanban boards

        // Format Kanban boards and tasks for response
        $formattedProjects = $projects->map(function ($assignedProject) {
            $project = Project::findOrFail($assignedProject->id);
            $assignedProjects = $project->projectAssignments;

            return [
                "id" => $project->id,
                "company_id" => $project->company_id,
                "name" => $project->name,
                "price" => $project->price,
                "description" => $project->description,
                "start_date" => $project->start_date,
                "end_date" => $project->end_date,
                "status" => $project->status,
                "assigned_projects" => $assignedProjects->map(function ($data) {
                    return [
                        "employee_id" => $data->employe->id,
                        "employee_name" => $data->employe->name, // Changed from id to name
                    ];
                }),
                "completed_at" => $project->completed_at,
            ];
        });

        return response()->json(['project' => $formattedProjects]);
    }

    public function show($id)
    {
        $project = Project::find($id);
        $assignedProjects = $project->projectAssignments->map(function ($employee) {
            return [
                'employee_id' => $employee->id,
                'employee_name' => $employee->employe->name,
            ];
        });

        if (!$project) {
            return response()->json([
                'message' => 'Project not found.'
            ], 404);
        }

        return response()->json([
            'id' => $project->id,
            'company_id' => $project->company_id,
            'name' => $project->name,
            'price' => $project->price,
            'description' => $project->description,
            'start_date' => $project->start_date,
            'end_date' => $project->end_date,
            'status' => $project->status,
            'employee_assigned' => $assignedProjects,
            'completed_at' => $project->completed_at,
        ]);
    }
}
