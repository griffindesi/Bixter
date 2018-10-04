<?php

/*
* This File Made By Abdulrahman Mardini
* In This File Will SEPARAT Url Containe (Controller,Action,Prams)
* And Will Include First File Bootstrap.php (This File Just Auto load Not Bootstrap Framework)
* DS Pram IS DIRECTORY_SEPARATOR
* ROOT Is The Local File
*/

  define('DS',DIRECTORY_SEPARATOR);
  define('ROOT',dirname(__FILE__) );

  // load config and helper functions

  require_once(ROOT . DS . 'config' . DS . 'config.php');
  require_once(ROOT . DS . 'App' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

// Autoload classes

  function Autoload ($className){
          if (file_exists(ROOT . DS . 'core' .DS . $className . '.php')) {
            require_once (ROOT . DS . 'core' .DS . $className . '.php');
          }elseif (file_exists(ROOT . DS . 'App' .DS . 'controllers' .DS . $className . '.php')) {
            require_once (ROOT . DS . 'App' .DS . 'controllers' .DS . $className . '.php');
          }elseif (file_exists(ROOT . DS . 'App' .DS . 'models' .DS . $className . '.php')) {
            require_once (ROOT . DS . 'App' .DS . 'models' .DS . $className . '.php');
          }
        };
        spl_autoload_register('Autoload');
        session_start();

    $url = isset($_SERVER['PATH_INFO'])? explode('/',ltrim($_SERVER['PATH_INFO'],'/')) : [];
    

            // Route request
            Router::route($url);
