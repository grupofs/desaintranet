<?php

/**
 * Class cevaluar
 *
 * @property mexpediente mexpediente
 * @property mevaluar mevaluar
 * @property mproveedor mproveedor
 * @property mproducto mproducto
 * @property marea marea
 */
class cevaluar extends CI_Controller
{
    /**
     * cevaluar constructor.
     */
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('ar/evalprod/mexpediente', 'mexpediente');
        $this->load->model('ar/evalprod/mevaluar', 'mevaluar');
        $this->load->model('ar/evalprod/mproveedor', 'mproveedor');
        $this->load->model('ar/evalprod/mproducto', 'mproducto');
        $this->load->model('ar/evalprod/marea', 'marea');
    }

    /**
     * Guarda la evaluacion del expediente
     */
    public function guardar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {

            $hdnIdexpe = $this->input->post('hdnIdexpe');
            $objExpediente = $this->mexpediente->buscarPorId($hdnIdexpe);
            if (empty($objExpediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }
            $id_evaluador = $this->input->post('id_evaluador');
            $objEvaluar = $this->mevaluar->buscarPorId($id_evaluador);
            if (empty($objEvaluar)) {
                throw new Exception('La evaluación no pudo ser encontrado.');
            }
            $cboc_f = $this->input->post('cboc_f');
            $cbon_r = $this->input->post('cbon_r');
            $cbof_v = $this->input->post('cbof_v');
            $cboc_l_p = $this->input->post('cboc_l_p');
            $cbol_i = $this->input->post('cbol_i');
            $cboc_c_p = $this->input->post('cboc_c_p');
            $mtxtc_c = $this->input->post('mtxtc_c');
            $mtxtc_c_r = $this->input->post('mtxtc_c_r');
            $cboPais = $this->input->post('cboPais');
            $cboc_n = $this->input->post('cboc_n');
            $cbod_i = $this->input->post('cbod_i');
            $mtxtt_v_u = $this->input->post('mtxtt_v_u');
            $cbotiempo_m = $this->input->post('cbotiempo_m');
            $Fechaf_i_h = $this->input->post('Fechaf_i_h');
            $mtxtentidad = $this->input->post('mtxtentidad');
            $mtxtresponsable = $this->input->post('mtxtresponsable');
            $mtxtobservacion = $this->input->post('mtxtobservacion');
            $mtxtacuerdos = $this->input->post('mtxtacuerdos');
            $Fechafecha = $this->input->post('Fechafecha');
            $cbostatus = $this->input->post('cbostatus');
            $cboa_s = $this->input->post('cboa_s');
            $mtxtf_e_a_s = $this->input->post('mtxtf_e_a_s');
            $mtxtf_a_v_s = $this->input->post('mtxtf_a_v_s');
            $cbod_p = $this->input->post('cbod_p');
            $cboo_l = $this->input->post('cboo_l');
            $cboo_n = $this->input->post('cboo_n');

            $Fechaf_i_h = (!empty($Fechaf_i_h)) ? substr($Fechaf_i_h, 6, 4) . '-' . substr($Fechaf_i_h, 3, 2) . '-' . substr($Fechaf_i_h, 0, 2) : null;
            $Fechafecha = (!empty($Fechafecha)) ? substr($Fechafecha, 6, 4) . '-' . substr($Fechafecha, 3, 2) . '-' . substr($Fechafecha, 0, 2) : null;

            if (empty($cboPais)) {
                throw new Exception('Debes elegir el Pais en la evaluación.');
            }
            if (empty($cbostatus)) {
                throw new Exception('Debes elegir el Status en la evaluación.');
            }

            $this->db->trans_begin();

            $this->mevaluar->guardar([
                '@id_evaluador' => $objEvaluar->id_evaluador,
                '@c_f' => $cboc_f,
                '@n_r' => $cbon_r,
                '@f_v' => $cbof_v,
                '@c_l_p' => $cboc_l_p,
                '@l_i' => $cbol_i,
                '@c_c_p' => $cboc_c_p,
                '@c_c' => trim($mtxtc_c),
                '@c_c_r' => trim($mtxtc_c_r),
                '@pais' => $cboPais,
                '@c_n' => $cboc_n,
                '@d_i' => $cbod_i,
                '@t_v_u' => trim($mtxtt_v_u),
                '@tiempo_m' => $cbotiempo_m,
                '@f_i_h' => $Fechaf_i_h,
                '@entidad' => trim($mtxtentidad),
                '@responsable' => trim($mtxtresponsable),
                '@observacion' => trim($mtxtobservacion),
                '@acuerdo' => trim($mtxtacuerdos),
                '@fecha' => $Fechafecha,
                '@status' => $cbostatus,
                '@a_s' => $cboa_s,
                '@f_e_a_s' => trim($mtxtf_e_a_s),
                '@f_a_v_s' => trim($mtxtf_a_v_s),
                '@d_p' => $cbod_p,
                '@o_l' => $cboo_l,
                '@o_n' => $cboo_n
            ]);

            $this->mexpediente->actualizar($objExpediente->id_expediente, [
                'estado' => 2
            ]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode([
                'datos' => $_POST
            ]);

        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Guardar la evaluacion del producto
     */
    public function guardar_producto()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $hdnIdexpe = $this->input->post('hdnIdexpe');
            $mhdnIdproductos = $this->input->post('mhdnIdproductos');
            $mtxtCodigoean = trim($this->input->post('mtxtCodigoean'));
            $mtxtDescrip = trim($this->input->post('mtxtDescrip'));
            $mtxtMarca = trim($this->input->post('mtxtMarca'));
            $mtxtPresent = trim($this->input->post('mtxtPresent'));
            $mtxtFabri = trim($this->input->post('mtxtFabri'));
            $cboTipodoc = $this->input->post('cboTipodoc');
            $mtxtNrodoc = trim($this->input->post('mtxtNrodoc'));
            $FechaEmi = $this->input->post('FechaEmi');
            $FechaVence = $this->input->post('FechaVence');
            $FechaEval = $this->input->post('FechaEval');
            $cboGrasaSatu = $this->input->post('cboGrasaSatu');
            $cboAzucar = $this->input->post('cboAzucar');
            $cboSodio = $this->input->post('cboSodio');
            $cboGrasaTrans = $this->input->post('cboGrasaTrans');
            $mtxtObserva = trim($this->input->post('mtxtObserva'));
            $mtxtObservaCli = trim($this->input->post('mtxtObservaCli'));
            $FechaLevanta = $this->input->post('FechaLevanta');
            $mtxtTiempoEval = $this->input->post('mtxtTiempoEval');

            $expediente = $this->mexpediente->buscarPorId($hdnIdexpe);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado al registrar el producto.');
            }
            $producto = $this->mproducto->buscarPorId($mhdnIdproductos);
            if (empty($producto)) {
                throw new Exception('El producto no pudo ser encontrado. Vuelva a intentarlo.');
            }
            $FechaEval = trim($FechaEval);
            if (empty($FechaEval)) {
                throw new Exception('La Fecha de evaluación no puede estar vacío.');
            }
            $FechaLevanta = trim($FechaLevanta);
            if (empty($FechaLevanta)) {
                throw new Exception('La Fecha de levantamiento no puede estar vacío.');
            }

            $this->db->trans_begin();

            $this->mevaluar->guardarProducto([
                '@id_producto' => $producto->id_producto,
                '@codigo' => $mtxtCodigoean,
                '@descripcion' => $mtxtDescrip,
                '@marca' => trim($mtxtMarca),
                '@presentacion' => trim($mtxtPresent),
                '@fabricante' => trim($mtxtFabri),
                '@tipo_codigo' => $cboTipodoc,
                '@rs' => trim($mtxtNrodoc),
                '@fecha_emision' => trim($FechaEmi),
                '@fecha_vcto' => trim($FechaVence),
                '@f_evaluado' => substr($FechaEval, 6, 4) . '-' . substr($FechaEval, 3, 2) . '-' . substr($FechaEval, 0, 2),
                '@f_levantamiento' => substr($FechaLevanta, 6, 4) . '-' . substr($FechaLevanta, 3, 2) . '-' . substr($FechaLevanta, 0, 2),
                '@tiempo_evaluacion' => $mtxtTiempoEval,
                '@observacion' => trim($mtxtObserva),
                '@grasas_saturadas' => $cboGrasaSatu,
                '@azucar' => $cboAzucar,
                '@sodio' => $cboSodio,
                '@grasas_trans' => $cboGrasaTrans,
                '@observacion_cli' => trim($mtxtObservaCli),
                '@ccliente' => '00005',
                '@accion' => 'A'
            ]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode([
                'datos' => $_POST
            ]);
        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Busqueda de paises
     */
    public function autocompletado_paises()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $busqueda = $this->input->post('busqueda');
        $busqueda = (empty($busqueda)) ? '' : $busqueda;
        $resultado = $this->mevaluar->autoCompletadoPais($busqueda);
        echo json_encode(["items" => $resultado]);
    }

    /**
     * Devuelve la evaluacion del expediente por producto
     */
    public function buscar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $idExpediente = $this->input->post('id_expediente');
        $idProducto = $this->input->post('id_producto');
        $evaluacion = $this->mevaluar->buscarExpediente($idExpediente, $idProducto);
        echo json_encode(['datos' => [
            'evaluacion' => $evaluacion,
        ]]);
    }

    /**
     * Busqueda de estados del expediente
     * @param int $id
     */
    public function buscar_estados($id = 0)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $items = $this->mevaluar->obtenerCantidadEstados($id);
        echo json_encode(['items' => $items]);
    }

}