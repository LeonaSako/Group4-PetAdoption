if ($type == 'User') {

} else {
$registrationForm = new RegistrationForm();
$registrationForm->processForm("Agency");

$errors = $registrationForm->getErrors();
$emailError = isset($errors['email']) ? $errors['email'] : '';
$passError = isset($errors['password']) ? $errors['password'] : '';

$agency = isset($_POST['agency']) ? $_POST['agency'] : '';

$emailError = isset($errors['email']) ? $errors['email'] : '';
$passError = isset($errors['password']) ? $errors['password'] : '';
}