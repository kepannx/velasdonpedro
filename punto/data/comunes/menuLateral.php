<!-- Left navbar-header -->
  <div class="navbar-default sidebar" role="navigation" id="noPrint" onload="loadTraslados()">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" >
      
  <!-- Perfil y Menú de Perfil-->
      <div class="user-profile" id="noPrint">
        <div class="dropdown user-pro-body" id="noPrint">
          <div id="noPrint" ></div>
          <a href="#" class="dropdown-toggle u-dropdown"  id="noPrint" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="word-wrap:break-word;">
          Hola <?php echo $datoUsuario["nombrePunto"]; ?>

            <span class="caret"></span></a>
              <ul class="dropdown-menu animated flipInY">
                <li><a href="#"><i class="ti-user"></i> Mi Perfil</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="ti-settings"></i>Configuración</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo PATH; ?>logOut.php"><i class="fa fa-power-off"></i> Salida Segura</a></li>
              </ul>
        </div>
      </div>
      <!-- Fin Perfil Menú Perfil-->


      <!-- Menus de Navegación -->
      <ul class="nav" id="side-menu">
        
        
        <li class="nav-small-cap m-t-10" align="center">Menú Principal</li>
        <!-- inventario-->
        <li><a href="#" class="waves-effect"><i class="fa  fa-cube"></i> <span class="hide-menu">Productos<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            <li><a href="<?php echo PATH; ?>modulos/productos/">Listado</a></li>
            <!-- BUSQUEDA -->
            <li><a href="#" data-toggle="modal" data-target="#busquedaGeneral">Busca Un Producto</a></li>
            <!-- fin busqueda -->
          </ul>
        </li>
        <!-- Fin inventario-->

      
        <!-- CONTABILIDAD-->
    <li><a href="#" class="waves-effect"><i class="fa   fa-university"></i> <span class="hide-menu">Contabilidad<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            
         
            
            <li><a href="<?php echo PATH; ?>modulos/contabilidad/listasGastos.php">Egresos y Gastos</a></li>

            <li><a href="<?php echo PATH; ?>modulos/contabilidad/movimientosDia.php">Movimientos Del Día</a></li>


            <li><a href="<?php echo PATH; ?>modulos/contabilidad/facturasCuentasCobro.php">Facturas</a></li>
  
            <li><a href="<?php echo PATH; ?>modulos/contabilidad/historicoVentas.php">Historico de Ventas</a></li>
            
          </ul>
        </li>
    <!-- FIN CONTABILIDAD-->
    <!-- TRASLADO DE MERCANCÍA-->


    <li><a href="#" class="waves-effect"><i class="fa   fa-arrows-h"></i> <span class="hide-menu">TRASLADOS<span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            <li><a href="<?php echo PATH; ?>modulos/inventario/traslados.php">Hacer Traslados</a></li>
            <li><a href="<?php echo PATH; ?>modulos/inventario/checkTraslados.php">Movimientos de Traslados</a></li>
          </ul>
        </li>



    <!-- FIN DEL TRASLADO DE MERCANCÍA-->


    <?php if ($datoUsuario["modoInventario"]=='si') {
    ?>
    <li><a href="<?php echo PATH; ?>modulos/inventario/" class="waves-effect"><i class="fa fa-truck"></i> <span class="hide-menu">INVENTARIO</span></a></li>
    <?php } ?>


       

      


        <li><a href="<?php echo PATH; ?>logOut.php" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Salida Segura</span></a></li>
      </ul>
    </div>
  </div>
  <!-- Left navbar-header end -->