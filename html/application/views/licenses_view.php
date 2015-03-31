<?php

//display any form validation errors
echo validation_errors();

//using the form helper to help create the start of form code
echo form_open("licenses");

?>
<div class="container">

	<label for="firstName">First Name </label>
	<input type="text" name="firstName"> <br>

	<label for="lastName">Last Name </label>
	<input type="text" name="lastName"> <br>

	<label for="companyName">Company Name </label>
	<input type="text" name="companyName"> <br>

	<label for="address">Address </label>
	<input type="text" name="address"> <br>

	<label for="city">City </label>
	<input type="text" name="city"> <br>

	<label for="state">State </label>
	<input type="text" name="state"> <br>

	<label for="zip">Zip Code </label>
	<input type="text" name="zip"> <br>

	<label for="phone">Phone Number </label>
	<input type="text" name="phone"> <br>

	<label for="email">Email Address </label>
	<input type="text" name="email"> <br>

	<input type="submit" name="submit" value="Submit">
	
</form>
</div>

</html>