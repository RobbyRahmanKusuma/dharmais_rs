<?php
include 'config.php';
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Form Login</title>
    <style>
        h2 {
    color: black;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
}

/*
.username {
    
}
*/

.password {
    align-items: center;
}

.button {
    align-items: center;
}

.form {
    margin: 5% 20% 0 20%;
    padding: 5% 5% 5% 5%;
    border: 3px solid black;
    text-align: center;
}
    </style>
</head>
<body>
    <h2 class="h2">Login</h2>
    <form action="" class="form">
        <label class="username" for="username">Username</label>
        <input placeholder="Masukkan Username Anda" class="center" type="text">
        <br>
        <br>
        <label class="password" for="password">Password</label>
        <input placeholder="Masukkan Password Anda" class="center" type="text">
        <br>
        <br>
        <button class="button">Login</button>
    </form>

</body>
</html>