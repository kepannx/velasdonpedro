<!-- Left navbar-header -->
  <div class="navbar-default sidebar" role="navigation" id="noPrint">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" >
      
  <!-- Perfil y Menú de Perfil-->
      <div class="user-profile" id="noPrint">
        <div class="dropdown user-pro-body" id="noPrint">
          <div id="noPrint" ><img src="" alt="Usuario" class="img-circle" ></div>
          <a href="#" class="dropdown-toggle u-dropdown"  id="noPrint" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          Hola <?php echo $datoUsuario["nombre"]; ?>

            <span class="caret"></span></a>
              <ul class="dropdown-menu animated flipInY">
                <li><a href="#"><i class="ti-user"></i> Mi Perfil</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="ti-settings"></i>Configuración</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo PATH; ?>logOut.php?id=<?php echo $_SESSION['datos']; ?>"><i class="fa fa-power-off"></i> Salida Segura</a></li>
              </ul>
        </div>
      </div>
      <!-- Fin Perfil Menú Perfil-->


      <!-- Menus de Navegación -->
      <ul class="nav" id="side-menu">
        
        
        <li class="nav-small-cap m-t-10" align="center">Menú Principal</li>
        

        <!-- Asociados/Clientes -->
        <li>
          <a href="<?php echo PATH ?>modulos/asociados/index.php?id=<?php echo $_SESSION['datos']; ?>" class="waves-effect"><i class="fa fa-user"></i>
            <span class="hide-menu">Tus Clientes</span></a>
         
        </li>
       <!-- Fin Asociados/Clientes -->
      

       <!-- PUNTOS DE VENTA-->
        <li><a href="#" class="waves-effect"><i class="fa  fa fa-fort-awesome"></i> <span class="hide-menu">Tus Puntos de Venta<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            <li><a href="<?php echo PATH ?>modulos/puntosVenta/lista.php">Lista De Los Puntos</a></li>

            <li><a href="<?php echo PATH ?>modulos/puntosVenta/nuevo.php">Ingresar Nuevo Punto</a></li>
            
          </ul>
        </li>
        <!-- Fin PUNTOS DE VENTA-->

        
        
       
       <!-- DENEGAR PERMISO--> 
        <!-- productos-->
        <li><a href="#" class="waves-effect"><i  class="fa fa-cube"></i> <span class="hide-menu">Productos<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
           

             <li><a href="<?php echo PATH?>modulos/inventario/crearItemInventario.php?id=<?php echo $_SESSION['datos']; ?>">Nuevo Producto</a></li>
            
             <li><a href="<?php echo PATH ?>modulos/inventario/">Lista Productos</a></li>
             

             <li><a href="<?php echo PATH ?>modulos/categorias/index.php?id=<?php echo $_SESSION['datos']; ?>">Categorías</a></li>

            <li><a href="<?php echo PATH ?>modulos/inventario/trasladoMercancia.php?id=<?php echo $_SESSION['datos']; ?>">Traslado de Mercancía</a></li>
            
            <li><a href="<?php echo PATH ?>modulos/inventario/imeisSeriales.php?id=<?php echo $_SESSION['datos']; ?>">IMEIS Y SERIALES</a></li>



          </ul>
        </li>
        <!-- Fin productos-->
    



        <!-- DENEGAR PERMISO-->
        <!-- Provedores-->
        <li><a href="#" class="waves-effect"><i class="fa  fa-truck"></i> <span class="hide-menu">Tus Provedores<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            <li><a href="<?php echo PATH ?>modulos/provedores/">Lista Proveedores</a></li>

            <li><a href="<?php echo PATH ?>modulos/provedores/ingresarProvedor.php?id=<?php echo $_SESSION['datos']; ?>">Ingresar Proveedor</a></li>
            
          </ul>
        </li>
        <!-- Fin provedores-->





      <!-- DENEGAR PERMISO-->
        <!-- inventario-->
        <li><a href="#" class="waves-effect"><i class="fa  fa-cubes"></i> <span class="hide-menu">Tus Inventarios<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            

            <li><a href="<?php echo PATH ?>modulos/inventario/ingresoLotes.php?id=<?php echo $_SESSION['datos']; ?>">Ingresar Lotes</a></li>
            
          </ul>
        </li>
        <!-- Fin inventario-->




        
    

        <li><a href="#" class="waves-effect"><i class="fa fa-cog"></i> <span class="hide-menu">Administración Sistema<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
        

             <li><a href="<?php echo PATH ?>modulos/settings/misUsuarios.php">Mis Usuarios</a></li>
      
                    
            <!-- Sincronización de Datos-->
             <li> <a href="javascript:void(0)" class="waves-effect"> <span class="hide-menu">Sincronización de Datos<span class="fa arrow"></span></span></a>
              <ul class="nav nav-third-level">
                <li> <a href="<?php echo PATH ?>modulos/sincronizacion/clientes.php?id=<?php echo $_SESSION['datos']; ?>">Sincronizar Clientes</a> </li>


                <li> <a href="<?php echo PATH ?>modulos/sincronizacion/provedores.php?id=<?php echo $_SESSION['datos']; ?>">Sincronizar Proveedores</a> </li>


                <li> <a href="<?php echo PATH ?>modulos/sincronizacion/ingresoInventario.php?id=<?php echo $_SESSION['datos']; ?>">Sincronizar Inventario</a> </li>


                <li> <a href="<?php echo PATH ?>modulos/sincronizacion/ingresoCelularesImeis.php?id=<?php echo $_SESSION['datos']; ?>">Sincronizar Seriales e Imeis</a> </li>
              
                  
                </li>
              </ul>
            </li>
        <!--Fin de sincrinización de datos -->

        <li><a href="<?php echo PATH ?>modulos/settings/settings.php?id=<?php echo $_SESSION['datos']; ?>">Configuración de Datos de la Aplicación</a></li>

          </ul>
        </li>



        <li><a href="<?php echo PATH ?>logOut.php?id=<?php echo $_SESSION['datos']; ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Salida Segura</span></a></li>
      </ul>
    </div>
  </div>
  <!-- Left navbar-header end -->