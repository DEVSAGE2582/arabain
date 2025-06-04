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
            <label class="form-label">Assign Permissions:</label>
            <div class="accordion" id="permissionsAccordion">
                @foreach($permissions as $group => $groupPermissions)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}">
                                {{ ucfirst($group) }} Permissions
                            </button>
                        </h2>
                        <div id="collapse-{{ $loop->index }}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                @foreach($groupPermissions as $permission)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            id="perm-{{ $permission->id }}"
                                            {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                                            {{ ucwords(str_replace('.', ' ', $permission->name)) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
