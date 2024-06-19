<script src='../../assets/js/sweetalert2.all.min.js'></script>

<body>

</body>

<?php
require_once '../../config/server_connection.php';
$id_venta = $_POST['id_venta'];
$producto = $_POST['producto'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$productos = new ServerConnection();
$productos->query = "SELECT existencias FROM tbl_productos WHERE id_producto = '$producto'";
$resultado_producto = $productos->get_records();

$stock = $resultado_producto[0]['existencias'];
if ($stock < $cantidad) {
    echo "<script>
        Swal.fire({
            title: 'Error al agregar producto',
            text: 'No hay suficiente stock',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        }).then(() => {
            window.history.back();
        });
    </script>
        ";
    exit();
}

$server = new ServerConnection();
$query = "INSERT INTO tbl_det_ventas (id_cab_venta, id_producto, cantidad, precio_unitario) VALUES ($id_venta, $producto, $cantidad, $precio)";
$server->query = $query;
$server->execute_query();

// Actualizar stock
$server->query = "UPDATE tbl_productos SET existencias = existencias - $cantidad WHERE id_producto = $producto";
$server->execute_query();


echo "<script>
            window.location.href = 'form_nuevo.php?id={$id_venta}';
    </script>
        ";