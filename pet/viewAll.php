<?php
function viewPets($result)
{
    $layout = "";

    if (!empty($result)) {
        foreach ($result as $row) {
            $id = $row['id'];
            $name = $row['name'];
            $image = "../images/pets/{$row['image']}";
            $breed = $row['breed'];
            $age = $row['age'];
            $size = $row['size'];
            $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';

            $layout .= <<<HTML
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{$image}" id="details-img" class='img-fluid shadow mb-5' alt="Pet image">
                    <div class="card-body">
                        <h5 class="card-title">$name</h5>
                        <p class='card-text'>Breed: $breed</p>
                        <p class="card-text">Age: $age years</p>
                        <p class="card-text">Size: $size</p>
                        <p class="card-text">Vaccinated: $vaccinated</p>
                        <a href="../pet/details.php?id=$id" class="btn btn-primary">Show Details</a>
                        <a href="../adoptions/new.php?id=$id" class="btn btn-warning">Take me home</a>
                        <a href="update.php?id={$id}" class="btn btn-success">Update</a>
                    </div>
                </div>
            </div>
HTML;
        }
    } else {
        $layout .= "No results";
    }

    return $layout;
}
