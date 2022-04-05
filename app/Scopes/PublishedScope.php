<?php

declare(strict_types=1);

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            $builder->where('published', true);
        }
        $model;
    }
}
