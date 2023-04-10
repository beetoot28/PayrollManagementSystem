<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Employees;
use App\Models\ViewEmployees;
use App\Models\ViewAttendances;
use App\Models\ViewLoans;
use App\Models\ViewPayrolls;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportEmployees;
use App\Exports\ExportAttendances;
use App\Exports\ExportLoans;
use App\Exports\ExportPayrolls;

use App\Models\Loans;
use App\Models\Cutoff;

use Illuminate\Support\Facades\DB;
// use App\Models\OtherCompanyDr;
// use App\Models\DueFrom;
// use App\Models\EmployeeLeavePay;
// use App\Models\HolidayComputations;
// use App\Models\KindsOfComputations;
// use App\Models\Holiday;
// use Illuminate\Contracts\Encryption\DecryptException;
// use Illuminate\Support\Facades\Crypt;
// use Illuminate\Database\Eloquent\Builder;

class ReportsController extends Controller
{
    public function report_index(){
        $active_tab = Settings::where('id', 1)->first();
        $employees = $this->get_employees()['employee'];
        $attendances = $this->get_attendances()['attendance'];
        $loans = $this->get_loans()['loan'];
        $payrolls = $this->get_payrolls()['payroll'];

        $flag_reset_refresh_emp = request()->query('r_emp_details') || request()->query('r_emp_department') || request()->query('r_emp_employment_status') || request()->query('r_emp_employee_status');
        $flag_reset_refresh_att = request()->query('r_att_details') || request()->query('r_att_department') || request()->query('r_att_employment_status') || request()->query('r_att_employee_status') || request()->query('r_att_startdate') || request()->query('r_att_enddate');
        $flag_reset_refresh_loan = request()->query('r_loan_details') || request()->query('r_loan_department') || request()->query('r_loan_employment_status') || request()->query('r_loan_employee_status') || request()->query('r_loan_startdate') || request()->query('r_loan_enddate') || request()->query('r_loan_type') || request()->query('r_loan_term') || request()->query('r_loan_paid');
        $flag_reset_refresh_payroll = request()->query('r_payroll_details') || request()->query('r_payroll_department') || request()->query('r_payroll_employment_status') || request()->query('r_payroll_employee_status') || request()->query('r_payroll_startdate') || request()->query('r_payroll_enddate') || request()->query('r_payroll_cutoff') || request()->query('r_payroll_cycle');

        $loan_terms = Loans::groupBy('loan_terms')->pluck('loan_terms');  // For loan only
        $cutoffs = Cutoff::all(); // For cutoff only

        if(request()->query('export_emp_flag')){
            $employees2 = $this->get_employees()['employee_export'];
            return Excel::download(new ExportEmployees($employees2) , 'employees_report.xlsx');
        }

        if(request()->query('export_att_flag')){
            $attendances2 = $this->get_attendances()['attendance_export'];
            return Excel::download(new ExportAttendances($attendances2) , 'attendance_report.xlsx');
        }

        if(request()->query('export_loan_flag')){
            $loans2 = $this->get_loans()['loan_export'];
            return Excel::download(new ExportLoans($loans2) , 'loan_report.xlsx');
        }

        if(request()->query('export_payroll_flag')){
            $payrolls2 = $this->get_payrolls()['payroll_export'];
            return Excel::download(new ExportPayrolls($payrolls2) , 'payroll_report.xlsx');
        }

        return view('modules.reports.reports', [
            'flag_reset_refresh_emp' => $flag_reset_refresh_emp,
            'flag_reset_refresh_att' => $flag_reset_refresh_att,
            'flag_reset_refresh_loan' => $flag_reset_refresh_loan,
            'flag_reset_refresh_payroll' => $flag_reset_refresh_payroll,
            'active_tab' => $active_tab->active_tab_reports,

            'employees' => $employees,
            'attendances' => $attendances,
            'loans' => $loans,
            'payrolls' => $payrolls,

            'loan_terms' => $loan_terms,
            'cutoffs' => $cutoffs,
        ]);
    }

    public function set_active_tab_reports(Request $request){
        $settings_obj = Settings::find(1);
        $settings_obj->active_tab_reports = $request->tab_value;
        $settings_obj->save();

        //Return data
        $active_tab = Settings::where('id', 1)->first();
        return $active_tab->active_tab_reports;
    }

