<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');



if(empty($_SESSION['user'])){
    $_SESSION['alert'] = "<meta http-equiv='refresh' content='0;".URL."login/?login'>";
    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/html.inc');
   exit();
}

$user = new User();
$invitation = new Invitation_game();
$waiting_stroke = new Waiting_stroke($_SESSION['user']['id']);
$aside = $waiting_stroke->list;
$aside .= $invitation->list_answer($_SESSION['user']['id']);

if(isset($_GET['my_account'])){
	include($_SERVER['DOCUMENT_ROOT']."/chess/user/html/user_info.inc");
}
elseif(isset($_GET['edit_user'])){
	if(isset($_POST['edit_user'])){
		if($_SESSION['user']['password'] == md5(trim(htmlentities($_POST['current_password'])))){
			$password = $_POST['current_password'];
			unset($_POST['current_password']);
			unset($_POST['edit_user']);
			if($_POST['password'] == $_POST['confirm_password']){
				if($_POST['password'] != null){
					unset($_POST['confirm_password']);
					$password = $_POST['password'];
				}
				$user->edit_user($_POST);
				$user->login_user(trim(htmlentities($_POST['login'])),md5(trim(htmlentities($password))));
			}
			else
				$_SESSION['alert'] = "<script>alert('Confirm password is not corect')</script>";
		}
		else
			$_SESSION['alert'] = "<script>alert('Current password is not corect')</script>";
	}
	include($_SERVER['DOCUMENT_ROOT']."/chess/user/html/user_edit.inc");
}
    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/user/html/user_account.inc');