<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class StudentListController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        if ($searchQuery) {
            return $this->search($request);
        }

        $students = Student::latest()->paginate(5);

        return view('student-list.index', compact('students', 'request'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('q');

        $students = Student::where(function ($query) use ($searchQuery) {
            $query->where('firstname', 'like', "%$searchQuery%")
                ->orWhere('lastname', 'like', "%$searchQuery%")
                ->orWhere('student_id', 'like', "%$searchQuery%")
                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE '%$searchQuery%'");
        })
            ->latest()
            ->paginate(5);

        return view('student-list.index', compact('students'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('searchQuery', $searchQuery);
    }

    public function show($id): View
    {
        $student = Student::find($id);
        return view('student-list.show', compact('student'));
    }

    public function edit($id): View
    {
        $student = Student::find($id);
        return view('student-list.edit', compact('student'));
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

        $student = Student::find($id);
        $student->firstname = $request->input('firstname');
        $student->middlename = $request->input('middlename') ? $request->middlename : "";
        $student->lastname = $request->input('lastname');
        $student->extname = $request->input('extname') ? $request->extname : "";
        $student->birthdate = $request->input('birthdate');
        $student->sex = $request->input('sex');
        $student->learners_reference_number = $request->input('learners_reference_number');
        $student->street = $request->input('street') ? $request->street : "";
        $student->barangay = $request->input('barangay');
        $student->municipal = $request->input('municipal');
        $student->province = $request->input('province');
        $student->zip_code = $request->input('zip_code') ? $request->zip_code : "";
        $student->mother_name = $request->input('mother_name');
        $student->father_name = $request->input('father_name') ? $request->father_name : "";
        $student->guardian_name = $request->input('guardian_name') ? $request->guardian_name : "";
        $student->emergency_contact_number = $request->input('emergency_contact_number');
        $student->last_elementary_school = $request->input('last_elementary_school');
        $student->last_grade_level_completed = $request->input('last_grade_level_completed') ? $request->last_grade_level_completed : "";
        $student->last_school_year_completed = $request->input('last_school_year_completed') ? $request->last_school_year_completed : "";
        $student->last_school_name = $request->input('last_school_name') ? $request->last_school_name : "";
        $student->last_school_address = $request->input('last_school_address') ? $request->last_school_address : "";
        $student->last_school_id = $request->input('last_school_id') ? $request->last_school_id : "";
        $student->save();

        return redirect()->route('student-list.index')->with('success', 'Student Profile updated successfully.');
    }

}
