<?php
include 'client_config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pac = [
        'cedula'=>$_POST['cedula'],
        'nombres'=>$_POST['nombres'],
        'apellidos'=>$_POST['apellidos'],
        'telefono'=>$_POST['telefono'],
        'direccion'=>$_POST['direccion'],
        'fecha_nacimiento'=>$_POST['fecha_nacimiento']
    ];
    try {
        $ok = $client->RegistrarPaciente(['paciente'=>$pac]);
        $message = $ok ? 'Paciente registrado correctamente.' : 'Error: ya existe un paciente con esa cédula.';
    } catch (Exception $e) {
        $message = 'Error al registrar: ' . $e->getMessage();
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Registrar</title><link rel="stylesheet" href="../assets/style.css"></head>
<body><div class="container">
<header class="hero"><h1>Registrar Paciente</h1></header>
<main>
<?php if($message): ?><div class="notice"><?=$message?></div><?php endif; ?>
<form method="post" class="form">
<label>Cédula <input name="cedula" required></label>
<label>Nombres <input name="nombres" required></label>
<label>Apellidos <input name="apellidos" required></label>
<label>Teléfono <input name="telefono"></label>
<label>Dirección <input name="direccion"></label>
<label>Fecha de nacimiento <input name="fecha_nacimiento" type="date"></label>
<div class="form-actions"><button class="btn primary" type="submit">Guardar</button><a class="btn" href="index.php">Volver</a></div>
</form>
</main></div></body></html>
