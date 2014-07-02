<?php $main = "<form method='POST' action='".URL."user/?edit_user' class='user_form'>
	<fieldset>
	<legend>Edit account</legend>
<table>
	<tr><td>My name:</td><td><input type='text' name='real_name' value='".$_SESSION['user']['real_name']."' class='input_form_user' required></td></tr>
	<tr><td>My login:</td><td><input type='text' name='login' value='".$_SESSION['user']['login']."' class='input_form_user'></td></tr>
	<tr><td>My e-mail:</td><td><input type='email' name='email' value='".$_SESSION['user']['email']."' class='input_form_user' required></td></tr>
	<tr><td>New password:</td><td><input type='password' name='password' class='input_form_user'></td></tr>
	<tr><td>Confirm new password:</td><td><input type='password' name='confirm_password' class='input_form_user'></td></tr>
	<tr><td>Current password:</td><td><input type='password' name='current_password' class='input_form_user' required></td></tr>
</table>
<input type='hidden' name='id' value='".$_SESSION['user']['id']."' class='input_form_user'>
<input type='submit' class='buttom_user submit' value='Save' name='edit_user'>
</fieledset>
</form>"; ?>