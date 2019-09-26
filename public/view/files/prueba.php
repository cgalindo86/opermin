<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>CAJA CHICA</title>
</head>
<body>
<h1>CAJA CHICA</h1>
<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
$archivo = "libro1.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

$dat = '<center><table><tr><td>Fecha Emision</td><td>Producto</td><td>Importe</td></tr>';

for ($row = 2; $row <= $highestRow; $row++){ 
    $dat = $dat.'<tr><td>'.$sheet->getCell("A".$row)->getValue().'</td>';
    $dat = $dat.'<td>'.$sheet->getCell("B".$row)->getValue().'</td>';
    $dat = $dat.'<td>'.$sheet->getCell("C".$row)->getValue().'</td></tr>';
}

$dat = $dat.'</table></center>';

echo $dat;
?>
</body>
</html>