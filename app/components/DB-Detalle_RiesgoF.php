       <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">          
                    <tr>
                        <td class='text-left' colspan="7">Causas</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='Causas' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $regF['VariableName'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_Causas.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteCausas" ><i class="material-icons" id="btn-deleteCausas" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>

                                </table>
                        </div><div id="respCausas"></div>
                <form method="post" id="formularioCausas" >
                     <div class="collapse" id="collapseExample">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Causas</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT CausasName FROM CausasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['CausasName'];?>"><?php echo $row['CausasName'];?></option>
                                    <?php } ?>
                            </select><input type="hidden" name="VariableTipo" value="Causas"><input type="hidden" name="VariableObservacion" value="NA"><input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarCausas" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr>

                    <tr>
                        <td class='text-left' colspan="7">Consecuencias</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExampl" aria-expanded="false" aria-controls="collapseExampl"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='Consecuencias' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_Consecuencias.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteConsecuencias" ><i class="material-icons" id="btn-deleteConsecuencias" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>

                                </table>
                        </div><div id="respConsecuencias"></div>
                <form method="post" id="formularioConsecuencias" >
                     <div class="collapse" id="collapseExampl">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Consecuencias</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT ConsecuenciasName FROM ConsecuenciasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['ConsecuenciasName'];?>"><?php echo $row['ConsecuenciasName'];?></option>
                                    <?php } ?>
                            </select><input type="hidden" name="VariableTipo" value="Consecuencias"><input type="hidden" name="VariableObservacion" value="NA"><input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarConsecuencias" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr>                   
                    <tr>
                        <td class='text-left' colspan="3">Segmento Clientes</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                     <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseE" aria-expanded="false" aria-controls="collapseE"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='SegClientes' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="6" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="4" align="left"><?php echo $roww['VariableObservacion'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_SegClientes.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteSegClientes" ><i class="material-icons" id="btn-deleteSegClientes" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td>
                                  
                                </tr>
                            <?php } ?>

                                </table>
                        </div><div id="respSegClientes"></div>
                <form method="post" id="formularioSegClientes" >
                     <div class="collapse" id="collapseE">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Segmento Clientes</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT SegClientesName FROM SegClientesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['SegClientesName'];?>"><?php echo $row['SegClientesName'];?></option>
                                    <?php } ?>
                            </select>
                            <textarea id="VariableObservacion" name="VariableObservacion" rows="3" class="form-control" required></textarea>
                            <input type="hidden" name="VariableTipo" value="SegClientes">
                            <input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarSegClientes" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="3">Segmento Productos</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                     <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseP" aria-expanded="false" aria-controls="collapseP"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='SegProductos' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="6" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="4" align="left"><?php echo $roww['VariableObservacion'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_SegProductos.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteSegProductos" ><i class="material-icons" id="btn-deleteSegProductos" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td>
                                  
                                </tr>
                            <?php } ?>

                                </table>
                        </div><div id="respSegProductos"></div>
                <form method="post" id="formularioSegProductos" >
                     <div class="collapse" id="collapseP">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Segmento Productos</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT SegProductosName FROM SegProductosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['SegProductosName'];?>"><?php echo $row['SegProductosName'];?></option>
                                    <?php } ?>
                            </select>
                            <textarea id="VariableObservacion" name="VariableObservacion" rows="3" class="form-control" required></textarea>
                            <input type="hidden" name="VariableTipo" value="SegProductos">
                            <input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarSegProductos" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="3">Segmento Canales</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                    <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseC" aria-expanded="false" aria-controls="collapseC"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='SegCanales' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="6" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="4" align="left"><?php echo $roww['VariableObservacion'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_SegCanales.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteSegCanales" ><i class="material-icons" id="btn-deleteSegCanales" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td>
                                  
                                </tr>
                            <?php } ?>

                                </table>
                        </div><div id="respSegCanales"></div>
                <form method="post" id="formularioSegCanales" >
                     <div class="collapse" id="collapseC">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Segmento Canales</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT SegCanalesName FROM SegCanalesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['SegCanalesName'];?>"><?php echo $row['SegCanalesName'];?></option>
                                    <?php } ?>
                            </select>
                            <textarea id="VariableObservacion" name="VariableObservacion" rows="3" class="form-control" required></textarea>
                            <input type="hidden" name="VariableTipo" value="SegCanales">
                            <input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarSegCanales" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="3">Segmento Jurisdiccion</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                    <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseJ" aria-expanded="false" aria-controls="collapseJ"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='SegJurisdiccion' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="6" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="4" align="left"><?php echo $roww['VariableObservacion'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_SegJurisdiccion.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteSegJurisdiccion" ><i class="material-icons" id="btn-deleteSegJurisdiccion" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td>
                                  
                                </tr>
                            <?php } ?>

                                </table>
                        </div><div id="respSegJurisdiccion"></div>
                <form method="post" id="formularioSegJurisdiccion" >
                     <div class="collapse" id="collapseJ">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Segmento Jurisdiccion</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT SegJurisdiccionName FROM SegJurisdiccionSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['SegJurisdiccionName'];?>"><?php echo $row['SegJurisdiccionName'];?></option>
                                    <?php } ?>
                            </select>
                            <textarea id="VariableObservacion" name="VariableObservacion" rows="3" class="form-control" required></textarea>
                            <input type="hidden" name="VariableTipo" value="SegJurisdiccion">
                            <input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarSegJurisdiccion" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr>                                                                                  
                    <tr>
                        <td class='text-left' colspan="7">Debilidades</td>                        
                    </tr> 
                     <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExamp" aria-expanded="false" aria-controls="collapseExamp"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='Debilidades' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_Debilidades.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteDebilidades" ><i class="material-icons" id="btn-deleteDebilidades" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>

                                </table>
                        </div><div id="respDebilidades"></div>
                <form method="post" id="formularioDebilidades" >
                     <div class="collapse" id="collapseExamp">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Debilidades</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT DebilidadesName FROM DebilidadesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['DebilidadesName'];?>"><?php echo $row['DebilidadesName'];?></option>
                                    <?php } ?>
                            </select><input type="hidden" name="VariableTipo" value="Debilidades"><input type="hidden" name="VariableObservacion" value="NA"><input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarDebilidades" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr>                     
                    <tr>
                        <td class='text-left' colspan="7">Oportunidades</td>                        
                    </tr> 
                     <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExam" aria-expanded="false" aria-controls="collapseExam"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='Oportunidades' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_Oportunidades.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteOportunidades" ><i class="material-icons" id="btn-deleteOportunidades" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>

                                </table>
                        </div><div id="respOportunidades"></div>
                <form method="post" id="formularioOportunidades" >
                     <div class="collapse" id="collapseExam">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Oportunidades</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT OportunidadesName FROM OportunidadesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['OportunidadesName'];?>"><?php echo $row['OportunidadesName'];?></option>
                                    <?php } ?>
                            </select><input type="hidden" name="VariableTipo" value="Oportunidades"><input type="hidden" name="VariableObservacion" value="NA"><input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarOportunidades" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr>  
                    <tr>
                        <td class='text-left' colspan="7">Fortalezas</td>                        
                    </tr> 
                     <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExa" aria-expanded="false" aria-controls="collapseExa"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='Fortalezas' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_Fortalezas.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteFortalezas" ><i class="material-icons" id="btn-deleteFortalezas" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>

                                </table>
                        </div><div id="respFortalezas"></div>
                <form method="post" id="formularioFortalezas" >
                     <div class="collapse" id="collapseExa">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Fortalezas</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT FortalezasName FROM FortalezasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['FortalezasName'];?>"><?php echo $row['FortalezasName'];?></option>
                                    <?php } ?>
                            </select><input type="hidden" name="VariableTipo" value="Fortalezas"><input type="hidden" name="VariableObservacion" value="NA"><input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarFortalezas" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="7">Amenazas</td>                        
                    </tr> 
                     <tr>                                               
                        <td class='text-center' style="vertical-align: top;">
                         <div class="form-group"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseEx" aria-expanded="false" aria-controls="collapseEx"><i class="material-icons">&#xE147;</i></button></div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">                            
                            <?php $query = sqlsrv_query($conn,"SELECT id,VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE VariableTipo='Amenazas' AND EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $roww['VariableName'] ;?></td><td colspan="2"><a onClick="return confirm('Está seguro(a) que desea borrar este registro?')" href='delete_Amenazas.php?id=<?php echo $roww['id'] ;?>&ERK=<?php echo $_GET['ERK'] ;?>' type='button' class="delete" id="formularioDeleteAmenazas" ><i class="material-icons" id="btn-deleteAmenazas" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>

                                </table>
                        </div><div id="respAmenazas"></div>
                <form method="post" id="formularioAmenazas" >
                     <div class="collapse" id="collapseEx">
                        <div class="input-group">
                            <select class="form-control" id="VariableName" name="VariableName" required>
                                <option value="">Amenazas</option>                                     
                                    <?php $query = sqlsrv_query($conn,"SELECT AmenazasName FROM AmenazasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'"); while($row = sqlsrv_fetch_array($query)){  ?>                                      
                                <option value="<?php echo $row['AmenazasName'];?>"><?php echo $row['AmenazasName'];?></option>
                                    <?php } ?>
                            </select><input type="hidden" name="VariableTipo" value="Amenazas"><input type="hidden" name="VariableObservacion" value="NA"><input type="hidden" name="EventosdeRiesgoKey" value="<?php echo $_GET['ERK']; ?>">
                            <div class="input-group-append">
                                <button type="button" id="btn-ingresarAmenazas" class="btn btn-primary"><i class="fas fa-save" ></i></button>
                            </div>
                        </div>
                    </div>
                </form>                        
                        </td>
                    </tr> 
            </table>
        </div>