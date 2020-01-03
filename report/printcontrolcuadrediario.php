<?php
include "../core/autoload.php";
include "../core/app/model/CashRegisterData.php";
include "../core/app/model/PaymentTypeData.php";
include "../core/app/model/Util.php";
// include "../core/app/model/StatusData.php";
// include "../core/app/model/PaymentData.php";
require_once '../PHPWord/bootstrap.php';
//session_start();

//require_once '../PhpWord/Autoloader.php';

//use PhpOffice\PhpWord\Autoloader;
//use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

//Autoloader::register();

$word = new  PhpOffice\PhpWord\PhpWord();

if (isset($_GET['id'])) {
	$id_cashregister = $_GET['id'];
	$cr = CashRegisterData::getById($id_cashregister);
	$result = PaymentTypeData::getAllCashRegister($cr->id);
	$radicado = $cr->radicado;
	$cuentaanticipos = $cr->cuentaanticipos;
	$cuentanotaria = $cr->cuentanotaria;
	$cuentaunicanotarial = $cr->cuentaunicanotarial;
	$cuentaapropiacion = $cr->cuentaapropiacion;
	$diferencias = $cr->diferencias;
	$totalpagos = $cr->totalpagos;
	$cajaauxuliar = $cr->cajaauxuliar;
	$cajaprincipal = $cr->cajaprincipal;
	$caja1erpiso = $cr->caja1erpiso;
	$created_at = $cr->created_at;
	$totalMount = 0.00;
	$totalMountAccount1 = 0.00;
	$totalMountAccount2 = 0.00;
	$totalMountAccount3 = 0.00;
	$totalMountAccount1Efectivo = 0.00;
	$totalMountAccount1Voucher = 0.00;
	$totalMountAccount1Cheque = 0.00;
	$totalMountAccount1Transferencia = 0.00;
	$totalMountAccount1Gastos = 0.00;
	$totalMountAccount1Cartera = 0.00;
	$totalMountAccount1Devoluciones = 0.00;
	$totalMountAccount1Consignaciones = 0.00;
	$totalMountAccount2Efectivo = 0.00;
	$totalMountAccount2Voucher = 0.00;
	$totalMountAccount2Cheque = 0.00;
	$totalMountAccount2Transferencia = 0.00;
	$totalMountAccount2Gastos = 0.00;
	$totalMountAccount2Cartera = 0.00;
	$totalMountAccount2Devoluciones = 0.00;
	$totalMountAccount2Consignaciones = 0.00;
	$totalMountAccount3Efectivo = 0.00;
	$totalMountAccount3Voucher = 0.00;
	$totalMountAccount3Cheque = 0.00;
	$totalMountAccount3Transferencia = 0.00;
	$totalMountAccount3Gastos = 0.00;
	$totalMountAccount3Cartera = 0.00;
	$totalMountAccount3Devoluciones = 0.00;
	$totalMountAccount3Consignaciones = 0.00;
}
$display_number = 1;
// 1. Basic table
$section = $word->addSection();
$header = array('size' => 12, 'bold' => true);
$rows = 10;
$cols = 5;
$section->addText('PLANILLA CONTROL CUADRE DIARIO: ' . $created_at . ' del radicado: ' . $radicado, $header);
$fancyTableStyleName = 'Fancy Table';
$fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50);
$fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$fancyTableCellStyle = array('valign' => 'center');
$fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fancyTableFontStyle = array('bold' => true);
$word->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
$table = $section->addTable($fancyTableStyleName);
$table->addRow();
$table->addCell()->addText("Cuenta notarial (1837)");
$table->addCell()->addText("");
$table->addCell()->addText("Ingreso cuadre según (SIGNO): " . Util::toDot($cuentaanticipos + $cuentanotaria));

$table->addRow();
$table->addCell()->addText("Tipo transacción");
$table->addCell()->addText("Núm. transacción");
$table->addCell()->addText("Monto");

