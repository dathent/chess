<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');


class Check{


	function check_stroke($game_val, $chessman, $new_position, $new_chessman = null){
		$game_id = $game_val['0']['id'];
		$gameclass = new Game();
        $king_status = new King_status($game_val,$new_position,$chessman);
        $king_status_check = $king_status->check(1);
        if($king_status_check){
            if($new_chessman == null){
                $nameClass = ucfirst(strstr($chessman,'-',true));
                $chessman_obj = new $nameClass($game_val,$new_position,$chessman);
                $check = $chessman_obj->check_run();
                if(is_bool($check) and $check){
                    $gameclass->save_desk($game_val, $game_id, $chessman, $new_position, $new_chessman);
                }
                elseif(is_string($check)){
                    $_SESSION['options']['new_chessman'] = $check;
                    $_SESSION['alert'] = "<meta http-equiv='refresh' content='0;".URL."game/?game_id=".$_GET['game_id']."&amp;new_position=".$_POST['new_position']."&amp;chessman=".$_POST['chessman']."&amp;new_chessman=1'>";
                }
                elseif(is_array($check)){
                    $gameclass->save_desk($game_val, $game_id, $chessman, $new_position, $new_chessman, $check);
                }
                else
                    $_SESSION['alert'] = "<script>alert('Not correct stroke !')</script>";
            }
            else
                $gameclass->save_desk($game_val, $game_id, $chessman, $new_position, $new_chessman);
        }
        else
            $_SESSION['alert'] = "<script>alert('Your king is under attack !')</script>";
	}
}