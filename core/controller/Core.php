<?php


// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.
// actualizado [11-Aug-2016]
class Core
{
    public static $theme = "";
    public static $root = "";

    public static $user = null;
    public static $debug_sql = false;
    //Syntactical errors or parse errors are generally caused by a typo in your code.
    public static $debug_syntactical = false;

    public static function debugPHP()
    {
        if (Core::$debug_syntactical) {
            ini_set('display_errors', 'On');
            error_reporting(E_ALL);
        }
    }
    public static function includeCSS()
    {
        $path = "res/css/";
        $handle=opendir($path);
        if ($handle) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry!="." && $entry!="..") {
                    $fullpath = $path.$entry;
                    if (!is_dir($fullpath)) {
                        echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";
                    }
                }
            }
            closedir($handle);
        }
    }

    public static function alert($text)
    {
        echo "<script>alert('".$text."');</script>";
    }
    /*--------------------------------------------------------------*/
    /* Function for redirect
    /*--------------------------------------------------------------*/
    public static function redir($url, $permanent = false)
    {
        if (headers_sent() === false) {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }
        exit();
    }


    public static function includeJS()
    {
        $path = "res/js/";
        $handle=opendir($path);
        if ($handle) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry!="." && $entry!="..") {
                    $fullpath = $path.$entry;
                    if (!is_dir($fullpath)) {
                        echo "<script type='text/javascript' src='".$fullpath."'></script>";
                    }
                }
            }
            closedir($handle);
        }
    }
}
