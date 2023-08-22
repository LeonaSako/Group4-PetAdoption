<?php

session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudPet.php";
require_once "../utils/crudUser.php";
require_once "../components/breadcrumb.php";
$pageTitle = "Adoption Details";


$adopId = $_GET["id"];
$crudAdoption = new CRUD_ADOPTION();
$getAdoption = $crudAdoption->selectAdoptions("id = $adopId");
$adoption = $getAdoption[0];

if (!empty($adoption)) {

    $reason = $adoption["reason"];
    $status = $adoption["adopStatus"];
    $submitionDate = $adoption["submitionDate"];
    $adoptionDate = $adoption["adoptionDate"];
    $donation = $adoption["donation"];
    
    $petId = $adoption["fk_pet_id"];
    $crudPet = new CRUD_PET();
    $getPet = $crudPet->selectPets("id = $petId");
    $pet = $getPet[0];
    
    $petName = $pet["name"];
    $species = $pet["species"];
    $imagePet = "../images/pets/{$pet['image']}";

    $userId = $adoption["fk_adoptee_id"];
    $crudUser = new CRUD_USER();
    $getUser = $crudUser->selectUsers("id = $userId");
    $user = $getUser[0];
    $userName = $user["firstName"]." ".$user["lastName"];

    $url = "#";

    $btnattr = "hidden";

}

    // if ($status == 'Apply') {
    //     $application = 'pending';
    //     $url = "cancel.php?id=" . $adoption["id"];
    //     $btnattr = "";
    // } elseif ($status == 'Approved') {
    //     $application = 'approved';
    // } else {
    //     $application = 'rejected';
    // }

    // $submitted = $adoption["submitionDate"];
    // $today = date("Y-m-d");
    // $diff = strtotime($today) - strtotime($submitted);
    // $daysAgo = floor($diff / (60 * 60 * 24));
    // $daytext = ($daysAgo == 1) ? 'day' : 'days';


addBreadcrumb('Home', '../user/dashboard.php');
//  addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
addBreadcrumb('Adoptions', '../adoptions/myadoptions.php');
addBreadcrumb('Details');
?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo $imagePet; ?>" alt="avatar" class="rounded-circle img-fluid" id="profile-picture">
                            <h5 class="my-3"><?php echo $petName; ?></h5>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-success">Approve</button>
                                <button type="button" class="btn btn-outline-primary ms-1">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            Adoption details
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Pet ID:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $petId; ?></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Pet Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $petName; ?></p>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Species</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $species; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">User ID:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $userId; ?></p>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">User Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $userName; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Pet Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $petName; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Reason</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $reason; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Adoption Status</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $status; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Submission date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $submitionDate; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Possible adoption date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $adoptionDate; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Donation</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">€ <?php echo $donation; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
            
        </div>
    </section>
</body>

</html>
