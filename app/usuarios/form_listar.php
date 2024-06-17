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
    <div class="d-flex align-items-center mb-3">
      <div>
        <h4 class="page-header">Módulo de Usuarios</h4>
      </div>
      <div class="ms-auto">
        <a href="" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Agregar Usuario</a>
        <a href="" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
      </div>
    </div>
    <div class="card text-dark bg-light mb-3 card-shadow">
      <div class="card-header"><strong>Listado de Usuarios</strong></div>
      <div class="card-body">
        <form action="" method="get" autocomplete="off">
          <div class="input-group mb-3">
            <span class="input-group-text fw-600">Buscar:</span>
            <input type="text" name="buscar" class="form-control" placeholder="Ingrese un término de búsqueda" value="">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
            <button class="btn btn-secondary" type="button"><i class="bi bi-x-circle-fill"></i> Limpiar</button>

          </div>
        </form>
        <div class="table-responsive">

          <table class="table table-bordered table-hover" style="margin-top: 15px;">
            <thead class="table-primary">
              <tr>
                <th>Nombre Completo</th>
                <th>Nombre de Usuario</th>
                <th>Tipo de Cuenta</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $registro["nombre_completo"]; ?></td>
                <td><?php echo $registro["usuario"]; ?></td>
                <td><?php echo $registro["tipo_cuenta"]; ?></td>
                <td style="width: 150px; text-align: center;">
                  <a href="form_editar.php?idus=<?php echo $registro["id_usuario"]; ?>" class="btn btn-primary"><i class="bi bi-eye-fill"></i> Editar</a>
                </td>
              </tr>
            </tbody>
          </table>
          <span>Total de registros: </span><span class="fw-600"></span>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<!-- JS -->
<script src="../../assets/js/pooper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/sweetalert2.all.min.js"></script>
<!-- JS -->