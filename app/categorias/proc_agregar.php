<script src='../../assets/js/sweetalert2.all.min.js'></script>

<body>

</body>
<?php
//Clase para la conexion
include_once "../../config/server_connection.php";
//Instancia de la clase de conexion
$server = new ServerConnection();
//QUERY para insertar los datos
$nombre = @$_POST['nombre'];

if ($nombre == '') {
    echo "<script>
        Swal.fire({
            title: 'Error al registrar',
            text: 'Todos los campos son obligatorios',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        }).then(() => {
            window.location.href = 'form_nuevo.php';
        });
    </script>
        ";
    exit();
}


//Ejecutar la consulta
$server->query = "INSERT INTO tbl_categorias (nombre) 
    VALUES (
        '$nombre')";

$server->execute_query();
$con = new ServerConnection();
$con->query = "SELECT MAX(id_categoria) as id_categoria FROM tbl_categorias";
$dt_last = $con->get_records();
$id_categoria = $dt_last[0]['id_categoria'];

echo "<script>
    Swal.fire({
        title: 'Categoria registrada',
        text: 'La categoria ha sido registrada con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_detalles.php?id=$id_categoria';
    });
</script>";
?>