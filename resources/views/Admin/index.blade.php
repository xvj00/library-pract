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
                                    <h4 class="card-title">Админ панель</h4>
                                    <p class="card-subtitle mb-4">Users Table</p>
                                    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Create</a>
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
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <form action="{{ route('admin.destroy', $user->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success" href="{{ route('admin.edit', $user->id) }}">Update</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div> <!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end container-fluid -->
            </div> <!-- end page-content -->
        </div> <!-- end main-content -->
    </div> <!-- end layout-wrapper -->
@endsection
