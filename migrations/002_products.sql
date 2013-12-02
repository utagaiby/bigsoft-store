CREATE TABLE `products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(512) NOT NULL,
  `description` TEXT NOT NULL,
  `image_url` VARCHAR(512) NOT NULL,
  `price` DECIMAL(12,4) NOT NULL,
  PRIMARY KEY (`id`));
