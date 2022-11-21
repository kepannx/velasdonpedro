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
$breadcrumb = array(0 => contabilidad, 1 => facturasCuentascobro);
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

<!-- Datepicker-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Fin Datepicker -->

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
      <div class="row bg-title" id="noPrint">
        <?php 
          require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->
        
        <div class="row">
          <div class="col-md-12"> 
            <div class="white-box">
              <h3 id="noPrint">
                <i class="fa fa-list" ></i> 
                <?php echo facturasCuentascobro ?> 
              </h3>
                <svg class="hidden">
                  <defs>
                    <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
                  </defs>
                </svg>
                <section class="m-t-40">
                  <div class="sttabs tabs-style-shape">
                    <nav id="noPrint">
                      <ul>
                        <li>
                          <a href="#facturacion" id="pestanaFacturacion">
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <span> <i class="fa  fa-file-text-o"></i> Facturas</span>
                          </a>
                        </li>
                       
                        
                        
                        
                      </ul>
                    </nav>
                    <div class="content-wrap">
                      <!-- Inicio sección factura -->
                      <section id="facturacion">
                         <div id="noPrint">
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <h3> <i class="fa  fa-file-text-o"></i> Facturas</h3>
                            </div>
                            <div class="col-md-6">
                              <button type="button" class="btn btn-success col-md-12"  data-toggle="modal" data-target="#busquedaFactura"><i class="fa fa-search"></i>Búscame y filtrame resultados</button>
                            </div>
                          </div>
                        <p>
                        Encuentra todas las facturas que  se han hecho desde que empezaste a ingresar facturación en <?php echo nombreSoftware; ?> hasta la fecha
                      </p>

                      <div class="well">
                        <i class="fa fa-info-circle"></i>
                        En esta pestaña solo te mostraré las facturas de los últimos 30 días, si necesitas ver un listado mas grande solo has clic en el botón de "búscame y fíltrame resultados" y elige un rángo de fecha
                      </div>
                      <div class="col-md-12" style="padding-bottom: 20px;">
                          <button type="button" class="btn btn-success col-md-12" data-toggle="modal" data-target="#busquedaFacturaBloque" > <i class="fa fa-print"></i> Necesitas Imprimir Facturas en Bloque?</button>
                      </div>
                        
                        <input type="hidden" id="id" value="<?php echo $consultaComun->encrypt($datoUsuario['idusuario'], key) ?> ">

                           <div id="contenido">
                           </div>
                     </div>

                        <div id="listaFacturaBloques">
                        </div>
                      </section>
                      <!-- Fin sección facturas-->
                      <!-- Inicio sección cuenta de cobro -->
                    
                      <!-- Fin sección cuenta de cobro-->

                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>
            </div>
        </div>
        <!-- Fin del cuerpo-->
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/contabilidad/buscaryFiltrarFacturas.php");
      require("../../data/comunes/modal/contabilidad/buscaryFiltrarFacturasEnBloque.php");
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
<script src="<?php echo PATH ?>js/acciones/min/cargarFacturas.min.js" type="text/javascript" charset="utf-8" async defer></script>






<script src="<?php echo BASEPATH ?>js/cbpFWTabs.js"></script>
<script src="<?php echo PATH ?>js/custom.js"></script>
<!-- 
<script src="<?php echo PATH ?>js/acciones/resaurarAnularGastoEgreso.js" type="text/javascript" charset="utf-8" async defer></script> -->
<!-- TABLAS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>


<!-- rángos de fecha-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

 

<script type="text/javascript">
      (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();

      jQuery('#rangoFechaFactura').datepicker({
        toggleActive: true
      });

      jQuery('#rangoFechaFacturaBloque').datepicker({
        toggleActive: true
      });

      $(document).ready(function(){
      $('#tablaFacturacion').DataTable();
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


<script>
    
    
  </script>
</body>
</html>
