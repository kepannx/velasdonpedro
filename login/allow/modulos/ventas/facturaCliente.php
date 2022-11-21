<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/facturacion/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
$consultaComun=new consultasComunes();
$consultaFacturas=new consultaProductos();
$facturero=new ingresoFacturas();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
$datoFactura=mysql_fetch_array($consultaComun->sqlFactura($idFactura));
$datoCliente=mysql_fetch_array($consultaComun->sqlCliente($consultaComun->encrypt($datoFactura['idCliente'], publickey)));
/*breadcrumb */
$paginaActual=facturaCliente;
$breadcrumb = array(0 => facturaCliente, 1 => facturaCliente." Nro ".$datoFactura["nroFactura"]);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
  <!-- CSS PLUGIN sweet alert -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Preloader -->
<div class="preloader" id="noPrint">
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
  <div id="page-wrapper" >
    <div class="container-fluid">
    <!-- breadcrumb -->
      <div class="row bg-title" id="noPrint">
        <?php 
          require("../../data/comunes/breadcrumb.php");
        ?>
      </div>
      <!-- Fin breadcrumb -->
      <!--Inicio del cuerpo  -->
        <div class="row" id="noPrint">
          <div class="col-md-12">
            <div class="white-box">
              <div class="table-responsive">
                <div class="col-md-12">
                  <div class="col-md-5">
                     <label class="col-md-4 control-label">Nombres</label>
                     <div class="col-md-8">
                       <?php
                            echo $consultaComun->consultaDatosCliente($datoFactura["idCliente"], "nombreCliente");
                       ?>
                       <input type="hidden" id="idFactura" value="<?php echo $consultaComun->encrypt($datoFactura["idFactura"], publickey); ?>">
                     </div>
                       
                  </div>


                  <div class="col-md-3">
                     <label class="col-md-6 control-label">Identificación</label>
                     <div class="col-md-6">
                       <?php
                            echo $consultaComun->consultaDatosCliente($datoFactura["idCliente"], "identificacionCliente");
                       ?>
                     </div>
                       
                  </div>

                  <?php
                  if ($datoFactura['nroFactura']!==NULL) {
                      ?>
                <!-- nro Factura -->
                <div class="col-md-4">
                    <label class="col-md-8 control-label">Nro Factura<span class="text-danger">*</span></label>
                     <div class="col-md-4">
                       <?php
                            echo $datoFactura["nroFactura"];
                       ?>
                     </div>
                  </div>
                <!-- Fin nro factura-->
                      <?php
                    }else{
                      ?>
                <!-- nro cotización -->
                <div class="col-md-4">
                    <label class="col-md-8 control-label">Nro Cuenta de Cobro<span class="text-danger">*</span></label>
                     <div class="col-md-4">
                       <?php
                            echo 'C-'.$datoFactura["nroCotizacion"];
                       ?>

                     </div>
                  </div>
                <!-- Fin nro cotización-->


                      <?php 
                    }


                  ?>

                  




                </div>

                 <br><br>
                  <!-- Segunda  fila-->
                <div class="col-md-12">
                  <div class="col-md-6">
                     <label class="col-md-4 control-label">Dirección</label>
                     <div class="col-md-8">
                       <?php
                             echo $consultaComun->consultaDatosCliente($datoFactura["idCliente"], "direccionCliente");
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-3">
                     <label class="col-md-4 control-label">Ciudad</label>
                     <div class="col-md-8">
                       <?php
                             echo $consultaComun->consultaDatosCliente($datoFactura["idCliente"], "ciudadCliente");
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-3">
                     <label class="col-md-4 control-label">Teléfonos</label>
                     <div class="col-md-8">
                       <?php
                             echo $consultaComun->consultaDatosCliente($datoFactura["idCliente"], "telefonosCliente");
                       ?>
                     </div>
                       
                  </div>

                </div>



                <br><br>
                  <!-- Tercera  fila-->
                <div class="col-md-12">
                  <div class="col-md-5">
                     <label class="col-md-4 control-label">Email</label>
                     <div class="col-md-8">
                       <?php
                             echo $consultaComun->consultaDatosCliente($datoFactura["idCliente"], "emailCliente");
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-4">
                    <label class="col-md-4 control-label">Día Factura</label>
                     <div class="col-md-8">
                       <?php
                             $fecha=explode(" ",$datoFactura["fechaFactura"]);
                             echo $fecha[0];
                       ?>
                     </div>
                  </div>


                  <div class="col-md-2">
                    <label class="col-md-5 control-label">Estado<span class="text-danger">*</span></label>
                     <div class="col-md-7">
                       <?php
                            echo $consultaComun->estadoCuentaCss($datoFactura["estadoFactura"]);
                       ?>
                     </div>
                  </div>

                </div>
                  


                 

                <br><br>
                  <!-- Cuarta  fila-->
                <div class="col-md-12">
                  <div class="col-md-4">
                     <label class="col-md-4 control-label">Tipo Pago</label>
                     <div class="col-md-8">
                       <?php
                             echo $datoFactura["tipoPago"];
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-5">
                    <label class="col-md-5 control-label">Código Vendedor</label>
                     <div class="col-md-6">
                       <?php
                            
                             echo $datoFactura["codigoVendedor"];
                       ?>
                     </div>
                  </div>


                </div>



                
                  
                <!-- mensaje de anulación factura -->
                <?php
                    if ($datoFactura["estadoFactura"]==='anulada') {
                      # code...

                ?>
                <div class="col-md-12 well" align="center">
                  <h3 class="text-danger"><i class="fa fa-bell"></i>ANULADA</h3>
                  <P><?php  echo $datoFactura["justificacionAnulacion"]; ?></P>
                </div>
                <?php }?>

                <!-- Mensaje de anulación factura-->
                  
                  <!-- fin del cabezote-->

                  <?php
                   if($datoFactura["estadoFactura"]=='en credito'){
                       $consultaComun->botonAbonoPazYSalvo($datoCliente["idcliente"], $datoCliente["nombreCliente"], 2);
                    }
                    echo '<div class="col-md-12">';
                    require("../../data/comunes/listas/ventas/productoFacturado.php");
                     echo '<div>';
                   if ($datoFactura["estadoFactura"]=='pagada' || $datoFactura["estadoFactura"]=='en credito') {
                      # Anular...
                    echo '<div class="col-md-6" align="center">
                            <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#justificacionAnulacion">
                              <i class="fa fa-warning"></i>ANULAR
                            </button>
                          </div>';
                    //Imprimir
                    echo '<div class="col-md-6" align="center">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#imprimirFactura"><i class="fa fa-print"></i>Imprimir Factura</button>
                          </div>';

                    }
                    else{
                       echo '<div class="col-md-12" align="center">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#imprimirFactura"><i class="fa fa-print"></i>Imprimir Factura</button>
                          </div>';
                    }
                  ?>
              </div>
            </div>


          </div>
        </div>
      <!-- Fin del cuerpo-->
    </div>
    <!-- /.container-fluid -->
  
    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/asociados/abonoCredito.php");
      require("../../data/comunes/modal/contabilidad/justificacionAnulacion.php");
      require("../../data/comunes/modal/contabilidad/facturaCliente.php");
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- -->

<!-- -->
<!-- jQuery -->
<?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>
<script src="<?php echo PATH ?>js/guardar/guardarAbono.js" type="text/javascript" charset="utf-8" async defer></script>

<script src="<?php echo PATH ?>js/acciones/anularFactura.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
 
<?php 
 ?>

</body>
</html>
