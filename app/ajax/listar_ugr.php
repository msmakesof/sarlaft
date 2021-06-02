<?php
	include('is_logged.php');
	/* Connect To Database*/
	require_once ("../components/sql_server.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){

	$query = sqlsrv_query($conn,"SELECT id, CustomerKey, CargosKey, CargosName, UserKey FROM CargosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
	{		
	?>
	<?php
	include('../components/table.php');
	?>
					<tr>
						<th class='text-center'>#</th>
						<th class='text-left'>Nombre Cargo </th>
						<th class='text-center'>Eventos</th>
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						$i=1;
						while($row = sqlsrv_fetch_array($query)){	
							$id=$row['id'];
							$CustomerKey=$row['CustomerKey'];
							$CargosKey=$row['CargosKey'];
							$CargosName=$row['CargosName'];
							$UserKey=$row['UserKey'];					
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $i++;?></td>
							<td class='text-left'><?php echo $CargosName;?></td>
							<td class='text-center'><a href="#" class='btn btn-default' title='Eventos'><i class="material-icons">&#xE147;</i></a></td>
						</tr>
						<?php }?>

				</tbody>			
			</table>
		</div>	

	
	<?php	
	}	
}
?>          
		  
