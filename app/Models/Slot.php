<?php

namespace App\Models;

use App\Models\Scopes\UserWise;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start',
        'end',
        'notes',
    ];

    public function scopeOnGoing($query, User $user)
    {
        return $query->whereUserId($user->id)->whereNull('end');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_slot');
    }

    protected function projectNames(): Attribute
    {
        $names = $this->projects?->pluck('name')->join(",") ?? '';
        return Attribute::make(get: fn() => $names);
    }

    protected function delta(): Attribute
    {
        return Attribute::make(
            get: function($field, $slot) {
                $end = new Carbon($slot['end']) ?? Carbon::now();
                $start = new Carbon($slot['start']);
                return $end->diffInSeconds($start);
            }
        );
    }

    protected function diff(): Attribute
    {
        $delta = $this->delta;
        return Attribute::make(
            get: fn() => gmdate('H:i:s', $delta)
        );
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new UserWise);
    }
}
