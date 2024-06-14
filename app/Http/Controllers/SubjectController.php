<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all subjects from the database
        $subjects = Subject::all();
        
        // Pass the fetched subjects to the view
        return view('subject.index', ['subjects' => $subjects]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'subjectName' => 'required',
            'subjectCode' => 'required',
            'subjectUnit' => 'required',
            'subjectYear' => 'required|in:1,2,3,4', // Ensure year is one of 1, 2, 3, or 4
            'subjectSemester' => 'required|in:1,2', // Ensure semester is one of 1, 2, or 3 (Summer)
            // Add more validation rules if needed
        ]);

        // Create a new subject with the validated data
        $newSubject = Subject::create($data);

        // Redirect back with a success message
        return redirect()->route('subject.index')->with('success', 'Subject added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        // Return the view with the subject data
        return view('subject.show', ['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        // Return the edit view with the subject data
        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        // Validate incoming request data
        $data = $request->validate([
            'subjectName' => 'required',
            'subjectCode' => 'required',
            'subjectUnit' => 'required',
            'subjectYear' => 'required|in:1,2,3,4', // Ensure year is one of 1, 2, 3, or 4
            'subjectSemester' => 'required|in:1,2,3', // Ensure semester is one of 1, 2, or 3 (Summer)
            // Add more validation rules if needed
        ]);

        // Update the subject attributes
        $subject->update($data);

        // Redirect back with a success message
        return redirect()->route('subject.index')->with('success', 'Subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Delete the subject
        $subject->delete();

        // Redirect back with a success message
        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully');
    }
}
