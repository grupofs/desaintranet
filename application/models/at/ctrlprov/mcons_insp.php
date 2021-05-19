<?php


class mcons_insp extends CI_Model
{

	/**
	 * mcons_insp constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busqueda de todos las inspecciones
	 * @return array
	 */
	public function buscarInspecciones(
		$CCIA,
		$CAREA,
		$CSERVICIO,
		$CCLIENTE,
		$CCLIENTEPROV,
		$CCLIENTEMAQUILA,
		$CAREACLIENTE,
		$establecimientoMaqui,
		$dirEstablecimientoMaqui,
		$nroInforme,
		$TIPOESTADO,
		$FINI,
		$FFIN,
		$PELIGRO,
		$SEVALPROD,
		$calificacion
	): array
	{
		$select = "
			A.CAUDITORIAINSPECCION AS 'CODIGO',
            M.FSERVICIO AS 'FECHAINSPECCION',
            M.DUBICACIONFILESERVERPDF AS 'DUBICACIONFILESERVERPDF',
            M.DUBICACIONFILESERVERAC AS 'DUBICACIONFILESERVERAC',
            B.DRAZONSOCIAL AS 'CLIENTE',
            C.DRAZONSOCIAL AS 'PROVEEDOR',
            (
            CASE ISNULL(A.CESTABLECIMIENTOPROV, '0') 
            	WHEN '0' 
            		THEN ''
            	ELSE (
            		SELECT X.DESTABLECIMIENTO 
					FROM MESTABLECIMIENTOCLIENTE X 
					WHERE X.CCLIENTE = A.CPROVEEDORCLIENTE AND X.CESTABLECIMIENTO = A.CESTABLECIMIENTOPROV
				) 
			END
			) AS 'ESTABLECIMIENTOPROV',
            (CASE ISNULL(A.CESTABLECIMIENTOPROV, '0') WHEN '0' THEN '' ELSE (SELECT XX.DDIRECCION FROM MESTABLECIMIENTOCLIENTE XX WHERE XX.CCLIENTE = A.CPROVEEDORCLIENTE AND XX.CESTABLECIMIENTO = A.CESTABLECIMIENTOPROV) END) AS 'DIRECCIONPROV',
            (CASE ISNULL(A.CESTABLECIMIENTOPROV, '0') WHEN '0' THEN '' ELSE (SELECT K.DDEPARTAMENTO+'-'+K.DPROVINCIA+'-'+K.DDISTRITO FROM TUBIGEO K WHERE K.CUBIGEO = (SELECT L.CUBIGEO FROM MESTABLECIMIENTOCLIENTE L WHERE L.CCLIENTE = A.CPROVEEDORCLIENTE AND L.CESTABLECIMIENTO = A.CESTABLECIMIENTOPROV)) END) AS 'UBIGEOPROV',
            E.DRAZONSOCIAL AS 'MAQUILADOR',
            (CASE ISNULL(A.CESTABLECIMIENTOMAQUILA, '0') WHEN '0' THEN '' ELSE (SELECT Z.DESTABLECIMIENTO FROM MESTABLECIMIENTOCLIENTE Z WHERE Z.CCLIENTE = A.CMAQUILADORCLIENTE AND Z.CESTABLECIMIENTO = A.CESTABLECIMIENTOMAQUILA ) END) AS 'ESTABLECIMIENTOMAQUILA',
            (CASE ISNULL(A.CESTABLECIMIENTOMAQUILA, '0') WHEN '0' THEN '' ELSE (SELECT ZZ.DDIRECCION FROM MESTABLECIMIENTOCLIENTE ZZ WHERE ZZ.CCLIENTE = A.CMAQUILADORCLIENTE AND ZZ.CESTABLECIMIENTO = A.CESTABLECIMIENTOMAQUILA ) END) AS 'DIRECCIONMAQUILA',
            (CASE ISNULL(A.CESTABLECIMIENTOMAQUILA, '0') WHEN '0' THEN '' ELSE (SELECT Y.DDEPARTAMENTO+'-'+Y.DPROVINCIA+'-'+Y.DDISTRITO FROM TUBIGEO Y WHERE Y.CUBIGEO = (SELECT S.CUBIGEO FROM MESTABLECIMIENTOCLIENTE S WHERE S.CCLIENTE = A.CMAQUILADORCLIENTE AND S.CESTABLECIMIENTO = A.CESTABLECIMIENTOMAQUILA)) END) AS 'UBIGEOMAQUILA',
            I.DAREACLIENTE AS 'AREACLIENTE',
            L.DLINEACLIENTEE AS 'LINEA',
            M.PRESULTADOCHECKLIST AS 'RESULTADOCHECKLIST',
            CC.DDETALLECRITERIORESULTADO AS 'RESULTADOTEXTO',
            P.DREGISTRO AS 'TAMANOEMPRESAPROV',
            Q.DREGISTRO AS 'TIPOESTADOSERVICIO',
            M.DCOMENTARIO AS 'COMENTARIO',
            M.DLICENCIAFUNCIONAMIENTO AS'LICENCIADEFUNCIONAMIENTO',
            (CASE M.SLICENCIAFUNCIONAMIENTO WHEN 'T' THEN 'EN TRAMITE' WHEN 'N' THEN 'NO TIENE' WHEN 'S' THEN 'SI TIENE' ELSE '' END) AS 'ESTADOLICENCIADEFUNCIONAMIENTO',
            R.DAPEPAT + ' ' + CASE  WHEN LENGTH(R.DAPEMAT)= 0 THEN '' WHEN LENGTH(R.DAPEMAT) > 0 THEN R.DAPEMAT + ' ' END + R.DNOMBRE  AS 'CONSULTOR',            
           (SELECT MAX(V.DRAZONSOCIAL) FROM POTRACERTIFICADORA T, MCERTIFICADORA V 
                               WHERE T.CAUDITORIAINSPECCION = M.CAUDITORIAINSPECCION 
                              AND T.CCERTIFICADORA = V.CCERTIFICADORA AND T.FSERVICIO = M.FSERVICIO) AS 'EMPRESAINSPECTORA',
            (CASE M.ZCTIPOESTADOSERVICIO WHEN '519' THEN 'SI' ELSE 'NO' END) AS 'CONVALIDADO',
            (SELECT 
                (CASE
                    (SELECT COUNT(PAC.SACEPTARACCIONCORRECTIVA) FROM PACCIONCORRECTIVA PAC 
                                                                WHERE PAC.CAUDITORIAINSPECCION = PD.CAUDITORIAINSPECCION 
                                                                AND PAC.FSERVICIO = PD.FSERVICIO) 
                    WHEN 0 THEN 'NO' 
                    ELSE( 
                CASE (SELECT COUNT(PAC.SACEPTARACCIONCORRECTIVA) FROM PACCIONCORRECTIVA PAC
                                                                    WHERE PAC.CAUDITORIAINSPECCION = PD.CAUDITORIAINSPECCION 
                                                                    AND PAC.FSERVICIO = PD.FSERVICIO 
                                                                    AND PAC.SACEPTARACCIONCORRECTIVA = 'N')
                 WHEN 0 THEN 'SI' ELSE 'NO' END) 
                END)
                FROM PDAUDITORIAINSPECCION PD WHERE PD.CAUDITORIAINSPECCION = M.CAUDITORIAINSPECCION AND PD.FSERVICIO = M.FSERVICIO) AS  'ACCIONCORRECTIVA',
                (SELECT MAX(T.DUBICACIONFILESERVER) FROM POTRACERTIFICADORA T, MCERTIFICADORA V 
                               WHERE T.CAUDITORIAINSPECCION = M.CAUDITORIAINSPECCION 
                              AND T.CCERTIFICADORA = V.CCERTIFICADORA AND T.FSERVICIO = M.FSERVICIO) AS 'DUBICACIONFILESERVER',
                (CASE (SELECT DATEDIFF(DAY, GETDATE(), PD.FSERVICIO)
                    FROM PDAUDITORIAINSPECCION PD WHERE PD.ZCTIPOESTADOSERVICIO IN('028','029','030','498')
                    AND PD.CAUDITORIAINSPECCION = M.CAUDITORIAINSPECCION 
                    AND PD.FSERVICIO = M.FSERVICIO) 
            WHEN (SELECT NVALOR FROM TTABLA WHERE CTIPO = '571') THEN 1 
            WHEN (SELECT NVALOR FROM TTABLA WHERE CTIPO = '572') THEN 2 
            ELSE 0 END) AS 'COLOR',
            c.nruc as nruc, C.CCLIENTE AS 'CPROVEEDOR', 
            (select ncd.drazonsocial from mcertificaciones nc join MCERTIFICADORA ncd on nc.ccertificadora = ncd.ccertificadora and nc.ccertificacion = M.ccertificacion) AS 'CERTIFICADORA',
            (select nc.DCERTIFICACION from mcertificaciones nc where nc.ccertificacion = M.ccertificacion ) AS 'CERTIFICACION' ,
            (case scertificacion when 'ST' then 'SI TIENE' when 'NT' then 'NO TIENE' when 'SA' then 'SI APLICA' when 'NA' then 'NO APLICA' end ) AS 'SCERTIFICACION',
            dmarca,dmarca2,(select ttabla.dregistro from ttabla where ttabla.ctabla = '49' and ttabla.ctipo = A.zctipodestino) as 'DDESTINO',
             (SELECT DISTINCT msistema.dsistema + ' >> ' + mnorma.dnorma FROM mnorma, msistema, mchecklist 
                WHERE ( msistema.csistema = mnorma.csistema ) and ( mnorma.cnorma = mchecklist.cnorma ) and  
                      ( msistema.ccompania = mchecklist.ccompania ) and ( mnorma.sregistro = 'A' ) AND
                       mchecklist.cchecklist = M.cchecklist) AS 'SISTEMA', 
            (SELECT DCHECKLIST FROM mchecklist WHERE mchecklist.cchecklist = M.cchecklist) AS 'CHECKLIST', ISNULL(M.dinformefinal,'') AS 'dinformefinal',M.FCREACION AS 'FCREACION', ISNULL(A.SEVALPROD,'0') AS 'SEVALPROD',
            (select ML.speligro from MLINEAPROCESOCLIENTE ML  where ML.clineaprocesocliente =  A.clineaprocesocliente) as espeligro, M.CCHECKLIST, AE.DNORMA, AG.DSISTEMA, AF.DSUBNORMA
		";
		$from = "
		 	PCAUDITORIAINSPECCION A LEFT OUTER JOIN MLINEAPROCESOCLIENTE L ON A.CLINEAPROCESOCLIENTE = L.CLINEAPROCESOCLIENTE
            LEFT OUTER JOIN MCLIENTE C ON A.CPROVEEDORCLIENTE = C.CCLIENTE
            LEFT OUTER JOIN MCLIENTE E ON A.CMAQUILADORCLIENTE = E.CCLIENTE,
            MCLIENTE B, MAREACLIENTE I,
            PDAUDITORIAINSPECCION M LEFT OUTER JOIN MUSUARIO R ON M.CUSUARIOCONSULTOR = R.CUSUARIO
            LEFT OUTER JOIN MDETALLECRITERIORESULTADO CC ON CC.CDETALLECRITERIORESULTADO = M.CDETALLECRITERIORESULTADO AND CC.CCRITERIORESULTADO = M.CCRITERIORESULTADO
            JOIN MCHECKLIST AD ON AD.CCHECKLIST = M.CCHECKLIST
            JOIN MNORMA AE ON AE.CNORMA = AD.CNORMA
            JOIN MSUBNORMA AF ON AF.CNORMA = AD.CNORMA AND AF.CSUBNORMA = M.CSUBNORMA
            JOIN MSISTEMA AG ON AG.CSISTEMA = AE.CSISTEMA,
            MCRITERIORESULTADO N, TTABLA P, TTABLA Q, PCPTE AA, PDPTE BB
		";

		$where = "
			A.CCLIENTE = B.CCLIENTE
			AND A.CCLIENTE = I.CCLIENTE
			AND A.CAREACLIENTE = I.CAREACLIENTE
			AND A.CAUDITORIAINSPECCION = M.CAUDITORIAINSPECCION
			AND M.CCRITERIORESULTADO = N.CCRITERIORESULTADO
			AND C.ZCTIPOTAMANOEMPRESA = P.CTIPO
			AND M.ZCTIPOESTADOSERVICIO = Q.CTIPO
			AND AA.CINTERNOPTE = BB.CINTERNOPTE
			AND A.CINTERNOPTE = BB.CINTERNOPTE
			AND A.NORDEN = BB.NORDEN
			AND BB.CCOMPANIA    = '{$CCIA}'
			AND BB.CAREA        = '{$CAREA}'
			AND BB.CSERVICIO    = '{$CSERVICIO}'
			AND ISNULL(B.CCLIENTE,'%') LIKE '{$CCLIENTE}'  
			AND ISNULL(C.CCLIENTE,'%') LIKE '{$CCLIENTEPROV}'
			AND ISNULL(E.CCLIENTE,'%') LIKE '{$CCLIENTEMAQUILA}'
			AND (
				ISNULL(ESTABLECIMIENTOPROV, '%') LIKE '{$establecimientoMaqui}'
				OR ISNULL(MAQUILADOR, '%') LIKE '{$establecimientoMaqui}'
			)
			AND (
				ISNULL(DIRECCIONPROV, '%') LIKE '{$dirEstablecimientoMaqui}'
				OR ISNULL(UBIGEOPROV, '%') LIKE '{$dirEstablecimientoMaqui}'
				OR ISNULL(DIRECCIONMAQUILA, '%') LIKE '{$dirEstablecimientoMaqui}'
				OR ISNULL(UBIGEOMAQUILA, '%') LIKE '{$dirEstablecimientoMaqui}'
			)
			AND ISNULL(dinformefinal, '%') LIKE '{$nroInforme}'
			AND A.CTIPOREGISTRO = 'I'
			AND L.SPELIGRO like '{$PELIGRO}'
			AND A.SEVALPROD = '{$SEVALPROD}'
		";

		if (!empty($calificacion)) {
			$where .= " AND lcase(CC.DDETALLECRITERIORESULTADO) IN ({$calificacion}) ";
		}

		if (!empty($TIPOESTADO)) {
			$where .= " AND lcase(M.ZCTIPOESTADOSERVICIO) IN ({$TIPOESTADO}) ";
		}

		if(!empty($CAREACLIENTE)) {
			$where .= " AND lcase(I.CAREACLIENTE) IN ({$CAREACLIENTE}) ";
		}

		if (!empty($FINI)) {
			$where .= " AND (M.FSERVICIO >= '{$FINI}' OR ISNULL('{$FINI}', '1900-01-01') = '1900-01-01') ";
		}

		if (!empty($FFIN)) {
			$where .= " AND (M.FSERVICIO <= '{$FFIN}' OR ISNULL('{$FFIN}', '1900-01-01') = '1900-01-01') ";
		}

		$sql = "SELECT {$select} FROM {$from} WHERE {$where} ORDER BY A.CAUDITORIAINSPECCION DESC, M.FSERVICIO DESC";

		$query = $this->db->query($sql);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * Busca una inspección con su ID
	 * @param $CAUDITORIAINSPECCION, $CINTERNOPTE
	 * @return array|bool|mixed|object|null
	 */
	public function buscarInspccion($CAUDITORIAINSPECCION, $CINTERNOPTE)
	{
		$this->db->select('*');
		$this->db->from('PDAUDITORIAINSPECCION');
		$this->db->where('CAUDITORIAINSPECCION', $CAUDITORIAINSPECCION);
		$this->db->where('FSERVICIO', $CINTERNOPTE);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * Busca una inspección con su ID
	 * @param $CAUDITORIAINSPECCION
	 * @return array|bool|mixed|object|null
	 */
	public function buscarInspccionCab($CAUDITORIAINSPECCION)
	{
		$this->db->select('*');
		$this->db->from('PCAUDITORIAINSPECCION');
		$this->db->where('CAUDITORIAINSPECCION', $CAUDITORIAINSPECCION);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfCaratula(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_caratula(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfParrafo1Parte1(array $data): string
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo1_pt1(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfParrafo1Parte2(array $data): string
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo1_pt2(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro1(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro1(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfParrafo2(array $data): string
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo2(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfGrafico1(array $data)
	{
		$query = $this->db->query("CALL sp_graf_01(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro2(array $data): array
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro2(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfGrafico2(array $data): array
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_grafico2(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro3(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro3(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro4(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro4(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfConclucionesGeneral(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_concluciones(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfConclucionesEspecificas(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_concluciones_especificas(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfPlanAccionParrafo1(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_plan_acciones_parrafo1(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfPlanAccionParrafo2(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_plan_acciones_parrafo2(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfPlanAccionParrafo3(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_plan_acciones_parrafo3(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfCriteriosInspeccion(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_criterio_insp(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfCriteriosEvaluacion(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_criterio_eval(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfEscalaValoracion(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_escala_val(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfParrafoRequisitos(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo_requisitos(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfRequisitoExcluyentes(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_requisitos_excl(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return mixed
	 */
	public function getDatosInspector(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_inspector(?,?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfPeligros(array $data)
	{
		$query = $this->db->query("CALL sp_peligros_inspeccion(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfExcluyentes(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_excluyentes(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getAccionesCorrectiva(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_accion_correctiva(?, ?)", $params);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getProveedor(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor(?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $params
	 * @return mixed
	 */
	public function getProveedorEstablecimiento(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor_establecimiento(?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getProveedorLinea(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor_linea(?,?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row()->DLINEACLIENTEE : null;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getProveedorContactos(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor_contactos(?,?)", $params);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getAreaCliente(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_area_cliente(?)", $params);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}
}
