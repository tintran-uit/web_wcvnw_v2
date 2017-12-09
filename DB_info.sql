
ALTER TABLE `products` AUTO_INCREMENT = 53

SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", 	
       p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price",        
       p.`unit_quantity` "unit_quantity", p.`unit` "unit", 
       IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", MIN(tr.`priority`), `priority` 
  FROM `products` p, `trading` tr, `farmers` f 
 WHERE tr.`product_id` = p.`id` 
   AND f.`id` = tr.`farmer_id` 
   AND tr.`status` = 1 
   AND tr.`capacity` - tr.`sold` - p.`unit_quantity` > 0
   AND p.`category` = 3
GROUP BY tr.`product_id`
HAVING `priority` = MIN(`priority`);


SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", 	
       p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price",        
       p.`unit_quantity` "unit_quantity", p.`unit` "unit", tr.`sold`, tr.`capacity`, tr.`priority`,
       IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", `priority`, COUNT(*), 
       MIN(FLOOR(tr.`sold`/tr.`capacity`)*50 + tr.`priority`), (FLOOR(tr.`sold`/tr.`capacity`)*50 + tr.`priority`)
  FROM `products` p, `trading` tr, `farmers` f 
 WHERE tr.`product_id` = p.`id` 
   AND f.`id` = tr.`farmer_id` 
   AND tr.`status` = 1 
   AND p.`category` = 3
GROUP BY tr.`product_id`
ORDER BY tr.`priority`
HAVING COUNT(*) = 1 OR (FLOOR(tr.`sold`/tr.`capacity`)*50 + tr.`priority`) = MIN(FLOOR(tr.`sold`/tr.`capacity`)*50 + tr.`priority`)



SELECT `product_id`, COUNT(*)
  FROM `trading` tr 
 WHERE `status` = 1
  GROUP BY `product_id`
HAVING COUNT(*) = 1
UNION 

/* priority with quantity_left > 0*/
SELECT `product_id`, COUNT(*)
  FROM `trading` tr 
  GROUP BY `product_id`
HAVING COUNT(*) > 1

/* priority with quantity_left = 0*/
SELECT `product_id`, COUNT(*)
  FROM `trading` tr 
  GROUP BY `product_id`
HAVING COUNT(*) > 1


SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", 
		p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", 
		IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", 
		p.`unit` "unit"  
  FROM `products` p, `trading` tr, `farmers` f 
 WHERE tr.`product_id` = p.`id` 
   AND f.`id` = tr.`farmer_id` 
   AND p.`category` = 3


UPDATE `trading` AS t, `m_packages` AS m 
   SET t.`sold` = t.`sold` + m.`quantity` 
 WHERE t.`farmer_id` = m.`farmer_id`
   AND t.`product_id` = m.`product_id` 
   AND m.`package_id` = 1;

UPDATE `trading` AS t, `m_packages` AS m 
   SET t.`sold` = t.`sold` + m.`quantity`,
       t.`sold_count` =  t.`sold_count` + 2
 WHERE t.`farmer_id` = m.`farmer_id`
   AND t.`product_id` = m.`product_id` 
   AND m.`package_id` = 62

SELECT SUM(`total`)
FROM `g_orders`
WHERE `status` != 8 
  AND `delivery_date` = '2017-11-04';

SELECT tr.`farmer_id`, tr.`product_id`, p.`name`, p.`unit_quantity`, p.`unit`, p.`price` 
  FROM `trading` tr, `products` p
WHERE tr.`status` = 1
  AND tr.`product_id` = p.`id`
ORDER BY tr.`category`;

SELECT tr.`farmer_id`, tr.`product_id`, p.`name`, tr.`sold` "Đã Bán", p.`unit_quantity`, p.`unit`, p.`price`, p.`category` 
  FROM `trading` tr, `products` p
WHERE tr.`status` = 1
  AND tr.`sold` > 0
  AND tr.`product_id` = p.`id`
ORDER BY p.`category`;

SELECT tr.`product_id`, p.`name` "Product_name", f.`name` "Farmer",  tr.`capacity` "Đã Bán", p.`unit_quantity`, p.`unit`, p.`price` "Selling_price", tr.`farmer_price` "Farmer_price", p.`category` "Category"
  FROM `trading` tr, `products` p, `farmers` f
