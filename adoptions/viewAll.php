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

            $petId = $row["petId"];
            $getPet = $crudPet->selectPets("id = $petId");
            $pet = $getPet[0];
            
            $petName = $pet["name"];
            $petSpecies = $pet["species"];
            $status = $row['adopStatus'];
            $adopId = $row["adoptId"];

            $btnattr = "hidden";

            if ($status == 'Apply') {
                $application = 'Pending';
                $url = "cancel.php?id=" . $adopId;
                $btnattr = "";
            } elseif ($status == 'Approved') {
                $application = 'Approved';
            } else {
                $application = 'Rejected';
            }

            $list .= <<<HTML
                            <tr>
                                <td> $adopId </td>
                                <td> $petId </td>
                                <td> {$petName} </td>
                                <td> {$petSpecies} </td>
                                <td> $application </td>
                                <td> {$adoptee} </td>
                                <td> {$row['submitionDate']} </td>
                                <td> {$row['donation']} </td>
                                <td>
                                <p class="d-inline-flex gap-1">
                            HTML;

                            if (isset($_SESSION['User'])) {
                                $list .= "
                                <a href='../adoptions/view.php?id={$adopId}' class='btn btn-warning'>Details</a>";
                            };
                        
                            if (isset($_SESSION['Agency']) || isset($_SESSION['Adm'])) {
                                $list .= "    
                                    <a href='../adoptions/viewAdoptions.php?id={$adopId}' class='btn btn-warning'>Details</a>";
                            } 

            if (isset($_SESSION['Agency'])) {
                $list .= "
                <a href='../adoptions/edit.php?id={$adopId}&status=Approved' class='btn btn-success ' aria-disabled='true'>Approve</a>
                <a href='../adoptions/edit.php?id={$adopId}&status=Declined' class='btn btn-primary ' aria-disabled='true'>Reject</a>";
            } else {
                $list .= "<a href='../adoptions/edit.php?id={$adopId}&status=Cancelled' class='btn btn-primary' $btnattr>Cancel</a>";
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
