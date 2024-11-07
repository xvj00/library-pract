<?php

namespace App\Http\Filters\Book;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class AuthorFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->has('author')) {
            $query->where('name', request('author'));
        }

        return $next($query);
    }
}
