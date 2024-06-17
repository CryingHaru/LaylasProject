<?php

$id = $_GET['id'];
include_once "../../config/server_connection.php";
$con = new ServerConnection();
$con->query = "SELECT * FROM tbl_clientes WHERE id_cliente = $id";
$dt_cliente = $con->get_records();
$nombre = $dt_cliente[0]['nombre'];
$direccion = $dt_cliente[0]['direccion'];
$telefono = $dt_cliente[0]['telefono'];
$dui_nit = $dt_cliente[0]['dui_nit'];

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
                <h4 class="page-header">Módulo Clientes</h4>
            </div>
            <div class="ms-auto">
                <a href="#" onclick="window.history.back()" class="btn btn-secondary"><i class="bi bi-arrow-left-circle-fill"></i> Regresar</a>
                <a href="#" onclick="guardar()" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Guardar</a>
                <a href="#" onclick="eliminar()" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Eliminar</a>
            </div>
        </div>
        <div class="card text-dark bg-light mb-3 card-shadow">
            <div class="card-header"><strong>Edición de Cliente</strong></div>
            <form action="proc_editar.php" method="post" autocomplete="off">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-2 col-form-label">
                            <label for="nombre" class="form-label">Nombre:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="id" hidden value="<?php echo $id ?>">
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-2 col-form-label">
                            <label for="direccion" class="form-label">Dirección:</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" name="direccion" id="direccion"><?php echo $direccion; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-form-label">
                            <label for="telefono" class="form-label">Teléfono:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="tel" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-2 col-form-label">
                            <label for="dui_nit" class="form-label">DUI/NIT:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="dui_nit" id="dui_nit" value="<?php echo $dui_nit; ?>">
                        </div>
                    </div>
                </div>
            </form>
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
                window.location.href = `../../controllers/clientes/proc_eliminar.php?id=<?php echo $id; ?>`;
            }
        });
    }

    function guardar() {
        let nombre = document.getElementById('nombre').value;
        let direccion = document.getElementById('direccion').value;
        let telefono = document.getElementById('telefono').value;
        let dui_nit = document.getElementById('dui_nit').value;
        let form = document.forms[0];

        const campos = ['nombre', 'direccion', 'telefono', 'dui_nit'];
        const valores = {
            nombre,
            direccion,
            telefono,
            dui_nit
        };

        for (let campo of campos) {
            if (valores[campo] == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `El campo ${campo} es obligatorio`,
                    timer: 3000
                });
                return;
            }
        }
        form.submit();
    }
</script>