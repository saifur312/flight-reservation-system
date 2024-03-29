<?php
class Session
{
  public static function init()
  {
    if (version_compare(phpversion(), '5.4.0', '<')) {
      if (session_id() == '') {
        session_start();
      }
    } else {
      if (session_status() == PHP_SESSION_NONE)
        session_start();
    }
  }

  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get($key)
  {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    } else {
      return false;
    }
  }

  public static function destroy()
  {
    session_destroy();
    session_unset();
    header("Location: " . ROOT_URL . "auth/login.php");
    exit();
  }

  public static function checkSession()
  {
    if (self::get('login')) {
      header("Location: " . ROOT_URL . "index.php");
    } else {
      self::destroy();
      header("Location: " . ROOT_URL . "auth/login.php");
    }
  }

  // public static function checkSession()
  // {
  //   if (!self::get('login')) {
  //     self::destroy();
  //     // header("Location: " . ROOT_URL . "auth/login.php");
  //     // exit();
  //   }
  // }
}
