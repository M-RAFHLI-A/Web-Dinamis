<?php
    //cek tombol submit apakah sudah di pencet
    if( isset($_POST["submit"]) ) {
        //cek username dan password
        if( $_POST["username"]=="admin" && $_POST["password"]=="123" ) {
            //hasil jika benar, masuk ke halaman admin
            header("Location: admin.php");
            exit;
        }else {
            //hasil jika salah, mengisi variabel error dengan pesan
            $error = true;
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Admin</title>
    </head>

    <body>
        <h1>Login Admin</h1>

        <?php if( isset($error) ) : ?>
            <p style="color: red; font-style: italic; font-style: bold;">
                Username atau Password nya salah
            </p>
        <?php endif ?>

        <ul>
            <form action="login.php" method="POST">
                <li>
                    <label for="username">Username :</label>
                    <input type="text" id="username" name="username">
                </li>

                <li>
                    <label for="password">password :</label>
                    <input type="password" id="password" name="password">
                </li>

                <button type="submit" name="submit">Login</button>
            </form>
        </ul>



        <form action="/pc1/2.php/indexphp.html">
			<input type="submit" value="Kembali">
		</form>
    </body>
</html>