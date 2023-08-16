<?php

require_once __DIR__ . "/crud.php";
require_once __DIR__ . "/formUtils.php";
require_once __DIR__ . "/file_upload.php";

class RegistrationForm
{
    private $crud;
    private $errors = [];

    public function __construct()
    {
        $this->crud = new CRUD();
    }

    private function validateName($name)
    {
        return preg_match('/^[a-zA-ZäöüÄÖÜß\s]+$/', $name);
    }

    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password)
    {
        if (!(strlen($password) >= 6)) {
            return $this->addError('password', "Password must have at least 6 characters.");
        }
    }

    private function addError($field, $message)
    {
        $this->errors[$field] = $message;
    }
    private function cleanInputs($input)
    {
        $data = trim($input);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return  $data;
    }

    public function processForm($accountType)
    {
        if (isset($_POST["sign-up"])) {

            if ($accountType == 'User') {
                $fname = $this->cleanInputs($_POST["fname"]);
                $lname = $this->cleanInputs($_POST["lname"]);
                $birthdate = $this->cleanInputs($_POST["birthdate"]);
                $picture = fileUpload($_FILES["picture"], 'user');

                if (strlen($fname) < 3) {
                    $this->addError('fname', "First Name must have at least 3 characters.");
                } elseif (!$this->validateName($fname)) {
                    $this->addError('fname', "First Name must contain only letters and spaces.");
                }

                if (strlen($lname) < 3) {
                    $this->addError('lname', "Last Name must have at least 3 characters.");
                } elseif (!$this->validateName($lname)) {
                    $this->addError('lname', "Last Name must contain only letters and spaces.");
                }
            } else {
                $agency = $this->cleanInputs($_POST["agency"]);
            }

            $phone = $this->cleanInputs($_POST["phone"]);
            $address = $this->cleanInputs($_POST["address"]);

            $email = $this->cleanInputs($_POST["email"]);
            $password = $_POST["password"];

            if (!$this->validateEmail($email)) {
                $this->addError('email', "Please enter a valid email address");
            } else {
                $result = $this->crud->selectUsers("email='$email'");
                if (!empty($result)) {
                    $this->addError('email', "Provided Email is already in use");
                }
            }

            $this->validatePassword($password);

            if (empty($this->errors)) {
                $password = hash("sha256", $password);

                if ($accountType == 'User') {

                    $values = ['User', $fname, $lname, $email, $phone, $address, $picture[0], $birthdate, $password];

                    $this->crud->createUser($values);
                } else {
                    $values = ['Agency', $agency, $address, $email, $phone, $password];

                    $this->crud->createAgency($values);
                }
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
