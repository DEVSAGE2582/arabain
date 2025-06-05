@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Role:</label>
            <select name="role" class="form-select" required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
                @endforeach
            </select>
        </div>
        @if (auth()->user()->hasRole('Admin')
        )
    <div class="col-md-3" style="display: flex; flex-direction: column; gap: 15px;">
        <div class="form-group">
            <div style="display: flex; gap: 10px;">
                <div>
                    <label for="active_till">{{ __('Active To') }}:*</label>
                    <input 
                        type="date" 
                        name="active_date" 
                        id="active_till" 
                        class="form-control" 
                        required 
                        placeholder="{{ __('Active Days') }}" 
                        value="{{ old('active_date', $user->active_date) }}">
                </div>

                <div>
                    <label for="active_days">{{ __('Active Days') }}</label>
                    <input 
                        type="text" 
                        name="active_days" 
                        id="active_days" 
                        class="form-control" 
                        value="{{ $user->active_days }}" 
                        readonly>
                </div>
            </div>
        </div>

        
    </div>
@endif


        <div class="mb-3">
            <label class="form-label">User Status:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="active" value="active" id="status-active" {{
                    old('active', $user->active) == 'active' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="active" value="inactive" id="status-inactive" {{
                    old('active', $user->active) == 'inactive' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-inactive">Inactive</label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateDays() {
            // Get the date value from the active_till input field
            var activeTillValue = document.getElementById('active_till').value;

            if (activeTillValue) {
                // Parse the active_till date and the current date
                var activeTillDate = new Date(activeTillValue);
                var currentDate = new Date();

                // Calculate the difference in time and convert it to days
                var timeDiff = activeTillDate - currentDate;
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                // Ensure days are non-negative (set to 0 if the date has passed)
                document.getElementById('active_days').value = daysDiff > 0 ? daysDiff : 0;
            } else {
                // If no date is selected, clear the active_days field
                document.getElementById('active_days').value = '';
            }
        }

        // Calculate days initially on page load
        calculateDays();

        // Recalculate days whenever the active_till input changes
        document.getElementById('active_till').addEventListener('change', calculateDays);
    });
</script>