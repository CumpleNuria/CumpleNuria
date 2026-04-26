<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "cumple_nuria");

// FILTRO
$busqueda = $_GET['busqueda'] ?? '';

$sql = "SELECT * FROM asistentes WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%'";
$resultado = $conexion->query($sql);

// STATS
$total = $conexion->query("SELECT COUNT(*) as t FROM asistentes")->fetch_assoc()['t'];
$asisten = $conexion->query("SELECT COUNT(*) as t FROM asistentes WHERE asiste=1")->fetch_assoc()['t'];
$fiesta = $conexion->query("SELECT COUNT(*) as t FROM asistentes WHERE fiesta=1")->fetch_assoc()['t'];

$porcentaje = $total > 0 ? round(($asisten / $total) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #0f172a;
    color: white;
}

/* NAV */
.nav {
    background: #1e293b;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav h1 {
    margin: 0;
    font-size: 18px;
}

.logout {
    background: #ef4444;
    border: none;
    padding: 8px 15px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}

/* GRID */
.container {
    padding: 20px;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.card {
    background: #1e293b;
    padding: 20px;
    border-radius: 15px;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card h2 {
    margin: 0;
    font-size: 28px;
}

/* PROGRESS */
.progress {
    background: #334155;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 10px;
}

.progress-bar {
    height: 10px;
    background: #22c55e;
    width: <?= $porcentaje ?>%;
}

/* SEARCH */
.search {
    margin: 20px 0;
}

.search input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background: #334155;
}

tr {
    border-bottom: 1px solid #334155;
}

tr:hover {
    background: #334155;
}

.badge {
    padding: 5px 10px;
    border-radius: 20px;
}

.si {
    background: #22c55e;
}

.no {
    background: #ef4444;
}

.delete {
    background: #ef4444;
    border: none;
    padding: 6px 10px;
    border-radius: 5px;
    color: white;
    cursor: pointer;
}

</style>
</head>

<body>

<div class="nav">
    <h1>🎛️ Dashboard Evento</h1>
    <a href="logout.php"><button class="logout">Salir</button></a>
</div>

<div class="container">

<div class="cards">
    <div class="card">
        <p>Total invitados</p>
        <h2><?= $total ?></h2>
    </div>

    <div class="card">
        <p>Asistirán</p>
        <h2><?= $asisten ?></h2>
    </div>

    <div class="card">
        <p>Fiesta</p>
        <h2><?= $fiesta ?></h2>
    </div>

    <div class="card">
        <p>Confirmación</p>
        <h2><?= $porcentaje ?>%</h2>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
    </div>
</div>

<div class="search">
    <form method="GET">
        <input type="text" name="busqueda" placeholder="Buscar invitado...">
    </form>
</div>

<table>
<tr>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Alergias</th>
    <th>Peticiones</th>
    <th>Asiste</th>
    <th>Fiesta</th>
    <th></th>
</tr>

<?php while($row = $resultado->fetch_assoc()) { ?>
<tr>
    <td><?= $row['nombre'] ?></td>
    <td><?= $row['apellido'] ?></td>
    <td><?= $row['alergias'] ?></td>
    <td><?= $row['peticiones'] ?></td>
    <td><span class="badge <?= $row['asiste'] ? 'si' : 'no' ?>">
        <?= $row['asiste'] ? 'Sí' : 'No' ?>
    </span></td>
    <td><span class="badge <?= $row['fiesta'] ? 'si' : 'no' ?>">
        <?= $row['fiesta'] ? 'Sí' : 'No' ?>
    </span></td>
    <td>
        <a href="eliminar.php?id=<?= $row['id'] ?>">
            <button class="delete">X</button>
        </a>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>