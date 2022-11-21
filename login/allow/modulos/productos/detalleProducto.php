<?php 
require('../../data/libreria.lib/libreria.clases.php');//Clases normales basicas.
require('../../data/libreria.lib/productos/libreria.clases.php'); //Llamo las clases  para productos
require('../../data/libreria.lib/inventarios/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require '../../data/libreria.lib/70/libreria.class.php';
$consultaComun=new consultasComunes();
$consultaInventario=new consultaInventarios();
$consultaProducto = new consultaProductos();
$consultasQuery=new queryAjax();  
$objHtm=new objetosHtml();

$idProducto=$_SESSION['idProductoServicio'];
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador

//Los fetch para las consultas
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
$datosProductoServicio=mysql_fetch_array($consultaProducto->sqlProductos($_SESSION['idProductoServicio']));
/*breadcrumb */
$paginaActual=recetasyproductos;
$breadcrumb = array(0 => recetasyproductos, 1=> detalleProducto);
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
<link href="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

<!-- Pluging AutoCompletar-->
  <!-- CSS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">

<!-- FIN CSS PLUGIN switchery -->
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
    
      <div class="row white-box">
         <div class="col-md-12  col-sm-12 col-xs-12">

          <h3>
              <i class="fa fa-file"></i> Detalles de <?php echo $datosProductoServicio['nombreProductosServicios'] ; ?>
            </h3>
           <!--==============================================================
          =            TABLAS DE OPCIONES DE PERFIL DE PRODUCTO            =
          ===============================================================-->
          <section class="m-t-40">
                  <div class="sttabs tabs-style-flip">
                    <nav>
                      <ul>
                       
                        <li><a href="" class="sticon fa fa-arrows-h"><span>Movmientos</span></a></li>
                        <li><a href="" class="sticon fa fa-shopping-cart"><span>Movimientos De Compras</span></a></li>
                        <li><a href="" class="sticon fa fa-certificate"><span>Garantías</span></a>
                              
                        </li>
                        <li><a href="" class="sticon fa fa-file"><span>Datos Básicos</span></a></li>
                         
                      </ul>
                    </nav>
                    <div class="content-wrap">


                      
                      <!-- MOVIMIENTOS -->
                      
                      <section id="movimientosProducto">
                          

                          <!-- INICIO INDICADORES BÁSICOS -->
                          <div class="row">
                            <!-- EXISTENCIA GLOBAL -->
                              <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="white-box bg-white "  style="height: 170px;">
                                    <h4 align="center" class="txt-blanco">Existencia Global</h4>
                                    <div align="center" >
                                      <h1 ><?php echo $consultasQuery->getCantidadExistenciasProductoEnGlobal($validar->decrypt($idProducto, publickey)); ?> </h1>
                                     <h4 class="txt-blanco"> En Existencia</h4>
                                    </div>
                                </div>
                              </div>

                             
                              <!-- INDICADOR DE VALOR DE INVENTARIO -->                              
                              <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="white-box bg-theme-dark"  style="height: 170px">
                                    <h4 align="center" class="txt-blanco">Valor En Inventario</h4>
                                    <div align="center" class="txt-blanco">
                                      <h1 class="txt-blanco">$ <?php echo number_format($consultasQuery->costoTotalInventarioProducto($idProducto)); ?> </h1>
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                            <h3 align="center"> <i class="fa fa-list"></i> Existencia en Puntos de Venta</h3>
                              
                              <div id="existenciaPuntosVenta"></div>
                          </div>



                          <!-- FIN INDICADORES BASICOS -->
                            
                          <!-- Lista de las compras para ese producto -->
                          <!-- MOVIMIENTOS Y GRÁFICAS -->
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <h3> <i class="fa fa-shopping-cart"></i> Movimientos En Ventas</h3>
                              <div id="movimientoVentaProducto"></div>
                            </div>

                            <div class="col-md-6">
                              <h3> <i class="fa fa-bar-chart-o"></i>Gráficas Comparativas</h3>
                              <div id="graficaComportamientoVenta"></div>
                            </div>

                          </div>
                          <!-- FIN MOVIMIENTOS Y GRÁFICAS -->

                      </section>
                    <!-- FIN DE MOVIMIENTOS -->

                    <!-- MOVIMIENTOS DE COMPRAS -->
                    
                    <section id="movimientosCompras">
                      <div class="col-md-12">
                           <div id="listaComprasProducto"></div>
                      </div>
                      <div align="center">
                        Lista de todas las compras registradas que se han hecho de este producto a los provedores
                      </div>

                    </section>
                    <!-- FIN DE MOVIMIENTOS DE COMPRAS -->
                    

                      
                    <!-- Garantías -->
                    <section id="Garantías">
                         <div class="col-md-12">
                           <div class="col-md-6">
                             <h3><i class="fa fa-certificate"></i> Garantías</h3>

                           </div>
                           <div class="col-md-6"></div>
                         </div>
                        
                         <div class="col-md12">
                          <div id="listaGarantias"></div>
                         </div>
                    </section>
                    <!-- Garantías -->


                    <section id="datosBasico">
                        <div class="col-md-12">
                          <h2>
                            <i class="fa fa-file"></i> Datos Básicos del Producto/Servicio</h2>
                              <form action="#" class="form-horizontal" data-toggle="validator" name="formObj">
                                <?php
                                  require '../../data/comunes/formularios/productos/informacionBaseProducto.php';
                                ?>
                              </form>

                         </div>

                         <div class="col-md-12" align="center">
                                  <button type="submit" class="btn btn-success" id="editarDatosProductoServicio" ><i class="fa fa-edit"></i> Editame Este Item</button>
                               </div>


                    </section>
                                       
                      <br>
                      </section>
                      <!-- DATOS BASICOS -->
                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>
          <!--====  End of TABLAS DE OPCIONES DE PERFIL DE PRODUCTO  ====-->
        </div>
      </div>
   
      <!-- Fin del cuerpo-->
   
    </div>
    <!-- /.container-fluid -->

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

<!-- JS PLUGINGS-->
  <script src="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>

 
  
  <!-- sweer alerts-->


  <script src="<?php echo BASEPATH ?>js/cbpFWTabs.js"></script>
  <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

  <script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>



<script src="<?php echo BASEPATH ?>js/validator.js"></script>
<script src="<?php echo PATH ?>js/custom.js"></script>
<script src="<?php echo PATH ?>js/customProductosServicios.js"></script>
<script src="<?php echo PATH ?>js/editar/editarServicioProducto.js" type="text/javascript" charset="utf-8" async defer></script>



  <!--FIN PLUGIN TABLAS -->
  

  <!-- FIN PLUGIN JS-->
<script>

</script>

</body>
</html>
