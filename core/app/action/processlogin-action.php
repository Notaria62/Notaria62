<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if (!isset($_SESSION["user_id"])) {
    $b = $_POST['username'];
    $pass = sha1(md5($_POST['password']));

    $base = new Database();
    $con = $base->connect();
    $sql = "select * from user where (email= \"".$b."\" or username= \"".$b."\") and password= \"".$pass."\" and is_active=1";
    //print $sql;
    $query = $con->query($sql);
    $found = false;
    $userid = null;
    while ($r = $query->fetch_array()) {
        $found = true ;
        $userid = $r['id'];
    }
    $con->close();
    if ($found==true) {
        //	session_start();
        //	print $userid;
        $_SESSION['user_id']=$userid ;
        //	setcookie('userid',$userid);
        //	print $_SESSION['userid'];
        print "Cargando ... $b";
        print "<script>window.location='index.php?view=home';</script>";
    } else {
        print "<script>window.location='index.php?view=login';</script>";
    }
} else {
    print "<script>window.location='index.php?view=home';</script>";
}