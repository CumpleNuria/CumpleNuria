<?php
session_start();

// ⚙️ USUARIO Y PASSWORD (cámbialo)
$usuario_correcto = "admin";
$password_correcto = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    if ($user === $usuario_correcto && $pass === $password_correcto) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>

<style>
body {
    background: #1e1e2f;
    color: white;
    font-family: Arial;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background: #2c2c54;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}

input {
    display: block;
    margin: 10px auto;
    padding: 10px;
    border: none;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background: #ff4d6d;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.error {
    color: red;
}
</style>
</head>
<body>

<form method="POST">
    <h2>🔐 Admin Login</h2>

    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>

    <button type="submit">Entrar</button>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
</form>

</body>
</html>