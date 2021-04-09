<?php

function public_url($url = '')
{
	return base_url('assets/' . $url);
}

function public_url_ftp($url = '')
{
	return base_url('FTPfileserver/' . $url);
}

function public_base_url($url = '')
{
	return base_url($url);
}

if (!function_exists('versionar_archivo')) {
	/**
	 * Devuelve el archivo enviado pero con una extension para versionar
	 * @param $rutaArchivo
	 * @param string $extension
	 * @return string
	 */
	function versionar_archivo($rutaArchivo, $extension = '')
	{
		$rutaArchivo = "{$rutaArchivo}{$extension}";
		if ($archivo = file_exists(APPPATH . "../assets/{$rutaArchivo}")) {
			// Se busca una version del archivo en caso halla sido modificado con una ruta completa
			$tempURL = str_replace("\\", "/", FCPATH) . "assets/{$rutaArchivo}";
			// Se crea el archivo versionado
			$versionScript = "{$rutaArchivo}?v" . filemtime($tempURL);
			return base_url('assets/' . $versionScript);
		}
		return '';
	}
}

if (!function_exists('public_asset')) {
	/**
	 * Imprime la ruta de un archivo versionado
	 * @param $rutaArchivo
	 * @see versionar_archivo
	 */
	function public_asset($rutaArchivo)
	{
		$archivo = versionar_archivo($rutaArchivo);
		if (!empty($archivo)) {
			echo $archivo;
		}
	}
}

if (!function_exists('responseResult')) {
	/**
	 * Imprimir el resultado de los controlladores
	 * @param array $result
	 * @param boolean $setStatusHeader default true
	 * @void
	 */
	function responseResult(array $result, bool $setStatusHeader = true): void
	{
		$result['status'] = ($result['status'] == 0) ? 500 : $result['status'];
		if ($setStatusHeader) set_status_header($result['status']);
		$JSON = json_encode($result, JSON_UNESCAPED_UNICODE);
		switch (json_last_error()) {
			//case JSON_ERROR_NONE:
			//    $MENSAJE = "Ok";
			//    break;
			case JSON_ERROR_DEPTH:
				$JSON = json_encode(["status" => 500, "message" => "JSON: Excedido tamaño máximo de la pila.", "data" => []]);
				break;
			case JSON_ERROR_STATE_MISMATCH:
				$JSON = json_encode(["status" => 500, "message" => "JSON: Desbordamiento de buffer o los modos no coinciden.", "data" => []]);
				break;
			case JSON_ERROR_CTRL_CHAR:
				$JSON = json_encode(["status" => 500, "message" => "JSON: Encontrado carácter de control no esperado.", "data" => []]);
				break;
			case JSON_ERROR_SYNTAX:
				$JSON = json_encode(["status" => 500, "message" => "JSON: Error de sintaxis, JSON mal formado.", "data" => []]);
				break;
			case JSON_ERROR_UTF8:
				$JSON = json_encode(["status" => 500, "message" => "JSON: Caracteres UTF-8 malformados, posiblemente están mal codificados.", "data" => []]);
				break;
		}
		echo $JSON;
	}
}

if (!function_exists('validateEmail')) {
	/**
	 * Validar email
	 * @param string $email
	 * @return mixed
	 */
	function validateEmail(string $email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

if (!function_exists('validateDate')) {
	/**
	 * Compara la fecha enviada por el parametro $format
	 * @param string $date
	 * @param string $format
	 * @return bool
	 */
	function validateDate(string $date, string $format = 'Y-m-d H:i:s'): bool
	{
		if (empty($date)) {
			return false;
		}
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}

if (!function_exists('numberFormat')) {
	/**
	 * Devuelve el valor con la "," o no
	 * Valor de tipo:
	 * -human
	 * -none
	 * @param string $value
	 * @param int $decimal
	 * @param string $type
	 * @return string
	 */
	function numberFormat($value, $decimal, $type = 'none'): string
	{
		$thousands_sep = ($type == "human") ? ',' : '';
		return number_format($value, $decimal, ".", $thousands_sep);
	}
}

if (!function_exists('getMonthText')) {
	/**
	 * Devuelve la posición de un mes en texto
	 * @param $pos
	 * @return string
	 */
	function getMonthText($pos): string
	{
		$months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		$pos = intval($pos);
		return (isset($months[$pos])) ? $months[$pos] : '';
	}
}

if (!function_exists('base64ResourceConvert')) {
	/**
	 * @param $resource
	 * @return string
	 */
	function base64ResourceConvert($resource): string
	{
		$data = file_get_contents($resource);
		return 'data:image/png;base64,' . base64_encode($data);
	}
}
