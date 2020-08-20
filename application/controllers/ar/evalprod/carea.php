<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Carea
 *
 * @property marea marea
 */
class Carea extends CI_Controller
{
    /**
     * Cproveedor constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ar/evalprod/marea', 'marea');
    }

    /**
     * Auto completado de areas
     */
    public function autocompletado()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $busqueda = $this->input->post('busqueda');
        $busqueda = (empty($busqueda)) ? '' : $busqueda;
        $ccliente = $this->session->userdata('s_ccliente');
        $ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005
        $resultado = $this->marea->autoCompletado($ccliente, $busqueda);
        echo json_encode(["items" => $resultado]);
    }

    /**
     * Auto completado de contactos de area
     */
    public function autocompletado_contacto()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $busqueda = $this->input->post('busqueda');
        $busqueda = (empty($busqueda)) ? '' : $busqueda;
        $ccliente = $this->session->userdata('s_ccliente');
        $ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005
        $params = $this->input->post('params');
        $idarea = 0;
        if (isset($params['idarea']) && !empty($params['idarea'])) {
            $idarea = $params['idarea'];
        }
        $resultado = $this->marea->autoCompletadoContacto($ccliente,$idarea, $busqueda);
        echo json_encode(["items" => $resultado]);
    }

}