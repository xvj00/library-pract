@extends('layouts.main')

@section('content')

    <h1>Create</h1>
    <hr>
    <div>
        <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
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
                <select name="author_id">
                    @foreach($authors as $author)
                        <option value="{{$author->id}}">{{ $author->name}} {{ $author->surname}}</option>
                    @endforeach
                </select>
                <div>
                    @error('title')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image">Book Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div>
                <button type="submit">Добавить в бд</button>
            </div>
        </form>
    </div>

@endsection
