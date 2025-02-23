<?php

namespace Framework;

class Session{
/**
 * Start the session
 * 
 * @return void
 */

 public static function start(){
    if(session_status() ==PHP_SESSION_NONE){
        session_start();
    }
 }

 /**
  * Set a session key/value pair
*
  *@param string $key
   *@param mixed $value
   *@return void
  */

  public static function set($key, $value){
$_SESSION[$key] = $value;
  }


/**
 * Get a session value by key
 * @params string $key
 * @params mixed $default
 * @return mixed
 */

 public static function get($key, $default = null){
    return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;

 }

 /**
  * check if the session key exists
  *@params string $key
  *@return bool
  */

  public static function has($key){
      return isset($_SESSION[$key]);
  }

/**
 * Clear the session by the key
 * 
 * @params string $key
 * @return void
 */

 public static function clear($key){
    if(isset($_SESSION[$key])){
         unset($_SESSION[$key]);
    }
 }

 /**
  * Clear all session data
  *@return void
  */
  
  public static function clearAll(){
    session_unset();
    session_destroy();
  }
}