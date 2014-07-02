<?php $main = "<div class='user_form'>
	<fieldset>
<table>
	<legend>My account</legend>
	<tr><td>My name:</td><td><input type='text' value='".$_SESSION['user']['real_name']."' class='input_form_user' disabled></td></tr>
	<tr><td>My login:</td><td><input type='text' value='".$_SESSION['user']['login']."' class='input_form_user' disabled></td></tr>
	<tr><td>My e-mail:</td><td><input type='text' value='".$_SESSION['user']['email']."' class='input_form_user' disabled></td></tr>
	<tr><td>My points:</td><td><input type='text' value='".$_SESSION['user']['points']."' class='input_form_user' disabled></td></tr>
	<tr><td>Date register:</td><td><input type='text' value='".$_SESSION['user']['created']."' class='input_form_user' disabled></td></tr>
</table>

<a href='".URL."user/?edit_user' class='buttom_user' >Edit</a>

</fieledset>
</div>"; ?>