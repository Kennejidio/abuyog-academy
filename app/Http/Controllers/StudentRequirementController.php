<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentRequirementController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        if ($searchQuery) {
            return $this->search($request);
        }

        $students = Student::latest()->paginate(5);

        return view('student-requirements.index', compact('students' , 'request'))
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

        return view('student-requirements.index', compact('students'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('searchQuery', $searchQuery);
    }

    public function create(Student $student)
    {
        $latestSchoolYear = SchoolYear::latest('id')->first();
        $requirements = Requirement::all();

        return view('student-requirements.create', compact('student'))
            ->with(compact('latestSchoolYear'))
            ->with(compact('requirements'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'requirement' => 'required',
            'requirement_status' => 'required',
        ], [
            'requirement.required' => 'Please input Requirement',
            'requirement_status.required' => 'Please input Status',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $studentRequirement = new StudentRequirement();
        $studentRequirement->student_id = $request->student;
        $studentRequirement->school_year_id = $request->schoolyear;
        $studentRequirement->requirement_id = $request->requirement;
        $studentRequirement->requirement_status = $request->requirement_status;
        $studentRequirement->created_by = Auth::user()->id;
        $studentRequirement->updated_by = Auth::user()->id;
        $studentRequirement->save();

        return redirect()->route('student-requirements.show', ['student' => $studentRequirement->student_id])
            ->with('success', 'Student Requirement created successfully.');
    }

    public function show(Student $student)
    {
        $studentRequirements = StudentRequirement::where('student_id', $student->id)
            ->paginate(5);

        return view('student-requirements.show', compact('student', 'studentRequirements'));
    }

    public function edit(StudentRequirement $studentRequirement)
    {
        $requirements = Requirement::all();
        return view('student-requirements.edit', compact('studentRequirement'))->with(compact('requirements'));
    }

    public function update(Request $request, StudentRequirement $studentRequirement)
    {
        $request->validate([
            'requirement_status' => 'required',
        ]);

        $studentRequirement->requirement_status = $request->requirement_status;
        $studentRequirement->save();

        return redirect()->route('student-requirements.show', ['student' => $studentRequirement->student_id])
            ->with('success', 'Requirement updated successfully.');
    }

    public function destroy(StudentRequirement $studentRequirement)
    {
        $studentRequirement->delete();

        return redirect()->route('student-requirements.show', ['student' => $studentRequirement->student_id])
            ->with('success', 'Requirement deleted successfully.');
    }
}
