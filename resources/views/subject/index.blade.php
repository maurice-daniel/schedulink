@extends('layouts.app')
  
@section('title', 'Subject')
  
@section('contents')
        <div class="row mb-3">
            <div class="col">
                <h1 class="mb-0">Subject List</h1>
            </div>
        </div>
         @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Whoops! Duplicate Entry.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        
        <div class="row mb-3">
            <div class="col-md-5"> 
                <div class="input-group light-bg">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <label class="input-group-text light-bg" for="semesterDropdown">Semester</label>
                    <select class="form-select light-bg" id="semesterDropdown">
                        <option value="">All</option>
                        <option value="1">1st Semester</option>
                        <option value="2">2nd Semester</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <label class="input-group-text light-bg" for="yearDropdown">Year</label>
                    <select class="form-select light-bg" id="yearDropdown">
                        <option value="">All</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="col-md-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal">Add Subject</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="subjectTable" class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th onclick="sortTable(0)">Subject Name <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(1)">Subject Code <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(2)">Unit <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(3)">Year <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(4)">Semester <i class="fas fa-sort"></i></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <!-- Edit Subject Modal -->
                    <div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" aria-labelledby="editSubjectModalLabel{{ $subject->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content light-bg">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSubjectModalLabel{{ $subject->id }}">Edit Subject</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Content for editing subject -->
                                <div class="modal-body">
                                    <form action="{{ route('subject.update', $subject->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="subjectName" class="form-label">Subject Name</label>
                                            <input type="text" class="form-control" id="subjectName" name="subjectName" value="{{ $subject->subjectName }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="subjectCode" class="form-label">Subject Code</label>
                                            <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="{{ $subject->subjectCode }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="subjectUnit" class="form-label">Unit</label>
                                            <input type="number" class="form-control" id="subjectUnit" name="subjectUnit" value="{{ $subject->subjectUnit }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="subjectYear" class="form-label">Year</label>
                                            <select class="form-select light-bg" id="subjectYear" name="subjectYear">
                                                @for($year = 1; $year <= 4; $year++)
                                                    <option value="{{ $year }}" {{ $year == $subject->year ? 'selected' : '' }}>{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="subjectSemester" class="form-label">Semester</label>
                                            <select class="form-select light-bg" id="subjectSemester" name="subjectSemester">
                                                <option value="1" {{ $subject->subjectSemester == 1 ? 'selected' : '' }}>1st Semester</option>
                                                <option value="2" {{ $subject->subjectSemester == 2 ? 'selected' : '' }}>2nd Semester</option>
                                                <option value="3" {{ $subject->subjectSemester == 3 ? 'selected' : '' }}>Summer</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <td>{{ $subject->subjectName }}</td>
                        <td>{{ $subject->subjectCode }}</td>
                        <td>{{ $subject->subjectUnit }}</td>
                        <td>{{ $subject->subjectYear }}</td>
                        <td>
                            @if($subject->subjectSemester == 1)
                                1st Semester
                            @else($subject->subjectSemester == 2)
                                2nd Semester
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="d-flex">
                                <a href="#" type="button" class="btn btn-warning m-0 me-2" data-bs-toggle="modal" data-bs-target="#editSubjectModal{{ $subject->id }}">Edit</a>
                                <form action="{{ route('subject.destroy', $subject->id) }}" method="POST" class="delete-form" id="deleteForm{{ $subject->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0 delete-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-subject-id="{{ $subject->id }}">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content light-bg">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subject.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="subjectName" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subjectName" name="subjectName">
                    </div>
                    <div class="mb-3">
                        <label for="subjectCode" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="subjectCode" name="subjectCode">
                    </div>
                    <div class="mb-3">
                        <label for="subjectUnit" class="form-label">Unit</label>
                        <input type="number" class="form-control" id="subjectUnit" name="subjectUnit">
                    </div>
                    <div class="mb-3">
                        <label for="subjectYear" class="form-label">Year</label>
                        <select class="form-select light-bg" id="subjectYear" name="subjectYear">
                            @for($year = 1; $year <= 4; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subjectSemester" class="form-label">Semester</label>
                        <select class="form-select light-bg" id="subjectSemester" name="subjectSemester">
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                            
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content light-bg">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this subject?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    var deleteModal = document.getElementById('deleteModal');
    var confirmDeleteBtn = document.getElementById('confirmDelete');
    var deleteForm;

    confirmDeleteBtn.addEventListener('click', function() {
        if (deleteForm) {
            deleteForm.submit();
        }
    });

    var deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var subjectId = this.getAttribute('data-subject-id');
            deleteForm = document.getElementById('deleteForm' + subjectId);
        });
    });
</script>

