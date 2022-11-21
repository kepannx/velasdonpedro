<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/contabilidad/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);

$consultaComun=new consultasComunes();
$consultaContable=new consultaContabilidad();



//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=contabilidad;
$breadcrumb = array(0 => index, 1 => listaGastos);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

</head>



<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
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
  <div id="page-wrapper">
    <div class="container-fluid">
      
      
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
          require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->
        
        <div class="row">
          <div class="col-md-12"> 
            <div class="white-box">
                <div class="col-md-12">
                 <button class="btn btn-block btn-info col-md-12" data-toggle="modal" data-target="#registrarGasto"> Ingresar Gastos</button>
                </div>

                  
                <div class="col-md-12"><h3><i class="fa fa-list"></i>Lista de Gastos</h3></div>

                
               
               <?php
                


                  $consultaContable->listaGastos($id, 1)
               ?>

               <div class="pull-right m-t-30 text-right">
                        <p>Gastos y Egresos Sin Liquidar </p>
                        <hr>
                        <h3><b>Total :</b> $ <?php echo number_format($consultaContable->valorEgresosSinLiquidar(1)); ?></h3>
                      </div>


          </div>
        </div>
      
      <!-- Fin del cuerpo-->



      
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/contabilidad/registrarGasto.php");
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
<script src="<?php echo PATH ?>js/guardar/guardarEgresoGastos.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- 
<script src="<?php echo PATH ?>js/acciones/resaurarAnularGastoEgreso.js" type="text/javascript" charset="utf-8" async defer></script> -->
<!-- TABLAS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
 



<script>
    $(document).ready(function(){
      $('#tablaGastos').DataTable();
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

</body>
</html>
