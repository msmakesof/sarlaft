    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>
    $(document).on('ready',function(){

      $('#btn-ingresar').click(function(){
        var url = "ajax/econtrol.php";                                      

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
        <script>
    $(document).on('ready',function(){

      $('#btn-ingresar2').click(function(){
        var url = "ajax/eprobabilidad.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario2").serialize(),
           success: function(data)            
           {
             $('#resp2').html(data);           
           }
         });
      });
    });
    </script>
        <script>
    $(document).on('ready',function(){

      $('#btn-ingresar3').click(function(){
        var url = "ajax/eriesgos.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario3").serialize(),
           success: function(data)            
           {
             $('#resp3').html(data);           
           }
         });
      });
    });
    </script>
    <script type="text/javascript">
    $('#editERiesgosModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('name') 
      $('#edit_name').val(name)
      var id = button.data('id') 
      $('#edit_id').val(id)
    })      
          
    $( "#edit_eriesgos" ).submit(function( event ) {
      var parametros = $(this).serialize();
      $.ajax({
          type: "POST",
          url: "ajax/editar_eriesgos.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#resultados").html("Enviando...");
            },
          success: function(datos){
          $("#resultados").html(datos);
          load(1);location.reload();
          $('#editERiesgosModal').modal('hide');
          }
      });
      event.preventDefault();
    });
    </script>
        <script>
    $(document).on('ready',function(){

      $('#btn-ingresar4').click(function(){
        var url = "ajax/enivelderiesgo.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario4").serialize(),
           success: function(data)            
           {
             $('#resp4').html(data);           
           }
         });
      });
    });
    </script>
        <script>
    $(document).on('ready',function(){

      $('#btn-ingresar5').click(function(){
        var url = "ajax/eefectividad.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario5").serialize(),
           success: function(data)            
           {
             $('#resp5').html(data);           
           }
         });
      });
    });
    </script>
        <script>
    $(document).on('ready',function(){

      $('#btn-ingresar6').click(function(){
        var url = "ajax/ecategoria.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario6").serialize(),
           success: function(data)            
           {
             $('#resp6').html(data);           
           }
         });
      });
    });
    </script>