var $miSuperId = "";
var $miProyecto = "";
var $miNombre = "";
var $areaSelect = "";
var $funcionSelect = "";
var socket = io.connect();
var $cont=0;
var $tablaEmpleado = '';

MainApp();

function MainApp() {
	init();
}
		
function init(){
		
		socket.on("ParametrosInicio2",function(xdata){
			$miSuperId = xdata.id;
			$miProyecto = xdata.miProyecto;
			$miNombre = xdata.miNombre;

			console.log("ini2: "+$miProyecto+" "+$miNombre+" "+$miSuperId);

			socket.emit("ConsultaProyecto",{proyecto:$miProyecto,periodo:"201909",usuario:"admin",fecha:"",estado:"Activo"});
			$miNombre = $miNombre.replace("_"," ");

			//$("#codProy").html($miProyecto +" - "+ $miNombre);

			document.getElementById("codProy").innerHTML = $miProyecto +" - "+ $miNombre;

			socket.emit("busca nombre",{usuario:$miSuperId});
			socket.emit("BuscaArea","");
			socket.emit("buscaFuncion","");

		});

		alert("v");

		Ocultar();
			
		

			/*$("#botonCargar").click(function(){
				CallService($miProyecto,"inicial");
			});

			$("#bbuscar").click(function(){
				$cod = $("#bcodigo").val();
				$doc = $("#bdocumento").val();
				$nom = $("#bnombre").val();
				$ape = $("#bapellidos").val();
				
				socket.emit("BuscaEmpleado",{
					codigo: $cod,
					documento: $doc,
					nombre: $nom,
					apellidos: $ape
				});
			});*/
			
			document.getElementById("proyecto").style.background = "#273156";
			document.getElementById("empleados").style.background = "transparent";
			document.getElementById("incidencias").style.background = "transparent";
			document.getElementById("proyecto").style.cursor = "pointer";
			document.getElementById("empleados").style.cursor = "pointer";
			document.getElementById("incidencias").style.cursor = "pointer";

			

			

			socket.on("recibeArea",function(data){
				$areaSelect = data;
				console.log("opt area "+$areaSelect);
			});
			
			socket.on("minombre",function(xdata){
				$("#inombre").html(xdata.nombre);
				$("#inombre2").html(xdata.nombre);
			});

			socket.on("DatosProyecto",function(xdata){
				console.log("datosProyecto");
				var mensaje = "";
				if(xdata.proyecto==""){
					mensaje = "NO existe información para este proyecto y periodo";
				} else {
					mensaje = "Ya existe información para este proyecto y periodo";
				}
				$("#mgif").hide();
				$("#contenidop").show();
				$("#contenidop").html(mensaje);
			});

			socket.on("ResultEmpleado",function(data){
				var d = data.split("%");
				var n = d.length;
				var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
				tabla = tabla + '<thead><tr style="background:#ffffff;"><td>MATRICULA</td><td>APELLIDOS Y NOMBRES</td><td>UNIDAD FUNCIONAL</td>';
				tabla = tabla + '<td>F. INGRESO</td><td>F. CESE</td></tr></thead>';
				tabla = tabla+'<tbody>';
						
				for(i=0; i<n-1; i++){
					var d2 = d[i].split("#");

					tabla = tabla+'<tr><td>'+d2[0]+'</td>';
					tabla = tabla+'<td>'+d2[1]+'</td>';
					tabla = tabla+'<td>'+d2[2]+'</td>';
					tabla = tabla+'<td>'+d2[3]+'</td>';
					tabla = tabla+'<td>'+d2[4]+'</td>';
					tabla = tabla+'<td><button onclick="Seleccionar('+d2[0]+')">SELECCIONAR</button></td></tr>';
				}
				tabla = tabla+'</tbody></table>';
				document.getElementById("rbusqueda").innerHTML = tabla;
			});

}
	



function Ocultar(){
	$("#contenidop").hide();
	$("#campoEmpleado").hide();
	$("#campoIncidencias").hide();
	$("#campoArea").hide();
}

