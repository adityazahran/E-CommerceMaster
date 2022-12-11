<?php
$pro = "simpan";

$nama_produk = "";
$gambar = "";
$harga = "";
$kategori = "";
$harga = "";
$deskripsi = "";
$status = "Aktif";
$keterangan = "";
?>

<link type="text/css" href="<?php echo "$PATH/base/"; ?>ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo "$PATH/"; ?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/"; ?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/"; ?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/"; ?>ui/i18n/ui.datepicker-id.js"></script>

<script type="text/javascript">
	function PRINT(pk) {
		win = window.open('produk/produk_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>

<?php
$sql = "select `id_produk` from `$tblproduk` order by `id_produk` desc";
$jum = getJum($conn, $sql);
$kd = "PRO";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_produk'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_produk = $idmax;
?>
<?php
if (isset($_GET["pro"]) && $_GET["pro"] == "ubah") {
	$id_produk = $_GET["kode"];
	$sql = "select * from `$tblproduk` where `id_produk`='$id_produk'";
	$d = getField($conn, $sql);
	$id_produk = $d["id_produk"];
	$id_produk0 = $d["id_produk"];
	$nama_produk = $d["nama_produk"];
	$deskripsi = $d["deskripsi"];
	$gambar = $d["gambar"];
	$harga = $d["harga"];
	$kategori = $d["kategori"];
	$deskripsi = $d["deskripsi"];
	$status = $d["status"];
	$keterangan = $d["keterangan"];
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


<div id="accordion">
	<h3>Input Data produk</h3>
	<div>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<th width="70"><label for="id_produk">ID produk</label>
					<th width="9">:
					<th colspan="2"><b><?php echo $id_produk; ?></b>
				</tr>
				<tr>
					<td><label for="nama_produk">Nama produk</label>
					<td>:
					<td width="683"><input required name="nama_produk" class="form-control" type="text" id="nama_produk" value="<?php echo $nama_produk; ?>" size="25" />
					</td>
				</tr>
				<tr>
					<td height="24"><label for="harga">harga</label>
					<td>:
					<td><input required name="harga" class="form-control" type="number" id="harga" value="<?php echo $harga; ?>" size="25" /></td>
				</tr>

				<tr>
					<td height="24"><label for="kategori">kategori</label>
					<td>:
					<td><input required name="kategori" class="form-control" type="text" id="kategori" value="<?php echo $kategori; ?>" size="25" />
					</td>
				</tr>
				<tr>
					<td height="24"><label for="deskripsi">deskripsi</label>
					<td>:
					<td><input required name="deskripsi" class="form-control" type="text" id="deskripsi" value="<?php echo $deskripsi; ?>" size="25" />
					</td>
				</tr>
				<tr>
					<td height="24"><label for="gambar">gambar</label>
					<td>:
					<td><input required name="gambar" class="form-control" type="file" id="gambar" value="<?php echo $deskripsi; ?>" size="25" />
					</td>
				</tr>


				<tr>
					<td><label for="status">Status</label>
					<td>:
					<td colspan="2">
						<input type="radio" name="status" id="status" checked="checked" value="Aktif" <?php if ($status == "Aktif") {
																											echo "checked";
																										} ?> />Aktif
						<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if ($status == "Tidak Aktif") {
																								echo "checked";
																							} ?> />Tidak Aktif
					</td>
				</tr>

				<tr>
					<td height="24"><label for="keterangan">Keterangan</label>
					<td>:
					<td>
						<textarea name="keterangan" class="form-control" cols="55" rows="2"><?php echo $keterangan; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>
					<td>
					<td colspan="2">
						<input name="Simpan" class="btn btn-danger" type="submit" id="Simpan" value="Simpan" />
						<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
						<input name="id_produk" type="hidden" id="id_produk" value="<?php echo $id_produk; ?>" />
						<input name="id_produk0" type="hidden" id="id_produk0" value="<?php echo $id_produk0; ?>" />
						<a href="?mnu=produk"><input class="btn btn-primary" name="Batal" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<?php
	$sqlc = "select distinct(`status`) from `$tblproduk` order by `status` asc";
	$jumc = getJum($conn, $sqlc);
	if ($jumc < 1) {
		echo "<h1>Maaf data produk belum tersedia</h1>";
	}
	$arrc = getData($conn, $sqlc);
	foreach ($arrc as $dc) {
		$status = $dc["status"];
	?>
		<h3>Data produk <?php echo $status ?>:</h3>
		<div class="col-lg-12 grid-margin stretch-card">
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>ID produk</td>
                            <th>nama produk</td>
                            <th>deskripsi</td>
                            <th>gambar</td>
                            <th>harga</td>
                            <th>kategori</td>
                            <th>keterangan</td>
                            <th></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from `$tblproduk`  order by `id_produk` desc";
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
                            $id_produk = $d["id_produk"];
                            $id_produk = ucwords($d["id_produk"]);
                            $nama_produk = $d["nama_produk"];
                            $deskripsi = $d["deskripsi"];
                            $gambar = $d["gambar"];
                            $harga = $d["harga"];
                            $kategori = $d["kategori"];
                            $keterangan = $d["keterangan"];
                            echo "<tr>
                        <td>$no</td>
                        <td>$nama_produk</td>
                        <td><div align='center'>";
echo"<a href='#' onclick='buka(\"produk/zoom.php?id=$id_produk\")'>
<img src='$YPATH/$gambar' width='40' height='40' /></a></div>";
				echo"</td>
                        <td>$deskripsi</td>
                        <td>$harga</td>
                        <td>$kategori</td>
                        <td>$keterangan</td>
                        <td><div align='center'>
                <a href='?mnu=produk&pro=ubah&kode=$id_produk&id=$nama_produk'><img src='ypathicon/ub.png' title='ubah'></a>
                <a href='?mnu=produk&pro=hapus&kode=$id_produk&id=$nama_produk'><img src='ypathicon/ha.png' title='hapus' 
                onClick='return confirm(\"Apakah Anda benar-benar akan menghapus \"$id_produk\" pada data produk ?..\")'></a></div></td>
                        </tr>";
                            $no++;
                          } //for dalam
                        } //if
                        else {
                          echo "<tr><td colspan='6'><blink>Maaf, Data produk belum tersedia...</blink></td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>

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
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=produk'>« Prev</a></span> ";
			} else {
				echo "<span class=disabled>« Prev</span> ";
			}

			for ($i = 1; $i <= $jmlhal; $i++)
				if ($i != $page) {
					echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=produk'>$i</a> ";
				} else {
					echo " <span class=current>$i</span> ";
				}

			if ($page < $jmlhal) {
				$next = $page + 1;
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=produk'>Next »</a></span>";
			} else {
				echo "<span class=disabled>Next »</span>";
			}
			echo "</div>";
		} //if jmldata

		$jmldata = $jum;
		echo "<p align=center>Total data <b>$jmldata</b> item</p>";

		echo "</div>";
	} //for atas
		?>
		</div>

		<?php
		if (isset($_POST["Simpan"])) {
			$pro = strip_tags($_POST["pro"]);
			$id_produk = strip_tags($_POST["id_produk"]);
			$id_produk0 = strip_tags($_POST["id_produk0"]);
			
			$nama_produk = strip_tags($_POST["nama_produk"]);
			$harga = strip_tags($_POST["harga"]);
			$kategori = strip_tags($_POST["kategori"]);
			$deskripsi = strip_tags($_POST["deskripsi"]);
			$harga = strip_tags($_POST["harga"]);
			$status = strip_tags($_POST["status"]);
			$keterangan = strip_tags($_POST["keterangan"]);
			$gambar0 = strip_tags($_POST["gambar0"]);
			if ($_FILES["gambar"] != "") {
			move_uploaded_file($_FILES["gambar"]["tmp_name"], "$YPATH/" . $_FILES["gambar"]["name"]);
			$gambar = $_FILES["gambar"]["name"];
			} else {
			$gambar = $gambar0;
			}
			if (strlen($gambar) < 1) {
			$gambar = $gambar0;
			}

			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tblproduk` (
					`id_produk` ,
					`nama_produk` ,
					`gambar` ,
					`harga` ,
					`kategori` ,
					`deskripsi` ,
					`status` ,
					`keterangan`
					) VALUES (
					'$id_produk', 
					'$nama_produk',
					'$gambar',
					'$harga', 
					'$kategori',
					'$deskripsi',
					'$status',
					'$keterangan'
					)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $nama_produk berhasil disimpan !');document.location.href='?mnu=produk';</script>";
				} else {
					echo "<script>alert('Data $nama_produk gagal disimpan...');document.location.href='?mnu=produk';</script>";
				}
			} else {
				$sql = "update `$tblproduk` set 
					`nama_produk`='$nama_produk',
					`gambar`='$gambar',
					`harga`='$harga',
					`kategori`='$kategori' ,
					`deskripsi`='$deskripsi',
					`harga`='$harga',
					`status`='$status',
					`keterangan`='$keterangan'
					 where `id_produk`='$id_produk0'";
					 
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $nama_produk berhasil diubah !');document.location.href='?mnu=produk';</script>";
				} else {
					echo "<script>alert('Data $nama_produk gagal diubah...');document.location.href='?mnu=produk';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if (isset($_GET["pro"]) && $_GET["pro"] == "hapus") {
			$id_produk = $_GET["kode"];
			$sql = "delete from `$tblproduk` where `id_produk`='$id_produk'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_produk berhasil dihapus !');document.location.href='?mnu=produk';</script>";
			} else {
				echo "<script>alert('Data $id_produk gagal dihapus...');document.location.href='?mnu=produk';</script>";
			}
		}
		?>