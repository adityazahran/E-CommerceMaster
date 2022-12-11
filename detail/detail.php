<?php
$pro = "simpan";

$id_detail = "";
$id_order = "";
$id_produk = "";
$jumlah = "";
$harga = "";
$subtotal = "";
$catatan = "";
?>

<link type="text/css" href="<?php echo "$PATH/base/"; ?>ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo "$PATH/"; ?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/"; ?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/"; ?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/"; ?>ui/i18n/ui.datepicker-id.js"></script>

<script type="text/javascript">
	function PRINT(pk) {
		win = window.open('detail/detail_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>

<?php
if (isset($_GET["pro"]) && $_GET["pro"] == "ubah") {
	$id_detail = $_GET["kode"];
	$sql = "select * from `$tbldetail` where `id_detail`='$id_detail'";
	$d = getField($conn, $sql);
	$id_detail = $d["id_detail"];
	$id_detail0 = $d["id_detail"];
	$id_detail = $d["id_detail"];
	$id_order = $d["id_order"];
	$id_produk = $d["id_produk"];
	$jumlah = $d["jumlah"];
	$harga = $d["harga"];
	$subtotal = $d["subtotal"];
	$catatan = $d["catatan"];
	$pro = "ubah";
}
?>

<link rel="stylesheet" href="jsacordeon/jquery-ui.css">
<link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
<script src="jsacordeon/jquery-ui.js"></script>
<script>
	$(function() {
		$("#accordion").accordion({
			collapsible: true
		});
	});
</script>
<?php
	$id_order = $_GET["id"];
	$sql = "select * from `$tblorder` where `id_order`='$id_order'";
	$d = getField($conn, $sql);
	$id_order = $d["id_order"];
	$id_order0 = $d["id_order"];
	$deskripsi = $d["deskripsi"];
	$tanggal = WKT($d["tanggal"]);
	$jam = $d["jam"];
	$id_pelanggan = $d["id_pelanggan"];
	$nama = getPelanggan($conn,$d["id_pelanggan"]);
	$deskripsi = $d["deskripsi"];
	$status = $d["status"];
?>

<table class="table">
				<tr>
					<th width="70"><label for="id_order">ID order</label>
					<th width="9">:
					<th colspan="2"><b><?php echo $id_order; ?></b>
				</tr>
				<tr>
					<td height="24"><label for="deskripsi">Tanggal</label>
					<td>:
					<td><b><?php echo $tanggal; ?> - <?php echo $jam; ?></td>
				</tr>

				<tr>
					<td height="24"><label for="deskripsi">Pelanggan</label>
					<td>:
					<td><b><?php echo $nama; ?> - <?php echo $id_pelanggan; ?></td>
				</tr>
</table>

	<h3>Input Data detail</h3>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">
			<tr>
					<td height="24"><label for="">Produk</label>
					<td>:
					<td>
					<select class="form-control" name="id_produk">
					<?php  
					$sql="select * from `$tblproduk`";
						$arr=getData($conn,$sql);
							foreach($arr as $d) {						
									$id_produk0=$d["id_produk"];
									$nama_produk=ucwords($d["nama_produk"]);
						echo "<option value='$id_produk0'"; if($id_produk0==$id_produk){echo"selected";} echo">$nama_produk ($id_produk0)</option>";
									}
									?>
					</select>
					</td>
				</tr>

				<tr>
					<td height="24"><label for="jumlah">jumlah</label>
					<td>:
					<td><input required name="jumlah" class="form-control" type="number" id="jumlah" value="<?php echo $jumlah; ?>" size="25" />
					</td>
				</tr>

				<tr>
					<td height="24"><label for="harga">harga</label>
					<td>:
					<td><input required name="harga" class="form-control" type="harga" id="harga" value="<?php echo $harga; ?>" size="25" />
					</td>
								</tr>

				<tr>
					<td height="24"><label for="catatan">catatan</label>
					<td>:
					<td>
						<textarea name="catatan" class="form-control" cols="55" rows="2"><?php echo $catatan; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>
					<td>
					<td colspan="2">
						<input name="Simpan" class="btn btn-danger" type="submit" id="Simpan" value="Simpan" />
						<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
						<input name="id_order" type="hidden" id="id_order" value="<?php echo $id_order; ?>" />
						<input name="id_detail0" type="hidden" id="id_detail0" value="<?php echo $id_detail0; ?>" />
						<a href="?mnu=detail&id=<?php echo $id_order ?>"><input class="btn btn-primary" name="Batal" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>

		<h3>Data detail <?php echo $id_order ?>:</h3>
		<div class="col-lg-12 grid-margin stretch-card">
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>No</td>
                            <th>barang</td>
                            <th>id order</td>
                            <th>jumlah</td>
                            <th>harga</td>
                            <th>subtotal</td>
                            <th>catatan</td>
                            <th>Menu</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from `$tbldetail`  order by `id_detail` desc";
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
                            $id_detail = $d["id_detail"];
                            $id_detail = ucwords($d["id_detail"]);
                            $id_order = $d["id_order"];
                            $nama_produk = getProduk($conn,$d["id_produk"]);
                            $id_produk = $d["id_produk"];
                            $jumlah = $d["jumlah"];
                            $harga = $d["harga"];
                            $subtotal = $d["subtotal"];
                            $catatan = $d["catatan"];
                            echo "<tr>
                        <td>$no</td>
                        <td>$id_produk | $nama_produk</td>
                        <td>$id_order</td>
                        <td>$jumlah</td>
                        <td>$harga</td>
                        <td>$subtotal</td>
                        <td>$catatan</td>
                        <td><div align='center'>
                <a href='?mnu=detail&pro=ubah&kode=$id_detail&id=$id_order'><img src='ypathicon/ub.png' title='ubah'></a>
                <a href='?mnu=detail&pro=hapus&kode=$id_detail&id=$id_order'><img src='ypathicon/ha.png' title='hapus' 
                onClick='return confirm(\"Apakah Anda benar-benar akan menghapus \"$id_detail\" pada data detail ?..\")'></a></div></td>
                        </tr>";
                            $no++;
                          } //for dalam
                        } //if
                        else {
                          echo "<tr><td colspan='6'><blink>Maaf, Data detail belum tersedia...</blink></td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

		<?php
		$jmldata = $jum;
		if ($jmldata > 0) {
			if ($batas < 1) {
				$batas = 1;
			}
			$jmlhal  = ceil($jmldata / $batas);
			echo "<div class=paging>";
			if ($page > 1) {
				$prev = $page - 1;
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=detail&id=$id_order'>« Prev</a></span> ";
			} else {
				echo "<span class=disabled>« Prev</span> ";
			}

			for ($i = 1; $i <= $jmlhal; $i++)
				if ($i != $page) {
					echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=detail&id=$id_order'>$i</a> ";
				} else {
					echo " <span class=current>$i</span> ";
				}

			if ($page < $jmlhal) {
				$next = $page + 1;
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=detail&id=$id_order'>Next »</a></span>";
			} else {
				echo "<span class=disabled>Next »</span>";
			}
			echo "</div>";
		} //if jmldata

		$jmldata = $jum;
		echo "<p align=center>Total data <b>$jmldata</b> item</p>";

		echo "</div>";
		?>
		<?php
		if (isset($_POST["Simpan"])) {
			$pro = strip_tags($_POST["pro"]);
			$id_detail = strip_tags($_POST["id_detail"]);
			$id_detail0 = strip_tags($_POST["id_detail0"]);
			$id_order = strip_tags($_POST["id_order"]);
			$id_detail = strip_tags($_POST["id_detail"]);
			$id_produk = strip_tags($_POST["id_produk"]);
			$jumlah = strip_tags($_POST["jumlah"]);
			$harga = strip_tags($_POST["harga"]);
			$subtotal = $harga * $jumlah;
			$catatan = strip_tags($_POST["catatan"]);

			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tbldetail` (
					`id_order` ,
					`id_produk` ,
					`jumlah` ,
					`harga` ,
					`subtotal` ,
					`catatan`
					) VALUES (
					'$id_order',
					'$id_produk', 
					'$jumlah',
					'$harga',
					'$subtotal',
					'$catatan'
					)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $id_detail berhasil disimpan !');document.location.href='?mnu=detail&id=$id_order';</script>";
				} else {
					echo "<script>alert('Data $id_detail gagal disimpan...');document.location.href='?mnu=detail&id=$id_order';</script>";
				}
			} else {
				$sql = "update `$tbldetail` set 
					`id_order`='$id_order',
					`id_produk`='$id_produk',
					`jumlah`='$jumlah' ,
					`harga`='$harga',
					`subtotal`='$subtotal',
					`catatan`='$catatan'
					 where `id_detail`='$id_detail0'";
					 
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $id_detail berhasil diubah !');document.location.href='?mnu=detail&id=$id_order';</script>";
				} else {
					echo "<script>alert('Data $id_detail gagal diubah...');document.location.href='?mnu=detail&id=$id_order';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if (isset($_GET["pro"]) && $_GET["pro"] == "hapus") {
			$id_detail = $_GET["kode"];
			$sql = "delete from `$tbldetail` where `id_detail`='$id_detail'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_detail berhasil dihapus !');document.location.href='?mnu=detail&id=$id_order';</script>";
			} else {
				echo "<script>alert('Data $id_detail gagal dihapus...');document.location.href='?mnu=detai&id=$id_orderl';</script>";
			}
		}
		?>