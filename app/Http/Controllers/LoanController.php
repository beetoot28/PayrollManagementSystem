<?php

namespace App\Http\Controllers;
use App\Models\Loans;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->query('search'))
        {
            $loans = Loans::where('type_of_loan', request()->query('search'))
                            // ->orWhere('Employee.first_name', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('loan_application_no', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('loan_date', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('loan_terms', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('deduction_from', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('deduction_to', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('loan_amount', 'like', '%'.request()->query('search').'%')
                            // ->orWhere('monthly_due', 'like', '%'.request()->query('search').'%');
                            ->paginate(10);
        }
        else
        {
            $loans  = Loans::orderBy('loan_date', 'DESC')->paginate(10);
        }


        return view('modules.loans.loans',
        [
            'loans' => $loans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        $loans = Loans::all();
        return view('modules.loans.new-loans', ['employees' => $employees, 'loans' => $loans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'employee_id' => ['required', 'string', 'max:255'],
            'employee_name' => ['required', 'string', 'max:255'],
            'loan_type' => ['required', 'string', 'max:255'],
            'loan_app_no' => ['required', 'string', 'max:255'],
            'loan_terms' => ['required', 'string', 'max:255'],
            'loan_date' => ['required', 'string', 'max:255'],
            'deduction_from' => ['required', 'string', 'max:255'],
            'deduction_to' => ['required', 'string', 'max:255'],
            'loan_amount' => ['required', 'string', 'max:255'],
            'monthly_due' => ['required', 'string', 'max:255'],
        ]);

        // try {
            $loan = Loans::create([
                'employee_id' => $request->employee_id,
                'type_of_loan' => $request->loan_type == 1 ? 'SSS Loan' : ($request->loan_type == 2 ? 'EF Loan' : 'Pag-ibig Loan'),
                'loan_application_no' => $request->loan_app_no,
                'loan_date' => date('Y-m-d', strtotime($request->loan_date)),
                'loan_terms' => $request->loan_terms,
                'deduction_from' => date('Y-m-d', strtotime($request->deduction_from)),
                'deduction_to' => date('Y-m-d', strtotime($request->deduction_to)),
                'loan_amount' => $request->loan_amount,
                'monthly_due' => $request->monthly_due,
            ]);

        // } catch (QueryException $exception) {
        //     return redirect()->route('create-loans')->withInput($request->all())->with('error_message', 'Loan Application No. already exist!. Please enter a new one.');
        // }

        return redirect()->route('loan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get employee ID based on loan ID
        $get_loan_details = Loans::where('loan_id', $id)->first();
        $employee_id = $get_loan_details->employee_id;

        // get employee details
        $employee_details = Employees::where('employee_id', $employee_id)->with('EmployeeDetails')->first();
        return view('modules.loans.view-loan',[
            'employee_details' => $employee_details,
            'get_loan_details' => $get_loan_details
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
        //get employee ID based on loan ID
        $get_loan_details = Loans::where('loan_id', $id)->first();
        $employee_id = $get_loan_details->employee_id;

        // get employee details
        $employee_details = Employees::where('employee_id', $employee_id)->with('EmployeeDetails')->first();

        $employees =  Employees::with('EmployeeDetails')->orderBy('last_name', 'ASC')->get();
        $loans = Loans::all();
        return view('modules.loans.update-loan', [
            'employees' => $employees,
            'employee_details' => $employee_details,
            'get_loan_details' => $get_loan_details,
            'loans' => $loans,
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
        $request->validate([
            'employee_name' => ['required', 'string', 'max:255'],
            'loan_type' => ['required', 'string', 'max:255'],
            'loan_app_no' => ['required', 'string', 'max:255'],
            'loan_terms' => ['required', 'string', 'max:255'],
            'loan_date' => ['required', 'string', 'max:255'],
            'deduction_from' => ['required', 'string', 'max:255'],
            'deduction_to' => ['required', 'string', 'max:255'],
            'loan_amount' => ['required', 'string', 'max:255'],
            'monthly_due' => ['required', 'string', 'max:255'],
        ]);

        // try{
            $loans = Loans::find($id);
            $loans->employee_id = $request->employee_id;
            $loans->type_of_loan = $request->loan_type == 1 ? 'SSS Loan' : ($request->loan_type == 2 ? 'EF Loan' : 'Pag-ibig Loan');
            $loans->loan_application_no = $request->loan_app_no;
            $loans->loan_date = date('Y-m-d', strtotime($request->loan_date));
            $loans->loan_terms = $request->loan_terms;
            $loans->deduction_from = date('Y-m-d', strtotime($request->deduction_from));
            $loans->deduction_to = date('Y-m-d', strtotime($request->deduction_to));
            $loans->loan_amount = $request->loan_amount;
            $loans->monthly_due = $request->monthly_due;
            $loans->save();
        // } catch (QueryException $exception) {
        //     return redirect()->route('edit-loans', $id)->withInput($request->all())->with('error_message', 'Loan Application No. already exist!. Please enter a new one.');
        // }
        return redirect()->route('loan');
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
}
