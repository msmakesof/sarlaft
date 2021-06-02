<?php
$host = "PMALAP-004\\SQLEXPRESS"; //servidor
$db_name = "SecureLogin"; //base de datos
$username = "sa "; //Usuario
$password = "Answer934@";
try {
    $con = new PDO("sqlsrv:Server={$host};Database={$db_name}", $username, $password);
}
catch(PDOException $exception){
	echo "Connection error: " . $exception->getMessage();
}

$query = "SELECT * FROM CustomerSarlaft";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
$num = count($rows);
print $num;

echo "<br>";
// To print results :
foreach ($rows as $row) {
    echo $row["CustomerKey"] . "<br/>";
}

echo "<br>";
echo "<br>------------------------------------";
echo "<br>";
$host = "PMALAP-004\\SQLEXPRESS"; //servidor
$db_name = "sarlaft"; //base de datos
$username = "sa "; //Usuario
$password = "Answer934@";
try {
    $con = new PDO("sqlsrv:Server={$host};Database={$db_name}", $username, $password);
}
catch(PDOException $exception){
	echo "Connection error: " . $exception->getMessage();
}
//echo $con;
if($con){
	echo "conexion correcta<br>";
	$query = "SELECT ERiesgosName FROM ERiesgosSarlaft";
	$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	//$rows = $stmt->fetchAll();
	$rows = $stmt->rowCount();
	//$num = count($rows);
	//print $num;
	echo "filas....".$rows;

	echo "<br>";
	// To print results :
	foreach ($rows as $row) {
		echo $row["ERiesgosName"] . "<br/>";
	}
}
else {
	echo "no hay conexion";
}
?>