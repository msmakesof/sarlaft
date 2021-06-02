<?php
echo getcwd() . "\n";
//require_once '../../config/dbx.php';
$Estado = $_POST['idestado'];
echo "state   ".$Estado;
?>
<select class="form-control select2" name="edit_estado" id="edit_estado" style="width: 100%;" required>
	<option value="">Seleccione ...</option>
	<?php include("curl/estado/listar.php"); ?>
</select>
