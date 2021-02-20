<?php

if(!function_exists('getLinkFormChartBar')) {
	/**
	 * Convierte al grafico BAR
	 * @param string $type
	 * @param string $title
	 * @param array $label
	 * @param array $data
	 * @return string
	 * @link https://quickchart.io/chart?c={type:'bar',data:{labels:['nomb1','nomb1','nomb1','nomb1','nomb1'],datasets:[{label:'Users',data:[100,101,102,103,104]}]}}
	 */
	function getLinkFormChartBar(string $title, array $label, array $data): string
	{
		$label = array_map(function($item) {
			return "'" . rawurlencode($item) . "'";
		}, $label);
		$sLabels = implode(',', $label);
		$sData = implode(',', $data);
		$title = rawurlencode($title);
		return "https://quickchart.io/chart?c={type:'bar',data:{labels:[{$sLabels}],datasets:[{label:'{$title}',data:[{$sData}]}]}}";
	}
}

if(!function_exists('getLinkFormChartBar2')) {
	/**
	 * Convierte al grafico BAR
	 * @param string $type
	 * @param string $title
	 * @param array $label
	 * @param array $data
	 * @return string
	 * @link https://quickchart.io/chart?c={type:'bar',data:{labels:['nomb1','nomb1','nomb1','nomb1','nomb1'],datasets:[{label:'Users',backgroundColor:'rgba(255, 0, 0, 0.2)',data:[100,101,102,103,104]}]}}
	 */
	function getLinkFormChartBar2(string $title, array $label, array $data): string
	{
		$label = array_map(function($item) {
			return "'" . rawurlencode($item) . "'";
		}, $label);
		$sLabels = implode(',', $label);
		$sData = implode(',', $data);
		$title = rawurlencode($title);
		return "https://quickchart.io/chart?c={type:'bar',data:{labels:[{$sLabels}],datasets:[{label:'{$title}',data:[{$sData}]}]}}";
	}
}
