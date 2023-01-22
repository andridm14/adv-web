<?php
session_start();

include 'config/app.php';

//cek button login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //cek username
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

    //jika ada user
    if (mysqli_num_rows($result) == 1) {
        //cek password
        $hasil = mysqli_fetch_assoc($result);

        if (password_verify($password, $hasil['password'])) {
            //set sessiion
            $_SESSION['login']      = true;
            $_SESSION['id_user']    = $hasil['id_user'];
            $_SESSION['username']   = $hasil['username'];
            $_SESSION['nm_user']    = $hasil['nm_user'];
            $_SESSION['role']       = $hasil['role'];

            header("location: index.php");
            exit;
        }
    }
    // tidak ada user/login salah
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#78e1f1;" name="theme-color">

    <title>Login - Apps</title>
    <link href="img/car.ico" rel="icon">

    <!-- css -->
    <link rel="stylesheet" href="css/login_style.css">
</head>

<body>

    <!-- registrer -->
    <div class="wrapper">
        <div class="form-wrapper sign-up">
            <form action="" method="post">
                <h2>Sign Up</h2>
                <div class="input-group">
                    <input type="hidden" name="id_user" required>
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                </div>
                <div class="input-group">
                    <input type="text" name="nm_user" required>
                    <label for="">Nama</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required>
                    <input type="hidden" name="role" value="2" required>
                    <label for="">Password</label>
                </div>
                <button type="submit" name="regis" class="btn">Sign Up</button>
                <div class="sign-link">
                    <p>Already have an account? <a href="#" class="signIn-link">Sign In</a></p>
                </div>
            </form>
        </div>

        <!-- login -->
        <div class="form-wrapper sign-in">
            <form action="" method="post">
                <h2>Login</h2>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center">
                        <p>Username or Password!</p>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="login" class="btn">Login</button>

                <div class="sign-link">
                    <p>Don't have an account? <a href="#" class="signUp-link">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="js/script.js">

        //title
        let docTitle = document.title;
        window.addEventListener("blur", () => {
            document.title = " Come On Back 🚗";
        })
        window.addEventListener("focus", () => {
            document.title = docTitle;
        })
    </script>
</body>

</html>