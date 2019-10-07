var $senal='';
var $curso='';
var $tipoCurso='';
var $sesion='';

$(document).ready(function () {
	MainApp();

	$("#addInteres").click(function(){
		$("#cuerpoInteres2").show();
		$("#cuerpoInteres").hide();
	});

	$("#addUsuarios").click(function(){
		$senal = '1';
		$("#cuerpoUsuarios2").show();
		$("#cuerpoUsuarios").hide();
	});	
	
});


function MainApp() {
	init();
}

function init(){
	$("#mgif").hide();
	Ocultar();
	console.log("ini");
}

function Ocultar(){
	$("#campoAsistencias").hide();
	$("#campoBeneficios").hide();
	$("#cuerpoBeneficios").hide();
	$("#cuerpoBeneficios2").hide();
	$("#campoBoletas").hide();
	$("#campoConvocatorias").hide();
	$("#campoDescanso").hide();
	$("#campoFrases").hide();
	$("#campoNotificaciones").hide();
	$("#campoReglamentos").hide();
	$("#campoInteres").hide();
	$("#campoUsuarios").hide();

	$("#campoCapacitaciones").hide();
	$("#campoSesiones").hide();
	$("#campoMateriales").hide();
	$("#campoInducciones").hide();
	$("#campoMejoras").hide();
	$("#campoProcedimientos").hide();
	$("#campoVideos").hide();
	console.log("ocultar");
}

function GuardaBeneficios(){
	$.post("../controler/usuario.php", {
		accion: "3",
		codigo: $("#bcodigo").val(),
		titulo: $("#btitulo").val(),
		empresa: $("#bempresa").val(),
		detalle: $("#bdetalle").val(),
		descuento_p: $("#bdescuento_p").val(),
		descuento_m: $("#bdescuento_m").val(),
		condiciones: $("#bcondiciones").val(),
		caducidad: $("#bfecha").val()
	}, function(htmlexterno){
		Beneficios();
	});
}

function GuardaConvocatorias(){
	$.post("../controler/usuario.php", {
		accion: "8",
		costos: $("#ccostos").val(),
		unidad: $("#cunidad").val(),
		puesto: $("#cpuesto").val(),
		descripcion: $("#cdescripcion").val(),
		requisitos: $("#crequisitos").val(),
		salario: $("#csalario").val()

	}, function(htmlexterno){
		Convocatorias();
	});
}

function GuardaFrase(){
	$.post("../controler/usuario.php", {
		accion: "13",
		detalle: $("#fdetalle").val()

	}, function(htmlexterno){
		Frases();
	});
}

function GuardaReglamentos(){
	Reglamentos();
}

function GuardaEditarBeneficios(){
	if($("#bfecha2").val()!=""){
		$caducidad = $("#bfecha2").val();
	} else {
		$caducidad = caducidadi;
	}
	$.post("../controler/usuario.php", {
		accion: "6",
		id: $mid,
		codigo: $("#bcodigo2").val(),
		titulo: $("#btitulo2").val(),
		empresa: $("#bempresa2").val(),
		detalle: $("#bdetalle2").val(),
		descuento_p: $("#bdescuento_p2").val(),
		descuento_m: $("#bdescuento_m2").val(),
		condiciones: $("#bcondiciones2").val(),
		caducidad: $caducidad
	}, function(htmlexterno){
		Beneficios();
	});
}

function GuardaEditarConvocatorias(){

	$.post("../controler/usuario.php", {
		accion: "10",
		id: $mid,
		costos: $("#ccostos2").val(),
		unidad: $("#cunidad2").val(),
		puesto: $("#cpuesto2").val(),
		descripcion: $("#cdescripcion2").val(),
		requisitos: $("#crequisitos2").val(),
		salario: $("#csalario2").val()
	}, function(htmlexterno){
		Convocatorias();
	});
}

