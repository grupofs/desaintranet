<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

/**
 * Class ctramite
 *
 * @property mcliente mcliente
 * @property mtramite mtramite
 * @property mproducto mproducto
 * @property mgrupoempresarial mgrupoempresarial
 * @property mptramiteregulatoriopte mptramiteregulatoriopte
 * @property mpproductoregulatorio mpproductoregulatorio
 * @property mentidadregulatoria mentidadregulatoria
 * @property mttramite mttramite
 * @property mtramitereguladora mtramitereguladora
 * @property mdocumentoregulatorio mdocumentoregulatorio
 * @property mpdocumentoregulatorio mpdocumentoregulatorio
 * @property mpdocumentoregulatorioarchivo mpdocumentoregulatorioarchivo
 */
class ctramite extends FS_Controller
{
	/**
	 * Ruta para el ingreso de FICHA
	 * @var string
	 */
	private $carpetaDocumento = '1nullnull/';

	/**
	 * ctramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mcliente', 'mcliente');
		$this->load->model('ar/ope/mtramite', 'mtramite');
		$this->load->model('ar/ope/mproducto', 'mproducto');
		$this->load->model('ar/ope/mgrupoempresarial', 'mgrupoempresarial');
		$this->load->model('ar/ope/mptramiteregulatoriopte', 'mptramiteregulatoriopte');
		$this->load->model('ar/ope/mpproductoregulatorio', 'mpproductoregulatorio');
		$this->load->model('ar/ope/mentidadregulatoria', 'mentidadregulatoria');
		$this->load->model('ar/ope/mttramite', 'mttramite');
		$this->load->model('ar/ope/mtramitereguladora', 'mtramitereguladora');
		$this->load->model('ar/ope/mdocumentoregulatorio', 'mdocumentoregulatorio');
		$this->load->model('ar/ope/mpdocumentoregulatorio', 'mpdocumentoregulatorio');
		$this->load->model('ar/ope/mpdocumentoregulatorioarchivo', 'mpdocumentoregulatorioarchivo');
	}

	/**
	 * Crear o Edita un AR
	 */
	public function guardar()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			// Usuario
			$s_cusuario = $this->session->userdata('s_cusuario');

			$fechaInicio = Carbon::now('America/Lima')->format('Y-m-d'); // No se toma en cuenta por que se tomara la fecha del servidor
			$fechaCierre = null; // Solo podra modificado cuando se cierre el AR
			$estado = $this->input->post('ar_estado');
			$codigo = $this->input->post('ar_codigo');
			$grupoEmpresarialID = $this->input->post('ar_grupo_empresarial');
			$clienteID = $this->input->post('ar_cliente_id');

			// Valida el cliente
			$objGrupoEmpresarial = $this->mgrupoempresarial->buscar($grupoEmpresarialID);
			if (empty($objGrupoEmpresarial)) {
				throw new Exception('Debe elegir un grupo empresarial.');
			}
			// Valida el cliente
			$objCliente = $this->mcliente->buscar($clienteID);
			if (empty($objCliente)) {
				throw new Exception('Debe elegir un cliente');
			}
			// Se guada el AR
			$dataAR = $this->mtramite->guardar($codigo, $fechaInicio, $fechaCierre, $estado, $objGrupoEmpresarial->cinternopte, $clienteID, $s_cusuario);
			$this->result['status'] = 200;
			$this->result['message'] = "A.R. {$dataAR['CASUNTOREGULATORIO']} fue creado correctamente.";
			$this->result['data'] = [
				'ar' => $dataAR,
				'grupoEmpresarial' => $objGrupoEmpresarial,
				'cliente' => $objCliente,
			];
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Guarda todos los datos de los tramties
	 */
	public function guardar_datos()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			// Usuario
			$s_cusuario = $this->session->userdata('s_cusuario');

			// Tramite regulatorio
			$asuntoregulatorio_id = $this->input->post('asuntoregulatorio_id');
			$objAsuntoRegulatorio = $this->mtramite->buscar($asuntoregulatorio_id);
			if (empty($objAsuntoRegulatorio)) {
				throw new Exception('El código de tramite no pudo ser encontrado.');
			}
			if ($objAsuntoRegulatorio->SCIERRE != 'A') {
				throw new Exception('El Asunto Regulatorio se encuentra cerrado. No puede actualizar su información.');
			}
			// Datos de la entidad
			$tramite_entidad_id = $this->input->post('tramite_entidad_id');
			$tramite_tipo_producto_id = $this->input->post('tramite_tipo_producto_id');

			if (empty($tramite_tipo_producto_id)) {
				throw new Exception('Debe elegir el Tipo de producto.');
			}

			$this->db->trans_begin();

			$objEntidad = $this->mentidadregulatoria->buscar($tramite_entidad_id);
			if (empty($objEntidad)) {
				throw new Exception('Debe elegir la entidad.');
			}

