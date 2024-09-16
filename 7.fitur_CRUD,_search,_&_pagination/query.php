<?php    
    /*
        Sebelumnya siapkan database dengan nama "kampus",
        dan siapkan tabelnya dengan nama "siswa"
    */
    // proses persiapan koneksi ke database MySQL
    $conn = mysqli_connect("localhost", "root", "", "kampus");

    // membuat fungsi untuk mengambil isi database nya
    function query($sql){
        global $conn;

        // proses masuk ke database
        $result = mysqli_query($conn, $sql);

        // inisialisasi array kosong untuk menghindari error jika tidak ada data
        $rows = [];

        // proses memindahkan isi database jika ada data yang ditemukan
        if ($result->num_rows > 0) {

            //jika ada isinya, maka datanya akan dipindahakan
            while( $wadah = mysqli_fetch_assoc($result) ){
                $rows[] = $wadah;
            }
        }
        
        // mengakhiri fungsi dengan mengembalikan hasil prosesnya kedalam fungsi
        return $rows;
    }
    
    // membuat fungsi untuk melakukan filter tampilan data
    function cari($cari) {
        // membuat kodisi sintaks SQL untuk Searching
        $sql = "SELECT * FROM siswa WHERE
    
            /* disini data akan tetap diambil walau jika ada potongan nta yang sesuai */
            nama LIKE '%$cari%' OR 
            nisn LIKE '%$cari%' OR 
            semester LIKE '%$cari%' OR
            jurusan LIKE '%$cari%'
        ";
    
        // memngembalikan nilai dari funsi query dengan isi variabel $sql kedalam fungsi cari
        return query($sql);
    }

    // membuat fungsi untuk meng-upload gambar
    function gambar(){
        // memindahkan data yang terdapat pada $_FILES
        $nama_F = $_FILES['gambar']['name']; 
        $ukuran_F = $_FILES['gambar']['size']; 
        $error_F = $_FILES['gambar']['error']; 
        $tempat_F = $_FILES['gambar']['tmp_name']; 

        // memastikan apakah gambar sudah di upload
        if( $error_F === 4 ){
            echo "
                <script>
                    alert('upload gambar terlebih dahulu');
                </script>
            ";
            return false;
        }

        // mempersiapkan ekstension yang bisa untuk di olah
        $ekstension_gambar_valid = ['jpg', 'jpeg', 'png'];

        // memecah nama foto kedalam string dengan parameter titik "."
        $ekstension_gambar = explode('.', $nama_F);

        // mengganti isi vaiavel dengan value array yang terakhir dan semua huruf dibuat kecil
        $ekstension_gambar = strtolower( end( $ekstension_gambar ) );
        
        // memastikan yang di upload itu adalah gambar dari ekstension nya, bukan file yang lain
        if( !in_array($ekstension_gambar, $ekstension_gambar_valid) ){
            echo "
                <script>
                    alert('yang anda upload bukan gambar');
                </script>
            ";
            return false;
        }

        // memastikan ukuran gambar yang dikirim tidak terlalu besar
        if( $ukuran_F > 10000000){
            echo "
                <script>
                    alert('gambar yang anda upload terlalu besar <br> ukuran lebih dari 10 MB');
                </script>
            ";
            return false;
        }

        // mempersiapkan nama unik untuk setiap foto 
        $nama_F_U = uniqid() . "-" . $nama_F; 

        // setelah lolos dari pengecekan diatas, maka file nya akan disimpan
        move_uploaded_file( $tempat_F, 'aset/' . $nama_F_U );

        // mengembalikan nama file baru nya agar nama file baru nya dimasukan ke database
        return $nama_F_U;
    }

    // membuat fungsi untuk menambahkan isi database nya
    function tambah($tambah){
        global $conn;

        // memindahkan input kedalam variabel agar mudah mengirimkannya
        $nama = htmlspecialchars($tambah["nama"]); 
        $nisn = htmlspecialchars($tambah["nisn"]); 
        $semester = htmlspecialchars($tambah["semester"]);
        $jurusan = htmlspecialchars($tambah["jurusan"]);
        
        // meastikan kondisi dan mengolah gambar yang diupload
        $gambar = gambar();
        if( !$gambar ){
            return false;
        }

        // persiapan untuk proses mengirimkan input ke database nya
        $sql = "INSERT INTO siswa VALUES
            ('', '$gambar', '$nama', '$nisn', '$semester', '$jurusan')
        ";

        // proses mengirimkan input ke database nya
        mysqli_query($conn, $sql);

        // kondisi pesan yang dibuat berdasarkan hasil dari proses
        if( mysqli_affected_rows($conn) > 0 ){
            $hasil = "
                <script>
                    alert('Data Berhasil Ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            $hasil = "
                <script>
                    alert('Data GAGAL Ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        }

        // mengembalikan fungsi dengan pesan dari hasil proses
        return $hasil;
    }
    
    // membuat fungsi untuk mengubah salah satu isi database
    function ubah($ubah){
        global $conn;

        // memindahkan input kedalam variabel agar mudah mengirimkannya
        $id = $ubah["id"];
        $nama = htmlspecialchars($ubah["nama"]); 
        $nisn = htmlspecialchars($ubah["nisn"]);
        $semester = htmlspecialchars($ubah["semester"]);
        $jurusan = htmlspecialchars($ubah["jurusan"]); 
        $gambarlama = htmlspecialchars($ubah["gambarlama"]);

        // memastikan apakah user memasukan gambar baru
        if( $_FILES['gambar']['error'] === 4 ){
            $gambar = $gambarlama;
        } else {
            $gambar = gambar();
        }

        // persiapan untuk proses melakukan update ke database nya
        $sql = "UPDATE siswa SET
            gambar = '$gambar', nama = '$nama', nisn = '$nisn', semester = '$semester', jurusan = '$jurusan'
            WHERE id = '$id'
        ";

        // proses mengirimkan input ke database nya
        mysqli_query($conn, $sql);

        // kondisi pesan yang dibuat berdasarkan hasil dari proses
        if( mysqli_affected_rows($conn) > 0 ){
            $hasil = "
                <script>
                    alert('Data Berhasil Diubahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            $hasil = "
                <script>
                    alert('Data GAGAL Diubahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        }   
        
        // mengembalikan fungsi dengan pesan dari hasil proses
        return $hasil; 
    }

    // membuat fungsi untuk menghapus isi database nya
    function hapus($id){
        global $conn;

        // proses menghapus data berdasarkan id yang ada di database nya
        mysqli_query($conn, "DELETE FROM siswa WHERE id = '$id'");

        // kondisi pesan yang dibuat berdasarkan hasil dari proses
        if( mysqli_affected_rows($conn) > 0 ){
            $hasil = "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href = 'index.php';
                </script>
            ";
        } else{
            $hasil = "
                <script>
                    alert('Data GAGAL Dihapus');
                    document.location.href = 'index.php';
                </script>
            ";
        }

        // mengembalikan fungsi dengan pesan dari hasil proses
        return $hasil; 
    }

    // membuat fungsi untuk hubungan pagination dengan keyword
    function pag_key($keyword, $data_tampil, $awal_data, $kondisi){
        if($kondisi){

            // menghitung banyak data yamg akan tampil
            $jumlah_data = count(cari($keyword));

            // menentukan banyak halaman yang dibutuhkan
            $jumlah_halaman = ceil($jumlah_data / $data_tampil);

            // menyiapkan query SQL untuk proses pengambilan data ari database
            $rows = query("SELECT * FROM siswa WHERE 
                nama LIKE '%$keyword%' OR 
                nisn LIKE '%$keyword%' OR 
                semester LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                LIMIT $awal_data, $data_tampil"
            );
        } else{

            // menghitung banyak data yamg akan tampil
            $jumlah_data = count(query("SELECT * FROM siswa"));

            // menentukan banyak halaman yang dibutuhkan
            $jumlah_halaman = ceil($jumlah_data / $data_tampil);

            // menyiapkan query SQL untuk proses pengambilan data ari database
            $rows = query("SELECT * FROM siswa LIMIT $awal_data, $data_tampil");
        }

        // mengembalikan hasil nya dalam bentuk array
        return array($jumlah_halaman, $rows);
    }
?>
