<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Mainmenu{

    protected  $tablename = 'main_menu';
    public  $fileMenu;

    protected function render_menu(){
        $dbclass = Database::dbase();
        return $dbclass->search_db($this->tablename);
    }

    function output_menu(){
        $list_menu = "<ul class = 'ul_mainMenu'> \n";
		$M = $this->render_menu();
        foreach($M as $key => $val ){
            $list_menu .= "<li class='li_mainMenu'><a href='".URL.$M[$key]['url']."' class='buttom_mainMenu'>".$M[$key]['label']."</a></li> \n";
        }
        $list_menu .= "</ul> \n";
        file_put_contents($this->fileMenu,$list_menu);
    }
	
	function create_menu($arrayForm){
		$dbclass = Database::dbase();
		$exception = $dbclass->write_table($this->tablename,$arrayForm);
     if($exception != null ){
            $this->output_menu();
         }
     else{
            $_SESSION['alert'] = "<script>alert('URL or label created !')</script>";
        }
	}
	
	function update_menu($array){
		$dbclass = Database::dbase();
		$set = array();
		$param = array();
		foreach($array as $key => $value){
			if($key == 'id') 
				$param[$key] = $value;
			else
				$set[$key] = $value;
		}
		$dbclass->ubdate_table($this->tablename,$set,$param);
		$this->output_menu();
	}

    function __construct(){
        $this->fileMenu = $_SERVER['DOCUMENT_ROOT']."/chess/html/main_menu.inc";
        if(!file_exists($this->fileMenu)){
            $menu = fopen($this->fileMenu,'w');
            fclose($menu);
            $this->output_menu();
        }
        else
           return;
    }


}