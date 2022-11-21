
<?php
	if(file_exists('../login/allow/data/comunes/modal/busqueda/busquedaGeneral.html')){
		require "../login/allow/data/comunes/modal/busqueda/busquedaGeneral.html";
	}else{
		require "../../../login/allow/data/comunes/modal/busqueda/busquedaGeneral.html";
	}	
?>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo BASEPATH; ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo BASEPATH; ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="<?php echo BASEPATH; ?>js/jquery-ui.min.js"></script>
<script src="<?php echo BASEPATH; ?>js/jquery.slimscroll.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo BASEPATH; ?>js/custom.min.js"></script>

<!-- SWEET ALERT -->
<script src="<?php echo BASEPATH; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo BASEPATH; ?>/plugins/bower_components/toast-master/js/jquery.toast.js"></script>



<script src="<?php echo BASEPATH; ?>/assets/node_modules/footable/js/footable.min.js"></script>


<!--BUSQUEDA -->
<input type="hidden" id="url"  value="<?php echo PATH  ?>">
<script src="<?php echo PATH; ?>js/acciones/busquedaGeneral.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo PATH; ?>js/acciones/checkTraslados.js" type="text/javascript" charset="utf-8" async defer></script>


