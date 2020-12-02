<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crecepcion extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('lab/recepcion/mrecepcion');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** COTIZACION **/

    public function getbuscarrecepcion() { // Buscar Cotizacion
		$varnull = '';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fini');
		$ffin       = $this->input->post('ffin');
		$descr      = $this->input->post('descr');
        
        $parametros = array(
			'@CCIA'         => '2',
			'@FINI'         => ($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@FFIN'         => ($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@DESCR'		=> ($this->input->post('descr') == '') ? '%' : '%'.$descr.'%',
        );
        $retorna = $this->mrecepcion->getbuscarrecepcion($parametros);
        echo json_encode($retorna);		
    }


    
    public function setcotizacion() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('mtxtidcotizacion');
		$nversioncotizacion 	= $this->input->post('mtxtnroversion');
		$fcotizacion 			= $this->input->post('mtxtFcotizacion');
		$dcotizacion 			= $this->input->post('mtxtregnumcoti');
		$scotizacion 		    = $this->input->post('mtxtregestado');
		$nvigencia 		        = $this->input->post('mtxtregvigen');
		$csubservicio 		    = $this->input->post('cboregserv');
		$ccliente 		        = $this->input->post('cboregclie');
		$cproveedorcliente 	    = $this->input->post('cboregprov');
		$ccontacto 	            = $this->input->post('cboregcontacto');
		$npermanenciamuestra 	= $this->input->post('mtxtregpermane');
		$ntiempoentregainforme 	= $this->input->post('mtxtregentregainf');
		$stiempoentregainforme 	= $this->input->post('txtregtipodias');
		$dobservacion 		    = $this->input->post('mtxtobserv');
		$zctipoformapago 		= $this->input->post('txtregformapagos');
		$dotraformapago 	    = $this->input->post('mtxtregpagotro');
		$ctipocambio 	        = $this->input->post('mtxtregtipopagos');
		$dtipocambio 	        = $this->input->post('mtxtregtipocambio');
		$smuestreo 	            = ($this->input->post('chksmuestreo') == '') ? 'N' : 'S';
		$imuestreo 	            = $this->input->post('txtmontmuestreo');
		$isubtotal 	            = $this->input->post('txtmontsubtotal');
		$pdescuento 	        = $this->input->post('txtporcdescuento');
		$pigv 	                = $this->input->post('txtporctigv');
		$itotal 	            = $this->input->post('txtmonttotal');
        $smostrarprecios 	    = ($this->input->post('chkregverpago') == '') ? 'N' : 'S';
		$accion 			    = $this->input->post('hdnAccionregcoti');
        
        $parametros = array(
            '@cinternocotizacion'   	=>  $cinternocotizacion,
            '@nversioncotizacion'   	=>  $nversioncotizacion,
            '@fcotizacion'      		=>  substr($fcotizacion, 6, 4).'-'.substr($fcotizacion,3 , 2).'-'.substr($fcotizacion, 0, 2),
            '@dcotizacion'    		    =>  $dcotizacion,
			'@scotizacion'    		    =>  $scotizacion,
			'@nvigencia'    	        =>  $nvigencia,
			'@csubservicio'    		    =>  $csubservicio,
			'@ccliente'    		        =>  $ccliente,
			'@cproveedorcliente'   	    =>  $cproveedorcliente,
			'@ccontacto'                =>  $ccontacto,
			'@npermanenciamuestra'    	=>  $npermanenciamuestra,
			'@ntiempoentregainforme'    =>  $ntiempoentregainforme,
			'@stiempoentregainforme'    =>  $stiempoentregainforme,
			'@dobservacion'    		    =>  $dobservacion,
            '@zctipoformapago'      	=>  $zctipoformapago,
            '@dotraformapago'           =>  $dotraformapago,
            '@ctipocambio'              =>  $ctipocambio,
            '@dtipocambio'              =>  $dtipocambio,
            '@smuestreo'                =>  $smuestreo,
            '@imuestreo'                =>  $imuestreo,
            '@isubtotal'                =>  $isubtotal,
            '@pdescuento'               =>  $pdescuento,
            '@pigv'                     =>  $pigv,
            '@itotal'                   =>  $itotal,
            '@smostrarprecios'          =>  $smostrarprecios,
            '@accion'           	    =>  $accion
        );
        $retorna = $this->mrecepcion->setcotizacion($parametros);
        echo json_encode($retorna);		
	}
    
    public function getrecepcionmuestra() {	// Visualizar Servicios en CBO	
             
		$cinternocotizacion 	= $this->input->post('idcoti');
        $nversioncotizacion 	= $this->input->post('nversion');
        
        $parametros = array(
            '@cinternocotizacion'   	=>  $cinternocotizacion,
            '@nversioncotizacion'   	=>  $nversioncotizacion
        );
        $resultado = $this->mrecepcion->getrecepcionmuestra($parametros);
        echo json_encode($resultado);
    } 
    

	public function pdfCoti($idcoti,$nversion) { // recupera los cPTIZACION
        $this->load->library('pdfgenerator');

        $date = getdate();
        $fechaactual = date("d") . "/" . date("m") . "/" . date("Y");

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
                    </style>
                </head>
                <body>';

        			
        $res = $this->mcotizacion->getpdfdatoscoti($idcoti,$nversion);
        if ($res){
            foreach($res as $row){
				$dcotizacion         = $row->dcotizacion;
				$drazonsocial         = $row->drazonsocial;
				$nruc         = $row->nruc;
				$ddireccioncliente         = $row->ddireccioncliente;
				$dtelefono         = $row->dtelefono;
				$dcontacto         = $row->dcontacto;
				$dmail         = $row->dmail;
                $fcotizacion         = $row->fcotizacion;
                $imuestreo         = $row->imuestreo;
                $isubtotal         = $row->isubtotal;
                $pigv         = $row->pigv;
                $pdescuento         = $row->pdescuento;
                $itotal         = $row->itotal;
				$cantprod         = $row->cantprod;
				$summuestra         = $row->summuestra;
				$cforma_pago         = $row->cforma_pago;
				$banco         = $row->banco;
				$detraccion         = $row->detraccion;
                $entrega         = $row->entrega;
                $dcantidadminima         = $row->dcantidadminima;
                $diaspermanecia         = $row->diaspermanecia;
                $diascoti         = $row->diascoti;
                $dobservacion         = $row->dobservacion;
                $usuariocrea         = $row->usuariocrea;
			}
		}
                
        $html .= '<div>
        <table width="700px" align="center" cellspacing="0" cellpadding="2" style="border: 1px solid black;">
                    <tr>
                        <td width="80px" rowspan="4">
                            <img src="./FTPfileserver/Imagenes/formatos/2/logoFSC.jpg" width="100" height="60" />    
                        </td>
                        <td align="center" rowspan="4">
                            <h2>COTIZACION DE SERVICIO DE ENSAYO</h2>
                        </td>
                        <td width="130px" align="center" colspan="2">
                            FSC-F-LAB-07
                        </td>
                    </tr>
                    <tr>
                        <td>Versión</td>
                        <td align="right">02</td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td align="right">24/10/2013</td>
                    </tr>
                    <tr>
                        <td>Página</td>
                        <td align="right">2D</td>
                    </tr>
                </table>
                <table width="700px" align="center" cellspacing="0" cellpadding="2" style="border: 1px solid black;">
                    <tr>
                        <td colspan="4"><b>N°'.$dcotizacion.'</b></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="height:10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="4" ><b>I CLIENTE</b></td>
                    </tr>
                    <tr>
                        <td width="80px">Razón Social:</td>
                        <td width="360px">'.$drazonsocial.'</td>
                        <td width="50px">RUC:</td>
                        <td width="190px">'.$nruc.'</td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td>'.$ddireccioncliente.'</td>
                        <td>Teléfono:</td>
                        <td>'.$dtelefono.'</td>
                    </tr>
                    <tr>
                        <td>Contacto:</td>
                        <td>'.$dcontacto.'</td>
                        <td>E-mail:</td>
                        <td>'.$dmail.'</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Fecha:</td>
                        <td>'.$fcotizacion.'</td>
                    </tr>
                </table>
                <table width="700px" align="center" cellspacing="0" cellpadding="2" style="border: 1px solid black;">
                    <tr>
                        <td><b>II DETERMINACIONES</b></td>
                    </tr>
                </table>
                <table width="700px" align="center" cellspacing="0" cellpadding="2" style="border: 1px solid black;" FRAME="void" RULES="cols">
                    <tr>
                        <td width="180px" align="center">LOCAL</td>
                        <td width="340px" align="center">PRODUCTO</td>
                        <td width="160px" align="center">CONDICIONES DE LA MUESTRA (*)</td>
                    </tr>
                </table>
                <table width="700px" align="center" cellspacing="0" cellpadding="3" FRAME="void" RULES="rows">';
                		
                	
        $resprod = $this->mcotizacion->getpdfdatosprod($idcoti,$nversion);
        if ($resprod){
            foreach($resprod as $rowprod){
				$destablecimiento = $rowprod->destablecimiento;
				$dproducto = $rowprod->dproducto;
				$condicion = $rowprod->condicion;
				$procedencia = $rowprod->procedencia;
                $html .= '<tr>
                    <td width="180px">'.$destablecimiento.' / '.$procedencia.'</td>
                    <td>'.$dproducto.'</td>
                    <td width="160px">'.$condicion.'</td>
                </tr>';
			}
		}        
        $html .= '</table>
        <table width="300px" style="margin-left: 15px; height:25px;">
            <tr>
                <td>Cantidad de Productos:</td>
                <td>'.$cantprod.'</td>
                <td>Suma de Muestras:</td>
                <td>'.$summuestra.'</td>
            </tr>
            <tr>
                <td colspan="4" style="height:30px;"></td>
            </tr>
        </table>
        <table width="700px" align="center" cellspacing="0" cellpadding="2" style="border: 1px solid black;"  FRAME="void" RULES="cols">
            <tr >
                <td width="40px" align="center">Codigo Metodo</td>
                <td width="120px" align="center">METODO DE ENSAYO</td>
                <td width="20px" align="center">AC / NOAC</td>
                <td width="160px" align="center">NORMA / REFERENCIA</td>
                <td width="20px" align="center">Cant.</td>
                <td width="40px" align="center">P.UNI S/.</td>
                <td width="40px" align="center">Precio Total S/.</td>
            </tr>';
        $resproddet = $this->mcotizacion->getpdfdatosprod($idcoti,$nversion);
        if ($resproddet){
            foreach($resproddet as $rowproddet){
                $dproductodet = strtoupper($rowproddet->dproducto);
                $idproduc = $rowproddet->nordenproducto;
                
                $html .= '<tr>
                    <td colspan="7"><h3>'.$dproductodet.'</h3>
                    </td>
                </tr>';
                    $resensadet = $this->mcotizacion->getlistarensayo($idcoti,$nversion,$idproduc);
                    if ($resensadet){
                        foreach($resensadet as $rowensadet){
                            $codigo = $rowensadet->CODIGO;
                            $densayo = $rowensadet->DENSAYO;
                            $acre = $rowensadet->ACRE;
                            $norma = $rowensadet->NORMA;
                            $cantidad = $rowensadet->CANTIDAD;
                            $costoensa = $rowensadet->CONSTOENSAYO;
                            $costo = $rowensadet->COSTO;
                            $html .= '<tr>
                            <td width="50px">
                            '.$codigo.'
                            </td>
                            <td width="160px">
                            '.$densayo.'
                            </td>
                            <td width="40px" align="center">
                            '.$acre.'
                            </td>
                            <td width="220px">
                            '.$norma.'
                            </td>
                            <td width="40px" align="center">
                            '.$cantidad.'
                            </td>
                            <td width="50px" align="right">
                            '.$costoensa.'
                            </td>
                            <td width="50px" align="right">
                            '.$costo.'
                            </td>
                            </tr>';
                        }
                    }
                    $html .= '';
			}
		}
        $html .= '</table>
        <table width="700px" align="center">
            <tr>
                <td width="500px">AC: Método Acreditado<br>NO AC: Método No Acreditado</td>
                <td width="80px"> Muestreo</td>
                <td width="80px" align="right">'.$imuestreo.'</td>
            </tr>
            <tr>
                <td></td>
                <td> SUBTOTAL</td>
                <td width="80px" align="right">'.$isubtotal.'</td>
            </tr>
            <tr>
                <td></td>
                <td> DESCUENTOS</td>
                <td width="80px" align="right">'.$pdescuento.'</td>
            </tr>
            <tr>                
                <td></td>
                <td> IGV 18%</td>
                <td width="80px" align="right">'.$pigv.'</td>
            </tr>
            <tr>                
                <td></td>
                <td> TOTAL</td>
                <td width="80px" align="right">'.$itotal.'</td>
            </tr>
            <tr>
                <td colspan="3" style="height:10px;">
                </td>
            </tr>
        </table>';

        $html .= '<table width="700px" align="center">
            <tr>
                <td><b>III</b></td>
                <td><b>FORMA DE PAGO</b></td>
                <td align="left">'.$cforma_pago.'</td>
                <td>'.$banco.'</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>'.$detraccion.'</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>CCI: 00219400156160801692</td>
            </tr>
            <tr>
                <td colspan="4" style="height:10px;">
                </td>
            </tr>
            <tr>
                <td><b>IV</b></td>
                <td colspan="2"><b>TIEMPO DE ENTREGA DEL INFORME</b></td>
                <td>'.$entrega.'</td>
            </tr>
            <tr>
                <td colspan="4" style="height:10px;">
                </td>
            </tr>
            <tr>
                <td><b>V</b></td>
                <td colspan="2"><b>CANTIDAD DE MUESTRA MINIMA</b></td>
                <td>'.$dcantidadminima.'</td>
            </tr>
            <tr>
                <td colspan="4" style="height:10px;">
                </td>
            </tr>
            <tr>
                <td>(*) </td>
                <td colspan="3">En caso el cliente incumpla estas condiciones la muestra se considerará muestra no idónea y sólo con su autorización será ensayada y reportará como Informe No Oficial.</td>
            </tr>
            <tr>
                <td colspan="4" style="height:10px;">
                </td>
            </tr>
        </table>';
        
        $html .= '<table width="700px" align="center">
            <tr>
                <td VALIGN=top><b>VI</b></td>
                <td colspan="2"><b>PERMANENCIA DE LA CONTRA MUESTRA EN EL LABORATORIO:</b>  En caso de que el servicio considere contramuestras, éstas se conservarán en el laboratorio por el período acordado con el cliente, 
                luego de lo cual serán eliminadas de acuerdo a nuestros procedimientos  internos. En caso el cliente requiera la devolución de la contramuestra, esta deberá ser solicitada antes de la finalización del Tiempo de Custodia(***)</td>
            </tr>
            <tr>
                <td colspan="3" style="height:10px;"></td>
            </tr>
            <tr>
                <td>(***)</td>
                <td colspan="2">'.$diaspermanecia.'</td>
            </tr>
            <tr>
                <td><b>VII</b></td>
                <td><b>VIGENCIA DE COTIZACION</b></td>
                <td align="left">'.$diascoti.'</td>
            </tr>
            <tr>
                <td colspan="3" style="height:10px;"></td>
            </tr>
        </table>';
        
        $html .= '<table width="700px" align="center">
            <tr>
                <td VALIGN=top><b>VIII</b></td>
                <td colspan="2"><b>ACEPTACION DE LA COTIZACION:</b></td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">En caso de Aceptar la Cotización, favor de enviarla firmada o declaranado su aceptación mediante un correo electronico. Cualquier cambio en la cotización enviada deberá solicitarse antes de iniciado el servicio.</td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">Al dar su visto bueno, el cliente acepta esta cotización con carácter de contrato.</td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">Toda la información derivada de las actividades del laboratorio obtenidas a través del servicio brindado se conservará de modo confidencial, excepto por la información que el cliente pone a disposición del público, o cuando lo acuerdan el laboratorio y el cliente.</td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">Cuando a FS Certificaciones se le solicite por ley o disposiciones contractuales divulgar información confidencial, notificará al cliente salvo que esté prohibido por ley.</td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">La información acerca del cliente, obtenida de fuentes diferentes del cliente se tratará como información confidencial.</td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">La emisión de los Informes de Ensayo se realizará en formato digital (PDF), los cuales serán enviados por correo electrónico al cliente. El envío de los informes físicos tiene un costo adicional que será informado al cliente.</td>
            </tr>
            <tr>
                <td VALIGN=top>-</td>
                <td colspan="2">Copias adicionales de los informes y las traducciones de los mismos tendrán un costo adicional.</td>
            </tr>
            <tr>
                <td colspan="3" style="height:10px;"></td>
            </tr>
            <tr>
                <td VALIGN=top><b>IX</b></td>
                <td><b>OBSERVACIONES:</b></td>
                <td>'.$dobservacion.'</td>
            </tr>
            <tr>
                <td colspan="3" style="height:10px;"></td>
            </tr>
        </table>';
        
        $html .= '<table width="700px" align="center">
            <tr>
                <td colspan="4" style="height:80px;"></td>
            </tr>
            <tr>
                <td></td>
                <td align="center">SOLICITANTE</td>
                <td></td>
                <td align="center">FSC LABORATORIO</td>
            </tr>
            <tr>
                <td colspan="4" style="height:10px;"></td>
            </tr>
            <tr>
                <td colspan="4"><b>'.$usuariocrea.'</b></td>
            </tr>
        </table>';

        $html .= '</div></body></html>';
		$filename = 'coti';
		$this->pdfgenerator->generate($html, $filename);
        //echo $html;
	}
}
?>