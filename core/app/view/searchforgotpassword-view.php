<?php

/**
 * search_action short summary.
 *
 * searchescrituras_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
$flag = "";
$userId = "";
if (count($_POST) > 0) {
    if ($_POST['value1'] != "" and $_POST['value2'] != "" and $_POST['value3'] != ""  and $_POST['getBy'] == "password") {
        # code...
        $result = UserData::getByccAndEmail($_POST['value1'], $_POST['value2']);
        if (count($result)) {
            $userId = $result->id;
            $result->password = sha1(md5($_POST["value3"]));
            $result->update_passwd();
            setcookie("password_updated", "true");

            $flag = "ok";
        } else {
            $flag = "empty";
        }
    } else {
        if ($_POST['value1'] != "" and $_POST['value2'] != "" and $_POST['getBy'] == "email") {
            # code...
            $result = UserData::getByccAndEmail($_POST['value1'], $_POST['value2']);
            if (count($result)) {
                $userId = $result->id;
                $flag = "ok";
            } else {
                $flag = "empty";
            }
        } else {
            if ($_POST['value1'] != "" and $_POST['getBy'] == "cc") {
                # code...
                $result = UserData::getBycc($_POST['value1']);
                if (count($result)) {
                    $flag = "ok";
                } else {
                    $flag = "empty";
                }
            }
        }
    }


    // if (mysql_num_rows($result) == 0) {
    // echo json_encode($ar);
}

echo $flag;