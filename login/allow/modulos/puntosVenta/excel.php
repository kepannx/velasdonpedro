<?php 
session_start();
require '../../data/libreria.lib/libreria.clases.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require('../../data/libreria.lib/70/libreria.class.php');

$consultaComun=new consultasComunes();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
/*breadcrumb */
//$_SESSION['idPV']=$idPunto;
$paginaActual=index;
$breadcrumb = array(0 => index );
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once '../../data/comunes/headercode.php' ;
?>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require "../../data/comunes/headerMenu.php";
  ?>
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH; ?>assets/node_modules/datatables/media/css/dataTables.bootstrap4.css" rel="stylesheet">

<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="<?php echo BASEPATH ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  <!-- Menu Lateral Izquierdo-->
  <?php 
    require "../../data/comunes/menuLateral.php";
  ?>
  <!-- Fin Menu Lateral Izquierdo-->



  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">      
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
          require "../../data/comunes/breadcrumb.php";


        ?>
      </div>
      <!-- Fin breadcrumb -->
    
      <!--Inicio del cuerpo  -->
        <div class="row white-box"> 
          <div class="col-md-12">
            <div class="col-md-12">
              <h2> <i class="fa fa-list"></i>Perfil Punto de Venta <spam id="nombrePuntoVenta"></spam></h2>
            </div>

                  <!-- Tabstyle start -->
                <hr> 
                <section class="m-t-40">
                  <div class="sttabs tabs-style-linemove">
                    <nav>
                      <ul>
                        <li><a href="#tabMovimientosDia" class="fa fa-arrows"><span>Movimientos Día</span></a></li>
                        

                        <li><a href="#tabEstadoMercancia"  id="tbLista"class="sticon ti-gift"><span>Estado Mercancía</span></a></li>
                        
                        <li><a href="#tabCuentasPorCobrar" class="fa fa-warning"><span>CxC</span></a></li>
                        <li><a href="#tabMovimientosDia" class="fa fa-list" id="listaFacturas"><span>Lista Facturas</span></a></li>

                        <li><a href="#tabDocumentacion" class="fa fa-arrows"><span>Tralsados de Mercancía</span></a></li>
                        <li><a href="#tabSettings" class="sticon ti-settings"><span>Settings</span></a></li>
                      </ul>
                    </nav>


                    <div class="content-wrap text-center">
                      <!--MOVIMIENTOS DEL DÍA -->
                      <section id="tabMovimientosDia">
                        <div class="col-md-12">
                          <div class="col-md-4">
                            <h3> <i class="fa  fa-book"></i><?php echo movimientoDia; ?></h3>
                          </div>
                          <div class="col-md-8">

                              <div class="col-md-6">
                                <h4>Estas Viendo El Cierre Del :</h4>
                              </div>
                              <div class="col-md-6">
                                  <div class="input-group">
                                    <input type="text" class="form-control fechaFiltro" id="fechas" placeholder="mm/dd/yyyy" value="<?php echo date('m/d/Y'); ?>" readonly="">
                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                  </div>
                              </div>
                              
                          </div>
                            
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <h4 align="center"><i class="fa fa-check-circle"></i> Facturación </h4>
                            <div id="listaFacturasDia"></div>
                          </div>
                          
                          <!-- EGRESOS Y GASTOS-->
                          <div class="col-xs-12 col-sm-12 col-md-6">
                             <h4 align="center"><i class="ti-ticket"></i> Egresos y Gastos </h4> 
                             <div id="listaGastosDia"></div>
                          </div>
                          <!-- FIN DE LOS EGRESOS Y LOS GASTOS-->
                    
                          <!--TOTALES -->
                          <div class="col-md-12" style="margin-top: 20px;">
                            <h1 class="text text-success" align="center">Consolidado</h1>
                            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-success">
                              <h5>Total en Efectivo</h5>
                              <h2><i class="fa fa-money"></i><div id="totalEfectivo"></div> </h2>
                            </div>

                            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-info" data-toggle="modal" data-target="#movimientosTransacciones" id="movimientosDeTransacciones">
                              <h5>Total en Transacciones</h5>
                              <h2><i class="fa fa-bank"></i><div id="totalTransacciones"></div> </h2>
                            </div>

                            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-danger" >
                              <h5>Total en Egresos</h5>
                              <h2><i class="fa fa-bank"></i><div id="totalEgresos"></div> </h2>
                            </div>




                            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-warning">
                              <h5>Cuentas por Cobrar</h5>
                                  
                              <h2><i class="ti-wallet"></i><div id="cxc"></div></h2>
                            </div>
                           
                            <div class="col-xs-12 col-sm-12 col-md-12 btn btn-default">
                              
                               <h5>Gran Total</h5>
                              <h2><i class="fa fa-star"></i><div id="granTotal"></div></h2>
                            </div>

                      </section>
                      <!-- FIN DE LOS MOVIMIENTOS DEL DÍA-->

                      <!-- ESTADO DE LA MERCANCÍA-->
                      <section id="tabEstadoMercancia">
                        <h2>Estado de Mercancía</h2>
                        <div id="listadoMercanciaPunto"></div>
                      </section>
                      <!-- FIN DEL ESTADO DE LA MERCANCÍA-->

                      <!-- CUENTAS POR COBRAR-->
                      <section id="tabCuentasPorCobrar">
                        <h2>Cuentas por Cobrar</h2>
                        <div id="listaCuentasPorCobrar"></div>
                      </section>
                      <!-- FIN DE LAS CUENTAS POR COBRAR -->


                       <!-- HISTORICO FACTURAS-->
                      <section id="tabHistorico">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <h2 class="box-title m-t-30"> <i class="fa fa-list"></i> Historia de Facturación</h2>
                          </div>
                          <div class="col-md-6">
                              <div class="example">
                                <h5 class="box-title m-t-30">Selecciona el Rango De Fechas Que Quieres Filtrar</h5>
                                <input class="form-control input-daterange-datepicker" type="text" id="rangoFacturas" value="<?php echo date('m/d/Y'); ?> - <?php echo date('m/d/Y'); ?>" readonly/>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div id="listaHistoricoFacturas"></div>
                        </div>
                      </section>
                      <!-- FIN HISTORICO FACTURAS -->
                      

                      <!-- DOCUMENTACIÓN-->
                      <section id="tabDocumentacion">

                        <div class="col-md-6">
                          <h2> <i class="fa fa-arrows"></i> Historial de Traslados de Mercancía</h2>
                        </div>
                        <div class="col-md-6">
                            <div class="example">
                              <h5 class="box-title m-t-30">Selecciona el Rango De Fechas Que Quieres Filtrar</h5>
                              <input class="form-control input-daterange-datepicker" type="text" id="rangoFechaTraslados" value="<?php echo date('m/d/Y'); ?> - <?php echo date('m/d/Y'); ?>" readonly/>
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div id="listaHistoricoTraslados"></div>
                        </div>

                      </section>
                      <!-- FIN DE LA DOCUMENTACIÓN-->
                      

                      <!--CONFIGURACIÓN -->
                      <section id="tabSettings">
                        <h2>Configuración</h2>
                      </section>
                      <!-- FIN DE LA CONFIGURACIÓN-->


                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>
                  </div>
        </div>
      <!-- FIN DEL CUERPO -->
    <?php 
      require "../../data/comunes/footer.php" ;
      require '../../data/comunes/modal/contabilidad/registroMovimientosTransaccionales.html';
    ?>
  </div>
</div>
<!-- /#wrapper -->
<!-- jQuery -->




<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>


<script src="<?php echo BASEPATH ?>plugins/bower_components/moment/moment.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASEPATH; ?>js/cbpFWTabs.js"></script>
<script src="<?php echo BASEPATH ?>assets/node_modules/datatables/datatables.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="<?php echo PATH; ?>js/acciones/customPerfilVenta.js"></script>

<script>

</script>
</body>
</html>
