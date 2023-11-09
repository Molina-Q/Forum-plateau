-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_plateau
CREATE DATABASE IF NOT EXISTS `forum_plateau` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_plateau`;

-- Listage de la structure de table forum_plateau. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_plateau.category : ~6 rows (environ)
INSERT INTO `category` (`id_category`, `label`) VALUES
	(1, 'Sport'),
	(2, 'Video game'),
	(3, 'Cooking'),
	(4, 'Fish'),
	(5, 'Dev'),
	(6, 'Environment');

-- Listage de la structure de table forum_plateau. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `FK_message_user` (`user_id`),
  KEY `FK_message_topic` (`topic_id`),
  CONSTRAINT `FK_message_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_plateau.message : ~15 rows (environ)
INSERT INTO `message` (`id_message`, `text`, `dateOfCreation`, `user_id`, `topic_id`) VALUES
	(1, 'Nothing is stopping you from doing it i guess..', '2023-11-09 09:34:21', 2, 1),
	(2, 'I am coming to your house and taking that crab away from you.', '2023-11-09 09:40:51', 4, 1),
	(3, 'What kind of degenerate would do that ?????', '2023-11-09 09:37:25', 4, 1),
	(4, 'Because ', '2023-11-09 09:41:24', 6, 2),
	(5, 'No idea but i would to know too!', '2023-11-09 09:41:38', 2, 3),
	(6, 'My clownfish could beat this boss', '2023-11-09 09:42:32', 4, 5),
	(7, 'git gud', '2023-11-09 09:43:33', 4, 5),
	(8, 'Just look at the speed-run strat they skip this boss entirely', '2023-11-09 09:43:45', 6, 5),
	(9, 'You can summon dogs to help you beat it!', '2023-11-09 09:44:49', 3, 5),
	(10, 'Because handball would be a bad name, imagine if a sport had that name', '2023-11-09 09:45:58', 3, 4),
	(11, 'What the **** ', '2023-11-09 09:48:41', 5, 6),
	(12, 'He looks a lot like my stolen crab...', '2023-11-10 09:51:05', 5, 6),
	(13, 'YOUR F*****G CRAB JUST ATE MY CLOWN FISH', '2023-11-10 09:52:54', 4, 6),
	(14, 'HE JUST LOST HIS GOD GIVEN PRIVILEGE OF LIFE; I AM FRYING HIM ALIVE', '2023-11-10 09:54:59', 4, 6),
	(15, 'Could i get a claw ? i heard fried crab is delicious', '2023-11-09 09:58:25', 4, 6);

-- Listage de la structure de table forum_plateau. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `FK_topic_category` (`category_id`),
  KEY `FK_topic_user` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_plateau.topic : ~6 rows (environ)
INSERT INTO `topic` (`id_topic`, `label`, `dateOfCreation`, `category_id`, `user_id`) VALUES
	(1, 'Can  boili an entire crab in pepsi ?', '2023-11-08 09:30:36', 3, 5),
	(2, 'Why is grass green ?', '2023-11-09 09:32:48', 6, 1),
	(3, 'How to center a div ?', '2023-11-09 09:33:14', 5, 3),
	(4, 'Why football ?', '2023-11-09 09:33:40', 1, 2),
	(5, 'Why is this boss so ******  hard ????', '2023-11-09 09:34:25', 2, 1),
	(6, 'Can a crab and a clown fish live together inside an aquarium ?', '2023-11-09 09:36:06', 4, 4);

-- Listage de la structure de table forum_plateau. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `role` json DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_plateau.user : ~6 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `dateOfCreation`, `role`, `picture`) VALUES
	(1, 'john111', '123', 'mail@mail.com', '2023-11-09 09:24:11', NULL, 'default'),
	(2, 'NotAUser', '123', 'mail@mail.com', '2023-11-09 09:25:11', NULL, 'default'),
	(3, 'dog45', '123', 'mail@mail.com', '2023-11-09 09:26:51', NULL, 'default'),
	(4, 'Clown-Fish', '123', 'mail@mail.com', '2023-11-09 09:26:55', NULL, 'default'),
	(5, 'Crepsi', '123', 'mail@mail.com', '2023-11-09 09:27:35', NULL, 'default'),
	(6, 'Tree-lover', '1323', 'mail@mail.com', '2023-11-09 09:28:15', NULL, 'default');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
