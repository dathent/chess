<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Top_10{

	public $table_name = 'user';

	public $sql;

	public $list;

	public $id;



	public function select_list(){
		$dbclass = Database::dbase();
		return $dbclass->select($this->sql);
	}

	public function __construct($id = 0){
		$this->id = $id;
		$this->sql();
		$this->list = $this->print_list();
	}

	public function sql(){
		$this->sql ="SELECT login, points FROM  $this->table_name  ORDER BY $this->table_name . points DESC limit 0 , 10 ";
	}

	public function print_list(){
		$top = $this->select_list();
		$top_list = "<table class='top'><caption>Top 10</caption><tr><th>№</th><th>Nick</th><th>Points</th></tr>";
		$count_top = count($top)-1;
		for($x = 0; $x <= $count_top; $x++){
			$top_list .= "<tr><td>".($x+1)."</td><td>".$top[$x]['login']."</td><td>".$top[$x]['points']."</td></tr>";
		}

		$top_list .= "</table>";
		return $top_list;

	}


}