<?php
require_once '../../config/server_connection.php';
require_once '../../utils/paginador.php';
$query = "SELECT * FROM tbl_categorias";

$paginador = new Paginador();
if (isset($_GET['buscar'])) {
  $query .= " WHERE nombre LIKE '%" . $_GET['buscar'] . "%'";
}
$paginador->query = $query;
$paginador->registros_por_pag = 5;
$paginador->pag_actual = isset($_GET['pa']) ? $_GET['pa'] : 1;
$paginador->destino = 'form_listar.php';
$paginador->crear_paginador();

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
    <div class="d-flex align-items-center mb-3">
      <div>
        <h4 class="page-header">Módulo de Categorias</h4>
      </div>
      <div class="ms-auto">
        <a href="./form_nuevo.php" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Agregar</a>
        <a href="../../index.php" class="btn btn-secondary
        "><i class="bi bi-x-circle-fill"></i> Cerrar</a>
      </div>
    </div>
    <div class="card text-dark bg-light mb-3 card-shadow">
      <div class="card-header"><strong>Listado de Categorias</strong></div>
      <div class="card-body">
        <form action="" method="get" autocomplete="off">
          <div class="input-group mb-3">
            <span class="input-group-text fw-600">Buscar:</span>
            <input type="text" name="buscar" class="form-control" placeholder="Ingrese un término de búsqueda" value="<?php echo @$_GET['buscar'] ?>">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
            <button class="btn btn-secondary" type="button" onclick="limpiarbusqueda()"><i class="bi bi-x-circle-fill"></i> Limpiar</button>

          </div>
        </form>
        <div class="table-responsive">
          <?php echo $paginador->mostrar_paginador(); ?>
          <br>
          <table class="table table-bordered table-hover">
            <thead class="table-primary">
              <tr>
                <th>Nombre</th>
                <th style="width:120px">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($paginador->registros_pagina as $categoria) {
                echo "<tr>";
                echo "<td>" . $categoria['nombre'] . "</td>";
                echo "<td>
                          <a style='color:white;' href='form_detalles.php?id=" . $categoria['id_categoria'] . "' class='btn btn-info'><i class='bi bi-eye-fill'></i> Detalles</a>
                      </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <span>Total de registros: </span><strong><?php echo $paginador->total_filas ?></strong>

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
<script>
  function limpiarbusqueda() {
    window.location.href = 'form_listar.php';
  }
</script>
