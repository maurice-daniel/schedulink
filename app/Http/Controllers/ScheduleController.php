<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Room;
use App\Models\Schedule; // Import the Schedule model
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        $sections = Section::all();
        $subjects = Subject::all();
        $rooms = Room::all();

        return view('dashboard', compact('faculties', 'sections', 'subjects', 'rooms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'faculty_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'days' => 'required|array',
        ]);

        Schedule::create([
            'faculty_name' => $validatedData['faculty_name'],
            'subject' => $validatedData['subject'],
            'section' => $validatedData['section'],
            'room' => $validatedData['room'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'days' => $validatedData['days'],
        ]);

        return redirect()->back()->with('success', 'Schedule assigned successfully');
    }

    public function fetchFacultySchedule(Request $request)
    {
        $facultyName = $request->input('faculty_name');

        // Fetch schedules for the selected faculty
        $schedules = Schedule::where('faculty_name', $facultyName)->get();

        return response()->json($schedules);
    }

}
