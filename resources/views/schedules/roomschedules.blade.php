<div id="roomCalendar" class="table-responsive" style="display: none;">
    <!-- Room Calendar Structure -->
    <div class="dash-content">
        <h1 class="mb-0">Room Schedule</h1>
    </div>
    <div class="column-head mb-3">
        <div class="input-group">
            <label class="input-group-text light-bg">Room Name</label>
            <select id="roomDropdown2" class="form-select light-bg">
                <!-- Loop through rooms -->
                @foreach($rooms as $room)
                    <option>{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button id="assignRoomButton" type="button" class="btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignRoomModal">Assign</button>
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
            <tbody>
                @php
                    // Time range from 7:30 AM to 10:00 PM
                    $startTime = new DateTime('07:30:00');
                    $endTime = new DateTime('22:00:00');
                    $interval = new DateInterval('PT30M'); // 30 minutes interval
                    
                    // Loop to generate rows for each half-hour interval
                    $currentTime = clone $startTime;
                    while ($currentTime <= $endTime) {
                        echo "<tr>";
                        echo "<td>" . $currentTime->format('h:i A') . "</td>"; // Display time
                        // Generate empty columns for each day
                        for ($i = 0; $i < 7; $i++) {
                            echo "<td></td>";
                        }
                        echo "</tr>";
                        $currentTime->add($interval); // Increment time by 30 minutes
                    }
                @endphp
            </tbody>
        </table>
    </div>
</div>

<!-- Room Assign Modal -->
<div class="modal fade" id="assignRoomModal" tabindex="-1" aria-labelledby="assignRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRoomModalLabel">Assign Room Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignRoomForm">
                    <div class="mb-3">
                        <label for="selectedRoom" class="form-label">Room Name</label>
                        <input type="text" class="form-control" id="selectedRoom" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="facultyDropdown" class="form-label">Faculty</label>
                        <select id="facultyDropdown" class="form-select" required>
                            <!-- Loop through faculties -->
                            @foreach($faculties as $faculty)
                                <option>{{ $faculty->facultyname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subjectDropdown" class="form-label">Subject</label>
                        <select id="subjectDropdown" class="form-select" required>
                            <!-- Loop through subjects -->
                            @foreach($subjects as $subject)
                                <option>{{ $subject->subjectName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sectionDropdown" class="form-label">Section</label>
                        <select id="sectionDropdown" class="form-select" required>
                            <!-- Loop through sections -->
                            @foreach($sections as $section)
                                <option>{{ $section->sectionName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Start Time</label>
                        <select id="startTime" class="form-select" required>
                            @php
                                // Time range from 7:30 AM to 10:00 PM
                                $startTime = new DateTime('07:30:00');
                                $endTime = new DateTime('22:00:00');
                                $interval = new DateInterval('PT30M'); // 30 minutes interval
                                
                                // Loop to generate options for each half-hour interval
                                $currentTime = clone $startTime;
                                while ($currentTime <= $endTime) {
                                    echo "<option value=\"" . $currentTime->format('H:i') . "\">" . $currentTime->format('h:i A') . "</option>";
                                    $currentTime->add($interval); // Increment time by 30 minutes
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">End Time</label>
                        <select id="endTime" class="form-select" required>
                            @php
                                // Time range from 7:30 AM to 10:00 PM
                                $startTime = new DateTime('07:30:00');
                                $endTime = new DateTime('22:00:00');
                                $interval = new DateInterval('PT30M'); // 30 minutes interval
                                
                                // Loop to generate options for each half-hour interval
                                $currentTime = clone $startTime;
                                while ($currentTime <= $endTime) {
                                    echo "<option value=\"" . $currentTime->format('H:i') . "\">" . $currentTime->format('h:i A') . "</option>";
                                    $currentTime->add($interval); // Increment time by 30 minutes
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Days</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Monday" id="monday">
                            <label class="form-check-label" for="monday">
                                Monday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Tuesday" id="tuesday">
                            <label class="form-check-label" for="tuesday">
                                Tuesday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday">
                            <label class="form-check-label" for="wednesday">
                                Wednesday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Thursday" id="thursday">
                            <label class="form-check-label" for="thursday">
                                Thursday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Friday" id="friday">
                            <label class="form-check-label" for="friday">
                                Friday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Saturday" id="saturday">
                            <label class="form-check-label" for="saturday">
                                Saturday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Sunday" id="sunday">
                            <label class="form-check-label" for="sunday">
                                Sunday
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roomDropdown = document.getElementById('roomDropdown2'); // Change to roomDropdown
        const assignRoomButton = document.getElementById('assignRoomButton'); // Change to assignRoomButton
        const selectedRoomInput = document.getElementById('selectedRoom');
        const roomModal = document.getElementById('assignRoomModal'); // Change this line to match your room modal ID

        // Check if the modal being affected is the one associated with the room schedule
        if (roomModal) {
            // Load the saved room name from local storage
            const savedRoomName = localStorage.getItem('selectedRoom');
            if (savedRoomName) {
                // Set the room name input value
                selectedRoomInput.value = savedRoomName;
                // Set the room dropdown value
                for (let i = 0; i < roomDropdown.options.length; i++) {
                    if (roomDropdown.options[i].text === savedRoomName) {
                        roomDropdown.selectedIndex = i;
                        break;
                    }
                }
            }

            // Add event listener to room dropdown change
            roomDropdown.addEventListener('change', function () {
                const selectedRoom = roomDropdown.options[roomDropdown.selectedIndex].text;
                // Save the selected room name in local storage
                localStorage.setItem('selectedRoom', selectedRoom);
                // Update the room name input value
                selectedRoomInput.value = selectedRoom;
            });

            // Add event listener to assign button click
            assignRoomButton.addEventListener('click', function () {
                // Save the selected room name in local storage
                localStorage.setItem('selectedRoom', roomDropdown.options[roomDropdown.selectedIndex].text);
            });

            // Update the room name input value when the modal is shown
            roomModal.addEventListener('shown.bs.modal', function () {
                selectedRoomInput.value = roomDropdown.options[roomDropdown.selectedIndex].text;
            });
        }
    });
</script>
