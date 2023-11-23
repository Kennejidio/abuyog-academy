<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentAdmissionController;
use App\Http\Controllers\StudentListController;
use App\Http\Controllers\StudentRequirementController;
use App\Http\Controllers\StudentViewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/test', function () {
    return view('backup.test');
});
Route::get('/', function () {
    if (Auth::user()) {
        if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Semi-admin')) {
            return redirect()->route('admin.dashboard', ['id' => Auth::user()->id]);
        } elseif (Auth::user()->hasRole('Student')) {
            return redirect()->route('students.dashboard', ['id' => Auth::user()->id]);
        }
    }
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('schoolyear', SchoolYearController::class);
    Route::resource('grade-level', GradeLevelController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('requirements', RequirementController::class);

    Route::get('/student-list/search', 'App\Http\Controllers\StudentListController@search')->name('student-list.search');
    Route::resource('student-list', StudentListController::class);

    Route::get('/student-requirements', [StudentRequirementController::class, 'index'])->name('student-requirements.index');
    Route::get('/student-requirements/show/{student}', [StudentRequirementController::class, 'show'])->name('student-requirements.show');
    Route::get('/student-requirements/create/{student}', [StudentRequirementController::class, 'create'])->name('student-requirements.create');
    Route::post('/student-requirements', [StudentRequirementController::class, 'store'])->name('student-requirements.store');
    Route::get('/student-requirements/{studentRequirement}/edit', [StudentRequirementController::class, 'edit'])->name('student-requirements.edit');
    Route::put('/student-requirements/{studentRequirement}', [StudentRequirementController::class, 'update'])->name('student-requirements.update');
    Route::delete('/student-requirements/{studentRequirement}', [StudentRequirementController::class, 'destroy'])->name('student-requirements.destroy');

    Route::get('/student-admit/search', 'App\Http\Controllers\StudentAdmissionController@search')->name('student-admit.search');
    Route::resource('student-admit', StudentAdmissionController::class);
    Route::put('student-admit/{temporaryStudent}/admit', [StudentAdmissionController::class, 'admit'])->name('student-admit.admit');
    Route::get('/admin/{id}/dashboard', [App\Http\Controllers\AdminViewController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/show/{student}', [EnrollmentController::class, 'show'])->name('enrollments.show');
    Route::get('/enrollments/create/{student}', [EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::get('/enrollments/{enrollment}/edit', [EnrollmentController::class, 'edit'])->name('enrollments.edit');
    Route::put('/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollments.update');
    Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

    Route::get('/billings', [BillingController::class, 'index'])->name('billings.index');
    Route::get('/billings/show/{student}', [BillingController::class, 'show'])->name('billings.show');
    Route::get('/billings/create/{student}', [BillingController::class, 'create'])->name('billings.create');
    Route::post('/billings', [BillingController::class, 'store'])->name('billings.store');
    Route::get('/billings/{billing}/edit', [BillingController::class, 'edit'])->name('billings.edit');
    Route::put('/billings/{billing}', [BillingController::class, 'update'])->name('billings.update');
    Route::delete('/billings/{billing}', [BillingController::class, 'destroy'])->name('billings.destroy');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/students/{id}/dashboard', [App\Http\Controllers\StudentViewController::class, 'dashboard'])->name('students.dashboard');
    Route::get('/students/{id}/form', [App\Http\Controllers\StudentViewController::class, 'showForm'])->name('students.form');
    Route::get('/students/{id}/edit', [App\Http\Controllers\StudentViewController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [App\Http\Controllers\StudentViewController::class, 'update'])->name('students.update');
    Route::get('/students/credentials', [StudentViewController::class, 'credentials'])->name('students.credentials');
    Route::get('/students/bills', [StudentViewController::class, 'bills'])->name('students.bills');
    Route::get('/settings', [StudentViewController::class, 'settings'])->name('students.settings');
    Route::post('/settings/update-password', [StudentViewController::class, 'updatePassword'])->name('students.updatePassword');

});

Route::get('/student-registration', [App\Http\Controllers\StudentRegistrationController::class, 'create'])->name('student.student-register');
Route::post('/student-store', [App\Http\Controllers\StudentRegistrationController::class, 'store'])->name('student.store');
