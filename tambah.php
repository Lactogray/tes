<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}


require 'function.php';

// cek apakah submit sudah diekan
if(isset($_POST["submit"])){;


    if (tambah($_POST) > 0){
        echo 
       " <script>
         alert('Data Berhasil Disimpan');
         document.location.href ='index.php';
        </script>";
    }else {
        echo 
        " <script>
          alert('Data Gagal  Disimpan');
          document.location.href ='index.php';
         </script>";
    }

 





}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
<h1>Silahkan, Tambah Data</h1>

<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nama">Isi Nama Siswa</label>
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="nim">Isi Nim Siswa</label>
            <input type="text" name="nim" id="nim" required>
        </li>
        <li>
            <label for="kelas">Isi Kelas Siswa</label>
            <input type="text" name="kelas" id="kelas" required>
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" >
        </li>
        <li>
            <button type="submit" name="submit">Pincit Aku</button>
        </li>
    </ul>
</form>


</body>
</html>