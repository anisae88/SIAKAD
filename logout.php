<?php
// logout.php
session_start();
session_destroy(); // Hapus semua data sesi
header("Location: index_login.php"); // Alihkan ke halaman login
exit();
?>