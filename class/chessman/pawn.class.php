<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Pawn extends Chessman_obj{

	public function check_run(){

		$position_start = ($this->color == 'black')? 7 : 2;
		$position_end = ($this->color == 'black')? 1 : 8;
		$number_current_position = intval(substr($this->current_position,1,1));
		$letter_current_position = substr($this->current_position,0,1);
		$next = ($this->color == 'black')? -1: 1;
		$position_next = $letter_current_position.($number_current_position+$next);
		$number_new_position = substr($this->new_position,1,1);

		if($this->color == 'white'){
            if($number_current_position > $number_new_position){
                return false;
            }
        }
        else{
            if($number_current_position < $number_new_position){
                return false;
            }
        }

        if($this->difference_num > 2 or $this->difference_letters > 1)
	        return false;

		elseif($this->difference_num <= 2 or $this->difference_letters <= 1){

			if($this->difference_num == 2 and $this->difference_letters == 0 and $number_current_position == $position_start and empty($this->new_position_chessman) and !in_array($position_next,$this->table_state)){
				return true;
			}

			elseif($this->difference_num == 1 and $this->difference_letters == 0 and $this->new_position_chessman == null){
				if($number_new_position == $position_end){
					return $this->new_chessman();
				}
				else
					return true;
			}
			elseif($this->difference_num == 1 and $this->difference_letters == 1 and $this->new_position_chessman != null){
				if($number_new_position == $position_end){
					return $this->new_chessman();
				}
				else
					return true;
			}
			else
				return false;
		}

        else
	        return false;
	}


	private function new_chessman(){

		$end_name = substr($this->color,0,1)."_".strstr($this->chessman,'-',true).substr(strstr($this->chessman,'_'),1,1);

		$options_list = "<option value='' disabled >Select new chessman</option>
						<option value='rook-$end_name'>rook</option>
		                 <option value='knight-$end_name'>knight</option>
		                 <option value='bishop-$end_name'>bishop</option>
		                 <option value='queen-$end_name'>queen</option>";

		return $options_list;
	}
}