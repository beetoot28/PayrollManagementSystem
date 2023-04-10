<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employees;
use App\Models\EmployeeDetails;
use App\Models\Loans;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){
        $total_employees = Employees::where('employee_id', '<>', 0)->count();
        $total_departments = EmployeeDetails::all()->groupBy('department')->count();
        $total_active_employees = EmployeeDetails::where('employment_status', '<>', 'Resigned')->count();
        $total_active_loans = Loans::where('is_paid', '<>', true)->count();


        return view('dashboard', [
           'total_employees' => $total_employees,
           'total_departments' => $total_departments,
           'total_active_employees' => $total_active_employees,
           'total_active_loans' => $total_active_loans,
        ]);
    }

    public function get_status(Request $request){
        $_current_user = User::where('id', $request->user_id)->first();

        if($_current_user->is_login == true){
            $current_user = User::find($request->user_id);
            $current_user->is_login = false;
            $current_user->save();
        }

        return $_current_user->is_login;
    }
}


