-- --------------------------------------------------------
-- DATABASE: manajemen_aset
-- --------------------------------------------------------

DROP DATABASE IF EXISTS `manajemen_aset`;
CREATE DATABASE `manajemen_aset` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `manajemen_aset`;

-- --------------------------------------------------------
-- TABLE: asset_category
-- --------------------------------------------------------
CREATE TABLE `asset_category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `asset_category` (`name`) VALUES
('Elektronik'),
('Kendaraan'),
('Mesin');

-- --------------------------------------------------------
-- TABLE: asset
-- --------------------------------------------------------
CREATE TABLE `asset` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `category_id` INT(11) NOT NULL,
  `location` VARCHAR(100),
  `status` ENUM('available','checked_out','maintenance') NOT NULL DEFAULT 'available',
  `qr_code` VARCHAR(255),
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `purchase_date` DATE,
  `last_used_date` DATE,
  `user` VARCHAR(100),
  `economic_life` INT(11) DEFAULT 5,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `asset_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `asset_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `asset` (`id`, `name`, `category_id`, `location`, `status`, `created_at`, `updated_at`)
VALUES
(20, 'Forklift A', 2, 'Gudang 1', 'available', NOW(), NOW()),
(30, 'Genset Cadangan', 3, 'Gudang 2', 'available', NOW(), NOW()),
(110, 'Komputer Kantor', 1, 'Ruang IT', 'maintenance', NOW(), NOW());

-- --------------------------------------------------------
-- TABLE: maintenance_schedule
-- --------------------------------------------------------
CREATE TABLE `maintenance_schedule` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `asset_id` INT(11) NOT NULL,
  `asset_name` VARCHAR(255), -- Tambahan kolom yang diperlukan model Yii
  `date` DATE NOT NULL,
  `description` TEXT,
  `status` ENUM('pending','done') DEFAULT 'pending',
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`),
  KEY `asset_id` (`asset_id`),
  CONSTRAINT `maintenance_schedule_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Isi awal
INSERT INTO `maintenance_schedule` (`asset_id`, `date`, `description`, `status`, `created_at`, `updated_at`)
VALUES
(110, '2025-06-12', 'Update komputer', 'pending', '2025-06-11 21:41:26', '2025-06-11 21:41:26'),
(20,  '2025-06-12', 'Pemeriksaan berkala alat berat', 'pending', '2025-06-11 21:41:26', '2025-06-11 21:41:26'),
(30,  '2025-06-13', 'Ganti oli mesin cadangan', 'done', '2025-06-11 21:41:26', '2025-06-11 21:41:26');

-- Update asset_name sesuai asset_id
UPDATE maintenance_schedule ms
JOIN asset a ON ms.asset_id = a.id
SET ms.asset_name = a.name;

-- Trigger: otomatis isi asset_name saat INSERT
DELIMITER $$

CREATE TRIGGER trg_before_insert_maintenance_schedule
BEFORE INSERT ON maintenance_schedule
FOR EACH ROW
BEGIN
    DECLARE asetNama VARCHAR(255);
    SELECT name INTO asetNama FROM asset WHERE id = NEW.asset_id;
    SET NEW.asset_name = asetNama;
END$$

DELIMITER ;

-- Trigger: otomatis update asset_name saat asset_id berubah
DELIMITER $$

CREATE TRIGGER trg_before_update_maintenance_schedule
BEFORE UPDATE ON maintenance_schedule
FOR EACH ROW
BEGIN
    DECLARE asetNama VARCHAR(255);
    SELECT name INTO asetNama FROM asset WHERE id = NEW.asset_id;
    SET NEW.asset_name = asetNama;
END$$

DELIMITER ;

-- --------------------------------------------------------
-- TABLE: asset_usage
-- --------------------------------------------------------
CREATE TABLE `asset_usage` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `asset_id` INT(11) NOT NULL,
  `usage_date` DATE NOT NULL,
  `usage_hours` INT(11),
  PRIMARY KEY (`id`),
  KEY `asset_id` (`asset_id`),
  CONSTRAINT `asset_usage_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `asset_usage` (`asset_id`, `usage_date`, `usage_hours`) VALUES
(20, '2025-06-10', 5),
(30, '2025-06-11', 3),
(110, '2025-06-09', 2);

-- --------------------------------------------------------
-- TABLE: user (for login)
-- --------------------------------------------------------
CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');
