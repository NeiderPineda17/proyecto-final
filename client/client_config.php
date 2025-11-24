<?php
$BASE_URL = 'http://localhost/proyecto_soap_mysql_fixed';
$WSDL = $BASE_URL . '/pacientes.wsdl';
try {
    $client = new SoapClient($WSDL, ['trace' => 1, 'exceptions' => 1]);
} catch (Exception $e) {
    echo '<div style="padding:12px;background:#fee;border:1px solid #faa;color:#600">';
    echo 'No se pudo conectar al servicio SOAP. Error: ' . htmlspecialchars($e->getMessage());
    echo '</div>';
    exit;
}
?>