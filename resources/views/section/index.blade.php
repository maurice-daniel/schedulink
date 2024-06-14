@extends('layouts.app')

@section('title', 'Section')

@section('contents')
    <div class="row mb-3">
        <div class="col">
            <h1 class="mb-0">Section List</h1>
        </div>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md">
            <div class="input-group light-bg">
                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
        <div class="col-md">
            <div class="input-group">
                <label class="input-group-text light-bg" for="yearDropdown">Year</label>
                <select class="form-select light-bg" id="yearDropdown">
                    <option value="">All</option>
                    @for($year = 1; $year <= 4; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">Add Section</button>
        </div>
    </div>
    <div class="table-responsive">
        <table id="sectionTable" class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th onclick="sortTable(0)">Section Name <i class="fas fa-sort"></i></th>
                    <th onclick="sortTable(1)">Section Code <i class="fas fa-sort"></i></th>
                    <th onclick="sortTable(2)">Year <i class="fas fa-sort"></i></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                <!-- Edit Section Modal -->
                <div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1" aria-labelledby="editSectionModalLabel{{$section->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content light-bg">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSectionModalLabel{{$section->id}}">Edit Section</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Content for editing section -->
                            <div class="modal-body">
                                <form action="{{ route('section.update', $section->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="sectionName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="sectionName" name="sectionName" value="{{ $section->sectionName }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sectioncode" class="form-label">Code</label>
                                        <input type="text" class="form-control" id="sectioncode" name="sectioncode" value="{{ $section->sectioncode }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sectionYear" class="form-label">Year</label>
                                        <select class="form-select light-bg" id="sectionYear" name="year">
                                            @for($year = 1; $year <= 4; $year++)
                                                <option value="{{ $year }}" {{ $year == $section->year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <tr>
                    <td>{{ $section->sectionName }}</td>
                    <td>{{ $section->sectioncode }}</td>
                    <td>{{ $section->year }}</td>
                    <td class="align-middle">
                        <div class="d-flex">
                            <a href="#" type="button" class="btn btn-warning m-0 me-2" data-bs-toggle="modal" data-bs-target="#editSectionModal{{ $section->id }}">Edit</a>
                            <form action="{{ route('section.destroy', $section->id) }}" method="POST" class="delete-form" id="deleteForm{{$section->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger m-0 delete-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-section-id="{{$section->id}}">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Section Modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content light-bg">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('section.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="sectionName">
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="sectioncode">
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <select class="form-select light-bg" id="year" name="year">
                                @for($year = 1; $year <= 4; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this section?</p>
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
                var sectionId = this.getAttribute('data-section-id');
                deleteForm = document.getElementById('deleteForm' + sectionId);
            });
        });
    </script>

    <script>
        function searchTable() {
            var input, filter, yearFilter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            yearFilter = document.getElementById("yearDropdown").value;
            table = document.getElementById("sectionTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                if (td.length > 0) {
                    var showRow = true;
                    if (yearFilter !== "" && td[2].textContent.trim() !== yearFilter) {
                        showRow = false;
                    }
                    if (filter !== "" && showRow) {
                        showRow = false;
                        for (var j = 0; j < td.length; j++) {
                            txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                showRow = true;
                                break;
                            }
                        }
                    }
                    if (showRow) {
                        tr[i].style.display = "";
                    }
                }
            }
        }

        document.getElementById("searchInput").addEventListener("keyup", searchTable);
        document.getElementById("yearDropdown").addEventListener("change", searchTable);
    </script>

    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("sectionTable");
            switching = true;
            dir = "asc"; 
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;      
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
            updateSortIndicator(n, dir);
        }

        function updateSortIndicator(n, dir) {
            var ths = document.getElementsByTagName("th");
            for (var i = 0; i < ths.length; i++) {
                ths[i].querySelector("i").className = "fas fa-sort";
            }
            var th = document.getElementsByTagName("th")[n];
            if (dir === "asc") {
                th.querySelector("i").className = "fas fa-sort-up";
            } else {
                th.querySelector("i").className = "fas fa-sort-down";
            }
        }
    </script>

@endsection
