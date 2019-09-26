
window.onload = function(){
    
	MainApp();
}


function MainApp() {

	socket = io.connect('/');
    init();
		
	function init(){

		var $ihead = '<div class="card"><div class="card-header header-elements-inline"><h6 class="card-title">MUESTRA DE UN ELEMENTO</h6>';
			$ihead = $ihead + '</div>';
			
		var $ibody = $ibody + '<div class="card-body"><p>';
							
		var $icierre = '</p></div></div>';

		var $imaster = '';
		var $idata = '', $idata2;
		var retorno = document.getElementById("retorno");
		var boton = document.getElementById("iboton");
		var boton2 = document.getElementById("iboton2");

		boton.addEventListener("click", function(evt) {
			$imaster = "";
			socket.emit("consulta",{id:"0",emp:""});
		}, false);

		boton2.addEventListener("click", function(evt) {
			$imaster = "";
			socket.emit("consulta",{id:"1",emp:""});
			
		}, false);
		
		

		socket.on("envio empresa",function(xdata){
			//alert(data.id+" - "+data.nombre);
			$idata = '<center><h1>'+xdata.id+'</h1><br><h2>'+xdata.nombre+'</h2></center>';
				
			$imaster = $imaster + $ihead + $ibody + $idata + $icierre;

			retorno.innerHTML = $imaster;
		});

		socket.on("envio obra",function(xdata){
			//alert(data.id+" - "+data.nombre);
			$idata = '<center><h6>'+xdata.nombre+'</h6><br><h2>S/. '+xdata.costo+' SOLES</h2></center><br>';
			$idata = '<center><h1>'+xdata.responsable+'</h1><br><h2>'+xdata.funcion+'</h2></center>';
			$imaster = $imaster + $ihead + $ibody + $idata + $icierre;

			retorno.innerHTML = $imaster;
		});

	}


}
