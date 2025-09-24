<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Ambil course yang SUDAH diambil oleh mahasiswa
        $enrolledCourses = auth()->user()->courses;

        // Ambil course yang BELUM diambil (tersedia untuk diambil)
        $availableCourses = Course::whereNotIn('id', $enrolledCourses->pluck('id'))->get();

        return view('student.courses.index', compact('enrolledCourses', 'availableCourses'));
    }

    public function enroll(Request $request, $id)
    {
        Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $id,
        ]);

        return back()->with('success', 'Berhasil mengambil mata kuliah!');
    }
}