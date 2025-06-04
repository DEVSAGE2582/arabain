@extends('layouts.admin') 

@section('content')
<div class="container">
    <h2 class="mb-4">Create New User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username (Auto-generated):</label>
            <input readonly type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" required>
            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        

        <div class="mb-3">
            <label for="name" class="form-label">Full Name:</label>
            <input  type="disabled" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address:</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
            @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Assign Role:</label>
            <select name="role" id="role" class="form-select" required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
<script>
    window.addEventListener('DOMContentLoaded', function () {
        fetch(`{{ route('users.generate-username') }}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('username').value = data.username;
            });
    });
</script>

