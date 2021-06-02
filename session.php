 <?php
 session_start();
include 'app/components/sql_server_login.php';
?>
<?php
if (empty($_POST['email'])) { $email="";} else { $email = strtolower($_POST["email"]);}
if (empty($_POST['password'])) { $password="";} else { $password = $_POST["password"];}
if (empty($_POST['human'])) { $human="";} else { $human = $_POST["human"];}

    if($email==NULL){echo 'Campo usuario vacio';} 
    else if($password==NULL){echo 'Campo password vacio';}
    else if($human==NULL){echo 'Seleccione no soy un robot ...';}
    else{
            //echo "mks<br>";
            $query = "SELECT UserKey,CustomerKey,UserEmail,UserName,UserTipo,UserStatus FROM UsersAuth WHERE UserEmail = '$_POST[email]' AND Password = '$_POST[password]'";
            //echo "qry.....$query";
            $result = sqlsrv_query($con,$query);
            $row = sqlsrv_fetch_array($result);
            if ($row > 0){
                
                $_SESSION["UserKey"] = $row["UserKey"];
                $_SESSION["CustomerKey"] = $row["CustomerKey"];
                $_SESSION["UserEmail"] = $row["UserEmail"];
                $_SESSION["UserName"] = $row["UserName"];
                $_SESSION["UserTipo"] = $row["UserTipo"];
                $_SESSION["UserStatus"] = $row["UserStatus"];
                echo'<SCRIPT LANGUAGE="javascript">
                location.href = "./app/Clientes.php";
                </SCRIPT>';
              }  else{

                echo 'Usuario y contraseña no coincide!';
              }
              }                             

?>
<!--fin acceso plataforma-->
