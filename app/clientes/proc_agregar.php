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
$direccion = @$_POST['direccion'];
$telefono = @$_POST['telefono'];
$dui_nit = @$_POST['dui_nit'];
if ($nombre == '' || $direccion == '' || $telefono == '' || $dui_nit == '') {
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
$server->query = "INSERT INTO tbl_clientes (nombre, direccion, telefono, dui_nit) 
    VALUES (
        '$nombre', 
        '$direccion', 
        '$telefono', 
        '$dui_nit')";

$server->execute_query();


$con = new ServerConnection();
$con->query = "SELECT MAX(id_cliente) as id_cliente FROM tbl_clientes";
$dt_last_client = $con->get_records();
$id_cliente = $dt_last_client[0]['id_cliente'];

echo "<script>
    Swal.fire({
        title: 'Cliente registrado',
        text: 'El cliente ha sido registrado con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_detalles.php?id=$id_cliente';
    });
</script>";
?>