@if (filled($brand = config('filament.brand')))
    <div @class([
        'filament-brand text-xl font-bold tracking-tight',
        'dark:text-white' => config('filament.dark_mode'),
    ])>
        <img src="{{ asset('/branding/BT-logo.png') }}" alt="Logo" class="h-10">
    </div>
@endif
