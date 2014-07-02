<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

$menu = "html/menu_null.inc";

$top = new Top_10();
$main = "<div class='top_list'>".$top->list."</div>";

if(isset($_SESSION['user'])){
	$menu = ($_SESSION['role'] == 'user')? "user/html/user_menu.inc": "admin/html/admin_menu.inc";
    $invitation = new Invitation_game();
    $waiting_stroke = new Waiting_stroke($_SESSION['user']['id']);
	$aside = $waiting_stroke->list;
    $aside .= $invitation->list_answer($_SESSION['user']['id']);
}

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/home.inc');




