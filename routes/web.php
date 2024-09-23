<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CompanyEmployeeController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\InstituteTypesController;
use App\Http\Controllers\AllMessagesController;
use App\Http\Controllers\ViewMessageController;
use App\Http\Controllers\LoacationController;
use App\Http\Controllers\DeviceDetectorController;


Route::get('/', function () {
    return view('auth.login');
});

route::get('/getDeviceDeatails', [DeviceDetectorController::class, 'getDeviceDeatails']);
route::get('/location', [LoacationController::class, 'getLocation']);

Route::get('/dashboard', function () {
    return view('inactiveUserError');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/user/inactive', function () {
    return view('inactiveUserError');
});


Route::controller(SuperAdminController::class)
    ->middleware('UserType:super admin')->group(function () {

        Route::get('/superAdmin/dashboard', 'superAdminDashboard')->name('superAdmin.dashboard');

        Route::post('/superAdmin/register', 'RegisterSuperAdmin')->name('RegisterSuperAdmin.save');

        //Company Employees Details Update and Delete routes
        Route::put('/company-employee/details/update/{id}', 'companyEmpUpdate')->name('companyEmp.details.update');
        Route::delete('/company-employee/delete/{id}', 'companyEmpDelete')->name('company.employee.delete');

        //Delete all company employees (Super Admins and Company Employees) route
        Route::delete('/company/employees/delete-all', 'deleteAllEmployees')->name('company.employees.deleteAll');

        //Displaying the institute details in Institute Management section route
        Route::get('/superAdmin/institute', 'ViewInstitute')->name('superAdmin.institute.view');

        //Institute administrators and employees show page route
        Route::get('/institute/{id}/employees/', 'viewInstituteEmployees')->name('institute.employees.view');

        //Institute administrators and employees delete route
        Route::delete('/institute-employee/delete/{id}', 'instituteEmpDelete')->name('institute.employee.delete');

        //Institute Details Update and Delete routes
        Route::put('/superAdmin/institute/{id}', 'instituteUpdate')->name('superAdmin.institute.update.view');
        Route::delete('/superAdmin/institute/{id}', 'instituteDelete')->name('superAdmin.institute.delete');

        Route::get('/superAdmin/messages', 'ViewMessages')->name('superAdmin.messages.view');
        Route::get('/superAdmin/messages/{id}', 'ViewOneMessages')->name('superAdmin.one.messages.view');
        Route::put('/superAdmin/messages/ProblemResolvedOrNot/{id}', 'ProblemResolvedOrNot')->name('superAdmin.problem.resolved.or.not');

        Route::get('/super-admin/password', 'changePassword')->name('super.admin.change.password');

        Route::get('/superAdmin/logout', 'superAdminLogout')->name('superAdmin.logout');
    });

Route::controller(SuperAdminController::class)->middleware('UserType:super admin')->group(function () {
    Route::get('/superAdmin/users', 'ViewUsers')->name('superAdmin.users.view');
});

// Define route for viewing a single message
Route::controller(ViewMessageController::class)->middleware('UserType:super admin')->group(function () {
    Route::get('/view-message/{id}', 'show')->name('superAdmin.one.messages.view');
    Route::post('/update-message-status/{id}', 'updateStatus')->name('update.message.status');
    Route::post('/update-message-priority/{id}', 'updatePriority')->name('update.message.priority');
    Route::post('/message/{id}/start', 'startTimer')->name('message.start');
    Route::post('/message/{id}/end', 'endTimer')->name('message.end');
    Route::post('/message/{id}/update', 'updateTimesAndStatus');
    Route::post('/messages/{id}/update-assigned-employee', 'updateAssignedEmployee')->name('update.assigned.employee');
    Route::post('/messages/{id}/update-progress-note', 'updateProgressNote')->name('update.progress.note');
    Route::post('/message/{id}/accept-sp-request', 'acceptSpRequest')->name('accept.sp_request');
});

// Super Admin All Messages Section (with filtering for assigned employee, priority, progress)
Route::controller(AllMessagesController::class)
    ->middleware('UserType:super admin')->group(function () {
        Route::get('/superAdmin/all-messages', [AllMessagesController::class, 'index'])->name('superAdmin.allmessages.view'); // Optional: Add query parameters for filtering
        Route::get('/superAdmin/all-messages/filter', [AllMessagesController::class, 'filter'])->name('messages.filter');
        Route::post('/superAdmin/messages/save', [AllMessagesController::class, 'store'])->name('superAdmin.messages.save');
});

