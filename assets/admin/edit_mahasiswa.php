<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Mahasiswa</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Mahasiswa</li>
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
                            <div class="row">
                                <div class="col-md-3">
                                    <form method="post" action="#">
                                        <?php
                                        require_once "./config.php";
                                        $xid=$_GET['id'];

                                        
                                        if(isset($_POST['simpan'])){
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
                                            
                                            
                                            $vjkL = ""; 
                                            $vjkP = "";
                                            $inf = "";
                                            $ars = "";
                                            $ilk = "";
                                            
                                            
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
                                </div>
                            </div>
                        <div class="card-footer">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
