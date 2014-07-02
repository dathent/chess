<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Invitation_game extends Admin {

	private $table_name = 'invite';

	public function form_invitation(){

		$_SESSION['options']['all_users'] = $this->output_user_list();

	}

	public function save_answer($from_user, $to_user, $result){
		$dbclass = Database::dbase();
		if($result == 'accept'){
			$game = new Game();
			$id_game = $game ->new_game($to_user, $from_user);
		}else{
			if($result == 'ignore'){
				$dbclass->write_table('ignore',array('my'=>$from_user, 'ignore_user_id'=>$to_user));
			}
			$id_game = null;
		}
		$set = array('result'=>$result,'game_id'=>$id_game);
		$where = array('from_user_id'=>$to_user, 'to_user_id' => $from_user);

		$dbclass->ubdate_table($this->table_name, $set, $where, ' and ');
	}

	public function list_answer($id){
		$list_array = $this->render($this->table_name,array('from_user_id','text'), array('to_user_id'=>$id, 'result'=>'progress'), ' and ');
        $ignore_array = $this->render('ignore', array('ignore_user_id'),array('me'=>$id));
		if(!empty($ignore_array)){
			$ignore_list = array();
			foreach($ignore_array as $key => $id_user){
				$ignore_list[] = $id_user[$key]['ignore_user_id'];
			}
		}

		$count_list = count($list_array)-1;
		$waiting_list = "<table class='top'><caption>Waiting my answer</caption><tr><th>Partner</th><th>Message</th><th>Answer</th></tr>";
		$options = "<option value='accept'>Accept</option><option value='reject'>Reject</option><option value='ignore'>Ignore user</option>";
		for($x = 0; $x <= $count_list; $x++){
			$to_user = $list_array[$x]['from_user_id'];
			if(isset($ignore_list) and in_array($to_user,$ignore_list)){
				continue;
			}
			$partner = $this->render('user', array('login'), array('id'=> $to_user));
            $partner = $partner['0']['login'];
			$waiting_list .= "<tr><td>".$partner."</td>
							<td>".$list_array[$x]['text']."</td>
							<td><form method='POST' action='".URL."game/'>
							<select name='result' request>".$options."</select>
							<input type='hidden' name='from_user' value='".$id."'>
							<input type='hidden' name='to_user' value='".$to_user."'>
							<input type='submit' value='Answer'>
							</form></td></tr>";
		}

		$waiting_list .= "</table>";
		return $waiting_list;
	}

	public function send_invitation($from_user, $to_user, $text){
		$value = array(
			'from_user_id' => $from_user,
			'to_user_id' => $to_user,
			'text' => $text
		);
		$dbclass = Database::dbase();
		$dbclass->write_table($this->table_name,$value);
	}

}