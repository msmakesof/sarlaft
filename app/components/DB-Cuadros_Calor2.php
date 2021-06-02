<!--Cuadros de calor gráficos de Riesgos-->
       <div class="table-responsive">
            <table>
                    <tr>
                        <td class='text-center' colspan="4">
                         <div class="form-group">
                            <select class="form-control" required>
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
                    </tr>                
                    <tr>
                        <td class='text-center' width="33%">
                            <?php include 'components/DB-Cuadro_MRI.php';?>                           
                        </td>                                                
                        <td class='text-center' width="33%">
                            <?php include 'components/DB-Cuadro_MRC.php';?>                           
                        </td>
                        <td class='text-center'>
                            <div ><img src='img/<?php echo $reg['CustomerLogo'];?>' style="max-width: 200px" ></div>
                        </td>                                                                          
                    </tr>  

            </table>
        </div>
<!--Fin Cuadros de calor gráficos de Riesgos-->         