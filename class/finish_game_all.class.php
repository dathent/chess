<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Finish_game_all extends  Finish_game{

	public $list_name = 'Finish game';

	public function sql(){
		$this->sql = "SELECT id, author_user_id, partner_user_id, result, description, edited, created FROM game WHERE status='finish'";
	}

	public function print_list(){
		$list_array = $this->select_list();
		$finish_list = "<table class='top'><caption>$this->list_name</caption><tr><th>№</th><th>Author</th><th>Partner</th><th>Losing</th><th>History</th></tr>";
		$count_top = count($list_array)-1;
		$dbclass = Database::dbase();
		$game = new Game();
		for($x = 0; $x <= $count_top; $x++){
			$result = unserialize($list_array[$x]['result']);
			$author = $dbclass->search_db('user', array('login'), array('id'=> $list_array[$x]['author_user_id']));
            $author = $author['0']['login'];
            $partner = $dbclass->search_db('user', array('login'), array('id'=> $list_array[$x]['partner_user_id']));
			$partner = $partner['0']['login'];
            if(empty($result['pat'])){
				$result_game = ($result['mat'] == $list_array[$x]['author_user_id'])? $author : $partner ;
			}
			else{
				$result_game = 'Draw';
			}
			$game_val['0']=$list_array[$x];
			$finish_list .= "<tr><td>".($x+1)."</td><td>".$author."</td><td>".$partner."</td><td>$result_game</td><td><details>".$game->history_print($game_val)."</details></td></tr>";
		}

		$finish_list .= "</table>";
		return $finish_list;
	}
}