<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$saveTemp = new saveForms();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);

if ($datoUsuario["modoInventario"]=='no') {
    header('Location:../../');
}
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";

?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"  ></div>
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
        <h3><i class="fa fa-truck"></i> INVENTARIO GLOBAL</h3>
      <!-- INICIO DE FORMULARIOS-->
      

        <!-- INICIO DE LA PRIMERA COLUMNA-->
        <div class="col-md-4">
           <div class="col-md-12">
            <input class="inputs form-control" type="text" id="codigo" placeholder="dame el serial o codigo"  onchange ="nuevoFocus(this)" autofocus="" />
            <label>SELECCIONA SOLO SI VAS A RESTAR 1 UNIDAD!
              <input type="checkbox" id="fc" >
            </label>
            
          </div>
          <div class="col-md-12">
            <h3 align="center"><i class="fa fa-minus-circle"></i> Seriales/Imeis Registrados En otros puntos de venta</h3>
            <div id="listaProductosRegistradosEnOtrosPuntos"></div> 
          </div>

         
          

        </div>
        <!-- FIN DE LA PRIMERA COLUMNA-->
        <!-- SEGUNDA COLUMNA-->
        <div class="col-md-8">
              <h4 align="center"> <i class="fa fa-check-circle"></i> REGISTRO INVENTARIO</h4>
          <div id="listaProductosRegistrados"></div>
        </div>


        <!-- FIN DE LA SEGUNDA COLUMNA-->


      <!-- FIN DE LOS FORMULARIOS-->
      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
       require "../../data/comunes/footer.php";
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<!-- JS PLUGINGS-->
<script>
  
  $.post('../../data/ajax/acciones/listaPreInventario.php', { }, function(datosTabla) {
              $('#codigo').val('');
              $('#listaProductosRegistrados').html(datosTabla);
              });  


   $.post('../../data/ajax/acciones/listaPreInventarioImeisSinCoincidir.php', { }, function(datosTabla) {

              $('#codigo').val('');
              $('#listaProductosRegistradosEnOtrosPuntos').html(datosTabla);
              });


   
  function nuevoFocus(valor){
    var number = Math.floor((Math.random() * 1000000000) + 1);;
      if (valor.value.length > 0) {
        setTimeout(function(){//time
          if((typeof($('[id=fc]')[0]) == 'undefined') || (typeof($('[id=fc]')[0]) == undefined)) { fc = false; }else{ fc= ($('[id=fc]')[0].checked) };

          if ((typeof($('[id=fc]')[0]) == 'undefined') || (typeof($('[id=fc]')[0]) == undefined)) { fc = false; }else{ fc= ($('[id=fc]')[0].checked) };
          addProducto(valor.value, fc);
         }, 10);//FIN DEL TIME
      }
  }


function addProducto(parametro, fc){

  $.ajax({
            //url: 'ajax/guardarUsuario.php',
            url : '../../data/ajax/insercionDatos/comparacionInventarios.php',
            type: 'GET',
            dataType: 'JSON',
            data: { 
                    codigo: ""+parametro+"",
                    fc : ""+fc+"" 
            },                                    
        })
        .done(function(data) { 
          if ((data.Registrado)==0) {
          $.post('../../data/ajax/acciones/listaPreInventario.php', { }, function(datosTabla) {

              $('#codigo').val('');
              $('#listaProductosRegistrados').html(datosTabla);
              });  

        }else if (data.Registrado == 1) {
              $('#codigo').val('');
              swal("Ops!", "EL PRODUCTO EXISTE PERO TIENE SERIAL/IMEI, ESCANEALO CON EL IMEI O SERIAL", "warning");

            //Error imei
        }else if (data.Registrado == 2) {
          //Ese imei no existe
              $('#codigo').val('');
              swal("Auch!", "Este producto ya lo inventariaste", "warning");

        }else if (data.Registrado == 3) {
          //Ese imei no existe
          $('#codigo').val('');
          swal("Ops!", "El producto no esta registrado en el sistema ", "warning");
          console.log('imei noe')

        }else if (data.Registrado == 4) {
          //Ese imei no existe
          $('#codigo').val('');
          swal("Ops!", "ESTA EN INVENTARIO PERO EN OTRO PUNTO DE VENTA ", "warning");
          console.log('imei noe')

          $.post('../../data/ajax/acciones/listaPreInventarioImeisSinCoincidir.php', { }, function(datosTabla) {

              $('#codigo').val('');
              $('#listaProductosRegistradosEnOtrosPuntos').html(datosTabla);
              });

        }
        $('#fc').prop('checked', false); // Checks it


           });
  /*=====  End of ajax de guardado  ======*/
}//fin de la funcion




</script>
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>