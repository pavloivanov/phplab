CREATE DATABASE `twitter_db` CHARACTER SET utf8 COLLATE utf8_general_ci;
 
USE `twitter_db`;
 
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `email` VARCHAR(32) NOT NULL,
  `country` VARCHAR(32),
  `created` DATETIME,
  `avatar_img` VARCHAR(32),
  PRIMARY KEY (`id`)
);
 
CREATE TABLE `tweets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_fk` INT NOT NULL,
  `tweet` VARCHAR(140),
  `retweets_count` INT,
  `favorites_count` INT,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` VARCHAR(32),
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`author_fk`) REFERENCES `users` (`id`)
);
 
CREATE TABLE `retweets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_fk` INT NOT NULL,
  `tweet_fk` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`author_fk`) REFERENCES `users` (`id`),
  CONSTRAINT FOREIGN KEY (`tweet_fk`) REFERENCES `tweets` (`id`)
);
 
CREATE TABLE `favorites` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_fk` INT NOT NULL,
  `tweet_fk` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`author_fk`) REFERENCES `users` (`id`),
  CONSTRAINT FOREIGN KEY (`tweet_fk`) REFERENCES `tweets` (`id`)
);
 
CREATE TABLE `comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_fk` INT NOT NULL,
  `tweet_fk` INT NOT NULL,
  `comment` VARCHAR(140) NOT NULL,
  `url` VARCHAR(255),
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`author_fk`) REFERENCES `users` (`id`),
  CONSTRAINT FOREIGN KEY (`tweet_fk`) REFERENCES `tweets` (`id`)
);
 
CREATE TABLE `messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_fk` INT NOT NULL,
  `receiver_fk` INT NOT NULL,
  `message` VARCHAR(140),
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` VARCHAR(32),
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`author_fk`) REFERENCES `users` (`id`),
  CONSTRAINT FOREIGN KEY (`receiver_fk`) REFERENCES `users` (`id`)
);
 
CREATE TABLE `notifications` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_fk` INT NOT NULL,
  `notification` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`user_fk`) REFERENCES `users` (`id`)
);
 
CREATE TABLE `folowers` (
  `user_fk` INT NOT NULL,
  `follower_fk` INT NOT NULL,
  CONSTRAINT FOREIGN KEY (`user_fk`) REFERENCES `users` (`id`),
  CONSTRAINT FOREIGN KEY (`follower_fk`) REFERENCES `users` (`id`)
);
 
CREATE TABLE `hashtags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hashtag` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`)
);
 
CREATE TABLE `hashtag_references` (
  `hashtag_fk` INT NOT NULL,
  `tweet_fk` INT NOT NULL,
  CONSTRAINT FOREIGN KEY (`hashtag_fk`) REFERENCES `hashtags` (`id`),
  CONSTRAINT FOREIGN KEY (`tweet_fk`) REFERENCES `tweets` (`id`)
);
 
CREATE TABLE `apps` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `author` VARCHAR(32) NOT NULL,
  `description` VARCHAR(140),
  `permissions` VARCHAR(32),
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
 
CREATE TABLE `apps_references` (
  `app_fk` INT NOT NULL,
  `customer_fk` INT NOT NULL,
  CONSTRAINT FOREIGN KEY (`app_fk`) REFERENCES `apps` (`id`),
  CONSTRAINT FOREIGN KEY (`customer_fk`) REFERENCES `users` (`id`)
);
