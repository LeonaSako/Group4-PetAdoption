<?php
function viewAdoptions($result)
{
    $layout = "";

    if (!empty($result)) {

        # Add the layout here

    } else {
        $layout .= "No results";
    }
    return $layout;
}
