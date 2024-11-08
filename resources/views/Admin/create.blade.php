@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Создание пользователя</h4>
                <p class="card-subtitle mb-4">
                    введите: имя, email, пароль для пользователя
                </p>
                <form action="{{ route('admin.store') }}" method="post">
                    @csrf
                    <!-- Поле для имени -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Введите имя"
                               value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Поле для электронной почты -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com"
                               value="{{ old('email') }}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Поле для пароля -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <!-- Кнопка отправки -->
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Отправить">
                    </div>
                </form>
            </div>
            <!-- end card-body-->
        </div>
    </div>
@endsection
