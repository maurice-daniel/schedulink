<div id="facultyCalendar" class="table-responsive" style="display: none;">
    <!-- Section Calendar Structure -->
    <div class="dash-content">
        <h1 class="mb-0">Faculty Schedule</h1>
    </div>
    <div class="column-head mb-3">
        <div class="input-group">
            <label class="input-group-text light-bg">Faculty Name</label>
            <select id="facultyDropdown" class="form-select light-bg">
                <!-- Loop through faculties -->
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->facultyname }}">{{ $faculty->facultyname }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button id="assignButton" type="button" class="btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignModal">Assign</button>
        </div>
        <div>
            <button type="button" class="btn btn-print">Print</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table-dash">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody id="scheduleTableBody">
                @php
                    $startTime = new DateTime('07:30:00');
                    $endTime = new DateTime('22:00:00');
                    $interval = new DateInterval('PT30M');
                    $currentTime = clone $startTime;
                    while ($currentTime <= $endTime) {
                        echo "<tr>";
                        echo "<td>" . $currentTime->format('h:i A') . "</td>"; // Display time in 12-hour format with AM/PM
                        for ($i = 0; $i < 7; $i++) {
                            echo "<td></td>";
                        }
                        echo "</tr>";
                        $currentTime->add($interval);
                    }
                @endphp
            </tbody>
        </table>
    </div>
</div>





<!-- Modal Structure -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Assign Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignForm" method="POST" action="{{ route('schedule.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="facultyName" class="form-label">Faculty Name</label>
                        <input type="text" class="form-control" id="facultyName" name="faculty_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <select id="subjectDropdown" class="form-select" name="subject" required>
                            @foreach($subjects as $subject)
                                <option>{{ $subject->subjectName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Section</label>
                        <select id="sectionDropdown" class="form-select" name="section" required>
                            @foreach($sections as $section)
                                <option>{{ $section->sectionName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Room</label>
                        <select id="roomDropdown" class="form-select" name="room" required>
                            @foreach($rooms as $room)
                                <option>{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Start Time</label>
                        <select id="startTime" class="form-select" name="start_time" required>
                            @php
                                $startTime = new DateTime('07:30:00');
                                $endTime = new DateTime('22:00:00');
                                $interval = new DateInterval('PT30M');
                                $currentTime = clone $startTime;
                                while ($currentTime <= $endTime) {
                                    echo "<option value=\"" . $currentTime->format('H:i') . "\">" . $currentTime->format('h:i A') . "</option>";
                                    $currentTime->add($interval);
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">End Time</label>
                        <select id="endTime" class="form-select" name="end_time" required>
                            @php
                                $startTime = new DateTime('07:30:00');
                                $endTime = new DateTime('22:00:00');
                                $interval = new DateInterval('PT30M');
                                $currentTime = clone $startTime;
                                while ($currentTime <= $endTime) {
                                    echo "<option value=\"" . $currentTime->format('H:i') . "\">" . $currentTime->format('h:i A') . "</option>";
                                    $currentTime->add($interval);
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Days</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Monday" id="monday" name="days[]">
                            <label class="form-check-label" for="monday">Monday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Tuesday" id="tuesday" name="days[]">
                            <label class="form-check-label" for="tuesday">Tuesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday" name="days[]">
                            <label class="form-check-label" for="wednesday">Wednesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Thursday" id="thursday" name="days[]">
                            <label class="form-check-label" for="thursday">Thursday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Friday" id="friday" name="days[]">
                            <label class="form-check-label" for="friday">Friday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Saturday" id="saturday" name="days[]">
                            <label class="form-check-label" for="saturday">Saturday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Sunday" id="sunday" name="days[]">
                            <label class="form-check-label" for="sunday">Sunday</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
document.getElementById('facultyDropdown').addEventListener('change', function() {
    const facultyName = this.value;

    fetch('{{ route('get-faculty-schedule') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ faculty_name: facultyName })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const tableBody = document.getElementById('scheduleTableBody');

        // Clear existing table data
        tableBody.innerHTML = '';

        // Populate table with schedule data
        data.forEach(schedule => {
            const days = JSON.parse(schedule.days);
            const startTime = schedule.start_time;
            const endTime = schedule.end_time;

            // Iterate through each time slot in the table
            let currentTime = new Date('2024-06-14 ' + startTime); // Using a fixed date for display purposes

            while (currentTime <= new Date('2024-06-14 ' + endTime)) {
                const timeSlot = currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                const row = tableBody.querySelector(`tr[data-time="${timeSlot}"]`);

                if (!row) {
                    // Create a new row if it doesn't exist
                    const newRow = document.createElement('tr');
                    newRow.setAttribute('data-time', timeSlot);
                    newRow.innerHTML = `<td>${timeSlot}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>`;
                    tableBody.appendChild(newRow);
                }

                // Fill the cell for the current day
                days.forEach(day => {
                    const dayIndex = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'].indexOf(day);

                    if (dayIndex !== -1) {
                        const cell = tableBody.querySelector(`tr[data-time="${timeSlot}"]`).querySelectorAll('td')[dayIndex + 1];
                        cell.innerHTML = `${schedule.subject}<br>${schedule.section}<br>${schedule.room}`;
                    }
                });

                // Move to the next 30-minute interval
                currentTime.setTime(currentTime.getTime() + 30 * 60000); // 30 minutes in milliseconds
            }
        });
    })
    .catch(error => {
        console.error('Error fetching and parsing data', error);
        // Optionally handle errors here (e.g., display an error message)
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const facultyDropdown = document.getElementById('facultyDropdown');
    const assignButton = document.getElementById('assignButton');
    const facultyNameInput = document.getElementById('facultyName');

    // Load the saved faculty name from local storage
    const savedFacultyName = localStorage.getItem('selectedFaculty');
    if (savedFacultyName) {
        for (let i = 0; i < facultyDropdown.options.length; i++) {
            if (facultyDropdown.options[i].text === savedFacultyName) {
                facultyDropdown.selectedIndex = i;
                break;
            }
        }
    }

    // Save the selected faculty name to local storage
    facultyDropdown.addEventListener('change', function () {
        const selectedFaculty = facultyDropdown.options[facultyDropdown.selectedIndex].text;
        localStorage.setItem('selectedFaculty', selectedFaculty);
    });

    // Set the faculty name in the modal when the Assign button is clicked
    assignButton.addEventListener('click', function () {
        const selectedFaculty = facultyDropdown.options[facultyDropdown.selectedIndex].text;
        facultyNameInput.value = selectedFaculty;
    });
});
</script>
