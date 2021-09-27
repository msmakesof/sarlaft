<?php 
$qry=sqlsrv_query($con,"SELECT U.UserName, U.IdRol, R.RolNombre, P.PER_IdMenu, OPC_Nombre, P.PER_IdAccion, ACC_Nombre
FROM UsersAuth U 
JOIN RolUsers R ON R.IdRol = U.IdRol AND R.IdEstado = 1
JOIN PermisosxRol P ON P.PER_IdRol = R.IdRol 
JOIN OptionMenu ON OPC_Id = P.PER_IdMenu AND OPC_IdEstado = 1
JOIN Action ON ACC_IdAccion = PER_IdAccion AND ACC_IdEstado= 1
WHERE U.UserKey = '".$UserKey."' ORDER BY OPC_Nombre, ACC_Nombre ");

?>