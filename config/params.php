<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'hail812/yii2-adminlte3' => [
        'pluginMap' => [
            'daterangepicker' => [
                'js' => 'daterangepicker/daterangepicker.js',
            ],
            'jquery-validation' => [
                'js' => ['jquery-validation/jquery.validate.min.js', 'jquery-validation/additional-methods.min.js'],
            ],
            'sweetalert2' => [
                'css' => 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'js' => 'sweetalert2/sweetalert2.min.js'
            ],
            'toastr' => [
                'css' => ['toastr/toastr.min.css'],
                'js' => ['toastr/toastr.min.js']
            ],
            'my-script' => [
                'js' => ['my-script/alert-new.js']
            ],
        ]
    ]
];