WHERE tr.`status` = 1
  AND tr.`farmer_id` = f.`id`
  AND tr.`product_id` = p.`id`
ORDER BY `Category`;


INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `quantity`, `unit`, `price`, `category`, `delivery_date`) 
SELECT 61, tr.`farmer_id`, tr.`product_id`, p.`name`, tr.`unit_quantity`, tr.`unit`, tr.`price`, p.`category`, tr.`delivery_date` 
  FROM `trading` tr, `products` p
WHERE tr.`status` = 1
  AND tr.`product_id` = p.`id`
  AND tr.`product_id` IN (17, 20, 88, 94,38);
ORDER BY p.`category`;

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `quantity`, `unit`, `price`, `category`, `delivery_date`) 
SELECT 63, `farmer_id`, `product_id`, `product_name`, `quantity`, `unit`, `price`, `category`, `delivery_date`
  FROM `m_packages`
 WHERE `delivery_date`='2017-11-25'
   AND `package_id`=62;

SELECT *
  FROM `m_packages`
 WHERE `delivery_date`='2017-11-25'
   AND `package_id`=63;

25nov: (3, 6, 53, 24, 66, 28, 29, 18, 65, 35, 70, 36, 41, 44, 43, 45, 46, 51, 40)
18nov: (23, 22, 86, 83, 87, 84, 75, 65, 18, 71, 36, 69, 41, 44, 43, 45, 46, 51, 40)
11nov: (81, 22, 82, 29, 5, 12, 65, 18, 33, 69, 41, 44, 43, 45, 46, 51, 39)
04nov: (74, 73, 76, 1, 9, 8, 27, 54, 75, 18, 35, 70, 41, 44, 43, 45, 46, 51, 39)

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`) 
SELECT 63, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`
 FROM `m_packages`
WHERE `package_id`=62;


 UPDATE `trading` AS t, `m_packages` AS m, `m_orders` AS mo, `products` AS p 
                              SET t.`sold` = t.`sold` - m.`quantity`
                  WHERE t.`farmer_id` = m.`farmer_id`
                      AND t.`product_id` = m.`product_id` 
                      AND p.`id` = mo.`product_id`
                      AND p.`category` = 0
                      AND m.`package_id` = p.`id`
                      AND mo.`order_id` =1000108

SELECT t.`farmer_id`, t.`product_id`, t.`capacity`, t.`sold`,
       m.`farmer_id`, m.`product_id`, m.`quantity` 
  FROM `trading` t, `m_packages` m
  WHERE t.`farmer_id` = m.`farmer_id`
    AND t.`product_id` = m.`product_id`
    AND m.`package_id` = 61;

SELECT * 
  FROM `trading` AS t, `m_packages` AS m, `m_orders` AS mo, `products` AS p 
                  WHERE t.`farmer_id` = m.`farmer_id`
                      AND t.`product_id` = m.`product_id` 
                      AND p.`id` = mo.`product_id`
                      AND p.`category` = 0
                      AND m.`package_id` = p.`id`
                      AND mo.`order_id` = 1000107

UPDATE `trading` AS t, `m_packages` AS m, `m_orders` AS mo, `products` AS p 
                              SET t.`sold` = t.`sold` - m.`quantity`
                  WHERE t.`farmer_id` = m.`farmer_id`
                      AND t.`product_id` = m.`product_id` 
                      AND p.`id` = mo.`product_id`
                      AND p.`category` = 0
                      AND m.`package_id` = p.`id`
                                      AND p.`id` = 64
                      AND mo.`order_id` = 1000107

UPDATE `trading` SET `status` = 2 WHERE `status` = 1;
 
INSERT INTO `trading`(`farmer_id`, `product_id`, `product_name`, `capacity`, `unit_quantity`, `unit`, `price`, `price_wholesale`, `price_farmer`, `sold`, `status`, `delivery_date`, `priority`, `category`) 
SELECT `farmer_id`, `product_id`, `product_name`, `capacity`, `unit_quantity`, `unit`, `price`, `price_wholesale`, `price_farmer`, 0, 1, DATE_ADD(`delivery_date`, INTERVAL 7 DAY), `priority`, `category`
  FROM `trading`
 WHERE `delivery_date`= '2017-12-01';

 UPDATE `trading` 
    SET `status`=2
 WHERE `delivery_date`= '2017-12-01';

