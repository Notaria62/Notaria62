<?php
$msg ="";
if (count($_POST)>0) {
    $target_dir = "PHPWord/resources/";
    
    if (isset($_FILES['fileToUpload'])) {
        $errors= array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $temp = explode('.', $file_name);
        $file_ext= strtolower(end($temp));
      
        $expensions= array("jpeg","jpg","png","docx", "doc");
      
        if (in_array($file_ext, $expensions)=== false) {
            $errors[]= "Extension no permitida.";
        }
        //   if ($file_size > 2097152) {
        //       $errors[]='File size must be excately 2 MB';
        //   }
        if (empty($errors)==true) {
            move_uploaded_file($file_tmp, $target_dir.$file_name);
            $msg= "Cargo bien el archivo ".$file_name;
        } else {
            $msg=$errors;
        }
    }
    Session::msg("s", $msg);

    Core::redir("./?view=admintemplates");
} else {
    Session::msg("d", $msg);

    Core::redir("./?view=admintemplates");
}
