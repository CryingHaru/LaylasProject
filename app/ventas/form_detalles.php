<?php
$id = $_GET['id'];
require_once '../../config/server_connection.php';
$server = new ServerConnection();

$server->query = "SELECT * FROM tbl_cab_ventas";
$ventas = $server->get_records();
$conn = new ServerConnection();
$conn->query = "SELECT * FROM tbl_clientes";
$clientes = $conn->get_records();

$connner = new ServerConnection();
$connner->query = "SELECT * FROM tbl_productos";
$productos = $connner->get_records();
?>


<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="Layla's Salón" content="width=device-width, initial-scale=1.0">
    <title>Layla's Salón</title>
    <meta name="author" content="ITCA-FEPADE" />
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/formularios.css">
    <!-- CSS -->
</head>

<body>

    <div class="container-fluid" style="padding-top: 10px;">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h4 class="page-header">Módulo de Ventas</h4>
            </div>
            <div class="ms-auto">
                <a href="form_listar.php" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
                <a href="form_nventa.php?state=d&id=<?php echo $id; ?>" class="btn btn-danger"><i
                        class="bi bi-x-circle-fill"></i> Eliminar</a>
            </div>
        </div>
        <div class="card text-dark bg-light mb-3 card-shadow">
            <div class="card-header"><strong>Detalles de venta</strong></div>
            <div class="card-body">

                <div class="row mb-3">
                    <form name="cabupd" action="form_nventa.php?state=u&&id=<?php echo $id ?>" method="post" style="display: flex;flex-direction: row;margin:0;">
                        <div class="col-6 ml-1">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php
                            foreach ($clientes as $cliente) {
                                if ($cliente['id_cliente'] == $ventas[0]['id_cliente']) {
                                    echo htmlspecialchars($cliente['nombre'], ENT_QUOTES, 'UTF-8');
                                    break; // Salir del bucle una vez que se encuentra el cliente correcto
                                }
                            }
                            ?>" disabled>
                        </div>
                        <div class="col-4 ml-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" disabled class="form-control" name="fecha" id="fecha""
                                value="<?php echo $ventas[0]['fecha'] ?>">
                        </div>
                        <div class="col-2">
                            <label for="estado" class="form-label">Estado:</label>
                           <?php if ($ventas[0]['estado'] == '1') { ?>
                            <input type="text" class="form-control " name="estado" id="estado" value="Abierto" disabled>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="estado" id="estado" value="Cerrado" disabled>
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $server->query = "SELECT tbl_productos.nombre AS nombre, tbl_det_ventas.* FROM tbl_det_ventas INNER JOIN tbl_productos ON tbl_det_ventas.id_producto = tbl_productos.id_producto WHERE id_cab_venta = $id";
                            $detalles = $server->get_records();
                            $total = 0;
                            foreach ($detalles as $detalle) {
                                $subtotal = $detalle['precio_unitario'] * $detalle['cantidad'];
                                $total += $subtotal;
                                echo "<tr>";
                                echo "<td>{$detalle['nombre']}</td>";
                                echo "<td>{$detalle['precio_unitario']}</td>";
                                echo "<td>{$detalle['cantidad']}</td>";
                                echo "<td>$subtotal</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <h4>Total: $<?php echo $total ?></h4>
                    </div>
                </div>
            </div>
        </div>




</body>

</html>

<!-- JS -->
<script src="../../assets/js/pooper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/sweetalert2.all.min.js"></script>
<!-- JS -->