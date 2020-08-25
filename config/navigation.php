<?php

return [
    [
        'id' => 1, 
        'route' => '', 
        'name' => 'Web', 
        'icon' => 'fas fa-globe-europe', 
        'child' => [
            ['id' => 2, 'route' => '/admin/content', 'name' => 'Texty'],
            //['id' => 3, 'route' => '/admin/navigation', 'name' => 'Navigace'],
            //['id' => 4, 'route' => '/admin/course', 'name' => 'Kurzy'],
            ['id' => 10, 'route' => '/admin/message', 'name' => 'Zprávy'],
        ]
    ],   
    [
        'id' => 5, 
        'route' => '', 
        'name' => 'Nastavení', 
        'icon' => 'fas fa-cog', 
        'child' => [
            ['id' => 6, 'route' => '/admin/company', 'name' => 'Firma'],
            ['id' => 11, 'route' => '/admin/office', 'name' => 'Pobočky'],
            ['id' => 7, 'route' => '/admin/admins', 'name' => 'Administrátoři'],
            ['id' => 9, 'route' => '/admin/settings', 'name' => 'Nastavení'],
        ]
    ], 
];