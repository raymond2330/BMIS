<?php

return [
    'activated'        => true, // active/inactive all logging
    // 'middleware'       => ['web', 'auth'],
    'middleware'       => ['web', 'useractivity'],
    'route_path'       => 'admin-panel/user-activity',
    'admin_panel_path' => 'dashboard',
    'delete_limit'     => 1, // default 7 days

    'model' => [
        'user' => "App\Models\User",
        'link' => "App\Models\Link",
        'announcement' => "App\Models\Announcement",
        'video' => "App\Models\Video",
        'household' => "App\Models\Household",
        'resident' => "App\Models\Resident",
        'certificate' => "App\Models\Certificate"
    ],

    'log_events' => [
        'on_create'     => true,
        'on_edit'       => true,
        'on_delete'     => true,
        'on_login'      => true,
        'on_lockout'    => true
    ]
];
