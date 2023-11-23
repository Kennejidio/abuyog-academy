<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminViewController extends Controller
{
    public function dashboard(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->hasRole('Admin') | $user->hasRole('Semi-admin')) {

        } else {
            abort(404);
        }
        if ($user->id != Auth::user()->id) {abort(401);

        }

        $enrolledStudents = Student::where('enrollment_status', 'enrolled')->count();
        $temporaryStudents = TemporaryStudent::where('enrollment_status', 'pending')->count();
        $admittedStudents = Student::where('enrollment_status', 'admitted')->count();
        $notOfficialStudents = Student::where('enrollment_status', 'not_enrolled')->count();
        $totalStudents = Student::count();
        $maleStudents = Student::where('sex', 'male')->count();
        $femaleStudents = Student::where('sex', 'female')->count();
        $undefinedStudents = Student::where('sex', 'undefined')->count();

        return view('admin.dashboard')->with(compact('enrolledStudents', 'temporaryStudents',
        'admittedStudents', 'notOfficialStudents', 'totalStudents', 'maleStudents', 'femaleStudents',
        'undefinedStudents'));

    }

}