foreach ($result as $key => $value) {
	if ($value->id_bankaccounts == 1) {
		$table->addRow();
		$table->addCell()->addText($value->tipo);
		$table->addCell()->addText(($value->id_tipo == 0) ? "-" : $value->id_tipo);
		$table->addCell()->addText(Util::toDot($value->mount));
	}
	switch (true):
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Efectivo'):
			$totalMountAccount1Efectivo += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Voucher'):
			$totalMountAccount1Voucher += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Cheque'):
			$totalMountAccount1Cheque += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Transferencia'):
			$totalMountAccount1Transferencia += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Gastos'):
			$totalMountAccount1Gastos += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Cartera'):
			$totalMountAccount1Cartera += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Devoluciones'):
			$totalMountAccount1Devolociones += $value->mount;
			break;
		case ($value->id_bankaccounts == 1) && ($value->tipo == 'Consignaciones'):
			$totalMountAccount1Consignaciones += $value->mount;
			break;
	endswitch;
}
$totalMountAccount1 = $totalMountAccount1Efectivo + $totalMountAccount1Voucher + $totalMountAccount1Cheque + $totalMountAccount1Transferencia + $totalMountAccount1Gastos + $totalMountAccount1Cartera + $totalMountAccount1Devoluciones + $totalMountAccount1Consignaciones;



$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Efectivo A*:");
$table->addCell()->addText(Util::toDot($totalMountAccount1Efectivo));
$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Total ingreso:");
$table->addCell()->addText(Util::toDot($totalMountAccount1));
$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Diferecia:");
$table->addCell()->addText(Util::toDot($totalMountAccount1 - ($cuentaanticipos + $cuentanotaria)));
//Table two

$section->addTextBreak(2);
$table = $section->addTable($fancyTableStyleName);
$table->addRow();
$table->addCell()->addText("Cuenta unica notarial (1938)");
$table->addCell()->addText("");
$table->addCell()->addText("Ingreso según cuadre (SIGNO): " . Util::toDot($cuentaunicanotarial));

$table->addRow();
$table->addCell()->addText("Tipo transacción");
$table->addCell()->addText("Núm. transacción");
$table->addCell()->addText("Monto");

foreach ($result as $key => $value) {
	if ($value->id_bankaccounts == 2) {
		$table->addRow();
		$table->addCell()->addText($value->tipo);
		$table->addCell()->addText(($value->id_tipo == 0) ? "-" : $value->id_tipo);
		$table->addCell()->addText(Util::toDot($value->mount));
	}
	switch (true):
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Efectivo'):
			$totalMountAccount2Efectivo += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Voucher'):
			$totalMountAccount2Voucher += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Cheque'):
			$totalMountAccount2Cheque += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Transferencia'):
			$totalMountAccount2Transferencia += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Gastos'):
			$totalMountAccount2Gastos += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Cartera'):
			$totalMountAccount2Cartera += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Devoluciones'):
			$totalMountAccount2Devolociones += $value->mount;
			break;
		case ($value->id_bankaccounts == 2) && ($value->tipo == 'Consignaciones'):
			$totalMountAccount2Consignaciones += $value->mount;
			break;
	endswitch;
}
$totalMountAccount2 = $totalMountAccount2Efectivo + $totalMountAccount2Voucher + $totalMountAccount2Cheque + $totalMountAccount2Transferencia + $totalMountAccount2Gastos + $totalMountAccount2Cartera + $totalMountAccount2Devoluciones + $totalMountAccount2Consignaciones;

$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Efectivo B*:");
$table->addCell()->addText(Util::toDot($totalMountAccount2Efectivo));
$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Total ingreso:");
$table->addCell()->addText(Util::toDot($totalMountAccount2));
$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Diferencia:");
$table->addCell()->addText(Util::toDot($totalMountAccount2 - $cuentaunicanotarial));

//Table three

$section->addTextBreak(2);
$table = $section->addTable($fancyTableStyleName);
$table->addRow();
$table->addCell()->addText("Cuenta apropiación (3426)");
$table->addCell()->addText("");
$table->addCell()->addText("Ingreso según cuadre (SIGNO): " . Util::toDot($cuentaapropiacion));