Route::controller(InstituteController::class)->group(function () {
    Route::post('/superAdmin/institute', 'RegisterInstitute')->name('RegisterInstitute.save');
});


//Institute type CURD parts and routes.....
Route::controller(InstituteTypesController::class)->group(function () {
    Route::post('/superAdmin/institute-type/add', 'AddInstituteType')->name('AddInstituteType.save');
    Route::post('/superAdmin/institute-type/update', 'UpdateInstituteType')->name('UpdateInstituteType');
});





//Company employees routes....
Route::controller(CompanyEmployeeController::class)->middleware('UserType:company employee')->group(function () {
    Route::get('/companyEmployee/dashboard', 'index')->name('company.employee.dashbord');

    Route::get('/companyEmployee/message/{id}', 'messageView')->name('message');
    Route::post('/companyEmployee/message/{id}', 'messageView')->name('company.employee.messageView');
    Route::get('/companyEmployee/password', 'changePassword')->name('change.password');
});


//Institute employees message send routes....
//company employee view message and submit current time to message table
// Route::controller(MessageController::class)->middleware('UserType:user')->group(function (){
//     Route::post('/companyEmployee/message/{id}', 'messageView')->name('company.employee.messageView');
//     Route::get('/companyEmployee/password', 'changePassword')->name('change.password');
// });

Route::controller(MessageController::class)->middleware('UserType:user')->group(function () {
    Route::post('/user/dashboard', 'SaveMessage')->name('message.save');
    Route::get('/user/Message/{mid}', 'showOneMessage')->name('oneMessageForUser.show');
    //send support message details to message table
    Route::post('/user/Message/{mid}', 'sendSupportMessage')->name('send.support.message');
});

Route::controller(UserController::class)->middleware('UserType:user')->group(function () {
    Route::get('/user/dashboard', 'index')->name('user.index');
    //Show the user's previous send messages
    Route::get('/user/previous-messages', 'previousMessages')->name('user.previous.messages');
    Route::get('/user/logout', 'userLogout')->name('user.logout');
});




//for company side super admin
Route::controller(UserController::class)->middleware('UserType:super admin')->group(function () {
    Route::delete('/superAdmin/users/{id}', 'deleteUserForAdmin')->name('user.delete.for.admin');
    Route::get('/superAdmin/user/details/{id}', 'oneUserDetailsForSuperAdmin')->name('superAdmin.user.details');
});

//Institute administrator main controller.
Route::controller(AdministratorController::class)
    ->middleware('UserType:administrator')->group(function () {
        Route::get('/administrator/dashboard', 'index')->name('administrator.index');
        Route::get('/administrator/messages', 'messages')->name('administrator.messages');
        Route::post('/administrator/messages/save', 'SaveMessageAdministrator')->name('administrator.messages.save');
        Route::get('/administrator/Message/{mid}', 'showOneMessage')->name('oneMessageForAdministrator.show');
        Route::put('/administrator/Message/conform/{mid}', 'ConformMessage')->name('administrator.conform.message');
        Route::put('/administrator/Message/reject/{mid}', 'RejectMessage')->name('administrator.reject.message');

        //Institute side employees edit and delete routes.
        Route::put('/institute-employee/details/update/{id}', 'instituteEmpUpdate')->name('instituteEmp.details.update');
        Route::delete('/institute-employee/delete/{id}', 'instituteEmpDelete')->name('institute.employee.delete');

        Route::get('/administrator/announcements', 'announcements')->name('administrator.announcements');
        Route::get('/administrator/users', 'users')->name('administrator.users');

        Route::get('/administrator/password', 'changePassword')->name('administrator.change.password');

        Route::get('/administrator/logout', 'administratorLogout')->name('administrator.logout');
    });


//Company side and Institute side company employee registration routes
Route::controller(UserController::class)->group(function () {
    Route::post('/administrator/users', 'RegisterUsers')->name('RegisterUser.save');
    Route::post('/superAdmin/users', 'RegisterUsers')->name('RegisterUser.save');
});

//for administrators
Route::controller(UserController::class)->group(function () {
    Route::get('/user/details/{id}', 'oneUserDetailsForAdministrator')->name('user.details');
    Route::put('/user/details/update/{id}', 'UsersUpdate')->name('user.details.update');
    Route::delete('/user/delete/{id}', 'deleteUser')->name('user.delete');
});
