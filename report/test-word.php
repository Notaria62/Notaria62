<?php
/**
* test_word short summary.
*
* test_word description.
*
* @version 1.0
* @author sistemas
*/
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;

$documento = new PhpOffice\PhpWord\PhpWord();
//$documento = new PhpWord();
echo "1";
    //$documento = new PhpWord();
// Nueva seccion
$seccion = $documento->addSection();
echo "hola2";
// Inline font style
// Simple text
$section->addTitle('Welcome to PhpWord', 1);
$section->addText('Hello World!');
$filename = "report-".time().".docx";
$documento->save($filename,"Word2007");
header("Content-Disposition: attachment; filename='$filename'");
readfile($filename); // or echo file_get_contents($filename);
unlink($filename);  // remove temp file
?>
