<?php
    /*
        Sebelumnya siapkan database dengan nama "cekdata",
        dan siapkan tabelnya dengan nama "datanama"
        didalam tabel nya terdapat kolom 'id', 'username', 'password', dan 'nama'
    */
    session_start();
    
    // proses koneksi ke dalam database
    $host = "localhost"; 
    $user = "root"; 
    $pass = ""; 
    $db = "cekdata"; 
    $conn = new mysqli($host, $user, $pass, $db);
    
    // menampilkan pesan jika koneksi error
    if ($conn->connect_error) { 
        die("Koneksi gagal: " . $conn->connect_error); 
    } 

    // memindahkan isi variabel dari super global ke lokal
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buat query untuk mencocokkan username dan password
    $sql = "SELECT nama FROM datanama WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika data ditemukan, ambil nama pengguna dan simpan ke dalam session
        $row = $result->fetch_assoc();
        $_SESSION['nama'] = $row['nama'];

        header("Location: welcome.php");
    } else {
        // Jika tidak ditemukan, kembalikan ke halaman login
        echo "Login gagal. <a href='index.php'>Coba lagi</a>";
    }

    $conn->close();
?>
