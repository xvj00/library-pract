@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Создание юзера </h4>
            <p class="card-subtitle mb-4">Textual form controls—like <code>input</code>s,<code> selects</code>,
                and<code> textare</code>s—are styled with the .form-control class. Included are styles for general
                appearance, focus state, sizing, and more. </p>

            <form action="{{route('admin.store')}}" method="post">
                @csrf
                <!-- Поле для имени -->
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Введите имя"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Поле для электронной почты -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com"
                           value="{{ old('email') }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Поле для пароля -->
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group my-1">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>

            </form>
        </div>
        <!-- end card-body-->
    </div>

@endsection
