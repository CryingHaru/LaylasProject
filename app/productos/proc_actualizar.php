<script src='../../assets/js/sweetalert2.all.min.js'></script>

<head>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
</head>

<body>

</body>

<?php
include_once "../../config/server_connection.php";

$nombre = $_POST['nombre'];
$marca = $_POST['id_marca'];
$categoria = $_POST['id_categoria'];
$detalles = $_POST['detalles'];
$precio_venta = $_POST['precio_venta'];
$existencias = $_POST['existencias'];
$imagen = $_POST['imagen_bd'];
$id_producto = $_POST['id'];

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
            </script>";
        exit();
    }

    $name = "prod_" . date("YmdHis");
    $type = "." . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $newLocation = '../../assets/images/img_productos/' . $name . $type;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $newLocation)) {
        $imageurl = file_get_contents($newLocation);
        $imagen = $newLocation;
    } else {
        echo "Failed to move uploaded file.";
    }
}

$server = new ServerConnection();
$query = "UPDATE tbl_productos 
SET nombre = '$nombre',
    id_marca = $marca,
    id_categoria = $categoria,
    detalles = '$detalles',
    precio_venta = $precio_venta,
    existencias = $existencias,
    imagen = '$imagen'
WHERE id_producto = $id_producto";

$server->query = $query;
$server->execute_query();

echo "<script>
        Swal.fire({
            title: 'Registro exitoso',
            text: 'El producto se ha actualizado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar',
        }).then(() => {
            window.location.href = 'form_listar.php';
        });
    </script>";
