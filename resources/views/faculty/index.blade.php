@extends('layouts.app')
  
@section('title', 'Faculty')
  
@section('contents')
        <div class="row mb-3">
            <div class="col">
                <h1 class="mb-0 ">Faculty List</h1>
            </div>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div>
        <div class="row mb-3">
            <div class="col-md-6"> 
                <div class="input-group light-bg">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
             <div class="col-md-auto">
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addFacultyModal">Add Faculty</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="facultyTable" class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th onclick="sortTable(0)">Name <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(1)">Email <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(2)">Units <i class="fas fa-sort"></i></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faculties as $faculty)
                    <!-- Edit Faculty Modal -->
                    <div class="modal fade" id="editFacultyModal{{$faculty->id}}" tabindex="-1" aria-labelledby="editFacultyModalLabel{{$faculty->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title " id="editFacultyModalLabel{{$faculty->id}}">Edit Faculty</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('faculty.update', $faculty->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="facultyname" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="facultyname" name="facultyname" value="{{ $faculty->facultyname }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="facultyemail" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="facultyemail" name="facultyemail" value="{{ $faculty->facultyemail }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="facultyunit" class="form-label">Unit</label>
                                            <input type="integer" class="form-control" id="facultyunit" name="facultyunit" value="{{ $faculty->facultyunit }}">
                                        </div>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td>{{$faculty->facultyname}}</td>
                        <td>{{$faculty->facultyemail}}</td>
                        <td>{{$faculty->facultyunit}}</td>
                        <td class="align-middle">
                            <div class="d-flex">
                                <a href="#" type="button" class="btn btn-warning m-0 me-2" data-bs-toggle="modal" data-bs-target="#editFacultyModal{{$faculty->id}}">Edit</a>
                                <form action="{{ route('faculty.destroy', $faculty->id) }}" method="POST" class="delete-form" id="deleteForm{{$faculty->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0 delete-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-faculty-id="{{$faculty->id}}">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

<!-- Add Faculty Modal -->
<div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacultyModalLabel">Add Faculty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form here -->
                <form action="{{ route('faculty.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="facultyname" class="form-label">Name</label>
                        <input type="text" class="form-control" id="facultyname" name="facultyname">
                    </div>
                    <div class="mb-3">
                        <label for="facultyemail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="facultyemail" name="facultyemail">
                    </div>
                    <div class="mb-3">
                        <label for="facultyunit" class="form-label">Unit</label>
                        <input type="integer" class="form-control" id="facultyunit" name="facultyunit">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Faculty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this faculty?</p>
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
            var facultyId = this.getAttribute('data-faculty-id');
            deleteForm = document.getElementById('deleteForm' + facultyId);
        });
    });
</script>


<script>
function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("facultyTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those that don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }

    // Event listener for search input
    document.getElementById("searchInput").addEventListener("keyup", searchTable);
</script>


<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("facultyTable");
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
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
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
                switchcount++;
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

@endsection
