CREATE DATABASE IF NOT EXISTS `db_uas_pwt`;
USE `db_uas_pwt`;

CREATE TABLE IF NOT EXISTS `Tb_Jurusan` (
  `id_jurusan` INT NOT NULL AUTO_INCREMENT,
  `Nama_Jurusan` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Tb_Dosen` (
  `id_Dosen` INT NOT NULL AUTO_INCREMENT,
  `Nama_Dosen` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_Dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Tb_Mahasiswa` (
  `NIM` CHAR(10) NOT NULL,
  `Nama_Mhs` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `id_jurusan_fk` INT NOT NULL,
  `id_Dosenwali_fk` INT NOT NULL,
  PRIMARY KEY (`NIM`),
  FOREIGN KEY (`id_jurusan_fk`) REFERENCES `Tb_Jurusan`(`id_jurusan`) ON DELETE CASCADE,
  FOREIGN KEY (`id_Dosenwali_fk`) REFERENCES `Tb_Dosen`(`id_Dosen`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Tb_Jurusan` (`Nama_Jurusan`) VALUES
('Informatika'),
('Sistem Informasi'),
('Teknik Komputer');

INSERT INTO `Tb_Dosen` (`Nama_Dosen`) VALUES
('Moh. Ali Romli, S.Kom., M.Kom.'),
('Sutarman, S.Kom., M.Kom., Ph.D.'),
('Irma Handayani, S.KOM., M.CS.');

INSERT INTO `Tb_Mahasiswa` (`NIM`, `Nama_Mhs`, `email`, `id_jurusan_fk`, `id_Dosenwali_fk`) VALUES
('5240411199', 'Wildan akmal', 'Akmal12@gmail.com', 1, 1),
('5240411200', 'Arya Cahyo', 'Cahyo@gmail.com', 1, 2);