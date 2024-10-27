<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements HasMedia
{

    use InteractsWithMedia;
    protected $table = 'books';
    protected $guarded = ['image'];



    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }


    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_books', 'book_id', 'genre_id');
    }

    public function edition(){
        return $this->belongsTo(Edition::class, 'edition_id');
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'book_id');
    }


}
