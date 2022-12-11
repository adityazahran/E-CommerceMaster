<div class="col-lg-12 grid-margin stretch-card">
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>ID order</td>
                            <th>tanggal</td>
                            <th>jam</td>
                            <th>id pelanggan</td>
                            <th>deskripsi</td>
                            <th>status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from `$tblorder`  order by `id_order` desc";
                        $jum = getJum($conn, $sql);
                        if ($jum > 0) {
                          //--------------------------------------------------------------------------------------------
                          $batas   = 10;
                          $page = 1;
                          if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                          }
                          if (empty($page)) {
                            $posawal  = 0;
                            $page = 1;
                          } else {
                            $posawal = ($page - 1) * $batas;
                          }
                
                          $sql2 = $sql . " LIMIT $posawal,$batas";
                          $no = $posawal + 1;
                          //--------------------------------------------------------------------------------------------									
                          $arr = getData($conn, $sql2);
                          foreach ($arr as $d) {
                            $id_order = $d["id_order"];
                            $id_order = ucwords($d["id_order"]);
                            $tanggal = $d["tanggal"];
                            $jam = $d["jam"];
                            $id_pelanggan = $d["id_pelanggan"];
                            $deskripsi = $d["deskripsi"];
                            $status = $d["status"];
                            echo "<tr>
                        <td>$no</td>
                        <td>$tanggal</td>
                        <td>$id_pelanggan </td>
                        <td>$jam</td>
                        <td>$deskripsi</td>
                        <td>$status</td>
                        <td><div align='center'>
                <a href='?mnu=order&pro=ubah&kode=$id_order&id=$tanggal'><img src='ypathicon/ub.png' title='ubah'></a>
                <a href='?mnu=order&pro=hapus&kode=$id_order&id=$tanggal'><img src='ypathicon/ha.png' title='hapus' 
                onClick='return confirm(\"Apakah Anda benar-benar akan menghapus \"$id_order\" pada data order ?..\")'></a></div></td>
                        </tr>";
                            $no++;
                          } //for dalam
                        } //if
                        else {
                          echo "<tr><td colspan='6'><blink>Maaf, Data order belum tersedia...</blink></td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>