			$carga_registro_nro_seguimiento = (string)$this->input->post('carga_registro_nro_seguimiento');
			$carga_registro_nro_seguimiento = (is_null($carga_registro_nro_seguimiento)) ? '' : $carga_registro_nro_seguimiento;
			$carga_registro_nro_expediente = (string)$this->input->post('carga_registro_nro_expediente');
			$carga_registro_nro_expediente = (is_null($carga_registro_nro_expediente)) ? '' : $carga_registro_nro_expediente;
			$carga_registro_nro_dr = (string)$this->input->post('carga_registro_nro_dr');
			$carga_registro_nro_dr = (is_null($carga_registro_nro_dr)) ? '' : $carga_registro_nro_dr;
			$carga_registro_estado = (string)$this->input->post('carga_registro_estado');
			$carga_registro_estado = (is_null($carga_registro_estado)) ? '' : $carga_registro_estado;
			$carga_registro_nro_rs = (string)$this->input->post('carga_registro_nro_rs');
			$carga_registro_nro_rs = (is_null($carga_registro_nro_rs)) ? '' : $carga_registro_nro_rs;
			$carga_registro_fecha_inicio = $this->input->post('carga_registro_fecha_inicio');
			$carga_registro_fecha_inicio = (is_null($carga_registro_fecha_inicio)) ? '' : $carga_registro_fecha_inicio;
			$carga_registro_fecha_final = $this->input->post('carga_registro_fecha_final');
			$carga_registro_fecha_final = (is_null($carga_registro_fecha_final)) ? '' : $carga_registro_fecha_final;

			$tramiteFechaInicio = '';
			if (!empty($carga_registro_fecha_inicio) && validateDate($carga_registro_fecha_inicio, 'd/m/Y')) {
				$tramiteFechaInicio = Carbon::createFromFormat('d/m/Y', $carga_registro_fecha_inicio, 'America/Lima')->format('Y-m-d');
			}

			$tramiteFechaFinal = '';
			if (!empty($carga_registro_fecha_final) && validateDate($carga_registro_fecha_final, 'd/m/Y')) {
				$tramiteFechaFinal = Carbon::createFromFormat('d/m/Y', $carga_registro_fecha_final, 'America/Lima')->format('Y-m-d');
			}

			// Datos de la entidad y tramite
			$tramite_id = $this->input->post('tramite_id');
			$tramite_operation = $this->input->post('tramite_operation');
			$tramiteItem = 1;
			$tramites = [];
			if (!empty($tramite_operation) && is_array($tramite_operation)) {
				foreach ($tramite_operation as $key => $value) {
					$tramiteOperation = (isset($tramite_operation[$key])) ? $tramite_operation[$key] : '';
					$tramiteId = (isset($tramite_id[$key])) ? $tramite_id[$key] : '';
					// Puede ser creado y/o actualizado
					if ($tramiteOperation == 0 || $tramiteOperation == 1) {
						$linea = "Linea Tramite {$tramiteItem}: ";
						// Solo se toma el primer registro
						$objTramite = $this->mtramitereguladora->buscarTramite($objEntidad->CENTIDADREGULA, $tramiteId);
						if (empty($objTramite)) {
							throw new Exception("{$linea}Debe elegir el tramite");
						}

						$objTramiteRegulatorio = new mptramiteregulatoriopte();
						$objTramiteRegulatorio->guardar(
							$objAsuntoRegulatorio->CASUNTOREGULATORIO,
							$objEntidad->CENTIDADREGULA,
							$tramiteId,
							'S',
							'R',
							'N',
							date('Y-m-d'),
							$carga_registro_nro_seguimiento,
							$carga_registro_nro_rs,
							$carga_registro_nro_expediente,
							$tramiteFechaInicio,
							$tramiteFechaFinal,
							$carga_registro_estado,
							$s_cusuario,
							'A',
							$carga_registro_nro_dr
						);
						++$tramiteItem;
						$tramites[] = $objTramite;
					}
				}
			}


			// Datos del producto
			$tramite_producto_id = $this->input->post('tramite_producto_id');
			$tramite_producto_fecha_estimada = $this->input->post('tramite_producto_fecha_estimada');
			$tramite_producto_comentario = $this->input->post('tramite_producto_comentario');

