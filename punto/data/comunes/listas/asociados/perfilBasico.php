<div class="white-box">
 <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $validar->datospagina(9); ?>asociado/panel/files/usuarios/imagenes/perfiles/<?php echo $datoCliente["clienteImagen"] ?>">
   <div class="overlay-box">
     <div class="user-content"> <a href="javascript:void(0)"><img src="<?php echo $validar->datospagina(9); ?>asociado/panel/files/usuarios/imagenes/perfiles/<?php echo $datoCliente["clienteImagen"] ?>" class="thumb-lg img-circle" alt="img"></a>
       <h4 class="text-white"><?php echo $datoCliente["clienteNombres"]." ".$datoCliente["clienteApellidosPrimero"] ?></h4>
       <h5 class="text-white"><?php echo $datoCliente["clienteIdEntidadNumero"]; ?></h5>
     </div>
   </div>
 </div>
 <div class="user-btm-box">
   <div class="col-md-6 col-sm-12 text-center">
     <p class="text-purple">Cupo Global De Crédito</p>
     <h3>$ <?php echo number_format($datoCliente["clienteCupoCredito"]); ?></h3>
   </div>

   <div class="col-md-6 col-sm-12 text-center">
     <p class="text-blue">Último Abono</p>
     <h3>22 de Septiembre de 2016</h3>
   </div>
 </div>
</div>