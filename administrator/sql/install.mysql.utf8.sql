CREATE TABLE IF NOT EXISTS `#__eventshandler_events` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR(255)  NOT NULL ,
`description` TEXT NOT NULL ,
`date` DATE NOT NULL ,
`start_time` VARCHAR(128)  NOT NULL ,
`end_time` VARCHAR(128)  NOT NULL ,
`image` TEXT  NOT NULL ,
`link_fb` TEXT NOT NULL ,
`link_tw` TEXT NOT NULL ,
`link_yt` TEXT NOT NULL ,
`place_id` INT(11) NOT NULL ,
`special_id` INT(11) NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__eventshandler_places` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR(255)  NOT NULL ,
`address` VARCHAR(255)  NOT NULL ,
`link_fb` TEXT NOT NULL ,
`link_tw` TEXT NOT NULL ,
`website` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__eventshandler_specials` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR(255)  NOT NULL ,
`logo` TEXT  NOT NULL ,
`description` TEXT NOT NULL ,
`image` TEXT  NOT NULL ,
`link_fb` TEXT NOT NULL ,
`link_tw` TEXT NOT NULL ,
`link_yt` TEXT NOT NULL ,
`website` TEXT NOT NULL ,
`color1` VARCHAR(50),
`color2` VARCHAR(50) ,
`color3` VARCHAR(50),
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

