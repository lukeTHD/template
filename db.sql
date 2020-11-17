/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : update_mydas

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 11/11/2020 16:43:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTitle` int(100) NULL DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `userId` int(11) NULL DEFAULT NULL,
  `create_at` timestamp(0) NULL DEFAULT NULL,
  `update_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 123 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contents
-- ----------------------------
INSERT INTO `contents` VALUES (1, 1, 'send 1', 1, '2020-11-01 17:21:38', '2020-11-01 17:21:43');
INSERT INTO `contents` VALUES (2, 1, 'rep 1', 100, '2020-11-02 17:21:59', '2020-11-02 17:22:02');
INSERT INTO `contents` VALUES (3, 2, 'send 1', 2, '2020-11-03 17:27:39', '2020-11-03 17:27:43');
INSERT INTO `contents` VALUES (4, 1, 'rep 2 user 1', 1, '2020-11-02 11:36:44', '2020-11-04 11:34:15');
INSERT INTO `contents` VALUES (5, 2, 'aaaaaa', 100, '2020-11-03 13:08:31', '2020-11-03 13:08:31');
INSERT INTO `contents` VALUES (6, 1, 'dkasda', 100, '2020-11-03 13:32:31', '2020-11-03 13:32:31');
INSERT INTO `contents` VALUES (7, 1, 'send 5', 1, '2020-11-03 13:34:33', '2020-11-03 13:34:36');
INSERT INTO `contents` VALUES (14, 2, 'abc', 100, '2020-11-04 15:27:46', '2020-11-04 15:27:46');
INSERT INTO `contents` VALUES (47, 1, 'rep 2', 100, '2020-11-09 15:46:49', '2020-11-09 15:46:49');
INSERT INTO `contents` VALUES (73, 1, '<p>aaaa</p>\n<p>bbb</p>\n<p>ccc</p>', 100, '2020-11-10 11:30:48', '2020-11-10 11:30:48');
INSERT INTO `contents` VALUES (86, 3, 'test sending', 100, '2020-11-10 13:23:51', '2020-11-10 13:23:57');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for list_template
-- ----------------------------
DROP TABLE IF EXISTS `list_template`;
CREATE TABLE `list_template`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `price` double(8, 2) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT NULL,
  `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of list_template
-- ----------------------------
INSERT INTO `list_template` VALUES (1, '1', '1603694059_1.png', 1.00, NULL, '1', NULL, NULL, NULL);
INSERT INTO `list_template` VALUES (2, '2', '1603694134_1.png', 2.00, NULL, '2', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (3, '2020_10_21_020320_create_table_list_template_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_10_22_090948_create_customers_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_10_22_094436_create_contacts_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_10_22_095349_add_foreign_key_to_contacts_table', 2);
INSERT INTO `migrations` VALUES (7, '2020_10_22_093819_add_status_and_price_to_list_template_table', 3);
INSERT INTO `migrations` VALUES (8, '2020_10_25_065959_add_softdelete_to_list_template_table', 3);

-- ----------------------------
-- Table structure for subject
-- ----------------------------
DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contentTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `userId` int(11) NULL DEFAULT NULL,
  `create_at` timestamp(0) NULL DEFAULT NULL,
  `update_at` timestamp(0) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subject
-- ----------------------------
INSERT INTO `subject` VALUES (1, 'Chủ đề 1', 1, '2020-11-24 15:56:47', '2020-11-25 15:56:51', 1);
INSERT INTO `subject` VALUES (2, 'Chủ đề 2', 1, '2020-11-05 15:57:27', '2020-11-07 15:57:29', 2);
INSERT INTO `subject` VALUES (3, 'Chủ đề 3', 2, '2020-11-12 15:57:41', '2020-11-14 15:57:44', 3);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Nguyễn Văn A', 'nguyen1@', NULL, '', NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'Trần Thị B', 'tran2@g', NULL, '', NULL, NULL, NULL);
INSERT INTO `users` VALUES (100, 'Me', 'me@g', NULL, '', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
