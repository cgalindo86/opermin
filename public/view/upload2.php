<?php
    
//comprobamos que sea una petici贸n ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $datos = $_POST['datos'];
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
        $d = explode("#",$datos);

        $empleado = $d[0];
        $fechaI = $d[1];
        $fechaF = $d[2];
        $filtro = $d[3];
    
        if($filtro=="descanso"){
            $mysqli = new mysqli('localhost', 'root', '', 'opermin');
    
            $query = "SELECT * FROM descansos WHERE empleado='$empleado' AND fecha_inicio='$fechaI' AND fecha_fin ='$fechaF' ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            $dat="";
            while ($row = $result->fetch_array()){
                $dat = $row['id'];
            }
            
            //echo $dat."#";
            
            if($dat==""){
                $sql = "INSERT INTO descansos (EMPLEADO,FECHA_INICIO,FECHA_FIN,DIRECCION) VALUES ('$empleado','$fechaI','$fechaF','$nom_arch')";
                
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
                $sql = "UPDATE descansos SET empleado='$empleado', fecha_inicio='$fechaI', fecha_fin='$fechaF', direccion='$nom_arch' WHERE id='$dat'";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    echo 'EXITO2';
                } 
            }
                
            echo "Documento subido correctamente";
            
        } else if($filtro=="frase"){
            $mysqli = new mysqli('localhost', 'root', '', 'opermin');
    
            $query = "SELECT * FROM frases WHERE detalle='$empleado' OR imagen='$nom_arch' ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            $dat="";
            while ($row = $result->fetch_array()){
                $dat = $row['id'];
            }
            
            //echo $dat."#";
            
            if($dat==""){
                $sql = "INSERT INTO frases (DETALLE,IMAGEN) VALUES ('$empleado','$nom_arch')";
                
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
                $sql = "UPDATE frases SET detalle='$empleado', imagen='$nom_arch' WHERE id='$dat'";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    echo 'EXITO2';
                } 
            }
                
            echo "Documento subido correctamente";

        } else if($filtro=="reglamento"){
            $mysqli = new mysqli('localhost', 'root', '', 'opermin');
    
            $query = "SELECT * FROM reglamento WHERE centro_costos='$empleado' AND unidad='$fechaI' ";
            mysqli_set_charset($mysqli, 'utf8'); 
            $result = mysqli_query($mysqli, $query);
            $dat="";
            while ($row = $result->fetch_array()){
                $dat = $row['id'];
            }
            
            //echo $dat."#";
            
            if($dat==""){
                $sql = "INSERT INTO reglamento (CENTRO_COSTOS,UNIDAD,ARCHIVO) VALUES ('$empleado','$fechaI','$nom_arch')";
                
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
                $sql = "UPDATE reglamento SET centro_costos='$empleado', unidad='$unidad', archivo='$nom_arch' WHERE id='$dat'";
                
                if (!$resultado = $mysqli->query($sql)) {
                    
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    echo "Error: La ejecución de la consulta falló debido a: \n";
                    echo "Query: " . $sql . "\n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    
                    exit;
                } else {
                    echo 'EXITO2';
                } 
            }
                
            echo "Documento subido correctamente";
        }  else if($filtro=="interes"){
            $mysqli = new mysqli('localhost', 'root', '', 'opermin');
    
            $sql = "INSERT INTO temas (TITULO,DETALLE) VALUES ('$empleado','$fechaI')";
                
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
            
            $sql2 = "INSERT INTO temas (TEMA,TIPO,DETALLE) VALUES ('$idT','$fechaF','$fechaI')";
                
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
            
            
                
            echo "Documento subido correctamente";
        }
    }
    
}else{
    throw new Exception("Error Processing Request", 1);   
}


?>