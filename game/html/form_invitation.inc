<form method='POST' action='<?php print URL; ?>game/' class='user_form form_stroke'>
	<fieldset>
		<legend>Invitation user to game</legend>
		<p><select name='id_invitation' required>
				<?php print $_SESSION['options']['all_users'] ; ?>
			</select> Partner
			<input type='text' name='text_invite' value='Hi, let`s play'> Message
		</p>
		<p><input type='submit' value='Invitation'></p>
	</fieldset>
</form>