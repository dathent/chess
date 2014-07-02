<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Account</title>
		<?php if(isset($_SESSION['alert'])){print $_SESSION['alert']; unset($_SESSION['alert']);} ?>
        <link rel= 'stylesheet' href='<?php print URL.'css/style.css'; ?>'>
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
			<?php if(isset($main)) print $main ?>
		</main>
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/footer.inc'); ?>
	</body>
</html>