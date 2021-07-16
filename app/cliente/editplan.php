<?php
$id = $_GET['id'];
$ck= $_GET['ck'];
include("../curl/plan/idplan.php");
echo 'id...'.$id;
?>
<form id="f">

<div class="form-group row">
    <div class="col-md-12">
        <label>Nombre Plan </label>
        <?php echo $id ?>
        <textarea class="form-control" id="Name2" name="Name2" rows="2" placeholder="Digite nombre del Plan" required><?php echo $dataplan['PlanesName']; ?></textarea>        
    </div>
</div>
 