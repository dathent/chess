<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

$userclass = new User();


	if(isset($_POST['sign'])){
		$userclass->login_user(trim(htmlentities($_POST['login'])),md5(trim(htmlentities($_POST['password']))));
	}
    elseif(isset($_POST['recovery'])){
        $userclass->recovery_pass(trim(htmlentities($_POST['email'])),trim(htmlentities($_POST['login'])));
    }
	elseif(isset($_GET['logout'])){
		$userclass->logout_user();
	}
	elseif(isset($_GET['register']) and isset($_POST['real_name'])){
		if($_POST['password'] != $_POST['pass1'])
            $_SESSION['alert'] = "<script>alert('Rewrite password !')</script>";
		else{
            $userclass -> create_user($_POST);
		}
	}
	elseif(isset($_GET['confirm']) and $_GET['confirm'] != '0' and empty($_SESSION['alert'])){
		$userclass->activate(trim(htmlentities($_GET['email'])),'',trim(htmlentities($_GET['confirm'])));
	}
    elseif(isset($_SESSION['user'])){
        $_SESSION['alert'] = "<meta http-equiv='refresh' content='0;".URL."'>";
    }

    if(isset($_GET['recovery']))
        include_once($_SERVER['DOCUMENT_ROOT'].'/chess/login/html/recovery_pass.inc');
		
	elseif(isset($_GET['register']))
        include_once($_SERVER['DOCUMENT_ROOT'].'/chess/login/html/register.inc');
	
	elseif(isset($_GET['confirm']))
		include_once($_SERVER['DOCUMENT_ROOT'].'/chess/login/html/confirm.inc');
	
	elseif(isset($_GET['login']))
	    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/login/html/login.inc');
    else{
	    $_SESSION['alert'] = "<meta http-equiv='refresh' content='0; ".URL."'>";
	    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/html.inc');
    }
