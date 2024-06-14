<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all sections from the database
        $sections = Section::all();
        
        // Pass the fetched sections to the view
        return view('section.index', ['sections' => $sections]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'sectionName' => 'required',
            'sectioncode' => 'required',
            'year' => 'required|in:1,2,3,4', // Ensure year is one of 1, 2, 3, or 4
            // Add more validation rules if needed
        ]);
    
        // Create a new section with the validated data
        $newSection = Section::create($data);
    
        // Redirect back with a success message
        return redirect()->route('section.index')->with('success', 'Section added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the section by its ID using the Section model
        $section = Section::findOrFail($id);

        // Return the view with the section data
        return view('section.show', ['section' => $section]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        // Return the edit view with the section data
        return view('section.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate incoming request data
    $data = $request->validate([
        'sectionName' => 'required',
        'sectioncode' => 'required',
        'year' => 'required|in:1,2,3,4', // Ensure year is one of 1, 2, 3, or 4
        // Add more validation rules if needed
    ]);

    // Find the section by its ID using the Section model
    $section = Section::findOrFail($id);

    // Update the section attributes
    $section->update([
        'sectionName' => $request->input('sectionName'),
        'sectioncode' => $request->input('sectioncode'),
        'year' => $request->input('year'),
    ]);

    // Redirect back with a success message
    return redirect()->route('section.index')->with('success', 'Section updated successfully');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the section by its ID using the Section model
        $section = Section::findOrFail($id);

        // Delete the section
        $section->delete();

        // Redirect back with a success message
        return redirect()->route('section.index')->with('success', 'Section deleted successfully');
    }
}