$table->addRow();
$table->addCell()->addText("Tipo transacción");
$table->addCell()->addText("Núm. transacción");
$table->addCell()->addText("Monto");

foreach ($result as $key => $value) {
	if ($value->id_bankaccounts == 3) {
		$table->addRow();
		$table->addCell()->addText($value->tipo);
		$table->addCell()->addText(($value->id_tipo == 0) ? "-" : $value->id_tipo);
		$table->addCell()->addText(Util::toDot($value->mount));
	}
	switch (true):
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Efectivo'):
			$totalMountAccount2Efectivo += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Voucher'):
			$totalMountAccount3Voucher += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Cheque'):
			$totalMountAccount3Cheque += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Transferencia'):
			$totalMountAccount3Transferencia += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Gastos'):
			$totalMountAccount3Gastos += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Cartera'):
			$totalMountAccount3Cartera += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Devoluciones'):
			$totalMountAccount3Devolociones += $value->mount;
			break;
		case ($value->id_bankaccounts == 3) && ($value->tipo == 'Consignaciones'):
			$totalMountAccount3Consignaciones += $value->mount;
			break;
	endswitch;
}
$totalMountAccount3 = $totalMountAccount3Efectivo + $totalMountAccount3Voucher + $totalMountAccount3Cheque + $totalMountAccount3Transferencia + $totalMountAccount3Gastos + $totalMountAccount3Cartera + $totalMountAccount3Devoluciones + $totalMountAccount3Consignaciones;

$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Efectivo B*:");
$table->addCell()->addText(Util::toDot($totalMountAccount3Efectivo));
$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Total ingreso:");
$table->addCell()->addText(Util::toDot($totalMountAccount3));
$table->addRow();
$table->addCell()->addText("");
$table->addCell()->addText("Diferencia:");
$table->addCell()->addText(Util::toDot($totalMountAccount3 - $cuentaapropiacion));
//Resumen
$section->addTextBreak(2);
$table = $section->addTable($fancyTableStyleName);
$table->addRow();
$table->addCell()->addText("Total efectivo reflejado en arqueos");
$table->addRow();
$table->addCell()->addText("C) Cajero auxiliar");
$table->addCell()->addText(Util::toDot($cajaauxuliar));
$table->addRow();
$table->addCell()->addText("D) Cajero principal");
$table->addCell()->addText(Util::toDot($cajaprincipal));
$table->addRow();
$table->addCell()->addText("E) Caja primer piso");
$table->addCell()->addText(Util::toDot($caja1erpiso));
$table->addRow();
$table->addCell()->addText("Sume (C+D+E) total $");
$table->addCell()->addText(Util::toDot($cajaauxuliar + $cajaprincipal + $caja1erpiso));
$table->addRow();
$table->addCell()->addText("Sume (A+B+C) efectivo total $");
$table->addCell()->addText(Util::toDot($totalMountAccount1Efectivo + $totalMountAccount2Efectivo + $totalMountAccount3Efectivo));
$section->addTextBreak(1);
$section->addText('(1)SIEMPRE DEBE DAR CERO, EN CASO CONTRARIO INDIQUE VALOR.');
$section->addText('(+) Ó (-) IMPLICA TRASLADAR MEDIANTE CHEQUE ENTRE LAS CUENTAS PARA CUADRAR. GIRE CHEQUE CUENTA CON (+)');
$section->addText('(*)VAUCHER(S): SI LAS CASILLAS NO LE ALCANZAN AGRUPELAS DE MENOR VALOR EN LA CASILLA ANTES DEL EFECTIVO.');

$filename = "report-" . time() . ".docx";
#$word->setReadDataOnly(true);
$word->save($filename, "Word2007");
//chmod($filename,0444);
header("Content-Disposition: attachment; filename=$filename");
readfile($filename); // or echo file_get_contents($filename);
unlink($filename);  // remove temp file