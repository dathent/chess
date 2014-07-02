<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/chess/config.php');

function chessman_class_autoload($classname){

	$filename = $_SERVER['DOCUMENT_ROOT'].'/chess/class/chessman/'.strtolower($classname).'.class.php';
	if(is_file($filename)){
		include_once($filename);
	}
	else{
		$filename = $_SERVER['DOCUMENT_ROOT'].'/chess/class/'.strtolower($classname).'.class.php';
		if(is_file($filename)){
			include_once($filename);
		}
	}

}
if (version_compare(PHP_VERSION, '5.1.2', '>=')) {

	if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
		spl_autoload_register('chessman_class_autoload', true, true);
	} else {
		spl_autoload_register('chessman_class_autoload');
	}
} else {

	function __autoload($classname)
	{
		chessman_class_autoload($classname);
	}
}
