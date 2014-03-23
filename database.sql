
DROP TABLE IF EXISTS `dns_user`;
CREATE TABLE `dns_user`(
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`username` CHAR(50) UNIQUE NOT NULL DEFAULT '',
`password` CHAR(32) NOT NULL DEFAULT '',
`nickname` VARCHAR(16) NOT NULL DEFAULT '',
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
KEY `name_pass`(`username`(10),`password`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '用户表';


DROP TABLE IF EXISTS `dns_account`;
CREATE TABLE `dns_account`(
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`uid` INT UNSIGNED NOT NULL DEFAULT 0,
`dnspod_username` CHAR(100) NOT NULL DEFAULT '',
`dnspod_password` CHAR(50) NOT NULL DEFAULT '' COMMENT 'Encrypt过的密码',
`nickname` VARCHAR(32) NOT NULL DEFAULT '',
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
FOREIGN KEY(`uid`) REFERENCES `dns_user`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT 'DNSPOD账户表';

DROP TABLE IF EXISTS `dns_domain`;
CREATE TABLE `dns_domain`(
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`aid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Account ID',
`domain_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '域名在DNSPOD中的ID',
`domain_name` CHAR(80) NOT NULL DEFAULT '',
`created_on` TIMESTAMP NOT NULL DEFAULT 0,
`updated_on` TIMESTAMP NOT NULL DEFAULT 0,
PRIMARY KEY(`id`),
FOREIGN KEY(`aid`) REFERENCES `dns_account`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '域名表';

DROP TABLE IF EXISTS `dns_record`;
CREATE TABLE `dns_record`(
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`did` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Domain ID',
`record_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '此记录在DNSPOD中的ID',
`name` CHAR(80) NOT NULL DEFAULT '',
`type` CHAR(10) NOT NULL DEFAULT '',
`line` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '线路',
`value` CHAR(100) NOT NULL DEFAULT '' COMMENT '记录的值',
`ttl` INT UNSIGNED NOT NULL DEFAULT 0,
`status` CHAR(10) NOT NULL DEFAULT '',
`created_on` TIMESTAMP NOT NULL DEFAULT 0,
`updated_on` TIMESTAMP NOT NULL DEFAULT 0,
PRIMARY KEY(`id`),
FOREIGN KEY(`did`) REFERENCES `dns_domain`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '域名记录表';