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
$paginaActual=cajas;
$breadcrumb = array(0 => index, 1 => aperturaYCierreCaja);
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
    <link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
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
            <h2><i class="fa fa-key"></i> Cierre de Caja</h2>
             <div class="panel-body">Estas a punto de cerrar la caja, no olvides revisar todos los recibos de los gastos, los comprobantes de banco y cualquier documento que represente un ingreso o egreso </div>


            <div class="col-md-6">
                <label>¿Cuánto tienes en Efectivo?</label>
                          <div class="input-group col-md-12 col-xs-10">
                            <div class="input-group-addon"><i class="ti-money"></i></div>
                              <input type="text" id="valorEnEfectivo" class="form-control" id="exampleInputuname"  onkeyup="format(this)" onchange="format(this)" placeholder="¿Cuánto tienes en efectivo en la caja?" required >
                          </div>
            </div>

            <div class="col-md-6">
                <label>¿Cuánto tienes en Recibos?</label>
                <div class="input-group col-md-12 col-xs-10">
                <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                <input type="text" id="valorEnDocumentos" class="form-control" id="exampleInputuname"  onkeyup="format(this)" onchange="format(this)" placeholder="Suma la cantidad de recibos o cheques que tienes en caja" required >
                          </div>
                
          </div>
         

          <div class="col-md-12 " align="center">
             <h2 class="text-success"> <i class="fa fa-check-circle"></i> Deberías Tener En Total: $ <?php echo number_format($consultaComun->ventasSinLiquidar()-$consultaContable->valorEgresosSinLiquidar(1)+$consultaContable->consultaDatosCaja('valorBase'))?></h2>
             <input type="hidden" id="totalEnSistema" value="<?php echo $consultaComun->ventasHoy()-$consultaContable->valorEgresosSinLiquidar(1)+$consultaContable->consultaDatosCaja('valorBase'); ?>">
             <input type="hidden" id="idCierreCaja" value='<?php echo $consultaContable->consultaDatosCaja('idcaja')  ?>'>
             <input type="hidden" id="valorGastosEgresos" value="<?php echo $consultaContable->valorEgresosSinLiquidar(1) ?>">
          </div>

          <div class="col-md-12">
            <button type="button" class="btn btn-success col-md-12" id="guardarDato"> <i class="ti-lock"></i> Quiero Cerrar La Caja!</button>
          </div>
          <div class="col-md-12" align="center">
            <h1>
               <hr>
              <i class="fa fa-exchange"></i> Registro de los movimientos de la caja</h1>
          </div>
          <div class="col-md-6">
            <h2><i class="fa fa-list"></i> Lista de movimientos en Ingresos</h2>
            <!-- Listado-->
            <div class="col-md-12">
              <?php $consultaComun->listaIngresosSinCerrar(); ?>
            </div>

            <div class="col-md-12">
              <h1 class="col-md-6">Ingresos: </h1>
              <h1 class="col-md-6 text-success" align="center">$ <?php echo number_format($consultaComun->ventasSinLiquidar()); ?></h1>
            </div>
            <!-- Fin listado-->
          </div>
          <div class="col-md-6">
            <h2><i class="fa fa-list"></i> Lista de los egresos y gastos</h2>
            <!-- Listado-->
            <div class="col-md-12">
              <?php $consultaComun->listaEgresosSinCerrar(); ?>
            </div>

            <div class="col-md-12">
              <H3 class="col-md-6">EGRESOS Y GASTOS:</H3>
              <h1 class="col-md-6 text-danger" align="center">$ <?php echo number_format($consultaContable->valorEgresosSinLiquidar(1)); ?></h1>
            </div>
            <!-- Fin listado-->
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
    <script src="<?php echo PATH ?>js/guardar/cerrarCaja.js" type="text/javascript" charset="utf-8" async defer></script>

    <script src="<?php echo BASEPATH ?>js/validator.js"></script>
      <!-- sweer alerts-->
    <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    
<!-- jQuery -->
<script src="<?php echo PATH ?>js/custom.js"></script>
<?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>

</body>
</html>
