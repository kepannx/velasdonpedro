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
$datoBanco=mysql_fetch_array($consultaComun->sqlBanco($idBanco));

/*breadcrumb */
$paginaActual=misBancos;
$breadcrumb = array(0 => index, 1 => misBancos, 2=> $datoBanco['nombreBanco']);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
<!-- CSS PLUGIN sweet alert -->
    <link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
      <!-- CSS-->
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
        
        <div class="row" data-toggle="validator">
          <div class="col-md-12 white-box">
              <div class="col-md-12">
                <div class="col-md-6">
                  <h2><i class="fa fa-bank"></i> <?php echo $datoBanco['nombreBanco']; ?></h2>
                </div>
                <div class="col-md-6">

                 <h1 class="text-success" style="text-align: right">Saldo Actual: <?php echo number_format($datoBanco['saldo']); ?></h1>
                  <button class="btn btn-outline btn-default waves-effect waves-light col-md-12" data-toggle="modal" data-target="#registrarRegistroBancario"> <i class="fa fa-bookmark-o"></i> <span>¿Necesitas registrar una consignación,retiro o traslado?</span></button>
                  <input type="hidden" id="saldoActual" value="<?php echo $datoBanco['saldo'] ?>">
                </div>
              </div>

            

             <div class="panel-body">
               
             </div>



          <!-- DATOS DEL BANCO-->
          <div class="col-md-12">
            <section>
                  <div class="sttabs tabs-style-bar">
                    <nav>
                      <ul>
                        <li><a href="#informacionBanco" class="fa fa-info-circle"><span> Información Primaria Del Banco</span></a></li>

                        <li><a href="#productosRelacionados" class="fa fa-cubes"><span> Productos Relacionados</span></a></li>
                        <li><a href="#documentacion" class="fa fa-file-text-o"><span>Documentación</span></a></li>
                        <li><a href="#historialMovimientos" class="fa fa-book"><span> Historial de Movimientos</span></a></li>
                      </ul>
                    </nav>
                    <div class="content-wrap">
                      <section id="sinformacionBanco">
                        <h3> <i class="fa fa-info-circle"></i> Información del Banco</h3>
                      <!-- Datos del Banco-->
                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Cómo se llama el banco?:</label>
                          <input type="text" id="nombreBanco" class="form-control" value="<?php echo $datoBanco['nombreBanco']; ?>" placeholder="Nombre Del Banco">
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Número Cuenta</label>
                          <input type="text" id="nroCuenta" class="form-control" value="<?php echo $datoBanco['nroCuenta']; ?>"  placeholder="Número de la Cuenta">
                        </div>
                        
                        
                      </div>


                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Tipo de Cuenta</label>
                              <?php
                               $consultaComun->selectTiposCuenta($datoBanco['tipoCuenta']);

                              ?>
                        </div>



                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Cuenta Activada</label>

                          <?php
                               $consultaComun->selectCuentaActivada($datoBanco['activada']);
                              ?>
                          
                        </div>
    
                      <input type="hidden" id="idBanco" value="<?php echo $consultaComun->encrypt($datoBanco['idBanco'], publickey); ?>">
                        
                      </div>
                 
                    <div class="col-md-12">
                    <br>
                      <button type="button" id="editarBanco" class="btn btn-success col-md-12 waves-effect waves-light">Editar Banco</button>
                    </div>

                      <!-- Fin de los datos del banco-->




                      </section>


                      <section id="productosRelacionados">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <h2><i class="fa fa-cubes"></i> Productos Asociados a <?php echo $datoBanco['nombreBanco']; ?></h2>
                          </div>
                          <div class="col-md-6">
                            <button type="button" class="btn btn-success col-md-12" data-toggle="modal" data-target="#creacionProductoBancario">
                               <i class="fa fa-bank"></i> Quiero Crear Un Nuevo Producto Bancario
                            </button>
                          </div>
                        </div>

                         <?php
                            $consultaComun->listaProductosBancarios($datoBanco['idBanco']);
                         ?>
                      </section>


                      <section id="documentacion">
                        <h2> <i class="fa fa-file-text-o"></i>  Documentación</h2>

                      </section>
                      
                      <section id="historialMovimientos">
                          <h2><i class="fa fa-book"></i>
                          Historial de Movimientos</h2>
                           <?php
                            $consultaComun->listaMovimientosBancarios($datoBanco['idBanco']);
                          ?>
                      </section>
                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>

          </div>
          <!-- FIN DATOS DEL BANCO-->
      

         

         
        </div>
      
      <!-- Fin del cuerpo-->

      
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/contabilidad/guardarProductoBancario.php");
      require("../../data/comunes/modal/contabilidad/registrarRegistroBancario.php")
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
    


    <script src="<?php echo BASEPATH ?>js/validator.js"></script>
      <!-- sweer alerts-->
    <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo BASEPATH ?>js/cbpFWTabs.js"></script>
    <script src="<?php echo PATH ?>js/editar/editarBanco.js" type="text/javascript" charset="utf-8" async defer></script>

    <script src="<?php echo PATH ?>js/acciones/registroMovimientoBancario.js" type="text/javascript" charset="utf-8" async defer></script>

    <script src="<?php echo PATH ?>js/guardar/nuevoProductoBanco.js" type="text/javascript" charset="utf-8" async defer></script>

<!-- jQuery -->
<script src="<?php echo PATH ?>js/custom.js"></script>

<script>

  // Date Picker
      jQuery('.complex-colorpicker, #inventarioConvenioFecha').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
          autoclose: true,
          todayHighlight: true
        });    
  </script>

<script type="text/javascript">
      (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
     
</script>


  <?php 
//Links de librerias js 
require("../../data/comunes/js.php");

?>

</body>
</html>
