<?php
class Cuentas_model extends CI_Model {
    public function getCuentas() {
        // Consulta para obtener cuentas bancarias con unión de persona y tipo_cuenta
        $this->db->select("cb.id, p.nombres, p.ap_pat, p.ci, cb.saldo, cb.fecha_creacion, tc.nombre AS tipo_cuenta");
        $this->db->from("cuentabancaria cb");
        $this->db->join("persona p", "cb.id_persona = p.id", "inner");
        $this->db->join("tipo_cuenta tc", "cb.id_tipo_cuenta = tc.id", "inner");

        $query = $this->db->get();

        return $query->result(); // Devolver los resultados como array de objetos
    }
    public function eliminarCuenta($id) {
        $this->db->where('id', $id);
        return $this->db->delete('cuentabancaria'); // Retorna true si tuvo éxito
    }
    

    public function agregarCuenta($datos) {
        return $this->db->insert('cuentabancaria', $datos); // Devuelve true si se inserta correctamente
    }
    
    
    
}