#production
INSERT INTO `trading`(`farmer_id`, `product_id`, `product_name`, `capacity`, `unit_quantity`, `unit`, `price`, `price_wholesale`, `price_farmer`, `sold`, `status`, `delivery_date`, `priority`, `category`) 
SELECT `farmer_id`, `product_id`, `product_name`, `capacity`, `unit_quantity`, `unit`, `price`, `price_wholesale`, `price_farmer`, 0, 1, DATE_ADD(`delivery_date`, INTERVAL 7 DAY), `priority`, `category`
  FROM `trading`
 WHERE `status`= 1;

 UPDATE `trading` 
    SET `status`=2
 WHERE `delivery_date`= '2017-12-01';

SELECT * 
  FROM `m_orders` m 
 WHERE m.`order_id` IN (SELECT `order_id` FROM `g_orders` WHERE `delivery_date`='2017-11-11');

SELECT *
  FROM `trading`
WHERE `delivery_date`='2017-11-11'
ORDER BY `category`;

SELECT `order_id` "order_id" 
  FROM `g_orders` 
 WHERE `order_id` = ? 
   AND `customer_id` = ?
   AND DATEDIFF(CURRENT_DATE, `delivery_date`) < 7
   AND `rating` IS NULL
   AND `status` != 8;

SELECT * FROM `trading` WHERE `delivery_date`='2017-11-04' ORDER BY `product_id`;
SELECT * FROM `trading` WHERE `delivery_date`='2017-12-15' ORDER BY `category`;

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, `delivery_date`) 
SELECT `package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, DATE_ADD(`delivery_date`, INTERVAL 6 DAY)
  FROM `m_packages`
 WHERE `delivery_date` = '2017-11-25'
   AND `product_id` IN (18, 36, 41, 43, 44, 45, 46, 51);

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, `delivery_date`) 
SELECT `package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, "2017-12-01"
  FROM `m_packages`
 WHERE `delivery_date` = '2017-11-11'
   AND `product_id` IN (39, 12, 69);

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, `delivery_date`) 
SELECT `package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, "2017-12-01"
  FROM `m_packages`
 WHERE `delivery_date` = '2017-11-18'
   AND `product_id` IN (75, 23, 83, 84);

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `quantity`, `unit`, `price`, `category`, `delivery_date`) 
SELECT 64, tr.`farmer_id`, tr.`product_id`, p.`name`, tr.`unit_quantity`, tr.`unit`, tr.`price`, p.`category`, tr.`delivery_date` 
  FROM `trading` tr, `products` p
WHERE tr.`status` = 1
  AND tr.`product_id` = p.`id`
  AND tr.`product_id` IN (17, 20, 88, 94, 38);

INSERT INTO `cost`(`farmer_id`, `product_id`, `product_name`, `farmer_quantity`, `sold`, `unit`, `sold_income`, `cost`, `delivery_date`) 
SELECT `farmer_id`, `product_id`, `product_name`, `sold`, `sold`, `unit`, ROUND((`price`*`sold`)/`unit_quantity`), ROUND((`price_farmer`*`sold`)/`unit_quantity`), `delivery_date`
  FROM `trading`
 WHERE `delivery_date` = '2017-11-25'
   AND ROUND(`sold`, 2) > 0
   AND `product_id` NOT IN (61, 62, 63, 64);

SELECT * 
  FROM `m_packages`
 WHERE `delivery_date` = '2017-11-25';

SELECT p.`category`, p.`unit_quantity`, p.`price`, p.`unit`, tr.`price_farmer`, tr.`capacity`,  tr.`sold`, ROUND(tr.`capacity` - tr.`sold`, 1)
                                             FROM `products` p, `trading` tr
                                            WHERE p.`id` = tr.`product_id`
                                              AND ROUND(tr.`capacity` - tr.`sold`,1) >= 0.1
                                              AND tr.`farmer_id` = 6
                                              AND tr.`product_id` = 12
                                              AND tr.`delivery_date` = '2017-11-11';

SELECT m.`order_id`, p.`id`, tr.`sold`,m.`quantity`, g.`delivery_date`, p.`name`, tr.`delivery_date`, g.`total`
  FROM `trading` tr, `m_orders` m, `g_orders` g, `products` p
                                WHERE m.`order_id` = g.`order_id`
                                  AND g.`order_id` = 1000199
                                  AND g.`delivery_date` = tr.`delivery_date`
                                  AND tr.`product_id` = m.`product_id`
                                  AND tr.`farmer_id` = m.`farmer_id` 
                                  AND p.`id` = tr.`product_id`

UPDATE `trading` tr, `products` p 
   SET tr.`category` = p.`category`, tr.`product_name` = p.`name`
 WHERE tr.`status`=1
   AND tr.`product_id` = p.`id`
   AND (tr.`category` IS NULL OR tr.`product_name` IS NULL);

SELECT * FROM `trading` WHERE `delivery_date`='2017-12-08' ORDER BY `category`;

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, `delivery_date`) 
SELECT `package_id`, `farmer_id`, `product_id`, `product_name`, `category`, `quantity`, `unit`, `price`, '2017-12-08'
FROM `m_packages` WHERE (`delivery_date` = '2017-11-11' OR `delivery_date`= '2017-11-25') AND `product_id` IN (53, 5)

//sort products in categories
UPDATE `trading` tr, `products` p 
   SET tr.`priority` = LENGTH(CONCAT(p.`name`, ' ', p.`unit_quantity`, ' ', p.`unit`))
 WHERE tr.`status` = 1
   AND tr.`priority` IS NULL
   AND tr.`product_id` = p.`id`
   AND p.`category` IN (1, 2, 3, 4, 5);

UPDATE `trading` tr, `products` p 
   SET tr.`priority` = LENGTH(CONCAT(p.`name`, ' ', p.`unit_quantity`, ' ', p.`unit`)),
       tr.`product_name` = p.`name`,
       tr.`category` = p.`category`
 WHERE tr.`status` = 1
   AND tr.`priority` IS NULL
   AND tr.`product_id` = p.`id`
   AND p.`category` IN (1, 2, 3, 4, 5);

INSERT INTO `products`(`brand_id`, `name`, `en_name`, `category`, `farmer_id`, `price`, `price_wholesale`, `price_farmer`, `unit_quantity`, `unit`, `en_unit`, `image`, `thumbnail`, `slug`, `description`, `en_description`, `short_description`, `en_short_description`, `created_at`, `updated_at`, `price_old`) 
SELECT `brand_id`, "Bắp Cải", `en_name`, `category`, 5, `price`, `price_wholesale`, `price_farmer`, `unit_quantity`, `unit`, `en_unit`, `image`, `thumbnail`, `slug`, `description`, `en_description`, `short_description`, `en_short_description`, `created_at`, `updated_at`, `price_old`
FROM `products`
WHERE `id` = 24;

INSERT INTO `products`(`brand_id`, `name`, `en_name`, `category`, `farmer_id`, `price`, `price_wholesale`, `price_farmer`, `unit_quantity`, `unit`, `en_unit`, `image`, `thumbnail`, `slug`, `description`, `en_description`, `short_description`, `en_short_description`, `created_at`, `updated_at`, `price_old`) 
SELECT `brand_id`, "Mướp Non", "Baby Luffa", `category`, 13, `price`, `price_wholesale`, `price_farmer`, `unit_quantity`, `unit`, `en_unit`, "uploads/\products/\images/\muop-non.png", "uploads/\products/\thumbnails/\muop-non.png", "muop-non", `description`, `en_description`, `short_description`, `en_short_description`, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, `price_old`
FROM `products`
WHERE `id` = 11;

SELECT  CONCAT(p.`name`, ' ', p.`unit_quantity`, p.`unit`), LENGTH(CONCAT(p.`name`, ' ', p.`unit_quantity`, p.`unit`))
  FROM `trading` tr, `products` p 
 WHERE tr.`status` = 1
   AND tr.`product_id` = p.`id`
   AND tr.`category` = 4

SELECT CONCAT(p.`name`, ' (', m.`quantity`, m.`unit`, ')') "Product" , COUNT(*) "Number"
  FROM `m_orders` m, `g_orders` g, `products` p 
 WHERE p.`id` = m.`product_id`
   AND m.`order_id` = g.`order_id`
   AND g.`delivery_date` = '2017-10-21'
 GROUP BY `Product`  
ORDER BY `Product`  ASC;

(SELECT CONCAT(p.`name`, ' (', m.`quantity`, m.`unit`, ')') "Product" , COUNT(*) "Number"
  FROM `m_orders` m, `g_orders` g, `products` p 
 WHERE p.`id` = m.`product_id`
   AND m.`order_id` = g.`order_id`
   AND g.`delivery_date` = '2017-10-21'
GROUP BY `Product` ) 
UNION ALL
(SELECT CONCAT(p.`name`, ' (', pa.`quantity`, pa.`unit`, ')') "Product" , COUNT(*) "Number"
  FROM `m_orders` m, `g_orders` g, `products` p, `m_packages` pa 
 WHERE p.`id` = pa.`product_id`
   AND m.`order_id` = g.`order_id`
   AND g.`delivery_date` = '2017-10-21'
   AND m.`product_id` IN (61, 62, 63, 64)
   AND pa.`package_id` = m.`product_id`
 GROUP BY `Product`  )
ORDER BY `Product`  ASC;

#version with Order by category
(SELECT CONCAT(p.`name`, " (", m.`quantity`, m.`unit`, ")") "Product", COUNT(*) "Quantity", tr.`category` "category"
  FROM `m_orders` m, `g_orders` g, `products` p, `trading` tr
 WHERE p.`id` = m.`product_id`
   AND m.`order_id` = g.`order_id`
   AND tr.`farmer_id` = m.`farmer_id`
   AND tr.`product_id` = m.`product_id`
   AND g.`status` != 8
   AND tr.`delivery_date` = g.`delivery_date`
   AND tr.`delivery_date` = '2017-11-04'
GROUP BY  `Product`) 
UNION ALL
(SELECT CONCAT(p.`name`, " (", pa.`quantity`, pa.`unit`, ")") "Product", COUNT(*) "Quantity", tr.`category` "category"
  FROM `m_orders` m, `g_orders` g, `products` p, `m_packages` pa, `trading` tr
 WHERE p.`id` = pa.`product_id`
   AND m.`order_id` = g.`order_id`
   AND tr.`farmer_id` = pa.`farmer_id`
   AND tr.`product_id` = pa.`product_id`
   AND g.`status` != 8
   AND g.`delivery_date` = '2017-11-04'
   AND tr.`delivery_date` = g.`delivery_date`
   AND m.`product_id` IN (SELECT `id` FROM `products` WHERE `category` = 0)
   AND pa.`package_id` = m.`product_id`
 GROUP BY `Product`)
ORDER BY `category`,`Product`  ASC;

SELECT *, CONCAT(m.`product_name`, " (", m.`quantity`, m.`unit`, ")") "Product"
  FROM `m_orders` mo, `g_orders` g, `products` p, `m_packages` m
 WHERE g.`delivery_date` = '2017-11-11'
   AND g.`status` != 8
   AND g.`order_id` = mo.`order_id`
   AND p.`id` = mo.`product_id`
   AND p.`category` = 0
   AND m.`package_id` = p.`id` 
   AND m.`delivery_date` = g.`delivery_date`
 ORDER BY `Product`;

#production
(SELECT CONCAT(p.`name`, " (", m.`quantity`, m.`unit`, ")") "Product", COUNT(*) "Quantity", p.`category` "category"
  FROM `m_orders` m, `g_orders` g, `products` p
 WHERE g.`delivery_date` = '2017-12-08'
   AND g.`status` != 8
   AND g.`order_id` = m.`order_id`
   AND p.`id` = m.`product_id`
   AND m.`quantity` > 0
   GROUP BY `Product`)
UNION ALL 
(SELECT CONCAT(m.`product_name`, " (", m.`quantity`, m.`unit`, ")") "Product", COUNT(*) "Quantity", m.`category` "category"
  FROM `m_orders` mo, `g_orders` g, `products` p, `m_packages` m
 WHERE g.`delivery_date` = '2017-12-08'
   AND g.`status` != 8
   AND g.`order_id` = mo.`order_id`
   AND p.`id` = mo.`product_id`
   AND m.`delivery_date` = g.`delivery_date`
   AND p.`category` = 0
   AND m.`package_id` = p.`id` 
   AND m.`quantity` > 0
   GROUP BY `Product`
 )
 ORDER BY `category`, `Product`;

INSERT INTO `trading`(`farmer_id`, `product_id`, `product_name`, `capacity`, `unit_quantity`, `unit`, `price`, `price_wholesale`, `price_farmer`, `sold`, `status`, `delivery_date`, `priority`, `category`) 
SELECT `farmer_id`, `product_id`, `product_name`, `capacity`, `unit_quantity`, `unit`, `price`, `price_wholesale`, `price_farmer`, 0, 1, DATE_ADD(`delivery_date`, INTERVAL 7 DAY), `priority`, `category`
  FROM `trading`
 WHERE `status`= 1;

 UPDATE `trading` 
    SET `status`=2
 WHERE `delivery_date`= '2017-12-08';


#stats one specific product:
(SELECT g.`order_id`, g.`delivery_name`, "Lẻ" AS "order_as", m.`quantity` "quantity", m.`unit` "unit", g.`delivery_address`
  FROM `m_orders` m, `g_orders` g, `products` p
 WHERE g.`delivery_date` = '2017-11-11'
   AND g.`status` != 8
   AND g.`order_id` = m.`order_id`
   AND p.`id` = m.`product_id`
   AND p.`id` = 69)
UNION ALL 
(SELECT g.`order_id`, g.`delivery_name`, "Gói" AS "order_as", m.`quantity` "quantity", m.`unit` "unit", g.`delivery_address`
  FROM `m_orders` mo, `g_orders` g, `products` p, `m_packages` m
 WHERE g.`delivery_date` = '2017-11-11'
   AND g.`status` != 8
   AND g.`order_id` = mo.`order_id`
   AND p.`id` = mo.`product_id`
   AND m.`product_id` =69
   AND m.`delivery_date` = g.`delivery_date`
   AND p.`category` = 0
   AND m.`package_id` = p.`id` 
 )

UPDATE `products` p, `trading` tr 
   SET p.`farmer_id`= tr.`farmer_id` 
 WHERE p.`farmer_id` IS NULL
   AND tr.`status` = 1
   AND tr.`product_id` = p.`id`;

SELECT * 
  FROM `products`
WHERE `farmer_id` IS NULL;

UPDATE `products` p, `trading` tr 
   SET p.`price_farmer`= tr.`price_farmer` 
 WHERE p.`price_farmer` IS NULL
   AND tr.`status` = 1
   AND tr.`product_id` = p.`id`;

UPDATE `trading` tr, `products` p 
  SET tr.`price` = p.`price`,
      tr.`price_wholesale` = p.`price_wholesale`,
      tr.`unit_quantity` = p.`unit_quantity`
WHERE tr.`product_id` = p.`id`;

SELECT `order_id`, g.`delivery_name`, g.`delivery_phone`, g.`delivery_address`, d.`name` "district", "10h00", g.`total`, g.`note`, d.`area` 
  FROM `g_orders` g, `district` d
 WHERE g.`status` !=8
   AND g.`delivery_date`='2017-11-25' 
   AND g.`delivery_district` = d.`id` 
ORDER BY d.`area`, `district` DESC

#change product farmer trading
UPDATE `trading` tr, `g_orders` g, `m_orders` mo, `m_packages` m 
   SET tr.`farmer_id` = 1,
       mo.`farmer_id` = 1,
       m.`farmer_id` = 1
 WHERE tr.`delivery_date` = g.`delivery_date`
   AND m.`delivery_date` = g.`delivery_date`
   AND g.`delivery_date` = "2017-11-18"
   AND mo.`order_id` = g.`order_id`
   AND tr.`product_id` = mo.`product_id`
   AND m.`product_id` = tr.`product_id`
   AND tr.`product_id` = 41;



SELECT SUM(`total`)
  FROM `g_orders`
 WHERE `status` != 8
   AND `delivery_date` = '2017-11-04';

   SELECT SUM(`price`) "Price", SUM(`price_farmer`) "Pay"
  FROM `m_orders` m, `g_orders` g 
 WHERE g.`order_id` = m.`order_id` 
   AND g.`status` != 8
   AND g.`delivery_date` = '2017-11-04';

SELECT CONCAT(g.`delivery_address`, " ", d.`name`) 
  FROM `g_orders` g, `district` d
 WHERE g.`delivery_date` = '2017-10-28'
   AND d.`id` = g.`delivery_district`;

 UPDATE `g_orders` g, `district` d
   SET g.`delivery_address` = CONCAT(g.`delivery_address`, " ", d.`name`)
 WHERE g.`delivery_date` = '2017-10-28'
   AND d.`id` = g.`delivery_district`;

SELECT * FROM `trading` WHERE `delivery_date`='2017-11-18' ORDER BY `category` 


SELECT g.`order_id` "order_id", c.`name` "customer_name", g.`delivery_phone` "phone",
     g.`delivery_address` "address", g.`delivery_district` "district", 
  FROM `g_orders` g, `m_orders` m, `customers` c;

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`) 

