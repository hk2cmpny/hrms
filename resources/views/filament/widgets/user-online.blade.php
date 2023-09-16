<x-filament::widget>
    <x-filament::card>
        {{-- Widget content --}}
        <h2 class="text-xl border-b" style="padding-bottom:10px;">People</h2>
        @foreach ($users as $user)
            <div class="flex items-center justify-between">
                @php
                    $sign = '#aaaaaa';
                    $text = 'text-gray-400'
                @endphp
                @if ($user->active_slot_count())
                    @php
                        $sign = '#44aa44';
                        $text = 'text-black';
                    @endphp
                @endif
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="{{$sign}}" style="margin: 2px 10px 2px 0px;">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                    </svg>
                    <span class="{{$text}}">
                        {{$user->name}} 
                    </span>
                </div>
                <div>{{$user->activeSlot?->projectNames}}</div>
            </div>
        @endforeach
    </x-filament::card>
</x-filament::widget>
