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
$breadcrumb = array(0 => index, 1 => tusFacturas);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

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


                <div class="col-md-12"><h3><i class="fa fa-list"></i> Todas Tus Facturas  Del Último Trimestre</h3></div>
                
            <!-- WIDGETS-->
                <div class="col-md-12">
                 
                  <!-- Indicador Ventas del Día -->
                  <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="white-box">
                      <?php 
                          require("../../data/comunes/widgets/contabilidad/valorCompradoUltimoTrimestre.php");
                      ?>
                    </div>
                  </div>
                <!-- Fin Indicador Ventas del Día -->



                <!-- Indicador Créditos del Día -->
                  <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="white-box">
                      <?php 
                          require("../../data/comunes/widgets/contabilidad/misCreditosUltimoTrimestre.php");
                      ?>
                    </div>
                  </div>
                <!-- Fin Indicador Créditos del Día -->





                </div>
            <!-- FIN WIDGETS-->
              <?php
                  $consultaContable->listaMisFacturas($id, 1);
               ?>
              </div>

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
  <!-- TABLAS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<!-- exportador de formatos-->
<script src="<?php echo BASEPATH ?>js/dataTables.buttons.min.js"></script>
<script src="<?php echo BASEPATH ?>js/jszip.min.js"></script>
<script src="<?php echo BASEPATH ?>/js/buttons.html5.min.js"></script>
<script src="<?php echo BASEPATH ?>/js/buttons.print.min.js"></script>
<script>

  $('#todasLasFacturas').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            //'copy', 'csv', 'excel', 'pdf', 'print'
            'excel', 'print'
        ]
    });



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
