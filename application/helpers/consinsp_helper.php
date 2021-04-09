<?php

if (!function_exists('getLinkFormChartBar')) {
	/**
	 * Convierte al grafico BAR
	 * @param array $label
	 * @param array $data
	 * @return string
	 * @link https://quickchart.io/chart?c={type:'bar',data:{labels:['nomb1','nomb1','nomb1','nomb1','nomb1'],datasets:[{label:'Users',data:[100,101,102,103,104]}]}}
	 */
	function getLinkFormChartBar(array $label, array $data): string
	{
		$sLabels = clearLabel($label);
		$sData = implode(',', $data);
		return "https://quickchart.io/chart?c={type:'bar',data:{labels:[{$sLabels}],datasets:[{label:'',data:[{$sData}]}]},options:{legend:{display:false}}}";
	}
}

if (!function_exists('getLinkFormChartBar2')) {
	/**
	 * Convierte al grafico BAR
	 * @param array $label
	 * @param string $sData
	 * @return string
	 * @link https://quickchart.io/chart?c={type:'bar',data:{labels:['1','2','3'],datasets:[{label:'Maximo',data:[400,110,40]},{label:'Obtenido',data:[400,100,40]}]}}
	 */
	function getLinkFormChartBar2(array $label, string $sData): string
	{
		$sLabels = clearLabel($label);
		return "https://quickchart.io/chart?c={type:'bar',data:{labels:[{$sLabels}],datasets:[{$sData}]},options:{legend:{display:true,position:'right',align:'middle'}}}";
	}
}

if (!function_exists('clearLabel')) {
	/**
	 * @param array $label
	 * @return string
	 */
	function clearLabel(array $label)
	{
		$label = array_map(function ($item) {
			return "'" . rawurlencode($item) . "'";
		}, $label);
		return implode(',', $label);
	}
}

if (!function_exists('getValueGraphic2')) {
	/**
	 * @param array $data
	 * @param string $filter
	 * @return array
	 */
	function getValueGraphic2(array $data, string $filter) {
		return array_map(function($res) use ($data) {
			return $res->mayor_val;
		}, array_filter($data, function($item) use ($filter) {
			return (strtolower($item->Maximo) == $filter);
		}, 0));
	}
}
