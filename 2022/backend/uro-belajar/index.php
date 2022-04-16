<?php

// menampilakan isi variabel

// $angka = 1;
// // echo $angka;
// $angka = "hallo";
// echo $angka;


// percabangan

// if ($angka == 1){
//     echo "angka sama dengan 1";
// }elseif ($angka == "hallo"){
//     echo "ini adalah halo";
// }


// perulangan

// $iniData = [
//     ['nama' => 'Alif Naufal', 'nim' => '119130022'],
//     ['nama' => 'Susanti', 'nim'=>'120130130']
// ];

// foreach($iniData as $d){
//     echo $d['nama'];
//     echo "<br>";
// }



// fungsi (function)

// function penjumlahan($nilai1 = 0, $nilai2 = 0){
//     return $nilai1 + $nilai2;
// }
// echo penjumlahan();





// Database (CRUD) -> Create, Read, Update, Delete
// XAMPP -> linux, windows, macOS
// MAMPP -> macOS
// WAMPP -> Windows

$conn = mysqli_connect("localhost", "root", "", "uro_belajar");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function delete($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM artikel WHERE id = $id");
    return mysqli_affected_rows($conn);
}

$idDariURL = $_GET['id'];
if($idDariURL == true){
    if (delete($idDariURL) > 0){
        echo "<script>
                alert('data berhasil dihapus');
                document.location.href = 'index.php';
            </script>";
    }
}



$articles = query("SELECT * FROM artikel");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Saya</title>
</head>
<body>
    <ol>
        <?php foreach($articles as $article) : ?>
        <li><?= $article['judul'] ?></li>
<button><a href="?id=<?= $article['id'] ?>" onclick="return confirm('yakin mau dihapus?')">hapus</a></button>
        <?php endforeach ?>
    </ol>
</body>
</html>