
-- view_articles_page
SELECT `a`.`article_articles` AS `articles`, `a`.`position_articles` AS `position`, `p`.`nom_pages` AS `pages` 
FROM (`articles` `a` join `pages` `p`)
WHERE `p`.`id_pages` = `a`.`id_pages` 
ORDER BY position ASC

--view_articles_page_admin
SELECT `a`.`articles_admin_articles` AS `articles`, `a`.`position_admin_articles` AS `position`, `p`.`nom_pages` AS `pages`, `a`.`id_pages` as `idpage`, `a`.`id_admin_articles` as id_articles
FROM (`admin_articles` `a` join `pages` `p`)
WHERE `p`.`id_pages` = `a`.`id_pages` 
ORDER BY position ASC

--view_images_page
SELECT i.nom_images as nom, i.ext_images as ext, i.position_images as position, p.nom_pages as pages FROM images as i, pages as p
WHERE i.id_pages = p.id_pages
ORDER BY i.position_images ASC

--view_images_page_admin
SELECT i.nom_admin_images as nom, i.ext_admin_images as ext, i.position_admin_images as position, p.nom_pages as pages, i.id_admin_images as id_images
FROM admin_images as i, pages as p
WHERE i.id_pages = p.id_pages  
ORDER BY `position`  ASC