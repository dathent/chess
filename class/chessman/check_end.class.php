<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');


class Check_end extends  Chessman_obj{


	private $shah = "<h2 class='end_game'>Check !</h2>";
	private $mat = "<h2 class='end_game'>Checkmate !</h2>";
	private $pat = "<h2 class='end_game'>Pat !</h2>";


	public function check(){
		$color_chessman = substr($this->color,0,1);
		foreach($this->table_state as $man => $coordinate){
			$man_color = substr(strstr($man,'-'),1,1);
			if($man_color == $color_chessman and $coordinate != null){
				$nameClass = ucfirst(strstr($man,'-',true));
				for($s= 'a'; $s <= 'h';$s++) {
					for($n = 1; $n <= 8;$n++){
						$new_position = $s.$n;
						$obj_chassman = new $nameClass($this->game,$new_position,$man);
						$quest = $obj_chassman->check_run();
						if($quest){
							$table_state = (is_array($quest))? $quest : $this->table_state ;
                            $game = $this->game;
                            $game['0']['table_state'] = serialize($table_state);
                            $new_position = (is_array($quest))? $table_state[$man] : $new_position ;
                            $king = new King_status($game,$new_position, $man);
							if($king->check(1)){
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}

	public function check_finish(){
		if(!$this->check()){
			$game_class = new Game();
			$game_class->end_game($this->game,$this->game['0']['id'],$this->game['0']['next_go'],'mat');
			return $this->mat;
		}
		else{
			return $this->shah;
		}
	}

	public function check_pat(){
		if(!$this->check()){
			$game_class = new Game();
			$game_class->end_game($this->game,$this->game['0']['id'],$this->game['0']['next_go'],'pat');
			return $this->pat;
		}
		else{
			return true;
		}
	}

}