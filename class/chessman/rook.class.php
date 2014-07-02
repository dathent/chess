<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Rook extends Queen{

    public function check_run(){
        if(($this->difference_num > 0 and $this->difference_letters == 0) or ($this->difference_letters > 0 and $this->difference_num == 0)){
	        return $this->check_rook();
        }
    else{
	        return false;
        }
    }
}
