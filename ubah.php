<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}


require 'function.php';


// ambil  data id dari index
$id = $_GET["id"];

// query data siswa berdasarkan id 

$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];


// cek apakah submit sudah diekan
if( isset($_POST["submit"]) ){;

    if( ubah($_POST) > 0){
        echo 
       " <script>
         alert('Data Berhasil Diubah');
         document.location.href ='index.php';
        </script>";
    }else {
        echo 
        " <script>
          alert('Data Gagal  Diubah');
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

    <input type="hidden" name="id" value="<?= $siswa ["id"] ?>">
    <input type="hidden" name="gambarLama" value="<?= $siswa ["gambar"] ?>">

    <ul>
        <li>
            <label for="nama">Isi Nama Siswa</label>
            <input type="text" name="nama" id="nama"  value="<?= $siswa ["nama"] ?> " required>
        </li>
        <li>
            <label for="nim">Isi Nim Siswa</label>
            <input type="text" name="nim" id="nim"  value="<?= $siswa ["nim"] ?>" required>
        </li>
        <li>
            <label for="kelas">Isi Kelas Siswa</label>
            <input type="text" name="kelas" id="kelas"  value="<?= $siswa ["kelas"] ?>" required>
        </li>
        <li>
            <label for="gambar">gambar</label> <br>
            <img src="img/<?= $siswa['gambar'] ?>" alt="" width="50px">
            <br>
            <input type="file" name="gambar" id="gambar" >
        </li>
        <li>
            <button type="submit" name="submit">Pincit Aku</button>
        </li>
    </ul>
</form>


</body>
</html>