			if (!empty($tramite_producto_id) && is_array($tramite_producto_id)) {
				(new mpproductoregulatorio())->eliminarTodo($objAsuntoRegulatorio->CASUNTOREGULATORIO);
				foreach ($tramite_producto_id as $key => $value) {
					$tramiteProductoId = (isset($tramite_producto_id[$key])) ? (string)$tramite_producto_id[$key] : '';
					$tramiteProductoFechaEstimada = (isset($tramite_producto_fecha_estimada[$key])) ? (string)$tramite_producto_fecha_estimada[$key] : '';
					$tramiteProductoComentario = (isset($tramite_producto_comentario[$key])) ? (string)$tramite_producto_comentario[$key] : '';
					$itemProducto = ($key + 1);
					$lineaProducto = "Ítem Producto {$itemProducto}: ";
					if (empty($tramiteProductoId)) {
						throw new Exception("{$lineaProducto}Debe elegir el producto.");
					}

					if (empty($tramiteProductoFechaEstimada) || !validateDate($tramiteProductoFechaEstimada, 'd/m/Y')) {
						$tramiteProductoFechaEstimada = date('d/m/Y');
					}

					$tramiteProductoFechaEstimada = Carbon::createFromFormat('d/m/Y', $tramiteProductoFechaEstimada, 'America/Lima')->format('Y-m-d');
					$objProductoRegulatorio = new mpproductoregulatorio();
					$objProductoRegulatorio->guardar(
						$objAsuntoRegulatorio->CASUNTOREGULATORIO,
						$tramiteProductoId,
						$tramiteProductoFechaEstimada,
						trim($tramiteProductoComentario),
						$s_cusuario,
						'A'
					);
				}
			}