INSERT INTO `m_packages`(`package_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`)
SELECT 64, `farmer_id`, `product_id`, `quantity`, `unit`, `price`
  FROM `m_packages`
 WHERE `package_id` = 61;

DELETE FROM `m_orders` WHERE `order_id` in (1000107, 1000108, 1000110, 1000113, 1000116);
DELETE FROM `g_orders` WHERE `order_id` in (1000107, 1000108, 1000110, 1000113, 1000116);

SELECT m.`id`, m.`quantity`, m.`unit`, m.`price`, g.`total`, d.`shipping_cost`
                                     FROM `m_orders` m, `g_orders` g, `district` d
                                    WHERE g.`order_id` = m.`order_id`
                                      AND d.`id` = g.`delivery_district`
                                      AND m.`order_id` = 1000137
                                      AND `product_id` = 58
                                      AND `farmer_id` = 2

SELECT f.`name`, p.`name`, p.`unit_quantity`, p.`unit`, p.`price`, tr.`price_farmer`, tr.`delivery_date`, tr.`category`, tr.`status`
  FROM `trading` tr, `products` p, `farmers` f
 WHERE `delivery_date`='2017-11-18'
   AND tr.`product_id` = p.`id` 
   AND tr.`farmer_id` = f.`id` 
 ORDER BY `category`;

 #Setup Trading Admin and package Admin
 SELECT f.`name`, p.`name`, tr.`capacity`, p.`unit_quantity`, p.`unit`, p.`price`, tr.`price_farmer`, tr.`delivery_date`, tr.`category`, tr.`status`
  FROM `trading` tr, `products` p, `farmers` f
 WHERE `delivery_date`='2017-11-18'
   AND tr.`product_id` = p.`id` 
   AND tr.`farmer_id` = f.`id` 
 ORDER BY `category`;

