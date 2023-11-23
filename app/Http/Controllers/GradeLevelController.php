<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GradeLevelController extends Controller
{
    public function index()
    {
        $gradelevels = GradeLevel::latest()->paginate(5);
        return view('grade-level.index', compact('gradelevels'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('grade-level.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|unique:grade_levels',
        ], [
            'code.required' => 'Please input Grade Level',
            'code.unique' => 'Grade Level is already been taken',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $gradelevel = new GradeLevel();
        $gradelevel->code = $request->code;
        $gradelevel->created_by = Auth::user()->id;
        $gradelevel->updated_by = Auth::user()->id;
        $gradelevel->save();

        return redirect()->route('grade-level.index')
            ->with('success', 'Grade Level created successfully.');
    }

    public function edit($id)
    {
        $gradelevel = GradeLevel::find($id);

        return view('grade-level.edit', compact('gradelevel'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|unique:grade_levels,code,' . $id,
        ], [
            'code.required' => 'Please input Grade Level',
            'code.unique' => 'Grade Level is already been taken',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $gradelevel = GradeLevel::find($id);
        $gradelevel->code = $request->code;
        $gradelevel->created_by = Auth::user()->id;
        $gradelevel->updated_by = Auth::user()->id;
        $gradelevel->save();

        return redirect()->route('grade-level.index')
            ->with('success', 'Grade Level updated successfully.');
    }

    public function destroy($id)
    {
        DB::table("grade_levels")->where('id', $id)->delete();
        return redirect()->route('grade-level.index')
            ->with('success', 'Grade Level deleted successfully');
    }
}