    private function get_employees(){
        $employees_export = [];

        $r_emp_details = request()->query('r_emp_details');
        $r_emp_department = request()->query('r_emp_department') == 1  ? 'Sales Department' : (request()->query('r_emp_department') == 2 ? 'Accounting Department' : (request()->query('r_emp_department') == 3 ? 'Finance Department' : (request()->query('r_emp_department') == 4 ? 'Logistics Department' : '')));
        $r_emp_employment_status = request()->query('r_emp_employment_status') == 1 ? 'Active' : (request()->query('r_emp_employment_status') == 2 ? 'Resigned' : '');
        $r_emp_employee_status = request()->query('r_emp_employee_status') == 1 ? 'Regular' : (request()->query('r_emp_employee_status') == 2 ? 'Casual' : '');

        if(!$r_emp_details && !$r_emp_department && !$r_emp_employment_status && !$r_emp_employee_status){
            $employees =  ViewEmployees::orderBy('first_name', 'ASC')->paginate(10);
            $employees_export =  ViewEmployees::select('employee_code', 'first_name', 'middle_name', 'last_name', 'sex', 'mobile_no', 'nationality', 'employee_status', 'block_house_no', 'street', 'barangay', 'city', 'province', 'marital_status', 'spouse_name', 'spouse_occupation', 'dependant', 'emergency_contact_name', 'emergency_contact_no', 'emergency_contact_address', 'basic_rate', 'allowance', 'leave_with_pay', 'with_ot_pay', 'department', 'position', 'employee_history_position', 'sss_no', 'philhealth_no', 'tin_no', 'hdmf_no', 'date_hired', 'date_resigned', 'employment_status', 'sss_contribution', 'philhealth_contribution', 'ef_contribution', 'hdmf_contribution')->orderBy('first_name', 'ASC')->get();
        }
        else
        {
            $emp_details = '';
            $emp_department = '';
            $emp_employment_status = '';
            $emp_employee_status = '';

            $cons_string = 'employee_id <> 0';
            $sql_query = '';

            if($r_emp_details)
            {
                $emp_details = " AND (first_Name LIKE '%".$r_emp_details."%' OR middle_name LIKE '%".$r_emp_details."%' OR last_name LIKE '%".$r_emp_details."%' OR sex LIKE '%".$r_emp_details."%' OR mobile_no LIKE '%".$r_emp_details."%' OR nationality LIKE '%".$r_emp_details."%' OR block_house_no LIKE '%".$r_emp_details."%' OR street LIKE '%".$r_emp_details."%' OR barangay LIKE '%".$r_emp_details."%' OR city LIKE '%".$r_emp_details."%' OR province LIKE '%".$r_emp_details."%' OR marital_status LIKE '%".$r_emp_details."%' OR spouse_name LIKE '%".$r_emp_details."%' OR dependant LIKE '%".$r_emp_details."%' OR emergency_contact_name LIKE '%".$r_emp_details."%' OR emergency_contact_no LIKE '%".$r_emp_details."%' OR emergency_contact_address LIKE '%".$r_emp_details."%' OR position LIKE '%".$r_emp_details."%' OR sss_no LIKE '%".$r_emp_details."%' OR philhealth_no LIKE '%".$r_emp_details."%' OR tin_no LIKE '%".$r_emp_details."%' OR hdmf_no LIKE '%".$r_emp_details."%') ";
            }

            if($r_emp_department)
            {
                $emp_department = " AND department = '".$r_emp_department."'";
            }

            if($r_emp_employment_status)
            {
                $emp_employment_status = " AND employment_status = '".$r_emp_employment_status."'";
            }

            if($r_emp_employee_status)
            {
                $emp_employee_status = " AND employee_status = '".$r_emp_employee_status."'";
            }

            $sql_query = $cons_string.$emp_details.$emp_department.$emp_employment_status.$emp_employee_status;
            $employees =  ViewEmployees::select('*')
                ->whereRaw($sql_query)
                ->paginate(10);

            $employees_export =  ViewEmployees::select('employee_code', 'first_name', 'middle_name', 'last_name', 'sex', 'mobile_no', 'nationality', 'employee_status', 'block_house_no', 'street', 'barangay', 'city', 'province', 'marital_status', 'spouse_name', 'spouse_occupation', 'dependant', 'emergency_contact_name', 'emergency_contact_no', 'emergency_contact_address', 'basic_rate', 'allowance', 'leave_with_pay', 'with_ot_pay', 'department', 'position', 'employee_history_position', 'sss_no', 'philhealth_no', 'tin_no', 'hdmf_no', 'date_hired', 'date_resigned', 'employment_status', 'sss_contribution', 'philhealth_contribution', 'ef_contribution', 'hdmf_contribution')
                ->whereRaw($sql_query)
                ->get();
        }

        return $return_data = [
            'employee' => $employees,
            'employee_export' => $employees_export,
        ];
    }

