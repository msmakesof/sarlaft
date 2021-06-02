<?php
    $email = $passwd = $error = "";
    $errorflag = false;

    $erroremail = "<h3 class='erroremail'>Email Required...!</h3>";
    $errorpasswd = "<h3 class='errorpasswd'>Password Required...!</h3>";

    if (isset($_POST["submit"])){
        if (empty($_POST["email"])){
            echo $erroremail;
            $errorflag = false;
        }elseif (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            $erroremail = "<h3 class='erroremail'>Invalido Email...!</h3>";
            echo $erroremail;
            $errorflag = false;
        }else{
            $email = validation_input($_POST["email"]);
            $errorflag = true;
        }

        if (empty($_POST["passwd"])){
            echo $errorpasswd;
            $errorflag = false;
        }else{

            $len = strlen($_POST["passwd"]);
            if ($len > 15 || $len < 3){
                $errorpasswd = "<h3 class='errorpasswd'>Password debe tener entre 3 y 15 caracteres</h3>";
                echo $errorpasswd;
                $errorflag= false;
            }else{
                $passwd = validation_input($_POST["passwd"]);
                $errorflag = true;
            }
        }


        if ($errorflag = true){

            $query = "SELECT * FROM UsersAuth WHERE UserEmail = '$_POST[email]' AND Password = '$_POST[passwd]'";
            $result = sqlsrv_query($con,$query);
            $row = sqlsrv_fetch_array($result);
            if ($row > 0){
                $_SESSION["IdUser"] = $row["IdUser"];
                $_SESSION["UserKey"] = $row["UserKey"];
                $_SESSION["UserEmail"] = $row["UserEmail"];
                $_SESSION["UserName"] = $row["UserName"];
                $_SESSION["UserTipo"] = $row["UserTipo"];
                $_SESSION["UserStatus"] = $row["UserStatus"];
                //$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/app/clientes.php';
                $home_url = 'http://localhost:8090/app/clientes.php';
                header('Location: '. $home_url);
            }else {
                $error = "Usuario o contraseña no coincide...!";

            }
        }
    }
    function validation_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


?> 