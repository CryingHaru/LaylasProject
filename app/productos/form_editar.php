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
  tbl_marcas.id_marca AS id_marca,
  tbl_categorias.id_categoria AS id_categoria
FROM
  tbl_productos
  INNER JOIN tbl_marcas ON tbl_productos.id_marca = tbl_marcas.id_marca
  INNER JOIN tbl_categorias ON tbl_productos.id_categoria = tbl_categorias.id_categoria
WHERE
  tbl_productos.id_producto = $id";
$dt_producto = $server->get_records();
$nombre = $dt_producto[0]['nombre'];
$nombre_marca = $dt_producto[0]['id_marca'];
$nombre_categoria = $dt_producto[0]['id_categoria'];
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
    <form name="form_editar" action="proc_actualizar.php" method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="d-flex align-items-center mb-3">
        <div>
          <h4 class="page-header">Módulo de Productos</h4>
        </div>
        <div class="ms-auto">
          <a href="#" onclick="guardar()" class="btn btn-success"><i class="bi bi-floppy2-fill"></i> Guardar</a>
          <a href="form_listar.php" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
          <a href="../../index.php" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
        </div>
      </div>
      <div class="card text-dark bg-light mb-3 card-shadow">
        <div class="card-header"><strong>Edición de Productos</strong></div>
        <div class="card-body">

          <div class="row mb-3">
            <label for="nombre" class="col-2 col-form-label">Nombre:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
          </div>

          <div class="row mb-3">
            <label for="nombre_marca" class="col-2 col-form-label">Marca:</label>
            <div class="col-10">
              <select class="form-select" name="id_marca" id="id_marca">
                <?php
                foreach ($marcas as $marca) {
                  $selected = $marca['id_marca'] == $nombre_marca ? 'selected' : '';
                  echo "<option value='" . $marca['id_marca'] . "' $selected>" . $marca['nombre'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="nombre_categoria" class="col-2 col-form-label">Categoría:</label>
            <div class="col-10">
              <select class="form-select" name="id_categoria" id="id_categoria">
                <?php
                foreach ($categorias as $categoria) {
                  $selected = $categoria['id_categoria'] == $nombre_categoria ? 'selected' : '';
                  echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['nombre'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="detalles" class="col-2 col-form-label">Detalles:</label>
            <div class="col-10">
              <textarea class="form-control" name="detalles" id="detalles"><?php echo $detalles; ?></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label for="precio_venta" class="col-2 col-form-label">Precio de Venta:</label>
            <div class="col-10">
              <input type="number" class="form-control" name="precio_venta" id="precio_venta" value="<?php echo $precio_venta; ?>">
            </div>
          </div>

          <div class="row mb-3">
            <label for="existencias" class="col-2 col-form-label">Existencias:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="existencias" id="existencias" value="<?php echo $existencias; ?>">
            </div>
          </div>

          <div class="row mb-3">
            <label for="imagen" class="col-2 col-form-label">Imagen Actual:</label>
            <div class="col-10">
              <div class="imagen_producto">
                <img src="<?php echo $imagen; ?>" alt="Imagen del producto" width="100px">
                <input type="hidden" id="imagen_bd" name="imagen_bd" value="<?php echo $imagen; ?>">
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label for="imagen" class="col-2 col-form-label">Nueva Imagen:</label>
            <div class="col-10">
              <input type="file" class="form-control-file" id="imagen" name="imagen">
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
  function guardar() {
    let nombre = document.getElementById('nombre').value;
    let id_marca = document.getElementById('id_marca').value;
    let id_categoria = document.getElementById('id_categoria').value;
    let detalles = document.getElementById('detalles').value;
    let precio_venta = document.getElementById('precio_venta').value;
    let existencias = document.getElementById('existencias').value;
    let imagen = document.getElementById('imagen').value;
    let imagen_bd = document.getElementById('imagen_bd').value;
    if (nombre == '' || id_marca == '' || id_categoria == '' || detalles == '' || precio_venta == '' || existencias == '') {
      Swal.fire({
        icon: 'warning',
        title: 'Atención',
        text: 'Todos los campos son obligatorios',
        confirmButtonText: 'Aceptar'
      });
    } else {
      if (imagen == '' && imagen_bd == '') {
        Swal.fire({
          icon: 'warning',
          title: 'Atención',
          text: 'Debe seleccionar una imagen',
          confirmButtonText: 'Aceptar'
        });
      } else {
        document.form_editar.submit();
      }
    }
  }
</script>
