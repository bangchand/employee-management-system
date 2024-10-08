<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeDetailController;
use App\Http\Controllers\KanbanBoardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\KanbanTaskController;
use App\Http\Controllers\ProjectAssignmentController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TransactionController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');


Route::middleware('guest')->group(function () {
    Route::get('confirmation', function () {
        return view('confirmation');
    })->name('confirmation');
});

Route::get('/invitation', function () {
    return view('invitation');
})->name('invitation');

Route::get('/apply_or_invite', [RegisteredUserController::class, 'apply_or_invite'])->name('apply_or_invite');

Route::middleware('auth')->group(function () {

    Route::middleware(['role:manager', 'auth', 'check_location'])->group(function () {

        Route::prefix('manager')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            // route attendence
            Route::get('/mark-absentees', [AttendanceController::class, 'markAbsentees']);

            route::post('/kanban-tasks/update-order', [KanbanTaskController::class, 'updateOrder'])->name('kanban-tasks.update-order');
            Route::post('/kanban-tasks/update-status', [KanbanTaskController::class, 'updateStatus'])->name('kanban-tasks.update-status');

            Route::get('dashboard', [DashboardController::class, 'index'])->name('manager.dashboard');

            Route::resource('project-assignments', ProjectAssignmentController::class);
            Route::post('department/restore/{id}', [DepartmentController::class, 'restore'])->name('departments.restore');
            Route::resource('departments', DepartmentController::class);
            Route::resource('salaries', SalaryController::class);

            Route::resource('transactions', TransactionController::class);
            Route::get('transaction/export', [TransactionController::class, 'export'])->name('transaction.export');

            Route::get('/getEmployeeSalary/{employeeId}', [SalaryController::class, 'getEmployeeSalary'])->name('salary.getEmployeeSalary');

            Route::resource('positions', PositionController::class);


            // Route::resource('attendance', AttendanceController::class);
            Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
            Route::get('attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');


            Route::resource('employees', EmployeeDetailController::class);

            Route::patch('/projects/{id}/complete', [ProjectController::class, 'mark_completed'])->name('projects.complete');
            Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
            Route::resource('projects', ProjectController::class);
            Route::get('/get-employees/{department_id}', [ProjectController::class, 'getEmployees']);

            Route::get('/candidates', [UserController::class, 'index'])->name('candidates.index');
            Route::patch('/invite/{company}', [CompanyController::class, 'reset_invite'])->name('invited.reset');

            Route::get('/candidates/cv/{applicant}', [UserController::class, 'cv'])->name('candidates.cv');
            Route::get('/candidates/detail/{applicant}', [UserController::class, 'detail'])->name('candidates.detail');
            Route::patch('/candidates/reject/{applicant}', [UserController::class, 'reject'])->name('candidates.reject');
            Route::patch('/candidates/update/{applicant}', [UserController::class, 'update'])->name('candidates.update');

            Route::patch('/company/{company}', [CompanyController::class, 'reset_code'])->name('companies.reset');
            Route::patch('/company', [CompanyController::class, 'updateOfficeHour'])->name('update.officeHour');

            route::get('/leave-requests/calendar', [LeaveRequestController::class, 'calendar'])->name('calendar');
            Route::put('/leave-requests/{id}/approve', [LeaveRequestController::class, 'approve'])->name('leave-requests.approve');
            Route::post('/leave-requests/{id}/reject', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');

            Route::patch('company-location/update', [RegisteredUserController::class, 'store_location'])
                ->name('company.location.update');
        });
    });

    Route::middleware(['role:manager', 'check_exists_location'])->group(function () {
        Route::get('company-location', [RegisteredUserController::class, 'setup_location'])
            ->name('company.location.setup');
        Route::patch('company-location', [RegisteredUserController::class, 'store_location'])
            ->name('company.location.store');
    });

    Route::middleware('role:employee')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'userDashboard'])->name('employee.dashboard');
            Route::get('/my-projects', [ProjectController::class, 'myProjects'])->name('project.user');

            Route::get('/attendance', [AttendanceController::class, 'user_index'])->name('attendance.user');
            Route::post('/attendance-mark', [AttendanceController::class, 'user_attendance'])->name('attendance.mark');
            Route::get('/employee-list', [EmployeeDetailController::class, 'user_index'])->name('employee.user');
        });
    });

    Route::patch('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::resource('notifications', NotificationController::class);

    Route::resource('leave-requests', LeaveRequestController::class);
    Route::resource('kanban-boards', KanbanBoardController::class);
    Route::resource('kanban-tasks', KanbanTaskController::class);

    Route::post('comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::put('comment/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comment/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php';
