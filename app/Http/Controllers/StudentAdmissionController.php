<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TemporaryStudent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentAdmissionController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        if ($searchQuery) {
            return $this->search($request);
        }

        $temporaryStudents = TemporaryStudent::latest()->paginate(5);

        return view('student-admit.index', compact('temporaryStudents', 'request'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('q');

        $temporaryStudents = TemporaryStudent::where(function ($query) use ($searchQuery) {
            $query->where('firstname', 'like', "%$searchQuery%")
                ->orWhere('lastname', 'like', "%$searchQuery%")
                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE '%$searchQuery%'");
        })
        ->latest()
        ->paginate(5);

        return view('student-admit.index', compact('temporaryStudents', 'request'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('searchQuery', $searchQuery);
    }


    public function show($id): View
    {
        $temporaryStudent = TemporaryStudent::find($id);
        return view('student-admit.show', compact('temporaryStudent'));
    }

    public function edit($id): View
    {
        $temporaryStudent = TemporaryStudent::find($id);
        return view('student-admit.edit', compact('temporaryStudent'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'sex' => 'required',
            'learners_reference_number' => 'required',
            'barangay' => 'required',
            'municipal' => 'required',
            'province' => 'required',
            'mother_name' => 'required',
            'emergency_contact_number' => 'required',
            'last_elementary_school' => 'required',
        ]);

        $temporaryStudent = TemporaryStudent::find($id);
        $temporaryStudent->firstname = $request->input('firstname');
        $temporaryStudent->middlename = $request->input('middlename') ? $request->middlename : "";
        $temporaryStudent->lastname = $request->input('lastname');
        $temporaryStudent->extname = $request->input('extname') ? $request->extname : "";
        $temporaryStudent->birthdate = $request->input('birthdate');
        $temporaryStudent->sex = $request->input('sex');
        $temporaryStudent->learners_reference_number = $request->input('learners_reference_number');
        $temporaryStudent->street = $request->input('street') ? $request->street : "";
        $temporaryStudent->barangay = $request->input('barangay');
        $temporaryStudent->municipal = $request->input('municipal');
        $temporaryStudent->province = $request->input('province');
        $temporaryStudent->zip_code = $request->input('zip_code') ? $request->zip_code : "";
        $temporaryStudent->mother_name = $request->input('mother_name');
        $temporaryStudent->father_name = $request->input('father_name') ? $request->father_name : "";
        $temporaryStudent->guardian_name = $request->input('guardian_name') ? $request->guardian_name : "";
        $temporaryStudent->emergency_contact_number = $request->input('emergency_contact_number');
        $temporaryStudent->last_elementary_school = $request->input('last_elementary_school');
        $temporaryStudent->last_grade_level_completed = $request->input('last_grade_level_completed') ? $request->last_grade_level_completed : "";
        $temporaryStudent->last_school_year_completed = $request->input('last_school_year_completed') ? $request->last_school_year_completed : "";
        $temporaryStudent->last_school_name = $request->input('last_school_name') ? $request->last_school_name : "";
        $temporaryStudent->last_school_address = $request->input('last_school_address') ? $request->last_school_address : "";
        $temporaryStudent->last_school_id = $request->input('last_school_id') ? $request->last_school_id : "";
        $temporaryStudent->save();

        return redirect()->route('student-admit.index')->with('success', 'Temporary student updated successfully.');
    }

    public function admit(TemporaryStudent $temporaryStudent)
    {
        // Perform admin approval steps
        $temporaryStudent->update([
            'is_approved' => true,
        ]);
        // Generate a unique student ID
        $studentId = Str::random(10);

        // Create a new student record
        $student = new Student();
        $student->student_id = $studentId;
        $student->learners_reference_number = $temporaryStudent->learners_reference_number;
        $student->enrollment_status = 'admitted';
        $student->is_approved = '1';
        $student->firstname = $temporaryStudent->firstname;
        $student->middlename = $temporaryStudent->middlename;
        $student->lastname = $temporaryStudent->lastname;
        $student->extname = $temporaryStudent->extname;
        $student->birthdate = $temporaryStudent->birthdate;
        $student->sex = $temporaryStudent->sex;
        $student->street = $temporaryStudent->street;
        $student->barangay = $temporaryStudent->barangay;
        $student->municipal = $temporaryStudent->municipal;
        $student->province = $temporaryStudent->province;
        $student->zip_code = $temporaryStudent->zip_code;
        $student->mother_name = $temporaryStudent->mother_name;
        $student->father_name = $temporaryStudent->father_name;
        $student->guardian_name = $temporaryStudent->guardian_name;
        $student->emergency_contact_number = $temporaryStudent->emergency_contact_number;
        $student->last_elementary_school = $temporaryStudent->last_elementary_school;
        $student->last_grade_level_completed = $temporaryStudent->last_grade_level_completed;
        $student->last_school_year_completed = $temporaryStudent->last_school_year_completed;
        $student->last_school_name = $temporaryStudent->last_school_name;
        $student->last_school_address = $temporaryStudent->last_school_address;
        $student->last_school_id = $temporaryStudent->last_school_id;
        // Add other fields from the temporary student record
        $student->user_id = $temporaryStudent->user_id;
        $student->created_by = $temporaryStudent->created_by;
        $student->updated_by = $temporaryStudent->updated_by;
        $student->save();

        // Delete the temporary student record
        $temporaryStudent->delete();

        // Redirect or show success message
        return redirect()->route('student-admit.index')->with('success', 'Temporary student admitted successfully.');
    }
}
