<?php
session_start();
require 'function.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");

    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){

        $_SESSION["login"] = true;
    }


}

if(isset($_SESSION["login"])){
    header("Location: index.php");
}





    if(isset($_POST["login"])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");

        // cek username
        if (mysqli_num_rows($result) === 1){

            // cek password
            $row = mysqli_fetch_assoc($result);

          if (  password_verify($password, $row["password"]) ) {

                // Bikin session 
                $_SESSION["login"]= true;

            //    cek remember me
                if(isset($_POST["remember"])){

                     // bikin cookie
                setcookie('id', $row['id'], time()+300);
                setcookie('key', hash('sha256', $row['username']), time()+300);

                }

                header ("Location: index.php");

          }

        }

        $error = true;

    }

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="login/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- <h1>HALAMAN LOGIN</h1> -->

<?php if(isset($error) ) :  ?>
"<p style="color:red; font-style: italic;" >Username / Password salah</p>"
    <?php endif; ?>
        
    

    <div class="bungkus">
    <h1> LOGIN</h1>
    <form action="" method="post">
       
                <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                <input type="text" name="password" id="password"  placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
                </div>
                <!-- <div> -->
                <button class="btn" type="submit" name="login">Login</button>
                <!-- </div> -->
        
    </form>
    </div>
    
</body>
</html>