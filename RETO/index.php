<?php 

require_once './clases/Producto.php';
require_once './clases/Inventario.php';
require_once './clases/Ventas.php';

    function displayMenu(){
        echo "---- Menu de la Tiendita ---- \n";
        echo "1. Agregar nuevo producto \n";
        echo "2. Eliminar producto \n";
        echo "3. Actualizar producto \n";
        echo "4. Generar Venta \n";
        echo "5. Generar informe \n";
        echo "6. Salir \n";
        echo "Seleccione una opcion: ";
    }

    function prompt($mensaje){
        echo $mensaje;
        $input = trim(fgets(STDIN));
        return $input;
    }

    $inventario = new Inventario([]);
    
    $flag = true;
    $idProducto = 0;
    $idVenta = 0;
    while($flag){
        displayMenu();
       $opcion = prompt("");
        switch($opcion){
            case 1: 
                //Obtenemos valores de producto a traves del uso de prompt (funcion para obtener valores de la terminal)
                $idProducto = $idProducto+1;
                $nombre = prompt("Ingrese el nombre del producto:\n");
                $descripcion = prompt("Ingrese la descripcion del producto:\n");
                $precio = prompt("Ingrese el precio del producto:\n");
                $cantidad = prompt("Ingrese la cantidad del producto:\n");
                $categoria = prompt("Ingrese la categoria de su producto: \n");
                $proveedor = prompt("Ingrese quien es el proveedor de su producto: \n");
                //Creamos nuevo producto con los valores recibidos por prompt
                $producto = new Producto($idProducto,$nombre,$descripcion,$precio,$cantidad,$proveedor,$categoria);
                
                //Agregamos el nuevo producto a nuestro inventario
                $inventario->agregarProducto($producto);
                echo "Ingresaste el siguiente producto: \n";
                print_r($inventario);
                break;
            case 2: 
                $id = prompt("Ingrese el id del producto a eliminar: \n");
                $inventario->eliminarProducto($id);
                echo "Eliminaste el producto con id: $id \n";
                break;
            case 3:
                $id = prompt("Ingrese el id del producto a actualizar: \n");
                $producto = $inventario->buscarProductoPorId($id);
                $nombre = prompt("Ingrese el nuevo nombre del producto:\n");
                $descripcion = prompt("Ingrese la nueva descripcion del producto:\n");
                $precio = prompt("Ingrese el nuevo precio del producto:\n");
                $categoria = prompt("Ingrese la nueva categoria de su producto: \n");
                $datos = ['nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'categoria' => $categoria];
                $producto->editarProducto($datos);
                break;
            case 4: 
                $idVenta = $idVenta+1;
                $productos = [];
                while(true){
                    $id = prompt("Ingrese el id del producto a vender: \n");
                    $producto = $inventario->buscarProductoPorId($id);
                    if($producto AND $producto->getStock() > 0){
                        $productos[] = $producto;
                    }else{
                        echo "No es posible agregar este producto \n";
                    }
                    $continuar = prompt("Desea agregar otro producto a la venta? (s/n) \n");
                    if($continuar === 'n'){
                        break;
                    }
                }
                $venta = new Venta($idVenta, $productos);
                $venta->calcularTotal();
                echo "El total de la venta es: $".$venta->getTotal()."\n";
                break;
            case 5:
                $inventario->generarInforme();
                break;
            case 6:
                echo "Estas saliendo ... \n";
                $flag = false;
                break;

            default: 
            echo "Seleccione una opcion valida \n";

        }


    }
?>
