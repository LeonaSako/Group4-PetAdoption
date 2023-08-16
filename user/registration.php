<?php

session_start();

if (isset($_SESSION["Adm"])) {
    header("Location: ../admin/dashboard.php");
}
if (isset($_SESSION["User"])) {
    header("Location: ../user/dashboard.php");
}
if (isset($_SESSION["Agency"])) {
    header("Location: ../agency/dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Sign Up </h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="justify-content-center">
                <div class="mb-3 mt-3">
                    <label for="type" class="form-label">Account type <span class='required'>*</span> </label>
                    <!--<form name="accountType">
                        <input class="form-check-input" type="radio" name="user" id="user" checked>
                        <label class="form-check-label" for="user">User</label>
                        <input class="form-check-input" type="radio" name="agency" id="agency">
                        <label class="form-check-label" for="agency">Agency</label>
                    </form>-->
                    <select id="accountType" class="form-select" aria-label="Default select example">
                        <option selected value="User">User</option>
                        <option value="Agency">Agency</option>
                    </select>
                </div>
                <div id="formtype">
                    <?php include "../components/userForm.php" ?>
                </div>
                <p>(<span class='required'>*</span>) Required fields</p>
                <button name="sign-up" type="submit" class="btn btn-primary">Create account </button>

                <span>You have an account already? <a href="login.php">Sign in here </a></span>
            </div>
        </form>

    </div>
    <script type="text/javascript" src="../js/accountType.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>