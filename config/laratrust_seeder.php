<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'user' => 'c,r,u,d',
            'brand' => 'c,r,u,d',
            'unit' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'subcategory' => 'c,r,u,d',
            'product' => 'c,r,u,d',
            'slider' => 'c,r,u,d',
            'notice' => 'c,r,u,d',
            'termsandcondition' => 'c,r,u,d',
            'sitesetting' => 'c,r,u,d',
            'attribute' => 'c,r,u,d',
            'shipping' => 'c,r,u,d',
            'gallery' => 'c,r,u,d',
            'client' => 'c,r,u,d',
        ],
        
        'user' => [
            'user' => 'c,r,u,d',
        ],
        'vendor' => [
            'user' => 'c,r,u,d',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
