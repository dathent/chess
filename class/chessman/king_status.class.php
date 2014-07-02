<?php

    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');


class King_status extends  Chessman_obj{



    public function check($checks = null){
        $enemy_color = ($this->color == 'white')? 'b' : 'w';
        if(in_array($this->new_position,$this->table_state)){
            $name_chessman = array_search($this->new_position,$this->table_state);
            if($enemy_color == substr(strstr($name_chessman,'-'),1,1)){
                $this->table_state[$name_chessman] = null;
            }
        }
        $this->table_state[$this->chessman] = $this->new_position;
        $this->game['0']['table_state'] = serialize($this->table_state);
        $this->game['0']['next_go'] = ($this->color == 'white')? 'black' : 'white';
        $position_king = $this->table_state["king-".substr($this->color,0,1)."_1"];
        foreach($this->table_state as $key => $coordinate){
            $color_chessman = substr(strstr($key,'-'),1,1);
            if($color_chessman == $enemy_color and $coordinate != null){
                $nameClass = ucfirst(strstr($key,'-',true));
                $obj_chassman = new $nameClass($this->game,$position_king,$key);
                $quest = $obj_chassman->check_run();
	            if($quest){
                    if($checks == null){
                        $check = new Check_end($this->game['0']['id']);
	                    return $check->check_finish();
                    }
                    else
                        return false;
                }
            }
        }
        if($checks == null){
	        $check = new Check_end($this->game['0']['id']);
	        return $check->check_pat();
        }
        else
            return true;
    }



}