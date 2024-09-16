<?php
    // memanggil isi suatu dokumen/file
    require "query.php";

    // memindakan input id ke variabel
    $id = $_GET["id"];

    // mengambil data siswa yang sesuai dengan id yang diinput
    $siswa = query("SELECT * FROM siswa WHERE id = '$id'")[0];
 
    // proses mengganti data jika tombol sudah ditekan
    if( isset($_POST["submit"]) ){
        echo ubah($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Data Siswa</title>
        <style>
            /* Gaya dasar untuk body */
            body {
                font-family: Arial, sans-serif;
                background-color: #DCDCDC;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }

            /* Gaya untuk kontainer utama */
            .container {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                max-width: 600px;
                width: 100%;
            }
            h1 {
                text-align: center;
                background-color:  #A9A9A9;
                padding: 10px;
                border-radius: 5px;
                color: black;
                margin-bottom: 20px;
            }
            ul {
                list-style-type: none;
                padding: 0;
            }
            li {
                margin-bottom: 15px;
            }
            label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="number"],
            input[type="file"] {
                width: 100%;
                padding: 10px;
                border-radius: 4px;
                border: 1px solid #D3D3D3;
                box-sizing: border-box;
            }

            img {
                max-width: 150px;
                border-radius: 8px;
            }

            button, input[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: #696969;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover, input[type="submit"]:hover {
                background-color: #222;
            }

            /* Responsif untuk layar kecil */
            @media (max-width: 600px) {
                .container {
                    padding: 15px;
                }

                button, input[type="submit"] {
                    padding: 12px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Mengubah Data Siswa Baru</h1>

            <ul>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $siswa["id"] ?>">
                    <input type="hidden" name="gambarlama" value="<?= $siswa["gambar"] ?>">
                    
                    <li>
                        <label for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" value="<?= $siswa["nama"] ?>" required>
                    </li>

                    <li>
                        <label for="nisn">NISN Siswa</label>
                        <input type="number" name="nisn" id="nisn" value="<?= $siswa["nisn"] ?>" required>
                    </li>

                    <li>
                        <label for="semester">Semester Siswa</label>
                        <input type="number" name="semester" id="semester" value="<?= $siswa["semester"] ?>" required>
                    </li>

                    <li>
                        <label for="jurusan">Jurusan Siswa</label>
                        <input type="text" name="jurusan" id="jurusan" value="<?= $siswa["jurusan"] ?>" required>
                    </li>

                    <li>
                        <label for="gambar">Foto Siswa</label> <br>
                        <img src="aset/<?= $siswa['gambar'] ?>" alt="foto siswa">
                        <input type="file" name="gambar" id="gambar">
                    </li>

                    <li>
                        <button type="submit" name="submit">Ubah Data</button>
                    </li>
                </form>

                <li>
                    <form action="index.php">
                        <input type="submit" value="Kembali">
                    </form>
                </li>
            </ul>
        </div>
    </body>
</html>