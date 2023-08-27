/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : sports

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 06/07/2023 16:32:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for borrow
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `borrowtime` datetime(0) NULL DEFAULT NULL,
  `nameNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of borrow
-- ----------------------------
INSERT INTO `borrow` VALUES (2, 'ppq', '12', '2023-06-08 00:00:00', '小熊');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `categoryName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'qiulei', '球类');
INSERT INTO `category` VALUES (4, 'jianshen', '健身类');
INSERT INTO `category` VALUES (5, 'youyang', '有氧类');
INSERT INTO `category` VALUES (6, 'ikun', '爱困类');
INSERT INTO `category` VALUES (7, 'fei', '飞类');

-- ----------------------------
-- Table structure for equipment
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `equipmentName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipment
-- ----------------------------
INSERT INTO `equipment` VALUES (1, 'lanqiu', '篮球');
INSERT INTO `equipment` VALUES (2, 'ppq', '乒乓球');

-- ----------------------------
-- Table structure for name
-- ----------------------------
DROP TABLE IF EXISTS `name`;
CREATE TABLE `name`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nameName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of name
-- ----------------------------
INSERT INTO `name` VALUES (1, 'xx', '小熊');

-- ----------------------------
-- Table structure for nation
-- ----------------------------
DROP TABLE IF EXISTS `nation`;
CREATE TABLE `nation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nationNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nationName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nation
-- ----------------------------
INSERT INTO `nation` VALUES (1, 'hanzu', '汉族');
INSERT INTO `nation` VALUES (2, 'zhuangzu', '壮族');

-- ----------------------------
-- Table structure for qx_juese
-- ----------------------------
DROP TABLE IF EXISTS `qx_juese`;
CREATE TABLE `qx_juese`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jueseId` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jueseName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `jueseId`, `jueseName`) USING BTREE,
  UNIQUE INDEX `jueseId`(`jueseId`, `jueseName`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qx_juese
-- ----------------------------
INSERT INTO `qx_juese` VALUES (1, 'j001', '超级管理员', 1);
INSERT INTO `qx_juese` VALUES (2, 'j002', '普通管理员', 0);
INSERT INTO `qx_juese` VALUES (3, 'j003', '用户', 1);
INSERT INTO `qx_juese` VALUES (4, 'j004', '学生', 1);
INSERT INTO `qx_juese` VALUES (5, 'j005', '老师', 1);
INSERT INTO `qx_juese` VALUES (11, 'j006', '家长', 1);

-- ----------------------------
-- Table structure for qx_jueserule
-- ----------------------------
DROP TABLE IF EXISTS `qx_jueserule`;
CREATE TABLE `qx_jueserule`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jueseId` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ruleId` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `jueseId`(`jueseId`, `ruleId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qx_jueserule
-- ----------------------------
INSERT INTO `qx_jueserule` VALUES (44, '', '');
INSERT INTO `qx_jueserule` VALUES (1, 'j001', 'r001');
INSERT INTO `qx_jueserule` VALUES (2, 'j001', 'r002');
INSERT INTO `qx_jueserule` VALUES (3, 'j001', 'r003');
INSERT INTO `qx_jueserule` VALUES (27, 'j001', 'r004');
INSERT INTO `qx_jueserule` VALUES (28, 'j001', 'r005');
INSERT INTO `qx_jueserule` VALUES (29, 'j001', 'r006');
INSERT INTO `qx_jueserule` VALUES (30, 'j001', 'r007');
INSERT INTO `qx_jueserule` VALUES (31, 'j001', 'r008');
INSERT INTO `qx_jueserule` VALUES (32, 'j001', 'r009');
INSERT INTO `qx_jueserule` VALUES (33, 'j001', 'r010');
INSERT INTO `qx_jueserule` VALUES (34, 'j001', 'r011');
INSERT INTO `qx_jueserule` VALUES (35, 'j001', 'r012');
INSERT INTO `qx_jueserule` VALUES (36, 'j001', 'r013');
INSERT INTO `qx_jueserule` VALUES (37, 'j001', 'r014');
INSERT INTO `qx_jueserule` VALUES (42, 'j001', 'r015');
INSERT INTO `qx_jueserule` VALUES (38, 'j002', 'r002');
INSERT INTO `qx_jueserule` VALUES (39, 'j002', 'r003');
INSERT INTO `qx_jueserule` VALUES (41, 'j003', 'r008');
INSERT INTO `qx_jueserule` VALUES (40, 'j003', 'r009');

