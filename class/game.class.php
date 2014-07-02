<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Game{
    
	private $table_name = 'game';
	
	private $position_start = array(
		'rook-w_l' => 'a1',
		'knight-w_l' => 'b1',
		'bishop-w_l' => 'c1',
		'queen-w_1' => 'd1',
		'king-w_1' => 'e1',
		'bishop-w_r' => 'f1',
		'knight-w_r' => 'g1',
		'rook-w_r' => 'h1',
		
		'pawn-w_1' => 'a2',
		'pawn-w_2' => 'b2',
		'pawn-w_3' => 'c2',
		'pawn-w_4' => 'd2',
		'pawn-w_5' => 'e2',
		'pawn-w_6' => 'f2',
		'pawn-w_7' => 'g2',
		'pawn-w_8' => 'h2',
		
		'rook-b_l' => 'a8',
		'knight-b_l' => 'b8',
		'bishop-b_l' => 'c8',
		'queen-b_1' => 'd8',
		'king-b_1' => 'e8',
		'bishop-b_r' => 'f8',
		'knight-b_r' => 'g8',
		'rook-b_r' => 'h8',
		
		'pawn-b_1' => 'a7',
		'pawn-b_2' => 'b7',
		'pawn-b_3' => 'c7',
		'pawn-b_4' => 'd7',
		'pawn-b_5' => 'e7',
		'pawn-b_6' => 'f7',
		'pawn-b_7' => 'g7',
		'pawn-b_8' => 'h7');

	public $desc = "<div class='desk_game'>
						<table class='desk'>
							<tr><th></th><th class='marking_desk'>a</th><th class='marking_desk'>b</th><th class='marking_desk'>c</th><th class='marking_desk'>d</th><th class='marking_desk'>e</th><th class='marking_desk'>f</th><th class='marking_desk'>g</th><th class='marking_desk'>h</th></tr>
							<tr><th class='marking_desk'>8</th><td class='color_white'><div class='a8  cell_desk'></div></td><td class='color_black'><div class='b8  cell_desk'></div></td><td class='color_white'><div class='c8  cell_desk'></div></td><td class='color_black'><div class='d8  cell_desk'></div></td><td class='color_white'><div class='e8  cell_desk'></div></td><td class='color_black'><div class='f8  cell_desk'></div></td><td class='color_white'><div class='g8  cell_desk'></div></td><td class='color_black'><div class='h8  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>7</th><td class='color_black'><div class='a7  cell_desk'></div></td><td class='color_white'><div class='b7  cell_desk'></div></td><td class='color_black'><div class='c7  cell_desk'></div></td><td class='color_white'><div class='d7  cell_desk'></div></td><td class='color_black'><div class='e7  cell_desk'></div></td><td class='color_white'><div class='f7  cell_desk'></div></td><td class='color_black'><div class='g7  cell_desk'></div></td><td class='color_white'><div class='h7  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>6</th><td class='color_white'><div class='a6  cell_desk'></div></td><td class='color_black'><div class='b6  cell_desk'></div></td><td class='color_white'><div class='c6  cell_desk'></div></td><td class='color_black'><div class='d6  cell_desk'></div></td><td class='color_white'><div class='e6  cell_desk'></div></td><td class='color_black'><div class='f6  cell_desk'></div></td><td class='color_white'><div class='g6  cell_desk'></div></td><td class='color_black'><div class='h6  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>5</th><td class='color_black'><div class='a5  cell_desk'></div></td><td class='color_white'><div class='b5  cell_desk'></div></td><td class='color_black'><div class='c5  cell_desk'></div></td><td class='color_white'><div class='d5  cell_desk'></div></td><td class='color_black'><div class='e5  cell_desk'></div></td><td class='color_white'><div class='f5  cell_desk'></div></td><td class='color_black'><div class='g5  cell_desk'></div></td><td class='color_white'><div class='h5  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>4</th><td class='color_white'><div class='a4  cell_desk'></div></td><td class='color_black'><div class='b4  cell_desk'></div></td><td class='color_white'><div class='c4  cell_desk'></div></td><td class='color_black'><div class='d4  cell_desk'></div></td><td class='color_white'><div class='e4  cell_desk'></div></td><td class='color_black'><div class='f4  cell_desk'></div></td><td class='color_white'><div class='g4  cell_desk'></div></td><td class='color_black'><div class='h4  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>3</th><td class='color_black'><div class='a3  cell_desk'></div></td><td class='color_white'><div class='b3  cell_desk'></div></td><td class='color_black'><div class='c3  cell_desk'></div></td><td class='color_white'><div class='d3  cell_desk'></div></td><td class='color_black'><div class='e3  cell_desk'></div></td><td class='color_white'><div class='f3  cell_desk'></div></td><td class='color_black'><div class='g3  cell_desk'></div></td><td class='color_white'><div class='h3  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>2</th><td class='color_white'><div class='a2  cell_desk'></div></td><td class='color_black'><div class='b2  cell_desk'></div></td><td class='color_white'><div class='c2  cell_desk'></div></td><td class='color_black'><div class='d2  cell_desk'></div></td><td class='color_white'><div class='e2  cell_desk'></div></td><td class='color_black'><div class='f2  cell_desk'></div></td><td class='color_white'><div class='g2  cell_desk'></div></td><td class='color_black'><div class='h2  cell_desk'></div></td></tr>
							<tr><th class='marking_desk'>1</th><td class='color_black'><div class='a1  cell_desk'></div></td><td class='color_white'><div class='b1  cell_desk'></div></td><td class='color_black'><div class='c1  cell_desk'></div></td><td class='color_white'><div class='d1  cell_desk'></div></td><td class='color_black'><div class='e1  cell_desk'></div></td><td class='color_white'><div class='f1  cell_desk'></div></td><td class='color_black'><div class='g1  cell_desk'></div></td><td class='color_white'><div class='h1  cell_desk'></div></td></tr>
						</table>
					</div>";

	function desc_print(){
		$main = "<div class='desk_game'><table class='desk'>";
		$th = null;
            for($y= 9; $y >=1;$y--) {
                $main .= "<tr>";
				$main .= ($y != 9 )? "<th class='marking_desk'>$y</th>": "<th></th>";
                for($x = 1, $b = 'a'; $x <= 8;$x++,$b++){
					if($th == null){
						$main .= "<th class='marking_desk'>$b</th>";
						if($x == 8) $th = $x;
					}
                    else{
						$color = ((($y+$x)%2) == 0)?"color_black":"color_white";
						$main .= "<td class='$color'><div class='$b$y  cell_desk'></div></td>";
					}
				}
                $main .= "</tr>";

            }
		$main .= "</table></div>";
		return $main;
	}
	
	function new_game($author_user_id, $partner_user_id){
		$param = array(
            'author_user_id'=>$author_user_id,
            'partner_user_id'=>$partner_user_id,
            'table_state'=>serialize($this->position_start),
            'created'=>'NOW()',
            'status'=>'active',
            'next_go'=>'white',
            'author_color'=>'white',
			'description' =>null);
        $dbclass = Database::dbase();
		$id = $dbclass->write_table($this->table_name,$param);
		$chessgame = $dbclass->search_db($this->table_name,0,array('id'=>$id));
		$chessgame['description'] = serialize(array(
			0 => array('start_time'=>time(),
				'user_id'=> $author_user_id,
				'color' => 'white'
			),
		));
		$dbclass->ubdate_table($this->table_name,array('description'=>$chessgame['description']),array('id'=>$id));
		$_SESSION['alert']=  "<meta http-equiv='refresh' content='0; ".URL."game/?game_id=".$id."'>";
		return $id;
	}

    function save_desk($game_val, $game_id, $chessman, $new_position, $new_chessman, $table = null){
	    $next_go = ($game_val['0']['next_go'] == 'white')? 'black': 'white';
	    $description = unserialize($game_val['0']['description']);
	    $table_state =  unserialize($game_val['0']['table_state']);
	    if($table == null){
		    $key = array_search($new_position, $table_state);
		    if(!is_bool($key)) $table_state[$key] = null;
		    if($new_chessman == null)
		        $new_chessman = $chessman;
	        else{
		        $cord = $table_state[$chessman];
                unset($table_state[$chessman]);
            }

		    $description[count($description)-1]['finish_time'] = time();
		    $description[count($description)-1]['chessman'] = $new_chessman;
		    $description[count($description)-1]['start_position'] = ($new_chessman != $chessman)? $cord : $table_state[$new_chessman] ;
		    $description[count($description)-1]['finish_position'] = $new_position;

		    $table_state[$new_chessman] = $new_position;
	    }
        else{
	        $description[count($description)-1]['finish_time'] = time();
	        $description[count($description)-1]['castling'] = $chessman;
	        $description[count($description)-1]['start_position'] = $table_state[$chessman];
	        $description[count($description)-1]['finish_position'] = $table[$chessman];
        }
	    $description[count($description)] = array();
	    $description[count($description)-1]['start_time'] = time();
	    $description[count($description)-1]['color'] = $next_go;
	    $description[count($description)-1]['user_id'] = ($next_go == 'white')? $game_val['0']['author_user_id']: $game_val['0']['partner_user_id'] ;
	    $table_state = ($table == null)? $table_state: $table;
        $set = array('table_state'=>serialize($table_state), 'next_go'=>$next_go, 'description'=>serialize($description));
	    $dbclass = Database::dbase();
	    $dbclass->ubdate_table($this->table_name, $set, array('id'=>$game_id));
    }

	function end_game($game_val, $game_id, $loser, $result){
		$dbclass = Database::dbase();
		$description = unserialize($game_val['0']['description']);
		$description['finish']['result'] = $result;
		$description['finish']['finish_time'] = time();
		if($result == 'pat'){
			$description['finish']['loser'] = '0';
		}
		else{
			$description['finish']['loser'] = $game_val['0']['next_go'];
			$winner_id = ($game_val['0']['next_go'] != 'white')? $game_val['0']['author_user_id'] : $game_val['0']['partner_user_id'] ;
			$winner_point = $dbclass->search_db('user', array('points'), array('id'=>$winner_id));
			$winner_point = $winner_point['0']['points']+10;
			$dbclass->ubdate_table('user', array('points'=>$winner_point), array('id'=>$winner_id));
		}
		$id_loser = ($loser == 'white')? $game_val['0']['author_user_id']: $game_val['0']['partner_user_id'];
		$set = array('result'=>serialize(array($result=>$id_loser)),'status'=>'finish','description'=>serialize($description));
		$dbclass->ubdate_table($this->table_name, $set, array('id'=>$game_id));
	}

	function position_chessman($game_val = 0){
		if($game_val != 0){
			$table_state =  unserialize($game_val['0']['table_state']);
			$this->option_run($table_state,$game_val['0']['next_go']);
		}
		else
			$table_state = $this->position_start;
        $style = "<style>";
		foreach($table_state as $key=>$value){
			if($value !=null){
				$style .= ".$value{ background: url('".URL."game/img/".strstr($key,'_',true).".png') no-repeat;}
				           .$value:after{ content: '$key'; font-size: .6em; position: relative; left: 1px; top: 33px; font-weight: 700; color: red;} ";
			}
		}
		$style .= "</style>";
		return $style;
	}

	function option_run($table_state, $next_go){
		$go_color = ($next_go == 'white')? 'w' : 'b';
		$_SESSION['options']['chessman'] ="<option value='' disabled >Select chessman</option>";
		$_SESSION['options']['new_position'] = "<option value='' disabled >Select new position</option>";
		foreach($table_state as $key => $value){
			$chessman = substr(strstr($key,'-'),'1','1');
			if($go_color == $chessman and $value != null){
				$_SESSION['options']['chessman'] .= "<option value='$key'>".$key."</option>";
			}
		}
		for($x = 1, $b = 'a'; $x <= 8;$x++,$b++) {
			for($y= 1; $y <=8;$y++){
				if(!in_array($b.$y,$table_state) or $go_color != substr(strstr(array_search($b.$y,$table_state),'-'),'1','1') or strstr(array_search($b.$y,$table_state),'-',true) == 'rook'){
					if($go_color == substr(strstr(array_search($b.$y,$table_state),'-'),'1','1') and ($b == 'h' or $b == 'a')){
						$_SESSION['options']['new_position'] .= "<option value='".$b.$y."'>Castling ".$b.$y."</option>";
					}
					else
						$_SESSION['options']['new_position'] .= "<option value='".$b.$y."'>".$b.$y."</option>";
				}
			}
		}
	}

    function history_print($game_val){
        $dbclass = Database::dbase();
        if(!is_array($game_val)){
	        $game_val = $dbclass->search_db($this->table_name,0,array('id'=>$game_val));
        }
	    $history_array = unserialize($game_val['0']['description']);
        $history = "<div class='history_game'><table><caption>History game</caption>
                    <tr><td colspan = '3'>Start time:</td></tr><tr><td colspan = '3'>".$game_val['0']['created']."</td></tr>";
        $x = 1;
	    if(is_array($history_array)){
            foreach($history_array as  $value){
                    if(empty($value['start_position'])){
                        continue;
                    }
                    $user_id = $value['user_id'];
                    $user = $dbclass->search_db('user',array('login'),array('id'=>$user_id));
                    $user = $user['0']['login'];
                    $history .= "<tr><td>$x</td><td>$user</td><td>".$value['start_position']." - ".$value['finish_position']."</td></tr>";
                    $x++;
            }
        }
	    if(isset($history_array['finish'])){
		    $result_val = unserialize($game_val['0']['result']);
		    if(isset($result_val['pat'])){
			    $result = 'Draw';
			    $loser = null;
		    }
		    else{
			    $result = 'Loser - ';
			    $loser = $dbclass->search_db('user',array('login'),array('id'=>$result_val['mat']));
                $loser = $loser['0']['login'];
		    }
		    $history .= "<tr><td colspan = '3'>Finish time:</td></tr><tr><td colspan = '3'>".$game_val['0']['edited']."</td></tr>
		            <tr><td>Result:</td></tr><tr><td colspan = '3'>$result $loser</td></tr>";
	    }
        $history .= "</table></div>";
        return $history;
    }

	public function close_game($id_game){
		$dbclass = Database::dbase();
		$dbclass->ubdate_table($this->table_name, array('status'=>'close'),array('id'=>$id_game));
	}
}