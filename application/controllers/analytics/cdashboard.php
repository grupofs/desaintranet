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

class Cdashboard extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('analytics/mdashboard');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** CONTROL PERMISOS - VACACIONES - EXTRAS **/ 
	
   public function getlisthorasextras() { // Lista horas extras x empleado	   
        $parametros = array(
            '@id_empleado'    =>  $this->input->post('id_empleado')
        );		
        $resultado = $this->mdashboard->getlisthorasextras($parametros);
        echo json_encode($resultado);
    }		
    public function getlistpermisos() { // Lista permisos x empleado	   
        $parametros = array(
            '@id_empleado'    =>  $this->input->post('id_empleado')
        );		
        $resultado = $this->mdashboard->getlistpermisos($parametros);
        echo json_encode($resultado);
    }
	public function guardarpermiso() {	// Registrar Permisos		
		$varnull 			= 	'';
		
		$fecharegistro = $this->input->post('mtxtFregistroperm');
		$fechasalida = $this->input->post('mtxtFsalperm');
		$fecharecupera = $this->input->post('mtxtFrecuperm');
		
        $parametros['@idpermiso'] 		= $this->input->post('mhdnIdpermiso');
        $parametros['@fregistro'] 		= ($fecharegistro == $varnull) ? NULL : substr($fecharegistro, 6, 4).'-'.substr($fecharegistro,3 , 2).'-'.substr($fecharegistro, 0, 2);
    	$parametros['@fsalida'] 		= ($fechasalida == $varnull) ? NULL : substr($fechasalida, 6, 4).'-'.substr($fechasalida,3 , 2).'-'.substr($fechasalida, 0, 2);
        $parametros['@hsalida'] 		= $this->input->post('mtxtHsalperm');
        $parametros['@hretorno'] 		= $this->input->post('mtxtHretorperm');
        $parametros['@motivo'] 			= $this->input->post('mcboMotivo');
        $parametros['@recuperahora'] 	= $this->input->post('cboRecuperahora');
        $parametros['@frecupera'] 		= ($fecharecupera == $varnull) ? NULL : substr($fecharecupera, 6, 4).'-'.substr($fecharecupera,3 , 2).'-'.substr($fecharecupera, 0, 2);
        $parametros['@fundamento'] 		= $this->input->post('mtxtFundamentoperm');
		$parametros['@accion'] 			= $this->input->post('mhdnAccionperm');
		$parametros['@idempleado'] 		= $this->input->post('hdregIdempleadoperm');
			
		$respuesta = $this->mdashboard->guardarpermiso($parametros);
		echo json_encode($respuesta);
	}	

	public function getlistvacaciones() { // Lista vacaciones x empleado   
		$parametros = array(
			'@id_empleado'    =>  $this->input->post('id_empleado')
		);		
		$resultado = $this->mrecursoshumanos->getlistvacaciones($parametros);
		echo json_encode($resultado);
	}	
	public function guardarvacaciones() {	// Registrar Vacaciones		
		$varnull 			= 	'';	

		$fecharegistro = $this->input->post('mtxtFregistrovaca');
		$fechasalida = $this->input->post('mtxtFsalvaca');
		$fecharetorno = $this->input->post('mtxtFretovaca');
			
        $parametros['@idvacaciones'] 	= $this->input->post('mhdnIdvacaciones');
        $parametros['@fregistro'] 		= ($fecharegistro == $varnull) ? NULL : substr($fecharegistro, 6, 4).'-'.substr($fecharegistro,3 , 2).'-'.substr($fecharegistro, 0, 2);
        $parametros['@fsalida'] 		= ($fechasalida == $varnull) ? NULL : substr($fechasalida, 6, 4).'-'.substr($fechasalida,3 , 2).'-'.substr($fechasalida, 0, 2);
        $parametros['@fretorno'] 		= ($fecharetorno == $varnull) ? NULL : substr($fecharetorno, 6, 4).'-'.substr($fecharetorno,3 , 2).'-'.substr($fecharetorno, 0, 2);
        $parametros['@comentario'] 		= $this->input->post('mtxtFundamentovaca');
		$parametros['@accion'] 			= $this->input->post('mhdnAccionvaca');
		$parametros['@idempleado'] 		= $this->input->post('hdregIdempleadovaca');
			
		$respuesta = $this->mdashboard->guardarvacaciones($parametros);
		echo json_encode($respuesta);
	}
	
	public function sendEmailValidarPerm() {  // Envio de Email para visto bueno  
		$emailrespomsable = $this->input->post('emailrespomsable');
		$tipo = $this->input->post('tipo');
		$token = $this->input->post('token');
		$idempleado = $this->input->post('idempleado');
		$idpermisosvacaciones = $this->input->post('idpermisosvacaciones');

		$datopermisosvacaciones = $this->mdashboard->getpermisosvacaciones($idpermisosvacaciones);

		//cargamos la libreria email de CI
		$this->load->library("email");

		$empleado = $datopermisosvacaciones->datosrazonsocial;

		if($tipo = 'P'){
			$asunto = 'Solicitud de Permiso para '.$empleado;
			$tipopermiso = 'permiso para el dia '.$datopermisosvacaciones->fecha_salida.', desde '.$datopermisosvacaciones->hora_salida.' hasta '.$datopermisosvacaciones->hora_retorno;
		}else if($tipo = 'V'){
			$asunto = 'Solicitud de Vacaciones para '.$empleado;
			$tipopermiso = 'vacaciones desde el dia '.$datopermisosvacaciones->fecha_salida.' hasta '.$datopermisosvacaciones->fecha_retorno;
		}else if($tipo = 'X'){			
			$asunto = 'Horas fuera de horario laboral para '.$empleado;
			$tipopermiso = 'ingreso el dia '.$datopermisosvacaciones->fecha_salida.', desde '.$datopermisosvacaciones->fecha_retorno.' hasta '.$datopermisosvacaciones->hora_retorno;
		}			

		$emailData = $this->mglobales->getconfigemail('001');
		if($emailData){
			$mailhost = $emailData->DSERVER;
			$mailport = $emailData->NPUERTO;
			$mailuser = $emailData->DUSER;
			$mailpass = $emailData->DPASSWORD;
		}
		
		//configuracion para grupofs
		$configGrupofs = array(
			'protocol' => 'smtp',
			'smtp_host' => $mailhost,
			'smtp_port' => $mailport,
			'smtp_user' => $mailuser ,
			'smtp_pass' => $mailpass,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);
 
        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGrupofs);
 
        $this->email->from('sistemas@grupofs.com');
        $this->email->to($emailrespomsable);
        $this->email->subject($asunto);
		$VarToken = $token;
		
			
		$html = '<h3>Estimado(a),</h3><br>';
		$html .= '<table><tr><td align="justify" colspan="3">La presente es para dar a conocer que el personal : '.$empleado.', a realizado una solicitud de '.$tipopermiso.'.
			<br><h3><small>Si esta de acuerdo Aceptar la solicitud, de lo contrario Cancelar.</small></h3></td></tr>';
		$html .= '<tr><td colspan="3"></td></tr>';
		$html .= '<tr ><td></td><td align="center" >';
		$html .= '<table cellpadding="0" cellmargin="0" border="0" height="44" width="320" style="border-radius: 8px; border:5px solid #0080FF">
			<tr>
		  		<td bgcolor="#0080FF" valign="middle" align="center" width="320">
					<div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;">
			  			<a href="'.base_url("/crecursoshumanos/setValidarPermiso/$VarToken/$idempleado/$idpermisosvacaciones/1").'" style="text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;" border="0">ACEPTAR SOLICITUD</a>
					</div>
		  		</td>
		  		<td bgcolor="#E11515" valign="middle" align="center" width="320">
					<div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;">
			  			<a href="'.base_url("/crecursoshumanos/setValidarPermiso/$VarToken/$idempleado/$idpermisosvacaciones/2").'" style="text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;" border="0">CANCELAR SOLICITUD</a>
					</div>
		  		</td>
			</tr>
	  	</table>'; 
	  	$html .= '</td><td></td></tr></table>';
		$html .= '<br><b>Recuerda :: </b>Si tienes dudas nos puedes contactar en el siguiente email - sistemas@grupofs.com<br><br>Atentamente,<br><br> Area de Sistemas.<br><br>';
		
		
		$this->email->message($html);

        if($this->email->send())
        {
        	return TRUE;
		}	
		else
		{
			return FALSE;
		}			
	}

   /* ------------- */
}
?>