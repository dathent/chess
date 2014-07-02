<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Game</title>
    <?php if(isset($_SESSION['alert'])){print $_SESSION['alert']; unset($_SESSION['alert']);} ?>
    <link rel= 'stylesheet' href='<?php print URL.'css/style.css'; ?>'>
    <link rel= 'stylesheet' href='<?php print URL.'game/css/desk_style.css'; ?>'>
    <?php if(isset($style)) print $style ?>
</head>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/header.inc'); ?>
<main>
    <nav>
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/user/html/user_menu.inc'); ?>
    </nav>
	<aside>
		<?php
		if(isset($aside)){
			print $aside;
		} ?>
	</aside>
    <?php
    if(isset($main)){
	    print $main;
    }
    if($stroke){
		if(empty($_GET['new_chessman'])){
	        include_once($_SERVER['DOCUMENT_ROOT'].'/chess/game/html/form_run.inc');
	    }
	    elseif(isset($_GET['new_chessman'])){
		    include_once($_SERVER['DOCUMENT_ROOT'].'/chess/game/html/form_replacement.inc');
	    }
	}
    elseif(empty($_GET)){
        include_once($_SERVER['DOCUMENT_ROOT'].'/chess/game/html/form_invitation.inc');
    }

    if(isset($history)){
        print $history;
    }
   if(isset($alert) and $alert != '1'){
        print $alert;
   }
    ?>

</main>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/footer.inc'); ?>
</body>
</html>