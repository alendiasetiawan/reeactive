-- -------------------------------------------------------------
-- TablePlus 6.7.3(640)
--
-- https://tableplus.com/
--
-- Database: u957899853_reeactive
-- Generation Time: 2025-11-12 10:46:04.4810
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


INSERT INTO `programs` (`id`, `program_name`, `quota_min`, `quota_max`, `program_status`, `program_type`, `is_pregnant_friendly`, `created_at`, `updated_at`) VALUES
(1, 'Private 1 on 1', 1, 1, 'Close', 'Reguler', 1, '2023-10-04 13:55:29', '2023-10-04 13:55:29'),
(2, 'Buddy', 1, 2, 'Close', 'Reguler', 1, '2023-10-04 13:55:29', '2023-10-04 13:55:29'),
(3, 'Small Group', 4, 6, 'Open', 'Reguler', 1, '2023-10-04 13:55:29', '2023-10-04 13:55:29'),
(4, 'Special Case Small Group', 4, 6, 'Close', 'Reguler', 1, '2023-10-04 13:55:29', '2023-10-04 13:55:29'),
(5, 'Large Group', 10, 15, 'Open', 'Reguler', 1, '2023-10-04 13:55:29', '2023-10-04 13:55:29'),
(6, 'Nutritionist Consultation', 1, 100, 'Close', 'Reguler', 1, '2023-10-04 13:55:29', '2023-10-04 13:55:29'),
(7, 'Early Postpartum Workshop', 1, 500, 'Close', 'Workshop', 1, '2023-10-22 16:45:21', '2023-10-22 16:45:21'),
(8, 'Core Stability Program', 1, 20, 'Open', 'Workshop', 1, '2023-10-22 16:45:21', '2023-10-22 16:45:21'),
(9, 'Mat Pilates', 1, 20, 'Open', 'Special', 1, '2025-01-06 14:34:49', '2025-01-06 14:34:49'),
(10, 'ActivBump', 1, 20, 'Open', 'Special', 0, '2025-01-06 14:34:49', '2025-01-06 14:34:49');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;