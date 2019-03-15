-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: notaris
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data_berkas`
--

DROP TABLE IF EXISTS `data_berkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_berkas` (
  `id_data_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `id_berkas` varchar(255) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `status_berkas` varchar(255) NOT NULL,
  `tanggal_dibuat` varchar(255) NOT NULL,
  `tanggal_selesai` varchar(255) DEFAULT NULL,
  `folder_berkas` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  `pembuat_berkas` varchar(255) NOT NULL,
  `jenis_perizinan` varchar(255) NOT NULL,
  `id_jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_berkas`),
  KEY `no_berkas` (`no_berkas`),
  KEY `id_jenis` (`id_jenis`),
  KEY `no_client` (`no_client`),
  CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `data_jenis_dokumen` (`no_jenis_dokumen`),
  CONSTRAINT `data_berkas_ibfk_2` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_berkas`
--

LOCK TABLES `data_berkas` WRITE;
/*!40000 ALTER TABLE `data_berkas` DISABLE KEYS */;
INSERT INTO `data_berkas` VALUES (39,'20190315/0001/000001','C_000001','000001','Proses','2019/03/15',NULL,'file_000001','0001','Dedy Ibrahim','Akta pendirian Perseroan Terbatas ( PT )','J_0001'),(40,'20190315/0001/000002','C_000002','000002','Proses','2019/03/15',NULL,'file_000002','0001','Dedy Ibrahim','Akta perubahan Koperasi','J_0008'),(41,'20190315/0001/000003','C_000003','000003','Proses','2019/03/15',NULL,'file_000003','0001','Dedy Ibrahim','Akta pendirian Perseroan Terbatas ( PT )','J_0001'),(42,'20190315/0001/000004','C_000001','000004','Proses','2019/03/15',NULL,'file_000004','0001','Dedy Ibrahim','Akta perubahan Koperasi','J_0008'),(43,'20190315/0001/000005','C_000003','000005','Proses','2019/03/15',NULL,'file_000005','0001','Dedy Ibrahim','Akta pendirian Perseroan Terbatas ( PT )','J_0001'),(44,'20190315/0001/000006','C_000003','000006','Proses','2019/03/15',NULL,'file_000006','0001','Dedy Ibrahim','Akta perubahan Yayasan','J_0010'),(45,'20190315/0001/000007','C_000004','000007','Proses','2019/03/15',NULL,'file_000007','0001','Dedy Ibrahim','Akta perubahan perseroan terbatas ( PT )','J_0002'),(46,'20190315/0001/000008','C_000004','000008','Proses','2019/03/15',NULL,'file_000008','0001','Dedy Ibrahim','Akta pendirian CV','J_0003'),(47,'20190315/0001/000009','C_000004','000009','Proses','2019/03/15',NULL,'file_000009','0001','Dedy Ibrahim','Akta perubahan Firma','J_0006'),(48,'20190315/0001/000010','C_000002','000010','Proses','2019/03/15',NULL,'file_000010','0001','Dedy Ibrahim','Akta perubahan Yayasan','J_0010'),(49,'20190315/0001/000011','C_000004','000011','Proses','2019/03/15',NULL,'file_000011','0001','Dedy Ibrahim','Akta pendirian Koperasi','J_0007'),(50,'20190315/0001/000012','C_000005','000012','Proses','2019/03/15',NULL,'file_000012','0001','Dedy Ibrahim','Akta pendirian Perseroan Terbatas ( PT )','J_0001');
/*!40000 ALTER TABLE `data_berkas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_client`
--

DROP TABLE IF EXISTS `data_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_client` (
  `id_data_client` int(11) NOT NULL AUTO_INCREMENT,
  `no_client` varchar(255) NOT NULL,
  `nama_client` varchar(255) NOT NULL,
  `jenis_client` varchar(255) NOT NULL,
  `alamat_client` varchar(255) NOT NULL,
  `tanggal_daftar` varchar(255) NOT NULL,
  `pembuat_client` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_client`),
  KEY `no_client` (`no_client`),
  KEY `no_user` (`no_user`),
  CONSTRAINT `data_client_ibfk_1` FOREIGN KEY (`no_user`) REFERENCES `user` (`no_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_client`
--

LOCK TABLES `data_client` WRITE;
/*!40000 ALTER TABLE `data_client` DISABLE KEYS */;
INSERT INTO `data_client` VALUES (37,'C_000001','PT Lemari Sejati','Perorangan','asd','2019/03/15','Dedy Ibrahim','0001'),(38,'C_000002','PT Lemari Sejati','Badan Hukum','bogor','2019/03/15','Dedy Ibrahim','0001'),(39,'C_000003','PT Lemari Sejati','Perorangan','asd','2019/03/15','Dedy Ibrahim','0001'),(40,'C_000004','PT Angkasindo Dunia','Perorangan','a','2019/03/15','Dedy Ibrahim','0001'),(41,'C_000005','asd','Perorangan','sda','2019/03/15','Dedy Ibrahim','0001');
/*!40000 ALTER TABLE `data_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_dokumen`
--

DROP TABLE IF EXISTS `data_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_dokumen` (
  `id_data_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_data_dokumen` varchar(255) NOT NULL,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `file_berkas` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `no_client` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_dokumen`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`,`no_client`,`no_berkas`),
  KEY `no_client` (`no_client`),
  KEY `no_berkas` (`no_berkas`),
  CONSTRAINT `data_dokumen_ibfk_1` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_dokumen_ibfk_2` FOREIGN KEY (`no_client`) REFERENCES `data_client` (`no_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_dokumen_ibfk_3` FOREIGN KEY (`no_berkas`) REFERENCES `data_berkas` (`no_berkas`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_dokumen`
--

LOCK TABLES `data_dokumen` WRITE;
/*!40000 ALTER TABLE `data_dokumen` DISABLE KEYS */;
INSERT INTO `data_dokumen` VALUES (7,'D_0001','N_0001','file_000012',NULL,'C_000005','Surat Izin Usaha Perdagangan ( SIUP )','000012'),(8,'D_0002','N_0002','file_000012',NULL,'C_000005','Nomor pokok wajib pajak (NPWP)','000012'),(9,'D_0003','N_0003','file_000012',NULL,'C_000005','SK Kehakiman','000012'),(10,'D_0004','N_0004','file_000012',NULL,'C_000005','Tanda daftar perusahaan ( TDP )','000012');
/*!40000 ALTER TABLE `data_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_jenis_dokumen`
--

DROP TABLE IF EXISTS `data_jenis_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_jenis_dokumen` (
  `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_jenis_dokumen` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat_jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_dokumen`),
  KEY `no_jenis_dokumen` (`no_jenis_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_jenis_dokumen`
--

LOCK TABLES `data_jenis_dokumen` WRITE;
/*!40000 ALTER TABLE `data_jenis_dokumen` DISABLE KEYS */;
INSERT INTO `data_jenis_dokumen` VALUES (1,'J_0001','NOTARIS','Akta pendirian Perseroan Terbatas ( PT )','2019-03-05 06:28:28.165949','Dedy Ibrahim'),(2,'J_0002','NOTARIS','Akta perubahan perseroan terbatas ( PT )','2019-03-05 06:29:24.100515','Dedy Ibrahim'),(3,'J_0003','NOTARIS','Akta pendirian CV','2019-03-05 06:30:13.576017','Dedy Ibrahim'),(4,'J_0004','NOTARIS','Akta perubahan CV','2019-03-05 06:30:31.712436','Dedy Ibrahim'),(5,'J_0005','NOTARIS','Akta pendirian Firma','2019-03-05 06:31:49.696745','Dedy Ibrahim'),(6,'J_0006','NOTARIS','Akta perubahan Firma','2019-03-05 06:32:10.476590','Dedy Ibrahim'),(7,'J_0007','NOTARIS','Akta pendirian Koperasi','2019-03-05 06:33:01.350481','Dedy Ibrahim'),(8,'J_0008','NOTARIS','Akta perubahan Koperasi','2019-03-05 06:33:23.456080','Dedy Ibrahim'),(9,'J_0009','NOTARIS','Akta pendirian Yayasan','2019-03-05 06:37:31.682419','Dedy Ibrahim'),(10,'J_0010','NOTARIS','Akta perubahan Yayasan','2019-03-05 06:37:55.661141','Dedy Ibrahim'),(11,'J_0011','NOTARIS','Akta pendirian Perkumpulan','2019-03-05 06:38:39.618898','Dedy Ibrahim'),(12,'J_0012','NOTARIS','Akta perubahan Perkumpulan','2019-03-05 06:39:10.083953','Dedy Ibrahim'),(13,'J_0013','NOTARIS','Akta perjanjian Hutang','2019-03-05 06:40:41.199175','Dedy Ibrahim'),(14,'J_0014','NOTARIS','Akta perjanjian Kawin','2019-03-05 06:40:58.992524','Dedy Ibrahim'),(15,'J_0015','NOTARIS','Akta perjanjian Jual Beli','2019-03-05 06:41:35.892605','Dedy Ibrahim'),(16,'J_0016','NOTARIS','Akta perjanjian Sewa Menyewa','2019-03-05 06:42:18.334631','Dedy Ibrahim'),(17,'J_0017','NOTARIS','Akta perjanjian Kerjasama','2019-03-05 06:42:50.359475','Dedy Ibrahim'),(18,'J_0018','NOTARIS','Akta perjanjian Kredit','2019-03-05 06:43:23.037420','Dedy Ibrahim'),(20,'J_0019','NOTARIS','Akta perjanjian Koperasi','2019-03-05 06:45:58.615867','Dedy Ibrahim'),(21,'J_0020','NOTARIS','Akta Wasiat','2019-03-05 06:46:23.085321','Dedy Ibrahim'),(22,'J_0021','NOTARIS','Akta jaminan Tanah','2019-03-05 06:50:01.945909','Dedy Ibrahim'),(23,'J_0022','NOTARIS','Akta Jaminan personal Guarantee','2019-03-05 06:50:30.948411','Dedy Ibrahim'),(24,'J_0023','NOTARIS','Akta Fidusia','2019-03-05 06:50:46.733389','Dedy Ibrahim'),(25,'J_0024','NOTARIS','Akta legalisir surat Kuasa','2019-03-05 06:57:20.671361','Dedy Ibrahim'),(27,'J_0025','NOTARIS','Akta Legalisir Surat Kuasa','2019-03-05 06:58:53.346596','Dedy Ibrahim'),(28,'J_0026','NOTARIS','Akta legalisir surat Pernyataan','2019-03-05 07:00:34.582190','Dedy Ibrahim'),(29,'J_0027','NOTARIS','Akta legalisir Surat Persetujuan','2019-03-05 07:01:02.329769','Dedy Ibrahim'),(30,'J_0028','PPAT','Akta peralihan hak Jual Beli','2019-03-05 07:02:58.130489','Dedy Ibrahim'),(31,'J_0029','PPAT','Akta peralihan hak Hibah','2019-03-05 07:04:15.530001','Dedy Ibrahim'),(32,'J_0030','PPAT','Akta peralihan hak Tukar Menukar','2019-03-05 07:03:55.906857','Dedy Ibrahim'),(33,'J_0031','PPAT','Akta peralihan hak Pembagian Hak','2019-03-05 07:06:21.486152','Dedy Ibrahim'),(34,'J_0032','PPAT','Akta pembebanan hak SKMHT','2019-03-05 07:06:07.412667','Dedy Ibrahim'),(35,'J_0033','PPAT','Akta pembebanan hak APHT','2019-03-05 07:07:18.824630','Dedy Ibrahim');
/*!40000 ALTER TABLE `data_jenis_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_perorangan`
--

DROP TABLE IF EXISTS `data_perorangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_perorangan` (
  `id_perorangan` int(11) NOT NULL AUTO_INCREMENT,
  `no_nama_perorangan` varchar(255) NOT NULL,
  `nama_identitas` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `jenis_identitas` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL,
  `status_jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perorangan`),
  KEY `no_nama_perorangan` (`no_nama_perorangan`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_perorangan`
--

LOCK TABLES `data_perorangan` WRITE;
/*!40000 ALTER TABLE `data_perorangan` DISABLE KEYS */;
INSERT INTO `data_perorangan` VALUES (16,'I_000001','Dedi Ibrahim','32710623011998','KTP','MjA4MzY3Njg5OTVjOGI1MWEzOTg0YjY=.png','file_000001','Komisaris '),(17,'I_000002','Zaenudin Ngaciro','327106230119982','KTP','NDE3NzMzOTYyNWM4YjUxOWY1YzU4Nw==.png','file_000002','Presiden Komisaris'),(18,'I_000003','asd','322710623011998','KTP','MTgxMzMxODI4MzVjOGI1MTliM2QxMDI=.png','file_000003','Komisaris '),(19,'I_000004','Zaenudin Ngaciro','3271062301199832324','KTP','MTc2MzM0MjY5MDVjOGI1MTk3YTBhZGE=.png','file_000004','Presiden Komisaris'),(20,'I_000005','ASD','32710623011995435345454','KTP','MjEyOTM3NDkzMzVjOGI1MzkzMTliMDQ=.png','file_000011','Komisaris ');
/*!40000 ALTER TABLE `data_perorangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_syarat_jenis_dokumen`
--

DROP TABLE IF EXISTS `data_syarat_jenis_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_syarat_jenis_dokumen` (
  `id_syarat_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  PRIMARY KEY (`id_syarat_dokumen`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`),
  KEY `no_berkas` (`no_berkas`),
  KEY `no_client` (`no_client`),
  CONSTRAINT `data_syarat_jenis_dokumen_ibfk_1` FOREIGN KEY (`no_berkas`) REFERENCES `data_berkas` (`no_berkas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_syarat_jenis_dokumen_ibfk_2` FOREIGN KEY (`no_nama_dokumen`) REFERENCES `nama_dokumen` (`no_nama_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_syarat_jenis_dokumen`
--

LOCK TABLES `data_syarat_jenis_dokumen` WRITE;
/*!40000 ALTER TABLE `data_syarat_jenis_dokumen` DISABLE KEYS */;
INSERT INTO `data_syarat_jenis_dokumen` VALUES (61,'N_0001','Surat Izin Usaha Perdagangan ( SIUP )','000012','','C_000005'),(62,'N_0002','Nomor pokok wajib pajak (NPWP)','000012','','C_000005'),(63,'N_0003','SK Kehakiman','000012','','C_000005'),(64,'N_0004','Tanda daftar perusahaan ( TDP )','000012','','C_000005');
/*!40000 ALTER TABLE `data_syarat_jenis_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_syarat_perorangan`
--

DROP TABLE IF EXISTS `data_syarat_perorangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_syarat_perorangan` (
  `id_data_syarat_perorangan` int(11) NOT NULL AUTO_INCREMENT,
  `no_nama_perorangan` varchar(255) NOT NULL,
  `nama_identitas` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `jenis_identitas` varchar(255) NOT NULL,
  `no_berkas` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status_jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_data_syarat_perorangan`),
  KEY `no_nama_perorangan` (`no_nama_perorangan`),
  KEY `no_berkas` (`no_berkas`),
  CONSTRAINT `data_syarat_perorangan_ibfk_1` FOREIGN KEY (`no_nama_perorangan`) REFERENCES `data_perorangan` (`no_nama_perorangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_syarat_perorangan_ibfk_2` FOREIGN KEY (`no_berkas`) REFERENCES `data_berkas` (`no_berkas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_syarat_perorangan`
--

LOCK TABLES `data_syarat_perorangan` WRITE;
/*!40000 ALTER TABLE `data_syarat_perorangan` DISABLE KEYS */;
INSERT INTO `data_syarat_perorangan` VALUES (54,'I_000001','Dedi Ibrahim','32710623011998','KTP','000001','file_000001','MjA4MzY3Njg5OTVjOGI1MWEzOTg0YjY=.png','Komisaris '),(57,'I_000001','Dedi Ibrahim','32710623011998','KTP','000003','file_000001','MjA4MzY3Njg5OTVjOGI1MWEzOTg0YjY=.png','Komisaris '),(58,'I_000002','Zaenudin Ngaciro','327106230119982','KTP','000003','file_000002','NDE3NzMzOTYyNWM4YjUxOWY1YzU4Nw==.png','Presiden Komisaris'),(59,'I_000003','asd','322710623011998','KTP','000003','file_000003','MTgxMzMxODI4MzVjOGI1MTliM2QxMDI=.png','Komisaris '),(60,'I_000004','Zaenudin Ngaciro','3271062301199832324','KTP','000004','file_000004','MTc2MzM0MjY5MDVjOGI1MTk3YTBhZGE=.png','Presiden Komisaris'),(61,'I_000001','Dedi Ibrahim','32710623011998','KTP','000005','file_000001','MjA4MzY3Njg5OTVjOGI1MWEzOTg0YjY=.png','Komisaris '),(62,'I_000002','Zaenudin Ngaciro','327106230119982','KTP','000005','file_000002','NDE3NzMzOTYyNWM4YjUxOWY1YzU4Nw==.png','Presiden Komisaris'),(63,'I_000003','asd','322710623011998','KTP','000005','file_000003','MTgxMzMxODI4MzVjOGI1MTliM2QxMDI=.png','Komisaris '),(64,'I_000004','Zaenudin Ngaciro','3271062301199832324','KTP','000005','file_000004','MTc2MzM0MjY5MDVjOGI1MTk3YTBhZGE=.png','Presiden Komisaris'),(69,'I_000001','Dedi Ibrahim','32710623011998','KTP','000012','file_000001','MjA4MzY3Njg5OTVjOGI1MWEzOTg0YjY=.png','Komisaris ');
/*!40000 ALTER TABLE `data_syarat_perorangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nama_dokumen`
--

DROP TABLE IF EXISTS `nama_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nama_dokumen` (
  `id_nama_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `no_nama_dokumen` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `pembuat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_nama_dokumen`),
  KEY `no_nama_dokumen` (`no_nama_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nama_dokumen`
--

LOCK TABLES `nama_dokumen` WRITE;
/*!40000 ALTER TABLE `nama_dokumen` DISABLE KEYS */;
INSERT INTO `nama_dokumen` VALUES (1,'N_0001','Surat Izin Usaha Perdagangan ( SIUP )','2019-03-06 06:35:35.892906','Dedy Ibrahim'),(2,'N_0002','Nomor pokok wajib pajak (NPWP)','2019-03-06 06:36:01.479696','Dedy Ibrahim'),(3,'N_0003','SK Kehakiman','2019-03-06 06:36:20.751813','Dedy Ibrahim'),(4,'N_0004','Tanda daftar perusahaan ( TDP )','2019-03-06 06:36:57.464862','Dedy Ibrahim'),(5,'N_0005','Domisili','2019-03-06 06:37:33.825515','Dedy Ibrahim');
/*!40000 ALTER TABLE `nama_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `no_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `tanggal_daftar` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `no_user` (`no_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'0001','Dedi','Dedy Ibrahim','dedyibrahym23@gmail.com','0887487772','Admin','2019-02-27 06:36:37.309694','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(15,'0002','zaenudin','zaenudin al bughuri','sajarudin','082381109774','Admin','2019-02-27 06:36:18.564278','7815696ecbf1c96e6894b779456d330e',NULL,'Aktif'),(16,'0003','Fajri','Fajri Ja','fajri@gmail.com','081873772','Admin','2019-02-27 06:35:46.434698','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(17,'0004','Wisnu','nugroho','wisnu@gmail.com','081289903664','Admin','2019-02-27 06:12:13.449046','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif'),(18,'0005','BANS','WISNU SUBROTO NOVI ARIYANTO','yuniaryanto697@gmail.com','087877912311','Admin','2019-03-05 07:41:05.163385','ea6b2efbdd4255a9f1b3bbc6399b58f4',NULL,'Aktif'),(19,'0006','Zae','Komarudin','dedyibrahym23@gmail.com','3423423423423','Admin','2019-03-11 04:12:27.316704','21232f297a57a5a743894a0e4a801fc3',NULL,'Aktif');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-15 16:15:21
