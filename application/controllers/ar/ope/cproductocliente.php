<?php

/**
 * Class cproductocliente
 *
 * @property mproductocliente mproductocliente
 * @property mcliente mcliente
 * @property mttramite mttramite
 */
class cproductocliente extends FS_Controller
{

	/**
	 * cproductocliente constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mproductocliente');
		$this->load->model('ar/ope/mcliente');
		$this->load->model('ar/ope/mttramite');
	}

	/**
	 * Crea o Edita el producto relacionado a un cliente
	 */
	public function guardar()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$producto_cliente_id = $this->input->post('producto_cliente_id');
			$codigo_cliente_id = (string) $this->input->post('codigo_cliente_id');
			$entidad_id = (string) $this->input->post('entidad_id');
			$tipo_producto_id = (string) $this->input->post('tipo_producto_id');
			$codigo = (string) $this->input->post('producto_codigo_producto');
			$categoria_id = $this->input->post('producto_categoria_id');
			$rs = (string) $this->input->post('producto_rs');
			$fecha_inicio = (string) $this->input->post('producto_fecha_inicio');
			$fecha_vencimiento = (string) $this->input->post('producto_fecha_vencimiento');
			$descripcion_sap = (string) $this->input->post('producto_descripcion_sap');
			$nombre = (string) $this->input->post('producto_nombre');
			$marca_id = $this->input->post('producto_marca_id');
			$presentacion = (string) $this->input->post('producto_presentacion');
			$fabricante_id = $this->input->post('producto_fabricante_id');
			$pais = $this->input->post('producto_pais');
			$direccion_fabricante = (string) $this->input->post('producto_direccion_fabricante');
			$producto_vida_util = (string) $this->input->post('producto_vida_util');
			$estado = (string) $this->input->post('producto_estado');

			$objCliente = $this->mcliente->buscar($codigo_cliente_id);
			if (empty($objCliente)) {
				throw new Exception('Debe elegir el cliente.' . $codigo_cliente_id);
			}

			$objTipoProducto = $this->mttramite->buscarTipoProducto($entidad_id, $tipo_producto_id);
			if (empty($objTipoProducto)) {
				throw new Exception('Debe elegir el cliente.');
			}

			$producto = $this->mproductocliente->guardar(
				$producto_cliente_id,
				$objCliente->CCLIENTE,
				$objTipoProducto->id,
				$codigo,
				$categoria_id,
				$rs,
				$fecha_inicio,
				$fecha_vencimiento,
				$descripcion_sap,
				$nombre,
				$marca_id,
				$presentacion,
				$pais,
				$fabricante_id,
				$direccion_fabricante,
				$producto_vida_util,
				$estado
			);

			$this->result['status'] = 200;
			$type = (empty($producto_cliente_id)) ? 'creado' : 'actualizado';
			$this->result['message'] = "Producto {$producto['DPRODUCTOCLIENTE']} {$type} correctamente.";
			$this->result['data'] = $this->mproductocliente->buscarDatos($producto['CPRODUCTOFS']);

		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Busqueda de la lista
	 */
	public function filtro()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {

			$limit = $this->input->post('filtro_producto_limit');
			$offset = $this->input->post('filtro_producto_offset');
			// Por defecto será siempre 80
			$limit = (is_numeric($limit) && $limit > 0 && $limit <= 10000) ? intval($limit) : 80;
			// Se le aumenta 1 para contar el ultimo registro anterior
			$offset = (is_numeric($offset) && $offset > 1 && $offset <= 10000) ? $offset : 1;

			$codigo_cliente_id = (string) $this->input->post('codigo_cliente_id');
			$tipo_producto_id = (string) $this->input->post('tipo_producto_id');
			$filter_producto_descripcion = (string) $this->input->post('filter_producto_descripcion');

			$result = $this->mproductocliente->filtrar($codigo_cliente_id, $tipo_producto_id, $filter_producto_descripcion, $limit, $offset);
			$total = $this->mproductocliente->filtrarTotal($codigo_cliente_id, $tipo_producto_id, $filter_producto_descripcion);

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

		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Busqueda de producto
	 */
	public function buscar()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$ccliente = $this->input->post('ccliente');
		$tipoProducto = $this->input->post('tipo_producto');
		$tipo = $this->input->post('tipo');
		$buscar = $this->input->post('buscar');
		$items = $this->mproductocliente->buscar($ccliente, $tipoProducto, $tipo, $buscar);
		echo json_encode(['items' => $items]);
	}

}
