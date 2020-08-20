<?php

function public_url($url='')
{ 
    return base_url('assets/'.$url);
}
function public_url_ftp($url='')
{ 
    return base_url('FTPfileserver/'.$url);
}
function public_base_url($url='')
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
     * @see versionar_archivo
     * @param $rutaArchivo
     */
    function public_asset($rutaArchivo)
    {
        $archivo = versionar_archivo($rutaArchivo);
        if (!empty($archivo)) {
            echo $archivo;
        }
    }
}