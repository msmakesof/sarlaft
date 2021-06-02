  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form action="./" method="post" name="login_form" class="login100-form validate-form"><img src="img/as riesgos.png" width="80%"><p><hr></p>
          <span class="login100-form-title p-b-43">
            Iniciar sesión
          </span>
          
          
          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100" type="email" name="email">
            <span class="focus-input100"></span>
            <span class="label-input100">Email</span>
          </div>
          
          
          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="passwd" id="passwd">
            <span class="focus-input100"></span>
            <span class="label-input100">Password</span>
          </div>
          
                    <div class="controls">
                      <span style="color: red"><?php echo $error; ?></span>
                        <button type="submit" class="btn btn-primary" id="sub" name="submit">Ingresar</button>
                            <!-- if login failed show this -->
                            <?php if(isset($_GET['error'])) {?>
                              <div class="alert alert-error fade in error">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Ups! That wasn't correct...</strong>
                            </div>
                          <?php }?>   
                    </div>
          <p>
            <div>
              <a href="#" class="txt1">
                ¿Olvidó su contraseña?
              </a>
            </div>
          </p>
          
          <div class="text-center p-t-46 p-b-20">
            <span class="txt2">
              Visite nuestras redes sociales
            </span>
          </div>

          <div class="login100-form-social flex-c-m">
            <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
              <i class="fa fa-facebook-f" aria-hidden="true"></i>
            </a>

            <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
          </div>
        </form>

        <div class="login100-more" style="background-image: url('img/bg-04.jpg');">
        </div>
      </div>
    </div>
  </div>
