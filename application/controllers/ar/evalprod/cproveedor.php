<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

/**
 * Class Cproveedor
 *
 * @property mproveedor mproveedor
 */
class Cproveedor extends FS_Controller
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
            $id = $this->input->post('mhdnIdproveedor');
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
            /*$validarRuc = $this->mproveedor->buscarPorRuc($ruc, $id);
            if (!empty($validarRuc)) {
                throw new Exception('El RUC del Proveedor ya existe.');
            }*/
            $this->db->trans_begin();
            $parametros = array(
                '@id_proveedor' => $id,
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

	/**
	 * Realiza la descarga de proveedores
	 */
    public function exportar()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {

			$ccliente = $this->session->userdata('s_ccliente');
			$ccliente = (empty($ccliente)) ? '00005' : $ccliente; // por defecto es 00005
			$nombre = $this->input->post('nombre');
			$ruc = $this->input->post('ruc');
			$resultado = $this->mproveedor->lista($ccliente, $nombre, $ruc);

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setTitle('Proveedores');

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);

			$sheet->setCellValue('A1', 'LISTA DE PROVEEDORES')
				->mergeCells('A1:G1');

			$sheet->setCellValue('A2', 'PROVEEDOR')
				->setCellValue('B2', 'RUC')
				->setCellValue('C2', 'CONTACTO 1')
				->setCellValue('D2', 'EMAIL 1')
				->setCellValue('E2', 'CONTACTO 2')
				->setCellValue('F2', 'EMAIL 2')
				->setCellValue('G2', 'TELEFONO');

			if (!empty($resultado)) {
				$pos = 3;
				foreach ($resultado as $key => $value) {
					$sheet->setCellValue('A' . $pos, $value->nombre);
					$sheet->setCellValue('B' . $pos, $value->ruc);
					$sheet->setCellValue('C' . $pos, $value->contacto_p);
					$sheet->setCellValue('D' . $pos, $value->email_p);
					$sheet->setCellValue('E' . $pos, $value->contacto_q);
					$sheet->setCellValue('F' . $pos, $value->email_q);
					$sheet->setCellValue('G' . $pos, $value->telefono);
					++$pos;
				}
			}

			$titulo = [
				'font' => [
					'name' => 'Arial',
					'size' => 12,
					'color' => array('rgb' => 'FFFFFF'),
					'bold' => true,
				],
				'fill' => [
					'fillType' => Fill::FILL_SOLID,
					'startColor' => [
						'rgb' => '29B037'
					]
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => Border::BORDER_THIN,
						'color' => [
							'rgb' => '000000'
						]
					]
				],
				'alignment' => [
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'vertical' => Alignment::VERTICAL_CENTER,
					'wrapText' => true,
				],
			];
			$cabecera = [
				'font' => [
					'name' => 'Arial',
					'size' => 10,
					'color' => array('rgb' => 'FFFFFF'),
					'bold' => true,
				],
				'fill' => [
					'fillType' => Fill::FILL_SOLID,
					'startColor' => [
						'rgb' => '29B037'
					]
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => Border::BORDER_THIN,
						'color' => [
							'rgb' => '000000'
						]
					]
				],
				'alignment' => [
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'vertical' => Alignment::VERTICAL_CENTER,
					'wrapText' => true,
				],
			];
			$sheet->getStyle('A1:G1')->applyFromArray($titulo);
			$sheet->getStyle('A2:G2')->applyFromArray($cabecera);

			foreach (range('A', 'G') as $column) {
				$sheet->getColumnDimension($column)->setAutoSize(true);
			}

			$writer = new Xlsx($spreadsheet);
			$filename = 'proveedores_' . date('Ymd') . '.xlsx';
			$path = RUTA_ARCHIVOS . '../../temp/' . $filename;
			$writer->save($path);

			$this->result['status'] = 200;
			$this->result['message'] = 'Se realizo la exportación correctamente.';
			$this->result['data'] = $filename;

		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Realiza la descarga del archivo
	 */
	public function download()
	{
		$fileName = $this->input->get('filename');
		$this->load->helper('download');
		$pathFile = RUTA_ARCHIVOS . '../../temp/' . $fileName;
		if (!file_exists($pathFile)) {
			show_404();
		}
		force_download($pathFile, null, false, true);
	}

}
