<?php
require_once "../utils/crud.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];
$crud = new CRUD();

 $result = $crud->selectUsers("id = $id"); 

# for image upload use: $image = fileUpload($_FILES["image"], 'user');
#   
# Check if a new image has been uploaded to set the value of the column `image`:
#
 if ($_FILES["image"]["error"] == 0) {
   $pic = $image[0]; 
 } else {
    $pic = null;
 }

 $update = $crud->updateUser($id, $fname, $lname, $address, $birthdate, $phone, $email, $space, $exp, $pic)


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <!-- Add layout -->
    <div class="container">
        <h1 class="text-center">Update user</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="firstname" class="form-label">First name </label>
                <input type="text" class="form-control" id="fname" name="firstname" placeholder="First name" value="<?= $firstname ?>">
            
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name </label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?= $lastname ?>">
        
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="birthdate" value="<?= $birthdate ?>">
                
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture </label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                
            </div>
            <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=$address?>">
        
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?=$phone?>">
                   
                </div>
                <div class="mb-3">
                    <label for="space" class="form-label">Space</label>
                    <input type="number" class="form-control" id="space" name="space" placeholder="Space m3" value="<?=$space?>">
                </div>
                <label for="experienced">Do you have experience with the Pets?</label>
                <select name="experienced" id="experienced">
               <option name="experienced" value="Yes">Yes</option>
               <option name="experienced" value="No">No</option>
             
            </select>
        </form>
        <button name="update" type="submit" class="btn btn-primary">Update </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>