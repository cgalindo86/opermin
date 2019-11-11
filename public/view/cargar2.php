<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        
<script>
    
    var $dato = "";

    $(document).ready(function(){
        
	    $("#datos").hide();
	    $(".messages").hide();
        var fileExtension = "";
        $(':file').change(function()
        {
            var file = $("#imagen")[0].files[0];
            var fileName = file.name;
            fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            var fileSize = file.size;
            var fileType = file.type;
            showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
        });
     
        $('#subir2').click(function(){
            var formData = new FormData($(".formulario")[0]);
            var message = "";
            
            var miurl = 'upload2.php';
            //alert(miurl);
            $.ajax({
                url: miurl,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    message = $("<span class='before'>Subiendo el archivo, por favor espere...</span>");
                    showMessage(message)        
                },
                success: function(data){
                    message = $("<span class='success'>"+data+"</span>");
                    showMessage(message);
                    
                },
                error: function(){
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                    showMessage(message);
                }
            });
        });
        
    
    });
    
            function Dia(){
        		var d = new Date();
        		var diaMes = d.getDate()+"";
        		return diaMes;
	        }
	        
	        function Mes(){
        		var d = new Date();
        		var mMes = d.getMonth() + 1;
        		return mMes;
	        }
	        
	        function Anio(){
        		var d = new Date();
        		var anio = d.getFullYear();
        		return anio;
	        }
    
    function showMessage(message){
        $(".messages").html("").show();
        $(".messages").html(message);
    }
     
    function isImage(extension)
    {
        switch(extension.toLowerCase()) 
        {
            case 'png': case 'jpg': case 'doc': case 'docx': case 'pdf': 
                return true;
            break;
            default:
                return false;
            break;
        }
    }

</script>

</head>
<body>
        
    <form enctype="multipart/form-data" class="formulario">
        <?php
            $doc = $_GET['doc'];
            $fini = $_GET['fini'];
            $ffin = $_GET['ffin'];
            $filtro = $_GET['filtro'];

            echo '<input id="datos" name="datos" type="text" value="'.$doc."#".$fini."#".$ffin."#".$filtro.'">';
        ?>
        <br><br>
        <label>Subir un archivo</label><br />
        
        <br>
        <input name="archivo" type="file" class="form-control input-lg" id="imagen" /><br /><br />
        <input id="subir2" type="button" class="btn btn-lg btn-primary" value="Subir archivo" /><br />
    </form>
    <!--div para visualizar mensajes-->
    <div class="messages"></div><br /><br />
    <!--div para visualizar en el caso de imagen-->
    <div class="showImage"></div>
</body>
</html>