function GuardaInteres(){
	var x = document.getElementById("itipo").selectedIndex;
    var y = document.getElementById("itipo").options;
	var tipo = y[x].value;
	
	if(tipo!="0"){
		var v = document.getElementById("ititulo").value;
		var v2 = document.getElementById("idetalle").value;
		var mat = document.getElementById("itexto").value;
		if(v!="" && v2!="2"){
			$.post("../controler/usuario.php", {
				accion: "19",
				titulo: v,
				detalle: v2,
				tipo: tipo,
				material: mat

			}, function(htmlexterno){
				Interes();
			});
		} else {

		}
	} else {
		alert("Elegir tipo material");
	}
}

function GuardaUsuarios(){
	var x = document.getElementById("ucentro").selectedIndex;
    var y = document.getElementById("ucentro").options;
	var centro = y[x].value;
	
	var x = document.getElementById("uunidad").selectedIndex;
    var y = document.getElementById("uunidad").options;
	var unidad = y[x].value;
	
	if(centro!="0" && unidad != "0"){
		var apellidos = document.getElementById("uapellidos").value;
		var nombre = document.getElementById("unombres").value;
		var dni = document.getElementById("udocumento").value;
		var correo = document.getElementById("ucorreo").value;
		//alert($senal);
		if(apellidos!="" && nombre!="" && dni!="" && correo!=""){
			if($senal=="1"){
				$.post("../controler/usuario.php", {
					accion: "22",
					apellidos: apellidos,
					nombre: nombre,
					dni: dni,
					correo: correo,
					centro: centro,
					unidad: unidad
	
				}, function(htmlexterno){
					Usuarios();
				});
			} else {
				$.post("../controler/usuario.php", {
					accion: "24",
					id: $mid,
					apellidos: apellidos,
					nombre: nombre,
					dni: dni,
					correo: correo,
					centro: centro,
					unidad: unidad
	
				}, function(htmlexterno){
					Usuarios();
				});
			}
			
		} else {
			alert("Ingrese datos");
		}
	} else {
		alert("Elegir centro de costos o unidad");
	}
}

function GuardaCapacitacion(){
	var x = document.getElementById("capcostos").selectedIndex;
    var y = document.getElementById("capcostos").options;
	var centro = y[x].value;
	
	var x = document.getElementById("capunidad").selectedIndex;
    var y = document.getElementById("capunidad").options;
	var unidad = y[x].value;
	
	if(centro!="0" && unidad != "0"){
		var nombre = document.getElementById("capnombre").value;
		
		if(nombre!=""){
			if($senal=="1"){
				$.post("../controler/usuario.php", {
					accion: "26",
					nombre: nombre,
					centro: centro,
					unidad: unidad
	
				}, function(htmlexterno){
					Capacitaciones();
				});
			} else {
				$.post("../controler/usuario.php", {
					accion: "28",
					id: $mid,
					nombre: nombre,
					centro: centro,
					unidad: unidad
	
				}, function(htmlexterno){
					Capacitaciones();
				});
			}
			
		} else {
			alert("Ingrese datos");
		}
	} else {
		alert("Elegir centro de costos o unidad");
	}
}

function GuardaSesion(){
	
	var nombre = document.getElementById("sesnombre").value;
		
	if(nombre!=""){
		if($senal=="1"){
			$.post("../controler/usuario.php", {
				accion: "30",
				nombre: nombre,
				tipo: $tipoCurso,
				curso: $curso
		
			}, function(htmlexterno){
				Sesiones();
			});
		} else {
			$.post("../controler/usuario.php", {
				accion: "32",
				id: $mid,
				nombre: nombre,
				tipo: $tipoCurso,
				curso: $curso
		
			}, function(htmlexterno){
				Sesiones();
			});
		}
		
			
			
	} else {
		alert("Ingrese datos");
	}
	
}


function EditarBeneficios($id){
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "5", id:$id
	}, function(htmlexterno){
		$("#cuerpoBeneficios2").show();
		$("#cuerpoBeneficios").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		caducidadi = txt[6];
		console.log(txt[0]+"-"+txt[1]+"-"+txt[2]+"-"+txt[3]+"-"+txt[4]+"-"+txt[5]+"-"+txt[6]);
		document.getElementById("bcodigo2").value = txt[0];
		document.getElementById("bempresa2").value = txt[1];
		document.getElementById("bdetalle2").innerHTML = txt[2];
		document.getElementById("bdescuento_p2").value = txt[3];
		document.getElementById("bdescuento_m2").value = txt[4];
		document.getElementById("bcondiciones2").innerHTML = txt[5];
		document.getElementById("nfecha2").innerHTML = 'Actual: '+txt[6]+'<br><input name="datepicker" type="date" id="bfecha2" style="width:150px;" value="'+txt[6]+'" />';
		document.getElementById("btitulo2").innerHTML = txt[7];
	});
}

