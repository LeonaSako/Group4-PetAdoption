<?php

$navlayout = "";
if (isset($_SESSION["Adm"])) {
    $navlayout .= <<<HTML
    
    /** Add navbar menu for admin */

    HTML;
} elseif (isset($_SESSION["User"])) {
    $navlayout .= <<<HTML
    
        /** Add navbar menu for user */

    HTML;
} elseif (isset($_SESSION["Agency"])) {
    $navlayout .= <<<HTML

    /** Add navbar menu for agency */
    
    HTML;
} else {
    $navlayout .= <<<HTML
        <li class='nav-item'>
            <a class='nav-link' href='../user/login.php'>Login</a>
        </li>
    HTML;
}

?>

<!DOCTYPE html>
<html lang="en">

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <?= $navlayout ?>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>