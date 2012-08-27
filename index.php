<?php
$url = substr($_SERVER["SCRIPT_NAME"],0,strripos($_SERVER["SCRIPT_NAME"],"/"));
$protocolo = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on")?"https":"http";
$url = $protocolo."://{$_SERVER["HTTP_HOST"]}".$url;
define("URL",$url);
define("APP_HOME",__DIR__.DIRECTORY_SEPARATOR."app");
$include_patch = APP_HOME.DIRECTORY_SEPARATOR."mods";
set_include_path($include_patch.get_include_path());

function  __autoload($nombre){
	$nombre =str_repalce("_",DIRECTORY_SEPARATOR,$nombre);
	$file = $nombre.".php";
	if($fh = @fopen($file,"r",true)){
		require_once($file);
	}
	@fclose($fh);
	
}
$urlRequest = $_SERVER["REQUEST_URI"];
$requestUrl =  str_replace("index.php",NULL,$_SERVER["SCRIPT_NAME"]);
$parametrosGet = str_replace($requestUrl,NULL,$urlRequest);
$parametrosGet = explode('?',$parametrosGet);
$parametrosGet = $parametrosGet[0];
$parametrosGet = explode("/",$parametrosGet);
$_GET["controller"] = $controller  = (isset($parametrosGet[0]) )? $parametrosGet[0]:"index";
$_GET['action']     = $action     = (isset($parametrosGet[1]) && $parametrosGet[1] )? $parametrosGet[1] : "index";
if(count($parametrosGet)>2){
	for($item = 2; $item < $items; $item+=2){
		if($parametrosGet[$item]){
			
			$_GET[ $parametrosGet[$item] ] = isset($parametrosGet[$item+1])?$parametrosGet[$item+1]:TRUE;
		}
	}
}

print_r($_GET);