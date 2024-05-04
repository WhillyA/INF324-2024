<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentabancaria extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Cuentas_model");
        $this->load->helper("url"); // Asegúrate de cargar el helper de URL
    }

    public function index() {
        $cuentas = $this->Cuentas_model->getCuentas();
        $this->load->view("Cuentabancaria", compact("cuentas"));
    }

    public function eliminar($id) {
    
        $this->load->model("Cuentas_model");
        $resultado = $this->Cuentas_model->eliminarCuenta($id);
    
        if ($resultado) {
            redirect("Cuentabancaria/index");
        } else {
            echo "Error al eliminar la cuenta bancaria.";
        }
    }
    
    public function agregarUS() {
        if ($this->input->post()) {
            // Recoge datos del formulario
            $datos = [
                'id_persona' => $this->input->post('id_persona'),
                'saldo' => $this->input->post('saldo'),
                'fecha_creacion' => date('Y-m-d H:i:s'), // Fecha actual
                'id_tipo_cuenta' => $this->input->post('id_tipo_cuenta')
            ];
    
            // Inserta en la base de datos
            $resultado = $this->Cuentas_model->agregarCuenta($datos);
    
            if ($resultado) {
                // Redirecciona a la lista de cuentas bancarias
                redirect('cuentabancaria/index');
            } else {
                echo "Error al agregar la cuenta bancaria.";
            }
        } else {
            // Muestra el formulario para agregar
            $this->load->view('agregar_cuentabancaria');
        }
    }
 
    
    
}
