@extends('layouts.main')

@section('content')
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-lg border-0">
                                <form method="GET" action="{{ route('admin.index') }}" class="container my-5 p-4 bg-light rounded shadow-sm">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-lg border-primary shadow-sm" id="search"
                                                   name="search"
                                                   placeholder="🔍 Поиск по запросу" value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end gap-2">
                                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">Применить фильтр</button>
                                            <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">Сбросить</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="card-body">
                                    <h4 class="card-title text-center text-primary mb-4">Users Table</h4>
                                    <a href="{{ route('admin.create') }}" class="btn btn-success mb-3">Create New User</a>

                                    <!-- Active Users Table -->
                                    <table id="basic-datatable" class="table table-hover table-striped table-bordered dt-responsive nowrap align-middle">
                                        <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            @if($user->deleted_at == null)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <form action="{{ route('admin.destroy', $user->id) }}" method="post" class="mb-0">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                            <a class="btn btn-success btn-sm" href="{{ route('admin.edit', $user->id) }}">Update</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Deleted Users Table -->
                                    <h4 class="card-title text-center text-danger mt-5">Deleted Users Table</h4>
                                    <table id="deleted-datatable" class="table table-hover table-striped table-bordered dt-responsive nowrap align-middle">
                                        <thead class="table-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Restore</th>
                                            <th>Force Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            @if($user->deleted_at !== null)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.restore', $user->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm">Restore</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.forceDelete', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Force Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- end container-fluid -->
            </div> <!-- end page-content -->
        </div> <!-- end main-content -->
    </div> <!-- end layout-wrapper -->
@endsection
