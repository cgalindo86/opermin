<?php

class Usuario{

	function __constructor($id){
		$this -> id = $id;
		
	}
	
	function Validar($usuario,$password){
	    include('conexion.php');
    
        $query = "SELECT * FROM empleados WHERE usuario='$usuario' AND password='$password'";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
    		
    	while ($row = $result->fetch_array()){
    	    $dat=$row['id'];
    			
    	}
    		
    	return $dat;
	}
	
	function NombreUsuario($id){
		include('conexion.php');
    
        $query = "SELECT * FROM empleados WHERE id='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
    		
    	while ($row = $result->fetch_array()){
    	    $dat=$row['nombre']." ".$row['apellidos'];
    	}
    		
    	return $dat;
	}

	function Asistencia($fecha){
		include('conexion.php');
    
        $query = "SELECT * FROM asistencia ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>FECHA</td><td>EMPLEADO</td><td>HORA INGRESO</td>';
		$tabla = $tabla . '<td>HORA SALIDA</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			$nombre = $this->NombreUsuario($row['empleado']);
			$tabla = $tabla . '<tr><td>'.$row['fecha'].'</td><td>'.$nombre.'</td>';
			$tabla = $tabla . '<td>'.$row['hora_inicio'].'</td><td>'.$row['hora_fin'].'</td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table>';
    	return $tabla;
	}

	function Beneficios(){
		include('conexion.php');
    
        $query = "SELECT * FROM beneficios ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>EMPRESA</td><td>DETALLE</td>';
		$tabla = $tabla . '<td>DESCUENTO %</td><td>DESCUENTO S/</td>';
		$tabla = $tabla . '<td>CONDICIONES</td><td>CADUCIDAD</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			
			$tabla = $tabla . '<tr><td>'.$row['codigo'].'</td><td>'.$row['empresa'].'</td>';
			$tabla = $tabla . '<td>'.$row['detalle'].'</td><td>'.$row['descuento_p'].'</td>';
			$tabla = $tabla . '<td>'.$row['descuento_m'].'</td><td>'.$row['condiciones'].'</td>';
			$tabla = $tabla . '<td>'.$row['caducidad'].'</td>';
			$tabla = $tabla . '<td><img onclick="EditarBeneficios('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table>';
    	return $tabla;
	}

