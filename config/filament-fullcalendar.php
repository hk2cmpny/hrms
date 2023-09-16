<?php

/**
 * Consider this file the root configuration object for FullCalendar.
 * Any configuration added here, will be added to the calendar.
 * @see https://fullcalendar.io/docs#toc
 */

return [
    'timeZone' => config('app.timezone'),

    'locale' => config('app.locale'),

    'headerToolbar' => [
        'left' => 'prev,next today',
        'center' => 'title',
        'right' => 'dayGridMonth,dayGridWeek,dayGridDay',
    ],

    'holiday' => [
        'color' => '#0c7f00',
        'text' => "Holidays"
    ],

    'leaves_requested' => [
        'color' => '#ff8318',
        'text' => "Pending Leaves"
    ],

    'leaves' => [
        'color' => '#3560ff',
        'text' => "Approved Leaves"
    ],

    'navLinks' => true,

    'editable' => false,

    'selectable' => false,

    'dayMaxEvents' => true,
];
