<?php
    session_start();

    // memastika bawaha sesion nama ada isinya
    if (!isset($_SESSION['nama'])) {

        // jika tidak ada isinya maka akan dikembalikan ke halam login
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
    </head>
    <body>
        <h2>Selamat datang, <?php echo $_SESSION['nama']; ?>!</h2>
        <p><a href="logout.php">Logout</a></p>
    </body>
</html>
