<?php

namespace App\Http\Controllers;

use App\Models\TemporaryStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class StudentRegistrationController extends Controller
{
    public function create()
    {
        return view('students.student-register');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validate = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',

            'contact_number' => ['required', 'string', 'min:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'firstname.required' => 'Please input your First Name',
            'lastname.required' => 'Please input your Last Name',

            'contact_number.required' => 'Please input your Contact Number',
            'email.required' => 'Please input your Valid Email Address',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        // Create a new user account
        $user = User::create([
            'name' => $request->firstname,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            // Handle the case when user creation fails
            return back()->withInput()->withErrors('Failed to create user account.');
        }

        // Create a temporary student record
        $temporaryStudent = new TemporaryStudent();
        $temporaryStudent->learners_reference_number = $request->input('learners_reference_number', '');
        $temporaryStudent->firstname = $request->input('firstname');
        $temporaryStudent->middlename = $request->input('middlename') ? $request->middlename: '';
        $temporaryStudent->lastname = $request->input('lastname');
        $temporaryStudent->extname = $request->input('extname') ? $request->extname: '';
        $temporaryStudent->birthdate = $request->input('birthdate') ? $request->birthdate: null;
        $temporaryStudent->street = $request->input('street', '');
        $temporaryStudent->barangay = $request->input('barangay', '');
        $temporaryStudent->municipal = $request->input('municipal', '');
        $temporaryStudent->province = $request->input('province', '');
        $temporaryStudent->zip_code = $request->input('zip_code', '');
        $temporaryStudent->mother_name = $request->input('mother_name', '');
        $temporaryStudent->father_name = $request->input('father_name', '');
        $temporaryStudent->guardian_name = $request->input('guardian_name', '');
        $temporaryStudent->emergency_contact_number = $request->input('emergency_contact_number', '');
        $temporaryStudent->last_elementary_school = $request->input('last_elementary_school', '');
        $temporaryStudent->last_grade_level_completed = $request->input('last_grade_level_completed', '');
        $temporaryStudent->last_school_year_completed = $request->input('last_school_year_completed', '');
        $temporaryStudent->last_school_name = $request->input('last_school_name', '');
        $temporaryStudent->last_school_address = $request->input('last_school_address', '');
        $temporaryStudent->last_school_id = $request->input('last_school_id', '');
        // Add other fields from the form
        $temporaryStudent->user_id = $user->id;
        $temporaryStudent->created_by = $user->id;
        $temporaryStudent->updated_by = $user->id;
        $temporaryStudent->save();

        if (!$temporaryStudent->save()) {
            // Handle the case when temporary student saving fails
            // You can log the error or display an appropriate error message
            return back()->withInput()->withErrors('Failed to save temporary student record.');
        }

        $role = Role::where('name', 'Student')->first();
        $user->assignRole([$role->id]);
        // Redirect or perform additional actions
        return redirect()->route('login')->with('success', 'You were temporarily registered, please Login.');
    }

}
