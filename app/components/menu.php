        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" style="background-color: <?php echo $reg['UserColor'];?>" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">

                <div ><img src="../img/as riesgos.png" width="100%"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./Clientes.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="Clientes.php">
                    <i class="fas fa-briefcase"></i>
                    <span>Clientes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Users.php">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Roles.php">
                    <i class="fas fa-user-circle"></i>
                    <span>Roles</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="Perfiles.php">
                    <i class="fas fa-user-cog"></i>
                    <span>Perfiles</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Menu.php">
                    <i class="far fa-newspaper"></i>
                    <span>Menu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Accion.php">
                    <i class="fas fa-pen-square"></i>
                    <span>Acciones</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Estado.php">
                    <i class="fas fa-thumbtack"></i>
                    <span>Estados</span></a>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Addons
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-palette"></i>
                    <span>Colors Dashboard</span>
                </a>
            
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Colors</h6>
            <table width="50%" align="center">
                <tr>
                    <td height="30px">
                <a href="?db=1&clr=1f77b4"><span style="background: #1f77b4;border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-palette"></i></span></a>                        
                    </td>
                    <td>
                <a href="?db=1&clr=ff7f0e"><span style="background: #ff7f0e;border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-palette"></i></span></a>                        
                    </td>
                </tr>
                <tr>                    
                    <td height="30px">
                <a href="?db=1&clr=2ca02c"><span style="background: #2ca02c;border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-palette"></i></span></a>                        
                    </td>
                    <td>
                <a href="?db=1&clr=d62728"><span style="background: #d62728;border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-palette"></i></span></a>                        
                    </td>
                 </tr>
                <tr>                   
                    <td height="30px">
                <a href="?db=1&clr=9467bd"><span style="background: #9467bd;border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-palette"></i></span></a>                        
                    </td>
                    <td>
                <a href="?db=1&clr=8c564b"><span style="background: #8c564b;border-radius: 0.8em;-moz-border-radius: 0.8em;-webkit-border-radius: 0.8em;color: #ffffff;display: inline-block;font-weight: bold;line-height: 1.6em;margin-right: 15px;text-align: center;width: 1.6em; "><i class="fas fa-palette"></i></span></a>                        
                    </td>                                                              
                </tr>
            </table>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/logo.ico" alt="">
                <p class="text-center mb-2"><strong>Precision Tools</strong></p>
                
            </div>

        </ul>