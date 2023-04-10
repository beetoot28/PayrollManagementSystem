<?php

namespace App\Http\Controllers;
use App\Models\Employees;
use App\Models\EmployeeDetails;
use App\Models\Loans;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->query('search')) // for search function
        {
            $employees = Employees::where('employee_code', request()->query('search'))
                                    ->orWhere('first_name', 'like', '%'.request()->query('search').'%')
                                    ->orWhere('middle_name', 'like', '%'.request()->query('search').'%')
                                    ->orWhere('last_name', 'like', '%'.request()->query('search').'%')
                                    ->orWhere('age', request()->query('search'))
                                    ->orWhere('sex', 'like', '%'.request()->query('search').'%')
                                    ->orWhere('mobile_no', 'like', '%'.request()->query('search').'%')
                                    ->orWhere('nationality', 'like', '%'.request()->query('search').'%')
                                    ->orWhere('employee_status', 'like', '%'.request()->query('search').'%')
                                    // ->orWhere('employee_code', '')
                                    ->paginate(10);
        }
        else
        {
            $employees =  Employees::with('EmployeeDetails')->orderBy('first_name', 'ASC')->paginate(10);
        }
        return view('modules.employees.employees',
        [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.employees.new-employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validation
        $request->validate([
            'employee_status' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'numeric'],
            'sex' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'string', 'min:7', 'max:11'],
            // 'date_of_birth' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],

            'barangay' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],

            'employee_number' => ['required', 'string', 'max:30'],
            'department' => ['required', 'string', 'max:255'],
            'basic_rate' => ['required', 'string', 'max:255'],
            'allowance' => ['required', 'string', 'max:255'],
            'leave_pay' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'date_hired' => ['required', 'string', 'max:255'],
            'employment_status' => ['required', 'string', 'max:255'],
            'sss_number' => ['required', 'string', 'max:255'],
            'philhealth_no' => ['required', 'string', 'max:255'],
            'tin_no' => ['required', 'string', 'max:255'],
            'pagibig_no' => ['required', 'string', 'max:255'],

            'sss_contribution' => ['required', 'string', 'max:255'],
            'philhealth_contribution' => ['required', 'string', 'max:255'],
            'ef_contribution' => ['required', 'string', 'max:255'],
            'pagibig_contribution' => ['required', 'string', 'max:255'],

            'marital_status' => ['required', 'string', 'max:255'],
            'number_of_children' => ['required', 'numeric'],
            'spouse_name' => ['required', 'string', 'max:255'],
            'spouse_occupation' => ['required', 'string', 'max:255'],
            'contact_person' => ['required', 'string', 'max:255'],
            'emergency_number' => ['required', 'string', 'min:7', 'max:11'],
            'contact_person_address' => ['required', 'string', 'max:255'],
            'dependant' => ['required', 'string'],
        ]);

        /*
         * Employee Status
         *  1 - Regular
         *  2 - Casual
         */

        /*
         * Sex
         *  1 - Male
         *  2 - Female
         */

         /*
         * Department
         *  1 - Sales Department
         *  2 - Accounting Department
         *  3 - Finance Department
         *  4 - Logistics Department
         */

         /*
         * Employment Status
         *  1 - Active
         *  2 - Resigned
         */

         /*
         * Marital Status
         *  1 - Single
         *  2 - Married
         *  3 - Widowed
         *  4 - Separated
         */
        try {
            // check if input for image has a value
            // emp_photo refers to the name of the input filed for image/photo
            $filename = '';
            if($request->hasFile('emp_photo'))
            {
                // if may laman check natin if image format ba
                $extension = strtolower($request->file('emp_photo')->getClientOriginalExtension()); // get file extension
                // check the allowed files extension
                if ($extension != 'jpeg' && $extension != 'png' && $extension != 'jpg' && $extension != 'gif')
                {
                    return redirect()->route('create-employee')->withInput($request->all())->with('error_message', 'Image format invalid.');
                }
                else
                {
                    $filename = rand(12, 34353).time().'_employeephoto.'.$extension;
                    $request->file('emp_photo')->storeAs('public/employee', $filename);
                }
            }

            $employee = Employees::create([
                'employee_code' => $request->employee_number,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                // 'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
                'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
                'sex' => $request->sex == 1 ? 'Male' : 'Female',
                'mobile_no' => $request->mobile_no,
                'nationality' => $request->nationality,
                'employee_status' => $request->employee_status == 1 ? 'Regular' : 'Casual',
                'employee_photo' => $filename ? $filename : ($request->sex == 1 ? 'male.png' : 'female.png'),
            ]);

            $employee_details = EmployeeDetails::create([
                'employee_id' => $employee->employee_id,
                'block_house_no' => $request->block_house_no,
                'street' => $request->street,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'marital_status' => $request->marital_status == 1 ? 'Single' : ($request->marital_status == 2 ? 'Married' : ($request->marital_status == 3 ? 'Widowed' : 'Separated')),
                'no_of_children' => $request->number_of_children,
                'spouse_name' => $request->spouse_name,
                'spouse_occupation' => $request->spouse_occupation,
                'dependant' => $request->dependant,
                'emergency_contact_name' => $request->contact_person,
                'emergency_contact_no' => $request->emergency_number,
                'emergency_contact_address' => $request->contact_person_address,
                'basic_rate' => $request->basic_rate,
                'allowance' => $request->allowance,
                'leave_with_pay' => $request->leave_pay,
                'with_ot_pay' => $request->ot_pay_value == 'true' ? 1 : 0,
                'department' => $request->department == 1 ? 'Sales Department' : ($request->department == 2 ? 'Accounting Department' : ($request->department == 3 ? 'Finance Department' : 'Logistics Department')),
                'position' => $request->position,
                'employee_history_position' => $request->pwposition,
                'sss_no' => $request->sss_number,
                'philhealth_no' => $request->philhealth_no,
                'tin_no' => $request->tin_no,
                'hdmf_no' => $request->pagibig_no,
                'date_hired' => date('Y-m-d', strtotime($request->date_hired)),
                // 'date_resigned' => $request->street,
                'employment_status' => $request->employment_status == 1 ? 'Active' : 'Resigned',
                'sss_contribution' => $request->sss_contribution,
                'philhealth_contribution' => $request->philhealth_contribution,
                'ef_contribution' => $request->ef_contribution,
                'hdmf_contribution' => $request->pagibig_contribution,
            ]);
            $employee->save();
            $employee_details->save();
        } catch (QueryException $exception) {
            return redirect()->route('create-employee')->withInput($request->all())->with('error_message', 'Employee Code already exist!. Please enter a new one.');
        }
        return redirect()->route('employee')->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees =  Employees::where('employee_id', $id)->with('EmployeeDetails')->first();
        $loans = Loans::where('employee_id', $id)->get();
        return view('modules.employees.view-employee', [
            'employees' => $employees,
            'loans' => $loans
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
        $employees = Employees::where('employee_id', $id)->first();
        $loans = Loans::where('employee_id', $id)->get();
        // need din natin dito i declare si error_message kasi mag error sya hehe blank lang
        return view('modules.employees.update-employee', [
            'employees' => $employees,
            'error_message' => '',
            'loans' => $loans
        ]);
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
        // Validation
        if($request->employment_status == 1){
            $request->validate([
                'employee_status' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'age' => ['required', 'numeric'],
                'sex' => ['required', 'string', 'max:255'],
                'mobile_no' => ['required', 'string', 'min:7', 'max:11'],
                'date_of_birth' => ['required', 'string', 'max:255'],
                'nationality' => ['required', 'string', 'max:255'],

                'barangay' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'province' => ['required', 'string', 'max:255'],

                'employee_number' => ['required', 'string', 'max:30'],
                'department' => ['required', 'string', 'max:255'],
                'basic_rate' => ['required', 'string', 'max:255'],
                'allowance' => ['required', 'string', 'max:255'],
                'leave_pay' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'date_hired' => ['required', 'string', 'max:255'],
                'employment_status' => ['required', 'string', 'max:255'],
                'sss_number' => ['required', 'string', 'max:255'],
                'philhealth_no' => ['required', 'string', 'max:255'],
                'tin_no' => ['required', 'string', 'max:255'],
                'pagibig_no' => ['required', 'string', 'max:255'],

                'sss_contribution' => ['required', 'string', 'max:255'],
                'philhealth_contribution' => ['required', 'string', 'max:255'],
                'ef_contribution' => ['required', 'string', 'max:255'],
                'pagibig_contribution' => ['required', 'string', 'max:255'],

                'marital_status' => ['required', 'string', 'max:255'],
                'number_of_children' => ['required', 'numeric'],
                'spouse_name' => ['required', 'string', 'max:255'],
                'spouse_occupation' => ['required', 'string', 'max:255'],
                'contact_person' => ['required', 'string', 'max:255'],
                'emergency_number' => ['required', 'string', 'min:7', 'max:11'],
                'contact_person_address' => ['required', 'string', 'max:255'],
                'dependant' => ['required', 'string'],
            ]);
        }
        else{
            $request->validate([
                'employee_status' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'age' => ['required', 'numeric'],
                'sex' => ['required', 'string', 'max:255'],
                'mobile_no' => ['required', 'string', 'min:7', 'max:11'],
                'date_of_birth' => ['required', 'string', 'max:255'],
                'nationality' => ['required', 'string', 'max:255'],

                'barangay' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'province' => ['required', 'string', 'max:255'],

                'employee_number' => ['required', 'string', 'max:30'],
                'department' => ['required', 'string', 'max:255'],
                'basic_rate' => ['required', 'string', 'max:255'],
                'allowance' => ['required', 'string', 'max:255'],
                'leave_pay' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'date_hired' => ['required', 'string', 'max:255'],
                'employment_status' => ['required', 'string', 'max:255'],
                'date_resigned' => ['required', 'string', 'max:255'],
                'sss_number' => ['required', 'string', 'max:255'],
                'philhealth_no' => ['required', 'string', 'max:255'],
                'tin_no' => ['required', 'string', 'max:255'],
                'pagibig_no' => ['required', 'string', 'max:255'],

                'sss_contribution' => ['required', 'string', 'max:255'],
                'philhealth_contribution' => ['required', 'string', 'max:255'],
                'ef_contribution' => ['required', 'string', 'max:255'],
                'pagibig_contribution' => ['required', 'string', 'max:255'],

                'marital_status' => ['required', 'string', 'max:255'],
                'number_of_children' => ['required', 'numeric'],
                'spouse_name' => ['required', 'string', 'max:255'],
                'spouse_occupation' => ['required', 'string', 'max:255'],
                'contact_person' => ['required', 'string', 'max:255'],
                'emergency_number' => ['required', 'string', 'min:7', 'max:11'],
                'contact_person_address' => ['required', 'string', 'max:255'],
                'dependant' => ['required', 'string'],
            ]);
        }

         /*
         * Employee Status
         *  1 - Regular
         *  2 - Casual
         */

         /*
         * Sex
         *  1 - Male
         *  2 - Female
         */

         /*
         * Department
         *  1 - Sales Department
         *  2 - Accounting Department
         *  3 - Finance Department
         *  4 - Logistics Department
         */

         /*
         * Employment Status
         *  1 - Active
         *  2 - Resigned
         */

         /*
         * Marital Status
         *  1 - Single
         *  2 - Married
         *  3 - Widowed
         *  4 - Separated
         */
        try {
            $filename = '';
            if($request->hasFile('emp_photo'))
            {
                // if may laman check natin if image format ba
                $extension = strtolower($request->file('emp_photo')->getClientOriginalExtension()); // get file extension
                // check the allowed files extension
                if ($extension != 'jpeg' && $extension != 'png' && $extension != 'jpg' && $extension != 'gif')
                {
                    return redirect()->route('create-employee')->withInput($request->all())->with('error_message', 'Image format invalid.');
                }
                else
                {
                    $filename = rand(12, 34353).time().'_employeephoto.'.$extension;
                    $request->file('emp_photo')->storeAs('public/employee', $filename);
                }
            }

            $user = Employees::find($id); //<- so pag meron ito ang gagawin natin access natina ang field sa employees table tapos assign natin ng value
            $user->employee_code = $request->employee_number;
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->age = $request->age;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $user->sex = $request->sex == 1 ? 'Male' : 'Female';
            $user->mobile_no = $request->mobile_no;
            $user->nationality = $request->nationality;
            $user->employee_status = $request->employee_status == 1 ? 'Regular' : 'Casual';
            $user->employee_photo = $filename ? $filename : ($request->sex == 1 ? 'male.png' : 'female.png');


            $get_employee_details = EmployeeDetails::where('employee_id', $id)->first();
            $user_details = EmployeeDetails::find($get_employee_details->employee_details_id); // dito hanapin ang ID for employee details na nakaforeign key and employee_id sa empployee table
            $user_details->block_house_no = $request->block_house_no;
            $user_details->block_house_no = $request->block_house_no;
            $user_details->street = $request->street;
            $user_details->barangay = $request->barangay;
            $user_details->city = $request->city;
            $user_details->province = $request->province;
            $user_details->marital_status = $request->marital_status == 1 ? 'Single' : ($request->marital_status == 2 ? 'Married' : ($request->marital_status == 3 ? 'Widowed' : 'Separated'));
            $user_details->no_of_children = $request->number_of_children;
            $user_details->spouse_name = $request->spouse_name;
            $user_details->spouse_occupation = $request->spouse_occupation;
            $user_details->dependant = $request->dependant;
            $user_details->emergency_contact_name = $request->contact_person;
            $user_details->emergency_contact_no = $request->emergency_number;
            $user_details->emergency_contact_address = $request->contact_person_address;
            $user_details->basic_rate = $request->basic_rate;
            $user_details->allowance = $request->allowance;
            $user_details->leave_with_pay = $request->leave_pay;
            $user_details->with_ot_pay = $request->ot_pay_value == 'true' ? 1 : 0;
            $user_details->department = $request->department == 1 ? 'Sales Department' : ($request->department == 2 ? 'Accounting Department' : ($request->department == 3 ? 'Finance Department' : 'Logistics Department'));
            $user_details->position = $request->position;
            $user_details->employee_history_position = $request->pwposition;
            $user_details->sss_no = $request->sss_number;
            $user_details->philhealth_no = $request->philhealth_no;
            $user_details->tin_no = $request->tin_no;
            $user_details->hdmf_no = $request->pagibig_no;
            $user_details->date_hired = date('Y-m-d', strtotime($request->date_hired));
            $user_details->date_resigned = $request->date_resigned ? date('Y-m-d', strtotime($request->date_resigned)) : null;
            $user_details->employment_status = $request->employment_status == 1 ? 'Active' : 'Resigned';
            $user_details->sss_contribution = $request->sss_contribution;
            $user_details->philhealth_contribution = $request->philhealth_contribution;
            $user_details->ef_contribution = $request->ef_contribution;
            $user_details->hdmf_contribution = $request->pagibig_contribution;

            // last part na natin isave ang changes kasi meron pa sa employee details incase magkaerror atleast wala pa changes
            $user->save();
            $user_details->save();
        } catch (QueryException $exception) {
            // ->with()
            //  dalawang parameters meron. first the variable, second message string
            // ang variable sa first parameter, will be accesible sa blade so pwede natin ma retrieve ang error message

            // then pag error di natin iredirect sa employees route same page lang dapat
            return redirect()->route('edit-employee', $id)->with('error_message', 'Employee Code already taken!. Please enter a new one.');
        }
        //Find employee id to be edited


        return redirect()->route('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get employee details
        $get_employee_details = EmployeeDetails::where('employee_id', $id)->first();
        // get employee details id
        $employee_details = EmployeeDetails::find($get_employee_details->employee_details_id);
        //delete record
        $employee_details->delete();

        $employee = Employees::find($id);
        $employee->delete();

        return redirect()->route('employee');
    }
}
