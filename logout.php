<?php
include 'app/components/sql_server_login.php';

// Delete the actual cookie.
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// Destroy session
session_destroy();
header('Location: ./');




;?>