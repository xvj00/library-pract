<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $guarded = false;

    public function books(){
        return $this->belongsToMany(Book::class, 'author_books', 'author_id', 'book_id');
    }
}
