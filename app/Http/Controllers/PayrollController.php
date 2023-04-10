<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollDetails;
use App\Models\Cutoff;
use App\Models\Attendances;
use App\Models\Employees;

use App\Models\EmployeeDr;
use App\Models\OtherCompanyDr;
use App\Models\DueFrom;

use App\Models\Holiday;
use App\Models\HolidayComputations;
use App\Models\KindsOfComputations;

use App\Models\EmployeeLeavePay;

use App\Models\ContributionEF;
use App\Models\ContributionSSS;
use App\Models\ContributionHDMF;
use App\Models\ContributionPhilHealth;

use App\Models\Loans;
use App\Models\LoanPayments;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;
use DateTime;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->query('p_start_date') && request()->query('p_end_date')){
            $sd = date('Y-m-d', strtotime(request()->query('p_start_date')));
            $ed = date('Y-m-d', strtotime(request()->query('p_end_date')));
            $cutoff_records = Cutoff::where('cutoff_date', '>=' ,$sd)->where('cutoff_date', '<=', $ed)->pluck('cutoff_id');
            $cutoff_ids = [];
            foreach ($cutoff_records as $key => $value) {
                $cutoff_ids[$key] = $value;
            }

            $payroll_records = Payroll::whereIn('cutoff_id', $cutoff_ids)->orderBy('payroll_id', 'desc')->get()->unique('cutoff_id');
        }
        else {
            $payroll_records = Payroll::orderBy('payroll_id', 'desc')->get()->unique('cutoff_id');
        }

        $_cutoff = Cutoff::pluck('cutoff_id');
        $_payroll_cutoffs = Payroll::groupBy('cutoff_id')->pluck('cutoff_id');

        $cutoff = [];
        foreach ($_cutoff as $key => $value) {
            $cutoff[$key] = $value;
        }

        $payroll_cutoffs = [];
        foreach ($_payroll_cutoffs as $key => $value) {
            $payroll_cutoffs[$key] = $value;
        }

        $qualified_cutoff_ids = [];
        $counter_1 = 0;
        for ($i=0; $i < sizeof($cutoff) ; $i++) {
            if(!in_array($cutoff[$i], $payroll_cutoffs) ){
                $qualified_cutoff_ids[$counter_1] = $cutoff[$i];
                $counter_1++;
            }
        }

        $qualified_cutoff_dates = [];
        for ($i=0; $i < sizeof($qualified_cutoff_ids); $i++) {
            $_date = Cutoff::where('cutoff_id', $qualified_cutoff_ids[$i])->first();
            $qualified_cutoff_dates[$i] = $_date->cutoff_id;
        }

        return view('modules.payroll.payroll', [
            'payroll_records' => $payroll_records,
            'qualified_cutoff_dates' => $qualified_cutoff_dates,
        ]);
    }

    public function verify_authorization_code(Request $request)
    {
        $passcode_obj = Settings::where('id', 1)->first();
        $decrypted_code = Crypt::decryptString($passcode_obj->authorization_code);

        if($decrypted_code == $request->authorization_code){
            return 'true';
        }
        else {
            return 'false';
        }
        // return $decrypted_code.' '.$request->authorization_code;
    }

    public function check_currentdate(Request $request){
        $cutoff = Cutoff::where('cutoff_id', $request->cutoff_id)->first();
        $cutoff_date = date('Y-m-d', strtotime($cutoff->cutoff_date));
        $current_date = date('Y-m-d');

        $flag = 'false';
        if($current_date < $cutoff_date){
            $flag = 'true';
        }

        return $flag;
    }

    public function get_payroll_period(Request $request){
        $_date_range = Attendances::where('cutoff_id', $request->cutoff_id)->pluck('date_in');
        $_date_range_arr = [];
        foreach ($_date_range as $key => $value) {
            $_date_range_arr[$key] = date('Y-m-d', strtotime($value));
        }

        return date('F j', strtotime(min($_date_range_arr))).' to '.date('F j', strtotime(max($_date_range_arr))).', '.date('Y', strtotime(min($_date_range_arr)));
    }

    public function post_payroll(Request $request){
        $payroll_records = Payroll::where('cutoff_id', $request->cutoff_id)->get();
        foreach ($payroll_records as $key => $value) {
            $row = Payroll::where('payroll_id', $value->payroll_id)->where('cutoff_id', $request->cutoff_id)->first();
            $row->status = true;
            $row->save();
        }
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all employee number in attendances based on cutoff
        $employee_numbers = Attendances::where('cutoff_id', $request->cutoff_id)->groupBy('employee_no')->pluck('employee_no');

        // DTR Static
        $_start_time_am = strtotime("8:00:00 AM");
        $_end_time_am = strtotime("12:00:00 PM");
        $_start_time_pm = strtotime("1:00:00 PM");
        $_end_time_pm = strtotime("5:00:00 PM");
        $_start_ot = strtotime("5:01:00 PM");
        // DTR Static

        // Get holidays for the month
        $_holidays = $this->get_holidays($request->cutoff_id);

        // Get rest days (SUNDAY)
        $_rest_days = $this->get_rest_days($request->cutoff_id);

        // Working days
        $_working_days = $this->working_days($request->cutoff_id);

        // $_employee_code = null;
        foreach ($employee_numbers as $key => $value) {
            /**
             *
             *
             * Payroll Details
             *
             */
            $working_hours = 0;
            $working_hours_overtime = 0;

            $working_hours_holiday = 0;
            $working_days_no_overtime = 0;

            $total_working_hours_no_overtime = 0;
            $total_working_hours_with_overtime = 0;
            $total_working_hours_overtime = 0;

            //Pays
            $regular_pay = 0;
            $overtime_pay = 0;

            $legal_holiday_pay = 0;
            $special_holiday_pay = 0;
            $double_legal_holiday_pay = 0;

            $overtime_legal_holiday_pay = 0;
            $overtime_special_holiday_pay = 0;
            $overtime_double_legal_holiday_pay = 0;

            $gross_pay = 0;
            $net_pay = 0;


            // Attendance ID array
            $attendance_id_overtime = [];

            // Per employee attendances
            $employee_attendances = Attendances::where('employee_no', $value)->where('cutoff_id', $request->cutoff_id)->get();
            // Employee Details
            $employee_details = Employees::where('employee_code', $value)->with('EmployeeDetails')->first();
            // Basic Wage
            $employee_basic_wage = $employee_details->EmployeeDetails->basic_rate;
            // Allowance
            $employee_allowance = $employee_details->EmployeeDetails->allowance;
            // SSS Contribution
            $sss_contribution_amount = $employee_details->EmployeeDetails->sss_contribution;
            // Philhealth Contribution
            $philhealth_contribution_amount = $employee_details->EmployeeDetails->philhealth_contribution;
            // EF Contribution
            $ef_contribution_amount = $employee_details->EmployeeDetails->ef_contribution;
            // HDMF Contribution
            $hdmf_contribution_amount = $employee_details->EmployeeDetails->hdmf_contribution;
            // Rate per hour
            $rate_per_hour = round($employee_details->EmployeeDetails->basic_rate / 8, 2);
            // Allowed for overtime pay
            $is_overtime_pay = $employee_details->EmployeeDetails->with_ot_pay;
            // Holiday ID
            $holiday_id = 0;
            // Holiday Type
            $holiday_type = null;
            $pay = null;

            // Employee Loans
            $employee_loans = Employees::where('employee_code', $value)->with('Loans')->first();

            // Computation of total working hours
            foreach ($employee_attendances as $key1 => $value1) {
                $working_hours_overtime = null;
                if(in_array($value1->date_in, $_holidays)){
                    $working_hours = $this->get_working_hours($value1, $_start_time_am, $_end_time_am, $_start_time_pm, $_end_time_pm);
                    $working_hours_overtime = $this->get_working_hours_overtime($value1, $_start_ot);

                    // Get holiday ID and Type
                    $holiday_object = Holiday::where('holiday_date', $value1->date_in)->first();
                    $holiday_id = $holiday_object->id;
                    $holiday_type = $holiday_object->holiday_type;

                    // Rest Day
                    $is_rest_day = false;
                    if(in_array($value1->date_in, $_rest_days)){
                        $is_rest_day = true;
                    }

                    // Is Worked
                    if(in_array($value1->date_in, $_working_days)){
                        // Special
                        if($holiday_type == 0){
                            // Overtime
                            if($working_hours_overtime > 0){
                                $holiday_computation = HolidayComputations::where('computation_id', 4)->first();
                                $koc_id_2 = $holiday_computation->computation_field2;
                                $koc_id_5 = $holiday_computation->computation_field5;
                                $field2 = ($koc_id_2 == 1 || $koc_id_2 == 5 ? $employee_basic_wage : ($koc_id_2 == 3 || $koc_id_2 == 6 ? $rate_per_hour : ($koc_id_2 == 4 ? $working_hours_overtime : ($koc_id_2 == 7 ? $employee_allowance : ($koc_id_2 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field3 = (int)(substr($holiday_computation->computation_field3, 0, -1));
                                $field4 = (int)(substr($holiday_computation->computation_field4, 0, -1));
                                $field5 = ($koc_id_5 == 1 || $koc_id_5 == 5 ? $employee_basic_wage : ($koc_id_5 == 3 || $koc_id_5 == 6 ? $rate_per_hour : ($koc_id_5 == 4 ? $working_hours_overtime : ($koc_id_5 == 7 ? $employee_allowance : ($koc_id_5 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $pay = ($field2 * ($field3 / 100) * ($field4 / 100) * $field5);
                            }
                            // No Overtime
                            else{
                                $holiday_computation = HolidayComputations::where('computation_id', 3)->first();
                                $koc_id = $holiday_computation->computation_field2;
                                $field2 = ($koc_id == 1 || $koc_id == 5 ? $employee_basic_wage : ($koc_id == 3 || $koc_id == 6 ? $rate_per_hour : ($koc_id == 4 ? $working_hours_overtime : ($koc_id == 7 ? $employee_allowance : ($koc_id == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field3 = (int)(substr($holiday_computation->computation_field3, 0, -1));
                                $field4 = (int)$employee_details->EmployeeDetails->allowance;
                                $pay = ($field2 * ($field3 / 100)) + $field4;
                            }
                        }
                        // Legal
                        else if($holiday_type == 1){
                            if($working_hours_overtime > 0){
                                $holiday_computation = HolidayComputations::where('computation_id', 9)->first();
                                $koc_id_2 = $holiday_computation->computation_field2;
                                $koc_id_5 = $holiday_computation->computation_field5;
                                $field2 = ($koc_id_2 == 1 || $koc_id_2 == 5 ? $employee_basic_wage : ($koc_id_2 == 3 || $koc_id_2 == 6 ? $rate_per_hour : ($koc_id_2 == 4 ? $working_hours_overtime : ($koc_id_2 == 7 ? $employee_allowance : ($koc_id_2 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field3 = (int)(substr($holiday_computation->computation_field3, 0, -1));
                                $field4 = (int)(substr($holiday_computation->computation_field4, 0, -1));
                                $field5 = ($koc_id_5 == 1 || $koc_id_5 == 5 ? $employee_basic_wage : ($koc_id_5 == 3 || $koc_id_5 == 6 ? $rate_per_hour : ($koc_id_5 == 4 ? $working_hours_overtime : ($koc_id_5 == 7 ? $employee_allowance : ($koc_id_5 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $pay = ($field * ($field3 / 100) * ($field4 / 100) * $field5);
                            }
                            // No Overtime
                            else{
                                $holiday_computation = HolidayComputations::where('computation_id', 8)->first();
                                $koc_id_2 = $holiday_computation->computation_field2;
                                $koc_id_3 = $holiday_computation->computation_field3;
                                $field2 = ($koc_id_2 == 1 || $koc_id_2 == 5 ? $employee_basic_wage : ($koc_id_2 == 3 || $koc_id_2 == 6 ? $rate_per_hour : ($koc_id_2 == 4 ? $working_hours_overtime : ($koc_id_2 == 7 ? $employee_allowance : ($koc_id_2 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field3 = ($koc_id_3 == 1 || $koc_id_3 == 5 ? $employee_basic_wage : ($koc_id_3 == 3 || $koc_id_3 == 6 ? $rate_per_hour : ($koc_id_3 == 4 ? $working_hours_overtime : ($koc_id_3 == 7 ? $employee_allowance : ($koc_id_3 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field4 = (int)(substr($holiday_computation->computation_field4, 0, -1));
                                $pay = (($field2 + $field3) + $field4);
                            }
                        }
                        // Double Legal
                        else if($holiday_type == 2){

                        }
                        else {
                            $pay = 0;
                        }
                    }
                    else{
                        // Special
                        if($holiday_type == 0){

                        }
                        // Legal
                        else if($holiday_type == 1){
                            if($working_hours_overtime > 0){

                            }
                            // No Overtime
                            else{
                                $holiday_computation = HolidayComputations::where('computation_id', 7)->first();
                                $koc_id_2 = $holiday_computation->computation_field2;
                                $koc_id_3 = $holiday_computation->computation_field3;
                                $field2 = ($koc_id_2 == 1 || $koc_id_2 == 5 ? $employee_basic_wage : ($koc_id_2 == 3 || $koc_id_2 == 6 ? $rate_per_hour : ($koc_id_2 == 4 ? $working_hours_overtime : ($koc_id_2 == 7 ? $employee_allowance : ($koc_id_2 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field3 = ($koc_id_3 == 1 || $koc_id_3 == 5 ? $employee_basic_wage : ($koc_id_3 == 3 || $koc_id_3 == 6 ? $rate_per_hour : ($koc_id_3 == 4 ? $working_hours_overtime : ($koc_id_3 == 7 ? $employee_allowance : ($koc_id_3 == 8 ? ($working_hours + $working_hours_overtime) : '')))));
                                $field4 = (int)(substr($holiday_computation->computation_field4, 0, -1));
                                $pay = (($field2 + $field3) + $field4);
                            }
                        }
                        // Double Legal
                        else if($holiday_type == 2){

                        }
                    }

                    $payrolldetails = PayrollDetails::create([
                        'cutoff_id' => $request->cutoff_id,
                        'employee_id' => $employee_details->employee_id,
                        'attendance_id' => $value1->attendance_id,
                        'working_hours' => $this->get_working_hours($value1, $_start_time_am, $_end_time_am, $_start_time_pm, $_end_time_pm),
                        'working_hours_overtime' => $working_hours_overtime == 0 ? null : $working_hours_overtime,
                        'holiday_type' => $holiday_type,
                        'is_restday' => in_array($value1->date_in, $_rest_days) ? true : false,
                        'is_work' => in_array($value1->date_in, $_working_days) ? true : false,
                        'pay' => $pay,
                    ]);

                    $holiday_type = null;
                    $pay = null;
                }
                else{
                    $working_hours = $this->get_working_hours($value1, $_start_time_am, $_end_time_am, $_start_time_pm, $_end_time_pm);
                    if($this->get_working_hours_overtime($value1, $_start_ot) > 0) {
                        $working_hours_overtime = $this->get_working_hours_overtime($value1, $_start_ot);
                    }

                    $payrolldetails = PayrollDetails::create([
                        'cutoff_id' => $request->cutoff_id,
                        'employee_id' => $employee_details->employee_id,
                        'attendance_id' => $value1->attendance_id,
                        'working_hours' => $this->get_working_hours($value1, $_start_time_am, $_end_time_am, $_start_time_pm, $_end_time_pm),
                        'working_hours_overtime' => $working_hours_overtime,
                        'holiday_type' => null,
                        'is_restday' => in_array($value1->date_in, $_rest_days) ? true : false,
                        'is_work' => in_array($value1->date_in, $_working_days) ? true : false,
                        'pay' => $working_hours_overtime == 0 || $working_hours_overtime == null ? null : ($rate_per_hour * $working_hours_overtime),
                    ]);
                }
            }

            /**
             *
             *
             * Payroll
             *
             */

            $p_cutoff_id = $request->cutoff_id;
            $p_employee_id = $employee_details->employee_id;
            $p_employee_code = $employee_details->employee_code;
            $p_no_working_days = $this->get_total_working_days($p_cutoff_id, $p_employee_id);
            $p_holiday_pay = $this->get_total_pay($p_cutoff_id, $p_employee_id, 'holiday pay', $is_overtime_pay);
            $p_overtime_pay = $this->get_total_pay($p_cutoff_id, $p_employee_id, 'overtime pay', $is_overtime_pay);
            $p_holiday_overtime_pay = $this->get_total_pay($p_cutoff_id, $p_employee_id,'holiday overtime pay', $is_overtime_pay);

            $p_absences = $this->get_total_absences($p_cutoff_id, $employee_details->employee_code);
            $p_absences_amount = $this->get_absences_amount($p_cutoff_id, $employee_details->employee_code, $employee_basic_wage);

            $p_undertime = $this->get_undertime($p_cutoff_id, $employee_details->employee_code);

            $p_undertime_amount = $this->get_undertime_amount($p_cutoff_id, $employee_details->employee_code, $employee_basic_wage);

            $total_drs = $this->get_total_drs($employee_details->employee_id, $p_cutoff_id);
            $total_otherdr = $this->get_total_drs_to_other_company($employee_details->employee_id, $p_cutoff_id);
            $total_duefrom = $this->get_total_due_from($employee_details->employee_id, $p_cutoff_id);

            $leave_pays = $this->get_leave_pays($employee_details, $p_cutoff_id);

            $sss_contribution = $this->set_contribution_sss($request->cutoff_id, $employee_details->employee_id, $sss_contribution_amount);
            $philhealth_contribution = $this->set_contribution_philhealth($request->cutoff_id, $employee_details->employee_id, $philhealth_contribution_amount);
            $hdmf_contribution = $this->set_contribution_hdmf($request->cutoff_id, $employee_details->employee_id, $hdmf_contribution_amount);
            $ef_contribution = $this->set_contribution_ef($request->cutoff_id, $employee_details->employee_id, $ef_contribution_amount);

            // Computation
            $drs_deduction = ($total_drs + $total_otherdr + $total_duefrom);
            $contribution_deduction = ($sss_contribution_amount + $philhealth_contribution_amount + $hdmf_contribution_amount + $ef_contribution_amount);
            $loan_deduction = $this->set_loan_payment($employee_loans->loans, $request->cutoff_id);

            $total_allowance = $this->get_total_allowance($p_cutoff_id, $employee_details);

            $salary = ($p_no_working_days * $employee_basic_wage);
            $gross_pay = ($salary + $p_holiday_pay + $p_overtime_pay + $p_holiday_overtime_pay + $leave_pays + $total_allowance);
            $total_deductions = ($p_undertime_amount + $contribution_deduction + $drs_deduction + $loan_deduction);
            $net_salary = ($gross_pay - $total_deductions);

            $payroll_cycle = $this->get_payroll_cycle($request->cutoff_id);

            $payrollheader = Payroll::create([
                'cutoff_id' => $p_cutoff_id,
                'employee_code' => $p_employee_code,
                'employee_id' => $p_employee_id,
                'no_of_workingdays' => $p_no_working_days,
                'holiday_pay' => $p_holiday_pay,
                'overtime_pay' => $p_overtime_pay,
                'holiday_overtime_pay' => $p_holiday_overtime_pay,
                'absences' => $p_absences,
                'absences_amount' => $p_absences_amount,
                'late_undertime' => $p_undertime,
                'late_undertime_pay' => $p_undertime_amount,
                'sss_contribution_id' => $sss_contribution,
                'philhealth_contribution_id' => $philhealth_contribution,
                'hdmf_contribution_id' => $hdmf_contribution,
                'ef_contribution_id' => $ef_contribution,

                'employees_dr' => $total_drs,
                'dr_to_other_company' => $total_otherdr,
                'due_from' => $total_duefrom,
                'total_allowance' => $total_allowance,
                'leave_pay' => $leave_pays,
                'gross_pay' => $gross_pay,
                'total_deductions' => $total_deductions,
                'net_salary' => $net_salary,
                'payroll_cycle' => $payroll_cycle,
            ]);
        }

        return strtotime(date('Y-m-d'));
        // return [$sss_contribution, $philhealth_contribution, $hdmf_contribution, $ef_contribution];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->query('search')){
            $s_value = request()->query('search');
            $payrolls = Payroll::where('cutoff_id', $id)->with(['Employee', 'EmployeeDetails', 'Loans', 'Attendances', 'EmployeeDr', 'DueFrom', 'OtherCompanyDr'])
                                ->whereHas('Employee', function ($query) use ($s_value) {
                                    $query->where('first_name', 'like', '%'.$s_value.'%')->orwhere('middle_name', 'like', '%'.$s_value.'%')->orwhere('last_name', 'like', '%'.$s_value.'%');
                                })
                                ->get();
        }
        else {
            $payrolls = Payroll::where('cutoff_id', $id)->with(['Employee', 'EmployeeDetails', 'Loans', 'Attendances', 'EmployeeDr', 'DueFrom', 'OtherCompanyDr'])->get();
        }

        return view('modules.payroll.view_payroll_details', [
            'payrolls' => $payrolls,
            'id' => $id,
        ]);
    }

    public function show_drs(Request $request){
        $dr = [];
        $cid = $request->cutoff_id;
        if($request->dr_type == 'Employee Dr'){
            $dr = EmployeeDr::where('employee_id', $request->employee_id)->orwhere(function ($query) use($cid) {
                $query->where('cutoff_id', $cid)->where('cutoff_id', null);
            })->get();
        }
        else if($request->dr_type == 'Other Dr'){
            // $dr = OtherCompanyDr::where('employee_id', $request->employee_id)->where('cutoff_id', $request->cutoff_id)->orwhere('cutoff_id', null)->get();
            $dr = OtherCompanyDr::where('employee_id', $request->employee_id)->orwhere(function ($query) use($cid) {
                $query->where('cutoff_id', $cid)->where('cutoff_id', null);
            })->get();
        }
        else if($request->dr_type == 'Due From'){
            // $dr = DueFrom::where('employee_id', $request->employee_id)->where('cutoff_id', $request->cutoff_id)->orwhere('cutoff_id', null)->get();
            $dr = DueFrom::where('employee_id', $request->employee_id)->orwhere(function ($query) use($cid) {
                $query->where('cutoff_id', $cid)->where('cutoff_id', null);
            })->get();
        }
        return $dr;
    }

    public function update_dr_values(Request $request){
        $employee_id = $request->employee_id;
        $cutoff_id = $request->cutoff_id;
        $payroll_id = $request->payroll_id;
        $dr_ids = explode(",", $request->dr_ids);

        // Update Employee DR
        $dr_record = EmployeeDr::where('employee_id', $employee_id)->where('cutoff_id', $cutoff_id)->orWhere('cutoff_id', null)->get();
        foreach ($dr_record as $key => $value) {
            if(in_array($value->id, $dr_ids)){
                $record = EmployeeDr::find($value->id);
                $record->cutoff_id = $cutoff_id;
                $record->is_paid = true;
                $record->save();
            }
            else {
                $record = EmployeeDr::find($value->id);
                $record->cutoff_id = null;
                $record->is_paid = false;
                $record->save();
            }
        }

        $return_val = 0;
        $dr_record = EmployeeDr::where('employee_id', $employee_id)->where('cutoff_id', $cutoff_id)->get();
        foreach ($dr_record as $key => $value) {
            $return_val = ($return_val + $value->amount);
        }

        // Get Payroll Header
        $payroll = Payroll::where('cutoff_id', $cutoff_id)->where('employee_id', $employee_id)->first();

        $old_total_deductions = $payroll->total_deductions;
        $old_net_salary = $payroll->net_salary;

        $new_total_deductions = ($old_total_deductions - $payroll->employees_dr);
        $new_total_deductions2 = ($new_total_deductions + $return_val);
        $new_net_salary = ($payroll->gross_pay - $new_total_deductions2);

        // Update Payroll
        $payroll->employees_dr = $return_val;
        $payroll->total_deductions = $new_total_deductions2;
        $payroll->net_salary = $new_net_salary;
        $payroll->save();

        $return_array = [
            'employees_dr' => $return_val,
            'total_deductions' => $new_total_deductions2,
            'net_salary' => $new_net_salary,
        ];

        return $return_array;
    }

    public function update_otherdr_values(Request $request){
        $employee_id = $request->employee_id;
        $cutoff_id = $request->cutoff_id;
        $payroll_id = $request->payroll_id;
        $dr_ids = explode(",", $request->dr_ids);

        // Update Employee DR
        $dr_record = OtherCompanyDr::where('employee_id', $employee_id)->where('cutoff_id', $cutoff_id)->orWhere('cutoff_id', null)->get();
        foreach ($dr_record as $key => $value) {
            if(in_array($value->id, $dr_ids)){
                $record = OtherCompanyDr::find($value->id);
                $record->cutoff_id = $cutoff_id;
                $record->is_paid = true;
                $record->save();
            }
            else {
                $record = OtherCompanyDr::find($value->id);
                $record->cutoff_id = null;
                $record->is_paid = false;
                $record->save();
            }
        }

        $return_val = 0;
        $dr_record = OtherCompanyDr::where('employee_id', $employee_id)->where('cutoff_id', $cutoff_id)->get();
        foreach ($dr_record as $key => $value) {
            $return_val = ($return_val + $value->amount);
        }

        // Get Payroll Header
        $payroll = Payroll::where('cutoff_id', $cutoff_id)->where('employee_id', $employee_id)->first();
        $old_total_deductions = $payroll->total_deductions;
        $old_net_salary = $payroll->net_salary;

        $new_total_deductions = ($old_total_deductions - $payroll->dr_to_other_company);
        $new_total_deductions2 = ($new_total_deductions + $return_val);
        $new_net_salary = ($payroll->gross_pay - $new_total_deductions2);

        // Update Payroll
        $payroll->employees_dr = $return_val;
        $payroll->total_deductions = $new_total_deductions2;
        $payroll->net_salary = $new_net_salary;
        $payroll->save();

        $return_array = [
            'employees_dr' => $return_val,
            'total_deductions' => $new_total_deductions2,
            'net_salary' => $new_net_salary,
        ];

        return $return_array;
    }

    public function update_duefrom_values(Request $request){
        $employee_id = $request->employee_id;
        $cutoff_id = $request->cutoff_id;
        $payroll_id = $request->payroll_id;
        $dr_ids = explode(",", $request->dr_ids);

        // Update Employee DR
        $dr_record = DueFrom::where('employee_id', $employee_id)->where('cutoff_id', $cutoff_id)->orWhere('cutoff_id', null)->get();
        foreach ($dr_record as $key => $value) {
            if(in_array($value->id, $dr_ids)){
                $record = DueFrom::find($value->id);
                $record->cutoff_id = $cutoff_id;
                $record->is_paid = true;
                $record->save();
            }
            else {
                $record = DueFrom::find($value->id);
                $record->cutoff_id = null;
                $record->is_paid = false;
                $record->save();
            }
        }

        $return_val = 0;
        $dr_record = DueFrom::where('employee_id', $employee_id)->where('cutoff_id', $cutoff_id)->get();
        foreach ($dr_record as $key => $value) {
            $return_val = ($return_val + $value->amount);
        }

        // Get Payroll Header
        $payroll = Payroll::where('cutoff_id', $cutoff_id)->where('employee_id', $employee_id)->first();

        $old_total_deductions = $payroll->total_deductions;
        $old_net_salary = $payroll->net_salary;

        $new_total_deductions = ($old_total_deductions - $payroll->due_from);
        $new_total_deductions2 = ($new_total_deductions + $return_val);
        $new_net_salary = ($payroll->gross_pay - $new_total_deductions2);

        // Update Payroll
        $payroll->employees_dr = $return_val;
        $payroll->total_deductions = $new_total_deductions2;
        $payroll->net_salary = $new_net_salary;
        $payroll->save();

        $return_array = [
            'employees_dr' => $return_val,
            'total_deductions' => $new_total_deductions2,
            'net_salary' => $new_net_salary,
        ];

        return $return_array;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function update_remarks(Request $request)
    {
        $payroll_emp = Payroll::find($request->payroll_id);
        $payroll_emp->remarks = $request->remarks;
        $payroll_emp->save();
        return $request->remarks;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function get_holidays($cutoff_id){
        $_date_range = Attendances::where('cutoff_id', $cutoff_id)->groupBy('date_in')->pluck('date_in');
        $_date_range_arr = [];
        foreach ($_date_range as $key => $value) {
            $_date_range_arr[$key] = date('Y-m-d', strtotime($value));
        }

        if($_date_range_arr){
            $_hstart_date = min($_date_range_arr);
            $_hend_date = max($_date_range_arr);
            $_holidays = Holiday::where('holiday_date', '>=', $_hstart_date)->where('holiday_date', '<=', $_hend_date)->get();

            $_holiday_array = [];
            foreach ($_holidays as $key => $value) {
                $_holiday_array[$key] = $value->holiday_date;
            }
            return $_holiday_array;
        }
        return 0;
    }

    private function get_rest_days($cutoff_id){
        $_date_range = Attendances::where('cutoff_id', $cutoff_id)->groupBy('date_in')->pluck('date_in');
        $_date_range_arr = [];
        foreach ($_date_range as $key => $value) {
            $_date_range_arr[$key] = date('Y-m-d', strtotime($value));
        }

        if($_date_range_arr){
            $_rest_days_arr = [];
            $_rdstart_date = min($_date_range_arr);
            $_rdend_date = max($_date_range_arr);
            $_counter_rd = 0;

            while($_rdstart_date <= $_rdend_date){
                if(date('l', strtotime($_rdstart_date)) == 'Sunday') {
                    $_rest_days_arr[$_counter_rd] = date('Y-m-d', strtotime($_rdstart_date));
                    $_counter_rd++;
                }
                $_rdstart_date = date('Y-m-d', strtotime($_rdstart_date.' +1 day'));
            }

            $_return_rest_days = [];
            foreach ($_rest_days_arr as $key => $value) {
                $_return_rest_days[$key] = $value;
            }

            return $_return_rest_days;
        }
        return 0;

    }

    private function get_working_hours($value1, $_start_time_am, $_end_time_am, $_start_time_pm, $_end_time_pm){

        $_totalhours_am = 0;
        $_totalhours_pm = 0;
        if($value1->time_in_am && $value1->time_out_am){
            // Time in AM condition
            $_timein_am = strtotime($value1->time_in_am);
            if($_timein_am < $_start_time_am){
                $_timein_am = $_start_time_am;
            }

            // Time out AM condition
            $_timeout_am = strtotime($value1->time_out_am);
            if($_timeout_am > $_end_time_am){
                $_timeout_am = $_end_time_am;
            }
            $_totalhours_am =  round(((abs($_timeout_am - $_timein_am) / 60) / 60), 2);
        }

        if($value1->time_in_pm && $value1->time_out_pm){
            // Time in PM condition
            $_timein_pm = strtotime($value1->time_in_pm);
            if($_timein_pm < $_start_time_pm){
                $_timein_pm = $_start_time_pm;
            }

            // Time out PM condition
            $_timeout_pm = strtotime($value1->time_out_pm);
            if($_timeout_pm > $_end_time_pm){
                $_timeout_pm = $_end_time_pm;
            }
            $_totalhours_pm =  round(((abs($_timeout_pm - $_timein_pm) / 60) /60), 2);
        }


        $_total_hours_per_day = ($_totalhours_am + $_totalhours_pm);
        return $_total_hours_per_day;
    }

    private function get_working_hours_overtime($value1, $_start_ot){
        if(strtotime($value1->time_out_pm) >= $_start_ot){
            return round(((abs(strtotime($value1->time_out_pm) - $_start_ot) / 60) / 60), 2);
        }
        return 0;
    }

    private function working_days($cutoff_id){
        $_date_range = Attendances::where('cutoff_id', $cutoff_id)->groupBy('date_in')->pluck('date_in');
        $_date_range_arr = [];
        foreach ($_date_range as $key => $value) {
            $_date_range_arr[$key] = date('Y-m-d', strtotime($value));
        }

        if($_date_range_arr){
            $_working_days_arr = [];
            $_wdstart_date = min($_date_range_arr);
            $_wdend_date = max($_date_range_arr);
            $_counter_wd = 0;

            while($_wdstart_date <= $_wdend_date){
                $_working_days_arr[$_counter_wd] = date('Y-m-d', strtotime($_wdstart_date));
                $_counter_wd++;
                $_wdstart_date = date('Y-m-d', strtotime($_wdstart_date.' +1 day'));
            }

            $_working_days_filtered = [];
            foreach ($_working_days_arr as $key => $value) {
                if(date('l', strtotime($value)) != 'Sunday'){
                    $_working_days_filtered[$key] = date('Y-m-d', strtotime($value));
                }
            }
            return $_working_days_filtered;
        }

        return 0;
    }

    private function get_total_working_days($cutoff_id, $employee_id){
        $payroll_details = PayrollDetails::where('cutoff_id', $cutoff_id)->where('employee_id', $employee_id)->get();
        $total_working_days = 0;
        foreach ($payroll_details as $key => $value) {
            $total_working_days = ($total_working_days + $value->working_hours);
        }
        return round(($total_working_days / 8), 2);
    }

    private function get_total_pay($cutoff_id, $employee_id, $_type, $is_overtime_pay){
        $payroll_details = PayrollDetails::where('cutoff_id', $cutoff_id)->where('employee_id', $employee_id)->get();
        $total_pays = 0;
        foreach ($payroll_details as $key => $value) {
            // For holiday Pay Only
            if($_type == 'holiday pay'){
                if(is_null($value->working_hours_overtime) && !is_null($value->holiday_type)){
                    $total_pays = ($total_pays + $value->pay);
                }
            }

            // For Overtime Pay Only
            if($_type == 'overtime pay'){
                if($is_overtime_pay == 1){
                    if(!is_null($value->working_hours_overtime) && is_null($value->holiday_type)){
                        $total_pays = ($total_pays + $value->pay);
                    }
                }
            }

            // For Holiday Overtime
            if($_type == 'holiday overtime pay'){
                if(!is_null($value->working_hours_overtime) && !is_null($value->holiday_type)){
                    $total_pays = ($total_pays + $value->pay);
                }
            }
        }
        return round($total_pays, 2);
    }

    private function get_total_absences($cutoff_id, $employee_code){
        $_date_range = Attendances::where('cutoff_id', $cutoff_id)->where('employee_no', $employee_code)->pluck('date_in');
        $_date_range_arr = [];
        foreach ($_date_range as $key => $value) {
            $_date_range_arr[$key] = date('Y-m-d', strtotime($value));
        }

        $working_days = $this->working_days($cutoff_id);
        $total_absences = 0;
        $arr_return = [];
        foreach ($working_days as $key => $value){
            if(!in_array($value, $_date_range_arr)){
                $total_absences = $total_absences + 1;
                $arr_return[$total_absences] = $value;
            }
        }
        return $total_absences;
    }

    private function get_absences_amount($cutoff_id, $employee_code, $employee_basic_wage){
        $total_absences = $this->get_total_absences($cutoff_id, $employee_code);

        return $total_absences * $employee_basic_wage;
    }

    private function get_undertime($cutoff_id, $employee_code){
        $_date_range = Attendances::where('cutoff_id', $cutoff_id)->where('employee_no', $employee_code)->get();

        $default_timein_am  = strtotime("08:00:00 AM");
        $default_timeout_am = strtotime("12:00:00 PM");
        $default_timein_pm  = strtotime("01:00:00 PM");
        $default_timeout_pm = strtotime("05:00:00 PM");

        $total_undertime = 0;
        foreach($_date_range as $key => $value){
            $_time_in_am    = strtotime($value->time_in_am);
            $_time_out_am   = strtotime($value->time_out_am);
            $_time_in_pm    = strtotime($value->time_in_pm);
            $_time_out_pm   = strtotime($value->time_out_pm);

            if($_time_in_am && $_time_out_am){
                // Undertime AM
                if($_time_in_am > $default_timein_am && $_time_out_am < $default_timeout_am){
                    $undertime_am1 = round((abs($_time_in_am - $default_timein_am) / 3600), 2);
                    $undertime_am2 = round((abs($default_timeout_am - $_time_out_am) / 3600), 2);
                    $total_undertime = $total_undertime + ($undertime_am1 + $undertime_am2);
                }
                if($_time_in_am > $default_timein_am && $_time_out_am >= $default_timeout_am){
                    $undertime_am1 = round((abs($_time_in_am - $default_timein_am) / 3600), 2);
                    $total_undertime = $total_undertime + ($undertime_am1);
                }
                if($_time_in_am <= $default_timein_am && $_time_out_am < $default_timeout_am){
                    // $undertime_am1 = round((abs($_time_in_am - $default_timein_am) / 3600), 2);
                    $undertime_am2 = round((abs($default_timeout_am - $_time_out_am) / 3600), 2);
                    $total_undertime = $total_undertime + ($undertime_am2);
                }
            }

            if($_time_in_pm && $_time_in_pm){
                // Undertime PM
                if($_time_in_pm > $default_timein_pm && $_time_out_pm < $default_timeout_pm){
                    $undertime_pm1 = round((abs($_time_in_pm - $default_timein_pm) / 3600), 2);
                    $undertime_pm2 = round((abs($default_timeout_pm - $_time_out_pm) / 3600), 2);
                    $total_undertime = $total_undertime + ($undertime_pm1 + $undertime_pm2);
                }
                if($_time_in_pm > $default_timein_pm && $_time_out_pm >= $default_timeout_pm){
                    $undertime_pm1 = round((abs($_time_in_pm - $default_timein_pm) / 3600), 2);
                    $total_undertime = $total_undertime + ($undertime_pm1);
                }
                if($_time_in_pm <= $default_timein_pm && $_time_out_pm < $default_timeout_pm){
                    // $undertime_am1 = round((abs($_time_in_am - $default_timein_am) / 3600), 2);
                    $undertime_pm2 = round((abs($default_timeout_pm - $_time_out_pm) / 3600), 2);
                    $total_undertime = $total_undertime + ($undertime_pm2);
                }
            }
        }

        return $total_undertime;
    }

    private function get_undertime_amount($cutoff_id, $employee_code, $employee_basic_wage){
        $undertime = $this->get_undertime($cutoff_id, $employee_code);
        $rate_per_hour = round(($employee_basic_wage / 8), 2);

        return $undertime * $rate_per_hour;
    }

    private function get_total_drs($employee_id, $cutoff_id){
        $employee_drs = EmployeeDr::where('employee_id', $employee_id)->where('is_paid', 0)->get();
        $total_drs = 0;
        foreach($employee_drs as $key => $value){
            $total_drs = round($total_drs + $value->amount, 2);
            $dr_row = EmployeeDr::find($value->id);
            $dr_row->is_paid = true;
            $dr_row->cutoff_id = $cutoff_id;
            $dr_row->save();
        }
        return $total_drs;
    }

    private function get_total_drs_to_other_company($employee_id, $cutoff_id){
        $employee_drs = OtherCompanyDr::where('employee_id', $employee_id)->where('is_paid', 0)->get();
        $total_drs = 0;
        foreach($employee_drs as $key => $value){
            $total_drs = round($total_drs + $value->amount, 2);
            $dr_row = OtherCompanyDr::find($value->id);
            $dr_row->is_paid = true;
            $dr_row->cutoff_id = $cutoff_id;
            $dr_row->save();
        }
        return $total_drs;
    }

    private function get_total_due_from($employee_id, $cutoff_id){
        $employee_drs = DueFrom::where('employee_id', $employee_id)->where('is_paid', 0)->get();
        $total_drs = 0;
        foreach($employee_drs as $key => $value){
            $total_drs = round($total_drs + $value->amount, 2);
            $dr_row = DueFrom::find($value->id);
            $dr_row->is_paid = true;
            $dr_row->cutoff_id = $cutoff_id;
            $dr_row->save();
        }
        return $total_drs;
    }

    private function set_contribution_sss($cutoff_id, $employee_id, $contribution_amount){
        $cutoff = Cutoff::where('cutoff_id', $cutoff_id)->first();
        $day = (int)(date('d', strtotime($cutoff->cutoff_date)));
        if($day >= 16 && $day <= 31){
            $new_contribution = ContributionSSS::create([
                'cutoff_id' => $cutoff_id,
                'employee_id' => $employee_id,
                'contribution_amount' => $contribution_amount,
            ]);
            return $new_contribution->id;
        }
        return null;
    }

    private function set_contribution_philhealth($cutoff_id, $employee_id, $contribution_amount){
        $cutoff = Cutoff::where('cutoff_id', $cutoff_id)->first();
        $day = (int)(date('d', strtotime($cutoff->cutoff_date)));
        if($day >= 16 && $day <= 31){
            $new_contribution = ContributionPhilHealth::create([
                'cutoff_id' => $cutoff_id,
                'employee_id' => $employee_id,
                'contribution_amount' => $contribution_amount,
            ]);
            return $new_contribution->id;
        }
        return null;
    }

    private function set_contribution_hdmf($cutoff_id, $employee_id, $contribution_amount){
        $cutoff = Cutoff::where('cutoff_id', $cutoff_id)->first();
        $day = (int)(date('d', strtotime($cutoff->cutoff_date)));
        if($day >= 1 && $day <= 15){
            $new_contribution = ContributionHDMF::create([
                'cutoff_id' => $cutoff_id,
                'employee_id' => $employee_id,
                'contribution_amount' => $contribution_amount,
            ]);
            return $new_contribution->id;
        }
        return null;
    }

    private function get_payroll_cycle($cutoff_id){
        $cutoff = Cutoff::where('cutoff_id', $cutoff_id)->first();
        $day = (int)(date('d', strtotime($cutoff->cutoff_date)));
        $return_value = '30th';
        if($day >= 1 && $day <= 15){
            $return_value =  '15th';
        }

        return $return_value;
    }

    private function set_contribution_ef($cutoff_id, $employee_id, $contribution_amount){
        $new_contribution = ContributionEF::create([
            'cutoff_id' => $cutoff_id,
            'employee_id' => $employee_id,
            'contribution_amount' => $contribution_amount,
        ]);

        return $new_contribution->id;
    }

    private function set_loan_payment($loans, $cutoff_id){
        $return_amount = 0;

        $cutoff = Cutoff::where('cutoff_id', $cutoff_id)->first();
        $day = (int)(date('d', strtotime($cutoff->cutoff_date)));

        foreach($loans as $key => $value){
            if($value->type_of_loan == 'SSS Loan'){
                if($day >= 16 && $day <= 31){
                    $loan_payment = LoanPayments::create([
                        'loan_id' => $value->loan_id,
                        'cutoff_id' => $cutoff_id,
                        'amount' => $value->monthly_due,
                    ]);
                }
            }
            else if($value->type_of_loan == 'Pag-ibig Loan'){
                if($day >= 1 && $day <= 15){
                    $loan_payment = LoanPayments::create([
                        'loan_id' => $value->loan_id,
                        'cutoff_id' => $cutoff_id,
                        'amount' => $value->monthly_due,
                    ]);
                }
            }
            else if($value->type_of_loan == 'EF Loan'){
                $loan_payment = LoanPayments::create([
                    'loan_id' => $value->loan_id,
                    'cutoff_id' => $cutoff_id,
                    'amount' => $value->monthly_due,
                ]);
            }
            $return_amount = ($return_amount + $value->monthly_due);


            if(($this->get_paid_loans($value->loan_id) >= $value->loan_amount) && (strtotime($cutoff->cutoff_date) <= strtotime(date('Y-m-d')))){
                $loan = Loans::find($value->loan_id);
                $loan->is_paid = true;
                $loan->save();
            }
        }
        return $return_amount;
    }

    private function get_paid_loans($loan_id) {
        $loan_payment = LoanPayments::where('loan_id', $loan_id)->get();
        $total_monthly_due = 0;
        foreach($loan_payment as $key => $value){
            $total_monthly_due = ($total_monthly_due + $value->amount);
        }

        return $total_monthly_due;
    }

    private function get_leave_pays($employee, $cutoff_id){
        $cutoff = Cutoff::where('cutoff_id', $cutoff_id)->first();
        $month = (int)(date('m', strtotime($cutoff->cutoff_date)));
        $year = (int)(date('Y', strtotime($cutoff->cutoff_date)));
        $day = (int)(date('d', strtotime($cutoff->cutoff_date)));

        $daterange1 = date_format(date_create($year.'-'.$month.'-01'), "Y-m-d");
        $daterange2 = date_format(date_create($year.'-'.$month.'-15'), "Y-m-d");
        if($day >= 16 && $day <= 31){
            $daterange1 = date_format(date_create($year.'-'.$month.'-16'), "Y-m-d");
            $daterange2 = date_format(date_create($year.'-'.$month.'-31'), "Y-m-d");
        }

        // Retrieve Leave Pays Records
        $leavepay_records = EmployeeLeavePay::where('employee_id', $employee->employee_id)->where('is_used', false)->get();
        // Leave Pay
        $basic_rate = $employee->EmployeeDetails->basic_rate;
        $allowance = $employee->EmployeeDetails->allowance;

        $return_amount = 0;
        $allowedleavedays = $employee->EmployeeDetails->leave_with_pay;
        $q_noofdays = 0;
        foreach ($leavepay_records as $key => $value) {
            if($value->leave_date <= $daterange2){
                $q_noofdays = ($q_noofdays + 1);
            }
        }
        $cond = ($q_noofdays > 0 && $allowedleavedays > 0);
        if($cond){
            return (($basic_rate + $allowance) * $q_noofdays);
        }
        else{
            return $return_amount;
        }
    }

    private function get_total_allowance($cutoff_id, $employee){
        $working_days = $this->get_total_working_days($cutoff_id, $employee->employee_id);
        $total_allowance = ($employee->EmployeeDetails->allowance * $working_days);

        return $total_allowance;
    }

    public function testing(){
        $date=date_create("2013-03-15");
        $year = 2023;
        $month = 03;
        $daterange1 = date_format(date_create($year.'-'.$month.'-16'), "Y-m-d");
        return $daterange1;
    }
}

