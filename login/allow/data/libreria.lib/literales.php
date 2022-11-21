<?php
date_default_timezone_set('america/bogota');
define("nombreSoftware", "BillWare");
define("version", "1.0 Beta");
define('anioVersion', 2017);
define("titulo", "Billware 1.0 Versión Beta");
define("autor", "Codream S.A.S");
define("telefonoSoporte", '3167386129');
define("emailSoporte", "codream@outlook.es");
define(piePaginaFacturas, "BillWare Facturación Punto de Venta | Power By codream.co © ".date("Y"));

define('PATH', "http://".$_SERVER['HTTP_HOST']."/billware/login/allow/");

define('BASEPATH', "http://".$_SERVER['HTTP_HOST']."/billware/");
//Datos Aplicacion
define(fechaActual, strtotime("now"));
define(fechaActualFija, strtotime(date("d-m-Y")));
define("fechaActualFijaHora", strtotime('Y-m-d H:m'));
define(fechaMesActual, strtotime(date("Y-m")));
define('ciudadDefecto', 'Medellín');
define('dptoDefecto', 'Antioquia');
define('PATH', '/login/allow/');

define('txtSinSubCategoria', 'Sin Subcategoria');


/*****************************************[TITULOS DE LOS DOCUMENTOS]************************************/


/*CONVENIOS*/

define(index, "Panel Principal");



/* CATEGORÍAS */
define('categorias', 'Categorías');
define('nuevaCategoria', 'Nueva Categoría');



/*ASOCIADOS*/

define(clientes, "Clientes");
define(listaClientes, "Lista de los Clientes");
define(perfilCliente, "Perfil De ");




/*INVENTARIOS*/

define(inventario, "Inventario");
define(nuevoInventario, "Nuevo Inventario");
define(listaInventario, "Lista del Inventario");




/* PROVEDORES */
define(provedor, "Proveedores");
define(nuevoProvedor, "Nuevo Proveedor");
define(listaProvedores, "Lista de los Proveedores");
define(datosProvedor, "Datos del proveedor");

/*******productos********/
define(recetasyproductos, "Productos y Servicios");
define(nuevaReceta, "Nuevo Producto/Servicio");
define(listaRecetas, "Lista de Productos/Servicios");
define(listaProductos, "Lista de Productos");
define(detalleProducto, "Detalle del Producto/Servicio");




/**************[POST DE VENTAS]**********************/

define(ventas, "Ventas");
define(postVentas, "Post de Ventas");
define(facturaCliente, "Factura");

/*----------  PUNTOS DE VENTA  ----------*/
define(puntosVenta, "Puntos de Venta");
define(nuevoPuntoVenta, "Nuevo Punto De Venta");
//*********contabilidad*************//

define(contabilidad, "Contabilidad");
define(cajas, "Cajas");
define(aperturaYCierreCaja, "Apertura y Cierre de Caja");
define(gastos, "Gastos y Egresos");
define(listaGastos, "Lista de Gastos");
define(tusFacturas, "Tus Facturas");
define(tusCuentasCobro, "Tus Cuentas de Cobro");
define(facturaProvedor, "Factura Del Provedor ");
define(perfilProvedor, 'Perfil del Provedor');
define(historialVentas, 'Historico de Ventas');
define(hojaHistorialVentas, 'Historial de movimientos de ');
define(misBancos, "Mis Bancos");
define(productoBancario, "Productos Bancarios");
define(cuentasPorPagar, "Cuentas por Pagar");
define(facturasCuentascobro, "Facturas y Cuentas de Cobro");
define(reporteVentas, "Reporte de Ventas");
define(reporteVentasPorProducto, "Reporte de Ventas Por Producto");
define(movimientoDia, 'Movimientos del Día');

/****************[SINCRONIZACIÓN]*************************/

define(sincronizacion, "Sincronización de Datos");
define(sincronizarCliente, "Sincronizar Clientes");
define(sincronizarProveedor, "Sincronizar Proveedores");
define(sincronizarProductos, "Sincronizar Productos");



/**********************[USUARIOS]**************************/
define(usuarios, 'Usuarios');
define(listaUsuarios, "Lista De Usuarios");
define(perfilUsuario, "Perfil de Usuario");



/*********************[SETTINGS]****************************/

define(settings, "Configuración");
define(settingsSistema, "Configuración del Sistema");
define(valorComisionBancaria, 3.5);
