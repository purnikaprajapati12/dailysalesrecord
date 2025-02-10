<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;
// use App\Models\Admin;

class UserController extends Controller
{
    public function create_employee()
    {
        $url = url('/create-employee');
        $title = "Create employee";
        $label = "Create";
        $employees = new User();
        $data = compact('url', 'title', 'label', 'employees');
        return view('admin.create-employee')->with($data);
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function manage_employee()
    {
        $employees = User::where('usertype', 1)->get();
        return view('admin.manage-employee', compact('employees'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request)
    {

        $incommingFields = $request->validate([
            'signin-email' => 'required',
            'signin-password' => 'required'
        ], []);

        if (auth()->attempt(['email' => $incommingFields['signin-email'], 'password' => $incommingFields['signin-password']])) {
            $request->session()->regenerate();

            $usertype = User::where(['email' => $incommingFields['signin-email']])->value('usertype');

            if ($usertype == 0) {
                return redirect('admin-index');
            } else {
                return redirect('employee-index');
            }
        } else {

            return redirect()->back()->with('message', 'invalid Email and Password');
        }
    }
    public function store(Request $request)
    {
        $incommingFields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
            'contact' => ['required', Rule::unique('users', 'contact')],
            'address' => ['required'],
            'usertype' => ['required']
        ]);
        $incommingFields['password'] = bcrypt($incommingFields['password']);
        User::create($incommingFields);
        return redirect('manage-employee');
    }

    public function edit($id)
    {
        $employees = User::find($id);
        // echo '<pre>';
        // print_r($employees);
        if (is_null($employees)) {
            //not found
            return redirect('manage-employee');
        } else {
            //found
            $title = "Update employee";
            $label = "Update";
            $url = url('/update-employee') . "/" . $id;
            $data = compact('employees', 'url', 'title', 'label');
            return view('admin.create-employee')->with($data);
        }
    }

    public function update(Request $request, $id)
    {

        // Validate the request data
        // $request->validate([
        //     'name' => 'required',
        //     'email' => ['required', 'email', Rule::unique('users', 'email')],
        //     'password' => ['required', 'min:8', 'confirmed'],
        //     'contact' => ['required', Rule::unique('users', 'contact')],
        //     'address' => ['required'],
        //     'usertype' => ['required']
        //     // Add validation rules for other fields if needed
        // ]);

        // Find the product to be updated
        // dd($request->input());
        $employee = User::find($id);

        // Update the product with the new data
        // dd('here');
        $employee->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address'),
            'usertype' => $request->input('usertype'),


            // Update other fields as needed
        ]);

        return redirect('manage-employee')->with('success', 'employee updated successfully!');
    }

    public function delete($id)
    {
        $res = User::find($id);
        if (!is_null($res)) {
            $res->delete();
        }
        return redirect()->back();
    }
}
