<?php
//marcas y categorias
require_once '../../config/server_connection.php';
$server = new ServerConnection();
$server->query = "SELECT * FROM tbl_marcas";
$marcas = $server->get_records();
$server->query = "SELECT * FROM tbl_categorias";
$categorias = $server->get_records();
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
</head>

<body>

  <div class="container-fluid" style="padding-top: 10px;">
    <form name="form_nuevo" action="proc_agregar.php" method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="d-flex align-items-center mb-3">
        <div>
          <h4 class="page-header">Módulo de Productos</h4>
        </div>
        <div class="ms-auto">
          <a href="#" class="btn btn-success" onclick="guardar()"><i class="bi bi-floppy2-fill"></i> Guardar</a>
          <a href="form_listar.php" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
          <a href="../../index.php" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
        </div>
      </div>
      <div class="card text-dark bg-light mb-3 card-shadow">
        <div class="card-header"><strong>Registro de Nuevos Productos</strong></div>
        <div class="card-body">

          <div class="row mb-3">
            <label for="nombre" class="col-2 col-form-label">Nombre:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
          </div>

          <div class="row mb-3">
            <label for="id_marca" class="col-2 col-form-label">Marca:</label>
            <div class="col-10">
              <select class="form-select" name="id_marca" id="id_marca">
                <option value="">Seleccione...</option>
                <?php
                foreach ($marcas as $marca) {
                  echo "<option value='" . $marca['id_marca'] . "'>" . $marca['nombre'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="id_categoria" class="col-2 col-form-label">Categoría:</label>
            <div class="col-10">
              <select class="form-select" name="id_categoria" id="id_categoria">
                <option value="">Seleccione...</option>
                <?php
                foreach ($categorias as $categoria) {
                  echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre'] . "</option>";
                }
                ?>

              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="detalles" class="col-2 col-form-label">Detalles:</label>
            <div class="col-10">
              <textarea class="form-control" name="detalles" id="detalles"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label for="precio_venta" class="col-2 col-form-label">Precio de Venta:</label>
            <div class="col-10">
              <input type="number" class="form-control" name="precio_venta" id="precio_venta">
            </div>
          </div>

          <div class="row mb-3">
            <label for="existencias" class="col-2 col-form-label">Existencias:</label>
            <div class="col-10">
              <input type="number" class="form-control" name="existencias" id="existencias">
            </div>
          </div>

          <div class="row mb-3">
            <label for="imagen" class="col-2 col-form-label">Imagen:</label>
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

<!-- -------------------- Validaciones de ingreso de datos -------------------- -->

<script>
  function guardar() {
    var nombre = document.getElementById('nombre').value;
    var id_marca = document.getElementById('id_marca').value;
    var id_categoria = document.getElementById('id_categoria').value;
    var detalles = document.getElementById('detalles').value;
    var precio_venta = Number(document.getElementById('precio_venta').value)
    if (precio_venta <= 0 || isNaN(precio_venta)) {
      Swal.fire({
        title: 'Error al registrar',
        text: 'El precio de venta debe ser mayor a 0',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        timer: 3000
      }).then(() => {

      });
      return;
    }
    var existencias = Number(document.getElementById('existencias').value)
    if (existencias < 0 || isNaN(existencias)) {
      Swal.fire({
        title: 'Error al registrar',
        text: 'Las existencias deben ser mayor o igual a 0',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        timer: 3000
      }).then(() => {

      });
      return;
    }

    var imagen = document.getElementById('imagen').value;

    if (nombre == '' || id_marca == '' || id_categoria == '' || detalles == '' || precio_venta == '' || existencias == '') {
      Swal.fire({
        title: 'Error al registrar',
        text: 'Todos los campos son obligatorios',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        timer: 3000
      }).then(() => {

      });
      return;
    }

    document.form_nuevo.submit();
  }
</script>