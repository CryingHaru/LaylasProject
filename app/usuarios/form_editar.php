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
    <form name="form_editar" action="" method="post" autocomplete="off">
      <div class="d-flex align-items-center mb-3">
        <div>
          <h4 class="page-header">Módulo de Usuarios</h4>
        </div>
        <div class="ms-auto">
          <a href="#" class="btn btn-success"><i class="bi bi-floppy2-fill"></i> Guardar Cambios</a>
          <a href="" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Cancelar Cambios</a>
          <a href="#" class="btn btn-primary"><i class="bi bi-key-fill"></i> Restablecer Contraseña</a>
          <a href="#" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Eliminar</a>
          <a href="" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
        </div>
      </div>
      <div class="card text-dark bg-light mb-3 card-shadow">
        <div class="card-header"><strong>Edición de Usuarios</strong></div>
        <div class="card-body">

          <div class="row mb-3">
            <label for="nombre_completo" class="col-2 col-form-label">Nombre Completo:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="usuario" class="col-2 col-form-label">Nombre de Usuario:</label>
            <div class="col-10">
              <input type="text" class="form-control" name="usuario" id="usuario" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="dui_nit" class="col-2 col-form-label">Tipo de Cuenta:</label>
            <div class="col-10">
              <select class="form-select" name="tipo_cuenta" id="tipo_cuenta">
                <option value=""></option>
                <option value="Administrador">Administrador</option>
                <option value="Usuario Limitado">Usuario Limitado</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>

</body>

</html>

<!-- JS -->
<script src=" ../../assets/js/pooper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/sweetalert2.all.min.js"></script>
<!-- JS -->

<!-- -------------------- Validaciones de ingreso de datos -------------------- -->