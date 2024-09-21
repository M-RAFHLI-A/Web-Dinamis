<?php
    // memangil file yang di pilih agar berfungsi disini
    require "query.php";

    // jika user telah login, meastikan user telah logout terlebih dahulu
    if( isset($_SESSION["login"]) ){
        header("Location: dashboard.php");
        exit;
    }

    // program dan logika mengecek cookie yang ada pada halaman
    if( isset($_COOKIE["id"]) && isset($_COOKIE["data"]) ){
        cek_cookie($_COOKIE["id"], $_COOKIE["data"]);
    }

    // proses dan logika untuk user login saat tombol dipencet
    if ( isset($_POST["login"]) ){
        $error = login($_POST);      
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Halaman Login</title>
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

            .login-container {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                width: 450px;
            }

            li {
                display: flex;
                align-items: center;
            }

            input[type="checkbox"] {
                margin-right: 5px;
                width: auto; /* Supaya tidak memenuhi lebar */
            }

            label[for="remember"] {
                margin: 0; /* Menghilangkan margin ekstra */
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
            }

            @media (max-width: 600px) {
                .login-container {
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
        <div class="login-container">
            <h1>Halaman Login</h1>

            <?php if( isset($error) ): ?>
                <p class="error-message">Username atau Password SALAH</p>
            <?php endif ?>

            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="username">Username: </label>
                        <input type="text" name="username" id="username" required>
                    </li>

                    <li>
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" required>
                    </li>
                    <li>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </li>
                    <li>
                        <button type="submit" name="login">Login</button>
                    </li>
                </ul>
            </form>

            <div class="other-buttons">
                <form action="/pc1/2.php/indexphp.html">
                    <button type="submit">Kembali</button>
                </form>

                <form action="registrasi.php">
                    <button type="submit">Registrasi</button>
                </form>
            </div>
        </div>
    </body>
</html>
