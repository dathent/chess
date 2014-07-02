<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');


if(empty($_SESSION['user'])){
    $_SESSION['alert'] = "<meta http-equiv='refresh' content='0;".URL."login/?login'>";
    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/html.inc');
   exit();
}

$user = new User();
$game = new Game();
$check = new Check();
$invitation = new Invitation_game();
$waiting_stroke = new Waiting_stroke($_SESSION['user']['id']);
$aside = $waiting_stroke->list;
$aside .= $invitation->list_answer($_SESSION['user']['id']);
$stroke = false;

if(isset($_POST['id_invitation'])){
	$invitation->send_invitation($_SESSION['user']['id'],$_POST['id_invitation'],$_POST['text_invite']);
}
elseif(isset($_POST['result'])){
    $invitation->save_answer($_POST['from_user'],$_POST['to_user'],$_POST['result']);
}


if(isset($_GET['my_game'])){
	$active_game = new Active_game($_SESSION['user']['id']);
	$finish_game = new Finish_game($_SESSION['user']['id']);
	$main = "<div class='game_table'><div class='active_table'>".$active_game->list."</div><div class='finish_table'>".$finish_game->list."</div></div>";
}

elseif(isset($_GET['game_id'])){
	$dbclass = new Database();
	$game_val = $dbclass->search_db('game',0,array('id'=>$_GET['game_id']));
	if(empty($game_val) or ($_SESSION['user']['id'] != $game_val['0']['author_user_id'] and $_SESSION['user']['id'] != $game_val['0']['partner_user_id'])){
		$_SESSION['alert'] = "<script>alert('Not your game !')</script>
										<meta http-equiv='refresh' content='0;".URL."'>";
	}
	else{
        if(isset($_POST['run'])){
            $check -> check_stroke($game_val,$_POST['chessman'],$_POST['new_position']);
	        $main = $waiting_stroke->print_list();
        }
		elseif(isset($_POST['new_chessman'])){
			$check -> check_stroke($game_val,$_POST['chessman'],$_POST['new_position'],$_POST['new_chessman']);
			$main = $waiting_stroke->print_list();
		}

        if($game_val['0']['status'] == 'active'){
	        $king_status = new King_status($_GET['game_id']);
	        $color_user = ( $king_status->game['0']['author_user_id'] ==  $_SESSION['user']['id'])? 'white' : 'black' ;
	        $style = $game->position_chessman($king_status->game);
            $history = $game->history_print($king_status->game);
	        $aside = $waiting_stroke->print_list();
            $aside .= $invitation->list_answer($_SESSION['user']['id']);
	        if($king_status->color == $color_user){
		        $alert = $king_status -> check();
		        $stroke = true ;
	        }else{
	          $_SESSION['alert'] = "<meta http-equiv='refresh' content='10'>";
                }
$main = $game -> desc;
	        $main .= "<p><a href=".URL."game/?game_id=".$_GET['game_id']." ><img src=".URL."game/img/refresh.png></a></p>";
        }
		else{
            $_SESSION['alert'] = "<script>alert('Not your game !')</script>
										<meta http-equiv='refresh' content='0;".URL."'>";
		}

    }

}
else{
	$style = $game->position_chessman();
	$main = $game -> desc;
	$invitation->form_invitation();
}


include_once($_SERVER['DOCUMENT_ROOT'].'/chess/game/html/game.inc');

