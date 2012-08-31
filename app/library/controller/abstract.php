<?php
abstract class controller_abstract{

	public function __construct(){
		
		
		
	}
	public function dispatch($action){
		
		
		$view =  APP_HOME . DIRECTORY_SEPARATOR . 'modulos' . 
								DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR .
															 "{$this->controller}-{$action}.phtml";
	
		if(file_exists($view) === false){
			
			throw  new Exception("se intento buscar la vista ".$view);
			
		}
	
	
	}
	
	
}