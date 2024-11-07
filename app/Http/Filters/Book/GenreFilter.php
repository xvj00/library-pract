<?php

namespace App\Http\Filters\Book;

use Illuminate\Database\Eloquent\Builder;

class GenreFilter
{
    public function handle(Builder $builder, \Closure $next)
    {
        if (request('genre')){
            $builder->where('genre', 'like', '%' . request('genre') . '%');
        }
    }
}
