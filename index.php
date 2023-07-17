<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}


require 'function.php';

// pagination
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM siswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


// pertama masuk tampilkan semua datanya
$siswa =  query("SELECT * FROM siswa LIMIT $awalData, $jumlahDataPerHalaman" );


// tapi setelah tombol cari di tekan

if( isset($_POST["cari"])){
    $siswa = cari($_POST["keyword"]);
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hehe</title>
</head>
<body>
    <button><a href="logout.php">LOGOUT</a></button>
<h1>DAFTAR SISWA</h1>
<a href="tambah.php">Tambah Data Siswa</a>
<br><br>
<form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus placeholder="Apa Yang Dicari Dek !.." autocomplete="off">
    <button type="submit" name="cari">Cari</button>
</form>
<br>
<table border="1" cellpadding="10" cellspacing="0">

<tr>
    <th>ID</th>
    <th>NAMA</th>
    <th>NIM</th>
    <th>KELAS</th>
    <th>GAMBAR</th>
    <th>AKSI</th>

</tr>
<?php $i = 1; ?>
<?php foreach($siswa as $sis) : ; ?>
<tr>
    <td><?= $i ?></td>
    <td><?= $sis["nama"] ?></td>
    <td><?= $sis["nim"] ?></td>
    <td><?= $sis["kelas"] ?></td>
    <td><img src="img/<?= $sis["gambar"] ?>" width="50px"></td>
    <td>
        <a href="hapus.php?id=<?= $sis['id']; ?>" onclick="return confirm('Yakin Dek?');">hapus</a>  |
        <a href="ubah.php?id=<?= $sis['id']; ?>">ubah</a>
    </td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>
<br>

<!-- navigation -->

<?php if($halamanAktif > 1) : ?>
    <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
<?php endif; ?>

<?php for($i = 1; $i <= $jumlahHalaman; $i++)  :?>

    <?php if($i == $halamanAktif) : ?>
         <a href="?halaman=<?= $i ?>" style="font-weight: bold; color: red;"><?=$i?></a>

    <?php else : ?>
         <a href="?halaman=<?= $i ?>"><?=$i?></a>

    <?php endif; ?>

<?php endfor;  ?>

<?php if($halamanAktif < $jumlahHalaman) : ?>
    <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
<?php endif; ?>

</body>
</html>