    private function get_attendances(){
        $attendances_export = [];

        $r_att_details = request()->query('r_att_details');
        $r_att_department = request()->query('r_att_department') == 1  ? 'Sales Department' : (request()->query('r_att_department') == 2 ? 'Accounting Department' : (request()->query('r_att_department') == 3 ? 'Finance Department' : (request()->query('r_att_department') == 4 ? 'Logistics Department' : '')));
        $r_att_employment_status = request()->query('r_att_employment_status') == 1 ? 'Active' : (request()->query('r_att_employment_status') == 2 ? 'Resigned' : '');
        $r_att_employee_status = request()->query('r_att_employee_status') == 1 ? 'Regular' : (request()->query('r_att_employee_status') == 2 ? 'Casual' : '');

        $r_att_startdate = request()->query('r_att_startdate') ? date('Y-m-d', strtotime(request()->query('r_att_startdate'))) : '';
        $r_att_enddate = request()->query('r_att_enddate') ? date('Y-m-d', strtotime(request()->query('r_att_enddate'))) : '';

        if(!$r_att_details && !$r_att_department && !$r_att_employment_status && !$r_att_employee_status && !$r_att_startdate && !$r_att_enddate){
            $attendances =  ViewAttendances::orderBy('first_name', 'ASC')->groupBy('employee_code')->paginate(10);
            $attendances_export =  ViewAttendances::select('employee_code', 'first_name', 'middle_name', 'last_name', 'employee_status', 'employment_status', 'department', 'cutoff_date', 'account_no', 'number', 'date_in', 'time_in_am', 'time_out_am', 'time_in_pm', 'time_out_pm')->orderBy('first_name', 'ASC')->get();
        }
        else
        {
            $att_details = '';
            $att_department = '';
            $att_employment_status = '';
            $att_employee_status = '';
            $att_date_range = '';

            $cons_string = 'attendance_id <> 0';
            $sql_query = '';

            if($r_att_details)
            {
                $att_details = " AND (first_Name LIKE '%".$r_att_details."%' OR middle_name LIKE '%".$r_att_details."%' OR last_name LIKE '%".$r_att_details."%')";
            }

            if($r_att_department)
            {
                $att_department = " AND department = '".$r_att_department."'";
            }

            if($r_att_employment_status)
            {
                $att_employment_status = " AND employment_status = '".$r_att_employment_status."'";
            }

            if($r_att_employee_status)
            {
                $att_employee_status = " AND employee_status = '".$r_att_employee_status."'";
            }

            if($r_att_startdate && $r_att_enddate){
                $att_date_range = " AND cutoff_date >= '".$r_att_startdate."' AND cutoff_date <= '".$r_att_enddate."'";
            }

            $sql_query = $cons_string.$att_details.$att_department.$att_employment_status.$att_employee_status.$att_date_range;
            $attendances =  ViewAttendances::select('*')
                ->groupBy('employee_code')
                ->whereRaw($sql_query)
                ->paginate(10);

            $attendances_export =  ViewAttendances::select('employee_code', 'first_name', 'middle_name', 'last_name', 'employee_status', 'employment_status', 'department', 'cutoff_date', 'account_no', 'number', 'date_in', 'time_in_am', 'time_out_am', 'time_in_pm', 'time_out_pm')
                ->whereRaw($sql_query)
                ->get();
        }

        return $return_data = [
            'attendance' => $attendances,
            'attendance_export' => $attendances_export,
        ];
    }

