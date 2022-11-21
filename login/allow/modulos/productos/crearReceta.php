<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/productos/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();
$ingresarProductos=new ingresoProductos();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=recetasyproductos;
$breadcrumb = array(0 => recetasyproductos, 1=> nuevaReceta);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
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
        <?php
        if (!isset($confirmacion)) {
          # no hay confirmación...
          require("../../data/comunes/formularios/productos/recetas.php");
        }
        else
        {
            if ($confirmacion==1) {
              # code...
              require("../../data/comunes/formularios/productos/confirmacion/recetas.php");
            }
            elseif ($confirmacion==2) {
              # code...
              if ($_SESSION["sesionControl"]) {
                # code...
                if($ingresarProductos->ingresarRecetas($datos)==1)
                  { 
                      $consultaComun->avisos("done", "Listo, La receta quedo lista para empezar a venderse!");
                      //unset($_SESSION['sesionControl']);
                  }
                else
                {
                  $consultaComun->avisos("error", "Ops! Ocurrió un error, Intenta de nuevo, si sigue el error llama al ingeniero, seguro el sabrá que hacer :) ");   
                }
              }

              else//En caso que se recargue la página o hayauna actualización y los POST sigan en memoria
              {

                $consultaComun->avisos("aviso", "Auch! no vuelvas a actualizar la pagina por favor! si necesitas ingresar otro inventario solo tienes que  hacer clic en <br><b><i class='fa fa-cubes'></i>Tus Inventarios > Nuevo Inventario</b>");   

              }

              
            }
        }
        ?>
        
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

<!-- PLUGINGS-->
   <?php include("../../scripts/recetas/ajaxInvoice.php") ?>

<!-- FIN PLUGINS-->

</body>
</html>
