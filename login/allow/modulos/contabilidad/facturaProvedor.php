<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/facturacion/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);

$consultaComun=new consultasComunes();
$consultaFacturas=new consultaProductos();
//$ingresarFactura=new ingresoFacturas();

//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
$datoFactura=mysql_fetch_array($consultaComun->sqlFacturaProvedor($idFactura));
$datoProvedor=mysql_fetch_array($consultaComun->sqlProvedor($consultaComun->encrypt($datoFactura['idProvedor'], publickey)));
/*breadcrumb */
$paginaActual=facturaProvedor;
$breadcrumb = array(0 => facturaProvedor, 1 => facturaCliente." Nro ".$datoFactura["nroFacturaProvedor"]);
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
        
        <div class="row">
          <div class="col-md-12">
            <div class="white-box">

              <h2>
                <h2>
                    <i class="icon-notebook"></i>
                    Factura De Compra A Provedor
                  </h2>
              </h2>


              <div class="table-responsive">

                <div class="col-md-12">
                  

                  <div class="col-md-6">
                     <label class="col-sm-4 control-label">Nombres</label>
                     <div class="col-md-8">
                       <?php
                            echo $datoProvedor["nombreProvedor"];
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-4">
                     <label class="col-sm-4 control-label">Identificación</label>
                     <div class="col-md-8">
                       <?php
                           echo $datoProvedor["ideProvedor"];
                       ?>
                     </div>
                       
                  </div>

                  

                  <div class="col-md-2">
                    <label class="col-sm-9 control-label">Nro Factura<span class="text-danger">*</span></label>
                     <div class="col-md-3">
                       <?php
                            echo $datoFactura["nroFacturaProvedor"];
                       ?>
    
                     </div>
                  </div>
                </div>

                 <br><br>
                  <!-- Segunda  fila-->
                <div class="col-md-12">
                  <div class="col-md-6">
                     <label class="col-sm-4 control-label">Dirección</label>
                     <div class="col-md-8">
                       <?php
                            echo $datoProvedor["direccionProvedor"];
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-3">
                     <label class="col-sm-4 control-label">Ciudad</label>
                     <div class="col-md-8">
                       <?php
                            echo $datoProvedor["ciudadProvedor"];
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-3">
                     <label class="col-sm-4 control-label">Teléfonos</label>
                     <div class="col-md-8">
                       <?php
                            echo $datoProvedor["telefonoProvedor"];
                       ?>
                     </div>
                       
                  </div>

                </div>



                <br><br>
                  <!-- Tercera  fila-->
                <div class="col-md-12">
                  <div class="col-md-5">
                     <label class="col-sm-4 control-label">Email</label>
                     <div class="col-md-8">
                       <?php
                             echo $datoProvedor["emailProvedor"];
                       ?>
                     </div>
                       
                  </div>


                  <div class="col-md-4">
                    <label class="col-sm-4 control-label">Día Factura</label>
                     <div class="col-md-8">
                       <?php
                           echo $datoFactura["fechaFacturaProvedor"]
                       ?>
                     </div>
                  </div>


                  <div class="col-md-2">
                    <label class="col-sm-5 control-label">Estado<span class="text-danger">*</span></label>
                     <div class="col-md-7">
                       <?php
                            echo $datoFactura["estadoFactura"];
                       ?>
                     </div>
                  </div>

                </div>


                <br><br>
          


                  
                  <!-- fin del cabezote-->

                  <?php
                   if($datoFactura["estadoFactura"]=='credito'){
                    echo  '<button type="button" id="noPrint" class="btn btn-danger col-md-12" data-toggle="modal" data-target="#abonoFacturaProvedor" ><i class="fa fa-warning"></i>Abonar a esta factura</h1></button>';
                    }
                    echo '<div class="col-md-12">';
                    require("../../data/comunes/listas/ventas/productoFacturadoProvedores.php");
                     echo '<div>';
                   
                      if ($datoFactura["estadoFactura"]=='cancelado' || $datoFactura["estadoFactura"]=='consignacion') {
                      # Anular...
                    echo '<div class="col-md-6" align="center">
                            <button type="button" class="btn btn-danger">
                              <i class="fa fa-warning"></i>ANULAR FACTURA
                            </button>
                          </div>';
                    //Imprimir
                    echo '<div class="col-md-6" align="center">
                            <button type="button" class="btn btn-success"><i class="fa fa-print"></i>Imprimir Factura</button>
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
      require("../../data/comunes/modal/contabilidad/abonoFacturaProvedor.php");
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
<script src="<?php echo PATH ?>js/guardar/guardarAbonoFacturaProvedor.js" type="text/javascript" charset="utf-8" async defer></script>



<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
 

</body>
</html>
