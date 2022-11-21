<div class="white-box">
  <div class="table-responsive">
  <h3><i class="fa fa-list"></i> Esto es lo que <?php echo $datoCliente["clienteNombres"] ?> ha comprado</h3>
  <?php
      //Traigo la tabla de los convenios
      $consultaComun->historicoCompras();
  ?>
  </div>
</div>
