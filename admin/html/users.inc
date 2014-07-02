    <form method='POST' action='<?php print URL.'admin/'; ?>' class='form_admin'>
		<fieldset>
			<legend>Select user</legend>
				<select name='id[]' multiple required class='select'>
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