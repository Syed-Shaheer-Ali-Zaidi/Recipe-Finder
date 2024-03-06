<?php
    session_start();
    if (isset($_SESSION["user"])){
        header("Location: recipes.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
          if (isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user){
                if(password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = $email;
                    header("Location: recipes.php");
                    die();
                }
                else{
                    echo"<div class='alert alert-danger'>Incorrect Password!</div>";
                }
            }
            else{
                echo "<div class='alert alert-danger'>Email does not exist</div>";
            }
          }  
          
          if (isset($_POST["guest"])){
            session_start();
            $_SESSION["user"] = "guest";
            header("Location: recipes.php");
            die();
          }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type = "email" placeholder="Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type = "password" placeholder="Password:" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type = "submit" value = "Login" name="login" class="btn btn-primary">
            </div>
            <div class="form-group" method="post">
                <input type = "submit" value = "Continue as a Guest" name="guest" class="btn btn-primary">
            </div>
        </form>
        <div><a href="registration.php">Sign Up</a></div>

    </div>
</body>
</html>