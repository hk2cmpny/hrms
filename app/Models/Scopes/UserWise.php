<?php

namespace App\Models\Scopes;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserWise implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Filament::auth()->user();
        if($user != null && !$user->is_admin) {
            $builder->whereUserId($user->id);
        }
    }
}
