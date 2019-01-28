<?php

/**
 * updalodprocedure_action short summary.
 *
 * updalodprocedure_action description.
 *
 * @version 1.0
 * @author sistemas
 */

if (isset($_POST['submit']))
{
    $proc = new ProcedureData();
    $proc->user_id=Session::getUID();
    $filename=$_FILES["uploadedfile"]["tmp_name"];

	$file_CSV = fopen($filename, "r");
	while (($CSV_row_Data = fgetcsv($file_CSV, 1000, ",")) !== FALSE)
    {
        //echo $CSV_row_Data[2];
        if ($CSV_row_Data[2]!="")
        {
        	$proc->upload($CSV_row_Data[0], $CSV_row_Data[1], $CSV_row_Data[2],$CSV_row_Data[3],$CSV_row_Data[4],$CSV_row_Data[5]);
        }


        //        mysql_query("INSERT into user (user_name, first_name, last_name, date_added)
        //values('$CSV_row_Data[0]', '$CSV_row_Data[1]', '$CSV_row_Data[2]', NOW())");
    }

	fclose($file_CSV);

	// print "Import done";

	//echo "<script type='text/javascript'>alert('Successfully Imported a CSV File for User!');</script>";
	//echo "<script>document.location='./?view=notarialprocedure'</script>";

    Core::alert("Successfully Imported a CSV File for User!. ");
    print "<script>window.location='./?view=notarialprocedure';</script>";

	// view upload form

}

?>
