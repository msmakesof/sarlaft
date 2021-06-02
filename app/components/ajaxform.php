  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<!--Primer registro Gestion de Riesgo-->  
      <script>
  $(document).on('ready',function(){

    $('#btn-ingresar').click(function(){
    var url = "guardar_gestion.php";                                      

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
 <!--Registro Causas-->  
      <script>
  $(document).on('ready',function(){

    $('#btn-ingresarCausas').click(function(){
    var url = "guardar_Causas.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioCausas").serialize(),
       success: function(data)            
       {
       $('#respCausas').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteCausas').click(function(){
    var url = "delete_Causas.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteCausas").serialize(),
       success: function(data)            
       {
       $('#respDeleteCausas').html(data);           
       }
     });
    });
  });
  </script>
     <script>
  $(document).on('ready',function(){

    $('#btn-ingresarConsecuencias').click(function(){
    var url = "guardar_Consecuencias.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioConsecuencias").serialize(),
       success: function(data)            
       {
       $('#respConsecuencias').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteConsecuencias').click(function(){
    var url = "delete_Consecuencias.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteConsecuencias").serialize(),
       success: function(data)            
       {
       $('#respDeleteConsecuencias').html(data);           
       }
     });
    });
  });
  </script>


     <script>
  $(document).on('ready',function(){

    $('#btn-ingresarSegClientes').click(function(){
    var url = "guardar_SegClientes.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioSegClientes").serialize(),
       success: function(data)            
       {
       $('#respSegClientes').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteSegClientes').click(function(){
    var url = "delete_SegClientes.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteSegClientes").serialize(),
       success: function(data)            
       {
       $('#respDeleteSegClientes').html(data);           
       }
     });
    });
  });
  </script>
    <script>
  $(document).on('ready',function(){

    $('#btn-ingresarSegProductos').click(function(){
    var url = "guardar_SegProductos.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioSegProductos").serialize(),
       success: function(data)            
       {
       $('#respSegProductos').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteSegProductos').click(function(){
    var url = "delete_SegProductos.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteSegProductos").serialize(),
       success: function(data)            
       {
       $('#respDeleteSegProductos').html(data);           
       }
     });
    });
  });
  </script>
     <script>
  $(document).on('ready',function(){

    $('#btn-ingresarSegCanales').click(function(){
    var url = "guardar_SegCanales.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioSegCanales").serialize(),
       success: function(data)            
       {
       $('#respSegCanales').html(data);           
       }
     });
    });
  });
  </script> 
       <script>
  $(document).on('ready',function(){

    $('#btn-ingresarSegJurisdiccion').click(function(){
    var url = "guardar_SegJurisdiccion.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioSegJurisdiccion").serialize(),
       success: function(data)            
       {
       $('#respSegJurisdiccion').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteSegJurisdiccion').click(function(){
    var url = "delete_SegJurisdiccion.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteSegJurisdiccion").serialize(),
       success: function(data)            
       {
       $('#respDeleteSegJurisdiccion').html(data);           
       }
     });
    });
  });
  </script>
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteSegCanales').click(function(){
    var url = "delete_SegCanales.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteSegCanales").serialize(),
       success: function(data)            
       {
       $('#respDeleteSegCanales').html(data);           
       }
     });
    });
  });
  </script>

     <script>
  $(document).on('ready',function(){

    $('#btn-ingresarDebilidades').click(function(){
    var url = "guardar_Debilidades.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDebilidades").serialize(),
       success: function(data)            
       {
       $('#respDebilidades').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteDebilidades').click(function(){
    var url = "delete_Debilidades.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteDebilidades").serialize(),
       success: function(data)            
       {
       $('#respDeleteDebilidades').html(data);           
       }
     });
    });
  });
  </script>
      <script>
  $(document).on('ready',function(){

    $('#btn-ingresarOportunidades').click(function(){
    var url = "guardar_Oportunidades.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioOportunidades").serialize(),
       success: function(data)            
       {
       $('#respOportunidades').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteOportunidades').click(function(){
    var url = "delete_Oportunidades.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteOportunidades").serialize(),
       success: function(data)            
       {
       $('#respDeleteOportunidades').html(data);           
       }
     });
    });
  });
  </script>
       <script>
  $(document).on('ready',function(){

    $('#btn-ingresarFortalezas').click(function(){
    var url = "guardar_Fortalezas.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioFortalezas").serialize(),
       success: function(data)            
       {
       $('#respFortalezas').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteFortalezas').click(function(){
    var url = "delete_Fortalezas.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteFortalezas").serialize(),
       success: function(data)            
       {
       $('#respDeleteFortalezas').html(data);           
       }
     });
    });
  });
  </script>


       <script>
  $(document).on('ready',function(){

    $('#btn-ingresarAmenazas').click(function(){
    var url = "guardar_Amenazas.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioAmenazas").serialize(),
       success: function(data)            
       {
       $('#respAmenazas').html(data);           
       }
     });
    });
  });
  </script> 
  <!--Nuevo registro Gestion de Riesgo-->
      <script>
  $(document).on('ready',function(){

    $('#btn-deleteAmenazas').click(function(){
    var url = "delete_Amenazas.php";                                      

    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#formularioDeleteAmenazas").serialize(),
       success: function(data)            
       {
       $('#respDeleteAmenazas').html(data);           
       }
     });
    });
  });
  </script>
                