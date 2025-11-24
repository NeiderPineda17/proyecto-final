<?php
include 'client_config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ced = $_POST['cedula'];
    $pac = [
        'nombres'=>$_POST['nombres'],
        'apellidos'=>$_POST['apellidos'],
        'telefono'=>$_POST['telefono'],
        'direccion'=>$_POST['direccion'],
        'fecha_nacimiento'=>$_POST['fecha_nacimiento']
    ];
    try {
        $ok = $client->ModificarPaciente(['cedula'=>$ced,'paciente'=>$pac]);
        $message = $ok ? 'Paciente modificado correctamente.' : 'Error al modificar.';
    } catch (Exception $e) {
        $message = 'Error: '.$e->getMessage();
    }
    $paciente = $client->BuscarPacientePorCedula($ced);
} else {
    if (!isset($_GET['cedula'])) { header('Location: listar_pacientes.php'); exit;}
    $paciente = $client->BuscarPacientePorCedula($_GET['cedula']);
    if (!$paciente) { header('Location: listar_pacientes.php'); exit;}
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Editar</title><link rel="stylesheet" href="../assets/style.css"></head>
<body><div class="container">
<header class="hero"><h1>Editar Paciente</h1></header>
<main>
<?php if($message): ?><div class="notice"><?=$message?></div><?php endif; ?>
<form method="post" class="form">
<label>Cédula <input name="cedula" value="<?=htmlspecialchars($paciente['cedula'])?>" readonly></label>
<label>Nombres <input name="nombres" value="<?=htmlspecialchars($paciente['nombres'])?>" required></label>
<label>Apellidos <input name="apellidos" value="<?=htmlspecialchars($paciente['apellidos'])?>" required></label>
<label>Teléfono <input name="telefono" value="<?=htmlspecialchars($paciente['telefono'])?>"></label>
<label>Dirección <input name="direccion" value="<?=htmlspecialchars($paciente['direccion'])?>"></label>
<label>Fecha de nacimiento <input name="fecha_nacimiento" type="date" value="<?=htmlspecialchars($paciente['fecha_nacimiento'])?>"></label>
<div class="form-actions"><button class="btn primary" type="submit">Guardar</button><a class="btn" href="listar_pacientes.php">Volver</a></div>
</form>
</main></div></body></html>
