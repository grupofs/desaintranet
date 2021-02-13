<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cconsinf extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('lab/consinf/mconsinf');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
    public function getbuscar() { // Buscar Cotizacion
		$varnull = '';

		$ccliente       = $this->input->post('ccliente');
		$descripcion    = $this->input->post('descripcion');
		$tipobuscar     = $this->input->post('tipobuscar');
        
        $parametros = array(
			'@ccliente'         => $ccliente,
			'@descripcion'		=> ($this->input->post('descripcion') == '') ? '%' : '%'.$descripcion.'%',
			'@tipobuscar'       => $tipobuscar,
        );
        $retorna = $this->mconsinf->getbuscar($parametros);
        echo json_encode($retorna);		
    }
    
	public function pdfInforme($cinternoordenservicio,$cmuestra) { // recupera los cPTIZACION
        $this->load->library('pdfgenerator');

        $html = '<html>
                <head>
                    <title>Cotizacion</title>
                    <style>
                        @page {
                             margin: 0.3in 0.3in 0.3in 0.3in;
                        }
                        .teacherPage {
                            page: teacher;
                            page-break-after: always;
                        }
                        body{
                            font-family: Arial, Helvetica, sans-serif;
                            font-size: 9pt;
                        }  
                        .cuerpo {
                            text-align: justify;
                        }
                        img.izquierda {
                            float: left;
                        }
                        img.derecha {
                            float: right;
                        }

                        .list-unstyled {
                            padding-left: 0;
                            list-style: none;
                        }
                    </style>
                </head>
                <body>';

        $html .= '<div>
                    <table width="700px" align="center">
                        <tr>
                            <td width="80px" align="center" >
                                <img src="./FTPfileserver/Imagenes/formatos/2/logoFSC.jpg" width="100" height="60" />    
                            </td>
                            <td align="center">
                                <ul class="list-unstyled">
                                    <li>LABORATORIO DE ENSAYO ACREDITADO POR EL</li>
                                    <li>ORGANISMO PERUANO DE ACREDITACIÓN INACAL - DA</li>
                                    <li>CON EL REGISTRO N° LE-073</li>
                                </ul>
                            </td>
                            <td width="130px" align="center" >
                                <img src="./FTPfileserver/Imagenes/formatos/2/logoFSC.jpg" width="100" height="60" /> 
                            </td>
                        </tr>
                    </table>';
                    
        $parametros = array(
			'@cinternoordenservicio'         => $cinternoordenservicio,
			'@cmuestra'       => $cmuestra,
        );
        $res = $this->mconsinf->getinfxmuestras_caratula($parametros);
        if ($res){
            foreach($res as $row){
				$NROINFORME        = $row->NROINFORME;
				$CLIENTE       = $row->CLIENTE;
				$DIRECCION               = $row->DIRECCION;
				$NROORDEN          = $row->NROORDEN;
				$PROCEDENCIA  = $row->PROCEDENCIA;
				$FMUESTRA          = $row->FMUESTRA;
				$FRECEPCION              = $row->FRECEPCION;
                $FANALISIS        = $row->FANALISIS;
                $LUGARMUESTRA          = $row->LUGARMUESTRA;
                $CMUESTRA          = $row->CMUESTRA;
                $DPRODUCTO               = $row->DPRODUCTO;
                $DTEMPERATURA         = $row->DTEMPERATURA;
                $DLCLAB         = $row->DLCLAB;
                $OBSERVACION         = $row->OBSERVACION;
                
			}
        }
        
        $html .= '
                    <table width="600px" align="center" cellspacing="0" cellpadding="2" >
                        <tr>
                            <td width="100%" align="center" colspan="3">
                                <h2>INFORME DE ENSAYO N° '.$NROINFORME.'</h2>   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Nombre del cliente</b>   
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$CLIENTE.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Dirección del Cliente</b>  
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$DIRECCION.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>N° Orden de Servicio</b>   
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$NROORDEN.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Procedencia de la Muestra</b>  
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$PROCEDENCIA.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Fecha de Muestreo</b>    
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$FMUESTRA.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Fecha de Recepción</b>    
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$FRECEPCION.'<   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Fecha de Análisis</b>    
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$FANALISIS.'  
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Lugar de Muestreo</b>   
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$LUGARMUESTRA.'  
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Muestra / Descripción</b>    
                            </td>
                            <td width="8px" align="left">
                                : '.$CMUESTRA.'   
                            </td>
                            <td width="75%" align="left">
                                 '.$DPRODUCTO.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left">
                                <b>Temperatura de Recepción</b>    
                            </td>
                            <td width="75%" align="left" colspan="2">
                                : '.$DTEMPERATURA.'   
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" align="center" colspan="3">
                            &nbsp;   
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" align="center" colspan="3" style=" border-top:solid 3px #000000">
                                <h3>RESULTADOS DE ENSAYO</h3>   
                            </td>
                        </tr>
                    </table>';
                    /*RESULTADOS MICROBIOLOGIA*/
                    $resmicro = $this->mconsinf->getinfxmuestras_resmicro($parametros);
                    if ($resmicro){
                        $html .= '<table width="600px" align="center" cellpadding="2" style="border: 1px solid black;">
                        <tr>
                            <td>
                                <b>Ensayo</b>   
                            </td>
                            <td >
                                <b>Unidades</b>    
                            </td>
                            <td>
                                <b>Via</b>    
                            </td>
                            <td>
                                <b>Resultado</b>   
                            </td>
                        </tr>';
                        foreach($resmicro as $rowmicro){
                            $DENSAYO = $rowmicro->DENSAYO;
                            $UNIDADMEDIDA = $rowmicro->UNIDADMEDIDA;
                            $VIA = $rowmicro->VIA;
                            $RESULT_FINAL = $rowmicro->RESULT_FINAL;
                            $html .= '<tr>
                                <td>'.$DENSAYO.'</td>
                                <td width="100px">'.$UNIDADMEDIDA.'</td>
                                <td width="50px">'.$VIA.'</td>
                                <td width="100px">'.$RESULT_FINAL.'</td>
                            </tr>';
                        }
                        $html .= '</table><br>';
                    }  
                    /*RESULTADOS FISICOQUIMICO*/
                    $resfq = $this->mconsinf->getinfxmuestras_resfq($parametros);
                    if ($resfq){
                        $html .= '<table width="600px" align="center" cellpadding="2" style="border: 1px solid black;">
                        <tr>
                            <td> <b>Ensayo</b> </td>
                            <td> <b>Unidades</b> </td>
                            <td> <b>Via</b> </td>
                            <td> <b>Resultado</b> </td>
                        </tr>';
                        foreach($resfq as $rowfq){
                            $DENSAYO = $rowfq->DENSAYO;
                            $UNIDADMEDIDA = $rowfq->UNIDADMEDIDA;
                            $VIA = $rowfq->VIA;
                            $RESULT_FINAL = $rowfq->RESULT_FINAL;
                            $html .= '<tr>
                                <td>'.$DENSAYO.'</td>
                                <td width="100px">'.$UNIDADMEDIDA.'</td>
                                <td width="50px">'.$VIA.'</td>
                                <td width="100px">'.$RESULT_FINAL.'</td>
                            </tr>';
                        }
                        $html .= '</table><br>'.$DLCLAB;
                    }
        
        $resNOTA1 = $this->mconsinf->getinfxmuestras_nota01($parametros);
        if ($resNOTA1){
            foreach($resNOTA1 as $rowNOTA1){
				$NOTA01        = $rowNOTA1->NOTA01;
			}
        }
        
        $html .= '
                <table width="600px" align="center" cellspacing="0" cellpadding="2" >
                    <tr>
                        <td width="100%" align="center" colspan="3" style=" border-top:solid 3px #000000">
                            <h3>METODOS DE ENSAYO</h3>   
                        </td>
                    </tr>
                </table>';
        $html .= '
                    <table width="600px" align="center" cellspacing="0" cellpadding="2" >
                        <tr>
                            <td width="100%" align="center" >
                                '.$NOTA01.'   
                            </td>
                        </tr> 
                    </table> <br>';
    
        /*RESULTADOS METODOS DE ENSAYO*/
        $resmetensa = $this->mconsinf->getmetodosensayos($parametros);
        if ($resmetensa){
            $html .= '<table width="600px" align="center" cellpadding="2" style="border: 1px solid black;"  FRAME="void" RULES="cols">
                        <tr>
                            <td>
                                <b>Ensayo</b>   
                            </td>
                            <td >
                                <b>Norma o Referencia</b>    
                            </td>
                        </tr>';
                foreach($resmetensa as $rowmetensa){
                    $METDENSAYO = $rowmetensa->DENSAYO;
                    $METDNORMA = $rowmetensa->DNORMA;
                    $html .= '<tr>
                        <td width="180px">'.$METDENSAYO.'</td>
                        <td>'.$METDNORMA.'</td>
                    </tr>';
                }
            $html .= '</table><br>';
        }  
        $html .= '
                    <table width="600px" align="center" cellspacing="0" cellpadding="2" >
                        <tr>
                            <td width="100%" align="left" >
                                Observaciones .-   
                            </td>
                        </tr> 
                        <tr>
                            <td width="100%" align="center" >
                                <div style="text-align: justify;">'.$OBSERVACION.'</div>   
                            </td>
                        </tr> 
                    </table> <br>';

        $html .= '</div></body></html>';
		$filename = 'coti';
		$this->pdfgenerator->generate($html, $filename);
        //echo $html;
    }
}
?>