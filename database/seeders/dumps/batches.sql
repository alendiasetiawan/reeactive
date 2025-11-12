-- -------------------------------------------------------------
-- TablePlus 6.7.3(640)
--
-- https://tableplus.com/
--
-- Database: reeactive
-- Generation Time: 2025-11-12 12:15:07.1170
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `batches`;
CREATE TABLE `batches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `early_bird_end` date DEFAULT NULL,
  `batch_status` enum('Active','Close','Open') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `disc_early_bird` float NOT NULL DEFAULT '0.05',
  `admin_fee` float NOT NULL DEFAULT '50000',
  `discount_referral` float NOT NULL DEFAULT '0',
  `referral_limit` int NOT NULL DEFAULT '3',
  `merchandise_voucher` float NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `batches` (`id`, `batch_name`, `start_date`, `end_date`, `early_bird_end`, `batch_status`, `disc_early_bird`, `admin_fee`, `discount_referral`, `referral_limit`, `merchandise_voucher`, `created_at`, `updated_at`) VALUES
(1, 'Batch 8', '2023-08-01', '2023-08-31', NULL, 'Close', 0.05, 50000, 0, 3, 0, '2023-10-06 17:47:01', '2023-10-06 17:47:01'),
(2, 'Batch 9', '2023-10-10', '2023-10-29', NULL, 'Close', 0.05, 50000, 0, 3, 0, '2023-10-06 17:47:01', '2023-10-06 17:47:01'),
(4, 'Batch 10', '2023-12-25', '2024-01-15', NULL, 'Close', 0.05, 50000, 0, 3, 0, '2023-12-10 22:47:56', '2023-12-24 22:48:02'),
(5, 'Batch 11', '2024-04-17', '2024-04-28', '2024-04-20', 'Close', 0.05, 50000, 0, 3, 0, '2024-04-15 22:47:56', '2024-04-15 22:48:02'),
(6, 'Batch 12', '2024-07-01', '2024-07-31', '2024-07-08', 'Close', 50000, 50000, 0, 3, 0, '2024-06-30 22:47:56', '2024-06-30 22:47:56'),
(7, 'Batch 13', '2024-10-01', '2024-11-02', '2024-10-07', 'Close', 30000, 50000, 30000, 3, 25000, '2024-06-30 22:47:56', '2024-06-30 22:47:56'),
(8, 'Batch 14', '2024-12-27', '2025-01-15', '2025-01-03', 'Close', 30000, 50000, 30000, 3, 25000, '2024-12-26 22:47:56', '2024-12-26 22:47:56'),
(9, 'Batch 15', '2025-03-24', '2025-04-10', '2025-03-26', 'Close', 30000, 50000, 30000, 3, 25000, '2025-03-21 22:47:56', '2025-03-21 22:47:56'),
(10, 'Batch 16', '2025-06-01', '2025-07-10', '2025-06-03', 'Close', 30000, 50000, 30000, 10, 25000, '2025-06-01 22:47:56', '2025-06-01 22:47:56'),
(11, 'Batch 17', '2025-09-07', '2025-09-30', '2025-09-09', 'Open', 30000, 50000, 30000, 10, 25000, '2025-09-04 09:14:44', '2025-09-04 09:14:44');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;