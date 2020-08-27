<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Carea
 *
 * @property marea marea
 * @property marea_contacto mcontacto
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
        $this->load->model('ar/evalprod/marea_contacto', 'mcontacto');
    }

    /**
     * Vista para visualizar las areas
     */
    public function lista()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $ccliente = $this->session->userdata('s_ccliente');
        $ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005
        $nombre = $this->input->get('nombre');
        $areas = $this->marea->lista($ccliente, $nombre);
        echo json_encode($areas);
    }

    /**
     * Sirve para guardar el contacto
     */
    public function guardar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $area_id = $this->input->post('area_id');
            $area_nombre = $this->input->post('area_nombre');
            $ccliente = $this->session->userdata('s_ccliente');
            $ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005

            if (empty($area_nombre)) {
                throw new Exception('El nombre del área no puede estar vacío');
            }
            if (strlen($area_nombre) > 150) {
                throw new Exception('El nombre del área no puede ser mayor a 150 caracteres.');
            }

            $this->db->trans_begin();

            // Poder crear y actualizar el área
            if ($area_id <= 0) {
                $area_id = $this->marea->obtenerNuevoID();
                if ($area_id <= 0) {
                    throw new Exception('Lo siento no se pudo obetner un Identificado para el área, vuelva a intentarlo.');
                }
                $mensajeTexto = 'creado';
                $respuesta = $this->marea->crear($area_id, $area_nombre, 1, $ccliente);
            } else {
                $mensajeTexto = 'actualizado';
                $respuesta = $this->marea->editar($area_id, $area_nombre, 1);
            }

            if (!$respuesta) {
                throw new Exception("El proceso de {$mensajeTexto} es incorrecto.");
            }

            // Contactos
            $contacto_nombre = $this->input->post('contacto_nombre');
            $contacto_email = $this->input->post('contacto_email');
            $contacto_estado = $this->input->post('contacto_estado');
            $contacto_id = $this->input->post('contacto_id');
            $contacto_operacion = $this->input->post('contacto_operacion');
            if (!empty($contacto_id)) {
                foreach($contacto_id as $key => $value) {
                    $contactoOperacion = (isset($contacto_operacion[$key])) ? $contacto_operacion[$key] : 3;
                    $contactoId = (isset($contacto_id[$key])) ? $contacto_id[$key] : 0;
                    $contactoNombre = (isset($contacto_nombre[$key])) ? $contacto_nombre[$key] : '';
                    $contactoEmail = (isset($contacto_email[$key])) ? $contacto_email[$key] : '';
                    $contactoEstado = (isset($contacto_estado[$key])) ? $contacto_estado[$key] : '';
                    if ($contactoOperacion == "0" || $contactoOperacion == "1") {
                        $linea = "Contacto " . ($key + 1) . ": ";
                        if (empty($contactoNombre)) {
                            throw new Exception("{$linea}El nombre del contacto no puede estar vacío.");
                        }
                        if (strlen($contactoNombre) > 200) {
                            throw new Exception("{$linea}El nombre del contacto no puede ser mayor a 200 caracteres.");
                        }
                        if (empty($contactoId)) {
                            $area_contacto_id = $this->mcontacto->obtenerNuevoID();
                            $respuestaContacto = (new Marea_contacto())->crear(
                                $area_id,
                                $area_contacto_id,
                                $contactoNombre,
                                $contactoEmail,
                                $contactoEstado
                            );
                        } else {
                            $respuestaContacto = (new Marea_contacto())->editar(
                                $contactoId,
                                $contactoNombre,
                                $contactoEmail,
                                $contactoEstado
                            );
                        }
                        if (!$respuestaContacto) {
                            throw new Exception("{$linea}Error en el contacto.");
                        }
                    }
                    if ($contactoOperacion == 2) {
                        $respuestaContacto = (new Marea_contacto())->eliminar($contactoId);
                        if (!$respuestaContacto) {
                            throw new Exception("Error al eliminar el contacto.");
                        }
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode([
                'mensaje' => "Área fue {$mensajeTexto} correctamente",
            ]);

        } catch (Exception $ex) {
            $this->db->trans_rollback();
            echo json_encode(['error' => $ex->getMessage()]);
        }
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
        $params = $this->input->post('params');
        $idarea = 0;
        if (isset($params['idarea']) && !empty($params['idarea'])) {
            $idarea = $params['idarea'];
        }
        $resultado = $this->mcontacto->autoCompletado($idarea, $busqueda);
        echo json_encode(["items" => $resultado]);
    }

    /**
     * Busqueda del area con sus contactos
     */
    public function buscar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $id = $this->input->post('id');
        $area = $this->marea->buscarPorId($id);
        $contactos = [];
        if (!empty($area)) {
            $contactos = $this->mcontacto->areaContactos($area->id_area);
        }
        echo json_encode([
            'area' => $area,
            'contactos' => $contactos,
        ]);
    }

}