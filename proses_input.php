<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form_mahasiswa.php');
    exit;
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$jurusan = $_POST['jurusan'] ?? '';
$dosen = $_POST['dosen'] ?? '';
$errors = [];

if (empty($nim)) {
    $errors[] = "NIM tidak boleh kosong.";
} elseif (strlen($nim) !== 10) {
    $errors[] = "NIM harus 10 karakter.";
}

if (empty($nama)) {
    $errors[] = "Nama tidak boleh kosong.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}

if (empty($jurusan) || !is_numeric($jurusan)) {
    $errors[] = "Jurusan harus dipilih.";
}

if (empty($dosen) || !is_numeric($dosen)) {
    $errors[] = "Dosen wali harus dipilih.";
}

if (!empty($errors)) {
    $error_msg = urlencode(implode(" | ", $errors));
    header("Location: form_mahasiswa.php?status=error&msg=$error_msg");
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO Tb_Mahasiswa (NIM, Nama_Mhs, email, id_jurusan_fk, id_Dosenwali_fk) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nim, $nama, $email, $jurusan, $dosen]);
    
    header('Location: form_mahasiswa.php?status=success');
    exit;
} catch (PDOException $e) {
    $error_msg = urlencode("Error: " . $e->getMessage());
    header("Location: form_mahasiswa.php?status=error&msg=$error_msg");
    exit;
}
?>