CREATE TABLE `orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `pay_type` VARCHAR(45) NOT NULL,
  `name` VARCHAR(512) NOT NULL,
  `address` TEXT NOT NULL
PRIMARY KEY (`id`));

ALTER TABLE `cart_items`
ADD COLUMN `order_id` INT(11) NULL,
ADD INDEX `fk_cart_items_order_id_idx` (`order_id` ASC);
ALTER TABLE `cart_items`
ADD CONSTRAINT `fk_cart_items_order_id`
FOREIGN KEY (`order_id`)
REFERENCES `orders` (`id`)
  ON DELETE SET NULL
  ON UPDATE SET NULL;


ALTER TABLE `cart_items`
DROP FOREIGN KEY `fk_cart_items_carts`;
ALTER TABLE `cart_items`
CHANGE COLUMN `cart_id` `cart_id` INT(11) NULL ;
ALTER TABLE `cart_items`
ADD CONSTRAINT `fk_cart_items_carts`
FOREIGN KEY (`cart_id`)
REFERENCES `carts` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


