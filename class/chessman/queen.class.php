<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Queen extends Chessman_obj{

	public function check_run(){
		if($this->difference_num == $this->difference_letters){
			return $this->check_bishop();
		}
		elseif(($this->difference_num > 0 and $this->difference_letters == 0) or ($this->difference_letters > 0 and $this->difference_num == 0)){
			return $this->check_rook();
		}
		else{
			return false;
		}
	}


	public function check_rook(){
		if ($this->difference_num != null){
			$coordinate = substr($this->current_position,1,1);
			$new_position = substr($this->new_position,1,1);
			$mat = ($coordinate < substr($this->new_position,1,1))? 1: -1;
		}
		else{
			$coordinate = ord(substr($this->current_position,0,1));
			$new_position = ord(substr($this->new_position,0,1));
			$mat = ($coordinate < ord(substr($this->new_position,0,1)))? 1: -1;
		}
		$coordinate = $coordinate+$mat;

		for($coordinate; $coordinate != $new_position; $coordinate = $coordinate + $mat){
			$position = ($this->difference_num != null)? substr($this->current_position,0,1).$coordinate : chr($coordinate).substr($this->current_position,1,1);
			if(in_array($position,$this->table_state)){
				return false;
			}
		}
		if(substr(strstr($this->new_position_chessman,'-'),1,1) != substr($this->color,0,1) or strstr($this->chessman,'-',true) == 'king')
			return true;
		else
			return false;
	}


	public function check_bishop(){
		if($this->current_position == $this->new_position)
			return false;
		$number = substr($this->current_position,1,1);
		$letter = ord(substr($this->current_position,0,1));
		$mat_number = ($number < substr($this->new_position,1,1))? 1 : -1 ;
		$mat_letter = ($letter < ord(substr($this->new_position,0,1)))? 1 : -1 ;
		$number = $number + $mat_number;
		$letter = $letter + $mat_letter;

		for($letter, $number; chr($letter).$number != $this->new_position; $letter = $letter + $mat_letter, $number = $number + $mat_number){
			$position = chr($letter).$number;
			if(in_array($position, $this->table_state)){
				return false;
			}
		}
		if(substr(strstr($this->new_position_chessman,'-'),1,1) != substr($this->color,0,1))
			return true;
		else
			return false;
	}
}