	function Beneficios2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM beneficios WHERE id='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
    	while ($row = $result->fetch_array()){
			
			$tabla = $tabla . $row['codigo'].'#'.$row['empresa'].'#';
			$tabla = $tabla . $row['detalle'].'#'.$row['descuento_p'].'#';
			$tabla = $tabla . $row['descuento_m'].'#'.$row['condiciones'].'#';
			$tabla = $tabla . $row['caducidad'].'#';
			
    	}
    	return $tabla;
	}

	function GuardaBeneficios($codigo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad){
		include('conexion.php');
    								
        $sql = "INSERT INTO beneficios (CODIGO,EMPRESA,DETALLE,DESCUENTO_P,DESCUENTO_M,CONDICIONES,CADUCIDAD) 
        VALUES ('$codigo','$empresa','$detalle','$descuento_p','$descuento_m','$condiciones','$caducidad')";
        
        if (!$resultado = $mysqli->query($sql)) {
    	    // ¡Oh, no! La consulta falló. 
    	    echo "Lo sentimos, este sitio web está experimentando problemas.";
    	
    	    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    	    // cómo obtener información del error
    	    echo "Error: La ejecución de la consulta falló debido a: \n";
    	    echo "Query: " . $sql . "\n";
    	    echo "Errno: " . $mysqli->errno . "\n";
    	    echo "Error: " . $mysqli->error . "\n";
    	    
    	    exit;
    	} else {
    		
    		echo "Ingresado"."\n";
    	    
    	}
	} 

	function GuardaBeneficios2($id,$codigo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad){
		include('conexion.php');
    								
        $sql = "UPDATE beneficios SET codigo='$codigo', empresa='$empresa', detalle='$detalle',
		descuento_p='$descuento_p', descuento_m='$descuento_m', condiciones='$condiciones',
		caducidad='$caducidad' WHERE id='$id' ";
        
        if (!$resultado = $mysqli->query($sql)) {
    	    // ¡Oh, no! La consulta falló. 
    	    echo "Lo sentimos, este sitio web está experimentando problemas.";
    	
    	    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    	    // cómo obtener información del error
    	    echo "Error: La ejecución de la consulta falló debido a: \n";
    	    echo "Query: " . $sql . "\n";
    	    echo "Errno: " . $mysqli->errno . "\n";
    	    echo "Error: " . $mysqli->error . "\n";
    	    
    	    exit;
    	} else {
    		
    		echo "Ingresado"."\n";
    	    
    	}
	} 

	function VerBoletas(){
		include('conexion.php');
    
        $query = "SELECT * FROM boletas ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>TIPO DOCUMENTO</td><td>DNI</td><td>APELLIDOS Y NOMBRES</td>';
		$tabla = $tabla . '<td>CENTRO DE COSTOS</td><td>UNIDAD</td>';
		$tabla = $tabla . '<td>CARGO</td><td>REGIMEN</td>';
		$tabla = $tabla . '<td>FULL - PART TIME</td><td>BANCO</td>';
		$tabla = $tabla . '<td>NRO CUENTA</td><td>SISTEMA PENSIONARIO</td>';
		$tabla = $tabla . '<td>CUSPP</td><td>BRUTO O NETO</td>';
		$tabla = $tabla . '<td>IMPORTE DE MOVILIDAD<BR>SUPEDITADA</td><td>REFRIGERIO SUPEDITADO</td>';
		$tabla = $tabla . '<td>REFRIGERIO FIJO</td><td>EPS</td>';
		$tabla = $tabla . '<td>SCTR</td><td>ASIG. FAM. (SI O NO)</td>';
		$tabla = $tabla . '<td>REM. BASICA</td><td>DIAS LABORADOS</td>';
		$tabla = $tabla . '<td>DESCANSO MEDICO</td><td>VACACIONES</td>';
		$tabla = $tabla . '<td>HORAS TRABAJADAS</td><td>HABER MENSUAL</td>';
		$tabla = $tabla . '<td>ASIGNACION FAMILIAR</td><td>VACACIONES</td>';
		$tabla = $tabla . '<td>COMISIONES</td><td>MOVILIDAD SUPEDITADA</td>';
		$tabla = $tabla . '<td>REFRIGERIO</td><td>BONIFICACION</td>';
		$tabla = $tabla . '<td>CONDICION DE TRABAJO</td><td>BASE IMPONIBLE</td>';
		$tabla = $tabla . '<td>TOTAL BRUTO</td><td>APORTE AFP</td>';
		$tabla = $tabla . '<td>COMISIONES AFP</td><td>PRIMA AFP</td>';
		$tabla = $tabla . '<td>ONP</td><td>RENTA 5TA</td>';
		$tabla = $tabla . '<td>PRESTAMO</td><td>ADELANTOS</td>';
		$tabla = $tabla . '<td>DESCUENTO</td><td>NETO</td>';
		$tabla = $tabla . '<td>ESSALUD</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			
			$tabla = $tabla . '<tr><td>'.$row['tipo_documento'].'</td><td>'.$row['dni'].'</td>';
			$tabla = $tabla . '<td>'.$row['nombre'].'</td><td>'.$row['centro_costos'].'</td>';
			$tabla = $tabla . '<td>'.$row['unidad'].'</td><td>'.$row['cargo'].'</td>';
			$tabla = $tabla . '<td>'.$row['regimen'].'</td><td>'.$row['tipo_contrato'].'</td>';
			$tabla = $tabla . '<td>'.$row['banco'].'</td><td>'.$row['cuenta'].'</td>';
			$tabla = $tabla . '<td>'.$row['pensionario'].'</td><td>'.$row['cuspp'].'</td>';
			$tabla = $tabla . '<td>'.$row['tipo_remuneracion'].'</td><td>'.$row['movilidad'].'</td>';
			$tabla = $tabla . '<td>'.$row['refrigerio_supeditado'].'</td><td>'.$row['refrigerio_fijo'].'</td>';
			$tabla = $tabla . '<td>'.$row['eps'].'</td><td>'.$row['sctr'].'</td>';
			$tabla = $tabla . '<td>'.$row['asignacion_si_no'].'</td><td>'.$row['remuneracion_basica'].'</td>';
			$tabla = $tabla . '<td>'.$row['dias_laborados'].'</td><td>'.$row['descanso_medico'].'</td>';
			$tabla = $tabla . '<td>'.$row['vacaciones'].'</td><td>'.$row['horas_trabajadas'].'</td>';
			$tabla = $tabla . '<td>'.$row['haber_mensual'].'</td><td>'.$row['asignacion_importe'].'</td>';
			$tabla = $tabla . '<td>'.$row['vacaciones_importe'].'</td><td>'.$row['comisiones'].'</td>';
			$tabla = $tabla . '<td>'.$row['movilidad_importe'].'</td><td>'.$row['refrigerio_importe'].'</td>';
			$tabla = $tabla . '<td>'.$row['bonificacion'].'</td><td>'.$row['condicion'].'</td>';
			$tabla = $tabla . '<td>'.$row['base_imponible'].'</td><td>'.$row['total_bruto'].'</td>';
			$tabla = $tabla . '<td>'.$row['aporte_afp'].'</td><td>'.$row['comisiones_afp'].'</td>';
			$tabla = $tabla . '<td>'.$row['prima_afp'].'</td><td>'.$row['onp'].'</td>';
			$tabla = $tabla . '<td>'.$row['renta_5ta'].'</td><td>'.$row['prestamos'].'</td>';
			$tabla = $tabla . '<td>'.$row['adelantos'].'</td><td>'.$row['descuentos'].'</td>';
			$tabla = $tabla . '<td>'.$row['neto'].'</td><td>'.$row['esslud'].'</td>';
			$tabla = $tabla . '</tr>';
    	}
    	$tabla = $tabla . '</tbody></table>';
    	return $tabla;
	}

	function Convocatorias(){
		include('conexion.php');
    
        $query = "SELECT * FROM convocatorias ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>CENTRO DE COSTOS</td><td>UNIDAD</td>';
		$tabla = $tabla . '<td>PUESTO</td><td>DESCRIPCION</td>';
		$tabla = $tabla . '<td>REQUISITOS</td><td>SALARIO</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			
			$tabla = $tabla . '<tr><td>'.$row['id'].'</td><td>'.$row['centro_costos'].'</td>';
			$tabla = $tabla . '<td>'.$row['unidad'].'</td><td>'.$row['puesto'].'</td>';
			$tabla = $tabla . '<td>'.$row['descripcion'].'</td><td>'.$row['requisitos'].'</td>';
			$tabla = $tabla . '<td>'.$row['salario'].'</td>';
			$tabla = $tabla . '<td><img onclick="EditarConvocatorias('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table>';
    	return $tabla;
	}

	function Convocatorias2(){
		include('conexion.php');
    
        $query = "SELECT * FROM convocatorias ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		while ($row = $result->fetch_array()){
			
			$tabla = $tabla . $row['centro_costos'].'#';
			$tabla = $tabla . $row['unidad'].'#'.$row['puesto'].'#';
			$tabla = $tabla . $row['descripcion'].'#'.$row['requisitos'].'#';
			$tabla = $tabla . $row['salario'].'#';
			
    	}
    	return $tabla;
	}

	function GuardaConvocatorias($costos,$unidad,$puesto,$descripcion,$requisitos,$salario){
		include('conexion.php');
    								
        $sql = "INSERT INTO convocatorias (CENTRO_COSTOS,UNIDAD,PUESTO,DESCRIPCION,REQUISITOS,SALARIO) 
        VALUES ('$costos','$unidad','$puesto','$descripcion','$requisitos','$salario')";
        
        if (!$resultado = $mysqli->query($sql)) {
    	    // ¡Oh, no! La consulta falló. 
    	    echo "Lo sentimos, este sitio web está experimentando problemas.";
    	
    	    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    	    // cómo obtener información del error
    	    echo "Error: La ejecución de la consulta falló debido a: \n";
    	    echo "Query: " . $sql . "\n";
    	    echo "Errno: " . $mysqli->errno . "\n";
    	    echo "Error: " . $mysqli->error . "\n";
    	    
    	    exit;
    	} else {
    		
    		echo "Ingresado"."\n";
    	    
    	}
	} 

	function GuardaConvocatorias2($id,$costos,$unidad,$puesto,$descripcion,$requisitos,$salario){
		include('conexion.php');
    								
        $sql = "UPDATE convocatorias SET centro_costos='$costos', unidad='$unidad', puesto='$puesto',
		descripcion='$descripcion', requisitos='$requisitos', 
		salario='$salario' WHERE id='$id' ";
        
        if (!$resultado = $mysqli->query($sql)) {
    	    // ¡Oh, no! La consulta falló. 
    	    echo "Lo sentimos, este sitio web está experimentando problemas.";
    	
    	    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    	    // cómo obtener información del error
    	    echo "Error: La ejecución de la consulta falló debido a: \n";
    	    echo "Query: " . $sql . "\n";
    	    echo "Errno: " . $mysqli->errno . "\n";
    	    echo "Error: " . $mysqli->error . "\n";
    	    
    	    exit;
    	} else {
    		
    		echo "Ingresado"."\n";
    	    
    	}
	}
}

?>