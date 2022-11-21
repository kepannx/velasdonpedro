<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/contabilidad/libreria.clases.php');

$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);

$consultaComun=new consultasComunes();
$consultaContable=new consultaContabilidad();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
$datosEmpresa=mysql_fetch_array($consultaComun->sqlDatosEmpresa());

/*breadcrumb */
$paginaActual=settings;
$breadcrumb = array(0 => settings, 1 => settingsSistema, 2=> $datoBanco['nombreBanco']);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
<!-- CSS PLUGIN sweet alert -->
    <link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo BASEPATH ?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />


      <!-- CSS-->
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
        
        <div class="row" data-toggle="validator">
          <div class="col-md-12 white-box">
              <div class="col-md-12">
                <div class="col-md-6">
                  <h2><i class="fa fa-cogs"></i> <?php  echo settingsSistema;?></h2>
                </div>
                

            

             <div class="panel-body">
               
             </div>



          <!-- DATOS DEL BANCO-->
          <div class="col-md-12">
            <section>
                  <div class="sttabs tabs-style-bar">
                    <nav>
                      <ul>
                        <li><a href="#informacionBanco" class="fa fa-info-circle"><span> Información Básica</span></a></li>

                        <li><a href="#informacionTributaria" class="fa fa-legal"><span> Información Trubutaria</span></a></li>
                        <li><a href="#documentacion" class="fa fa-file-text-o"><span>Documentación</span></a></li>
                        <li><a href="#aboutSoftwa" class="fa fa-bell-o"><span>Sobre <?php  echo nombreSoftware; ?></span></a></li>
                      </ul>
                    </nav>
                    

                    <div class="content-wrap">
                      <section id="sinformacionBanco">
                        <h3> <i class="fa fa-info-circle"></i> Información Básica</h3>
                      <!-- Datos de la empresa-->
                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Nombre de la Empresa:</label>
                          <input type="text" id="nombreEmpresa" class="form-control" value="<?php echo $datosEmpresa['nombreEmpresa']; ?>" max="50" placeholder="Cómo se llama tu empresa?">
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Direccion:</label>
                          <input type="text" id="direccionEmpresa" class="form-control" value="<?php echo $datosEmpresa['direccionEmpresa']; ?>" max="50" placeholder="Cómo se llama tu empresa?">
                        </div>

                      </div>



                      <div class="form-group">
                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">Ciudad</label>
                          <input type="text" id="ciudadEmpresa" class="form-control" value="<?php echo $datosEmpresa['ciudadEmpresa']; ?>"  placeholder="En qué ciudad esta?">
                        </div>   

                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">Departamento/Estado</label>
                          <input type="text" id="estadoEmpresa" class="form-control" value="<?php echo $datosEmpresa['estadoEmpresa']; ?>"  placeholder="Estado o Departamento">
                        </div>



                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">País</label>
                          <input type="text" id="paisEmpresa" class="form-control" value="<?php echo $datosEmpresa['paisEmpresa']; ?>"  placeholder="En qué país se encuentra la empresa?">
                        </div>


                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">Teléfonos</label>
                          <input type="text" id="telefonosEmpresa" class="form-control" value="<?php echo $datosEmpresa['telefonosEmpresa']; ?>"  placeholder="Teléfono Empresa">
                        </div>


                      </div>


                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Email</label>
                          <input type="email" id="emailEmpresa" class="form-control" value="<?php echo $datosEmpresa['emailEmpresa']; ?>" max="45" placeholder="Correo Electrónico Empresa">
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Sitio Web:</label>
                          <input type="text" id="sitioWeb" class="form-control" value="<?php echo $datosEmpresa['sitioWeb']; ?>" max="100" placeholder="Cómo se llama tu empresa?">
                        </div>
                    
                      </div>
                        <br><br>


              <div class="form-group">
                <label class="col-sm-12">Actualizar Logo</label>
                <div class="col-sm-12">
                 <form method="post" enctype="multipart/form-data"  action="ajax/upload.php">
                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Seleccionar Archivo</span> <span class="fileinput-exists">Change</span>
                    <input type="file" name="images" id="images">
                    </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                  </form>

                  <div id="response"></div>
                </div>
              </div>
                                          <button type="submit" id="btn">subir Logo</button>

                 
                    <div class="col-md-12">
                      <br>
                      <button type="button" id="editarDatosBasicos" class="btn btn-success col-md-12 waves-effect waves-light">Editar Información Básica</button>
                    </div>

         




                      </section>
                     <!-- Fin de los datos básicos-->
                     <!-- Inicio Información Tributaria-->
                      <section id="informacionTributaria">
                        <h2><i class="fa fa-legal"></i>Información Truburaria</h2>

                      <div class="form-group">
                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">N.I.T</label>
                          <input type="text" id="identificacionTributaria" class="form-control" value="<?php echo $datosEmpresa['identificacionTributaria']; ?>"  placeholder="Tu nñumero de Identificación Tributaria">
                        </div>   

                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">Tipo de Empresa</label>
                            <?php
                                $consultaComun->selectTiposRegimenTributario($datosEmpresa['regimenEmpresa'])
                            ?>
                        </div>



                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">Representante Legal</label>
                          <input type="text" id="representanteEmpresa" class="form-control" value="<?php echo $datosEmpresa['representanteEmpresa']; ?>"  placeholder="¿Quién representa la empresa?">
                        </div>


                        <div class="col-md-3">
                          <label for="recipient-name" class="control-label">Moneda</label>
                          <?php
                                $consultaComun->selectMoneda($datosEmpresa['moneda'])
                            ?>
                        </div>


              <div class="form-group">

                <label for="recipient-name" i class="control-label">Términos y Condiciones de la Factura</label>
                <textarea class="textarea_editor form-control" rows="15" id="terminosCondicionesFactura" placeholder="Escribe aquí lo que quieres que aparezca como términos y condiciones en la factura, ejemplo, 'Pasados _______ dias no se responderá por garantia en productos como displays, cables etc'

