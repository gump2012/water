-- ============================================================
-- MySQL 5.7 图片 URL 批量替换脚本
-- 将 oss.tigshop.com/img/ 下的图片 URL 替换为
-- img.lxxshop.com/img/gallery/202501/ + 文件名
-- ============================================================
--
-- 使用方法（在服务器上执行）：
--   mysql -u user -p123456 user < replace_img_urls.sql
--
-- ⚠️ 执行前请先备份数据库！
--   mysqldump -u user -p123456 user > backup_before_replace.sql
-- ============================================================

START TRANSACTION;

-- 所有需要替换的目录前缀
-- gallery/demo/ gallery/202304/ gallery/202305/ gallery/202306/
-- gallery/202403/ gallery/202404/ gallery/202405/ gallery/202406/
-- gallery/202407/ gallery/202411/ gallery/202501/
-- item/demo/ upload/202409/

-- ============================================================
-- 1. category 表 (category_pic, category_ico)
-- ============================================================
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- ============================================================
-- 2. config 表 (biz_val)
-- ============================================================
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- ============================================================
-- 3. friend_links 表 (link_logo)
-- ============================================================
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- ============================================================
-- 4. gallery_pic 表 (pic_url, pic_thumb)
-- ============================================================
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- ============================================================
-- 5. product_gallery 表 (pic_url, pic_thumb, pic_original, pic_large)
-- ============================================================
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- ============================================================
-- 6. product 表 (pic_url, pic_thumb, pic_original, product_desc)
-- ============================================================
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- ============================================================
-- 7. user_rank 表 (rank_logo, rank_bg, rights)
-- ============================================================
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/upload/202409/%';

UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/demo/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202304/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202304/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202305/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202305/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202306/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202306/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202403/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202403/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202404/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202404/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202405/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202405/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202406/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202406/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202407/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202407/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202411/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202411/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202501/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202501/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/item/demo/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/item/demo/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/upload/202409/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/upload/202409/%';

-- rights 字段是 JSON 格式，URL 中的 / 被转义为 \/
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/demo\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/demo\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202304\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202304\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202305\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202305\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202306\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202306\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202403\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202403\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202404\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202404\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202405\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202405\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202406\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202406\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202407\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202407\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202411\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202411\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202501\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202501\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/item\\/demo\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/item\\/demo\\/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/upload\\/202409\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/upload\\/202409\\/%';

COMMIT;

-- ============================================================
-- 验证查询（执行后检查是否还有残留，应全部返回 0）
-- ============================================================
SELECT 'category' AS tbl, COUNT(*) AS cnt FROM `category` WHERE `category_pic` LIKE '%oss.tigshop.com/img/%' OR `category_ico` LIKE '%oss.tigshop.com/img/%'
UNION ALL
SELECT 'config', COUNT(*) FROM `config` WHERE `biz_val` LIKE '%oss.tigshop.com/img/%'
UNION ALL
SELECT 'friend_links', COUNT(*) FROM `friend_links` WHERE `link_logo` LIKE '%oss.tigshop.com/img/%'
UNION ALL
SELECT 'gallery_pic', COUNT(*) FROM `gallery_pic` WHERE `pic_url` LIKE '%oss.tigshop.com/img/%' OR `pic_thumb` LIKE '%oss.tigshop.com/img/%'
UNION ALL
SELECT 'product_gallery', COUNT(*) FROM `product_gallery` WHERE `pic_url` LIKE '%oss.tigshop.com/img/%' OR `pic_thumb` LIKE '%oss.tigshop.com/img/%' OR `pic_original` LIKE '%oss.tigshop.com/img/%' OR `pic_large` LIKE '%oss.tigshop.com/img/%'
UNION ALL
SELECT 'product', COUNT(*) FROM `product` WHERE `pic_url` LIKE '%oss.tigshop.com/img/%' OR `pic_thumb` LIKE '%oss.tigshop.com/img/%' OR `pic_original` LIKE '%oss.tigshop.com/img/%' OR `product_desc` LIKE '%oss.tigshop.com/img/%'
UNION ALL
SELECT 'user_rank', COUNT(*) FROM `user_rank` WHERE `rank_logo` LIKE '%oss.tigshop.com/img/%' OR `rank_bg` LIKE '%oss.tigshop.com/img/%' OR `rights` LIKE '%oss.tigshop.com/img/%';