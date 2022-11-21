<h3 class="box-title">Este Trimestre <?php  $nombre=explode(" ", $datosUser['nombre']); echo $nombre[0]; ?> Ha Vendido</h3>
 <ul class="list-inline two-part">
   	<li style="width: 50px;" ><i class="fa fa-dollar text-info" ></i></li>
    <li class="text-right" style="width: 50px;" ><span class="counter" style="font-size: 40px;">$<?php echo number_format($consultaContable->valorVendidoUltimoTrimestre($datosUser['codigo'])); ?></span></li>
</ul>
