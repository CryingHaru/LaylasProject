<?php

$id = $_GET['id'];
include_once "../../config/server_connection.php";
$con = new ServerConnection();
$con->query = "SELECT * FROM tbl_marcas WHERE id_marca = $id";
$dt_marca = $con->get_records();
$nombre = $dt_marca[0]['nombre'];

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
                <h4 class="page-header">Módulo Marcas</h4>
            </div>
            <div class="ms-auto">
                <a href="./form_listar.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle-fill"></i> Regresar</a>
                <a href="./form_editar.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</a>
                <a href="#" onclick="eliminar()" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Eliminar</a>
            </div>
        </div>
        <div class="card text-dark bg-light mb-3 card-shadow">
            <div class="card-header"><strong>Detalles de la Marca</strong></div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2 col-form-label">
                        <label for="nombre" class="form-label">Nombre:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" disabled>
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
<script>
    function eliminar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!',
            timer: 5000,
            focusCancel: true,
            CancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `./proc_eliminar.php?id=<?php echo $id; ?>`;
            }
        });

    }
</script>