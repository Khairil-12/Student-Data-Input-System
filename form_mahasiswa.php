<?php
require_once 'db_connect.php';

$query_jurusan = $pdo->query("SELECT * FROM Tb_Jurusan ORDER BY Nama_Jurusan");
$jurusan = $query_jurusan->fetchAll();
$query_dosen = $pdo->query("SELECT * FROM Tb_Dosen ORDER BY Nama_Dosen");
$dosen = $query_dosen->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Form Input Data Mahasiswa</h1>
            <p>Fakultas Sains & Teknologi - Universitas Teknologi Yogyakarta</p>
        </div>
        
        <div class="content">
            <div class="nav-menu">
                <a href="form_mahasiswa.php" class="nav-btn">Input Mahasiswa</a>
                <a href="daftar_mahasiswa.php" class="nav-btn secondary">Daftar Mahasiswa</a>
            </div>
            
            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'success'): ?>
                    <div class="alert alert-success">
                        Data mahasiswa berhasil disimpan!
                    </div>
                <?php elseif ($_GET['status'] == 'error'): ?>
                    <div class="alert alert-error">
                        <?php 
                        echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Gagal menyimpan data.';
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <div class="form-container">
                <form action="proses_input.php" method="POST">
                    <div class="form-group">
                        <label for="nim">NIM (10 karakter):</label>
                        <input type="text" id="nim" name="nim" maxlength="10" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa:</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="jurusan">Jurusan:</label>
                        <select id="jurusan" name="jurusan" class="form-control" required>
                            <option value="">-- Pilih Jurusan --</option>
                            <?php foreach ($jurusan as $j): ?>
                                <option value="<?= $j['id_jurusan'] ?>">
                                    <?= htmlspecialchars($j['Nama_Jurusan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="dosen">Dosen Pembimbing:</label>
                        <select id="dosen" name="dosen" class="form-control" required>
                            <option value="">-- Pilih Dosen Pembimbing --</option>
                            <?php foreach ($dosen as $d): ?>
                                <option value="<?= $d['id_Dosen'] ?>">
                                    <?= htmlspecialchars($d['Nama_Dosen']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="submit-btn">Simpan Data</button>
                </form>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; <?= date('Y') ?> - Ujian Akhir Semester Pemrograman Web</p>
            <p>Dosen: Moh. Ali Romli, S.Kom., M.Kom. & Sutarman, S.Kom., M.Kom., Ph.D.</p>
        </div>
    </div>
</body>
</html>