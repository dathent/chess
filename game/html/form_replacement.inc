<form method="POST" action="<?php print URL.'game/?game_id='.$_GET['game_id']; ?>"   class="user_form form_stroke">
	<fieldset>
		<legend>Replacement chessman</legend>
	<p>
		<select name="new_chessman" required>
			<?php print $_SESSION['options']['new_chessman'];?>
		</select>
	</p>
	<input type="hidden" value="<?php print $_GET['chessman']; ?>" name="chessman">
	<input type="hidden" value="<?php print $_GET['new_position']; ?>" name="new_position">
	<p>
		<input type="submit" value="Replacement">
	</p>
		</fieldset>
</form>
