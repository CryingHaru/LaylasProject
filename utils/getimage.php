<?php
require_once '../config/server_connection.php';
$server = new ServerConnection();
$server->query = "SELECT imagen, precio_venta FROM tbl_productos where id_producto = {$_POST['id']}";
$info = $server->get_records();
echo json_encode($info);