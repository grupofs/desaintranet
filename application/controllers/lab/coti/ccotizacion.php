<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccotizacion extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('lab/coti/mcotizacion');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** COTIZACION **/
    public function getcboclieserv() {	// Visualizar Clientes del servicio en CBO	
        $resultado = $this->mcotizacion->getcboclieserv();
        echo json_encode($resultado);
    } 

    public function getbuscarcotizacion() { // Buscar Cotizacion
		$varnull = '';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fini');
		$ffin       = $this->input->post('ffin');
		$descr      = $this->input->post('descr');
        
        $parametros = array(
			'@CCIA'         => '2',
			'@CCLIENTE'     => ($this->input->post('ccliente') == '') ? '0' : $ccliente,
			'@FINI'         => ($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@FFIN'         => ($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@DESCR'		=> ($this->input->post('descr') == '') ? '%' : '%'.$descr.'%',
        );
        $retorna = $this->mcotizacion->getbuscarcotizacion($parametros);
        echo json_encode($retorna);		
    }
    
    public function getcboregserv() {	// Visualizar Servicios en CBO	
        $resultado = $this->mcotizacion->getcboregserv();
        echo json_encode($resultado);
    } 
    
    public function getcliente() {	// Visualizar Servicios en CBO	
        $resultado = $this->mcotizacion->getcliente();
        echo json_encode($resultado);
    } 
    
    public function getprovcliente() {	// Visualizar Servicios en CBO
        $ccliente   = $this->input->post('ccliente');
        $resultado = $this->mcotizacion->getprovcliente($ccliente);
        echo json_encode($resultado);
    } 
    
    public function getcontaccliente() {	// Visualizar Servicios en CBO
        $ccliente   = $this->input->post('ccliente');
        $resultado = $this->mcotizacion->getcontaccliente($ccliente);
        echo json_encode($resultado);
    } 

    public function setcotizacion() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('mtxtidcotizacion');
		$nversioncotizacion 	= $this->input->post('mtxtnroversion');
		$fcotizacion 			= $this->input->post('mtxtFcotizacion');
		$dcotizacion 			= $this->input->post('mtxtregnumcoti');
		$scotizacion 		    = $this->input->post('hdnregestado');
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
		$cusuario 			    = $this->input->post('mtxtcusuario');
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
            '@cusuario'                 =>  $cusuario,
            '@accion'           	    =>  $accion
        );
        $retorna = $this->mcotizacion->setcotizacion($parametros);
        echo json_encode($retorna);		
	}
    
    public function getlistarproducto() {	// Visualizar Servicios en CBO	
        $idcoti     = $this->input->post('idcoti');
        $nversion   = $this->input->post('nversion');
        $resultado = $this->mcotizacion->getlistarproducto($idcoti,$nversion);
        echo json_encode($resultado);
    } 
    
    public function getcboregLocalclie() {	// Visualizar Servicios en CBO
        $ccliente   = $this->input->post('ccliente');
        $resultado = $this->mcotizacion->getcboregLocalclie($ccliente);
        echo json_encode($resultado);
    }
    
    public function getcboregcondi() {	// Visualizar Servicios en CBO
        $resultado = $this->mcotizacion->getcboregcondi();
        echo json_encode($resultado);
    }  
    
    public function getcboregprocede() {	// Visualizar Servicios en CBO
        $resultado = $this->mcotizacion->getcboregprocede();
        echo json_encode($resultado);
    }  

    public function setproductoxcotizacion() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('mhdnidcotizacion');
		$nversioncotizacion 	= $this->input->post('mhdnnroversion');
		$nordenproducto 		= $this->input->post('mhdnIdProduc');
		$clocalcliente 			= $this->input->post('mcboregLocalclie');
		$dproducto 		        = $this->input->post('mtxtregProducto');
		$zctipocondicionpdto 	= $this->input->post('mcboregcondicion');
		$nmuestra 		        = $this->input->post('mtxtregmuestra');
		$zctipoprocedencia 		= $this->input->post('mcboregprocedencia');
		$dcantidadminima 	    = $this->input->post('mtxtregcantimin');
		$ctipoproducto 	        = $this->input->post('mcboregoctogono');
		$setiquetanutri 	    = $this->input->post('mcboregetiquetado');
		$ntamanoporcion 	    = $this->input->post('mtxtregtamporci');
		$umporcion 	            = $this->input->post('mcboregumeti');
		$cusuario 			    = $this->input->post('mhdncusuario');
		$accion 			    = $this->input->post('mhdnAccionProduc');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion,
            '@nordenproducto'   	=>  $nordenproducto,
            '@clocalcliente'    	=>  $clocalcliente,
			'@dproducto'    		=>  $dproducto,
			'@zctipocondicionpdto'  =>  $zctipocondicionpdto,
			'@nmuestra'    		    =>  $nmuestra,
			'@zctipoprocedencia'    =>  $zctipoprocedencia,
			'@dcantidadminima'   	=>  $dcantidadminima,
			'@ctipoproducto'        =>  $ctipoproducto,
			'@setiquetanutri'    	=>  $setiquetanutri,
			'@ntamanoporcion'       =>  $ntamanoporcion,
			'@umporcion'            =>  $umporcion,
            '@cusuario'             =>  $cusuario,
            '@accion'           	=>  $accion
        );
        $retorna = $this->mcotizacion->setproductoxcotizacion($parametros);
        echo json_encode($retorna);		
	}
    
    public function getlistarensayo() {	// Visualizar Servicios en CBO	
        $idcoti     = $this->input->post('idcoti');
        $nversion   = $this->input->post('nversion');
        $idproduc   = $this->input->post('idproduc');
        $resultado = $this->mcotizacion->getlistarensayo($idcoti,$nversion,$idproduc);
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

    public function setduplicarprodxcoti() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('idcotizacion');
		$nversioncotizacion 	= $this->input->post('nversion');
		$nordenproducto 		= $this->input->post('idcotiproducto');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion,
            '@nordenproducto'   	=>  $nordenproducto
        );
        $retorna = $this->mcotizacion->setduplicarprodxcoti($parametros);
        echo json_encode($retorna);		
	}

    public function deleteprodxcoti() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('idcotizacion');
		$nversioncotizacion 	= $this->input->post('nversion');
		$nordenproducto 		= $this->input->post('idcotiproducto');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion,
            '@nordenproducto'   	=>  $nordenproducto
        );
        $retorna = $this->mcotizacion->deleteprodxcoti($parametros);
        echo json_encode($retorna);		
	}

    public function getbuscarensayos() { // Buscar Cotizacion
		$varnull = '';

		$descripcion   = $this->input->post('descripcion');
		$sacnoac       = $this->input->post('sacnoac');
        
        $parametros = array(
			'@descripcion'		=> ($this->input->post('descripcion') == '') ? '%' : '%'.$descripcion.'%',
			'@sacnoac'          => ($this->input->post('sacnoac') == '') ? '%' : $sacnoac,
        );
        $retorna = $this->mcotizacion->getbuscarensayos($parametros);
        echo json_encode($retorna);		
    }

    public function setregensayoxprod() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('hdnmIdcoti');
		$nversioncotizacion 	= $this->input->post('hdnmNvers');
		$nordenproducto 		= $this->input->post('hdnmIdprod');
		$censayo 		        = $this->input->post('mhdnmcensayo');
		$claboratorio 		    = $this->input->post('mtxtmCLab');
		$nvias 		            = $this->input->post('mtxtmvias');
		$icostoclienteparcial 	= $this->input->post('mtxtmCosto');
		$accion 		        = $this->input->post('hdnmAccion');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion,
            '@nordenproducto'   	=>  $nordenproducto,
            '@censayo'   	        =>  $censayo,
            '@claboratorio'   	    =>  $claboratorio,
            '@nvias'   	            =>  $nvias,
            '@icostoclienteparcial' =>  $icostoclienteparcial,
            '@accion'   	        =>  $accion
        );
        $retorna = $this->mcotizacion->setregensayoxprod($parametros);
        echo json_encode($retorna);		
	}

    public function seteditensayoxprod() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('ehdnmIdcoti');
		$nversioncotizacion 	= $this->input->post('ehdnmNvers');
		$nordenproducto 		= $this->input->post('ehdnmIdprod');
		$censayo 		        = $this->input->post('ehdnmcensayo');
		$claboratorio 		    = $this->input->post('etxtmCLab');
		$nvias 		            = $this->input->post('etxtmvias');
		$icostoclienteparcial 	= $this->input->post('etxtmCosto');
		$accion 		        = $this->input->post('ehdnmAccion');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion,
            '@nordenproducto'   	=>  $nordenproducto,
            '@censayo'   	        =>  $censayo,
            '@claboratorio'   	    =>  $claboratorio,
            '@nvias'   	            =>  $nvias,
            '@icostoclienteparcial' =>  $icostoclienteparcial,
            '@accion'   	        =>  $accion
        );
        $retorna = $this->mcotizacion->setregensayoxprod($parametros);
        echo json_encode($retorna);		
	}

    public function deleteensayoxprod() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('idcotizacion');
		$nversioncotizacion 	= $this->input->post('nversion');
		$nordenproducto 		= $this->input->post('idcotiproducto');
		$censayo 		        = $this->input->post('censayo');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion,
            '@nordenproducto'   	=>  $nordenproducto,
            '@censayo'   	        =>  $censayo
        );
        $retorna = $this->mcotizacion->deleteensayoxprod($parametros);
        echo json_encode($retorna);		
	}

    public function cerrarcotizacion() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('idcotizacion');
		$nversioncotizacion 	= $this->input->post('nversion');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion
        );
        $retorna = $this->mcotizacion->cerrarcotizacion($parametros);
        echo json_encode($retorna);		
	}

    public function abrircotizacion() { // Registrar informe PT
		$varnull = '';
		
		$cinternocotizacion 	= $this->input->post('idcotizacion');
		$nversioncotizacion 	= $this->input->post('nversion');
        
        $parametros = array(
            '@cinternocotizacion'   =>  $cinternocotizacion,
            '@nversioncotizacion'   =>  $nversioncotizacion
        );
        $retorna = $this->mcotizacion->abrircotizacion($parametros);
        echo json_encode($retorna);		
	}
}
?>