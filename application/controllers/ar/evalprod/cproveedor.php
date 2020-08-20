<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cproveedor
 *
 * @property mproveedor mproveedor
 */
class Cproveedor extends CI_Controller
{
    /**
     * Cproveedor constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ar/evalprod/mproveedor', 'mproveedor');
    }

    /**
     * Lista de proveedores
     */
    public function lista()
    {
        $ccliente = $this->session->userdata('s_ccliente');
        $ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005
        $nombre = $this->input->get('nombre');
        $ruc = $this->input->get('ruc');
        $proveedores = $this->mproveedor->lista($ccliente, $nombre, $ruc);
        echo json_encode($proveedores);
    }

    /**
     * Crea o edita un proveedor
     */
    public function guardar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $proveedor = trim($this->input->post('mtxtProveedor'));
            $ruc = trim($this->input->post('mtxtRUC'));
            $contacto1 = trim($this->input->post('mtxtContactop'));
            $email1 = trim($this->input->post('mtxtEmailp'));
            $contacto2 = trim($this->input->post('mtxtContactoq'));
            $email2 = trim($this->input->post('mtxtEmailq'));
            $telefono = trim($this->input->post('mtxtTelefono'));
            if (empty($proveedor)) {
                throw new Exception('Debes ingresar nombre del Proveedor.');
            }
            if (empty($ruc)) {
                throw new Exception('Debes ingresar el RUC del Proveedor.');
            }
            if (!is_numeric($ruc)) {
                throw new Exception('El RUC debe ser númerico.');
            }
            if (strlen($ruc) != 11) {
                throw new Exception('El RUC debe ser de 11 digitos.');
            }
            if (empty($contacto1) && empty($contacto2)) {
                throw new Exception('Debes ingresar al menos un contacto.');
            }
            // Valida el RUC no exista
            $validarRuc = $this->mproveedor->buscarPorRuc($ruc, $this->input->post('mhdnIdproveedor'));
            if (!empty($validarRuc)) {
                throw new Exception('El RUC del Proveedor ya existe.');
            }
            $this->db->trans_begin();
            $parametros = array(
                '@id_proveedor' => $this->input->post('mhdnIdproveedor'),
                '@nombre' => $proveedor,
                '@contacto_p' => $contacto1,
                '@email_p' => $email1,
                '@contacto_q' => $contacto2,
                '@email_q' => $email2,
                '@telefono' => $telefono,
                '@ruc' => $ruc,
                '@ccliente' => '00005',
                '@accion' => $this->input->post('mhdnAccionprov'),
            );
            $respuesta = $this->mproveedor->guardar($parametros);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode([
                'mensaje' => $respuesta[0]->respuesta,
                'datos' => $this->mproveedor->buscarPorRuc($ruc)
            ]);
        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Auto completado de proveedores con el plugins select2
     */
    public function autocompletado()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $ccliente = $this->session->userdata('s_ccliente');
        $ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005
        $busqueda = $this->input->post('busqueda');
        $busqueda = (empty($busqueda)) ? '' : $busqueda;
        $resultado = $this->mproveedor->autoCompletado($ccliente, $busqueda);
        echo json_encode(["items" => $resultado]);
    }

    /**
     * Busca un proveedor por ID
     */
    public function buscar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $id = $this->input->post('id');
        $proveedor = $this->mproveedor->buscarPorId($id);
        echo json_encode(['proveedor' => $proveedor]);
    }

}