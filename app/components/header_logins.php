<head>
  <title>Precision Tools :: Ingreso plataforma Sarlaft</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Ingreso plataforma Sarlaft ">
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="icon" type="image/x-icon" href="images/logo.ico" />
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>  
  <script>
  $(document).on('ready',function(){

    $('#btn-ingresar').click(function(){
    var url = "session.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formulario").serialize(),
       success: function(data)            
       {
       $('#resp').html(data);           
       }
     });
    });
  });
  </script>     
</head>