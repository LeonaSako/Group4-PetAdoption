<?php
function buildForm($crud, $usage, $userID = null, $pet = null)
{
    $fieldNames = ['name', 'species', 'location', 'available', 'experienceNeeded', 'minSpace', 'vaccinated', 'breed', 'age', 'size', 'description', 'behavior'];

    foreach ($fieldNames as $fieldName) {
        $fields[$fieldName] = isset($_POST[$fieldName]) ? cleanInputs($_POST[$fieldName]) : ($usage === 'update' ? $pet[$fieldName] : '');
    }
    $fields['image'] = isset($_FILES['image']) ? fileUpload($_FILES["image"], 'pet') : ($usage === 'update' ? $pet['image'] : '');

    $speciesOptions = ['Cat', 'Dog', 'Bird', 'Fish'];
    $selectedSpecies = $fields['species'];
    $experience = ($fields['experienceNeeded'] == 1) ? 'checked' : '';
    $available = ($fields['available'] == 1) ? 'checked' : '';
    $vaccine = ($fields['vaccinated'] == 1) ? 'checked' : '';
    $sizeOptions = ['Small', 'Medium', 'Large'];
    $selectedSize = $fields['size'];

    $buttonName = $usage === 'create' ? 'Submit' : 'Update pet';

    if ($usage === 'create') {

        if (isset($_POST["create"])) {

            $values = [
                $fields['name'], $fields['image'][0], $fields['location'], $fields['species'], $fields['breed'],
                $fields['age'], $fields['size'], $fields['description'], $fields['vaccinated'], $fields['experienceNeeded'], $fields['minSpace'],
                $fields['behavior'], $userID
            ];

            $crud->createPet($values);
        }
    } else {
        if (isset($_POST["update"])) {

            if ($_FILES["image"]["error"] == 0) {
                removeOldImage($pet["image"]);
                $update = $crud->updatePet(
                    $pet["id"],
                    $fields['name'],
                    $fields['location'],
                    $fields['species'],
                    $fields['breed'],
                    $fields['age'],
                    $fields['size'],
                    $fields['description'],
                    $fields['available'],
                    $fields['vaccinated'],
                    $fields['experienceNeeded'],
                    $fields['minSpace'],
                    $fields['behavior'],
                    $fields['image'][0],
                );
            } else {
                $update = $crud->updatePet(
                    $pet["id"],
                    $fields['name'],
                    $fields['location'],
                    $fields['species'],
                    $fields['breed'],
                    $fields['age'],
                    $fields['size'],
                    $fields['description'],
                    $fields['available'],
                    $fields['vaccinated'],
                    $fields['experienceNeeded'],
                    $fields['minSpace'],
                    $fields['behavior'],
                    null
                );
            }
            if ($update) {
                header("refresh: 2; url = ../pet/details.php?id=" . $pet["id"]);
            }
        }
    }
    $layout = <<<HTML
                        <div class="required-fields">
                            <h6 id=pet-details-h6>Required pet details</h6>
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Name <span class='required'>*</span> </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{$fields['name']}" required="" oninvalid="this.setCustomValidity('Please, add a pet name')" oninput="setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="species" class="form-label">Species <span class='required'>*</span></label>
                                <select class="form-control" id="species" name="species" required="" oninvalid="this.setCustomValidity('Please, select a pet species')" oninput="setCustomValidity('')">
                                    <option value="" disabled selected>Select</option>
                HTML;
    foreach ($speciesOptions as $optionValue) {
        $selected = ($selectedSpecies === $optionValue) ? 'selected' : '';
        $layout .= "<option value=\"$optionValue\" $selected>$optionValue</option>";
    }
    $layout .= <<<HTML
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="space" class="form-label">Space needed <span class='required'>*</span></label>
                                <input type="number" class="form-control" id="space" name="space" placeholder="Space" min="0" value="{$fields['minSpace']}" required="" oninvalid="this.setCustomValidity('Please, add the amount of space needed')" oninput="setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" $experience>
                                    <label class="form-label form-check-label" for="flexCheckChecked">Experience with pets needed? <span class='required'>*</span></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" $available>
                                    <label class="form-label form-check-label" for="flexCheckChecked">Is the pet available for adoption? <span class='required'>*</span></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" $vaccine>
                                    <label class="form-label form-check-label" for="flexCheckChecked">Is the pet vaccinated? <span class='required'>*</span></label>
                                </div>
                            </div>
                            <p>(<span class='required'>*</span>) Required fields</p>
                        </div>
                        <br>
                        <div class="optional-fields">
                            <h6 id=pet-details-h6>Optional pet details</h6>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Breed </label>
                                <input type="text" class="form-control" id="breed" name="breed" placeholder="Breed" value="{$fields['breed']}">
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Description </label>
                                <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Give a pet description">{$fields['description']}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <select class="form-control" id="size" name="size">
                                    <option value="" disabled selected>Select</option>
                    HTML;
    foreach ($sizeOptions as $optionValue) {
        $selected = ($selectedSize === $optionValue) ? 'selected' : '';
        $layout .= "<option value=\"$optionValue\" $selected>$optionValue</option>";
    }
    $layout .= <<<HTML
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age </label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="Age" min="0" value="{$fields['age']}">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image </label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{$fields['location']}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="behavior" class="form-label">Behavior </label>
                                <textarea class="form-control" id="behavior" name="behavior" rows="4" cols="50" placeholder="Give a pet behavior">{$fields['behavior']}</textarea>
                            </div>
                        </div>
                        <div class="container">
                            <div class="d-grid gap-2 d-md-flex justify-content-start">
                                <button name=$usage type="submit" class="btn btn-primary">$buttonName</button>
                                <a href="../dashboard.php" class="btn btn-warning">Back to dashboard</a>
                            </div>
                        </div>
        HTML;
    return $layout;
}
