<?php

namespace App\Http\Filters\Book;

use Illuminate\Database\Eloquent\Builder;

class EditionFilter
{
    public function handle(Builder $builder, \Closure $next)
    {
        if (request('edition')){
            $builder->where('edition', 'like', '%' . request('edition') . '%');
        }
    }
}
