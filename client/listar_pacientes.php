<?php
include 'client_config.php';
$error = null;
$pacientes = [];
try {
    $pacientes = $client->ListarTodosLosPacientes();
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Lista</title><link rel="stylesheet" href="../assets/style.css"><script src="../assets/main.js" defer></script></head>
<body><div class="container">
<header class="hero"><h1>Pacientes</h1></header>
<main>
<a class="btn" href="index.php">Volver</a>
<?php if($error): ?><div class="notice error"><?=htmlspecialchars($error)?></div><?php endif; ?>
<?php if(empty($pacientes)): ?><p>No hay pacientes registrados.</p>
<?php else: ?>
<table class="table"><thead><tr><th>Cédula</th><th>Nombre</th><th>Teléfono</th><th>Acciones</th></tr></thead><tbody>
<?php foreach($pacientes as $p): ?>
<tr>
<td><?=htmlspecialchars($p['cedula'])?></td>
<td><?=htmlspecialchars($p['nombres'].' '.$p['apellidos'])?></td>
<td><?=htmlspecialchars($p['telefono'])?></td>
<td><a class="btn small" href="editar_paciente.php?cedula=<?=urlencode($p['cedula'])?>">Editar</a>
<a class="btn small danger" href="eliminar_paciente.php?cedula=<?=urlencode($p['cedula'])?>" onclick="return confirmDelete(event)">Eliminar</a></td>
</tr>
<?php endforeach; ?>
</tbody></table>
<?php endif; ?>
</main></div></body></html>
