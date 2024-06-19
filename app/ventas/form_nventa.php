<?php
require_once '../../config/server_connection.php';
$state = $_GET['state'];
$server = new ServerConnection();

if ($state == "n") {
    $query = "INSERT INTO tbl_cab_ventas (`fecha`, `id_cliente`, `estado`) VALUES (SYSDATE(), 1,1);";
    $server->query = $query;
    $server->execute_query();
    $conn = new ServerConnection();
    $conn->query = "SELECT MAX(id_cab_venta) AS id FROM tbl_cab_ventas";
    $id_venta = $conn->get_records();
    $last = $id_venta[0]['id'];
    header("Location: form_nuevo.php?id={$last}");
}
if ($state == "d") {
    $id = $_GET['id'];
    // Actualizar stock
    $server->query = "SELECT cantidad, id_producto FROM tbl_det_ventas WHERE id_cab_venta = $id";
    $datos = $server->get_records();
    if ($datos) {
        foreach ($datos as $dato) {
            $cantidad = $dato['cantidad'];
            $producto = $dato['id_producto'];
    
            $server->query = "UPDATE tbl_productos SET existencias = existencias + $cantidad WHERE id_producto = $producto";
            $server->execute_query();
        }
    
        $server->query = "DELETE FROM tbl_det_ventas WHERE id_cab_venta = $id";
        $server->execute_query();
    }
    
    // Eliminar cabecera de venta, independientemente de si había detalles o no
    $server->query = "DELETE FROM tbl_cab_ventas WHERE id_cab_venta = $id";
    $server->execute_query();
    
    header("Location: form_listar.php");
}
if ($state == "u") {
    $id = $_GET['id'];
    $id_cliente = $_POST['nombre_cliente'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $query = "UPDATE tbl_cab_ventas SET id_cliente = $id_cliente, fecha = '$fecha', estado = $estado WHERE id_cab_venta = $id";
    $server->query = $query;
    $server->execute_query();
    header("Location: form_nuevo.php?id={$id}");
}

if ($state== "s"){
    //guardar
    $id = $_GET['id'];
    //calcula el total
    $server->query = "SELECT SUM(precio_unitario*cantidad) AS total FROM tbl_det_ventas WHERE id_cab_venta = $id";
    $total = $server->get_records();
    $total = $total[0]['total'];
    //actualiza el total
    $server->query = "UPDATE tbl_cab_ventas SET total = $total WHERE id_cab_venta = $id";
    $server->execute_query();
    header("Location: form_listar.php");


}