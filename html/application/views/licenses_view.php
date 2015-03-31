
<div class="container">
    <h3 class="text-center">Please provide us with your information to update your company's license.</h3>
    <?php
    //display any form validation errors
    echo validation_errors();

    //using the form helper to help create the start of form code
    echo form_open("licenses");
    ?>
    
    <label for="firstName">First Name </label>
    <input type="text" name="firstName" class="form-control"> <br>

    <label for="lastName">Last Name </label>
    <input type="text" name="lastName" class="form-control"> <br>

    <label for="companyName">Company Name </label>
    <input type="text" name="companyName" class="form-control"> <br>

    <label for="address">Address </label>
    <input type="text" name="address" class="form-control"> <br>

    <label for="city">City </label>
    <input type="text" name="city" class="form-control"> <br>

    <label for="state">State </label>
    <input type="text" name="state" class="form-control"> <br>

    <label for="zip">Zip Code </label>
    <input type="text" name="zip" class="form-control"> <br>

    <label for="phone">Phone Number </label>
    <input type="text" name="phone" class="form-control"> <br>

    <label for="email">Email Address </label>
    <input type="text" name="email" class="form-control"> <br>

    <input type="submit" name="submit" value="Submit" class="btn btn-default"> <br>

    <?php form_close(); ?>
</div>