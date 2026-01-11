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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Form Input Data Mahasiswa</h1>
    
    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <p class="success">Data mahasiswa berhasil disimpan!</p>
        <?php elseif ($_GET['status'] == 'error'): ?>
            <p class="error">Gagal menyimpan data. Periksa kembali input Anda.</p>
        <?php endif; ?>
    <?php endif; ?>

    <form action="proses_input.php" method="POST">
        <label for="nim">NIM (10 karakter):</label>
        <input type="text" id="nim" name="nim" maxlength="10" required>

        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="jurusan">Jurusan:</label>
        <select id="jurusan" name="jurusan" required>
            <option value="">Pilih Jurusan</option>
            <?php foreach ($jurusan as $j): ?>
                <option value="<?= $j['id_jurusan'] ?>"><?= htmlspecialchars($j['Nama_Jurusan']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="dosen">Dosen Wali:</label>
        <select id="dosen" name="dosen" required>
            <option value="">Pilih Dosen Wali</option>
            <?php foreach ($dosen as $d): ?>
                <option value="<?= $d['id_Dosen'] ?>"><?= htmlspecialchars($d['Nama_Dosen']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Simpan Data</button>
    </form>

    <p style="margin-top: 20px;">
        <a href="daftar_mahasiswa.php">Lihat Daftar Mahasiswa</a>
    </p>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const container = document.createElement('div');
            container.className = 'container';
            
            while(body.firstChild) {
                container.appendChild(body.firstChild);
            }
            body.appendChild(container);
            
            const header = document.createElement('div');
            header.className = 'header';
            header.innerHTML = `
                <h1><i class="fas fa-university"></i> Sistem Input Data Mahasiswa</h1>
                <p>Fakultas Sains & Teknologi - Universitas Teknologi Yogyakarta</p>
            `;
            container.insertBefore(header, container.firstChild);
            
            const content = document.createElement('div');
            content.className = 'content';
            const elementsToWrap = Array.from(container.children).slice(1);
            elementsToWrap.forEach(el => content.appendChild(el));
            container.appendChild(content);
            
            const footer = document.createElement('div');
            footer.className = 'footer';
            footer.innerHTML = `
                <p>&copy; <?= date('Y') ?> - Ujian Akhir Semester Pemrograman Web</p>
            `;
            container.appendChild(footer);
            
            const navMenu = document.createElement('div');
            navMenu.className = 'nav-menu';
            navMenu.innerHTML = `
                <a href="form_mahasiswa.php" class="nav-btn">
                    <i class="fas fa-user-plus"></i> Input Mahasiswa
                </a>
                <a href="daftar_mahasiswa.php" class="nav-btn secondary">
                    <i class="fas fa-list"></i> Daftar Mahasiswa
                </a>
            `;
            content.insertBefore(navMenu, content.firstChild);
            
            const form = document.querySelector('form');
            if (form) {
                form.className = 'form-container';
                const formGroups = form.querySelectorAll('label, input, select, button');
                formGroups.forEach(el => {
                    if (el.tagName === 'LABEL') el.className = 'form-group';
                    if (el.tagName === 'INPUT' || el.tagName === 'SELECT') el.className = 'form-control';
                    if (el.tagName === 'BUTTON') el.className = 'submit-btn';
                });
            }
            
            const messages = document.querySelectorAll('.success, .error');
            messages.forEach(msg => {
                msg.className = msg.classList.contains('success') ? 'alert alert-success' : 'alert alert-error';
                if (msg.classList.contains('success')) {
                    msg.innerHTML = `<i class="fas fa-check-circle"></i> ` + msg.textContent;
                } else {
                    msg.innerHTML = `<i class="fas fa-exclamation-circle"></i> ` + msg.textContent;
                }
            });
        });
    </script>
</body>
</html>