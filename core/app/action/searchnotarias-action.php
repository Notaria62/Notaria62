<?php

/**
 * searchnotaria_action short summary.
 *
 * searchnotaria_action description.
 *
 * @version 1.0
 * @author sistemas
 */
//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['term'])) {
    $query = $_REQUEST['term'];
    $return_arr = array();
    try
    {

        $sql = NotariasData::getLike($query);
        foreach ($sql as $value)
        {
            $return_arr[] =  $value->name;
        }
    }
    catch (Exception $exception)
    {
        echo 'ERROR: ' . $exception->getMessage();
    }
    //RETURN JSON ARRAY
    echo json_encode ($return_arr);
}

?>