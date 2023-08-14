<?php
function generateAnimalCards($result)
{
    $layout = "";

    if (!empty($result)) {
        foreach ($result as $animal) {

            $imageSrc = "../pictures/{$animal['image']}";
            $name = "{$animal['name']}";
            $breed = "{$animal['breed']}";
            $size = "{$animal['size']}";
            $age = "{$animal['age']}";
            $isAdopted = ("{$animal['status']}" === 'adopted');
            $animalDetails = "../animal/details.php?id={$animal['id']}";
            $petAdoption = "../animal/adoption.php?id={$animal['id']}";
            $updateAnimal = "../animal/update.php?id={$animal['id']}";
            $deleteAnimal = "../animal/delete.php?id={$animal['id']}";

            $buttonClass = $isAdopted ? 'btn btn-primary disabled' : 'btn btn-primary';

            $layout .= <<<HTML
                        <div class='col-lg-3 col-md-4 col-sm-6'>
                            <div class='book-card'>
                                <img src="{$imageSrc}" class='img-fluid'>
                                <div class='card-body'>
                                    <h5 class='card-title'> $name </h5>
                                    <p>Breed: $breed</p>
                                    <p>Size: $size</p>
                                    <p>Age: $age</p>
                        HTML;
            if (isset($_SESSION["user"])) {
                $layout .= <<<HTML
                                    <a href="{$petAdoption}" class="$buttonClass">Take me home</a>
                                    <a href="{$animalDetails}" class='btn btn-warning'>Details</a>
                                HTML;
            }
            if (isset($_SESSION["admin"])) {
                $layout .= <<<HTML
                                    <a href="{$animalDetails}" class='btn btn-primary'>Details</a>
                                    <a href="{$updateAnimal}" class='btn btn-warning'>Update</a>
                                    <a href="{$deleteAnimal}" class='btn btn-danger'>Delete</a> 
                                HTML;
            }
            $layout .= "
                        </div>
                    </div>
                </div>";
        }
    } else {
        $layout .= "No results";
    }
    return $layout;
}
