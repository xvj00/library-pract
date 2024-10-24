@extends('layouts.main')

@section('content')

    <h1>Create</h1>
    <hr>
    <div>
        <form action="{{route('book.update' , $book -> id)}}" method="post">
            @csrf
            @method('PATCH')
            <div><input type="text" name="title" placeholder="title" value="{{old('title') ?? $book -> title}}">
                <div>
                    @error('title')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div><textarea name="description" placeholder="Описание">{{old('description') ?? $book -> description}}
                    @error('description')
                    {{ $message }}
                    @enderror
            </textarea></div>
            <div>
                <div><input type="text" name="author" placeholder="author" value="{{old('author') ?? $book -> author}}">
                    <div>
                        @error('author')
                        {{ $message }}
                        @enderror
                    </div>
                </div>


                <button type="submit">Изменить</button>
            </div>
        </form>
    </div>

@endsection
