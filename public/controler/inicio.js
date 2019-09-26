var $miSuperId = "";
var $miProyecto = "";
var $miNombre = "";
var $areaSelect = "";
var $funcionSelect = "";
var socket = io.connect();
var $cont=0;
var $tablaEmpleado = '';
var $tablaIncidencia = '';
var ext;
var listaEmpleado='',listaArea='',listaNomArea='',listaFuncion='',listaNomFuncion='';


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

			Ocultar();
	

		});

		socket.on("recibeArea",function(data){
			$areaSelect = data;
			console.log("opt area "+$areaSelect);
		});

		socket.on("recibeArea2",function(data){
			console.log("area 2"+data);
			var estado='';

			ext = data.length;
			var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
			tabla = tabla + '<thead><tr style="background:#ffffff;"><td>DESCRIPCION</td><td>ESTADO</td><td>ACCIONES</td>';
			tabla = tabla + '</tr></thead>';
			tabla = tabla+'<tbody>';
			for(i=0; i<ext; i++){
				listaArea = listaArea + data[i].area_empleado + "#";
				listaNomArea = listaNomArea + data[i].descripcion_area + "#";
				if(data[i].estado=="1"){
					estado="ACTIVO";
				} else if(data[i].estado=="0"){
					estado="INACTIVO";
				}

				var acciones = '<img src="../view/imagenes/editar.png" onclick="EditArea('+i+')" >';
				acciones = acciones + '<img src="../view/imagenes/borrar.png" onclick="DeleteArea('+i+')">';
				
				tabla = tabla+'<tr><td>'+data[i].descripcion_area+'</td>';
				tabla = tabla+'<td>'+estado+'</td>';
				tabla = tabla+'<td>'+acciones+'</td>';
				tabla = tabla+'</tr>';
			}
			tabla = tabla+'</tbody></table>';
			document.getElementById("cuerpoArea").innerHTML = tabla;
		});
		
		socket.on("recibeFuncion",function(data){
			$funcionSelect = data;
			console.log("opt funcion "+$funcionSelect);
		});

		socket.on("recibeFuncion2",function(data){
			console.log("funcion 2"+data);
			var estado='';

			ext = data.length;
			var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
			tabla = tabla + '<thead><tr style="background:#ffffff;"><td>DESCRIPCION</td><td>ESTADO</td><td>ACCIONES</td>';
			tabla = tabla + '</tr></thead>';
			tabla = tabla+'<tbody>';
			for(i=0; i<ext; i++){
				listaFuncion = listaFuncion + data[i].funcion_empleado + "#";
				listaNomFuncion = listaNomFuncion + data[i].descripcion_funcion + "#";
				if(data[i].estado=="1"){
					estado="ACTIVO";
				} else if(data[i].estado=="0"){
					estado="INACTIVO";
				}

				var acciones = '<img src="../view/imagenes/editar.png" onclick="EditFuncion('+i+')" >';
				acciones = acciones + '<img src="../view/imagenes/borrar.png" onclick="DeleteFuncion('+i+')">';
				
				tabla = tabla+'<tr><td>'+data[i].descripcion_funcion+'</td>';
				tabla = tabla+'<td>'+estado+'</td>';
				tabla = tabla+'<td>'+acciones+'</td>';
				tabla = tabla+'</tr>';
			}
			tabla = tabla+'</tbody></table>';
			document.getElementById("cuerpoFuncion").innerHTML = tabla;
		});
		
		socket.on("minombre",function(xdata){
			$("#inombre").html(xdata.nombre);
			$("#inombre2").html(xdata.nombre);
		});

		socket.on("DatosProyecto",function(xdata){
			var mensaje = "";
			if(xdata.proyecto==""){
				mensaje = "NO existe información para este proyecto y periodo";
			} else {
				mensaje = "Ya existe información para este proyecto y periodo";
			}
			$("#mgif").hide();
			$("#contenidop").show();
			//document.getElementById('contenidop').style.display = 'block';
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

		socket.on("ResultadoEmpleadoProyecto",function(data){
			ext = data.length;
			var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
			tabla = tabla + '<thead><tr style="background:#ffffff;"><td>MATRICULA</td><td>APELLIDOS Y NOMBRES</td><td>UNIDAD FUNCIONAL</td>';
			tabla = tabla + '<td>F. INGRESO</td><td>F. CESE</td><td>AREA</td>';
			tabla = tabla + '<td>COD. FUNCION</td><td>FUNCION</td><td>F. INICIO</td><td>F. FIN</td></tr></thead>';
			tabla = tabla+'<tbody>';
			for(i=0; i<ext; i++){
				listaEmpleado = listaEmpleado + data[i].empleado + "#";
				
				var pickeri = '<div class="form-group">';
				pickeri = pickeri + '<div class="input-group">';
				pickeri = pickeri + '<span class="input-group-prepend">';
				pickeri = pickeri + '<span class="input-group-text"><i class="icon-calendar22"></i></span>';
				pickeri = pickeri + '</span>';
				pickeri = pickeri + '<input name="datepicker" type="date" id="datepickeri'+i+'" style="width:150px;" value="'+data[i].fecha_inicio+'" />';
				pickeri = pickeri + '</div>';
				pickeri = pickeri + '</div>';

				var pickerf = '<div class="form-group">';
				pickerf = pickerf + '<div class="input-group">';
				pickerf = pickerf + '<span class="input-group-prepend">';
				pickerf = pickerf + '<span class="input-group-text"><i class="icon-calendar22"></i></span>';
				pickerf = pickerf + '</span>';
				pickerf = pickerf + '<input name="datepicker" type="date" id="datepickerf'+i+'" style="width:150px;" value="'+data[i].fecha_fin+'" />';
				pickerf = pickerf + '</div>';
				pickerf = pickerf + '</div>';

				//console.log("data"+i+": "+data[i]["AreaCodigo"]);
				tabla = tabla+'<tr><td>'+data[i].empleado+'</td>';
				tabla = tabla+'<td>'+data[i].apellido_empleado+' '+data[i].nombre_empleado+'</td>';
				//tabla = tabla+'<td>'+data[i]["EmpleadoNombre"]+'</td>';
				tabla = tabla+'<td>'+data[i].proyecto+'</td>';
				tabla = tabla+'<td>'+data[i].fecha_ingreso+'</td>';
				tabla = tabla+'<td>'+data[i].fecha_cese+'</td>';
				var larea = '<select id="AreaSelectVal_'+i+'">';
				larea = larea + '<option value="'+data[i].area_empleado+'">'+data[i].area_empleado_r+'</option>';
				larea = larea + $areaSelect+'</select>';
				tabla = tabla + '<td>'+larea+'</td>';
				//tabla = tabla+'<td>'+data[i]["AreaNombre"]+'</td>';
				tabla = tabla+'<td>'+data[i].cargo_empleado+'</td>';
				tabla = tabla+'<td>'+data[i].cargo_empleado_r+'</td>';
				tabla = tabla+'<td>'+pickeri+'</td>';
				tabla = tabla+'<td>'+pickerf+'</td></tr>';
				/*
				<div class="form-group">
				<div class="input-group">
				<span class="input-group-prepend">
				<span class="input-group-text"><i class="icon-calendar22"></i></span>
				</span>
				<input type="text" id="" class="form-control daterange-single">
				</div>
				</div>
				data[i]["EmpleadoCodigo"]
				*/
				//FuncionNombre
			}
			tabla = tabla+'</tbody></table>';
			$tablaEmpleado = tabla;
			document.getElementById("dataInicial").innerHTML = tabla;
		});

		socket.on("ResultadoIncidenciaProyecto",function(data){
			var codigo = data.empleado;
			var codigox = codigo.split("#");
			var nombre = data.nombre;
			var nombrex = nombre.split("#");
			var fechaI = data.fechaInicio;
			var fechaIx = fechaI.split("#");
			var fechaF = data.fechaFin;
			var fechaFx = fechaF.split("#");

			console.log(codigox + " " + nombrex);
			console.log(fechaIx+" "+fechaFx);

			ext = codigox.length;
			
			var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
			tabla = tabla + '<thead><tr style="background:#ffffff;"><td>CODIGO</td><td>APELLIDOS Y NOMBRES</td>';
			tabla = tabla + '<td>F. INICIO</td><td>F. FIN</td><td>2019-01</td>';
			tabla = tabla + '<td>2019-02</td><td>2019-03</td><td>2019-04</td><td>2019-05</td>';
			tabla = tabla + '<td>2019-06</td><td>2019-07</td><td>2019-08</td><td>2019-09</td>';
			tabla = tabla + '<td>2019-10</td><td>2019-11</td><td>2019-12</td></tr></thead>';
			tabla = tabla+'<tbody>';
			
			var mdata = data.incidencia_prevista;
			var ndata = mdata.split("%");
			console.log("data2 "+mdata+" -#");
			
			var mdata2 = data.incidencia_real;
			var ndata2 = mdata2.split("%");
			console.log("data3 "+mdata2+" -#");
			
			for(i=0; i<ext-1; i++){
				listaEmpleado = listaEmpleado + codigox[i] + "#";
				
				var ldata = ndata[i].split("#");
				var ldata2 = ndata2[i].split("#");
				//console.log("data"+i+": "+data[i]["AreaCodigo"]);
				tabla = tabla+'<tr><td>'+codigox[i]+'</td>';
				tabla = tabla+'<td>'+nombrex[i]+'</td>';
				tabla = tabla+'<td>'+fechaIx[i]+'</td>';
				tabla = tabla+'<td>'+fechaFx[i]+'</td>';

				if(ldata2[0]!=""){
					tabla = tabla+'<td><input type="text" id="201901'+i+'" maxlength="5" size="5" value="'+ldata2[0]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201901'+i+'" maxlength="5" size="5" value="'+ldata[0]+'"></td>';				
				}

				if(ldata2[1]!=""){
					tabla = tabla+'<td><input type="text" id="201902'+i+'" maxlength="5" size="5" value="'+ldata2[1]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201902'+i+'" maxlength="5" size="5" value="'+ldata[1]+'"></td>';				
				}

				if(ldata2[2]!=""){
					tabla = tabla+'<td><input type="text" id="201903'+i+'" maxlength="5" size="5" value="'+ldata2[2]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201903'+i+'" maxlength="5" size="5" value="'+ldata[2]+'"></td>';				
				}

				if(ldata2[3]!=""){
					tabla = tabla+'<td><input type="text" id="201904'+i+'" maxlength="5" size="5" value="'+ldata2[3]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201904'+i+'" maxlength="5" size="5" value="'+ldata[3]+'"></td>';				
				}

				if(ldata2[4]!=""){
					tabla = tabla+'<td><input type="text" id="201905'+i+'" maxlength="5" size="5" value="'+ldata2[4]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201905'+i+'" maxlength="5" size="5" value="'+ldata[4]+'"></td>';				
				}

				if(ldata2[5]!=""){
					tabla = tabla+'<td><input type="text" id="201906'+i+'" maxlength="5" size="5" value="'+ldata2[5]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201906'+i+'" maxlength="5" size="5" value="'+ldata[5]+'"></td>';				
				}

				if(ldata2[6]!=""){
					tabla = tabla+'<td><input type="text" id="201907'+i+'" maxlength="5" size="5" value="'+ldata2[6]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201907'+i+'" maxlength="5" size="5" value="'+ldata[6]+'"></td>';				
				}

				if(ldata2[7]!=""){
					tabla = tabla+'<td><input type="text" id="201908'+i+'" maxlength="5" size="5" value="'+ldata2[7]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201908'+i+'" maxlength="5" size="5" value="'+ldata[7]+'"></td>';				
				}

				if(ldata2[8]!=""){
					tabla = tabla+'<td><input type="text" id="201909'+i+'" maxlength="5" size="5" value="'+ldata2[8]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201909'+i+'" maxlength="5" size="5" value="'+ldata[8]+'"></td>';				
				}

				if(ldata2[9]!=""){
					tabla = tabla+'<td><input type="text" id="201910'+i+'" maxlength="5" size="5" value="'+ldata2[9]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201910'+i+'" maxlength="5" size="5" value="'+ldata[9]+'"></td>';				
				}

				if(ldata2[10]!=""){
					tabla = tabla+'<td><input type="text" id="201911'+i+'" maxlength="5" size="5" value="'+ldata2[10]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201911'+i+'" maxlength="5" size="5" value="'+ldata[10]+'"></td>';				
				}

				if(ldata2[11]!=""){
					tabla = tabla+'<td><input type="text" id="201912'+i+'" maxlength="5" size="5" value="'+ldata2[11]+'"></td>';
				} else {
					tabla = tabla+'<td><input type="text" id="201912'+i+'" maxlength="5" size="5" value="'+ldata[11]+'"></td>';				
				}

			}
			tabla = tabla+'</tbody></table>';
			$tablaIncidencia = tabla;
			document.getElementById("cuerpoIncidencias").innerHTML = tabla;
			Deshabilitar();
		});

}

function Deshabilitar(){
	var lista = listaEmpleado.split("#");
	var ext = lista.length;
	var eperiodo = 201909;
	var iperiodo;
		
	
	for(var i=0; i<ext-1; i++){
		
		for(var x=1; x<=12; x++){
			if(x<10){ iperiodo='0'; } else { iperiodo = ''; }
			iperiodo = "2019" + iperiodo + x;
			if(parseInt(iperiodo)<eperiodo){
				iperiodo = iperiodo + "" + i;
				document.getElementById(iperiodo).disabled = true;
			}
		}
	}
}

function Ocultar(){
	$("#contenidop").hide();
	$("#campoEmpleado").hide();
	$("#campoIncidencias").hide();
	$("#campoArea").hide();
	$("#campoFuncion").hide();
	$("#campoPerfil").hide();
	$("#campoUsuarios").hide();
	$("#campoOpcion").hide();
	$("#campoParametros").hide();
	console.log("ocultar");
}

function CallService($miProyecto,$filtro){
		console.log("proy "+$miProyecto);
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
					ext = data.length;
					var tabla = '<div class="table-responsive"><table class="table table-bordered table-striped">';
					tabla = tabla + '<thead><tr style="background:#ffffff;"><td>MATRICULA</td><td>APELLIDOS Y NOMBRES</td><td>UNIDAD FUNCIONAL</td>';
					tabla = tabla + '<td>F. INGRESO</td><td>F. CESE</td><td>AREA</td>';
					tabla = tabla + '<td>COD. FUNCION</td><td>FUNCION</td><td>F. INICIO</td><td>F. FIN</td></tr></thead>';
					tabla = tabla+'<tbody>';
					for(i=0; i<ext; i++){
						listaEmpleado = listaEmpleado + data[i]["EmpleadoCodigo"] + "#";
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

						var pickeri = '<div class="form-group">';
						pickeri = pickeri + '<div class="input-group">';
						pickeri = pickeri + '<span class="input-group-prepend">';
						pickeri = pickeri + '<span class="input-group-text"><i class="icon-calendar22"></i></span>';
						pickeri = pickeri + '</span>';
						pickeri = pickeri + '<input name="datepicker" type="date" id="datepickeri'+i+'" style="width:150px;" />';
						pickeri = pickeri + '</div>';
						pickeri = pickeri + '</div>';

						var pickerf = '<div class="form-group">';
						pickerf = pickerf + '<div class="input-group">';
						pickerf = pickerf + '<span class="input-group-prepend">';
						pickerf = pickerf + '<span class="input-group-text"><i class="icon-calendar22"></i></span>';
						pickerf = pickerf + '</span>';
						pickerf = pickerf + '<input name="datepicker" type="date" id="datepickerf'+i+'" style="width:150px;" />';
						pickerf = pickerf + '</div>';
						pickerf = pickerf + '</div>';

						//console.log("data"+i+": "+data[i]["AreaCodigo"]);
						tabla = tabla+'<tr><td>'+data[i]["EmpleadoCodigo"]+'</td>';
						tabla = tabla+'<td>'+data[i]["EmpleadoApellido"]+' '+data[i]["EmpleadoNombre"]+'</td>';
						//tabla = tabla+'<td>'+data[i]["EmpleadoNombre"]+'</td>';
						tabla = tabla+'<td>'+data[i]["ProyectoCodigo"]+'</td>';
						tabla = tabla+'<td>'+data[i]["fechaIngreso"]+'</td>';
						tabla = tabla+'<td>'+data[i]["fechaCese"]+'</td>';
						var larea = '<select id="AreaSelectVal_'+i+'">';
						larea = larea + '<option value="'+data[i]["AreaCodigo"]+'">'+data[i]["AreaNombre"]+'</option>';
						larea = larea + $areaSelect+'</select>';
						tabla = tabla + '<td>'+larea+'</td>';
						//tabla = tabla+'<td>'+data[i]["AreaNombre"]+'</td>';
						tabla = tabla+'<td>'+data[i]["FuncionCodigo"]+'</td>';
						tabla = tabla+'<td>'+data[i]["FuncionNombre"]+'</td>';
						tabla = tabla+'<td>'+pickeri+'</td>';
						tabla = tabla+'<td>'+pickerf+'</td></tr>';
						/*
						<div class="form-group">
						<div class="input-group">
						<span class="input-group-prepend">
						<span class="input-group-text"><i class="icon-calendar22"></i></span>
						</span>
						<input type="text" id="" class="form-control daterange-single">
						</div>
						</div>
						data[i]["EmpleadoCodigo"]
						*/
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

function GuardaArea(){
	//alert("x");
	
	var acodigo = document.getElementById("acodigo").value;
	var anombre = document.getElementById("anombre").value;
	var aestado = document.getElementById("estadoa").value;

	socket.emit("GuardaArea",{codigo:acodigo, descripcion:anombre, estado:aestado});
	Area();
}

function GuardaFuncion(){
	//alert("x");
	
	var fcodigo = document.getElementById("fcodigo").value;
	var fnombre = document.getElementById("fnombre").value;
	var festado = document.getElementById("estadof").value;

	socket.emit("GuardaFuncion",{codigo:fcodigo, descripcion:fnombre, estado:festado});
	Funcion();
}

function GuardarEmpl(){
	var lista = listaEmpleado.split("#");
	for(var i=0; i<ext-1; i++){
		$txt1 = "datepickeri"+i;
		$txt2 = "datepickerf"+i;
		$txt3 = "AreaSelectVal_"+i;
		var texto = document.getElementById($txt3);
		var fec1 = document.getElementById($txt1).value;
		var fec2 = document.getElementById($txt2).value;
		var sel = document.getElementById($txt3).value;
		var text = texto.options[texto.selectedIndex].innerText;
		console.log(fec1+" "+fec2+" "+sel+" "+text);	

		socket.emit("ActualizaEmpleado",{
			fechaInicio:fec1,
			fechaFin:fec2,
			area:sel,
			nombreArea:text,
			empleado: lista[i],
			proyecto: $miProyecto,
			periodo: "201909"
		});
	}
}

function GuardarIncidencia(){
	var lista = listaEmpleado.split("#");
	for(var i=0; i<ext-1; i++){
		
		var iperiodo,eperiodo;
		for(var x=1; x<=12; x++){
			if(x<10){ iperiodo='0'; } else { iperiodo = ''; }
			eperiodo = "2019" + iperiodo + x;
			
			iperiodo = "2019" + iperiodo + x + i;
			/*if(parseInt(iperiodo)<eperiodo){
				iperiodo = iperiodo + "" + i;
				document.getElementById(iperiodo).disabled = true;
			}*/
			var inc = document.getElementById(iperiodo).value;
			console.log(inc+" "+iperiodo+" "+eperiodo);
			socket.emit("GuardarIncidencia",{
				incidencia: inc,
				empleado: lista[i],
				proyecto: $miProyecto,
				periodo: eperiodo
			});
		}
	}
	Incidencias();
}


function CierrePeriodo(){
	var lista = listaEmpleado.split("#");
	for(var i=0; i<ext-1; i++){
		
		var iperiodo,eperiodo;
		/*for(var x=1; x<=12; x++){
			if(x<10){ iperiodo='0'; } else { iperiodo = ''; }*/
			eperiodo = "201909";// + iperiodo + x;
			
			iperiodo = "201909" + i; //iperiodo + x + i;
			/*if(parseInt(iperiodo)<eperiodo){
				iperiodo = iperiodo + "" + i;
				document.getElementById(iperiodo).disabled = true;
			}*/
			var inc = document.getElementById(iperiodo).value;
			console.log(inc+" "+iperiodo+" "+eperiodo);
			socket.emit("CierrePeriodo",{
				incidencia: inc,
				empleado: lista[i],
				proyecto: $miProyecto,
				periodo: eperiodo
			});
		//}
	}
	Incidencias();
}

function Autollenado(){
	var lista = listaEmpleado.split("#");
	for(var i=0; i<ext-1; i++){
		document.getElementById("201901"+i).value = "1.0";
		document.getElementById("201902"+i).value = "1.0";
		document.getElementById("201903"+i).value = "1.0";
		document.getElementById("201904"+i).value = "1.0";
		document.getElementById("201905"+i).value = "1.0";
		document.getElementById("201906"+i).value = "1.0";
		document.getElementById("201907"+i).value = "1.0";
		document.getElementById("201908"+i).value = "1.0";
		document.getElementById("201909"+i).value = "1.0";
		document.getElementById("201910"+i).value = "1.0";
		document.getElementById("201911"+i).value = "1.0";
		document.getElementById("201912"+i).value = "1.0";
	}
}

function Cargar(){
	if($tablaEmpleado==""){
		CallService($miProyecto,"inicial");
	} else {
		document.getElementById("dataInicial").innerHTML = $tablaEmpleado;
	}
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
		socket.emit("EmpleadoProyecto",{proyecto:$miProyecto});
		//CallService($miProyecto,"bempleado");
	} else {
		document.getElementById("dataInicial").innerHTML = $tablaEmpleado;
	}
	
	document.getElementById("empleados").style.background = "#273156";
	document.getElementById("proyecto").style.background = "transparent";
	document.getElementById("incidencias").style.background = "transparent";
}

function Incidencias(){
	Ocultar();
	$("#campoIncidencias").show();
	socket.emit("IncidenciaProyecto",{proyecto:$miProyecto});
	document.getElementById("incidencias").style.background = "#273156";
	document.getElementById("proyecto").style.background = "transparent";
	document.getElementById("empleados").style.background = "transparent";
}
	
function Area(){
	Ocultar();
	socket.emit("ConsultaArea","");
	$("#campoArea").show();
	$("#cuerpoArea2").hide();
	
	document.getElementById("area").style.background = "#273156";
	document.getElementById("funcion").style.background = "transparent";
	document.getElementById("perfil").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";
	document.getElementById("opcionSistema").style.background = "transparent";
	document.getElementById("parametrosGenerales").style.background = "transparent";
	
}

function Funcion(){
	Ocultar();
	socket.emit("ConsultaFuncion","");
	$("#campoFuncion").show();
	$("#cuerpoFuncion2").hide();
	
	document.getElementById("funcion").style.background = "#273156";
	document.getElementById("area").style.background = "transparent";
	document.getElementById("perfil").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";
	document.getElementById("opcionSistema").style.background = "transparent";
	document.getElementById("parametrosGenerales").style.background = "transparent";
	
}

function Perfil(){
	Ocultar();
	$("#campoPerfil").show();
	document.getElementById("perfil").style.background = "#273156";
	document.getElementById("funcion").style.background = "transparent";
	document.getElementById("area").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";
	document.getElementById("opcionSistema").style.background = "transparent";
	document.getElementById("parametrosGenerales").style.background = "transparent";
	
}

function Usuarios(){
	Ocultar();
	$("#campoUsuarios").show();
	document.getElementById("usuarios").style.background = "#273156";
	document.getElementById("funcion").style.background = "transparent";
	document.getElementById("perfil").style.background = "transparent";
	document.getElementById("area").style.background = "transparent";
	document.getElementById("opcionSistema").style.background = "transparent";
	document.getElementById("parametrosGenerales").style.background = "transparent";
	
}

function OpcionSistema(){
	Ocultar();
	$("#campoOpcion").show();
	document.getElementById("opcionSistema").style.background = "#273156";
	document.getElementById("funcion").style.background = "transparent";
	document.getElementById("perfil").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";
	document.getElementById("area").style.background = "transparent";
	document.getElementById("parametrosGenerales").style.background = "transparent";
	
}

function ParametrosGenerales(){
	Ocultar();
	$("#campoParametros").show();
	document.getElementById("parametrosGenerales").style.background = "#273156";
	document.getElementById("funcion").style.background = "transparent";
	document.getElementById("perfil").style.background = "transparent";
	document.getElementById("usuarios").style.background = "transparent";
	document.getElementById("opcionSistema").style.background = "transparent";
	document.getElementById("area").style.background = "transparent";
	
}

function EditArea(a){
	$("#cuerpoArea").hide();
	$("#cabeceraArea").hide();
	$("#cuerpoArea2").show();

	var larea = listaArea.split("#");
	var lnomArea = listaNomArea.split("#");
	
	document.getElementById("acodigo2").value = larea[a];
	document.getElementById("anombre2").value = lnomArea[a];

}

function EditArea2(a){
	$("#cuerpoArea2").hide();
	$("#cuerpoArea").show();
	$("#cabeceraArea").show();
	//var larea = listaArea.split("#");
	//var lnomArea = listaNomArea.split("#");
	var acodigo2 = document.getElementById("acodigo2").value;
	var anombre2 = document.getElementById("anombre2").value;
	var eestado = document.getElementById("aestado2").value;

	console.log(acodigo2+ " " + anombre2);
	
	socket.emit("EditaArea",{codigo:acodigo2,descripcion:anombre2,estado:eestado});
	Area();
}

function EditFuncion(a){
	$("#cuerpoFuncion").hide();
	$("#cabeceraFuncion").hide();
	$("#cuerpoFuncion2").show();

	var lFuncion = listaFuncion.split("#");
	var lnomFuncion = listaNomFuncion.split("#");
	
	document.getElementById("fcodigo2").value = lFuncion[a];
	document.getElementById("fnombre2").value = lnomFuncion[a];

}

function EditFuncion2(a){
	$("#cuerpoFuncion2").hide();
	$("#cuerpoFuncion").show();
	$("#cabeceraFuncion").show();
	//var larea = listaArea.split("#");
	//var lnomArea = listaNomArea.split("#");
	var fcodigo2 = document.getElementById("fcodigo2").value;
	var fnombre2 = document.getElementById("fnombre2").value;
	var festado = document.getElementById("festado2").value;

	console.log(fcodigo2+ " " + fnombre2);
	
	socket.emit("EditaFuncion",{codigo:fcodigo2,descripcion:fnombre2,estado:festado});
	Funcion();
}