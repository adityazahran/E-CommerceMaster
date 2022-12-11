<?php
$pro = "simpan";

$tanggal = "";
$jam = "";
$id_pelanggan = "";
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
		win = window.open('order/order_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>

<?php
$sql = "select `id_order` from `$tblorder` order by `id_order` desc";
$jum = getJum($conn, $sql);
$kd = "ORD";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_order'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_order = $idmax;
?>
<?php
if (isset($_GET["pro"]) && $_GET["pro"] == "ubah") {
	$id_order = $_GET["kode"];
	$sql = "select * from `$tblorder` where `id_order`='$id_order'";
	$d = getField($conn, $sql);
	$id_order = $d["id_order"];
	$id_order0 = $d["id_order"];
	$deskripsi = $d["deskripsi"];
	$tanggal = $d["tanggal"];
	$jam = $d["jam"];
	$id_pelanggan = $d["id_pelanggan"];
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
	<h3>Input Data order</h3>
	<div>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<th width="70"><label for="id_order">ID order</label>
					<th width="9">:
					<th colspan="2"><b><?php echo $id_order; ?></b>
				</tr>

				<tr>
					<td height="24"><label for="id_pelanggan">Pelanggan</label>
					<td>:
					<td>
					<select class="form-control" name="id_pelanggan">
					<?php  
					$sql="select * from `$tblpelanggan`";
						$arr=getData($conn,$sql);
							foreach($arr as $d) {						
									$id_pelanggan0=$d["id_pelanggan"];
									$nama_pelanggan=ucwords($d["nama_pelanggan"]);
						echo "<option value='$id_pelanggan0'"; if($id_pelanggan0==$id_pelanggan){echo"selected";} echo">$nama_pelanggan ($id_pelanggan0)</option>";
									}
									?>
					</select>
					</td>
				</tr>
				<tr>
					<td height="24"><label for="deskripsi">deskripsi</label>
					<td>:
					<td><input required name="deskripsi" class="form-control" type="text" id="deskripsi" value="<?php echo $deskripsi; ?>" size="25" />
					</td>
				</tr>


				<tr>
					<td><label for="status">Status</label>
					<td>:
					<td colspan="2">
						<input type="radio" name="status" id="status" checked="checked" value="Order" <?php if ($status == "Order") {
																											echo "checked";
																										} ?> />Order
						<input type="radio" name="status" id="status" value="Selesai" <?php if ($status == "Selesai") {
																								echo "checked";
																							} ?> />Selesai
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
						<input name="id_order" type="hidden" id="id_order" value="<?php echo $id_order; ?>" />
						<input name="id_order0" type="hidden" id="id_order0" value="<?php echo $id_order0; ?>" />
						<a href="?mnu=order"><input class="btn btn-primary" name="Batal" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>
	</div>

		<h3>Data order :</h3>
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
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=order'>« Prev</a></span> ";
			} else {
				echo "<span class=disabled>« Prev</span> ";
			}

			for ($i = 1; $i <= $jmlhal; $i++)
				if ($i != $page) {
					echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=order'>$i</a> ";
				} else {
					echo " <span class=current>$i</span> ";
				}

			if ($page < $jmlhal) {
				$next = $page + 1;
				echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=order'>Next »</a></span>";
			} else {
				echo "<span class=disabled>Next »</span>";
			}
			echo "</div>";
		} //if jmldata

		$jmldata = $jum;
		echo "<p align=center>Total data <b>$jmldata</b> item</p>";

		echo "</div>";
		?>
		</div>

		<?php
		if (isset($_POST["Simpan"])) {
			$pro = strip_tags($_POST["pro"]);
			$id_order = strip_tags($_POST["id_order"]);
			$id_order0 = strip_tags($_POST["id_order0"]);
			
			$jam = date("H:i:s");
			$id_pelanggan = strip_tags($_POST["id_pelanggan"]);
			$deskripsi = strip_tags($_POST["deskripsi"]);
			$status = strip_tags($_POST["status"]);
			$keterangan = strip_tags($_POST["keterangan"]);
			$tanggal = date("Y-m-d");

			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tblorder` (
					`id_order` ,
					`tanggal` ,
					`jam` ,
					`id_pelanggan` ,
					`deskripsi` ,
					`status` ,
					`keterangan`
					) VALUES (
					'$id_order', 
					'$tanggal',
					'$jam', 
					'$id_pelanggan',
					'$deskripsi',
					'$status',
					'$keterangan'
					)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $id_order berhasil disimpan !');document.location.href='?mnu=order';</script>";
				} else {
					echo "<script>alert('Data $id_order gagal disimpan...');document.location.href='?mnu=order';</script>";
				}
			} else {
				$sql = "update `$tblorder` set 
					`tanggal`='$tanggal',
					`jam`='$jam',
					`id_pelanggan`='$id_pelanggan' ,
					`deskripsi`='$deskripsi',
					`status`='$status',
					`keterangan`='$keterangan'
					 where `id_order`='$id_order0'";
					 
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $id_order berhasil diubah !');document.location.href='?mnu=order';</script>";
				} else {
					echo "<script>alert('Data $id_order gagal diubah...');document.location.href='?mnu=order';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if (isset($_GET["pro"]) && $_GET["pro"] == "hapus") {
			$id_order = $_GET["kode"];
			$sql = "delete from `$tblorder` where `id_order`='$id_order'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_order berhasil dihapus !');document.location.href='?mnu=order';</script>";
			} else {
				echo "<script>alert('Data $id_order gagal dihapus...');document.location.href='?mnu=order';</script>";
			}
		}
		?>