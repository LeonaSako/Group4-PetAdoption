<?php
session_start();

require_once "../utils/crud.php";

$crud = new Crud();
$layout = "";

if (isset($_POST["finish"])) {
    $animalPreference = $_POST["animalPreference"];
    $sizePreference = $_POST["sizePreference"];
    $result = $crud->selectPets("species = '$animalPreference' AND size = '$sizePreference'");
   
    
    if (!empty($result)) {  
        foreach ($result as $row) {

            $id = $row['id'];
            $name = $row['name'];
            $image = "../images/pets/{$row['image']}";
            $breed = $row['breed'];
            $age = $row['age'];
            $size = $row['size'];
            $description = $row['description'];
            $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';
        
            $layout .= <<<HTML
                     <div class=" ">
                     <div class="card-header p-2 m-5"><h1>Matching Pets:</h1></div>
                    <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                <div class="card">
                    <img src="{$image}" id="details-img" class='img-fluid shadow mb-5' alt="Pet image">
                    <div class="card-body ">
                    <figure class="text-center">
                    <blockquote class="blockquote">
                        <h5>{$name}</h5>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            {$description}
                            </figcaption>
                        </figure>
                        <p class='card-text'>Breed: $breed</p>
                        <p class="card-text">Age: $age years</p>
                        <p class="card-text">Size: $size</p>
                        <p class="card-text">Vaccinated: $vaccinated</p>
                        <div class="gap-2 d-md-flex justify-content-center">
                        <a href="../pet/details.php?id=$id" class="btn btn-primary">Details</a>
                        <a href="../adoptions/new.php?id=$id" class="btn btn-warning">Take me home</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            HTML;
        }
    } else {
            $layout .= "<div class='alert alert-info mt-4' role='alert'>
            No matching pets found.
            </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Compatibility Quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #fce4ec; 
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #ff80ab; 
            border-bottom: none;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .btn-primary {
            background-color: #ff80ab;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff6090; 
        }
        .btn-warning {
            background-color: #ffb74d; 
            border: none;
        }
        .btn-warning:hover {
            background-color: #ffab40; 
        }
        .img-fluid {
            border-radius: 20px 20px 0 0;
        }
        .card-text {
            color: #333;
        }
        .blockquote-footer {
            color: #666;
        }
        .form-select {
            background-color: #fff;
        }
    </style>
</head>
<body>

<?php include '../components/navbar.php'; ?>
<a class="m-3 btn btn-primary" href="javascript:history.back()">GO BACK</a>
<div class="container">
    
        <div class="card ">
            <div class="card-header">
                Compatibility Quiz
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="animalPreference" class="form-label">Which animal do you prefer?</label>
                        <select class="form-select" name="animalPreference" required>
                            <option value="Cat">Cat</option>
                            <option value="Dog">Dog</option>
                            <option value="Bird">Bird</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sizePreference" class="form-label">What size are you looking for?</label>
                        <select class="form-select" name="sizePreference" required>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                        </select>
                    </div>
                    <button type="submit" name ='finish' class="btn btn-primary">Finish Quiz</button>
                </form>
            </div>
        </div>
       
            
            <?= $layout ?>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
