<?php
require_once "../utils/registrationForm.php";

$registrationForm = new RegistrationForm();
$registrationForm->processForm("Agency");

$errors = $registrationForm->getErrors();

$agency = isset($_POST['agency']) ? $_POST['agency'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$emailError = isset($errors['email']) ? $errors['email'] : '';
$passError = isset($errors['password']) ? $errors['password'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<div class="col-md-8">
    <label for="agency" class="form-label">Agency <span class='required'>*</span> </label>
    <input type="text" class="form-control" id="agency" name="agency" placeholder="Agency" required="" oninvalid="this.setCustomValidity('Please add the agency name')" oninput="setCustomValidity('')" value="<?= $agency ?>">
</div>
<div class="col-md-8">
    <label for="phone" class="form-label">Phone Number </label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?= $phone ?>">
</div>
<div class="col-md-8">
    <label for="address" class="form-label">Address </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $address ?>">
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