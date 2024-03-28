<?php

/** 
 * define some constants to hold credentials and configuration 
 * necessary to connect to the MySQL database.
 * this constants are global and can be accessed from any php code directly
 */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "flightciu");
/** 
 * set root manually 
 */
define("ROOT_URL", "http://localhost/flight-reservation-system/src/");

/**
 *  this code will show `htodcs` as root directory
 */
// $docRoot = $_SERVER['DOCUMENT_ROOT'];
// echo "From config.php--> root: $docRoot";

/**
 * by this code we can get the path for root folder of our files
 * C:\xampp\htdocs\flight-reservation-system/src/
 */
// $filepath = realpath(dirname(__FILE__));
// echo "From config.php--> rootPath: $filepath/src/";

/**
 * by this code we can get the uri of the file running 
 * in browser starting from root folder
 * /flight-reservation-system/src/index.php
 */
// $root_uri = $_SERVER['REQUEST_URI'];
// echo "From config.php--> root uri: $root_uri";

/**
 * with the code  below we can get the uri we want
 * in browser starting from root folder
 * http://localhost/flight-reservation-system/src/
 */

// Get the protocol (HTTP or HTTPS)
//$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

// Get the host (localhost in my case)
//$host = $_SERVER['HTTP_HOST'];

// Get the base path (flight-reservation-system)
//$base_path = dirname($_SERVER['SCRIPT_NAME']);

// Remove trailing slash if present
//$base_path = rtrim($base_path, '/');
// Find the last occurrence of your project folder name in the base path
//$project_root_index = strrpos($base_path, '/flight-reservation-system');

// Get the root URL by slicing the base path up to the project root
// $root_url = $protocol . $host . substr($base_path, 0, $project_root_index + strlen('/flight-reservation-system')) . '/';

// Construct the root URL
//$root_url = $protocol . $host . $base_path . '/';

//echo $root_url;

//set the root url as constant
//define("ROOT_URL", "$root_url/src/");

//define("ROOT_PATH", "");
// $rootpath = 