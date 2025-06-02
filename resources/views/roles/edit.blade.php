@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Role: {{ $role->name }}</h2>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Role Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Assign Permissions:</label><br>
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                        id="perm-{{ $permission->id }}"
                        {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
