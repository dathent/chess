<!doctype html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>CHESS</title>
			<?php
			 if(isset($_SESSION['alert'])){print $_SESSION['alert']; unset($_SESSION['alert']);}
			?>
            <link rel= 'stylesheet' href='<?php print URL.'css/style.css'; ?>'>
        </head>
        <body>
            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/header.inc'); ?>
            <main>
                    <nav>
                    </nav>
                <form action='<?php print URL."login/"; ?>' method='POST' class='user_form'>
					<fieldset>
						<legend>Recovery password</legend>
						<p><input type='text' name='login' required class='input_form_user'> User name</p>
						<p><input type='text' name='email' required class='input_form_user'> E-mail</p>
						<input type='submit' value='Recovery' name='recovery' class='buttom_user submit'>
					</fieldset>
                </form>
			</main>
			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/footer.inc'); ?>
		</body>
	</html>