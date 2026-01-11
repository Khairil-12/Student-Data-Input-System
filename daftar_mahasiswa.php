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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    
    <?php if (empty($mahasiswa)): ?>
        <p>Belum ada data mahasiswa.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
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
    <?php endif; ?>
    
    <p style="margin-top: 20px;">
        <a href="form_mahasiswa.php">Kembali ke Form Input</a>
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
                <h1><i class="fas fa-users"></i> Daftar Mahasiswa</h1>
                <p>Data Mahasiswa dengan Informasi Jurusan dan Dosen Wali</p>
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
                <p>&copy; <?= date('Y') ?> - Sistem Informasi Mahasiswa</p>
            `;
            container.appendChild(footer);
            
            const navMenu = document.createElement('div');
            navMenu.className = 'nav-menu';
            navMenu.innerHTML = `
                <a href="form_mahasiswa.php" class="nav-btn">
                    <i class="fas fa-user-plus"></i> Input Mahasiswa Baru
                </a>
                <a href="daftar_mahasiswa.php" class="nav-btn secondary">
                    <i class="fas fa-list"></i> Lihat Daftar Mahasiswa
                </a>
            `;
            content.insertBefore(navMenu, content.firstChild);
            
            const table = document.querySelector('table');
            if (table) {
                table.className = 'data-table';
                const tableContainer = document.createElement('div');
                tableContainer.className = 'table-container';
                table.parentNode.insertBefore(tableContainer, table);
                tableContainer.appendChild(table);
            }
            
            const links = document.querySelectorAll('a');
            links.forEach(link => {
                if (link.href.includes('form_mahasiswa.php')) {
                    link.className = 'nav-btn';
                }
            });
            
            const infoBox = document.createElement('div');
            infoBox.className = 'alert alert-info';
            infoBox.innerHTML = `<i class="fas fa-info-circle"></i> Menampilkan ${<?= count($mahasiswa) ?>} mahasiswa menggunakan query JOIN 3 tabel.`;
            content.insertBefore(infoBox, content.children[1]);
        });
    </script>
</body>
</html>