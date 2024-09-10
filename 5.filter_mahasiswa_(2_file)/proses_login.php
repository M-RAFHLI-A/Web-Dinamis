<?php
    session_start();

    // proses koneksi ke database MySQL
    $host = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "kampus"; 
    $conn = mysqli_connect($host, $username, $password, $database); 

    // Memastikan apakah sudah masuk ke database
    if ($conn->connect_error) { 
        die("Database Kampus Tidak Ditemukan" . $conn->connect_error); 
        exit;
    } 

    // melanjutkan proses jika sudah terdapat input
    if(isset($_POST['prodi']) && isset($_POST['absen'])){

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

            header("Location: index.php");
        } else {
            
            // Jika tidak ditemukan, kembalikan ke halaman login
            $_SESSION["gagal"] = "<font color='red'><i><h2>Data Mahasiswa Tidak Ditemukan.</h2></i></font>";            
            header("Location: index.php"); //hapus baris ini jika ingin ditampilkan di beda halaman
        }
    }

    $conn->close();

    if( isset($_POST["hapus"])) {
        session_destroy(); 
        header("Location: index.php"); 
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .hasil{
                margin-top: 55px;
                padding: 20px;
                background: #f9f9f9;
                border: 1px solid #000000;
                border-radius: 5px;                
            }
        </style>
    </head>

    <body>
        <div class="hasil">
            <?php if(isset($_SESSION["gagal"])) { ?>
                <?php echo $_SESSION["gagal"] ?> 
            <?php } elseif(isset($_SESSION['nama'])) { ?>
                <table border="0">
                    <tr>
                        <td><strong>Nama Mahasiswa </strong></td> <td>: <?= $_SESSION['nama'] ?> <br></td>                    
                    </tr>
                    <tr>
                        <td><strong>Prodi Mahasiswa </strong></td> <td>: <?= $_SESSION['prodi'] ?> <br></td>
                    </tr>
                    <tr>
                        <td><strong>Absen Mahasiswa </strong></td> <td>: <?= $_SESSION['absen'] ?> <br></td>
                    </tr>
                </table>
            <?php } else{?>
                <table border="0">
                    <tr>
                        <td><strong>Nama Mahasiswa </strong></td> <td>: <br></td>
                    </tr>
                    <tr>
                        <td><strong>Prodi Mahasiswa </strong></td> <td>: <br></td>
                    </tr>
                    <tr>
                        <td><strong>Absen Mahasiswa </strong></td> <td>: <br></td>
                    </tr>
                </table>
            <?php } ?>
        </div>
        
        <form action="proses_login.php" method="post">
			<input type="submit" name="hapus" value="Bersihkan Data & Ulang Kembali">
		</form>
    </body>
</html>
