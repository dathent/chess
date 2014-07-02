<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Bishop extends Queen{

    public function check_run(){

        if($this->difference_num == $this->difference_letters){
			return $this->check_bishop();
        }
	    else
		    return false;
    }
}