<?php
include 'client_config.php';
if (!isset($_GET['cedula'])) { header('Location: listar_pacientes.php'); exit; }
$ced = $_GET['cedula'];
try { $client->EliminarPaciente($ced); } catch (Exception $e) {}
header('Location: listar_pacientes.php');
exit;
?>