<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cari Mahasiswa</title>
        <style>
            body {
                font-family: Arial;
                background-color: #fff;
                margin: 25px;
            }
            .container {
                padding: 20px;
                background: #fff;
                box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
                border-radius: 8px;
            }
            header{
                padding: 5px;
                background: #909090;
                border-radius: 8px 8px 0 0;
            }
            form {
                padding-top: 20px;
            }         
            .tempat-input{
                display: flex;
                padding-bottom: 20px;
            }
            .input{
                flex: 1;
            }
            .input:last-child{
                margin-left: 10px;
            }
            select{
                width: 100%;
                padding: 8px;
                margin-top: 10px;
                margin-bottom: 2px;
                border: 1px solid #ccc;
                border-radius: 50px;
            }
            input[type="submit"] {
                width: 100%;
                padding: 8px;
                background: #909090;
                border: 0;
                border-radius: 5px;
                font-size: 18px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- Tampilan header dari website -->
            <header>
                <table align="center" border="0" cellpadding="5">
                    <td>
                        <img src="foto.png" alt="" width="80px" >
                    </td>
                    <td>
                        <h1> From Cari Nama Mahasiswa</h1>
                    </td>                
                </table>
            </header>
            
            <!-- Tampilan input dari website -->
            <Form action="proses_login.php" method="POST">
                <div class="tempat-input">
                    <div class="input">
                        <label for="prodi">Prodi Mahasiswa: </label>
                        <select name="prodi" id="prodi">
                            <option value="Akuntansi">Prodi Akuntansi</option>
                            <option value="Informatika">Prodi Teknik Informatika</option>
                            <option value="Elektro">Prodi Teknik Elektro</option>
                        </select>
                    </div>

                    <div class="input">
                        <label for="absen">Nomor Absen Mahasiswa : </label>
                        <select name="absen" id="absen">
                            <option value="1">No 1</option>
                            <option value="2">No 2</option>
                            <option value="3">No 3</option>
                            <option value="4">No 4</option>
                            <option value="5">No 5</option>
                            <option value="6">No 6</option>
                        </select>
                    </div>
                </div>
                
                <input type="submit" value="Cari Mahasiswa"> 
            </Form>
            
            <!-- Menampilhan halaman yang terdapat pada halaman welcome.php -->
            <?php include("welcome.php"); ?>  
        </div>
    </body>
</html>