Recuerda que entre mas largo el texto mas larga será la factura
                ">
                  
                  <?php echo $datosEmpresa['terminosCondicionesFactura']; ?>
                </textarea>
              </div>



              <div class="col-md-12">
                <button type="button" id="editarDatosTributarios" class="btn btn-success col-md-12 waves-effect waves-light">Editar Información Tributaria</button>
              </div>

                    

                     



                      </section>
                      <!--Fin de información triburaria -->

                      <!-- documentación -->
                      <section id="documentacion">
                        <h2> <i class="fa fa-file-text-o"></i> Documentación Del Negocio</h2>

                      </section>
                      <!-- Fin documentación -->

                      <!-- Inicio About Software-->
                      <section id="aboutSoftwa">
                          <h2><i class="fa fa-bell-o"></i>
                          Sobre <?php echo nombreSoftware; ?></h2>
                            

                            <div class="col-md-3">
                              <strong>
                                Desarrollado por
                              </strong>
                            </div>
                            <div class="col-md-3">
                              <?php echo autor; ?>
                            </div>



                            <div class="col-md-2">
                              <strong>
                                Versión 
                              </strong>
                            </div>
                            <div class="col-md-3">
                              <?php echo version; ?>
                            </div>



                            <div class="col-md-3">
                              <strong>
                                Año de la versión 
                              </strong>
                            </div>
                            <div class="col-md-3">
                              <?php echo anioVersion; ?>
                            </div>


                      </section>

                      <!-- Fin About Software-->
                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>

          </div>
          <!-- FIN DATOS DEL BANCO-->
      

         

         
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

  <script src="<?php echo PATH ?>js/editar/editarInformacionBasicaNegocio.js" type="text/javascript" charset="utf-8" async defer></script>

  <script src="<?php echo PATH ?>js/editar/editarInformacionTributariaNegocio.js" type="text/javascript" charset="utf-8" async defer></script>



  <script src="<?php echo PATH ?>js/acciones/subirLogo.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- /#wrapper 
    <script src="<?php echo PATH ?>js/editar/editarBanco.js" type="text/javascript" charset="utf-8" async defer></script>

    <script src="<?php echo PATH ?>js/acciones/registroMovimientoBancario.js" type="text/javascript" charset="utf-8" async defer></script>

    <script src="<?php echo PATH ?>js/guardar/nuevoProductoBanco.js" type="text/javascript" charset="utf-8" async defer></script>

-->
    <script src="<?php echo BASEPATH ?>js/validator.js"></script>

      <!-- sweer alerts-->
    <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>


    <!-- pestañas-->
    <script src="<?php echo BASEPATH ?>js/cbpFWTabs.js"></script>
    

<!-- jQuery -->
<script src="<?php echo PATH ?>js/custom.js"></script>

<script type="text/javascript">

      (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
     
</script>



  <?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>

</body>
</html>
