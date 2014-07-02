<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Chessman_obj implements Chessman{

    public $color;
    public $current_position;
    public $new_position_chessman;
	public $description;
	public $new_position;
	public $chessman;
    public $difference_num;
    public $difference_letters;
    public $table_state;
    public $game;

    public function check_run()
    {
        exit('release this function !!!!');
    }

    public function __construct($game, $new_position = null, $chessman = null){
	    $this->game = (is_array($game))? $game: $this->load_game($game);
	    $this->new_position = ($new_position == null)? null : $new_position;
	    $this->chessman = ($chessman == null)? null : $chessman ;
	    $this->color = $this->game['0']['next_go'];
	    $this->table_state = unserialize($this->game['0']['table_state']);
	    $this->current_position = ($chessman == null)? null : $this->table_state[$this->chessman];
	    $this->new_position_chessman = ($new_position == null)? null : array_search($this->new_position,$this->table_state);
	    $this->difference_num = ($new_position == null)? null : abs(substr($this->current_position,1,1)-substr($this->new_position,1,1));
	    $this->difference_letters = ($new_position == null)? null : abs(ord(substr($this->current_position,0,1))-ord(substr($this->new_position,0,1)));
	    $this->description = unserialize($this->game['0']['description']);
    }

	private function load_game($id){
		$dbclass = Database::dbase();
		$game = $dbclass->search_db('game',0,array('id'=>$id));
		return $game;
	}
}