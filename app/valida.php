<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT UserColor, id FROM UsersAuth WHERE UserKey=".$_SESSION['UserKey']."");
$reg=sqlsrv_fetch_array($query_empresa);
?>
    <?php
        if (empty($_SESSION['Keyp'])) { $Keyp="";} else { $Keyp = strtolower($_SESSION["Keyp"]);}
        if($Keyp!=NULL){
    $sqls = "
CREATE TABLE DebilidadesSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL, CustomerKey VARCHAR(250)  NOT NULL, DebilidadesKey VARCHAR(250) NOT NULL, DebilidadesName VARCHAR(max) NOT NULL, 
UserKey VARCHAR(150) NOT NULL, DateStamp VARCHAR(150));

CREATE TABLE OportunidadesSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,OportunidadesKey VARCHAR(250) NOT NULL,OportunidadesName VARCHAR(max) NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE FortalezasSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,FortalezasKey VARCHAR(250) NOT NULL,FortalezasName VARCHAR(max) NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE AmenazasSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,AmenazasKey VARCHAR(250) NOT NULL,AmenazasName VARCHAR(max) NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE CargosSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,PlanesKey VARCHAR(250) NOT NULL,CustomerKey VARCHAR(250) NOT NULL,CargosKey VARCHAR(250) NOT NULL,CargosName VARCHAR(max) NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE CausasSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,CausasKey VARCHAR(250) NOT NULL,CausasName VARCHAR(max) ,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ConsecuenciasSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,ConsecuenciasKey VARCHAR(250) NOT NULL,
ConsecuenciasName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ControlesSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,ControlesKey VARCHAR(250) NOT NULL,
ControlesName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE EventosdeRiesgoSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,EventosdeRiesgoKey VARCHAR(250) NOT NULL,
EventosdeRiesgoName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ProcesosSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,ProcesosKey VARCHAR(250) NOT NULL,
ProcesosName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ResponsablesSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,PlanesKey VARCHAR(250) NOT NULL,CustomerKey VARCHAR(250) NOT NULL,ResponsablesKey VARCHAR(250) NOT NULL,
ResponsablesName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE TratamientosSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,TratamientosKey VARCHAR(250) NOT NULL,
TratamientosName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE PlanesSarlaft ( Id INT IDENTITY(1,1) NOT NULL,PlanesKey VARCHAR(250) PRIMARY KEY NOT NULL,PlanesName VARCHAR(max) NOT NULL,PlanesResponsable VARCHAR(max) NOT NULL,
PlanesTarea VARCHAR(max) NOT NULL,PlanesPlazo VARCHAR(max) NOT NULL,PlanesAprueba VARCHAR(max) NOT NULL,PlanesNivelPrioridad VARCHAR(max) NOT NULL,PlanesRespSeguimiento VARCHAR(max) NOT NULL,
PlanesRespAprobacion VARCHAR(max),PlanesFInicio VARCHAR(max) NOT NULL,PlanesFSeguimiento VARCHAR(max) NOT NULL,PlanesFTerminacion VARCHAR(max) NOT NULL,PlanesAvance VARCHAR(max) NOT NULL,
PlanesStatus INT NOT NULL,CustomerKey VARCHAR(250) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE SegClientesSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,SegClientesKey VARCHAR(250) NOT NULL,
SegClientesName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE SegProductosSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,SegProductosKey VARCHAR(250) NOT NULL,
SegProductosName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE SegCanalesSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,SegCanalesKey VARCHAR(250) NOT NULL,
SegCanalesName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE SegJurisdiccionSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,SegJurisdiccionKey VARCHAR(250) NOT NULL,
SegJurisdiccionName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE EControlSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,EscalaKey VARCHAR(250) NOT NULL,EControlKey VARCHAR(250) NOT NULL,EControlValue INT NOT NULL,EControlName INT NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE EProbabilidadSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,EscalaKey VARCHAR(250) NOT NULL,EProbabilidadKey VARCHAR(250) NOT NULL,EProbabilidadValue INT NOT NULL,
EProbabilidadName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ERiesgosSarlaft ( Id INT IDENTITY(1,1)  PRIMARY KEY NOT NULL,EscalaKey VARCHAR(250) NOT NULL,ERiesgosKey VARCHAR(250) NOT NULL,ERiesgosValue INT NOT NULL,ERiesgosName VARCHAR(max) NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ENiveldeRiesgoSarlaft ( Id INT IDENTITY(1,1)  PRIMARY KEY NOT NULL,EscalaKey VARCHAR(250) NOT NULL,ENiveldeRiesgoKey VARCHAR(250) NOT NULL,ENiveldeRiesgoValue INT NOT NULL,
ENiveldeRiesgoName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE EEfectividadSarlaft ( Id INT IDENTITY(1,1)  PRIMARY KEY NOT NULL,EscalaKey VARCHAR(250) NOT NULL,EEfectividadKey VARCHAR(250) NOT NULL,EEfectividadValue INT NOT NULL,
EEfectividadName VARCHAR(max) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE ECategoriaSarlaft ( Id INT IDENTITY(1,1)  PRIMARY KEY NOT NULL,EscalaKey VARCHAR(250) NOT NULL,ECategoriaKey VARCHAR(250) NOT NULL,ECategoriaValue INT NOT NULL,ECategoriaName VARCHAR(max) NOT NULL,
UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150));

CREATE TABLE EscalasSarlaft ( Id INT IDENTITY(1,1)  NOT NULL,IdUser INT NOT NULL,EscalaKey VARCHAR(250) PRIMARY KEY NOT NULL,UserKey VARCHAR(250));

CREATE TABLE GestiondeRiesgoSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
CustomerKey VARCHAR(250) ,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150),ConsecutivoEventoRiesgoValue INT NOT NULL,EventoRiesgoStatus INT NOT NULL,
EventosdeRiesgoKey VARCHAR(250) NOT NULL,
EventosdeRiesgoName VARCHAR(max),
ProcesosKey VARCHAR(250) NOT NULL,
ProcesosName VARCHAR(max),
CargosKey VARCHAR(250) NOT NULL,
CargosName VARCHAR(max),
ResponsablesKey VARCHAR(250) NOT NULL,
ResponsablesName VARCHAR(max),
TipoRiesgo VARCHAR(250),
FuenteRiesgoA VARCHAR(250) NOT NULL,
FuenteRiesgoB VARCHAR(250) NOT NULL,
FuenteRiesgoC VARCHAR(250) NOT NULL,
FuenteRiesgoD VARCHAR(250) NOT NULL,
FuenteRiesgoE VARCHAR(250) NOT NULL,
FuenteRiesgoF VARCHAR(250) NOT NULL,
FuenteRiesgoG VARCHAR(250) NOT NULL,
RiesgoAsociadoA VARCHAR(250) NOT NULL,
RiesgoAsociadoB VARCHAR(250) NOT NULL,
RiesgoAsociadoC VARCHAR(250) NOT NULL,
RiesgoAsociadoD VARCHAR(250) NOT NULL,
EProbabilidadValue INT NOT NULL,
EProbabilidadName VARCHAR(250) NOT NULL,
ERiesgosValue INT NOT NULL,
ERiesgosName VARCHAR(250) NOT NULL,
EProbabilidadCValue INT NOT NULL,
EProbabilidadCName VARCHAR(250) NOT NULL,
ERiesgosCValue INT NOT NULL,
ERiesgosCName VARCHAR(250) NOT NULL);

CREATE TABLE GestiondeRiesgoPSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250) NOT NULL,UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150) NOT NULL,
EventosdeRiesgoKey VARCHAR(250) NOT NULL,
VariableTipo VARCHAR(max) NOT NULL,
VariableName VARCHAR(max) NOT NULL,
VariableObservacion VARCHAR(max) NOT NULL);

