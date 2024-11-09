-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2024 pada 05.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `NamaAdmin` varchar(100) NOT NULL,
  `EmailAdmin` varchar(100) NOT NULL,
  `PasswordAdmin` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `BukuID` int(11) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Penulis` varchar(255) NOT NULL,
  `Penerbit` varchar(255) NOT NULL,
  `TahunTerbit` int(11) NOT NULL,
  `Deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `TahunTerbit`, `Deskripsi`, `gambar`) VALUES
(5, 'Solo Leveling', 'h-qoon', 'D&C MEDIA', 2016, 'Solo Leveling adalah salah satu novel berseri berbahasa Korea asal Korea Selatan yang ditulis oleh Chugong. Novel ini awalnya diterbitkan dalam bentuk novel web di layanan komik dan fiksi digital milik perusahaan Kakao, yaitu KakaoPage pada tanggal 25 Juli 2016.', '1729567001_571c4b4f913065f2bc5b.jpg'),
(6, 'Oshi no Ko', 'Aka Akasaka', 'Aka Akasaka', 2020, 'Berkisah tentang seorang dokter spesialis kandungan bernama Goro Amemiya yang merawat seorang pasien yang tengah hamil bernama Ai Hoshino, seorang idol terkenal yang sekaligus adalah oshi-nya Goro. Ai yang merupakan seorang idol tidak ingin seluruh fansnya tau bahwa dia tengah mengandung, sehingga dirawat di rumah sakit pelosok tempat Goro bekerja', '1729262983_7f1c92f75c2ec04a8e78.jpg'),
(7, 'Frieren: After The End', 'Kanehito Yamada', 'Kanehito Yamada', 2020, 'Berkisah tentang Frieren si penyihir elf, mantan anggota kelompok petualang yang mengalahkan Demon King dan mengembalikan kedamaian di dunia setelah 10 tahun berpetualang. Di kelompok petualang tersebut, selain Freiren, terdapat juga Himmel si pahlawan manusia, Eisen si prajurit dwarf, dan Heiter si pendeta manusia. Sebelum mereka berpisah, mereka mengamati Hujan Meteor Era, hujan meteor yang muncul 50 tahun sekali, bersama-sama. Frieren setuju untuk menemui mereka lagi 50 tahun ke depan dan menawarkan mereka tempat dengan pemandangan yang lebih baik untuk melihat kembali hujan meteor. Frieren lalu pergi berkelana mengelilingi dunia untuk memperkaya kekuatan sihirnya.', '1729401545_21fc9ee6a9b83808d399.png'),
(8, 'BOCHIII THE ROCK', 'dasdasd', 'asdad', 4333, 'dasd adddddddddde eeeeeeeeeeeeeas aaaaaaaaa', '1729567436_df72e59747d79d29e586.jpg'),
(9, 'The World After the Fall', 'Sing-Shong', 'Redice Studio', 2022, 'Jaehwan was an ordinary person buying chips at a local convenience store when strange towers suddenly appeared around the world, summoning people inside. Choosing to accept the summons, he witnessed monsters ravaging his home and managed to conquer 100 levels, defeating various boss monsters along the way. In the end, he discovered that the Tower was an illusion and that humanity had not been destroyed. ', '1729406361_3ae6953a948f66f9749c.png'),
(13, 'qeqw', 'dqqwdeq', '33322sdasd', 434, ' dawd dweadsdasdadw ew aaaaaaaa', '1729414523_67de87c31f0d90acbca2.jpg'),
(16, 'Yozakura-san Chi no Daisakusen', 'Hitsuji Gondaira', 'Shueisha', 2019, 'Taiyo Asano adalah seorang siswa SMA yang sangat pemalu. Satu-satunya orang yang berani untuk diajaknya bicara adalah teman masa kecilnya, Mutsumi Yozakura. Kemudian terungkap bahwa Mutsumi merupakan putri dari keluarga Yozakura, salah satu keluarga mata-mata. ', '1729567494_989c5c6e6d991ab085b4.png'),
(18, 'Ensiklopedia Sejarah Dunia', 'Usborne', 'Bhuana Ilmu Populer', 2021, 'Buku terbaru ini akan memperkenalkan kalian pada sejarah dunia, dari zaman prasejarah hingga awal abad ke-21. Di dalam buku ini, kalian akan menemukan informasi mengenai dinosaurus, manusia pertama, Mesir Kuno, Kekaisaran Aztec, Abad Pertengahan di Eropa, Perang Dunia I, dan banyak hal-hal menarik lainnya.', '1730081714_ceee8c346a3cb4b7bb0f.jpg'),
(19, 'Ensiklopedia Mini: Alam Semesta', 'Yusup Somadinata', 'Elex Media Komputindo', 2021, 'Dari tempat tinggal kita di Bumi, kita menuju dunia aneh yang mempunyai udara beracun, gunung berapi raksasa, lautan tersembunyi bahkan dunia yang mempunyai hujan berlian! Kita juga akan menemukan planet bercincin, bintang terpanas, nebula yang indah, galaksi dengan triliunan bintang serta banyak objek luar angkasa menakjubkan lainnya.', '1730081907_b96470feaa648a3a28c3.jpg'),
(20, 'No Longer Human', 'Osamu Dazai', 'New Directions', 1958, 'Osamu Dazai\'s No Longer Human, this leading postwar Japanese writer\'s second novel, tells the poignant and fascinating story of a young man who is caught between the breakup of the traditions of a northern Japanese aristocratic family and the impact of Western ideas. In consequence, he feels himself \"disqualified from being human\" (a literal translation of the Japanese title)', '1730082083_156d0fb3edb83210d043.jpg'),
(21, 'Mohammad Hatta : Biografi Singkat 1902 - 1980', 'Salman Alfarizi', 'Garasi', 2020, 'MOHAMMAD HATTA : BIOGRAFI SINGKAT 1902 - 1980', '1730082264_8a3785b8217230aef3b3.jpg'),
(22, 'The Beginning After The End', 'TurtleMe (Brandon Lee)', ' Tapas', 2017, 'The Beginning After The End is an epic fantasy Light Novel, which is written by TurtleMe. The novel is on Tapas, where it is updated weekly. It is currently available in English. There exists also a webcomic adaptation, which can be found on Tapas as well. ', '1730082546_8f85f1da8415540192cd.webp'),
(23, 'Overlord', 'Kugane Maruyama', 'Arkadia', 2012, 'Overlord (Japanese: オーバーロード, Hepburn: Ōbārōdo) is a Japanese light novel series written by Kugane Maruyama and illustrated by so-bin. It began serialization online in 2010, before being acquired by Enterbrain. Sixteen volumes have been published since July 2012. A manga adaptation by Satoshi Ōshio, with art by Hugin Miyama, began serialization in Kadokawa Shoten\'s manga magazine Comp Ace from November 26, 2014. Both the light novels and the manga are licensed in North America by Yen Press since 2016.', '1730083137_058a2b9ddad039b11d44.webp'),
(24, 'Artificial Intelligence: A Textbook ', 'Charu C Aggarwal', 'Springer International Publishing', 2021, 'The primary audience for this textbook are professors and advanced-level students in computer science. It is also possible to use this textbook for the mathematics requirements for an undergraduate data science course. Professionals working in this related field many also find this textbook useful as a reference.', '1730085124_5107fceca8a72c5d6cf8.webp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` int(11) NOT NULL,
  `NamaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
(1, 'Manga'),
(2, 'Light Novel'),
(3, 'Cerpen'),
(4, 'Ensiklopedia'),
(5, 'Novel'),
(6, 'Biografi'),
(7, 'Manhwa'),
(8, 'Komedi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `KetogoriBukuID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `KategoriID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategoribuku_relasi`
--

INSERT INTO `kategoribuku_relasi` (`KetogoriBukuID`, `BukuID`, `KategoriID`) VALUES
(4, 8, 4),
(7, 13, 3),
(11, 6, 1),
(12, 7, 1),
(13, 5, 7),
(14, 9, 7),
(15, 16, 1),
(16, 18, 4),
(17, 19, 4),
(18, 20, 5),
(19, 21, 6),
(20, 22, 2),
(21, 23, 2),
(22, 24, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `TanggalDitambahkan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`, `TanggalDitambahkan`) VALUES
(9, 2, 7, '2024-10-27 03:03:29'),
(11, 2, 5, '2024-10-27 03:32:55'),
(12, 2, 6, '2024-10-27 04:31:53'),
(13, 2, 9, '2024-10-27 04:32:29'),
(17, 9, 5, '2024-10-27 16:19:01'),
(19, 15, 5, '2024-10-28 03:03:26'),
(20, 15, 9, '2024-10-28 03:03:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `PeminjamanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `TanggalPeminjaman` date NOT NULL,
  `TanggalPengembalian` date NOT NULL,
  `StatusPeminjaman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`PeminjamanID`, `UserID`, `BukuID`, `TanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`) VALUES
(1, 2, 5, '2024-10-21', '2045-03-31', 'Dikembalikan'),
(2, 9, 6, '2024-10-21', '2233-03-31', 'Dipinjam'),
(3, 2, 8, '2024-10-21', '2024-10-21', 'Dikembalikan'),
(4, 2, 5, '2024-10-22', '4444-04-04', 'Dikembalikan'),
(5, 2, 5, '2024-10-27', '6323-05-31', 'Dipinjam'),
(6, 2, 16, '2024-10-27', '2024-10-27', 'Dikembalikan'),
(7, 2, 16, '2024-10-27', '2024-10-27', 'Dikembalikan'),
(8, 2, 13, '2024-10-27', '3333-03-23', 'Dipinjam'),
(9, 9, 13, '2024-10-27', '3333-03-31', 'Dipinjam'),
(10, 2, 8, '2024-10-27', '4444-04-02', 'Dipinjam'),
(11, 15, 5, '2024-10-28', '2024-10-29', 'Dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `PetugasID` int(11) NOT NULL,
  `NamaPetugas` varchar(100) NOT NULL,
  `EmailPetugas` varchar(100) NOT NULL,
  `PasswordPetugas` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `Ulasan` text NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`UlasanID`, `UserID`, `BukuID`, `Ulasan`, `Rating`) VALUES
(1, 9, 5, 'GOAT', 5),
(2, 9, 7, 'GOAT MANGA', 10),
(3, 2, 6, 'manga ngeri', 7),
(4, 2, 8, 'konyol', 10),
(5, 2, 9, 'ini GOAT bro!! apakah ini berhasil??', 10),
(8, 2, 5, 'sdsddsd', 3),
(9, 2, 22, 'saya suka saya suka saya suka', 9),
(10, 15, 5, 'ini buku bagus', 10),
(11, 15, 6, '-', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `role` enum('admin','petugas','peminjam') DEFAULT 'peminjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `role`) VALUES
(1, 'Acumalaka', '$2y$10$T.Yvaq6oSF8ib2q57pSSR..gDaosQZPWheG.U/JPdd9VhUKlARfa.', 'neko@gmail.com', 'ACUMALAKA', 'JL CEMPAKAdsad', 'admin'),
(2, 'user', '$2y$10$AWlDK.2MIDsWPM5E1gcgdOUV/X1SF1KlGfUioh1CEUN956goAQstK', 'neko@gmail.com', 'ACUMALAKAss', '..........................sadda', 'peminjam'),
(3, 'skibidi', '$2y$10$v/S99NhbWxGIWJ.AnLUZs.2ncB/L3K72wvHw5mVXeQRJUUFAY1gpK', 'neko@gmail.com', 'skibidi', 'Jl Taniasli Komplek Green Harmoni Residence. Blok B.16', 'admin'),
(5, 'sdasdsd', '$2y$10$BrRGtk4a2Tn7e7btuk3/9eH/pgNcg836Pf0Zw/qOuGikheSkiV/dS', 'shiroNeko@gmail', 'Shiro Neko', 'Jl Taniasli Komplek Green Harmoni Residence. Blok B.16', 'admin'),
(9, 'user2', '$2y$10$63HPxOW.l1SaW81jKxECP.rorCcsV86Mxm6d8QM27ZR4tcYZGPK8e', 'asdasd@DA', 'USERman', 'Jl Taniasli Komplek Green Harmoni Residence. Blok B.16', 'peminjam'),
(10, 'kakdld', '$2y$10$MukK.QMrlu1grYYii2N9BOgZ4Ns/M4frL8uF/laAwV06QicM65o8.', 'SAsda@ad', 'tessss', 'adadadddd', 'peminjam'),
(11, 'admin', '$2y$10$1f3TvEr4iZ7J7IFnAVorM.lq9DHX8rjGXADyizxcJUYkAW3U0vvVG', 'ad@gmail.com', 'Sulaiman AR', 'Jl Taniasli Komplek Green Harmoni Residence. Blok B.16', 'peminjam'),
(12, 'arigata', '$2y$10$L6X4XY7IiOi.i6DrmxpHtOXvJtCwcrfN9ypnJYp0UmkIsk9fboPZy', 'ar@gmail', 'ARigata', 'Jl. Tapola', 'peminjam'),
(13, 'tes1', '$2y$10$1fGYx0iry4MNEuXg.dh7HOeH0cDbFczSXQx1.mJea6TDDQzh0gXg6', 'tes@gmail', 'TES', 'jl TEs', 'peminjam'),
(14, 'tes2', '$2y$10$FAiwPRc96wcL4MRzzefBjewxv2GYcBPA8MGkPaK0R6FJsMB/GBUoq', 'tes@s', 'Tes', 'jl tes', 'peminjam'),
(15, 'sulaiman', '$2y$10$wajS1i5y/ipV/CyczPeB4.hLc8gb6vu0w78XS0XEydSQ1YsjWxGzq', 'sulaiman@gmail', 'Sulaiman AR', 'Jl Taniasli Komplek Green Harmoni Residence. Blok B.16', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `EmailAdmin` (`EmailAdmin`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indeks untuk tabel `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indeks untuk tabel `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`KetogoriBukuID`),
  ADD KEY `KategoriID` (`KategoriID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indeks untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`PeminjamanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`PetugasID`),
  ADD UNIQUE KEY `EmailPetugas` (`EmailPetugas`);

--
-- Indeks untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`),
  ADD KEY `BukuID` (`BukuID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `KategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `KetogoriBukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `PeminjamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `PetugasID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`KategoriID`) REFERENCES `kategoribuku` (`KategoriID`),
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Ketidakleluasaan untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Ketidakleluasaan untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`),
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
