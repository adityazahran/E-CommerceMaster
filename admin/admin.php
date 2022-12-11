<?php
$pro = "simpan";

$nama_admin = "";
$username = "";
$password = "";
$telepon = "";
$email = "";
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
		win = window.open('admin/admin_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>

<?php
$sql = "select `id_admin` from `$tbladmin` order by `id_admin` desc";
$jum = getJum($conn, $sql);
$kd = "ADM";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_admin'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_admin = $idmax;
?>
<?php
if (isset($_GET["pro"]) && $_GET["pro"] == "ubah") {
	$id_admin = $_GET["kode"];
	$sql = "select * from `$tbladmin` where `id_admin`='$id_admin'";
	$d = getField($conn, $sql);
	$id_admin = $d["id_admin"];
	$id_admin0 = $d["id_admin"];
	$nama_admin = $d["nama_admin"];
	$username = $d["username"];
	$password = $d["password"];
	$telepon = $d["telepon"];
	$email = $d["email"];
	$status = $d["status"];
	$keterangan = $d["keterangan"];
	$pro = "ubah";
}
?>


	<h3>Input Data Admin</h3>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<th width="70"><label for="id_admin">ID Admin</label>
					<th width="9">:
					<th colspan="2"><b><?php echo $id_admin; ?></b>
				</tr>
				<tr>
					<td><label for="nama_admin">Nama Admin</label>
					<td>:
					<td width="683"><input required name="nama_admin" class="form-control" type="text" id="nama_admin" value="<?php echo $nama_admin; ?>" size="25" />
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
						<input name="id_admin" type="hidden" id="id_admin" value="<?php echo $id_admin; ?>" />
						<input name="id_admin0" type="hidden" id="id_admin0" value="<?php echo $id_admin0; ?>" />
						<a href="?mnu=admin"><input class="btn btn-primary" name="Batal" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>

		<div class="col-lg-12 grid-margin stretch-card">
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>ID Admin</td>
                            <th>nama Admin</td>
                            <th>email</td>
                            <th>telepon</td>
                            <th>username</td>
                            <th>status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from `$tbladmin`  order by `id_admin` desc";
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
                            $id_admin = $d["id_admin"];
                            $id_admin = ucwords($d["id_admin"]);
                            $nama_admin = $d["nama_admin"];
                            $email = $d["email"];
                            $telepon = $d["telepon"];
                            $username = $d["username"];
                            $status = $d["status"];
                            echo "<tr>
                        <td>$no</td>
                        <td>$nama_admin</td>
                        <td>$telepon </td>
                        <td>$email</td>
                        <td>$username</td>
                        <td>$status</td>
                        <td><div align='center'>
                <a href='?mnu=admin&pro=ubah&kode=$id_admin&id=$nama_admin'><img src='ypathicon/ub.png' title='ubah'></a>
                <a href='?mnu=admin&pro=hapus&kode=$id_admin&id=$nama_admin'><img src='ypathicon/ha.png' title='hapus' 
                onClick='return confirm(\"Apakah Anda benar-benar akan menghapus \"$id_admin\" pada data admin ?..\")'></a></div></td>
                        </tr>";
                            $no++;
                          } //for dalam
                        } //if
                        else {
                          echo "<tr><td colspan='6'><blink>Maaf, Data admin belum tersedia...</blink></td></tr>";
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
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=admin'>« Prev</a></span> ";
			} else {
				echo "<span class=disabled>« Prev</span> ";
			}

			for ($i = 1; $i <= $jmlhal; $i++)
				if ($i != $page) {
					echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=admin'>$i</a> ";
				} else {
					echo " <span class=current>$i</span> ";
				}

			if ($page < $jmlhal) {
				$next = $page + 1;
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=admin'>Next »</a></span>";
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
			$id_admin = strip_tags($_POST["id_admin"]);
			$id_admin0 = strip_tags($_POST["id_admin0"]);
			$username = strip_tags($_POST["username"]);
			$nama_admin = strip_tags($_POST["nama_admin"]);
			$password = strip_tags($_POST["password"]);
			$telepon = strip_tags($_POST["telepon"]);
			$email = strip_tags($_POST["email"]);
			$status = strip_tags($_POST["status"]);
			$keterangan = strip_tags($_POST["keterangan"]);

			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tbladmin` (
					`id_admin` ,
					`nama_admin` ,
					`username` ,
					`password` ,
					`telepon` ,
					`email` ,
					`status` ,
					`keterangan`
					) VALUES (
					'$id_admin', 
					'$nama_admin',
					'$username',
					'$password', 
					'$telepon',
					'$email',
					'$status',
					'$keterangan'
					)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $nama_admin berhasil disimpan !');document.location.href='?mnu=admin';</script>";
				} else {
					echo "<script>alert('Data $nama_admin gagal disimpan...');document.location.href='?mnu=admin';</script>";
				}
			} else {
				$sql = "update `$tbladmin` set 
					`nama_admin`='$nama_admin',
					`username`='$username',
					`password`='$password',
					`telepon`='$telepon' ,
					`email`='$email',
					`status`='$status',
					`keterangan`='$keterangan'
					 where `id_admin`='$id_admin0'";
					 
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $nama_admin berhasil diubah !');document.location.href='?mnu=admin';</script>";
				} else {
					echo "<script>alert('Data $nama_admin gagal diubah...');document.location.href='?mnu=admin';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if (isset($_GET["pro"]) && $_GET["pro"] == "hapus") {
			$id_admin = $_GET["kode"];
			$sql = "delete from `$tbladmin` where `id_admin`='$id_admin'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_admin berhasil dihapus !');document.location.href='?mnu=admin';</script>";
			} else {
				echo "<script>alert('Data $id_admin gagal dihapus...');document.location.href='?mnu=admin';</script>";
			}
		}
		?>