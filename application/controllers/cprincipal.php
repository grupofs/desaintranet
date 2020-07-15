<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cprincipal extends CI_Controller { 
	function __construct()
	{
		parent:: __construct();	
		$this->load->model('mprincipal');
		$this->load->library('session');		
	}

	public function principal() { // Abrir ventana principal
		if (!$this->session->userdata("login")) {
			redirect('clogin');
		}
		$this->session->time = time();

		$this->layout->js(array(public_url('script/analytics/dashboard.js')));

		$idempleado = $this -> session -> userdata('s_idempleado');
		$parametros = array(
			'@idempleado'   => $idempleado
		);
		$this->load->model('analytics/mdashboard');
		$resumenpermisos= $this->mdashboard->getresumenpermisos($parametros);	
		
		$data['vista'] = 'DInternos';
		$data['datos_resumenpermisos'] = $resumenpermisos;
		$data['content_for_layout'] = 'analytics/dashboard';
        $this->parser->parse('seguridad/vprincipal',$data);

	}

	public function principalClie() { // Abrir ventana principal
		if (!$this->session->userdata("login")) {
			redirect('clogin');
		}
		$this->session->time = time();

		$this->layout->js(array(public_url('script/analytics/dashboard.js')));

		$idempleado = $this -> session -> userdata('s_idempleado');
		$parametros = array(
			'@idempleado'   => $idempleado
		);
		$this->load->model('analytics/mdashboard');
		$resumenpermisos= $this->mdashboard->getresumenpermisos($parametros);	
		
		$data['vista'] = 'DInternos';
		$data['datos_resumenpermisos'] = $resumenpermisos;
		$data['content_for_layout'] = 'analytics/dashboardClie';
        $this->parser->parse('seguridad/vprincipalClie',$data);

	}       
	
	public function perfilusuario() { // Abrir ventanas de perfil de usuario		
		if (!$this->session->userdata("login")) {
			redirect('clogin');
		}
		$this->session->time = time();

		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$idempleado = $this -> session -> userdata('s_idempleado');
		$parametros = array(
			'@idempleado'   => $idempleado
		);
		$this->load->model('mperfilusuario');
		$resumenperfil= $this->mperfilusuario->getresumenperfil($parametros);	
		
		$data['vista'] = 'DInternos';
		$data['datos_perfil'] = $resumenperfil;
		$data['content_for_layout'] = 'seguridad/vperfilusuario';
        $this->parser->parse('seguridad/vprincipal',$data);

	}

	public function ventanas() { // Abrir ventanas de opcion menu
		if (!$this->session->userdata("login")) {
			redirect('clogin');
		}
		$this->session->time = time();

		$vista = $this->input->post('vista');
		$script = $this->input->post('script');

		$this->layout->js(array(public_url('script/'.$script.'.js')));

		$data['vista'] = 'Ventana';
		$data['content_for_layout'] = $vista;
        $this->parser->parse('seguridad/vprincipal',$data);

	}
	
	public function cerrar() { // Cerrar Sesion
		$vars = array('s_idusuario','s_cusuario','s_usuario','s_idrol','s_cia','s_dmail','s_passw','s_changepassw','s_druta','s_tipopwd','s_tipousu','login');
		$this->session->unset_userdata($vars);
		$this->session->sess_destroy();
		session_destroy();
	}

}
?>