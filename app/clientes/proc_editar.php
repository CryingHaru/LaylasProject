<script src='../../assets/js/sweetalert2.all.min.js'></script>

<body>

</body>
<?php
include_once "../../config/server_connection.php";
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$dui_nit = $_POST['dui_nit'];

if ($nombre == '' || $direccion == '' || $telefono == '' || $dui_nit == '') {
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
$server->query = "UPDATE tbl_clientes SET nombre = '$nombre',direccion = '$direccion',telefono = '$telefono',dui_nit = '$dui_nit' WHERE id_cliente = $id";
$server->execute_query();

echo "<script>
    Swal.fire({
        title: 'Cliente actualizado',
        text: 'El cliente ha sido actualizado con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_detalles.php?id=$id';
    });
</script>";
?>