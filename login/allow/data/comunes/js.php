
<?php
	if(file_exists('data/comunes/modal/busqueda/busquedaGeneral.html')){
		require "data/comunes/modal/busqueda/busquedaGeneral.html";
	}else{
		require "../../data/comunes/modal/busqueda/busquedaGeneral.html";
	}	
?>


<script src="<?php echo BASEPATH; ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo BASEPATH ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo BASEPATH ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="<?php echo BASEPATH ?>js/jquery-ui.min.js"></script>
<input type="hidden" id="url"  value="<?php echo PATH  ?>">
<script src="<?php echo BASEPATH ?>js/jquery.slimscroll.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo BASEPATH ?>js/custom.min.js"></script>
<script src="<?php echo PATH; ?>js/acciones/busquedaGeneral.js" type="text/javascript" charset="utf-8" async defer></script>



