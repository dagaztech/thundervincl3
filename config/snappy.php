<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  =>  base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        'timeout' => false,
        'options' => array(
            'disable-external-links' => true,
            'enable-local-file-access' => true,
            'enable-internal-links' => true
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  =>  base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
