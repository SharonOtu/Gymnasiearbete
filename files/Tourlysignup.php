<?php
require_once 'assets/functions.php';
session_start();

$error=false;

if(isset($_POST['submit'])) {
    if(isset($_POST['username'])
        && isset($_POST['name'])
        && isset($_POST['email'])
        && isset($_POST['password'])
        ) {

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS); Går ej att filtrera och hasha samtidigt
    
    if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
    
    echo("Email is valid");
    } else {
    
    echo("Email is not valid");
}

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);/*Det är osäkert att ha användarnas lösenord 
                                                                    i klar text, därför måste vi använda oss av detta. */
/*$_POST['username'] = $username;
$_POST['name'] = $name;
$_POST['email'] = $email;
$_POST['password'] = $hashed_password;*/

    $_POST = [
        'username' => $username,
        'name' => $name,
        'email' => $email,
        'password' => $hashed_password
    ];
        if(addUser($_POST)){
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            /* $_SESSION['password']= $password; */
        header("Location: index.php");
        }

        else {
            $error=true;
        }
    } else {
        $error=true;
    }
}

    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Your lyrical future starts here - Sign Up</title>
</head>
<body>
            <form method="post" action="">
            <label for="username">username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="name">name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" id="submit" name="submit">
        </form>

        <p><a href="Tourlylogin.php">Already have an account?</a></p>
    
</body>
</html>