-- ----------------------------
-- Table structure for qx_rule
-- ----------------------------
DROP TABLE IF EXISTS `qx_rule`;
CREATE TABLE `qx_rule`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruleId` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ruleName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menuLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `moduleName` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `iconClass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `ruleId`(`ruleId`, `ruleName`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qx_rule
-- ----------------------------
INSERT INTO `qx_rule` VALUES (1, 'r001', '用户管理', 'userlist.php', 'userlist.php', 'icon icon-group');
INSERT INTO `qx_rule` VALUES (2, 'r002', '类别管理', 'categorylist.php', 'categorylist.php', 'icon icon-list-ol');
INSERT INTO `qx_rule` VALUES (3, 'r003', '存放管理', 'storagelist.php', 'storagelist.php', 'icon icon-newspaper-o');
INSERT INTO `qx_rule` VALUES (16, 'r004', '器材管理', 'equipmentlist.php', 'equipmentlist.php', NULL);
INSERT INTO `qx_rule` VALUES (17, 'r005', '商品管理', 'shoplist.php', 'shoplist.php', NULL);
INSERT INTO `qx_rule` VALUES (18, 'r006', '民族管理', 'nationlist.php', 'nationlist.php', NULL);
INSERT INTO `qx_rule` VALUES (19, 'r007', '供应商管理', 'supplierlist.php', 'supplierlist.php', NULL);
INSERT INTO `qx_rule` VALUES (20, 'r008', '供应商信息管理', 'supplierinfolist.php', 'supplierinfolist.php', NULL);
INSERT INTO `qx_rule` VALUES (21, 'r009', '器材报废管理', 'scraplist.php', 'scraplist.php', NULL);
INSERT INTO `qx_rule` VALUES (22, 'r010', '借用管理', 'borrowlist.php', 'borrowlist.php', NULL);
INSERT INTO `qx_rule` VALUES (23, 'r011', '归还管理', 'repaylist.php', 'repaylist.php', NULL);
INSERT INTO `qx_rule` VALUES (24, 'r012', '权限_角色管理', 'jueselist.php', 'jueselist.php|jueseinsert.php|jueseUpdate.php|jueseSave.php', 'icon icon-group');
INSERT INTO `qx_rule` VALUES (25, 'r013', '权限_模块管理', 'rulelist.php', 'rulelist.php|ruleinsert.php|ruleupdate.php|ruleSave.php', 'icon icon-list');
INSERT INTO `qx_rule` VALUES (26, 'r014', '权限_为用户分配角色', 'userJueselist.php', 'userJueselist.php|userJueseInsert.php|userJueseUpdate.php|userJueseSave.php', 'icon icon-signin');
INSERT INTO `qx_rule` VALUES (27, 'r015', '权限_为角色分配模块', 'jueserulelist.php', 'jueserulelist.php', 'icon icon-edit');

-- ----------------------------
-- Table structure for qx_userjuese
-- ----------------------------
DROP TABLE IF EXISTS `qx_userjuese`;
CREATE TABLE `qx_userjuese`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jueseId` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `userName`(`userName`, `jueseId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qx_userjuese
-- ----------------------------
INSERT INTO `qx_userjuese` VALUES (32, 'abc', 'j002');
INSERT INTO `qx_userjuese` VALUES (27, 'abc', 'j003');
INSERT INTO `qx_userjuese` VALUES (1, 'test', 'j001');
INSERT INTO `qx_userjuese` VALUES (2, 'test', 'j002');
INSERT INTO `qx_userjuese` VALUES (30, 'user', 'j002');
INSERT INTO `qx_userjuese` VALUES (31, 'user', 'j003');

-- ----------------------------
-- Table structure for repay
-- ----------------------------
DROP TABLE IF EXISTS `repay`;
CREATE TABLE `repay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `repaytime` datetime(0) NULL DEFAULT NULL,
  `nameNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of repay
-- ----------------------------
INSERT INTO `repay` VALUES (2, '乒乓球', '11', '2023-07-08 00:00:00', '小熊');

-- ----------------------------
-- Table structure for resource
-- ----------------------------
DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resourceNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `resourceName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `categoryNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `introduction` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `upFilePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of resource
-- ----------------------------
INSERT INTO `resource` VALUES (10, '123', '666', 'youyang', '<img src=\"http://localhost/qicai/inc/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" />请在此输入资源简介……', 'uploadfile/test/1688628676.zip', '11');

-- ----------------------------
-- Table structure for scrap
-- ----------------------------
DROP TABLE IF EXISTS `scrap`;
CREATE TABLE `scrap`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scrapName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `scrapNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `scraptime` date NULL DEFAULT NULL,
  `scrapcause` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scrap
-- ----------------------------
INSERT INTO `scrap` VALUES (1, '篮球', 'lanqiu', '2023-06-14', '有包', '报废');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `shopName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `categoryNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `shopMoney` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `BImgpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `shopDescp` varchar(2550) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES (4, 'lanqiu', '篮球', 'qiulei', '1', '', '<img alt=\"\" src=\"http://127.0.0.1/learn4/inc/kindeditor/plugins/emoticons/images/11.gif\" border=\"0\" />请在此输入商品简介……', '无');
INSERT INTO `shop` VALUES (5, '看ii看i', '12', 'youyang', '1', '2023-07/1688403369.gif', '<img src=\"http://localhost/learn4/inc/kindeditor/plugins/emoticons/images/2.gif\" border=\"0\" alt=\"\" />请在此输入商品简介……', 'qw');

-- ----------------------------
-- Table structure for storage
-- ----------------------------
DROP TABLE IF EXISTS `storage`;
CREATE TABLE `storage`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `storageNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `storageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `categoryNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `introduction` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `BImgpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of storage
-- ----------------------------
INSERT INTO `storage` VALUES (1, '20', '232', '历史21', '56', '');
INSERT INTO `storage` VALUES (2, '12', '12', '123', '<img src=\"http://localhost/learn4/inc/kindeditor/plugins/emoticons/images/9.gif\" border=\"0\" alt=\"\" />请在此输入商品简介……', '');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guige` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `supplierNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ArticleContent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `BImgpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (2, 'ppq', '1', '1', '2023-06-29', 'xxx', '<img src=\"http://localhost/qicai/inc/kindeditor/plugins/emoticons/images/10.gif\" border=\"0\" alt=\"\" />请在此输入商品简介……', '2023-07/1688630801.jpg');

-- ----------------------------
-- Table structure for supplierinfo
-- ----------------------------
DROP TABLE IF EXISTS `supplierinfo`;
CREATE TABLE `supplierinfo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `supplierName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplierinfo
-- ----------------------------
INSERT INTO `supplierinfo` VALUES (1, 'xxx', '嘻嘻嘻有限公司');

-- ----------------------------
-- Table structure for userinfo
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `passWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `nationNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ArticleContent` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `BImgpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES (4, 'test', '123', '13457789896', '129@qq.com', '2023-06-08', 'hanzu', '女', '<img src=\"http://localhost/learn4/inc/kindeditor/plugins/emoticons/images/11.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/learn4/inc/kindeditor/plugins/emoticons/images/1.gif\" border=\"0\" alt=\"\" />请输入简历...', '');
INSERT INTO `userinfo` VALUES (5, 'abc', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `userinfo` VALUES (6, 'user', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- View structure for v_jueserule
-- ----------------------------
DROP VIEW IF EXISTS `v_jueserule`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_jueserule` AS select `qx_juese`.`jueseName` AS `jueseName`,`qx_jueserule`.`id` AS `id`,`qx_jueserule`.`jueseId` AS `jueseId`,`qx_jueserule`.`ruleId` AS `ruleId`,`qx_rule`.`ruleName` AS `ruleName`,`qx_rule`.`menuLink` AS `menuLink`,`qx_rule`.`moduleName` AS `moduleName`,`qx_rule`.`iconClass` AS `iconClass` from ((`qx_juese` join `qx_jueserule` on((`qx_jueserule`.`jueseId` = `qx_juese`.`jueseId`))) join `qx_rule` on((`qx_jueserule`.`ruleId` = `qx_rule`.`ruleId`)));

-- ----------------------------
-- View structure for v_userjuese
-- ----------------------------
DROP VIEW IF EXISTS `v_userjuese`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_userjuese` AS select `qx_userjuese`.`id` AS `id`,`qx_userjuese`.`userName` AS `userName`,`qx_userjuese`.`jueseId` AS `jueseId`,`qx_juese`.`jueseName` AS `jueseName` from (`qx_userjuese` join `qx_juese` on((`qx_userjuese`.`jueseId` = `qx_juese`.`jueseId`)));

SET FOREIGN_KEY_CHECKS = 1;
