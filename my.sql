CREATE DATABASE `github`;
use `github`;
CREATE TABLE `mobidev_github_likes` (
  `like_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `parent_type` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL
) COMMENT='' ENGINE='InnoDB';
