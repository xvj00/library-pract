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

                                    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Create</a>
                                    <table id="basic-datatable"
                                           class="table table-striped table-bordered dt-responsive nowrap">
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
                                            @if($user -> deleted_at == null)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <form action="{{ route('admin.destroy', $user->id) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success"
                                                       href="{{ route('admin.edit', $user->id) }}">Update</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach

                                        <table id="basic-datatable"
                                               class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <h4 class="card-title">Deleted Users Table</h4>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Restore</th>
                                                <th>ForceDelete</th>
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
                                                                <button type="submit" class="btn btn-danger">ForceDelete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->


                            <div class="card">
                                <div class="card-body">

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
