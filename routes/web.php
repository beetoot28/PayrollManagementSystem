<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);

Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::post('/get-status', [Controller::class, 'get_status'])->name('get-status');
    Route::post('/set-active-tab-reports', [ReportsController::class, 'set_active_tab_reports'])->name('set-active-tab-reports');

    //Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users-create', [UserController::class, 'create'])->name('create-users');
    Route::post('/users-store', [UserController::class, 'store'])->name('store-users');
    Route::get('/users-view/{id}', [UserController::class, 'show'])->name('view-user');
    Route::get('/users-edit/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::put('/users-update/{id}', [UserController::class, 'update'])->name('update-user');
    Route::post('/users-delete', [UserController::class, 'destroy'])->name('delete-user');

    //Employee
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee');
    Route::get('/employees-create', [EmployeeController::class, 'create'])->name('create-employee');
    Route::post('/employees-store', [EmployeeController::class, 'store'])->name('store-employee');
    Route::get('/employees-view/{id}', [EmployeeController::class, 'show'])->name('view-employee');
    Route::get('/employees-edit/{id}', [EmployeeController::class, 'edit'])->name('edit-employee');
    Route::put('/employees-update/{id}', [EmployeeController::class, 'update'])->name('update-employee');
    Route::delete('/employees-delete/{id}', [EmployeeController::class, 'destroy'])->name('delete-employee');

    // Attendance
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/attendances-create', [AttendanceController::class, 'create'])->name('create-attendances');
    Route::post('/attendances-store', [AttendanceController::class, 'store'])->name('store-attendances');
    Route::get('/attendances-view/{id}', [AttendanceController::class, 'show'])->name('view-attendances');
    Route::get('/attendances-edit/{id}', [AttendanceController::class, 'edit'])->name('edit-attendances');
    Route::put('/attendances-update/{id}', [AttendanceController::class, 'update'])->name('update-attendances');
    // Route::get('/import-attendance', [AttendanceController::class, 'import_attendance'])->name('import_attendance');
    Route::post('/upload-attendance', [AttendanceController::class, 'upload_attendance'])->name('upload_attendance');
    Route::get('/check-cutoff', [AttendanceController::class, 'check_cutoff'])->name('check_cutoff');
    Route::post('/process-time', [AttendanceController::class, 'process_time'])->name('process-time');


    //Payroll
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll');
    Route::get('/test_date_', [PayrollController::class, 'testing'])->name('test_date_');
    Route::post('/verify-authorization-code', [PayrollController::class, 'verify_authorization_code'])->name('verify-authorization-code');
    Route::post('/payrolls-store', [PayrollController::class, 'store'])->name('store-payrolls');
    Route::get('/payrolls-view/{id}', [PayrollController::class, 'show'])->name('view-payrolls');
    Route::post('/update-remarks', [PayrollController::class, 'update_remarks'])->name('update-remarks');
    Route::post('/check-currentdate', [PayrollController::class, 'check_currentdate'])->name('check-currentdate');
    Route::post('/get-payroll-period', [PayrollController::class, 'get_payroll_period'])->name('get-payroll-period');
    Route::post('/post-payroll', [PayrollController::class, 'post_payroll'])->name('post-payroll');

    Route::post('/show-drs', [PayrollController::class, 'show_drs'])->name('show-drs');
    Route::post('/update-dr-values', [PayrollController::class, 'update_dr_values'])->name('update-dr-values');
    Route::post('/update-otherdr-values', [PayrollController::class, 'update_otherdr_values'])->name('update-otherdr-values');
    Route::post('/update-duefrom-values', [PayrollController::class, 'update_duefrom_values'])->name('update-duefrom-values');


    //Loans
    Route::get('/loans', [LoanController::class, 'index'])->name('loan');
    Route::get('/loans-create', [LoanController::class, 'create'])->name('create-loans');
    Route::post('/loans-store', [LoanController::class, 'store'])->name('store-loans');
    Route::get('/loans-view/{id}', [LoanController::class, 'show'])->name('view-loans');
    Route::get('/loans-edit/{id}', [LoanController::class, 'edit'])->name('edit-loans');
    Route::put('/loans-update/{id}', [LoanController::class, 'update'])->name('update-loans');

    //Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings_set_authcode', [SettingsController::class, 'set_authorization_code'])->name('set-authcode');
    Route::post('/set-active-tab', [SettingsController::class, 'set_active_tab'])->name('set-active-tab');

    Route::post('/employee-dr-store', [SettingsController::class, 'store_employee_dr'])->name('employee-dr-store');
    Route::get('/view-employee-dr/{id}', [SettingsController::class, 'show_employee_dr'])->name('view-employee-dr');
    Route::post('/update-employee-dr', [SettingsController::class, 'update_employee_dr'])->name('update-employee-dr');
    Route::post('/delete-employee-dr', [SettingsController::class, 'delete_employee_dr'])->name('delete-employee-dr');

    Route::post('/employee-ocdr-store', [SettingsController::class, 'store_employee_ocdr'])->name('employee-ocdr-store');
    Route::get('/view-employee-ocdr/{id}', [SettingsController::class, 'show_employee_ocdr'])->name('view-employee-ocdr');
    Route::post('/update-employee-ocdr', [SettingsController::class, 'update_employee_ocdr'])->name('update-employee-ocdr');
    Route::post('/delete-employee-ocdr', [SettingsController::class, 'delete_employee_ocdr'])->name('delete-employee-ocdr');

    Route::post('/employee-duefrom-store', [SettingsController::class, 'store_employee_duefrom'])->name('employee-duefrom-store');
    Route::get('/view-employee-duefrom/{id}', [SettingsController::class, 'show_employee_duefrom'])->name('view-employee-duefrom');
    Route::post('/update-employee-duefrom', [SettingsController::class, 'update_employee_duefrom'])->name('update-employee-duefrom');
    Route::post('/delete-employee-duefrom', [SettingsController::class, 'delete_employee_duefrom'])->name('delete-employee-duefrom');

    Route::post('/employee-leavepay-store', [SettingsController::class, 'store_employee_leavepay'])->name('employee-leavepay-store');
    Route::get('/view-employee-leavepay/{id}', [SettingsController::class, 'show_employee_leavepay'])->name('view-employee-leavepay');
    Route::post('/update-employee-leavepay', [SettingsController::class, 'update_employee_leavepay'])->name('update-employee-leavepay');
    Route::post('/delete-employee-leavepay', [SettingsController::class, 'delete_employee_leavepay'])->name('delete-employee-leavepay');

    Route::post('/update-holiday-computations', [SettingsController::class, 'update_holiday_computations'])->name('update-holiday-computations');

    Route::post('/holiday-store', [SettingsController::class, 'holiday_store'])->name('holiday-store');
    Route::post('/holiday-update', [SettingsController::class, 'holiday_update'])->name('holiday-update');
    Route::post('/delete-holiday', [SettingsController::class, 'delete_holiday'])->name('delete-holiday');

    // Reports
    Route::get('/reports', [ReportsController::class, 'report_index'])->name('reports');
    Route::post('/get-loan-reports', [ReportsController::class, 'get_loan_reports'])->name('get-loan-reports');
});

require __DIR__.'/auth.php';
