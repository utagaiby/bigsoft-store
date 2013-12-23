ALTER TABLE `cart_items`
ADD COLUMN `quantity` INT(11) NOT NULL DEFAULT 1 AFTER `product_id`;
