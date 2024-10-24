<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $guarded = false;



    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }


    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_books', 'book_id', 'genre_id');
    }
}
