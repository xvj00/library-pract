@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Добавление жанра</h4>

                <form action="{{ route('genre.store') }}" method="post">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Имя</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Введите название"
                               value="{{ old('title') }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
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
