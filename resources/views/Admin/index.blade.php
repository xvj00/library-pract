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
                                    <h4 class="card-title">Basic Data Table</h4>
                                    <p class="card-subtitle mb-4">
                                        ВОН ТЕ ПОЛЬЗОВАТЕЛИ ЕПТА

                                    </p>

                                    <a href="{{route('admin.create')}}" class="btn btn-primary">Create</a>
                                    <table id="basic-datatable" class="table dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>name</th>
                                            <th>email</th>

                                            <th>Role</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>


                                                <td>{{$user->role}}</td>
                                                <td>
                                                    <form action="{{route('admin.destroy', $user -> id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger" value="Удалить">
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success" href="{{ route('admin.edit', $user->id) }}">Update</a>
                                                <td>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
@endsection
