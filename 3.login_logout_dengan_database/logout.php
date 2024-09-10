<?php 
    session_start(); 

    // menghapus riwayat penggunaan sesion
    session_unset();
    session_destroy(); 

    // kembali ke halaman login
    header("Location: index.php"); 
?>