<?php
    // mengaktifkan session
    session_start();
    
    // proses persiapan koneksi ke database MySQL
    $conn = mysqli_connect("localhost", "root", "", "login");

    // membuat fungsi untuk mengambil isi database nya
    function query($sql){
        global $conn;

        // proses masuk ke database
        $result = mysqli_query($conn, $sql);

        // inisialisasi array kosong untuk menghindari error jika tidak ada data
        $rows = [];

        // proses memindahkan isi database jika ada data yang ditemukan
        if ($result->num_rows > 0) {
            $rows = mysqli_fetch_assoc($result);
        }
        
        // mengakhiri fungsi dengan mengembalikan hasil prosesnya kedalam fungsi
        return $rows;
    }

    function registrasi($daftar){
        global $conn;

        // memindahkan input ke dalam variabel yang disediakan
        $nama = htmlspecialchars($daftar["nama"]);
        $email = htmlspecialchars($daftar["email"]);
        $username = htmlspecialchars($daftar["username"]);
        $password = mysqli_real_escape_string($conn, $daftar["password"]);
        $password_cek = mysqli_real_escape_string($conn, $daftar["password_cek"]);

        // memastikan apakah username yang di-input sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        if ( mysqli_fetch_assoc($result) ){
            echo "
                <script>
                    alert('Username Yang Diinput Sudah Terdaftar');
                </script>
            ";
            return false;
        }

        // memasdikan password dengan konvirmasi-nya
        if( $password !== $password_cek ){
            echo "
                <script>
                    alert('Konfirmasi Possword Tidak Sesuai !!!');
                </script>
            ";
            return false;
        }

        // proses enskripsi possword
        $password = password_hash($password, PASSWORD_DEFAULT);

        // proses memasukan data ke database
        query("INSERT INTO users VALUES ('', '$nama', '$username', '$password', '$email')");

        // kondisi pesan yang dibuat berdasarkan hasil dari proses
        if( mysqli_affected_rows($conn) > 0 ){
            
            // proses menghapus session untuk login kembali
            session_unset();
            session_destroy();

            // membuat pesan jika data berhasil di masukkan
            $hasil = "
                <script>
                    alert('Registrasi Berhasil Dilakukan');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {

            // memanpilakn error yang terjadi
            $hasil = "Registrasi GAGAL Dilakukan, karena " . mysqli_error($conn);
        }

        // mengembalikan fungsi dengan pesan dari hasil proses
        return $hasil; 
    }

    function login($login){

        // memindahkan isi variabel super global ke variabel lokal 
        $username = $login["username"];
        $password = $login["password"];

        // mencari data yang cocok di database dengan username yang di input
        if( isset($username) ){
            $row = query("SELECT * FROM users WHERE username = '$username'");
        }

        // proses memastikan password yang di input cocok dengan database
        if( isset($password, $row) ){

            // memproses dan memastikan password yang di input cocok dengan database
            password_verify($password, $row["password"]);
        
            // mengisi nilai variabel $_SESSION dengan nilai TRUE dan yang ada di database
            $_SESSION["login"] = TRUE;
            $_SESSION["id"] = $row["id"];

            // cek remember me
            if( isset($_POST["remember"]) ){

                // proses membuat cookie untuk name "id" yang bertahan 60 detik
                setcookie("id", $row["Id"], time()+60);

                // proses membuat cookie untuk name "data" yang bertahan 60 detik
                setcookie("data", hash("sha256", $row["username"]), time()+60);
            }

            // memindahkan user ke halaman yang dituju
            header("Location: dashboard.php");

            // menghentikan proses dibawahnya
            exit;
        }
        
        return "SALAH";
    }

    function cek_cookie($id, $kunci){

        // proses mengambil data username dari database
        $row = query("SELECT * FROM users WHERE Id = '$id'");

        // cek cookie dari id dan data untuk mengaktifkan session
        if( $kunci === hash("sha256", $row["username"]) ){
            return $_SESSION["login"] = TRUE;
        }
    }

    // membuat fungsi logika kerika user ingin keluar
    function logout(){
        // proses menghapus session
        session_unset();
        session_destroy();

        // proses menghapus cookie
        setcookie("id", "", time()+3600);
        setcookie("data", "", time()+3600);

        // mengembalikan user ke menu login
        return header("Location: index.php");
    }
?>