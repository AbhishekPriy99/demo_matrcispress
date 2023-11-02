<?php

return [
    'THEME_ASSETS' => [
        'global' => [
            'css' => [
                'assets/compiled/css/app.css',
                'assets/compiled/css/app-dark.css',
                'assets/compiled/css/iconly.css',
                'assets/extensions/@fortawesome/fontawesome-free/css/all.min.css',
                'assets/extensions/sweetalert2/sweetalert2.min.css',
            ],

            'js' => [
                'assets/static/js/components/dark.js',
                'assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js',
                'assets/compiled/js/app.js',
                'assets/extensions/sweetalert2/sweetalert2.all.min.js',
                'assets/compiled/js/maticpress.js',
            ],
        ],
    ],

    # Theme Vendors
    'THEME_VENDORS' => [
        'datatable' => [
            'css' => [
                'assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
            ],
            'js' => [
                'assets/extensions/datatables.net/js/jquery.dataTables.min.js',
                'assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js',

            ],
        ],
        'website-settings' => [
            'css' => [
                'assets/compiled/css/website-settings.css',
            ],
            'js' => [
                'assets/compiled/js/website-settings.js',
            ],
        ],
        'quill-editor' => [
            'css' => [
                'assets/extensions/quill/quill.snow.css',
                'assets/extensions/quill/quill.bubble.css'
            ],
            'js' => [
                'assets/extensions/quill/quill.min.js'
            ]
        ]
    ],

];
