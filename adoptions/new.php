<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/formUtils.php";

$petID = $_GET["id"];
$userID = $_SESSION["User"];
$crud = new CRUD_PET();
$crudUser = new CRUD_USER();
$crudAdoption = new CRUD_ADOPTION();

$result1 = $crud->selectPets("id = $petID");
$result2 = $crudUser->selectUsers("id = $userID");

$pets = $result1[0];
$users = $result2[0];
//convert Birthday
function calculateAge($birthdate)
{
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $ageInterval = $currentDate->diff($birthDate);
    return $ageInterval->y;
}

// Adoption Part
if (isset($_POST['adoption-submit'])) {
    $submitionDate = date("Y/m/d");
    $adoptionDate = $_POST['adoptionDate'];
    $donation = $_POST['donation'];
    $reason = $_POST['reason'];
    $values = [$petID, $userID, $submitionDate, $donation, $reason, $adoptionDate];
    $crudAdoption->createAdoption($values);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <?php
    foreach ($users as $user) {
        $image = "../images/user/{$users['image']}";
        $firstName = $users["firstName"];
        $lastName = $users["lastName"];
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $image ?>" class="card-img-top" alt="User Image">
                    <div class="card-body">
                        <h3 class='card-title'><?php echo ($firstName); ?></h3>
                        <br>
                        <p class="card-text"><?php echo ($lastName); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
            <?php
            foreach ($pets as $pet) {
                $image = "../images/pets/{$pets['image']}";
                $name = $pets["name"];
                $location = $pets["location"];
                $age = $pets["age"];
            }
            ?>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $image ?>" id="details-img" class='img-fluid shadow mb-5' alt="Pet image" width="400px">
                    <div class="card-body">
                        <p class='card-title'>Name:<?php echo ($name); ?></p>
                        <br>
                        <p class="card-text">Location:<?php echo ($location); ?></p>
                        <br>
                        <p class="card-text">Age:<?php echo ($age); ?> years old</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    </div>
    <form method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="container">
            <div class="d-grid gap-2 d-md-flex justify-content-start">
                <button type="submit" name='submit' class="btn btn-primary">Check condition</button>
                <a href="../admin/dashboard.php" class="btn btn-warning">Back to dashboard</a>
            </div>
        </div>
    </form>
    <br><br>
    <?php

    if (isset($_POST['submit'])) {
        $birthdate = $users['birthdate'];
        $age = calculateAge($birthdate);
        $spacepet = $pets['minSpace'];
        $spaceuser = $users['space'];
        $petexperience = $pets['experienceNeeded'];
        $userexperience = $users['experienced'];

        if ($age < 18) {
            echo "You are younger than 18";
        } elseif (!$userexperience == $petexperience && $userexperience == 0) {
            echo "You need more exprerince";
        } elseif ($spaceuser < $spacepet) {
            echo "Unfortunetly you need more space";
        } else {
            echo "You can apply for the Adoption
                        <div class='container'>
                            <div class='row'>
                                <h1>Please fill in the blanks</h1>
                                <div class='col-2'></div>
                                <div class='col-8'>
                                    <form method='post' autocomplete='off' enctype='multipart/form-data'>
                                        <div class='mb-3'>
                                            <label for='adoptionDate' class='form-label'>AdoptionDate</label>
                                            <input type='date' name='adoptionDate' class='form-control' id='adoptionDate' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='donation' class='form-label'>Donation</label>
                                            <input type='text' name='donation' class='form-control' id='donation' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='reason' class='form-label'>reason</label>
                                            <input type='texterea' name='reason' class='form-control' id='reason' required>
                                        </div>
                                        <button type='submit' name='adoption-submit' class='btn btn-primary'>Submit</button>
                                    </form>
                                </div>
                                <div class='col-2'></div>
                            </div>
                        </div> 
                        ";
        }
    }
    ?>
</body>

</html>