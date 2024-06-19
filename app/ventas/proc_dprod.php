<script src='../../assets/js/sweetalert2.all.min.js'></script>

<body>

</body>
<?php
require_once '../../config/server_connection.php';
$id_venta = $_GET['idventa'];
$id = $_GET['id'];

if (!isset($id_venta) || !isset($id)) {
    echo "<script>
        Swal.fire({
            title: 'Error al eliminar producto',
            text: 'No se ha seleccionado un producto',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        }).then(() => {
            window.history.back();
        });
    </script>
        ";
}
//obtener cantidad y producto
$can = new ServerConnection();
$can->query = "SELECT cantidad, id_producto FROM tbl_det_ventas WHERE tbl_det_ventas = $id";
$datos = $can->get_records();
$cantidad = $datos[0]['cantidad'];
$producto = $datos[0]['id_producto'];

$ser = new ServerConnection();
$ser->query = "DELETE FROM tbl_det_ventas WHERE tbl_det_ventas = $id";
$ser->execute_query();

// Actualizar stock
$ser->query = "UPDATE tbl_productos SET existencias = existencias + $cantidad WHERE id_producto = $producto";
$ser->execute_query();



header("Location: form_nuevo.php?id={$id_venta}");