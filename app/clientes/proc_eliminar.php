<script src='../../assets/js/sweetalert2.all.min.js'></script>

<body>

</body>
<?php

$id = $_GET['id'];
include_once "../../config/server_connection.php";
if ($id == '') {
    echo "<script>
        Swal.fire({
            title: 'Error al eliminar',
            text: 'No se ha seleccionado un cliente',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        }).then(() => {
            window.location.href = 'listado.php';
        });
    </script>
        ";
    exit();
}
$server = new ServerConnection();
$server->query = "DELETE FROM tbl_clientes WHERE id_cliente = $id";
$server->execute_query();

echo "<script>
    Swal.fire({
        title: 'Cliente eliminado',
        text: 'El cliente ha sido eliminado con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_listar.php';
    });
</script>";
