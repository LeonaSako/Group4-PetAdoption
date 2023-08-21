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
            $isAdopted = ($row['available'] == 0) ? true : false;

            $buttonClass = $isAdopted ? 'btn btn-primary disabled' : 'btn btn-primary';

            $layout .= <<<HTML
                            
                            <div class="col" style="display: inline-block;">
                                <div class="pet-card">
                                    <img src="{$image}" id="details-img" class='img-fluid shadow' alt="Pet image">
                                    <div class="card-body">
                                        <figure class="text-center">
                                            <blockquote class="blockquote"><h5>{$name}</h5></blockquote>
                                            <figcaption class="blockquote-footer">{$description}</figcaption>
                                        </figure>
                                        <p class='card-text'>Breed: $breed</p>
                                        <p class="card-text">Age: $age years</p>
                                        <p class="card-text">Size: $size</p>
                                        <p class="card-text">Vaccinated: $vaccinated</p>
                                        <div class="gap-2 d-md-flex justify-content-center">
                                            <a href="../pet/details.php?id=$id" class="btn btn-warning">Details</a>
                        HTML;
            if (isset($_SESSION["User"])) {
                $layout .= <<<HTML
                        <a href="../adoptions/new.php?id=$id" class="$buttonClass">Take me home</a>
                        HTML;
            }
            if (isset($_SESSION["Adm"]) || isset($_SESSION["Agency"])) {
                $layout .= <<<HTML
                        <a href="../pet/update.php?id={$id}" class="btn btn-primary">Update</a>
                        
                        HTML;
            }
            $layout .= "    </div>
                        </div>
                    </div>
                
                </div>
                
            ";
        }
    } else {
        $layout .= "No results";
    }
    return $layout;
}