function CallService($miProyecto,$filtro){
		
		$("#mgif").show();
		
			var input = {

				"DocumentoNumero":"",
				"EmpleadoApellido":"",
				"EmpleadoCodigo":"",
				"EmpleadoNombre":"",
				"Periodo":"201909",
				"ProyectoCodigo":$miProyecto
			};

			var param1 = JSON.stringify(input,null,2);
			var endpointAddress = "http://serdesa.cosapi.com.pe/Rest.Cosapi/OperativeResult.svc/";
			var url = endpointAddress + "Listar";
			$.ajax({
				type: 'POST',
				url: url,
				contentType: 'application/json',
				data: param1,
				dataType : 'json', //Expected data format from server
				processdata : true,
				success: function(result) {
					var txt = JSON.stringify(result);
					console.log(txt);
					var data = JSON.parse(txt);
					var ext = data.length;
					var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
					tabla = tabla + '<thead><tr style="background:#ffffff;"><td>MATRICULA</td><td>APELLIDOS Y NOMBRES</td><td>UNIDAD FUNCIONAL</td>';
					tabla = tabla + '<td>F. INGRESO</td><td>F. CESE</td><td>AREA</td>';
					tabla = tabla + '<td>COD. FUNCION</td><td>FUNCION</td></tr></thead>';
					tabla = tabla+'<tbody>';
					for(i=0; i<ext; i++){

						socket.emit("GuardaEmpleadoProyecto",{
							
							empleado: data[i]["EmpleadoCodigo"],
							cargo: data[i]["FuncionCodigo"],
							cargo_r: data[i]["FuncionNombre"],
							area: data[i]["AreaCodigo"],
							area_r: data[i]["AreaNombre"],
							tipoDocumento: data[i]["DocumentoTipo"],
							numeroDocumento: data[i]["DocumentoNumero"],
							nombre: data[i]["EmpleadoNombre"],
							apellido: data[i]["EmpleadoApellido"],
							fechaIngreso: data[i]["fechaIngreso"],
							fechaCese: data[i]["fechaCese"],
							provisiones: data[i]["Provision"],
							sueldo: data[i]["Ingreso"],
							costo: data[i]["CostoTotal"],
							estado: data[i]["Estado"],
							proyecto: $miProyecto,
							periodo: "201909"
						});

						//console.log("data"+i+": "+data[i]["AreaCodigo"]);
						tabla = tabla+'<tr><td>'+data[i]["EmpleadoCodigo"]+'</td>';
						tabla = tabla+'<td>'+data[i]["EmpleadoApellido"]+' '+data[i]["EmpleadoNombre"]+'</td>';
						//tabla = tabla+'<td>'+data[i]["EmpleadoNombre"]+'</td>';
						tabla = tabla+'<td>'+data[i]["ProyectoCodigo"]+'</td>';
						tabla = tabla+'<td>'+data[i]["fechaIngreso"]+'</td>';
						tabla = tabla+'<td>'+data[i]["fechaCese"]+'</td>';
						var larea = '<select onclick="AreaSelectVal('+data[i]["EmpleadoCodigo"]+')">'+$areaSelect+'</select>';
						tabla = tabla+'<td>'+larea+'</td>';
						//tabla = tabla+'<td>'+data[i]["AreaNombre"]+'</td>';
						tabla = tabla+'<td>'+data[i]["FuncionCodigo"]+'</td>';
						tabla = tabla+'<td>'+data[i]["FuncionNombre"]+'</td></tr>';
						
						//FuncionNombre
					}
					tabla = tabla+'</tbody></table>';
					$tablaEmpleado = tabla;
					document.getElementById("dataInicial").innerHTML = tabla;
					
				}
			});
			
			$("#mgif").hide();

		if($filtro=="inicial"){
			alert("DATOS CARGADOS CORRECTAMENTE");
		}
		   
	}

function AreaSelectVal($codArea){

}

function Proyectos(){
	Ocultar();
	socket.emit("ConsultaProyecto",{proyecto:$miProyecto,periodo:"201909",usuario:"admin",fecha:"",estado:"Activo"});
	
	document.getElementById("proyecto").style.background = "#273156";
	document.getElementById("empleados").style.background = "transparent";
	document.getElementById("incidencias").style.background = "transparent";
}

function Empleados(){
	Ocultar();
	$("#botones").show();
	$("#campoEmpleado").show();
	if($tablaEmpleado==""){
		CallService($miProyecto,"bempleado");
	} else {
		document.getElementById("dataInicial").innerHTML = $tablaEmpleado;
	}
	
	document.getElementById("empleados").style.background = "#273156";
	document.getElementById("proyecto").style.background = "transparent";
	document.getElementById("incidencias").style.background = "transparent";
}

function Incidencias(){
	$("#contenidop").hide();
	$("#campoEmpleado").hide();
	document.getElementById("incidencias").style.background = "#273156";
	document.getElementById("proyecto").style.background = "transparent";
	document.getElementById("empleados").style.background = "transparent";
}