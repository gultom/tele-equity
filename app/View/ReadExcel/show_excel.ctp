<?php
	// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
 
// import data excel mulai baris ke-2
// (karena baris pertama adalah nama kolom)
for ($i=2; $i <= $baris; $i++){
    $nim = $data->val($i, 1);
    $nama = $data->val($i, 2);
    $alamat = $data->val($i, 3);
    $jurusan = $data->val($i, 4);
    $hp = $data->val($i, 5);
	echo $nim.':'.$nama.'<br>';
	
	}

?>