<?php if (!defined("IN_WALLET")) {
	die("Auth Error!");
} ?>
<!DOCTYPE HTML>

<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap include stuff -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/wallet.css" rel="stylesheet">
	<link href="assets/css/languages.min.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- End Bootstrap include stuff-->
	<title><?= $fullname ?> Wallet</title>
	<link rel="shortcut icon" href="assets/img/favicon.ico">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>


<body>