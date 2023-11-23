<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SchoolYearController extends Controller
{
    public function index()
    {
        $schoolyears = SchoolYear::latest()->paginate(5);
        return view('schoolyear.index', compact('schoolyears'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('schoolyear.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'start_year' => 'required|unique:school_years',
            'end_year' => 'required',
        ]);

        $schoolyear = new SchoolYear();
        $schoolyear->start_year = $request->start_year;
        $schoolyear->end_year = $request->end_year;
        $schoolyear->created_by = Auth::user()->id;
        $schoolyear->updated_by = Auth::user()->id;
        $schoolyear->save();

        return redirect()->route('schoolyear.index')
            ->with('success', 'School Year created successfully.');
    }

    public function edit($id)
    {
        $schoolyear = SchoolYear::find($id);

        return view('schoolyear.edit', compact('schoolyear'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'start_year' => 'required|unique:school_years,start_year,' . $id,
            'end_year' => 'required',
        ]);

        $schoolyear = SchoolYear::find($id);
        $schoolyear->start_year = $request->start_year;
        $schoolyear->end_year = $request->end_year;
        $schoolyear->created_by = Auth::user()->id;
        $schoolyear->updated_by = Auth::user()->id;
        $schoolyear->save();

        return redirect()->route('schoolyear.index')
            ->with('success', 'School Year Updated successfully.');
    }

    public function destroy($id)
    {
        DB::table("school_years")->where('id', $id)->delete();
        return redirect()->route('schoolyear.index')
            ->with('success', 'School Year deleted successfully');
    }
}
