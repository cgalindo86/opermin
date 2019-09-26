<?php

    /*$cliente = $_GET['nombre'];
    $correo = $_GET['correo'];
    $fechaEvento = $_GET['fecha1'];
    $fechaFinEvento = $_GET['fecha2'];
    $dia = $_GET['dia'];
    $mes = $_GET['mes'];
    $anio = $_GET['anio'];
    
    $fecha1 = explode("-",$fechaEvento);
    $fechaEvento = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
    
    $fecha2 = explode("-",$fechaFinEvento);
    $fechaFinEvento = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];*/
    
//comprobamos que sea una petici贸n ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $file = $_FILES['archivo']['name'];
    $tipo = explode(".",$file);
    
    $dir="files/";
    
    $nom_arch = $file;
        
        
    
    if(!is_dir($dir)){ 
        mkdir($dir, 0777);
    }
    
    
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$dir.$nom_arch))
    {
            
        sleep(3);
        echo "Documento subido correctamente";
    }
}else{
    throw new Exception("Error Processing Request", 1);   
}


require_once 'files/PHPExcel/Classes/PHPExcel.php';
$archivo = $dir.$nom_arch;
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(1); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();


$periodo = $sheet->getCell("E4")->getValue();

for ($row = 13; $row <= $highestRow; $row++){ 
    $d1 = $sheet->getCell("D".$row)->getValue();//tipo_doc
    $d2 = $sheet->getCell("E".$row)->getValue();//dni
    $d3 = $sheet->getCell("F".$row)->getValue();//nombre
    $d4 = $sheet->getCell("P".$row)->getValue();//centro_costos
    $d5 = $sheet->getCell("Q".$row)->getValue();//unidad
    $d6 = $sheet->getCell("R".$row)->getValue();//cargo
    $d7 = $sheet->getCell("V".$row)->getValue();//regimen
    $d8 = $sheet->getCell("W".$row)->getValue();//tipo_contrato
    $d9 = $sheet->getCell("X".$row)->getValue();//banco
    $d10 = $sheet->getCell("Y".$row)->getValue();//cuenta
    $d11 = $sheet->getCell("AE".$row)->getValue();//pensionario
    $d12 = $sheet->getCell("AF".$row)->getValue();//cuspp
    $d13 = $sheet->getCell("AI".$row)->getValue();//tipo_remuneracion
    $d14 = $sheet->getCell("AK".$row)->getValue();//movilidad
    $d15 = $sheet->getCell("AM".$row)->getValue();//refrigerio_supedi
    $d16 = $sheet->getCell("AN".$row)->getValue();//refrigerio_fijo
    $d17 = $sheet->getCell("AO".$row)->getValue();//eps
    $d18 = $sheet->getCell("AP".$row)->getValue();//sctr
    $d19 = $sheet->getCell("AQ".$row)->getValue();//asig_si_no
    $d20 = $sheet->getCell("AR".$row)->getValue();//remuneracion_basica
    $d21 = $sheet->getCell("AS".$row)->getValue();//dias_laborados
    $d22 = $sheet->getCell("AT".$row)->getValue();//descanso_medico
    $d23 = $sheet->getCell("AU".$row)->getValue();//vacaciones
    $d24 = $sheet->getCell("BK".$row)->getValue();//horas_trabajadas
    $d25 = $sheet->getCell("BM".$row)->getValue();//haber_mensual
    $d26 = $sheet->getCell("BL".$row)->getValue();//asignacion_importe
    $d27 = $sheet->getCell("BO".$row)->getValue();//vacaciones_importe
    $d28 = $sheet->getCell("CA".$row)->getValue();//comisiones
    $d29 = $sheet->getCell("CQ".$row)->getValue();//movilidad_importe
    $d30 = $sheet->getCell("CR".$row)->getValue();//refrigerio_importe
    $d31 = $sheet->getCell("DB".$row)->getValue();//bonificacion
    $d32 = $sheet->getCell("DT".$row)->getValue();//condicion
    $d33 = $sheet->getCell("EG".$row)->getValue();//base_imponible
    $d34 = $sheet->getCell("EH".$row)->getValue();//total_bruto
    $d35 = $sheet->getCell("EI".$row)->getValue();//aporte_afp
    $d36 = $sheet->getCell("EJ".$row)->getValue();//comisiones_afp
    $d37 = $sheet->getCell("EK".$row)->getValue();//prima
    $d38 = $sheet->getCell("EN".$row)->getValue();//onp
    $d39 = $sheet->getCell("EO".$row)->getValue();//renta_5ta
    $d40 = $sheet->getCell("EV".$row)->getValue();//prestamo
    $d41 = $sheet->getCell("FA".$row)->getValue();//adelantos
    $d42 = $sheet->getCell("FL".$row)->getValue();//descuento
    $d43 = $sheet->getCell("FM".$row)->getValue();//neto
    $d44 = $sheet->getCell("FO".$row)->getValue();//esslud
    //$d45 = $sheet->getCell("FO".$row)->getValue();//esslud

    Inserta($periodo,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12,$d13,$d14,$d15,$d16,$d17,$d18,$d19,$d20,$d21,$d22,$d23,$d24,$d25,$d26,$d27,$d28,$d29,$d30,$d31,$d32,$d33,$d34,$d35,$d36,$d37,$d38,$d39,$d40,$d41,$d42,$d43,$d44);
    
}


