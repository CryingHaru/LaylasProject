<?php
require_once '../../config/server_connection.php';
$req = new ServerConnection();
$req->query = "SELECT nombre FROM tbl_productos";
$productos = $req->get_records();
echo json_encode($productos);