<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Database{

	public  $base;

    private  function link(&$link, $sql = null){
        try {
            $link = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE,USER,PASSWORD);
	        $sql = ($sql != null)? $sql : null ;
	        $link->query($sql);
	    }
        catch(PDOException $e){
	        $link = new PDO("mysql:host=".HOST.";".USER,PASSWORD);
	        $link->query("create database".DATA_BASE);
	        $sql = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/chess/chess.sql');
	        $this->link($sql);
	        $link = null;
        }
    }
	
    function __construct(){
        $this->link($this->base);
    }
	
	function write_table($nameTable,$arrayValue){
		$into = null;
		$value = null;
		foreach($arrayValue as $colum => $val){
			if($into != null){ $into .= ","; $value .= ",";}
			$into .= $colum;
			if($colum == 'created' or $colum == 'edited')
				$value .= $val;
			else
				$value .= "'$val'";
		}
		$sql = "INSERT INTO $nameTable ($into) VALUES($value)";
        $this->base->query($sql);
        $id = $this->base->lastInsertId();
        return $id;
	}
	
	function search_db($tablename,$set = 0,$where = 0, $oper = ' or '){
        $seting = ($set == 0)?"*": null;
        $param =  null;
        if($set != 0){
              foreach($set as $setV){
                  if($seting != null) $seting .= ',';
                  $seting .= "  $setV";
              }
        }
        if($where != 0){
              foreach($where as $wherK => $wherV){
				   if(is_array($wherV)){
						foreach($wherV as $value){
							if($param != null )
								$param .= $oper;
							else
								$param .= "WHERE ";
							$param .= "$wherK = '$value'";
						}
					}
				   else{
				   	if($param != null ){
						$param .= $oper;
					}else
						$param .= "WHERE ";
						$param .= "$wherK = '$wherV'";
					}
				}

        }

        $sql = "SELECT $seting FROM $tablename $param";
        $columTable = $this->base->prepare($sql);
		$columTable->execute();
		$arrayResult=$columTable->fetchAll(PDO::FETCH_ASSOC); //array();
		return $arrayResult;
	}


	function select($sql){
		$columTable = $this->base->prepare($sql);
		$columTable->execute();
		$arrayResult=$columTable->fetchAll(PDO::FETCH_ASSOC); //array();
		return $arrayResult;
	}


	function ubdate_table($tablename,$set,$wher, $oper = ' or '){
		$seting = null;
		$param = null;
		foreach($set as $setK => $setV){
			if($seting != null) $seting .= ',';
			$seting .= "$setK = '$setV'";
		}
		foreach($wher as $wherK => $wherV){
			if(is_array($wherV)){
				foreach($wherV as $value){
					if($param != null) 
						$param .= $oper;
					$param .= "$wherK = '$value'";
				}
			}
			else{
				if($param != null) 
					$param .= $oper;
				$param .= "$wherK = '$wherV'";
			}
		}
		$sql = "update $tablename set $seting where $param";
		$this->base->query($sql);
	}

    public static function  dbase(){
        global $DB;

        if( isset($DB) ){
            return $DB;
        }
        else{
            $DB = new self();
            return $DB;
        }
    }
}


