<?php
require_once 'db_connect.php';

$query = "
    SELECT 
        m.NIM,
        m.Nama_Mhs,
        m.email,
        j.Nama_Jurusan,
        d.Nama_Dosen
    FROM Tb_Mahasiswa m
    INNER JOIN Tb_Jurusan j ON m.id_jurusan_fk = j.id_jurusan
    INNER JOIN Tb_Dosen d ON m.id_Dosenwali_fk = d.id_Dosen
    ORDER BY m.NIM
";

$stmt = $pdo->query($query);
$mahasiswa = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Daftar Mahasiswa</h1>
            <p>Data Mahasiswa dengan Informasi Jurusan dan Dosen Pembimbing</p>
        </div>
        
        <div class="content">
            <div class="nav-menu">
                <a href="form_mahasiswa.php" class="nav-btn">Input Mahasiswa Baru</a>
                <a href="daftar_mahasiswa.php" class="nav-btn secondary">Lihat Daftar Mahasiswa</a>
            </div>

            <?php if (empty($mahasiswa)): ?>
                <div style="text-align: center; padding: 40px; color: #666;">
                    <h3>Belum ada data mahasiswa</h3>
                    <p>Silakan tambahkan data mahasiswa terlebih dahulu.</p>
                    <a href="form_mahasiswa.php" class="nav-btn" style="display: inline-block; margin-top: 15px;">
                        Tambah Mahasiswa
                    </a>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Dosen Wali</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mahasiswa as $m): ?>
                            <tr>
                                <td><?= htmlspecialchars($m['NIM']) ?></td>
                                <td><?= htmlspecialchars($m['Nama_Mhs']) ?></td>
                                <td><?= htmlspecialchars($m['email']) ?></td>
                                <td><?= htmlspecialchars($m['Nama_Jurusan']) ?></td>
                                <td><?= htmlspecialchars($m['Nama_Dosen']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p>&copy; <?= date('Y') ?> - Sistem Informasi Mahasiswa</p>
            <p>Universitas Teknologi Yogyakarta</p>
        </div>
    </div>
</body>
</html>