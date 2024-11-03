<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('student_email');
        $exists = School::where('student_personal_email', $email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function deleteStudent($id)
    {
    $student = School::find($id);

    if ($student) {
        $student->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
    }

    // Function to save the student details
    public function addStudent(Request $request)
    {
        $student = new School; // Replace 'Student' with the appropriate model name if different
        $student->student_college_name = $request->student_college_name;
        $student->student_name = $request->student_name;
        $student->student_gender = $request->student_gender;
        $student->student_personal_email = $request->student_email;
        $student->student_department = $request->student_department;
        $student->student_cgpa = $request->student_cgpa;
        $student->student_native_location = $request->student_native_location;
        $student->student_contact_number = '+91 ' . $request->student_contact;
        $student->student_father_occupation = $request->father_occupation; // Optional field, no modification needed if null

        $student->save();

        return back()->with('success', 'Your details have been successfully added! We Connect with you very Shortly.');
    }

    public function studentDetails()
    {
        $studentDetails = School::all();
        return view('studentDetails', compact('studentDetails'));
    }

    
}
