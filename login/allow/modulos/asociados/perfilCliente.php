<?php 
session_start();
require('../../data/libreria.lib/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require '../../data/libreria.lib/70/libreria.class.php';
$consultaComun=new consultasComunes();
$consultas=new queryAjax();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
/*breadcrumb */
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoCliente=mysql_fetch_array($consultaComun->sqlCliente($_SESSION['IDCLIENTE']));
/*breadcrumb */
$paginaActual=clientes;
$breadcrumb = array(0 => clientes, 1=> perfilCliente." ".$datoCliente["nombreCliente"]);


?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

<!-- CSS PLUGIN TABLAS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- FIN CSS PLUGIN TABLAS-->

<!-- CSS PLUGIN sweet alert -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
</head>



<body>
<!-- Preloader -->
<div class="preloader" id="noPrint">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper" id="noPrint">
  <!-- Navigación -->
  <?php 
    require("../../data/comunes/headerMenu.php");
  ?>


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require("../../data/comunes/menuLateral.php");
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  <!-- Contenedor de Pagina -->
  <div id="page-wrapper" id="noPrint">
    <div class="container-fluid">
      <!-- breadcrumb -->
      <div class="row bg-title" id="noPrint">
        <?php 
         require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->

      <!-- Alerta Sobre Ausencia Prolongada de Usuario-->
    
      <div class="row">

           <!-- Cuentas y Abonos -->
        <div class="col-md-12 col-xs-12">
          
          <!--Boton de Abono General -->
            <div class="col-md-12">
                <?php
                  $consultaComun->botonAbonoPazYSalvo($datoCliente["idcliente"], $datoCliente["nombreCliente"], 1);
                ?>
            </div>
          <!-- Fin Abono General-->


          <div class="col-md-12" id="noPrint">
               <!-- Histórico de Compras-->
          <?php
            require("../../data/comunes/listas/asociados/historicoCompras.php");
          ?>
          
          <!-- Fin de Histórico de Compras-->

          </div>
          <!-- -->
         
        </div>
          <!-- Fin de las Cuentas y Los Abonos-->


        
      </div>
   

      <!-- Fin del cuerpo-->
      
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/asociados/abonoCreditoGlobal.php");
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>
<!-- Guardar Abono -->
<script src="<?php echo PATH ?>js/guardar/guardarAbonoGlobal.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- JS PLUGINGS-->

 <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
 

    
  <!-- TABLAS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
      $('#tablaClientes').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          
          "drawCallback": function ( settings ) {
            var api = this.api();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

              }
            } );
          }
        } );
  });
    });
    
  </script>
  <!--FIN PLUGIN TABLAS -->

  <!-- modal -->

 
  <!-- Fin modal -->
<!-- FIN PLUGIN JS-->
</body>
</html>
