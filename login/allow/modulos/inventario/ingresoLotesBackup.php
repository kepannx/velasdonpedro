<?php 
require('../../data/libreria.lib/libreria.clases.php');//Clases normales basicas.
require('../../data/libreria.lib/productos/libreria.clases.php'); //Llamo las clases  para productos
require('../../data/libreria.lib/inventarios/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();
$consultaInventario=new consultaInventarios();
$consultaProducto = new consultaProductos();
$ingresarInventario=new ingresoInventarios();
$editarProducto = new   editoProductos();


//Aqui viene el condicional para saber si es empleado del convenio o  es administrador

//Los fetch para las consultas
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
$datoProducto=mysql_fetch_array($consultaProducto->sqlProductos($idProducto));
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

<!-- Pluging AutoCompletar-->
  <!-- CSS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
  <!-- FIN CSS-->

  <!-- CSS PLUGIN switchery -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
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
    
      <div class="row">
         <div class="col-md-12  col-sm-12 col-xs-12">
            <?php
            if (!isset($confirmacion)) {
              # code...
              require("../../data/comunes/formularios/inventario/ingresoLotes.php");
            }
            else
            {
              if ($confirmacion==1) {
                # code...
                  //confirma el pedido

                   require("../../data/comunes/formularios/inventario/confirmacion/ingresoLotes.php");
              }
              elseif ($confirmacion==2) {
                # code...
                //ingresa la  factura y  la lista  y destruye la sesion
                 if ($_SESSION["sesionControl"]) {
                    $ingreso=$ingresarInventario->ingresoLotes($datos);
                   if($ingreso==1)
                      { 
                        //Mensaje de exito y destrucción de la sesion de control
                         $consultaComun->avisos("done", "Listo, ya actualicé el inventario");
                         //Si existen nuevos productos en el inventario  saco la lista de los productos para actualizar
                        
                         if (isset($_SESSION['nuevoProducto'])) {
                           # code...
                          $numeroNuevosProductos=sizeof($_SESSION['nuevoProducto']);
                          $n=0;
                          echo '<h2 class="text-danger" align="center"><i class="fa fa-warning"></i> Agregaste productos que no tenia registrados, necesito que les des el precio de venta</h2>';

                          //Cabecera del formulario 
                          echo '
                        <form action="#" class="form-horizontal"  method="POST">
                          <div class="white-box">

                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th align="center"  width="30%"><div style="width:100%; text-align:center">Nombre del Producto</div></th>
                                      
                                      <th align="center"  width="15%"> <div style="width:100%; text-align:center">Precio Público</div></th>
                                      <th align="center"  width="20%"> <div style="width:100%; text-align:center">Precio Por Mayor</div></th>
                                      <th align="center"  width="15%"> <div style="width:100%; text-align:center">Alerta de Minimos en Existencia</div></th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                          while ($numeroNuevosProductos>$n) {
                            $producto=explode("-", $_SESSION['nuevoProducto'][$n]);
                            # code...
                            echo ' <tr>
                                    <td>'.$producto[1].'</td><!-- Nombre del producto-->
                                    <input type="hidden" name="idProducto[]" value="'.$producto[0].'">
                                    <td class="text-danger" align="center">
                                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                             <input type="text" name="valorVentaUnidad[]" class="form-control"  onkeyup="format(this)" onchange="format(this)" placeholder="Valor Venta"  >
                                          </div>
                                    </td>
                                    <td>
                                      <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                             <input type="text" name="valorVentaPorMayor[]" class="form-control"  onkeyup="format(this)" onchange="format(this)" placeholder="Valor Venta"  >

                                          </div>
                                        </div>

                                    </td><!-- Valor -->
                                    <td>
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-bell"></i></div>
                                            <input type="number" name="productosConvenioMinimo[]" min="1" max="999"  class="form-control">
                                           
                                          </div>
                                        </div>
                                    </td><!-- Margenes Mínimos -->
                                  </tr>';
                            $n++;

                          }
                          echo ' </tbody>
                              </table>';

                              echo '<div class="col-md-12" align="center">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Listo, Actualízame los datos de estos '.$n.' productos </button>

                                        <input type="hidden" name="confirmacion"  value="3">
                                        <input type="hidden" name="id" value="'.$id.'">
                                    </div>';
                  echo '</form>'; //fin de la edicion de los nuevos productos
                          //unset($_SESSION['nuevoProducto']);
                         }
                          
                         //unset($_SESSION['sesionControl']);
                      }
                    elseif ($ingreso==0) {//Error Al Ingresar la factura general
                      # code...
                        $consultaComun->avisos("ERROR", "Ops!  no pude  ingresar el lote :/ registé un error al tratar de ingresar la factura general, comunícate con el ingeniero y dile que tengo un error 00-02-00-02,  el lo entenderá ;) ");  
                    }
                    elseif ($ingreso==2) {//Error al ingresar los sublotes
                      # code...
                       $consultaComun->avisos("ERROR", "Ops!  no pude  ingresar el lote :/ registé un error al tratar de ingresar  los productos, comunícate con el ingeniero y dile que tengo un error 00-02-00-02,  el lo entenderá ;) ");  
                    }
                 }
                   else
                   {
                    //Me indica el error que intento reactualizar la pagina cuando ya se habia ingresado el producto
                    $consultaComun->avisos("aviso", "Auch! no vuelvas a actualizar la pagina por favor! si necesitas ingresar otro inventario solo tienes que  hacer clic en <br><b><i class='fa fa-cubes'></i>Tus Inventarios > Ingresar Lotes</b>");   
                   }
               }

              elseif ($confirmacion==3) { //Actualizo los datos de los productos que ingrese
                # code...
                if ($editarProducto->editarProductoDesdeLote($datos)==1) {
                  # code...
                  $consultaComun->avisos("done", "Listo, ya actualicé los datos a los productos");
                }
                else
                {
                  $consultaComun->avisos("ERROR", "Ops! no pude editar todos los productos, comunícate con el ingeniero y dile que tengo un error 00-02-01-02,  el lo entenderá ;) ".mysql_error()); 
                }
              }


               else
                {//Si el ingreso del producto tuvo errores internos

                  $consultaComun->avisos("ERROR", "Ops!  no pude  ingresar el lote :/ intentalo de nuevo, si el error sigue, comunícate con el ingeniero y dile que tengo un error 00-02-00-02,  el lo entenderá ;) ");  
                }
            }    
            ?>
            
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
 <!-- Invoice-->
  <script src="../../scripts/ui/jquery-ui.min.js"></script>
    <?php include("../../scripts/ajax/ajaxInvoiceIngreso.php") ?>


  <!--fin invoice -->

  <!-- swich-->
   <script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>
  <!-- Fin Swich-->
   <!-- TYPEHEAD-->
      <script src="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>

      <script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

      <script src="<?php echo PATH ?>js/custom.js"></script>
      
    
      <?php
        include("../../js/typehead/listaJsonProductos.php");
      ?>
  <!-- FIN TYPEHEAD-->

  <script>









  // Date Picker
      jQuery('.complex-colorpicker, #inventarioConvenioFecha').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
          autoclose: true,
          todayHighlight: true
        });    
  </script>
<!-- FIN PLUGIN JS-->


</body>
</html>
