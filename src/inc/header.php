<?php

include_once __DIR__ . '../../../config.php';
include_once __DIR__ . '/../service/Session.php';
Session::init();

/* session logout */
if (isset($_GET['action']) && $_GET['action'] == "logout") {
  Session::destroy();
}

/*  get login info and username */
$login = Session::get('login');
$username = Session::get('username');
$userId = Session::get('id');

/* declare root_url as var to use it inside heredoc syntax; */
$root_url = ROOT_URL;
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Reservation System</title>

  <!-- Google fonts  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet" /> -->

  <!-- Bootstrap css  -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap icons  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- sidebar style -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>libs/codepen/sidebar.css">

  <!-- select2 css -->
  <link href="<?php echo ROOT_URL; ?>libs/select2/select2.min.css" rel="stylesheet" />

  <!-- our customized style -->
  <!-- <link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/custom-style.css"> -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/styles.css">

  <!-- noUi slider -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css">

  <style>

  </style>

</head>