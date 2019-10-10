<?php
    ini_set("display_errors", false);
    $accion = $_POST['accion'];
    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
	$password  = $_POST['password'];
    $codigo = $_POST['codigo'];
    $empresa = $_POST['empresa'];
	$detalle = $_POST['detalle'];
	$descuento_p = $_POST['descuento_p'];
	$descuento_m = $_POST['descuento_m'];
	$condiciones = $_POST['condiciones'];
	$caducidad = $_POST['caducidad'];
    $costos = $_POST['costos'];
	$unidad = $_POST['unidad'];
	$puesto = $_POST['puesto'];
	$descripcion = $_POST['descripcion'];
	$requisitos = $_POST['requisitos'];
    $salario = $_POST['salario'];
    $titulo = $_POST['titulo'];
    $material = $_POST['material'];
    $tipo = $_POST['tipo'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $centro = $_POST['centro'];
    $unidad = $_POST['unidad'];
    $curso = $_POST['curso'];
    $sesion = $_POST['sesion'];
    $tipomat = $_POST['tipomat'];

	include('../model/Usuario.php');
	
	$miprod = new Usuario("");

    if($accion=="1"){
        echo $miprod -> Asistencia($fecha);
    } else if($accion=="2"){
        echo $miprod -> Beneficios();
    } else if($accion=="3"){
        echo $miprod -> GuardaBeneficios($codigo,$titulo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad);
    } else if($accion=="4"){
        echo $miprod -> VerBoletas();
    } else if($accion=="5"){
        echo $miprod -> Beneficios2($id);
    } else if($accion=="6"){
        echo $miprod -> GuardaBeneficios2($id,$codigo,$titulo,$empresa,$detalle,$descuento_p,$descuento_m,$condiciones,$caducidad);
    } else if($accion=="7"){
        echo $miprod -> Convocatorias();
    } else if($accion=="8"){
        echo $miprod -> GuardaConvocatorias($costos,$unidad,$puesto,$descripcion,$requisitos,$salario);
    } else if($accion=="9"){
        echo $miprod -> Convocatorias2($id);
    } else if($accion=="10"){
        echo $miprod -> GuardaConvocatorias2($id,$costos,$unidad,$puesto,$descripcion,$requisitos,$salario);
    } else if($accion=="11"){
        echo $miprod -> Descansos();
    } else if($accion=="12"){
        echo $miprod -> Descansos2($id);
    } else if($accion=="13"){
        echo $miprod -> GuardaFrase($detalle);
    } else if($accion=="14"){
        echo $miprod -> Frases();
    } else if($accion=="15"){
        echo $miprod -> Unidad($id);
    } else if($accion=="16"){
        echo $miprod -> CentroCostos();
    } else if($accion=="17"){
        echo $miprod -> Reglamentos();
    } else if($accion=="18"){
        echo $miprod -> Reglamentos2($id);
    } else if($accion=="19"){
        echo $miprod -> GuardaInteres($titulo,$detalle,$tipo,$material);
    } else if($accion=="20"){
        echo $miprod -> Interes();
    } else if($accion=="21"){
        echo $miprod -> Usuarios();
    } else if($accion=="22"){
        echo $miprod -> GuardaUsuarios($apellidos,$nombre,$dni,$correo,$centro,$unidad);
    } else if($accion=="23"){
        echo $miprod -> Usuarios2($id);
    } else if($accion=="24"){
        echo $miprod -> EditaUsuarios($id,$apellidos,$nombre,$dni,$correo,$centro,$unidad);
    } else if($accion=="25"){
        echo $miprod -> Capacitaciones();
    } else if($accion=="26"){
        echo $miprod -> GuardaCapacitaciones($nombre,$centro,$unidad);
    } else if($accion=="27"){
        echo $miprod -> Capacitaciones2($id);
    } else if($accion=="28"){
        echo $miprod -> EditaCapacitaciones($id,$nombre,$centro,$unidad);
    } else if($accion=="29"){
        echo $miprod -> Sesiones($tipo,$curso);
    } else if($accion=="30"){
        echo $miprod -> GuardaSesiones($tipo,$curso,$nombre);
    } else if($accion=="31"){
        echo $miprod -> Sesiones2($id,$tipo,$curso);
    } else if($accion=="32"){
        echo $miprod -> EditaSesiones($id,$tipo,$curso,$nombre);
    } else if($accion=="33"){
        echo $miprod -> Materiales($tipo,$sesion);
    } else if($accion=="34"){
        echo $miprod -> GuardaMateriales($tipo,$tipomat,$sesion,$nombre);
    } else if($accion=="35"){
        echo $miprod -> Materiales2($id,$tipo,$sesion);
    } else if($accion=="36"){
        echo $miprod -> EditaMateriales($id,$tipo,$tipomat,$sesion,$nombre);
    } else if($accion=="37"){
        echo $miprod -> Inducciones();
    } else if($accion=="38"){
        echo $miprod -> GuardaInducciones($nombre,$centro,$unidad);
    } else if($accion=="39"){
        echo $miprod -> Inducciones2($id);
    } else if($accion=="40"){
        echo $miprod -> EditaInducciones($id,$nombre,$centro,$unidad);
    } else if($accion=="41"){
        echo $miprod -> Mejoras();
    } else if($accion=="42"){
        echo $miprod -> Procedimientos();
    } else if($accion=="43"){
        echo $miprod -> Procedimientos2($id);
    }

    
?>