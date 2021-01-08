<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chomologaciones extends CI_Controller { 
    function __construct() {
		parent:: __construct();	
		$this->load->model('oi/homologaciones/mhomologaciones');
		$this->load->helper(array('form','url','download','html','file'));
        $this->load->library(array('form_validation','session','encryption'));
    }

    // Vista principal
	public function index(){				
		$this->load->view('oi/homologaciones/vhomologaciones');		
	}

    public function getClientes(){
        $resultado = $this->mhomologaciones->getClientes();
        echo json_encode($resultado);
    }

    public function getEstadoExp(){
        $resultado = $this->mhomologaciones->getEstadoExp();
        echo json_encode($resultado);
    }

    public function getArea(){
        $cliente = $this->input->post('cliente');

        $parametros = array(
            '@cliente'   => $cliente
        );

        $resultado = $this->mhomologaciones->getArea($parametros);
        echo json_encode($resultado);
    }

    public function getbuscarexpediente(){

        $cliente = $this->input->post('cliente');
        $finicio = $this->input->post('fecinicio');
        $ffin = $this->input->post('fecfin');
        $estado = $this->input->post('estado');

        $parametros = array(
            '@cliente'   => $cliente,
            '@fecinicio' => $finicio,
            '@fecfin'    => $ffin,
            '@estado'    => $estado
        );

        $resultado = $this->mhomologaciones->getbuscarexpediente($parametros);
        echo json_encode($resultado);

    }

    public function getbuscarproductoxespediente(){
        $expediente = $this->input->post('expediente');

        $parametros = array(
            '@expediente'   => $expediente
            
        );

        $resultado = $this->mhomologaciones->getbuscarproductoxespediente($parametros);
        echo json_encode($resultado);
    }

    public function getClienteDetallado(){
        $expediente = $this->input->post("expediente");

        $parametros = array(
            '@expediente' => $expediente
        );

        $resultado = $this->mhomologaciones->getClienteDetallado($parametros);
        echo json_encode($resultado);
    }

    public function getContactoProveedor(){
        $idproveedor = $this->input->post('idproveedor');

        $parametros = array(
            '@idproveedor' => $idproveedor
        );

        $resultado = $this->mhomologaciones->getContactoProveedor($idproveedor);
        echo json_encode($resultado);
    }
    
    public function getProveedorxCliente(){
        $cliente = $this->input->post('expediente');

        $parametros = array(
            '@expediente' => $cliente
        );

        $resultado = $this->mhomologaciones->getProveedorxCliente($parametros);
        echo json_encode($resultado);
    }

    public function getbuscarequisitoxproducto(){
        $parametros = array(
            '@expediente' => $this->input->post('expediente'),
            '@idprod'     => $this->input->post('idprod')
        );

        $resultado = $this->mhomologaciones->getbuscarequisitoxproducto($parametros);
        echo json_encode($resultado);
    }

    public function getbuscarobservacionxproducto(){
        $parametros = array(
            '@expediente' => $this->input->post('expediente'),
            '@idprod'     => $this->input->post('idprod')
        );

        $resultado = $this->mhomologaciones->getbuscarobservacionxproducto($parametros);
        echo json_encode($resultado);
    }

    public function insertarProducto(){
        $this->form_validation->set_rules('txtProducto', 'Producto', 'required');
		$this->form_validation->set_rules('cboTipRequisito', 'Requisito', 'required');
		$this->form_validation->set_rules('cboTipoMarca', 'Tipo Marca', 'required');
        $this->form_validation->set_rules('cboOrigenProd', 'Origen', 'required');
        $this->form_validation->set_rules('txtEnvPrimario', 'Envase', 'required');
        
        
        if ($this->form_validation->run() == TRUE)
		{
			$idprod = $this->input->post('idProductoEdit');

            $parametros = array(
                '@idproductoexpediente' => $this->input->post('txtIdExpediente'),
                '@nombreproducto'       => strtoupper($this->input->post('txtProducto')),
                '@requisito'            => $this->input->post('cboTipRequisito'),
                '@tipomarca'            => $this->input->post('cboTipoMarca'),
                '@origen_prod'          => $this->input->post('cboOrigenProd'),
                '@dmarca'               => $this->input->post('txtMarca'),
                '@cond_almacenaje'      => $this->input->post('txtCondicionAlmacen'),
                '@vida_util'            => $this->input->post('txtVidautil'),
                '@env_primario'         => $this->input->post('txtEnvPrimario'),
                '@env_secundario'       => $this->input->post('txtEnvSecundario'),
                '@fabricante'           => $this->input->post('txtFabricante'),
                '@direc_fabricante'     => $this->input->post('txtDirFabricante'),
                '@almacen'              => $this->input->post('txtAlmacen'),
                '@direc_almacen'        => $this->input->post('txtDirecAlmacen'),
                '@userreg'              => $this->input->post('txtUserCreated')
                
            );

            //PROBLEMAS AL REGISTRAR Y ACTUALIZAR, DESPUES DE AÑADIR EL CAMPO VIDA UTIL

            if (!empty($idprod)) {
                $parametros['@idprod'] = $idprod; //añadir una variable idprod para poider editar
                $response = $this->mhomologaciones->update($parametros);
                
            }else{
                $response = $this->mhomologaciones->insert($parametros);
            }

            echo json_encode($response);
		}
		else
		{   
            $response = 2;
            echo json_encode($response);
			
		}

       
    }

    public function deleteProducto(){
        $parametros = array(
            '@expediente' => $this->input->post('expediente'),
            '@idprod' => $this->input->post('idprod')
            
        );

        $response = $this->mhomologaciones->delete($parametros);
        echo json_encode($response);

        /* CAMMBIA EL ESTADO DEL PRODUCTO PARA NO VISUALIZARLO, MAS NO ELIMINA */
    }

    public function insertarObsRequisito(){
        
        $parametros = array(
            '@txtExpedienteObservacion'     => $this->input->post('txtExpedienteObservacion'),
            '@txtIdProdObservacion'         => $this->input->post('txtIdProdObservacion'),
            '@mtxtObservacion'              => $this->input->post('mtxtObservacion'),
            '@mtxtAcuerdo'                  => $this->input->post('mtxtAcuerdo'),
            '@FechaRecepDoc'                => $this->input->post('FechaRecepDoc'),
            '@tmpRespProv'                  => $this->input->post('tmpRespProv'),
            '@FecPrimEval'                  => $this->input->post('FecPrimEval'),
            '@tmpRespFsc'                   => $this->input->post('tmpRespFsc'),
            '@FechaLevObs'                  => $this->input->post('FechaLevObs'),
           // '@txtmpPrimEval'                => $this->input->post('txtmpPrimEval'),
            '@FechaTerminos'                => $this->input->post('FechaTerminos'),
            '@tmpDuracion'                  => $this->input->post('tmpDuracion')
            
        );

        $response = $this->mhomologaciones->insertarObsRequisito($parametros);
     
        echo json_encode($response);
		

       
    }

    public function insertarProductoProveedor(){
        $this->form_validation->set_rules('cboPagoCliente', 'Pago Cliente', 'required');

        if ($this->form_validation->run() == TRUE){

            $parametros = array(
                '@txtidProduc'           => $this->input->post('txtidProduc'),
                '@txtExp'                => $this->input->post('txtExp'),
                '@cboEstadoProducto'     => $this->input->post('cboEstadoProducto'),
                '@txtProductoTab3'       => $this->input->post('txtProductoTab3'),
                '@txtMonto'              => $this->input->post('txtMonto'),
                '@cboPagoCliente'        => $this->input->post('cboPagoCliente'),
                '@FechaCobro'            => $this->input->post('FechaCobro')
            );

            $response = $this->mhomologaciones->updateProductoProveedor($parametros);
                
           
            echo json_encode($response);

        }else{
            $response = 2;
            echo json_encode($response);
        }
       
    }
   
    public function getTipoRequisito(){
        $tipoProd = $this->input->post('tipoProd');

        $parametros = array(
            '@tipoProd' => $tipoProd
        );

        $resultado = $this->mhomologaciones->getTipoRequisito($parametros);
        echo json_encode($resultado);
    }

    public function insertarRequisitoProducto(){
        $this->form_validation->set_rules('txtExpRequisito', 'idExpediente', 'required');
        $this->form_validation->set_rules('txtIdProducto', 'idProducto', 'required');
        $this->form_validation->set_rules('cboRequisito', 'Requisito', 'required');
        $this->form_validation->set_rules('cboConformidad', 'Conformidad', 'required');
        $this->form_validation->set_rules('cboTipo', 'Tipo', 'required');

        if ($this->form_validation->run() == TRUE){
            $accion = $this->input->post('txtAccion');

            $parametros = array(
                '@exp'           => $this->input->post('txtExpRequisito'),
                '@idprod'        => $this->input->post('txtIdProducto'),
                '@requisito'     => $this->input->post('cboRequisito'),
                '@conformidad'   => $this->input->post('cboConformidad'),
                '@nota'          => $this->input->post('txtNotaReq'),
                '@fecha'         => $this->input->post('FecRegistroRequ'),
                '@descripcion'   => $this->input->post('txtDescripcionRequisito'),
                '@archivo'       => $this->input->post('txtFileRequisito'),
                '@usereg'        => $this-> session-> userdata('s_usuario')
            );

            if ($accion == 'I') {
                $response = $this->mhomologaciones->insertarRequisitoProducto($parametros);
            } else if($accion == 'U') {
                $response = $this->mhomologaciones->updateRequisitoProducto($parametros);
            }
            
            echo json_encode($response);

        }else{
            $response = 2;
            echo json_encode($response);
        }
       
    }

    public function deleteRequisitoProd(){
        $parametros = array(
            '@exp' => $this->input->post('expediente'),
            '@idprod' => $this->input->post('idprod'),
            '@requisito' => $this->input->post('requisito')
        );

        $response = $this->mhomologaciones->deleteRequisitoProd($parametros);
        echo json_encode($response);
        /* CAMMBIA EL ESTADO DEL REQUISITO PARA NO VISUALIZARLO, MAS NO ELIMINA */
    }

    // Subir Archivos	
	public function subirArchivo(){
		//RUTA DONDE SE GUARDAN LOS FICHEROS
	   $config['upload_path'] = 'FTPfileserver/Archivos/Homologaciones/';
	   $config['allowed_types'] = 'pdf|xlsx|docx|doc|xls|rar|zip';
	   $config['max_size'] = '90048';
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   //if (!($this->upload->do_upload('mtxtArchivopropu') || $this->upload->do_upload('mtxtArchivo'))) {

	   if (!($this->upload->do_upload('fileRequisito') )) {
		   //si al subirse hay algun error 
		   $data['uploadError'] = $this->upload->display_errors();
		   $error = '';
		   return $error;
			
	   } else {

		   $data = $this->upload->data();

		   $path = array(
					$prueba1 = $data['file_name'],
				   $prueba2 = $config['upload_path'],
		   );
		   echo json_encode($path);
	   }
	   
	}	
}