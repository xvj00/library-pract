<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    use HasFactory;
    protected $table = 'authors';
    protected $guarded = false;

    public function books(){
        return $this->belongsToMany(Book::class, 'author_books', 'author_id', 'book_id');
    }
}
