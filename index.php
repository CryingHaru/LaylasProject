<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="Layla's Salón" content="width=device-width, initial-scale=1.0">
  <title>Layla's Salón</title>
  <meta name="author" content="ITCA-FEPADE" />
  <link rel="shortcut icon" href="assets/images/favicon.ico">
  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./assets/css/menu.css">
  <!-- CSS -->
</head>

<body>

  <div class="DivTopMenu" style="position: fixed; width: 100%; z-index: 1000000" class="flex-column">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon" style="height: 15px;"></span>
      </button>

      <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start" style=" padding-left: 10px;">
        <div class="navbar-nav">
          <div class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Inventario</a>
            <div class="dropdown-menu">
              <a href="./app/productos/form_listar.php" class="dropdown-item">Productos</a>
              <a href="./app/marcas/form_listar.php" class="dropdown-item">Marcas</a>
              <a href="./app/categorias/form_listar.php" class="dropdown-item">Categorías</a>
            </div>
          </div>

          <a href="app/clientes/form_listar.php" class="nav-link">Clientes</a>
          <a href="app/Ventas/form_listar.php" class="nav-link">Ventas</a>
          <?php
          //Validamos que este enlace esté disponible solo para los administradores
          //if (@$_SESSION['mega_tipo_cuenta'] == 'administrador') {
          ?>
          <a href="" class="nav-link">Usuarios</a>
          <?php
          //}
          ?>

        </div>
        <div class="navbar-nav ms-auto">
          <div class="dropdown">
            <a href="#" role="button" data-bs-toggle="dropdown" class="nav-link dropdown-toggle user-action">
              <img src="assets/images/avatar.png" class="avatar" alt="Avatar" width="30">
              Nombre de Usuario <b class="caret"></b></a>
            <div class="dropdown-menu">
              <a href="app/usuarios/form_perfil.php" class="dropdown-item">
                <i class="bi bi-person-circle"></i> Mi Perfil</a></a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item" onclick="">
                <i class="bi bi-power"></i> Cerrar Sesión</a></a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>

</body>

</html>

<!-- JS -->
<script src="./assets/js/pooper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/sweetalert2.all.min.js"></script>
<!-- JS -->

<script type="text/javascript">

</script>