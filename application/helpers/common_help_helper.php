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