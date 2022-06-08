CREATE TABLE IF NOT EXISTS `facility_code_pool`
(
    `facility_code_pool_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`                  VARCHAR(100)                        NOT NULL,
    `regex`                 VARCHAR(100)                        NOT NULL,
    `creation_date`         TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `alteration_date`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`facility_code_pool_id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `facility_stack_detail`
(
    `facility_stack_detail_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `production_order_id`      INT UNSIGNED NOT NULL,
    `buck_sheet_id`            INT UNSIGNED NOT NULL,
    `part_number`              VARCHAR(250)                        NOT NULL,
    `creation_date`            TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `alteration_date`          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`facility_stack_detail_id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `facility_stack_image`
(
    `facility_stack_image_id`  INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `facility_stack_detail_id` INT UNSIGNED NOT NULL,
    `part_number`              VARCHAR(250)                        NOT NULL,
    `reference`                VARCHAR(50)                         NOT NULL,
    `creation_date`            TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `alteration_date`          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (`facility_stack_detail_id`) REFERENCES `facility_stack_detail` (`facility_stack_detail_id`),
    PRIMARY KEY (`facility_stack_image_id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `facility_core_version`
(
    `facility_core_version_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `version`                  VARCHAR(200)                        NOT NULL UNIQUE,
    `creation_date`            TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `alteration_date`          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`facility_core_version_id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
