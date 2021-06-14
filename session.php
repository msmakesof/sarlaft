 <?php
 session_start();
//include 'app/components/sql_server_login.php';
//include 'app/config/db.php';

?>
<?php
if (empty($_POST['email'])) { $email="";} else { $email = strtolower($_POST["email"]);}
if (empty($_POST['password'])) { $password="";} else { $password = $_POST["password"];}
if (empty($_POST['human'])) { $human="";} else { $human = $_POST["human"];}

    if($email==NULL){echo 'Campo usuario vacio';} 
    else if($password==NULL){echo 'Campo password vacio';}
    else if($human==NULL){echo 'Seleccione no soy un robot ...';}
    else{
      ////$query = "SELECT UserKey,CustomerKey,UserEmail,UserName,UserTipo,UserStatus FROM UsersAuth WHERE UserEmail = '$_POST[email]' AND Password = '$_POST[password]'";
      //echo "qry.....$query";
      ////$result = sqlsrv_query($con,$query);
      ////$row = sqlsrv_fetch_array($result);
      include 'app/curl/usuario/buscar.php';

      if ($cantidad == 1){       
          //echo "ingreso OK";
          echo'<SCRIPT LANGUAGE="javascript">
          location.href = "./app/Clientes.php";
          </SCRIPT>';
        }
        else{
          echo 'Usuario y contraseña no coincide!';
        }
    }
?>
<!--fin acceso plataforma-->