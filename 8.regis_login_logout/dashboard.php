<?php
    // memangil file yang di pilih agar berfungsi disini
    require "query.php";

    // memastikam user login terlebih dahulu
    if( !isset($_SESSION["login"]) ){
        header("Location: index.php");
        exit;
    }

    // Logika untuk menghapus session dan cookie ketika logout
    if (isset($_POST["logout"])) {
        logout();
    }

    // mengambil data user yang masuk
    if( isset($_SESSION["id"]) ){
        $id = $_SESSION["id"];

        // mengmbil semua data user yang masuk
        $data = query("SELECT * FROM users WHERE id = $id");

        // memisahkan data user
        $nama = $data["nama"];
        $username = $data["username"];
        $email = $data["email"];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
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
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .dashboard-container {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                width: 400px;
                text-align: center;
            }

            h1 {
                margin-bottom: 20px;
                color: #333;
            }

            table {
                width: 100%;
                margin-bottom: 20px;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid #ccc;
                padding: 10px;
            }

            th {
                background-color: #f7f7f7;
                color: #333;
            }

            button {
                padding: 10px 20px;
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

            .logout-btn {
                margin-top: 20px;
            }

            @media (max-width: 600px) {
                .dashboard-container {
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
        <div class="dashboard-container">
            <h1>SELAMAT DATANG, <?= $nama ?></h1>

            <!-- Menampilkan informasi pengguna -->
            <table>
                <tr>
                    <th>Nama</th>
                    <td><?= $nama ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= $username ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $email ?></td>
                </tr>
            </table>

            <form action="" method="post" class="logout-btn">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </body>
</html>
