<?php

// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1); 


ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 0);

// ini_set('session.gc_maxlifetime', 60 * 60); // expires in 60 minutes on server side
// ini_set('session.cookie_lifetime', 60 * 60); // expires in 60 minutes on user side


session_start();
header('Cache-control: private'); // IE 6 FIX
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");

define("WITHDRAWALS_ENABLED", true); //Disable withdrawals during maintenance

include('jsonRPCClient.php');
include('classes/Client.php');
include('classes/User.php');

// function by zelles to modify the number to bitcoin format ex. 0.00120000
function satoshitize($satoshitize)
{
   return sprintf("%.8f", $satoshitize);
}

// function by zelles to trim trailing zeroes and decimal if need
function satoshitrim($satoshitrim)
{
   return rtrim(rtrim($satoshitrim, "0"), ".");
}

require('settings.php');

if (isset($_GET['lang'])) {
   $lang = $_GET['lang'];

   // register the session and set the cookie
   $_SESSION['lang'] = $lang;

   setcookie('lang', $lang, time() + (3600 * 24 * 30), NULL, NULL, TRUE, TRUE);
} else if (isset($_SESSION['lang'])) {
   $lang = $_SESSION['lang'];
} else if (isset($_COOKIE['lang'])) {
   $lang = $_COOKIE['lang'];
} else {
   $lang = 'en';
}

switch ($lang) {
   case 'en':
      $lang_file = 'lang.en.php';
      break;

      // case 'grc':
      //    $lang_file = 'lang.grc.php';
      //    break;


   default:
      $lang_file = 'lang.en.php';
}

include_once 'languages/' . $lang_file;

error_reporting(0);
