<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/facturacion/libreria.clases.php');
require('../../data/libreria.lib/contabilidad/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);

$consultaComun=new consultasComunes();
$ingresarFactura=new ingresoFacturas();
$consultaContable=new consultaContabilidad();
$ingresarContabilidad=new ingresoContabilidad();

//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=ventas;
$breadcrumb = array(0 => ventas, 1 => postVentas);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://www.jose-aguilar.com/scripts/jquery/jquery.js" type="text/javascript"></script>
<script>
$('#formulario').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
</script>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
    
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="ajax/autocompletar.js"></script>
    <!-- CSS PLUGIN sweet alert -->
    <link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
      <!-- CSS-->
    <link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">


<script type="text/javascript">
$(document).ready(function() {
    $("clientForm").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
</script>

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
           


           <?php 


           /*apertura de cajas */
           if (isset($convenioCajasBase) AND fechaActualFija == $consultaComun->decrypt($aperturaCaja, publickey)) {
          # code...ç
              if ($ingresarContabilidad->abrirCaja($convenioCajasBase)==1) {
                # code...
                $consultaComun->avisos("done", "Listo, ya la caja quedó abierta y  estoy listo para registrar!");
              }
              else
              { //Error
                $consultaComun->avisos("error", "Ops! Ocurrió un error al abrir la caja, intentalo de nuevo o llama a soporte y dile que tengo un error 02-00-00-00,  ellos entenderán :) ");
              }
          }
          /**fin apertura de cajas*****/


           if ($consultaContable->checkAperturaCaja($id)==1) {
             # code...
            if (!isset($confirmacion)) {
                # code...
                require("../../data/comunes/formularios/ventas/remision.php");
              }
              elseif ($confirmacion==0)
              {
                # code...
                  //Verifico si  esta pagando  completo o es un crédito

               echo '
                      <div class="white-box">
                        <script type="text/javascript">
                          <!--
                            window.print();
                            //-->
                        </script>';
                           $ingresarFactura->ingresarNuevaFactura($datos);
            

                        echo '<a href="javascript:window.print()" id="noPrint"  >
                                <div class="btn btn-primary">Imprime</div>
                              </a>
                    </div>';



      
                } 

            }//fin check apertura de cajas
            else{

              $consultaComun->avisos("aviso","Debes abrir primero la caja para poder empezar a facturar! sin eso no podemos empezar<br>");
              
              echo '<div class="col-md-12>';

                $ingresarContabilidad->BotonAperturaCaja($id);
              echo "</div>";
            }


           ?>


          </div>
        </div>
      
      <!-- Fin del cuerpo-->



      
    </div>
    <!-- /.container-fluid -->
  
    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/contabilidad/aperturaCaja.php");
    ?>
    <script src="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
  </div>
  <!-- /#page-wrapper -->
</div>


<!-- APERTURA DE CAJAS-->
<script src="<?php echo PATH ?>js/acciones/aperturaCaja.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- -->


<!-- /#wrapper -->
<!-- autocompletar-->
<?php
        include("../../js/typehead/listaJsonProductos.php");
      ?>
<script src="js/auto.js"></script>
<script src="<?php echo BASEPATH ?>js/validator.js"></script>
<script src="<?php echo PATH ?>js/custom.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

 <!-- sweer alerts-->
    <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    
<!-- fin autocompletar-->
<script>

  // Date Picker
      jQuery('.complex-colorpicker, #inventarioConvenioFecha').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
          autoclose: true,
          todayHighlight: true
        });    
  </script>

<?php include("ajax/ajaxInvoice.php"); //Subproductos de la factura
 
?>
<!-- -->

<!-- -->
<!-- jQuery -->
<?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>


</body>
</html>
