<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Conditional;

class Cregauditoria extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/auditoria/mregauditoria');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** AUDITORIA **/ 
    public function getcboclieserv() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mregauditoria->getcboclieserv();
		echo json_encode($resultado);
	}
    public function getestableaudi() {	// Visualizar Establecimiento por Clientes en CBO	
        
        $parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregauditoria->getestableaudi($parametros);
		echo json_encode($resultado);
	}
    public function getcboauditor() {	// Visualizar Auditores en CBO	
        
		$resultado = $this->mregauditoria->getcboauditor();
		echo json_encode($resultado);
	}
    public function getsistemaaudi() {	// Visualizar Auditores en CBO	
        
		$resultado = $this->mregauditoria->getsistemaaudi();
		echo json_encode($resultado);
	}
    public function getcborubro() {	// Visualizar Auditores en CBO	
        
        $parametros = array(
            '@idnorma'   => $this->input->post('idnorma')
        );
		$resultado = $this->mregauditoria->getcborubro($parametros);
		echo json_encode($resultado);
	}
    public function getcbochecklist() {	// Visualizar Auditores en CBO	
        
        $parametros = array(
            '@idnorma'   => $this->input->post('idnorma'),
            '@idsubnorma'   => $this->input->post('idsubnorma'),
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregauditoria->getcbochecklist($parametros);
		echo json_encode($resultado);
	}
    public function getcboformula() {	// Visualizar Auditores en CBO	
        
        $parametros = array(
            '@idchceklist'   => $this->input->post('idchceklist')
        );
		$resultado = $this->mregauditoria->getcboformula($parametros);
		echo json_encode($resultado);
	}
    public function setauditoria() { // Registrar informe PT
		$varnull = '';
		
		$id_audi 			= $this->input->post('mhdnIdaudi');
		$ccliente 			= $this->input->post('cboregClie');
		$cestablecimiento 	= $this->input->post('cboregEstable');
		$faudi 				= $this->input->post('txtFAudi');
		$idauditor 			= $this->input->post('cboregAuditor');
		$idnorma 			= $this->input->post('cboregSistema');
		$idsubnorma 		= $this->input->post('cboregRubro');
		$idchecklist 		= $this->input->post('cboregChecklist');
		$idformula 			= $this->input->post('cboregFormula');
		$accion 			= $this->input->post('mhdnAccionAudi');
        
        $parametros = array(
            '@id_audi'   			=>  $id_audi,
            '@ccliente'   			=>  $ccliente,
            '@cestablecimiento'     =>  ($cestablecimiento == $varnull || $cestablecimiento == '%') ? '000000' : $this->input->post('cboregEstable'),
            '@faudi'				=>  substr($faudi, 6, 4).'-'.substr($faudi,3 , 2).'-'.substr($faudi, 0, 2),
            '@idauditor'      		=>  $idauditor,
            '@idnorma'      		=>  $idnorma,
            '@idsubnorma'      		=>  $idsubnorma,
            '@idchecklist'      	=>  $idchecklist,
            '@idformula'      		=>  $idformula,
            '@accion'           	=>  $accion
        );
        $resultado = $this->mregauditoria->setauditoria($parametros);
        echo json_encode($resultado);		
	}
    public function getbuscarauditoria() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$ccliente   = $this->input->post('ccliente');
		$cestablecimiento  = $this->input->post('cestablecimiento');
		$fini       = $this->input->post('fini');
		$ffin       = $this->input->post('ffin');
		$idauditor    = $this->input->post('idauditor');
            
        $parametros = array(
			'@ccliente'     	=> $ccliente,
			'@cestablecimiento' => ($this->input->post('cestablecimiento') == '') ? '%' : $cestablecimiento,
			'@fini'         	=> ($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         	=> ($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@idauditor'		=> ($this->input->post('idauditor') == '') ? '%' : $idauditor,
		);		
		$resultado = $this->mregauditoria->getbuscarauditoria($parametros);
		echo json_encode($resultado);
	}
    public function getlistarchecklist() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$idaudi   = $this->input->post('idaudi');
		$fechaaudi   = $this->input->post('fechaaudi');
		$cchecklist   = $this->input->post('cchecklist');
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist
		);		
		$resultado = $this->mregauditoria->getlistarchecklist($parametros);
		echo json_encode($resultado);
	}
    public function setregchecklist() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$idaudi   = $this->input->post('mhdncauditoriainspeccion');
		$fechaaudi   = $this->input->post('mhdnfservicio');
		$cchecklist   = $this->input->post('mhdncchecklist');
		$crequisitochecklist   = $this->input->post('mhdncrequisitochecklist');
		$cdetvalrequisito   = $this->input->post('mhdncdetallevalor');
		$dhallazgo   = $this->input->post('mtxthallazgo');
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist,
			'@crequisitochecklist' => $crequisitochecklist,
			'@cdetvalrequisito' => $cdetvalrequisito,
			'@dhallazgo'  	=> $dhallazgo
		);		
		$resultado = $this->mregauditoria->setregchecklist($parametros);
		echo json_encode($resultado);
	}
    public function setcalcularchecklist() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$idaudi   = $this->input->post('idaudi');
		$fechaaudi   = $this->input->post('fechaaudi');
		$cchecklist   = $this->input->post('cchecklist');
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist
		);		
		$resultado = $this->mregauditoria->setcalcularchecklist($parametros);
		echo json_encode($resultado);
	}
}
?>