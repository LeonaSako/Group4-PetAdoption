<?php
    session_start();

    if(isset($_SESSION["user"])){ 
        header("Location: home.php");
    }
    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");  
    } 
    require_once "db_connection.php";
    $error = false; 
    function cleanInputs($input){ 
        $data = trim($input);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = ""; 
    $emailError = $passError = ""; 

    if(isset($_POST["login"])){
        $email = cleanInputs($_POST["email"]);
        $password = cleanInputs($_POST["password"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Please enter a valid email address";
        }
        if (empty($password)) {
            $error = true;
            $passError = "Password can't be empty!";
        }

        if(!$error){
            $password = hash("sha256", $password);

            $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

            $result = mysqli_query($connect, $sql);

            $row = mysqli_fetch_assoc($result);

            if(mysqli_num_rows($result) == 1){
                if($row["status"] == "adm"){
                    $_SESSION["adm"] = $row["id"];
                    header("Location: dashboard.php");
                }else {
                    $_SESSION["user"] = $row["id"];
                    header("Location: home.php");
                }
            }else {
                echo "<div class='alert alert-danger'>
                        <p>Something went wrong, please try again later ...</p>
                      </div>";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
        <div class="container">
            <h1 class="text-center">Sign Up</h1>
            <form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="password">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="login">Sign in</button>
            </div>
            </form>
        </div>
        <br> <br> <br>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>