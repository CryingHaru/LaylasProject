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
            text: 'No se ha seleccionado una marca',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        }).then(() => {
            window.location.href = 'form_listar.php';
        });
    </script>
        ";
    exit();
}
$server = new ServerConnection();
$server->query = "DELETE FROM tbl_marcas WHERE id_marca = $id";
$server->execute_query();

echo "<script>
    Swal.fire({
        title: 'Marca eliminada',
        text: 'La marca ha sido eliminada con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_listar.php';
    });
</script>";
