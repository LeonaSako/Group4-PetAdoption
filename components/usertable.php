<?php
function viewAdoptions($result)
{

    $crudPet = new CRUD_PET();
    $list = "";

    if (!empty($result)) {

        foreach ($result as $adoption) {


            $petId = $adoption["fk_pet_id"];

            $getPet = $crudPet->selectPets("id = $petId");

            $petName = $getPet[0]["name"];
            $petSpecies = $getPet[0]["species"];

            $submission = $adoption['submitionDate'];

            $status = $adoption['adopStatus'];

            $url = "#";

            $btnattr = "hidden";
            $btnattr2 = "hidden";

            $submitted = $adoption["submitionDate"];
            $today = date("Y-m-d");
            $diff = strtotime($today) - strtotime($submitted);
            $daysAgo = floor($diff / (60 * 60 * 24));
            $daytext = ($daysAgo == 1) ? 'day' : 'days';

            if ($status == 'Apply') {
                $application = 'Pending';
                $url = "cancel.php?id=" . $adoption["id"];
                $btnattr = "";
            } elseif ($status == 'Approved') {
                $application = 'Approved';
                $btnattr2 = "";
            } else {
                $application = 'Rejected';
            }

            $donation = ($adoption['donation']) ? "&euro; " . $adoption['donation'] : "-";

            $list .= <<<HTML
                            <tr>
                                <td> $petName </td>
                                <td> $petSpecies </td>
                                <td> $application </td>
                                <td> $submission <span class="cssFont_1"> ($daysAgo $daytext ago)</span> </td>
                                <td> $donation </td>
                                <td>
                                <p class="d-inline-flex gap-1">
                                    <a href='../adoptions/view.php?id={$adoption["id"]}' class='btn btn-warning'>Details</a>
                                    <a href='cancel.php?id={$petId}' class='btn btn-primary' $btnattr>Cancel</a>
                                    <a href='../stories/new.php?id={$petId}' class='btn btn-primary' $btnattr2>Add Story</a>
                            HTML;
            if (isset($_SESSION['Adm'])) {
                $list .= "<a href='edit.php?id={$petId}' class='btn btn-success disabled' aria-disabled='true'>Approve</a>
                                <a href='edit.php?id={$petId}' class='btn btn-primary disabled' aria-disabled='true'>Reject</a>";
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
