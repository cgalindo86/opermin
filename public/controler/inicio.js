
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
	$("#campoFuncion").hide();
	$("#campoPerfil").hide();
	$("#campoUsuarios").hide();
	$("#campoOpcion").hide();
	$("#campoParametros").hide();
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

function Asistencias(){
	Ocultar();
	$("#campoAsistencias").show();

	document.getElementById("asistencia").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("descanso").style.background = "transparent";

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

	$.post("../controler/usuario.php", {
		accion: "7"
	}, function(htmlexterno){

	$("#cuerpoConvocatorias").html(htmlexterno);
		console.log(htmlexterno+"");
	});
}

function Descanso(){
	Ocultar();
	//$("#campoUsuarios").show();
	document.getElementById("descanso").style.background = "#273156";
	document.getElementById("beneficios").style.background = "transparent";
	document.getElementById("boletas").style.background = "transparent";
	document.getElementById("convocatorias").style.background = "transparent";
	document.getElementById("asistencia").style.background = "transparent";

}

function AgregarArchDescanso(){
	$doc = $("#ddocumento").val();
	$fini = $("#dfechaInicio").val();
	$ffin = $("#dfechaFin").val();

	$enlace = "cargar2.php?doc="+$doc+"&fini="+$fini+"&ffin="+$ffin;
	console.log("enlace",$enlace);
	document.getElementById("archDescanso").innerHTML = '<iframe src="'+$enlace+'" style="width:400px; height:200px;"></iframe><br>';
}

