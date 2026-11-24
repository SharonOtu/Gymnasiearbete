<?php
session_start();
require_once '../assets/functions.php';


$error="";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']??'');
    $name = trim($_POST['name']??'');
    $lastname = trim($_POST['lastname']??'');
    $email = trim($_POST['email']??'');
    $password = $_POST['password']??'';


if (
    $username === "" ||
    $name === "" ||
    $lastname === "" ||
    $email === "" ||
    $password === ""
) {
    $error = "Fill in all fields.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $error = "Invalid email";
}

else {
    $felt = [
        
        'username' => $username,
        'name' => $name,
        'lastname' => $lastname,
        'email' => $email,
        'password' => $password
    ];

if (addUser($felt)) {

    $_SESSION['username'] = $username; //Sparar användarnamed, namn o mejl i sessionen
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;

    header("Location: index.php"); // Redirect till index.php om användaren har registrerats
    exit();
    } 
    else {
        $error = "Could not register user. Username or email may already exist. Please try again.";
    }
}
 }



    ?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/stylesheet.css">

    <title>Join Tourly - Sign Up</title>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="signupNav">

        <a href="index.php" class="tourlyLogo">
            Tourly
        </a>

        <div class="navLinks">
            <a href="index.php">Home</a>
            <a href="Tourlylogin.php">Log in</a>
        </div>

    </nav>


    <!-- SIGNUP SECTION -->
    <main class="signupContainer">

        <!-- LEFT SIDE: FORM -->
        <section class="signupForm">

            <h1>Join Tourly</h1>

            <p class="signupSubtitle">
                Your musical journey starts here.
            </p>

            <?php if ($error !== ""): ?>
                <p class="errorMessage">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <form method="POST" action="">

                <label for="name">First name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter your first name"
                    required
                >

                <label for="lastname">Last name</label>
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    placeholder="Enter your last name"
                    required
                >

                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Choose a username"
                    required
                >

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create a password"
                    required
                >

                <button type="submit" name="submit">
                    Create account
                </button>

            </form>

            <p class="loginText">
                Already have an account?
                <a href="Tourlylogin.php">Log in</a>
            </p>

        </section>


        <!-- RIGHT SIDE: VIDEO -->
        <section class="signupVideo">

            <video autoplay muted loop playsinline>
                <source src="../images/concert.mp4" type="video/mp4">
                Your browser does not support this video.
            </video>

            <div class="videoOverlay">
                <h2>Feel the music.</h2>
                <p>
                    Discover artists, explore concerts
                    and create your musical memories.
                </p>
            </div>

        </section>

    </main>
    
</body>
</html>