    private function get_loans(){
        $loans_export = [];

        $r_loan_details = request()->query('r_loan_details');
        $r_loan_department = request()->query('r_loan_department') == 1  ? 'Sales Department' : (request()->query('r_loan_department') == 2 ? 'Accounting Department' : (request()->query('r_loan_department') == 3 ? 'Finance Department' : (request()->query('r_loan_department') == 4 ? 'Logistics Department' : '')));
        $r_loan_employment_status = request()->query('r_loan_employment_status') == 1 ? 'Active' : (request()->query('r_loan_employment_status') == 2 ? 'Resigned' : '');
        $r_loan_employee_status = request()->query('r_loan_employee_status') == 1 ? 'Regular' : (request()->query('r_loan_employee_status') == 2 ? 'Casual' : '');

        $r_loan_startdate = request()->query('r_loan_startdate') ? date('Y-m-d', strtotime(request()->query('r_loan_startdate'))) : '';
        $r_loan_enddate = request()->query('r_loan_enddate') ? date('Y-m-d', strtotime(request()->query('r_loan_enddate'))) : '';

        $r_loan_type = request()->query('r_loan_type') == 1 ? 'SSS Loan' : (request()->query('r_loan_type') == 2 ? 'EF Loan' : (request()->query('r_loan_type') == 3 ? 'Pag-ibig Loan' : ''));
        $r_loan_term = request()->query('r_loan_term');
        $r_loan_paid = request()->query('r_loan_paid') == 1 ? 'Yes' : (request()->query('r_loan_paid') == 2 ? 'No' : '');

        if(!$r_loan_details && !$r_loan_department && !$r_loan_employment_status && !$r_loan_employee_status && !$r_loan_startdate && !$r_loan_enddate && !$r_loan_type && !$r_loan_term && !$r_loan_paid){
            $loans =  ViewLoans::orderBy('first_name', 'ASC')->paginate(10);
            $loans_export =  ViewLoans::select('employee_code', 'first_name', 'middle_name', 'last_name', 'employee_status', 'employment_status', 'department', 'type_of_loan', 'loan_application_no', 'loan_date', 'loan_terms', 'deduction_from', 'deduction_to', 'loan_amount', 'monthly_due', 'is_paid')->orderBy('first_name', 'ASC')->get();
        }
        else
        {
            $loan_details = '';
            $loan_department = '';
            $loan_employment_status = '';
            $loan_employee_status = '';
            $loan_date_range = '';
            $loan_type = '';
            $loan_term = '';
            $loan_paid = '';

            $cons_string = 'loan_id <> 0';
            $sql_query = '';

            if($r_loan_details)
            {
                $loan_details = " AND (first_Name LIKE '%".$r_loan_details."%' OR middle_name LIKE '%".$r_loan_details."%' OR last_name LIKE '%".$r_loan_details."%')";
            }

            if($r_loan_department)
            {
                $loan_department = " AND department = '".$r_loan_department."'";
            }

            if($r_loan_employment_status)
            {
                $loan_employment_status = " AND employment_status = '".$r_loan_employment_status."'";
            }

            if($r_loan_employee_status)
            {
                $loan_employee_status = " AND employee_status = '".$r_loan_employee_status."'";
            }

            if($r_loan_startdate && $r_loan_enddate){
                $loan_date_range = " AND loan_date >= '".$r_loan_startdate."' AND loan_date <= '".$r_loan_enddate."'";
            }

            if($r_loan_type){
                $loan_type = " AND type_of_loan = '".$r_loan_type."'";
            }

            if($r_loan_term){
                $loan_term = " AND loan_terms = '".$r_loan_term."'";
            }

            if($r_loan_paid){
                $loan_paid = " AND is_paid = '".$r_loan_paid."'";
            }

            $sql_query = $cons_string.$loan_details.$loan_department.$loan_employment_status.$loan_employee_status.$loan_date_range.$loan_type.$loan_term.$loan_paid;
            $loans =  ViewLoans::select('*')
                ->orderBy('first_name', 'ASC')
                ->whereRaw($sql_query)
                ->paginate(10);

            $loans_export =  ViewLoans::select('employee_code', 'first_name', 'middle_name', 'last_name', 'employee_status', 'employment_status', 'department', 'type_of_loan', 'loan_application_no', 'loan_date', 'loan_terms', 'deduction_from', 'deduction_to', 'loan_amount', 'monthly_due', 'is_paid')
                ->orderBy('first_name', 'ASC')
                ->whereRaw($sql_query)
                ->get();
        }

        return $return_data = [
            'loan' => $loans,
            'loan_export' => $loans_export,
        ];
    }

