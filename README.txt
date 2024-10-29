Hola, mi nombre es Martin.

Este sistema esta creado como un proyecto personal para mejorar mis capacidades en la programacion en el lenguaje php.

Se trata de un sistema de gestion de ventas con un control de stock.

El mismo consta de un login para el administrador o los representantes de ventas.

Funcionalidades

1. Gestión de productos (Administrador):

CRUD de productos:
El administrador podrá crear, editar, y eliminar productos del inventario.
Al crear un producto, se incluirá: nombre, descripción, precio, categoría, y stock.
Al modificar, podrá ajustar la cantidad en stock manualmente.
Listar productos: Visualización completa del inventario.

2. Gestión de clientes (Vendedor):

Crear clientes: 
El vendedor podrá registrar nuevos clientes.

Listar clientes: 
El vendedor verá la lista de clientes existentes y podrá seleccionarlos para asociar una compra.

3. Gestión de ventas (Vendedor):

Registrar ventas:
El vendedor puede seleccionar un cliente y añadir los productos que comprará, seleccionando las cantidades.
El sistema descontará automáticamente del stock del inventario.

Historial de ventas:
El vendedor podrá ver un listado de las ventas realizadas, detallando el cliente, los productos vendidos, las cantidades y la fecha.

4. Control de stock (Administrador):

Modificación del stock:
Si hay productos que ingresan al inventario (por compra de proveedores, etc.), el administrador podrá actualizar manualmente el stock.


### Despliegue del sitio

- Clone el repositorio con git clone (url)
- Iniciar Apache y MySQL
- Ir a phpMyAdmin y crear base de datos con nombre stockear
- Importar la base de datos en la carpeta database
- En XAMPP, haga click en explorer y seleccione htdocs
- Pase el repositorio clonado a la carpeta htdocs
- Ir a su navegador de preferencia e ingresar a localhost/stockear
- Logearse
- Disfrutar la aplicacion

### Usuario y contraseña del admin
- user: webadmin
- contraseña: admin123