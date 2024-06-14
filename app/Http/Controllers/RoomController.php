<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all rooms from the database
        $room = room::all();
        
        // Pass the fetched rooms to the view
        return view('room.index', ['rooms' => $room]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Use the Faculty model to create a new faculty entry
        $data = $request -> validate([
            'name' => 'required',
            'type'=> 'nullable'
        ]);
        $newRoom = Room::create($data);
        return redirect()->route('room.index')->with('success', 'Room added successfully');


        

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the faculty by its ID using the Room model
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(room $room)
    {
        ///// faculty edit
        return view('room.edit', compact('room'))->with('success', 'Room updated successfully');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request -> validate([
            'name' => 'required',
            'type' => 'nullable'
        ]);
        // Find the faculty by its ID using the Room model
        $room = Room::findOrFail($id);
 
        // Update the faculty attributes
        $room->update($data);
 
        return redirect()->route('room.index')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the faculty by its ID using the Faculty model
        $room = Room::findOrFail($id);
 
        // Delete the faculty
        $room->delete();
 
        return redirect()->route('room.index')->with('success', 'Room deleted successfully');
    }
}
