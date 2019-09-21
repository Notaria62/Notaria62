<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");
//echo $_POST['mail'].Session::getUID();
if (Session::getUID()=="") {
    $user = Util::remove_junk($_POST['mail']);
    $pass = Util::remove_junk(sha1(md5($_POST['password'])));

    $base = new Database();
    $con = $base->connect();
    $sql = "select * from users where (email= \"".$user."\" or username= \"".$user."\") and password= \"".$pass."\" and is_active=1";
    //print $sql;
    $query = $con->query($sql);
    $found = false;
    $userid = null;
    $name = null;

    while ($r = $query->fetch_array()) {
        $found = true ;
        $userid = $r['id'];
        $name = $r['name'];
    }
    $con->close();
    if ($found==true) {
        //	print $userid;
        $_SESSION['user_id']=$userid ;
        setcookie('userid', $userid);
        //	print $_SESSION['userid'];
        UserData::updateLastLogIn($userid);
        Session::msg("s", "Welcome back... <b>$name</b>");
        print "Cargando ... $user";
        Core::redir("./?view=home");
    } else {
        setcookie("loginInvalid", "true");
        Core::redir("./?view=login");
    }
} else {
    Session::msg("s", "Welcome back... <b>$name</b>");
    Core::redir("./?view=home");
}
 //Session::msg("d", "Usuerio y/o contraseña errónea");
