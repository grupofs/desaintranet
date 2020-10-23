<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

/**
 * Class ctramite
 *
 * @property mcliente mcliente
 * @property mtramite mtramite
 * @property mproducto mproducto
 */
class ctramite extends FS_Controller
{

	/**
	 * ctramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mcliente', 'mcliente');
		$this->load->model('ar/ope/mtramite', 'mtramite');
		$this->load->model('ar/ope/mproducto', 'mproducto');
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

			$total = $this->mtramite->filtrarTramitesTotal($fechaInicio, $fechaFinal, $tipoEstado, $cliente, $nroAR);
			$data = $this->mtramite->filtrarTramites($fechaInicio, $fechaFinal, $tipoEstado, $cliente, $nroAR, $limit, $offset);
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

			$data = $this->mtramite->filtrarTramites($fechaInicio, $fechaFinal, $tipoEstado, $cliente, $nroAR, 0);
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

}
