<?php 
require '../../data/libreria.lib/libreria.clases.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require '../../data/libreria.lib/70/libreria.class.php';
$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();
$consulta=new queryAjax();

if (is_numeric($consultaComun->decrypt($_SESSION['IDFACTURAPROVEDOR'], publickey))==NULL) {
  # verifico si es numerico el  codigo de el provedor...
  header('../../logOut.php');
}
 
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=provedor;
$breadcrumb = array(0 => provedor, 1=> perfilProvedor, 2=>facturaProvedor);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";
?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASEPATH ?>plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo BASEPATH ?>assets/node_modules/dropify/dist/css/dropify.min.css">

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
             <div class="col-md-6">
                <h2><i class="fa fa-fort-awesome"></i> <?php  echo facturaProvedor;?> <span id="nombreProvedor"></span></h2>
             </div>

             <div class="col-md-6" align="right">
                <div id="fechaPagoMaximo"></div>
             </div>
          </div>
          <!-- Formulario de Punto De Venta -->
      <div class="col-md-12">
          <div class="col-md-4  col-sm-12 col-xs-12">
             <i class="fa far fa-sticky-note"></i> Factura nro <span id="nroFacturaProvedor"></span>
          </div>
          <div class="col-md-4  col-sm-12 col-xs-12">
            <i class="fa far fa-calendar"></i> Fecha <span id="fechaFacturaProvedor"></span> 
          </div>
          <div class="col-md-4">
            <div class="col-md-7"> <i class="fa fa-bell"></i> Estado Factura</div>
            <div class="col-md-5" id="estadoFactura"></div>
          </div>
            <br>  


  <br>  

      </div>
    
  
  <hr>
  <h3> <i class="fa fa-list"></i> Productos Comprados</h3>
    <div class="col-md-8" id="listaProductosFacturaProvedores"></div>
    
  <!-- COLUMNA DERECHA-->
  <div class="col-md-4">

  <!-- DIGITALIZACIÓN DE LA FACTURA-->
    <div class="col-md-12 card">
      <h4 align="center"> <i class="fa fa-upload"></i> Digitalización de la factura física</h4>
        <div class="card-body">
          <input type="file" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
        </div>
    </div>


    <div class="col-md-12">
        <div id="serializacion"></div>

    </div>



  <!-- FIN DE LA DIGITALIZACIÓN DE LA FACTURA-->
  </div>
  <!-- FIN COLUMNA DERECHA-->
   

  <div class="col-md-12">

    <br>
          <div class="col-md-6">
            <div class="btn btn-success">
              <i class="fa fa-money"></i> Valor de la Factura<h1 id="valorTotalFactura"></h1>
            </div>
          </div>
          <div class="col-md-6">
            <div id="deudaFacturaProvedor"></div>
          </div>
      </div>


      </div>
          <!-- Fin Formulario de punto de venta -->
          

        </div>
    <!-- /.container-fluid -->

    <?php 
      require "../../data/comunes/footer.php" ;
    ?>
  </div>

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="<?php echo BASEPATH ?>js/validator.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="<?php echo PATH ?>js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo PATH ?>js/acciones/customPerfilPerfilFacturasProvedor.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
