<?php
$targetDirectory = "images/"; 
if (!file_exists($targetDirectory)) {
    if (!mkdir($targetDirectory, 0777, true)) {
        die("Gagal membuat direktori unggahan.");
    }
}

$allowedExtensions = array("jpg", "jpeg", "png", "gif");
$maxsize = 5 * 1024 * 1024; 

if (isset($_FILES['files']['name'][0]) && !empty($_FILES['files']['name'][0])) {
    $totalFiles = count($_FILES['files']['name']);
    
    echo "<h3>Hasil Multi Upload Gambar:</h3>";

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $fileSize = $_FILES['files']['size'][$i];
        $fileTmp = $_FILES['files']['tmp_name'][$i];
        
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $targetFile = $targetDirectory . $fileName;
        
        if (!in_array($fileType, $allowedExtensions)) {
            echo "File **$fileName** gagal: Ekstensi tidak diizinkan ($fileType). Hanya (JPG, PNG, GIF).<br>";
            continue; 
        }

        if ($fileSize > $maxsize) {
            echo "File **$fileName** gagal: Ukuran file melebihi batas 5 MB.<br>";
            continue; 
        }
        
       
        if (move_uploaded_file($fileTmp, $targetFile)) {
            echo "File **$fileName** berhasil diunggah. <br>";
        } else {
            echo "Gagal mengunggah file **$fileName**. (Kesalahan server/izin).<br>";
        }
    }
    
} else {
    echo "Tidak ada file yang diunggah.";
}
?>