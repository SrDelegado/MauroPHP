<?php

require_once "config/db.php";
require_once "logic/cultivos.php"; 

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "tipo", FILTER_SANITIZE_STRING);
    $dias = filter_input(INPUT_POST, "dias_cosecha", FILTER_VALIDATE_INT);

    if (!$nombre) {
        $errores[] = "El nombre no puede quedar vacío.";
    }

    if (!$dias || $dias <= 0) {
        $errores[] = "Introduce un número de días válido.";
    }

    if (empty($errores)) {
   
        $sql = "INSERT INTO cultivos (nombre, tipo, dias_cosecha) VALUES (?, ?, ?)";
        
        $stmt = mysqli_prepare($conexion, $sql);
        
       
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $tipo, $dias); 

        if (mysqli_stmt_execute($stmt)) {
      
            header("Location: index.php?msg=" . urlencode("Cultivo guardado con éxito."));
            exit;
        } else {
            
            error_log("Fallo inserción de cultivo: " . mysqli_stmt_error($stmt)); 
            header("Location: nuevo.php?error=" . urlencode("No se pudo guardar el cultivo. Error interno."));
            exit;
        }
        
        mysqli_stmt_close($stmt);
    }
}


$error_url = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
if ($error_url) {
    $errores[] = $error_url;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Cultivo</title>
</head>
<body>

<h1>Registrar Cultivo</h1>

<?php if (!empty($errores)): ?>
<div style="color: red; margin-bottom: 20px;">
    <b>Errores detectados:</b><br>
    <?php 

    foreach ($errores as $e) echo "- " . htmlspecialchars($e) . "<br>"; 
    ?>
</div>
<?php endif; ?>

<form action="" method="POST">
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre ?? ''); ?>"><br><br>

    Tipo:<br>
    <select name="tipo">
        <option value="Hortaliza" <?php echo (isset($tipo) && $tipo == 'Hortaliza') ? 'selected' : ''; ?>>Hortaliza</option>
        <option value="Fruto" <?php echo (isset($tipo) && $tipo == 'Fruto') ? 'selected' : ''; ?>>Fruto</option>
        <option value="Aromática" <?php echo (isset($tipo) && $tipo == 'Aromática') ? 'selected' : ''; ?>>Aromática</option>
        <option value="Legumbre" <?php echo (isset($tipo) && $tipo == 'Legumbre') ? 'selected' : ''; ?>>Legumbre</option>
        <option value="Tubérculo" <?php echo (isset($tipo) && $tipo == 'Tubérculo') ? 'selected' : ''; ?>>Tubérculo</option>
    </select><br><br>

    Días hasta la cosecha:<br>
    <input type="number" min="1" name="dias_cosecha" value="<?php echo htmlspecialchars($dias ?? ''); ?>"><br><br>

    <button type="submit">Guardar</button>
</form>

</body>
</html>