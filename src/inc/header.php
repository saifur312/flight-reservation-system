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

  <!-- Bootstrap css  -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- select2 css -->
  <link href="<?php echo ROOT_URL; ?>libs/select2/select2.min.css" rel="stylesheet" />
  <!-- our customized style -->
  <!-- <link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/custom-style.css"> -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- noUi slider -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css">

  <style>

  </style>

</head>