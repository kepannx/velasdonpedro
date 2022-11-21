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
$datosCaja=mysql_fetch_array($consultaComun->sqlCaja($historial));
/*breadcrumb */
$paginaActual=cajas;
$fechaApertura=explode(" ", $datosCaja['fechaAperturaCaja']);
$breadcrumb = array(0 => index, 1 => historialVentas, 2=> hojaHistorialVentas." ".$fechaApertura[0]);
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
            <h2><i class="fa fa-book"></i><?php echo hojaHistorialVentas. " ".$fechaApertura[0];  ?></h2>
             <div class="panel-body">Estos son los movimientos que se hicieron en este cierre ciclo de caja </div>

          <!-- Resultados Base-->
           
          <div class="col-md-12">
              <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="white-box text-center bg-success">
                  <h1 class="text-white counter"> <i class="fa fa-money"></i> $ <?php echo number_format($consultaComun->ventasLiquidadas($consultaComun->decrypt($historial, publickey))); ?></h1>
                  <p class="text-white">  Es el valor de los ingresos que habían registrados antes de cruzar con egresos y gastos en este cíclo de operación</p>
                </div>
              </div>




              <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="white-box text-center bg-red">
                  <h1 class="text-white counter"> <i class="fa fa-external-link-square"></i> $ <?php echo number_format($datosCaja['valorGastosEgresos']); ?></h1>
                  <p class="text-white">Es el valor de la suma de todos los egresos y gastos hechos en este ciclo de operación</p>
                </div>
              </div>
          </div>
    


        <div class="col-md-12">
         <?php $consultaComun->mensajeEstadoCaja($datosCaja['diferencia']) ?>
        </div>



          <!-- Fin de Resultados Base-->
          <!-- indicadores de las ventas  -->
          <div class="row">
       


        


        

        
      
      <!-- INDICADORES DE TIPO INGRESOS -->
      <div class="col-md-4 col-xs-12 col-sm-6" id="showmeefectivo">
          <div class="white-box text-center bg-purple">
            <h1 class="text-white counter">$ <?php echo number_format($datosCaja['valorEfectivo']-$datosCaja['valorBase']); ?></h1>
            <p class="text-white"> <i class="fa fa-money"></i> Ingreso En Efectivo</p>
          </div>
        </div>
        <div class="col-md-4 col-xs-12 col-sm-6" id="showmeTarjetasCredito">
          <div class="white-box text-center bg-info">
            <h1 class="text-white counter">$ <?php echo number_format($consultaContable->valorLiquidadosIngresosPorTarjetasCredito($datosCaja['idcaja'])); ?></h1>
            <p class="text-white"><i class="fa fa-credit-card-alt"></i> Ingreso por Tarjetas Crédito </p>
          </div>
        </div>
        <div class="col-md-4 col-xs-12 col-sm-6" id="showmeTarjetasDebito">
          <div class="white-box text-center">
            <h1 class="counter">$ <?php echo number_format($consultaContable->valorLiquidadosIngresosPorTarjetasDebito($datosCaja['idcaja'])); ?></h1>
            <p class="text-muted"><i class="fa fa-credit-card-alt"></i> Ingreso por Tarjetas Débito</p>
          </div>
        </div>
        <input type="hidden" id="idHistorial" value="<?php echo $historial; ?>">
        <input type="hidden" id="id" value="<?php echo $id; ?>">
      <!-- FIN DE LOS INDICADORES TIPO INGRESOS -->



        <div id="listadoFacturasFiltradas"></div>
        

      </div>
      
  


          <!-- fin de los indicadores de las ventas-->
          

          <div class="col-md-12" align="center">
            <h1>
               <hr>
              <i class="fa fa-exchange"></i> Registro de los movimientos de la caja</h1>
          </div>
          <div class="col-md-6 well">
              
        
            <h2><i class="fa fa-list"></i> Lista de movimientos en Ingresos</h2>
            <!-- Listado-->
            <p align="center">
                Los números de factura que esten en rojo indican que son abonos a esa factura
            </p>
            <div class="col-md-12">
              
              
              <?php $consultaComun->listaIngresosCerrados($consultaComun->decrypt($historial, publickey)); ?>
            </div>

            <div class="col-md-12">
              <h1 class="col-md-6">Ingresos: </h1>
              <h1 class="col-md-6 text-success" align="center">$ <?php echo number_format($consultaComun->ventasLiquidadas($consultaComun->decrypt($historial, publickey))); ?></h1>
            </div>
            <!-- Fin listado-->
          </div>
          <div class="col-md-6 well">
            <h2><i class="fa fa-list"></i> Lista de los egresos y gastos</h2>
            <!-- Listado-->
            <div class="col-md-12">
              <?php $consultaComun->listaEgresosCerrados($consultaComun->decrypt($historial, publickey)); ?>
            </div>

            <div class="col-md-12">
              <H3 class="col-md-6">EGRESOS Y GASTOS:</H3>
              <h1 class="col-md-6 text-danger" align="center">$ <?php echo number_format($datosCaja['valorGastosEgresos']); ?></h1>
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

  <script src="<?php echo PATH ?>js/acciones/min/cargarFacturasMetodosPago.min.js" type="text/javascript" charset="utf-8" async defer></script>

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
