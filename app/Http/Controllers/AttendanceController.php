<?php

namespace App\Http\Controllers;
use App\Models\Attendances;
use App\Models\Employees;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Excel;
use App\Imports\ImportAttendances;
use Carbon\Carbon;
use App\Models\Cutoff;

// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_ids = Attendances::groupBy('employee_no')->pluck('employee_no');
        if (request()->query('search'))
        {
            // $attendances = Attendances::where('employee_no', request()->query('search'))
            $attendances = Employees::whereIn('employee_code', $_ids)
            ->where('first_name', 'like', '%'.request()->query('search').'%')
            ->orWhere('middle_name', 'like', '%'.request()->query('search').'%')
            ->orWhere('last_name', 'like', '%'.request()->query('search').'%')
            ->paginate(10);
        }
        else
        {
            $attendances = Employees::whereIn('employee_code', $_ids)->paginate(10);
        }
        return view('modules.attendance.attendances', ['attendances' => $attendances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        return view('modules.attendance.upload-attendance', [
            'current_date' => date('m/d/Y'),
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * Saving data to Database
         * $request->all() to get all request data from axios POST
         *
         */
        $attendance_data = $request->attendance_data;
        $employees = Employees::all();

        $att_emp_no = [];
        for ($i=0; $i < (sizeof($attendance_data)); $i++) {
            $att_emp_no[$i] = $attendance_data[$i]['employee_no'];
        }

        $db_employee_code = [];
        $_index = 0;
        foreach($employees as $emp_record){
            $db_employee_code[$_index] = $emp_record->employee_code;
            $_index++;
        }

        $is_proceed = true;
        for ($i=0; $i < sizeOf($att_emp_no); $i++) {
            if(in_array($att_emp_no[$i], $db_employee_code) ){
                $is_proceed = true;
            }
            else {
                $is_proceed = false;
                break;
            }
        }

        if($is_proceed){
            try {
                // for ($i=0; $i < (sizeof($attendance_data)); $i++) {
                //     if(!$attendance_data[$i]['time_in_am'] || !$attendance_data[$i]['time_out_am'] || !$attendance_data[$i]['time_in_pm'] && !$attendance_data[$i]['time_out_pm']){
                //         return true;
                //     }
                // }
                $new_cutoff = Cutoff::create([
                    'cutoff_date' => date('Y-m-d', strtotime($request->cutoff_date)),
                ]);

                for ($i=0; $i < (sizeof($attendance_data)); $i++) {
                    $attendance_record = Attendances::create([
                        'employee_no' =>    $attendance_data[$i]['employee_no'],
                        'cutoff_id' =>      $new_cutoff->cutoff_id,
                        'account_no' =>     $attendance_data[$i]['account_no'],
                        'number' =>         $attendance_data[$i]['no'],
                        'date_in' =>        date('Y-m-d', strtotime($attendance_data[$i]['date'])),
                        'time_in_am' =>     $attendance_data[$i]['time_in_am'],
                        'time_out_am' =>    $attendance_data[$i]['time_out_am'],
                        'time_in_pm' =>     $attendance_data[$i]['time_in_pm'],
                        'time_out_pm' =>    $attendance_data[$i]['time_out_pm'],
                    ]);
                }
            } catch (QueryException $exception) {
                // $newly_created_attendances = Attendances::find($new_cutoff->cutoff_id);
                // $newly_created_attendances->delete();
                $newly_created_cutoff = Cutoff::find($new_cutoff->cutoff_id);
                $newly_created_cutoff->delete();
                return $exception->getMessage();
                // return true;
            }

        }
        else {
            return 'One of the employee code does not match in database records!';
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee_record = Employees::where('employee_code', $id)->first();
        $cutoff_dates = Cutoff::all();

        if (request()->query('v_search')) {
            $_cutoff_date = date('Y-m-d', strtotime(request()->query('v_search')));
            $_cutoff = Cutoff::where('cutoff_date', $_cutoff_date)->first();
            // dd($_cutoff->cutoff_id);
            $employee_attendances = Attendances::where('employee_no', $id)
            ->where('cutoff_id', $_cutoff->cutoff_id)
            ->paginate(10);
        }
        else if (request()->query('v_start_date') && request()->query('v_end_date')) {
            $employee_attendances = Attendances::where('employee_no', $id)
            ->where('date_in', '>=', date('Y-m-d', strtotime(request()->query('v_start_date'))))
            ->where('date_in', '<=', date('Y-m-d', strtotime(request()->query('v_end_date'))))
            ->paginate(10);
        }
        else {
            $employee_attendances = Attendances::where('employee_no', $id)->paginate(10);
        }



        return view('modules.attendance.view-attendance', [
            'current_date' => date('m/d/Y'),
            'employee_code' => $id,
            'employee_record' => $employee_record,
            'employee_attendances' => $employee_attendances,
            'cutoff_dates' => $cutoff_dates
        ]);
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

    public function upload_attendance(Request $request)
    {
        $filename = rand(12, 34353).time().'_attendance.'.($request->file_type);
        $request->file('attendance_file')->storeAs('public/attendance_uploads', $filename);
        $data = Excel::toCollection(new ImportAttendances, public_path('storage\attendance_uploads\\'.$filename));
        // use realpath instead of public_path when desployed in hosting
        return $data;
    }

    public function check_cutoff(Request $request){
        $cutoff_dates = Cutoff::all();
        return $cutoff_dates;
    }

    public function process_time(Request $request){
        // DTR Static
        $default_time_in_am = strtotime('08:00:00 AM');
        $default_time_out_am = strtotime('12:00:00 PM');
        $default_time_in_pm = strtotime('1:00:00 PM');
        $default_time_out_pm = strtotime('5:00:00 PM');
        // DTR Static
        $return_arr = array();
        for ($i = 0; $i < sizeof($request->dtr_to_process); $i++) {
            $new_time_in_am = null;
            $new_time_out_am = null;
            $new_time_in_pm = null;
            $new_time_out_pm = null;


            $row = ($request->dtr_to_process[$i]);
            $time_in_am     = ($row[0]['_field6'] == '') ? '' : strtotime($row[0]['_field6']);
            $time_out_am    = ($row[0]['_field7'] == '') ? '' : strtotime($row[0]['_field7']);
            $time_in_pm     = ($row[0]['_field8'] == '') ? '' : strtotime($row[0]['_field8']);
            $time_out_pm    = ($row[0]['_field9'] == '') ? '' : strtotime($row[0]['_field9']);

            if($time_in_am && $time_out_am && $time_in_pm && $time_out_pm ){
                $new_time_in_am = date('h:i:s A', $time_in_am);
                $new_time_out_am = date('h:i:s A', $time_out_am);
                $new_time_in_pm = date('h:i:s A', $time_in_pm);
                $new_time_out_pm = date('h:i:s A', $time_out_pm);
            }
            else if($time_in_am && $time_out_am && !$time_in_pm && !$time_out_pm){
                if($time_in_am < $default_time_out_am && $time_out_am < $default_time_in_pm){
                    $new_time_in_am = date('h:i:s A', $time_in_am);;
                    $new_time_out_am = date('h:i:s A', $time_out_am);
                    $new_time_in_pm = '';
                    $new_time_out_pm = '';
                }
                else if($time_in_am < $default_time_out_am && $time_out_am > $default_time_in_pm) {
                    $new_time_in_am = date('h:i:s A', $time_in_am);
                    $new_time_out_am = date('h:i:s A', $default_time_out_am);
                    $new_time_in_pm = date('h:i:s A', $default_time_in_pm);
                    $new_time_out_pm = date('h:i:s A', $time_out_am);
                }
                else {
                    $new_time_in_am = '';
                    $new_time_out_am = '';
                    $new_time_in_pm = date('h:i:s A', $time_in_am);
                    $new_time_out_pm = date('h:i:s A', $time_out_am);
                }
            }
            else if($time_in_am && !$time_out_am && !$time_in_pm && !$time_out_pm){
                $new_time_in_am = date('h:i:s A', $time_in_am);
                $new_time_out_am = date('h:i:s A', $default_time_out_am);
                $new_time_in_pm = date('h:i:s A', $default_time_in_pm);
                $new_time_out_pm = date('h:i:s A', $default_time_out_pm);
            }

            $row_data = [
                'emp_no' => $row[0]['_field1'],
                'acc_no' => $row[0]['_field2'],
                'no' => $row[0]['_field3'] == 'null' ? '' : $row[0]['_field3'],
                'name' => $row[0]['_field4'],
                'date' => $row[0]['_field5'],
                'timein_am' => $new_time_in_am,
                'timeout_am' => $new_time_out_am,
                'timein_pm' => $new_time_in_pm,
                'timeout_pm' => $new_time_out_pm,
            ];

            array_push($return_arr, $row_data);
        }

        return $return_arr;



        //

        // return $row_data = [
        //     'emp_no' => $request->_field1,
        //     'acc_no' => $request->_field2,
        //     'no' => $request->_field3 == 'null' ? '' : $request->_field3,
        //     'name' => $request->_field4,
        //     'date' => $request->_field5,
        //     'timein_am' => $request->_field6,
        //     'timeout_am' => $new_time_out_am,
        //     'timein_pm' => $new_time_in_pm,
        //     'timeout_pm' => $new_time_out_pm,
        // ];
    }

}
