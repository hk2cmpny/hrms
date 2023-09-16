<?php

namespace App\Models;

use App\Models\Scopes\UserWise;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'half',
        'reason',
        'status',
    ];

    public function days(): Attribute
    {
        $diff = (new Carbon($this->from))->diffInDays(new Carbon($this->to));
        $diff = ($diff + 1) / ($this->half?2:1);
        return Attribute::make(
            get: fn($f, $leave) => $diff
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new UserWise);
        static::creating(function (Leave $leave) {
            $user = auth()->user();
            if($user) {
                $leave->user_id = $user->id;
            }
        });
    }
}
