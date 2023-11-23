<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        if ($searchQuery) {
            return $this->search($request);
        }

        $students = Student::latest()->paginate(5);

        return view('enrollments.index', compact('students' , 'request'))
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

        return view('enrollments.index', compact('students'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('searchQuery', $searchQuery);
    }

    public function create(Student $student)
    {
        $latestSchoolYear = SchoolYear::latest('id')->first();
        $sections = Section::all();

        return view('enrollments.create', compact('student'))
            ->with(compact('latestSchoolYear'))
            ->with(compact('sections'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'section' => 'required',
            'enrollment_status' => 'required',
        ], [
            'section.required' => 'Please input Grade and Section',
            'enrollment_status.required' => 'Please input Enrollment Status',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $enrollment = new Enrollment();
        $enrollment->school_year_id = $request->schoolyear;
        $enrollment->student_id = $request->student;
        $enrollment->section_id = $request->section;
        $enrollment->enrollment_status = $request->enrollment_status;
        $enrollment->created_by = Auth::user()->id;
        $enrollment->updated_by = Auth::user()->id;
        $enrollment->save();

        $student = Student::find($request->student);
        $student->enrollment_status = $enrollment->enrollment_status;
        $student->save();

        return redirect()->route('enrollments.show', ['student' => $enrollment->student_id])
            ->with('success', 'Student Enrolled successfully.');
    }

    public function show(Student $student)
    {
        $enrollments = Enrollment::where('student_id', $student->id)
        ->paginate(4);

        // dd($enrollments);

        return view('enrollments.show', compact('student', 'enrollments'));
    }

    public function edit(Enrollment $enrollment)
    {
        $sections = Section::all();
        return view('enrollments.edit', compact('enrollment'))->with(compact('sections'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'enrollment_status' => 'required',
        ]);

        $enrollment->section_id = $request->section;
        $enrollment->enrollment_status = $request->enrollment_status;
        $enrollment->save();

        $student = Student::find($request->student);
        $student->enrollment_status = $enrollment->enrollment_status;
        $student->save();

        return redirect()->route('enrollments.show', ['student' => $enrollment->student_id])
            ->with('success', 'Enrollment Data updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.show', ['student' => $enrollment->student_id])
            ->with('success', 'Enroll Data deleted successfully.');
    }
}
