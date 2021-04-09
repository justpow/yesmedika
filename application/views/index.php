<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/bootstrap-5.0.0/css/bootstrap.min.css') ?>" rel="stylesheet">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1 class="hello">Hello, world!</h1>
    <script src="<?= base_url('assets/bootstrap-5.0.0/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/jquery-v3.6.0/jquery.min.js') ?>"></script>
  </body>
  <script>
	$( document ).ready(() => {
    	console.log($('.hello').html())
	});
  </script>
</html>