@extends('layouts.admin')

@section('content')
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Users Table</h4>

                                    <form method="GET" action="{{ route('admin.index') }}" class="container my-4">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" id="search" name="search"
                                                       placeholder="Поиск" value="{{ request('search') }}">
                                            </div>



                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary w-100">Применить фильтр</button>
                                                <a href="{{ route('admin.index') }}" class="btn btn-secondary w-100 ms-2">Сбросить фильтр</a>
                                            </div>
                                        </div>
                                    </form>

                                    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Create</a>

                                    <!-- Таблица активных пользователей -->
                                    <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Delete</th>
                                            <th>Update</th>
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
                                                        <form action="{{ route('admin.destroy', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('admin.edit', $user->id) }}">Update</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Таблица удаленных пользователей -->
                                    <h4 class="card-title mt-4">Deleted Users Table</h4>
                                    <table id="deleted-datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
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
                                                            <button type="submit" class="btn btn-warning">Restore</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.forceDelete', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Force Delete</button>
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
