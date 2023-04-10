<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use App\Models\Employees;
use App\Models\EmployeeDr;
use App\Models\OtherCompanyDr;
use App\Models\DueFrom;
use App\Models\EmployeeLeavePay;
use App\Models\HolidayComputations;
use App\Models\KindsOfComputations;
use App\Models\Holiday;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = [];
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);

        // For other company dr
        $view_ocdr = false;
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr_record = '';

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';


        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        if(request()->query('edr_search')){
            $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')
                ->whereHas('Employee', function (Builder $query) {
                    $query->where('first_name', 'like', '%'.request()->query('edr_search').'%')
                            ->orWhere('middle_name', 'like', '%'.request()->query('edr_search').'%')
                            ->orWhere('last_name', 'like', '%'.request()->query('edr_search').'%');
                })
                ->orwhereHas('EmployeeDetails', function (Builder $query) {
                    $query->where('department', 'like', '%'.request()->query('edr_search').'%');
                })
                ->groupBy('employee_id')->paginate(10);
        }
        else if(request()->query('ocdr_search')){
            $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')
                ->whereHas('Employee', function (Builder $query) {
                    $query->where('first_name', 'like', '%'.request()->query('ocdr_search').'%')
                            ->orWhere('middle_name', 'like', '%'.request()->query('ocdr_search').'%')
                            ->orWhere('last_name', 'like', '%'.request()->query('ocdr_search').'%');
                })
                ->orwhereHas('EmployeeDetails', function (Builder $query) {
                    $query->where('department', 'like', '%'.request()->query('ocdr_search').'%');
                })
                ->groupBy('employee_id')->paginate(10);
        }
        else if(request()->query('duefrom_search')){
            $due_from = DueFrom::with('Employee', 'EmployeeDetails')
                ->whereHas('Employee', function (Builder $query) {
                    $query->where('first_name', 'like', '%'.request()->query('duefrom_search').'%')
                            ->orWhere('middle_name', 'like', '%'.request()->query('duefrom_search').'%')
                            ->orWhere('last_name', 'like', '%'.request()->query('duefrom_search').'%');
                })
                ->orwhereHas('EmployeeDetails', function (Builder $query) {
                    $query->where('department', 'like', '%'.request()->query('duefrom_search').'%');
                })
                ->groupBy('employee_id')->paginate(10);
        }
        else if(request()->query('leavepay_search')){
            $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')
                ->whereHas('Employee', function (Builder $query) {
                    $query->where('first_name', 'like', '%'.request()->query('duefrom_search').'%')
                            ->orWhere('middle_name', 'like', '%'.request()->query('duefrom_search').'%')
                            ->orWhere('last_name', 'like', '%'.request()->query('duefrom_search').'%');
                })
                ->orwhereHas('EmployeeDetails', function (Builder $query) {
                    $query->where('department', 'like', '%'.request()->query('duefrom_search').'%');
                })
                ->groupBy('employee_id')->paginate(10);
        }

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'total_amount' => $total_amount,

            'employees_dr' => $employees_dr,
            'view_dr' => $view_dr,
            'view_dr_record' => $view_dr_record,
            'view_dr_records' => $view_dr_records,

            'view_ocdr' => $view_ocdr,
            'view_ocdr_record' => $view_ocdr_record,
            'other_company_dr' => $other_company_dr,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
        ]);
    }

    public function set_active_tab(Request $request){
        $passcode_obj = Settings::find(1);
        $passcode_obj->active_tab = $request->tab_value;
        $passcode_obj->save();

        //Return data
        $active_tab = Settings::where('id', 1)->first();
        return $active_tab->active_tab;
    }

    public function set_authorization_code(Request $request){
        $passcode_encrypt = Crypt::encryptString($request->pass_code); // encryption

        $passcode_obj = Settings::find(1);
        $passcode_obj->authorization_code = $passcode_encrypt;
        $passcode_obj->save();
        // $decrypted = Crypt::decryptString($passcode_encrypt); // decryption
        return $passcode_encrypt;
    }

    public function store_employee_dr(Request $request){
        $employee_dr = EmployeeDr::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        return 'true';
    }

    public function show_employee_dr($id){
        //For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = true;
        $view_dr_record = EmployeeDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->first();
        $view_dr_records = EmployeeDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = '';
        $view_ocdr_records = OtherCompanyDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        if(request()->query('vdr_start_date') && request()->query('vdr_end_date')){
            $view_dr_records = EmployeeDr::where('employee_id', $id)
                                            ->where('created_at', '>=', date('Y-m-d', strtotime(request()->query('vdr_start_date'))))
                                            ->where('created_at', '<=', date('Y-m-d', strtotime(request()->query('vdr_end_date').' +1 day')))
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        else if(request()->query('vdr_note')){
            $view_dr_records = EmployeeDr::where('employee_id', $id)
                                            ->where('note', 'like', '%'.request()->query('vdr_note').'%')
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        if(!$view_dr_record){
           return redirect()->route('settings');
        }

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function update_employee_dr(Request $request){
        //Update process
        $emp_dr = EmployeeDr::find($request->id);
        $emp_dr->amount = $request->amount;
        $emp_dr->note = $request->note;
        $emp_dr->save();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = true;
        $view_dr_record = EmployeeDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_dr_records = EmployeeDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function delete_employee_dr(Request $request){
        // Delete process
        $emp_dr = EmployeeDr::find($request->id);
        $emp_dr->delete();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = EmployeeDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_dr_records = EmployeeDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function store_employee_ocdr(Request $request){
        $employee_dr = OtherCompanyDr::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        return 'true';
    }

    public function show_employee_ocdr($id){
        $active_tab = Settings::where('id', 1)->first();
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;

        //For other company dr
        $view_ocdr = true;

        $view_dr_record = '';
        $view_dr_records = [];

        $view_ocdr_record = OtherCompanyDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->first();
        $view_ocdr_records = OtherCompanyDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        // dump(request()->query('vdr_start_date'), request()->query('vdr_end_date'));
        if(request()->query('vdr_start_date') && request()->query('vdr_end_date')){
            $view_ocdr_records = OtherCompanyDr::where('employee_id', $id)
                                            ->where('created_at', '>=', date('Y-m-d', strtotime(request()->query('vdr_start_date'))))
                                            ->where('created_at', '<=', date('Y-m-d', strtotime(request()->query('vdr_end_date').' +1 day')))
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        else if(request()->query('vdr_note')){
            $view_ocdr_records = OtherCompanyDr::where('employee_id', $id)
                                            ->where('note', 'like', '%'.request()->query('vdr_note').'%')
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        if(!$view_ocdr_record){
           return redirect()->route('settings');
        }

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function update_employee_ocdr(Request $request){
        //Update process
        $emp_dr = OtherCompanyDr::find($request->id);
        $emp_dr->amount = $request->amount;
        $emp_dr->note = $request->note;
        $emp_dr->save();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = EmployeeDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_dr_records = EmployeeDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = true;
        $view_ocdr_record = OtherCompanyDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_ocdr_records = OtherCompanyDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function delete_employee_ocdr(Request $request){
        // Delete process
        $emp_ocdr = OtherCompanyDr::find($request->id);
        $emp_ocdr->delete();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = [];

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = OtherCompanyDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_ocdr_records = OtherCompanyDr::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function store_employee_duefrom(Request $request){
        $employee_dr = DueFrom::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        return 'true';
    }

    public function show_employee_duefrom($id){
        $active_tab = Settings::where('id', 1)->first();
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;

        //For other company dr
        $view_ocdr = false;
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);

        $view_dr_record = '';
        $view_dr_records = [];

        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = true;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = DueFrom::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->first();
        $view_duefrom_records = DueFrom::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        // dump(request()->query('vdr_start_date'), request()->query('vdr_end_date'));
        if(request()->query('duefrom_start_date') && request()->query('duefrom_end_date')){
            $view_duefrom_records = DueFrom::where('employee_id', $id)
                                            ->where('created_at', '>=', date('Y-m-d', strtotime(request()->query('duefrom_start_date'))))
                                            ->where('created_at', '<=', date('Y-m-d', strtotime(request()->query('duefrom_end_date').' +1 day')))
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        else if(request()->query('duefrom_note')){
            $view_duefrom_records = DueFrom::where('employee_id', $id)
                                            ->where('note', 'like', '%'.request()->query('duefrom_note').'%')
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        if(!$view_duefrom_record){
           return redirect()->route('settings');
        }

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,
            'other_company_dr' => $other_company_dr,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function update_employee_duefrom(Request $request){
        //Update process
        $emp_dr = DueFrom::find($request->id);
        $emp_dr->amount = $request->amount;
        $emp_dr->note = $request->note;
        $emp_dr->save();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = [];

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = true;
        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = DueFrom::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();;
        $view_duefrom_records = DueFrom::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function delete_employee_duefrom(Request $request){
        // Delete process
        $emp_ocdr = DueFrom::find($request->id);
        $emp_ocdr->delete();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = [];

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = DueFrom::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_duefrom_records = DueFrom::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = '';
        $view_leavepay_records = [];

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function store_employee_leavepay(Request $request){
        $leavepay_records = EmployeeLeavePay::where('employee_id', $request->employee_id)->get();
        $year_ = date('Y');
        $leave_counter = 0;
        foreach($leavepay_records as $key => $value){
            if(date('Y', strtotime($value->created_at)) == $year_){
                $leave_counter = ($leave_counter + 1);
            }
        }

        if($request->number_of_days > 6 || ((int)$leave_counter + (int)$request->number_of_days) > 6 || $leave_counter > 6){
            return 'Maximum leave days reached!';
        }
        else {
            $cond = date('Y-m-d', strtotime($request->start_date));
            $edate = date('Y-m-d', strtotime($request->end_date));

            $verify_counter = 0;
            while($cond <= $edate){
                $verify_counter = ($verify_counter + 1);
                $cond = date('Y-m-d', strtotime($cond.' +1 day'));
            }

            $is_proceed = false;
            $leavepay_previous_records = EmployeeLeavePay::where('employee_id', $request->employee_id)->pluck('leave_date')->toArray();
            $cond2 = date('Y-m-d', strtotime($request->start_date));

            while($cond2 <= $edate){
                if(in_array($cond2, $leavepay_previous_records)){
                    return 'Date already occupied!';
                }
                $cond2 = date('Y-m-d', strtotime($cond2.' +1 day'));
            }
            $is_proceed = true;

            if($verify_counter == $request->number_of_days && $is_proceed){
                $cond = date('Y-m-d', strtotime($request->start_date));
                $noofdays = 1;
                while($cond <= $edate){
                    $employee_leavepay = EmployeeLeavePay::create([
                        'employee_id' => $request->employee_id,
                        // 'number_of_days' => $noofdays,
                        // 'start_date' => date('Y-m-d', strtotime($request->start_date)),
                        // 'end_date' => date('Y-m-d', strtotime($request->end_date)),
                        'leave_date' => ($cond),
                        'note' => $request->note,
                    ]);
                    $cond = date('Y-m-d', strtotime($cond.' +1 day'));
                }
                return 'true';
            }
            else{
                return 'Number of days and date range don\'t match';
            }
        }
    }

    public function show_employee_leavepay($id){
        //For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = EmployeeDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = '';
        $view_ocdr_records = OtherCompanyDr::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = true;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = EmployeeLeavePay::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->first();
        $view_leavepay_records = EmployeeLeavePay::where('employee_id', $id)->with('Employee', 'EmployeeDetails')->paginate(10);

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        if(request()->query('leavepay_start_date') && request()->query('leavepay_end_date')){
            $view_leavepay_records = EmployeeLeavePay::where('employee_id', $id)
                                            ->where('created_at', '>=', date('Y-m-d', strtotime(request()->query('leavepay_start_date'))))
                                            ->where('created_at', '<=', date('Y-m-d', strtotime(request()->query('leavepay_end_date').' +1 day')))
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        else if(request()->query('leavepay_note')){
            $view_leavepay_records = EmployeeLeavePay::where('employee_id', $id)
                                            ->where('note', 'like', '%'.request()->query('leavepay_note').'%')
                                            ->with('Employee', 'EmployeeDetails')->paginate(10);
        }
        if(!$view_leavepay_record){
           return redirect()->route('settings');
        }

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function delete_employee_leavepay(Request $request){
        // Delete process
        $emp_leavepay = EmployeeLeavePay::find($request->id);
        $emp_leavepay->delete();

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = [];

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = false;
        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = EmployeeLeavePay::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();;
        $view_leavepay_records = EmployeeLeavePay::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }

    public function update_employee_leavepay(Request $request){
        $leavepay_previous_records = EmployeeLeavePay::where('employee_id', $request->emp_id)->pluck('leave_date')->toArray();
        if(in_array(date('Y-m-d', strtotime($request->leave_date)), $leavepay_previous_records)){
            return 'Date already occupied!';
        }
        $emp_dr = EmployeeLeavePay::find($request->id);
        $emp_dr->leave_date = date('Y-m-d', strtotime($request->leave_date));
        $emp_dr->note = $request->note;
        $emp_dr->save();
        return 'true';

        // For active tab
        $active_tab = Settings::where('id', 1)->first();
        // For Dropdown selection of employees
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        // For total amount each employee
        $total_amount = 0;

        // For employee dr
        $employees_dr = EmployeeDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_dr = false;
        $view_dr_record = '';
        $view_dr_records = [];

        // For other company dr
        $other_company_dr = OtherCompanyDr::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_ocdr = true;
        $view_ocdr_record = '';
        $view_ocdr_records = [];

        // Due From
        $view_duefrom = false;
        $due_from = DueFrom::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_duefrom_record = '';
        $view_duefrom_records = [];

        // Leave Pays
        $view_leavepay = false;
        $leave_pay = EmployeeLeavePay::with('Employee', 'EmployeeDetails')->groupBy('employee_id')->paginate(10);
        $view_leavepay_record = EmployeeLeavePay::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->first();
        $view_leavepay_records = EmployeeLeavePay::where('employee_id', $request->emp_id)->with('Employee', 'EmployeeDetails')->paginate(10);

        //Holiday Computations
        $holiday_computations = HolidayComputations::all();
        $kinds_of_computations = KindsOfComputations::all();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return view('modules.settings.settings', [
            'active_tab' => $active_tab->active_tab,
            'employees' => $employees,
            'employees_dr' => $employees_dr,
            'other_company_dr' => $other_company_dr,
            'total_amount' => $total_amount,

            'view_dr' => $view_dr,
            'view_ocdr' => $view_ocdr,
            'view_dr_record' => $view_dr_record,
            'view_ocdr_record' => $view_ocdr_record,
            'view_dr_records' => $view_dr_records,
            'view_ocdr_records' => $view_ocdr_records,

            'view_duefrom' => $view_duefrom,
            'due_from' => $due_from,
            'view_duefrom_record' => $view_duefrom_record,
            'view_duefrom_records' => $view_duefrom_records,
            'holiday_computations' => $holiday_computations,
            'kinds_of_computations' => $kinds_of_computations,
            'holidays' => $holidays,

            'view_leavepay' => $view_leavepay,
            'leave_pay' => $leave_pay,
            'view_leavepay_record' => $view_leavepay_record,
            'view_leavepay_records' => $view_leavepay_records,
        ]);
    }


    public function update_holiday_computations(Request $request){
        $update_computation = HolidayComputations::find($request->computation_id);
        $update_computation->computation_field2 = $request->computation_field2 ? $request->computation_field2 : null;
        $update_computation->computation_field3 = $request->computation_field3 ? $request->computation_field3 : null;
        $update_computation->computation_field4 = $request->computation_field4 ? $request->computation_field4 : null;
        $update_computation->computation_field5 = $request->computation_field5 ? $request->computation_field5 : null;
        $update_computation->computation_field6 = $request->computation_field6 ? $request->computation_field6 : null;
        $update_computation->computation_field7 = $request->computation_field7 ? $request->computation_field7 : null;
        $update_computation->save();


        return HolidayComputations::all();
    }

    public function holiday_store(Request $request){
        $holiday = Holiday::create([
            'holiday_date' => date('Y-m-d', strtotime($request->holiday_date)),
            'holiday_name' => $request->holiday_name,
            'holiday_type' => $request->holiday_type,
        ]);

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return $holidays;
    }

    public function holiday_update(Request $request){
        // Update Record

        $update_holiday = Holiday::find($request->holiday_id);
        $update_holiday->holiday_date = date('Y-m-d', strtotime($request->holiday_date));
        $update_holiday->holiday_name = $request->holiday_name;
        $update_holiday->holiday_type = $request->holiday_type;
        $update_holiday->save();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return $holidays;
    }

    public function delete_holiday(Request $request){
        // Delete Record
        $update_holiday = Holiday::find($request->holiday_id);
        $update_holiday->delete();

        //Holidays
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();
        return $holidays;
    }

}
