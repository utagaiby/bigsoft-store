CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(512) NOT NULL,
  `pay_type` VARCHAR(45) NULL,
  `address` TEXT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));

-- email: email@user.com, password:userpass
INSERT INTO `store`.`users` (`email`, `password`, `pay_type`, `address`, `first_name`, `last_name`) VALUES ('email@user.com', '45f106ef4d5161e7aa38cf6c666607f25748b6ca', 'check', 'some_address', 'User', 'Userstein');