SELECT f.`name`, p.`name`, ROUND(tr.`capacity`, 2), ROUND(p.`unit_quantity`, 2), p.`unit`, p.`price`, tr.`price_farmer`, tr.`delivery_date`, p.`category`, 1 as "status"
  FROM `trading` tr, `products` p, `farmers` f
 WHERE `delivery_date`='2017-11-18'
   AND tr.`product_id` = p.`id` 
   AND tr.`farmer_id` = f.`id` 
UNION 
  SELECT f.`name`, p.`name`, 0, 0.3, "kg", p.`price`, 0, "2017-11-18", p.`category`, 0 AS "status"
  FROM `products` p, `farmers` f
 WHERE f.`id` = p.`farmer_id`
   AND p.`id` NOT IN (SELECT `product_id` FROM `trading` WHERE `delivery_date`='2017-11-18') 
 ORDER BY `category`;



SELECT * 
  FROM `trading`
 WHERE `status`=1
 ORDER BY `category`;

SELECT m.`package_id`, p.`name`, tr.`capacity`, tr.`sold`, tr.`unit`, m.`quantity`, m.`unit`
  FROM `trading` tr, `m_packages` m, `products` p
 WHERE tr.`status`=1
   AND m.`product_id` = tr.`product_id` 
   AND m.`farmer_id` = tr.`farmer_id`
   AND p.`id` = tr.`product_id`
 ORDER BY m.`package_id`, tr.`category`;

