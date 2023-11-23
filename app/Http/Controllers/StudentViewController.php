<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\StudentRequirement;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentViewController extends Controller
{
    public function dashboard(Request $request, $id)
    {
        if ($id != Auth::user()->id) {abort(401);}
        if (!Auth::user()->hasRole('Student')) {abort(404, 'Invalid Role');}

        $student = Auth::user()->student;
        $temporaryStudent = TemporaryStudent::where('user_id', $id)->first();
        $enrollments = collect([]);

        if (!$student && !$temporaryStudent) {
            // Set both $student and $temporaryStudent to null
            $student = null;
            $temporaryStudent = null;
        } elseif (!$student) {
            // If the student is not found, set $student to null
            $student = null;
        }

        // If the student exists, fetch the enrollments
        if ($student) {
            $enrollments = Enrollment::where('student_id', $student->id)
                ->with('schoolyear', 'section')
                ->get();
        }

        return view('students.dashboard', compact('student', 'enrollments', 'temporaryStudent'));
    }

    public function settings()
    {
        return view('students.settings');
    }

    public function updatePassword(Request $request)
    {
        $student = Auth::user()->student;

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password matches the one in the database
        if (!Hash::check($request->current_password, $student->user->password)) {
            return redirect()->back()->with('error', 'Invalid current password.');
        }

        // Update the password
        $student->user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function edit($id)
    {

        $temporaryStudent = TemporaryStudent::where('user_id', $id)->first();
        $student = Student::where('user_id', $id)->first();

        if (!$temporaryStudent) {
            return redirect()->route('students.form', ['id' => $id])->with('error', 'Temporary Student profile not found');
        }

        return view('students.edit', compact('temporaryStudent', 'student'));
    }

    public function update(Request $request, $id)
    {
        $temporaryStudent = TemporaryStudent::where('user_id', $id)->first();

        if (!$temporaryStudent) {
            return redirect()->back()->with('error', 'Profile not found');
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'sex' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'undefined') {
                        $fail($attribute . ' is invalid.');
                    }
                },
            ],
            'learners_reference_number' => 'required',
            'last_elementary_school' => 'required',
            'barangay' => 'required',
            'municipal' => 'required',
            'province' => 'required',
            'mother_name' => 'required',
            'emergency_contact_number' => 'required',
        ], [
            'firstname.required' => 'Your Given Name is required.',
            'lastname.required' => 'Your Surname is required.',
            'birthdate.required' => 'Your Birth Date is required.',
            'sex.required' => 'Your Gender is required.',
            'learners_reference_number.required' => 'Your Learners Reference Number is required.',
            'last_elementary_school.required' => 'Your Former Elementary School Name is required.',
            'barangay.required' => 'Your Barangay is required.',
            'municipal.required' => 'Your Municipal is required.',
            'province.required' => 'Your Province is required.',
            'mother_name.required' => 'Your Mother Name is required.',
            'emergency_contact_number.required' => 'Your Parent or guardian Contact Number is required.',
            // Add custom error messages for other fields
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the data
        $temporaryStudent->update([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename') ? $request->middlename : '',
            'lastname' => $request->input('lastname'),
            'extname' => $request->input('extname') ? $request->extname : '',
            'birthdate' => $request->input('birthdate'),
            'sex' => $request->input('sex'),
            'learners_reference_number' => $request->input('learners_reference_number'),
            'last_elementary_school' => $request->input('last_elementary_school'),
            'street' => $request->input('street') ? $request->street : '',
            'barangay' => $request->input('barangay'),
            'municipal' => $request->input('municipal'),
            'province' => $request->input('province'),
            'zip_code' => $request->input('zip_code') ? $request->zip_code : '',
            'mother_name' => $request->input('mother_name'),
            'father_name' => $request->input('father_name') ? $request->father_name : '',
            'guardian_name' => $request->input('guardian_name') ? $request->guardian_name : '',
            'emergency_contact_number' => $request->input('emergency_contact_number'),
            'last_grade_level_completed' => $request->input('last_grade_level_completed') ? $request->last_grade_level_completed : '',
            'last_school_year_completed' => $request->input('last_school_year_completed') ? $request->last_school_year_completed : '',
            'last_school_name' => $request->input('last_school_name') ? $request->last_school_name : '',
            'last_school_address' => $request->input('last_school_address') ? $request->last_school_address : '',
            'last_school_id' => $request->input('last_school_id') ? $request->last_school_id : '',
        ]);

        Session::flash('success', 'Profile updated successfully');

        return redirect()->route('students.form', ['id' => $id]);
    }

    public function showForm($id)
    {
        if ($id != Auth::user()->id) {abort(401);}
        if (!Auth::user()->hasRole('Student')) {abort(404, 'Invalid Role');}
        $temporaryStudent = TemporaryStudent::where('user_id', auth()->user()->id)->first();
        $student = Student::where('user_id', auth()->user()->id)->first();

        return view('students.form', compact('temporaryStudent', 'student'));
    }

    public function credentials()
    {
        $user = Auth::user();

        // Check if the authenticated user has a student record
        $student = $user->student;

        if (!$student) {
            // Set $student to null to indicate that no student record was found
            $student = null;
        }

        $requirements = StudentRequirement::where('student_id', optional($student)->id)
            ->with('requirement.schoolyear') // Load the requirement and schoolyear relationships
            ->get();

        return view('students.credentials', compact('student', 'requirements'));
    }



    public function bills()
    {
        $user = Auth::user();

        // Check if the authenticated user has a student record
        $student = $user->student;

        if (!$student) {
            // Set $student to null to indicate that no student record was found
            $student = null;
        }

        $bills = Billing::where('student_id', optional($student)->id)
            ->with('schoolyear') // Load the schoolyear relationship
            ->get();

        return view('students.bills', compact('student', 'bills'));
    }

}
