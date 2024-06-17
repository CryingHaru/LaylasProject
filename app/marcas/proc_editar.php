<script src='../../assets/js/sweetalert2.all.min.js'></script>

<body>

</body>
<?php
include_once "../../config/server_connection.php";
$id = $_POST['id'];
$nombre = $_POST['nombre'];

if ($nombre == '') {
    echo "<script>
        Swal.fire({
            title: 'Error al actualizar',
            text: 'Todos los campos son obligatorios',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        }).then(() => {
            window.location.href = 'form_editar.php?id=$id';
        });
    </script>
        ";
    exit();
}

$server = new ServerConnection();
$server->query = "UPDATE tbl_marcas SET nombre = '$nombre' WHERE id_marca = $id";
$server->execute_query();

echo "<script>
    Swal.fire({
        title: 'Marca actualizada',
        text: 'La marca ha sido actualizado con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_detalles.php?id=$id';
    });
</script>";
?>