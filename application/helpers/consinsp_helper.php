<?php

if (!function_exists('getLinkFormChartBar')) {
	/**
	 * Convierte al grafico BAR
	 * @param array $label
	 * @param array $data
	 * @param array $colors
	 * @return string
	 * @link https://quickchart.io/chart?c={type:'bar',data:{labels:['nomb1','nomb1','nomb1','nomb1','nomb1'],datasets:[{label:'Users',data:[100,101,102,103,104]}]}}
	 */
	function getLinkFormChartBar(array $label, array $data, array $colors): string
	{
		$sLabels = clearLabel($label);
		$sData = implode(',', $data);
		$cColor = implode(',', $colors);
		$url = "https://quickchart.io/chart?c=";
		$url .= "{";
		$url .= "type:'bar',";
		$url .= "data:{";
		$url .= "labels:[{$sLabels}],";
		$url .= "datasets:[{label:'',data:[{$sData}],backgroundColor:[$cColor]}]";
		$url .= "},";
		$url .= "options:{";
		$url .= "legend:{display:false},";
		$url .= urlencode("scales:{yAxes:[{ticks:{fontSize:10,beginAtZero:true,fontFamily:'Arial',min:0,max:110,stepSize:10}}],xAxes:[{ticks:{fontSize:10,fontFamily:'Arial'}}]},");
		$url .= urlencode("plugins:{datalabels:{anchor:'end',align:'top',color:'#000',font:{size:10},formatter:(value)=>{return value+'%'}}}");
		$url .= "}";
		$url .= "}";
		return $url;
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
		$url = "https://quickchart.io/chart?c=";
		$url .= "{";
		$url .= "type:'bar',";
		$url .= "data:{";
		$url .= "labels:[{$sLabels}],";
		$url .= "datasets:[{$sData}]";
		$url .= "},";
		$url .= "options:{";
		$url .= "legend:{display:true,position:'right',align:'middle',labels:{fontSize:10,fontFamily:'Arial'}},";
		$url .= urlencode("scales:{yAxes:[{ticks:{fontSize:10,beginAtZero:true,fontFamily:'Arial'}}],xAxes:[{ticks:{fontSize:10,fontFamily:'Arial'}}]},");
		$url .= urlencode("plugins:{datalabels:{anchor:'end',align:'top',color:'#000',font:{size:10}}}");
		$url .= "}";
		$url .= "}";
		return $url;
	}
}

if (!function_exists('clearLabel')) {
	/**
	 * @param array $label
	 * @param boolean $typeUrl
	 * @return string
	 */
	function clearLabel(array $label, $typeUrl = true)
	{
		$label = array_map(function ($item) use ($typeUrl) {
			if ($typeUrl) {
				return "'" . rawurlencode($item) . "'";
			} else {
				return "'" . $item . "'";
			}
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

if (!function_exists('getColorRgba')) {
	/**
	 * Se obtiene el color por su calificacion
	 * @param $value
	 * @return string
	 */
	function getColorRgba($value) {
		$value = floatval($value);
		if ($value >= 86) {
			$color = "'rgba(0,128,0,1)'";
		} else if ($value >= 71 && $value <= 85.99) {
			$color = "'rgba(0,0,255,1)'";
		} else if ($value >= 51 && $value <= 70.99) {
			$color = "'rgba(255,255,0,1)'";
		} else { // 50.99
			$color = "'rgba(255,0,0,1)'";
		}
		return $color;
	}
}

if (!function_exists('getColor')) {
	/**
	 * Se obtiene el color por su calificacion
	 * @param $value
	 * @return string
	 */
	function getColor($value) {
		$value = floatval($value);
		if ($value >= 86) {
			$color = "green";
		} else if ($value >= 71 && $value <= 85.99) {
			$color = "#0000ff";
		} else if ($value >= 51 && $value <= 70.99) {
			$color = "yellow";
		} else { // 50.99
			$color = "red";
		}
		return $color;
	}
}
