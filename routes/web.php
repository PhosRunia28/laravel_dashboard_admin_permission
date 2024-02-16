<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\backend\AmenitiesController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\PropertyTypeController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','roles:admin'])->group((function () {

    Route::controller(AdminController::class)->group(function() {
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::put('/admin/profile/update', 'AdminProfileUpdate')->name('admin.profile.update');
        Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::put('/admin/update/password', 'AdminUpdatePassword')->name('admin.password.update');

        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    });

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', "AllType")->name('all.type')->middleware("permission:all.type");
        Route::get('/add/type', "AddType")->name('add.type')->middleware("permission:add.type");
        Route::post('/store/type', "StoreType")->name('store.type');
        Route::get('/edit/type/{id}', "EditType")->name('edit.type')->middleware("permission:edit.type");
        Route::put('/update/type', "UpdateType")->name('update.type');
        Route::get('/delete/type/{id}', "DeleteType")->name('delete.type')->middleware("permission:delete.type");
    });

    Route::controller(AmenitiesController::class)->group(function () {
        Route::get('/all/amenities', "AllAmenities")->name('all.amenities')->middleware("permission:all.amenitie");
        Route::get('/add/amenities', "AddAmenities")->name('add.amenities')->middleware("permission:add.amenitie");
        Route::post('/store/amenities', "StoreAmenities")->name('store.amenities');
        Route::get('/edit/amenities/{id}', "EditAmenities")->name('edit.amenities')->middleware("permission:edit.amenitie");
        Route::put('/update/amenities', "UpdateAmenities")->name('update.amenities');
        Route::get('/delete/amenities/{id}', "DeleteAmenities")->name('delete.amenities')->middleware("permission:delete.amenitie");
    });

    Route::controller(PermissionController::class)->group(function () {
        Route::get('/all/permission', "AllPermission")->name('all.permission');
        Route::get('/add/permission', "AddPermission")->name('add.permission');
        Route::post('/store/permission', "StorePermission")->name('store.permission');
        Route::get('/edit/permission/{id}', "EditPermission")->name('edit.permission');
        Route::put('/update/permission', "UpdatePermission")->name('update.permission');
        Route::get('/delete/permission/{id}', "DeletePermission")->name('delete.permission');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', "AllRole")->name('all.roles');
        Route::get('/add/roles', "AddRole")->name('add.roles');
        Route::post('/store/roles', "StoreRole")->name('store.roles');
        Route::get('/edit/roles/{id}', "EditRole")->name('edit.roles');
        Route::put('/update/roles', "UpdateRole")->name('update.roles');
        Route::get('/delete/roles/{id}', "DeleteRole")->name('delete.roles');

        Route::get('/all/roles/permissions', "AllRolePermission")->name('all.roles.permission');
        Route::get('/add/roles/permissions', "AddRolePermission")->name('add.roles.permission');
        Route::post('/store/roles/permissions', "StoreRolePermission")->name('store.roles.permission');
        Route::get('/edit/roles/permissions/{id}', "EditRolePermission")->name('edit.roles.permission');
        Route::post('/update/roles/permissions/{id}', "UpdateRolePermission")->name('update.roles.permission');
    });
}));

Route::middleware(['auth','roles:agent'])->group((function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
}));

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

require __DIR__.'/auth.php';