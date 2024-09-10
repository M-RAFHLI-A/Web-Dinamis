<?php
    // sebelum memulai, siapkan database dengan nama "kampus", dana tabel "mahasiswa"
    session_start();

    // proses koneksi ke database MySQL
    $host = "localhost"; 
    $user = "root"; 
    $pass = ""; 
    $db = "kampus"; 
    $conn = mysqli_connect($host, $user, $pass, $db); 

    // Memastikan apakah sudah masuk ke database
    if ($conn->connect_error) { 
        die("Database Kampus Tidak Ditemukan" . $conn->connect_error); 
        exit;
    }

    // Memindahkan input ke variabel yang disediakan
    $prodi = $_POST['prodi'];
    $absen = $_POST['absen'];

    // Buat query untuk mencocokkan prodi dan absen
    $sql = "SELECT * FROM mahasiswa WHERE prodi='$prodi' AND absen='$absen'";
    $result = mysqli_query($conn, $sql);

    //Untuk memastikan eror yang muncul saat mengambil data
    if( !$result ){
        echo mysqli_error($conn);
    }

    //Memastikan apakah data yang dicari telah tersedia
    if ($result->num_rows > 0) {

        // Jika data ditemukan, ambil nama pengguna dan simpan ke dalam session
        $row = $result->fetch_assoc();
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['prodi'] = $row['prodi'];
        $_SESSION['absen'] = $row['absen'];
        // echo var_dump($row);    
        header("Location: index.php");
    } else {
        // Jika tidak ditemukan, akan menampilkan pemberitahuan sintas HTML ini        
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hasil Tidak Ada</title>
        <style>
            body {      
                height: 100vh;
                display: flex; /* Akses untuk menerapkan properti flexbox */
                align-items: center; /* kordinat Y */
                justify-content: center; /* kordinat X */
            }
            .container {
                width: 40%;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                border-radius: 8px;
                text-align: center;
            }
            .pesan {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .link {
                text-decoration: none;
                padding: 10px;
                background: #909090;
                color: #000000;
                border-radius: 10px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="pesan">Data Mahasiswa Tidak Ditemukan</div>
            <a href="index.php" class="link">Silahkan Coba Lagi</a>
        </div>        
    </body>
</html>

<?php                
        session_destroy();
    }

    // Menutup koneksi ke database
    $conn->close();
?>