@extends('layouts.admin')

@section('content')

<form action="{{ route('admin.update', $admin) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" class="form-control">
        @error('password')
        <div class="text-danger">{{ $message }}</div> <!-- выводим сообщение об ошибке -->
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Подтвердите пароль</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div> <!-- обработка ошибок для password_confirmation -->
        @enderror
    </div>

    <div class="form-group my-1">
        <input class="btn btn-primary" type="submit" value="Обновить">
    </div>
</form>
@endsection
