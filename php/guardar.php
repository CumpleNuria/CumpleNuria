<?php

// 🔗 CONEXIÓN A LA BASE DE DATOS
$conexion = new mysqli("localhost", "root", "", "cumple_nuria");

// ❌ ERROR DE CONEXIÓN
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 📥 RECOGER DATOS DEL FORMULARIO
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$alergias = $_POST['alergias'];
$peticiones = $_POST['peticiones'];
$asiste = $_POST['asiste'];
$fiesta = $_POST['fiesta'];

// 📝 INSERTAR EN LA BASE DE DATOS
$sql = "INSERT INTO asistentes (nombre, apellido, alergias, peticiones, asiste, fiesta)
VALUES ('$nombre', '$apellido', '$alergias', '$peticiones', '$asiste', '$fiesta')";

// ✅ EJECUTAR
if ($conexion->query($sql) === TRUE) {

    header("Location: ../index.html?ok=1");
    exit();

} else {
    echo "Error: " . $conexion->error;
}

// 🔒 CERRAR CONEXIÓN
$conexion->close();

?>