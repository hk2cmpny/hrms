<?php

namespace App\Filament\Widgets;

use App\Models\Slot;
use Carbon\Carbon;
use Exception;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Contracts\Database\Query\Builder;

class UserTimer extends Widget
{
    protected static string $view = 'filament.widgets.user-timer';

    public $slot = null;
    public $user = null;
    public $project = null;
    
    public function rules()
    { 
        return [
            'slot.notes' => ['required'],
        ];
    }

    public function __construct()
    {
        parent::__construct();
        $this->user = Filament::auth()->user();
        $this->setSlot();
    }

    private function setSlot()
    {
        $this->slot = $this->count() === 1 ? Slot::onGoing($this->user)->first(): null;
    }

    public function valid(): bool
    {
        return $this->count() <= 1;
    }

    public function isOnline(): bool {
        return boolval($this->count() === 1);
    }

    public function count(): int
    {
        return Slot::onGoing($this->user)->count();
    }

    public function start()
    {
        try {
            $slot = Slot::create([
                'user_id' => $this->user->id,
                'start' => Carbon::now(),
            ]);
            if ($this->project != null && $this->project > 0) {
                $slot->projects()->sync([$this->project]);
                $this->project = null;
            }
            $this->setSlot();
            Notification::make() 
                ->title('Your timer is started !')
                ->success()
                ->send();
        } catch (Exception $e) {
            Notification::make() 
                ->title('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function end()
    {
        try {
            if($this->validate()) {
                $this->slot->end = Carbon::now();
                $this->slot->save();
                $this->setSlot();
                Notification::make() 
                    ->title('Your timer is ended !')
                    ->success()
                    ->send();
            }
        } catch (Exception $e) {
            Notification::make() 
                ->title('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
