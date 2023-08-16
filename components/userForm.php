<?php
require_once "../utils/registrationForm.php";

$registrationForm = new RegistrationForm();
$registrationForm->processForm("User");

$errors = $registrationForm->getErrors();

$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$fnameError = isset($errors['fname']) ? $errors['fname'] : '';
$lnameError = isset($errors['lname']) ? $errors['lname'] : '';
$emailError = isset($errors['email']) ? $errors['email'] : '';
$passError = isset($errors['password']) ? $errors['password'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<div class="row g-2">
    <div class="col-md-4">
        <label for="fname" class="form-label">First Name <span class='required'>*</span> </label>
        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" required="" oninvalid="this.setCustomValidity('Please, enter your first name')" oninput="setCustomValidity('')" value="<?= $fname ?>">
        <span class="text-danger"><?= $fnameError ?></span>
    </div>
    <div class="col-md-4">
        <label for="lname" class="form-label">Last Name <span class='required'>*</span></label>
        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" required="" oninvalid="this.setCustomValidity('Please, enter your last name')" oninput="setCustomValidity('')" value="<?= $lname ?>">
        <span class="text-danger"><?= $lnameError ?></span>
    </div>
</div>
<div class="col-md-8">
    <label for="birthdate" class="form-label">Date of birth <span class='required'>*</span></label>
    <input type="date" class="form-control" id="birthdate" name="birthdate" required="" oninvalid="this.setCustomValidity('Please, add your birthdate')" oninput="setCustomValidity('')" value="<?= $birthdate ?>">
</div>
<div class="col-md-8">
    <label for="picture" class="form-label">Profile picture </label>
    <input type="file" class="form-control" id="picture" name="picture">
</div>
<div class="col-md-8">
    <label for="phone" class="form-label">Phone Number </label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?= $phone ?>">
</div>
<div class="col-md-8">
    <label for="address" class="form-label">Address </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
</div>
<div class="col-md-8">
    <label for="email" class="form-label">Email address <span class='required'>*</span></label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required="" oninvalid="this.setCustomValidity('Please, add your email')" oninput="setCustomValidity('')" value="<?= $email ?>">
    <span class="text-danger"><?= $emailError ?></span>
</div>
<div class="col-md-8">
    <label for="password" class="form-label">Password <span class='required'>*</span></label>
    <input type="password" class="form-control" id="password" name="password" required="" oninvalid="this.setCustomValidity('Please, add a password')" oninput="setCustomValidity('')" placeholder="Password">
    <span class="text-danger"><?= $passError ?></span>
</div>

</html>