<?php
// Sambung ke database
$conn = mysqli_connect("localhost","root","","phpdasar");


// bikin function

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {;
    $rows[] = $row;
    }

    return $rows;
}




function tambah($data){

    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $kelas = htmlspecialchars($data["kelas"]);

// upload gambar
    $gambar = upload();

        if( !$gambar ){
            return false;
        }
    

    $query = "INSERT INTO siswa
        VALUES
        ('','$nama','$nim','$kelas','$gambar')
        ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function upload(){
    // ambil data gambar dari $_FILES
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


// cek apakah tidak ada gambar yang di upload
    if($error === 4){
        echo "<script>
            alert('Tambah Gambar Dulu Bro')
            </script>";
            return false;
    }

    // cek apakah yang di upload adalah gambar
    $extensiGambarValid = ['jpg','jpeg','png'];
    $extensiGambar = explode('.',$namaFile);
    $extensiGambar = strtolower(end($extensiGambar));

    if(!in_array($extensiGambar, $extensiGambarValid)){

        echo "<script>
        alert('Gambar PLzz!!!')
        </script>";
        return false; 
    }

// cek apakah ukuran gambar terlalu besar

if ($ukuranFile > 1000000){

    echo "<script>
    alert('Kegedean WOIII!!!')
    </script>";
    return false; 
}

// jika sudah lolos pengecekan pindahkan gambar 
// generete nama file baru

$namaFileBaru = uniqid();
$namaFileBaru .= '.';
$namaFileBaru .= $extensiGambar;

move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

return $namaFileBaru;
    

}



    function hapus($id){
        global $conn;
        $query = "DELETE FROM siswa WHERE id = '$id'";
        mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
    }
    




    function ubah($data){

        global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $kelas = htmlspecialchars($data["kelas"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }
  

    $query = "UPDATE siswa SET
                nama = '$nama',
                nim = '$nim',
                kelas ='$kelas',
                gambar ='$gambar'
                WHERE id = '$id'";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
    }





    function cari($keyword){

        $query = ("SELECT * FROM siswa WHERE
                    nama LIKE '%$keyword%' OR
                    nim LIKE '%$keyword%' OR
                    kelas LIKE '%$keyword%'");

        return query($query);
    }
    

    function daftar($data){

        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        
        // konfirmasi username 

        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if(mysqli_fetch_assoc($result)){
            echo"<script>
            alert('username sudah dipakai !')
            </script>";
            return false;
        }

        // konfirmasi password

        if($password !== $password2){
            echo
            "<script>
            alert('Konfirmasi password salah')
            </script>";
            return false;

        }

        // enskripsi password

        $password = password_hash($password, PASSWORD_DEFAULT);


        // Masukan Data ke data bases

        mysqli_query($conn, "INSERT INTO user VALUES
                                ('','$username','$password')");


        return mysqli_affected_rows($conn);

    


    }




?>