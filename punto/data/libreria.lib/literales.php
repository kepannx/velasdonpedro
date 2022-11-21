<?php
date_default_timezone_set('america/bogota');
define("nombreSoftware", "BillWare");
define("version", "1.0 Beta");
define('anioVersion', 2018);
define("titulo", "BillWare 2.0 [PUNTO DE VENTA]");
define("autor", "Codream S.A.S");
define("telefonoSoporte", '3167386129');
define("emailSoporte", "codream@outlook.es");
define(piePaginaFacturas, "BillWare Sistema Registro OnLine | Power By codream.co © ".date("Y"));
define('ciudadDefecto', 'Medellín');
define('dptoDefecto', 'Antioquia');
//define('PATH', "http://".$_SERVER['HTTP_HOST']."/bw/versiones/beta20/app/cSuperAdmin/");
define('PATH', "http://".$_SERVER['HTTP_HOST']."/billware/punto/");

define('BASEPATH', "http://".$_SERVER['HTTP_HOST']."/billware/");

//Datos Aplicacion
define(fechaActual, strtotime("now"));
define(fechaActualFija, strtotime(date("d-m-Y")));
define("fechaActualFijaHora", strtotime('Y-m-d H:m'));
define(fechaMesActual, strtotime(date("Y-m")));
define("url", "app/cSuperAdmin/");
define(valorComisionBancaria, 3.5);
define(key, 'SpufraK3858EpechUkU4rajAjuWrapRapH3hep6desebrekeb2crux6c87hEsA3rned4EwredRaPr2B7t5ekega2a73xupen');
define(publickey, "5663284166397124291158310398993993");

/*************************[TITULOS DE LOS DOCUMENTOS]************************************/

/*CONVENIOS*/

define(index, "Panel Principal");




/*ASOCIADOS*/

define(clientes, "Clientes");
define(listaClientes, "Lista de los Clientes");
define(perfilCliente, "Perfil De ");




/*INVENTARIOS Y BODEGAS*/

define(inventario, "Bodegas e Inventario");
define(nuevoInventario, "Nuevo Inventario");
define(listaInventario, "Lista del Inventario");

define(bodegas, "Bodegas");
define(nuevaBodega, "Nueva Bodega");
define(listadoBodegas, "Listado de Bodegas");
define(ingresarFacturaProvedor, "Nueva Factura de Provedor");

/* PROVEDORES */
define(provedor, "Proveedores");
define(nuevoProvedor, "Nuevo Proveedor");
define(listaProvedores, "Lista de los Proveedores");
define(datosProvedor, "Datos del proveedor");
define(perfilProvedor, 'Perfil del Provedor');

/*******productos********/
define(productosServicios, "Productos y Servicios");
define(nuevoProducto, "Nuevo Producto/Servicio");
define(listaProductosServicios, "Lista de Productos/Servicios");
define(listaProductos, "Lista de Productos");
define(detalleProducto, "Detalle del Producto/Servicio");



/**************[POS DE VENTAS]**********************/

define(ventas, "Ventas");
define(postVentas, "Pos de Ventas");
define(facturaCliente, "Factura");

/*----------  PUNTOS DE VENTA  ----------*/
define(puntosVenta, "Puntos de Venta");
define(nuevoPuntoVenta, "Nuevo Punto De Venta");
define(listaPuntosVenta, "Lista De Puntos De Venta");
define(adminPuntoVenta, 'Administración de Punto De Venta');



//*********contabilidad*************//

define(contabilidad, "Contabilidad");
define(cajas, "Cajas");
define(aperturaYCierreCaja, "Apertura y Cierre de Caja");
define(gastos, "Gastos y Egresos");
define(listaGastos, "Lista de Gastos");
define(listaFacturas, "Lista de Gastos");
define(tusFacturas, "Facturas");
define(tusCuentasCobro, "Tus Cuentas de Cobro");
define(facturaProvedor, "Factura Del Provedor ");
define(historialVentas, 'Historico de Ventas');
define(hojaHistorialVentas, 'Historial de movimientos de ');
define(misBancos, "Mis Bancos");
define(productoBancario, "Productos Bancarios");
define(cuentasPorPagar, "Cuentas por Pagar");
define(facturasCuentascobro, "Facturas y Cuentas de Cobro");
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


/*----------  TEXTOS  ----------*/
define(txtSinSubCategoria, "Sin SubCategoría");


?>