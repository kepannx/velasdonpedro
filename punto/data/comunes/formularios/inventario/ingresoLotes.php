<div class="col-md-12">
  <div class="col-md-3 col-sm-12">
      <div class="form-group">
          <label>Quién Es El Provedor?</label>
          <div class="input-group" id="nombreProvedor">
            <div class="input-group-addon">
              <i class="fa fa-fort-awesome"></i>
            </div>
            <input type="text" class="typeahead form-control" id="provedor" placeholder="Dime como llamarás a este punto de venta"  data-error="Necesito que me digas quien es el provedor" max="100" required>
          </div>
        <div class="help-block with-errors"></div>
      </div>
      <input type="hidden" id="idProvedor" value="0">

  </div>
  <div class="col-md-3 col-sm-12">
    <div class="form-group">
          <label>Número de Factura</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-hashtag"></i>
            </div>
            <input type="text" class="typeahead form-control" id="nroFacturaProvedor" placeholder="Cuál Es El Numero De Factura"  data-error="Debes darme el número de la factura"  required>
          </div>
        <div class="help-block with-errors"></div>
      </div>
  </div>
  <div class="col-md-3 col-sm-12">
    <div class="form-group">
          <label>Cuándo Hiciste La compra?</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control fechas" id="fechaFacturaProvedor" placeholder="Cuando lo compraste"  data-error="Debes darme el número de la factura"  required>
          </div>
        <div class="help-block with-errors"></div>
      </div>
  </div>


  <div class="col-md-3 col-sm-12">
    <div class="form-group">
          <label>Ya Pagaste Esta Factura?</label>
          <div class="input-group" id="nombreProvedor">
            <select id="estadoFactura" class="form-control" required="" data-error="Necesito que me digas si ya lo pagaste o no">
                <option value = "">Dime si lo hiciste </option>
                <?php
                  $objHtm->selectCancelacionFacturasProvedor()
                ?>
            </select>
           
          </div>
        <div class="help-block with-errors"></div>
      </div>
  </div>
</div>

<div id="facturaCredito"></div>

<div class="col-md-12">
  <div class="col-md-12 col-sm-12">
    <div class="form-group">
          <label>A dónde enviarás esta mercancía?</label>
          <div class="input-group" >
            <select class="selectpicker" data-style="form-control" id="origenTraslado" required  data-error="Debes decirme donde pongo esta mercancía">
                  <?php $consultaComun->optionGroupBodegasPuntosVenta() ?>
                </select>
           
          </div>
        <div class="help-block with-errors"></div>
      </div>
  </div>
</div>
