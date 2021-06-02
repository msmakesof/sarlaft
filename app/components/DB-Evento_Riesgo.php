        <div class="table-responsive">
            <table class="table table-striped table-hover" style="font-size: 12px; color: #333; background-color: #FBFBFC;">
                    <tr>
                        <td>
                         <div class="form-group">
                            <div align="left"><label>Consecutivo</label></div>
                            <input class="form-control" type="text" id="ConsecutivoEventoRiesgoValue" name="ConsecutivoEventoRiesgoValue" readonly="readonly" value="1">                        
                        </div>                            
                        </td>
                        <td class='text-center' colspan="10">
                         <div class="form-group">
                            <div align="left"><label>Evento</label></div> 
                            <select class="form-control" id="EventosdeRiesgoName" name="EventosdeRiesgoName" required>
                                <option value="">Evento de Riesgo</option>                                     
                                    <?php
                                        $query = sqlsrv_query($conn,"SELECT EventosdeRiesgoName FROM EventosdeRiesgoSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                        while($row = sqlsrv_fetch_array($query)){   
                                    ?>
                                    <option value="<?php echo $row['EventosdeRiesgoName'];?>"><?php echo $row['EventosdeRiesgoName'];?></option>
                                    <?php
                                        }
                                    ?>
                            </select>
                         </div>
                        </td>
                        <td colspan="2" align="right" style="vertical-align: top;"><div id="resp"></div></td>
                        <td colspan="2" align="right" style="vertical-align: top;"><button type="button" id="btn-ingresar" class="btn btn-primary">Crear Evento</button></td>
                    </tr>
            </table>
        </div>