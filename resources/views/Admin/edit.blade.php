@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Обновление пользователя</h4>
                <form action="{{ route('admin.update', $admin) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- Поле для пароля -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" id="password" name="password" class="form-control">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div> <!-- выводим сообщение об ошибке -->
                        @enderror
                    </div>
                    <!-- Поле для подтверждения пароля -->
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div> <!-- обработка ошибок для password_confirmation -->
                        @enderror
                    </div>
                    <!-- Кнопка отправки -->
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Обновить">
                    </div>
                </form>
            </div>
            <!-- end card-body-->
        </div>
    </div>
@endsection
