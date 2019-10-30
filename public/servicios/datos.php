<?php


    ini_set("display_errors", false);
    $accion = $_GET['accion'];
    $id = $_GET['id'];
    $fecha = $_GET['fecha'];
    $nombre = $_GET['nombre'];
	$password  = $_GET['password'];
    $codigo = $_GET['codigo'];
    $empresa = $_GET['empresa'];
	$detalle = $_GET['detalle'];
	$descuento_p = $_GET['descuento_p'];
	$descuento_m = $_GET['descuento_m'];
	$condiciones = $_GET['condiciones'];
	$caducidad = $_GET['caducidad'];
    $costos = $_GET['costos'];
	$unidad = $_GET['unidad'];
	$puesto = $_GET['puesto'];
	$descripcion = $_GET['descripcion'];
	$requisitos = $_GET['requisitos'];
	$salario = $_GET['salario'];

    $accion2 = $_POST['accion2'];
    $detalle2 = $_POST['detalle2'];
    $usuario2 = $_POST['usuario2'];
	
    if($accion=="0"){
        echo Login($id);
    } else if($accion=="1"){
        echo Asistencia($id);
    } else if($accion=="2"){
        echo Beneficios();
    } else if($accion=="3"){
        echo VerBoletas($id);
    } else if($accion=="4"){
        echo VerBoletas();
    } else if($accion=="5"){
        echo Beneficios2($id);
    } else if($accion=="6"){
        echo GuardaBeneficios2($id,$codigo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad);
    } else if($accion=="7"){
        echo Convocatorias();
    } else if($accion=="8"){
        echo GuardaConvocatorias($costos,$unidad,$puesto,$descripcion,$requisitos,$salario);
    } else if($accion=="9"){
        echo Convocatorias2($id);
    } else if($accion=="10"){
        echo GuardaConvocatorias2($id,$costos,$unidad,$puesto,$descripcion,$requisitos,$salario);
    } else if($accion=="11"){
        echo Descansos();
    } else if($accion=="12"){
        echo Descansos2($id);
    } else if($accion=="13"){
        echo GuardaFrase($detalle);
    } else if($accion=="14"){
        echo Frases();
    } else if($accion=="15"){
        echo Unidad($id);
    } else if($accion=="16"){
        echo CentroCostos();
    } else if($accion=="17"){
        echo Reglamentos();
    } else if($accion=="18"){
        echo Reglamentos2($id);
    } else if($accion2=="19"){
        echo Mejoras($usuario2,$detalle2);
    } else if($accion=="20"){
        echo Mejoras2($id);
    }
    
    
        function Login($id){
            include('conexion.php');
        
            $query = "SELECT * FROM empleados WHERE dni='$id' ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            
            $dat = 'no';
            while ($row = $result->fetch_array()){
                $dat='si'."#".$row['nombre']."#".$row['apellidos']."#".$row['dni']."#".$row['empresa']."#";
                $dat=$dat.$row['sucursal']."#".$row['area']."#".$row['subarea']."#".$row['email']."#";
            }
                
            return $dat;
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
    
        function Asistencia($id){
            include('conexion.php');
        
            $query = "SELECT * FROM asistencia WHERE empleado='$id' ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            
            while ($row = $result->fetch_array()){
                //$nombre = NombreUsuario($row['empleado']);
                $d = explode(":",$row['hora_inicio']);
                $dif = ((8*60 + 15) - (60*intval($d[0])+intval($d[1])));
                //echo $dif.'<br>';
                if(($dif >= 0) AND ($dif <= 15)){
                    $t = "2";
                    $tt = 'Temprano';
                    $tabla = $tabla . ''.$row['fecha'].'#';
                    $tabla = $tabla . ''.$row['hora_inicio'].'#'.$row['hora_fin'].'#'.$tt.'#'.$t.'#'.$dif.'##%';
                } else {
                    $t = "1";
                    $tt = 'Tarde';
                    $tabla = $tabla . ''.$row['fecha'].'#';
                    $tabla = $tabla . ''.$row['hora_inicio'].'#'.$row['hora_fin'].'#'.$tt.'#'.$t.'#'.$dif.'##%';
                }
                //$tabla = $tabla . ''.$row['fecha'].'#';
                //$tabla = $tabla . ''.$row['hora_inicio'].'#'.$row['hora_fin'].'#'.$tt.'#'.$t.'#%';
            }
            
            return $tabla;
        }
    
        function Beneficios($id){
            include('conexion.php');
        
            $query = "SELECT * FROM beneficios ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            
            while ($row = $result->fetch_array()){
                if($row['descuento_p']=="0"){
                    $descuento = 'S/ '.$row['descuento_m'];
                } else {
                    $descuento = $row['descuento_p'].' porc.';
                }
                $tabla = $tabla . $row['titulo'].'#'.$descuento.'#';
                $tabla = $tabla . $row['caducidad'].'#'.$row['detalle'].'#';
                $tabla = $tabla . $row['codigo'].'#'.$row['empresa'].'#';
                $tabla = $tabla . $row['condiciones'].'##%';
                
            }
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
    
        function VerBoletas($id){
            include('conexion.php');
        
            $query = "SELECT * FROM boletas WHERE dni='$id'";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            
            $tabla='';
            while ($row = $result->fetch_array()){
                
                $tabla = $tabla . ''.$row['periodo'].'#'.$row['tipo_documento'].'#'.$row['dni'].'#';
                $tabla = $tabla . ''.$row['nombre'].'#'.$row['centro_costos'].'#';
                $tabla = $tabla . ''.$row['unidad'].'#'.$row['cargo'].'#';
                $tabla = $tabla . ''.$row['remuneracion_basica'].'#';
                $tabla = $tabla . ''.$row['dias_laborados'].'#'.$row['descanso_medico'].'#';
                $tabla = $tabla . ''.$row['vacaciones'].'#'.$row['horas_trabajadas'].'#';
                $tabla = $tabla . ''.$row['haber_mensual'].'#'.$row['asignacion_importe'].'##';
                /*$tabla = $tabla . '<td>'.$row['vacaciones_importe'].'</td><td>'.$row['comisiones'].'</td>';
                $tabla = $tabla . '<td>'.$row['movilidad_importe'].'</td><td>'.$row['refrigerio_importe'].'</td>';
                $tabla = $tabla . '<td>'.$row['bonificacion'].'</td><td>'.$row['condicion'].'</td>';
                $tabla = $tabla . '<td>'.$row['base_imponible'].'</td><td>'.$row['total_bruto'].'</td>';
                $tabla = $tabla . '<td>'.$row['aporte_afp'].'</td><td>'.$row['comisiones_afp'].'</td>';
                $tabla = $tabla . '<td>'.$row['prima_afp'].'</td><td>'.$row['onp'].'</td>';
                $tabla = $tabla . '<td>'.$row['renta_5ta'].'</td><td>'.$row['prestamos'].'</td>';
                $tabla = $tabla . '<td>'.$row['adelantos'].'</td><td>'.$row['descuentos'].'</td>';
                $tabla = $tabla . '<td>'.$row['neto'].'</td><td>'.$row['esslud'].'</td>';
                $tabla = $tabla . '</tr>';*/
            }
            //$tabla = $tabla . '</tbody></table>';
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
            $tabla = $tabla . '</tbody></table>';
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
            $tabla = $tabla . '</tbody></table>';
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
    
        function CentroCostos2(){
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
                $costo = NombreCentro($row['centro_costos']);
                $unidad = NombreUnidad($row['unidad']);
    
                $direccion = '<a href="files/'.$row['archivo'].'" target="_blank">'.$row['archivo'].'</a>';
                $tabla = $tabla . '<tr><td>'.$costo.'</td><td>'.$unidad.'</td><td>'.$direccion.'</td>';
                $tabla = $tabla . '<td><img onclick="EditarReglamentos('.$row['id'].')" src="imagenes/editar.png"></td></tr>';
            }
            $tabla = $tabla . '</tbody></table>';
            return $tabla;
        }
    
    
        function Reglamentos2(){
            include('conexion.php');
        
            $query = "SELECT * FROM reglamento ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            
            $tabla = '';
            while ($row = $result->fetch_array()){
                $costo = CentroCostos2($row['centro_costos']);
                $unidad = Unidad2($row['unidad']);
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
    
        function Mejoras($usuario2,$detalle2){
            include('conexion.php');
                                        
            $sql = "INSERT INTO mejoras (ID_USUARIO,DETALLE) 
            VALUES ('$usuario2','$detalle2')";
            
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
                
                $query = "SELECT * FROM mejoras WHERE id_usuario='$usuario2' ";
                mysqli_set_charset($mysqli, 'utf8'); 
                $result = mysqli_query($mysqli, $query);
                while ($row = $result->fetch_array()){
                    $dat = $dat.$row['id']."#".$row['detalle']."#%";
                }
                return $dat;
                
            }
        } 


        function Mejoras2($usuario2){
            include('conexion.php');
                                        
            $query = "SELECT * FROM mejoras WHERE id_usuario='$usuario2' ";
                mysqli_set_charset($mysqli, 'utf8'); 
                $result = mysqli_query($mysqli, $query);
                while ($row = $result->fetch_array()){
                    $dat = $dat.$row['id']."#".$row['detalle']."#%";
                }
                return $dat;
                
        } 
    
    

?>