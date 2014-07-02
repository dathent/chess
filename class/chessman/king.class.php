<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class King extends Queen{

	public function check_run(){
		$color_king = substr($this->color,0,1);
		$color_new_position_chessman = substr(strstr($this->new_position_chessman,'-'),1,1);
		if($this->difference_num <= 1 and $this->difference_letters <= 1 and $color_king != $color_new_position_chessman and $this->chessman != $this->new_position_chessman){
			return true;
		}
		elseif(strstr($this->new_position_chessman,'-',true) == 'rook'){
			$king_history = $this->search_chessman($this->description,$this->chessman);
			$rook_history = $this->search_chessman($this->description, $this->new_position_chessman);
            if($king_history == null and $rook_history == null){
				$rook_check = $this->check_rook();
                if($rook_check){
					$this->table_state[$this->chessman] = (substr($this->table_state[$this->new_position_chessman],0,1) == 'a')? "c".substr($this->table_state[$this->new_position_chessman],1,1)  : "g".substr($this->table_state[$this->new_position_chessman],1,1) ;
					$this->table_state[$this->new_position_chessman] = (substr($this->table_state[$this->new_position_chessman],0,1) == 'a')? "d".substr($this->table_state[$this->new_position_chessman],1,1) : "f".substr($this->table_state[$this->new_position_chessman],1,1) ;
					return $this->table_state;
				}
			}
		}
		else
			return false;
	}

	private function search_chessman($array_data, $chessman){
		if($array_data == null){
			return;
		}
		else{
			foreach($array_data as $key => $value){
				if(in_array($chessman, $value)) {
					return $key+1;
				}
			}
			return;
		}
	}

}