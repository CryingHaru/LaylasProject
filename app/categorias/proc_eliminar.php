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
            text: 'No se ha seleccionado una categoria',
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
$server->query = "DELETE FROM tbl_categorias WHERE id_categoria = $id";
$server->execute_query();

echo "<script>
    Swal.fire({
        title: 'Categoria eliminada',
        text: 'La categoria ha sido eliminada con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_listar.php';
    });
</script>";
