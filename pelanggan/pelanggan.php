<?php
$pro = "simpan";

$nama_pelanggan = "";
$username = "";
$password = "";
$telepon = "";
$email = "";
$alamat = "";
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
		win = window.open('pelanggan/pelanggan_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>

<?php
$sql = "select `id_pelanggan` from `$tblpelanggan` order by `id_pelanggan` desc";
$jum = getJum($conn, $sql);
$kd = "PLG";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_pelanggan'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_pelanggan = $idmax;
?>
<?php
if (isset($_GET["pro"]) && $_GET["pro"] == "ubah") {
	$id_pelanggan = $_GET["kode"];
	$sql = "select * from `$tblpelanggan` where `id_pelanggan`='$id_pelanggan'";
	$d = getField($conn, $sql);
	$id_pelanggan = $d["id_pelanggan"];
	$id_pelanggan0 = $d["id_pelanggan"];
	$nama_pelanggan = $d["nama_pelanggan"];
	$alamat = $d["alamat"];
	$username = $d["username"];
	$password = $d["password"];
	$telepon = $d["telepon"];
	$email = $d["email"];
	$alamat = $d["alamat"];
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
	<h3>Input Data pelanggan</h3>
	<div>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<th width="70"><label for="id_pelanggan">ID pelanggan</label>
					<th width="9">:
					<th colspan="2"><b><?php echo $id_pelanggan; ?></b>
				</tr>
				<tr>
					<td><label for="nama_pelanggan">Nama pelanggan</label>
					<td>:
					<td width="683"><input required name="nama_pelanggan" class="form-control" type="text" id="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>" size="25" />
					</td>
				</tr>
				<tr>
					<td height="24"><label for="username">Username</label>
					<td>:
					<td><input required name="username" class="form-control" type="text" id="username" value="<?php echo $username; ?>" size="25" /></td>
				</tr>

				<tr>
					<td height="24"><label for="password">Password</label>
					<td>:
					<td><input required name="password" class="form-control" type="password" id="password" value="<?php echo $password; ?>" size="25" /></td>
				</tr>

				<tr>
					<td height="24"><label for="telepon">Telepon</label>
					<td>:
					<td><input required name="telepon" class="form-control" type="number" id="telepon" value="<?php echo $telepon; ?>" size="25" />
					</td>
				</tr>
				<tr>
					<td height="24"><label for="alamat">alamat</label>
					<td>:
					<td><input required name="alamat" class="form-control" type="text" id="alamat" value="<?php echo $alamat; ?>" size="25" />
					</td>
				</tr>
				<tr>
					<td height="24"><label for="email">Email</label>
					<td>:
					<td><input required name="email" class="form-control" type="email" id="email" value="<?php echo $email; ?>" size="25" />
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
						<input name="id_pelanggan" type="hidden" id="id_pelanggan" value="<?php echo $id_pelanggan; ?>" />
						<input name="id_pelanggan0" type="hidden" id="id_pelanggan0" value="<?php echo $id_pelanggan0; ?>" />
						<a href="?mnu=pelanggan"><input class="btn btn-primary" name="Batal" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<?php
	$sqlc = "select distinct(`status`) from `$tblpelanggan` order by `status` asc";
	$jumc = getJum($conn, $sqlc);
	if ($jumc < 1) {
		echo "<h1>Maaf data pelanggan belum tersedia</h1>";
	}
	$arrc = getData($conn, $sqlc);
	foreach ($arrc as $dc) {
		$status = $dc["status"];
	?>
		<h3>Data pelanggan <?php echo $status ?>:</h3>
		<div class="col-lg-12 grid-margin stretch-card">
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>ID pelanggan</td>
                            <th>nama pelanggan</td>
                            <th>alamat</td>
                            <th>email</td>
                            <th>telepon</td>
                            <th>username</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from `$tblpelanggan`  order by `id_pelanggan` desc";
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
                            $id_pelanggan = $d["id_pelanggan"];
                            $id_pelanggan = ucwords($d["id_pelanggan"]);
                            $nama_pelanggan = $d["nama_pelanggan"];
                            $alamat = $d["alamat"];
                            $email = $d["email"];
                            $telepon = $d["telepon"];
                            $username = $d["username"];
                            echo "<tr>
                        <td>$no</td>
                        <td>$nama_pelanggan</td>
                        <td>$email </td>
                        <td>$alamat</td>
                        <td>$telepon</td>
                        <td>$username</td>
                        <td><div align='center'>
                <a href='?mnu=pelanggan&pro=ubah&kode=$id_pelanggan&id=$nama_pelanggan'><img src='ypathicon/ub.png' title='ubah'></a>
                <a href='?mnu=pelanggan&pro=hapus&kode=$id_pelanggan&id=$nama_pelanggan'><img src='ypathicon/ha.png' title='hapus' 
                onClick='return confirm(\"Apakah Anda benar-benar akan menghapus \"$id_pelanggan\" pada data pelanggan ?..\")'></a></div></td>
                        </tr>";
                            $no++;
                          } //for dalam
                        } //if
                        else {
                          echo "<tr><td colspan='6'><blink>Maaf, Data pelanggan belum tersedia...</blink></td></tr>";
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
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=pelanggan'>« Prev</a></span> ";
			} else {
				echo "<span class=disabled>« Prev</span> ";
			}

			for ($i = 1; $i <= $jmlhal; $i++)
				if ($i != $page) {
					echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=pelanggan'>$i</a> ";
				} else {
					echo " <span class=current>$i</span> ";
				}

			if ($page < $jmlhal) {
				$next = $page + 1;
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=pelanggan'>Next »</a></span>";
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
			$id_pelanggan = strip_tags($_POST["id_pelanggan"]);
			$id_pelanggan0 = strip_tags($_POST["id_pelanggan0"]);
			$username = strip_tags($_POST["username"]);
			$nama_pelanggan = strip_tags($_POST["nama_pelanggan"]);
			$password = strip_tags($_POST["password"]);
			$telepon = strip_tags($_POST["telepon"]);
			$alamat = strip_tags($_POST["alamat"]);
			$email = strip_tags($_POST["email"]);
			$status = strip_tags($_POST["status"]);
			$keterangan = strip_tags($_POST["keterangan"]);

			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tblpelanggan` (
					`id_pelanggan` ,
					`nama_pelanggan` ,
					`username` ,
					`password` ,
					`telepon` ,
					`alamat` ,
					`email` ,
					`status` ,
					`keterangan`
					) VALUES (
					'$id_pelanggan', 
					'$nama_pelanggan',
					'$username',
					'$password', 
					'$telepon',
					'$alamat',
					'$email',
					'$status',
					'$keterangan'
					)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $nama_pelanggan berhasil disimpan !');document.location.href='?mnu=pelanggan';</script>";
				} else {
					echo "<script>alert('Data $nama_pelanggan gagal disimpan...');document.location.href='?mnu=pelanggan';</script>";
				}
			} else {
				$sql = "update `$tblpelanggan` set 
					`nama_pelanggan`='$nama_pelanggan',
					`username`='$username',
					`password`='$password',
					`telepon`='$telepon' ,
					`alamat`='$alamat',
					`email`='$email',
					`status`='$status',
					`keterangan`='$keterangan'
					 where `id_pelanggan`='$id_pelanggan0'";
					 
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $nama_pelanggan berhasil diubah !');document.location.href='?mnu=pelanggan';</script>";
				} else {
					echo "<script>alert('Data $nama_pelanggan gagal diubah...');document.location.href='?mnu=pelanggan';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if (isset($_GET["pro"]) && $_GET["pro"] == "hapus") {
			$id_pelanggan = $_GET["kode"];
			$sql = "delete from `$tblpelanggan` where `id_pelanggan`='$id_pelanggan'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_pelanggan berhasil dihapus !');document.location.href='?mnu=pelanggan';</script>";
			} else {
				echo "<script>alert('Data $id_pelanggan gagal dihapus...');document.location.href='?mnu=pelanggan';</script>";
			}
		}
		?>