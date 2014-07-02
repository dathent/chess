<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Register acount</title>
		<?php if(isset($_SESSION['alert'])){print $_SESSION['alert']; unset($_SESSION['alert']);} ?>
            <link rel= 'stylesheet' href='<?php print URL.'css/style.css'; ?>'>
        </head>
        <body>
            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/header.inc'); ?>
        <main>
                <nav>
                </nav>
            <form method='POST' action='<?php print URL."login/?register=0"; ?>' class='user_form'>
				<fieldset>
						<legend>Register</legend>
					<p><input type='text' name='real_name' required class='input_form_user'> Enter Real name</p>
					<p><input type='email' name='email' required class='input_form_user'> Enter e-mail</p>
					<p><input type='text' name='login' required class='input_form_user'> Enter login</p>
					<p><input type='password' name='password' required class='input_form_user'> Entert password</p>
					<p><input type='password' name='pass1' required class='input_form_user'> Re entert password</p>
					<p><input type='submit' value='Register' class='buttom_user submit'></p>
				</fieldset>
            </form>
        </main>
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/footer.inc'); ?>
	</body>
</html>