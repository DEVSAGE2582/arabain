@extends('layouts.admin')

@section('content')
    <style>
        #basic-6_info {
            margin: 20px 0;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <!-- Page Title & Breadcrumb -->
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <h2>Basic DataTables</h2>
                    </div>
                    <div class="col-sm-6 col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="iconly-Home icli svg-color"></i></a></li>
                            <li class="breadcrumb-item">Data Tables</li>
                            <li class="breadcrumb-item active">Basic DataTables</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable with Add/Edit modals -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Employee List</h3>
                            <a href="{{ route('employee.create') }}" class="btn btn-dark">Add Employee</a>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="basic-6">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Mobile No.</th>
                                            <th>Email</th>
                                            <th>DOB</th>
                                            <th>DOJ</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($employees as $index => $employee)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->contact_no }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->dob }}</td>
                                                <td>{{ $employee->doj }}</td>
                                                <td><span class="badge rounded-pill bg-success">Hired</span></td>
                                                <td>
                                                    <ul class="action list-inline mb-0">
                                                        <li class="list-inline-item edit">
                                                            <a href="javascript:void(0);" class="editBtn"
                                                                data-id="{{ $employee->id }}"
                                                                data-first_name="{{ $employee->first_name }}"
                                                                data-last_name="{{ $employee->last_name }}"
                                                                data-contact_no="{{ $employee->contact_no }}"
                                                                data-email="{{ $employee->email }}"
                                                                data-passport_no="{{ $employee->passport_no }}"
                                                                data-issue_date="{{ $employee->issue_date }}"
                                                                data-expiry_date="{{ $employee->expiry_date }}"
                                                                data-id_no="{{ $employee->id_no }}"
                                                                data-mailing_address="{{ $employee->mailing_address }}"
                                                                data-nationality="{{ $employee->nationality }}"
                                                                data-father_name="{{ $employee->father_name }}"
                                                                data-mother_name="{{ $employee->mother_name }}"
                                                                data-dob="{{ $employee->dob }}"
                                                                data-doj="{{ $employee->doj }}"
                                                                data-designation="{{ $employee->designation }}"
                                                                data-qualification="{{ $employee->qualification }}"
                                                                data-salary="{{ $employee->salary }}"
                                                                data-bonus="{{ $employee->bonus }}"
                                                                data-food_allowance="{{ $employee->food_allowance }}"
                                                                data-transport_allowance="{{ $employee->transport_allowance }}"
                                                                data-id_image="{{ asset($employee->id_image) }}"
                                                                data-photo="{{ asset($employee->photo) }}"
                                                                data-job_note="{{ $employee->job_note }}"
                                                                data-bs-toggle="modal" data-bs-target="#editModal">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item delete">
                                                            <button type="button" class="btn btn-link text-danger p-0"
                                                                onclick="openDeleteModal({{ $employee->id }})">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No employees found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- EDIT Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <form id="editEmployeeForm" method="POST" action=""
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="edit_id">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            id="edit_first_name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="edit_last_name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Contact No</label>
                                                        <input type="text" class="form-control" name="contact_no"
                                                            id="edit_contact_no">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="edit_email">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Passport No</label>
                                                        <input type="text" class="form-control" name="passport_no"
                                                            id="edit_passport_no">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Issue Date</label>
                                                        <input type="date" class="form-control" name="issue_date"
                                                            id="edit_issue_date">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Expiry Date</label>
                                                        <input type="date" class="form-control" name="expiry_date"
                                                            id="edit_expiry_date">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>ID No</label>
                                                        <input type="text" class="form-control" name="id_no"
                                                            id="edit_id_no">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label>Mailing Address</label>
                                                        <textarea class="form-control" name="mailing_address" id="edit_mailing_address"></textarea>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Nationality</label>
                                                        <input type="text" class="form-control" name="nationality"
                                                            id="edit_nationality">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Father's Name</label>
                                                        <input type="text" class="form-control" name="father_name"
                                                            id="edit_fathers_name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Mother's Name</label>
                                                        <input type="text" class="form-control" name="mother_name"
                                                            id="edit_mothers_name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Date of Birth (DOB)</label>
                                                        <input type="date" class="form-control" name="dob"
                                                            id="edit_dob">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Date of Joining (DOJ)</label>
                                                        <input type="date" class="form-control" name="doj"
                                                            id="edit_doj">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Designation</label>
                                                        <input type="text" class="form-control" name="designation"
                                                            id="edit_designation">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Qualification</label>
                                                        <input type="text" class="form-control" name="qualification"
                                                            id="edit_qualification">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>Salary</label>
                                                        <input type="text" class="form-control" name="salary"
                                                            id="edit_salary">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>Bonus</label>
                                                        <input type="text" class="form-control" name="bonus"
                                                            id="edit_bonus">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>Food Allowance</label>
                                                        <input type="text" class="form-control" name="food_allowance"
                                                            id="edit_food_allowance">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>Transport Allowance</label>
                                                        <input type="text" class="form-control"
                                                            name="transport_allowance" id="edit_transport_allowance">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>ID Image</label>
                                                        <div>
                                                            <img id="edit_id_image_preview" src="" alt="ID Image"
                                                                style="max-width: 100%; max-height: 150px; margin-bottom: 10px; display:none;">
                                                        </div>
                                                        <input type="file" class="form-control" name="id_image">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Photo</label>
                                                        <div>
                                                            <img id="edit_photo_preview" src="" alt="Photo"
                                                                style="max-width: 100%; max-height: 150px; margin-bottom: 10px; display:none;">
                                                        </div>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label>Job Note</label>
                                                        <textarea class="form-control" name="job_note" id="edit_job_note"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update Employee</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="deleteForm" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                Are you sure you want to delete this employee?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>




                            {{-- Optional: remove modal includes since you use a separate page for Add --}}
                            {{-- @include('admin.modals.add-employee') --}}
                            {{-- @include('admin.modals.edit-employee') --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.editBtn', function() {

        $('#edit_id').val($(this).data('id'));
        $('#edit_first_name').val($(this).data('first_name'));
        $('#edit_last_name').val($(this).data('last_name'));
        $('#edit_contact_no').val($(this).data('contact_no'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_passport_no').val($(this).data('passport_no'));
        $('#edit_issue_date').val($(this).data('issue_date'));
        $('#edit_expiry_date').val($(this).data('expiry_date'));
        $('#edit_id_no').val($(this).data('id_no'));
        $('#edit_mailing_address').val($(this).data('mailing_address'));
        $('#edit_nationality').val($(this).data('nationality'));
        $('#edit_fathers_name').val($(this).data('father_name'));
        $('#edit_mothers_name').val($(this).data('mother_name'));
        $('#edit_dob').val($(this).data('dob'));
        $('#edit_doj').val($(this).data('doj'));
        $('#edit_designation').val($(this).data('designation'));
        $('#edit_qualification').val($(this).data('qualification'));
        $('#edit_salary').val($(this).data('salary'));
        $('#edit_bonus').val($(this).data('bonus'));
        $('#edit_food_allowance').val($(this).data('food_allowance'));
        $('#edit_transport_allowance').val($(this).data('transport_allowance'));
        $('#edit_job_note').val($(this).data('job_note'));

        let id = $(this).data('id');
        $('#editEmployeeForm').attr('action', `/employee/update/${id}`);

        let idImageUrl = $(this).data('id_image');
        if (idImageUrl) {
            $('#edit_id_image_preview').attr('src', idImageUrl).show();
        } else {
            $('#edit_id_image_preview').hide();
        }

        // Show existing Photo preview
        let photoUrl = $(this).data('photo');
        if (photoUrl) {
            $('#edit_photo_preview').attr('src', photoUrl).show();
        } else {
            $('#edit_photo_preview').hide();
        }
    });
</script>

<script>
    function openDeleteModal(employeeId) {
        const form = document.getElementById('deleteForm');
        form.action = `/employee/${employeeId}`; // Make sure the route matches
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>