function EditarConvocatorias($id){
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "9", id:$id
	}, function(htmlexterno){
		$("#cuerpoConvocatorias2").show();
		$("#cuerpoConvocatorias").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		//console.log(txt[0]+"-"+txt[1]+"-"+txt[2]+"-"+txt[3]+"-"+txt[4]+"-"+txt[5]+"-"+txt[6]);
		document.getElementById("ccostos2").value = txt[0];
		document.getElementById("cunidad2").value = txt[1];
		document.getElementById("cpuesto2").value = txt[2];
		document.getElementById("cdescripcion2").innerHTML = txt[3];
		document.getElementById("crequisitos2").innerHTML = txt[4];
		document.getElementById("csalario2").value = txt[5];

	});
}

function EditarDescanso($id){
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "12", id:$id
	}, function(htmlexterno){
		$("#cuerpoDescanso2").show();
		$("#cuerpoDescanso").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		//console.log(txt[0]+"-"+txt[1]+"-"+txt[2]+"-"+txt[3]+"-"+txt[4]+"-"+txt[5]+"-"+txt[6]);
		document.getElementById("ddocumento2").value = txt[0];
		document.getElementById("nfechaInicio2").innerHTML = 'Actual: '+txt[1]+'<br><input name="datepicker" type="date" id="dfechaInicio2" style="width:150px;" value="'+txt[1]+'" />';
		document.getElementById("nfechaFin2").innerHTML = 'Actual: '+txt[2]+'<br><input name="datepicker" type="date" id="dfechaFin2" style="width:150px;" value="'+txt[2]+'" />';
		document.getElementById("ddireccion2").innerHTML = txt[3];
		
	});
}

function EditarUsuarios($id){
	$senal = '2';
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "23", id:$id
	}, function(htmlexterno){
		$("#cuerpoUsuarios2").show();
		$("#cuerpoUsuarios").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		//console.log(txt[0]+"-"+txt[1]+"-"+txt[2]+"-"+txt[3]+"-"+txt[4]+"-"+txt[5]+"-"+txt[6]);
		document.getElementById("uapellidos").value = txt[0];
		document.getElementById("unombres").value = txt[1];
		document.getElementById("udocumento").value = txt[2];
		document.getElementById("ucorreo").value = txt[3];
		
	});
}

function EditarCapacitaciones($id){
	$senal = '2';
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "27", id:$id
	}, function(htmlexterno){
		$("#cuerpoCapacitaciones2").show();
		$("#cuerpoCapacitaciones").hide();
		$("#cabeceraCapacitaciones").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		var ss = txt[1];
		ss = ss.replace("icostos","capcostos");
		ss = ss.replace("CambioCentroCostos","CambioCentroCostos3");

		var tt = txt[2];
		tt = tt.replace("iunidad","capunidad");

		document.getElementById("capnombre").value = txt[0];
		document.getElementById("selectCapCentro").innerHTML = ss;
		document.getElementById("selectCapUnidad").innerHTML = tt;
		
	});
}

function EditarSesiones($id){
	$senal = '2';
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "31", 
		id:$id,
		tipo: $tipoCurso,
		curso: $curso
	}, function(htmlexterno){
		$("#cuerpoSesiones2").show();
		$("#cuerpoSesiones").hide();
		$("#cabeceraSesiones").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");

		document.getElementById("sesnombre").value = txt[0];
		
	});
}

