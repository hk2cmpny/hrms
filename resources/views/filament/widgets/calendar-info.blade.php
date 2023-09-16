<x-filament::widget>
    {{-- <x-filament::card> --}}
        {{-- Widget content --}}
        <div class="grid grid-cols-4">

            @foreach(['holiday', 'leaves', 'leaves_requested'] as $k)
            <div>
                <span style="margin-right:7px; width:30px;height:10px;background:{{config('filament-fullcalendar.' . $k . '.color')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                {{ config('filament-fullcalendar.' . $k . '.text') }}
            </div>
            @endforeach
        </div>
    {{-- </x-filament::card> --}}
</x-filament::widget>