UPDATE `trading` 
   SET `sold`=0
 WHERE `status`=1;


SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", 
       m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" 
  FROM `m_orders` m, `products` p, `farmers` f 
 WHERE p.`id` = m.`product_id` 
   AND f.`id` = m.`farmer_id` 
   AND `order_id` = ?

SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", 
       m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" 
  FROM `m_packages` m, `products` p, `farmers` f 
 WHERE p.`id` = m.`product_id` 
   AND f.`id` = m.`farmer_id` 
   AND m.`package_id` = ?;


#Add item into order
INSERT INTO m_orders(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`) VALUES(?,?,?,?,?,?,?)


#Bớt 2kg Xoài - 69:  1kg Ổi 71
#order: 1000138  Farmer: 9

INSERT INTO `m_orders`(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`) VALUES (1000137, 2, 44, 1, "kg", 150000, 95000);
UPDATE `trading` 
    SET `sold` = `sold` - 2 
  WHERE `status` = 1 
    AND `delivery_date` = '2017-10-28'
    AND `farmer_id` = 9 
    AND `product_id` = 69;

UPDATE `trading` 
    SET `sold` = `sold` - 1 
  WHERE `status` = 1 
    AND `delivery_date` = '2017-10-28'
    AND `farmer_id` = 9 
    AND `product_id` = 71;

