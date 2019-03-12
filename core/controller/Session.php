<?php
session_start();

/**
* 1 de agosto del 2013
* Esta funcion contiene el nombre de los identificadores que se usaran como variables de session
* y tambien los setters y getters correspondientes.
**/

class Session
{
    public static $msg;
    public function __construct()
    {
        self::flash_msg();
    }
    public static function setUID($uid)
    {
        $_SESSION['user_id'] = $uid;
    }
    public static function setUserIsActive($uid)
    {
        $_SESSION['userIsActive'] = $uid;
    }
    public static function issetUserIsActive()
    {
        if (isset($_SESSION['userIsActive'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function unsetUID()
    {
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
    }

    public static function issetUID()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUID()
    {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        } else {
            return false;
        }
    }
    public static function getLogin()
    {
        //$u=null;
        if (!isset($_SESSION["user_id"])) {
            //$u = UserData::getById($_SESSION["user_id"]);
            //$fullname = $u->name." ".$u->lastname;
            //echo $fullname;
            //$_SESSION['userIsActive'] = false;
            Core::redir("./");
        }
    }
    
    public static function msg($type ='', $msg ='')
    {
        if (!empty($msg)) {
            if (strlen(trim($type)) == 1) {
                $type = str_replace(array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type);
            }
            $_SESSION['msg'][$type] = $msg;
        } else {
            return self::$msg;
        }
    }
    private function flash_msg()
    {
        if (isset($_SESSION['msg'])) {
            self::$msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
        } else {
            self::$msg;
        }
    }

    public static function currentURL()
    {
        $uri= $_SERVER["REQUEST_URI"];
        $user = Util::current_user();
        $ugcm = Util::getUrlGropus($user->user_level);
        $flag = false;
        foreach ($ugcm as $value) {
            //echo $value->url;
            $urlDB= substr($value->url, 1);
            if (false !== strpos($uri, $urlDB)) {
                //echo " -".$urlDB."- ";
                //echo ' #Acepted# ';
                $flag = true;
                break;
            }
        }
        if (false === strpos($uri, '/?view=home')) {
            if (!$flag) {
                Session::msg("d", "No tiene permiso para ver esa pagina por favor contactar al administrador del sistema...");
                Core::redir("./?view=home");
            }
        }
    }
}
 $session = new Session();
 $msg = $session->msg();