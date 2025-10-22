<?php
if (isset($_FILES['files'])) {
    $errors = array();
    $allowed_ext = array("jpg", "jpeg", "png", "gif");

    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['files']['name'][$key];
        $file_size = $_FILES['files']['size'][$key];
        $file_tmp  = $_FILES['files']['tmp_name'][$key];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_ext)) {
            $errors[] = "$file_name: hanya boleh gambar (jpg, jpeg, png, gif)";
            continue;
        }

        if ($file_size > 2097152) {
            $errors[] = "$file_name: ukuran file melebihi 2 MB";
            continue;
        }

        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
            echo "$file_name berhasil diunggah.<br>";
        } else {
            $errors[] = "$file_name gagal diunggah.";
        }
    }

    if (!empty($errors)) {
        echo "<br><b>Daftar Error:</b><br>" . implode("<br>", $errors);
    }
}
?>
