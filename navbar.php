<?php

$navlayout = "";
if (isset($_SESSION["admin"])) {
    $navlayout .= <<<HTML
    
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../dashboard.php">Home</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../home.php'>Animals</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../animal/senior.php'>Seniors</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../animal/create.php'>New animal</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../animal/adoptions.php'>Adoptions</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../user/logout.php?logout'>Logout ({$_SESSION["UserEmail"]})</a>
        </li>
    HTML;
} elseif (isset($_SESSION["user"])) {
    $navlayout .= <<<HTML
        <a class="navbar-brand" href="#">
            <img src="../pictures/{$_SESSION['Userimage']}" alt="user pic" style ="border-radius: 8px 8px 0 0; width: 80%; height: 50px;">
        </a>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../user/myadoptions.php'>My adoptions</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../animal/senior.php'>Seniors</a>
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
        <li class='nav-item'>
            <a class='nav-link' href='../animal/senior.php'>Seniors</a>
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