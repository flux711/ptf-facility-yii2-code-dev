SET FOREIGN_KEY_CHECKS = 0;

INSERT IGNORE INTO `facility_code_pool`
SELECT * FROM `fake_code_pool`;

INSERT IGNORE INTO `facility_stack_detail`
SELECT * FROM `fake_stack_detail`;

INSERT IGNORE INTO `facility_stack_image`
SELECT * FROM `fake_stack_image`;

DROP TABLE `fake_code_pool`;
DROP TABLE `fake_stack_image`;
DROP TABLE `fake_stack_detail`;

SET FOREIGN_KEY_CHECKS = 1;

UPDATE `rhea_settings`
SET `setting_value` = 0
WHERE `setting` = 'use_phptool';
