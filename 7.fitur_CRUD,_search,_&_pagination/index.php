<?php
    // memanggil isi suatu dokumen/file
    require "query.php";
    
    // Cek apakah ada pencarian
    if (isset($_POST["cari"])) {
        $keyword = $_POST["keyword"];
    } else if (isset($_GET["keyword"])) {
        $keyword = $_GET["keyword"];
    } else {
        $keyword = '';
    }
    
    // Menentukan banyak data yang tampil dalam satu halaman
    $data_tampil = 3;

    // Menentukan halaman dan data yang tampil
    $page_aktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
    $awal_data = ($data_tampil * $page_aktif) - $data_tampil;

    // Menentukan query yang digunakan
    if (!empty($keyword)) {
        $hasil = pag_key($keyword, $data_tampil, $awal_data, TRUE);

        // variabel untuk parameter banyak nya jumlah halaman
        $jumlah_halaman = $hasil[0];

        // variabel berisi query SQL untuk mengambil data dari database 
        $rows = $hasil[1];
    } else {
        $hasil = pag_key($keyword, $data_tampil, $awal_data, FALSE);

        // variabel untuk parameter banyak nya jumlah halaman
        $jumlah_halaman = $hasil[0];

        // variabel berisi query SQL untuk mengambil data dari database
        $rows = $hasil[1];
    }

    // Proses dan Logika untuk menghapus data yang dipilih
    if (isset($_GET["id"])) {
        echo hapus($_GET["id"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CRUD, Search, dan Pagination dalam PHP</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: grey;
            }
            .container {
                max-width: 1200px;
                margin: 10px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
            }
            h1 {
                text-align: center;
                background-color: #888888;
                color: #fff;
                padding: 15px;
                border-radius: 5px;
            }

            /* Tombol "Tambah Data Siswa" di tengah dengan gaya abu-abu */
            a[href="tambah.php"] {
                display: inline-block;
                text-align: center;
                background-color: #d3d3d3;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
                color: #000;
                font-weight: bold;
                transition: background-color 0.3s ease;
            }
            a[href="tambah.php"]:hover {
                background-color: #a9a9a9;
            }

            /* Tabel dengan batas yang jelas dan elemen yang lebih rapi */
            table, th, td {
                border: 1px solid #000;
                text-align: center;
                padding: 3px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 0;
            }
            th {
                background-color: #d3d3d3;
                padding: 5px;
            }
            td {
                vertical-align: middle;
            }
            td img {
                max-width: 125px;
                border-radius: 5px;
            }

            /* Tombol Aksi (Ubah dan Hapus) sejajar dan dengan warna abu-abu */
            td a {
                display: inline-block;
                width: 60%;
                margin: 2px;
                background-color: #d3d3d3;
                padding: 5px 10px;
                border-radius: 3px;
                text-decoration: none;
                color: #000;
                transition: background-color 0.3s ease;
            }
            td a:hover {
                background-color: #a9a9a9;
            }

            /* Form pencarian dengan tampilan rapi */
            form input[type="text"] {
                padding: 5px 8px;
                width: 250px;
                border: 1px solid #000;
                border-radius: 3px;
            }

            /* Mengatur Tombol "Kembali ke Menu PHP" */
            form button {
                width: 100%;
                padding: 8px 15px;
                background-color: #d3d3d3;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            form button:hover {
                background-color: #a9a9a9;
            }

            /* Mengatur Tombol "Cari Data" */
            button[type="submit"] {
                width: 120px;
                padding: 5px 10px;
                background-color: #d3d3d3;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
                transition: background-color 0.3s ease;
            }
            button[type="submit"]:hover {
                background-color: #a9a9a9;
            }

            /* Pengaturan navigasi pagination */
            a[href*="halaman="] {
                text-decoration: none;
                padding: 5px 10px;
                margin: 2px;
                border-radius: 3px;
                background-color: #d3d3d3;
                color: #000;
            }
            a[href*="halaman="]:hover {
                background-color: #a9a9a9;
            }
            a[href*="halaman="][style*="font-weight: bold;"] {
                background-color: #ffdddd;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Daftar Siswa</h1>

            <!-- link untuk tambah data -->
            <a href="tambah.php">Tambah Data Siswa</a>
            <br><br>

            <!-- Tombol untuk menampilkan semua data -->
            <?php if (!empty($keyword)): ?>
                <a href="?halaman=1">Tampilkan Semua Data</a>
            <?php endif; ?>

            <!-- form untuk filter data -->
            <form action="" method="post">
                <input type="text" name="keyword" size="25" autofocus autocomplete="off" placeholder="Masukan Keyword Pencarian" ">
                <button type="submit" name="cari">Cari Data</button>
            </form> <br>

            <!-- navigasi ke halaman sebelumnya -->
            <?php if($page_aktif > 1): ?>
                <a href="?halaman=1&keyword=<?= urlencode($keyword) ?>"><-FIRST--</a> 
                <a href="?halaman=<?= $page_aktif-1; ?>&keyword=<?= urlencode($keyword) ?>">Sebelumnya</a>
            <?php endif ?>

            <!-- navigasi pagination -->
            <?php for( $i=1; $i <= $jumlah_halaman; $i++ ): ?>
                <?php if( $i == $page_aktif ): ?>
                    <a href="?halaman=<?= $i; ?>&keyword=<?= urlencode($keyword) ?>" style="font-weight: bold; color: red"> <?= $i; ?> </a>
                <?php else: ?>
                    <a href="?halaman=<?= $i; ?>&keyword=<?= urlencode($keyword) ?>"> <?= $i; ?> </a>
                <?php endif ?>
            <?php endfor ?>

            <!-- navigasi ke halaman selanjutnya -->
            <?php if($page_aktif < $jumlah_halaman): ?>
                <a href="?halaman=<?= $page_aktif+1; ?>&keyword=<?= urlencode($keyword) ?>">Selanjutnya</a> 
                <a href="?halaman=<?= $jumlah_halaman ?>&keyword=<?= urlencode($keyword) ?>">--LAST-></a>
            <?php endif ?> <br> <br>

            <!-- proses menampilkan data -->
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                </tr>

                <?php 
                    $i = $awal_data + 1 ;
                    foreach( $rows as $row ): 
                ?>
                    <tr>
                        <td> <?= $i ?> </td>
                        <td>
                            <a href="ubah.php?id=<?= $row["id"] ?>">Ubah</a> <br>
                            <a href="index.php?id=<?= $row["id"] ?>" onclick="return confirm('Yakin ?')">Hapus</a>
                        </td>
                        <td> 
                            <img src="aset/<?= $row["gambar"] ?>" alt="foto siswa" width="150px"> 
                        </td>                    
                        <td> <?= $row["nama"] ?> </td>
                        <td> <?= $row['nisn'] ?> </td>
                        <td> <?= $row['semester'] ?> </td>
                        <td> <?= $row['jurusan'] ?></td>
                    </tr>
                <?php 
                    $i++;
                    endforeach
                ?>
            </table>
        </div>
    </body>
</html>
