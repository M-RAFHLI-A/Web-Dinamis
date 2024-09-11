<?php
    // memanggil isi suatu dokumen/file
    require "query.php";

    // Proses ambil data dari database
    $rows = query("SELECT * FROM siswa");

    // Proses dan Logika untuk menghapus data yang dipilih
    if (isset($_GET["id"])) {
        echo hapus($_GET["id"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CRUD Lewat PHP</title>
        <style>
            /* Mengatur tampilan global */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            /* Style untuk konten utama */
            .container {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                max-width: 900px;
                width: 98%;
            }
            h1 {
                text-align: center;
                background-color: #A9A9A9;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
            .tambah-data {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            a {
                text-decoration: none;
                color: white;
                background-color: #696969;
                padding: 10px 20px;
                border-radius: 4px;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }
            a:hover {
                background-color: #222;
                transform: scale(1.05);
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid #000000;
            }
            th, td {
                padding: 8px;
                text-align: center;
            }
            th {
                background-color: #696969;
                color: white;
            }
            img {
                max-width: 150px;
                border-radius: 8px;
            }

            /* Mengatur gaya tombol aksi */
            .aksi {
                display: flex;
                border-bottom: #f4f4f4;
                border-left: #f4f4f4;
                border-right: #f4f4f4;
                justify-content: center;
                align-items: center;
                gap: 8px; /* Memberikan jarak antar tombol */
                flex-wrap: wrap; /* Agar tombol bisa melipat ke bawah ketika ruang tidak cukup */
            }

            /* Menjadikan tombol ukuran yang sama */
            .aksi a {
                flex: 2;
                text-align: center;
                padding: 6px 8px;
                min-width: 100px; /* Ukuran minimal tombol */
                margin: 10px; /* Pastikan tidak ada margin yang menyebabkan garis */
                
            }

            /* Hover efek pada tombol */
            .aksi a:hover {
                background-color: #333;
            }

            /* Media query untuk layar kecil, tombol akan disusun secara vertikal */
            @media (max-width: 500px) {
                img {
                    max-width: 80px; /* Gambar lebih kecil pada layar kecil */
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Daftar Siswa Yang Aktif Sekolah</h1>

            <!-- link untuk tambah data -->
            <div class="tambah-data">
                <a href="tambah.php">Tambah Data Mahasiswa</a>
            </div>

            <!-- proses menampilkan data -->
            <table>
                <tr>
                    <th>NO</th>
                    <th>Aksi</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Semester</th>
                    <th>Jurusan</th>
                </tr>

                <?php 
                    $i = 1;
                    foreach( $rows as $row ): 
                ?>
                    <tr>
                        <td> <?= $i ?> </td>
                        <td class="aksi">
                            <a href="ubah.php?id=<?= $row["id"] ?>">Ubah</a>
                            <a href="index.php?id=<?= $row["id"] ?>" onclick="return confirm('Yakin ?')">Hapus</a>
                        </td>
                        <td> 
                            <img src="aset/<?= $row["gambar"] ?>" alt="foto siswa" > 
                        </td>
                        <td> <?= $row["nama"] ?> </td>
                        <td> <?= $row["nisn"] ?> </td>
                        <td> <?= $row["semester"] ?> </td>
                        <td> <?= $row["jurusan"] ?> </td>
                    </tr>
                <?php 
                    $i++;
                    endforeach
                ?>
            </table>
        </div>
    </body>
</html>
