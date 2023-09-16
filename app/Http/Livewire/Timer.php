<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Livewire\Component;

class Timer extends Component
{

    public function timeDiff()
    {
        $user = Filament::auth()->user();
        $slot = Slot::onGoing($user)->first();
        if($slot != null) {
            return $slot->diff;
        } else {
            return '[[ Offline ]]';
        }
    }

    public function render()
    {
        return view('livewire.timer');
    }
}
