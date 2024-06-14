@extends('layouts.app')
  
@section('title', 'Schedulink ')
  
@section('contents')
    <div class="row mb-3">
        <div class="dash-content">
            <button type="button" class="btn btn-entry" onclick="showCalendar('faculty')">Faculty Table</button>
            <button type="button" class="btn btn-entry" onclick="showCalendar('section')">Section Table</button>
            <button type="button" class="btn btn-entry" onclick="showCalendar('room')">Room Table</button>
        </div>
        
    </div>

   <!-- tawagon ang schedules -->
    @include('schedules.facultyschedules')
    @include('schedules.sectionschedules')
    @include('schedules.roomschedules')

    
    <script>
        function showCalendar(calendarType) {
            // Hide all 
            document.getElementById("facultyCalendar").style.display = "none";
            document.getElementById("sectionCalendar").style.display = "none";
            document.getElementById("roomCalendar").style.display = "none";
            
            // Show the selected calendar section
            document.getElementById(calendarType + "Calendar").style.display = "block";
        }

        // ang faculties ang default view sa dashboard 
        window.onload = function() {
            // Display the faculty calendar by default
            showCalendar('faculty');
        };
    </script>
@endsection
