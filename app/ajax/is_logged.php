<?php	
session_start();
if (empty($_SESSION['UserKey'])) { $UserKey="";} else { $UserKey = strtolower($_SESSION['UserKey']);}
if (empty($_SESSION['UserStatus'])) { $UserStatus="";} else { $UserStatus = strtolower($_SESSION['UserStatus']);}

if (empty($_SESSION['IdUsuario'])) { $IdUsuario="";} else { $IdUsuario = strtolower($_SESSION['IdUsuario']);}

if ($_SESSION['UserKey']==NULL AND $_SESSION['UserStatus'] != 1) {
    session_destroy();
    header("location: ../logout.php");
    exit;
}
?>
    