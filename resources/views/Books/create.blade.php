@extends('layouts.main')

@section('content')

    <h1>Create</h1>
    <hr>
    <div>
        <form action="{{route('book.store')}}" method="post">
            @csrf
            <div><input type="text" name="title" placeholder="title" value="{{ old('title') }}">
                <div>
                    @error('title')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div><textarea name="description" placeholder="Описание">{{ old('description') }}</textarea>
                <div>
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit">Добавить в бд</button>
            </div>
        </form>
    </div>

@endsection
