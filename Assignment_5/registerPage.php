<?php
session_start();

$usersFile = 'users.json';



$users = file_exists( $usersFile ) ? json_decode( file_get_contents( $usersFile ), true ) : [];
function saveUsers( $users, $file )
{
    file_put_contents( $file, json_encode( $users, JSON_PRETTY_PRINT ) );
}

// Registration Form Handling
if ( isset( $_POST['register'] ) ) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

//Validation
    if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
        $errorMsg = "Please fill  all the fields.";
    } else {
        if ( isset( $users[$email] ) ) {
            $errorMsg = "Email already exists.";
        } else {
            $users[$email] = [
                'username' => $username,
                'password' => $password,
                'role'     => '',
            ];

            saveUsers( $users, $usersFile );
            $_SESSION['email'] = $email;
            header( 'Location: login.php' );
        }

    }

}

// [

//     'abc@gmail.com' => [

//         'username' => abc@gamil....,

//         'password' => 43545345,

//         'role' => ''

//     ];

// ]

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>Registration Page</title>
    </head>
    <body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">Use Role Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>User Registration</h3>
                        <a href="login.php" class="btn btn-info text-white">
                            Already have an account?
                        </a>
                    </div>
                    <div class="card-body">
                        <?php

if ( isset( $errorMsg ) ) {
    echo "<p>$errorMsg</p>";
}

?>
                        <form class="form" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="Username"><br>
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <input type="hidden" name="role" value="">
                            <input class="btn btn-primary" type="submit" name="register" value="Register">
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->
    </body>
</html>