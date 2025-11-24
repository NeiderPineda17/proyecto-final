<?php
require_once __DIR__ . '/db.php';

class PacienteLogic {

    public function RegistrarPaciente($params) {
        // $params might come as array('paciente' => array(...)) or directly as array
        $p = is_array($params) && isset($params['paciente']) ? $params['paciente'] : $params;
        $db = DB::connect();

        $stmt = $db->prepare('SELECT cedula FROM pacientes WHERE cedula = ?');
        $stmt->execute([$p['cedula']]);
        if ($stmt->fetch()) return false;

        $stmt = $db->prepare('INSERT INTO pacientes (cedula,nombres,apellidos,telefono,direccion,fecha_nacimiento) VALUES (?,?,?,?,?,?)');
        return $stmt->execute([
            $p['cedula'],
            $p['nombres'],
            $p['apellidos'],
            $p['telefono'] ?? null,
            $p['direccion'] ?? null,
            $p['fecha_nacimiento'] ?? null
        ]);
    }

    public function BuscarPacientePorCedula($cedula) {
        $db = DB::connect();
        $stmt = $db->prepare('SELECT * FROM pacientes WHERE cedula = ?');
        $stmt->execute([$cedula]);
        $row = $stmt->fetch();
        return $row ? $row : null;
    }

    public function ListarTodosLosPacientes() {
        $db = DB::connect();
        $stmt = $db->query('SELECT * FROM pacientes');
        return $stmt->fetchAll();
    }

    public function ModificarPaciente($params) {
        // Expecting array('cedula' => '...', 'paciente' => array(...)) or two params depending on SoapClient
        if (is_array($params) && isset($params['cedula']) && isset($params['paciente'])) {
            $cedula = $params['cedula'];
            $p = $params['paciente'];
        } else {
            // fallback: maybe called as ModificarPaciente($cedula, $paciente) - handle both
            if (is_array($params) && isset($params[0]) && isset($params[1])) {
                $cedula = $params[0];
                $p = $params[1];
            } else {
                return false;
            }
        }

        $db = DB::connect();
        $stmt = $db->prepare('UPDATE pacientes SET nombres=?, apellidos=?, telefono=?, direccion=?, fecha_nacimiento=? WHERE cedula = ?');
        return $stmt->execute([
            $p['nombres'] ?? null,
            $p['apellidos'] ?? null,
            $p['telefono'] ?? null,
            $p['direccion'] ?? null,
            $p['fecha_nacimiento'] ?? null,
            $cedula
        ]);
    }

    public function EliminarPaciente($cedula) {
        $db = DB::connect();
        $stmt = $db->prepare('DELETE FROM pacientes WHERE cedula = ?');
        return $stmt->execute([$cedula]);
    }
}
?>