<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

    if(!isset($_SESSION['role']) or $_SESSION['role'] != 'admin'){
         $_SESSION['alert'] = "<meta http-equiv='refresh' content='0; ".URL."'>";
		         include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/html.inc');
		 exit();
    }
		$user = new User();
        $adminclass = new Admin();
        $option_user = $adminclass->output_user_list();
		
	if(isset($_POST['users'])){
		if($_POST['option'] == 'browse'){
			$main = $adminclass->browse('user',array('id','login', 'email', 'real_name',  'created', 'edited', 'points', 'status','role' ),$_POST['id'] );
		}
		elseif($_POST['option'] == 'edit'){
			$main = $adminclass->edit_form('user', array('login', 'email', 'real_name', 'status', 'role', 'id'), $_POST['id']);
		}
		elseif($_POST['option'] == 'delete'){
			$main = $adminclass->confirm_form($_POST['id'], 'delete');
		}
		elseif($_POST['option'] == 'blocked'){
			$main = $adminclass->confirm_form($_POST['id'], 'blocked');
		}
	}
	elseif(isset($_POST['edit_user'])){
		unset($_POST['edit_user']);
		$user->edit_user($_POST);
	}
	elseif(isset($_POST['blocked_user'])){
		$user->edit_user(array('id'=>$_POST['id'], 'status' => $_POST['status']));
	}
	elseif(isset($_POST['delete_user'])){
		$user->edit_user(array('id'=>$_POST['id'], 'status' => $_POST['status']));
	}
	elseif(isset($_GET['main_menu'])){
		include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/mainmenu.class.php');
		$menu = new MainMenu();
		$menu ->output_menu();
		include_once($_SERVER['DOCUMENT_ROOT'].'/chess/admin/html/main_menu_form_add.inc');
		if(isset($_POST['url'])){
			$menu->create_menu($_POST);
		}
	}
	elseif(isset($_GET['close_game_id'])){
		$game_class = new Game();
		$game_class->close_game($_GET['close_game_id']);
		$_SESSION['alert'] = "<meta http-equiv='refresh' content='0; ".URL."admin/?list_game'>";
	}

	
	if(isset($_GET['all_user'])){
		$main = $adminclass->browse('user',array('id','login', 'email', 'real_name',  'created', 'edited', 'points','status','role' ));
		include_once($_SERVER['DOCUMENT_ROOT'].'/chess/admin/html/admin.inc');
    }
	if(isset($_GET['list_game'])){
		$finish_game = new Finish_game_all();
		$active_game = new Active_game_all();
		$main = "<div class='game_table'><div class='active_table'>".$active_game->list."</div><div class='finish_table'>".$finish_game->list."</div></div>";
	}

        include_once($_SERVER['DOCUMENT_ROOT'].'/chess/admin/html/admin.inc');


