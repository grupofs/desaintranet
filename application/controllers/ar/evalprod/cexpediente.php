<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class Cexpediente
 *
 * @property mexpediente mexpediente
 * @property mproveedor mproveedor
 * @property mproducto mproducto
 * @property marea marea
 * @property mevaluar mevaluar
 * @property marea_contacto marea_contacto
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
        $this->load->model('ar/evalprod/marea_contacto', 'marea_contacto');
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
		$mostrarVencidos = $this->input->post('mostrar_vencidos');
		$mostrarVencidos = (empty($mostrarVencidos)) ? 0 : $mostrarVencidos;

        $ccliente = (empty($ccliente)) ? '00005' : $ccliente;
        $fdesde = ($fdesde == '') ? null : substr($fdesde, 6, 4) . '-' . substr($fdesde, 3, 2) . '-' . substr($fdesde, 0, 2);
        $fhasta = ($fhasta == '') ? null : substr($fhasta, 6, 4) . '-' . substr($fhasta, 3, 2) . '-' . substr($fhasta, 0, 2);

        $parametros = array(
            '@ccliente' => $ccliente,
            '@cproveedor' => (empty($cproveedor)) ? 0 : $cproveedor,
            '@expediente' => (empty($expedientes)) ? '%' : "%{$expedientes}%",
            '@fdesde' => $fdesde,
            '@fhasta' => $fhasta,
        );
        $resultado = $this->mexpediente->lista($parametros);
		$resultadoExpedientes = [];
		if (!empty($resultado)) {
			// Si no se toma en cuenta el filtro de vencidos, se muestra el resultado
			if (!$mostrarVencidos) {
				$resultadoExpedientes = $resultado;
			} else {
				$fechaActual = \Carbon\Carbon::now('America/Lima');
				foreach ($resultado as $key => $value) {
					$producto = (new mproducto())->primerProducto($value->id_expediente);
					if (!empty($producto)) {
						if (!empty($producto->f_evaluado) && validateDate($producto->f_evaluado, 'Y-m-d')) {
							$evaluacion = $this->mevaluar->buscarExpediente($value->id_expediente, $producto->id_producto);
							if (!empty($evaluacion)) {
								// Solo para los de status Observado
								if ($evaluacion->status == 3) {
									$estado = $value->destado;
									$fechaPorVencer = \Carbon\Carbon::createFromFormat('Y-m-d', $producto->f_evaluado, 'America/Lima');
									$fechaVencido = \Carbon\Carbon::createFromFormat('Y-m-d', $producto->f_evaluado, 'America/Lima');
									// Por Vencer
									$fechaPorVencer->addWeekdays(13);
									if ($fechaActual->gte($fechaPorVencer)) {
										$estado = 'Por Vencer';
									}
									// Vencido
									$fechaVencido->addWeekdays(15);
									if ($fechaActual->gt($fechaVencido)) {
										$estado = 'Vencido';
									}
									// Solo se muestran los "Por vencer y Vencidos"
									if ($estado == 'Por Vencer' || $estado == 'Vencido') {
										$value->destado = $estado;
										$resultadoExpedientes[] = $value;
									}
								}
							}
						}
					}
				}
			}
		}
        echo json_encode($resultadoExpedientes);
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
        $areaContacto = null;
        $proveedor = null;
        if (!empty($expediente)) {
            $area = $this->marea->buscarPorId($expediente->id_area);
            if (!empty($expediente->area_contacto)) {
                $areaContacto = $this->marea_contacto->buscarPorNombre($expediente->area_contacto);
            }
            $proveedor = $this->mproveedor->buscarPorId($expediente->id_proveedor);
        }
        echo json_encode([
            'datos' => [
                'expediente' => $expediente,
                'area' => $area,
                'area_contacto' => $areaContacto,
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
            $areaContacto = $this->marea_contacto->buscarPorId($this->input->post('cboContacto'));
            $contacto = '';
            // Solo si exsite el contacto será guardado
            if (!empty($areaContacto)) {
                $contacto = $areaContacto->contacto;
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
                '@area_contacto' => $contacto,
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
            // Elimina la evaluacionP
            $evaluacion = $this->mevaluar->buscarExpediente($expediente->id_expediente, $producto->id_producto);
            if (!empty($evaluacion)) {
                $eliminarEvaluacion = $this->mevaluar->eliminar($evaluacion->id_evaluador);
                if (!$eliminarEvaluacion) {
                    throw new Exception('La evaluación no pudo ser eliminada.');
                }
            }
            // Elimina el producto
            $eliminarProducto = $this->mproducto->eliminar($producto->id_producto, $expediente->id_expediente);
            if (!$eliminarProducto) {
                throw new Exception('El Producto: no pudo ser eliminado.');
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
            $rutaficha = RUTA_ARCHIVOS . $this->carpetaFICHA;
            $rutaarchivoficha = $this->carpetaFICHA . $nombreficha;
            
            !is_dir($rutaficha) && @mkdir($rutaficha, 0777, true);

            $config['upload_path']      = $rutaficha;
            $config['file_name']        = $nombreficha;
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '60048';
            $config['overwrite'] 		= TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!($this->upload->do_upload('ficha_arhivo'))) {
                throw new Exception($this->upload->display_errors());
            } else {
                $expediente->ruta_ficha = $rutaarchivoficha; // Se almacena para devolverlo como respuesta
                $actualizar = $this->mexpediente->actualizar($expediente->id_expediente, [
                    'ruta_ficha' => $rutaarchivoficha
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
            $nombrepdf = 'expediente_' . $expediente->id_expediente . '-' . $expediente->fecha . '.pdf';
            $rutapdf = RUTA_ARCHIVOS . $this->carpetaPDF;
            $rutaarchivopdf = $this->carpetaPDF . $nombrepdf;
            
            !is_dir($rutapdf) && @mkdir($rutapdf, 0777, true);

            $config['upload_path']      = $rutapdf;
            $config['file_name']        = $nombrepdf;
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '60048';
            $config['overwrite'] 		= TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!($this->upload->do_upload('pdf_arhivo'))) {
                throw new Exception($this->upload->display_errors());
            } else {
                $expediente->ruta_expediente = $rutaarchivopdf; // Se almacena para devolverlo como respuesta
                $actualizar = $this->mexpediente->actualizar($expediente->id_expediente, [
                    'ruta_expediente' => $rutaarchivopdf
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

    /** 
     * Recupera los cartas a proveedores
     */
    public function genPdfcargorecepcion($id_expediente) 
    { 
        $this->load->library('pdfgenerator');
        
		
		$parametros = array( 
            '@id_expediente'   	=> $id_expediente,
		);
		$resultado = $this->mexpediente->pdfCargoRecepcion_cab($parametros);
		if ($resultado){
			foreach($resultado as $row){
				$vfecha         = $row->vfecha;
				$fecha 		    = $row->fecha;
				$expediente 	= $row->expediente;
				$proveedor 	    = $row->proveedor;
				$contacto_p 	= $row->contacto_p;
				$email_p 		= $row->email_p;
				$contacto_q 	= $row->contacto_q;
				$email_q 		= $row->email_q;
				$area 		    = $row->area;
				$area_contacto 	= $row->area_contacto;
				$Tiporpov 	    = $row->Tiporpov;
                $documentos     = $row->documentos;                
                
                $date = date_create($fecha);  
                date_add($date,date_interval_create_from_date_string("15 days"));
                $fechavence = date_format($date, "d-m-Y");
                
                $html = '<html>
                    <head>
                        <title>'.$expediente.'</title>
                        <link rel="shortcut icon" href="./assets/images/ico-gfs.ico" class="img-circle" type="image/x-icon" />
                        <style>
                            @page {
                                margin: 0.5in 0.5in 0.5in 0.5in;;
                            }
                            .teacherPage {
                                    page: teacher;
                                    page-break-after: always;
                            }
                            p{
                                font-weight: bold;
                                font: 15px arial, sans-serif;
                                text-align: center;
                            }
                            table tbody tr td{
                                font-family: "Helvetica";
                                font-size: 9pt;
                            }
                            .cuerpo {
                                text-align: justify;
                            }
                            img.izquierda {
                                float: left;
                            }
                            img.derecha {
                                float: right;
                            }
                        </style>
                    </head>
                    <body>';

                $html .= '<div class="teacherPage">				
                    <page>					
                    <table width="700px" style="font-family:arial; font-size:10px;">
                        <tr>
                            <td align="left" colspan="2">
                                <img src="' . base_url('FTPfileserver/Imagenes/formatos/10407/cargo/00005/tottus.png') . '" width="120" height="40" />
                            </td>
                            <td align="right" colspan="2">
                                <img src="' . base_url('FTPfileserver/Imagenes/formatos/10407/cargo/00005/gfs_75.png') . '" width="120" height="40" />
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="4">
                            <p>CARGO DE RECEPCION DE MUESTRAS PARA EVALUACION</p>
                            </td>
                        </tr>
                        <tr style="height:25px;"><td colspan="4"></td></tr>
                        <tr>
                            <td width="80px">Fecha:</td>
                            <td width="250px">'.$vfecha.'</td>
                            <td width="80px">Expediente:</td>
                            <td width="250px">'.$expediente.'</td>
                        </tr>
                        <tr style="height:15px;"><td colspan="4"></td></tr>
                        <tr>
                            <td>Proveedor:</td>
                            <td colspan="3">'.$proveedor.'</td>
                        </tr>
                        <tr style="height:15px;"><td colspan="4"></td></tr>
                        <tr>
                            <td>Contacto 1:</td>
                            <td>'.$contacto_p.'</td>
                            <td>Email 1:</td>
                            <td>'.$email_p.'</td>
                        </tr>
                        <tr style="height:15px;"><td colspan="4"></td></tr>
                        <tr>
                            <td>Contacto 2:</td>
                            <td>'.$contacto_q.'</td>
                            <td>Email 2:</td>
                            <td>'.$email_q.'</td>
                        </tr>
                        <tr style="height:15px;"><td colspan="4"></td></tr>                        
                        <tr>
                            <td>Area:</td>
                            <td>'.$area.'</td>
                            <td>Contacto TOTTUS:</td>
                            <td>'.$area_contacto.'</td>
                        </tr>
                        <tr style="height:15px;"><td colspan="4"></td></tr> 
                        <tr>
                            <td>Tipo Prov.:</td>
                            <td>'.$Tiporpov.'</td>
                            <td></td>
                            <td></td>
                        </tr> 
                    </table>  
                    <p>&nbsp;</p>';
                    $m = '0';
                    $f = '0';
                    $r = '0';
                    $h = '0';
                    $l = '0';
                    $i = '0';
                    $o = '0';

                    $expediente_r=explode("-",$documentos);
                    $cantidad=count($expediente_r);
                    for($z=0;$z<$cantidad;$z++){
                        if($expediente_r[$z]==1){
                            $m = '1';
                        }
                        if($expediente_r[$z]==2){
                            $f = '1';
                        }
                        if($expediente_r[$z]==3){
                            $r = '1';
                        }
                        if($expediente_r[$z]==4){
                            $h = '1';
                        }
                        if($expediente_r[$z]==5){
                            $l = '1';
                        }
                        if($expediente_r[$z]==6){
                            $i = '1';
                        }
                        if($expediente_r[$z]==7){
                            $o = '1';
                        }
                    }
                $html .= '<table width="700px" class="marco" align="center" style="font-family:arial; font-size:10px; border: 1px solid black;">
                    <tr>
                        <td style="height:10px;" colspan="8" align="center">DOCUMENTOS</td>
                    </tr>
                    <tr>
                        <td width="70px" style="height:10px;">&nbsp;Muestra</td>
                        <td width="15px" align="left">
                            <?php if($m=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>                   
                        </td>
                        <td width="80px">&nbsp;Ficha Tecnica</td>
                        <td width="15px" align="left">
                            <?php if($f=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>   
                        </td>
                        <td width="60px">&nbsp;RS/NSO/RD</td>
                        <td width="15px" align="left">
                            <?php if($r=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>  
                        </td>
                        <td width="60px">&nbsp;Hoja de Seguridad</td>
                        <td width="15px" align="left">
                            <?php if($h=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>  
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px;">&nbsp;Licencia de Func.</td>
                        <td align="left">
                            <?php if($l=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>  
                        </td>
                        <td colspan="2" >&nbsp;Inspeccion Higienico Sanitaria</td>
                        <td colspan="2" align="left">
                            <?php if($i=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>  
                        </td>
                        <td>&nbsp;Otros</td>
                        <td  align="left">
                            <?php if($o=="1"){ ?> 
                            <img src="' . base_url('FTPfileserver\Imagenes\formatos\10407\cargo/correcto.jpg') . '" alt="Smiley face" width="15" height="15" align="center">
                            <?php } ?>  
                        </td>
                    </tr>
                    </table>
                    <p>&nbsp;</p>';
                $html .= '<table width="700px" class="marco" align="center" style="font-family:arial; font-size:10px; border: 1px solid black;">
                    <tr>
                        <td width="20px">N°</td>
                        <td width="120px" align="center">EAN</td>
                        <td width="280px" align="center">Descripción</td>
                        <td width="130px" align="center">Marca</td>
                        <td width="120px" align="center">Presentación</td>
                    </tr>';
                    $resultadoDet = $this->mexpediente->pdfCargoRecepcion_det($parametros);
                    if ($resultadoDet){
                        $posDet = 1;
                        foreach($resultadoDet as $rowDet){
                            $codigo         = $rowDet->codigo;
                            $descripcion 	= $rowDet->descripcion;
                            $marca 	        = $rowDet->marca;
                            $presentacion 	= $rowDet->presentacion;

                            $html .= '<tr style="font-family:arial; font-size:9px;">
                                <td>'.$posDet.'</td>
                                <td>'.$codigo.'</td>
                                <td>'.$descripcion.'</td>
                                <td>'.$marca.'</td>
                                <td>'.$presentacion.'</td>
                            </tr>';
                            $posDet++;
                        }
                    }
                $html .= '</table>
                    <p>&nbsp;</p>
                    <div align="justify" style="padding-right: 15px; padding-left: 15px;">  
                        <span style="font-family:arial; font-size:13px; font-weight: bold" align="justify">
                        	Importante: En caso de presentar muestras para la evaluación, puede ser abierta o rasgada, considerar que las muestras no regresarán para foto y otros. Es preciso señalar que usted
cuenta con 15 dias ÚTILES(' . $fechavence . ') contados a partir de la recepcion de las muestras para proceder con su recojo sin considerar el estado de evaluación (Aprobado /
Observado / Rechazado). El recojo no aplica para los productos que tienen un tiempo menor o igual a 15 diás de viada útil.
						</span>
                    </div>
                    </page>
                    </div>';
			}
		}
        $html .= '</body></html>';
		$filename = $expediente;
		$this->pdfgenerator->generate($html, $filename);
        //echo $html;
	}

	/**
	 * @throws PHPExcel_Exception
	 * @throws PHPExcel_Reader_Exception
	 * @throws PHPExcel_Writer_Exception
	 */
	public function exportar()
	{
		try {
			$fdesde = $this->input->get('fdesde');
			$fhasta = $this->input->get('fhasta');
			$ccliente = $this->input->get('ccliente');
			$cproveedor = $this->input->get('cproveedor');
			$expedientes = $this->input->get('expediente');
			$ccliente = (empty($ccliente)) ? '00005' : $ccliente;
			$fdesde = ($fdesde == '') ? null : substr($fdesde, 6, 4) . '-' . substr($fdesde, 3, 2) . '-' . substr($fdesde, 0, 2);
			$fhasta = ($fhasta == '') ? null : substr($fhasta, 6, 4) . '-' . substr($fhasta, 3, 2) . '-' . substr($fhasta, 0, 2);

			$objPHPExcel = new Spreadsheet();
			$sheet = $objPHPExcel->getActiveSheet();

			$sheet->setCellValue('A1', 'LISTA DE EXPEDIENTES');
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->mergeCells('A1:G1');
			$sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			$sheet
				->setCellValue('A2', '#')
				->setCellValue('B2', 'Expediente')
				->setCellValue('C2', 'Proveedor')
				->setCellValue('D2', 'Total')
				->setCellValue('E2', 'Fecha Ingreso')
				->setCellValue('F2', 'Fecha Limite')
				->setCellValue('G2', 'Estado');

			$colorTitulo = array(
				'font' => array(
					'name' => 'Verdana',
					'bold' => true,
					'size' => 10,
					'color' => array(
						'rgb' => '000000'
					)
				)
			);

			$fondoTitulo = array(
				'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => '28a745'
				)
			);

			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($colorTitulo);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->applyFromArray($fondoTitulo);
			$objPHPExcel->getActiveSheet()->setTitle('Expedientes');

			$resultado = $this->mexpediente->lista([
				'@ccliente' => $ccliente,
				'@cproveedor' => (empty($cproveedor) || $cproveedor == 'null') ? 0 : $cproveedor,
				'@expediente' => (empty($expedientes)) ? '%' : "%{$expedientes}%",
				'@fdesde' => $fdesde,
				'@fhasta' => $fhasta,
			]);
			if (!empty($resultado)) {
				$pos = 3;
				foreach ($resultado as $key => $item) {
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $pos, ($key + 1));
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $pos, $item->expediente);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $pos, $item->proveedor);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $pos, $item->total);
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $pos, $item->fecha);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $pos, $item->flimite);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $pos, $item->destado);
					++$pos;
				}
			}

			foreach (range('A', 'G') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$objPHPExcel->setActiveSheetIndex(0);

			$nombre = 'expedientes' . date('dmy');
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="' . $nombre . '.xlsx"');
			$writer->save("php://output");
			exit();

		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
	}

}

