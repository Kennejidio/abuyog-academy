<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::latest()->paginate(5);
        return view('requirements.index', compact('requirements'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('requirements.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|unique:requirements',
            'description' => 'required',
        ], [
            'code.required' => 'Please input Requirement',
            'code.unique' => 'Requirement is already exist',
            'description.required' => 'Please input some Description',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $requirement = new Requirement();
        $requirement->code = $request->code;
        $requirement->description = $request->description;
        $requirement->created_by = Auth::user()->id;
        $requirement->updated_by = Auth::user()->id;
        $requirement->save();

        return redirect()->route('requirements.index')
            ->with('success', 'Requirement created successfully.');
    }

    public function edit($id)
    {
        $requirement = Requirement::find($id);

        return view('requirements.edit', compact('requirement'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|unique:requirements,code,' . $id,
            'description' => 'required',
        ], [
            'code.required' => 'Please input Requirement',
            'code.unique' => 'Requirement is already exist',
            'description.required' => 'Please input some Description',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->errors());
        }

        $requirement = Requirement::find($id);
        $requirement->code = $request->input('code');
        $requirement->description = $request->input('description');
        $requirement->created_by = Auth::user()->id;
        $requirement->updated_by = Auth::user()->id;
        $requirement->save();

        return redirect()->route('requirements.index')
            ->with('success', 'Requirement updated successfully');
    }

    public function destroy($id)
    {
        DB::table("requirements")->where('id', $id)->delete();
        return redirect()->route('requirements.index')
            ->with('success', 'Requirements deleted successfully');
    }
}
