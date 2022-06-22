LOCK TABLES `facility-dev`.`facility_code_pool` WRITE;
INSERT IGNORE INTO `facility-dev`.`facility_code_pool` VALUES (2, 'Phytec Seriennummern', '^S[0-9ABCDEF]{8}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility-dev`.`facility_code_pool` VALUES (12, 'Phytec Mac adressen', '^502DF4[0-9ABCDEF]{6}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility-dev`.`facility_code_pool` VALUES (22, 'Phytec Productionscodes', '^P[0-9]{8}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility-dev`.`facility_code_pool` VALUES (82, 'Phytec Seriennummern (alt)', '^[0-9A-Z]{2}[0-9]{4}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;

LOCK TABLES `facility-dev`.`facility_stack_detail` WRITE;
INSERT IGNORE INTO `facility-dev`.`facility_stack_detail` VALUES (1, 654321, 123456, 'TH-085.A1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;

LOCK TABLES `facility-dev`.`facility_stack_image` WRITE;
INSERT IGNORE INTO `facility-dev`.`facility_stack_image` VALUES (1, 1, 'barebox.bin', '//U13-1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility-dev`.`facility_stack_image` VALUES (2, 1, 'zImage', '//U13-2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;

LOCK TABLES `facility-dev`.`test_facility_version` WRITE;
INSERT IGNORE INTO `facility-dev`.`test_facility_version` VALUES (1, '1.0.0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility-dev`.`test_facility_version` VALUES (1, '1.0.1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;
