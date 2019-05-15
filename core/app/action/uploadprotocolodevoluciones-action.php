<?php

/**
 * updalodprocedure_action short summary.
 *
 * updalodprocedure_action description.
 *
 * @version 1.0
 * @author sistemas
 */

if (isset($_POST['submit'])) {
    $proc = new ProtocoloDevolucionesData();
    $proc->user_id = Session::getUID();
    $filename = $_FILES["uploadedfile"]["tmp_name"];
    $file_CSV = fopen($filename, "r");
    while (($CSV_row_Data = fgetcsv($file_CSV, 1000, ",")) !== FALSE) {
        $proc->upload($CSV_row_Data[0], $CSV_row_Data[1], $CSV_row_Data[2], $CSV_row_Data[3], $CSV_row_Data[4], $CSV_row_Data[5], $CSV_row_Data[6], $CSV_row_Data[7]);
    }

    fclose($file_CSV);

    Core::alert("Successfully Imported a CSV File for User!. ");
    print "<script>window.location='./?view=protocolodevoluciones';</script>";
}