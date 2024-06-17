<?php
include_once "../../config/server_connection.php";
//marcas y categorias
$server = new ServerConnection();
$server->query = "SELECT * FROM tbl_marcas";
$marcas = $server->get_records();
$server->query = "SELECT * FROM tbl_categorias";
$categorias = $server->get_records();
$id = $_GET['id'];
$server->query = "SELECT
  tbl_productos.*,
  tbl_marcas.nombre AS nombre_marca,
  tbl_categorias.nombre AS nombre_categoria
FROM
  tbl_productos
  INNER JOIN tbl_marcas ON tbl_productos.id_marca = tbl_marcas.id_marca
  INNER JOIN tbl_categorias ON tbl_productos.id_categoria = tbl_categorias.id_categoria
WHERE
  tbl_productos.id_producto = $id";
$dt_producto = $server->get_records();
$nombre = $dt_producto[0]['nombre'];
$nombre_marca = $dt_producto[0]['nombre_marca'];
$nombre_categoria = $dt_producto[0]['nombre_categoria'];
$detalles = $dt_producto[0]['detalles'];
$precio_venta = $dt_producto[0]['precio_venta'];
$existencias = $dt_producto[0]['existencias'];
//si no hay imagen se coloca una por defecto
$imagen = $dt_producto[0]['imagen'] == '' ? '../../assets/images/img_productos/sin_imagen.png' : $dt_producto[0]['imagen'];


?>


<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="Layla's Salón" content="width=device-width, initial-scale=1.0">
  <title>Layla's Salón</title>
  <meta name="author" content="ITCA-FEPADE" />
  <link rel="shortcut icon" href="../../assets/images/favicon.ico">
  <!-- CSS -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/css/formularios.css">
  <!-- CSS -->
  <style type="text/css">
    .imagen_producto {
      width: 100%;
      height: 300px;
      background: transparent;
      overflow: hidden;
    }

    .imagen_producto img {
      width: auto;
      height: auto;
      background-repeat: no-repeat;
      background-size: contain;
    }

    @supports(object-fit: cover) {
      .imagen_producto img {
        height: 100%;
        object-fit: cover;
        object-position: center center;
      }
    }
  </style>
</head>

<body>

  <div class="container-fluid" style="padding-top: 10px;">
    <form name="form_detalles" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="d-flex align-items-center mb-3">
        <div>
          <h4 class="page-header">Módulo de Productos</h4>
        </div>
        <div class="ms-auto">
          <a href="form_listar.php" class="btn btn-primary"><i class="bi bi-arrow-left-circle-fill"></i> Regresar</a>
          <a href="form_editar.php?id=<?php echo $id;?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</a>
          <a href="#" onclick="eliminar()" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Eliminar</a>
          <a href="../../index.php" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
        </div>
      </div>
      <div class="card text-dark bg-light mb-3 card-shadow">
        <div class="card-header"><strong>Registro de Nuevos Productos</strong></div>
        <div class="card-body">

          <div class="row mb-3">
            <label for="nombre" class="col-2 col-form-label">Nombre:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label for="nombre_marca" class="col-2 col-form-label">Marca:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="nombre_marca" id="nombre_marca" value="<?php echo $nombre_marca; ?>" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label for="nombre_categoria" class="col-2 col-form-label">Categoría:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="nombre_categoria" id="nombre_categoria" value="<?php echo $nombre_categoria; ?>" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label for="detalles" class="col-2 col-form-label">Detalles:</label>
            <div class="col-10">
              <textarea class="form-control" name="detalles" id="detalles" disabled><?php echo $detalles; ?></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label for="precio_venta" class="col-2 col-form-label">Precio de Venta:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="precio_venta" id="precio_venta" value="<?php echo $precio_venta; ?>" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label for="existencias" class="col-2 col-form-label">Existencias:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="existencias" id="existencias" value="<?php echo $existencias; ?>" disabled>
            </div>

            <div class="row mb-3">
              <label for="imagen" class="col-2 col-form-label">Imagen:</label>
              <div class="col-10">
                <div class="imagen_producto">
                  <img src="<?php echo $imagen; ?>" alt="Imagen del producto" width="100px">
                </div>
              </div>
            </div>

          </div>
        </div>
    </form>
  </div>

</body>

</html>

<!-- JS -->
<script src="../../assets/js/pooper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/sweetalert2.all.min.js"></script>
<!-- JS -->
<script>
  function eliminar() {
    Swal.fire({
      title: '¿Estás seguro?',
      text: "¡No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminarlo!',
      timer: 5000,
      focusCancel: true,
      CancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `./proc_eliminar.php?id=<?php echo $id; ?>`;
      }
    });

  }
</script>