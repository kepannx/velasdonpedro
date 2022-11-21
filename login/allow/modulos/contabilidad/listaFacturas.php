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
$fechaConsulta=$consultaComun->decrypt($fecha, publickey);
/*breadcrumb */
$paginaActual=contabilidad;
$breadcrumb = array(0 => index, 1 => reporteVentas);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
<!-- Page plugins css -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<!-- Color picker plugins css -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
          <div class="col-md-12 white-box"> 
            <div class="white-box">
              
                <div class="col-md-12"><h3><i class="fa fa-list"></i><?php echo reporteVentas ?> del Día <?php echo $fechaConsulta ?></h3></div>
                
 
                  
                  
            
              <div id="listaFacturas"></div>

            
               
          </div>
        </div>
      <!-- Fin del cuerpo-->
    </div>
    <!-- /.container-fluid -->
      <input type="hidden" id="id" value="<?php echo $id; ?>">
      <input type="hidden" id="fecha" value="<?php echo $fecha; ?>" >
    <?php 
      require("../../data/comunes/footer.php");
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

<script src="<?php echo PATH ?>js/acciones/listaFacturaDia.js" type="text/javascript" charset="utf-8" async defer></script>


<script>
    $(document).ready(function(){


      $('#tablaRelacionFacturas').DataTable();
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