<script>
    // Function to handle filtering by year and semester
    function filterTable() {
        var selectedYear = document.getElementById("yearDropdown").value;
        var selectedSemester = document.getElementById("semesterDropdown").value;
        var filterText = document.getElementById("searchInput").value.toUpperCase();
        var rows = document.getElementById("subjectTable").getElementsByTagName("tr");
        
        for (var i = 0; i < rows.length; i++) {
            var yearCell = rows[i].getElementsByTagName("td")[3]; // Assuming year is the fourth column
            var semesterCell = rows[i].getElementsByTagName("td")[4]; // Assuming semester is the fifth column
            var subjectNameCell = rows[i].getElementsByTagName("td")[0]; // Assuming subject name is the first column
            if (rows[i].classList.contains("table-header")) {
                rows[i].style.display = ""; // Ensure the table header is always visible
            } else if (yearCell && semesterCell) {
                var yearMatch = selectedYear === "" || yearCell.textContent.trim() === selectedYear;
                var semesterMatch = selectedSemester === "" || semesterCell.textContent.trim() === selectedSemester;
                var searchMatch = filterText === "" || subjectNameCell.textContent.toUpperCase().includes(filterText);
                if (yearMatch && semesterMatch && searchMatch) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }

    document.getElementById("yearDropdown").addEventListener("change", filterTable);
    document.getElementById("semesterDropdown").addEventListener("change", filterTable);
    document.getElementById("searchInput").addEventListener("keyup", filterTable);
</script>

<script>
    function sortTable(n) {
      var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
      table = document.getElementById("subjectTable");
      switching = true;
      // Set the sorting direction to ascending initially:
      dir = "asc"; 
      /* Make a loop that will continue until
      no switching has been done: */
      while (switching) {
        // Start by assuming no switching is needed:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
          // Start by assuming there should be no switching:
          shouldSwitch = false;
          /* Get the two elements you want to compare,
          one from the current row and one from the next: */
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
          /* Check if the two rows should switch place,
          based on the direction, asc or desc: */
          if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              // If so, mark as a switch and break the loop:
              shouldSwitch= true;
              break;
            }
          } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              // If so, mark as a switch and break the loop:
              shouldSwitch= true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          /* If a switch has been marked, make the switch
          and mark that a switch has been done: */
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          // Each time a switch is done, increase this count by 1:
          switchcount ++;      
        } else {
          /* If no switching has been done AND the direction is "asc",
          set the direction to "desc" and run the while loop again. */
          if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
      // Update the sort indicator
      updateSortIndicator(n, dir);
    }

    function updateSortIndicator(n, dir) {
      // Reset all sort indicators
      var ths = document.getElementsByTagName("th");
      for (var i = 0; i < ths.length; i++) {
        ths[i].querySelector("i").className = "fas fa-sort";
      }
      // Update the sort indicator for the clicked column
      var th = document.getElementsByTagName("th")[n];
      if (dir === "asc") {
        th.querySelector("i").className = "fas fa-sort-up";
      } else {
        th.querySelector("i").className = "fas fa-sort-down";
      }
    }
</script>

<script>
    // Function to handle filtering by year and semester
    function filterTable() {
        var selectedYear = document.getElementById("yearDropdown").value;
        var selectedSemester = document.getElementById("semesterDropdown").value;
        var filterText = document.getElementById("searchInput").value.toUpperCase();
        var rows = document.getElementById("subjectTable").getElementsByTagName("tr");
        
        for (var i = 0; i < rows.length; i++) {
            var yearCell = rows[i].getElementsByTagName("td")[3]; // Assuming year is the fourth column
            var semesterCell = rows[i].getElementsByTagName("td")[4]; // Assuming semester is the fifth column
            var subjectNameCell = rows[i].getElementsByTagName("td")[0]; // Assuming subject name is the first column
            if (rows[i].classList.contains("table-header")) {
                rows[i].style.display = ""; // Ensure the table header is always visible
            } else if (yearCell && semesterCell) {
                var yearMatch = selectedYear === "" || yearCell.textContent.trim() === selectedYear;
                var semesterMatch = selectedSemester === "" || semesterCell.textContent.trim() === getSemesterText(selectedSemester);
                var searchMatch = filterText === "" || subjectNameCell.textContent.toUpperCase().includes(filterText);
                if (yearMatch && semesterMatch && searchMatch) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }

    // Function to convert semester text to numerical value
    function getSemesterText(semesterValue) {
        if (semesterValue === "1") {
            return "1st Semester";
        } else if (semesterValue === "2") {
            return "2nd Semester";
        }
        return "";
    }

    document.getElementById("yearDropdown").addEventListener("change", filterTable);
    document.getElementById("semesterDropdown").addEventListener("change", filterTable);
    document.getElementById("searchInput").addEventListener("keyup", filterTable);
</script>


@endsection
