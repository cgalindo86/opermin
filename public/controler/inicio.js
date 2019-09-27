
$(document).ready(function () {
	MainApp();

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
	console.log("ocultar");
}

function GuardaBeneficios(){
	$.post("../controler/usuario.php", {
		accion: "3",
		codigo: $("#bcodigo").val(),
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
		$("#rcostos2").html(htmlexterno);
		console.log("c16 "+htmlexterno+"");
	});

}

function CambioCentroCostos(){
	var $v = document.getElementById("icostos").value;
	console.log("c15 "+$v+"");
	$.post("../controler/usuario.php", {
		accion: "15",
		id: $v
	}, function(htmlexterno){
		$("#runidad").html(htmlexterno);
		$("#runidad2").html(htmlexterno);
		console.log("c15 "+htmlexterno+"");
	});
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
		accion: "11"
	}, function(htmlexterno){

	$("#cuerpoInteres").html(htmlexterno);
		console.log(htmlexterno+"");
	});
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
		accion: "11"
	}, function(htmlexterno){

	$("#cuerpoUsuarios").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

