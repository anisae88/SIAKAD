<?php
require_once "./config.php";

$keyword_dosen = isset($_POST['keyword_dosen']) ? $_POST['keyword_dosen'] : '';
$category_dosen = isset($_POST['category_dosen']) ? $_POST['category_dosen'] : '';

if(empty($keyword_dosen)){
    
    $data_dosen = $konek->query("SELECT * FROM dosen order by nidn limit 5");
} else {
   
    $query_dosen = "SELECT * FROM dosen";
    if($category_dosen==1){
      $query_dosen .= " where nidn like '%$keyword_dosen%'";
    }elseif($category_dosen==2){
      $query_dosen .= " where nama like '%$keyword_dosen%'";
    }elseif($category_dosen==3){
      $query_dosen .= " where gender like '%$keyword_dosen%'";
    }elseif($category_dosen==4){
        $keyword2 = 0;
        if(strtoupper($keyword_dosen)=="INF") $keyword2=1;
        elseif(strtoupper($keyword_dosen)=="ARS") $keyword2=2;
        elseif(strtoupper($keyword_dosen)=="ILK") $keyword2=3;
        
        if ($keyword2 != 0) {
            $query_dosen .= " where bidang like '%$keyword2%'";
        } else {
            
             $query_dosen .= " where 1=0"; 
        }
    }
    $data_dosen = $konek->query($query_dosen);
}

$keyword_mhs = isset($_POST['keyword_mhs']) ? $_POST['keyword_mhs'] : '';
$category_mhs = isset($_POST['category_mhs']) ? $_POST['category_mhs'] : '';

if(empty($keyword_mhs)){
    
    $data_mhs = $konek->query("SELECT * FROM mhs order by nim limit 5");
} else {
  
    $query_mhs = "SELECT * FROM mhs";
    if($category_mhs==1){
      $query_mhs .= " where nim like '%$keyword_mhs%'";
    }elseif($category_mhs==2){
      $query_mhs .= " where nama like '%$keyword_mhs%'";
    }elseif($category_mhs==3){
      $query_mhs .= " where gender like '%$keyword_mhs%'";
    }elseif($category_mhs==4){
        $keyword2 = 0;
        if(strtoupper($keyword_mhs)=="INF") $keyword2=1;
        elseif(strtoupper($keyword_mhs)=="ARS") $keyword2=2;
        elseif(strtoupper($keyword_mhs)=="ILK") $keyword2=3;
        
        if ($keyword2 != 0) {
            $query_mhs .= " where prodi like '%$keyword2%'";
        } else {
             
             $query_mhs .= " where 1=0"; 
        }
    }
    $data_mhs = $konek->query($query_mhs);
}


function getBidangName($kode, $type='bidang') {
    $nama = "";
    $kolom = ($type == 'bidang') ? 'bidang' : 'prodi';

    if($kode == 1) {
        $nama = "Teknik Informatika";
    } else if ($kode == 2) {
        $nama = "Arsitektur";
    } else if ($kode == 3) {
        $nama = "Ilmu Lingkungan";
    } else {
        $nama = "-";
    }
    return $nama;
}
?>

<main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"><h3 class="mb-0">dashboard admin</h3></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">dashboard admin</li>
            </ol>
          </div>
          </div>
        </div>
      </div>
    <div class="app-content">
      <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Data Dosen </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Bidang Keahlian</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no_dosen = 1; 
                            if ($data_dosen->num_rows > 0) { 
                                while ($row = $data_dosen->fetch_assoc()) { 
                                    $bidang = getBidangName($row['bidang'], 'bidang'); 
                                    echo "<tr>
                                            <td>{$no_dosen}</td>
                                            <td>".htmlspecialchars($row['nidn'])."</td>
                                            <td>".htmlspecialchars($row['nama'])."</td>
                                            <td>".htmlspecialchars($row['gender'])."</td>
                                            <td>".htmlspecialchars($bidang)."</td>
                                            <td>
                                                <a href='?p=detail_dosen&id={$row['id']}' class='btn btn-success btn-sm'>Detail</a>
                                                <a href='?p=edit_dosen&id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='?p=hapus_dosen&id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus?')\">Hapus</a>
                                            </td>
                                        </tr>"; 
                                    $no_dosen++;
                                }
                            } else {
                                echo "<tr><td colspan='6'>Data Dosen tidak ditemukan.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <a href="./?p=data_dosen" class="btn btn-secondary mt-3">Lihat Semua Data Dosen >></a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                   <div class="card-header bg-success text-white">
                        <h3 class="card-title">Data Mahasiswa </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Prodi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no_mhs = 1; 
                            if ($data_mhs->num_rows > 0) { 
                                while ($row = $data_mhs->fetch_assoc()) { 
                                    $prodi = getBidangName($row['prodi'], 'prodi'); 
                                    echo "<tr>
                                            <td>{$no_mhs}</td>
                                            <td>".htmlspecialchars($row['nim'])."</td>
                                            <td>".htmlspecialchars($row['nama'])."</td>
                                            <td>".htmlspecialchars($row['gender'])."</td>
                                            <td>".htmlspecialchars($prodi)."</td>
                                            <td>
                                                <a href='./?p=detail_mahasiswa&id={$row['id']}' class='btn btn-sm btn-success'>Detail</a>
                                                <a href='./?p=edit_mahasiswa&id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a> 
                                                <a href='./?p=hapus_mahasiswa&id={$row['id']}' class='btn btn-sm btn-danger'>Hapus</a>
                                            </td>
                                        </tr>"; 
                                    $no_mhs++;
                                }
                            } else {
                                echo "<tr><td colspan='6'>Data Mahasiswa tidak ditemukan.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <a href="./?p=data_mahasiswa" class="btn btn-secondary mt-3">Lihat Semua Data Mahasiswa >></a>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
      </div>
    </main>
