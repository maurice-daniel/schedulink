<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('faculty.index', ['faculties' => $faculties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define custom error messages
        $messages = [
            'facultyname.unique' => 'The faculty name already exists.',
            'facultyemail.unique' => 'The faculty email already exists.',
        ];

        // Validate the request data with custom error messages
        $data = $request->validate([
            'facultyname' => 'required|string|max:255|unique:faculties,facultyname',
            'facultyemail' => 'required|string|email|max:255|unique:faculties,facultyemail',
            'facultyunit' => 'required|numeric',
        ], $messages);

        // Create the faculty record
        Faculty::create($data);

        // Redirect to the index page with a success message
        return redirect()->route('faculty.index')->with('success', 'Faculty added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'facultyname' => 'required|string|max:255',
            'facultyemail' => 'required|string|email|max:255|unique:faculties,facultyemail,' . $id,
            'facultyunit' => 'required|numeric',
        ]);

        $faculty = Faculty::findOrFail($id);
        $faculty->update($data);

        return redirect()->route('faculty.index')->with('success', 'Faculty updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();
        return redirect()->route('faculty.index')->with('success', 'Faculty deleted successfully');
    }
}
