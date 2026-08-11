-- ============================================================
-- 补充修复脚本：处理遗漏的 gallery/202608/ 目录
-- ============================================================
-- 使用方法：
--   mysql -u user -p123456 user < fix_remaining.sql
-- ============================================================

START TRANSACTION;

-- gallery_pic 表
UPDATE `gallery_pic` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `gallery_pic` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202608/%';

-- 其他表也一并补充（防止有遗漏）
UPDATE `category` SET `category_pic` = REPLACE(`category_pic`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_pic` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `category` SET `category_ico` = REPLACE(`category_ico`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `category_ico` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `config` SET `biz_val` = REPLACE(`biz_val`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `biz_val` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `friend_links` SET `link_logo` = REPLACE(`link_logo`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `link_logo` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product_gallery` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product_gallery` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product_gallery` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product_gallery` SET `pic_large` = REPLACE(`pic_large`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_large` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product` SET `pic_url` = REPLACE(`pic_url`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_url` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product` SET `pic_thumb` = REPLACE(`pic_thumb`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_thumb` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product` SET `pic_original` = REPLACE(`pic_original`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `pic_original` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `product` SET `product_desc` = REPLACE(`product_desc`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `product_desc` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `user_rank` SET `rank_logo` = REPLACE(`rank_logo`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_logo` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `user_rank` SET `rank_bg` = REPLACE(`rank_bg`, 'https://oss.tigshop.com/img/gallery/202608/', 'https://img.lxxshop.com/img/gallery/202501/') WHERE `rank_bg` LIKE '%oss.tigshop.com/img/gallery/202608/%';
UPDATE `user_rank` SET `rights` = REPLACE(`rights`, 'https:\\/\\/oss.tigshop.com\\/img\\/gallery\\/202608\\/', 'https:\\/\\/img.lxxshop.com\\/img\\/gallery\\/202501\\/') WHERE `rights` LIKE '%oss.tigshop.com\\/img\\/gallery\\/202608\\/%';

COMMIT;

-- 验证
SELECT 'gallery_pic' AS tbl, COUNT(*) AS cnt FROM `gallery_pic` WHERE `pic_url` LIKE '%oss.tigshop.com/img/%' OR `pic_thumb` LIKE '%oss.tigshop.com/img/%';