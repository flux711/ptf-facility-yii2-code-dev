LOCK TABLES `facility_code_pool` WRITE;
INSERT IGNORE INTO `facility_code_pool` VALUES (1, 'Phytec Seriennummern', '^S[0-9ABCDEF]{8}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility_code_pool` VALUES (2, 'Phytec Mac adressen', '^502DF4[0-9ABCDEF]{6}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility_code_pool` VALUES (3, 'Phytec Productionscodes', '^P[0-9]{8}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility_code_pool` VALUES (4, 'Phytec Seriennummern (alt)', '^[0-9A-Z]{2}[0-9]{4}$', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;

LOCK TABLES `facility_stack_detail` WRITE;
INSERT IGNORE INTO `facility_stack_detail` VALUES (1, 654321, 123456, 'TH-085.A1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;

LOCK TABLES `facility_stack_image` WRITE;
INSERT IGNORE INTO `facility_stack_image` VALUES (1, 1, 'barebox.bin', '//U13-1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT IGNORE INTO `facility_stack_image` VALUES (2, 1, 'zImage', '//U13-2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;

LOCK TABLES `core_version` WRITE;
INSERT IGNORE INTO `core_version` VALUES (1, '1.0.0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
UNLOCK TABLES;