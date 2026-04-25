<?php
$conexion = new mysqli("localhost", "root", "", "cumple_nuria");

$id = $_GET['id'];

$conexion->query("DELETE FROM asistentes WHERE id=$id");

header("Location: admin.php");
exit();
?>