<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Knight extends Chessman_obj{

    public function check_run(){
        if(($this->difference_num == 2 and $this->difference_letters == 1) or ($this->difference_letters == 2 and $this->difference_num == 1)){
            if(substr(strstr($this->new_position_chessman,'-'),1,1) != substr($this->color,0,1))
	            return true;
	        else
		        return false;
        }
        else
            return false;
    }
}