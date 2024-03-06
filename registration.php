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
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
             if (isset($_POST["submit"])){
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["repeat_password"];
                
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if(empty($username) or empty($password) or empty($passwordRepeat)){
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password)<8){
                    array_push($errors, "Password must be at least 8 charachters long.");
                }
                if ($password != $passwordRepeat){
                    array_push($errors,"The passwords do not match!");
                }
                
                require_once "database.php";
                $sql= "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount>0){
                    array_push($errors, "This email is already in use.");
                }

                $sql= "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount>0){
                    array_push($errors, "This username is already in use.");
                }

                if(count($errors)>0){
                    foreach ($errors as $error){
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
                else{
                    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt){
                        mysqli_stmt_bind_param($stmt,'sss', $username,$email ,$passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    }
                    else{
                        die("Something went wrong.");
                    }
                }
             }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <br>
        <div><a href="login.php">Log In</a></div>
    </div>
</body>
</html>