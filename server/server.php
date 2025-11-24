<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once __DIR__ . '/PacienteLogic.php';

$wsdl = realpath(__DIR__ . '/../pacientes.wsdl');
$options = ['uri' => 'http://example.org/pacientes'];

try {
    $server = new SoapServer($wsdl, $options);
    $server->setClass('PacienteLogic');
    $server->handle();
} catch (Exception $e) {
    header('Content-Type: text/plain');
    echo 'SOAP Server error: ' . $e->getMessage();
}
?>