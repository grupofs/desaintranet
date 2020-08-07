<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cptcliente extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('pt/mptcliente');
		$this->load->model('mglobales');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
    public function getbuscarclientes() { // Lista de consultas de Cliente	
        $parametros = array(
            '@CLIENTE' =>  "%".$this->input->post('cliente')."%"
        );		
        $resultado = $this->mptcliente->getbuscarclientes($parametros);
        echo json_encode($resultado);
    }
	    
    public function setptcliente() { // Guardar Cliente
        $parametros = array(
            '@ccliente' 		    =>  $this->input->post('hdnIdptclie'),
            '@nruc' 	            =>  $this->input->post('txtnrodoc'),
            '@drazonsocial' 	    =>  $this->input->post('txtrazonsocial'),
            '@cpais' 	            =>  $this->input->post('cboPais'),
            '@dciudad' 	            =>  $this->input->post('txtCiudad'),
            '@destado' 	            =>  $this->input->post('txtEstado'),
            '@dzip' 	            =>  $this->input->post('txtCodigopostal'),
            '@cubigeo' 	            =>  $this->input->post('hdnidubigeo'),
            '@ddireccioncliente' 	=>  $this->input->post('txtDireccion'),
            '@dtelefono' 	        =>  $this->input->post('txtTelefono'),
            '@dfax' 	            =>  $this->input->post('txtFax'),
            '@dweb' 	            =>  $this->input->post('txtWeb'),
            '@zctipotamanoempresa' 	=>  112,
            '@ntrabajador' 	        =>  0,
            '@drepresentante' 	    =>  $this->input->post('txtRepresentante'),
            '@dcargorepresentante' 	=>  $this->input->post('txtCargorep'),
            '@demailrepresentante' 	=>  $this->input->post('txtEmailrep'),
            '@accion' 		        =>  $this->input->post('hdnAccionptclie'),
            '@druta' 		        =>  $this->input->post('utxtlogo'),
            '@tipodoc' 		        =>  $this->input->post('cboTipoDoc'),
        );
        $retorna = $this->mptcliente->setptcliente($parametros);		
        echo json_encode($retorna);
    }

    public function upload_image() {

        $config['upload_path'] = 'FTPfileserver/Imagenes/clientes';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '60048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('logo_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = $this->upload->data();
            $path = array(
                    $prueba1 =$data['file_name'],
                );
            echo json_encode($path);           
        }
    }
    
    public function getbuscarestablecimiento() { // Lista de consultas de Establecimiento	
        $parametros = array(
            '@CCLIENTE' =>  $this->input->post('IDCLIENTE')
        );		
        $resultado = $this->mptcliente->getbuscarestablecimiento($parametros);
        echo json_encode($resultado);
    }
	    
    public function mantgral_establecimiento() { // Guardar Establecimiento
        $parametros = array(
            '@CCLIENTE' 		=>  $this->input->post('mhdnIdClie'),
            '@CESTABLECIMIENTO' =>  $this->input->post('mhdnIdEstable'),
            '@DESTABLECIMIENTO' =>  $this->input->post('txtestableCI'),
            '@DDIRECCION' 	    =>  $this->input->post('txtestabledireccion'),
            '@DZIP' 	        =>  $this->input->post('txtestablezip'),
            '@FCE' 	            =>  $this->input->post('txtestableFce'),
            '@FFRN' 	        =>  $this->input->post('txtestableFfrn'),
            '@ECP' 	            =>  $this->input->post('txtestableEcp'),
            '@DRESPCALIDAD' 	=>  $this->input->post('txtestableresproceso'),
            '@DCARGOCALIDAD' 	=>  $this->input->post('txtestablecargo'),
            '@DEMAILCALIDAD' 	=>  $this->input->post('txtestableEmail'),
            '@ESTADO' 	        =>  $this->input->post('cboestableEstado'),
            '@ACCION' 	        =>  $this->input->post('mhdnAccionEstable'),
            '@TELEFONO' 	    =>  $this->input->post('txtestablecelu'),
            '@cubigeo' 	        =>  $this->input->post('hdnidubigeoEstable'),
            '@cpais' 	        =>  $this->input->post('cboPaisEstable'),
            '@dciudad' 	        =>  $this->input->post('txtCiudadEstable'),
            '@destado' 	        =>  $this->input->post('txtEstadoEstable'),
        );
        $retorna = $this->mptcliente->mantgral_establecimiento($parametros);		
        echo json_encode($retorna);
    }
}
?>