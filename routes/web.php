<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clients', ClientController::class);
    Route::get('clients/{client}/timeline', [\App\Http\Controllers\ClientActivityController::class, 'timeline'])->name('clients.timeline');
    Route::resource('categories', CategoryController::class);
    
    Route::resource('files', FileController::class)->except(['edit', 'update']);
    Route::get('files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::get('files/{file}/preview', [FileController::class, 'preview'])->name('files.preview');
    Route::get('files/{file}/preview-page', [FileController::class, 'previewPage'])->name('files.preview-page');
    Route::put('files/{file}/status', [FileController::class, 'updateStatus'])->name('files.update-status');
    Route::post('files/{file}/toggle-lock', [FileController::class, 'toggleLock'])->name('files.toggle-lock');
    Route::post('files/{file}/upload-version', [FileController::class, 'uploadVersion'])->name('files.upload-version');
    Route::post('files/bulk-action', [FileController::class, 'bulkAction'])->name('files.bulk-action');
    
    Route::post('files/{file}/notes', [\App\Http\Controllers\FileNoteController::class, 'store'])->name('files.notes.store');
    Route::delete('file-notes/{fileNote}', [\App\Http\Controllers\FileNoteController::class, 'destroy'])->name('files.notes.destroy');
    
    Route::resource('file-requests', FileRequestController::class)->except(['edit', 'update']);
    
    Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->except(['show', 'create', 'edit']);
        Route::put('roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'updatePermissions'])->name('roles.update-permissions');
        
        Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->except(['show', 'create', 'edit']);
        
        Route::get('users', [\App\Http\Controllers\Admin\UserRoleController::class, 'index'])->name('users.index');
        Route::get('users/create', [\App\Http\Controllers\Admin\UserRoleController::class, 'create'])->name('users.create');
        Route::post('users', [\App\Http\Controllers\Admin\UserRoleController::class, 'store'])->name('users.store');
        Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserRoleController::class, 'destroy'])->name('users.destroy');
        Route::put('users/{user}/roles', [\App\Http\Controllers\Admin\UserRoleController::class, 'updateRoles'])->name('users.update-roles');
        
        Route::get('settings', [\App\Http\Controllers\Admin\SystemSettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [\App\Http\Controllers\Admin\SystemSettingsController::class, 'update'])->name('settings.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public file upload route (no authentication required)
Route::get('upload/{token}', [\App\Http\Controllers\PublicFileUploadController::class, 'show'])->name('file-requests.upload');
Route::post('upload/{token}', [\App\Http\Controllers\PublicFileUploadController::class, 'store']);

require __DIR__.'/auth.php';
