<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create([
            'name' => 'Admin',
        ]);   
        $role2 =Role::create([
            'name' => 'Cajero',
        ]);  
        $role3 = Role::create([
            'name' => 'Comercial',
        ]);  


// Rutas para manejar productos
$permissionsProductos = [
    'verActualizarPorduct', 'verImagen', 'deletePorduct',
    'indexPorduct', 'postPorduct', 'updatedProducto'
];
foreach ($permissionsProductos as $permissionProducto) {
    Permission::create(['name' => $permissionProducto])->syncRoles([$role1]);
}

// Rutas para manejar clientes
$permissionsClientes = ['postClient', 'verActualizar', 'verActualizarClient', 'deleteClient', 'indexClient', 'updatedClient'];
foreach ($permissionsClientes as $permissionCliente) {
    Permission::create(['name' => $permissionCliente])->syncRoles([$role1]);
}

// Rutas para manejar ventas
$permissionsVentas = ['indexVentas', 'cart.add', 'cart.barcode', 'cart.checkout', 'cart.clear', 'cart.removeitem', 'cart.actualizar'];
foreach ($permissionsVentas as $permissionVenta) {
    Permission::create(['name' => $permissionVenta])->syncRoles([$role1]);
}

// Rutas para manejar entradas
$permissionsEntradas = ['product.entradas', 'product.formulario', 'product.buscar', 'product.store'];
foreach ($permissionsEntradas as $permissionEntrada) {
    Permission::create(['name' => $permissionEntrada])->syncRoles([$role1]);
}

// Rutas para manejar facturación
$permissionsFacturacion = ['facturacionView', 'abonar', 'Abono', 'factura', 'historial', 'facturacion', 'historial.abonos'];
foreach ($permissionsFacturacion as $permissionFacturacion) {
    Permission::create(['name' => $permissionFacturacion])->syncRoles([$role1]);
}

// Rutas para manejar tiendas
$permissionsTiendas = ['indexTienda', 'indexTiendas', 'storeTienda', 'showTiendas'];
foreach ($permissionsTiendas as $permissionTienda) {
    Permission::create(['name' => $permissionTienda])->syncRoles([$role1]);
}

// Rutas para manejar proveedores
$permissionsProveedores = ['indexProveedore', 'store.proveedore', 'edit.proveedore', 'update.proveedore', 'delete.Proveedore', 'show.proveedore'];
foreach ($permissionsProveedores as $permissionProveedor) {
    Permission::create(['name' => $permissionProveedor])->syncRoles([$role1]);
}

// Ruta para el historial de abonos
Permission::create(['name' => 'tabla.abonos'])->syncRoles([$role1]);
    }
}
