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
            text: 'No se ha seleccionado un producto',
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
$server->query = "DELETE FROM tbl_productos WHERE id_producto = $id";
$server->execute_query();
//delete image in temp folder
//check if file exists


echo "<script>
    Swal.fire({
        title: 'Producto eliminado',
        text: 'El producto ha sido eliminado con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_listar.php';
    });
</script>";
