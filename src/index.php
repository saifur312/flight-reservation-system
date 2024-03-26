<?php

//include __DIR__ . '/inc/header.php';

include "./inc/header.php";
//include __DIR__ . "/service/Session.php";
//Session::init();
//Session::checkSession();

$loginmsg = Session::get('loginmsg');
$username = Session::get('username');
if (isset($loginmsg)) {
  echo $loginmsg;
}
Session::set('loginmsg', NULL);

echo "<h2>Welcome $username </h2>";

include "./inc/footer.php";
