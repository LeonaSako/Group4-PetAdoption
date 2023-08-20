<?php
function viewAdoptions($result)
{
    $crudUser = new CRUD_USER();
    $crudPet = new CRUD_PET();
    $list = "";

    if (!empty($result)) {

        foreach ($result as $row) {

            if ($row["fk_adoptee_id"] != Null) {
                $getUser = $crudUser->selectUsers("id = {$row["fk_adoptee_id"]}");
                $adoptee = $getUser[0]["firstName"] . ' ' . $getUser[0]["lastName"];
            } else {
                $adoptee = '';
            }

            $petId = $row["fk_pet_id"];

            $getPet = $crudPet->selectPets("id = $petId");

            $petName = $getPet[0]["name"];
            $petSpecies = $getPet[0]["species"];
            $status = $row['adopStatus'];

            $btnattr = "hidden";

            if ($status == 'Apply') {
                $application = 'Pending';
                $url = "cancel.php?id=" . $row["id"];
                $btnattr = "";
            } elseif ($status == 'Approved') {
                $application = 'Approved';
            } else {
                $application = 'Rejected';
            }

            $list .= <<<HTML
                            <tr>
                                <td> {$row["id"]} </td>
                                <td> $petId </td>
                                <td> {$petName} </td>
                                <td> {$petSpecies} </td>
                                <td> $application </td>
                                <td> {$adoptee} </td>
                                <td> {$row['submitionDate']} </td>
                                <td> {$row['donation']} </td>
                                <td>
                                <p class="d-inline-flex gap-1">
                                    <a href='view.php?id={$row["id"]}' class='btn btn-warning'>Details</a>
                            HTML;
            if (isset($_SESSION['Adm'])) {
                $list .= "<a href='edit.php?id={$petId}' class='btn btn-success disabled' aria-disabled='true'>Approve</a>
                                <a href='edit.php?id={$petId}' class='btn btn-primary disabled' aria-disabled='true'>Reject</a>";
            } else if (isset($_SESSION['Agency'])) {
                $list .= "<a href='edit.php?id={$petId}' class='btn btn-primary'>Approve</a>
                                <a href='edit.php?id={$petId}' class='btn btn-primary'>Reject</a>";
            } else {
                $list .= "<a href='cancel.php?id={$petId}' class='btn btn-primary' $btnattr>Cancel</a>";
            }
            $list .= "</p>
                    </td>
                    </tr>";
        }
    } else {
        $list .= "<tr><td colspan='9'>No records found</td></tr>";
    }
    return $list;
}
