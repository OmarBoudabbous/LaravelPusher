<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\PanneController;
use Illuminate\Support\Facades\Route;



require __DIR__ . '/auth.php';

//Admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('admin/chef/{id}', [AdminController::class, 'getChefData'])->name('chef.data');
    Route::get('admin/ajouter/user', [AdminController::class, 'viewForAjouterChef'])->name('admin.chef');
    Route::post('admin/', [AdminController::class, 'ajouterChef'])->name('admin.chef.store');
    
    Route::get('admin/panne/{id}', [PanneController::class, 'getOnePanne'])->name('admin.panne');
    Route::put('/panne/update/{id}', [PanneController::class, 'update'])->name('admin.panne.update');
    Route::delete('/panne/{id}', [PanneController::class, 'destroy'])->name('admin.panne.destroy');
});
// for admin and chef
Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
    Route::get('/panne', [PanneController::class, 'index'])->name('panne');
    Route::post('/panne', [PanneController::class, 'store'])->name('panne.store');

});


//chef
Route::middleware(['auth', 'role:chef'])->group(function () {
    Route::get('/chef', [ChefController::class, 'index'])->name('chef.index');
});