CREATE TABLE GestiondeRiesgoCTSarlaft ( Id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,CustomerKey VARCHAR(250),UserKey VARCHAR(150) NOT NULL,DateStamp VARCHAR(150),
EventosdeRiesgoKey VARCHAR(250) NOT NULL,
ControlesName VARCHAR(max) NOT NULL,
ControlesPropietario VARCHAR(250) NOT NULL,
ControlesEjecutor VARCHAR(250) NOT NULL,
ControlesEfectividad VARCHAR(250) NOT NULL,
ControlesFrecuencia VARCHAR(250) NOT NULL,
ControlesCategoria VARCHAR(250) NOT NULL,
ControlesRealizado VARCHAR(250) NOT NULL,
ControlesCalificacion VARCHAR(250) NOT NULL,
ControlesDocumentado VARCHAR(250) NOT NULL,
ControlesAplicado VARCHAR(250) NOT NULL,
ControlesEfectivo VARCHAR(250) NOT NULL,
ControlesEvaluado VARCHAR(250) NOT NULL,
ControlesPromedio VARCHAR(250) NOT NULL,
TratamientosName VARCHAR(max) NOT NULL,
TratamientosEstado VARCHAR(250) NOT NULL,
TratamientosPrioridad VARCHAR(max) NOT NULL,
TratamientosPlandeAccion VARCHAR(max) NOT NULL,
TratamientosFInicial VARCHAR(max) NOT NULL,
TratamientosFFinal VARCHAR(250) NOT NULL,
TratamientosFseguimiento VARCHAR(max) NOT NULL);





ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_ProcesosName FOREIGN KEY(ProcesosKey)
REFERENCES dbo.ProcesosSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_CargosName FOREIGN KEY(CargosKey)
REFERENCES dbo.CargosSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_ResponsablesName FOREIGN KEY(ResponsablesKey)
REFERENCES dbo.ResponsablesSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_CausasName FOREIGN KEY(CausasKey)
REFERENCES dbo.CausasSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_EventosdeRiesgoName FOREIGN KEY(EventosdeRiesgoKey)
REFERENCES dbo.EventosdeRiesgoSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_ConsecuenciasName FOREIGN KEY(ConsecuenciasKey)
REFERENCES dbo.ConsecuenciasSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_ControlesName FOREIGN KEY(ControlesKey)
REFERENCES dbo.ControlesSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_TratamientosName FOREIGN KEY(TratamientosKey)
REFERENCES dbo.TratamientosSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_SegClientesName FOREIGN KEY(SegClientesKey)
REFERENCES dbo.SegClientesSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_SegProductosName FOREIGN KEY(SegProductosKey)
REFERENCES dbo.SegProductosSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_SegCanalesName FOREIGN KEY(SegCanalesKey)
REFERENCES dbo.SegCanalesSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_SegJurisdiccionName FOREIGN KEY(SegJurisdiccionKey)
REFERENCES dbo.SegJurisdiccionSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_DebilidadesName FOREIGN KEY(DebilidadessKey)
REFERENCES dbo.DebilidadesSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_OportunidadesName FOREIGN KEY(OportunidadesKey)
REFERENCES dbo.OportunidadesSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_FortalezasName FOREIGN KEY(FortalezasKey)
REFERENCES dbo.FortalezasSarlaft  (Id)

ALTER TABLE dbo.GestiondeRiesgoSarlaft  WITH CHECK ADD CONSTRAINT FK_GestiondeRiesgo_AmenazasName FOREIGN KEY(AmenazasKey)
REFERENCES dbo.AmenazasSarlaft  (Id)


    ";
    $query = sqlsrv_query($conn,$sqls);

          header("location: ./Clientes.php");
          }
    ?>
    
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
  <div role="dialog" tabindex="-1" class="modal fade" id="modal-avisolegal" >
   <div class="modal-dialog" role="document">
     <div class="modal-content">
     </div>
   </div>
</div>
    <div id="wrapper">

        <?php include 'components/menu.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbarppal.php';?>

                <?php include 'components/content_clientes.php';?>
            </div>
                <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

                <?php include 'components/settings.php';?>
</body>
</html>

