<?php

    function render_head_with_title($title = 'YES! Medika')
    {
        echo '
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="'.base_url('assets/font-awesome-5.15.2/all.min.css').'" rel="stylesheet">
                <link href="'.base_url('assets/bootstrap-5.0.0/css/bootstrap.min.css').'" rel="stylesheet">
                <link rel="stylesheet" href="'.base_url('assets/bootstrap-5.0.0/css/bootstrap-icons.css').'">
                <link rel="stylesheet" href="'.base_url('assets/style.css').'">
                <title>'.$title.'</title>
            </head>
        ';
    }