function Inserta($periodo,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12,$d13,$d14,$d15,$d16,$d17,$d18,$d19,$d20,$d21,$d22,$d23,$d24,$d25,$d26,$d27,$d28,$d29,$d30,$d31,$d32,$d33,$d34,$d35,$d36,$d37,$d38,$d39,$d40,$d41,$d42,$d43,$d44){
    $mysqli = new mysqli('localhost', 'root', '', 'opermin');
    
    $query = "SELECT * FROM boletas WHERE periodo='$periodo' AND dni='$d2' ";
    mysqli_set_charset($mysqli, 'utf8'); 
    $result = mysqli_query($mysqli, $query);
    $dat="";
    while ($row = $result->fetch_array()){
    	$dat = $row['id'];
    }
    
    //echo $dat."#";
    
    if($dat==""){
        $sql = "INSERT INTO boletas (PERIODO,TIPO_DOCUMENTO,DNI,NOMBRE,CENTRO_COSTOS,UNIDAD,CARGO,REGIMEN,
        TIPO_CONTRATO,BANCO,CUENTA,PENSIONARIO,CUSPP,TIPO_REMUNERACION,MOVILIDAD,REFRIGERIO_SUPEDITADO,
        REFRIGERIO_FIJO,EPS,SCTR,ASIGNACION_SI_NO,REMUNERACION_BASICA,DIAS_LABORADOS,DESCANSO_MEDICO,
        VACACIONES,HORAS_TRABAJADAS,HABER_MENSUAL,ASIGNACION_IMPORTE,VACACIONES_IMPORTE,
        COMISIONES,MOVILIDAD_IMPORTE,REFRIGERIO_IMPORTE,BONIFICACION,CONDICION,BASE_IMPONIBLE,
        TOTAL_BRUTO,APORTE_AFP,COMISIONES_AFP,PRIMA_AFP,ONP,RENTA_5TA,PRESTAMO,ADELANTOS,
        DESCUENTO,NETO,ESSLUD) VALUES ('$periodo','$d1','$d2','$d3','$d4','$d5','$d6','$d7','$d8','$d9','$d10',
        '$d11','$d12','$d13','$d14','$d15','$d16','$d17','$d18','$d19','$d20',
        '$d21','$d22','$d23','$d24','$d25','$d26','$d27','$d28','$d29','$d30',
        '$d31','$d32','$d33','$d34','$d35','$d36','$d37','$d38','$d39','$d40',
        '$d41','$d42','$d43','$d44')";
        
        if (!$resultado = $mysqli->query($sql)) {
    	    
    	    echo "Lo sentimos, este sitio web está experimentando problemas.";
    	    echo "Error: La ejecución de la consulta falló debido a: \n";
    	    echo "Query: " . $sql . "\n";
    	    echo "Errno: " . $mysqli->errno . "\n";
    	    echo "Error: " . $mysqli->error . "\n";
    	    
    	    exit;
    	} else {
    		//echo 'EXITO';
    	}
    }
    
        
}



    

?>