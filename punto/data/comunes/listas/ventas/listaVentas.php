<div class="white-box">
  <div class="table-responsive">
  <h1><i class="fa fa-list"></i> Lista de las ventas de hoy </h1>
  <?php
      //Traigo la tabla de los convenios
      $consultaComun->listaVentas(date("Y-m-d"));
  ?>
  </div>
</div>
