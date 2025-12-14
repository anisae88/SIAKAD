<?php
$p = $_GET['p'] ?? '';

switch($p){
    case 'dosen':
        require_once "dosen.php";
        break;
    case 'mahasiswa':
        require_once "mahasiswa.php";
        break;
    case 'alumni':
        require_once "alumni.php";
        break;
    case 'ganti_passwoard':
        require_once "ganti_passwoard.php";
        break;
    case 'add_mahasiswa':
        require_once "add_mahasiswa.php";
        break;
    case 'add_dosen':
        require_once "add_dosen.php";
        break;
    case 'detail_mahasiswa':
        require_once "detail_mahasiswa.php";
        break;
    case 'detail_dosen':
        require_once "detail_dosen.php";
        break;
    case 'edit_mahasiswa':
        require_once "edit_mahasiswa.php";
        break;
    case 'edit_dosen':
        require_once "edit_dosen.php";
        break;
    case 'hapus_mahasiswa':
        require_once "hapus_mahasiswa.php";
        break;
    case 'hapus_dosen':
        require_once "hapus_dosen.php";
        break;
    default:
        require_once "dasboard.php";
        break;
    
}
?>