    private function get_payrolls(){
        $payrolls_export = [];

        // $payrolls =  ViewPayrolls::groupBy(['employee_code', 'cutoff_id'])->orderBy('employee_code', 'ASC')->paginate(10);
        // return $payrolls;
        $r_payroll_details = request()->query('r_payroll_details');
        $r_payroll_department = request()->query('r_payroll_department') == 1  ? 'Sales Department' : (request()->query('r_payroll_department') == 2 ? 'Accounting Department' : (request()->query('r_payroll_department') == 3 ? 'Finance Department' : (request()->query('r_payroll_department') == 4 ? 'Logistics Department' : '')));
        $r_payroll_employment_status = request()->query('r_payroll_employment_status') == 1 ? 'Active' : (request()->query('r_payroll_employment_status') == 2 ? 'Resigned' : '');
        $r_payroll_employee_status = request()->query('r_payroll_employee_status') == 1 ? 'Regular' : (request()->query('r_payroll_employee_status') == 2 ? 'Casual' : '');

        $r_payroll_startdate = request()->query('r_payroll_startdate') ? date('Y-m-d', strtotime(request()->query('r_payroll_startdate'))) : '';
        $r_payroll_enddate = request()->query('r_payroll_enddate') ? date('Y-m-d', strtotime(request()->query('r_payroll_enddate'))) : '';

        $r_payroll_cutoff = request()->query('r_payroll_cutoff');
        $r_payroll_cycle = request()->query('r_payroll_cycle');

        if(!$r_payroll_details && !$r_payroll_department && !$r_payroll_employment_status && !$r_payroll_employee_status && !$r_payroll_startdate && !$r_payroll_enddate && !$r_payroll_cutoff && !$r_payroll_cycle){
            $payrolls =  ViewPayrolls::groupBy(['employee_code', 'cutoff_id'])->orderBy('employee_code', 'ASC')->paginate(10);
            $payrolls_export =  ViewPayrolls::select('employee_code',  'first_name', 'middle_name', 'last_name', 'employee_status', 'department', 'no_of_workingdays', 'holiday_pay', 'overtime_pay', 'holiday_overtime_pay', 'absences', 'absences_amount', 'late_undertime', 'late_undertime_pay', 'employees_dr', 'dr_to_other_company', 'due_from', 'sss_contribution_id', 'philhealth_contribution_id', 'hdmf_contribution_id', 'ef_contribution_id', 'leave_pay', 'gross_pay', 'total_deductions', 'net_salary', 'payroll_cycle', 'remarks', 'cutoff_date', 'working_hours', 'working_hours_overtime', 'holiday_type', 'is_restday', 'is_work', 'pay')
                ->orderBy('employee_code', 'ASC')
                ->get();
        }
        else
        {
            $payroll_details = '';
            $payroll_department = '';
            $payroll_employment_status = '';
            $payroll_employee_status = '';
            $payroll_date_range = '';
            $payroll_cutoff = '';
            $payroll_cycle = '';

            $cons_string = 'payroll_id <> 0';
            $sql_query = '';

            if($r_payroll_details)
            {
                $payroll_details = " AND (first_Name LIKE '%".$r_payroll_details."%' OR middle_name LIKE '%".$r_payroll_details."%' OR last_name LIKE '%".$r_payroll_details."%')";

            }

            if($r_payroll_department)
            {
                $payroll_department = " AND department = '".$r_payroll_department."'";
            }

            if($r_payroll_employment_status)
            {
                $payroll_employment_status = " AND employment_status = '".$r_payroll_employment_status."'";
            }

            if($r_payroll_employee_status)
            {
                $payroll_employee_status = " AND employee_status = '".$r_payroll_employee_status."'";
            }

            if($r_payroll_startdate && $r_payroll_enddate){
                $payroll_date_range = " AND cutoff_date >= '".$r_payroll_startdate."' AND cutoff_date <= '".$r_payroll_enddate."'";
                // $payroll_date_range = "";
                // dump($r_payroll_startdate);
            }

            if($r_payroll_cutoff){
                $payroll_cutoff = " AND cutoff_id = '".$r_payroll_cutoff."'";
            }

            if($r_payroll_cycle){
                $payroll_cycle = " AND payroll_cycle = '".$r_payroll_cycle."'";
            }

            $sql_query = $cons_string.$payroll_details.$payroll_department.$payroll_employment_status.$payroll_employee_status.$payroll_date_range.$payroll_cutoff.$payroll_cycle;
            $payrolls =  ViewPayrolls::orderBy('employee_code', 'ASC')
                ->groupBy(['employee_code', 'cutoff_id'])
                ->whereRaw($sql_query)
                ->paginate(10);

            // $payrolls_export =  $this->test_sql($r_payroll_details, $r_payroll_department, $r_payroll_employment_status, $r_payroll_employee_status, $r_payroll_startdate, $r_payroll_enddate, $r_payroll_cutoff, $r_payroll_cycle);
            $payrolls_export =  ViewPayrolls::select('employee_code',  'first_name', 'middle_name', 'last_name', 'employee_status', 'department', 'no_of_workingdays', 'holiday_pay', 'overtime_pay', 'holiday_overtime_pay', 'absences', 'absences_amount', 'late_undertime', 'late_undertime_pay', 'employees_dr', 'dr_to_other_company', 'due_from', 'sss_contribution_id', 'philhealth_contribution_id', 'hdmf_contribution_id', 'ef_contribution_id', 'leave_pay', 'gross_pay', 'total_deductions', 'net_salary', 'payroll_cycle', 'remarks', 'cutoff_date', 'working_hours', 'working_hours_overtime', 'holiday_type', 'is_restday', 'is_work', 'pay')
                ->orderBy('first_name', 'ASC')
                ->whereRaw($sql_query)
                ->get();
        }

        return $return_data = [
            'payroll' => $payrolls,
            'payroll_export' => $payrolls_export,
        ];
    }

