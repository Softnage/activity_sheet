<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeeklyActivityController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ActivityExportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/weekly-activities', [WeeklyActivityController::class, 'index'])->name('weekly.activities');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // View all tasks or activities assigned to users
    Route::get('/admin/tasks', [AdminController::class, 'viewAllTasks'])->name('admin.viewAllTasks');
    Route::get('/admin/activities', [AdminController::class, 'viewAllActivities'])->name('admin.viewAllActivities');
    Route::get('/admin/activities/{activity}/edit', [AdminController::class, 'editActivity'])->name('admin.editActivity');
    Route::delete('/admin/activities/{activity}', [AdminController::class, 'deleteActivity'])->name('admin.deleteActivity');
    Route::put('/admin/activities/{activity}', [AdminController::class, 'updateActivity'])->name('admin.updateActivity');

    // Manage Users
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    // Assign Tasks
    Route::get('/admin/assign-task', [AdminController::class, 'showAssignTaskForm'])->name('admin.assign-task'); // Show form to assign task
    Route::post('/admin/assign-task', [AdminController::class, 'storeTask'])->name('admin.tasks.store'); // Store assigned task
});

Route::middleware(['auth'])->group(function () {
    Route::get('/activities/export/csv', [ActivityExportController::class, 'exportCsv'])->name('activities.export.csv');
    Route::get('/activities/export/pdf', [ActivityExportController::class, 'exportPdf'])->name('activities.export.pdf');
    // User can view their tasks
    Route::get('/tasks', [TaskController::class, 'showAssignedTasks'])->name('activities.tasks');
    Route::delete('/tasks/{taskId}/delete', [TaskController::class, 'deleteTask'])->name('tasks.delete');
    // User can mark a task as received
    Route::patch('/tasks/{taskId}/received', [TaskController::class, 'markAsReceived'])->name('activities.tasks.received');
});


Route::middleware('auth')->group(function () {
    // Route to show the form for creating a new activity
    Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    // Route to store the activity
    Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::put('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');

});

require __DIR__.'/auth.php';
