<?php
// index_login.php
session_start(); 
require_once "config.php"; // Pastikan file ini ada dan berisi koneksi DB

$pesan_login = ''; 
$pesan_tipe = 'alert-info'; // Default tipe alert

// 1. Pengecekan Awal: Jika sudah login, paksa masuk ke Dashboard Index.php
// Logika ini yang mencegah user melihat form login berulang kali.
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if(isset ($_POST['btnlogin'])){
    $user = $_POST['user'] ?? '';
    // PENTING: Jika password di database tidak di-hash (raw text) gunakan:
    $pass = $_POST['password'] ?? ''; 

    // Cek Koneksi dan Input
    if (!isset($konek)) {
        $pesan_login = "Koneksi database gagal!";
        $pesan_tipe = 'alert-danger';
    } elseif (empty($user) || empty($pass)) {
        $pesan_login = "Silahkan masukkan Username dan Password!";
        $pesan_tipe = 'alert-danger';
    } else {
        // MENGGUNAKAN PREPARED STATEMENT UNTUK KEAMANAN
        // Asumsi struktur tabel: users (username, password, level)
        $stmt = $konek->prepare("SELECT level FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $user, $pass); 
        $stmt->execute();
        $hasil = $stmt->get_result();
        $ada = $hasil->num_rows;
        $stmt->close(); 

        if($ada > 0){
            $data = $hasil->fetch_assoc();
            
            // SET Sesi
            $_SESSION['user'] = $user;
            $_SESSION['level'] = $data['level']; 
            
            // LOGIKA REDIRECT FINAL: SEMUA LEVEL MASUK KE index.php
            $location = "index.php"; 
            
            header("Location: " . $location);
            exit(); 

        } else {
            // Login Gagal
            $pesan_login = "Username atau Password salah!";
            $pesan_tipe = 'alert-danger';
        }
    }
}
// Catatan: Jika pesan_login tidak kosong, tag HTML-nya akan dibuat di bagian body.
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LOGIN SIAKAD</title>

    <link rel="stylesheet" href="assets/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    </head>
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a
                    href="index.php"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
                >
                    <h1 class="mb-0"><b>SIAKAD</b></h1>
                </a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Selamat Datang, Silahkan Sign in</p>

                <?php 
                // Tampilkan pesan error/notifikasi jika ada
                if ($pesan_login): ?>
                    <div class="alert <?php echo $pesan_tipe; ?>" role="alert">
                        <?php echo htmlspecialchars($pesan_login); ?>
                    </div>
                <?php endif; ?>
                
                <form action="index_login.php" method="post"> 
                    <div class="input-group mb-3"> 
                        <div class="form-floating">
                            <input id="loginUser" type="text" name="user" class="form-control" placeholder="Username" required /> 
                            <label for="loginUser">Username</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                    </div>
                    
                    <div class="input-group mb-3"> 
                        <div class="form-floating">
                            <input id="loginPassword" type="password" name="password" class="form-control" placeholder="Password" required />
                            <label for="loginPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary" value="Sign In" name="btnlogin"/> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.js"></script>
    
</body>
</html>