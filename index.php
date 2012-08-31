<?php
$url = substr($_SERVER["SCRIPT_NAME"],0,strripos($_SERVER["SCRIPT_NAME"],"/"));
$protocolo = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on")?"https":"http";
$url = $protocolo."://{$_SERVER["HTTP_HOST"]}".$url;
define("URL",$url);
define("APP_HOME",__DIR__.DIRECTORY_SEPARATOR."app");
$include_patch = APP_HOME.DIRECTORY_SEPARATOR."library".PATH_SEPARATOR.APP_HOME.DIRECTORY_SEPARATOR."modulos";

set_include_path($include_patch.get_include_path());

function  __autoload($nombre){
	$nombre =str_replace("_",DIRECTORY_SEPARATOR,$nombre);
	$file = $nombre.".php";
	
	if($fh = @fopen($file,"r",true)){
		require_once($file);
		
	}
	@fclose($fh);
	
}



$urlRequest = $_SERVER["REQUEST_URI"];
$requestUrl =  str_replace("index.php",NULL,$_SERVER["SCRIPT_NAME"]);

$parametrosGet = explode('?',$urlRequest);
$parametrosGet = explode("/",$parametrosGet[0]);

$_GET["controller"] = $controller  = ( $parametrosGet[1] )? $parametrosGet[1]:"index";
$_GET['action']     = $action     = (isset($parametrosGet[2]) && $parametrosGet[2] ) ? $parametrosGet[2] : "index";


$clase_controlador = "controller_{$controller}";

if(class_exists($clase_controlador)){

	 if(in_array($action."Action",get_class_methods($clase_controlador))){
	 		
			 $controler_objecto = new $clase_controlador();
		
	 		if($controler_objecto instanceof controller_abstract){
	 				
	 				$controler_objecto->controller = $controller;
	 				$controler_objecto->dispatch($action);
	 				
	 			
	 		}else{
	 			
	 			
	 		
	 			
	 		}
	 	
	 		
	 }
		
	
	
}else{
	echo $clase_controlador;
	die;
	throw new Exception("el controllador al cual se quiere llamar no existe");
	
}
