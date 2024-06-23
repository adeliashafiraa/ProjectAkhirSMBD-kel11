-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2019 pada 08.27
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `kode` varchar(10) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `jenis_cuti` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `status` enum('Approved','Rejected','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`kode`, `nik`, `tanggal_awal`, `tanggal_akhir`, `jumlah`, `jenis_cuti`, `ket`, `status`) VALUES
('CT5185', '12132', '2018-06-29', '2018-06-29', '1', 'Cuti Khitan Anak', 'test', 'Approved'),
('CT5628', '10161', '2018-07-06', '2018-07-07', '2', 'Cuti Mendadak', 'test', 'Approved');

INSERT INTO `cuti` (`kode`, `nik`, `tanggal_awal`, `tanggal_akhir`, `jumlah`, `jenis_cuti`, `ket`, `status`) VALUES
('CT5185', '12132', '2018-07-25', '2018-08-05', '1', 'Cuti Traveling', 'Cuti Liburan Ke Hungaria', 'Approved'),

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_dept` varchar(10) NOT NULL,
  `nama_dept` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_dept`, `nama_dept`) VALUES
('D4098', 'Accounting'),
('D5120', 'IT'),
('D5273', 'HRGA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tunjangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `tunjangan`) VALUES
('J2051', 'Supervisor', '350000'),
('J3066', 'Leader', '200000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_cuti`
--

CREATE TABLE `jenis_cuti` (
  `id_cuti` varchar(10) NOT NULL,
  `nama_cuti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id_cuti`, `nama_cuti`) VALUES
('VC3007', 'Cuti Khitan Anak'),
('VC3132', 'Cuti Mendadak'),
('VC6503', 'Cuti Melahirkan'),
('VC7268', 'Cuti Hamil');

INSERT INTO `jenis_cuti` (`id_cuti`, `nama_cuti`) VALUES
('VC3001', 'Cuti Traveling')

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` enum('TETAP','PKWT','PKWTT') NOT NULL,
  `jumlah_cuti` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Superuser','User') NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `tanggal_masuk`, `departemen`, `jabatan`, `status`, `jumlah_cuti`, `username`, `password`, `level`, `gambar`) VALUES
('10161', 'Hakko Bio Richard', '2018-04-21', 'IT', 'Supervisor', 'PKWTT', '6', 'hakko', 'fb92eb16a09ed530c91a0e17d9d61a7758754013', 'Admin', 'gambar_admin/5.jpg'),
('10222', 'testing', '2017-07-30', 'HRGA', 'Supervisor', 'TETAP', '0', 'test', 'c4033bff94b567a190e33faa551f411caef444f2', 'Admin', 'gambar_admin/4.jpg'),
('12132', 'test', '2018-06-01', 'Accounting', 'Supervisor', 'PKWTT', '9', 'test', 'c4033bff94b567a190e33faa551f411caef444f2', 'Admin', 'gambar_admin/4.jpg'),
('1232434', 'test', '2018-10-09', 'IT', 'Supervisor', 'PKWTT', '12', 'testing', '4c0d2b951ffabd6f9a10489dc40fc356ec1d26d5', 'Admin', 'gambar_admin/cuti.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jenis_cuti`
--
ALTER TABLE `jenis_cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);
COMMIT;

DELIMITER //

CREATE PROCEDURE GetCutiKaryawan(IN startDate DATE, IN endDate DATE)
BEGIN
    SELECT k.nama, COUNT(c.nik) as jumlah_cuti 
    FROM cuti c
    JOIN karyawan k ON c.nik = k.nik
    WHERE c.tanggal_awal >= startDate AND c.tanggal_akhir <= endDate AND c.status = 'Approved'
    GROUP BY c.nik;
END //

DELIMITER ;

-- Stored Procedure 2
DELIMITER //

CREATE PROCEDURE DataJumlahDepartemen(IN id_departemen1 VARCHAR (10), IN id_departemen2 VARCHAR (10), IN id_departemen3 VARCHAR (10))
BEGIN
    SELECT 
        d.nama_dept AS DepartmentName,
        COUNT(k.nik) AS EmployeeCount
    FROM 
        departemen d
    LEFT JOIN 
        karyawan k ON d.nama_dept = k.departemen
    WHERE
	d.id_dept IN (id_departemen1, id_departemen2, id_departemen3)
    GROUP BY 
        d.id_dept, d.nama_dept;
END //

DELIMITER ;

-- Untuk Bagian Login (Stored Procedure)
DELIMITER //

CREATE PROCEDURE LoginProcedure (
    IN input_username VARCHAR(50), 
    IN input_password VARCHAR(255), 
    OUT login_status VARCHAR(20)
)
BEGIN
    DECLARE user_level ENUM('Admin', 'Superuser', 'User');
    
    -- Memeriksa kredensial dan level user
    SELECT `level` INTO user_level
    FROM `karyawan`
    WHERE `username` = input_username AND `password` = input_password
    LIMIT 1;
    
    -- Menentukan status login
    IF user_level IN ('Admin', 'Superuser') THEN
        SET login_status = 'Success';
    ELSE
        SET login_status = 'Failure';
    END IF;
END //

DELIMITER ;

-- Registrasi Akun Baru
DELIMITER //

CREATE PROCEDURE TambahKaryawan(
    IN p_nik VARCHAR(10),
    IN p_nama VARCHAR(100),
    IN p_tanggal_masuk DATE,
    IN p_departemen VARCHAR(50),
    IN p_jabatan VARCHAR(50),
    IN p_status ENUM('TETAP', 'PKWT', 'PKWTT'),
    IN p_username VARCHAR(50),
    IN p_password TEXT,
    IN p_level ENUM('Admin', 'Superuser', 'User')
)
BEGIN
    -- Insert ke tabel karyawan
    INSERT INTO karyawan (nik, nama, tanggal_masuk, departemen, jabatan, STATUS, username, PASSWORD, LEVEL)
    VALUES (p_nik, p_nama, p_tanggal_masuk, p_departemen, p_jabatan, p_status, p_username, p_password, p_level);
END //

DELIMITER ;

-- Trigger Registrasi
DELIMITER //

CREATE TRIGGER trg_validate_level
BEFORE INSERT ON karyawan
FOR EACH ROW
BEGIN
    DECLARE level_valid ENUM('Admin', 'Superuser', 'User');

    SET level_valid = NULL;

    -- Cek jika level yang dimasukkan valid
    IF NEW.level IN ('Admin', 'Superuser', 'User') THEN
        SET level_valid = NEW.level;
    END IF;

    -- Jika level tidak valid, hasilkan error
    IF level_valid IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Level yang dimasukkan tidak valid. Harus berupa Admin, Superuser, atau User.';
    END IF;
END //

DELIMITER ;

-- View
/* - menampilkan jumlah karyawan, departemen, jabatan, jumlah cuti request*/
-- jumlah karyawan
CREATE VIEW vw_jumKaryawan AS
SELECT COUNT(nik) AS jumlah_karyawan 
FROM karyawan; 

SELECT * FROM vw_jumKaryawan;

-- jumlah departemen
CREATE VIEW vw_jumDepartement AS
SELECT COUNT(id_dept) AS jumlah_departemen
FROM departemen; 

SELECT * FROM vw_jumDepartement;

-- jumlah jabatan
CREATE VIEW vw_jumJabatan AS
SELECT COUNT(id_jabatan) AS jumlah_jabatan
FROM jabatan; 

SELECT * FROM vw_jumJabatan;

-- jumlah cuti request
CREATE VIEW vw_reqCuti AS
SELECT COUNT(*) AS jumlah_reqCuti
FROM cuti
WHERE STATUS = 'Approved';

SELECT * FROM vw_reqCuti;

CREATE VIEW vw_reqCutiPending AS
SELECT COUNT(*) AS jumlah_reqCutiPending
FROM cuti
WHERE STATUS = 'Pending';

SELECT * FROM vw_reqCutiPending;

-- menampilkan tabel cuti (nama karyaan dan jenis cuti)
CREATE VIEW vw_karyawanCuti AS
SELECT 
    k.nama,
    c.nik,
    c.tanggal_awal,
    c.tanggal_akhir,
    c.jenis_cuti,
    c.STATUS
FROM 
    cuti c
JOIN 
    karyawan k ON c.nik = k.nik;

SELECT * FROM vw_karyawanCuti;

-- menampilkan cuti rejected
CREATE VIEW vw_reqCutiRejected AS
SELECT COUNT(*) AS jumlah_reqCutiRejected
FROM cuti
WHERE STATUS = 'Rejected';

SELECT * FROM vw_reqCutiRejected;

-- Stored Procedure (Khusus Karyawan)
DELIMITER//
CREATE PROCEDURE cariKaryawan(keyword VARCHAR(50))
BEGIN
	SELECT 
		nik AS Nik, 
		nama AS Nama, 
		tanggal_masuk AS tgl_masuk, 
		departemen AS dept, 
		jabatan AS jabatan, 
		STATUS AS stts, 
		jumlah_cuti AS jumCuti, 
		username AS Uname, 
		PASSWORD AS pw, 
		LEVEL AS lv, 
		gambar AS pict
FROM karyawan WHERE nik LIKE CONCAT('%', keyword, '%') OR nama LIKE CONCAT('%', keyword, '%');
END//
DELIMITER; 

CALL cariKaryawan('andi');

-- Stored Procedure Insert Karyawan
DELIMITER//
CREATE PROCEDURE insertToKaryawan (
	IN Nik VARCHAR(10),
	IN Nama VARCHAR(100),
	IN Tanggal_masuk DATE,
	IN Departemen VARCHAR(50),
	IN Jabatan VARCHAR(50),
	IN`Status` ENUM('TETAP','PKWT','PKWTT'),
	IN Jumlah_cuti VARCHAR(10),
	IN Username VARCHAR(50),
	IN PASSWORD TEXT,
	IN LEVEL ENUM('Admin','Superuser','User'),
	IN Gambar TEXT
)
BEGIN
    INSERT INTO karyawan VALUES (
        Nik, 
        Nama, 
        Tanggal_masuk, 
        Departemen, 
        Jabatan, 
        STATUS, 
        Jumlah_cuti, 
        Username, 
        PASSWORD, 
        LEVEL, 
        Gambar
    );
END//
DELIMITER ;

-- Stored Procedure Untuk Insert Karyawan
DELIMITER //
CREATE PROCEDURE buatDataKaryawan(
    IN p_nik VARCHAR(10),
    IN p_nama VARCHAR(100),
    IN p_tanggal_masuk DATE,
    IN p_departemen VARCHAR(50),
    IN p_jabatan VARCHAR(50),
    IN p_status ENUM('TETAP','PKWT','PKWTT'),
    IN p_jumlah_cuti VARCHAR(10),
    IN p_username VARCHAR(50),
    IN p_password TEXT,
    IN p_level ENUM('Admin','Superuser','User'),
    IN p_gambar TEXT
)
BEGIN
    DECLARE keterangan VARCHAR(100);

    IF EXISTS (SELECT 1 FROM karyawan WHERE username = p_username) THEN
        SET keterangan = 'username sudah ada, silahkan buat username kembali';
    ELSE
        INSERT INTO karyawan (
            nik,
            nama,
            tanggal_masuk,
            departemen,
            jabatan,
            STATUS,
            jumlah_cuti,
            username,
            PASSWORD,
            LEVEL,
            gambar
        ) VALUES (
            p_nik,
            p_nama,
            p_tanggal_masuk,
            p_departemen,
            p_jabatan,
            p_status,
            p_jumlah_cuti,
            p_username,
            p_password,
            p_level,
            p_gambar
        );
        SET keterangan = 'data telah ditambahkan';
    END IF;

    SELECT keterangan;
END //
DELIMITER ;

CALL buatDataKaryawan('1209', 'fira', '2024-05-07', 'it', 'staff', 'TETAP', '6', 'adel', '0987', 'Admin', '');

-- Stored Procedure Untuk Mengambil Data Cuti
DELIMITER //
CREATE PROCEDURE buat_cuti (
    IN p_kode VARCHAR(10),
    IN p_nik VARCHAR(10),
    IN p_tanggal_awal DATE,
    IN p_tanggal_akhir DATE,
    IN p_jumlah VARCHAR(10),
    IN p_jenis_cuti VARCHAR(50),
    IN p_ket VARCHAR(50),
    IN p_status ENUM('Approved','Rejected','Pending'),
    IN p_tanggal_masuk DATE
)
BEGIN
    IF p_tanggal_akhir < p_tanggal_awal THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal akhir cuti tidak boleh lebih awal dari tanggal awal cuti';
    ELSE
        INSERT INTO cuti (kode, nik, tanggal_awal, tanggal_akhir, jumlah, jenis_cuti, ket, STATUS, tanggal_masuk)
        VALUES (p_kode, p_nik, p_tanggal_awal, p_tanggal_akhir, p_jumlah, p_jenis_cuti, p_ket, p_status, p_tanggal_masuk);
    END IF;
END //
DELIMITER ;

-- Trigger Untuk Update Data Cuti
DELIMITER//
CREATE TRIGGER sebelum_update_cuti BEFORE UPDATE ON cuti 
    FOR EACH ROW 
BEGIN
    DECLARE hari_cuti INT;

    -- Validasi cuti_terakhir tidak boleh kurang dari tanggal_awal
    IF NEW.tanggal_masuk <= NEW.tanggal_awal THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal masuk tidak boleh kurang dari tanggal awal';
    END IF;

    -- Hitung jumlah hari cuti dari tanggal_awal sampai cuti_terakhir
    SET hari_cuti = DATEDIFF(NEW.tanggal_masuk, NEW.tanggal_awal) + 1;

    -- Set kolom jumlah dengan hari_cuti
    SET NEW.jumlah = hari_cuti;
END//
DELIMITER ;

-- Trigger Untuk Hapus Data Cuti
DELIMITER //
CREATE TRIGGER hapusCuti
BEFORE DELETE ON cuti
FOR EACH ROW
BEGIN
    IF OLD.status <> 'Approved' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Hanya data cuti dengan status Approved yang bisa dihapus';
    END IF;
END //
DELIMITER ;

-- Procedure Delete Karyawan
DELIMITER $$
CREATE PROCEDURE deleteKaryawan(
    IN p_nik VARCHAR(10)
)
BEGIN
    DELETE FROM karyawan 
    WHERE nik = p_nik;
END $$
DELIMITER ;

-- Update Data Departemen
DELIMITER//

CREATE PROCEDURE updateDepartemen(IN dept_id VARCHAR(10), IN nama_dept VARCHAR(50))
BEGIN
    UPDATE departemen
    SET nama_dept = nama_dept
    WHERE id_dept = dept_id;
END//

DELIMITER ;

-- Mendapatkan Data Departemen Berdasarkan ID
DELIMITER//

CREATE PROCEDURE getDepartemenById(IN dept_id VARCHAR(10))
BEGIN
    SELECT * FROM departemen WHERE id_dept = dept_id;
END//

DELIMITER ;

-- Menghapus Data Departemen
DELIMITER//

CREATE PROCEDURE deleteDepartemen(IN dept_id VARCHAR(10))
BEGIN
    DELETE FROM departemen WHERE id_dept = dept_id;
END//

DELIMITER ;

-- Cari data cuti berdasarkan NIK
DELIMITER//

CREATE PROCEDURE searchCutiByNIK(IN p_nik VARCHAR(10))
BEGIN
    DECLARE v_done INT DEFAULT 0;
    DECLARE v_idx INT DEFAULT 0;
    DECLARE v_count INT;
    
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_cuti AS (
        SELECT kode, nik, tanggal_awal, tanggal_akhir, jumlah, jenis_cuti, ket, STATUS 
        FROM cuti 
        WHERE nik = p_nik
    );

    SELECT COUNT(*) INTO v_count FROM temp_cuti;

    WHILE v_idx < v_count DO
        SELECT 
            kode, nik, tanggal_awal, tanggal_akhir, jumlah, jenis_cuti, ket, STATUS 
        FROM temp_cuti
        LIMIT v_idx, 1;

        SET v_idx = v_idx + 1;
    END WHILE;

    DROP TEMPORARY TABLE IF EXISTS temp_cuti;
END//

DELIMITER ;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
