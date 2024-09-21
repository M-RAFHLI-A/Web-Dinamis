<?php
    // memangil file yang di pilih agar berfungsi disini
    require "query.php";

    // memastikan apakah tombol registrasi sudah di tekan
    if( isset($_POST["registrasi"]) ){
        $hasil = registrasi($_POST);
    }
    
    // proses menghapus session dan cookie serta memindahkan user ke page login
    if( isset($_POST["login"]) ) {
        logout();     
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registrasi</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }

            body {
                background-color: #A9A9A9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }

            .register-container {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                width: 350px;
            }

            form ul {
                list-style-type: none;
            }

            form ul li {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
            }

            input[type="text"], 
            input[type="password"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            button {
                width: 100%;
                padding: 10px;
                background-color: #5cb85c;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #4cae4c;
            }

            .error-message {
                color: red;
                text-align: center;
                margin-bottom: 15px;
            }

            .other-buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 10px;
            }

            @media (max-width: 600px) {
                .register-container {
                    width: 100%;
                    padding: 15px;
                    box-shadow: none;
                }

                button {
                    font-size: 14px;
                }
            }
        </style>
    </head>

    <body>
        <div class="register-container">
            <h1>Halaman Registrasi</h1>

            <?php
                if( isset($hasil) ){
                    echo '<p class="error-message">'.$hasil.'</p>';
                }
            ?>

            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="nama">Masukan Nama: </label>
                        <input type="text" name="nama" id="nama" required>
                    </li>
                    <li>
                        <label for="email">Masukan E-mail: </label>
                        <input type="text" name="email" id="email" required>
                    </li>
                    <li>
                        <label for="username">Masukan Username: </label>
                        <input type="text" name="username" id="username" required>
                    </li>
                    <li>
                        <label for="password">Masukan Password: </label>
                        <input type="password" name="password" id="password" required>
                    </li>
                    <li>
                        <label for="password_cek">Konfirmasi Password: </label>
                        <input type="password" name="password_cek" id="password_cek" required>
                    </li>
                    <li>
                        <button type="submit" name="registrasi">Registrasi</button>
                    </li>
                </ul>
            </form>

            <div class="other-buttons">
                <form action="" method="post">
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
