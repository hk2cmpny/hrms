<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Scopes\UserWise;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;


class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    public function canAccessFilament(): bool
    {
        return true;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class)->withoutGlobalScope(UserWise::class);
    }

    public function thisWeek()
    {
        $start = Carbon::now()->startOfWeek();
        $slots = Slot::where('start', '>', $start)->whereNotNull('end')->where('end', '>', $start)->get();
        return $slots->reduce(fn($sum, $slot) => $sum + $slot->delta, 0);
    }

    public function active_slot_count()
    {
        return $this->slots()->whereNull('end')->count();
    }

    public function activeSlot()
    {
        return $this->hasOne(Slot::class)->withoutGlobalScope(UserWise::class)->whereNull('end');

        return $this->slots()->whereNull('end');
    }
}
