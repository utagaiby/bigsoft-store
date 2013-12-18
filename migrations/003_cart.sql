CREATE TABLE `carts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`));

CREATE TABLE `cart_items` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cart_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cart_items_carts_idx` (`cart_id` ASC),
  INDEX `fk_cart_items_products_idx` (`product_id` ASC),
  CONSTRAINT `fk_cart_items_carts`
    FOREIGN KEY (`cart_id`)
    REFERENCES `carts` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_items_products`
    FOREIGN KEY (`product_id`)
    REFERENCES `products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);