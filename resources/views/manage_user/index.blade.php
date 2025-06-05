@extends('layouts.admin')

@section('content')
<div class="container">

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <h2>User Management</h2>
                    </div>
                    <div class="col-sm-6 col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="iconly-Home icli svg-color"></i></a></li>
                            <li class="breadcrumb-item">User Management</li>
                            <li class="breadcrumb-item active">User List</li>
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
                            <h3>Member Users</h3>
                            <a href="{{ route('users.create') }}" class="btn btn-dark">ADD</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table" id="basic-6">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                <span class="badge bg-success">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($user->active === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <ul class="action list-inline mb-0">
                                                    <li class="list-inline-item edit">
                                                        <a href="{{ route('impersonate', ['user_id' => $user->id]) }}"
                                                            class="login">
                                                            <i class="fas fa-sign-in-alt"></i> <!-- Login icon -->
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item edit">
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="edit-btnn">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item delete">
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="delete-btn border-0 bg-transparent p-0"
                                                                style="color: red;">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">No users found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- /.table-responsive -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.page-body -->
</div>
@endsection