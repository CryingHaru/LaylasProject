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
$server->query = "INSERT INTO tbl_marcas (nombre) 
    VALUES (
        '$nombre')";

$server->execute_query();
$con = new ServerConnection();
$con->query = "SELECT MAX(id_marca) as id_marca FROM tbl_marcas";
$dt_last = $con->get_records();
$id_marca = $dt_last[0]['id_marca'];

echo "<script>
    Swal.fire({
        title: 'Marca registrada',
        text: 'La marca ha sido registrada con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_detalles.php?id=$id_marca';
    });
</script>";
?>