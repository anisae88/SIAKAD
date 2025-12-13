<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-sm-6"><h3 class="mb-0">Edit Mahasiswa</h3></div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Mahasiswa</li>
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
                    <h3 class="card-title"></h3>
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
                      <!--begin::Col-->
                      <div class="col-md-3">
                        <form method="post" action="#">
                         <?php
                        require_once "./config.php";
                        $xid=$_GET['id'];

                        if($_POST['simpan']){
                            $nim=$_POST['nim'];
                            $nama=$_POST['nama'];
                            $alamat=$_POST['alamat'];
                            $jk=$_POST['jk'];
                            $prodi=$_POST['prodi'];
                            
                            $sql="update mhs set nim='$nim',nama='$nama',address='$alamat',gender='$jk',prodi='$prodi' where id='$xid'";
                            $a=$konek->query($sql);
                            if($a){
                                echo"<div class='alert alert-success'>Berhasil diedit!.
                                <a href='./?p=mahasiswa'>Lihat Data!</a></div>";
                            }
                        }
                        
                        $sql="select * from mhs where id='$xid'";
                        $data=$konek->query($sql);
                        foreach($data as $d){
                            switch($d['prodi']){
                                case '1': $prodi="Informatika"; break;
                                case '2': $prodi="Arsitektur"; break;
                                case '3': $prodi="Ilmu Lingkungan"; break;
                                default:$prodi="Tidak diketahui";break;
                            }
                            
                            if($d['gender']==="L"){
                                $vjkL="checked";
                            }else{
                                $vjkP="checked";
                            }
                            
                            if($d['prodi']=="1") $inf="selected";
                            if($d['prodi']=="2") $ars="selected";
                            if($d['prodi']=="3") $ilk="selected";
                            
                            echo "
                            <table class='table table-bordered table-hover table-striped'>
                            <tr><td>NIM</td><td>:</td><td><input type='number' value='$d[nim]' name='nim'></td></tr>
                            <tr><td>NAMA</td><td>:</td><td><input type='text' value='$d[nama]' name='nama'></td></tr>
                            <tr><td>Jenis Kelamin</td><td>:</td><td><input type='radio' name='jk' value='L' $vjkL> Laki-laki <input type='radio' name='jk' value='P' $vjkP> Perempuan
                            </td></tr>
                            <tr><td>Alamat</td><td>:</td><td><textarea name='alamat'>$d[address]</textarea></td></tr>
                            <tr><td>Prodi</td><td>:</td><td>
                            <select name='prodi'>
                            <option></option>
                            <option value='1' $inf>Informatika</option>
                            <option value='2' $ars>Arsitektur</option>
                            <option value='3' $ilk>Ilmu Lingkungan</option>
                            </select>
                            </td></tr>
                            <tr><td></td><td></td><td><input type='submit' value='Simpan' name='simpan'></td></tr>
                            </table>
                            ";
                        }
                         ?>
                         <a href="./?p=mahasiswa" class="btn btn-secondary"><< Back</a>
                        </form>
                       
                       
                    
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