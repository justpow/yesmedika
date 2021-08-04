<?php

    function render_head_with_title($title = 'YES! Medika')
    {
        echo '
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="'.base_url('assets/font-awesome-5.15.3/css/all.min.css').'" rel="stylesheet">
                <link href="'.base_url('assets/bootstrap-5.0.0/css/bootstrap.min.css').'" rel="stylesheet">
                <link rel="stylesheet" href="'.base_url('assets/bootstrap-5.0.0/css/bootstrap-icons.css').'">
                <link rel="stylesheet" href="'.base_url('assets/style.css').'">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
                <link rel="stylesheet" href="'.base_url('assets/owl-carousel/dist/assets/owl.carousel.min.css').'">
                <link rel="stylesheet" href="'.base_url('assets/owl-carousel/dist/assets/owl.theme.default.min.css').'">
                <script src="'.base_url('assets/swal/sweetalert2.all.min.js').'"></script>
                <title>'.$title.'</title>
            </head>
        ';
    }