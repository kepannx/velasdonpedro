<?php 
session_start();
require '../../data/libreria.lib/libreria.clases.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require('../../data/libreria.lib/70/libreria.class.php');

$consultaComun=new consultasComunes();
$consulta=new queryAjax();
$idUsuario=$_SESSION['IDEMPLEADO'];
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
$datosUser=mysql_fetch_array($consultaComun->sqlConvenioAdmin($consultaComun->encrypt($consultaComun->decrypt($idUsuario, publickey),key)));
$datoProvedor=mysql_fetch_array($consultaComun->sqlProvedor($idprovedor));
/*breadcrumb */
$paginaActual=usuarios;
$breadcrumb = array(0 => usuarios, 1=> perfilUsuario);
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

<!-- CSS PLUGIN TABLAS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- FIN CSS PLUGIN SWEET ALERT -->

<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

<link href="<?php echo BASEPATH; ?>assets/node_modules/datatables/media/css/dataTables.bootstrap4.css" rel="stylesheet">

<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Pluging AutoCompletar-->
  <!-- CSS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
  <!-- FIN CSS-->

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

      <!--INICIO PESTAÑAS-->

      <div class="col-md-12">
             <h2>
               <i class="fa fa-user"></i>
               Perfíl de <?php echo $datosUser['nombre']; ?>
             </h2>
           </div>


      <section>
                  <div class="sttabs tabs-style-bar">
                    <nav>
                      <ul>
                        <li><a href="#informacionBasica" class="fa fa-info-circle"><span> Información Básica</span></a></li>

                        <li><a href="#informes" class="fa fa-cubes"><span>Comisiones</span></a></li>
                        <li><a href="#documentacion" class="fa fa-file-text-o"><span>Documentación</span></a></li>
                        <li><a href="#nominaLiquidacion" class="fa fa-book"><span>Liquidación y Nomina</span></a></li>
                      </ul>
                    </nav>
                    <div class="content-wrap">

                      <!-- INFORMACION DEL USUARIO -->
                      <section id="informacionBasica">
                        <h3> <i class="fa fa-info-circle"></i>Información del Usuario</h3>
                      <!-- Datos del Del Usuario-->
                        <?php
                          require("../../data/comunes/formularios/usuarios/datosUsuario.php");
                        ?>
                        

                      </section>
                      <!-- FIN DE DATOS USUARIO-->
                      
                      <!--INFORME DE COMISIONES -->
                      <section id="informes">
                        <div class="col-md-12">
                          <div class="col-md-6">
                              <h2><i class="fa fa-cubes"></i>Informes de Rendimiento Y Comisiones</h2>
                          </div>
                          <div class="col-md-6">
                            <!-- RANGO DE FECHA DE COMISIÓN-->
                              <div class="example">
                                <h5 class="box-title m-t-30">Selecciona el Rango De Fechas Que Quieres Filtrar</h5>
                                <input class="form-control input-daterange-datepicker" type="text" id="rangoFacturas" value="<?php echo date('m/d/Y'); ?> - <?php echo date('m/d/Y'); ?>" readonly/>
                              </div>
                            <!-- FIN DEL RANGO DE LA FECHA DE COMISIÓN-->
                          </div>
                            <!-- LISTA DE LAS COMISIONES-->
                            <div id="listaHistoricoFacturas"></div>

                            <!-- -->

                        </div>
                      </section>
                      <!-- FIN DEL INFORME DE COMISIONES-->


                      <section id="documentacion">
                        <h2> <i class="fa fa-file-text-o"></i>  Documentación</h2>

                      </section>
                      
                      <section id="nominaLiquidacion">
                          <h2><i class="fa fa-book"></i>
                          Listado de Liquidación de Nómina</h2>
                           
                      </section>
                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>





      <!-- FIN PESTAÑAS-->





        
        <input type="hidden" id="idUsuario" value="<?php echo $consultaComun->encrypt($datosUser['idusuario'], publickey); ?>">
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

<script src="<?php echo PATH ?>js/editar/editarUsuario.js" type="text/javascript" charset="utf-8" async defer></script>



<!-- PLUGINGS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/moment/moment.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="<?php echo BASEPATH; ?>js/cbpFWTabs.js"></script>

<script src="<?php echo BASEPATH ?>assets/node_modules/datatables/datatables.min.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>



<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script src="<?php echo PATH; ?>js/acciones/customPerfilUsuario.js"></script>





  <!-- JQUERYS --> 
  <script>


  </script>
  <!-- FIN JQUERY-->

   
<!-- FIN PLUGINS-->

</body>
</html>
