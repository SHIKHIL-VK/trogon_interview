<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\subscribe;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('subscribe')
    ->when(auth()->user()->role == 'student', function ($query) {
            return $query->where('status', true);
        })->get();
        return view('courses.list', compact('courses'));
    }
    public function create()
    {
        return view('Courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $course = Course::findOrFail($id);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }
    public function enroll($id)
    {
        Subscribe::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'course_id' => $id,
            ],
            [
                'status' => true,
            ]
        );
        return redirect()->back()->with('success', 'Enrolled successfully!');
    }
    public function myCourse()
    {
        $courses = Course::whereHas('subscribe', function ($query) {
            $query->where('status', true);
        })->get();
        return view('courses.my-course', compact('courses'));
    }
    public function courses()
    {
        $courses = Course::select('title', 'price')
        ->withCount(['subscribe' => function ($query) {
            $query->where('status', true);
        }])
        ->get();
        return $courses;
    }
}
