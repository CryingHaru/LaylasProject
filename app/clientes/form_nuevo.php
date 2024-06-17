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
    <form name="form_nuevo" action="proc_agregar.php" method="post" autocomplete="off">
      <div class="d-flex align-items-center mb-3">
        <div>
          <h4 class="page-header">Modulo de Clientes</h4>
        </div>
        <div class="ms-auto">
          <a href="#" onclick="validator()" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Guardar</a>
          <a href="./form_listar.php" class="btn btn-dark"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
          <a href="../../index.php" class="btn btn-dark"><i class="bi bi-Escape"></i> Cerrar</a>
        </div>
      </div>
      <div class="card text-dark bg-light mb-3 card-shadow">
        <div class="card-header"><strong>Registro de Nuevos Clientes</strong></div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-2 col-form-label">
              <label for="nombre" class="form-label">Nombre:</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-2 col-form-label">
              <label for="direccion" class="form-label">Dirección:</label>
            </div>
            <div class="col-md-10">
              <textarea class="form-control" name="direccion" id="direccion"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-2 col-form-label">
              <label for="telefono" class="form-label">Teléfono:</label>
            </div>
            <div class="col-md-10">
              <input type="tel" class="form-control" name="telefono" id="telefono">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-2 col-form-label">
              <label for="dui_nit" class="form-label">DUI/NIT:</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" name="dui_nit" id="dui_nit">
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
  function validator() {
    let nombre = document.getElementById('nombre').value;
    let direccion = document.getElementById('direccion').value;
    let telefono = document.getElementById('telefono').value;
    let dui_nit = document.getElementById('dui_nit').value;
    let form = document.forms['form_nuevo'];

    const campos = ['nombre', 'direccion', 'telefono', 'dui_nit'];
    const valores = {
      nombre,
      direccion,
      telefono,
      dui_nit
    };

    for (let campo of campos) {
      if (valores[campo] == '') {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: `El campo ${campo} es obligatorio`,
          timer: 3000
        });
        return;
      }
    }
    form.submit();

  }
</script>