UPDATE `trading` 
    SET `sold` = `sold` - 1 
  WHERE `status` = 1 
    AND `delivery_date` = '2017-10-28'
    AND `farmer_id` = 2 
    AND `product_id` = 58;


UPDATE `g_orders` 
  SET `total` = ? ,
      `shipping_cost` = `shipping_cost` - ?
WHERE `farmer_id` = ? 
  AND `order_id` = ?
  AND `product_id` = ?

SELECT * 
FROM `trading` tr
WHERE (`delivery_date`='2017-11-11' OR `delivery_date`='2017-11-18')
  AND `product_id` IN  (SELECT m.`product_id` 
                           FROM `g_orders` g, `m_orders` m 
                          WHERE m.`order_id` = g.`order_id` 
                            AND g.`order_id` = 1000200
                        ) 
ORDER BY `delivery_date`, `category`;

SELECT * 
FROM `trading` tr
WHERE `delivery_date`='2017-11-04'
  AND (`product_id` IN  (SELECT m.`product_id` 
                           FROM `g_orders` g, `m_orders` m 
                          WHERE m.`order_id` = g.`order_id` 
                            AND g.`order_id` = 1000166) 
       OR `product_id` IN (SELECT `product_id` 
                             FROM `m_packages` 
                            WHERE `package_id` = 61
                              AND `delivery_date` = tr.`delivery_date`)
      )
