<form method="POST" action="<?php print URL.'game/?game_id='.$_GET['game_id']; ?>" class="user_form form_stroke">
	<fieldset>
		<legend>Pleas stroke</legend>
	<p>
		<select name="chessman" required>
			<?php print $_SESSION['options']['chessman'];?>
		</select>
	</p>
	<p>
		<select name="new_position" required>
			<?php print $_SESSION['options']['new_position'];?>
		</select>
	</p>
	<p>
		<input type="submit" value="Stroke" name="run">
	</p>
		</fieldset>
</form>