function Asistencias(){
	Ocultar();
	$("#campoAsistencias").show();

	document.getElementById("asistencia").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "1"
	}, function(htmlexterno){
		console.log("1");
		$("#cuerpoAsistencias").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function Beneficios(){
	Ocultar();
	$("#campoBeneficios").show();
	$("#cuerpoBeneficios").show();
	$("#cuerpoBeneficios2").hide();
	document.getElementById("beneficios").style.background = "#273156";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "2"
	}, function(htmlexterno){
		console.log("2");
		$("#cuerpoBeneficios").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function Boletas(){
	Ocultar();
	$("#campoBoletas").show();

	document.getElementById("boletas").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

}

function CargarBoletas(){
	document.getElementById("cuerpoBoletas").innerHTML = '<iframe src="cargar.php" style="width:80%; height:300px;"></iframe><br>';
}

function VerBoletas(){
	$.post("../controler/usuario.php", {
		accion: "4"
	}, function(htmlexterno){
		$("#cuerpoBoletas").html(htmlexterno);

	});
}

function Convocatorias(){
	Ocultar();
	$("#campoConvocatorias").show();
	$("#cuerpoConvocatorias").show();
	$("#cuerpoConvocatorias2").hide();

	document.getElementById("convocatorias").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "7"
	}, function(htmlexterno){

	$("#cuerpoConvocatorias").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function Descanso(){
	Ocultar();
	
	$("#campoDescanso").show();
	$("#cuerpoDescanso").show();
	$("#cuerpoDescanso2").hide();

	document.getElementById("descanso").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "11"
	}, function(htmlexterno){

	$("#cuerpoDescanso").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function AgregarArchDescanso(){
	$doc = $("#ddocumento").val();
	$fini = $("#dfechaInicio").val();
	$ffin = $("#dfechaFin").val();

	$enlace = "cargar2.php?doc="+$doc+"&fini="+$fini+"&ffin="+$ffin+"&filtro=descanso";
	console.log("enlace",$enlace);
	document.getElementById("archDescanso").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

function AgregarArchDescanso2(){
	$doc = $("#ddocumento2").val();
	$fini = $("#dfechaInicio2").val();
	$ffin = $("#dfechaFin2").val();

	$enlace = "cargar2.php?doc="+$doc+"&fini="+$fini+"&ffin="+$ffin+"&filtro=descanso";
	console.log("enlace",$enlace);
	document.getElementById("archDescanso2").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

function Frases(){
	Ocultar();
	
	$("#campoFrases").show();
	$("#cuerpoFrases").show();
	$("#cuerpoFrases2").hide();

	document.getElementById("frases").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "14"
	}, function(htmlexterno){

	$("#cuerpoFrases").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function EditarFrase($id){
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "12", id:$id
	}, function(htmlexterno){
		$("#cuerpoFrase2").show();
		$("#cuerpoFrase").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		//console.log(txt[0]+"-"+txt[1]+"-"+txt[2]+"-"+txt[3]+"-"+txt[4]+"-"+txt[5]+"-"+txt[6]);
		document.getElementById("fdetalle2").value = txt[0];
		/*document.getElementById("nfechaInicio2").innerHTML = 'Actual: '+txt[1]+'<br><input name="datepicker" type="date" id="dfechaInicio2" style="width:150px;" value="'+txt[1]+'" />';
		document.getElementById("nfechaFin2").innerHTML = 'Actual: '+txt[2]+'<br><input name="datepicker" type="date" id="dfechaFin2" style="width:150px;" value="'+txt[2]+'" />';
		document.getElementById("ddireccion2").innerHTML = txt[3];*/
		
	});
}

function EditarReglamentos($id){
	$mid = $id;
	$.post("../controler/usuario.php", {
		accion: "18", id:$id
	}, function(htmlexterno){
		$("#cuerpoReglamentos2").show();
		$("#cuerpoReglamentos").hide();
		console.log(htmlexterno);
		var txt;
		txt = htmlexterno.split("#");
		document.getElementById("rcostos2").innerHTML = txt[0];
		document.getElementById("runidad2").innerHTML = txt[1];
		document.getElementById("rarchivo2").innerHTML = txt[2];
		
	});
}


function AgregarArchFrase(){
	$doc = $("#fdetalle").val();
	$fini = "";
	$ffin = "";

	$enlace = "cargar2.php?doc="+$doc+"&fini="+$fini+"&ffin="+$ffin+"&filtro=frase";
	console.log("enlace",$enlace);
	document.getElementById("archFrase").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

function AgregarArchFrase2(){
	$doc = $("#fdetalle2").val();
	$fini = "";
	$ffin = "";

	$enlace = "cargar2.php?doc="+$doc+"&fini="+$fini+"&ffin="+$ffin+"&filtro=frase";
	console.log("enlace",$enlace);
	document.getElementById("archFrase2").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

function Notificaciones(){
	Ocultar();
	
	$("#campoNotificaciones").show();
	$("#cuerpoNotificaciones").show();
	$("#cuerpoNotificaciones2").hide();

	document.getElementById("notificaciones").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	/*$.post("../controler/usuario.php", {
		accion: "11"
	}, function(htmlexterno){

	$("#cuerpoNotificaciones").html(htmlexterno);
		console.log(htmlexterno+"");
	});*/
}

function Reglamentos(){
	Ocultar();
	
	$("#campoReglamentos").show();
	$("#cuerpoReglamentos").show();
	$("#cuerpoReglamentos2").hide();

	document.getElementById("reglamentos").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "16"
	}, function(htmlexterno){
		$("#rcostos").html(htmlexterno);
		htmlexterno = htmlexterno.replace("icostos","icostos2");
		htmlexterno = htmlexterno.replace("CambioCentroCostos","CambioCentroCostos2");
		$("#rcostos2").html(htmlexterno);
		console.log("c16 "+htmlexterno+"");
	});

	$.post("../controler/usuario.php", {
		accion: "17"
	}, function(htmlexterno){

		$("#cuerpoReglamentos").html(htmlexterno);
		console.log(htmlexterno+"");s
	});

}

function CambioCentroCostos(){
	var x = document.getElementById("icostos").selectedIndex;
    var y = document.getElementById("icostos").options;
    var v2 = y[x].value;
	console.log("c15 aa "+v2+"");
	$.post("../controler/usuario.php", {
		accion: "15",
		id: v2
	}, function(htmlexterno){
		$("#runidad").html(htmlexterno);
		//htmlexterno = htmlexterno.replace("iunidad","iunidad2");
		//htmlexterno = htmlexterno.replace("CambioCentroCostos","CambioCentroCostos2");
		//$("#runidad2").html(htmlexterno);
		console.log("c15 "+htmlexterno+"");
	});
}

function CambioCentroCostos2(){
	var x = document.getElementById("icostos2").selectedIndex;
    var y = document.getElementById("icostos2").options;
    var v2 = y[x].value;
	console.log("c15 aa "+v2+"");
	$.post("../controler/usuario.php", {
		accion: "15",
		id: v2
	}, function(htmlexterno){
		//$("#runidad").html(htmlexterno);
		htmlexterno = htmlexterno.replace("iunidad","iunidad2");
		$("#runidad2").html(htmlexterno);
		console.log("c15 "+htmlexterno+"");
	});
}

function CambioCentroCostos3(){
	var x = document.getElementById("capcostos").selectedIndex;
    var y = document.getElementById("capcostos").options;
    var v2 = y[x].value;
	//console.log("c15 aa "+v2+"");
	$.post("../controler/usuario.php", {
		accion: "15",
		id: v2
	}, function(htmlexterno){
		//$("#runidad").html(htmlexterno);
		htmlexterno = htmlexterno.replace("iunidad","capunidad");
		$("#selectCapUnidad").html(htmlexterno);
		console.log("c00 "+htmlexterno+"");
	});
}

function AgregarArchReglamentos(){
	var v = document.getElementById("icostos").value;
	var v2 = document.getElementById("iunidad").value;
	$enlace = "cargar2.php?doc="+v+"&fini="+v2+"&ffin="+"&filtro=reglamento";
	console.log("enlace",$enlace);
	document.getElementById("archReglamentos").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

function AgregarArchReglamentos2(){
	var v = document.getElementById("icostos2").value;
	var v2 = document.getElementById("iunidad2").value;
	$enlace = "cargar2.php?doc="+v+"&fini="+v2+"&ffin="+"&filtro=reglamento";
	console.log("enlace",$enlace);
	document.getElementById("archReglamentos2").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

function Interes(){
	Ocultar();
	
	$("#campoInteres").show();
	$("#cuerpoInteres").show();
	$("#cuerpoInteres2").hide();

	document.getElementById("interes").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "20"
	}, function(htmlexterno){

	$("#cuerpoInteres").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}



function TipoInteres(){
	var x = document.getElementById("itipo").selectedIndex;
    var y = document.getElementById("itipo").options;
	var tipo = y[x].value;
	
	if(tipo!="0"){
		if(tipo=="1" || tipo=="2"){
			$("#imaterial1").show();
			$("#imaterial2").hide();
			
		} else {
			$("#imaterial1").hide();
			$("#imaterial2").show();
			var v = document.getElementById("ititulo").value;
			var v2 = document.getElementById("idetalle").value;

			if(v != "" && v2 != ""){
				var w = v.split(" ");
				for(var i=0; i<w.length; i++){
					v = v.replace(" ","_");
				}

				var w2 = v2.split(" ");
				for(var i2=0; i2<w2.length; i2++){
					v2 = v2.replace(" ","_");
				}
				//v2 = v2.replace(" ","_");

				$enlace = "cargar2.php?doc="+v+"&fini="+v2+"&ffin="+tipo+"&filtro=interes";
				console.log("enlace",$enlace);
				document.getElementById("archInteres").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
			} else {
				alert("Ingrese datos de titulo y detalle");
			}
			
		}
	} else {

	}
}


function TipoMaterial(){
	var x = document.getElementById("mattipo").selectedIndex;
    var y = document.getElementById("mattipo").options;
	var tipo = y[x].value;
	
	if(tipo!="0"){
		if(tipo=="1" || tipo=="2"){
			$("#matmaterial1").show();
			$("#matmaterial2").hide();
			
		} else {
			$("#matmaterial1").hide();
			$("#matmaterial2").show();
			var v = $sesion;
			var v2 = "";

			$enlace = "cargar2.php?doc="+v+"&fini="+v2+"&ffin="+tipo+"&filtro=materiales";
			console.log("enlace",$enlace);
			document.getElementById("archMateriales").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
			
		}
	} else {

	}
}



function Usuarios(){
	Ocultar();
	
	$("#campoUsuarios").show();
	$("#cuerpoUsuarios").show();
	$("#cuerpoUsuarios2").hide();

	document.getElementById("usuarios").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";
	document.getElementById("frases").style.background = "transparent";
	document.getElementById("notificaciones").style.background = "transparent";
	document.getElementById("reglamentos").style.background = "transparent";
	document.getElementById("interes").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "21"
	}, function(htmlexterno){

	$("#cuerpoUsuarios").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}


function Capacitaciones(){
	Ocultar();
	
	$("#campoCapacitaciones").show();
	$("#cabeceraCapacitaciones").show();
	$("#cuerpoCapacitaciones").show();
	$("#cuerpoCapacitaciones2").hide();

	document.getElementById("capacitaciones").style.background = "#273156";
	document.getElementById("inducciones").style.background = "transparent";
	document.getElementById("mejoras").style.background = "transparent";
	document.getElementById("procedimientos").style.background = "transparent";
	document.getElementById("videos").style.background = "transparent";

	$.post("../controler/usuario.php", {
		accion: "25"
	}, function(htmlexterno){

		$("#cuerpoCapacitaciones").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function Inducciones(){
	Ocultar();
	
	$("#campoInducciones").show();
	$("#cuerpoInducciones").show();
	$("#cuerpoInducciones2").hide();

	document.getElementById("inducciones").style.background = "#273156";
	document.getElementById("capacitaciones").style.background = "transparent";
	document.getElementById("mejoras").style.background = "transparent";
	document.getElementById("procedimientos").style.background = "transparent";
	document.getElementById("videos").style.background = "transparent";

	/*$.post("../controler/usuario.php", {
		accion: "21"
	}, function(htmlexterno){

	$("#cuerpoUsuarios").html(htmlexterno);
		console.log(htmlexterno+"");
	});*/
}

function Mejoras(){
	Ocultar();
	
	$("#campoMejoras").show();
	$("#cuerpoMejoras").show();
	$("#cuerpoMejoras2").hide();

	document.getElementById("mejoras").style.background = "#273156";
	document.getElementById("inducciones").style.background = "transparent";
	document.getElementById("capacitaciones").style.background = "transparent";
	document.getElementById("procedimientos").style.background = "transparent";
	document.getElementById("videos").style.background = "transparent";

	/*$.post("../controler/usuario.php", {
		accion: "21"
	}, function(htmlexterno){

	$("#cuerpoUsuarios").html(htmlexterno);
		console.log(htmlexterno+"");
	});*/
}

function Procedimientos(){
	Ocultar();
	
	$("#campoProcedimientos").show();
	$("#cuerpoProcedimientos").show();
	$("#cuerpoProcedimientos2").hide();

	document.getElementById("procedimientos").style.background = "#273156";
	document.getElementById("inducciones").style.background = "transparent";
	document.getElementById("mejoras").style.background = "transparent";
	document.getElementById("capacitaciones").style.background = "transparent";
	document.getElementById("videos").style.background = "transparent";

	/*$.post("../controler/usuario.php", {
		accion: "21"
	}, function(htmlexterno){

	$("#cuerpoUsuarios").html(htmlexterno);
		console.log(htmlexterno+"");
	});*/
}

function Videos(){
	Ocultar();
	
	$("#campoVideos").show();
	$("#cuerpoVideos").show();
	$("#cuerpoVideos2").hide();

	document.getElementById("videos").style.background = "#273156";
	document.getElementById("inducciones").style.background = "transparent";
	document.getElementById("mejoras").style.background = "transparent";
	document.getElementById("procedimientos").style.background = "transparent";
	document.getElementById("capacitaciones").style.background = "transparent";

	/*$.post("../controler/usuario.php", {
		accion: "21"
	}, function(htmlexterno){

	$("#cuerpoUsuarios").html(htmlexterno);
		console.log(htmlexterno+"");
	});*/
}


function Sesiones(){
	Ocultar();
	
	$("#campoSesiones").show();
	$("#cabeceraSesiones").show();
	$("#cuerpoSesiones").show();
	$("#cuerpoSesiones2").hide();

	$.post("../controler/usuario.php", {
		accion: "29",
		tipo: $tipoCurso,
		curso: $curso
	}, function(htmlexterno){

		$("#cuerpoSesiones").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function AddCapacitaciones(){
	$senal = '1';
	$("#cabeceraCapacitaciones").hide();
	$("#cuerpoCapacitaciones2").show();
	$("#cuerpoCapacitaciones").hide();

	$.post("../controler/usuario.php", {
		accion: "16"
	}, function(htmlexterno){
		htmlexterno = htmlexterno.replace("icostos","capcostos");
		htmlexterno = htmlexterno.replace("CambioCentroCostos","CambioCentroCostos3");
		$("#selectCapCentro").html(htmlexterno);
		console.log(htmlexterno+"");
	});

}

function VerCapacitaciones($id){
	$curso = $id;
	$tipoCurso = '1';
	Ocultar();
	
	$("#campoSesiones").show();
	$("#cabeceraSesiones").show();
	$("#cuerpoSesiones").show();
	$("#cuerpoSesiones2").hide();

	$.post("../controler/usuario.php", {
		accion: "29",
		tipo: $tipoCurso,
		curso: $curso
	}, function(htmlexterno){

		$("#cuerpoSesiones").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function VerSesiones($id){
	$sesion = $id;
	$tipoCurso = '1';
	Ocultar();
	
	$("#campoMateriales").show();
	$("#cabeceraMateriales").show();
	$("#cuerpoMateriales").show();
	$("#cuerpoMateriales2").hide();

	$.post("../controler/usuario.php", {
		accion: "33",
		tipo: $tipoCurso,
		sesion: $sesion
	}, function(htmlexterno){

		$("#cuerpoMateriales").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function AddSesiones(){
	
	$("#cabeceraSesiones").hide();
	$("#cuerpoSesiones2").show();
	$("#cuerpoSesiones").hide();

}

function AddMateriales(){
	
	$("#cabeceraMateriales").hide();
	$("#cuerpoMateriales2").show();
	$("#cuerpoMateriales").hide();

}