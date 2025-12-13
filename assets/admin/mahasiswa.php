<?php
require_once "./config.php";
$keyword=$_POST['keyword'];
$category=$_POST['category'];
if(empty($keyword)){
  $n=0;
  $data=$konek->query("SELECT * FROM mhs order by nim limit 5");
}else{
  $n=0;
  if($category==1){
    $data=$konek->query("SELECT * FROM mhs where nim like '%$keyword%'");
  }elseif($category==2){
    $data=$konek->query("SELECT * FROM mhs where nama like '%$keyword%'");
  }elseif($category==3){
    $data=$konek->query("SELECT * FROM mhs where gender like '%$keyword%'");
  }elseif($category==4){
    if($keyword=="INF"){
      $keyword2=1;
    }elseif($keyword=="ARS"){
      $keyword2=2;
    }elseif($keyword=="ILK"){
      $keyword2=3;
    }
    $data=$konek->query("SELECT * FROM mhs where prodi like '%$keyword2%'");
  }
}
?>
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-sm-6"><h3 class="mb-0">Data Mahasiswa</h3></div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
                </ol>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-12">
                <!--begin::Card-->
                <div class="card">
                  <!--begin::Card Header-->
                 
                   
                  
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card mt-4">
                  <!--begin::Card Header-->
                  <div class="card-header">
                    <!--begin::Card Title-->
                    <h3 class="card-title">Data Mahasiswa</h3>
                    <!--end::Card Title-->
                    <!--begin::Card Toolbar-->
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
                    <!--end::Card Toolbar-->
                  </div>
                  <!--end::Card Header-->
                  <!--begin::Card Body-->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <table>
                        <tr><td><a href="./?p=add_mahasiswa" class="btn btn-success btn-sm">Add Student</a></td>
                        <td>
                        <form method="post" action="#">
                      <input type='text' name='keyword' placeholder='Keyword' class='form-control' 
                      style='width:300px; display:inline;' value="<?=$keyword;?>"/>
                      <select name='category'>
                        <option value='1' <?php if($category==1) echo"selected";?>>NIM</option>
                        <option value='2' <?php if($category==2) echo"selected";?>>Nama</option>
                        <option value='3' <?php if($category==3) echo"selected";?>>Gender</option>
                        <option value='4' <?php if($category==4) echo"selected";?>>Prodi</option>
                      </select>
                      <input type='reset' name='reset' value='Reset' class='btn btn-secondary btn-sm'/>
                      <input type='submit' value='Search' class='btn btn-primary btn-sm'/>
                      </form></td></tr></table>

                    
                      <table class="table table-striped table-hover">
                        <tr><th>No</th><th>NIM</th><th>Nama</th><th>Gender</th><th>Prodi</th></th><th>Option</th></tr>
                      <?php
                    foreach($data as $d){
                      $n++;
                      if($d['prodi']==1) {
                        $prodi="Teknik Informatika";
                      }else if ($d['prodi'] == 2) {
                        $prodi = "Arsitektur";
                      }
                      else if ($d['prodi'] == 3) {
                        $prodi = "Ilmu Lingkungan";
                      }
                      
                      else{
                        $prodi="-";
                      }
                      
                      echo "<tr><td>$n</td><td>$d[nim]</td><td>$d[nama]</td><td>$d[gender]</td><td>$prodi</td>
                      <td>
                      <a href='./?p=detail_mahasiswa&id=" . $d['id'] . "' class='btn btn-sm btn-success'>Detail</a>
                      <a href='./?p=edit_mahasiswa&id=" . $d['id'] . "' class='btn btn-sm btn-warning'>Edit</a> 
                      <a href='./?p=hapus_mahasiswa&id=" . $d['id'] . "' class='btn btn-sm btn-danger'>Hapus</a></td></tr>";
                    }
                      ?>
                      </table>

                  

                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>