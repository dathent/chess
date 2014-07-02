<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Finish_game extends  Active_game{

	public $list_name = 'My finish game';

	public function sql(){
		$this->sql = "SELECT id, author_user_id, partner_user_id, result, description, edited, created FROM game WHERE status='finish' and (author_user_id= $this->id  or partner_user_id= $this->id )";
	}

	public function print_list(){
		$list_array = $this->select_list();
		$finish_list = "<table class='top'><caption>$this->list_name</caption><tr><th>№</th><th>Partner</th><th>My color</th><th>Result</th><th>History</th></tr>";
		$count_top = count($list_array)-1;
		$dbclass = Database::dbase();
		$game = new Game();
		for($x = 0; $x <= $count_top; $x++){
			$partner = ($this->id == $list_array[$x]['author_user_id'])? $list_array[$x]['partner_user_id']  : $list_array[$x]['author_user_id'] ;
			$color = ($this->id == $list_array[$x]['author_user_id'])? 'white' : 'black';
			$result = unserialize($list_array[$x]['result']);
			if(empty($result['pat'])){
				$result_game = ($result['mat'] == $this->id)? 'Losing' : 'Win' ;
			}
			else{
				$result_game = 'Draw';
			}
			$game_val['0']=$list_array[$x];
			$login = $dbclass->search_db('user', array('login'), array('id'=> $partner));
            $login = $login['0']['login'];
			$finish_list .= "<tr><td>".($x+1)."</td><td>".$login."</td><td>".$color."</td><td>$result_game</td><td><details>".$game->history_print($game_val)."</details></td></tr>";
		}

		$finish_list .= "</table>";
		return $finish_list;
	}

}