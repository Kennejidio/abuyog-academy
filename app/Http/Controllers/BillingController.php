<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        if ($searchQuery) {
            return $this->search($request);
        }

        $students = Student::latest()->paginate(5);

        return view('billings.index', compact('students' , 'request'))
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

        return view('billings.index', compact('students'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('searchQuery', $searchQuery);
    }

    public function create(Student $student)
    {
        $latestSchoolYear = SchoolYear::latest('id')->first();

        return view('billings.create', compact('student'))
            ->with(compact('latestSchoolYear'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required',
            'description' => 'required',
        ], [
            'code.required' => 'Please input Bill Name',
            'description.required' => 'Please input Description',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $billing = new Billing();
        $billing->student_id = $request->student;
        $billing->school_year_id = $request->schoolyear;
        $billing->code = $request->code;
        $billing->description = $request->description;
        $billing->amount = $request->amount;
        $billing->amount_paid = $request->amount_paid;
        $billing->billing_status = $request->billing_status;
        $billing->payment_date = $request->payment_date;
        $billing->created_by = Auth::user()->id;
        $billing->updated_by = Auth::user()->id;
        $billing->save();

        return redirect()->route('billings.show', ['student' => $billing->student_id])
            ->with('success', 'Student Bill created successfully.');
    }

    public function show(Student $student)
    {
        $billings = Billing::where('student_id', $student->id)
            ->paginate(5);

        return view('billings.show', compact('student', 'billings'));
    }

    public function edit(Billing $billing)
    {
        return view('billings.edit', compact('billing'));
    }

    public function update(Request $request, Billing $billing)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required',
            'description' => 'required',
        ], [
            'code.required' => 'Please input Bill Name',
            'description.required' => 'Please input Description',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $billing->code = $request->code;
        $billing->description = $request->description;
        $billing->amount = $request->amount;
        $billing->amount_paid = $request->amount_paid;
        $billing->billing_status = $request->billing_status;
        $billing->payment_date = $request->payment_date;
        $billing->created_by = Auth::user()->id;
        $billing->updated_by = Auth::user()->id;
        $billing->save();

        return redirect()->route('billings.show', ['student' => $billing->student_id])
            ->with('success', 'Bill updated successfully.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();

        return redirect()->route('billings.show', ['student' => $billing->student_id])
            ->with('success', 'Bill deleted successfully.');
    }
}
