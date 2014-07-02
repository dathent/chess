<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Active_game_all extends  Waiting_stroke{

	public $list_name = 'Active game';

	public function sql(){
		$this->sql = "SELECT id, author_user_id, partner_user_id, created, edited FROM game WHERE status='active'";
	}

	public function print_list(){
		$list_array = $this->select_list();
		$all_game_list = "<table class='top'><caption>$this->list_name</caption><tr><th>№</th><th>Edit time</th><th>Author</th><th>Partner</th><th></th></tr>";
		$count_top = count($list_array)-1;
		$dbclass = Database::dbase();
		for($x = 0; $x <= $count_top; $x++){
			$author = $dbclass->search_db('user', array('login'), array('id'=> $list_array[$x]['author_user_id']));
            $author = $author['0']['login'];
			$partner = $dbclass->search_db('user', array('login'), array('id'=> $list_array[$x]['partner_user_id']));
            $partner = $partner['0']['login'];
			$all_game_list .= "<tr><td>".($x+1)."</td><td>".$list_array[$x]['edited']."</td><td>".$author."</td><td>".$partner."</td><td><a href='".URL."admin/?close_game_id=".$list_array[$x]['id']."'>Close game</a></td></tr>";
		}

		$all_game_list .= "</table>";
		return $all_game_list;
	}

}