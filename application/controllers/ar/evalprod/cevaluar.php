<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

/**
 * Class cevaluar
 *
 * @property mexpediente mexpediente
 * @property mevaluar mevaluar
 * @property mproveedor mproveedor
 * @property mproducto mproducto
 * @property marea marea
 * @property memail memail
 * @property marea_contacto marea_contacto
 */
class cevaluar extends FS_Controller
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
		$this->load->model('memail', 'memail');
		$this->load->model('ar/evalprod/marea_contacto', 'marea_contacto');
	}

	/**
	 * Vista para la evaluación del producto
	 * @param int $idExpediente
	 * @param int $uri
	 */
	public function producto($idExpediente = 0, $uri = 0)
	{
		if (!$this->session->userdata("login")) {
			redirect('clogin');
		}
		$this->session->time = time();

		$this->layout->js([
			versionar_archivo('script/ar/evalprod/proveedor/buscar.js'),
			versionar_archivo('script/ar/evalprod/proveedor/generar.js'),
			versionar_archivo('script/ar/evalprod/buscar_pais.js'),
			versionar_archivo('script/ar/evalprod/expediente/evaluar/generar.js'),
			versionar_archivo('script/ar/evalprod/expediente/evaluar/producto.js'),
			versionar_archivo('script/ar/evalprod/expediente/evaluar/evaluar.js')
		]);

		$expediente = $this->mexpediente->buscarPorId($idExpediente);
		if (empty($expediente)) {
			show_404();
		}
		$proveedor = $this->mproveedor->buscarPorId($expediente->id_proveedor);

		$resultado = $this->mproducto->lista([
			'@id_expediente' => $expediente->id_expediente,
		]);
		$totalResultado = count($resultado);

		$producto = (isset($resultado[$uri])) ? $resultado[$uri] : [];
		$evaluacion = [];
		if (!empty($producto)) {
			$evaluacion = $this->mevaluar->buscarExpediente($expediente->id_expediente, $producto->id_producto);
		}

		$this->load->library('pagination');
		$this->pagination->initialize([
			'base_url' => base_url('ar/evalprod/cevaluar/producto/' . $expediente->id_expediente),
			'total_rows' => $totalResultado,
			'per_page' => 1,
			'uri_segment' => 6,
			'num_links' => 50,
			'reuse_query_string' => TRUE,
			'full_tag_open' => '<nav aria-label="Lista Productos" ><ul class="pagination" >',
			'full_tag_lose' => '</ul></nav>',
			'first_tag_open' => '<li class="page-item" >',
			'first_tag_close' => '</li>',
			'last_tag_open' => '<li class="page-item" >',
			'last_tag_close' => '</li>',
			'cur_tag_open' => '<li class="page-item active" ><a class="page-link" href="javascript:void(0)">',
			'cur_tag_close' => '</a></li>',
			'next_tag_open' => '<li class="page-item" >',
			'next_tag_close' => '</a></li>',
			'prev_tag_open' => '<li class="page-item" >',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li class="page-item" >',
			'num_tag_close' => '</li>',
			'last_link' => FALSE,
		]);

		$this->parser->parse('seguridad/vprincipal', [
			'vista' => 'Ventana',
			'content_for_layout' => 'ar/evalprod/expediente/evaluar/vevaluar_expediente',
			'datos_ventana' => [
				'expediente' => $expediente,
				'proveedor' => $proveedor,
				'total_rows' => $totalResultado,
				'pagination' => $this->pagination->create_links(),
				'producto' => $producto,
				'evaluacion' => $evaluacion,
			]
		]);
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

			$Fechaf_i_h = (!empty($Fechaf_i_h)) ? $Fechaf_i_h : null;
			$Fechafecha = (!empty($Fechafecha)) ? substr($Fechafecha, 6, 4) . '-' . substr($Fechafecha, 3, 2) . '-' . substr($Fechafecha, 0, 2) : null;

			if (empty($cboPais)) {
				throw new Exception('Debes elegir el Pais en la evaluación.');
			}
			if (is_null($cbostatus)) {
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

	/**
	 * Envío de correo
	 */
	public function envio_correo()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$id = $this->input->post('id_expediente');
			$objExpediente = $this->mexpediente->buscarPorId($id);
			if (empty($objExpediente)) {
				throw new Exception('El expediente no pudo ser encontrado.');
			}

			$evaluaciones = $this->mevaluar->obtenerCantidadEstados($objExpediente->id_expediente);
			if (empty($evaluaciones)) {
				throw new Exception('No se encontraron evaluaciones. Vuelva a intentarlo.');
			}
			// Se valida que no existan evaluaciones pendientes
			foreach ($evaluaciones as $evaluacion) {
				$status = $evaluacion->flagEstado;
				if (is_null($status) || $status == '') {
					throw new Exception('Aún tienes evaluaciones pendientes.');
				}
			}

			$from = "intranet@grupofs.com";
			$namfrom = "PLATAFORMA GRUPOFS";

			$replyto = "tottusevalproduct@grupofs.com";
			$replynam = "TOTTUS EVALUACION";

			//cargamos la libreria email de ci
			$this->load->library("email");

			$emailData = $this->memail->obtenerConfiguracion('001');
			if (empty($emailData)) {
				throw new Exception('Ocurrio un error al buscar la configuración del envío de correo.');
			}
			//configuracion para grupofs
			$configGrupofs = array(
				'protocol' => 'smtp',
				'smtp_crypto' => 'tls',
				'smtp_host' => $emailData->DSERVER,
				'smtp_port' => $emailData->NPUERTO,
				'smtp_user' => $emailData->DUSER,
				'smtp_pass' => $emailData->DPASSWORD,
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'newline' => "\r\n",
				'crlf' => "\r\n",
			);
			$expediente = $this->memail->buscarExpediente($objExpediente->id_expediente);
			if (empty($expediente)) {
				throw new Exception('No se encontro evaluaciones para enviar.');
			}

			// Envío del correo
			foreach ($expediente as $rowpv) {
				$para = $rowpv->destino;
				$copia = $rowpv->cc;

				$mensaje = "";
				$mensaje .= "Estimado Cliente: <br><br>Le informamos que, el resultado de la evaluaci&oacute;n de sus productos ha sido el siguiente:<br><br>";
				$mensaje .= '<br>
					<br>';

				$proveedor = $rowpv->proveedor;
				$expediente = $rowpv->expediente;
				$status = $rowpv->status;
				//$fecha_limite = $rowpv->flimite;
				// Agregando 15 dias habilitando de Lunes a Viernes
				$fechaActual = Carbon::createFromFormat('Y-m-d', $rowpv->fecha, 'America/Lima');
				$fecha_limite = $fechaActual->addWeekdays(15)->format('d-m-Y');

				$nombre_status = "";
				$color_status = '';
				$letra_status = "";
				switch ($status) {
					case 1:
						$nombre_status = "APROBADO";
						$color_status = 'bgcolor="#33FF00"';
						$letra_status = "A";
						break;
					case 2:
						$nombre_status = "RECHAZADO";
						$color_status = 'bgcolor="#FF0000"';
						$letra_status = "R";
						break;
					case 3:
						$nombre_status = "OBSERVADO";
						$color_status = 'bgcolor="#FFFF00"';
						$letra_status = "O";
						break;
					case 4:
						$nombre_status = "PENDIENTE VIDA UTIL";
						$color_status = 'bgcolor="#FFFFCC"';
						$letra_status = "P";
						break;
				}

				$mensaje .= '
								<table border="1" cellpadding="0" cellspacing="0"><tr style="text-align:center"><td ' . $color_status . ' width="131">' . $letra_status . '</td><td width="159">' . $nombre_status . '</td></tr></table><br><br>
								<font color="#FF0000"><b>Se le recuerda que tiene <span style="text-decoration: underline;">hasta el ' . $fecha_limite . '</span> para subsanar observaciones y/o proceder con el recojo de su muestra.
								Asimismo cualquier duda comunicarse al tel&eacute;fono 4800561 Anexos 112-139.</b></font><br><br>';
				$mensaje .= '
								<table style="text-align: center; font-size: xx-small;" border="1" cellpadding="0" cellspacing="0" width="2600">
								  <tbody>
									<tr style="background-color:#bbbbbb;">
									  <td>FECHA DE INGRESO</td>
									  <td>FECHA DE EVALUADO</td>
									  <td>FECHA LEV. OBS.</td>
									  <td>AREA</td>
									  <td>EAN/GTIN</td>
									  <td>PRODUCTO<br/>(DESCRIPCION/MARCA/PRESENTACION)</td>
									  <td>FABRICANTE</td>
									  <td>PROVEEDOR</td>
									  <td>COD. R. S./ NSO/ R.D.</td>
									  <td>FECHA DE EMISION DE R.S/ N.S.O/ A.S</td>
									  <td>FECHA VENC.R.S./N.S.O./A.S.</td>
									  <td>CONDICIONES DE CONSERVACION (TRANSPORTE, ALMACENAMIENTO, PRODUCTO)</td>
									  <td >TIEMPO DE VIDA UTIL</td>
									  <td >PAIS DE PROCEDENCIA</td>
									  <td>OBSERVACIONES</td>
									  <td>ACUERDOS CON EL PROVEEDOR Y/O LEVANTAMIENTO DE OBSERVACIONES</td>
									  <td>RESPONSABLE</td>
									  <td>FECHA</td>
									  <td>STATUS</td>
									</tr>';

				$rsdet = $this->memail->buscarExpedienteDetalle($objExpediente->id_expediente, $status);
				if (empty($rsdet)) {
					throw new Exception('No se encontro el detalle del expediente.');
				}
				foreach ($rsdet as $rowdet) {

					$tiempo_m = $rowdet->tiempo_m;
					$fechaingreso = $rowdet->fechaingreso;
					$f_evaluado = $rowdet->f_evaluado;
					$f_levantamiento = $rowdet->f_levantamiento;
					$area = $rowdet->area;
					$codigo = $rowdet->codigo;
					$descripcion = $rowdet->descripcion;
					$marca = $rowdet->marca;
					$presentacion = $rowdet->presentacion;
					$fabricante = $rowdet->fabricante;
					$proveedor = $rowdet->proveedor;
					$rs = $rowdet->rs;
					$fecha_emision = $rowdet->fecha_emision;
					$fecha_vcto = $rowdet->fecha_vcto;
					$c_c = $rowdet->c_c;
					$t_v_u = $rowdet->t_v_u;
					$pais = $rowdet->pais;
					$observacion = $rowdet->observacion;
					$acuerdo = $rowdet->acuerdo;
					$responsable = $rowdet->responsable;
					$fecha = $rowdet->fecha;

					switch ($tiempo_m) {
						case 1:
							$tiempo_util = "D&iacute;as";
							break;
						case 2:
							$tiempo_util = "Meses";
							break;
						case 3:
							$tiempo_util = "Años";
							break;
						default;
						case 4:
							$tiempo_util = "NA";
							break;
					}

					$mensaje .= '
									<tr>
									<td>' . $fechaingreso . '</td>
									<td>' . $f_evaluado . '</td>
									<td>' . $f_levantamiento . '</td>
									<td>' . $area . '</td>
									<td>' . $codigo . '</td>
									<td>' . $descripcion . '<br/>' . $marca . '<br/>' . $presentacion . '</td>
									<td>' . $fabricante . '</td>
									<td>' . $proveedor . '</td>
									<td>' . $rs . '</td>
									<td>' . $fecha_emision . '</td>
									<td>' . $fecha_vcto . '</td>
									<td style="text-align: left;">' . $c_c . '</td>
									<td  >' . $t_v_u . " " . $tiempo_util . '</td>
									<td  >' . $pais . '</td>
									<td style="text-align: left;">' . $observacion . '</td>
									<td style="text-align: left;">' . $acuerdo . '</td>
									<td>' . $responsable . '</td>
									<td>' . $fecha . '</td>
									<td  ' . $color_status . ' >' . $letra_status . '</td>
									</tr>';
				}

				$mensaje .= '</tbody>
					</table><br>
					Leyenda:<br> <br>
					<table style="text-align: center; font-size: x-small;" border="1" cellpadding="0" cellspacing="0" width="295">
					  <tbody>
						<tr height="23">
						  <td bgcolor="lime" height="23" valign="bottom" width="147"><p align="center"><strong><span lang="EN-US">A</span></strong><span lang="EN-US"> </span></p></td>
						  <td height="23" valign="bottom" width="148"><p align="center"><span lang="EN-US">APROBADO</span><span lang="EN-US"> </span></p></td>
						</tr>
						<tr height="21">
						  <td bgcolor="red" height="21" valign="bottom" width="147"><p align="center"><strong><span lang="EN-US">R</span></strong><span lang="EN-US"> </span></p></td>
						  <td height="21" valign="bottom" width="148"><p align="center"><span lang="EN-US">RECHAZADO</span><span lang="EN-US"> </span></p></td>
						</tr>
						<tr height="21">
						  <td bgcolor="yellow" height="21" valign="bottom" width="147"><p align="center"><strong><span lang="EN-US">O</span></strong><span lang="EN-US"> </span></p></td>
						  <td height="21" valign="bottom" width="148"><p align="center"><span lang="EN-US">OBSERVADO</span><span lang="EN-US"> </span></p></td>
						</tr>
						<tr height="21">
						  <td bgcolor="#FFFF99" height="21" valign="bottom" width="147"><p align="center"><strong><span lang="EN-US">P</span></strong><span lang="EN-US"> </span></p></td>
						  <td height="21" valign="bottom" width="148"><p align="center"><span lang="EN-US">PENDIENTE VIDA &Uacute;TIL</span><span lang="EN-US"> </span></p></td>
						</tr>
					  </tbody>
					</table><br><br>
					Atentamente,<br><br>

					<img alt="Grupo FS" src="' . base_url() . 'assets/images/firma_grupofs.png" />
					<br><br>
					';

				if ($status == 3) {
					$mensaje .= "<font color='003399'>De acuerdo al Procedimiento se le otorga un plazo de QUINCE (15) d&iacute;as calendario, a partir de la fecha de evaluaci&oacute;n consignada en el cuadro, para que subsane las observaciones se&ntilde;aladas; caso contrario su expediente quedar&aacute; cerrado .</font><br><br>
									   <font color='FF0000'>TODA SUBSANACION DEBE INGRESAR POR VIA REGULAR.</font>";
				}

				$to = $para;
				$cc = $copia;

				$asunto = "TOTTUS EVALUACION :: " . $proveedor . " EXP. " . $expediente . " " . $nombre_status;

				//cargamos la configuración para enviar con gmail
				$this->email->initialize($configGrupofs);
				$this->email->from($from, $namfrom);
				$this->email->to($to);
				$this->email->cc($cc);
				$this->email->reply_to($replyto, $replynam);
				$this->email->subject($asunto);
				$this->email->message($mensaje);

				for ($i = 1; $i <= 1; $i++) {
					if (!$this->email->send()) {
						throw new Exception($this->email->print_debugger());
					}
					sleep(1);
				}
			}

			echo json_encode([
				'mensaje' => 'Correo enviado correctamente.'
			]);

		} catch (Exception $ex) {
			echo json_encode(['error' => $ex->getMessage()]);
		}
	}

	/**
	 * Modifica el proveedor de un expediente
	 */
	public function cambiar_proveedor()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$idExpediente = $this->input->post('id_expediente');
			$idProveedor = $this->input->post('id_proveedor');
			$expediente = $this->mexpediente->buscarPorId($idExpediente);
			if (empty($expediente)) {
				throw new Exception('El expediente no pudo ser encontrado.');
			}
			$proveedor = $this->mproveedor->buscarPorId($idProveedor);
			if (empty($proveedor)) {
				throw new Exception('El proveedor no pudo ser encontrado.');
			}
			$this->db->update('evalprod_expediente', [
				'id_proveedor' => $proveedor->id_proveedor,
			], [
				'id_expediente' => $expediente->id_expediente,
			]);
			$this->result['status'] = 200;
			$this->result['message'] = 'Proveedor modificado correctamente.';
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Realiza la descarga del cuadro de resultado que se envia por correo
	 */
	public function cuadro_resultado()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$id = $this->input->post('id_expediente');

			$expediente = $this->memail->buscarExpediente($id);
			if (empty($expediente)) {
				throw new Exception('El expediente no pudo ser encontrado.');
			}

			$expediente = $expediente[0];

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setTitle('Cuadro de Resultado');

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);

			$sheet->setCellValue('A1', $expediente->proveedor . ' EXP ' . $expediente->expediente)
				->mergeCells('A1:S1');

			$styleCabecera = [
				'font' => [
					'name' => 'Arial',
					'size' => 12,
					'color' => array('rgb' => 'FFFFFF'),
					'bold' => true,
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
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
			];
			$sheet->getStyle('A1:F1')->applyFromArray($styleCabecera);

			$nombre_status = "";
			$color_status = '';
			$letra_status = "";
			switch ($expediente->status) {
				case 1:
					$nombre_status = "APROBADO";
					$color_status = '33FF00';
					$letra_status = "A";
					break;
				case 2:
					$nombre_status = "RECHAZADO";
					$color_status = 'FF0000';
					$letra_status = "R";
					break;
				case 3:
					$nombre_status = "OBSERVADO";
					$color_status = 'FFFF00';
					$letra_status = "O";
					break;
				case 4:
					$nombre_status = "PENDIENTE VIDA UTIL";
					$color_status = 'FFFFCC';
					$letra_status = "P";
					break;
			}

			$sheet->setCellValue('A3', '');

			$sheet->getStyle('A3:A3')->applyFromArray([
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => [
						'rgb' => $color_status
					]
				],
			]);

			$sheet->setCellValue('B3', $nombre_status);

			$rsdet = $this->memail->buscarExpedienteDetalle($id, $expediente->status);
			if (empty($rsdet)) {
				throw new Exception('No se encontro el detalle del expediente.');
			}

			$sheet->setCellValue('A5', 'FECHA DE INGRESO')
				->setCellValue('B5', 'FECHA DE EVALUADO')
				->setCellValue('C5', 'FECHA LEV. OBS.')
				->setCellValue('D5', 'AREA')
				->setCellValue('E5', 'EAN/GTIN')
				->setCellValue('F5', 'PRODUCTO (DESCRIPCION/MARCA/PRESENTACION)')
				->setCellValue('G5', 'FABRICANTE')
				->setCellValue('H5', 'PROVEEDOR')
				->setCellValue('I5', 'COD. R. S./ NSO/ R.D.')
				->setCellValue('J5', 'FECHA DE EMISION DE R.S/ N.S.O/ A.S')
				->setCellValue('K5', 'FECHA VENC.R.S./N.S.O./A.S.')
				->setCellValue('L5', 'CONDICIONES DE CONSERVACION (TRANSPORTE, ALMACENAMIENTO, PRODUCTO)')
				->setCellValue('M5', 'TIEMPO DE VIDA UTIL')
				->setCellValue('N5', 'PAIS DE PROCEDENCIA')
				->setCellValue('O5', 'OBSERVACIONES')
				->setCellValue('P5', 'ACUERDOS CON EL PROVEEDOR Y/O LEVANTAMIENTO DE OBSERVACIONES')
				->setCellValue('Q5', 'RESPONSABLE')
				->setCellValue('R5', 'FECHA')
				->setCellValue('S5', 'STATUS');
			$sheet->getStyle('A5:S5')->applyFromArray(array_merge($styleCabecera, ['alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
			]]));

			$pos = 6;
			foreach ($rsdet as $key => $value) {
				$tiempo_m = $value->tiempo_m;

				switch ($tiempo_m) {
					case 1:
						$tiempo_util = "D&iacute;as";
						break;
					case 2:
						$tiempo_util = "Meses";
						break;
					case 3:
						$tiempo_util = "Años";
						break;
					default;
					case 4:
						$tiempo_util = "NA";
						break;
				}

				$sheet->setCellValue('A' . $pos, $value->fechaingreso);
				$sheet->setCellValue('B' . $pos, $value->f_evaluado);
				$sheet->setCellValue('C' . $pos, $value->f_levantamiento);
				$sheet->setCellValue('D' . $pos, $value->area);
				$sheet->setCellValue('E' . $pos, $value->codigo);
				$sheet->setCellValue('F' . $pos, $value->descripcion . ' ' . $value->marca);
				$sheet->setCellValue('G' . $pos, $value->fabricante);
				$sheet->setCellValue('H' . $pos, $value->proveedor);
				$sheet->setCellValue('I' . $pos, $value->rs);
				$sheet->setCellValue('J' . $pos, $value->fecha_emision);
				$sheet->setCellValue('K' . $pos, $value->fecha_vcto);
				$sheet->setCellValue('L' . $pos, $value->c_c);
				$sheet->setCellValue('M' . $pos, $value->t_v_u . ' ' . $tiempo_util);
				$sheet->setCellValue('N' . $pos, $value->pais);
				$sheet->setCellValue('O' . $pos, strip_tags($value->observacion));
				$sheet->setCellValue('P' . $pos, $value->acuerdo);
				$sheet->setCellValue('Q' . $pos, $value->responsable);
				$sheet->setCellValue('R' . $pos, $value->fecha);
				$sheet->setCellValue('S' . $pos, $letra_status);
				$sheet->getStyle('S' . $pos . ':S' . $pos)->applyFromArray([
					'fill' => [
						'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
						'startColor' => [
							'rgb' => $color_status
						]
					],
				]);
				++$pos;
			}

			foreach (range('A','S') as $col) {
				$sheet->getColumnDimension($col)->setAutoSize(true);
			}

			$writer = new Xlsx($spreadsheet);
			$filename = 'cuadro_resultado_' . $expediente->expediente . '.xlsx';
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

}
