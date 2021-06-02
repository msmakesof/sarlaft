<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
?>
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
    <div id="wrapper">

        <?php include 'components/menu_setting.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbar.php';?>

                <?php include 'components/content_setting.php';?>

                <?php

            $query = "SELECT EscalaKey FROM EscalasSarlaft";
            $result = sqlsrv_query($conn,$query);
            $row = sqlsrv_fetch_array($result);
            if ($row > 0){
                include 'components/content_escalas_setup.php';
            }else{
                include 'components/content_escalas.php';
            }


                ?>
            </div>
                <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

                <?php include 'components/settings.php';?>
</body>
</html>
<?php include 'ajax/delete_escalas.php';?>
<?php
$CustomerKey=$_SESSION['Keyp'];
if (empty($_GET['db'])) { $db="";} else { $db = strtolower($_GET["db"]);}
if($db != NULL){
        $sqls="INSERT INTO EscalasSarlaft (EscalaKey) VALUES ('".$CustomerKey."')"; 
        $query = sqlsrv_query($conn,$sqls);
        $sql="
INSERT INTO EControlSarlaft (EscalaKey, EControlKey, EControlValue, EControlName, UserKey , DateStamp) VALUES 
('".$CustomerKey."','1',5,'5','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','2',4,'4','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','3',3,'3','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','4',2,'2','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','5',1,'1','123456789','2021-04-09 09:45:00');

INSERT INTO EProbabilidadSarlaft (EscalaKey, EProbabilidadKey, EProbabilidadValue, EProbabilidadName, UserKey , DateStamp) VALUES 
('".$CustomerKey."','1',5,'Certeza','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','2',4,'Casi Certeza','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','3',3,'Posible','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','4',2,'Raro','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','5',1,'Improbable','123456789','2021-04-09 09:45:00');

INSERT INTO ERiesgosSarlaft (EscalaKey, ERiesgosKey, ERiesgosValue, ERiesgosName, UserKey , DateStamp) VALUES 
('".$CustomerKey."','1',5,'Muy Grave','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','2',4,'Grave','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','3',3,'Moderado','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','4',2,'Menor','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','5',1,'Insignificante','123456789','2021-04-09 09:45:00');

INSERT INTO ENiveldeRiesgoSarlaft (EscalaKey, ENiveldeRiesgoKey, ENiveldeRiesgoValue, ENiveldeRiesgoName, UserKey , DateStamp) VALUES 
('".$CustomerKey."','1',4,'Bajo','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','2',3,'Tolerable','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','3',2,'Mayor','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','4',1,'Extremo','123456789','2021-04-09 09:45:00');

INSERT INTO ECategoriaSarlaft (EscalaKey, ECategoriaKey, ECategoriaValue, ECategoriaName, UserKey , DateStamp) VALUES 
('".$CustomerKey."','2',3,'Preventivo','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','3',2,'Correctivo','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','4',1,'Ambos','123456789','2021-04-09 09:45:00');

INSERT INTO EEfectividadSarlaft (EscalaKey, EEfectividadKey, EEfectividadValue, EEfectividadName, UserKey , DateStamp) VALUES 
('".$CustomerKey."','2',3,'Pobre','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','3',2,'Adecuado','123456789','2021-04-09 09:45:00'),
('".$CustomerKey."','4',1,'Bueno','123456789','2021-04-09 09:45:00');

";
        $querys = sqlsrv_query($conn,$sql);


    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalas";
</SCRIPT>';
    } 
}
?>