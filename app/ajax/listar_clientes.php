<?php

require_once ("../components/sql_server_login.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = sqlsrv_query($con,"SELECT id, CustomerKey, CustomerLogo, CustomerCity, CustomerName, CustomerNit, CustomerColor, CustomerDB FROM CustomerSarlaft");	
	?>
	<?php
	include('../components/table.php');
	?>
					<tr>
						<th class='text-center'>#</th>
						<th class='text-center'>DataBase</th>
						<th class='text-left'>Ciudad </th>
						<th class='text-left'>Nombre Cliente </th>
						<th class='text-center'>Nit</th>
						<th class='text-center'>Logo</th>
						<th class='text-center'>Color</th>
						<th class='text-center'>Configurar</th>
						<th class='text-center'>UGR</th>
						<th class='text-left'>Acciones</th>
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						$i=1;
						while($row = sqlsrv_fetch_array($query)){	
							$id=$row['id'];
							$CustomerDB=$row['CustomerDB'];
							$CustomerLogo=$row['CustomerLogo'];
							$CustomerName=$row['CustomerName'];
							$CustomerCity=$row['CustomerCity'];
							$CustomerNit=$row['CustomerNit'];
							$CustomerKey=$row['CustomerKey'];
							$CustomerColor=$row['CustomerColor'];						
							$finales++;
							$colorud='<span style="background: '.$CustomerColor.';border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-tint"></i></span>';
							?>
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $i++;?></td>
							<td class='text-left'>E<?php echo $CustomerDB;?></td>
							<td class='text-left'><?php echo $CustomerCity;?></td>
							<td class='text-left'><?php echo $CustomerName;?></td>
							<td class='text-center'><?php echo $CustomerNit;?></td>
							<td class='text-center'><a href="logo.php?id=<?php echo $id;?>" data-toggle="modal" data-target="#modal-avisolegal"><img src='img/<?php echo $CustomerLogo;?>' width='45' height='20'  border='0'/></a></td>
							<td class='text-center'><?php echo $colorud;?></td>
							<td class='text-center'><a href="?Keyp=<?php echo $CustomerKey; ?>" class='btn btn-default' title='Ingresar'><i class="fas fa-sign-in-alt"></i></a></td>							
							<td class='text-center'><a href="?Keypugr=<?php echo $CustomerKey; ?>" class='btn btn-default' title='Ingresar'><i class="fab fa-artstation"></i></a></td>
							<td class='text-left'>
								<a href="#"  data-target="#editClienteModal" class="edit" data-toggle="modal" data-name="<?php echo $CustomerName?>" data-city="<?php echo $CustomerCity?>" data-nit="<?php echo $CustomerNit?>" data-color="<?php echo $CustomerColor;?>" data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deleteClienteModal" class="delete" data-toggle="modal" data-key="<?php echo $CustomerKey?>" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                    		</td>
						</tr>
						<?php }?>

				</tbody>			
			</table>
		</div>	

	
	<?php	
	}
	?>          
		  
