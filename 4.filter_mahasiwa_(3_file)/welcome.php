<?php
    session_start();

    // Menghapus semua riwayat dan mengembalikan ke halaman index
    if( isset($_POST["hapus"]) ) {
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
            <!-- Menampikan hasil dari poses login sesuai dengan kondisinya -->
            <?php if(isset($_SESSION['nama'])) { ?>
                
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
        
        <!-- Tombol untuk membersihkan data dan memulai nya dari awal kembali -->
        <form action="welcome.php" method="post">
			<input type="submit" name="hapus" value="Bersihkan Data">
		</form>
    </body>
</html>