ORDER BY `category`;       

#Modify the on-fly-printing
#g_orders ADD column order_total before total;
UPDATE `g_orders` SET `order_total`=`total`;

ALTER TABLE `m_orders` ADD `order_quantity` FLOAT NULL AFTER `product_id`;
UPDATE `m_orders` SET `order_quantity`=`quantity`;

#Chỉnh sửa kiểu Order, rã gói:
ALTER TABLE `m_orders` ADD `order_type` INT NULL COMMENT '0:gói, 1:lẻ, 2:biếu tặng, 4: giá gốc' AFTER `price_farmer`;

#English Version
`products` table 
Add `farmer_id`
ALTER TABLE `products` ADD `en_name` VARCHAR(255) NULL AFTER `name`;
ALTER TABLE `products` ADD `en_description` TEXT NULL AFTER `description`;
ALTER TABLE `products` ADD `en_short_description` TEXT NULL AFTER `short_description`;

#categories
ALTER TABLE `categories` ADD `en_name` VARCHAR(255) NULL AFTER `name`;

#farmers
ALTER TABLE `farmers` ADD `en_name` VARCHAR(100) NULL AFTER `profile`, 
                      ADD `en_short_address` VARCHAR(150) NULL AFTER `en_name`, 
                      ADD `en_product_list` VARCHAR(150) NULL AFTER `en_short_address`, 
                      ADD `en_quality` VARCHAR(150) NULL AFTER `en_product_list`;
ALTER TABLE `farmers` ADD `en_profile` TEXT NULL AFTER `profile`;






