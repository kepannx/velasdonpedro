<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
extract($_REQUEST);
$consultaComun=new queryComun();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$paginaActual=contabilidad;
$breadcrumb = array(0 => contabilidad, 1=> tusFacturas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";
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
      
      <!-- BODY -->
      <div class="row white-box">

      <!-- -->
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="col-md-5">
              <label class="col-md-4 control-label">Nombres</label>
                <div class="col-md-8" id="nombreCliente"></div>
            </div>

            <div class="col-md-4">
              <label class="col-md-6 control-label">Identificación</label>
                <div class="col-md-6" id="identificacionCliente"></div>
            </div>


            <div class="col-md-2">
              <label class="col-md-10 control-label">Nro de Factura</label>
                <div class="col-md-2" id="nroFactura"></div>
            </div>

        </div>

<br><br>
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="col-md-6">
              <label class="col-md-4 control-label">Dirección</label>
                <div class="col-md-8" id="direccionCliente"></div>
            </div>

            <div class="col-md-3">
              <label class="col-md-4 control-label">Ciudad</label>
                <div class="col-md-8" id="ciudadCliente"></div>
            </div>


            <div class="col-md-3">
              <label class="col-md-5 control-label">Teléfonos</label>
                <div class="col-md-2" id="telefonosCliente"></div>
            </div>
        </div>

<br><br>
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="col-md-3">
              <label class="col-md-2 control-label">Email</label>
                <div class="col-md-10" id="emailCliente">#direccionEmail</div>
            </div>

            <div class="col-md-3">
              <label class="col-md-4 control-label">Fecha Facturación</label>
                <div class="col-md-8" id="fechaFactura"></div>
            </div>


            <div class="col-md-3">
              <label class="col-md-5 control-label">Estado</label>
                <div class="col-md-2" id="estadoFactura"></div>
            </div>


            <div class="col-md-3">
              <label class="col-md-5 control-label">Vendedor</label>
                <div class="col-md-2" id="vendedor"></div>
            </div>
        </div>


        <br><br>
      
      <!-- LISTADO DE PRODUCTOS FACTURADOS -->
      <div class="col-md-12">
        <h3><i class="fa fa-list"></i> Productos Facturados</h3>
        <div id="listaProductosFacturados"></div>
      </div>
      <!-- FIN DEL LISTADO DE PRODUCTOS FACTURADOS-->
      <!-- TOTALES-->


      <div class="col-md-12">
        <div class="col-md-6">
          <div id="abonos"></div>
        </div>
        <div class="col-md-6 row sales-report">
          <div class="col-md-6">
            <h2 class="text-left">Deuda</h2>
            <h1 class="text-left text-danger m-t-20" id="deuda"></h1>
          </div>


           <div class="col-md-6">
            <h2 class="text-left">Valor Factura</h2>
            <h1 class="text-left text-success m-t-20" id="total"></h1>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12" id="tipoPago"></div>
        
      </div>
      <!-- FIN DE TOTALES-->
      

      <!-- BOTONES DE ACCIÓN -->
      <div class="col-md-12">
        <div class="col-md-6" align="center">
           
        </div>
        <div class="col-md-6" align="center">
          <button type="button" class="btn btn-success" id="imprimir" > <i class="fa fa-print"></i>IMPRIMIR FACTURA
            </button>
        </div>
        <input type="hidden" id="idFactura" value="<?php echo $idFactura; ?>">
      </div>
      <!-- FIN DE LOS BOTONES DE ACCIÓN-->
      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
       require "../../data/comunes/footer.php";
       require '../../../login/allow/data/comunes/modal/contabilidad/justificacionAnulacion.php';
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<script src="<?php echo PATH ?>/js/acciones/customFacturas.js"></script>

<!-- JS PLUGINGS-->
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>