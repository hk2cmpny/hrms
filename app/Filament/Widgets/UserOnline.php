<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;

class UserOnline extends Widget
{
    protected static string $view = 'filament.widgets.user-online';

    public $users = [];

    public function __construct()
    {
        parent::__construct();
        $this->users = User::all();
    }


}
