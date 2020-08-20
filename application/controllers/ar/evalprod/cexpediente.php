<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cexpediente
 *
 * @property mexpediente mexpediente
 * @property mproveedor mproveedor
 * @property mproducto mproducto
 * @property marea marea
 * @property mevaluar mevaluar
 */
class Cexpediente extends CI_Controller
{
    /**
     * Ruta para el ingreso de FICHA
     * @var string
     */
    private $carpetaFICHA = '1/04/07/FICHAS/';

    /**
     * Ruta para el ingreso de PDF
     * @var string
     */
    private $carpetaPDF = '1/04/07/PDF/';


    /**
     * Cexpediente constructor.
     */
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('ar/evalprod/mexpediente', 'mexpediente');
        $this->load->model('ar/evalprod/mproveedor', 'mproveedor');
        $this->load->model('ar/evalprod/mproducto', 'mproducto');
        $this->load->model('ar/evalprod/mevaluar', 'mevaluar');
        $this->load->model('ar/evalprod/marea', 'marea');
    }

    /**
     * Lista de ingreso de expedientes
     */
    public function lista()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $fdesde = $this->input->post('fdesde');
        $fhasta = $this->input->post('fhasta');
        $ccliente = $this->input->post('ccliente');
        $cproveedor = $this->input->post('cproveedor');
        $expedientes = $this->input->post('expediente');

        $ccliente = (empty($ccliente)) ? '00005' : $ccliente;
        $fdesde = ($fdesde == '%') ? null : substr($fdesde, 6, 4) . '-' . substr($fdesde, 3, 2) . '-' . substr($fdesde, 0, 2);
        $fhasta = ($fhasta == '%') ? null : substr($fhasta, 6, 4) . '-' . substr($fhasta, 3, 2) . '-' . substr($fhasta, 0, 2);

        $parametros = array(
            '@ccliente' => $ccliente,
            '@cproveedor' => $cproveedor,
            '@expediente' => (empty($expedientes)) ? '%' : "%{$expedientes}%",
            '@fdesde' => $fdesde,
            '@fhasta' => $fhasta,
        );
        $resultado = $this->mexpediente->lista($parametros);
        echo json_encode($resultado);
    }

    /**
     * Devuelve la lista de productos
     */
    public function lista_productos()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $parametros = array(
            '@id_expediente' => $this->input->post('id_expediente')
        );
        $resultado = $this->mproducto->lista($parametros);
        echo json_encode($resultado);
    }

    /**
     * Buscar expediente
     * @param int $id
     */
    public function buscar($id = 0)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $expediente = $this->mexpediente->buscarPorId($id);
        $area = null;
        $proveedor = null;
        if (!empty($expediente)) {
            $area = $this->marea->buscarPorId($expediente->id_area);
            $proveedor = $this->mproveedor->buscarPorId($expediente->id_proveedor);
        }
        echo json_encode([
            'datos' => [
                'expediente' => $expediente,
                'area' => $area,
                'proveedor' => $proveedor,
            ]
        ]);
    }

    /**
     * Busca el producto de un expediente
     * @param $id
     */
    public function buscar_producto($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $producto = $this->mproducto->buscarPorId($id);
        echo json_encode([
            'datos' => [
                'producto' => $producto,
            ]
        ]);
    }

    /**
     * Crea o edita un expediente
     */
    public function guardar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $proveedor = $this->mproveedor->buscarPorId($this->input->post('cboProveedorreg'));
            if (empty($proveedor)) {
                throw new Exception('Debe elegir un Proveedor.');
            }
            $area = $this->marea->buscarPorId($this->input->post('cboAreareg'));
            if (empty($area)) {
                throw new Exception('Debes elegir un área');
            }
            $contactoTottus = $this->input->post('cboContacto');
            if (empty($contactoTottus)) {
                throw new Exception('Debes elegir un Contact. Tottus');
            }
            $freg = $this->input->post('FechaReg');
            $arrayDocumentos = $this->input->post('documentos');

            $documentos = '';
            if (is_array($arrayDocumentos) && !empty($arrayDocumentos)) {
                $documentos = implode("-", $arrayDocumentos);
            }
            $this->db->trans_begin();
            $respuesta = $this->mexpediente->guardar([
                '@id_expediente' => $this->input->post('hdnIdexpe'),
                '@expediente' => $this->input->post('txtexpe'),
                '@fecha' => substr($freg, 6, 4) . '-' . substr($freg, 3, 2) . '-' . substr($freg, 0, 2),
                '@id_proveedor' => $proveedor->id_proveedor,
                '@id_area' => $area->id_area,
                '@area_contacto' => $contactoTottus,
                '@proveedor_nuevo' => 2, // Nunca sera un proveedor nuevo
                '@documentos' => $documentos,
                '@estado' => 1,
                '@observaciones' => '',
                '@ccliente' => '00005',
                '@accion' => $this->input->post('hdnAccion')
            ]);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode(['datos' => $respuesta[0]]);
        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Elimina un expediente
     */
    public function eliminar()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $id = $this->input->post('id');
            $objExpediente = $this->mexpediente->buscarPorId($id);
            if (empty($objExpediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }
            $productos = $this->mproducto->lista([
                '@id_expediente' => $this->input->post('id_expediente')
            ]);
            $this->db->trans_begin();
            if (!empty($productos)) {
                foreach($productos as $key => $producto) {
                    $evaluacion = $this->mevaluar->buscarExpediente($objExpediente->id_expediente, $producto->id_producto);
                    if (!empty($evaluacion)) {
                        $eliminarEvaluacion = $this->mevaluar->eliminar($evaluacion->id_evaluador);
                        if (!$eliminarEvaluacion) {
                            throw new Exception('El Producto ' . ($key + 1) .  ': La evaluación no pudo ser eliminada.');
                        }
                    }
                    $eliminarProducto = $this->mproducto->eliminar($producto->id_producto, $objExpediente->id_expediente);
                    if (!$eliminarProducto) {
                        throw new Exception('El Producto ' . ($key + 1) .  ': no pudo ser eliminado.');
                    }
                }
            }
            $eliminarExpediente = $this->mexpediente->eliminar($objExpediente->id_expediente);
            if (!$eliminarExpediente) {
                throw new Exception('El expediente no pudo ser eliminado.');
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode(['mensaje' => "Expediente {$objExpediente->expediente} fue eliminado correctamente."]);
        } catch (Exception $ex) {
            $this->db->trans_rollback();
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Guarda la cantidad de productos
     */
    public function guardar_cantidad_productos()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $objExpediente = $this->mexpediente->buscarPorId($this->input->post('id_expediente'));
            if (empty($objExpediente)) {
                throw new Exception('Expediente no pudo ser encontrado.');
            }
            $cantidadProductos = $this->input->post('agregar');
            if ($cantidadProductos < 0 && $cantidadProductos > 12) {
                throw new Exception('La Cantidad de expedientes no es valido.');
            }
            $this->db->trans_begin();
            $parametros = array(
                '@id_expediente' => $objExpediente->id_expediente,
                '@agregar' => $cantidadProductos
            );
            $respuesta = $this->mproducto->guardarCantidad($parametros);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode([
                'datos' => $respuesta
            ]);
        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Guarda los datos del producto
     */
    public function guardar_producto()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $hdnIdexpe = $this->input->post('hdnIdexpe');
            $mhdnIdproductos = $this->input->post('mhdnIdproductos');
            $mtxtCodigoean = $this->input->post('mtxtCodigoean');
            $mtxtDescrip = $this->input->post('mtxtDescrip');
            $mtxtMarca = $this->input->post('mtxtMarca');
            $mtxtPresent = $this->input->post('mtxtPresent');
            $mtxtFabri = $this->input->post('mtxtFabri');
            $cboTipodoc = $this->input->post('cboTipodoc');
            $mtxtNrodoc = $this->input->post('mtxtNrodoc');
            $FechaEmi = $this->input->post('FechaEmi');
            $FechaVence = $this->input->post('FechaVence');
            $cboGrasaSatu = $this->input->post('cboGrasaSatu');
            $cboAzucar = $this->input->post('cboAzucar');
            $cboSodio = $this->input->post('cboSodio');
            $cboGrasaTrans = $this->input->post('cboGrasaTrans');
            $mtxtObserva = $this->input->post('mtxtObserva');

            $expediente = $this->mexpediente->buscarPorId($hdnIdexpe);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado al registrar el producto.');
            }
            $producto = $this->mproducto->buscarPorId($mhdnIdproductos);
            if (empty($producto)) {
                throw new Exception('El producto no pudo ser encontrado. Vuelva a intentarlo.');
            }

            $this->db->trans_begin();

            $this->mproducto->guardar([
                '@id_producto' => $producto->id_producto,
                '@codigo' => trim($mtxtCodigoean),
                '@descripcion' => trim($mtxtDescrip),
                '@marca' => trim($mtxtMarca),
                '@presentacion' => trim($mtxtPresent),
                '@fabricante' => trim($mtxtFabri),
                '@tipo_codigo' => $cboTipodoc,
                '@rs' => trim($mtxtNrodoc),
                '@fecha_emision' => trim($FechaEmi),
                '@fecha_vcto' => trim($FechaVence),
                '@grasas_saturadas' => $cboGrasaSatu,
                '@azucar' => $cboAzucar,
                '@sodio' => $cboSodio,
                '@grasas_trans' => $cboGrasaTrans,
                '@observacion' => trim($mtxtObserva),
                '@observacion_cli' => '',
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
     * Elimina un producto de un expediente
     */
    public function eliminar_producto()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {
            $id_producto = $this->input->post('id_producto');
            $id_expediente = $this->input->post('id_expediente');
            $expediente = $this->mexpediente->buscarPorId($id_expediente);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }
            $producto = $this->mproducto->buscarPorId($id_producto);
            if (empty($producto)) {
                throw new Exception('El producto a eliminar no pudo ser encontrado. Vuelva a intentarlo.');
            }
            if (!$this->mproducto->eliminar($producto->id_producto, $expediente->id_expediente)) {
                throw new Exception('El Producto no pudo ser eliminado, vuelva a intentarlo.');
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Error en el proceso de ejecución.');
            }
            $this->db->trans_commit();
            echo json_encode([
                'datos' => $producto
            ]);

        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Guardar una ficha en el expediente
     */
    public function guardar_ficha()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {

            $ficha_id_expediente = $this->input->post('ficha_id_expediente');
            $expediente = $this->mexpediente->buscarPorId($ficha_id_expediente);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }
            $nombreficha = 'expediente_' . $expediente->id_expediente . '-' . $expediente->fecha . '.pdf';
            $rutaficha = $this->carpetaFICHA . $nombreficha;

            $config['upload_path'] = RUTA_ARCHIVOS . $this->carpetaFICHA;
            $config['file_name'] = $nombreficha;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '60048';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!($this->upload->do_upload('ficha_arhivo'))) {
                throw new Exception($this->upload->display_errors());
            } else {
                $expediente->ruta_ficha = $rutaficha; // Se almacena para devolverlo como respuesta
                $actualizar = $this->mexpediente->actualizar($expediente->id_expediente, [
                    'ruta_ficha' => $rutaficha
                ]);
                if (!$actualizar) {
                    throw new Exception('No se pudo actualizar la ficha cargada. Vuelva a intentarlo.');
                }
            }

            echo json_encode([
                'datos' => $expediente
            ]);

        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Elimina de la ficha de expediente
     */
    public function eliminar_ficha()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {

            $id = $this->input->post('id');
            $expediente = $this->mexpediente->buscarPorId($id);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }

            $rutaFicha = RUTA_ARCHIVOS . $expediente->ruta_ficha;
            if (file_exists($rutaFicha)) {
                unlink($rutaFicha);
            }

            $actualizar = $this->mexpediente->actualizar($expediente->id_expediente, [
                'ruta_ficha' => null
            ]);

            $expediente->ruta_ficha = null;
            echo json_encode([
                'datos' => $expediente
            ]);

        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Guardar un PDF en el expediente
     */
    public function guardar_pdf()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {

            $ficha_id_expediente = $this->input->post('pdf_id_expediente');
            $expediente = $this->mexpediente->buscarPorId($ficha_id_expediente);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }
            $nombreficha = 'expediente_' . $expediente->id_expediente . '-' . $expediente->fecha . '.pdf';
            $rutaficha = $this->carpetaPDF . $nombreficha;

            $config['upload_path'] = RUTA_ARCHIVOS . $this->carpetaPDF;
            $config['file_name'] = $nombreficha;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '60048';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!($this->upload->do_upload('pdf_arhivo'))) {
                throw new Exception($this->upload->display_errors());
            } else {
                $expediente->ruta_expediente = $rutaficha; // Se almacena para devolverlo como respuesta
                $actualizar = $this->mexpediente->actualizar($expediente->id_expediente, [
                    'ruta_expediente' => $rutaficha
                ]);
                if (!$actualizar) {
                    throw new Exception('No se pudo actualizar la ficha cargada. Vuelva a intentarlo.');
                }
            }

            echo json_encode([
                'datos' => $expediente
            ]);

        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Elimina de el PDF de expediente
     */
    public function eliminar_pdf()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        try {

            $id = $this->input->post('id');
            $expediente = $this->mexpediente->buscarPorId($id);
            if (empty($expediente)) {
                throw new Exception('El expediente no pudo ser encontrado.');
            }

            $rutaFicha = RUTA_ARCHIVOS . $expediente->ruta_expediente;
            if (file_exists($rutaFicha)) {
                unlink($rutaFicha);
            }

            $actualizar = $this->mexpediente->actualizar($expediente->id_expediente, [
                'ruta_expediente' => null
            ]);

            $expediente->ruta_expediente = null;
            echo json_encode([
                'datos' => $expediente
            ]);

        } catch (Exception $ex) {
            echo json_encode(['error' => $ex->getMessage()]);
        }
    }

}

