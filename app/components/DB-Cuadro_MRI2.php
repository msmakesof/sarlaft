       <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 9px; color: #333;">                                  
                    <tr id="miTablaAnswer_UGR">
                        <td class='text-center'>
                         <div class="form-group">
                            Probabilidad
                         </div>
                        </td>
                        <td class='text-center' colspan="2" >
                         <div class="form-group">
                            <select class="form-control" required style="font-size: 11px">
                                <option value="">Responsable</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT EProbabilidadName FROM EProbabilidadSarlaft ");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['EProbabilidadName'];?>"><?php echo $row['EProbabilidadName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select> 
                         </div>
                        </td>                                                                      
                        <td class='text-center' colspan="2" rowspan="2">
                         <div class="form-group">
                         <img src="img/mapacalor1.jpg" width="100%">
                         </div>
                        </td>                                                                      
                                                                     
                    </tr>
                    <tr id="miTablaAnswer_UGR">
                        <td class='text-center'>
                         <div class="form-group">
                            Consecuencia
                         </div>
                        </td>
                        <td class='text-center'>
                         <div class="form-group">
                            <select class="form-control" style="font-size: 9px; color: #333;" required >
                                <option value="">Escala de Riesgos</option>                                     
                                    <?php
                        $query = sqlsrv_query($conn,"SELECT ERiesgosName FROM ERiesgosSarlaft");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>                                      
                                <option value="<?php echo $row['ERiesgosName'];?>"><?php echo $row['ERiesgosName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                    </tr>                   
            </table>
        </div> 