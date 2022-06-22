SET FOREIGN_KEY_CHECKS = 0;

INSERT IGNORE INTO `facility-dev`.`facility_code_pool`
SELECT * FROM `rhea-dev`.`fake_code_pool`;

INSERT IGNORE INTO `facility-dev`.`facility_stack_detail`
SELECT * FROM `rhea-dev`.`fake_stack_detail`;

INSERT IGNORE INTO `facility-dev`.`facility_stack_image`
SELECT * FROM `rhea-dev`.`fake_stack_image`;

DROP TABLE `rhea-dev`.`fake_code_pool`;
DROP TABLE `rhea-dev`.`fake_stack_image`;
DROP TABLE `rhea-dev`.`fake_stack_detail`;

SET FOREIGN_KEY_CHECKS = 1;

UPDATE `rhea-dev`.`rhea_settings`
SET `rhea-dev`.`setting_value` = 0
WHERE `rhea-dev`.`setting` = 'use_phptool';
