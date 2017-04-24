CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_content` TEXT NOT NULL,
  `article_date` datetime DEFAULT NULL,
  `article_author` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_created` datetime NOT NULL,
  `user_hash` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;