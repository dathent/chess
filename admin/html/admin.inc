<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Admin</title>
    <?php if(isset($_SESSION['alert'])){print $_SESSION['alert']; unset($_SESSION['alert']);} ?>
    <link rel= 'stylesheet' href='<?php print URL.'css/style.css'; ?>'>
</head>
<body>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/header.inc'); ?>
<main>
    <nav>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/admin/html/admin_menu.inc'); ?>
    </nav>
	    <form method='POST' action='<?php print URL.'admin/'; ?>' class='form_admin'>
		<fieldset>
			<legend>Select user</legend>
				<select name='id[]' multiple required>
					<?php print $option_user;?>
				</select>
				<div>
					<label><input type='radio' name='option' value='browse'>Browse</label>
					<label><input type='radio' name='option' value='edit'>Edit</label><br>
					<label><input type='radio' name='option' value='blocked'>Blocked</label>
					<label><input type='radio' name='option' value='delete' required>Delete</label>
				</div>
			<input type='submit' value='Action' name='users'>
		</fieldset>
	</form>
    <?php if(isset($main)) print $main ?>
</main>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/footer.inc'); ?>
</body>
</html>