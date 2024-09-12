<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CompanyEmployeeController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\MesageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('404');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/user/inactive',function(){
    return view('inactiveUserError');
});



Route::controller(SuperAdminController::class)
    ->middleware('UserType:super admin')->group(function () {
    Route::get('/superAdmin/dashbord', 'superAdminDashbord')->name('superAdmin.dashbord');
    Route::post('/superAdmin/register', 'RegisterSuperAdmin')->name('RegisterSuperAdmin.save');
    Route::get('/superAdmin/details/{id}', 'superAdminDetails')->name('superAdmin.deails');
    Route::put('/superAdmin/details/update/{id}', 'superAdminUpdate')->name('superAdmin.details.update'); 
    Route::delete('/superAdmin/delete/{id}', 'deleteSuperAdmin')->name('superAdmin.SuperAdmin.delete');

    Route::get('/superAdmin/messages', 'ViewMessages')->name('superAdmin.messages.view');
    Route::get('/superAdmin/messages/{id}', 'ViewOneMessages')->name('superAdmin.one.messages.view');
    Route::put('/superAdmin/messages/ProblemResolvedOrNot/{id}', 'ProblemResolvedOrNot')->name('superAdmin.problem.resolved.or.not');

    Route::get('/superAdmin/announcements', 'ViewAnnouncements')->name('superAdmin.announcements.view');
    

    Route::get('/superAdmin/institute', 'ViewInstitute')->name('superAdmin.institute.view');
    Route::get('/superAdmin/institute/{id}', 'ViewOneInstitute')->name('superAdmin.one.institute.view');
    Route::put('/superAdmin/institute/{id}', 'instituteUpdate')->name('superAdmin.institute.update.view');
    Route::delete('/superAdmin/institute/{id}', 'instituteDelete')->name('superAdmin.institute.delete');

    Route::get('/superAdmin/logout', 'superAdminLogout')->name('superAdmin.logout');
});

Route::controller(SuperAdminController::class)
    ->middleware('UserType:super admin')->group(function () {
    Route::get('/superAdmin/users', 'ViewUsers')->name('superAdmin.users.view');
});

Route::controller(InstituteController::class)->group(function () {
    Route::post('/superAdmin/institute', 'RegisterInstitute')->name('RegisterInstitute.save');
});

Route::controller(CompanyEmployeeController::class)
    ->middleware('UserType:company employee')->group(function () {
    Route::get('/companyEmployee/dashboard', 'index')->name('dashboard');
    Route::get('/companyEmployee/message/{id}', 'messageView')->name('message');
});


Route::controller(MesageController::class)
    ->middleware('UserType:user')->group(function (){
    Route::post('/user/userDashbord', 'SaveMessage')->name('message.save');
    Route::get('/user/Message/{mid}', 'showOneMessage')->name('oneMessageForUser.show');
});


Route::controller(UserController::class)
    ->middleware('UserType:user')->group(function () {
    Route::get('/user/userDashbord', 'index')->name('user.index');
    Route::get('/user/logout', 'userLogout')->name('user.logout');
    
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user/details/{id}', 'oneUserDetailsForAdministrator')->name('user.details');
    Route::put('/user/details/update/{id}', 'UsersUpdate')->name('user.details.update'); 
    Route::delete('/user/delete/{id}', 'deleteUser')->name('user.delete');
});

//for super admin
Route::controller(UserController::class)
    ->middleware('UserType:super admin')->group(function () {
    Route::delete('/superAdmin/users/{id}', 'deleteUserForAdmin')->name('user.delete.for.admin');
    Route::get('/superAdmin/user/details/{id}', 'oneUserDetailsForSuperAdmin')->name('superAdmin.user.details'); 
});

//for administrator
Route::controller(UserController::class)->group(function () {
    Route::post('/administrator/users', 'RegisterUsers')->name('RegisterUser.save');
    Route::post('/superAdmin/users', 'RegisterUsers')->name('RegisterUser.save');
});


Route::controller(AdministratorController::class)
    ->middleware('UserType:administrator')->group(function () {
    Route::get('/administrator/dashboard', 'index')->name('administrator.index');
    Route::get('/administrator/messages', 'messages')->name('administrator.messages');
    Route::post('/administrator/messages/save', 'SaveMessageAdminisrator')->name('administrator.messages.save');

    Route::get('/administrator/Message/{mid}', 'showOneMessage')->name('oneMessageForAdministrator.show');
    Route::put('/administrator/Message/conform/{mid}', 'ConformMessage')->name('administrator.conform.message');
    Route::put('/administrator/Message/reject/{mid}', 'RejectMessage')->name('administrator.reject.message');
    Route::get('/administrator/announcements', 'announcements')->name('administrator.announcements');
    Route::get('/administrator/users', 'users')->name('administrator.users');
    Route::get('/administrator/logout', 'administratorLogout')->name('administrator.logout');

});



