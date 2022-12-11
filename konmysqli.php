<?php
require_once "koneksivar.php";

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
	trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
?>

<?php function RP($rupiah)
{
	return number_format($rupiah, "2", ",", ".");
} ?>

<?php
function WKT($sekarang)
{
	if ($sekarang == "0000-00-00") {
		$sekarang = date("Y-m-d");
	}

	$tanggal = substr($sekarang, 8, 2) + 0;
	$bulan = substr($sekarang, 5, 2);
	$tahun = substr($sekarang, 0, 4);

	$judul_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$wk = $tanggal . " " . $judul_bln[(int)$bulan] . " " . $tahun;
	return $wk;
}
?>
<?php
function WKTP($sekarang)
{
	$tanggal = substr($sekarang, 8, 2) + 0;
	$bulan = substr($sekarang, 5, 2);
	$tahun = substr($sekarang, 2, 2);

	$judul_bln = array(1 => "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	$wk = $tanggal . " " . $judul_bln[(int)$bulan] . "'" . $tahun;
	return $wk;
}
?>

<?php
function process($conn, $sql)
{
	$s = false;
	$conn->autocommit(FALSE);
	try {
		$rs = $conn->query($sql);
		if ($rs) {
			$conn->commit();
			$last_inserted_id = $conn->insert_id;
			$affected_rows = $conn->affected_rows;
			$s = true;
		}
	} catch (Exception $e) {
		echo 'fail: ' . $e->getMessage();
		$conn->rollback();
	}
	$conn->autocommit(TRUE);
	return $s;
}

function getJum($conn, $sql)
{
	$rs = $conn->query($sql);
	$jum = $rs->num_rows;
	$rs->free();
	return $jum;
}

function getField($conn, $sql)
{
	$rs = $conn->query($sql);
	$rs->data_seek(0);
	$d = $rs->fetch_assoc();
	$rs->free();
	return $d;
}

function getData($conn, $sql)
{
	$rs = $conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	//foreach($arr as $row) {
	//  echo $row['nama_kelas'] . '*<br>';
	//}

	$rs->free();
	return $arr;
}

function getPelanggan($conn, $kode)
{
	$field = "nama_pelanggan";
	$sql = "SELECT `$field` FROM `tbl_pelanggan` where `id_pelanggan`='$kode'";
	$rs = $conn->query($sql);
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
	return $row[$field];
}

function getProduk($conn, $kode)
{
	$field = "nama_produk";
	$sql = "SELECT `$field` FROM `tbl_produk` where `id_produk`='$kode'";
	$rs = $conn->query($sql);
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
	return $row[$field];
}
?>

