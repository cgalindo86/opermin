MainApp();



function MainApp() {

}


init();
		
	function init(){
		alert("hola");

		$.post("../controler/h.php", {
			accion: "3"
			
		}, function(htmlexterno){
		   alert("Data: " + htmlexterno);
		   
		});

	}