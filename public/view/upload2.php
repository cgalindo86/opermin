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
        $sql = "INSERT INTO descansos (EMPLEADO,FECHA_INICIO,FECHA_FIN) VALUES ('$empleado','$fechaI','$fechaF')";
        
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
        //echo $datos.'<br>';
        echo "Documento subido correctamente";
    }
}else{
    throw new Exception("Error Processing Request", 1);   
}


?>