       <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">          
                    <tr>
                        <td class='text-left' colspan="7">Causas</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <select class="form-control" id="ConsecuenciasName" name="ConsecuenciasName" required>
                                <option value="">Causas</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT CausasName FROM CausasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['CausasName'];?>"><?php echo $row['CausasName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr> 

                    <tr>
                        <td class='text-left' colspan="7">Consecuencias</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <select class="form-control" id="ConsecuenciasName" name="ConsecuenciasName" required>
                                <option value="">Consecuencias</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT ConsecuenciasName FROM ConsecuenciasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['ConsecuenciasName'];?>"><?php echo $row['ConsecuenciasName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr>                    
                    <tr>
                        <td class='text-left' colspan="3">Segmento Clientes</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="2">
                         <div class="form-group">
                            <select class="form-control" id="SegClientesName" name="SegClientesName" required>
                                <option value="">Segmento Clientes</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT SegClientesName FROM SegClientesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['SegClienteName'];?>"><?php echo $row['SegClientesName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                        <td class='text-left' colspan="4">
                         <div class="form-group">
                            <textarea class="form-control" id="VariableObservacion" name="VariableObservacion" rows="3" required></textarea>
                         </div>
                        </td>                        
                    </tr>
                    <tr>
                        <td class='text-left' colspan="3">Segmento Productos</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="2">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Segmento Productos</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT SegProductosName FROM SegProductosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['SegClienteName'];?>"><?php echo $row['SegProductosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                        <td class='text-left' colspan="4">
                         <div class="form-group">
                            <textarea class="form-control" id="VariableObservacion" name="VariableObservacion" rows="3" required></textarea>
                         </div>
                        </td>                        
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="3">Segmento Canales</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="2">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Segmento Canales</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT SegCanalesName FROM SegCanalesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['SegClienteName'];?>"><?php echo $row['SegCanalesName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                        <td class='text-left' colspan="4">
                         <div class="form-group">
                            <textarea class="form-control" id="VariableObservacion" name="VariableObservacion" rows="3" required></textarea>
                         </div>
                        </td>                        
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="3">Segmento Jurisdiccion</td>                        
                        <td class='text-left' colspan="4">Observaciones</td>                        
                    </tr>                      
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="2">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Segmento Jurisdiccion</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT SegJurisdiccionName FROM SegJurisdiccionSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['SegClienteName'];?>"><?php echo $row['SegJurisdiccionName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                        <td class='text-left' colspan="4">
                         <div class="form-group">
                            <textarea class="form-control" id="VariableObservacion" name="VariableObservacion" rows="3" required></textarea>
                         </div>
                        </td>                        
                    </tr>                                                                                  
                    <tr>
                        <td class='text-left' colspan="7">Debilidades</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Debilidades</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT DebilidadesName FROM DebilidadesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['DebilidadesName'];?>"><?php echo $row['DebilidadesName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr>                     
                    <tr>
                        <td class='text-left' colspan="7">Oportunidades</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Oportunidades</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT OportunidadesName FROM OportunidadesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['OportunidadesName'];?>"><?php echo $row['OportunidadesName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="7">Fortalezas</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Fortalezas</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT FortalezasName FROM FortalezasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['FortalezasName'];?>"><?php echo $row['FortalezasName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr> 
                    <tr>
                        <td class='text-left' colspan="7">Amenazas</td>                        
                    </tr> 
                    <tr>                                               
                        <td class='text-center'>
                         <div class="form-group">
                        <i class="material-icons">&#xE147;</i>
                         </div>
                        </td>                        
                        <td class='text-center' colspan="6">
                         <div class="form-group">
                            <select class="form-control" required>
                                <option value="">Amenazas</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT AmenazasName FROM AmenazasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['AmenazasName'];?>"><?php echo $row['AmenazasName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr>  
            </table>
        </div>