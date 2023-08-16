<?php

$navlayout = "";
if (isset($_SESSION["Adm"])) {
    $navlayout .= <<<HTML
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../admin/dashboard.php">Home</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../pet/viewAll.php'>Pet listings</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../pet/create.php'>New pet</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../adoptions/viewAll.php'>Adoptions</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../user/logout.php?logout'>Logout ({$_SESSION["UserEmail"]})</a>
            </li>

    HTML;
} elseif (isset($_SESSION["User"])) {
    $navlayout .= <<<HTML
    
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../user/dashboard.php">Home</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../pet/viewAll.php'>Pet listings</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../agency/contact.php'>Contact us</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../user/logout.php?logout'>Logout ({$_SESSION["UserEmail"]})</a>
            </li>

    HTML;
} elseif (isset($_SESSION["Agency"])) {
    $navlayout .= <<<HTML

            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../agency/dashboard.php">Home</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../pet/viewAll.php'>Pet listings</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../pet/create.php'>New pet</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../adoptions/viewAll.php'>Adoptions</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../user/logout.php?logout'>Logout ({$_SESSION["UserEmail"]})</a>
            </li>
    
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