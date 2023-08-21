<?php
require_once "../components/breadcrumb.php";
$navlayout = "";
$profile = "";
if (isset($_SESSION["Adm"])) {
    $navlayout .= <<<HTML
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../admin/dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                    Pets
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href='../pet/listings.php'>View all pets</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href='../pet/create.php'>Create new</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                    Users
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href='../admin/dashboard.php'>View all users</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href='../pet/create.php'>View all agencies</a>
                    </li>
                </ul>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../admin/adoptions.php'>Adoptions</a>
            </li>
    HTML;
    $profile .= "<a class='dropdown-item' href='../user/profile.php?id={$_SESSION["Adm"]}'>My profile</a>";
} elseif (isset($_SESSION["User"])) {
    $navlayout .= <<<HTML
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../user/dashboard.php">Home</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../pet/listings.php'>Pet listings</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../agency/contact.php'>Contact us</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../adoptions/myadoptions.php'>My Adoptions</a>
            </li>
            
            <li class='nav-item'>
                <a class='nav-link' href='../user/compatibility_quiz.php'>Go to the Quiz</a>
            </li>
    HTML;
    $profile .= "<a class='dropdown-item' href='../user/profile.php?id={$_SESSION["User"]}'>My profile</a>";
} elseif (isset($_SESSION["Agency"])) {
    $navlayout .= <<<HTML

            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../agency/dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                    Pets
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class='nav-link' href='../agency/repository.php'>Pet repository</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href='../pet/create.php'>Create new</a>
                    </li>
                </ul>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../agency/adoptions.php'>Adoptions</a>
            </li>
    HTML;
    $profile .= "<a class='dropdown-item' href='../user/profile.php?id={$_SESSION["Agency"]}'>My profile</a>";
} else {
    $navlayout .= <<<HTML
        <li class='nav-item'>
            <a class='nav-link' href='../user/registration.php'>Register as User</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../agency/registration.php'>Register as Agency</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='../user/login.php'>Login</a>
        </li>
    HTML;
}
$breadcrumbs = displayBreadcrumbs();
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    <img src="../images/layout/pet_logo_2.png" class="logo" alt="MDB Logo" loading="lazy" />
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?= $navlayout ?>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <?= $profile ?>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="../user/logout.php?logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <div class="container breadcrump-container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <?= $breadcrumbs ?>
                    </nav>
                </div>
            </div>
        </div>
    </section>

</body>

</html>