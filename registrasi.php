<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}

require 'function.php';


if(isset($_POST["daftar"])){

    if( daftar($_POST) > 0){
        echo "<script>
                alert('user baru berhasil di daftarkan!')
              </script>";
    }else {
        mysqli_error($conn);
    }

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>HALAMAN DAFTAR</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="daftar">DAFTAR</button>
            </li>
        </ul>
    </form>

</body>
</html>