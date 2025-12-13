<?php
$nim = '';
$nama = '';
$jk = '';
$alamat = '';
$prodi = '';
$pesan_error = '';


if(isset($_POST['simpan'])){
   
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jk = isset($_POST['jk']) ? $_POST['jk'] : ''; 
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];


    if (empty($nim) || empty($nama) || empty($jk) || empty($alamat) || empty($prodi)) {
        $pesan_error = "<div class='alert alert-danger'>Semua kolom wajib diisi.</div>";
    } else {
        require_once "./config.php"; 

        $waktu = date("Y-m-d H:i:s");
        $sql = "insert into mhs set nim='$nim',nama='$nama',gender='$jk',
        alamat='$alamat',prodi='$prodi',waktu='$waktu'";
        $data = $konek->query($sql);
        
        if($data){
            echo"<div class='alert alert-success'>Data berhasil disimpan.<br>
            <a href='./?p=mahasiswa'>Lihat Data</a></div>";
          
            $nim = $nama = $jk = $alamat = $prodi = ''; 
        } else {
            $pesan_error = "<div class='alert alert-danger'>Gagal menyimpan data: " . $konek->error . "</div>";
        }
    }
}
?>

<main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"><h3 class="mb-0">Tambah Mahasiswa</h3></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
            </ol>
          </div>
          </div>
        </div>
      </div>
    <div class="app-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
                </div>
            <div class="card mt-4">
              <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-tool"
                    data-lte-toggle="card-remove"
                    title="Remove"
                  >
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
                </div>
              <div class="card-body"> 
                <?php echo $pesan_error;  ?>
                <form method="post" action="#">
                  <table>
                    <tr>
                        <td>NIM</td>
                        <td><input type="number" name="nim" class="form-control" value="<?= $nim ?>"></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td><input type="text" name="nama" class="form-control" value="<?= $nama ?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <input type="radio" name="jk" value="L" id="jkL" <?php if ($jk=="L") echo "checked"; ?>>
                            <label for="jkL">Laki-laki</label>
                            <input type="radio" name="jk" value="P" id="jkP" <?php if ($jk=="P") echo "checked"; ?>>
                            <label for="jkP">Perempuan</label>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Alamat</td>
                        <td>
                            <textarea name="alamat" class="form-control" style="width:300px"><?= $alamat ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>
                            <select class="form-control" name="prodi">
                                <option value=""></option>
                                <option value="1" <?php if ($prodi=="1") echo "selected"; ?>>Informatika</option>
                                <option value="2" <?php if ($prodi=="2") echo "selected"; ?>>Arsitektur</option>
                                <option value="3" <?php if ($prodi=="3") echo "selected"; ?>>Ilmu Lingkungan</option>
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td></td> 
                        <td><input type="submit" name="simpan" value="Simpan" class="btn btn-primary"></td>
                    </tr>
                  </table>
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
