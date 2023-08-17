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
            $description = $row['description'];
            $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';

            $layout .= <<<HTML
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <img src="{$image}" id="details-img" class='img-fluid shadow mb-5' alt="Pet image">
                    <div class="card-body">
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
                        <a href="update.php?id={$id}" class="btn btn-success">Update</a>
                        </div>
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
