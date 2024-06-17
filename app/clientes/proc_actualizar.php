<?php 
// Clase para la conexión
include_once "../../config/server_connection.php";

// Instanciamos la clase
$conn = new ServerConnection();

// Consulta SQL
$conn->query = "UPDATE tbl_clientes SET 
nombre = '{$_POST["nombre"]}',
direccion = '{$_POST["direccion"]}',
telefono = '{$_POST["telefono"]}',
dui_nit = '{$_POST["dui_nit"]}'
WHERE id_cliente = '{$_GET["idcl"]}'";

// Ejecutamos la consulta
$conn->execute_query();

// Redirección
header("Location: ./form_detalles.php?msg=actualizado&idcl={$_GET["idcl"]}");

