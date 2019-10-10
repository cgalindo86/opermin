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
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Beneficios(){
		include('conexion.php');
    
        $query = "SELECT * FROM beneficios ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>EMPRESA</td><td>TITULO</td><td>DETALLE</td>';
		$tabla = $tabla . '<td>DESCUENTO %</td><td>DESCUENTO S/</td>';
		$tabla = $tabla . '<td>CONDICIONES</td><td>CADUCIDAD</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			
			$tabla = $tabla . '<tr><td>'.$row['codigo'].'</td><td>'.$row['empresa'].'</td>';
			$tabla = $tabla . '<td>'.$row['titulo'].'</td>';
			$tabla = $tabla . '<td>'.$row['detalle'].'</td><td>'.$row['descuento_p'].'</td>';
			$tabla = $tabla . '<td>'.$row['descuento_m'].'</td><td>'.$row['condiciones'].'</td>';
			$tabla = $tabla . '<td>'.$row['caducidad'].'</td>';
			$tabla = $tabla . '<td><img onclick="EditarBeneficios('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table></div>';
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
			$tabla = $tabla . $row['caducidad'].'#'.$row['titulo'].'#';
			
    	}
    	return $tabla;
	}

	function GuardaBeneficios($codigo,$titulo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad){
		include('conexion.php');

		$titulo = utf8_decode($titulo);
		$empresa = utf8_decode($empresa);
		$detalle = utf8_decode($detalle);
		$condiciones = utf8_decode($condiciones);
    								
        $sql = "INSERT INTO beneficios (CODIGO,TITULO,EMPRESA,DETALLE,DESCUENTO_P,DESCUENTO_M,CONDICIONES,CADUCIDAD) 
        VALUES ('$codigo','$titulo','$empresa','$detalle','$descuento_p','$descuento_m','$condiciones','$caducidad')";
        
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

	function GuardaBeneficios2($id,$codigo,$titulo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad){
		include('conexion.php');

		$titulo = utf8_decode($titulo);
		$empresa = utf8_decode($empresa);
		$detalle = utf8_decode($detalle);
		$condiciones = utf8_decode($condiciones);

    								
        $sql = "UPDATE beneficios SET codigo='$codigo', titulo='$titulo', empresa='$empresa', detalle='$detalle',
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
    	$tabla = $tabla . '</tbody></table></div>';
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
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Convocatorias2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM convocatorias WHERE id='$id'";
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

		$unidad = utf8_decode($unidad);
		$puesto = utf8_decode($puesto);
		$descripcion = utf8_decode($descripcion);
		$requisitos = utf8_decode($requisitos);
    								
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
		
		$unidad = utf8_decode($unidad);
		$puesto = utf8_decode($puesto);
		$descripcion = utf8_decode($descripcion);
		$requisitos = utf8_decode($requisitos);
		
		
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

	function Descansos(){
		include('conexion.php');
    
        $query = "SELECT * FROM descansos ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>EMPLEADO</td><td>FECHA INICIO</td><td>FECHA FIN</td>';
		$tabla = $tabla . '<td>DOCUMENTO</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			$direccion = '<a href="files/'.$row['direccion'].'" target="_blank">'.$row['direccion'].'</a>';
			$tabla = $tabla . '<tr><td>'.$row['empleado'].'</td><td>'.$row['fecha_inicio'].'</td>';
			$tabla = $tabla . '<td>'.$row['fecha_fin'].'</td><td>'.$direccion.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarDescanso('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Descansos2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM descansos WHERE id='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		while ($row = $result->fetch_array()){
			$direccion = '<a href="files/'.$row['direccion'].'" target="_blank">'.$row['direccion'].'</a>';
			$tabla = $tabla . $row['empleado'].'#';
			$tabla = $tabla . $row['fecha_inicio'].'#'.$row['fecha_fin'].'#';
			$tabla = $tabla . $direccion.'#';
			
    	}
    	return $tabla;
	}

	function GuardaFrase($detalle){
		include('conexion.php');
		
		$detalle = utf8_decode($detalle);

        $sql = "INSERT INTO frases (DETALLE) 
        VALUES ('$detalle')";
        
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

	function Frases(){
		include('conexion.php');
    
        $query = "SELECT * FROM frases ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>DETALLE</td><td>IMAGEN</td>';
		$tabla = $tabla . '<td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			$direccion = '<a href="files/'.$row['imagen'].'" target="_blank">'.$row['imagen'].'</a>';
			$tabla = $tabla . '<tr><td>'.$row['detalle'].'</td><td>'.$direccion.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarFrase('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Unidad($id){
		include('conexion.php');
		//echo $id;
        $query = "SELECT * FROM unidad WHERE centro_costos='$id'";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<select id="iunidad"><option value="0">Seleccione</option>';
		
    	while ($row = $result->fetch_array()){
			$tabla = $tabla . '<option value="'.$row['id'].'">'.$row['descripcion'].'</option>';
    	}
    	$tabla = $tabla . '</select>';
    	return $tabla;
	}

	function Unidad2($id){
		include('conexion.php');
		//echo $id;
        $query = "SELECT * FROM unidad WHERE centro_costos='$id'";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<select id="iunidad"><option value="0">Seleccione</option>';
		
    	while ($row = $result->fetch_array()){
			$tabla = $tabla . '<option value="'.$row['id'].'" selected>'.$row['descripcion'].'</option>';
    	}
    	$tabla = $tabla . '</select>';
    	return $tabla;
	}

	function Unidad3($centro,$id){
		include('conexion.php');
		//echo $id;
        $query = "SELECT * FROM unidad WHERE centro_costos='$centro'";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<select id="iunidad"><option value="0">Seleccione</option>';
		
    	while ($row = $result->fetch_array()){
			if($row['id']==$id){
				$tabla = $tabla . '<option value="'.$row['id'].'" selected>'.$row['descripcion'].'</option>';
			} else {
				$tabla = $tabla . '<option value="'.$row['id'].'">'.$row['descripcion'].'</option>';
			}
			
    	}
    	$tabla = $tabla . '</select>';
    	return $tabla;
	}

	function CentroCostos(){
		include('conexion.php');
    
        $query = "SELECT * FROM centro_costos";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<select id="icostos" onclick="CambioCentroCostos()">';
		//$tabla = '<select id="icostos" onclick="CambioCentroCostos()"><option value="0">Seleccione</option>';
		
    	while ($row = $result->fetch_array()){
			$tabla = $tabla . '<option value="'.$row['id'].'">'.$row['descripcion'].'</option>';
			
    	}
    	$tabla = $tabla . '</select>';
    	return $tabla;
	}

	function CentroCostos2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM centro_costos WHERE id='$id'";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<select id="icostos" onclick="CambioCentroCostos()">';
		//$tabla = '<select id="icostos" onclick="CambioCentroCostos()"><option value="0">Seleccione</option>';
		
    	while ($row = $result->fetch_array()){
			$tabla = $tabla . '<option value="'.$row['id'].'" selected>'.$row['descripcion'].'</option>';
			
    	}
    	$tabla = $tabla . '</select>';
    	return $tabla;
	}

	function CentroCostos3($id){
		include('conexion.php');
    
        $query = "SELECT * FROM centro_costos ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<select id="icostos" onclick="CambioCentroCostos()">';
		//$tabla = '<select id="icostos" onclick="CambioCentroCostos()"><option value="0">Seleccione</option>';
		
    	while ($row = $result->fetch_array()){
			if($row['id']==$id){
				$tabla = $tabla . '<option value="'.$row['id'].'" selected>'.$row['descripcion'].'</option>';
			} else {
				$tabla = $tabla . '<option value="'.$row['id'].'">'.$row['descripcion'].'</option>';
			}
			
    	}
    	$tabla = $tabla . '</select>';
    	return $tabla;
	}


	function Reglamentos(){
		include('conexion.php');
    
        $query = "SELECT * FROM reglamento ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CENTRO DE COSTOS</td><td>UNIDAD</td>';
		$tabla = $tabla . '<td>ARCHIVO</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			$costo = $this->NombreCentro($row['centro_costos']);
			$unidad = $this->NombreUnidad($row['unidad']);

			$direccion = '<a href="files/'.$row['archivo'].'" target="_blank">'.$row['archivo'].'</a>';
			$tabla = $tabla . '<tr><td>'.$costo.'</td><td>'.$unidad.'</td><td>'.$direccion.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarReglamentos('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}


	function Reglamentos2(){
		include('conexion.php');
    
        $query = "SELECT * FROM reglamento ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '';
		while ($row = $result->fetch_array()){
			$costo = $this->CentroCostos2($row['centro_costos']);
			$unidad = $this->Unidad2($row['unidad']);
			$direccion = '<a href="files/'.$row['archivo'].'" target="_blank">'.$row['archivo'].'</a>';
			$tabla = $tabla . ''.$costo.'#'.$unidad.'#'.$direccion.'#';
			
    	}
		
		return $tabla;
	}

	function NombreCentro($id){
		include('conexion.php');
    
        $query = "SELECT * FROM centro_costos WHERE id='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		while ($row = $result->fetch_array()){
			$dat = $row['descripcion'];
		}
		return $dat;
	}

	function NombreUnidad($id){
		include('conexion.php');
    
        $query = "SELECT * FROM unidad WHERE id='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		while ($row = $result->fetch_array()){
			$dat = $row['descripcion'];
		}
		return $dat;
	}

	function Interes(){
		include('conexion.php');
    
        $query = "SELECT * FROM temas ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>TITULO</td><td>DETALLE</td>';
		$tabla = $tabla . '<td>MATERIAL</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			$material = $this->MaterialXInteres($row['id']);

			$tabla = $tabla . '<tr><td>'.$row['titulo'].'</td><td>'.$row['detalle'].'</td><td>'.$material.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarInteres('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function MaterialXInteres($id){
		include('conexion.php');
    
        $query = "SELECT * FROM materialesxtema WHERE tema = '$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '';
		while ($row = $result->fetch_array()){
			if(($row['tipo']=="1") OR ($row['tipo']=="2")){
				$direccion = '<a href="'.$row['detalle'].'"  target="_blank">'.$row['detalle'].'</a>';
			} else {
				$direccion = '<a href="files/'.$row['detalle'].'" target="_blank">'.$row['detalle'].'</a>';
			}
			
			$tabla = $tabla . ''.$direccion.'<br>';
			
    	}
		
		return $tabla;
	}

	function GuardaInteres($titulo,$detalle,$tipo,$material){
		include('conexion.php');
		
		$titulo = utf8_decode($titulo);
		$detalle = utf8_decode($detalle);

		$sql = "INSERT INTO temas (TITULO,DETALLE) VALUES ('$titulo','$detalle')";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    $idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
            
        $sql2 = "INSERT INTO materialesxtema (TEMA,TIPO,DETALLE) VALUES ('$idT','$tipo','$material')";
                
                if (!$resultado = $mysqli->query($sql2)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    //$id = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function Usuarios(){
		include('conexion.php');
    
        $query = "SELECT * FROM empleados ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>APELLIDOS</td><td>NOMBRES</td>';
		$tabla = $tabla . '<td>DNI</td><td>CORREO</td><td>CENTRO COSTOS</td><td>UNIDAD</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			//$material = $this->MaterialXInteres($row['id']);
			$centro_costos = $this->Area($row['area']);
			$unidad = $this->SubArea($row['subarea']);

			$tabla = $tabla . '<tr><td>'.$row['apellidos'].'</td><td>'.$row['nombre'].'</td><td>'.$row['dni'].'</td>';
			$tabla = $tabla . '<td>'.$row['email'].'</td><td>'.$centro_costos.'</td><td>'.$unidad.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarUsuarios('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Usuarios2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM empleados WHERE id='$id'";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '';
    	while ($row = $result->fetch_array()){
			$tabla = $tabla . ''.$row['apellidos'].'#'.$row['nombre'].'#'.$row['dni'].'#';
			$tabla = $tabla . ''.$row['email'].'#';
			
		}
    	return $tabla;
	}

	function Area($id){
		include('conexion.php');
    
        $query = "SELECT * FROM centro_costos WHERE id='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '';
    	while ($row = $result->fetch_array()){
			$tabla = $row['descripcion'];
		}
    	return $tabla;
	}

	function Subarea($id){
		include('conexion.php');
    
        $query = "SELECT * FROM unidad WHERE centro_costos='$id' ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '';
    	while ($row = $result->fetch_array()){
			$tabla = $row['descripcion'];
		}
    	return $tabla;
	}


	function GuardaUsuarios($apellidos,$nombre,$dni,$correo,$centro,$unidad){
		include('conexion.php');
		
		$apellidos = utf8_decode($apellidos);
		$nombre = utf8_decode($nombre);
		$centro = utf8_decode($centro);
		$unidad = utf8_decode($unidad);
		
		$sql = "INSERT INTO empleados (APELLIDOS,NOMBRE,USUARIO,DNI,EMAIL,EMPRESA,SUCURSAL,AREA,SUBAREA) 
		VALUES ('$apellidos','$nombre','$nombre','$dni','$correo','1','1','$centro','$unidad')";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    $idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function EditaUsuarios($id,$apellidos,$nombre,$dni,$correo,$centro,$unidad){
		include('conexion.php');
		
		$apellidos = utf8_decode($apellidos);
		$nombre = utf8_decode($nombre);
		$centro = utf8_decode($centro);
		$unidad = utf8_decode($unidad);
		
		
		$sql = "UPDATE empleados SET apellidos='$apellidos', nombre='$nombre', usuario='$nombre', 
		dni='$dni', email='$correo', area='$centro', subarea='$unidad' WHERE id='$id' ";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    $idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function Capacitaciones(){
		include('conexion.php');
    
        $query = "SELECT * FROM cursos ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>NOMBRE</td>';
		$tabla = $tabla . '<td>CENTRO COSTOS</td><td>UNIDAD</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			//$material = $this->MaterialXInteres($row['id']);
			$centro_costos = $this->Area($row['centro_costos']);
			$unidad = $this->SubArea($row['unidad']);

			$tabla = $tabla . '<tr><td>'.$row['id'].'</td><td>'.$row['nombre'].'</td>';
			$tabla = $tabla . '<td>'.$centro_costos.'</td><td>'.$unidad.'</td>';
			$tabla = $tabla . '<td><img onclick="VerCapacitaciones('.$row['id'].')" src="imagenes/ver.png"><img onclick="EditarCapacitaciones('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Capacitaciones2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM cursos WHERE id='$id'";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '';
    	while ($row = $result->fetch_array()){
			$centro = $this->CentroCostos3($row['centro_costos']);
			$unidad = $this->Unidad3($row['centro_costos'],$row['unidad']);
			$tabla = $tabla . ''.$row['nombre'].'#';
			$tabla = $tabla . ''.$centro."#";
			$tabla = $tabla . ''.$unidad."#";
		}
    	return $tabla;
	}

	function GuardaCapacitaciones($nombre,$centro,$unidad){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		$centro = utf8_decode($centro);
		$unidad = utf8_decode($unidad);
		
		$sql = "INSERT INTO cursos (NOMBRE,EMPRESA,CENTRO_COSTOS,UNIDAD) 
		VALUES ('$nombre','1','$centro','$unidad')";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    $idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function EditaCapacitaciones($id,$nombre,$centro,$unidad){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		$centro = utf8_decode($centro);
		$unidad = utf8_decode($unidad);
		
		
		$sql = "UPDATE cursos SET nombre='$nombre',  
		centro_costos='$centro', unidad='$unidad' WHERE id='$id' ";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    //$idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function Inducciones(){
		include('conexion.php');
    
        $query = "SELECT * FROM inducciones ";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>NOMBRE</td>';
		$tabla = $tabla . '<td>CENTRO COSTOS</td><td>UNIDAD</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			//$material = $this->MaterialXInteres($row['id']);
			$centro_costos = $this->Area($row['centro_costos']);
			$unidad = $this->SubArea($row['unidad']);

			$tabla = $tabla . '<tr><td>'.$row['id'].'</td><td>'.$row['nombre'].'</td>';
			$tabla = $tabla . '<td>'.$centro_costos.'</td><td>'.$unidad.'</td>';
			$tabla = $tabla . '<td><img onclick="VerInducciones('.$row['id'].')" src="imagenes/ver.png"><img onclick="EditarInducciones('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Inducciones2($id){
		include('conexion.php');
    
        $query = "SELECT * FROM inducciones WHERE id='$id'";
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '';
    	while ($row = $result->fetch_array()){
			$centro = $this->CentroCostos3($row['centro_costos']);
			$unidad = $this->Unidad3($row['centro_costos'],$row['unidad']);
			$tabla = $tabla . ''.$row['nombre'].'#';
			$tabla = $tabla . ''.$centro."#";
			$tabla = $tabla . ''.$unidad."#";
		}
    	return $tabla;
	}

	function GuardaInducciones($nombre,$centro,$unidad){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		$centro = utf8_decode($centro);
		$unidad = utf8_decode($unidad);
		
		$sql = "INSERT INTO inducciones (NOMBRE,EMPRESA,CENTRO_COSTOS,UNIDAD) 
		VALUES ('$nombre','1','$centro','$unidad')";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    $idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function EditaInducciones($id,$nombre,$centro,$unidad){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		$centro = utf8_decode($centro);
		$unidad = utf8_decode($unidad);
		
		
		$sql = "UPDATE inducciones SET nombre='$nombre',  
		centro_costos='$centro', unidad='$unidad' WHERE id='$id' ";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    //$idT = mysqli_insert_id($mysqli);
                    echo 'EXITO';
                }
	}

	function Sesiones($tipo,$curso){
		include('conexion.php');

		if($tipo=="1"){
			$query = "SELECT * FROM sesionesxcurso WHERE curso='$curso' ";
		} else {
			$query = "SELECT * FROM sesionesxinduccion WHERE induccion='$curso'";
		}
    
        
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>COD. CURSO</td><td>NOMBRE</td>';
		$tabla = $tabla . '<td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			if($tipo=="1"){
				$tabla = $tabla . '<tr><td>'.$row['curso'].'</td><td>'.$row['detalle'].'</td>';
			} else {
				$tabla = $tabla . '<tr><td>'.$row['induccion'].'</td><td>'.$row['detalle'].'</td>';
			}
			$tabla = $tabla . '<td><img onclick="VerSesiones('.$row['id'].')" src="imagenes/ver.png"><img onclick="EditarSesiones('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Sesiones2($id,$tipo,$curso){
		include('conexion.php');

		if($tipo=="1"){
			$query = "SELECT * FROM sesionesxcurso WHERE id='$id' ";
		} else {
			$query = "SELECT * FROM sesionesxinduccion WHERE id='$id' ";
		}
    
        
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		while ($row = $result->fetch_array()){
			$tabla = $tabla . ''.$row['detalle'].'#';
			
		}
    	return $tabla;
	}

	function GuardaSesiones($tipo,$curso,$nombre){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		
		if($tipo=="1"){
			$sql = "INSERT INTO sesionesxcurso (DETALLE,CURSO) 
			VALUES ('$nombre','$curso')";
					
					if (!$resultado = $mysqli->query($sql)) {
						
						echo "Lo sentimos, este sitio web está experimentando problemas.";
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $sql . "\n";
						echo "Errno: " . $mysqli->errno . "\n";
						echo "Error: " . $mysqli->error . "\n";
						
						exit;
					} else {
						$idT = mysqli_insert_id($mysqli);
						echo 'EXITO';
					}
		} else {
			$sql = "INSERT INTO sesionesxinduccion (DETALLE,INDUCCION) 
			VALUES ('$nombre','$curso')";
					
					if (!$resultado = $mysqli->query($sql)) {
						
						echo "Lo sentimos, este sitio web está experimentando problemas.";
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $sql . "\n";
						echo "Errno: " . $mysqli->errno . "\n";
						echo "Error: " . $mysqli->error . "\n";
						
						exit;
					} else {
						$idT = mysqli_insert_id($mysqli);
						echo 'EXITO';
					}
		}
		
	}

	function EditaSesiones($id,$tipo,$curso,$nombre){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);

		if($tipo=="1"){
			$sql = "UPDATE sesionesxcurso SET detalle='$nombre' WHERE id='$id' ";
					
			if (!$resultado = $mysqli->query($sql)) {
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: La ejecución de la consulta falló debido a: \n";
				echo "Query: " . $sql . "\n";
				echo "Errno: " . $mysqli->errno . "\n";
				echo "Error: " . $mysqli->error . "\n";
						
				exit;
			} else {
				echo 'EXITO';
			}
		} else {
			$sql = "UPDATE sesionesxinduccion SET detalle='$nombre' WHERE id='$id' ";
					
			if (!$resultado = $mysqli->query($sql)) {
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: La ejecución de la consulta falló debido a: \n";
				echo "Query: " . $sql . "\n";
				echo "Errno: " . $mysqli->errno . "\n";
				echo "Error: " . $mysqli->error . "\n";
						
				exit;
			} else {
				echo 'EXITO';
			}
		}
		
		
	}

	function Materiales($tipo,$sesion){
		include('conexion.php');

		if($tipo=="1"){
			$query = "SELECT * FROM materialesxcurso WHERE sesion='$sesion' ";
		} else {
			$query = "SELECT * FROM materialesxinduccion WHERE sesion='$sesion'";
		}
    
        
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>COD. SESION</td><td>NOMBRE</td>';
		$tabla = $tabla . '<td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){

			if(($row['tipo']=="1") OR ($row['tipo']=="2")){
				//$direccion = $video_title;
				$direccion = '<a href="'.$row['detalle'].'"  target="_blank">'.$row['detalle'].'</a>';
			} else {
				$direccion = '<a href="files/'.$row['detalle'].'" target="_blank">'.$row['detalle'].'</a>';
			}

			$tabla = $tabla . '<tr><td>'.$row['sesion'].'</td><td>'.$direccion.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarMateriales('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Materiales2($id,$tipo,$sesion){
		include('conexion.php');

		if($tipo=="1"){
			$query = "SELECT * FROM materialesxcurso WHERE id='$id' ";
		} else {
			$query = "SELECT * FROM materialesxinduccion WHERE id='$id' ";
		}
    
        
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		while ($row = $result->fetch_array()){
			if(($row['tipo']=="1") OR ($row['tipo']=="2")){
				$direccion = '<a href="'.$row['detalle'].'"  target="_blank">'.$row['detalle'].'</a>';
			} else {
				$direccion = '<a href="files/'.$row['detalle'].'" target="_blank">'.$row['detalle'].'</a>';
			}
			
			$tabla = $tabla . ''.$direccion.'#';
			
		}
    	return $tabla;
	}

	function GuardaMateriales($tipo,$tipomat,$sesion,$nombre){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		
		if($tipo=="1"){
			$sql = "INSERT INTO materialesxcurso (DETALLE,SESION,TIPO) 
			VALUES ('$nombre','$sesion','$tipomat')";
					
					if (!$resultado = $mysqli->query($sql)) {
						
						echo "Lo sentimos, este sitio web está experimentando problemas.";
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $sql . "\n";
						echo "Errno: " . $mysqli->errno . "\n";
						echo "Error: " . $mysqli->error . "\n";
						
						exit;
					} else {
						$idT = mysqli_insert_id($mysqli);
						echo 'EXITO';
					}
		} else {
			$sql = "INSERT INTO materialesxinduccion (DETALLE,SESION,TIPO) 
			VALUES ('$nombre','$sesion','$tipomat')";
					
					if (!$resultado = $mysqli->query($sql)) {
						
						echo "Lo sentimos, este sitio web está experimentando problemas.";
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $sql . "\n";
						echo "Errno: " . $mysqli->errno . "\n";
						echo "Error: " . $mysqli->error . "\n";
						
						exit;
					} else {
						$idT = mysqli_insert_id($mysqli);
						echo 'EXITO';
					}
		}
		
	}

	function EditaMateriales($id,$tipo,$tipomat,$sesion,$nombre){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);

		if($tipo=="1"){
			$sql = "UPDATE materialesxcurso SET detalle='$nombre' WHERE id='$id' ";
					
			if (!$resultado = $mysqli->query($sql)) {
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: La ejecución de la consulta falló debido a: \n";
				echo "Query: " . $sql . "\n";
				echo "Errno: " . $mysqli->errno . "\n";
				echo "Error: " . $mysqli->error . "\n";
						
				exit;
			} else {
				echo 'EXITO';
			}
		} else {
			$sql = "UPDATE materialesxinduccion SET detalle='$nombre' WHERE id='$id' ";
					
			if (!$resultado = $mysqli->query($sql)) {
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: La ejecución de la consulta falló debido a: \n";
				echo "Query: " . $sql . "\n";
				echo "Errno: " . $mysqli->errno . "\n";
				echo "Error: " . $mysqli->error . "\n";
						
				exit;
			} else {
				echo 'EXITO';
			}
		}
		
		
	}
	
	function Mejoras(){
		include('conexion.php');
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>EMPLEADO</td>';
		$tabla = $tabla . '<td>SUGERENCIA</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	
		$query = "SELECT * FROM mejoras ";
		mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		while ($row = $result->fetch_array()){

			$dat = $dat.'<tr><td>'.$row['id']."</td><td>".$row['id_usuario']."</td><td>".$row['detalle']."</td></tr>";
		}

		$tabla = $tabla.$dat.'</tbody></table></div>';
		return $tabla;
			
	}

	function Procedimientos(){
		include('conexion.php');
    
        $query = "SELECT * FROM procedimientos ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CENTRO DE COSTOS</td><td>UNIDAD</td>';
		$tabla = $tabla . '<td>ARCHIVO</td><td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){
			$costo = $this->NombreCentro($row['centro_costos']);
			$unidad = $this->NombreUnidad($row['unidad']);

			$direccion = '<a href="files/'.$row['archivo'].'" target="_blank">'.$row['archivo'].'</a>';
			$tabla = $tabla . '<tr><td>'.$costo.'</td><td>'.$unidad.'</td><td>'.$direccion.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarProcedimientos('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
    	}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}


	function Procedimientos2(){
		include('conexion.php');
    
        $query = "SELECT * FROM procedimientos ";
        mysqli_set_charset($mysqli, 'utf8'); 
    	$result = mysqli_query($mysqli, $query);
		
		$tabla = '';
		while ($row = $result->fetch_array()){
			$costo = $this->CentroCostos2($row['centro_costos']);
			$unidad = $this->Unidad2($row['unidad']);
			$direccion = '<a href="files/'.$row['archivo'].'" target="_blank">'.$row['archivo'].'</a>';
			$tabla = $tabla . ''.$costo.'#'.$unidad.'#'.$direccion.'#';
			
    	}
		
		return $tabla;
	}

	function Videos(){
		include('conexion.php');

		$query = "SELECT * FROM videos ";
        
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		
		$tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
		$tabla = $tabla . '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>ENLACE</td>';
		$tabla = $tabla . '<td>EDITAR</td></tr></thead>';
		$tabla = $tabla . '<tbody>';
    	while ($row = $result->fetch_array()){

			if(($row['tipo']=="1") OR ($row['tipo']=="2")){
				$direccion = '<a href="'.$row['detalle'].'"  target="_blank">'.$row['detalle'].'</a>';
			} else {
				$direccion = '<a href="files/'.$row['detalle'].'" target="_blank">'.$row['detalle'].'</a>';
			}

			$tabla = $tabla . '<tr><td>'.$row['id'].'</td><td>'.$direccion.'</td>';
			$tabla = $tabla . '<td><img onclick="EditarVideos('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
		
		}
    	$tabla = $tabla . '</tbody></table></div>';
    	return $tabla;
	}

	function Videos2($id){
		include('conexion.php');

		$query = "SELECT * FROM videos WHERE id='$id'";
        
        mysqli_set_charset($mysqli, 'utf8'); 
		$result = mysqli_query($mysqli, $query);
		
		$tabla = '';
    	while ($row = $result->fetch_array()){

			$tabla = $tabla.$row['detalle'].'#';
		
		}
		
		return $tabla;
	}

	function GuardaVideos($tipomat,$nombre){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);
		
		$sql = "INSERT INTO videos (DETALLE,TIPO) 
			VALUES ('$nombre','$tipomat')";
					
					if (!$resultado = $mysqli->query($sql)) {
						
						echo "Lo sentimos, este sitio web está experimentando problemas.";
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $sql . "\n";
						echo "Errno: " . $mysqli->errno . "\n";
						echo "Error: " . $mysqli->error . "\n";
						
						exit;
					} else {
						$idT = mysqli_insert_id($mysqli);
						echo 'EXITO';
					}
	}

	function EditaVideos($id,$tipomat,$nombre){
		include('conexion.php');
		
		$nombre = utf8_decode($nombre);

		$sql = "UPDATE videos SET detalle='$nombre' WHERE id='$id' ";
					
			if (!$resultado = $mysqli->query($sql)) {
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: La ejecución de la consulta falló debido a: \n";
				echo "Query: " . $sql . "\n";
				echo "Errno: " . $mysqli->errno . "\n";
				echo "Error: " . $mysqli->error . "\n";
						
				exit;
			} else {
				echo 'EXITO';
			}
		
		
	}
}

?>