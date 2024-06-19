<?php
$id = $_GET['id'];
require_once '../../config/server_connection.php';
$server = new ServerConnection();

$server->query = "SELECT * FROM tbl_cab_ventas";
$ventas = $server->get_records();
$conn = new ServerConnection();
$conn->query = "SELECT * FROM tbl_clientes";
$clientes = $conn->get_records();

$connner = new ServerConnection();
$connner->query = "SELECT * FROM tbl_productos";
$productos = $connner->get_records();
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
        <h4 class="page-header">Módulo de Ventas</h4>
      </div>
      <div class="ms-auto">
        <a href="#" class="btn btn-success" onclick="guardar()"><i class="bi bi-floppy2-fill"></i> Guardar</a>
        <a href="form_nventa.php?state=d&id=<?php echo $id; ?>" class="btn btn-danger"><i
            class="bi bi-x-circle-fill"></i> Cancelar</a>
        <a href="" class="btn btn-secondary"><i class="bi bi-escape"></i> Cerrar</a>
      </div>
    </div>
    <div class="card text-dark bg-light mb-3 card-shadow">
      <div class="card-header"><strong>Registro de venta</strong></div>
      <div class="card-body">

        <div class="row mb-3">
          <form name="cabupd" action="form_nventa.php?state=u&&id=<?php echo $id ?>" method="post" style="display: flex;
    flex-direction: row;margin:0;">
            <div class="col-6">
              <label for="nombre" class="form-label">Nombre:</label>
              <select name="nombre_cliente" id="nombre_cliente" class="form-select" onchange="actualizar()">
                <option value="">Seleccione un cliente</option>
                <?php
                foreach ($clientes as $cliente) {
                  if ($cliente['id_cliente'] == $ventas[0]['id_cliente']) {
                    echo "<option value='{$cliente['id_cliente']}' selected>{$cliente['nombre']}</option>";
                  } else {
                    echo "<option value='{$cliente['id_cliente']}'>{$cliente['nombre']}</option>";
                  }
                }
                ?>
              </select>
              <a href="../clientes/form_nuevo.php?s=<?php echo $id ?>"
                class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Nuevo
                Cliente</a>
            </div>
            <div class="col-4">
              <label for="fecha" class="form-label">Fecha:</label>
              <input type="date" class="form-control" name="fecha" id="fecha" onchange="actualizar()"
                value="<?php echo $ventas[0]['fecha'] ?>">
            </div>
            <div class="col-2">
              <label for="estado" class="form-label">Estado:</label>
              <select name="estado" class="form-select" id="estado" onchange="actualizar()">
                <option value="" disabled>Seleccione un estado</option>
                <option value=" 1" <?php echo $ventas[0]['estado'] == 1 ? 'selected' : '' ?>>Abierto</option>
                <option value="0" <?php echo $ventas[0]['estado'] == 0 ? 'selected' : '' ?>>Cerrado</option>
              </select>
            </div>
          </form>
        </div>
        <div class="row mb-3">
          <form name="produp" action="proc_aprod.php" method="post" style="display: flex;flex-direction: row;margin:0;">
            <input type="hidden" name="id_venta" value="<?php echo $id ?>">
            <div class="col-4">
              <label for="producto" class="form-label">Producto:</label>
              <select name="producto" id="producto" class="form-select" onchange="getproducto(this.value)">
                <option value="" hidden>Seleccione un producto</option>
                <?php
                foreach ($productos as $producto) {
                  echo "<option value='{$producto['id_producto']}'>{$producto['nombre']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-2">
              <center>
                <img src="../../assets/images/img_productos/sin_imagen.png" style="margin:5px;" id="image" alt=""
                  width="100px" height="100px">
              </center>
            </div>
            <div class="col-2">
              <label for="precio" class="form-label">Precio Unitario:</label>
              <input type="number" class="form-control" name="precio" id="precio" value="">
            </div>
            <div class="col-2">
              <label for="cantidad" class="form-label">Cantidad:</label>
              <input type="number" class="form-control" name="cantidad" id="cantidad" min="1">
            </div>

            <button type="button" class="btn btn-primary col-2" onclick="postventa()"><i
                class="bi bi-plus-circle-fill"></i> Agregar</button>


          </form>
        </div>
        <div class="row">
          <table class="table table-bordered table-hover">
            <thead class="table-primary">
              <tr>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $server->query = "SELECT tbl_productos.nombre AS nombre, tbl_det_ventas.* FROM tbl_det_ventas INNER JOIN tbl_productos ON tbl_det_ventas.id_producto = tbl_productos.id_producto WHERE id_cab_venta = $id";
              $detalles = $server->get_records();
              $total = 0;
              foreach ($detalles as $detalle) {
                $subtotal = $detalle['precio_unitario'] * $detalle['cantidad'];
                $total += $subtotal;
                echo "<tr>";
                echo "<td>{$detalle['nombre']}</td>";
                echo "<td>{$detalle['precio_unitario']}</td>";
                echo "<td>{$detalle['cantidad']}</td>";
                echo "<td>$subtotal</td>";
                echo "<td>
                      <center>
                       <a href='javascript:void(0);' onclick='confirmDelete({$detalle['tbl_det_ventas']} , {$id})' class='btn btn-danger'><i class='bi bi-trash'></i></a>
                      </center>
                       </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <div class="d-flex justify-content-end">
            <h4>Total: $<?php echo $total ?></h4>
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

<!-- -------------------- Validaciones de ingreso de datos -------------------- -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  function actualizar() {
    let cabupd = document.forms['cabupd'];
    cabupd.submit();
  }

  function getproducto(id) {
    let floatingimage = document.getElementById('image');
    let precio = document.getElementById('precio');
    let formData = new FormData();
    formData.append('id', id);
    let request = new XMLHttpRequest();
    request.open('POST', '../../utils/getimage.php', true);
    request.onload = function () {
      if (request.status >= 200 && request.status < 400) {
        let data = JSON.parse(request.responseText);
        floatingimage.src = data[0]['imagen'];
        precio.value = data[0]['precio_venta'];
      } else {
        console.error('error');
      }
    };

    request.send(formData);
  }

  function postventa() {
    let produp = document.forms['produp'];
    produp.submit();
  }

  function confirmDelete(detalleId, ventaId) {
    // Preguntamos al usuario si está seguro de eliminar el registro
    Swal.fire({
      title: '¿Está seguro de eliminar el registro?',
      text: "Esta acción no se puede deshacer",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      defaultFocus: 'cancel'
    }).then((result) => {
      if (result.isConfirmed) {

        window.location.href = `proc_dprod.php?id=${detalleId}&idventa=${ventaId}`;
      }
    });

  }
</script>