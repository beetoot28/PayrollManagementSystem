<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->query('search')) { // condition if the search input has a value
            $users = User::where('user_type', '!=', '-1')
                    ->where('first_name', 'like', '%'.request()->query('search').'%')
                    ->orWhere('middle_name', 'like', '%'.request()->query('search').'%')
                    ->orWhere('last_name', 'like', '%'. request()->query('search').'%')
                    ->orWhere('email', request()->query('search'))
                    ->orWhere('user_type', strtolower(request()->query('search')) == strtolower('Admin') ? 0 : ( strtolower(request()->query('search')) == strtolower('Payroll') ? 1 : 'HR' ))
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        }
        else {
            $users = User::where('user_type', '!=', '-1')->orderBy('created_at', 'DESC')->paginate(10);
        }
        return view('modules.users.users',
            ['users' => $users]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.users.new-user');
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required', 'string', 'max:2'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // try {
            $user = User::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
            ]);
        // } catch (QueryException $exception) {
        //     return redirect()->route('create-users')->withInput($request->all())->with('error_message', 'Employee Code already exist!. Please enter a new one.');
        // }

        return redirect()->route('users')->withInput($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('modules.users.view-user', ['user_details' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('modules.users.update-user', ['user_details' => $user, 'error_message' => '']);
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
        if($request->password)
        {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', Rule::unique('users')->ignore($id)],
                'user_type' => ['required', 'string', 'max:2'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->password = Hash::make($request->password);
            $user->save();
        }
        else
        {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', Rule::unique('users')->ignore($id)],
                'user_type' => ['required', 'string', 'max:2'],
            ]);

            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->save();
        }

        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);
        $user->delete();
        return 'success';
    }
}
