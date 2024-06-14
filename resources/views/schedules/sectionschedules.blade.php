<div id="sectionCalendar" class="table-responsive" style="display: none;">
    <!-- Section Calendar Structure -->
    <div class="dash-content">
        <h1 class="mb-0">Section Schedule</h1>
    </div>
    <div class="column-head mb-3">
        <div class="input-group">
            <label class="input-group-text light-bg">Section Name</label>
            <select id="sectionDropdown1" class="form-select light-bg">
                <!-- Loop through sections -->
                @foreach($sections as $section)
                    <option>{{ $section->sectionName }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button id="assignButton" type="button" class="btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignModal2">Assign</button>
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


<!-- Modal Structure -->
<div class="modal fade" id="assignModal2" tabindex="-1" aria-labelledby="assignModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel2">Assign Section Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignSectionForm">
                    <div class="mb-3">
                        <label for="sectionName" class="form-label">Section Name</label>
                        <input type="text" class="form-control" id="sectionName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="faculty" class="form-label">Faculty</label>
                        <select id="facultyDropdown" class="form-select" required>
                            <!-- Loop through faculties -->
                            @foreach($faculties as $faculty)
                                <option>{{ $faculty->facultyname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <select id="subjectDropdown" class="form-select" required>
                            <!-- Loop through subjects -->
                            @foreach($subjects as $subject)
                                <option>{{ $subject->subjectName }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="room" class="form-label">Room</label>
                        <select id="roomDropdown1" class="form-select" required>
                            <!-- Loop through rooms -->
                            @foreach($rooms as $room)
                                <option>{{ $room->name }}</option>
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
        const sectionDropdown = document.getElementById('sectionDropdown1'); // Change to sectionDropdown1
        const assignButton = document.getElementById('assignButton');
        const sectionNameInput = document.getElementById('sectionName');
        const sectionModal = document.getElementById('assignModal2'); // Change this line to match your section modal ID

        // Check if the modal being affected is the one associated with the section schedule
        if (sectionModal) {
            // Load the saved section name from local storage
            const savedSectionName = localStorage.getItem('selectedSection');
            if (savedSectionName) {
                // Loop through options to find the saved section name
                for (let i = 0; i < sectionDropdown.options.length; i++) {
                    if (sectionDropdown.options[i].text === savedSectionName) {
                        sectionDropdown.selectedIndex = i; // Set the dropdown value
                        sectionNameInput.value = savedSectionName; // Set the section name when loading saved section
                        break;
                    }
                }
            }

            // Save the selected section name to local storage when dropdown value changes
            sectionDropdown.addEventListener('change', function () {
                localStorage.setItem('selectedSection', sectionDropdown.value);
                sectionNameInput.value = sectionDropdown.value; // Set the section name when dropdown value changes
            });

            // Set the section name in the modal when the Assign button is clicked
            assignButton.addEventListener('click', function () {
                const selectedSection = sectionDropdown.value;
                sectionNameInput.value = selectedSection;
            });
        }
    });
</script>
