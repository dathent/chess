<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Waiting_stroke extends Top_10{


	public $sql;

	public $list_name = 'Waiting my stroke';

	public function sql(){
		$this->sql = "SELECT id, author_user_id, partner_user_id, next_go FROM game WHERE status='active' and ((author_user_id= $this->id  and next_go='white') or (partner_user_id= $this->id and next_go='black'))";
	}

	public function print_list(){
		$list_array = $this->select_list();
		$waiting_list = "<table class='top'><caption>$this->list_name</caption><tr><th>№</th><th>Partner</th><th>My color</th><th></th></tr>";
		$count_top = count($list_array)-1;
		$dbclass = Database::dbase();
		for($x = 0; $x <= $count_top; $x++){
			$partner = ($this->id == $list_array[$x]['author_user_id'])? $list_array[$x]['partner_user_id']  : $list_array[$x]['author_user_id'] ;
			$color = ($this->id == $list_array[$x]['author_user_id'])? 'white' : 'black';
			$login = $dbclass->search_db('user', array('login'), array('id'=> $partner));
            $login = $login['0']['login'];
			$waiting_list .= "<tr><td>".($x+1)."</td><td>".$login."</td><td>".$color."</td><td><a href='".URL."game/?game_id=".$list_array[$x]['id']."'>".strrchr($this->list_name,' ')."</a></td></tr>";
		}

		$waiting_list .= "</table>";
		return $waiting_list;
	}

}