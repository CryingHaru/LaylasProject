<?php
require_once "../../config/server_connection.php";

$conn = new ServerConnection();

$conn->query =  "DELETE FROM tbl_productos
WHERE id_producto = '{$_GET["idprod"]}'";

$conn->execute_query();
 header("Location: ./form_listar.php?msg=eliminado");
