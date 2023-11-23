<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::latest()->paginate(5);
        $gradelevels = GradeLevel::all();
        return view('sections.index', compact('sections'))->with(compact('gradelevels'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $gradelevels = GradeLevel::all();
        return view('sections.create')->with(compact('gradelevels'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|unique:sections',
            'grade_level' => 'required',
        ], [
            'code.required' => 'Please input Section',
            'code.unique' => 'Section is already been taken',
            'grade_level.required' => 'Please choose Grade Level',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $section = new Section();
        $section->code = $request->code;
        $section->grade_level_id = $request->grade_level;
        $section->created_by = Auth::user()->id;
        $section->updated_by = Auth::user()->id;
        $section->save();

        return redirect()->route('sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function edit($id)
    {
        $section = Section::find($id);
        $gradelevels = GradeLevel::all();
        return view('sections.edit', compact('section'))->with(compact('gradelevels'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|unique:sections,code,' . $id,
            'grade_level' => 'required',
        ], [
            'code.required' => 'Please input Section',
            'code.unique' => 'Section is already been taken',
            'grade_level.required' => 'Please choose Grade Level',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $section = Section::find($id);
        $section->code = $request->input('code');
        $section->grade_level_id = $request->input('grade_level');
        $section->created_by = Auth::user()->id;
        $section->updated_by = Auth::user()->id;
        $section->save();

        return redirect()->route('sections.index')
            ->with('success', 'Section updated successfully');
    }

    public function destroy($id)
    {
        DB::table("sections")->where('id', $id)->delete();
        return redirect()->route('sections.index')
            ->with('success', 'Section deleted successfully');
    }
}
