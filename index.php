<!DOCTYPE html>
<html>
<head>
	<title>Precision Tools :: Ingreso plataforma Sarlaft</title>   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">	
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles3.css">	
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	
	<script src="https://www.google.com/recaptcha/api.js?render=6Le7QGwbAAAAAAg6uRDjHDmYE0chchEdZXez8ZGZ"></script>
	<script>
	$(document).on('ready',function(){
		toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
		}	

		$('#btn-ingresar').click(function(){
			event.preventDefault();
			let e = $("#email").val()
			let p = $("#password").val()
			if(e == "" || p == ""  ){
				toastr["warning"]("Atencion. Debe digitar un usuario y/o password.");
			}
			else {
				grecaptcha.ready(function() {
					grecaptcha.execute('6Le7QGwbAAAAAAg6uRDjHDmYE0chchEdZXez8ZGZ', {action: 'create_comment'}).then(function(token) {
						$('#formulario').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
						$.post("session.php",{email: e, password: p, token: token}, function(result) {
							if(result.success) {
								if(result.success == 'true'){
									location.href = "./app/Clientes.php";
								}
								else {
									toastr["warning"]("Atencion. Usuario y contraseña no coincide!.");
								}
							}
							else {									
								toastr["warning"]("Atencion. Posbile Spammer de acuerdo a Captcha.");
							}
						});
					});
				});
			}
		})
	});
</script> 
</head>
<body>
<section class="login-block">
    <div class="container">
		<div class="row">
			<div class="col-md-4 login-sec">
				<h2 class="text-center txtsombra">Ingreso</h2>
				<form class="login-form" id="formulario" action="session.php" method="post">
					<div class="input-group form-group">						
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user txtsombra" style="color:red"></i></span>
						</div>
						<input type="email" name="email" id="email" class="form-control" placeholder="Digite usuario" maxlength="30" required="required">				
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key txtsombra" style="color:red"></i></span>
						</div>
						<input type="password" name="password" id="password" class="form-control" placeholder="Digite Clave" maxlength="30" required="required">
					</div>

					<div>
						<button type="submit" class="btn btn-login float-right txtsombra" id="btn-ingresar">Ingresar</button>
					</div> 
				</form>
				<div id="load" style="text-align:center"></div>
				<div id="resp" style="margin:4em"></div>
				<div class="copy-text">Copyright &copy; Precision Tools SAS 2021</a></div>
			</div>
			<div class="col-md-8 banner-sec">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
					<div class="carousel-item active">
						<img class="d-block img-fluid" src="img/s1.png" alt="">
						<div class="carousel-caption d-none d-md-block">
							<div class="banner-text">
								<h2></h2>
								<p></p>
							</div>	
						</div>
					</div>
					<div class="carousel-item">
						<img class="d-block img-fluid" src="img/s4.png" alt="">
						<div class="carousel-caption d-none d-md-block">
							<div class="banner-text">
								<h2></h2>
								<p></p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<img class="d-block img-fluid" src="img/s3.png" alt="">
						<div class="carousel-caption d-none d-md-block">
							<div class="banner-text">
								<h2></h2>
								<p></p>
							</div>	
						</div>
					</div>
				</div>		    
			</div>
		</div>
	</div>
</section>
</body>
</html>