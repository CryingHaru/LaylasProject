<script src='../../assets/js/sweetalert2.all.min.js'></script>
<head><link rel="stylesheet" href="/assets/css/bootstrap.css"></head>
<body>

</body>
<?php
//Clase para la conexion
include_once "../../config/server_connection.php";
//Instancia de la clase de conexion
$server = new ServerConnection();
//QUERY para insertar los datos
$nombre = @$_POST['nombre'];
$id_marca = @$_POST['id_marca'];
$id_categoria = @$_POST['id_categoria'];
$detalles = @$_POST['detalles'];
$precio_venta = @$_POST['precio_venta'];
$existencias = @$_POST['existencias'];
$imagen = @$_POST['imagen'];
$imageurl = "";
if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $valid = getimagesize($_FILES['imagen']['tmp_name']);
    if (!$valid) {
        echo "<script>
        Swal.fire({
            title: 'Error al registrar',
            text: 'El archivo seleccionado no es una imagen',
            icon: 'error',
            confirmButtonText: 'Aceptar',
          
        }).then(() => {
            window.location.href = 'form_nuevo.php';
        });
    </script>
        ";
        exit();
    }
    $name = "prod_" . date("YmdHis");
    $type = "." . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $newLocation = '../../assets/images/img_productos/' . $name . $type;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $newLocation)) {
        $imagen = file_get_contents($newLocation);
        $imageurl = $newLocation;
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "No file was uploaded.";
}




if ($nombre == '' || $id_marca == '' || $id_categoria == '' || $detalles == '' || $precio_venta == '' || $existencias == '' ) {
    echo "<script>
        Swal.fire({
            title: 'Error al registrar',
            text: 'Todos los campos son obligatorios',
            icon: 'error',
            confirmButtonText: 'Aceptar',
          
        }).then(() => {
            window.location.href = 'form_nuevo.php';
        });
    </script>
        ";
    exit();
}

//Ejecutar la consulta
$server->query = "INSERT INTO tbl_productos (nombre, id_marca, id_categoria, detalles, precio_venta, existencias, imagen) 
    VALUES (
        '$nombre',
        '$id_marca',
        '$id_categoria',
        '$detalles',
        '$precio_venta',
        '$existencias',
        '$imageurl')";
$server->execute_query();
$con = new ServerConnection();
$con->query = "SELECT MAX(id_producto) as id_producto FROM tbl_productos";
$dt_last = $con->get_records();
$id_producto = $dt_last[0]['id_producto'];

echo "<script>
    Swal.fire({
        title: 'Producto registrado',
        text: 'El producto ha sido registrado con éxito',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        timer: 3000
    }).then(() => {
        window.location.href = 'form_detalles.php?id=$id_producto';
    });
</script>";
