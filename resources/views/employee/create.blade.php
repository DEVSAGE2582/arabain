@extends('layouts.admin')
@section('content')
    <div class="page-body">
        <div class="container mt-4 px-2">
            <div class="card p-4">
                <h2>Add New Employee</h2>
                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contact No</label>
                            <input type="text" name="contact_no" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Passport No</label>
                            <input type="text" name="passport_no" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label>Issue Date</label>
                            <input type="date" name="issue_date" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label>Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>ID No</label>
                            <input type="text" name="id_no" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Mailing Address</label>
                            <input type="text" name="mailing_address" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Father's Name</label>
                            <input type="text" name="father_name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Mother's Name</label>
                            <input type="text" name="mother_name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Date of Joining</label>
                            <input type="date" name="doj" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Designation</label>
                            <input type="text" name="designation" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Qualification</label>
                            <input type="text" name="qualification" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Salary Bonus</label>
                            <input type="number" name="salary_bonus" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Food Allowance</label>
                            <input type="number" name="food_allowance" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Transport Allowance</label>
                            <input type="number" name="transport_allowance" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>ID Image</label>
                            <input type="file" name="id_image" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label>Job Note</label>
                            <textarea name="job_note" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-success" type="submit">Save</button>
                        <a href="{{ route('employee.list') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