    private function test_sql($r_payroll_details, $r_payroll_department, $r_payroll_employment_status, $r_payroll_employee_status, $r_payroll_startdate, $r_payroll_enddate, $r_payroll_cutoff, $r_payroll_cycle){
            $payroll_details = '';
            $payroll_department = '';
            $payroll_employment_status = '';
            $payroll_employee_status = '';
            $payroll_date_range = '';
            $payroll_cutoff = '';
            $payroll_cycle = '';

            $cons_string = 'payroll_details.cutoff_id <> 0';
            $sql_query = '';

            if($r_payroll_details)
            {
                $payroll_details = " AND (first_Name LIKE '%".$r_payroll_details."%' OR middle_name LIKE '%".$r_payroll_details."%' OR last_name LIKE '%".$r_payroll_details."%')";
            }

            if($r_payroll_department)
            {
                $payroll_department = " AND department = '".$r_payroll_department."'";
            }

            if($r_payroll_employment_status)
            {
                $payroll_employment_status = " AND employment_status = '".$r_payroll_employment_status."'";
            }

            if($r_payroll_employee_status)
            {
                $payroll_employee_status = " AND employee_status = '".$r_payroll_employee_status."'";
            }

            if($r_payroll_startdate && $r_payroll_enddate){
                $payroll_date_range = " AND cutoff_date >= '".$r_payroll_startdate."' AND cutoff_date <= '".$r_payroll_enddate."'";
                // $payroll_date_range = "";
                // dump($r_payroll_startdate);
            }

            if($r_payroll_cutoff){
                $payroll_cutoff = " AND payroll_details.cutoff_id = '".$r_payroll_cutoff."'";
            }

            if($r_payroll_cycle){
                $payroll_cycle = " AND payroll_cycle = '".$r_payroll_cycle."'";
            }

            $sql_query = $cons_string.$payroll_details.$payroll_department.$payroll_employment_status.$payroll_employee_status.$payroll_date_range.$payroll_cutoff.$payroll_cycle;
            $payrolls = DB::table('employees')
                ->selectRaw(
                    'IF(@employee_code = payrolls.employee_code, "", @employee_code := payrolls.employee_code)                AS employee_code,
                    IF(@first_name = first_name, "", @first_name := first_name)                  AS first_name,
                    IF(@middle_name = middle_name, "", @middle_name := middle_name)               AS middle_name,
                    IF(@last_name = last_name, "", @last_name := last_name)                   AS last_name,
                    IF(@employee_status = employee_status, "", @employee_status := employee_status)              AS employee_status,
                    IF(@employment_status = employment_status, "", @employment_status := employment_status)     AS employment_status,
                    IF(@department = department, "", @department := department)            AS department,

                    IF(@no_of_workingdays = payrolls.no_of_workingdays, "", @no_of_workingdays := payrolls.no_of_workingdays)             AS no_of_workingdays,
                    IF(@holiday_pay = payrolls.holiday_pay, "", @holiday_pay := payrolls.holiday_pay)                   AS holiday_pay,
                    IF(@holiday_overtime_pay = payrolls.holiday_overtime_pay, "", @holiday_overtime_pay := payrolls.holiday_overtime_pay)                  AS overtime_pay,
                    IF(@holiday_overtime_pay = payrolls.holiday_overtime_pay, "", @holiday_overtime_pay := payrolls.holiday_overtime_pay)          AS holiday_overtime_pay,
                    IF(@absences = payrolls.absences, "", @absences := payrolls.absences)                       AS absences,
                    IF(@absences_amount = payrolls.absences_amount, "", @absences_amount := payrolls.absences_amount)               AS absences_amount,
                    IF(@late_undertime = payrolls.late_undertime, "", @late_undertime := payrolls.late_undertime)                AS late_undertime,
                    IF(@late_undertime_pay = payrolls.late_undertime_pay, "", @late_undertime_pay := payrolls.late_undertime_pay)           AS late_undertime_pay,
                    IF(@employees_dr = payrolls.employees_dr, "", @employees_dr := payrolls.employees_dr)                  AS employees_dr,
                    IF(@dr_to_other_company = payrolls.dr_to_other_company, "", @dr_to_other_company := payrolls.dr_to_other_company)            AS dr_to_other_company,
                    IF(@due_from = payrolls.due_from, "", @due_from := payrolls.due_from)                      AS due_from,
                    IF(@sss_contribution_id = payrolls.sss_contribution_id, "", @sss_contribution_id := payrolls.sss_contribution_id)           AS sss_contribution_id,
                    IF(@philhealth_contribution_id = payrolls.philhealth_contribution_id, "", @philhealth_contribution_id := payrolls.philhealth_contribution_id)    AS philhealth_contribution_id,
                    IF(@hdmf_contribution_id = payrolls.hdmf_contribution_id, "", @hdmf_contribution_id := payrolls.hdmf_contribution_id)         AS hdmf_contribution_id,
                    IF(@ef_contribution_id = payrolls.ef_contribution_id, "", @ef_contribution_id := payrolls.ef_contribution_id)            AS ef_contribution_id,
                    IF(@leave_pay = payrolls.leave_pay, "", @leave_pay := payrolls.leave_pay)                     AS leave_pay,
                    IF(@gross_pay = payrolls.gross_pay, "", @gross_pay := payrolls.gross_pay)                     AS gross_pay,
                    IF(@total_deductions = payrolls.total_deductions, "", @total_deductions := payrolls.total_deductions)               AS total_deductions,
                    IF(@net_salary = payrolls.net_salary, "", @net_salary := payrolls.net_salary)                    AS net_salary,
                    IF(@payroll_cycle = payrolls.payroll_cycle, "", @payroll_cycle := payrolls.payroll_cycle)                 AS payroll_cycle,
                    IF(@status = payrolls.status, "", @status := payrolls.status)                        AS status,
                    IF(@remarks = payrolls.remarks, "", @remarks := payrolls.remarks)                     AS remarks,
                    IF(@cutoff_id = payroll_details.cutoff_id, "", @cutoff_id := payroll_details.cutoff_id)              AS cutoff_id,
                    DATE_FORMAT(f_get_cutoff_date(payroll_details.cutoff_id), "%M %c, %Y")  AS cutoff_date,
                    payroll_details.employee_id            AS employee_id,
                    payroll_details.attendance_id          AS attendance_id,
                    payroll_details.working_hours          AS working_hours,
                    payroll_details.working_hours_overtime AS working_hours_overtime,
                    payroll_details.holiday_type           AS holiday_type,
                    payroll_details.is_restday             AS is_restday,
                    payroll_details.is_work                AS is_work,
                    payroll_details.pay                    AS pay')
                ->join('employee_details', 'employees.employee_id', '=', 'employee_details.employee_id')
                ->join('payrolls', 'employees.employee_id', '=', 'payrolls.employee_id')
                ->join('payroll_details', 'employees.employee_id', '=', 'payroll_details.employee_id')
                // ->whereRaw($sql_query)
                ->get();

            return $payrolls;
    }

    public function get_loan_reports(Request $request){
        $loans = Loans::where('employee_id', $request->emp_id)->get();
        return $loans;
    }
}
