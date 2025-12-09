<?php

require_once "config/db.php"; // Usa la conexión segura 
require_once "logic/cultivos.php"; // Usa la lógica pura
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Huerta — Listado de Cultivos</title>
</head>
<body>

<h1>Listado de Cultivos</h1>

<?php if (isset($_GET['msg'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
<?php endif; ?>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Días</th>
        <th>Ciclo</th>
    </tr>

<?php
$consulta = mysqli_query($conexion, "SELECT * FROM cultivos ORDER BY id ASC");

while ($fila = mysqli_fetch_assoc($consulta)) {
    // Sanitización de salida: htmlspecialchars() en CADA variable dinámica (Checklist)
    $id = htmlspecialchars($fila['id']);
    $nombre = htmlspecialchars($fila['nombre']);
    $tipo = htmlspecialchars($fila['tipo']);
    $dias_cosecha = htmlspecialchars($fila['dias_cosecha']);
    $ciclo = htmlspecialchars(cicloCultivo($fila['dias_cosecha']));
    
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$nombre}</td>";
    echo "<td>{$tipo}</td>";
    echo "<td>{$dias_cosecha}</td>";
    echo "<td>{$ciclo}</td>";
    echo "</tr>";
}
?>
</table>

<br>
<a href="nuevo.php">➕ Añadir nuevo cultivo</a>

</body>
</html>