# Proyecto SOAP + MySQL (Corregido)
Instrucciones rápidas:
1. Copia la carpeta `proyecto_soap_mysql_fixed` a `C:\xampp\htdocs\` (Windows).
2. En phpMyAdmin, ejecuta `sql/create_db.sql`.
3. Asegúrate de que `extension=soap` está habilitado en `php.ini` y reinicia Apache.
4. Abre en el navegador: http://localhost/proyecto_soap_mysql_fixed/client/index.php

Estructura relevante:
- pacientes.wsdl
- server/ (server.php, PacienteLogic.php, db.php)
- client/ (páginas y client_config.php)
- sql/create_db.sql
