<?php

$konek = new mysqli("localhost", "root", "", "siakaddb");

// Jika koneksi GAGAL ($konek->connect_error bernilai TRUE)
if ($konek->connect_error) {
    // Hentikan script dan tampilkan pesan error koneksi
    die("Koneksi database gagal: " . $konek->connect_error);
}


?>