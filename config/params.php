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
            'datatables' => [
                'css' => ['datatables-bs4/css/dataTables.bootstrap4.min.css', 'datatables-responsive/css/responsive.bootstrap4.min.css', 'datatables-buttons/css/buttons.bootstrap4.min.css'],
                'js' => ['datatables/jquery.dataTables.min.js', 'datatables-bs4/js/dataTables.bootstrap4.min.js', 'datatables-responsive/js/dataTables.responsive.min.js', 'datatables-responsive/js/responsive.bootstrap4.min.js', 'datatables-buttons/js/dataTables.buttons.min.js', 'datatables-buttons/js/buttons.bootstrap4.min.js', 'jszip/jszip.min.js', 'pdfmake/pdfmake.min.js', 'pdfmake/vfs_fonts.js', 'datatables-buttons/js/buttons.html5.min.js', 'plugins/datatables-buttons/js/buttons.print.min.js', 'datatables-buttons/js/buttons.colVis.min.js']
            ]
        ]
    ]
];