			if ($this->db->trans_status() == FALSE) {
				$this->db->trans_rollback();
				throw new Exception('Error en el proceso de ejecución');
			}
			$this->db->trans_commit();
			$this->result['status'] = 200;
			$this->result['message'] = 'Datos guardados correctamente.';
			$this->result['data'] = [
				'ar' => $objAsuntoRegulatorio,
			];

		} catch (Exception $ex) {
			$this->db->trans_rollback();
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Cierra el AR
	 */
	public function cerrar()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$id = $this->input->post('id');
			$objAsuntoRegulatorio = $this->mtramite->buscar($id);
			if (empty($objAsuntoRegulatorio)) {
				throw new Exception('El Asunto Regulatorio no pudo ser encontrado.');
			}
			$objAsuntoRegulatorio->SCIERRE = 'C';
			$data = ['SCIERRE' => 'C'];
			$this->mtramite->actualizar($objAsuntoRegulatorio->CASUNTOREGULATORIO, $data);
			$this->result['status'] = 200;
			$this->result['message'] = "Asunto Regulatorio {$objAsuntoRegulatorio->CASUNTOREGULATORIO} fue cerrado correctamente.";
			$this->result['data'] = $objAsuntoRegulatorio;
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Cierra el AR
	 */
	public function abrir()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$id = $this->input->post('id');
			$objAsuntoRegulatorio = $this->mtramite->buscar($id);
			if (empty($objAsuntoRegulatorio)) {
				throw new Exception('El Asunto Regulatorio no pudo ser encontrado.');
			}
			$objAsuntoRegulatorio->SCIERRE = 'A';
			$data = ['SCIERRE' => 'A'];
			$this->mtramite->actualizar($objAsuntoRegulatorio->CASUNTOREGULATORIO, $data);
			$this->result['status'] = 200;
			$this->result['message'] = "Asunto Regulatorio {$objAsuntoRegulatorio->CASUNTOREGULATORIO} fue abierto correctamente.";
			$this->result['data'] = $objAsuntoRegulatorio;
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * @param int $id
	 */
	public function buscar($id = 0)
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {

			// Asunto regulatorio
			$objAsuntoRegulatorio = $this->mtramite->buscar($id);
			if (empty($objAsuntoRegulatorio)) {
				throw new Exception('El Asunto Regulatorio no pudo ser encontrado.');
			}
			$objCliente = $this->mcliente->buscar($objAsuntoRegulatorio->CCLIENTE);
			if (empty($objCliente)) {
				throw new Exception('El Cliente del Asunto Regulatorio no pudo ser encontrado.');
			}
			$objGrupoEmpresarial = $this->mgrupoempresarial->buscar($objCliente->CGRUPOEMPRESARIAL);
			if (empty($objGrupoEmpresarial)) {
				throw new Exception('El Grupo Empresarial del Asunto Regulatorio no pudo ser encontrado.');
			}
			$objAsuntoRegulatorio->FAPERTURA = Carbon::createFromFormat('Y-m-d', $objAsuntoRegulatorio->FAPERTURA, 'America/Lima')->format('d/m/Y');
			if (!empty($objAsuntoRegulatorio->FCIERRE) && validateDate($objAsuntoRegulatorio->FCIERRE, 'Y-m-d')) {
				$objAsuntoRegulatorio->FCIERRE = Carbon::createFromFormat('Y-m-d', $objAsuntoRegulatorio->FCIERRE, 'America/Lima')->format('d/m/Y');
			}

			// Tramite
			$tramites = $this->mptramiteregulatoriopte->buscarAR($objAsuntoRegulatorio->CASUNTOREGULATORIO);
			$tramitePrimero = null;
			$objEntidad = null;
			$tipoProducto = null;
			$documentos = [];
			if (!empty($tramites)) {
				$tramitePrimero = $tramites[0];
				// Fecha Inicio
				if (!empty($tramitePrimero->FEMISIONREGISTRO) && validateDate($tramitePrimero->FEMISIONREGISTRO, 'Y-m-d')) {
					$tramitePrimero->FEMISIONREGISTRO = Carbon::createFromFormat('Y-m-d', $tramitePrimero->FEMISIONREGISTRO, 'America/Lima')->format('d/m/Y');
				}
				// Fecha Venc.
				if (!empty($tramitePrimero->FVENCIMIENTOREGISTRO) && validateDate($tramitePrimero->FVENCIMIENTOREGISTRO, 'Y-m-d')) {
					$tramitePrimero->FVENCIMIENTOREGISTRO = Carbon::createFromFormat('Y-m-d', $tramitePrimero->FVENCIMIENTOREGISTRO, 'America/Lima')->format('d/m/Y');
				}
				$objEntidad = $this->mentidadregulatoria->buscar($tramitePrimero->CENTIDADREGULA);
				if (!empty($objEntidad)) {
					$objTramite = $this->mtramitereguladora->buscarTramite($tramitePrimero->CENTIDADREGULA, $tramitePrimero->CTRAMITE);
					if (!empty($objTramite)) {
						$tipoProducto = $this->mttramite->buscarTipoProducto($tramitePrimero->CENTIDADREGULA, $objTramite->ZCTIPOCATEGORIAPRODUCTO);
					}
				}

				// Documentos
				$arrayTramites = [];
				foreach ($tramites as $key => $tramite) {
					$arrayTramites[] = $tramite->CTRAMITE;
				}
				// Se obtiene los documentos de los tramites elegidos
				$resDocumentos = $this->mdocumentoregulatorio->obtenerDocumentos($tramitePrimero->CENTIDADREGULA, $arrayTramites, '');
				$documentos = [];
				if (!empty($resDocumentos)) {
					foreach ($resDocumentos as $key => $documento) {
						$buscarDocumento = $this->mpdocumentoregulatorio->buscar($objAsuntoRegulatorio->CASUNTOREGULATORIO, $documento->CENTIDADREGULA, $documento->CTRAMITE, $documento->CDOCUMENTO);
						// Solo se debe mostrar los documento antiguos que existan en el tramite y/o los actuales activos
						if (!empty($buscarDocumento) || $documento->SREGISTRO == 'A') {
							$documentoTipo = $documento->TIPO;
							$ddocumento = $documento->DDOCUMENTO;
							$dtramite = '';
							$archivos = [];
							if (!empty($buscarDocumento)) {
								$buscarDocumento = $buscarDocumento[0]; // Se toma el primer documento, ya que debe existir solo uno
								$ddocumento = $buscarDocumento->DDOCUMENTO;
								$dtramite = $buscarDocumento->DTRAMITE;
								// Archivos del documento
								if (!empty($buscarDocumento->DUBICACIONFILESERVER)) {
									$archivos[] = (object) [
										'CDOCUMENTOREGULAARCHIVO' => null,
										'CASUNTOREGULATORIO' => $buscarDocumento->CASUNTOREGULATORIO,
										'CENTIDADREGULA' => $buscarDocumento->CENTIDADREGULA,
										'CTRAMITE' => $buscarDocumento->CTRAMITE,
										'CDOCUMENTO' => $ddocumento,
										'DUBICACIONFILESERVER' => $buscarDocumento->DUBICACIONFILESERVER,
										'SCARGADOCUMENTO' => 'R',
										'CUSUARIOCREA' => null,
										'CUSUARIOMODIFICA' => null,
										'SREGISTRO' => 'A',
									];
								}
								$otrosArchivos = (new mpdocumentoregulatorioarchivo())->buscarDocumentos(
									$buscarDocumento->CASUNTOREGULATORIO,
									$buscarDocumento->CENTIDADREGULA,
									$buscarDocumento->CTRAMITE,
									$buscarDocumento->CDOCUMENTO
								);
								$archivos = array_merge($archivos, $otrosArchivos);
							}
							// Se agrega el documento
							$documentos[] = (Object)[
								'CASUNTOREGULATORIO' => $objAsuntoRegulatorio->CASUNTOREGULATORIO,
								'CENTIDADREGULA' => $documento->CENTIDADREGULA,
								'CTRAMITE' => $documento->CTRAMITE,
								'CDOCUMENTO' => $documento->CDOCUMENTO,
								'TIPO' => $documentoTipo,
								'DDOCUMENTO' => $ddocumento,
								'DTRAMITE' => $dtramite,
								'DNUEVODOCUMENTO' => null,
								'DUBICACIONFILESERVER' => null,
								'SCARGADOCUMENTO' => 'E',
								'CUSUARIOCREA' => null,
								'CUSUARIOMODIFICA' => null,
								'SREGISTRO' => 'A',
								'archivos' => $archivos
							];
						}
					}
				}
			}

			// Productos
			$productos = $this->mpproductoregulatorio->buscarProductos($objAsuntoRegulatorio->CASUNTOREGULATORIO);

			$this->result['status'] = 200;
			$this->result['data'] = [
				'ar' => $objAsuntoRegulatorio,
				'grupoEmpresarial' => $objGrupoEmpresarial,
				'cliente' => $objCliente,
				// Tramite
				'tramites' => $tramites,
				'tramite' => $tramitePrimero,
				'entidad' => $objEntidad,
				'tipoProducto' => $tipoProducto,
				// Productos
				'productos' => $productos,
				// Documentos
				'documentos' => $documentos,
			];

		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Realiza la busqueda de los tramites
	 */
	public function filtro(): void
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			// Paginación
			$limit = $this->input->post('filtro_limit');
			$offset = $this->input->post('filtro_offset');
			$typeResult = $this->input->post('type_result');
			// Por defecto será siempre 80
			$limit = (is_numeric($limit) && $limit > 0 && $limit <= 10000) ? intval($limit) : 80;
			// Se le aumenta 1 para contar el ultimo registro anterior
			$offset = (is_numeric($offset) && $offset > 1 && $offset <= 10000) ? $offset : 1;
			// Filtro
			$fechaInicio = $this->input->post('filtro_fecha_inicio');
			$fechaFinal = $this->input->post('filtro_fecha_fin');
			$tipoEstado = $this->input->post('filtro_tipo_estado');
			$cliente = $this->input->post('filtro_cliente');
			$cliente = (is_null($cliente)) ? '' : trim($cliente);
			$nroAR = $this->input->post('filtro_nro_ar');
			$nroAR = (is_null($nroAR)) ? '' : trim($nroAR);
			$codigoRs = $this->input->post('filter_codigo_rs');
			$codigoRs = (is_null($codigoRs)) ? '' : trim($codigoRs);
			$estadoTramite = $this->input->post('filter_estado_tramite');
			$estadoTramite = (is_null($estadoTramite)) ? '' : trim($estadoTramite);
			$entidad = $this->input->post('filter_entidad');
			$entidad = (is_null($entidad)) ? '' : trim($entidad);
			$tipoProducto = $this->input->post('filter_tipo_producto');
			$tipoProducto = (is_null($tipoProducto)) ? '' : trim($tipoProducto);
			$tramite = $this->input->post('filter_tramite');
			$tramite = (is_null($tramite)) ? '' : trim($tramite);
			$categoria = $this->input->post('filter_categoria');
			$categoria = (is_null($categoria)) ? '' : trim($categoria);
			$producto = $this->input->post('filter_producto');
			$producto = (is_null($producto)) ? '' : trim($producto);
			$marca = $this->input->post('filter_marca');
			$marca = (is_null($marca)) ? '' : trim($marca);
			$expediente = $this->input->post('filter_expediente');
			$expediente = (!is_null($expediente)) ? '' : trim($expediente);

			if (!empty($fechaInicio) && !validateDate($fechaInicio, 'd/m/Y')) {
				throw new Exception('La Fecha de Inicio no es valido.');
			}
			if (!empty($fechaFinal) && !validateDate($fechaFinal, 'd/m/Y')) {
				throw new Exception('La Fecha de Final no es valido.');
			}

			$fechaInicio = Carbon::createFromFormat('d/m/Y', $fechaInicio, 'America/Lima')
				->setTime(0, 0, 0)
				->format('Y-m-d H:i:s');
			$fechaFinal = Carbon::createFromFormat('d/m/Y', $fechaFinal, 'America/Lima')
				->setTime(23, 59, 59)
				->format('Y-m-d H:i:s');

			$total = $this->mtramite->filtrarTramitesTotal(
				$fechaInicio,
				$fechaFinal,
				$tipoEstado,
				$cliente,
				$nroAR,
				$codigoRs,
				$estadoTramite,
				$entidad,
				$tipoProducto,
				$tramite,
				$categoria,
				$producto,
				$marca,
				$expediente
			);
			$data = $this->mtramite->filtrarTramites(
				$fechaInicio,
				$fechaFinal,
				$tipoEstado,
				$cliente,
				$nroAR,
				$codigoRs,
				$estadoTramite,
				$entidad,
				$tipoProducto,
				$tramite,
				$categoria,
				$producto,
				$marca,
				$expediente,
				$limit,
				$offset
			);
			$result = [];
			if (!empty($data)) {
				$tramites = [];
				foreach ($data as $key => $value) {
					$beforeCcliente = (isset($data[$key + 1])) ? $data[$key + 1] : null;
					$nuevoCliente = (!empty($beforeCcliente) && $beforeCcliente->ccliente == $value->ccliente);
					// Solo si el tipo de filtro es 2 (con productos) no se filtra la busqueda
					if ($typeResult == 2) {
						$tramites[] = $value;
					} else {
						// En caso se filtre por tramite se debe validar
						if (empty($beforeCcliente) || array_search($value->casuntoregulatorio, array_column($tramites, 'casuntoregulatorio')) === false) {
							$productos = [];
							foreach ($data as $keyProducto => $producto) {
								if ($value->casuntoregulatorio == $producto->casuntoregulatorio) {
									$productos[] = [
										'cproductocliente' => $producto->cproductocliente,
										'dproductocliente' => $producto->dproductocliente,
										'dmarca' => $producto->dmarca,
										'dnombreproducto' => $producto->dnombreproducto,
										'dmodeloproducto' => $producto->dmodeloproducto,
										'dregistrosanitario' => $producto->dregistrosanitario,
										'ffinregsanitario' => $producto->ffinregsanitario,
									];
								}
							}
							// Se guarda el Asunto Regulatorio por cabecera y sus productos
							$tramites[] = [
								'casuntoregulatorio' => $value->casuntoregulatorio,
								'cinternopte' => $value->cinternopte,
								'norden' => $value->norden,
								'fapertura' => $value->fapertura,
								'sregistro' => $value->sregistro,
								'drazonsocial' => $value->drazonsocial,
								'scierre' => $value->scierre,
								'textoscierre' => $value->textoscierre,
								'responsable' => $value->responsable,
								'productos' => $productos,
							];
						}
					}

					if (!$nuevoCliente) {
						$result[] = [
							'ccliente' => $value->ccliente,
							'customer' => $value->drazonsocial,
							'data' => $tramites,
						];
						$tramites = [];
					}
				}
			}
			$this->result['status'] = 200;
			// En caso se este en la siguiente pagina, debera disminuir uno
			$this->result['data']['pagination'] = (object)[
				'total' => numberFormat($total, 0, 'human'),
				'current_limit' => $limit,
				'current_offset' => $offset,
				'next_offset' => ((($offset + $limit) < $total) ? $offset + $limit : null),
				'previous_offset' => ($offset > 1) ? $offset - $limit : null,
				'start_offset' => 1,
				'end_offset' => ((ceil($total / $limit) * $limit) - $limit),
			];
			$this->result['data']['result'] = $result;
		} catch (\Carbon\Exceptions\Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Exporta los registros de Asunto regulatorio
	 * @void
	 */
	public function export(): void
	{
		try {

			$fechaInicio = $this->input->get('filtro_fecha_inicio');
			$fechaFinal = $this->input->get('filtro_fecha_fin');
			$tipoEstado = $this->input->get('filtro_tipo_estado');
			$cliente = $this->input->get('filtro_cliente');
			$nroAR = $this->input->get('filtro_nro_ar');

			$objPHPExcel = new PHPExcel();
			// Establecer propiedades
			$objPHPExcel->getProperties()
				->setCreator("GrupoFS")
				->setTitle("Exportar Asuntos Regulatorio")
				->setSubject("Asunto Regulatorio")
				->setDescription("Descargar en formato de lista los asuntos regulatorios")
				->setKeywords("Excel Office 2007 openxml php");

			// Agregar Informacion
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Tipo Estado')
				->setCellValue('B1', 'Cliente')
				->setCellValue('C1', 'Código A.R.')
				->setCellValue('D1', 'Fecha Inicio')
				->setCellValue('E1', 'Estado A.R.')
				->setCellValue('F1', 'Responsable')
				->setCellValue('G1', 'Cod. Producto')
				->setCellValue('H1', 'Descripción SAP')
				->setCellValue('I1', 'Producto')
				->setCellValue('J1', 'Marca')
//				->setCellValue('K1', 'Modelo/Tono/Variadades/Sub-marca')
				->setCellValue('K1', 'Registro Sanitario')
				->setCellValue('L1', 'Fecha Venc.');
			// Renombrar Hoja
			$objPHPExcel->getActiveSheet()->setTitle('Lista de A.R.');

			$colorTitulo = array(
				'font' => array(
					'name' => 'Verdana',
					'bold' => true,
					'size' => 10,
					'color' => array(
						'rgb' => 'FFFFFF'
					)
				)
			);

			$fondoTitulo = array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => '28a745'
				)
			);

			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($colorTitulo);
			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->applyFromArray($fondoTitulo);

			if (!empty($fechaInicio) && !validateDate($fechaInicio, 'd/m/Y')) {
				throw new Exception('La Fecha de Inicio no es valido.');
			}
			if (!empty($fechaFinal) && !validateDate($fechaFinal, 'd/m/Y')) {
				throw new Exception('La Fecha de Final no es valido.');
			}

			$fechaInicio = Carbon::createFromFormat('d/m/Y', $fechaInicio, 'America/Lima')
				->setTime(0, 0, 0)
				->format('Y-m-d H:i:s');
			$fechaFinal = Carbon::createFromFormat('d/m/Y', $fechaFinal, 'America/Lima')
				->setTime(23, 59, 59)
				->format('Y-m-d H:i:s');

			$data = $this->mtramite->filtrarTramites(
				$fechaInicio,
				$fechaFinal,
				$tipoEstado,
				$cliente,
				$nroAR,
				0,
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				0
			);
			if (!empty($data)) {
				foreach ($data as $key => $value) {
					$pos = ($key + 2);
					$tramiteCierre = ($value->scierre === 'A') ? 'ffc107' : '28a745';
					$objPHPExcel->getActiveSheet()->getStyle('A' . $pos)->getFill()->applyFromArray([
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'startcolor' => [
							'rgb' => $tramiteCierre
						]
					]);
					if ($value->sregistro != 'A') {
						$objPHPExcel->getActiveSheet()->getStyle('A' . $pos . ':L' . $pos)->applyFromArray([
							'font' => array(
								'name' => 'Verdana',
								'bold' => true,
								'size' => 10,
								'color' => array(
									'rgb' => 'dc3545'
								)
							)
						]);
					}
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $pos, '');
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $pos, $value->drazonsocial);
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $pos, $value->casuntoregulatorio);
					$objPHPExcel->getActiveSheet()->setCellValue('D' . $pos, $value->fapertura);
					$objPHPExcel->getActiveSheet()->setCellValue('E' . $pos, $value->textoscierre);
					$objPHPExcel->getActiveSheet()->setCellValue('F' . $pos, $value->responsable);
					$objPHPExcel->getActiveSheet()->setCellValue('G' . $pos, $value->cproductocliente);
					$objPHPExcel->getActiveSheet()->setCellValue('H' . $pos, $value->dproductocliente);
					$objPHPExcel->getActiveSheet()->setCellValue('I' . $pos, $value->dnombreproducto);
					$objPHPExcel->getActiveSheet()->setCellValue('J' . $pos, $value->dmarca);
//					$objPHPExcel->getActiveSheet()->setCellValue('K' . $pos, $value->dmodeloproducto);
					$objPHPExcel->getActiveSheet()->setCellValue('K' . $pos, $value->dregistrosanitario);
					$objPHPExcel->getActiveSheet()->setCellValue('L' . $pos, $value->ffinregsanitario);
				}
			}

			foreach (range('A', 'L') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}

			// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
			$objPHPExcel->setActiveSheetIndex(0);
			// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="registro_asuntos_regulatorios.xlsx"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit();

		} catch (PHPExcel_Reader_Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		} catch (PHPExcel_Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Guarda el archivo del documento
	 */
	public function guardar_archivo()
	{
		try {

			// Usuario
			$s_cusuario = $this->session->userdata('s_cusuario');

			if (empty($_FILES['archivo_documento']['name'])) {
				throw new Exception('Debes elegir un archivo');
			}

			$asuntoregulatorio_id = $this->input->post('asuntoregulatorio_id');
			$objAsuntoRegulatorio = $this->mtramite->buscar($asuntoregulatorio_id);
			if (empty($objAsuntoRegulatorio)) {
				throw new Exception('El código de tramite no pudo ser encontrado.');
			}

			$tramite_entidad_id = $this->input->post('tramite_entidad_id');
			$tramite_tipo_producto_id = $this->input->post('tramite_tipo_producto_id');
			if (empty($tramite_tipo_producto_id)) {
				throw new Exception('Debe elegir el Tipo de producto.');
			}
			$objEntidad = $this->mentidadregulatoria->buscar($tramite_entidad_id);
			if (empty($objEntidad)) {
				throw new Exception('Debe elegir la entidad.');
			}

			$documentotramiteid = $this->input->post('documento_tramite_id');
			$documentoTipo = $this->input->post('documento_tipo');
			$documentoNombre = $this->input->post('documento_nombre');
			$documentoId = $this->input->post('documento_id');

			// Se verfica la ruta en caso no existe y se crea
			$rutaArchivoReal = RUTA_ARCHIVOS . $this->carpetaDocumento . $objAsuntoRegulatorio->CCLIENTE . '/' . $objAsuntoRegulatorio->CASUNTOREGULATORIO;
			if (!file_exists($rutaArchivoReal)) {
				mkdir($rutaArchivoReal, '0777', true);
			}
			$config['upload_path'] = $rutaArchivoReal . '/';
			$config['overwrite'] = true;
			$rutaArchivo = $this->carpetaDocumento . $objAsuntoRegulatorio->CCLIENTE . '/' . $objAsuntoRegulatorio->CASUNTOREGULATORIO . '/';
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			$this->db->trans_begin();

			$objTramite = $this->mtramitereguladora->buscarTramite($objEntidad->CENTIDADREGULA, $documentotramiteid);
			if (empty($objTramite)) {
				throw new Exception("Debe elegir el tramite para su documento.");
			}

			// Solo los nuevos se guardan como inactivo
			$sregistro = (intval($documentoId) >= 900 || empty($documentoId)) ? 'I' : 'A';
			$objDocumento = (new mdocumentoregulatorio())->guardar(
				$documentoId,
				$objEntidad->CENTIDADREGULA,
				$objTramite->CTRAMITE,
				$documentoNombre,
				$s_cusuario,
				$sregistro
			);
			$objDocumentoArchivo = new mpdocumentoregulatorio();
			$objDocumentoArchivo->guardar(
				$objAsuntoRegulatorio->CASUNTOREGULATORIO,
				$objEntidad->CENTIDADREGULA,
				$objTramite->CTRAMITE,
				$objDocumento->CDOCUMENTO,
				$documentoTipo,
				'',
				null,
				$s_cusuario,
				'A'
			);
			// En caso no exista se crea el archivo
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('archivo_documento')) {
				throw new Exception($this->upload->display_errors());
			}
			$archivo = $rutaArchivo . $this->upload->data('file_name');
			$objDocumentoArchivoActualizado = new mpdocumentoregulatorioarchivo();
			$objDocumentoArchivoActualizado->guardar(
				null,
				$objAsuntoRegulatorio->CASUNTOREGULATORIO,
				$objEntidad->CENTIDADREGULA,
				$objTramite->CTRAMITE,
				$objDocumento->CDOCUMENTO,
				$archivo,
				$s_cusuario,
				'A'
			);

			if ($this->db->trans_status() == FALSE) {
				$this->db->trans_rollback();
				throw new Exception('Error en el proceso de ejecución');
			}
			$this->db->trans_commit();
			$this->result['status'] = 200;
			$this->result['message'] = 'Datos guardados correctamente.';
			$this->result['data'] = [
				'ar' => $objAsuntoRegulatorio,
			];

		} catch (Exception $ex) {
			$this->db->trans_rollback();
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);

	}

	/**
	 * Eliminar archivo de un documento en el detalle
	 */
	public function eliminar_archivo()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$id = $this->input->post('id');
			$objDocumentoArchivo = $this->mpdocumentoregulatorioarchivo->buscar($id);
			if (empty($objDocumentoArchivo)) {
				throw new Exception('El archivo del documento no pudo ser encontrado.');
			}
			$this->mpdocumentoregulatorioarchivo->delete($id);
			if (!empty($objDocumentoArchivo->DUBICACIONFILESERVER) && file_exists('./FTPfileserver/Archivos/' . $objDocumentoArchivo->DUBICACIONFILESERVER)) {
				unlink(RUTA_ARCHIVOS . $objDocumentoArchivo->DUBICACIONFILESERVER);
			}
			$this->result['status'] = 200;
			$this->result['message'] = 'Archivo eliminado correctamnete.';
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Eliminar archivo de un documento
	 */
	public function eliminar_archivo_cab()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$casuntoregula = $this->input->post('casuntoregula');
			$centidadregula = $this->input->post('centidadregula');
			$ctramite = $this->input->post('ctramite');
			$cdocumento = $this->input->post('cdocumento');

			if (empty($cdocumento)) {
				throw new Exception('Falta de parametros para eliminar el archivo.');
			}

			$mdocumentoregula = $this->mpdocumentoregulatorio->buscar(
				$casuntoregula,
				$centidadregula,
				$ctramite,
				$cdocumento
			);

			if (empty($mdocumentoregula)) {
				throw new Exception('El archivo no pudo ser encontrado.');
			}

			if (!empty($mdocumentoregula[0]->DUBICACIONFILESERVER)) {
				$data = [
					'DUBICACIONFILESERVER' => null,
					'SCARGADOCUMENTO' => 'E',
				];
				$this->mpdocumentoregulatorio->actualizar(
					$casuntoregula,
					$centidadregula,
					$ctramite,
					$cdocumento,
					$data
				);
				if (file_exists('./FTPfileserver/Archivos/' . $mdocumentoregula[0]->DUBICACIONFILESERVER)) {
					unlink(RUTA_ARCHIVOS . $mdocumentoregula[0]->DUBICACIONFILESERVER);
				}
			}

			$this->result['status'] = 200;
			$this->result['message'] = 'Archivo principal eliminado correctamnete.';
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

}
