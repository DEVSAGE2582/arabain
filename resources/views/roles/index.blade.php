@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Roles List</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">+ Create New Role</a>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <style>
        #basic-6_info {
            margin: 20px 0;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <h2>Basic DataTables</h2>
                    </div>
                    <div class="col-sm-6 col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i
                                        class="iconly-Home icli svg-color"></i></a></li>
                            <li class="breadcrumb-item">Data Tables</li>
                            <li class="breadcrumb-item active">Basic DataTables</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Complex headers (rowspan and colspan) </h3>
                            <div>
                                <button class="btn btn-dark add" data-bs-toggle="modal"
                                    data-bs-target="#addEmployeeModal">ADD</button>

                                <!-- Modal -->
                                <div class="modal fade" id="addEmployeeModal" tabindex="-1"
                                    aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Larger modal -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="employeeForm">
                                                <div class="modal-body row g-3">
                                                    <div class="col-md-6">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" id="name" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="position" class="form-label">Position</label>
                                                        <input type="text" id="position" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="salary" class="form-label">Salary</label>
                                                        <input type="number" id="salary" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="office" class="form-label">Office</label>
                                                        <input type="text" id="office" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="cv" class="form-label">CV</label>
                                                        <input type="file" id="cv" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select id="status" class="form-select" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option>Active</option>
                                                            <option>Inactive</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="email" class="form-label">E-mail</label>
                                                        <input type="email" id="email" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="basic-6">
                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>Role Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($roles as $index => $role)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            
                                            <td>
                                                <ul class="action list-inline mb-0">
                                                    <!-- Edit Button -->
                                                    <li class="list-inline-item edit">
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="edit-btnn">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                            
                                                    <!-- Delete Button (Wrapped in a form) -->
                                                    <li class="list-inline-item delete">
                                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this role?');" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-btn border-0 bg-transparent p-0" style="color: red;">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                            
                                           
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3">No roles found.</td>
                                        </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="modal fade" id="editModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form id="editForm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Employee</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" id="rowIndex">
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" id="editName" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Position</label>
                                                        <input type="text" id="editPosition" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Salary</label>
                                                        <input type="text" id="editSalary" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Location</label>
                                                        <input type="text" id="editLocation" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Email</label>
                                                        <input type="email" id="editEmail" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection