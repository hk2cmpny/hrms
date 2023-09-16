<x-filament::widget class="filament-account-widget">
    <x-filament::card>
        <div class="h-12 flex items-center space-x-4 rtl:space-x-reverse">
            <x-filament::user-avatar :user="$this->user" />

            <div>
                <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                    {{ __('filament::widgets/account-widget.welcome', ['user' => \Filament\Facades\Filament::getUserName($this->user)]) }}
                </h2>
            </div>
        </div>
        <hr>
        <div>
            <div style="float:right;">
                This week: {{gmdate(config('app.timeshow'), $user->thisWeek())}}
            </div>
            <h2 class="text-2xl mb-3 ">Timer</h2>

            
            @if ($this->isOnline())
                <livewire:timer></livewire:timer>
                <div>&nbsp;</div>
                <textarea 
                class="filament-forms-textarea-component filament-forms-input block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 border-gray-300"
                wire:model="slot.notes" id="" cols="30" rows="10"></textarea>
                <div>&nbsp;</div>
                <button
                    wire:click="end()"
                    class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                >End</button>
            @else
                @if(\App\Models\Project::count() > 0)
                <select
                    wire:model="project"
                    class="filament-forms-input text-gray-900 block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70"
                    >
                    <option value="0">-- No project --</option>
                    @foreach (\App\Models\Project::all() as $p)
                    <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
                @endif
                <div>&nbsp;</div>
                <button
                    wire:click="start()"
                    class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                >Start</button>
            @endif
        </div>
    </x-filament::card>
</x-filament::widget>
