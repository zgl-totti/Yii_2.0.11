/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50710
 Source Host           : 127.0.0.1:3306
 Source Schema         : yii2.0_new

 Target Server Type    : MySQL
 Target Server Version : 50710
 File Encoding         : 65001

 Date: 08/05/2018 09:23:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for shop_activity
-- ----------------------------
DROP TABLE IF EXISTS `shop_activity`;
CREATE TABLE `shop_activity`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gid` int(10) UNSIGNED NOT NULL,
  `starttime` int(10) UNSIGNED NULL DEFAULT 0,
  `endtime` int(10) UNSIGNED NULL DEFAULT 0,
  `votecount` int(10) NOT NULL DEFAULT 0 COMMENT '投票数量',
  `addvote` tinyint(1) NOT NULL DEFAULT 0 COMMENT '加入投票1代表投票，0代表不加入投票',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_activity
-- ----------------------------
INSERT INTO `shop_activity` VALUES (7, 56, 1499680266, 1501408266, 70, 1);
INSERT INTO `shop_activity` VALUES (13, 26, 1478782811, 1483175855, 17, 1);
INSERT INTO `shop_activity` VALUES (24, 2, 0, 0, 0, 0);
INSERT INTO `shop_activity` VALUES (25, 3, 1480583352, 1480665970, 1, 1);
INSERT INTO `shop_activity` VALUES (26, 4, 1480583328, 1483002531, 0, 0);
INSERT INTO `shop_activity` VALUES (28, 52, 1480583344, 1482397748, 0, 0);
INSERT INTO `shop_activity` VALUES (29, 54, 1480583311, 1483002515, 0, 0);

-- ----------------------------
-- Table structure for shop_address
-- ----------------------------
DROP TABLE IF EXISTS `shop_address`;
CREATE TABLE `shop_address`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '地址表ID',
  `mid` int(10) NOT NULL COMMENT '会员ID（用于关联会员表）',
  `address` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货地址',
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '联系人电话号码',
  `name` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人姓名',
  `postcode` int(10) NULL DEFAULT NULL,
  `isdefault` tinyint(2) NOT NULL DEFAULT 1 COMMENT '是否设置为默认地址（1代表是默认地址，0代表不是，默认为1）',
  `addtime` int(10) NOT NULL COMMENT '地址修改时间（最新收货地址）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_address
-- ----------------------------
INSERT INTO `shop_address` VALUES (1, 1, '河南省信阳市商丘县', '13033976013', '夏冉', NULL, 1, 0);
INSERT INTO `shop_address` VALUES (2, 2, '河南省信阳市商丘县aa', '15939762243', '夏冉', NULL, 0, 0);
INSERT INTO `shop_address` VALUES (3, 3, '浙江省', '13596325698', '李立新', NULL, 0, 0);
INSERT INTO `shop_address` VALUES (9, 1, '河南省信阳市息县', '13033976013', '栗飞', 464323, 0, 0);
INSERT INTO `shop_address` VALUES (10, 1, '河南省郑州市中原区', '13033976013', 'aa', 464323, 0, 0);
INSERT INTO `shop_address` VALUES (11, 1, '河南省信阳市息县', '13033976013', '夏冉3', 211212, 0, 0);
INSERT INTO `shop_address` VALUES (12, 1, '山东省聊城市阳谷县', '15939762243', '夏冉4', 555566, 0, 0);
INSERT INTO `shop_address` VALUES (13, 1, '河南省信阳市息县', '13033976013', '栗飞', 464323, 0, 0);
INSERT INTO `shop_address` VALUES (14, 1, '山东省淄博市市、县级市、县', '13033976013', '4s', 464323, 0, 0);
INSERT INTO `shop_address` VALUES (15, 1, '河南省三门峡市湖滨区', '13033976013', 'aa', 222222, 0, 0);
INSERT INTO `shop_address` VALUES (16, 1, '吉林省长春市朝阳区', '13033976013', '11', 321222, 0, 0);
INSERT INTO `shop_address` VALUES (17, 1, '吉林省地级市市、县级市、县', '13033976013', '11', 211222, 0, 0);
INSERT INTO `shop_address` VALUES (36, 5, '河南省-洛阳市-新安县-撒个', '13033976013', '姚发强', 464323, 1, 1478741947);
INSERT INTO `shop_address` VALUES (39, 19, '吉林省-吉林市-丰满区-长光小区', '13140645359', '杨晶', 126000, 1, 1478749764);
INSERT INTO `shop_address` VALUES (40, 19, '吉林省-吉林市-船营区-承青大院', '13140645359', '杨晶', 126000, 0, 1478749823);
INSERT INTO `shop_address` VALUES (41, 19, '吉林省-吉林市-龙潭区-抚顺街', '13140645359', '杨晶', 126000, 0, 1478749916);
INSERT INTO `shop_address` VALUES (42, 2, '辽宁省-锦州市-凌海市-', '15639470138', '李立新', 121000, 1, 1478836362);
INSERT INTO `shop_address` VALUES (43, 7, '黑龙江省-齐齐哈尔市-昂昂溪区-asdas', '15518170959', 'asda', 0, 1, 1478843119);
INSERT INTO `shop_address` VALUES (44, 14, '江苏省-徐州市-九里区-QWEQWER', '15555555553', 'qwe', 0, 1, 1478843301);
INSERT INTO `shop_address` VALUES (45, 29, '陕西省-延安市-延川县-去玩儿去玩儿', '13511111111', '13511111111', 0, 1, 1478843430);
INSERT INTO `shop_address` VALUES (46, 49, '陕西省-地级市-市、县级市、县-3421', '15333333333', '美丽可爱小杨晶', 1234, 1, 1479288888);
INSERT INTO `shop_address` VALUES (47, 12, '吉林省-吉林市-丰满区-长光小区', '13140645359', '杨晶', 126000, 0, 1479290028);
INSERT INTO `shop_address` VALUES (48, 4, '河南省-郑州市-中原区-冬青街长春路', '13033976013', '栗飞', NULL, 0, 1479435333);
INSERT INTO `shop_address` VALUES (52, 4, '河南省-郑州市-中原区-升龙又一城A区', '13033976013', '栗飞', NULL, 1, 1479435566);
INSERT INTO `shop_address` VALUES (53, 11, '陕西省-地级市-市、县级市、县-qweqwe', '15555555554', '小爱', 123123, 1, 1479460911);
INSERT INTO `shop_address` VALUES (54, 10, '陕西省-地级市-市、县级市、县-12312', '13333333333', 'qwe`1', 1231, 1, 1479461108);
INSERT INTO `shop_address` VALUES (55, 47, '陕西省-西安市-莲湖区-123123', '15518170959', '夏冉', 123123, 1, 1479884087);
INSERT INTO `shop_address` VALUES (56, 12, '山东省-淄博市-高青县-dsdasfff', '13071025537', 'matthew', 450000, 1, 1480060093);

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 1,
  `gender` tinyint(1) NULL DEFAULT 0 COMMENT '0,代表男，1代表女，2代表其他',
  `logintime` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `loginip` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1500866393, 1, 0, '1497511924', '127.0.0.1');
INSERT INTO `shop_admin` VALUES (2, 'xiaran', '9891062083f153a98a2a30651117113c', 1479198278, 1, 0, '1479198278', '172.16.17.184');
INSERT INTO `shop_admin` VALUES (3, 'yaofaqiang', '3460f80a7d2b0ffb204ba550a5e89d57', 1479198298, 1, 0, '1479198298', '172.16.17.184');
INSERT INTO `shop_admin` VALUES (4, 'yangjing', '64c01d87c5221b65f542162624c3008c', 1479198313, 1, 1, '1479198313', '172.16.17.184');
INSERT INTO `shop_admin` VALUES (5, 'lilixin', '0e88fa18eb8b349f4a690781c72babee', 1479198329, 1, 1, '1479198329', '172.16.17.184');
INSERT INTO `shop_admin` VALUES (6, 'tom', '34b7da764b21d298ef307d04d8152dc5', 1479198469, 1, 0, '1479198469', '172.16.17.184');
INSERT INTO `shop_admin` VALUES (7, 'totti', '21232f297a57a5a743894a0e4a801fc3', 1479198482, 1, 0, '1479198482', '172.16.17.184');

-- ----------------------------
-- Table structure for shop_admin_nav
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin_nav`;
CREATE TABLE `shop_admin_nav`  (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `navname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `navurl` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pid` tinyint(3) NULL DEFAULT NULL,
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `priority` smallint(5) NOT NULL,
  `edittime` int(10) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_admin_nav
-- ----------------------------
INSERT INTO `shop_admin_nav` VALUES (1, '系统管理', 'Admin/Nav/system', 0, '1', 100, 0);
INSERT INTO `shop_admin_nav` VALUES (2, '角色管理', 'Admin/Nav/role', 0, '2', 200, 0);
INSERT INTO `shop_admin_nav` VALUES (3, '权限管理', 'Admin/Nav/auth', 0, '3', 300, 0);
INSERT INTO `shop_admin_nav` VALUES (4, '广告管理', 'Admin/Nav/ads', 0, '4', 400, 0);
INSERT INTO `shop_admin_nav` VALUES (5, '商品管理', 'Admin/Nav/goods', 0, '5', 500, 0);
INSERT INTO `shop_admin_nav` VALUES (6, '品牌管理', 'Admin/Nav/brand', 0, '6', 600, 0);
INSERT INTO `shop_admin_nav` VALUES (7, '分类管理', 'Admin/Nav/category', 0, '7', 700, 0);
INSERT INTO `shop_admin_nav` VALUES (8, '促销管理', 'Admin/Nav/sale', 0, '8', 800, 0);
INSERT INTO `shop_admin_nav` VALUES (9, '会员管理', 'Admin/Nav/member', 0, '9', 900, 0);
INSERT INTO `shop_admin_nav` VALUES (10, '订单管理', 'Admin/Nav/order', 0, '10', 1000, 0);
INSERT INTO `shop_admin_nav` VALUES (11, '新闻管理', 'Admin/Nav/news', 0, '11', 1100, 0);
INSERT INTO `shop_admin_nav` VALUES (12, '拍卖专场', 'Admin/Nav/auction', 0, '12', 1200, 0);
INSERT INTO `shop_admin_nav` VALUES (13, '后台首页', 'Admin/Index/main', 1, '1,13', 101, 1479113162);
INSERT INTO `shop_admin_nav` VALUES (14, '投票系统', 'Admin/Vote/showlist', 1, '1,14', 102, 0);
INSERT INTO `shop_admin_nav` VALUES (15, '商城反馈', 'Admin/Feedback/showlist', 1, '1,15', 103, 0);
INSERT INTO `shop_admin_nav` VALUES (16, '管理员列表', 'Admin/Admin/showlist', 1, '1,16', 104, 0);
INSERT INTO `shop_admin_nav` VALUES (17, '添加管理员', 'Admin/Admin/addlist', 1, '1,17', 105, 0);
INSERT INTO `shop_admin_nav` VALUES (18, '菜单列表', 'Admin/AdminNav/showlist', 1, '1,18', 106, 0);
INSERT INTO `shop_admin_nav` VALUES (19, '添加菜单', 'Admin/AdminNav/addlist', 1, '1,19', 107, 0);
INSERT INTO `shop_admin_nav` VALUES (20, '角色列表', 'Admin/AuthGroup/showlist', 2, '2,20', 201, 0);
INSERT INTO `shop_admin_nav` VALUES (21, '添加角色', 'Admin/AuthGroup/addlist', 2, '2,21', 202, 0);
INSERT INTO `shop_admin_nav` VALUES (22, '权限列表', 'Admin/AuthRule/showlist', 3, '3,22', 301, 0);
INSERT INTO `shop_admin_nav` VALUES (23, '添加权限', 'Admin/AuthRule/addlist', 3, '3,23', 302, 0);
INSERT INTO `shop_admin_nav` VALUES (24, '广告列表', 'Admin/Ads/showlist', 4, '4,24', 401, 0);
INSERT INTO `shop_admin_nav` VALUES (25, '添加广告', 'Admin/Ads/addlist', 4, '4,25', 402, 0);
INSERT INTO `shop_admin_nav` VALUES (26, '商品列表', 'Admin/Goods/showlist', 5, '5,26', 501, 0);
INSERT INTO `shop_admin_nav` VALUES (27, '添加商品', 'Admin/Goods/addlist', 5, '5,27', 502, 0);
INSERT INTO `shop_admin_nav` VALUES (28, '用户评论', 'Admin/GoodsComment/comment', 5, '5,28', 503, 0);
INSERT INTO `shop_admin_nav` VALUES (29, '商品回收站', 'Admin/Goods/recycle', 5, '5,29', 504, 0);
INSERT INTO `shop_admin_nav` VALUES (30, '品牌列表', 'Admin/Brand/showlist', 6, '6,30', 601, 0);
INSERT INTO `shop_admin_nav` VALUES (31, '添加品牌', 'Admin/Brand/addlist', 6, '6,31', 602, 0);
INSERT INTO `shop_admin_nav` VALUES (32, '分类列表', 'Admin/Category/showlist', 7, '7,32', 701, 0);
INSERT INTO `shop_admin_nav` VALUES (33, '添加分类', 'Admin/Category/addlist', 7, '7,33', 702, 0);
INSERT INTO `shop_admin_nav` VALUES (34, '限时抢购', 'Admin/Sale/qianggou', 8, '8,34', 801, 0);
INSERT INTO `shop_admin_nav` VALUES (35, '节日狂欢', 'Admin/Sale/showlist/activity/2', 8, '8,35', 802, 0);
INSERT INTO `shop_admin_nav` VALUES (36, '十年店庆', 'Admin/Sale/showlist/activity/3', 8, '8,36', 803, 0);
INSERT INTO `shop_admin_nav` VALUES (37, '会员列表', 'Admin/Member/showlist', 9, '9,37', 901, 0);
INSERT INTO `shop_admin_nav` VALUES (38, '会员等级', 'Admin/Member/level', 9, '9,38', 902, 0);
INSERT INTO `shop_admin_nav` VALUES (39, '所有订单', 'Admin/Order/showlist', 10, '10,39', 1001, 0);
INSERT INTO `shop_admin_nav` VALUES (40, '未付款订单', 'Admin/Order/showlist/status/1', 10, '10,40', 1002, 0);
INSERT INTO `shop_admin_nav` VALUES (41, '已付款订单', 'Admin/Order/showlist/status/2', 10, '10,41', 1003, 0);
INSERT INTO `shop_admin_nav` VALUES (42, '已发货订单', 'Admin/Order/showlist/status/3', 10, '10,42', 1004, 0);
INSERT INTO `shop_admin_nav` VALUES (43, '未评价订单', 'Admin/Order/showlist/status/4', 10, '10,43', 1005, 0);
INSERT INTO `shop_admin_nav` VALUES (44, '已完成订单', 'Admin/Order/showlist/status/5', 10, '10,44', 1006, 0);
INSERT INTO `shop_admin_nav` VALUES (45, '新闻列表', 'Admin/News/showlist', 11, '11,45', 1101, 0);
INSERT INTO `shop_admin_nav` VALUES (46, '新闻发布', 'Admin/News/addlist', 11, '11,46', 1102, 0);
INSERT INTO `shop_admin_nav` VALUES (47, '评论列表', 'Admin/NewsComment/comment', 11, '11,47', 1103, 0);
INSERT INTO `shop_admin_nav` VALUES (48, '拍卖列表', 'Admin/Auction/showlist', 12, '12,48', 1201, 0);
INSERT INTO `shop_admin_nav` VALUES (49, '竞价记录', 'Admin/Auction/recordList', 12, '12,49', 1202, 0);
INSERT INTO `shop_admin_nav` VALUES (50, '成交记录', 'Admin/Auction/submitList', 12, '12,50', 1203, 0);
INSERT INTO `shop_admin_nav` VALUES (51, '文章管理', 'Admin/Nav/article', 0, '51', 1300, 0);
INSERT INTO `shop_admin_nav` VALUES (52, '文章列表', 'Admin/Article/showlist', 51, '51,52', 1301, 0);
INSERT INTO `shop_admin_nav` VALUES (53, '添加文章', 'Admin/Article/addlist', 51, '51,53', 1302, 0);
INSERT INTO `shop_admin_nav` VALUES (54, '积分商城', 'Admin/Nav/integral', 0, '54', 1400, 1480294499);
INSERT INTO `shop_admin_nav` VALUES (55, '商品列表', 'Admin/Integral/showlist', 54, '54,55', 1401, 0);
INSERT INTO `shop_admin_nav` VALUES (56, '添加商品', 'Admin/Integral/addlist', 54, '54,56', 1402, 1480299764);

-- ----------------------------
-- Table structure for shop_ads
-- ----------------------------
DROP TABLE IF EXISTS `shop_ads`;
CREATE TABLE `shop_ads`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adname` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `adlogo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `adposition` tinyint(1) UNSIGNED NOT NULL DEFAULT 4 COMMENT '0首页 1一楼 2二楼 3三楼 4其他',
  `top` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_ads
-- ----------------------------
INSERT INTO `shop_ads` VALUES (9, 'ads1', '581694c066d5a.jpg', 1, 0);
INSERT INTO `shop_ads` VALUES (10, 'ads2', '581694db0eae7.jpg', 1, 0);
INSERT INTO `shop_ads` VALUES (11, 'ads3', '5816953133cdb.jpg', 2, 0);
INSERT INTO `shop_ads` VALUES (13, 'ads', '5816957d67699.jpg', 2, 0);
INSERT INTO `shop_ads` VALUES (14, 'ad11', '5816961be2dfd.jpg', 5, 0);
INSERT INTO `shop_ads` VALUES (16, 'ad01', '5816983882aa4.png', 3, 0);
INSERT INTO `shop_ads` VALUES (17, 'ad02', '58169849ef4ea.png', 3, 0);
INSERT INTO `shop_ads` VALUES (18, 'ad044', '5816a36992230.png', 4, 0);
INSERT INTO `shop_ads` VALUES (19, 'a1', '5816a83b76f53.png', 3, 1477880201);
INSERT INTO `shop_ads` VALUES (20, 'a2', '5816a85ea89db.png', 1, 1496282207);
INSERT INTO `shop_ads` VALUES (21, 'a3', '5816a87020943.png', 2, 1477879920);
INSERT INTO `shop_ads` VALUES (22, 'a4', '5816a88cd34e4.png', 4, 1477880110);
INSERT INTO `shop_ads` VALUES (23, 'a5', '5816a89aacd24.png', 3, 1477879962);
INSERT INTO `shop_ads` VALUES (24, 'a6', '5816a8b1d8315.png', 1, 1477880074);
INSERT INTO `shop_ads` VALUES (25, 'a7', '5816a8be20800.png', 4, 1477879998);
INSERT INTO `shop_ads` VALUES (26, 'a8', '5816a8dd9f1ea.png', 2, 1477880090);
INSERT INTO `shop_ads` VALUES (36, '轮播', '5816bb0ebd82d.png', 0, 1497927821);
INSERT INTO `shop_ads` VALUES (47, 'd2', '5823e8b9676e4.png', 6, 1478748345);
INSERT INTO `shop_ads` VALUES (48, 'd1', '5823e9704f00f.png', 6, 1478748528);
INSERT INTO `shop_ads` VALUES (50, 'cx2', '58245b82692df.jpg', 5, 0);
INSERT INTO `shop_ads` VALUES (51, 'cx3', '58245b8f1138a.jpg', 5, 1478777743);
INSERT INTO `shop_ads` VALUES (52, 'cx4', '58245b9cd99c1.jpg', 5, 0);
INSERT INTO `shop_ads` VALUES (53, 'cx5', '58245babd3b71.jpg', 5, 1478777771);
INSERT INTO `shop_ads` VALUES (54, 'cx6', '58245bbadeaae.jpg', 5, 1478777786);
INSERT INTO `shop_ads` VALUES (55, '轮播3', '58245c8095447.jpg', 0, 1480580365);
INSERT INTO `shop_ads` VALUES (56, '轮播2', '58245c8e8f1d6.jpg', 0, 1497927805);
INSERT INTO `shop_ads` VALUES (57, '轮播1', '58245ca579b4c.jpg', 0, 1480667882);
INSERT INTO `shop_ads` VALUES (58, 'adsd', '5829283c391d4.jpg', 5, 0);
INSERT INTO `shop_ads` VALUES (59, '', '5837d7a0913a5.png', 2, 0);

-- ----------------------------
-- Table structure for shop_article
-- ----------------------------
DROP TABLE IF EXISTS `shop_article`;
CREATE TABLE `shop_article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章标题',
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章作者',
  `cate` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章类别',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章内容',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_article
-- ----------------------------
INSERT INTO `shop_article` VALUES (6, '新手上路', '姚发强', '售后流程', '一、退货流程\r\n为了我们更愉快的合作，请在申请退货之前确认是否符合以下退货条件：\r\n     1.    收到货物后7日内出现质量问题；\r\n    2.    产品包装完整；\r\n    3.    包装清单上的物品齐全，无破损；\r\n    4.    产品无人为损坏，如摔裂、划痕等，以及不属于本政策后附的免责条款的；\r\n    5.    您要求退货的商品是否从征途商城（shop.zhengtugps.com）购买的。\r\n经确认符合以上5个条件后,方可通过联系我们的客服办理退货手续！\r\n申明：请您将全部产品、各类配件、含发票（如有）等，发快递至客服指定的退货地址，并将退货的快递单号一同告知在线客服即可。\r\n        \r\n\r\n二、换机程序\r\n   1:  用户将符合保换条件的不良机器的机身编码、购机凭证（或征途商城订单号）告知在线客服，并申报机器故障部分与故障现象。\r\n    2：换货快递至客服指定的退货地址，并将退货的快递单号一同告知在线客服即可。\r\n    3：经本公司检查确认实属不良机器，给予换货寄回！\r\n \r\n三、维修程序\r\n1.    向在线客服提出维修申请，请将原机器寄回客服指定维修地址，等待公司维修。\r\n2.    在保修期内的产品，不收取任何维修费用。\r\n3.    过保修期的产品，需按照公司维修价目表收取一定的维修费用和上门拆装费用。\r\n \r\n\r\n四、换机与维修的注意事项\r\n1.    您要求换货或维修的产品必须确认是从征途商城平台（shop.zhengtugps.com）购买的。\r\n2.    主机坏换主机，配件坏换配件，包装附件不更换。\r\n3.    对于外观有损伤的机器，不予更换，但予以保修。\r\n4.    已停产无机更换的，更换同档次新机。\r\n5.    随机赠送的配件、促销品等不在保修、包换范围内。\r\n6.    如果您购买的产品需要维修或检测，请及时备份机器内的数据。征途商城不对因数据丢失所造成的损失负责。\r\n7.    购买产品的保修卡、登记的机身编码、征途商城购物记录等是您获得服务的重要凭证，请您妥善保管，在每次接受服务时务必提供！\r\n8.    如您不能提供上述信息，或所记载的信息与故障产品不符合，或被涂改、模糊不清、无法辨认，则该故障产品将无法由征途商城平台提供售后服务，需联系产品品牌厂商负责售后处理。\r\n ', 1478940255, 1);
INSERT INTO `shop_article` VALUES (7, '新手上路', '姚发强', '购物流程', '在网上购物或者进行话费充值，都有个基本的购买流程，熟悉这个购物的过程对于\r\n防骗是非常有好处的。下面以淘宝网为例，介绍下网络购物或者充值话费的基本流程\r\n。\r\n 如您已是鲜盟网会员，登录鲜盟网后，您可以通过以下任一途径进行购买（只是在拍\r\n下宝贝的操作上有所不同，流程还是一样的哦）。\r\n点击“立刻购买”直接购买：如您看中了卖家店铺中的其中一件宝贝，想购买，操作\r\n步骤如下：1.购买前使用阿里旺旺联系店主，商品信息，价格等方面信息，确定没有\r\n疑问后，点击“立刻购买”。2.第二步：确认收货地址、购买数量、运送方式等要素\r\n，点击“提交订单”。3.您可进入“我的淘宝”—“我的首页”—“已买到的宝贝”\r\n页面查找到对应的交易记录，交易状态显示“等待买家付款”，该状态下卖家可以修\r\n改交易价格，待交易付款金额确认无误后，点击“付款”。4.进入付款页面，选择合\r\n适你付款方式，付款成功后，交易状态显示为“买家已付款”，需要等待卖家发货。\r\n5.待卖家发货后，交易状态更改为“卖家已发货”，待收到货确认无误后，点击“确\r\n认收货”。6.输入支付宝账户支付密码，点击“确定”。交易状态显示为“交易成功\r\n”，说明交易已完成。交易完成买家可以给于卖家做出评价（好评，中评，差评）。\r\n如果你在同一家店铺购买，多件商品时，使用“购物车”，可以一起支付，并且还能\r\n够参加店铺的促销活动。交易的流程基本差不多。\r\n 交易流程基本是了解了。但有几个问题需要大家注意下！在淘宝是购物请使用&quot;旺旺\r\n&quot;作为联系工具，其他聊天工具不要用，不让骗子有可乘之机。交易请采用支付宝担\r\n保交易，即时到帐，转帐的交易不要尝试。在商品没有收到的情况下，不要轻易的确\r\n认收货，支付货款。在网上购物只要按照，流程操作，骗子想骗你也不那么容易的。', 1478940474, 1);
INSERT INTO `shop_article` VALUES (8, '新手上路', '姚发强', '隐私声明', '关于隐私\r\n【鲜盟货源网】以此声明对本站用户隐私保护的许诺。\r\n一、隐私政策\r\n【鲜盟货源网】非常重视对用户隐私权的保护，用户的邮件及手机号等个人资料为用户重要隐私，【鲜盟货源网】承诺不会将个人资料用作它途；承诺不会在未获得用户许可的情况下擅自将用户的个人资料信息出租或出售给任何第三方，但以下情况除外：用户同意让第三方共享资料；用户同意公开其个人资料，享受为其提供的产品和服务；本站需要听从法庭传票、法律命令或遵循法律程序；本站发现用户违反了本站服务条款或本站其它使用规定。\r\n二、使用说明\r\n【鲜盟货源网】用户可以通过设定的密码来保护帐户和资料安全。用户应当对其密码的保密负全部责任。请不要和他人分享此信息。如果您使用的是公共电脑，请在离开电脑时退出【鲜盟货源网】以保证您的信息不被后来的使用者获取。', 1478940672, 1);
INSERT INTO `shop_article` VALUES (9, '配送与支付', '栗飞', '保险需求测试', '导读：人的一生有少年儿童期，成人单身期，结婚生子期，中年规划期和老年期。在不同时期对保险的需求也不一样，如何用较少的钱来买到合理的保险产品？\r\n挑选一份保险在如今已被列入众多家庭规划之一，然而面对众多的保险公司和保险产品，如何在不同时期找到一份适合自己的保险产品呢？\r\n\r\n一、少年儿童期\r\n\r\n这个时段会经历幼婴、少儿、入学三个时期，不同时期有不同的保险产品。但这个时期的保险最好用消费卡单解决，一年仅需几百元，就能够有很全面的保障。\r\n\r\n二、成人单身期\r\n\r\n这个时期事业和生活刚刚起步，自身抵御经济风险能力较弱，应增强保险保障，构建单身人士必需的两份保单。责任保单：自身的意外险、定期寿险等。关爱保单：自身的重大疾病保险，住院津贴保险等。\r\n\r\n这个时段通常收入不高，支出又大，所以选购保险产品尽量用消费险。如果经济许可可以购入定期消费寿险。(定期寿险以主险+附险的形式出现会更省钱)。\r\n\r\n三、结婚生子期\r\n\r\n这个时期，既要承担家庭的正常开支，又往往会有房贷之类的负债出现。这个时候选保险，要从家庭责任确定保额，从月结余衡定保费支出。经济能力较差可选择消费型产品，经济能力许可则选择储蓄投资型产品。一定要遵从两个原则，年缴保费不能让家庭产生负担，保额要覆盖家庭所有保障缺口。\r\n\r\n四、中年规划期\r\n\r\n家庭成熟，事业上升，收入稳定是这个时期的特征。这个时候，需要拿出以前所有购买的保单，好好整理一遍。\r\n\r\n具体可分几步走：第一步，继续持有意外保险，根据职业的调整可适当降低或升高保额；第二步，考虑重大疾病险；第三步，追加或购入合理的养老年金保险很有必要。\r\n\r\n五、老年期\r\n\r\n保险适当减少，或不买保险。', 1478940854, 1);
INSERT INTO `shop_article` VALUES (10, '配送与支付', '栗飞', '专题及活动', '根据相关消息显示，现在我国快递业务量的40%来自电子商务，电子商务如今快速的发展，改变了很多消费者的消费习惯。\r\n\r\n　　网上购物带来便利\r\n\r\n　　今年30岁的王女士是省会某网站的一名编辑，也是某购物网站上的VIP会员。在生完孩子后，因为没有时间去逛街购物，所以她决定在网上购物。刚开始的王女士只是在网上买一些孩子的衣服、玩具等小物品。后来她发现在网上买东西，不仅比实体店方便快捷，而且价格也相对来说实惠，所以他大部分都在网上商店。如今她已是一名忠实的网购迷，几乎所有的东西都在网上购买，每周购物2至3次。“现在的年轻人大都已习惯了网上购物”，王女士说，她周围的同事们大都在购物网站上有自己的账户，想买什么东西，轻轻一点鼠标，过一两天，商品就被快递到家。“现在，年轻人生活节奏快，没有时间逛街。而电子商务这种方便快捷的消费模式，正适应了年轻人的要求。”\r\n\r\n　　如今，电子商务的发展让人们足不出户就能买到心仪的商品，节省了大量时间和精力。同时由于网络购物的商品相比实体商店便宜，也为消费者节省了开支。有关资料显示，近年来国内网络交易迅猛发展，2010年国内网络市场销售交易额超过了5000亿元，网络购物用户规模达1.48亿。\r\n\r\n　　网上购物难题不少\r\n\r\n　　在网络交易迅猛发展的同时，一些问题也随之而来。产品的质量、售后服务以及网络交易账号的安全等，都是备受网上消费者诟病的问题。\r\n\r\n　　几天前，王女士从网上购买了一款新手机壳，可用了不到一个星期，手机壳上就出现了几道划痕。经过与购物网站的客服人员几番交涉，那家网上商店终于答应退还一半货款，相当于将产品半价卖给了王女士。这样的事情，王女士曾经遇到过几次，幸运的是，每次都能顺利退货、退款。“但也影响了使用，特别是你急需的商品，拿过来后发现质量有问题，心情就会特别糟糕。”\r\n\r\n　　某快递公司的一位快递员小张告诉记者，近两年，因电子商务而发生的快递业务快速增长，但有二分之一左右的商品因质量问题而遭遇退货。他说，如果顾客打开包装一看，说是假的，或者说质量不好而拒付款，他就得将货物再送回给商家。\r\n\r\n　　网络交易账户信息安全也是网上购物的一大障碍。不久前，省会某网站编辑杨先生在网上购物时，发现不能进入自己的支付宝账户，与相关单位打电话了解情况时却被告知，这期间他的账户因扰乱网上经营秩序而被冻结。而这之前，杨先生有近一个月的时间没有使用过支付宝，他认为是自己的账户被别人盗用了，虽然向有关方面提供了相关证件，可到目前账户依旧未被开通。“这样，原来购物时信用度比较高的商家都很难找到，而自己的信用度也受损失，这给购物带来很大不便。”杨先生说。\r\n\r\n　　据了解，目前影响网上购物的因素主要有三个：一是网上售卖假冒伪劣产品，一些不法经营者利用网上销售的价格优势，将假冒伪劣商品销售给消费者。二是网购产品售后服务成为瓶颈，在实体商场购买的产品一般都有保质期，而网购产品售后服务问题严重。三是网络交易账号安全问题频频出现，一些消费者的个人信息外泄导致账号被盗取，给个人带来麻烦和经济损失。', 1478941061, 1);
INSERT INTO `shop_article` VALUES (11, '配送与支付', '栗飞', '挑选保险产品', '保险产品是保险公司为市场提供的有形产品和无形服务的综合体。保险产品在狭义上是指由保险公司创造、可供客户选择在保险市场进行交易的金融工具；在广义上是指保险公司向市场提供并可由客户取得、利用或消费的一切产品和服务，都属于保险产品服务的范畴。进一步讲，保险产品是由保险人提供给保险市场的，能够引起人们注意、购买，从而满足人们减少风险和转移风险，必要时能得到一定的经济补偿需要的承诺性组合。从营销学的角度讲，保险产品包括保险合同和相关服务的全过程。保险也是一种商品，既然是商品，它也就像一般商品那样，具有使用价值和价值。保险商品的使用价值体现在，它能够满足人们的某种需要。例如，人寿保险中的死亡保险能够满足人们支付死亡丧葬费用和遗属的生活需要；年金保险可以满足人们在生存时对教育、婚嫁、年老等所用资金的需要；财产保险可以满足人们在遭受财产损失后恢复原状、或减少损失程度等的需要。同时，保险产品也具有价值，保险人的劳动凝结在保险合同中，保险条款的规定，包括基本保障责任的设定、价格的计算、除外责任的规定、保险金的给付方式等都是保险人智力劳动的结晶。\r\n\r\n但是，与一般的实物商品和其他大众化金融产品相比，保险商品又具有自己的特点。\r\n\r\n(一)与一般实物商品相比较\r\n\r\n1．保险产品是一种无形商品\r\n\r\n实物商品是有形商品，看得见，摸得着，其形状、大小、颜色、功能、作用一目了然，买者很容易根据自己的偏好，在与其他商品进行比较的基础上，做出买还是不买的决定。而保险产品则是一种无形商品，保户只能根据很抽象的保险合同条文来理解其产品的功能和作用。由于保险商品的这一特点，它一方面要求保单的设计在语言上简洁、明确、清晰、易懂；另一方面要求市场营销员具有良好的保险知识和推销技巧。否则，投保人是很难接受保险产品的。[1]\r\n\r\n2．保险产品的交易具有承诺性\r\n\r\n实物商品在大多数情况下是即时交易。例如，消费者到商店去购买电视机，当他做出购买的决定以后，这个消费者一手交钱，商店一手交货，这笔交易就完成了，也可以说，就这个商品的交易来看，该消费者与商家的关系也就终结了。而保险产品的交易则是一种承诺交易。当投保人决定购买某一险种，并缴纳了保费之后，商品的交易并没有完成，因为保险人只是向投保人做出一项承诺，该承诺的实质内容是：如果被保险人在保险期间发生了合同中所规定的保险事故，保险人将依照承诺做出保险赔偿或给付。可见，在保险产品交易的场合，投保人缴付了保费以后，该投保人与保险公司的关系不仅没有结束，反而是刚刚开始。由于保险产品承诺性交易的这一特点，对于保险人和投保人(被保险人)来说，相互选择就是非常重要的。从保险人的角度来说，它需要认真选择被保险人，否则将遭受“逆选择”之苦；从投保人的角度来说，他需要认真选择保险公司和保险产品，否则，不论是保持合同关系还是退保，都将给自己带来不必要的损失。\r\n\r\n3．保险产品的交易具有一种机会性\r\n\r\n实物商品的交易是一种数量确定性的交换。例如，只要买者交了钱，不论是一手交钱、一手交货的现货交易，还是赊销、预付形式的交易，买卖双方都能明确地得到货币或者商品。而保险合同则具有机会性的特点。保险合同履行的结果是建立在保险事故可能发生、也可能不发生的基础之上的。在合同有效期间内，如果发生了保险事故，则保险购买者从保险人那里得到赔偿、给付，其数额可能大大超过其所缴纳的保险费；反之，如果保险事故没有发生，则保险产品的购买者可能只是支付了保费而没有得到任何形式的货币补偿或给付。', 1478941149, 1);
INSERT INTO `shop_article` VALUES (12, '配送与支付', '栗飞', '常见问题', '网上购物常见问题：\r\n网上购物作为一种崭新的消费模式，被越来越多的人接受，且随着人们对互联网的依赖，人们通过网络，各取所需，这种方式也改变着人们的消费和生活方式。正是由于网购的便捷省时性、商品的丰富性，也给消费者带来了两个显著性的问题：网购盲目性和网购无节制性。这里，小编发现了一个网购热站，就爱买，兴许能帮助各位解决这两大问题。 \r\n\r\n（一）网购盲目性 \r\n1.商品种类多 \r\n网络由于不受时空的限制，也造就了其商品的海量性。当你在面对琳琅满目的商品时，你是否有时会有那么一瞬间的发怔，不知道该如何下手。 \r\n2.商品质量问题 \r\n由于商品的海量性，导致了一些商家企图鱼目混珠，以次充好，甚至用一些低于正常价的所谓“超低价”来吸引消费者，误导消费者，给消费者造成一定的损失。 \r\n\r\n　　虽然说这种情形是很经常出现的，但是消费者依旧是频频中招。原因除了数量实在太多外，还由于商家的手段确实高，他可以变换着法子，让消费者应接不暇。不过就爱买网（www.9imai.com）的“淘宝好店”却是能在一定程度上缓解这样的问题。怎么说呢？因为就爱买返利网的“淘宝好店”都是根据一定的数据统计，综合信誉、评价、销量等各方面为大家推荐的商铺。另外，精品折扣、特价包邮也是从海量的商品中筛选，列出的性价比高的商品类别，对消费者的购物过程也起到了事半功倍的作用。 \r\n\r\n（二）网购上瘾（无节制上网） \r\n　　网上购物的好处真的很多，如节省时间、选择性多、价格优惠等，也正是由于这些好处，使得越来越多的人涌入网络这个平台，甚至沉迷于其中，无节制的上网购物也给这些人群造成一定的经济负担。这里，就爱买返利网高额度的返利，对这些“剁手族”的经济压力能有一定的缓解作用。几乎所有的淘宝天猫商铺都可以返利，另外当当网、京东商城、聚美优品等知名的商城也均可拿返利。返利省下来的钱，又可购置新的商品，能满足一时的购物欲。不过，这里要提醒大家的是，上网购物还是要把握这个“度”的问题，省钱工具的目的不是让你买更多，而是帮助你尽量少花些钱，注入“节省”的理财观念。', 1478941220, 1);
INSERT INTO `shop_article` VALUES (13, '售后保障', '杨晶', '售后政策', '服务名称\r\n\r\n具体描述\r\n\r\n7天无理由退货\r\n\r\n客户购买京东自营商品7日内（含7日，自客户收到商品之日起计算），在保证商品完好的前提下，可无理由退货。（部分商品除外，详情请见各商品细则）\r\n\r\n售后上门取件\r\n\r\n客户购买京东自营商品15日内（含15日，自客户收到商品之日起计算）因质量问题提交退换申请且审核通过，在京东自营配送范围内，京东提供免费上门取件服务。非质量问题的上门取件需要收费（钻石及企业用户例外），收费标准及收费方式：//help.jd.com/user/issue/126-300.html。法定节假日、停电、天气等不可抗力情况除外。\r\n\r\n售后100分\r\n\r\n客户购买京东自营商品15日内（自客户收到商品之日起计算）如出现故障，京东售后服务部收到故障品并确认属于质量故障（以国家三包法等有关法律、法规为准）开始计时。在100分钟内（工作时间每周一至周五，上午9:00至12:00，下午13:00至18:00，法定节假日、停电等无法正常处理情况除外）处理完客户的售后问题，处理完的标志为已经为客户提交了换新订单、补发订单、补偿申请或者退款申请（通过邮政等退款要依赖于第三方退款平台服务速度）。注：如客户不同意以上解决方案，协商时间另计。如以上承诺京东未做到，除故障商品全额退款外再给予客户京东账户1000个京豆作为补偿。\r\n\r\n售后到家\r\n\r\n如商品出现质量问题，京东将提供上门取送及原厂授权维修服务。\r\n  温馨提示：\r\n  售后到家服务仅针对部分指定商品，具体以客户下单时订单详情为准；\r\n  此服务仅限京东自营商品（京东销售和配送）；\r\n  法定节假日、停电、天气等不可抗力情况除外。\r\n\r\n极售后服务\r\n\r\n购买京东自营商品自签收之日起15日内提交退换货申请,自申请提交成功之时起,京东会在48小时内完成客户售后问题的处理。\r\n  温馨提示：此服务仅针对部分区域指定商品，具体以提交退换货服务单申请成功时的页面标识为准。‍\r\n\r\n上门换新\r\n\r\n是为魔镜等级S2及以上的京东优质客户提供的售后特色服务，符合条件的换货申请审核通过后由京东快递在上门取件的同时为客户更换新品。为客户节省了返回商品、商品检测、发货等多个环节的等待时间。\r\n\r\n适用范围：自客户签收之日起 15天内且在京东快递配送范围内的自营商品（个别特殊类目和虚拟类目除外）。\r\n\r\n闪电退款\r\n\r\n是为魔镜等级S3及以上的京东优质客户提供的售后特色服务，符合条件的退货申请审核通过后即进入退款流程，先退款后退货。为客户节省了返回商品的物流等待时间和收货检测的处理时间（个别特殊类目和虚拟类目除外）。', 1478941282, 1);
INSERT INTO `shop_article` VALUES (14, '售后保障', '杨晶', '价格保护', '什么是价格保护？\r\n以下价保规则适用京东自营商品\r\n\r\n价格保护是指：为了更好的提升您的购物体验，即如您在京东商城购物后，如商品出现降价情况，在价保规则范围内，将赠送您与差额部分等值的款项、或京券、京豆。注：差额以客户实际支付金额计算。\r\n\r\n\r\n一、家用电器价保规则\r\n您可在订单商品妥投之前及妥投30天内申请价保，申请成功，如未付款的可按照提交申请时商城售价支付，如已付款订单，将赠送您与差额部分等值的款项、或京券、京豆。\r\n\r\n\r\n订单类型	什么时候申请？	怎么申请？	怎么返还，什么时候？\r\n京东自营家用电器	订单商品妥投之前及妥投30天内可申请价保	1.网页申请：我的京东-&gt;价格保护\r\n2.电话申请：致电京东客服热线400-656-1000\r\n申请成功后，如未付款的按申请售价支付\r\n申请成功，如已付款订单，将赠送您与差额部分等值的款项、或京券、京豆。\r\n\r\n二、IT数码、通讯、日用百货类商品\r\n您可在订单商品妥投之前及妥投7天内申请价保。申请成功，如未付款的订单，您可按照提交申请时京东售价支付，如已付款的订单，将赠送您与差额部分等值的款项、或京券、京豆。\r\n\r\n\r\n订单类型	什么时候申请？	怎么申请？	怎么返还，什么时候？\r\nIT数码、通讯、日用百货类商品	订单商品妥投之前及妥投7天内可申请价保	1.网页申请：我的京东-&gt;价格保护\r\n2.电话申请：致电京东客服热线	申请成功，如未付款的按申请售价支付\r\n申请成功，如已付款订单，将赠送您与差额部分等值的款项、或京券、京豆。\r\n\r\n\r\n三、图书商品\r\n\r\n您可在订单商品妥投之前申请价保。申请成功，如未付款的订单，您可按照提交申请时京东售价支付，如已付款的订单，将赠送您与差额部分等值的款项、或京券、京豆。\r\n订单类型	什么时候申请？	怎么申请？	怎么返还，什么时候？\r\n图书商品	订单商品妥投之前可申请价保	1.网页申请：我的京东-&gt;价格保护\r\n2.电话申请：致电京东客服热线\r\n申请成功后，如未付款的按申请售价支付\r\n申请成功，如已付款订单，将赠送您与差额部分等值的款项、或京券、京豆\r\n\r\n\r\n四、不享受价保说明\r\n1、非京东商城网站购买的商品不支持价保，如易迅、手Q订单不适用京东商城价保规则；\r\n\r\n2、无效订单不支持价保，如已申请取消或已删除的订单、已经申请售后的订单不支持价保；\r\n\r\n3、售后返新订单、闪购订单、商采订单不支持价保；\r\n\r\n4、分期付款（不包括白条分期）、先款订单订单未支付、使用限品类东券的订单、使用手机红包支付的订单不支持价保；\r\n\r\n5、除家电、IT数码、通讯、日用百货、图书、pop自营商品之外的其他商品不支持价保，如团购/机票/彩票/充值/点卡/合约计划/海外订购/第三方商品等；\r\n\r\n6、无货、参与秒杀、限购的商品不支持价保；\r\n\r\n7、套装与商品本身为赠品的商品不支持价保；\r\n\r\n8、超过价保周期或商品价格未发生变化的不支持价保；\r\n\r\n9、订单”等待打印“状态之前、订单锁定状态系统不支持价保；\r\n\r\n10、其他网页有特殊说明的商品不支持价保；', 1478941340, 1);
INSERT INTO `shop_article` VALUES (15, '售后保障', '杨晶', '退款说明', '温馨提示：退款周期仅供您参考，具体退款周期可能会受银行、支付机构等相关因素影响。\r\n\r\n1.京东在线支付及POS机刷卡支付订单退款，如涉及到银行信息京东会依据银行及相关机构已经建立的条例处理退款，为了保证客户账户金额的安全，我们均会安排原卡原退。\r\n\r\n2.公司转账或支票支付的订单，需与客服人员确认公司相关信息后进行公司转账，目前京东只支持原路退回至客户原支付的公司账户中，给您带来的不便请您谅解。\r\n\r\n3.京东卡/京东E卡支付退款无法直接兑换成现金，会在1个工作日左右返还至您支付的京东卡/京东E卡内。\r\n\r\n4.退款金额在1000元及以下可选择退京东余额，退款时效即时到账。\r\n', 1478941390, 1);
INSERT INTO `shop_article` VALUES (16, '售后保障', '杨晶', '取消订单', '如何取消订单\r\n\r\n\r\n\r\n若您想取消未收货的订单，请使用 &quot;自助取消订单&quot;服务（查看更多自助服务）\r\n\r\n具体操作步骤如下：\r\n\r\n进入&quot;我的订单&quot;页面，找到要取消的订单，点击“取消订单”按钮；\r\n\r\n选择订单取消原因后，提交申请；\r\n\r\n&quot;取消订单&quot;申请成功后，您可在“我的订单”页面查看取消进度。\r\n\r\n\r\n\r\n订单快速退款\r\n\r\n在线支付的订单（包含使用优惠劵、账户余额、京东卡/京东E卡等货到付款的订单）取消成功后，我们会为您提供“订单快速退款”服务，京东退款处理时效如下：\r\n订单快速退款\r\n\r\n京东自营商品订单：\r\n\r\n商品出库前：若您在商品未出库前提交取消申请，会在30分钟后完成退款审核。\r\n\r\n商品送往配送站前：若您在商品已经出库，等待装车送往配送站前提交取消申请，会在24小时内完成退款审核。\r\n\r\n商品送往配送站的途中：若您在订单商品已经装车送往配送站的途中提交取消申请，会在商品到达配送站的当天24小时内完成退款审核。\r\n\r\n拒收订单：订单拒收后，系统会自动帮您提交取消申请，在当天24小时内完成退款审核。\r\n\r\n*注：不排除异常订单延迟退款的情况，请您直接联系客服处理\r\n\r\n\r\n第三方卖家商品订单：\r\n\r\n第三方卖家订单根据卖家自身情况进行取消申请和退款受理。\r\n\r\n\r\n取消订单注意事项\r\n\r\n订单提交成功后，您可取消京东自营商品订单及部分第三方卖家出售的商品订单。注：订单取消申请一旦提交成功，将无法进行任何修改或恢复，请您谨慎操作。\r\n\r\n1.提交订单取消申请后，系统会确认包裹位置，拦截成功之后会为您办理退款。若订单取消失败，订单会继续为您配送，您可根据需要签收或拒收。\r\n\r\n2.订单若包含赠品、加价购、满减、东券、套装等促销活动商品，若主商品订单取消，关联促销商品也将取消。\r\n\r\n3.已确认收货的订单，请申请返修/退换货。\r\n\r\n4.如果一个ID帐号在一个月内有过1次以上或一年内有过3次以上（不含本数），因非因京东原因导致拒收京东配送的商品，京东将从相应的ID帐户里按每单扣除500个京豆做为运费补偿\r\n\r\n即一个用户一个月内，如果拒收次数超过一次，第一次拒收的订单不扣除京豆，第二次及以上拒收的订单，每单扣除500京豆；一个用户一年内，如果拒收次数超过三次，前三次拒收的订单不扣除京豆，（其中若存在一个月内有过1次以上的情况，按照以上规定操作）第四次及以上拒收的订单，每单扣除500京豆\r\n\r\n时间计算方法为：成功提交订单后向前推算30天为一个月，成功提交订单后向前推算365天为一年，不以自然月和自然年计算。', 1478941457, 1);
INSERT INTO `shop_article` VALUES (17, '支付方式', '夏冉', '货到付款', '选择货到付款，在订单送达时您可选择现金、POS机刷卡、支票方式支付货款或通过京东APP手机客户端 【扫啊扫】功能扫描包裹单上的订单条形码方式用手机来完成订单的支付（扫码支付）。\r\n\r\nPOS机刷卡：目前仅支持带有银联标识的银行卡，信用卡POS机刷卡消费赠送积分以各银行为准，具体信息请致电发卡行。若您下单时在订单中填写POS机刷卡，支付时也可换成现金支付。\r\n\r\n 支票支付：需要您将支票内容填写完整且需要款到账后方可送货。目前仅北京、上海两地客户可使用此服务，其他地区暂不支持。\r\n\r\n注意：货到付款的订单，如果一个ID帐号在一个月内有过1次以上或一年内有过3次以上，因非因京东原因导致拒收京东配送的商品，京东将从相应的ID帐户里按每单扣除500个京豆做为运费补偿；即一个用户一个月内，如果拒收次数超过一次，第一次拒收的订单不扣除京豆，第二次及以上拒收的订单，每单扣除500京豆；一个用户一年内，如果拒收次数超过三次，前三次拒收的订单不扣除京豆，（其中若存在一个月内有过1次以上的情况，按照以上规定操作）第四次及以上拒收的订单，每单扣除500京豆。时间计算方法为：成功提交订单后向前推算30天为一个月，成功提交订单后向前推算365天为一年，不以自然月和自然年计算。', 1478941503, 1);
INSERT INTO `shop_article` VALUES (18, '支付方式', '夏冉', '在线支付', '问题知识列表\r\n\r\n· 在线支付支持哪些银行卡？\r\n· 在线支付分期付款会有手续费吗？\r\n· 如何到银行修改我开通的快捷支付银行卡的银行预留手机号？\r\n· 快捷支付支持的银行\r\n· 找不到支持的银行怎么办？\r\n· 为什么要开通快捷支付，开通有什么好处？\r\n· 怎样在京东开通快捷支付？\r\n· 怎样解除账户绑定的银行卡或快捷支付？\r\n· 怎样修改快捷支付银行相关信息以及手机号？\r\n· 什么是快捷支付？\r\n· 如何使用网银支付？\r\n· 网银支付支持的银行？\r\n· 在收银台可以用其他支付方式吗？\r\n· 支付平台支持哪些平台支付？\r\n· 如何使用邮局汇款？\r\n· 如何使用公司转账？\r\n· 如何使用企业网银？\r\n· 什么是组合支付？\r\n· 支持哪些支付方式组合？\r\n· 组合支付如果有部分金额支付失败怎么办？', 1478941551, 1);
INSERT INTO `shop_article` VALUES (19, '支付方式', '夏冉', '分期付款', ' 分期付款大多用在一些生产周期长、成本费用高的产品交易上。如成套设备、大型交通工具、重型机械设备等产品的出口。分期付款的做法是在进出口合同签订后，进口人先交付一小部分货款作为订金给出口人，其余大部分货款在产品部分或全部生产完毕装船付运后，或在货到安装、试车、投入以及质量保证期满时分期偿付。购买商品和劳务的一种付款方式。买卖双方在成交时签订契约，买方对所购买的商品和劳务在一定时期内分期向卖方交付货款。每次交付货款的日期和金额均事先在契约中写明。\r\n、 分期付款大多用在一些生产周期长、成本费用高的产品交易上。如成套设备、大型交通工具、重型机械设备等产品的出口。分期付款的做法是在进出口合同签订后，进口人先交付一小部分货款作为订金给出口人，其余大部分货款在产品部分或全部生产完毕装船付运后，或在货到安装、试车、投入以及质量保证期满时分期偿付。购买商品和劳务的一种付款方式。买卖双方在成交时签订契约，买方对所购买的商品和劳务在一定时期内分期向卖方交付货款。每次交付货款的日期和金额均事先在契约中写明。\r\n 分期付款大多用在一些生产周期长、成本费用高的产品交易上。如成套设备、大型交通工具、重型机械设备等产品的出口。分期付款的做法是在进出口合同签订后，进口人先交付一小部分货款作为订金给出口人，其余大部分货款在产品部分或全部生产完毕装船付运后，或在货到安装、试车、投入以及质量保证期满时分期偿付。购买商品和劳务的一种付款方式。买卖双方在成交时签订契约，买方对所购买的商品和劳务在一定时期内分期向卖方交付货款。每次交付货款的日期和金额均事先在契约中写明。', 1478941644, 1);
INSERT INTO `shop_article` VALUES (20, '支付方式', '夏冉', '异常情况', '为什么支付总是失败？\r\n（1） 您的银行卡尚未开通网上银行支付功能，建议您到当地营业厅开通网上银行；\r\n\r\n（2） 所用银行卡超出该银行支持地域范围，请您更换银行卡试试；\r\n\r\n（3） 银行卡已过期、作废、挂失或者余额不足等，建议您咨询您的开户行；\r\n\r\n（4） 输入的银行卡号、密码或证件号等与预置的不符，建议您重新输入正确的卡密码或证件号等，如果您忘记了密码，请您及时与所属银行联系办理密码重置；\r\n\r\n（5）  银行系统数据传输可能出现异常，建议您刷新页面或者稍后重启电脑；\r\n\r\n（6）  部分银行设置有支付金额限制，如限制支付金额不能操作1500，超过1500的订单则无法支付成功，您可以联系发卡银行详细了解。\r\n\r\n（7）快捷支付异常可能是您账户绑定的银行卡过期或者您换了新的银行卡没有重新绑定，还请您根据系统提示查看下具体原因再次操作付款。\r\n\r\n（8）如遇活动高峰期导致付款不成功，建议您重新打开页面进行支付。', 1478941701, 1);
INSERT INTO `shop_article` VALUES (21, '特色服务', '李立新', '次日送达', '天猫超市的送货时间\r\n\r\n天猫超市购物送货时间如下：\r\n（一）当日达：\r\n1、支持当日达配送城市（一）：\r\n上海市（除崇明岛外）；\r\n北京市（东城区、西城区、朝阳区、海淀区、丰台区、石景山区）;\r\n广州市（天河区、荔湾区、海珠区、越秀区）；\r\n武汉市（江岸区、江汉区、洪山区、硚口区、武昌区）；\r\n成都市（锦江区、青羊区、金牛区、武侯区、成华区）。\r\n备注：以上城市区域到货的消费者，应于当日上午11：00点前成功提交订单并完成支付，方可支持当日达到货物流配送。\r\n2、支持当日达配送城市（二）：\r\n苏州市（金阊区、沧浪区、平江区、姑苏区）；\r\n杭州市（上城区、下城区、拱墅区、江干区）\r\n备注：以上城市区域到货的消费者，应于当日上午10：00点前成功提交订单并完成支付，方可支持当日达到货物流配送。\r\n3、重要说明：\r\n（1）上述支持当日达到货物流配送的城市及/或区域，可能会根据实际业务的变化有所调整，天猫超市会相应不定期修订。\r\n（2）支持当日达物流配送的具体订单，可能会因法定节假日、重大促销活动（包括双十一，双十二，618大促，国庆大促等）、交通管制、自然灾害或其他不可抗拒因素等原因，实际到货时间可能会有所迟延，天猫超市将依据消费者诉求和天猫超市规则相应处理。\r\n \r\n（二）次日达：\r\n1、支持次日达配送城市（一）：\r\n上海市（宝山区、长宁区、川沙区、奉贤区、虹口区、黄浦区、嘉定区、金山区、静安区、卢湾区、南汇区、普陀区、浦东新区、青浦区、松江区、徐汇区、杨浦区、闸北区、闵行区）\r\n北京市（东城区、西城区、朝阳区、海淀区、丰台区、石景山区）\r\n备注：北京、上海以上区域到货的消费者，于当日上午11：00至24：00前成功提交订单并完成支付，即可支持次日达货物流配送。\r\n北京市（昌平区、大兴区、房山区、门头沟区、顺义区、通州区）\r\n备注：北京市以上区域到货的消费者，应于当日上午0：00至23：00前成功提交订单并完成支付，方可支持次日达货物流配送，23:00至24:00下单的，预计2日送达。北京远郊区县（怀柔区、平谷区、密云县、延庆县）预计2-3日送达，上海崇明岛预计3-4日送达。\r\n2、支持次日达配送城市（二）：\r\n杭州市（滨江区、拱墅区、江干区、上城区、西湖区、下城区、萧山区、余杭区）；\r\n宁波市（北仑区、慈溪市、海曙区、江北区、江东区、余姚市、镇海区、鄞州区）；\r\n金华市（金东区、婺城区）；嘉兴市（海宁市、嘉善县、南湖区、桐乡市、秀洲区）；\r\n台州市（高港区、海陵区）；\r\n绍兴市（柯桥区、越城区）；\r\n南京市（白下区、鼓楼区、建邺区、江宁区、浦口区、栖霞区、秦淮区、玄武区、雨花台区）；\r\n苏州市（常熟市、姑苏区、虎丘区、金阊区、昆山市、平江区、太仓市、吴江区、吴中区、相城区、新区、园区）；\r\n无锡市（北塘区、滨湖区、惠山区、江阴市、南长区、锡山区、新区、宜兴市）；\r\n常州市（戚墅堰区、新北区、钟楼区）；南通市（崇川区、港闸区）；\r\n镇江市（京口区、润州区）；\r\n扬州市（维扬区、邗江区）；\r\n泰州市（高港区、海陵区）；徐州市（鼓楼区）；\r\n广州市（白云区、从化区、东山区、番禺区、海珠区、花都区、黄埔区、荔湾区、萝岗区、南沙区、天河区、越秀区、增城区）；\r\n佛山市（南海区、顺德区、禅城区）；\r\n深圳市（宝安区、大鹏新区、福田区、光明新区、龙岗区、龙华新区、罗湖区、南山区、坪山新区、盐田区）；\r\n中山市、珠海市（斗门区、金唐区、南湾区、香洲区）；\r\n东莞市；\r\n成都市（成华区、崇州市、大邑县、都江堰市、金牛区、锦江区、龙泉驿区、青白江区、青羊区、双流县、温江区、武侯区、新都区、新津县、郫县）、德阳市（旌阳区）、乐山市（市中区）、绵阳市（涪城区、高新区、游仙区）；\r\n南充市（嘉陵区、顺庆区）、内江市（东兴区、隆昌县、市中区、威远县、资中县）；\r\n天津（宝坻区、北辰区、和平区、河北区、河东区、河西区、红桥区、津南区、南开区、武清区）；\r\n武汉（汉阳区、洪山区、江岸区、江汉区、青山区、武昌区、硚口区）\r\n备注：以上城市区域到货的消费者，应于当日21：00前成功提交订单并完成支付，方可支持次日达到货物流配送；', 1478941891, 1);
INSERT INTO `shop_article` VALUES (22, '特色服务', '李立新', '送货入户', '指消费者在天猫平台上购买大型家电等商品时，商家对于其天猫的店铺内带有“送货入户”标识的商品，如收货地址在商家承诺的销售区域内(例外区域除外)，则商家须向消费者提供送货到消费者购买时填写的详细收货地址，并搬楼、送货入户的特殊服务。\r\n用户须知：送货上楼服务标准\r\n建筑物本身及其所在环境允许商家在无需提供除搬运外的其他服务的情况下，即可将商品搬运至消费者指定送货地址，如入户大门、楼道、电梯等的宽度和高度可以搬运，楼道内无杂物等。\r\n收货地址在商家承诺提供送货入户服务的区域内。\r\n如消费者指定的送货地址不符合送货入户的条件（如收货地址在特定区域，如政府机关、司法机构、军事管理区、军校、海关管辖的特定区域等，而无法送货入户的情形），消费者可与配送服务商协商\r\n更改收货地址，更改后的地址超出商家承诺的销售区域或导致额外费用，由消费者和商家或配送服务商协商。\r\n因天气、交通管制等不可抗因素导致无法送货入户，消费者可与配送服务商预约再次配送时间。\r\n为保障消费者自身权益，请务必确认商家按约定方式提供送货入户服务后，再确认收货签字并将天猫发送的签收校验码提供给商家或配送员，，一旦签字将视为已经提供该服务，并作为商家提供服务的有效凭证。\r\n为保障消费者自身权益，额外支付的费用请向配送服务商索要收据或发票，作为费用支出的凭证。', 1478941946, 1);
INSERT INTO `shop_article` VALUES (23, '特色服务', '李立新', '无忧退换货', '无忧退换货介绍：指买家在天猫购买带有“无忧退换货”标识商品后，商家承诺所售商品符合退换货要求情况下，自售出之日（以实际收货日期为准）起7日内可以退货，15日内可以换货(大型促销活动如双十一，以实际活动规则为准)。\r\n无忧退换货成立条件：商品不影响二次销售（二次销售定义请点击查看：//rule.tmall.com/tdetail-1061.htm?spm=0.0.0.0.vN65hp）；\r\n经由生产厂家认可的售后服务中心或国家认可的第三方质检平台检测确认的非人为商品质量问题，并出具检测报告。\r\n无忧退换货特别说明：退换货商品引起的运费问题:\r\n买家申请“不想要了 ”退款原因的退换货，则所有运费买家承担（但包邮产品首次发货运费商家承担）。\r\n买家申请非“我不想要了”退款原因的退换货，如责任方在买家，则所有运费买家承担（但包邮产品首次发货运费商家承担）；如责任方在商家，则所有运费商家承担。\r\n买家根据协议约定或天猫做出的处理结果操作退换货时，应当使用与商家发货时相同的运输方式发货。除非得到收件方 　的明确同意，发件方不得使用到付方式支付运费，商家提供换货服务并重新发货后，买家有收货义务。\r\n享受“三包规定”保障的商品产生的保障范围内的争议，买家应当在交易成功后的九十天内提出申请。\r\n', 1478942034, 1);

-- ----------------------------
-- Table structure for shop_auction
-- ----------------------------
DROP TABLE IF EXISTS `shop_auction`;
CREATE TABLE `shop_auction`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '拍卖竞价表主键ID',
  `mid` int(10) NOT NULL COMMENT '竞价会员ID',
  `ag_id` int(10) NOT NULL COMMENT '竞价商品ID',
  `auctionprice` float(10, 2) NOT NULL COMMENT '竞拍价格',
  `addtime` int(10) NOT NULL COMMENT '出价时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auction
-- ----------------------------
INSERT INTO `shop_auction` VALUES (1, 4, 1, 22.00, 1480595179);
INSERT INTO `shop_auction` VALUES (2, 4, 9, 7.00, 1480666710);

-- ----------------------------
-- Table structure for shop_auction_deposit
-- ----------------------------
DROP TABLE IF EXISTS `shop_auction_deposit`;
CREATE TABLE `shop_auction_deposit`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '交易保证金表主键ID',
  `mid` int(10) NOT NULL COMMENT '会员表主键ID',
  `ag_id` int(10) NOT NULL COMMENT '拍卖商品表主键ID',
  `deposit` float(10, 2) NOT NULL COMMENT '拍卖交易保证金',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auction_deposit
-- ----------------------------
INSERT INTO `shop_auction_deposit` VALUES (1, 4, 1, 11.00);
INSERT INTO `shop_auction_deposit` VALUES (2, 4, 9, 4.00);

-- ----------------------------
-- Table structure for shop_auction_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_auction_goods`;
CREATE TABLE `shop_auction_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gid` int(10) NOT NULL,
  `starttime` int(10) NULL DEFAULT NULL,
  `endtime` int(10) NULL DEFAULT NULL,
  `startprice` float(10, 2) NULL DEFAULT NULL COMMENT '起拍价格',
  `commonprice` float(10, 2) NULL DEFAULT NULL COMMENT '低价',
  `maxprice` float(10, 2) NULL DEFAULT NULL COMMENT '最高价格',
  `range` smallint(6) NULL DEFAULT NULL COMMENT '加价幅度',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '拍卖状态，1代表拍卖未结束，0代表拍卖已结束',
  `isshow` tinyint(1) NOT NULL DEFAULT 1 COMMENT '展示1，隐藏0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auction_goods
-- ----------------------------
INSERT INTO `shop_auction_goods` VALUES (1, 37, 1498608000, 1498867200, 9.00, 15.00, 22.00, 10, 0, 1);
INSERT INTO `shop_auction_goods` VALUES (2, 33, 1480348800, 1480780800, 300.00, 450.00, 480.00, 30, 1, 1);
INSERT INTO `shop_auction_goods` VALUES (3, 39, 1480262400, 1480867200, 1.00, 5.00, 10.00, 8, 1, 1);
INSERT INTO `shop_auction_goods` VALUES (4, 40, 1480435200, 1480694400, 100.00, 180.00, 230.00, 20, 1, 1);
INSERT INTO `shop_auction_goods` VALUES (5, 51, 1480435200, 1480694400, 20.00, 35.00, 89.00, 10, 1, 1);
INSERT INTO `shop_auction_goods` VALUES (7, 35, 1480003200, 1480608000, 20.00, 30.00, 40.00, 3, 1, 1);
INSERT INTO `shop_auction_goods` VALUES (8, 34, 1480435200, 1481126400, 5.00, 15.00, 19.00, 1, 1, 1);
INSERT INTO `shop_auction_goods` VALUES (9, 36, 1480348800, 1480780800, 1.00, 3.00, 7.00, 3, 0, 1);
INSERT INTO `shop_auction_goods` VALUES (10, 38, 1479744000, 1481040000, 60.00, 100.00, 120.00, 5, 1, 1);

-- ----------------------------
-- Table structure for shop_auction_success
-- ----------------------------
DROP TABLE IF EXISTS `shop_auction_success`;
CREATE TABLE `shop_auction_success`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` int(10) NOT NULL,
  `ag_id` int(10) NOT NULL,
  `price` float(10, 0) NOT NULL,
  `isshow` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1代表去付款，0代表查看订单',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auction_success
-- ----------------------------
INSERT INTO `shop_auction_success` VALUES (1, 4, 1, 22, 1);
INSERT INTO `shop_auction_success` VALUES (2, 4, 9, 7, 0);

-- ----------------------------
-- Table structure for shop_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_group`;
CREATE TABLE `shop_auth_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '组名，角色名',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '角色状态，1显示，0隐藏',
  `rules` varchar(600) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色（组）所对应的规则（权限）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auth_group
-- ----------------------------
INSERT INTO `shop_auth_group` VALUES (1, '超级管理员', 1, '1,13,51,52,53,54,14,55,56,57,15,58,59,16,60,61,62,63,17,18,64,65,66,19,2,20,67,68,69,70,21,3,22,71,72,73,74,23,4,24,75,76,77,78,126,25,5,26,79,80,81,82,129,27,28,83,84,85,86,87,29,88,6,30,89,90,91,92,31,7,32,93,94,95,96,150,33,151,8,34,97,98,133,134,35,36,128,9,37,99,100,101,102,38,10,39,116,117,118,40,119,41,120,121,42,122,43,123,44,124,125,11,45,103,104,105,106,107,46,47,108,109,110,111,112,12,48,113,114,115,49,50,130,131,137,138,139,140,132,141,142,144,145,146,147,143,148,149,153,154');
INSERT INTO `shop_auth_group` VALUES (2, '商品管理员', 1, '1,13,51,52,53,54,5,26,79,80,81,82,27,28,83,84,85,86,87,29,88');
INSERT INTO `shop_auth_group` VALUES (3, '品牌管理员', 1, '21,22,23');

-- ----------------------------
-- Table structure for shop_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_group_access`;
CREATE TABLE `shop_auth_group_access`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '会员主键ID',
  `group_id` int(10) NOT NULL COMMENT '组主键ID（角色主键ID）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auth_group_access
-- ----------------------------
INSERT INTO `shop_auth_group_access` VALUES (13, 7, 3);
INSERT INTO `shop_auth_group_access` VALUES (20, 6, 2);
INSERT INTO `shop_auth_group_access` VALUES (28, 1, 1);
INSERT INTO `shop_auth_group_access` VALUES (29, 2, 1);
INSERT INTO `shop_auth_group_access` VALUES (30, 3, 1);
INSERT INTO `shop_auth_group_access` VALUES (31, 5, 1);
INSERT INTO `shop_auth_group_access` VALUES (32, 4, 1);

-- ----------------------------
-- Table structure for shop_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_rule`;
CREATE TABLE `shop_auth_rule`  (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `pid` int(8) NOT NULL,
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `edittime` int(10) NULL DEFAULT NULL COMMENT '权限的修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 155 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_auth_rule
-- ----------------------------
INSERT INTO `shop_auth_rule` VALUES (1, 'Admin/Nav/system', '系统管理', 1, 1, '', 0, '1', NULL);
INSERT INTO `shop_auth_rule` VALUES (2, 'Admin/Nav/role', '角色管理', 1, 1, '', 0, '2', NULL);
INSERT INTO `shop_auth_rule` VALUES (3, 'Admin/Nav/auth', '权限管理', 1, 1, '', 0, '3', NULL);
INSERT INTO `shop_auth_rule` VALUES (4, 'Admin/Nav/ads', '广告管理', 1, 1, '', 0, '4', NULL);
INSERT INTO `shop_auth_rule` VALUES (5, 'Admin/Nav/goods', '商品管理', 1, 1, '', 0, '5', NULL);
INSERT INTO `shop_auth_rule` VALUES (6, 'Admin/Nav/brand', '品牌管理', 1, 1, '', 0, '6', NULL);
INSERT INTO `shop_auth_rule` VALUES (7, 'Admin/Nav/category', '分类管理', 1, 1, '', 0, '7', NULL);
INSERT INTO `shop_auth_rule` VALUES (8, 'Admin/Nav/sale', '促销管理', 1, 1, '', 0, '8', NULL);
INSERT INTO `shop_auth_rule` VALUES (9, 'Admin/Nav/member', '会员管理', 1, 1, '', 0, '9', NULL);
INSERT INTO `shop_auth_rule` VALUES (10, 'Admin/Nav/order', '订单管理', 1, 1, '', 0, '10', NULL);
INSERT INTO `shop_auth_rule` VALUES (11, 'Admin/Nav/news', '新闻管理', 1, 1, '', 0, '11', NULL);
INSERT INTO `shop_auth_rule` VALUES (12, 'Admin/Nav/auction', '拍卖专场', 1, 1, '', 0, '12', NULL);
INSERT INTO `shop_auth_rule` VALUES (13, 'Admin/Index/index', '后台首页', 1, 1, '', 1, '1,13', NULL);
INSERT INTO `shop_auth_rule` VALUES (14, 'Admin/Vote/showlist', '投票系统', 1, 1, '', 1, '1,14', NULL);
INSERT INTO `shop_auth_rule` VALUES (15, 'Admin/Feedback/showlist', '商城反馈', 1, 1, '', 1, '1,15', NULL);
INSERT INTO `shop_auth_rule` VALUES (16, 'Admin/Admin/showlist', '管理员列表', 1, 1, '', 1, '1,16', NULL);
INSERT INTO `shop_auth_rule` VALUES (17, 'Admin/Admin/addlist', '添加管理员', 1, 1, '', 1, '1,17', NULL);
INSERT INTO `shop_auth_rule` VALUES (18, 'Admin/AdminNav/showlist', '菜单列表', 1, 1, '', 1, '1,18', NULL);
INSERT INTO `shop_auth_rule` VALUES (19, 'Admin/AdminNav/addlist', '添加菜单', 1, 1, '', 1, '1,19', NULL);
INSERT INTO `shop_auth_rule` VALUES (20, 'Admin/AuthGroup/showlist', '角色列表', 1, 1, '', 2, '2,20', NULL);
INSERT INTO `shop_auth_rule` VALUES (21, 'Admin/AuthGroup/addlist', '添加角色', 1, 1, '', 2, '2,21', NULL);
INSERT INTO `shop_auth_rule` VALUES (22, 'Admin/AuthRule/showlist', '权限列表', 1, 1, '', 3, '3,22', NULL);
INSERT INTO `shop_auth_rule` VALUES (23, 'Admin/AuthRule/addlist', '添加权限', 1, 1, '', 3, '3,23', NULL);
INSERT INTO `shop_auth_rule` VALUES (24, 'Admin/Ads/showlist', '广告列表', 1, 1, '', 4, '4,24', NULL);
INSERT INTO `shop_auth_rule` VALUES (25, 'Admin/Ads/addlist', '添加广告', 1, 1, '', 4, '4,25', NULL);
INSERT INTO `shop_auth_rule` VALUES (26, 'Admin/Goods/showlist', '商品列表', 1, 1, '', 5, '5,26', NULL);
INSERT INTO `shop_auth_rule` VALUES (27, 'Admin/Goods/addlist', '添加商品', 1, 1, '', 5, '5,27', NULL);
INSERT INTO `shop_auth_rule` VALUES (28, 'Admin/GoodsComment/comment', '用户评论', 1, 1, '', 5, '5,28', NULL);
INSERT INTO `shop_auth_rule` VALUES (29, 'Admin/Goods/recycle', '商品回收站', 1, 1, '', 5, '5,29', NULL);
INSERT INTO `shop_auth_rule` VALUES (30, 'Admin/Brand/showlist', '品牌列表', 1, 1, '', 6, '6,30', NULL);
INSERT INTO `shop_auth_rule` VALUES (31, 'Admin/Brand/addlist', '添加品牌', 1, 1, '', 6, '6,31', NULL);
INSERT INTO `shop_auth_rule` VALUES (32, 'Admin/Category/showlist', '分类列表', 1, 1, '', 7, '7,32', NULL);
INSERT INTO `shop_auth_rule` VALUES (33, 'Admin/Category/addlist', '添加分类', 1, 1, '', 7, '7,33', NULL);
INSERT INTO `shop_auth_rule` VALUES (34, 'Admin/Sale/qianggou', '限时抢购', 1, 1, '', 8, '8,34', NULL);
INSERT INTO `shop_auth_rule` VALUES (35, 'Admin/Sale/showlist/activity/2', '节日狂欢', 1, 1, '', 8, '8,35', NULL);
INSERT INTO `shop_auth_rule` VALUES (36, 'Admin/Sale/showlist/activity/3', '十年店庆', 1, 1, '', 8, '8,36', NULL);
INSERT INTO `shop_auth_rule` VALUES (37, 'Admin/Member/showlist', '会员列表', 1, 1, '', 9, '9,37', NULL);
INSERT INTO `shop_auth_rule` VALUES (38, 'Admin/Member/level', '会员等级', 1, 1, '', 9, '9,38', NULL);
INSERT INTO `shop_auth_rule` VALUES (39, 'Admin/Order/showlist', '所有订单', 1, 1, '', 10, '10,39', NULL);
INSERT INTO `shop_auth_rule` VALUES (40, 'Admin/Order/showlist/status/1', '未付款订单', 1, 1, '', 10, '10,40', NULL);
INSERT INTO `shop_auth_rule` VALUES (41, 'Admin/Order/showlist/status/2', '已付款订单', 1, 1, '', 10, '10,41', NULL);
INSERT INTO `shop_auth_rule` VALUES (42, 'Admin/Order/showlist/status/3', '已发货订单', 1, 1, '', 10, '10,42', NULL);
INSERT INTO `shop_auth_rule` VALUES (43, 'Admin/Order/showlist/status/4', '未评价订单', 1, 1, '', 10, '10,43', NULL);
INSERT INTO `shop_auth_rule` VALUES (44, 'Admin/Order/showlist/status/5', '已完成订单', 1, 1, '', 10, '10,44', NULL);
INSERT INTO `shop_auth_rule` VALUES (45, 'Admin/News/showlist', '新闻列表', 1, 1, '', 11, '11,45', NULL);
INSERT INTO `shop_auth_rule` VALUES (46, 'Admin/News/addlist', '新闻发布', 1, 1, '', 11, '11,46', NULL);
INSERT INTO `shop_auth_rule` VALUES (47, 'Admin/NewsComment/comment', '评论列表', 1, 1, '', 11, '11,47', NULL);
INSERT INTO `shop_auth_rule` VALUES (48, 'Admin/Auction/showlist', '拍卖列表', 1, 1, '', 12, '12,48', NULL);
INSERT INTO `shop_auth_rule` VALUES (49, 'Admin/Auction/recordList', '竞价记录', 1, 1, '', 12, '12,49', NULL);
INSERT INTO `shop_auth_rule` VALUES (50, 'Admin/Auction/submitList', '成交记录', 1, 1, '', 12, '12,50', NULL);
INSERT INTO `shop_auth_rule` VALUES (51, 'Admin/Index/top', '头部页面', 1, 1, '', 13, '1,13,51', 1479193756);
INSERT INTO `shop_auth_rule` VALUES (52, 'Admin/Index/main', '欢迎页面', 1, 1, '', 13, '1,13,52', NULL);
INSERT INTO `shop_auth_rule` VALUES (53, 'Admin/Index/left', '左侧页面', 1, 1, '', 13, '1,13,53', NULL);
INSERT INTO `shop_auth_rule` VALUES (54, 'Admin/Index/footer', '底部页面', 1, 1, '', 13, '1,13,54', NULL);
INSERT INTO `shop_auth_rule` VALUES (55, 'Admin/Vote/voteRecord', '投票记录', 1, 1, '', 14, '1,14,55', NULL);
INSERT INTO `shop_auth_rule` VALUES (56, 'Admin/Vote/addVote', '增加票数', 1, 1, '', 14, '1,14,56', NULL);
INSERT INTO `shop_auth_rule` VALUES (57, 'Admin/Vote/jianshao', '减少票数', 1, 1, '', 14, '1,14,57', NULL);
INSERT INTO `shop_auth_rule` VALUES (58, 'Admin/Feedback/detail', '查看详情', 1, 1, '', 15, '1,15,58', NULL);
INSERT INTO `shop_auth_rule` VALUES (59, 'Admin/Feedback/del', '删除', 1, 1, '', 15, '1,15,59', NULL);
INSERT INTO `shop_auth_rule` VALUES (60, 'Admin/Admin/enabled', '启用', 1, 1, '', 16, '1,16,60', NULL);
INSERT INTO `shop_auth_rule` VALUES (61, 'Admin/Admin/disabled', '禁用', 1, 1, '', 16, '1,16,61', NULL);
INSERT INTO `shop_auth_rule` VALUES (62, 'Admin/Admin/updlist', '编辑', 1, 1, '', 16, '1,16,62', NULL);
INSERT INTO `shop_auth_rule` VALUES (63, 'Admin/Admin/del', '删除', 1, 1, '', 16, '1,16,63', NULL);
INSERT INTO `shop_auth_rule` VALUES (64, 'Admin/AdminNav/addlist', '添加子菜单', 1, 1, '', 18, '1,18,64', NULL);
INSERT INTO `shop_auth_rule` VALUES (65, 'Admin/AdminNav/edit', '编辑', 1, 1, '', 18, '1,18,65', NULL);
INSERT INTO `shop_auth_rule` VALUES (66, 'Admin/AdminNav/delete', '删除', 1, 1, '', 18, '1,18,66', NULL);
INSERT INTO `shop_auth_rule` VALUES (67, 'Admin/AuthGroup/addMember', '添加组员', 1, 1, '', 20, '2,20,67', NULL);
INSERT INTO `shop_auth_rule` VALUES (68, 'Admin/AuthGroup/edit', '编辑', 1, 1, '', 20, '2,20,68', NULL);
INSERT INTO `shop_auth_rule` VALUES (69, 'Admin/AuthGroup/allocateRule', '分配权限', 1, 1, '', 20, '2,20,69', NULL);
INSERT INTO `shop_auth_rule` VALUES (70, 'Admin/AuthGroup/delete', '删除', 1, 1, '', 20, '2,20,70', NULL);
INSERT INTO `shop_auth_rule` VALUES (71, 'Admin/AuthRule/addlist', '添加子权限', 1, 1, '', 22, '3,22,71', NULL);
INSERT INTO `shop_auth_rule` VALUES (72, 'Admin/AuthRule/showlist', '查看子级权限', 1, 1, '', 22, '3,22,72', NULL);
INSERT INTO `shop_auth_rule` VALUES (73, 'Admin/AuthRule/edit', '编辑', 1, 1, '', 22, '3,22,73', NULL);
INSERT INTO `shop_auth_rule` VALUES (74, 'Admin/AuthRule/delete', '删除', 1, 1, '', 22, '3,22,74', NULL);
INSERT INTO `shop_auth_rule` VALUES (75, 'Admin/Ads/enabled', '显示', 1, 1, '', 24, '4,24,75', 1479273189);
INSERT INTO `shop_auth_rule` VALUES (76, 'Admin/Ads/disabled', '隐藏', 1, 1, '', 24, '4,24,76', NULL);
INSERT INTO `shop_auth_rule` VALUES (77, 'Admin/Ads/del', '删除', 1, 1, '', 24, '4,24,77', NULL);
INSERT INTO `shop_auth_rule` VALUES (78, 'Admin/Ads/edictlist', '编辑', 1, 1, '', 24, '4,24,78', NULL);
INSERT INTO `shop_auth_rule` VALUES (79, 'Admin/Goods/enabled', '上架', 1, 1, '', 26, '5,26,79', NULL);
INSERT INTO `shop_auth_rule` VALUES (80, 'Admin/Goods/disabled', '下架', 1, 1, '', 26, '5,26,80', NULL);
INSERT INTO `shop_auth_rule` VALUES (81, 'Admin/Goods/addrecycle', '加入回收站', 1, 1, '', 26, '5,26,81', NULL);
INSERT INTO `shop_auth_rule` VALUES (82, 'Admin/Goods/del', '删除', 1, 1, '', 26, '5,26,82', NULL);
INSERT INTO `shop_auth_rule` VALUES (83, 'Admin/GoodsComment/answer', '回复', 1, 1, '', 28, '5,28,83', NULL);
INSERT INTO `shop_auth_rule` VALUES (84, 'Admin/GoodsComment/del', '删除', 1, 1, '', 28, '5,28,84', NULL);
INSERT INTO `shop_auth_rule` VALUES (85, 'Admin/GoodsComment/enabled', '展示', 1, 1, '', 28, '5,28,85', NULL);
INSERT INTO `shop_auth_rule` VALUES (86, 'Admin/GoodsComment/disabled', '隐藏', 1, 1, '', 28, '5,28,86', NULL);
INSERT INTO `shop_auth_rule` VALUES (87, 'Admin/GoodsComment/detail', '查看详情', 1, 1, '', 28, '5,28,87', NULL);
INSERT INTO `shop_auth_rule` VALUES (88, 'Admin/Goods/regain', '恢复', 1, 1, '', 29, '5,29,88', NULL);
INSERT INTO `shop_auth_rule` VALUES (89, 'Admin/Brand/disabled', '禁用', 1, 1, '', 30, '6,30,89', NULL);
INSERT INTO `shop_auth_rule` VALUES (90, 'Admin/Brand/enabled', '启用', 1, 1, '', 30, '6,30,90', NULL);
INSERT INTO `shop_auth_rule` VALUES (91, 'Admin/Brand/edictlist', '编辑', 1, 1, '', 30, '6,30,91', NULL);
INSERT INTO `shop_auth_rule` VALUES (92, 'Admin/Brand/del', '删除', 1, 1, '', 30, '6,30,92', NULL);
INSERT INTO `shop_auth_rule` VALUES (93, 'Admin/Category/disabled', '禁用', 1, 1, '', 32, '7,32,93', NULL);
INSERT INTO `shop_auth_rule` VALUES (94, 'Admin/Category/enabled', '展示', 1, 1, '', 32, '7,32,94', NULL);
INSERT INTO `shop_auth_rule` VALUES (95, 'Admin/Category/del', '删除', 1, 1, '', 32, '7,32,95', NULL);
INSERT INTO `shop_auth_rule` VALUES (96, 'Admin/Category/edit', '编辑', 1, 1, '', 32, '7,32,96', NULL);
INSERT INTO `shop_auth_rule` VALUES (97, 'Admin/Sale/edictlist', '设置', 1, 1, '', 34, '8,34,97', NULL);
INSERT INTO `shop_auth_rule` VALUES (98, 'Admin/Sale/addlist', '查看详情', 1, 1, '', 34, '8,34,98', NULL);
INSERT INTO `shop_auth_rule` VALUES (99, 'Admin/Member/disabled', '禁用', 1, 1, '', 37, '9,37,99', NULL);
INSERT INTO `shop_auth_rule` VALUES (100, 'Admin/Member/enabled', '启用', 1, 1, '', 37, '9,37,100', NULL);
INSERT INTO `shop_auth_rule` VALUES (101, 'Admin/Member/del', '删除', 1, 1, '', 37, '9,37,101', NULL);
INSERT INTO `shop_auth_rule` VALUES (102, 'Admin/Member/detail', '查看详情', 1, 1, '', 37, '9,37,102', NULL);
INSERT INTO `shop_auth_rule` VALUES (103, 'Admin/News/tohide', '隐藏', 1, 1, '', 45, '11,45,103', NULL);
INSERT INTO `shop_auth_rule` VALUES (104, 'Admin/News/toshow', '显示', 1, 1, '', 45, '11,45,104', NULL);
INSERT INTO `shop_auth_rule` VALUES (105, 'Admin/News/totop', '置顶', 1, 1, '', 45, '11,45,105', NULL);
INSERT INTO `shop_auth_rule` VALUES (106, 'canceltop', '取消置顶', 1, 1, '', 45, '11,45,106', NULL);
INSERT INTO `shop_auth_rule` VALUES (107, 'Admin/News/del', '删除', 1, 1, '', 45, '11,45,107', NULL);
INSERT INTO `shop_auth_rule` VALUES (108, 'Admin/NewsComment/replyNews', '回复', 1, 1, '', 47, '11,47,108', NULL);
INSERT INTO `shop_auth_rule` VALUES (109, 'Admin/NewsComment/commentDetail', '查看详情', 1, 1, '', 47, '11,47,109', NULL);
INSERT INTO `shop_auth_rule` VALUES (110, 'Admin/NewsComment/commentHide', '隐藏', 1, 1, '', 47, '11,47,110', NULL);
INSERT INTO `shop_auth_rule` VALUES (111, 'Admin/NewsComment/commentShow', '显示', 1, 1, '', 47, '11,47,111', NULL);
INSERT INTO `shop_auth_rule` VALUES (112, 'Admin/NewsComment/commentDel', '删除', 1, 1, '', 47, '11,47,112', NULL);
INSERT INTO `shop_auth_rule` VALUES (113, 'Admin/Auction/enabled', '显示', 1, 1, '', 48, '12,48,113', NULL);
INSERT INTO `shop_auth_rule` VALUES (114, 'Admin/Auction/disabled', '隐藏', 1, 1, '', 48, '12,48,114', NULL);
INSERT INTO `shop_auth_rule` VALUES (115, 'Admin/Auction/settime', '设置时间', 1, 1, '', 48, '12,48,115', NULL);
INSERT INTO `shop_auth_rule` VALUES (116, 'Admin/Order/tosend', '发货', 1, 1, '', 39, '10,39,116', NULL);
INSERT INTO `shop_auth_rule` VALUES (117, 'Admin/Order/orderDetail', '订单详情', 1, 1, '', 39, '10,39,117', NULL);
INSERT INTO `shop_auth_rule` VALUES (118, 'Admin/Order/delete', '移除', 1, 1, '', 39, '10,39,118', NULL);
INSERT INTO `shop_auth_rule` VALUES (119, 'Admin/Order/orderDetail', '订单详情', 1, 1, '', 40, '10,40,119', NULL);
INSERT INTO `shop_auth_rule` VALUES (120, 'Admin/Order/tosend', '发货', 1, 1, '', 41, '10,41,120', NULL);
INSERT INTO `shop_auth_rule` VALUES (121, 'Admin/Order/orderDetail', '订单详情', 1, 1, '', 41, '10,41,121', NULL);
INSERT INTO `shop_auth_rule` VALUES (122, 'Admin/Order/orderDetail', '订单详情', 1, 1, '', 42, '10,42,122', NULL);
INSERT INTO `shop_auth_rule` VALUES (123, 'Admin/Order/orderDetail', '订单详情', 1, 1, '', 43, '10,43,123', NULL);
INSERT INTO `shop_auth_rule` VALUES (124, 'Admin/Order/orderDetail', '订单详情', 1, 1, '', 44, '10,44,124', NULL);
INSERT INTO `shop_auth_rule` VALUES (125, 'Admin/Order/delete', '移除', 1, 1, '', 44, '10,44,125', NULL);
INSERT INTO `shop_auth_rule` VALUES (126, 'Admin/Ads/zhiding', '置顶', 1, 1, '', 24, '4,24,126', NULL);
INSERT INTO `shop_auth_rule` VALUES (128, 'Admin/Sale/showlist', '活动列表', 1, 1, '', 8, '8,128', NULL);
INSERT INTO `shop_auth_rule` VALUES (129, 'Admin/Goods/edit', '编辑', 1, 1, '', 26, '5,26,129', NULL);
INSERT INTO `shop_auth_rule` VALUES (130, 'Admin/Nav/article', '文章管理', 1, 1, '', 0, '130', NULL);
INSERT INTO `shop_auth_rule` VALUES (131, 'Admin/Article/showlist', '文章列表', 1, 1, '', 130, '130,131', NULL);
INSERT INTO `shop_auth_rule` VALUES (132, 'Admin/Article/addlist', '添加文章', 1, 1, '', 130, '130,132', NULL);
INSERT INTO `shop_auth_rule` VALUES (133, 'Admin/Sale/enabled', '是', 1, 1, '', 34, '8,34,133', NULL);
INSERT INTO `shop_auth_rule` VALUES (134, 'Admin/Sale/disabled', '否', 1, 1, '', 34, '8,34,134', NULL);
INSERT INTO `shop_auth_rule` VALUES (137, 'Admin/Article/active', '隐藏', 1, 1, '', 131, '130,131,137', NULL);
INSERT INTO `shop_auth_rule` VALUES (138, 'Admin/Article/active', '显示', 1, 1, '', 131, '130,131,138', NULL);
INSERT INTO `shop_auth_rule` VALUES (139, 'Admin/Article/detail', '查看详情', 1, 1, '', 131, '130,131,139', NULL);
INSERT INTO `shop_auth_rule` VALUES (140, 'Admin/Article/del', '删除', 1, 1, '', 131, '130,131,140', NULL);
INSERT INTO `shop_auth_rule` VALUES (141, 'Admin/Nav/integral', '积分商城', 1, 1, '', 0, '141', NULL);
INSERT INTO `shop_auth_rule` VALUES (142, 'Admin/Integral/showlist', '商品列表', 1, 1, '', 141, '141,142', NULL);
INSERT INTO `shop_auth_rule` VALUES (143, 'Admin/Integral/addlist', '添加商品', 1, 1, '', 141, '141,143', 1480294953);
INSERT INTO `shop_auth_rule` VALUES (144, 'Admin/Integral/edit', '编辑', 1, 1, '', 142, '141,142,144', NULL);
INSERT INTO `shop_auth_rule` VALUES (145, 'Admin/Integral/enabled', '上架', 1, 1, '', 142, '141,142,145', NULL);
INSERT INTO `shop_auth_rule` VALUES (146, 'Admin/Integral/disabled', '下架', 1, 1, '', 142, '141,142,146', NULL);
INSERT INTO `shop_auth_rule` VALUES (147, 'Admin/Integral/del', '删除', 1, 1, '', 142, '141,142,147', NULL);
INSERT INTO `shop_auth_rule` VALUES (148, 'Admin/Integral/addlist', '发布商品', 1, 1, '', 143, '141,143,148', NULL);
INSERT INTO `shop_auth_rule` VALUES (149, 'Admin/Integral/uploadGoodsPic', '上传图片', 1, 1, '', 143, '141,143,149', NULL);
INSERT INTO `shop_auth_rule` VALUES (150, 'Admin/Category/keys', '搜索', 1, 1, '', 32, '7,32,150', NULL);
INSERT INTO `shop_auth_rule` VALUES (151, 'Admin/Category/getChildCate', '二级分类', 1, 1, '', 7, '7,151', NULL);
INSERT INTO `shop_auth_rule` VALUES (153, 'Admin/Vote/addBlack', '加入黑名单', 1, 1, '', 55, '1,14,55,153', NULL);
INSERT INTO `shop_auth_rule` VALUES (154, 'Admin/Vote/removeBlack', '移出黑名单', 1, 1, '', 55, '1,14,55,154', 1480574537);

-- ----------------------------
-- Table structure for shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `shop_brand`;
CREATE TABLE `shop_brand`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bname` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `addtime` int(10) UNSIGNED NULL DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '1使用0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_brand
-- ----------------------------
INSERT INTO `shop_brand` VALUES (1, '德芙', '580dcfc588a97.jpg', '德芙是世界最大宠物食品和休闲食品制造商美国跨国食品公司玛氏（Mars）公司在中国推出的系列产品。', 1477300165, 1);
INSERT INTO `shop_brand` VALUES (2, '大白兔', '580dd02073a15.jpg', '“大白兔”诞生于1959年——中华人民共和国建国十周年，当年，“大白兔”奶糖成为建国十周年的献礼产品。这一年，也是三年自然灾害的第一年，在物质匮乏的年代里，它是极其珍贵的，是多少“60后”“70后”儿时最美好的记忆。', 1477300256, 1);
INSERT INTO `shop_brand` VALUES (3, '格力高', '580dd0359b802.jpg', '格力高集团是一个多元化事业的集团型食品企业。总公司在上海，在日本以生产休闲食品、冷饮、加工食品、健康食品的江崎格力高食品公司为中心，另外在东南亚设有泰国格力高、在欧洲和达能合资有法国格力高、在美国国内设有Glico USA公司。', 1477300277, 1);
INSERT INTO `shop_brand` VALUES (5, '汇源', '580dd060e943a.jpg', '汇源集团成立于1992年。目前已在全国建立了140多个经营实体，链接了1000多万亩优质果蔬茶粮等种植基地，建立了基本遍布全国的销售网络，构建了一个横跨东西、纵贯南北的农业产业化经营体系。以果汁产业为主体，形成了汇源果汁、汇源果业、汇源农业互相促进、共同发展的新格局。', 1477300320, 1);
INSERT INTO `shop_brand` VALUES (6, '可口可乐', '580dd07fe04f1.jpg', '可口可乐（英语：Coca-Cola；简称 Coke，中文为可乐），1886年在美国乔治亚州亚特兰大市诞生，自此便与社会发展相互交融，激发创新灵感。这些依次展开的历史时刻精彩纷呈，成就了这个全球品牌的百年传奇.', 1477300351, 1);
INSERT INTO `shop_brand` VALUES (7, '零食工坊', '580dd099e2164.jpg', '零食工坊自2007年3月创办至今，已经拥有包括直营和加盟在内的两百家连锁店，覆盖到以江苏为中心的多个县市。零食工坊目前拥近百个品牌、六大品类、近千种口味的中外美味零食，每种零食都带着它产地的风情、美妙的滋味传递快乐的气息！\r\n', 1477300377, 1);
INSERT INTO `shop_brand` VALUES (8, '农夫山泉', '580dd0b046a2b.jpg', '农夫山泉股份有限公司原名“浙江千岛湖养生堂饮用水有限公司“，其公司总部位于浙江杭州，系养生堂旗下控股公司，成立于1996年9月26日。\r\n该公司是中国大陆一家饮用水生产企业，拥有浙江千岛湖、吉林长白山、湖北丹江口、广东万绿湖、宝鸡太白山、新疆天山玛纳斯、四川峨眉山、以及贵州武陵山八大优质水源基地[', 1477300400, 1);
INSERT INTO `shop_brand` VALUES (9, '盼盼', '580dd0c817d3f.jpg', '福建盼盼食品集团有限公司始创于1996年，公司前身系福建省晋江福源食品有限公司，集团总部位于中国品牌之都――晋江。', 1477300424, 1);
INSERT INTO `shop_brand` VALUES (10, '脉动', '5812c73565b15.png', '一款运动维生素饮料，于2003年上市。以居住在城市的年轻人，年龄约18-35之间，由于工作需求，经常在户外活动的人群为消费主体。', 1477625653, 1);
INSERT INTO `shop_brand` VALUES (11, '雀巢', '5812c7511832d.jpg', '雀巢公司，由亨利·雀巢（Henri Nestle)于1867年创建，总部设在瑞士日内瓦湖畔的韦威 (Vevey)，在全球拥有500多家工厂，为世界上最大的食品制造商。公司起源于瑞士，最初是以生产婴儿食品起家，以生产巧克力棒和速溶咖啡闻名遐迩。', 1477625681, 1);
INSERT INTO `shop_brand` VALUES (12, '百岁山', '5812c76b63075.jpg', '景田百岁山天然矿泉水采用千年未被改变和触动过的百岁山天然矿泉水源，为世上少见的优质矿泉水水源之一，其水质天然纯净、无污染，倍显甘甜，经专家鉴定为优质、天然矿泉水', 1477625707, 1);
INSERT INTO `shop_brand` VALUES (13, '依云', '5812c791cb91b.jpg', 'evian的名字，源自凯尔特语&quot;evua&quot;，即&quot;水&quot;的意思。依云天然矿泉水的水源地法国依云小镇， 背靠阿尔卑斯山，面临莱芒湖，远离任何污染和人为接触，经过了长达15年的天然过滤和冰川砂层的矿化，漫长的自然过滤过程为依云矿泉水注入天然、均衡、纯净的矿物质成份，适合人体需求，安全健康。依云天然矿泉水在水源地直接装瓶，无人体接触、无化学处理，每天进行300多次水质检查。在欧洲，依云已成为怀孕和哺乳期妈妈的信赖选择。自1789年依云水源地被发现以来，依云天然矿泉水已远销全球140个国家和地区。', 1477625745, 1);
INSERT INTO `shop_brand` VALUES (14, '天地精华', '5812c7acd3c25.jpg', '天地精华', 1477625772, 1);
INSERT INTO `shop_brand` VALUES (15, '茅台', '5812c8155ecf8.jpg', '茅台酒产于中国西南贵州省仁怀市茅台镇，同英国苏格兰威士忌和法国柯涅克白兰地并称为“世界三大名酒”。\r\n2016年8月，中国贵州茅台酒厂（集团）在&quot;2016中国企业500强&quot;中排名第356位。', 1477625877, 1);
INSERT INTO `shop_brand` VALUES (16, '百富', '5812c9a917c9b.jpg', '百富（The Balvenie），来自历史悠久、品质出众的苏格兰产区的格兰父子洋酒公司。格兰父子源自1886年，是苏格兰最古老、最富盛名的威士忌公司之一，其产品行销全球180多个国家，为英国王室贵族和全世界威士忌爱好者所喜爱。截止2010年，格兰父子已七度获选国际葡萄酒和烈酒大赛（IWSC）年度最佳酒厂。\r\n百富的独特品质，源自其独特的传统手工技艺：依然在自有的麦田里种植大麦，以传统铺地发芽制作麦芽，由桶匠悉心照看所有的橡木桶，由铜匠精心维护着铜制的蒸馏器。由纯手工打造出来的酒质，是追求高产量、高效率的现代化酒厂无法比拟的。百富对品质的追求还体现在单一纯麦威士忌上，区别于产量高、价格低的混合威士忌，单一纯麦威士忌稀有而珍贵，只有大概3%品质臻于完美巅峰的麦芽威士忌，才会被挑选出来装瓶为单一纯麦威士忌。', 1477626281, 1);
INSERT INTO `shop_brand` VALUES (17, 'J.P.CHENET', '5812cb2bc6221.jpg', '香奈品牌葡萄酒创始于1985年，是法国GCF（法国大酒窖）酒业集团旗下的全球销量第一的优质葡萄酒。 　　\r\n谁不知道意大利的比萨斜塔，无独有偶，法国也有一款知名葡萄酒———歪脖香奈。歪斜的瓶口，突破传统的瓶身设计，典雅，芬芳，诠释了另外一种时尚。', 1477626667, 1);
INSERT INTO `shop_brand` VALUES (18, '唐人福', '5812cb99db722.jpg', '唐人福为特乐福实业旗下的一个子品牌，专业从事无糖健康食品的生产和销售。本着“无糖也甜健康之选”的价值理念，唐人福为现代人们的生活增添了许多健康美味。', 1477626777, 1);
INSERT INTO `shop_brand` VALUES (19, '百草味', '5812cbce33f6a.jpg', '百草味坐落于风景秀丽的东方休闲之都杭州，是一家以休闲食品加工、生产、贸易为主体，集连锁、B2C经营模式为一体的新型企业。公司下设:杭州郝姆斯食品有限公司、杭州百草味企业管理咨询有限公司。公司自成立以来,一直以&quot;做中国休闲零食第一品牌&quot;为目标,以&quot;快乐百草味，健康好滋味&quot;为口号，先后成立了加盟连锁事业部、电子商务事业部，员工人数达到200多名。建立了涵盖:坚果炒货、蜜饯话梅、糕点饼干、肉干肉脯、花茶等5大系列300多个单品的产品体系，基本形成休闲食品一站式购物的格局。本着品质优先的理念，公司累计投入2000多万元建立了现代化的食品生产线，仓储面积达到1万平方米。2011年被评为浙江省优秀特许品牌。2012年被评为中国连锁经营金麒麟奖之最具成长力品牌。', 1477626830, 1);
INSERT INTO `shop_brand` VALUES (20, '口口福', '5812cbe214bf3.png', '口口福是由金华口口福有限公司于2008在浙江推出的一个互联网食品品牌。', 1477626850, 1);
INSERT INTO `shop_brand` VALUES (21, '舒可曼', '5812cbf6d5e88.jpg', '舒可曼是广州福正东海食品有限公司旗下品牌，专注于中国家庭烘焙与调味品的新时代品牌。\r\n舒可曼致力于在全球范围内寻找安全、健康、美味、富有特色的食品，以努力满足大众对食品日益增长的高需求。其强大的食品科学技术背景，资深的研发团队，让舒可曼能准确把握和深刻理解世界食品发展的潮流和趋势，而凭借对食品的敏感嗅觉和丰富的业界合作资源，让舒可曼成为了富有竞争力的高品质食品品牌，选择舒可曼，选择安心。', 1477626870, 1);
INSERT INTO `shop_brand` VALUES (22, 'DARS', '5812cc17ed135.jpg', 'DARS，来自于的日本森永，在日本算是比较有名的巧克力。介绍的这款新巧克力，而不是去闻它的味道了，是它盒子上面的粉红点。他们家独有的贴心的设计，盒子上有个圆形温度感应标志，在中间颜色，表明是最佳食用时间·那是一个化工温度计，图片上也标注着它温的显示，而中间22摄氏度，就是官方推荐的食用温度。 日本原装进口- 森永DARS红色牛奶巧克力', 1477626903, 1);
INSERT INTO `shop_brand` VALUES (23, '三只松鼠', '5812ccd89fb02.jpg', '三只松鼠股份有限公司成立于2012年，是中国第一家定位于纯互联网食品品牌的企业，也是当前中国销售规模最大的食品电商企业。“三只松鼠”品牌一经推出，立刻受到了风险投资机构的青睐，先后获得IDG的150万美金A轮天使投资和今日资本的600万美元B轮投资。2015年，三只松鼠获得峰瑞资本（FREES FUNDD）3亿元投资。', 1477627096, 1);
INSERT INTO `shop_brand` VALUES (24, '娃哈哈', '5812cd29cb0ed.jpg', '杭州娃哈哈集团有限公司创建于1987年（丁卯年），为中国最大全球第五的食品饮料生产企业，在资产规模、产量、销售收入、利润、利税等指标上已连续11年位居中国饮料行业首位，成为目前中国最大、效益最好、最具发展潜力的食品饮料企业。2010年，全国民企500强排名第8位。', 1477627177, 1);
INSERT INTO `shop_brand` VALUES (25, '好吃点', '5812cd4898b4e.jpg', '好吃点系列饼干由福建达利集体团生产销售。著名艺人赵薇代言了该商品，她在广告中那句“好吃点，好吃你就多吃点”的广告语被消费者耳熟能详，也让福建达利集团这个大平台成为家喻户晓的公司。达利集团的“达利园”、“可比克”、“好吃点”品牌，均以其优异的产品品质、亲和的品牌形象走进了千家万户。', 1477627208, 1);
INSERT INTO `shop_brand` VALUES (26, '上好佳', '5812cd6548c8e.jpg', '上好佳（中国）有限公司是菲律宾LIWAYWAY公司于1993年在华投资的以食品工业为主的企业集团', 1477627237, 1);
INSERT INTO `shop_brand` VALUES (27, '雅客', '5812cd862ea1f.jpg', '福建雅客食品有限公司创办于1993年10月，坐落于最具经济活力的海峡西岸经济区闽南金三角——晋江市，是目前中国最大的糖果、巧克力专业厂商之一。 专注于糖果、巧克力、果冻、蜜饯、闲点、小食品的研发、生产与销售。', 1477627270, 1);
INSERT INTO `shop_brand` VALUES (28, '宜侬', '5812cdf9d6438.jpg', '宜侬(ENOW)是上海宜侬生物科技有限公司旗下的化妆品品牌。凭借着芳香植物研发中心多年在研制和开发芳香精油、纯露、芳香花草茶、精油添加型化妆品等系列产品和应用技术优势，以及与美国、法国、韩国、日本、澳大利亚、瑞士等国的相关领域科学家;国际园艺学会芳疗医学协会、英国IFA芳香疗法治疗师协会等专业机构的合作，宜侬试图打造一个具有世界影响力的芳疗美容品牌。', 1477627385, 1);
INSERT INTO `shop_brand` VALUES (29, 'Stride炫迈', '5812ce23dcf44.jpg', 'Stride炫迈无糖口香糖于2012年9月9日正式登陆中国，属于亿滋中国(原卡夫食品中国)糖果品类。作为深受年轻人热爱的品牌，Stride炫迈口香糖在全球一直以大胆创新的市场营销而闻名。', 1477627427, 1);
INSERT INTO `shop_brand` VALUES (32, '良品铺子', '5812e9de49dc1.jpg', '良品铺子', 1477634526, 1);
INSERT INTO `shop_brand` VALUES (39, '厂家直销', NULL, '', 1477640830, 1);

-- ----------------------------
-- Table structure for shop_cart
-- ----------------------------
DROP TABLE IF EXISTS `shop_cart`;
CREATE TABLE `shop_cart`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '购物车ID',
  `mid` int(11) NOT NULL COMMENT '会员ID（用于关联会员表）',
  `gid` int(11) NOT NULL COMMENT '商品ID（用于关联商品表）',
  `buynum` int(11) NOT NULL COMMENT '购物车中商品的购买数量',
  `addtime` int(11) NOT NULL COMMENT '加入购物车的时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_cart
-- ----------------------------
INSERT INTO `shop_cart` VALUES (17, 12, 32, 1, 1480061358);
INSERT INTO `shop_cart` VALUES (20, 47, 21, 1, 1480395335);
INSERT INTO `shop_cart` VALUES (21, 4, 27, 1, 1480409344);
INSERT INTO `shop_cart` VALUES (22, 4, 25, 1, 1480666293);

-- ----------------------------
-- Table structure for shop_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE `shop_category`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catename` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pid` smallint(6) UNSIGNED NOT NULL,
  `path` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 98 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_category
-- ----------------------------
INSERT INTO `shop_category` VALUES (1, '甜品', 0, '1', 1);
INSERT INTO `shop_category` VALUES (2, '饮品', 0, '2', 1);
INSERT INTO `shop_category` VALUES (3, '零食', 0, '3', 1);
INSERT INTO `shop_category` VALUES (4, '冲剂品', 0, '4', 1);
INSERT INTO `shop_category` VALUES (5, '水果', 0, '5', 1);
INSERT INTO `shop_category` VALUES (6, '日常食品', 0, '6', 1);
INSERT INTO `shop_category` VALUES (7, '生鲜蔬菜', 0, '7', 1);
INSERT INTO `shop_category` VALUES (8, '肉类', 0, '8', 1);
INSERT INTO `shop_category` VALUES (9, '糖果', 1, '1,9', 1);
INSERT INTO `shop_category` VALUES (10, '饼干', 1, '1,10', 1);
INSERT INTO `shop_category` VALUES (11, '糕点', 1, '1,11', 1);
INSERT INTO `shop_category` VALUES (12, '水', 2, '2,12', 1);
INSERT INTO `shop_category` VALUES (13, '饮料', 2, '2,13', 1);
INSERT INTO `shop_category` VALUES (14, '酒类', 2, '2,14', 1);
INSERT INTO `shop_category` VALUES (15, '膨化食品', 3, '3,15', 1);
INSERT INTO `shop_category` VALUES (16, '坚果', 3, '3,16', 1);
INSERT INTO `shop_category` VALUES (17, '果干', 3, '3,17', 1);
INSERT INTO `shop_category` VALUES (18, '功能冲剂', 4, '4,18', 1);
INSERT INTO `shop_category` VALUES (19, '保健冲剂', 4, '4,19', 1);
INSERT INTO `shop_category` VALUES (20, '奶制品', 4, '4,20', 1);
INSERT INTO `shop_category` VALUES (21, '粮油', 6, '6,21', 1);
INSERT INTO `shop_category` VALUES (22, '速食', 6, '6,22', 1);
INSERT INTO `shop_category` VALUES (23, '调味', 6, '6,23', 1);
INSERT INTO `shop_category` VALUES (24, '棉花糖', 9, '1,9,24', 1);
INSERT INTO `shop_category` VALUES (25, '口香糖', 9, '1,9,25', 1);
INSERT INTO `shop_category` VALUES (26, '软糖', 9, '1,9,26', 1);
INSERT INTO `shop_category` VALUES (27, '奶糖', 9, '1,9,27', 1);
INSERT INTO `shop_category` VALUES (28, '巧克力', 1, '1,28', 1);
INSERT INTO `shop_category` VALUES (29, '黑巧克力', 28, '1,28,29', 1);
INSERT INTO `shop_category` VALUES (30, '白巧克力', 28, '1,28,30', 1);
INSERT INTO `shop_category` VALUES (31, '夹心巧克力', 28, '1,28,31', 1);
INSERT INTO `shop_category` VALUES (32, '牛奶巧克力', 28, '1,28,32', 1);
INSERT INTO `shop_category` VALUES (33, '饼干巧克力', 28, '1,28,33', 1);
INSERT INTO `shop_category` VALUES (34, '曲奇饼干', 10, '1,10,34', 1);
INSERT INTO `shop_category` VALUES (35, '威化饼干', 10, '1,10,35', 1);
INSERT INTO `shop_category` VALUES (36, '夹心饼干', 10, '1,10,36', 1);
INSERT INTO `shop_category` VALUES (37, '蛋黄派', 11, '1,11,37', 1);
INSERT INTO `shop_category` VALUES (38, '沙琪玛', 11, '1,11,38', 1);
INSERT INTO `shop_category` VALUES (39, '凤梨酥', 11, '1,11,39', 1);
INSERT INTO `shop_category` VALUES (40, '薯片', 15, '3,15,40', 1);
INSERT INTO `shop_category` VALUES (41, '虾片', 15, '3,15,41', 1);
INSERT INTO `shop_category` VALUES (42, '爆米花', 15, '3,15,42', 1);
INSERT INTO `shop_category` VALUES (43, '果蔬饮料', 13, '2,13,43', 1);
INSERT INTO `shop_category` VALUES (44, '碳酸饮料', 13, '2,13,44', 1);
INSERT INTO `shop_category` VALUES (45, '茶饮料', 13, '2,13,45', 1);
INSERT INTO `shop_category` VALUES (46, '矿泉水', 12, '2,12,46', 1);
INSERT INTO `shop_category` VALUES (47, '纯净水', 12, '2,12,47', 1);
INSERT INTO `shop_category` VALUES (48, '苏打水', 12, '2,12,48', 1);
INSERT INTO `shop_category` VALUES (49, '红葡萄酒', 14, '2,14,49', 1);
INSERT INTO `shop_category` VALUES (50, '白葡萄酒', 14, '2,14,50', 1);
INSERT INTO `shop_category` VALUES (51, '香槟', 14, '2,14,51', 1);
INSERT INTO `shop_category` VALUES (52, '冰酒', 14, '2,14,52', 1);
INSERT INTO `shop_category` VALUES (53, '食用油', 21, '6,21,53', 1);
INSERT INTO `shop_category` VALUES (54, '大米', 21, '6,21,54', 1);
INSERT INTO `shop_category` VALUES (55, '方便面', 22, '6,22,55', 1);
INSERT INTO `shop_category` VALUES (56, '饺子', 22, '6,22,56', 1);
INSERT INTO `shop_category` VALUES (57, '汤圆', 22, '6,22,57', 1);
INSERT INTO `shop_category` VALUES (58, '罐头', 22, '6,22,58', 1);
INSERT INTO `shop_category` VALUES (59, '咖喱', 23, '6,23,59', 1);
INSERT INTO `shop_category` VALUES (60, '沙拉', 23, '6,23,60', 1);
INSERT INTO `shop_category` VALUES (61, '梅类', 17, '3,17,61', 1);
INSERT INTO `shop_category` VALUES (62, '葡萄干', 17, '3,17,62', 1);
INSERT INTO `shop_category` VALUES (63, '草莓干', 17, '3,17,63', 1);
INSERT INTO `shop_category` VALUES (64, '红枣', 17, '3,17,64', 1);
INSERT INTO `shop_category` VALUES (65, '山楂片/卷', 17, '3,17,65', 1);
INSERT INTO `shop_category` VALUES (66, '核桃', 16, '3,16,66', 1);
INSERT INTO `shop_category` VALUES (67, '夏威夷果', 16, '3,16,67', 1);
INSERT INTO `shop_category` VALUES (68, '碧根果', 16, '3,16,68', 1);
INSERT INTO `shop_category` VALUES (69, '开心果', 16, '3,16,69', 1);
INSERT INTO `shop_category` VALUES (70, '奶粉', 20, '4,20,70', 1);
INSERT INTO `shop_category` VALUES (71, '奶茶', 20, '4,20,71', 1);
INSERT INTO `shop_category` VALUES (72, '芝麻糊', 19, '4,19,72', 1);
INSERT INTO `shop_category` VALUES (73, '咖啡', 18, '4,18,73', 1);
INSERT INTO `shop_category` VALUES (74, '茶叶', 18, '4,18,74', 1);
INSERT INTO `shop_category` VALUES (75, '蜂产品', 19, '4,19,75', 1);
INSERT INTO `shop_category` VALUES (76, '麦片', 19, '4,19,76', 1);
INSERT INTO `shop_category` VALUES (77, '苹果', 5, '5,77', 1);
INSERT INTO `shop_category` VALUES (78, '葡萄', 5, '5,78', 1);
INSERT INTO `shop_category` VALUES (79, '猕猴桃', 5, '5,79', 1);
INSERT INTO `shop_category` VALUES (80, '海鲜类', 7, '7,80', 1);
INSERT INTO `shop_category` VALUES (81, '蔬菜类', 7, '7,81', 1);
INSERT INTO `shop_category` VALUES (82, '茅台', 14, '2,14,82', 1);
INSERT INTO `shop_category` VALUES (83, '精品羊肉', 8, '8,83', 1);
INSERT INTO `shop_category` VALUES (84, '精品牛肉', 8, '8,84', 1);
INSERT INTO `shop_category` VALUES (85, '红富士', 77, '5,77,85', 1);
INSERT INTO `shop_category` VALUES (86, '红星', 77, '5,77,86', 1);
INSERT INTO `shop_category` VALUES (87, '乔那金', 77, '5,77,87', 1);
INSERT INTO `shop_category` VALUES (88, '黑奥林 ', 78, '5,78,88', 1);
INSERT INTO `shop_category` VALUES (89, '红提 ', 78, '5,78,89', 1);
INSERT INTO `shop_category` VALUES (90, '巨峰 ', 78, '5,78,90', 1);
INSERT INTO `shop_category` VALUES (92, '内蒙古西旗羔羊肉', 83, '8,83,92', 1);
INSERT INTO `shop_category` VALUES (93, '神户牛肉', 84, '8,84,93', 1);
INSERT INTO `shop_category` VALUES (94, '鱼类', 80, '7,80,94', 1);
INSERT INTO `shop_category` VALUES (95, '贝类', 80, '7,80,95', 1);
INSERT INTO `shop_category` VALUES (96, '柠檬', 5, '5,96', 1);
INSERT INTO `shop_category` VALUES (97, '厂家直销猕猴桃', 79, '5,79,97', 1);

-- ----------------------------
-- Table structure for shop_collect
-- ----------------------------
DROP TABLE IF EXISTS `shop_collect`;
CREATE TABLE `shop_collect`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '收藏表ID',
  `mid` int(10) NOT NULL COMMENT '会员ID',
  `gid` int(10) NOT NULL COMMENT '商品ID',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_collect
-- ----------------------------
INSERT INTO `shop_collect` VALUES (2, 4, 52, 1479538989);
INSERT INTO `shop_collect` VALUES (5, 54, 8, 1479539772);
INSERT INTO `shop_collect` VALUES (7, 4, 58, 1479544562);
INSERT INTO `shop_collect` VALUES (10, 5, 2, 1479884390);
INSERT INTO `shop_collect` VALUES (12, 5, 35, 1479884757);
INSERT INTO `shop_collect` VALUES (13, 5, 34, 1479967714);
INSERT INTO `shop_collect` VALUES (15, 5, 36, 1479977478);
INSERT INTO `shop_collect` VALUES (28, 12, 51, 1480051761);
INSERT INTO `shop_collect` VALUES (30, 12, 44, 1480051787);
INSERT INTO `shop_collect` VALUES (32, 5, 38, 1480407507);
INSERT INTO `shop_collect` VALUES (33, 5, 3, 1480407710);
INSERT INTO `shop_collect` VALUES (38, 5, 48, 1480411829);
INSERT INTO `shop_collect` VALUES (39, 12, 37, 1480667750);
INSERT INTO `shop_collect` VALUES (42, 5, 44, 1480669118);

-- ----------------------------
-- Table structure for shop_comment_pic
-- ----------------------------
DROP TABLE IF EXISTS `shop_comment_pic`;
CREATE TABLE `shop_comment_pic`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gid` int(10) UNSIGNED NOT NULL,
  `mid` int(10) UNSIGNED NOT NULL,
  `picname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `addtime` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_comment_pic
-- ----------------------------
INSERT INTO `shop_comment_pic` VALUES (1, 4, 47, '5836d69f2f2cd.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (2, 37, 47, '5836d6c27c929.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (3, 25, 47, '5836d802cbff3.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (4, 25, 47, '5836d8030f478.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (5, 25, 47, '5836d8037e202.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (6, 21, 47, '5836d84e1c0bc.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (7, 21, 47, '5836d84e366a3.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (8, 21, 47, '5836d84ea8ec5.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (9, 4, 47, '5836d863dac7a.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (10, 4, 47, '5836d86403349.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (11, 4, 47, '5836d8641f870.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (12, 4, 47, '5836d878a7117.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (13, 4, 47, '5836d878c70d7.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (14, 4, 47, '5836d878e2a45.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (15, 25, 47, '5836d89300330.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (16, 25, 47, '5836d8931eb80.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (17, 25, 47, '5836d89341e08.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (18, 3, 47, '5836d8b36442e.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (19, 3, 47, '5836d8b3824ad.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (20, 3, 47, '5836d8b39c2c3.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (21, 4, 47, '583d0e02074f4.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (22, 4, 47, '583d0e0220f22.jpg', NULL);
INSERT INTO `shop_comment_pic` VALUES (23, 52, 4, '583d141f87558.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (24, 52, 4, '583d141fbec2d.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (25, 52, 4, '583d142028236.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (26, 47, 12, '583d466458fce.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (27, 47, 12, '583d4664609ae.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (28, 47, 12, '583d46646838e.png', NULL);
INSERT INTO `shop_comment_pic` VALUES (29, 21, 12, '583fb29ce21f2.png', '1480569500');
INSERT INTO `shop_comment_pic` VALUES (30, 21, 12, '583fb29ceaaac.png', '1480569500');
INSERT INTO `shop_comment_pic` VALUES (31, 21, 12, '583fb29d01837.png', '1480569501');
INSERT INTO `shop_comment_pic` VALUES (32, 21, 12, '583fb66dc91e4.png', '1480570477');
INSERT INTO `shop_comment_pic` VALUES (33, 32, 12, '584130e264b29.jpg', '1480667362');
INSERT INTO `shop_comment_pic` VALUES (34, 32, 12, '584130e26dbb3.png', '1480667362');
INSERT INTO `shop_comment_pic` VALUES (35, 32, 12, '584130e277bde.jpg', '1480667362');

-- ----------------------------
-- Table structure for shop_credit_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_credit_goods`;
CREATE TABLE `shop_credit_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gid` int(10) NOT NULL,
  `mid` int(10) UNSIGNED NOT NULL,
  `credit` float(10, 0) NOT NULL,
  `buynum` tinyint(4) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_credit_goods
-- ----------------------------
INSERT INTO `shop_credit_goods` VALUES (1, 28, 19, 980, 1, 1478827541);
INSERT INTO `shop_credit_goods` VALUES (2, 58, 19, 26640, 6, 1478835067);
INSERT INTO `shop_credit_goods` VALUES (3, 59, 4, 286, 1, 1479439791);
INSERT INTO `shop_credit_goods` VALUES (4, 59, 4, 286, 1, 1479440466);
INSERT INTO `shop_credit_goods` VALUES (5, 59, 4, 286, 1, 1479440735);
INSERT INTO `shop_credit_goods` VALUES (6, 59, 4, 286, 1, 1479440736);
INSERT INTO `shop_credit_goods` VALUES (7, 31, 4, 239, 1, 1479441696);
INSERT INTO `shop_credit_goods` VALUES (8, 31, 4, 239, 1, 1479451946);
INSERT INTO `shop_credit_goods` VALUES (9, 59, 4, 286, 1, 1479452029);
INSERT INTO `shop_credit_goods` VALUES (10, 59, 4, 286, 1, 1479461767);
INSERT INTO `shop_credit_goods` VALUES (11, 59, 4, 286, 1, 1479462471);
INSERT INTO `shop_credit_goods` VALUES (12, 59, 4, 572, 2, 1479462484);
INSERT INTO `shop_credit_goods` VALUES (13, 58, 4, 0, 1, 1479525925);
INSERT INTO `shop_credit_goods` VALUES (14, 58, 4, 0, 1, 1479525958);
INSERT INTO `shop_credit_goods` VALUES (15, 58, 4, 0, 1, 1479526116);
INSERT INTO `shop_credit_goods` VALUES (16, 59, 4, 286, 1, 1479526254);
INSERT INTO `shop_credit_goods` VALUES (17, 58, 4, 0, 1, 1479526551);
INSERT INTO `shop_credit_goods` VALUES (18, 58, 4, 0, 1, 1479526552);
INSERT INTO `shop_credit_goods` VALUES (19, 58, 4, 0, 1, 1479526553);
INSERT INTO `shop_credit_goods` VALUES (20, 58, 4, 0, 1, 1479526553);
INSERT INTO `shop_credit_goods` VALUES (21, 58, 4, 0, 1, 1479526555);
INSERT INTO `shop_credit_goods` VALUES (22, 58, 4, 0, 1, 1479526555);
INSERT INTO `shop_credit_goods` VALUES (23, 58, 4, 0, 1, 1479526556);
INSERT INTO `shop_credit_goods` VALUES (24, 58, 4, 0, 1, 1479526556);
INSERT INTO `shop_credit_goods` VALUES (25, 57, 4, 0, 1, 1479526567);
INSERT INTO `shop_credit_goods` VALUES (26, 57, 4, 0, 1, 1479526568);
INSERT INTO `shop_credit_goods` VALUES (27, 57, 4, 0, 1, 1479526568);
INSERT INTO `shop_credit_goods` VALUES (28, 57, 4, 0, 1, 1479526569);
INSERT INTO `shop_credit_goods` VALUES (29, 57, 4, 0, 1, 1479526569);
INSERT INTO `shop_credit_goods` VALUES (30, 57, 4, 0, 1, 1479526570);
INSERT INTO `shop_credit_goods` VALUES (31, 57, 4, 0, 1, 1479526570);
INSERT INTO `shop_credit_goods` VALUES (32, 58, 4, 0, 1, 1479526604);
INSERT INTO `shop_credit_goods` VALUES (33, 58, 4, 0, 1, 1479526605);
INSERT INTO `shop_credit_goods` VALUES (34, 58, 4, 0, 1, 1479526605);
INSERT INTO `shop_credit_goods` VALUES (35, 58, 4, 0, 1, 1479526605);
INSERT INTO `shop_credit_goods` VALUES (36, 58, 4, 0, 1, 1479526606);
INSERT INTO `shop_credit_goods` VALUES (37, 58, 4, 0, 1, 1479526606);
INSERT INTO `shop_credit_goods` VALUES (38, 58, 4, 0, 1, 1479526606);
INSERT INTO `shop_credit_goods` VALUES (39, 58, 4, 0, 1, 1479526607);
INSERT INTO `shop_credit_goods` VALUES (40, 58, 4, 0, 1, 1479526607);
INSERT INTO `shop_credit_goods` VALUES (41, 58, 4, 0, 1, 1479526607);
INSERT INTO `shop_credit_goods` VALUES (42, 58, 4, 0, 1, 1479526607);
INSERT INTO `shop_credit_goods` VALUES (43, 58, 4, 0, 1, 1479526608);
INSERT INTO `shop_credit_goods` VALUES (44, 58, 4, 0, 1, 1479526608);
INSERT INTO `shop_credit_goods` VALUES (45, 58, 4, 0, 1, 1479526634);
INSERT INTO `shop_credit_goods` VALUES (46, 58, 4, 0, 1, 1479526647);
INSERT INTO `shop_credit_goods` VALUES (47, 58, 4, 0, 1, 1479526648);
INSERT INTO `shop_credit_goods` VALUES (48, 58, 4, 0, 1, 1479526648);
INSERT INTO `shop_credit_goods` VALUES (49, 58, 4, 0, 1, 1479526649);
INSERT INTO `shop_credit_goods` VALUES (50, 58, 4, 0, 1, 1479526649);
INSERT INTO `shop_credit_goods` VALUES (51, 58, 4, 0, 1, 1479526702);
INSERT INTO `shop_credit_goods` VALUES (52, 58, 4, 0, 1, 1479526703);
INSERT INTO `shop_credit_goods` VALUES (53, 58, 4, 0, 1, 1479526703);
INSERT INTO `shop_credit_goods` VALUES (54, 58, 4, 0, 1, 1479526704);
INSERT INTO `shop_credit_goods` VALUES (55, 58, 4, 0, 1, 1479526760);
INSERT INTO `shop_credit_goods` VALUES (56, 58, 4, 0, 1, 1479526789);
INSERT INTO `shop_credit_goods` VALUES (57, 58, 4, 0, 1, 1479526790);
INSERT INTO `shop_credit_goods` VALUES (58, 58, 4, 0, 1, 1479526791);
INSERT INTO `shop_credit_goods` VALUES (59, 58, 4, 0, 1, 1479526791);
INSERT INTO `shop_credit_goods` VALUES (60, 58, 4, 0, 1, 1479526792);
INSERT INTO `shop_credit_goods` VALUES (61, 58, 4, 0, 1, 1479526792);
INSERT INTO `shop_credit_goods` VALUES (62, 58, 4, 0, 1, 1479526800);
INSERT INTO `shop_credit_goods` VALUES (63, 58, 4, 0, 1, 1479526886);
INSERT INTO `shop_credit_goods` VALUES (64, 58, 4, 0, 1, 1479526886);
INSERT INTO `shop_credit_goods` VALUES (65, 58, 4, 0, 1, 1479526935);
INSERT INTO `shop_credit_goods` VALUES (66, 58, 4, 0, 1, 1479526979);
INSERT INTO `shop_credit_goods` VALUES (67, 58, 4, 444, 1, 1479527194);
INSERT INTO `shop_credit_goods` VALUES (68, 58, 4, 444, 1, 1479527960);
INSERT INTO `shop_credit_goods` VALUES (69, 58, 4, 444, 1, 1479527960);
INSERT INTO `shop_credit_goods` VALUES (70, 31, 4, 239, 1, 1479531966);
INSERT INTO `shop_credit_goods` VALUES (71, 60, 4, 2180, 1, 1479532446);
INSERT INTO `shop_credit_goods` VALUES (73, 59, 12, 286, 1, 1480398309);
INSERT INTO `shop_credit_goods` VALUES (74, 60, 4, 2180, 1, 1480409542);
INSERT INTO `shop_credit_goods` VALUES (75, 60, 4, 2180, 1, 1480666809);
INSERT INTO `shop_credit_goods` VALUES (76, 57, 12, 400, 1, 1480667570);

-- ----------------------------
-- Table structure for shop_delivery
-- ----------------------------
DROP TABLE IF EXISTS `shop_delivery`;
CREATE TABLE `shop_delivery`  (
  `id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_name` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '快递名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_delivery
-- ----------------------------
INSERT INTO `shop_delivery` VALUES (1, '圆通快递');
INSERT INTO `shop_delivery` VALUES (2, '中通快递');
INSERT INTO `shop_delivery` VALUES (3, '顺丰快递');
INSERT INTO `shop_delivery` VALUES (4, '申通快递');
INSERT INTO `shop_delivery` VALUES (5, '韵达快递');

-- ----------------------------
-- Table structure for shop_feedback
-- ----------------------------
DROP TABLE IF EXISTS `shop_feedback`;
CREATE TABLE `shop_feedback`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '反馈id',
  `mid` int(11) UNSIGNED NOT NULL,
  `feedback_admin` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '系统管理员',
  `addtime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '反馈',
  `reply` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '回复',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_feedback
-- ----------------------------
INSERT INTO `shop_feedback` VALUES (2, 20, '系统管理员', '1478833497', 'Feedback', '666');
INSERT INTO `shop_feedback` VALUES (3, 20, '系统管理员', '1478833616', '测试测试', '');
INSERT INTO `shop_feedback` VALUES (4, 20, '系统管理员', '1479019874', '你们这个商场啊 真好真好', '哈哈哈哈哈哈');
INSERT INTO `shop_feedback` VALUES (5, 4, '系统管理员', '1479365973', '你好，店家', '你好444');
INSERT INTO `shop_feedback` VALUES (6, 4, '系统管理员', '1479378451', '希望快点发货', '');
INSERT INTO `shop_feedback` VALUES (7, 12, '系统管理员', '1480328065', '真心不错', '');
INSERT INTO `shop_feedback` VALUES (8, 12, '系统管理员', '1480410774', '1111', '');
INSERT INTO `shop_feedback` VALUES (9, 12, '系统管理员', '1480568387', 'hello baby', '444444');
INSERT INTO `shop_feedback` VALUES (10, 4, '系统管理员', '1480666937', 'aaa', NULL);

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goodsname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cid` smallint(5) UNSIGNED NOT NULL,
  `bid` smallint(5) UNSIGNED NOT NULL,
  `marketprice` float(8, 2) UNSIGNED NULL DEFAULT NULL,
  `price` float(8, 2) UNSIGNED NULL DEFAULT NULL,
  `num` int(10) UNSIGNED NULL DEFAULT NULL,
  `salenum` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '热销',
  `pic` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `display` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '默认为上架',
  `addtime` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '促销',
  `activity` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '默认不做活动',
  `introduction` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '介绍',
  `parameter` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '参数',
  `delete` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `collectnum` int(11) NOT NULL DEFAULT 0 COMMENT '收藏的次数',
  `clicknum` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '点击数量',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
INSERT INTO `shop_goods` VALUES (1, '百草味  碧根果奶油味218g 坚果零食  干果炒货 山核桃', 68, 19, 35.00, 18.90, 10000, 7881, '5812f32604f2f.jpg', '东西很好', 1, '1480667294', 2, '东西很好', '东西很好', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (2, '全麦燕麦饼干谷物粗粮卡饱腹代餐糖尿人低无糖零食品', 36, 7, 56.00, 22.80, 1999, 112, '5812fa2b7f867.jpg', '正品保障', 1, '1480582562', 1, '', '', 1, 0, NULL);
INSERT INTO `shop_goods` VALUES (3, '哎哟咪小梅的零食山楂组合1044g包邮山楂片山楂糕山楂糕山楂糕山楂羹卷果丹皮', 65, 7, 66.99, 29.99, 995, 7903, '5812f9b39e6c8.jpg', '正品保障', 1, '1480582570', 1, ' ', '&amp;nbsp;', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (4, '【良品铺子-法兰蒂草莓干98g*3袋】 果脯水果干蜜饯零食小吃零食包邮', 62, 32, 2.00, 1.00, 0, 4586, '5812fb9788dc6.jpg', '&amp;nbsp;', 1, '1480582579', 1, ' ', '&amp;nbsp;', 0, 0, 60);
INSERT INTO `shop_goods` VALUES (5, '【百味草纸皮核桃180g】 薄皮大核桃 坚果零食果干', 66, 19, 50.00, 29.99, 997, 9866, '5812fc1bc6473.jpg', '&amp;nbsp;', 1, '1477639195', 3, ' ', '&amp;nbsp;', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (6, '无糖食品 唐仁福苦荞蛋碗面 鸡蛋面700g 非油炸方便面', 55, 18, 20.00, 18.00, 251, 236, '5812fd81b1449.jpg', '正品保障', 1, '1478497125', 3, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (7, '【百味草-抱抱果260x2盒】 和田枣核桃仁 新疆大枣干果特产', 64, 19, 50.00, 32.99, 999, 453, '581fe6e164acd.jpg', '&amp;nbsp;', 1, '1478485729', 0, ' 恩 不错', '&amp;nbsp;', 0, 0, 50);
INSERT INTO `shop_goods` VALUES (8, '高州桂圆肉灯笼肉 无硫蒸干零食特产 泡茶煲汤甜品250克', 17, 27, 40.00, 36.00, 384379, 13, '5812fec74e0e0.jpg', '正品保障', 1, '1477639879', 1, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (9, '三只松鼠 开心果 休闲零食 坚果特产 无漂白', 69, 23, 39.00, 33.90, 1450, 0, '5812fe1dd350d.jpg', '正品保障', 1, '1477639709', 1, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (10, '红枣夹核桃仁 什锦枣夹核桃葡萄干芝麻枸杞 特级新疆和田大枣', 64, 7, 98.00, 29.80, 998, 0, '5812ffaf4748c.jpg', '正品保障', 1, '1477640111', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (11, '哎呦咪 蜜饯果干 鸳鸯半梅 小梅的零食休闲', 61, 7, 15.00, 12.90, 5076, 12, '5812feeb3c600.jpg', '正品保障', 1, '1477639915', 1, '', '', 0, 0, 70);
INSERT INTO `shop_goods` VALUES (12, '三色葡萄干组合500g新疆特产黑咖仑葡萄干无籽红绿提子干', 62, 20, 48.00, 18.90, 4337, 0, '5812ffe226ebb.jpg', '正品保障', 1, '1477640162', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (13, '新货【口口福-夏威夷果218克x2袋】 坚果零食奶油味送开口器', 67, 20, 62.00, 28.90, 13337, 0, '5813005ab5794.jpg', '正品保障', 1, '1477640282', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (14, '山东特产曲阜临沂枣庄纯手工花生杂粮薄崔 500克香酥煎饼', 22, 7, 23.00, 8.90, 41370, 0, '581301e544ef1.jpg', '包邮', 1, '1477640677', 0, '正宗枣庄香酥煎饼，层薄如纸，口感酥脆，满口掉渣，回味无穷', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (15, '印度油咖喱 妙多咖喱膏', 59, 20, 44.00, 24.00, 9374, 0, '5813025901f24.jpg', '正品保障', 1, '1477640792', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (16, '白酒贵州茅台 保健酒公司 封藏酒', 82, 39, 996.00, 139.00, 922, 91, '581303174ca01.jpg', '正品保障', 1, '1477640983', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (17, '维他柠檬茶维他柠檬茶维他柠檬茶维他柠檬茶', 43, 39, 4.00, 3.80, 442, 2, '581c1cef7b8c0.jpg', '&lt;span&gt;值得拥有&lt;/span&gt;', 1, '1478237423', 0, '补充柠檬汁', '值得拥有', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (18, '青岛胡姬花 古法小榨 花生油（非转基因）', 53, 39, 150.00, 148.00, 8889, 0, '5813040d4977f.jpg', '正品保障', 1, '1477641229', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (19, '百富12年单一麦芽苏格兰威士忌 洋酒 双桶', 52, 16, 300.00, 278.00, 13492, 371, '5813049387e3e.jpg', '正品保障', 1, '1477641363', 1, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (20, '【三只松鼠_小贱爆米花150g】休闲零食膨化食品焦糖/奶油/麻椒', 42, 23, 40.00, 12.90, 99993, 0, '5813045d2298d.jpg', '正品保障', 1, '1477641309', 1, '潮流美食 不用挑 300款零食 低至3元起', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (21, 'mini小瓶装 法国进口香奈桃红起泡酒', 49, 39, 68.00, 46.00, 226, 13684, '58130512cffaf.jpg', '正品保障', 1, '1477641490', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (22, '香蕉片香甜酥脆芭蕉干 非油炸 香蕉干', 17, 39, 19.60, 13.50, 15122, 0, '581305f5621b5.jpg', '休闲零食 老少皆宜 营养健康&lt;br /&gt;', 1, '1478519529', 4, '香脆香蕉干', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (23, '清承堂 茶叶 龙井茶 绿茶 龙井2016新茶 毛尖西湖 散装 醇香耐泡', 74, 39, 98.00, 50.00, 19566, 1, '5813061200a88.jpg', '正品保障', 1, '1477641745', 0, '新鲜采摘 清香鲜爽 茶香浓郁 持久耐泡 口齿留香', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (24, '新货坚果炭烧腰果500g无无漂白无添加腰果仁', 16, 7, 49.99, 30.00, 1200, 0, '5813055235f70.jpg', '正品保障', 1, '1477641554', 0, '', '', 0, 0, 30);
INSERT INTO `shop_goods` VALUES (25, '达利园蛋黄派 小蛋糕零食 早餐食品糕点店心软面包整箱包邮1500g', 37, 25, 35.00, 32.80, 937, 9, '58130740b1bcb.jpg', '正品保障', 1, '1477642048', 0, '整箱约55个 入口即化 早餐食品 休闲零食 蛋糕', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (26, '百花牌蜂蜜3瓶 天然0添加 纯农家自产野生土蜂蜜', 75, 39, 119.80, 69.80, 1471, 6001, '581307c33a774.jpg', '正品保障', 1, '1477642179', 1, '蜂蜜销量爆款 热销1百万瓶 天然0添加', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (27, '【三只松鼠_一口凤梨酥300g】休闲零食点心特产小吃糕点美食', 39, 23, 40.00, 14.90, 99993, 6, '581308bfad134.jpg', '正品保障', 1, '1477642431', 0, '潮流美食 不用挑 300款零食 低至3折起', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (28, '好想你红枣 官方正品 新疆特产灰枣 一级金枣情阿克苏枣子1050克', 64, 39, 130.00, 98.00, 99999, 0, '581309fa070de.jpg', '正品保障', 1, '1477642745', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (29, '大卫之选速溶咖啡三合一即溶咖啡粉特浓3合1咖啡15g*30条共450g', 73, 11, 99.00, 39.90, 99998, 1, '58130aaf81b4c.jpg', '正品保障', 1, '1477642927', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (30, '良品铺子开心果210g坚果零食无漂白原味干果休闲炒货 办公室食品', 69, 32, 52.00, 28.90, 99999, 0, '58130b376ab39.jpg', '正品保障', 1, '1477643063', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (31, '燕麦片即食早餐冲饮纯无加糖免煮燕麦片1000g', 76, 39, 59.00, 23.90, 99997, 2, '58130bec06eda.jpg', '正品保障', 1, '1477643243', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (32, '立顿经典醇原味奶茶速溶奶茶粉40袋装*2包赠立顿折叠伞', 71, 39, 98.00, 72.00, 99996, 6590, '58130d095cb33.jpg', '正品保障', 1, '1477643529', 0, '', '', 0, 0, 20);
INSERT INTO `shop_goods` VALUES (33, 'Firso美素佳儿3段宝宝幼儿牛奶粉三段 荷兰本土进口 700g*6盒装', 70, 39, 594.00, 500.00, 99999, 0, '58130ddfbb3f2.jpg', '正品保障', 1, '1478498256', 4, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (34, '徐福记蛋黄沙琪玛168g*2袋(促销装) 饼干糕点零食品', 38, 32, 25.00, 19.80, 99997, 2, '58130e91c973a.jpg', '正品保障', 1, '1478584276', 4, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (35, '乐事薯片无限104g三连罐*2组+香芝一刻*2盒', 40, 26, 50.00, 42.80, 99996, 3, '58130ef5bcee7.jpg', '正品保障', 1, '1478584129', 4, '', '', 0, 0, 60);
INSERT INTO `shop_goods` VALUES (36, '亲亲鲜虾条原味80g休闲膨化食品非油炸零食美味特产', 41, 32, 10.00, 7.20, 99998, 1, '58130f4f19df4.jpg', '正品保障', 1, '1478584322', 4, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (37, '三只松鼠 夏威夷果265g零食坚果干果奶油味送开口器', 67, 23, 30.00, 22.90, 99990, 85867, '58130f973cd0b.jpg', '正品保障', 1, '1478497845', 4, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (38, '农夫山泉17.5纯鲜榨果汁果蔬汁饮料无添加轻断食NFC橙汁950ml*6瓶', 43, 8, 179.00, 140.00, 2001, 2, '58131123f1a5f.jpg', '正品保障', 1, '1478584387', 4, '很好很好很好', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (39, '可口可乐 碳酸饮料拉罐330ml*6 连罐装 可口可乐', 44, 6, 20.00, 10.80, 38302, 1, '5813123e6aeba.jpg', '正品保障', 1, '1478498284', 4, '很便宜 很合算', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (40, '澳洲进口 布朗兄弟白金莫斯卡托甜白葡萄酒', 50, 39, 672.00, 240.00, 2003, 0, '5813128438542.jpg', '正品保障', 1, '1478498307', 4, '定金25', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (43, '免煮汤圆 爆浆麻薯组合抹茶味糕点点心大礼包', 57, 32, 50.00, 26.90, 3000, 0, '5813133d95fb6.jpg', '正品保障', 1, '1477645117', 0, '', '', 0, 0, 10);
INSERT INTO `shop_goods` VALUES (44, '达能 脉动维生素饮料青柠味 600ml* 15/箱 健康饮料', 44, 10, 60.00, 49.90, 2843, 0, '5813135a77ad1.jpg', '正品保障', 1, '1477645146', 0, '此商品正在促销中 请尽快购买', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (45, 'Nestle/雀巢香滑即饮罐装180ML*24整箱 即饮咖啡', 73, 11, 100.00, 88.80, 18476, 12, '58131445c7ddd.jpg', '正品保障', 1, '1477645381', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (46, '日式煎饺', 56, 39, 15.00, 14.00, 440, 6670, '581314bd77b2a.jpg', '正品保障', 1, '1480582711', 2, '纯手工煎饺', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (47, '名仁苏打水 弱碱性水无糖无汽水饮用水', 48, 39, 66.00, 65.00, 962856, 5, '58131582f0dd2.jpg', '正品保障', 1, '1477645698', 0, 'PH值 弱碱性 厂家直销', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (48, '天地精华矿泉水600ml*20瓶 弱碱性小瓶矿物质水非纯净水包邮', 46, 14, 120.00, 59.80, 7777, 0, '5813158b540d0.jpg', '正品保障', 1, '1477645707', 0, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (49, '西班牙进口红酒浪漫之花起泡葡萄酒', 49, 39, 68.00, 49.00, 12319, 26, '58131623ded8f.jpg', '正品保障', 1, '1477645859', 0, '酒庄直采 品质保证', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (50, 'Evian依云天然矿泉水330ml*24瓶 法国原装进口依云水 纯净水', 47, 39, 252.00, 112.00, 789, 0, '581315f6f1cdd.jpg', '正品保障', 1, '1477645814', 0, '正品保障', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (51, '100%纯黑巧克力礼盒装极苦无糖纯可可脂手工diy散装零食品', 29, 39, 89.00, 39.90, 8874, 14, '581317294ce46.jpg', '正品保障', 1, '1478505940', 4, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (52, '纯可可脂草莓夹心白巧克力豆手工松露生日礼物礼盒散装', 31, 39, 118.00, 39.90, 2986, 14, '581317c698163.jpg', '正品保障', 1, '1480582642', 1, '整枚草莓夹心 搭配香浓白巧', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (53, '炫迈口香糖', 25, 29, 10.00, 6.00, 9897, 101, '5813181fe2167.jpg', '正品保障', 1, '1477646367', 1, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (54, '良品铺子 夹心棉花糖', 24, 32, 20.00, 10.00, 3, 40, '5813187a41f8e.jpg', '正品保障', 1, '1480582662', 1, '', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (55, '上海特产冠生园大白兔奶糖礼盒生日万圣节礼物喜糖果零食品', 27, 2, 21.80, 15.80, 15376, 53, '581318edad8a9.jpg', '正品保障', 1, '1478497745', 4, '净含量 114g 约22颗 大小参考6s对比图', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (56, '包邮 马来西亚LOT100一百份水果汁软糖150g 百分百进口糖果零食品', 26, 39, 23.80, 10.80, 2523, 66, '581319763b3ca.jpg', '正品保障', 1, '1477646710', 1, '添加真正果汁 Q嫩有嚼劲 特价促销 买到就能赚到', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (57, '进口猕猴桃', 79, 39, 55.00, 40.00, 7896, 0, '582005fa47764.jpg', '非常非常喜欢', 0, '1478493690', 0, '非常非常喜欢', '非常非常喜欢', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (58, '进口红富士', 85, 39, 444.00, 444.00, 7848, 7, '582006ac89ac1.jpg', '正品保障', 0, '1478493868', 0, '俺们可是进口的红富士', '', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (59, '新鲜柠檬一级小黄柠檬皮薄多汁柠檬小果五斤', 96, 39, 38.80, 28.60, 1253, 6, '582009e13c43d.jpg', '新鲜是必须保证的 皮薄肉才多', 0, '1478494689', 0, '新鲜是必须保证的 皮薄肉才多', '新鲜是必须保证的 皮薄肉才多', 0, 0, NULL);
INSERT INTO `shop_goods` VALUES (60, '小仙女巨峰无核葡萄单串500g新鲜水果包邮', 90, 39, 350.00, 218.00, 37, 3, '58200a4e4b75b.jpg', '此商品参加活动商品,请提前加入购物车', 0, '1480582859', 2, '此商品参加活动商品,请提前加入购物车', '此商品参加活动商品,请提前加入购物车', 0, 0, NULL);

-- ----------------------------
-- Table structure for shop_goods_comment
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_comment`;
CREATE TABLE `shop_goods_comment`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `mid` int(11) UNSIGNED NOT NULL COMMENT '用户id',
  `gid` int(11) UNSIGNED NOT NULL COMMENT '商品id',
  `commentcontent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品评论',
  `isreply` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 未回复 1已回复',
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 隐藏 1 展示',
  `replycontent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '回复字段',
  `addtime` int(20) UNSIGNED NOT NULL COMMENT '评论时间',
  `start` int(5) UNSIGNED NULL DEFAULT NULL COMMENT '星级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods_comment
-- ----------------------------
INSERT INTO `shop_goods_comment` VALUES (1, 4, 38, '非常满意', 1, 0, '111', 1479542993, 5);
INSERT INTO `shop_goods_comment` VALUES (2, 47, 4, '好不错啊', 1, 1, '你喜欢就好', 1479988894, 4);
INSERT INTO `shop_goods_comment` VALUES (3, 47, 37, '差评差评', 1, 1, '事多', 1479988930, 1);
INSERT INTO `shop_goods_comment` VALUES (4, 47, 25, '不错的', 0, 1, NULL, 1479989250, 3);
INSERT INTO `shop_goods_comment` VALUES (5, 47, 21, '真谛不错呦值得推荐', 0, 1, NULL, 1479989325, 5);
INSERT INTO `shop_goods_comment` VALUES (6, 47, 4, '啥也不说看图', 1, 1, '这是良心卖家吧', 1479989347, 5);
INSERT INTO `shop_goods_comment` VALUES (7, 47, 4, '东西还不错的', 0, 1, NULL, 1479989368, 4);
INSERT INTO `shop_goods_comment` VALUES (8, 47, 25, '差评啊,我是差评师', 0, 1, NULL, 1479989394, 1);
INSERT INTO `shop_goods_comment` VALUES (9, 47, 3, '将就着用吧', 0, 1, NULL, 1479989427, 2);
INSERT INTO `shop_goods_comment` VALUES (11, 47, 4, 'adfsjdhkashgdfoiasfdfdas', 0, 1, NULL, 1480396289, 3);
INSERT INTO `shop_goods_comment` VALUES (12, 4, 52, '真心不错', 0, 1, NULL, 1480397854, 4);
INSERT INTO `shop_goods_comment` VALUES (13, 12, 47, '111', 0, 1, NULL, 1480410724, 4);
INSERT INTO `shop_goods_comment` VALUES (14, 12, 21, '我好喜欢啊', 1, 1, '你喜欢就好', 1480569500, 4);
INSERT INTO `shop_goods_comment` VALUES (15, 12, 21, '又是我', 0, 1, NULL, 1480570477, 5);
INSERT INTO `shop_goods_comment` VALUES (16, 12, 32, 'dddd', 1, 1, 'gggg', 1480667362, 4);

-- ----------------------------
-- Table structure for shop_goods_pic
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_pic`;
CREATE TABLE `shop_goods_pic`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gid` int(10) UNSIGNED NOT NULL,
  `picname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 196 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_goods_pic
-- ----------------------------
INSERT INTO `shop_goods_pic` VALUES (1, 1, '5812f32604f2f.jpg');
INSERT INTO `shop_goods_pic` VALUES (2, 1, '5812f32606a87.jpg');
INSERT INTO `shop_goods_pic` VALUES (3, 1, '5812f32608db0.jpg');
INSERT INTO `shop_goods_pic` VALUES (4, 1, '5812f3260a520.jpg');
INSERT INTO `shop_goods_pic` VALUES (5, 2, '5812fa2b7f867.jpg');
INSERT INTO `shop_goods_pic` VALUES (6, 2, '5812fa2b81b90.jpg');
INSERT INTO `shop_goods_pic` VALUES (7, 2, '5812fa2b836e8.jpg');
INSERT INTO `shop_goods_pic` VALUES (8, 3, '5812f9b39e6c8.jpg');
INSERT INTO `shop_goods_pic` VALUES (9, 3, '5812f9b3a0221.jpg');
INSERT INTO `shop_goods_pic` VALUES (10, 3, '5812f9b3a2931.jpg');
INSERT INTO `shop_goods_pic` VALUES (11, 3, '5812f9b3a4c5a.jpg');
INSERT INTO `shop_goods_pic` VALUES (12, 4, '5812fb9788dc6.jpg');
INSERT INTO `shop_goods_pic` VALUES (13, 4, '5812fb978c08f.jpg');
INSERT INTO `shop_goods_pic` VALUES (14, 4, '5812fb9793d91.jpg');
INSERT INTO `shop_goods_pic` VALUES (15, 4, '5812fb979688a.jpg');
INSERT INTO `shop_goods_pic` VALUES (16, 5, '5812fc1bc6473.jpg');
INSERT INTO `shop_goods_pic` VALUES (17, 5, '5812fc1bc83b3.jpg');
INSERT INTO `shop_goods_pic` VALUES (18, 5, '5812fc1bcf115.jpg');
INSERT INTO `shop_goods_pic` VALUES (19, 6, '5812fd81b1449.jpg');
INSERT INTO `shop_goods_pic` VALUES (20, 6, '5812fd81b2bba.jpg');
INSERT INTO `shop_goods_pic` VALUES (21, 6, '5812fd81b432a.jpg');
INSERT INTO `shop_goods_pic` VALUES (22, 6, '5812fd81b5a9b.jpg');
INSERT INTO `shop_goods_pic` VALUES (23, 7, '581fe6e166df5.jpg');
INSERT INTO `shop_goods_pic` VALUES (24, 7, '581fe6e168565.jpg');
INSERT INTO `shop_goods_pic` VALUES (25, 7, '581fe6e16a0be.jpg');
INSERT INTO `shop_goods_pic` VALUES (26, 8, '5812fec74e0e0.jpg');
INSERT INTO `shop_goods_pic` VALUES (27, 8, '5812fec74f469.jpg');
INSERT INTO `shop_goods_pic` VALUES (28, 8, '5812fec750409.jpg');
INSERT INTO `shop_goods_pic` VALUES (29, 8, '5812fec751b79.jpg');
INSERT INTO `shop_goods_pic` VALUES (30, 9, '5812fe1dd350d.jpg');
INSERT INTO `shop_goods_pic` VALUES (31, 9, '5812fe1dd5065.jpg');
INSERT INTO `shop_goods_pic` VALUES (32, 9, '5812fe1ddb5f7.jpg');
INSERT INTO `shop_goods_pic` VALUES (33, 9, '5812fe1ddd537.jpg');
INSERT INTO `shop_goods_pic` VALUES (34, 10, '5812ffaf4748c.jpg');
INSERT INTO `shop_goods_pic` VALUES (35, 10, '5812ffaf48815.jpg');
INSERT INTO `shop_goods_pic` VALUES (36, 10, '5812ffaf49f85.jpg');
INSERT INTO `shop_goods_pic` VALUES (37, 11, '5812feeb3c600.jpg');
INSERT INTO `shop_goods_pic` VALUES (38, 11, '5812feeb3e929.jpg');
INSERT INTO `shop_goods_pic` VALUES (39, 11, '5812feeb44ad2.jpg');
INSERT INTO `shop_goods_pic` VALUES (40, 11, '5812feeb4662a.jpg');
INSERT INTO `shop_goods_pic` VALUES (41, 12, '5812ffe226ebb.jpg');
INSERT INTO `shop_goods_pic` VALUES (42, 12, '5812ffe2295cb.jpg');
INSERT INTO `shop_goods_pic` VALUES (43, 12, '5812ffe22f38d.jpg');
INSERT INTO `shop_goods_pic` VALUES (44, 12, '5812ffe232655.jpg');
INSERT INTO `shop_goods_pic` VALUES (45, 13, '5813005ab5794.jpg');
INSERT INTO `shop_goods_pic` VALUES (46, 13, '5813005ab76d4.jpg');
INSERT INTO `shop_goods_pic` VALUES (47, 13, '5813005abefee.jpg');
INSERT INTO `shop_goods_pic` VALUES (48, 13, '5813005ac0f2e.jpg');
INSERT INTO `shop_goods_pic` VALUES (49, 14, '581301e544ef1.jpg');
INSERT INTO `shop_goods_pic` VALUES (50, 14, '581301e54627a.jpg');
INSERT INTO `shop_goods_pic` VALUES (51, 14, '581301e547dd2.jpg');
INSERT INTO `shop_goods_pic` VALUES (52, 14, '581301e549d12.jpg');
INSERT INTO `shop_goods_pic` VALUES (53, 15, '5813025901f24.jpg');
INSERT INTO `shop_goods_pic` VALUES (54, 15, '58130259032ad.jpg');
INSERT INTO `shop_goods_pic` VALUES (55, 15, '581302590424d.jpg');
INSERT INTO `shop_goods_pic` VALUES (56, 16, '581303174ca01.jpg');
INSERT INTO `shop_goods_pic` VALUES (57, 16, '581303174d9a1.jpg');
INSERT INTO `shop_goods_pic` VALUES (58, 16, '581303174e942.jpg');
INSERT INTO `shop_goods_pic` VALUES (59, 17, '581c1cef7d418.jpg');
INSERT INTO `shop_goods_pic` VALUES (60, 17, '581c1cef81299.jpg');
INSERT INTO `shop_goods_pic` VALUES (61, 17, '581c1cef82df2.jpg');
INSERT INTO `shop_goods_pic` VALUES (62, 18, '5813040d4977f.jpg');
INSERT INTO `shop_goods_pic` VALUES (63, 18, '5813040d4ab07.jpg');
INSERT INTO `shop_goods_pic` VALUES (64, 18, '5813040d4be8f.jpg');
INSERT INTO `shop_goods_pic` VALUES (65, 19, '5813049387e3e.jpg');
INSERT INTO `shop_goods_pic` VALUES (66, 19, '58130493895ae.jpg');
INSERT INTO `shop_goods_pic` VALUES (67, 19, '581304938b107.jpg');
INSERT INTO `shop_goods_pic` VALUES (68, 20, '5813045d2298d.jpg');
INSERT INTO `shop_goods_pic` VALUES (69, 20, '5813045d244e6.jpg');
INSERT INTO `shop_goods_pic` VALUES (70, 20, '5813045d25c56.jpg');
INSERT INTO `shop_goods_pic` VALUES (71, 21, '58130512cffaf.jpg');
INSERT INTO `shop_goods_pic` VALUES (72, 21, '58130512d1eef.jpg');
INSERT INTO `shop_goods_pic` VALUES (73, 21, '58130512d3e30.jpg');
INSERT INTO `shop_goods_pic` VALUES (74, 22, '581305f5621b5.jpg');
INSERT INTO `shop_goods_pic` VALUES (75, 22, '581305f5644dd.jpg');
INSERT INTO `shop_goods_pic` VALUES (76, 22, '581305f56641e.jpg');
INSERT INTO `shop_goods_pic` VALUES (77, 22, '581305f5677a6.jpg');
INSERT INTO `shop_goods_pic` VALUES (78, 23, '5813061200a88.jpg');
INSERT INTO `shop_goods_pic` VALUES (79, 23, '58130612025e1.jpg');
INSERT INTO `shop_goods_pic` VALUES (80, 23, '5813061203969.jpg');
INSERT INTO `shop_goods_pic` VALUES (81, 24, '5813055235f70.jpg');
INSERT INTO `shop_goods_pic` VALUES (82, 24, '5813055238a69.jpg');
INSERT INTO `shop_goods_pic` VALUES (83, 25, '58130740b1bcb.jpg');
INSERT INTO `shop_goods_pic` VALUES (84, 25, '58130740b333b.jpg');
INSERT INTO `shop_goods_pic` VALUES (85, 25, '58130740b4e94.jpg');
INSERT INTO `shop_goods_pic` VALUES (86, 26, '581307c33a774.jpg');
INSERT INTO `shop_goods_pic` VALUES (87, 26, '581307c33bee4.jpg');
INSERT INTO `shop_goods_pic` VALUES (88, 26, '581307c33d655.jpg');
INSERT INTO `shop_goods_pic` VALUES (89, 27, '581308bfad134.jpg');
INSERT INTO `shop_goods_pic` VALUES (90, 27, '581308bfaec8d.jpg');
INSERT INTO `shop_goods_pic` VALUES (91, 27, '581308bfb0015.jpg');
INSERT INTO `shop_goods_pic` VALUES (92, 28, '581309fa070de.jpg');
INSERT INTO `shop_goods_pic` VALUES (93, 28, '581309fa0901f.jpg');
INSERT INTO `shop_goods_pic` VALUES (94, 28, '581309fa0a3a7.jpg');
INSERT INTO `shop_goods_pic` VALUES (95, 29, '58130aaf81b4c.jpg');
INSERT INTO `shop_goods_pic` VALUES (96, 29, '58130aaf832bc.jpg');
INSERT INTO `shop_goods_pic` VALUES (97, 29, '58130aaf84a2c.jpg');
INSERT INTO `shop_goods_pic` VALUES (98, 30, '58130b376ab39.jpg');
INSERT INTO `shop_goods_pic` VALUES (99, 30, '58130b376c2a9.jpg');
INSERT INTO `shop_goods_pic` VALUES (100, 30, '58130b376de02.jpg');
INSERT INTO `shop_goods_pic` VALUES (101, 31, '58130bec06eda.jpg');
INSERT INTO `shop_goods_pic` VALUES (102, 31, '58130bec08e1b.jpg');
INSERT INTO `shop_goods_pic` VALUES (103, 31, '58130bec0b143.jpg');
INSERT INTO `shop_goods_pic` VALUES (104, 32, '58130d095cb33.jpg');
INSERT INTO `shop_goods_pic` VALUES (105, 32, '58130d095e68c.jpg');
INSERT INTO `shop_goods_pic` VALUES (106, 32, '58130d09609b4.jpg');
INSERT INTO `shop_goods_pic` VALUES (107, 33, '58130ddfbb3f2.jpg');
INSERT INTO `shop_goods_pic` VALUES (108, 33, '58130ddfbcf4a.jpg');
INSERT INTO `shop_goods_pic` VALUES (109, 33, '58130ddfbeaa3.jpg');
INSERT INTO `shop_goods_pic` VALUES (110, 34, '58130e91c973a.jpg');
INSERT INTO `shop_goods_pic` VALUES (111, 34, '58130e91caeaa.jpg');
INSERT INTO `shop_goods_pic` VALUES (112, 34, '58130e91cca03.jpg');
INSERT INTO `shop_goods_pic` VALUES (113, 35, '58130ef5bcee7.jpg');
INSERT INTO `shop_goods_pic` VALUES (114, 35, '58130ef5be657.jpg');
INSERT INTO `shop_goods_pic` VALUES (115, 35, '58130ef5c01b0.jpg');
INSERT INTO `shop_goods_pic` VALUES (116, 36, '58130f4f19df4.jpg');
INSERT INTO `shop_goods_pic` VALUES (117, 36, '58130f4f1b94d.jpg');
INSERT INTO `shop_goods_pic` VALUES (118, 36, '58130f4f1d0bd.jpg');
INSERT INTO `shop_goods_pic` VALUES (119, 37, '58130f973cd0b.jpg');
INSERT INTO `shop_goods_pic` VALUES (120, 37, '58130f973e47b.jpg');
INSERT INTO `shop_goods_pic` VALUES (121, 37, '58130f973fbeb.jpg');
INSERT INTO `shop_goods_pic` VALUES (122, 38, '58131123f1a5f.jpg');
INSERT INTO `shop_goods_pic` VALUES (123, 38, '58131123f3d87.jpg');
INSERT INTO `shop_goods_pic` VALUES (124, 38, '5813112402258.jpg');
INSERT INTO `shop_goods_pic` VALUES (125, 38, '5813112403db0.png');
INSERT INTO `shop_goods_pic` VALUES (126, 39, '5813123e6aeba.jpg');
INSERT INTO `shop_goods_pic` VALUES (127, 39, '5813123e6c62a.jpg');
INSERT INTO `shop_goods_pic` VALUES (128, 39, '5813123e6e56b.jpg');
INSERT INTO `shop_goods_pic` VALUES (129, 40, '5813128438542.jpg');
INSERT INTO `shop_goods_pic` VALUES (130, 40, '58131284394e3.jpg');
INSERT INTO `shop_goods_pic` VALUES (131, 40, '581312843a483.jpg');
INSERT INTO `shop_goods_pic` VALUES (132, 41, '5813128e06e7b.jpg');
INSERT INTO `shop_goods_pic` VALUES (133, 41, '5813128e07e1b.jpg');
INSERT INTO `shop_goods_pic` VALUES (134, 41, '5813128e08dbb.jpg');
INSERT INTO `shop_goods_pic` VALUES (135, 42, '58131296cd83b.jpg');
INSERT INTO `shop_goods_pic` VALUES (136, 42, '58131296ce3f3.jpg');
INSERT INTO `shop_goods_pic` VALUES (137, 42, '58131296cf77b.jpg');
INSERT INTO `shop_goods_pic` VALUES (138, 43, '5813133d95fb6.jpg');
INSERT INTO `shop_goods_pic` VALUES (139, 43, '5813133d9733e.jpg');
INSERT INTO `shop_goods_pic` VALUES (140, 43, '5813133d982de.jpg');
INSERT INTO `shop_goods_pic` VALUES (141, 43, '5813133d9ec58.jpg');
INSERT INTO `shop_goods_pic` VALUES (142, 44, '5813135a77ad1.jpg');
INSERT INTO `shop_goods_pic` VALUES (143, 44, '5813135a78e59.jpg');
INSERT INTO `shop_goods_pic` VALUES (144, 44, '5813135a7a9b2.jpg');
INSERT INTO `shop_goods_pic` VALUES (145, 45, '58131445c7ddd.jpg');
INSERT INTO `shop_goods_pic` VALUES (146, 45, '58131445c9d1d.jpg');
INSERT INTO `shop_goods_pic` VALUES (147, 45, '58131445cbc5e.jpg');
INSERT INTO `shop_goods_pic` VALUES (148, 45, '58131445cdf86.jpg');
INSERT INTO `shop_goods_pic` VALUES (149, 46, '581314bd77b2a.jpg');
INSERT INTO `shop_goods_pic` VALUES (150, 46, '581314bd79683.jpg');
INSERT INTO `shop_goods_pic` VALUES (151, 46, '581314bd7adf3.jpg');
INSERT INTO `shop_goods_pic` VALUES (152, 46, '581314bd7c94b.jpg');
INSERT INTO `shop_goods_pic` VALUES (153, 47, '58131582f0dd2.jpg');
INSERT INTO `shop_goods_pic` VALUES (154, 47, '58131582f215b.jpg');
INSERT INTO `shop_goods_pic` VALUES (155, 47, '58131582f38cb.jpg');
INSERT INTO `shop_goods_pic` VALUES (156, 47, '5813158300a13.jpg');
INSERT INTO `shop_goods_pic` VALUES (157, 48, '5813158b540d0.jpg');
INSERT INTO `shop_goods_pic` VALUES (158, 48, '5813158b55c28.jpg');
INSERT INTO `shop_goods_pic` VALUES (159, 48, '5813158b57781.jpg');
INSERT INTO `shop_goods_pic` VALUES (160, 49, '58131623ded8f.jpg');
INSERT INTO `shop_goods_pic` VALUES (161, 49, '58131623dfd2f.jpg');
INSERT INTO `shop_goods_pic` VALUES (162, 49, '58131623e0ccf.jpg');
INSERT INTO `shop_goods_pic` VALUES (163, 49, '58131623e2440.jpg');
INSERT INTO `shop_goods_pic` VALUES (164, 50, '581315f6f1cdd.jpg');
INSERT INTO `shop_goods_pic` VALUES (165, 50, '581315f6f3065.jpg');
INSERT INTO `shop_goods_pic` VALUES (166, 50, '581315f700596.jpg');
INSERT INTO `shop_goods_pic` VALUES (167, 51, '581317294ce46.jpg');
INSERT INTO `shop_goods_pic` VALUES (168, 51, '581317294e5b6.jpg');
INSERT INTO `shop_goods_pic` VALUES (169, 52, '581317c698163.jpg');
INSERT INTO `shop_goods_pic` VALUES (170, 52, '581317c6998d4.jpg');
INSERT INTO `shop_goods_pic` VALUES (171, 52, '581317c69b42c.jpg');
INSERT INTO `shop_goods_pic` VALUES (172, 53, '5813181fe2167.jpg');
INSERT INTO `shop_goods_pic` VALUES (173, 53, '5813181fe38d7.jpg');
INSERT INTO `shop_goods_pic` VALUES (174, 53, '5813181fe5048.jpg');
INSERT INTO `shop_goods_pic` VALUES (175, 54, '5813187a41f8e.jpg');
INSERT INTO `shop_goods_pic` VALUES (176, 54, '5813187a43ae7.jpg');
INSERT INTO `shop_goods_pic` VALUES (177, 54, '5813187a45257.jpg');
INSERT INTO `shop_goods_pic` VALUES (178, 55, '581318edad8a9.jpg');
INSERT INTO `shop_goods_pic` VALUES (179, 55, '581318edaf7ea.jpg');
INSERT INTO `shop_goods_pic` VALUES (180, 55, '581318edb172a.jpg');
INSERT INTO `shop_goods_pic` VALUES (181, 56, '581319763b3ca.jpg');
INSERT INTO `shop_goods_pic` VALUES (182, 56, '581319763cf23.jpg');
INSERT INTO `shop_goods_pic` VALUES (183, 56, '581319763ea7b.jpg');
INSERT INTO `shop_goods_pic` VALUES (184, 56, '58131976409bc.jpg');
INSERT INTO `shop_goods_pic` VALUES (185, 57, '582005fa47764.jpg');
INSERT INTO `shop_goods_pic` VALUES (186, 57, '582005fa492bd.jpg');
INSERT INTO `shop_goods_pic` VALUES (187, 57, '582005fa4aa2d.jpg');
INSERT INTO `shop_goods_pic` VALUES (188, 58, '582006ac89ac1.jpg');
INSERT INTO `shop_goods_pic` VALUES (189, 58, '582006ac8e112.jpg');
INSERT INTO `shop_goods_pic` VALUES (190, 59, '582009e13c43d.jpg');
INSERT INTO `shop_goods_pic` VALUES (191, 59, '582009e13d7c5.jpg');
INSERT INTO `shop_goods_pic` VALUES (192, 59, '582009e13ef36.jpg');
INSERT INTO `shop_goods_pic` VALUES (193, 60, '58200a4e4b75b.jpg');
INSERT INTO `shop_goods_pic` VALUES (194, 60, '58200a4e4da84.jpg');
INSERT INTO `shop_goods_pic` VALUES (195, 60, '58200a4e4fdac.jpg');

-- ----------------------------
-- Table structure for shop_history
-- ----------------------------
DROP TABLE IF EXISTS `shop_history`;
CREATE TABLE `shop_history`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `mid` int(10) NOT NULL COMMENT '会员ID',
  `gid` int(10) NOT NULL COMMENT '商品ID',
  `addtime` int(10) NOT NULL COMMENT '浏览时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 123 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_history
-- ----------------------------
INSERT INTO `shop_history` VALUES (1, 4, 52, 1480578988);
INSERT INTO `shop_history` VALUES (2, 4, 34, 1479990602);
INSERT INTO `shop_history` VALUES (3, 4, 38, 1479543000);
INSERT INTO `shop_history` VALUES (4, 12, 37, 1480667748);
INSERT INTO `shop_history` VALUES (9, 12, 46, 1480332268);
INSERT INTO `shop_history` VALUES (11, 4, 59, 1480056112);
INSERT INTO `shop_history` VALUES (12, 12, 51, 1480051756);
INSERT INTO `shop_history` VALUES (13, 12, 39, 1480051780);
INSERT INTO `shop_history` VALUES (14, 12, 21, 1480577616);
INSERT INTO `shop_history` VALUES (15, 12, 17, 1479992916);
INSERT INTO `shop_history` VALUES (16, 4, 44, 1479543884);
INSERT INTO `shop_history` VALUES (17, 4, 47, 1480666893);
INSERT INTO `shop_history` VALUES (20, 12, 31, 1480397928);
INSERT INTO `shop_history` VALUES (21, 12, 19, 1479708686);
INSERT INTO `shop_history` VALUES (22, 12, 47, 1480410728);
INSERT INTO `shop_history` VALUES (23, 12, 34, 1480050914);
INSERT INTO `shop_history` VALUES (24, 12, 8, 1479994348);
INSERT INTO `shop_history` VALUES (25, 12, 30, 1479709671);
INSERT INTO `shop_history` VALUES (26, 47, 21, 1513242609);
INSERT INTO `shop_history` VALUES (27, 47, 36, 1479798409);
INSERT INTO `shop_history` VALUES (28, 47, 46, 1513239164);
INSERT INTO `shop_history` VALUES (29, 47, 26, 1513242636);
INSERT INTO `shop_history` VALUES (30, 47, 1, 1501556217);
INSERT INTO `shop_history` VALUES (31, 47, 2, 1480395900);
INSERT INTO `shop_history` VALUES (32, 47, 16, 1513242555);
INSERT INTO `shop_history` VALUES (33, 47, 4, 1523408974);
INSERT INTO `shop_history` VALUES (34, 47, 47, 1480411780);
INSERT INTO `shop_history` VALUES (35, 5, 2, 1480669159);
INSERT INTO `shop_history` VALUES (36, 5, 35, 1479987185);
INSERT INTO `shop_history` VALUES (37, 5, 34, 1479977681);
INSERT INTO `shop_history` VALUES (38, 5, 36, 1479977473);
INSERT INTO `shop_history` VALUES (39, 47, 37, 1480058041);
INSERT INTO `shop_history` VALUES (40, 47, 5, 1513242628);
INSERT INTO `shop_history` VALUES (41, 47, 6, 1513242624);
INSERT INTO `shop_history` VALUES (42, 47, 25, 1513242429);
INSERT INTO `shop_history` VALUES (43, 47, 3, 1513242393);
INSERT INTO `shop_history` VALUES (44, 4, 5, 1479990570);
INSERT INTO `shop_history` VALUES (45, 4, 4, 1480579090);
INSERT INTO `shop_history` VALUES (46, 4, 35, 1479990587);
INSERT INTO `shop_history` VALUES (47, 47, 52, 1480397129);
INSERT INTO `shop_history` VALUES (48, 47, 7, 1513242581);
INSERT INTO `shop_history` VALUES (49, 47, 51, 1479990935);
INSERT INTO `shop_history` VALUES (50, 47, 34, 1479990832);
INSERT INTO `shop_history` VALUES (51, 47, 60, 1479990893);
INSERT INTO `shop_history` VALUES (52, 47, 38, 1480054615);
INSERT INTO `shop_history` VALUES (55, 12, 44, 1480051785);
INSERT INTO `shop_history` VALUES (56, 12, 38, 1479994380);
INSERT INTO `shop_history` VALUES (57, 12, 5, 1480050942);
INSERT INTO `shop_history` VALUES (58, 12, 4, 1480668085);
INSERT INTO `shop_history` VALUES (59, 12, 3, 1480051451);
INSERT INTO `shop_history` VALUES (60, 12, 7, 1480060368);
INSERT INTO `shop_history` VALUES (61, 12, 12, 1480051463);
INSERT INTO `shop_history` VALUES (62, 12, 25, 1480407141);
INSERT INTO `shop_history` VALUES (63, 12, 52, 1480569026);
INSERT INTO `shop_history` VALUES (64, 12, 57, 1480667568);
INSERT INTO `shop_history` VALUES (65, 12, 28, 1480054149);
INSERT INTO `shop_history` VALUES (66, 12, 58, 1480398297);
INSERT INTO `shop_history` VALUES (67, 47, 11, 1501641484);
INSERT INTO `shop_history` VALUES (68, 12, 43, 1480055181);
INSERT INTO `shop_history` VALUES (69, 12, 1, 1480055238);
INSERT INTO `shop_history` VALUES (70, 4, 39, 1480056978);
INSERT INTO `shop_history` VALUES (71, 12, 2, 1480059972);
INSERT INTO `shop_history` VALUES (72, 12, 24, 1480060913);
INSERT INTO `shop_history` VALUES (73, 2, 52, 1480061333);
INSERT INTO `shop_history` VALUES (74, 47, 45, 1480411426);
INSERT INTO `shop_history` VALUES (75, 4, 54, 1480595894);
INSERT INTO `shop_history` VALUES (76, 4, 56, 1480333798);
INSERT INTO `shop_history` VALUES (77, 4, 45, 1480335712);
INSERT INTO `shop_history` VALUES (78, 2, 1, 1480395814);
INSERT INTO `shop_history` VALUES (79, 2, 5, 1480396197);
INSERT INTO `shop_history` VALUES (80, 2, 4, 1480396452);
INSERT INTO `shop_history` VALUES (81, 4, 60, 1480666791);
INSERT INTO `shop_history` VALUES (82, 12, 56, 1480667455);
INSERT INTO `shop_history` VALUES (83, 5, 38, 1480407829);
INSERT INTO `shop_history` VALUES (84, 5, 50, 1480411896);
INSERT INTO `shop_history` VALUES (85, 5, 3, 1480407749);
INSERT INTO `shop_history` VALUES (86, 5, 26, 1480407845);
INSERT INTO `shop_history` VALUES (87, 12, 36, 1480410826);
INSERT INTO `shop_history` VALUES (88, 47, 50, 1513242546);
INSERT INTO `shop_history` VALUES (89, 5, 48, 1480411856);
INSERT INTO `shop_history` VALUES (90, 5, 16, 1480412713);
INSERT INTO `shop_history` VALUES (91, 47, 32, 1511336638);
INSERT INTO `shop_history` VALUES (92, 12, 60, 1480667562);
INSERT INTO `shop_history` VALUES (93, 18, 21, 1480579466);
INSERT INTO `shop_history` VALUES (94, 4, 49, 1480577832);
INSERT INTO `shop_history` VALUES (95, 18, 4, 1480579532);
INSERT INTO `shop_history` VALUES (96, 18, 46, 1480579517);
INSERT INTO `shop_history` VALUES (97, 2, 21, 1480594537);
INSERT INTO `shop_history` VALUES (98, 4, 7, 1480656902);
INSERT INTO `shop_history` VALUES (99, 47, 43, 1480596305);
INSERT INTO `shop_history` VALUES (100, 4, 21, 1480656821);
INSERT INTO `shop_history` VALUES (101, 4, 3, 1480656734);
INSERT INTO `shop_history` VALUES (102, 12, 32, 1480667640);
INSERT INTO `shop_history` VALUES (103, 47, 49, 1480668468);
INSERT INTO `shop_history` VALUES (104, 5, 44, 1480669144);
INSERT INTO `shop_history` VALUES (105, 2, 7, 1500606052);
INSERT INTO `shop_history` VALUES (106, 52, 7, 1500606113);
INSERT INTO `shop_history` VALUES (107, 57, 7, 1500606116);
INSERT INTO `shop_history` VALUES (108, 91, 7, 1500606120);
INSERT INTO `shop_history` VALUES (109, 39, 7, 1500606126);
INSERT INTO `shop_history` VALUES (110, 92, 7, 1500606198);
INSERT INTO `shop_history` VALUES (111, 3228, 7, 1500606461);
INSERT INTO `shop_history` VALUES (112, 100, 16, 1500607702);
INSERT INTO `shop_history` VALUES (113, 47, 8, 1501641790);
INSERT INTO `shop_history` VALUES (114, 47, 15, 1501900372);
INSERT INTO `shop_history` VALUES (115, 47, 9, 1513242563);
INSERT INTO `shop_history` VALUES (116, 47, 24, 1501642203);
INSERT INTO `shop_history` VALUES (117, 47, 100, 1501640724);
INSERT INTO `shop_history` VALUES (118, 47, 10, 1513242397);
INSERT INTO `shop_history` VALUES (119, 47, 54, 1513242660);
INSERT INTO `shop_history` VALUES (120, 47, 48, 1501641404);
INSERT INTO `shop_history` VALUES (121, 47, 17, 1501641496);
INSERT INTO `shop_history` VALUES (122, 47, 35, 1501641971);

-- ----------------------------
-- Table structure for shop_integral
-- ----------------------------
DROP TABLE IF EXISTS `shop_integral`;
CREATE TABLE `shop_integral`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goodsname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `integral` int(10) UNSIGNED NULL DEFAULT NULL,
  `num` int(10) UNSIGNED NOT NULL,
  `detail` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `display` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `addtime` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_integral
-- ----------------------------
INSERT INTO `shop_integral` VALUES (1, '老阿嬷 即食香菇脆果蔬菜片香菇干蔬菜干90g', 2000, 6667, '店长推荐', 1, '1480330905', '583bb8ecb8f9a.jpg');
INSERT INTO `shop_integral` VALUES (2, '玛历德紫米面包黑米夹心奶酪切片三明治蛋糕营养早餐蒸零食品整箱', 205, 1111, '很好', 1, '1480309300', '583bba33755f1.jpg');
INSERT INTO `shop_integral` VALUES (3, '小胡鸭 香辣零食鸭脖 鸭翅 鸭爪 鸭锁骨等零食大礼包', 590, 222, '真心好', 1, '1480309375', '583bba7f59225.jpg');
INSERT INTO `shop_integral` VALUES (4, '原味坚果零食袋大礼包', 159, 88, '真好', 1, '1480309449', '583bbac8a692f.jpg');
INSERT INTO `shop_integral` VALUES (5, 'amovo魔吻原味抹茶卡拉奇 手工黑松巧克力礼盒装食品', 2000, 1000, '味道正宗', 1, '1480309192', '583bb9c76abae.jpg');
INSERT INTO `shop_integral` VALUES (6, '炎亭渔夫 休闲食品批发小吃鳕鱼丸 鱼蛋丸208g', 2000, 1000, '好吃不腻', 1, '1480309328', '583bba4fc82ff.jpg');
INSERT INTO `shop_integral` VALUES (8, '44444', 5555555, 555555555, NULL, 1, '1498289577', NULL);
INSERT INTO `shop_integral` VALUES (9, '44', 4294967295, 4294967295, NULL, 1, '1498290308', NULL);
INSERT INTO `shop_integral` VALUES (10, '999999', 4294967295, 4294967295, '99999999999', 1, '1498292615', NULL);
INSERT INTO `shop_integral` VALUES (11, '358', 358, 358, '358', 1, '1498292637', NULL);
INSERT INTO `shop_integral` VALUES (12, '89', 89, 89, '89', 1, '1498292659', NULL);
INSERT INTO `shop_integral` VALUES (13, 'totti', 200, 500, '444', 1, '1498292724', NULL);
INSERT INTO `shop_integral` VALUES (14, 'rr', 44, 44, '44', 1, '1498292954', NULL);

-- ----------------------------
-- Table structure for shop_integral_draw
-- ----------------------------
DROP TABLE IF EXISTS `shop_integral_draw`;
CREATE TABLE `shop_integral_draw`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` int(10) UNSIGNED NOT NULL,
  `addtime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_integral_draw
-- ----------------------------
INSERT INTO `shop_integral_draw` VALUES (1, 12, '2016-12-02', '35     积分');
INSERT INTO `shop_integral_draw` VALUES (2, 47, '2016-11-28', '15     积分');
INSERT INTO `shop_integral_draw` VALUES (6, 2, '2016-12-01', '20    积分');
INSERT INTO `shop_integral_draw` VALUES (7, 4, '2016-11-29', '50    积分');

-- ----------------------------
-- Table structure for shop_integral_pic
-- ----------------------------
DROP TABLE IF EXISTS `shop_integral_pic`;
CREATE TABLE `shop_integral_pic`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `iid` int(10) UNSIGNED NOT NULL,
  `picname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_integral_pic
-- ----------------------------
INSERT INTO `shop_integral_pic` VALUES (1, 1, '583bb8ef32f9e.jpg');
INSERT INTO `shop_integral_pic` VALUES (2, 1, '583bb8f178969.jpg');
INSERT INTO `shop_integral_pic` VALUES (3, 1, '583bb8f3aba4f.jpg');
INSERT INTO `shop_integral_pic` VALUES (4, 2, '583bba34a6b46.jpg');
INSERT INTO `shop_integral_pic` VALUES (5, 2, '583bba35a540f.jpg');
INSERT INTO `shop_integral_pic` VALUES (6, 3, '583bba80c3998.jpg');
INSERT INTO `shop_integral_pic` VALUES (7, 3, '583bba818cec4.jpg');
INSERT INTO `shop_integral_pic` VALUES (8, 4, '583bbac9a369f.jpg');
INSERT INTO `shop_integral_pic` VALUES (9, 4, '583bbaca80450.jpg');
INSERT INTO `shop_integral_pic` VALUES (10, 5, '583bb9c912213.jpg');
INSERT INTO `shop_integral_pic` VALUES (11, 5, '583bb9ca18fae.jpg');
INSERT INTO `shop_integral_pic` VALUES (12, 5, '583bb9cb42801.jpg');
INSERT INTO `shop_integral_pic` VALUES (13, 6, '583bba511dcb9.jpg');
INSERT INTO `shop_integral_pic` VALUES (14, 6, '583bba522c756.jpg');
INSERT INTO `shop_integral_pic` VALUES (15, 6, '583bba531b61b.jpg');

-- ----------------------------
-- Table structure for shop_level
-- ----------------------------
DROP TABLE IF EXISTS `shop_level`;
CREATE TABLE `shop_level`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '等级ID',
  `level_name` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '等级名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_level
-- ----------------------------
INSERT INTO `shop_level` VALUES (1, '普通会员');
INSERT INTO `shop_level` VALUES (2, '黄铜会员');
INSERT INTO `shop_level` VALUES (3, '白银会员');
INSERT INTO `shop_level` VALUES (4, '黄金会员');
INSERT INTO `shop_level` VALUES (5, '钻石会员');

-- ----------------------------
-- Table structure for shop_member
-- ----------------------------
DROP TABLE IF EXISTS `shop_member`;
CREATE TABLE `shop_member`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint(2) UNSIGNED NULL DEFAULT 2 COMMENT '0代表男，1代表女，2代表保密',
  `level` tinyint(2) NULL DEFAULT 1,
  `money` float(10, 2) NULL DEFAULT NULL,
  `costs` float(10, 2) NULL DEFAULT NULL,
  `credit` int(11) NULL DEFAULT NULL COMMENT '积分',
  `qq` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否禁用',
  `addtime` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '注册时间',
  `pic` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `paypwd` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '123456' COMMENT '账户的支付密码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_member
-- ----------------------------
INSERT INTO `shop_member` VALUES (1, '超级超级赛亚人', '7fa8282ad93047a4d6fe6111c93b308a', 1, 5, 1986067.25, 13932.79, 1392, 'f4dfff82f02316031abea33dfcec5bc1', '', '', 1, '1477454169', '582c0af9aa425.jpg', '111111');
INSERT INTO `shop_member` VALUES (2, '李立新', '96e79218965eb72c92a549dd5a330112', 2, 5, 184695.20, 15304.80, 170, '123456', '15543234866', '1234567@qq.com', 1, '1477454204', '583fce508e9b2.gif', '123456');
INSERT INTO `shop_member` VALUES (4, '栗飞', '96e79218965eb72c92a549dd5a330112', 2, 5, 1050126.00, 12507.75, 125, NULL, NULL, NULL, 1, '1477454266', NULL, '123456');
INSERT INTO `shop_member` VALUES (5, '姚发强', '96e79218965eb72c92a549dd5a330112', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1477454311', NULL, '123456');
INSERT INTO `shop_member` VALUES (6, '小小', '96e79218965eb72c92a549dd5a330112', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1477454337', NULL, '123456');
INSERT INTO `shop_member` VALUES (8, '小明', '7fa8282ad93047a4d6fe6111c93b308a', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1477454395', NULL, '123456');
INSERT INTO `shop_member` VALUES (9, '小刚', '96e79218965eb72c92a549dd5a330112', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1477454422', NULL, '123456');
INSERT INTO `shop_member` VALUES (10, '小李', '96e79218965eb72c92a549dd5a330112', 2, 3, 44440.00, 5560.00, 556, NULL, NULL, NULL, 1, '1477457239', NULL, '123456');
INSERT INTO `shop_member` VALUES (11, '小龙', '96e79218965eb72c92a549dd5a330112', 2, 5, 9960.00, 50040.00, 5004, NULL, NULL, NULL, 1, '1477457264', NULL, '123456');
INSERT INTO `shop_member` VALUES (12, '杨晶', '96e79218965eb72c92a549dd5a330112', 2, 3, 19517.28, 6575.22, 856, '591813762', '13140645359', '591813762@qq.com', 1, '1477457462', '58413174ddfa3.jpg', '123456');
INSERT INTO `shop_member` VALUES (14, '帝释天', '96e79218965eb72c92a549dd5a330112', 2, 2, 2310620.00, 3614.00, 361, NULL, NULL, NULL, 1, '1477457462', NULL, '123456');
INSERT INTO `shop_member` VALUES (17, 'yj1', '96e79218965eb72c92a549dd5a330112', 2, 2, NULL, 3320.00, NULL, '591813762', '13140645359', '131313@qq.com', 1, '1477457567', '583fcdfa2a1fd.png', '123456');
INSERT INTO `shop_member` VALUES (18, 'xiaoying', '96e79218965eb72c92a549dd5a330112', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1477457591', '583fcf1aef613.png', '123456');
INSERT INTO `shop_member` VALUES (20, '小小白', '96e79218965eb72c92a549dd5a330112', 2, 2, NULL, 3650.00, NULL, NULL, NULL, NULL, 1, '1477465520', NULL, '123456');
INSERT INTO `shop_member` VALUES (23, '小小熊啊', '96e79218965eb72c92a549dd5a330112', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1477530548', NULL, '123456');
INSERT INTO `shop_member` VALUES (45, 'lifei', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1479124791', NULL, '123456');
INSERT INTO `shop_member` VALUES (47, '小夏', '96e79218965eb72c92a549dd5a330112', 2, 1, 11916.79, 305.21, 1415, 'qqQXFSwsCnr7A', '', '', 1, '1479283416', '583e749c7de52.png', '123456');
INSERT INTO `shop_member` VALUES (48, 'xiaoxiao', '1bbd886460827015e5d605ed44252251', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1479285421', '582c1caddba18.jpg', '123456');
INSERT INTO `shop_member` VALUES (49, '美丽可爱小杨晶', 'b0baee9d279d34fa1dfd71aadb908c3f', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1479288805', NULL, '123456');
INSERT INTO `shop_member` VALUES (53, 'haha', '101a6ec9f938885df0a44f20458d2eb4', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1479461610', NULL, '123456');
INSERT INTO `shop_member` VALUES (54, 'xxx', '96e79218965eb72c92a549dd5a330112', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1479539765', NULL, '123456');
INSERT INTO `shop_member` VALUES (55, 'totti', '27bbfb70112bb208ffee732d6b4e7825', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1499680960', NULL, '123456');

-- ----------------------------
-- Table structure for shop_message
-- ----------------------------
DROP TABLE IF EXISTS `shop_message`;
CREATE TABLE `shop_message`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '系统' COMMENT '发送人',
  `message` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '发送信息',
  `mid` int(10) NOT NULL COMMENT '接收人（会员ID）',
  `addtime` int(10) NOT NULL COMMENT '发送时间',
  `msgstatus` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1代表已读状态，0代表未读状态',
  `ag_id` int(10) NOT NULL COMMENT '拍卖表主键ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_message
-- ----------------------------
INSERT INTO `shop_message` VALUES (1, '系统', '恭喜你获得该宝贝，请去我的拍卖查看，付款，逾期将扣除保证金，谢谢合作', 4, 1480595179, 0, 1);
INSERT INTO `shop_message` VALUES (2, '系统', '恭喜你获得该宝贝，请去我的拍卖查看，付款，逾期将扣除保证金，谢谢合作', 47, 1480666710, 0, 9);

-- ----------------------------
-- Table structure for shop_news
-- ----------------------------
DROP TABLE IF EXISTS `shop_news`;
CREATE TABLE `shop_news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '新闻ID',
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '新闻标题',
  `author` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '新闻作者',
  `clicknum` smallint(6) NULL DEFAULT NULL COMMENT '点击数量',
  `commentnum` smallint(6) NULL DEFAULT NULL COMMENT '评论数量',
  `likenum` smallint(6) NULL DEFAULT NULL COMMENT '点赞数量',
  `top` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否置顶',
  `isshow` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '新闻内容',
  `iscomment` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否评论，0代表未评论，1代表已评论',
  `addtime` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_news
-- ----------------------------
INSERT INTO `shop_news` VALUES (1, '最新的双十一活动简介', '栗飞', NULL, NULL, NULL, 0, 1, '科比退役了', 1, 1477269491);
INSERT INTO `shop_news` VALUES (2, '关于购物流程的详细解答', '栗飞', NULL, NULL, NULL, 1, 1, '今天是个好日子', 1, 1477269514);
INSERT INTO `shop_news` VALUES (3, '致亲爱的广大本店顾客的一封信', '栗飞', NULL, NULL, NULL, 1, 0, '南海事件持续升级', 0, 1477269550);
INSERT INTO `shop_news` VALUES (4, '对于商城抽奖活动的详细解答', '马云', NULL, NULL, NULL, 1, 1, 'aaaaaaaaaa', 0, 1477272202);
INSERT INTO `shop_news` VALUES (5, '商城意见征集专题', '小飞', NULL, NULL, NULL, 1, 0, 'ccccccccccccc', 0, 1477278721);
INSERT INTO `shop_news` VALUES (6, '谢谢大家对本小店的支持', '小李', NULL, NULL, 2, 1, 1, 'gff', 0, 1477559727);
INSERT INTO `shop_news` VALUES (7, '水果降价啦都来买', '马云', NULL, NULL, 10, 1, 1, '大家一起买', 0, 1477278821);
INSERT INTO `shop_news` VALUES (8, '关于商城的积分兑换规则', '小云', NULL, NULL, NULL, 1, 1, '限时特价', 0, 1477278000);
INSERT INTO `shop_news` VALUES (9, '怎么开网店', '小王', NULL, NULL, 15, 1, 1, '首先看你的淘宝店铺最主要是卖什么的，根据你店铺商品的特定写一些话，再写上一些关于你的产品的质量，进货渠道等，最后再写上一些优惠活动等。\r\n\r\n\r\n\r\n你也可以多去淘宝上几个砖或皇冠的看看，参考参考就知道应该怎么写了!看看别人为什么人气那么高，然后在自己这里变通变通。呵呵，另外店铺介绍虽然重要，但更为重要的是别人怎么样才能找到你的小店。店铺都找不到的话，那介绍写得再好也只有自己在看了_ 呵呵，建议应该去学学怎么发布商品，怎么宣传推广你的店铺，使你的店铺有更高的点击率 。\r\n\r\n\r\n\r\n再给你几个方案参考：\r\n\r\n方案一：我是新卖家，别的不敢说，货的质量你绝对放心，皮肤是女人多么重要的东西，咱们都知道，大家都是女人，绝对推荐给大家物美价廉的好dd!\r\n\r\n\r\n\r\n方案二：大家好欢迎大家光临**美妆屋~很高兴认识各位朋友噢~因为喜欢所以努力!希望大家多多捧场.\r\n\r\n\r\n\r\n方案三：我店产品全部来自正规的渠道，以最直接有效的方式送达最终端消费者手里，避免了中间过多的流通环节。并且本店一直是以薄利多销为原则，在有合理利润的基础下将尽最大可能让利给大家，所以才会比专柜便宜许多!!\r\n\r\n\r\n\r\n一、简洁型的淘宝店铺介绍书写方式：\r\n\r\n只写上一句话或一段话，再加上淘宝平台默认名片式的基本信息，和联系方式。简单明了。例如：\r\n\r\n1、欢迎光临本店，本店新开张，诚信经营，只赚信誉不赚钱，谢谢。\r\n\r\n2、本店商品均属正品，假一罚十信誉保证。 欢迎广大顾客前来放心选购，我们将竭诚为您服务!\r\n\r\n3、本店专门营销什么什么商品，假一罚十信誉保证。本店的服务宗旨是用心服务，以诚待人!\r\n\r\n\r\n\r\n二、消息型的淘宝店铺介绍数学方式：\r\n\r\n就是将店铺最新的优惠活动发布在淘宝店铺介绍里，这种类型不但能吸引喜欢优惠活动的新买家，如果是时间段优惠更能促使买家下定决心，尽快购买。\r\n\r\n\r\n\r\n三、独特型的淘宝店铺介绍书写方式：\r\n\r\n你可以把你产品的优势，服务的优势，或者店铺的特点写出来，就算实在找不出，就自己创造广告语。比如写一首幽默的打油诗之类的也行!\r\n\r\n\r\n\r\n四、详细型的淘宝店铺介绍书写方式：\r\n\r\n你不可能知道每个买家到你的淘宝店铺介绍页面里想了解什么，可以考虑把所有的都写进去。另外，还有购物流程、联系方式、物流方式、售后服务、温馨提示等等都统统写上去。但是一定要花时间好好排版。内容多，字体不能太大，正常就可以了，然后一段内容的标题要加粗或者加上颜色，比如给售后服务加粗，然后售后服务的内容则用正常字体，这样每段内容配上一个加粗标题，买家一点进淘宝店铺介绍，第一眼明显看到的都是几个加粗标题，能很快找到自己想了解的就有耐心看下去。就像本篇文章一样，没有一些加粗的字体，读者不从头读起，就找不到各段内容的主要针对点。\r\n\r\n\r\n\r\n五、参照别人的书写格式：\r\n\r\n看看一些皇冠店铺或者钻石卖家都是怎么写的，或者有时间去街上逛逛收集一些实体店的店铺介绍，再结合自己的情况，写出适合自己的淘宝店铺介绍。好的淘宝店铺介绍虽然起不到非常大的作用，但也能给你的店铺加分，所以花一点时间认真写好淘宝店铺介绍也是值得的。\r\n', 0, 1478231462);
INSERT INTO `shop_news` VALUES (10, '双十一来了你还不心动吗', '夏天', NULL, NULL, 2, 0, 1, '   双十一购物狂欢节是指每年11月11日（光棍节）的网络促销日。在这一天，许多网络商家会进行大规模促销活动。\r\n   双十一网购狂欢节源于淘宝商城（天猫）2009年11月11日举办的促销活动，当时参与的商家数量和促销力度均是有限，但营业额远超预想的效果，于是11月11日成为天猫举办大规模促销活动的固定日期。近年来双十一已成为中国电子商务行业的年度盛事，并且逐渐影响到国际电子商务行业。\r\n“双十一”不仅让电商热衷于促销，就连运营商也开始搞促销活动了。2015年11月9日至11月19日，中国联通在联通网上营业厅、手机营业厅、天猫旗舰店及京东商城等多个平台同时开展“11.11沃4G狂欢节”活动。[1]  2014年11月11日，阿里巴巴双十一全天交易额571亿元。[2]  2015年11月11日，天猫双十一全天交易额912.17亿元。[3]  2016年10月24日0点，天猫双11红包正式开抢，时间为2016年10月24日00:00:00至2016年11月10日23:59:59。[4] \r\n  中文名 双十一购物狂欢节、全球狂欢节 外文名 Double 11 shopping carnival 活动时间 11月11日00：00-23：59：59 起    源 2009年11月11日的淘宝商城\r\n目录\r\n1 起源\r\n2 2014年\r\n▪ 销售数据\r\n▪ 全球化\r\n▪ 物流\r\n▪ 云计算\r\n▪ 成交额排名\r\n3 2015年\r\n▪ 销售数据\r\n▪ 诸多记录\r\n▪ 全球化\r\n4 2016年\r\n▪ 活动时间\r\n▪ 面值数量\r\n▪ 使用时间\r\n▪ 使用规则\r\n5 各方评价\r\n6 数据解读\r\n▪ 交易额\r\n▪ 无线交易\r\n7 物流保障\r\n8 注意事项\r\n起源编辑\r\n双十一网购狂欢节源于淘宝商城（天猫）2009年11月11日举办的促销活动，当时参与的商家数量和促销力度均有限，但营业额远超预想的效果，于是11月11日成为天猫举办大规模促销活动的固定日期。[5] \r\n', 0, 1478233959);
INSERT INTO `shop_news` VALUES (11, '美文欣赏', '店小二', NULL, NULL, 3, 1, 1, '     我的衡量尺度是，一个人、一个民族在何种程度上能够激发起自己身上最可怕的欲望，并且转向自己的福乐，又没有因之而毁灭掉：而倒是转向了自己卓有成果的行为和功业。把所有不幸事件解释为那些未和解的心灵的作用，这乃是迄今为止促使大众走向宗教迷信的做法。即便更高的道德生活，圣徒的生活，也只不过是为了满足未和解的心灵而被虚构出来的手段之一。把我们的体验解释为一种善良的、具有教育作用的神性的天意暗示，也包括我们的不幸事件：父系的上帝概念的发展，从父权家庭出发。人类的绝对堕落，向善的不自由状态，因而用坏良心来解释我们的所有行动：最后是恩典。奇迹行为。突发的悔改。保罗、奥古斯丁、路德。日耳曼人对基督教的野蛮化：中介性的神祗，以及众多赎罪迷信，简言之，重又出现了前基督教的立场。作曲体系亦然。路德复述了基督教的基本逻辑，道德的不可能性因而也包括自我满足的不可能性，恩典的必然性因而也包括奇迹以及命定的必然性。根本上，是一种抑制状态的告白以及一种自我蔑视的发作。“要偿还自己的罪责是不可能的”，救恩欲望以及迷信和神秘的发作。“要摆脱自己的罪恶是不可能的”，保罗、奥古斯丁、路德的基督教的发作。从前，外在的不幸乃是宗教虔诚的推动力：后来则是内心的不幸感、未得救状态、畏惧、不安全感。看起来使基督和佛陀出人头地的东西：似乎正是内心的幸福使他们变得虔诚\r\n\r\n但愿没有人相信，人们有朝一日会突然双脚跳进这样一种热烈的心灵状态之中，后者的标志或比喻可能是一支刚刚唱完的舞曲。在学习这样一种舞蹈之前，人们必须已经完全学会了行走和跑步；而且，在我看来，始终只有少数人是命定能够做到自立的。在人们首先敢于靠自己的四肢走出去，没有襻带和扶手，在自己春天的充满最初青春力量和形形色色诱惑的时期里，人们已经受到了最恶劣的危害，经常颤抖不已，灰心丧气，犹如一个逃亡者，犹如一个被流放者，带着一颗战栗的良心，以及对自己道路的奇特怀疑：如果朝气蓬勃的精神自由就像一瓶葡萄酒\r\n\r\n一个头脑清醒的人在饥饿的时候不会用他最后的一块钱去买食物之外的东西。但一旦他衣食无忧、安居乐业，就可能会在电动剃须刀和电动牙刷中挑挑拣拣，他便可以被说动去做一个选择了。除了价格和成本，消费者的需求就成了需要管理的问题', 0, 1478261292);
INSERT INTO `shop_news` VALUES (12, '关于网络这条路', '店小三', NULL, NULL, 68, 1, 1, ' 搞这个个人网站可以说纯粹就是一时兴起，让朋友帮我买了域名和空间，由于自己在搞网站上不懂技术，所以这个网站用的是个人博客模板，主要是分享自己在某方面的心得。\r\n2\r\n 刚开始几个月自己是带着激情去原创博客里的文章，网站在前几个月也取得不错的进步，最大的进步就是在百度输入自己个人博客的名字可以在第一页第一个找到。那时感觉自己已经成功了，见到自己的朋友就说自己弄了一个网站，让他们去看看我的网站什么的。还有就是到自己的空间、微博等发布自己个人网站的信息，为的是能够让大家知道我这个网站。\r\n 就这样网站在前几个月自己的努力下也有一点小流量，平均每天在100个IP左右，那时也申请了广告。由于我这个个人博客网站买的域名和空间都是在国外网站上买的，在国内没有备案，所以当时就只申请了GG广告。还记得当时申请好GG广告后，那时别提有多兴奋，感觉就等着赚钱了。\r\n在这里想插一句，可以说99%的个人网站的站长都是想通过个人网站来赚钱的，没有哪个个人站长是想免费为互联网来做贡献。就是为了赚钱，作为个人站长不仅需要每天更新网站的内容，还要为网站的推广每天不辞辛劳的努力奉献自己的业余时间。\r\n当时自己的个人博客放了GG广告后，为了能够提高网站的IP，我每天几乎所有的业余时间都在弄这个网站，有时候上班也在弄这个网站。当时为了弄这个个人网站我的疯狂程度已经达到，不管是在单位还是在家里，只要用电脑，就弄自己的网站。可以说弄这个个人网站已经成为我的主业，上班反倒是成为我的副业。自从弄了这个网站后，我与家里的人交流的机会都少了，那时我总认为我的网站总有一天能够成为一个流量很高的网站，很快我就可以通过这个网站获取收入。曾经我还想过，要是这个网站有很多收入的时候，我就可以不上班，就在家里弄网站就可以了。为了弄这个网站，我与家里人吵架，因为家人看我太疯狂了，每天除了到单位上班，回到家就是弄网站，简直就是疯子。那个时候也许是信念，也许是有激情，也许是当时太年轻，考虑的太少。\r\n从第一个网站到今天已经2年了，现在这个网站我已经不再更新，网站租用的空间我也不再续费了，这个网站也彻底关闭了。所有这一切就是想告诉做个人网站的朋友们，个人网站没有前途。除非你的网站很有特色，这个特色要求很高，比如说你的个人网站可以帮助很多人，而且别人不可以复制等等很多优点，那么你做的个人网站才有机会成功。因为个人网站无法和大网站相比，不管是在人力、物力、财力、创新能力上，都是没办法比较。\r\n用我的经历来告诉你个人网站有没有前途\r\n本来这篇文章我是想些很多的，但是由于个人的文字功底有限，最后再总结一下，个人网站为什么没有前途，绝对是本人的轻身实例：\r\n用我的经历来告诉你个人网站有没有前途\r\n1、个人站长对于网站的内容，能够保持持续不断的更新吗？很显然不能，刚开始做站的时候站长们都可以原创自己网站的内容，后续就开始伪原创，再后来就抄袭，最后就复制粘帖。因为个人的创新能力实在是有限！\r\n用我的经历来告诉你个人网站有没有前途\r\n 2、个人站长的精力有限，个人站长一天只有24小时，一个大脑、一双手……，要让网站不断的更新以及推广靠个人站长是完全做不到，不管你的精力多强，最终的结果就是站长累死在电脑前。\r\n用我的经历来告诉你个人网站有没有前途\r\n 3、个人站长的财力，弄个个人网站买个域名和租用空间一般的话在一年1000元左右的支出，似乎一年1000元还可以，但是个人站长有没有考虑过，在一直没有收入的前提下，每年都支出1000元你认为值得的吗？作为个人站长做个人网站的初衷是什么呢？还不就是为了赚钱，不就是因为个人站长没有钱，才想通过写个人博客来赚钱，一般的个人站长都不是很富裕。\r\n用我的经历来告诉你个人网站有没有前途\r\n 4、个人站长耐不住寂寞，曾经有人跟我说，网站是靠养的，我也深知这个道理。但是个人站长能够坚持一年、两年，甚至三年，那问问自己能够坚持5年或者10年吗？你能坚持的了吗？坚持5年或者10年只是有机会成功，并不是一定能够成功，这个还要看网站的内容。\r\n用我的经历来告诉你个人网站有没有前途\r\n 以上4点为本人经历，告诉那些想要做个人网站或者个人博客的站长朋友们，不要再浪费时间了，个人网站真的没有前途。我是真正坚持了2年，而且这2年我努力了，到现在我还是放弃了，为什么，因为真的没有前途，不要再去做了。\r\n用我的经历来告诉你个人网站有没有前途', 0, 1478261501);
INSERT INTO `shop_news` VALUES (13, '英雄联盟', '小夏', NULL, NULL, 105, 1, 1, '《英雄联盟》（简称lol）是由美国Riot Games开发，中国大陆地区由腾讯游戏运营的网络游戏。\r\n《英雄联盟》除了即时战略、团队作战外，还拥有一百多位特色各异的英雄、丰富的地图及玩法、自动匹配的战网平台，包括天赋树、召唤师系统、符文等元素。[1] \r\n2014年1月，根据官方数据显示，LOL全球最高同时在线已突破750万，全球日活跃高达2700万，全球月活跃已达6700万，注册用户亿计，LOL已经成为当今世界最具人气和影响力的网络游戏之一。\r\n中文名 英雄联盟 原版名称 League of Legends 其他名称 撸啊撸、lol 游戏类型 MOBA 游戏平台Microsoft Windows \r\nMac OS X 开发商 Riot Games 发行商 Riot Games 发行日期 国服：2011年9月22日 发行日期 美服：2009年10月27日 制作人 Steven Snow，Travis George 总    监 Tom Cadwell，Shawn Carnes 编    剧 George Krstic 音    乐 Christian Linke 玩家人数 多人 游戏画面 3D 分    级 T(ESRB) \r\n12(PEGI)\r\n目录\r\n1 背景简介\r\n▪ 符文之地与魔法\r\n▪ 英雄联盟的历史\r\n▪ 战争学院\r\n▪ 诺克萨斯\r\n▪ 德玛西亚\r\n▪ 班德尔城\r\n▪ 艾欧尼亚\r\n▪ 弗雷尔卓德\r\n▪ 皮尔特沃夫\r\n▪ 比尔吉沃特\r\n▪ 祖安\r\n▪ 巨神峰\r\n▪ 恕瑞玛\r\n▪ 暗影岛\r\n2 游戏系统\r\n▪ 匹配系统\r\n▪ 天赋系统\r\n▪ 符文系统\r\n▪ 召唤师技能\r\n▪ 排位赛\r\n▪ 好友系统\r\n▪ 观战系统\r\n▪ 直播系统\r\n▪ 海克斯科技战利品库\r\n3 地图/模式\r\n4 英雄列表\r\n5 物品资料\r\n▪ 消耗品项\r\n▪ 特殊装备\r\n▪ 英雄专属\r\n▪ 输出系统\r\n▪ 生存辅助\r\n▪ 打野装备\r\n▪ 工资装/饰品\r\n6 中立资源\r\n7 术语解释\r\n▪ 团战定位\r\n▪ 地图术语\r\n▪ 兵线术语\r\n▪ 其他术语\r\n8 游戏赛事\r\n9 开发团队\r\n10 配置需求\r\n11 音乐专辑\r\n12 获奖记录\r\n背景简介\r\n符文之地与魔法\r\n在符文之地，魔法就是一切。\r\n在这里，魔法不只是一种神秘莫测的能量概念。它\r\n是实体化的物质，可以被引导、成形、塑造和操作。符文之地的魔法拥有自己的自然法则。源生态魔法随机变化的结果改变了科学法则。\r\n符文之地有数块大陆，不过所有的生命都集中在最大魔法大陆——瓦罗兰。瓦罗兰大陆居于符文之地中心，是符文之地面积最大的大陆。\r\n被祝福的符文之地上有大量源生态魔法能量，而此地居民可以触及其中的能量。符文之地的中心区域集中了数量巨大的源生态魔法能量，这些地方都是水晶枢纽的理想位置。水晶枢纽可以将源生能量塑形为自身实体化的存在。此外，水晶枢纽还可以成为能量车间，为需要魔法能量的建筑供能。水晶枢纽遍布符文之地，但最大的水晶枢纽都坐落在瓦罗兰大陆。[2] \r\n英雄联盟的历史\r\n直到二十年前，符文之地才从战乱中解脱。这片大陆上的人民自远古以来就习惯结群而斗，用战争解决纷争。而不论何时，战争的工具始终都是魔法。\r\n军队用法术和符文武装自己，英雄们打造出大部分魔法物品率领部队彼此厮杀。召唤者，瓦罗兰大陆的实际领导者们，他们疯狂使用魔法能量攻击敌人的部队和支持者。他们拥有近乎无限的原始魔法力量使用，从未考虑过无止境的滥用魔法会给这片大陆的环境带来怎么样的灾难。[3] \r\n然而近200年来无止境的魔法滥用让瓦罗兰的人民看到了符文之地的脆弱\r\n现状。最后两次符文之战剧烈影响了瓦罗兰的地质环境，尽管人们试图聚集魔法能量来恢复这灾难性的后果，却毫无作用。剧烈的地震和恐怖的魔法风暴让整个瓦罗兰为之颤抖，对人们来说这份恐惧远超过战争的可怖。人们终于意识到世界已经承受不起符文之战的破坏。为了回应世界上不断恶化的政治和经济危机，瓦罗兰的大法师们——包括许多强大的召唤者——达成共识，所有的冲突必须以可控和系统化的方式来处理。[3] \r\n他们成立了一个叫“英雄联盟”的组织，目的在于监督瓦罗兰的政治纷争得以有序处理。位于战争学院的英雄联盟获得了瓦罗兰政治实体们的陆续授权，这个组织将管理处置所有政治纷争带来的结果，英雄联盟决定所有主要的政治争论都必须通过特别设立在瓦罗兰各地的竞技场来处理。拥有不同政见的召唤者们各自召唤一个英雄，这些英雄们则带领没有心智意识的小兵进行战斗，这些小兵由初阶召唤者通过召唤节点制造。[3] \r\n战争学院\r\n战争学院是英雄联盟裁决瓦罗兰政治纠纷之地。这里是绝\r\n对中立的领土，严禁任何纷争。违反者将面对学院的士兵和魔法。学院坐落于一座巨型水晶枢纽之上，由黑曜石、贵金属和魔法塑形而成。它位于莫格罗恩关隘的北方入口，刚好位于相互敌对的城邦德玛西亚和诺克萨斯之间。\r\n除了作为英雄联盟所在地，战争学院还是瓦罗兰最权威的军事培训机构。很多图书馆都致力于收录战争学院的英雄信息，并向所有研究者开放。[2] \r\n战争学院内部是马约里斯秘术中心，部分是魔法学校，部分是法术储藏地，还有一部分是雇佣经纪处。马约里斯秘术中心是召唤师们交易游戏金币的中心，无论新手还是大师都可以在这里花费自己从正义之地挣得的金币，换取他们感兴趣的物件。召唤师可以在此消耗金币，换取召唤新保卫者化身的能力。[2] \r\n诺克萨斯\r\n人类城邦诺克萨斯坐落在瓦罗兰大陆远东中心，它在道德准则上和德玛西亚对比大相径庭。这个城市无论在物质上还是精神上都不择手段的追求强大权力，丝毫不顾对别人带来的影响。\r\n\r\n就诺克萨斯居民的素质而言，基本都是这条准则的支持者。虽然看起来很残酷，不过并非就是混乱的标志。由于人之本性，诺克萨斯是一个有序的城邦，保护局面不受侵害，至少不受同类侵害。不过在诺克萨斯，有权者受到法律的明显偏袒保护。此地政治上的最高统治机构是诺克萨斯最高统帅部，这也是该国最高军事权力机构。在诺克萨斯，军队控制着政治版图的方方面面；战争和政治没有明显的分界线。[2-3] \r\n德玛西亚\r\n人类城邦德玛西亚坐落在瓦罗兰的西部海岸。德玛西亚人民的共同目标是通过善良和正义让所有人都过得更\r\n好。他们认为恶毒自私如同疾病，应当从人类灵魂中根除。来到德玛西亚并定居于此的人们，具有和本地居民一样的理想和美德。损人利己的人很快会发现，在这里他们下场是放逐或者更糟。\r\n德玛西亚是一座闪亮的灯塔，放射出人性的希望之光，这座城市本身即为信念的直观展示。城市看上去纯净质朴，高耸的尖塔点缀着德玛西亚的地平线。\r\n德玛西亚是最早支持英雄联盟的城邦之一，不过他们的出发点不是维护星球的稳定性，更多的是处于对诺克萨斯对瓦罗兰威胁的担忧。[2-3] \r\n班德尔城\r\n班德尔城是符文之地最古老的城邦，它的历史比德玛西亚和诺克萨斯还早。班德尔城也是瓦洛兰最与世隔绝的城邦——约德尔人喜欢这样。虽然约德尔人非常友好互助，不过城市的天然自我保护性却阻碍了他们享受生\r\n活。班德尔城市斥候熟知黑貂山脉每一个角落与缝隙，他们的职责是确保每一位有着合法理由的冒险者，让他们可以安全完成任务。斥候们沿着一条精心维护的道路巡视着整个盆地。斥候们甚至还保持着四通八达的地下通道网络，可以迅速穿越盆地峡谷，挫败敌人试图越过山脉计划，或是迅速到达喧嚣的海岸线。\r\n班德尔城是瓦罗兰人口最少的城邦之一，不过他们的影响力早已越过山脉南部，一直传达到守护者之海海岸。班德尔城外无数农场和小型村落点缀在如画风景中。[2-3] \r\n艾欧尼亚\r\n艾欧尼亚位于瓦罗兰大陆之外，诺克萨斯东北。虽然该国的主要人口组成是人类，但部分约德尔人和其他世界性种族也将这里视为家园。艾欧尼亚有许多宗教中心和学校。\r\n艾欧尼亚法院是全瓦罗兰公认的公平和中立的典范。所以艾欧尼亚审判官是除了英雄联盟审判者之外最受青睐的职位。\r\n艾欧尼亚长期以来一直申明对瓦罗兰的政治事务保持中立，不过这一姿态并不能让艾欧尼亚远离大陆的纷争。人类强权城邦诺克萨斯已经将征服目标转向了艾欧尼亚。在英雄联盟有能力全面影响瓦洛兰的政治事务之前，诺克萨斯已经发动了旨在征服艾欧尼亚的一系列战役。艾欧尼亚成功挡住了诺克萨斯最高指挥部的攻击。事实上，诺克萨斯和艾欧尼亚之间胶着的战事，以及诺克萨斯试图将战争升级的后续举动是联盟成立的主要诱因之一。[2-3] \r\n弗雷尔卓德\r\n坐落于瓦罗兰大陆西北方的永冻苔原。早期因为内部纷争加上地处边疆，导致居住于此的种族不喜欢与外界往来，独然而居。在种种因素与诺克萨斯的推力下，让他们成为了瓦罗兰大陆中，第八个也是最新的一座城邦。弗雷尔卓德是冰雪风暴之乡。\r\n\r\n这是一个无情的地方，山地长年被冰雪所覆盖。弗雷尔卓德位于瓦罗兰大陆北部冻苔原地带，来这里旅游，特别是在冬季，是非常危险的。在这里有一个世上最大的冰雪漩涡，包围着整个大陆的北方。弗雷尔卓德人经历了多年的战争。在这一代，由传奇三姐妹分别带领着各自的部落而战，分别是——阿瓦罗萨部落的艾希公主、寒冬之爪部落的瑟庄妮公主，以及玛芙乐公主统一苦行僧部落。[2] \r\n皮尔特沃夫\r\n皮尔特沃夫是瓦罗兰北部的和平城邦，致力于推动科学技术的发展。当然在皮尔特沃夫境内也存在有魔法，不过科技得到了更广泛的使用，并成为居民的首选。“魔法是科技引擎的燃料”这是皮尔特沃夫的大众常识。海克斯科技即为皮尔特沃夫的法律准则。\r\n\r\n在皮尔特沃夫领导人的眼里，符文之战让整个星球的居民都滥用魔法，并将最终导致星球的崩溃。皮尔特沃夫的科研机构将此视为至关生死的重要事务，时刻保持关注。他们认为，祖安肆意滥用魔法，不顾过去的教训，用星球的未来换取眼前的知识和权力。[2-3] \r\n比尔吉沃特\r\n蓝焰岛是一个错误的古称，实际上蓝焰岛是瓦洛兰大陆约德尔城东部海岸线外三个独立岛屿的总称。在第三次符文之战期间，最大的一场战争引发的毁灭性魔法力量将岛屿撕成碎片。一枚附有高度不稳定的魔法超大稀有金属炸弹落在了岛上，引发了爆炸。后续的爆炸不仅将岛上驻军毁灭殆尽，爆炸产生的高温也融化了一切，为岛屿覆加了一层外壳。魔法混入岩浆，从支离破碎的土地表面喷射出来。\r\n比尔吉沃特是蓝焰岛上的扩展建筑，一直到八十年前才发现的。它位\r\n于三个岛最大的一座，拥有一个宽广且易守难攻的天然港口，面向东部海岸。三岛链中最大的岛屿仍是最稳固的。比尔吉沃特可以扩展开来成为一个真正的城邦。城镇无法成为一个政治实体，因为这里是瓦罗兰那些早已建立的王国的庇护所。政治和地理环境使得这里最终成为了海盗的避难所，并发展成为符文之地最无法无天的海上走私中心。无数海盗抛锚于比尔吉沃特。符文之地海域无数海盗的到来也让这座城市发展成为一个非官方的贸易中心，在这里你可以找到各种珍惜物品，甚至是违禁品。[2] \r\n祖安\r\n祖安是位于瓦罗兰北部被滥用的科技和魔法所扭曲的城邦。无数声名狼藉的恐怖科技和魔法创造发明于此。事实上，祖安政府成立的初衷即为保护祖安的实验不受反对力量的阻扰。建立这座城市的灵魂人物们，当初亦是为了从皮特沃夫保守的法律下追求学术自由而来到这里。祖安拥有优良的科学研究，不过对科学和魔法研究松散放纵的管理和控制，让祖安成为一个危险的居住之地。\r\n\r\n祖安自豪地宣称，这里拥有全瓦罗兰种类最多的化学研究中心。大量城邦——甚至包括竞争对手皮尔特沃夫——都与祖安有化学贸易往来。此外，祖安还是瓦罗兰的炼金术中心，只有寥寥几位炼金术士居住在祖安之外。瓦罗然的居民应当小心化学工业，这可比炼金术更加不可靠，影响也更加无法预测。然而在祖安，这些都是不可知的。[2-3] \r\n巨神峰\r\n巨神峰是符文大陆的世界之巅，这座高耸入云的山峰完全由坚硬的山石构成，终年沐浴着烈日阳光，永远俯视着脚下的群山，恢弘磅礴举世无双。巨神峰坐落于远离文明的无人之地，对于许多人都是遥不可及的，只有那些意志最坚决的追寻者有幸一睹尊容。\r\n\r\n许多传奇故事都与巨神峰有关，比较常见的是关于被灌注了神力的武士浑身火光四射从天而降斩妖除魔，更加离奇的则是关于神祇和他们的星界居所坠入凡间化作神峰。有些传奇故事甚至神乎其神地称这座山其实是一位沉睡中的上古巨人。和其他神秘地区一样，巨神峰也是一座吸引着梦想家、疯人和冒险者的璀璨信标。所有历经劫难坎坷，幸存来到山脚下的人会被当做殊途同归的朝圣者，受到山脚下零星散落的游牧部落的欢迎。[2] \r\n恕瑞玛\r\n恕瑞玛之前是符文之地上的一个伟大城邦，拥有强大的文明、军事、人文和科技，\r\n从各个角度影响着符文之地。不过在阿兹尔的飞升仪式遭到破坏以后，如今的恕瑞玛已经变成一片废墟，曾经的远古恕瑞玛文明也成为了一个传说。\r\n在远古时期的恕瑞玛，年轻的皇帝阿兹尔被他的大魔导师泽拉斯说服，决定举行一个加冕仪式，而一切却是泽拉斯的阴谋。阿兹尔的傲慢终于导致灾难发生，当太阳圆盘碟将破晓阳光转化成一道能量时，泽拉斯背叛了君主，将他推开并将那道能量据为已有。在一瞬间，阿兹尔变得濒死，而泽拉斯变成一股纯粹又邪恶的能量体，而整个恕瑞玛同时也被沙漠所吞噬。[3] \r\n暗影岛\r\n位于瓦洛兰大陆西北部、常年惊涛骇浪的征服者之海上，有一处岛屿终年笼罩在黑暗之中，这是一个集黑暗\r\n魔法与邪恶于一体的神秘地域。这就是大名鼎鼎的暗影岛。\r\n关于暗影岛的一切似乎都是谜，只有极少数人才能从暗影岛或者回来，或许那里根本就不会有人类敢随意涉足，正义之地的著名竞技场—扭曲丛林，就位于岛的深处。暗影岛的英雄几乎都出于某种不可告人的目的加入联盟，种种迹象表明，暗影岛的内部并不团结，而这种现象似乎在预示了某些大事件的发生。[5] \r\n拓展阅读：\r\n《正义周刊》,《奎因旅行日志》,《福影双至》[5]  ,《焰浪之潮》[4]  ,《铸星者的归来》[6]  ', 0, 1478329329);
INSERT INTO `shop_news` VALUES (14, '旅游', '小杨晶', NULL, NULL, 4, 1, 1, '　　 1.旅行游览。南朝 梁 沈约《悲哉行》：“旅游媚年春，年春媚游人。”唐王勃《涧底寒松赋》：“岁八月壬子旅游於蜀，寻茅溪之涧。” 宋无名氏《异闻总录》卷一：“临川画工黄生，旅游如广昌，至秩巴寨，卒长郎巖馆之。” 明吴承恩《著》：“东园公初晋七袠，言开曼龄，是日高宴……会有京华旅游淮海浪士，闻之欢喜。”《人民文学》1981年第3期：“旅游事业突起后，就有人在半山寺开设茶水站。”\r\n2.谓长期寄居他乡。唐贾岛《上谷旅夜》诗：“世难那堪恨旅游，龙钟更是对穷秋。故园千里数行泪，邻杵一声终夜愁。” 唐尚颜《江上秋思》诗：“到来江上久，谁念旅游心。故国无秋信，邻家有夜砧。” 明文徵明《枕上闻雨有怀宜兴杭道卿》诗：“应有旅游人不寐，凄凉莫到小楼前。” 清陆以湉《冷庐杂识·孔宥函司马》：“廿载邗江路，行吟动值秋……旅游复何事，飘泊问沙鸥。”[1] \r\n基本概念\r\n旨在提供一个理论框架，用以确定旅游的基本特点以及将它与其他类似的、有时是相关的，但是又不相同的活动区别开来。国际上普遍接受的艾斯特定义，1942年，瑞士学者汉沃克尔和克拉普夫。\r\n旅游是非定居者的旅行和暂时居留而引起的一种现象及关系的总和。这些人不会因而永久居留，并且主要不从事赚钱的活动。\r\n字根\r\n旅游（Tour）来源于拉丁语的“tornare”和希腊语的“tornos”，\r\n旅游山水\r\n旅游山水\r\n其含义是“车床或圆圈；围绕一个中心点或轴的运动。”这个含义在现代英语中演变为“顺序”。后缀—ism被定义为“一个行动或过程；以及特定行为或特性”，而后缀—ist则意指“从事特定活动的人”。词根tour与后缀—ism和—ist连在一起，指按照圆形轨迹的移动，所以旅游指一种往复的行程，即指离开后再回到起点的活动；完成这个行程的人也就被称为旅游者（Tourist）。\r\n技术定义\r\n用它来为统计和立法提供旅游信息。\r\n各种旅游技术定义所提供的含义或限定在国内和国际范畴上都得到了广泛的应用。技术定义的采用有助于实现可比性国际旅游数据收集工作的标准化。\r\n现代旅游业定义\r\n（1）定义旅游的三要素\r\n尽管上文中所提及的技术定义应当适用于国际旅游和国内旅游这两个领域，但是在涉及国内旅游时，这些定义并没有为所有的国家所采用。不过，大多数国家都采用了国际通用的定义中的三个方面的要素：\r\n——出游的目的——旅行的距离\r\n——逗留的时间\r\n（2）对出游的目的定义\r\n以该尺度为基础的定义旨在涵盖现代旅游的主要内容。\r\n——一般消遣性旅游，非强制性的或自主决定的旅游活动。他们只把消遣旅游者视为旅游者，并且有意把商务旅游单列出去。\r\n——商务和会议旅游，往往是和一定量的消遣旅游结合在一起的。参加会议公务旅游也被视为旅游。\r\n——宗教旅游，以宗教活动为目的的出行活动。\r\n——体育旅游，与重大体育活动联系在一起的旅游。\r\n——互助旅游，新兴的一种旅游方式，通过互相帮助 ，交换等互助的一方向另一方提供住宿，互助旅游不但节省了旅费，而且因为当地人的介入，更深入的体验当地的人文和自然景观。\r\n（3）对旅行距离的定义\r\n异地旅游（Non—10calTravel）：许多国家、区域和机构采用居住地和目的地之间的往返距离作为重要的统计尺度。\r\n旅行距离：确定的标准差别很大，从0到160公里）不等。低于所规定的最短行程的旅游在官方旅游估算中不包括在内，标准具有人为和任意性。\r\n（4）对逗留时间的定义\r\n过夜游客：为了符合限定“旅游者”的文字标准，大多数有关旅游者和游客的定义中，都包含有在目的地必须至少逗留一夜的规定。\r\n“过夜”的规定就把许多消遣型的“一日游”排除在外了，而事实上，“一日游”往往是旅游景点、餐馆和其他的旅游设施收入的重要来源。\r\n（5）其他方面\r\n旅游者的居住：在进行市场定位和制定相关市场战略时，了解旅游者的居住地要比确定其他的人口统计方面的因素，如民族和国籍等更为重要。\r\n交通方式：主要是为了更好地进行规划，一些目的地通过收集游客交通方式（航空、火车、轮船、长途汽车、轿车或其他工具）的信息来获得有关游客旅行模式的信息。\r\n世界旅游组织和联合国统计委员会推荐的技术性的统计定义\r\n旅游指为了休闲、商务或其他目的离开他她们惯常环境，到某些地方并停留在那里，但连续不超过一年的活动。旅游目的包括六大类：休闲、娱乐、度假，探亲访友，商务、专业访问，健康医疗，宗教/朝拜，其他。\r\n国际组织定义\r\n（1）1937年，第一次定义国际旅游者\r\n在两次世界大战的间歇期间，世界国际旅游收入增长迅速，因此在统计上迫切需要有一个更准确的定义。1936年举行的一个国际论坛，国家联盟统计专家委员会首次提出，“外国旅游者是指离开其惯常居住地到其他国家旅行至少24小时以上的人”。1945年，联合国（取代了原来的国家联盟）认可了这一定义，但是增加了“最长停留时间不超过6个月”的限定。\r\n（2）世界旅游组织的定义\r\n1963年，联合国国际旅游大会在罗马召开。这次大会是当时的国际官方旅游组织联盟（英文名字的缩写为IUOTO，即世界旅游组织，英文缩写为WTO发起的。\r\n大会提出应采用“游客”（Visitor）这个新词汇。游客是指离开其惯常居住地所在国到其他国家去，且主要目的不是在所访问的国家内获取收入的旅行者。游客包括两类不同的旅行者：\r\n——旅游者（Tourist）：在所访问的国家逗留时间超过24小时且以休闲、商务、家事、使命或会议为目的的临时性游客\r\n——短期旅游者(Excursionists）：在所访问的目的地停留时间在24小时以内，且不过夜的临时性游客（包括游船旅游者）。\r\n从1963年开始，绝大多数国家接受了这次联合国大会所提出的游客、旅游者和短期旅游者的定义以及以后所作的多次修改。\r\n在1967年的日内瓦会议上，联合国统计委员会提议，应该建立一个单独的游客类别。旅游者至少要逗留24小时，然而，有些游客外出游览但于当日返回了居住地，这些人被称为“短期旅行者（Excursionists）”、这类游客包括了不以就业为目的的一日游者、游船乘客和过境游客。短期旅行者很容易与其他游客区分开来，因为他们不在目的地过夜。\r\n世界旅游日\r\n世界旅游日\r\n（3）世界旅游日的确立\r\n世界旅游日 (World Tourism Day），是由世界旅游组织确定的旅游工作者和旅游者的节日。1970年9月27日，国际官方旅游联盟（世界旅游组织的前身）在墨西哥城召开的特别代表大会上通过了将要成立世界旅游组织的章程。1979年9月，世界旅游组织第三次代表大会正式将9月27日定为世界旅游日。选定这一天为世界旅游日，一是因为世界旅游组织的前身“国际官方旅游联盟”于1970年的这一天在墨西哥城的特别代表大会上通过了世界旅游组织的章程。此外，这一天又恰好是北半球的旅游高峰刚过去，南半球的旅游旺季刚到来的相互交接时间。[2] \r\n中国于1983年正式成为世界旅游组织成员。自1985年起，每年都确定一个省、自治区或直辖市为世界旅游日庆祝活动的主会场。[3] \r\n对国内旅游者的定义\r\n1963年提出的游客（Visitor）术语的定义仅仅是针对国际旅游而言，它也适用于国民（国内）旅游。\r\n1980年，世界旅游组织（WTO）《马尼拉宣言》：将该定义引申到所有旅游。巴昂（BarOn，1989）指出，世界旅游组织（WTO)欧洲委员会旅游统计工作组同意，尽管国内旅游比国际旅游的范围窄一些，但这一术语的使用还是相容的。\r\n德国作家黑塞定义\r\n德国作家黑塞说，“旅游就是艳遇”。既然是“遇”，自然是遇而不可求。旅行中的艳遇，陌生的地方，陌生的人，在美景的衬托之下更显出浪漫情调。艳，奇幻迷离，让人意犹未尽；遇，一场风花雪月的邂逅，一个怦然心动的瞬间。\r\n其他相关定义\r\n交往定义：1927年，德国的蒙根·罗德对旅游的定义，旅游从狭义的理解是那些暂时离开自己的住地，为了满足生活和文化的需要，或各种各样的愿望，而作为经济和文化商品的消费者逗留在异地的人的交往。注意：这个定义强调的是：旅游是一种社会交往活动。\r\n目的定义：20世纪50年代，奥地利维也纳经济大学旅游研究所对旅游的定义，旅游可以理解为是暂时在异地的人的空余时间的活动，主要是出于修养；其次是出于受教育、扩大知识和交际的原因的旅行；再是参加这样或那样的组织活动，以及改变有关的关系和作用。\r\n时间定义：1979年，美国通用大西洋有限公司的马丁·普雷博士在中国讲学时，对旅游的定义为，旅游是为了消遣而进行旅行，在某一个国家逗留的时间至少超过24小时。注意：这个定义强调的是，各个国家在进行国际旅游者统计时的统计标准之一：逗留的时间。\r\n相互关系定义：1980年，美国密执安大学的伯特·麦金托什和夏西肯特·格波特对旅游的定义，旅游可以定义为在吸引和接待旅游及其访问者的过程中，由于游客、旅游企业、东道政府及东道地区的居民的相互作用而产生的一切现象和关系的总和。注意：这个定义强调的是：旅游引发的各种现象和关系，即旅游的综合性。\r\n生活方式定义：中国经济学家于光远1985年对旅游的定义为，旅游是现代社会中居民的一种短期性的特殊生活方式，这种生活方式的特点是：异地性、业余性和享受性', 0, 1478330672);
INSERT INTO `shop_news` VALUES (15, '看小说', '大新新', NULL, NULL, 19, 1, 1, '小说 （文学体裁） 编辑\r\n小说：以刻画人物形象为中心，通过完整的故事情节和环境描写来反映社会生活的文学体裁。\r\n人物、情节、环境是小说的三要素。情节一般包括开端、发展、高潮、结局四部分，有的包括序幕、尾声。环境包括自然环境和社会环境。 小说按照篇幅及容量可分为长篇、中篇、短篇和微型小说（小小说）。按照表现的内容可分为科幻、公案、传奇、武侠、言情、同人、官宦等。按照体制可分为章回体小说、日记体小说、书信体小说、自传体小说。按照语言形式可分为文言小说和白话小说。\r\n小说与诗歌、散文、戏剧，并称“四大文学体裁”。\r\n小说刻画人物的方法：心理描写、动作描写、语言描写、外貌描写、神态描写，同时，小说是一种写作方法。\r\n中文名小说 外文名 Novel 三要素人物、情节、环境 篇幅分类长篇 中篇 短篇 微型小说 类    型 文学体裁 故事情节 起因，发展，高潮，结局 环    境 社会环境 拼    音 xiǎoshuō\r\n目录\r\n1 简介内容\r\n2 特点\r\n▪ 价值性\r\n▪ 容量性\r\n▪ 情节性\r\n▪ 环境性\r\n▪ 发展性\r\n▪ 纯粹性\r\n3 发展\r\n▪ 溯源\r\n▪ 衍化\r\n▪ 奠基\r\n4 构成\r\n5 写法\r\n6 类别\r\n▪ 按照篇幅长短划分\r\n▪ 按照创作年代划分\r\n▪ 按照内容题材划分\r\n▪ 按照主义流派划分古典主义小说\r\n▪ 按照表现形式划分\r\n▪ 按照创作进度划分\r\n7 举例\r\n▪ 古代小说\r\n▪ 现代小说\r\n简介内容编辑\r\n小说：是四大文学样式(散文、小说、诗歌、戏剧)之一，以塑造人物形象为中心，通过完整故事情节的叙述和具体的环境描写反映社会生活的一种文学体裁，它是拥有完整布局、发展及主题的文学作品。 小说三要素是：人物、情节、环境。\r\n小说是文学的一种样式，一般描写人物故事，塑造多种多样的人物形象，但亦有例外。\r\n它是拥有完整布局、发展及主题的文学作品。而对话是不是具有鲜明的个性，每个人物说的话是不是有独特的语言风格，是衡量小说水平的一个重要标准。\r\n“小说”一词最早出现于《庄子·外物》：「饰小说以干县令，其于大达亦远矣。」庄子所谓的「小说」，是指琐碎的言论，与今日小说观念相差甚远。直至东汉桓谭《新论》：「小说家合残丛小语，近取譬喻，以作短书，治身理家，有可观之辞。」班固《汉书．艺文志》将「小说家」列为十家之后，其下的定义为：「小说家者流，盖出于稗官，街谈巷语，道听途说[4]之所造也。」才稍与今日小说的意义相近。而中国小说最大的特色，便自宋代开始具有文言小说与白话小说两种不同的小说系统。文言小说起源于先秦的街谈巷语，是一种小知小道的纪录。在历经魏晋南北朝及隋唐长期的发展，无论是题材或人物的描写，文言小说都有明显的进步，形成笔记与传奇两种小说类型。而白话小说则起源于唐宋时期说话人的话本，故事的取材来自民间，主要表现了百姓的生活及思想意识。但不管文言小说或白话小说都源远流长，呈现各自不同的艺术特色。\r\n特点编辑\r\n价值性\r\n小说的价值本质是以时间为序列、以某一人物或几个人物为主线的，非常详细地、全面地反映社会生活中各种角色的价值关系(政治关系、经济关系和文化关系)的产生、发展与消亡过程。非常细致地、综合地展示各种价值关系的相互作用。\r\n容量性\r\n与其他文学样式相比，小说的容量较大，它可以细致地展现人物性格和人物命运，可以表现错综复杂的矛盾冲突，同时还可以描述人物所处的社会生活环境。小说的优势是可以提供整体的、广阔的社会生活。\r\n情节性\r\n小说主要是通过故事情节来展现人物性格、表现中心的。故事来源于生活，但它通过整理、提炼和安排，就比现实生活中发生的真实实例更加集中，更加完整，更具有代表性。\r\n环境性\r\n小说的环境描写和人物的塑造与中心思想有极其重要的关系。在环境描写中，社会环境是重点，它揭示了种种复杂的社会关系，如人物的身份、地位、成长的历史背景等等。自然环境包括人物活动的地点、时间、季节、气候以及景物等等。自然环境描写对表达人物的心情、渲染环境气氛都有不少的作用。\r\n发展性\r\n小说是随着时代的发展而发展的：魏晋南北朝，文人的笔记小说，是中国古代小说的雏形；唐代传奇的出现，尤其是三大爱情传奇，标志着古典小说的正式形成；宋元两代，随着商品经济和市井文化的发展，出现了话本小说，为小说的成熟奠定了坚实的基础；明清小说是中国古代小说发展的高峰，至今在古典小说领域内，没有可超越者，四大名著皆发于此。\r\n纯粹性\r\n纯文学中的小说体裁讲究纯粹性。“谎言去尽之谓纯。”(出自墨人钢《就是》创刊题词)便是所谓的“纯”。也就是说，小说在构思及写作的过程中能去尽政治谎言、道德谎言、商业谎言、维护阶级权贵谎言、愚民谎言等谎言，使呈现出来的小说成品具备纯粹的艺术性。小说的纯粹性是阅读者最重要的审美期待之一。随着时代的发展，不光是小说，整个文学的纯粹性逾来逾成为整个世界对文学审美的一个重要核心。\r\n发展编辑\r\n溯源\r\n“小说”一词最早见于《庄子·外物》：“夫揭竿累，趣灌渎，守鲵鲋，其于得大鱼难矣；饰小说以干县令，其于大达亦远矣。”“县”乃古“悬”字，高也；“令”，美也，“干”，追求。是说举着细小的钓竿钓绳，奔走于灌溉用的沟渠之间，只能钓到泥鳅之类的小鱼，而想获得大鱼可就难了。靠修饰琐屑的言论以求高名美誉，那和玄妙的大道相比，可就差得远了。春秋战国时，学派林立，百家争鸣，许多学人策士为说服王侯接受其思想学说，往往设譬取喻，征引史事，巧借神话，多用寓言，以便修饰言说以增强文章效果。庄子认为此皆微不足道，故谓之“小说”，即“琐屑之言，非道术所在”“浅识小道”，也就是琐屑浅薄的言论与小道理之意，正是小说之为小说的本来含义。\r\n衍化\r\n东汉桓谭在其所著的《新论》中，对小说如是说：“若其小说家，合丛残小语，近取譬论，以作短书，治身理家，有可观之辞。”认为小说仍然是“治身理家”的短书，而不是为政化民的“大道”。\r\n\r\n　　\r\n东汉班固在《汉书·艺文志》中写到：“小说家者流，盖出于稗官。街谈巷语，道听涂说者之所造也。孔子曰：‘虽小道，必有可观者焉，致远恐泥，是以君子弗为也。’然亦弗灭也。闾里小知者之所及，亦使缀而不忘。如或一言可采，此亦刍荛狂夫之议也。”这是史家和目录学家对小说所作的具有权威性的解释和评价。班固认为小说是“街谈巷语、道听涂(同“途”)说者之所造也”，虽然认为小说仍然是小知、小道，但从另一角度触及小说讲求虚构，植根于生活的特点。\r\n奠基\r\n小说的奠基历经先秦、两汉、魏晋南北朝八百多年的积累和沉淀，\r\n当历史进入唐代小说才正式形成。追溯八百多年的奠基，主要表现在四个方面：\r\n一是寓言故事。如《孟子》、《庄子》、《韩非子》、《战国策》，等书中都有不少人物性格鲜明的寓言故事，它们已经带有小说的意味。\r\n二是史传。如《左传》、《战国策》、《史记》、《三国志》，描写人物性格，叙述故事情节，或为小说提供了素材，或为小说积累了叙事的经验。\r\n三是文人笔记。这一点在魏晋南北朝时期尤为明显，文人笔记大都记载一些轶事、掌故、素材。\r\n四是民间娱乐消闲。各朝代都有茶馆饭店常驻的说话人、说书人，以话本为基础，每天把故事小小的说一段（小说），以吸引客人每天回来听书，希望保证生意兴隆。\r\n构成编辑\r\n小说的三要素：生动的人物形象、完整的故事情节和具体环境描写。\r\n1.人物形象\r\n　　人物的核心是思想性格，人物描写的角度有正面描写和侧面描写。正面描写包括外貌、语言、动作、神态、心理等，侧面描写通常以他人或事物来反映该人物，又叫侧面烘托。小说塑造人物，可以以某一真人为模特儿，综合其他人的一些事迹，如鲁迅所说：“人物的模特儿，没有专用过一个人，往往嘴在浙江，脸在北京，衣服在山西，是一个拼凑起来的角色。”任何一部优秀的小说，总有使人难忘的典型人物。人们可以通过这些艺术典型的镜子，看到、理解许多人的面目。\r\n2.故事情节\r\n　　故事情节是指作品所描写的事件发展，演变的全过程，故事情节的一般结构：序幕－开端－发展－高潮－结局－（尾声）。故事情节来源于生活，它是现实生活的提炼，它比现实生活更集中，更有代表性。现实生活中的事件和矛盾是有始有终，有起有伏，并有一定发展过程的，因而小说情节的展开，也是有段落，有过程的。这个过程一般分为开端、发展、高潮、结局四个部分。有时还有序幕和尾声。在作品中，情节的安排决定于作者的艺术构思，并不一定按照现实生活中的事件发生、发展的自然顺序，有时可以省略某一部分，有时也可颠倒或交错。\r\n3.环境描写\r\n　　环境描写是指对人物活动的环境和事情发生的背景作描写。一部好的小说总能让人身临其境、感同身受，而不像科学报告那样枯燥乏味。作者总是能以优美的文笔、生动的描写和不可思议的想象把这个故事牢牢地刻印在读者的脑海里。环境描写分为自然环境和社会环境。自然环境描写是指对人物活动的时间、地点、季节、气候及花草鸟虫的描写，作用是渲染故事气氛、烘托人物形象、推动情节发展、暗示社会环境、深化作品主题；社会环境描写是指对人物活动的具体背景、处所、氛围以及人际关系等作描写，作用是交代人物的生存环境、交代人物的社会关系、交代作品的时代背景。\r\n写法编辑\r\n描写\r\n　　人物描写、环境描写。\r\n　　人物描写又分为：语言、心理、神态、动作，身份、相貌、体型、穿着。\r\n　　正面描写：作者描述主角。侧面描写：小说中的角色描述主角。\r\n叙述\r\n　　1).时间先后顺序\r\n　　2).分叙同时发生的事\r\n　　3).倒叙（回忆）\r\n　　①先讲结果，后讲原因。回忆的方式讲原因，揭开谜团。\r\n　　②触景生情或触事生情，从而回忆过去。有时因物是人非而伤感。\r\n　　4).插叙（支线剧情）\r\n　　①插在开始：前奏，交代故事背景。\r\n　　②插在中部：为主线剧情做铺垫的支线剧情。\r\n抒情\r\n　　直接抒情（直接抒情可以使感情表达得朴实真切，震动人心。直接抒情一般适用于抒发强烈而紧张的感情。直接抒情的特点是叙述时感情强烈，节奏快、紧张，情感直露，容易把握。）\r\n　　间接抒情：话中含话、口是心非、借事喻事。（其特点是抒情含蓄婉转，富有韵味，感染力强。）\r\n矛盾\r\n　　矛盾是事物发展的根本动力。因为有矛盾，所以才要努力解决矛盾，这个过程中，事物得到发展。\r\n　　矛盾的产生、维持、延长、消除。\r\n　　如果矛盾早早解决，故事也就早早结束了，所以需要维持、延长矛盾。\r\n伏笔：伏笔为以后的剧情做铺垫，制造一个“原因”，目的是为了产生以后的“结果”。\r\n　　@逐渐清楚\r\n　　设置谜团，吸引读者的好奇心，随着故事的发展，逐渐揭开谜团。\r\n　　开始不理解的话语，随着故事的发展，逐渐的理解。\r\n　　@梦境：\r\n　　从中得到启发。\r\n　　读者以为是真事，后来知道描写的是梦。\r\n　　@中断：先把某件事说一半，不说另一半，故事发展到一定程度，再说出另一半，成为完整的事。\r\n配角\r\n　　(1)正面配角：\r\n　　①能力和主角互补，帮助主角完成事情。\r\n　　②主角完成事的必要条件或中间人。\r\n　　2).反面配角：\r\n　　①敌人，制造矛盾。\r\n　　②竞争对手。\r\n　　正面配角也可能变为反面配角，而反面配角也可能变为正面配角。\r\n修辞\r\n　　比喻：分为明喻、暗喻、借喻。\r\n　　借代：用一个事物相关的其它事物来代替这个事物。（比喻强调“喻”，借代强调“代”）\r\n　　拟人：用人的特征来表现物。\r\n　　拟物：用物的特征来表现人。\r\n　　夸张：扩大或缩小事物的特征。\r\n　　呼应：写了一个事物，后面又出现这个事物。\r\n　　对比。\r\n　　衬托：利用事物的相似条件来衬托就是正衬，利用事物的对立条件来衬托就是反衬。\r\n　　粘连：描写甲事物的词也用于描写乙事物。例如：别看我耳朵聋，可是心不聋（“聋”从耳朵转移到心）。\r\n　　移就：本来描写甲事物的词，转移到乙事物上，而不用在甲事物上。例如：张三向李四伸出善意的手（“善意的”本来要修饰张三）。\r\n　　排比：结构一致，语气一致，意思相关。\r\n　　对偶：结构一致，意思相对或相反。\r\n　　顶针(又称顶真)：前一句话的结尾词作为后一句话的开头词。\r\n　　欲扬先抑：要说一个事物好，先说这个事物不好的方面。\r\n　　引用：引用名言名句。\r\n类别编辑\r\n按照篇幅长短划分\r\n1.微型小说(数百至几千字)[1]  \r\n　　比短篇更短的小说完全符合瞬息万变的现代社会中忙碌的人们的阅读习惯，几乎每天都可以看到人们为这类的小说赋予一个新名词和新定义。例如极短篇、精短小说、超短篇小说、微信息小说、一分钟小说、一袋烟小说、袖珍小说、焦点小说、瞳孔小说、拇指小说、迷你小说等，族繁不及备载，连专门的文学研究者也很难如数家珍分叙其定义，一般人更容易混淆，故总论之。一般认为小小说的篇幅应在两千字以下。因为题材常是生活经验的片段，因此可以是有头无尾、有尾无头、甚至无头无尾。高潮放在结尾，高潮一出马上完结，营造余音绕梁的意境。由于比短篇更短，字句也需要更加精练，题材能见微知著者为佳。一个意外的结局虽然能吸引眼球，但文章短还是要有伏笔呼应，甚至比起给予读者意外、应该更重视能否带给读者感动。\r\n2.短篇小说(几千至三万字)\r\n　　一般认为，篇幅在几千到两万多字的小说会被划归短篇小说。在它的特色中有所谓三一律：一人一地一时，也就是减少角色、缩小舞台、短化故事中流动的时间。另外，虽然它们时常惜墨如金，但一般认为短篇小说仍应符合小说的原始定义、也就是对细节有足够的刻划，绝非长篇故事的节略或纲要。所有小说基础，其发展初期并无长短之分，随时代而区分。今短篇小说多要求文笔洗练，且受西洋三一定律一时一地一物观念影响，使其更生动详实但也限制其发展。\r\n3.中篇小说(三万至六万字)\r\n　　一般认为，篇幅在三万字至六万字之间的小说。也有少数十几万字也被算作中篇而不归于长篇，这取决于文章内容的丰富度。其容量大小、篇幅长短、人物多寡、情节繁简等均介于长篇小说和短篇小说之间，通常只是截取主人公一个时期或某一段生活的典型事件塑造形象。反映社会生活的某个方面，故事情节完整。线索比较单一，矛盾斗争不如长篇小说复杂，人物较少。所以，相比于长篇，中篇小说比较容易把握，也更容易成功。因为对于初涉创作领域的人而言，写作长篇易陷入多数的情节造成凌乱难收的困境，而写作短篇不是转折太少而单调、就是转折太多却显得拥挤。这时考虑将原本的构想修改中篇是一个广受推荐的建议。\r\n4.长篇小说(六万字或十万字以上)\r\n莫言小说-红树林\r\n莫言小说-红树林\r\n\r\n　　一般认为，字数在六万或十万以上的为长篇小说，还可细分为小长篇（一般六万到十万字），中长篇（一般十几万到三五十万字），超长篇（一般超过百万字）。如果作者打算表现人生中常见的错综复杂关系，则必须使用这么大的篇幅。通常就算是笔调轻松的长篇小说，也会有一个内里的严肃主题，否则很容易陷入无组织或是零乱。初涉者在写作长篇时最需注意全局对主题的呼应、结构的严密性，以及避免重复矛盾或缺漏。\r\n注：篇幅长短并非明文规定，但按照情节内容丰富度可能会把部分字数多的划入字数少的类别，例如某些十几万二三十万字的小说会因为内容太过不紧凑而被归入中篇小说，而某些仅有六万多字让人觉得篇幅过短的小说会因为内容情节十分紧凑而归为小长篇。\r\n按照创作年代划分\r\n1.古典小说\r\n古典小说萌芽于先秦，发展于两汉，雏形于魏晋南北朝，形成于唐代，繁荣于宋元，鼎盛于明清。大致可分以下几个时期：\r\n（1）先秦两汉时期：当时社会出现的神话传说、寓言故事、史传文学成为古典小说叙事的源头。神话传说已经具备人物和情节两个基本因素，散见于诸子百家书中的寓言典故提供了借鉴经验，历史著作有比较完整的结构、人物形象和历史背景。\r\n（2）魏晋南北朝时期：出现了志怪、志人小说。严格意义上说这仍然算不上是小说，只能算是小说的雏形。《世说新语》也是这个时期的优秀作品，里面收集了许多短小精悍的小故事。\r\n（3）唐朝时期：古代小说的发展趋于成熟，形成了独立的文学形式—传奇体小说，由此我国的小说脱离历史领域而成为文学创作。唐代三大爱情传奇是此时期的标志性作品。\r\n（4）宋元时期：商品经济的发展和市井文化的兴起，给小说创作带来深厚的土壤。话本经过文人加工形成许多话本小说和演义小说。\r\n（5）明清时期：小说开始走上了文人独立创作之路，这一时期，小说作家主体意识增强。《红楼梦》的出现，把中国古代小说发展推向了高峰，达到前所未有的成就。在明清这一段时间内涌现了无数的经典之作流传于世。如明代四大奇书（《西游记》《水浒传》《三国演义》《金瓶梅》）三言二拍（《醒世恒言》《警世通言》《喻世明言》《初刻拍案惊奇》《二刻拍案惊奇》）清代的《红楼梦》《儒林外史》《老残游记》《聊斋志异》等。明董其昌《袁伯应（袁可立子）诗集序》：“二十年来，破觚为圆，浸淫广肆，子史空玄，旁逮稗官小说，无一不为帖括用者”。\r\n2.现代小说\r\n矛盾小说-子夜\r\n矛盾小说-子夜\r\n现当代小说的兴起的标志性事件为新文化运动，新文化运动乃是五四运动的先导（时间从1915年-1919年），大致可分为四个时期：\r\n（1）第一时期为民国时期，即1949年以前，是小说的多元文艺复兴阶段。\r\n民国时期，尤其是五四以来，中国遭受列强侵略，社会各种思潮流行，舶来文化冲击传统文化，中国小说的发展出现多元化，各类小说题材涌现，其中现代言情小说的发端鸳鸯蝴蝶派就出现在此时。正统小说的代表性人物有“鲁郭茅巴老曹”六大家。晚清民国报纸兴起为小说创作提供了一个上佳的舞台，报纸通过了连载小说招揽人气，小说家通过报纸赚取稿费。近现代几乎所有著名的小说家最初都是从报纸上连载小说开始，从鸳鸯蝴蝶派的张恨水到鲁迅再到当代金庸。\r\n（2）第二时期为建国后到文革结束，即1976年以前，是小说的阶级斗争阶段。\r\n这一时期的大陆小说的带有明显的政治倾向，同时，这一时期的大陆文艺青年经历了重大的人生转变，命运的沉浮、多视角的阅历以及对价值的思考，为下一个时期的辉煌埋下了伏笔（中国第一位诺贝尔文学奖得主莫言的人生转变就在这一时期）。而在港台，这一时期的言情小说和武侠小说发展到了巅峰，分别产生了琼瑶时代和金庸时代。\r\n（3）第三时期为改革开放后二十多年的时期，即2003年以前，是小说的反思和蜕变阶段。\r\n这一时期的大陆小说展现了强劲的生命力，文革结束，对外开放，知识分子思想解放，对过去的反思，对未来的向往，传统和新时代的撞击，使得小说界出现欣欣向荣的勃勃生机。以莫言、贾平凹、陈忠实等为代表文革后作家，在此期间创作了许多经典作品，莫言更是凭借在此期间创作的文学作品和影响力，在2012年获得中国第一个诺贝尔文学奖。\r\n（4）第四时期为2003年至今，是小说的“表性”网络文学阶段。\r\n随着网络普及，网络文学的出现颠覆了传统的书写和传播模式，使小说的发展更加多元，80后90后的生力军开始步入文坛并展现了惊人的创作能力。以起点为代表的武侠玄幻小说作者群和以晋江为代表的言情小说作者群（四小天后、六小公主、八小玲珑）的整体出现，标志着网络小说已经成为主流文学之外的又一创作主体。\r\n按照内容题材划分\r\n1.武侠小说\r\n　　也有叫武打小说，金庸为代表，可看做男性言情和励志小说。民国时期，尤其是五四以来，舶来文化的冲击，中国小说发展出现多元化，代表性人物有“鲁郭茅巴老曹”六大家，以及鸳鸯蝴蝶派；1930李寿民开始在天津的《天风报》连载，一长篇武侠小说《蜀山剑侠传》并以还珠楼主为笔名。自此东南亚刮起了一股武侠风，在金庸手中发展到了巅峰。\r\n2.恐怖小说\r\n　　包含盗墓笔记、我和鬼小姐的那些事、鬼故事\r\n灵异小说-鬼吹烛\r\n灵异小说-鬼吹烛\r\n、灵异故事、以情节或者语言以达到让读者恐慌的目的。\r\n3.言情小说\r\n　　包括很多，如后宫文，穿越文，都市文，青春校园文等，以描述恋爱感情为主题。例如《躺在床上谈恋爱》《梁祝谈情篇》等等。\r\n4.推理小说\r\n　　推理小说是指在故事的描述过程中带有足够的线索让读者可以推理出结局，也可以不加推理由小说中的“侦探”来推导出结局的小说。\r\n5.悬疑小说\r\n　　悬疑和推理的区别在于，推理小说会描述足够的线索用以推断出结果，而悬疑小说则是遮掩各种关键线索，最后引导读者进入一个出乎意料的结局。\r\n　　注：一般认为\r\n盗墓笔记\r\n盗墓笔记\r\n，悬疑小说与推理小说均源自于犯罪小说在发展中的变化，而脱离产生的两种不同类型小说。推理小说与侦探小说区别并不显著，可归为一类。广义上的悬疑小说包括恐怖小说（恐怖悬疑）、灵异小说（灵异悬疑）、探险小说（探险悬疑）等等类型。\r\n6.历史小说\r\n　　历史小说通常与军事小说不分家，严格说历史小说主要是以史实记录为蓝本，重新记述刻画历史人物和事件。网络上出现的历史小说大多是使用中国古代历史为背景的穿越类小说。\r\n7.军事小说\r\n　　军事战争为主题。\r\n8.科幻[2]  小说\r\n　　是根据现有的科学理论进行幻想的小说，并非凭空捏造。\r\n特殊传说\r\n特殊传说\r\n9.网游小说\r\n　　新时代的产物，源于网络游戏。\r\n10.玄幻小说\r\n　　和科幻小说有很大区别，很多都是天马行空的想象，大多更具东方特征。\r\n11.逸体小说\r\n　　其特征有三：1.故事的叙述已经突破了既有的时空观念，既非经典的绝对时空，也非如今的相对时空，而是一种混沌的时空；2.混沌的时空在人物事件的发展中获得统一；3.既是理性的，又是诗性的。\r\n12.穿越小说\r\n　　同样是大陆新派小说，以时空交错为特征。\r\n\r\n13.魔幻小说\r\n　　几乎等同玄幻，但魔幻更偏向于西方。\r\n14.YY小说\r\n　　非主流小说。\r\n15.耽美小说\r\n　　源于日本。又称BL小说（boys love）或GL小说（girls love），结局分为be（bad end）和he（happy end）。\r\n16.黑道小说\r\n新时代的产物，源于武侠小说。\r\n17.轻小说\r\n　　近代很有前途的小说体系，起源于日本。\r\n轻小说\r\n轻小说\r\n18.仙侠修真小说\r\n　　以神话传说为基础二次创作的作品，封神演义和四大名著当中的西游记就是代表作品。\r\n19.校园小说\r\n　　一般以两个少年的纯真情感为主线，夹杂有青春期对生活的困惑，成长的烦恼，以及于家长老师之间的各种冲突于情感。一般比较唯美和理想化。', 0, 1478331387);
INSERT INTO `shop_news` VALUES (16, '红楼梦简介', '小曹', NULL, NULL, 11, 1, 1, '《红楼梦》，中国古典四大名著之首，清代作家曹雪芹创作的章回体长篇小说[1]  ，又名《石头记》《金玉缘》。此书分为120回“程本”和80回“脂本”两种版本系统。新版通行本前80回据脂本汇校，后40回据程本汇校，署名“曹雪芹著，无名氏续，程伟元、高鹗整理”[2]  。后40回作者尚有争议，但是对于矮化甚至腰斩后40回的极端倾向也应保持警惕。\r\n《红楼梦》是一部具有世界影响力的人情小说作品[3]  ，举世公认的中国古典小说巅峰之作，中国封建社会的百科全书，传统文化的集大成者。小说以贾、史、王、薛四大家族的兴衰为背景，以贾府的家庭琐事、闺阁闲情为脉络，以贾宝玉、林黛玉、薛宝钗的爱情婚姻故事为主线，刻画了以贾宝玉和金陵十二钗为中心的正邪两赋有情人的人性美和悲剧美。通过家族悲剧、女儿悲剧及主人公的人生悲剧，揭示出封建末世危机[4]  。\r\n《红楼梦》的作者具有初步的民主主义思想，他对现实社会包括宫廷及官场的黑暗、封建贵族阶级及其家庭的腐朽，封建的科举制度、婚姻制度、奴婢制度、等级制度，以及与此相适应的社会统治思想即孔孟之道和程朱理学、社会道德观念等，都进行了深刻的批判，并提出了朦胧的带有初步民主主义性质的理想和主张。[5] \r\n《红楼梦》以“大旨谈情，实录其事”自勉，只按自己的事体情理，按迹循踪，摆脱旧套，新鲜别致[1]  ，取得了非凡的艺术成就。“真事隐去，假语村言”的特殊笔法更是令后世读者脑洞大开，揣测之说久而遂多[3]  。围绕《红楼梦》的品读研究形成了一门显学——红学。', 0, 1478331850);
INSERT INTO `shop_news` VALUES (17, '西游记', '小吴', NULL, NULL, 9, 1, 0, '《西游记》为明代小说家吴承恩所著。取材于《大唐西域记》和民间传说、元杂剧。宋代《大唐三藏取经诗话》（本名《大唐三藏取经记》）是西游记故事见于说话文字的最早雏形，其中，唐僧就是以玄奘法师为原型的。\r\n作为中国古代第一部浪漫主义长篇神魔小说，该书深刻地描绘了当时的社会现实，是魔幻现实主义的开创作品。先写了孙悟空出世，然后遇见了唐僧、猪八戒和沙和尚三人，但还是主要描写了孙悟空、猪八戒、沙和尚三人保护唐僧西行取经，唐僧从投胎到取经受了九九八十一难，一路降妖伏魔，九九归一，终于到达西天见到如来佛祖，最终五圣成真。\r\n自《西游记》问世以来在民间广为流传，各式各样的版本层出不穷，明代刊本有六种，清代刊本、抄本也有七种，典籍所记已佚版本十三种。鸦片战争以后，中国古典文学作品大量被译为西文，西渐欧美，已有英、法、德、意、西、手语、世（世界语）、俄、捷、罗、波、日、朝、越等文种。并发表了不少研究论文和专著，对这部小说作出了极高的评价。被尊为中国古典四大名著之一。', 0, 1478331893);
INSERT INTO `shop_news` VALUES (18, 'qweq', 'WERWE', NULL, NULL, NULL, 1, 1, 'DWERWERW', 0, 1480668795);

-- ----------------------------
-- Table structure for shop_news_comment
-- ----------------------------
DROP TABLE IF EXISTS `shop_news_comment`;
CREATE TABLE `shop_news_comment`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `nid` int(11) NOT NULL COMMENT '新闻ID',
  `commentcontent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '评论内容',
  `isreply` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否回复',
  `isshow` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示，默认为1，代表可以显示，0代表隐藏不显示',
  `replycontent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '回复内容',
  `addtime` int(11) NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_news_comment
-- ----------------------------
INSERT INTO `shop_news_comment` VALUES (1, 1, 1, '伤心', 1, 0, '没事', 1456353629);
INSERT INTO `shop_news_comment` VALUES (2, 1, 2, '哈哈', 1, 1, 'aaaa', 1452612345);
INSERT INTO `shop_news_comment` VALUES (3, 2, 2, '好开心', 0, 1, '666', 1458978632);
INSERT INTO `shop_news_comment` VALUES (4, 1, 1, 'sdfasdfasdf', 1, 1, '我就去', 1478258726);
INSERT INTO `shop_news_comment` VALUES (5, 1, 1, ' dasdasd        ', 0, 1, NULL, 1478259151);
INSERT INTO `shop_news_comment` VALUES (6, 1, 0, 'fasdfasdfasd   ', 0, 1, NULL, 1478259227);
INSERT INTO `shop_news_comment` VALUES (7, 1, 10, 'sdasdasd', 0, 1, NULL, 1478261062);
INSERT INTO `shop_news_comment` VALUES (8, 1, 10, 'dsaasdfasdf', 0, 1, NULL, 1478261087);
INSERT INTO `shop_news_comment` VALUES (9, 1, 9, 'nihao1dfsadf', 0, 1, NULL, 1478261134);
INSERT INTO `shop_news_comment` VALUES (10, 1, 4, 'afsdfasdfasdf', 0, 1, NULL, 1478261142);
INSERT INTO `shop_news_comment` VALUES (11, 1, 12, 'fdsadasd', 0, 1, NULL, 1478261966);
INSERT INTO `shop_news_comment` VALUES (12, 1, 11, 'dsasdasdasd', 1, 1, '为切尔去玩儿玩儿去', 1478262670);
INSERT INTO `shop_news_comment` VALUES (13, 1, 10, 'sdfsdf', 0, 1, NULL, 1478263051);
INSERT INTO `shop_news_comment` VALUES (14, 4, 12, 'sgdgdsgsgdshfdsh', 0, 1, NULL, 1478307842);
INSERT INTO `shop_news_comment` VALUES (15, 1, 12, '你好哦哦111', 0, 1, NULL, 1478309499);
INSERT INTO `shop_news_comment` VALUES (16, 1, 12, '我去\r\n dasasda', 0, 1, NULL, 1478309528);
INSERT INTO `shop_news_comment` VALUES (17, 1, 12, '这是怎么了aa', 0, 1, NULL, 1478309607);
INSERT INTO `shop_news_comment` VALUES (18, 1, 12, 'dafsdkjgasdfa', 0, 1, NULL, 1478309786);
INSERT INTO `shop_news_comment` VALUES (19, 1, 12, 'sadfasdfas', 0, 1, NULL, 1478312089);
INSERT INTO `shop_news_comment` VALUES (20, 1, 12, 'adfsdfas', 0, 1, NULL, 1478312094);
INSERT INTO `shop_news_comment` VALUES (21, 1, 12, '文明上网.登录评论', 0, 1, NULL, 1478312139);
INSERT INTO `shop_news_comment` VALUES (22, 1, 11, '烈面实打实地方', 0, 1, NULL, 1478315525);
INSERT INTO `shop_news_comment` VALUES (23, 1, 9, '我的天那你呢11', 0, 1, NULL, 1478315543);
INSERT INTO `shop_news_comment` VALUES (24, 1, 7, '号卡斯和打手', 0, 1, NULL, 1478315560);
INSERT INTO `shop_news_comment` VALUES (25, 1, 6, '爱上当客服告诉ldnfmi[asdfh妈说话', 0, 1, NULL, 1478315934);
INSERT INTO `shop_news_comment` VALUES (26, 1, 6, '爱上的房间爱思考就都会害怕死了答复', 0, 1, NULL, 1478315941);
INSERT INTO `shop_news_comment` VALUES (27, 1, 6, 'asdfasdf', 0, 1, NULL, 1478315966);
INSERT INTO `shop_news_comment` VALUES (28, 1, 6, 'asdfasdfasdfasdf', 0, 1, NULL, 1478315971);
INSERT INTO `shop_news_comment` VALUES (29, 1, 12, '啊实打实大法师打发士大夫', 0, 1, NULL, 1478317051);
INSERT INTO `shop_news_comment` VALUES (30, 1, 12, 'dasdfasdfa', 0, 1, NULL, 1478317062);
INSERT INTO `shop_news_comment` VALUES (31, 1, 12, 'fdasdf', 0, 1, NULL, 1478317229);
INSERT INTO `shop_news_comment` VALUES (32, 1, 12, 'asdasdfas', 0, 1, NULL, 1478317282);
INSERT INTO `shop_news_comment` VALUES (33, 1, 12, 'asefasdf', 0, 1, NULL, 1478317322);
INSERT INTO `shop_news_comment` VALUES (34, 1, 12, 'fdsfasdfas', 0, 1, NULL, 1478317341);
INSERT INTO `shop_news_comment` VALUES (35, 1, 12, 'qsefasdfasdf', 0, 1, NULL, 1478317373);
INSERT INTO `shop_news_comment` VALUES (36, 1, 12, 'asdfasdfasd', 0, 1, NULL, 1478317382);
INSERT INTO `shop_news_comment` VALUES (37, 1, 12, 'fzvxcvzxcv', 0, 1, NULL, 1478317537);
INSERT INTO `shop_news_comment` VALUES (38, 1, 12, '你知道覅发到在等你吗我相中的同一首歌大是大非抛售', 0, 1, NULL, 1478317688);
INSERT INTO `shop_news_comment` VALUES (39, 1, 6, 'asyhaos', 0, 1, NULL, 1478318175);
INSERT INTO `shop_news_comment` VALUES (40, 1, 6, 'nasidfda', 0, 1, NULL, 1478318206);
INSERT INTO `shop_news_comment` VALUES (41, 1, 9, 'fddfsadfgsdfgsdfgsd', 0, 1, NULL, 1478318312);
INSERT INTO `shop_news_comment` VALUES (42, 1, 12, 'asdfasdf', 0, 1, NULL, 1478318557);
INSERT INTO `shop_news_comment` VALUES (43, 1, 12, 'asdfasdf', 0, 1, NULL, 1478318563);
INSERT INTO `shop_news_comment` VALUES (44, 1, 16, 'rwerqw', 0, 1, NULL, 1478587554);
INSERT INTO `shop_news_comment` VALUES (45, 1, 16, 'sfdasdfas', 0, 1, NULL, 1478587565);
INSERT INTO `shop_news_comment` VALUES (46, 1, 17, 'dsadfasdf', 0, 1, NULL, 1478587702);
INSERT INTO `shop_news_comment` VALUES (47, 1, 17, '111111111', 0, 1, NULL, 1478602845);
INSERT INTO `shop_news_comment` VALUES (48, 1, 16, '为轻微而前往   ', 0, 1, NULL, 1478603515);
INSERT INTO `shop_news_comment` VALUES (49, 47, 15, 'asdasdas', 0, 1, NULL, 1479345449);
INSERT INTO `shop_news_comment` VALUES (50, 47, 12, 'DFASDFASD', 1, 1, 'qweqrwe', 1480411491);
INSERT INTO `shop_news_comment` VALUES (51, 47, 16, '打死大飒飒大', 0, 1, NULL, 1480668528);

-- ----------------------------
-- Table structure for shop_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE `shop_order`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `mid` int(11) NOT NULL COMMENT '会员ID(用于关联会员表)',
  `order_syn` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单编号',
  `order_price` float(10, 2) NOT NULL COMMENT '订单价格',
  `order_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '订单状态(与订单状态表关联)',
  `addtime` int(11) NOT NULL COMMENT '下单时间',
  `address` int(11) NULL DEFAULT NULL COMMENT '收货地址(关联收货地址表)',
  `delivery` tinyint(2) NULL DEFAULT 1 COMMENT '快递表ID，与快递表关联',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_order
-- ----------------------------
INSERT INTO `shop_order` VALUES (3, 4, '201611191540201114592558', 195.00, 2, 1479541220, 52, 1);
INSERT INTO `shop_order` VALUES (4, 12, '201611201616231110988467', 23.90, 5, 1479629783, 47, 0);
INSERT INTO `shop_order` VALUES (5, 47, '201611221506061337157660', 46.00, 5, 1479798366, 55, 0);
INSERT INTO `shop_order` VALUES (6, 47, '201611231454191147642568', 18.90, 1, 1479884059, 55, 0);
INSERT INTO `shop_order` VALUES (7, 47, '201611231456211272571858', 1.00, 5, 1479884181, 55, 0);
INSERT INTO `shop_order` VALUES (10, 47, '201611241956251002002272', 1.00, 5, 1479988585, 55, 0);
INSERT INTO `shop_order` VALUES (11, 47, '201611241956321167702836', 1.00, 5, 1479988592, 55, 0);
INSERT INTO `shop_order` VALUES (12, 47, '201611241958561112978225', 32.80, 5, 1479988736, 55, 0);
INSERT INTO `shop_order` VALUES (13, 47, '201611241959151246116832', 29.99, 5, 1479988755, 55, 0);
INSERT INTO `shop_order` VALUES (14, 47, '201611242003211124228494', 32.80, 5, 1479989001, 55, 0);
INSERT INTO `shop_order` VALUES (17, 47, '201611242032321077262690', 31.92, 2, 1479990752, 55, 1);
INSERT INTO `shop_order` VALUES (18, 12, '201611242127451158367240', 69.80, 3, 1479994065, 47, 0);
INSERT INTO `shop_order` VALUES (21, 12, '201611251412151256703848', 65.00, 5, 1480054335, 47, 1);
INSERT INTO `shop_order` VALUES (22, 12, '201611251422351099362772', 46.00, 5, 1480054955, 47, 1);
INSERT INTO `shop_order` VALUES (24, 12, '201611251545071188726697', 32.80, 1, 1480059907, NULL, 1);
INSERT INTO `shop_order` VALUES (25, 12, '201611251546551295610506', 22.80, 3, 1480060015, 56, 1);
INSERT INTO `shop_order` VALUES (26, 12, '201611251549051216020174', 72.00, 3, 1480060145, 56, 1);
INSERT INTO `shop_order` VALUES (27, 12, '201611251550131092667674', 72.00, 5, 1480060213, 56, 1);
INSERT INTO `shop_order` VALUES (28, 12, '201611251553201229973510', 31.92, 3, 1480060400, 56, 1);
INSERT INTO `shop_order` VALUES (29, 2, '201611251608571173459369', 31.92, 1, 1480061337, NULL, 1);
INSERT INTO `shop_order` VALUES (30, 2, '201611251609171124478778', 31.92, 1, 1480061357, NULL, 1);
INSERT INTO `shop_order` VALUES (31, 12, '201611251609141221876821', 72.00, 4, 1480061354, 56, 1);
INSERT INTO `shop_order` VALUES (32, 4, '201611281946291054737124', 10.00, 2, 1480333589, 52, 1);
INSERT INTO `shop_order` VALUES (33, 4, '201611282028251330725360', 20.00, 2, 1480336105, 52, 1);
INSERT INTO `shop_order` VALUES (34, 47, '201611291255111110713155', 0.80, 1, 1480395311, NULL, 1);
INSERT INTO `shop_order` VALUES (35, 2, '201611291303411159743802', 18.90, 1, 1480395821, NULL, 1);
INSERT INTO `shop_order` VALUES (36, 47, '201611291304451056451570', 18.90, 1, 1480395885, NULL, 1);
INSERT INTO `shop_order` VALUES (37, 47, '201611291307141387990353', 1.00, 1, 1480396034, NULL, 1);
INSERT INTO `shop_order` VALUES (38, 2, '201611291314151285486515', 0.80, 3, 1480396455, 42, 1);
INSERT INTO `shop_order` VALUES (39, 47, '201611291309171140997526', 1.00, 5, 1480396157, 55, 1);
INSERT INTO `shop_order` VALUES (42, 4, '201611291652221054386726', 218.00, 2, 1480409542, 34, 1);
INSERT INTO `shop_order` VALUES (43, 4, '201611291653511065461796', 4.00, 1, 1480409631, NULL, 1);
INSERT INTO `shop_order` VALUES (44, 4, '201611291702571072619920', 5.00, 2, 1480410177, 34, 1);
INSERT INTO `shop_order` VALUES (45, 12, '201611291718221362110981', 0.80, 4, 1480411102, 56, 1);
INSERT INTO `shop_order` VALUES (46, 12, '201612011332441212854080', 46.00, 5, 1480570364, 56, 1);
INSERT INTO `shop_order` VALUES (47, 4, '201612011538521195647051', 49.00, 1, 1480577932, NULL, 1);
INSERT INTO `shop_order` VALUES (48, 4, '201612012036441288977978', 32.99, 4, 1480595804, 52, 1);
INSERT INTO `shop_order` VALUES (49, 4, '201612012038191054048843', 10.00, 2, 1480595899, 52, 1);
INSERT INTO `shop_order` VALUES (50, 47, '201612012039111351148539', 18.00, 4, 1480595951, 55, 1);
INSERT INTO `shop_order` VALUES (51, 4, '201612021333431202817690', 46.00, 2, 1480656823, 52, 1);
INSERT INTO `shop_order` VALUES (52, 4, '201612021612091054224042', 14.90, 4, 1480666329, 52, 1);
INSERT INTO `shop_order` VALUES (53, 4, '201612021619161385512541', 3.00, 2, 1480666756, 48, 1);
INSERT INTO `shop_order` VALUES (54, 4, '201612021620091011525581', 218.00, 2, 1480666809, 48, 1);
INSERT INTO `shop_order` VALUES (55, 4, '201612021621381190391086', 65.00, 2, 1480666898, 36, 1);
INSERT INTO `shop_order` VALUES (56, 12, '201612021632501322528557', 40.00, 1, 1480667570, NULL, 1);
INSERT INTO `shop_order` VALUES (57, 12, '201612021641291139157938', 1.60, 2, 1480668089, 56, 1);
INSERT INTO `shop_order` VALUES (58, 47, '201612021647501252799417', 49.00, 2, 1480668470, 55, 1);

-- ----------------------------
-- Table structure for shop_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_order_goods`;
CREATE TABLE `shop_order_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '订单商品表ID',
  `oid` int(11) NOT NULL COMMENT '订单ID（与订单表关联）',
  `gid` int(11) NOT NULL COMMENT '商品ID（与商品表关联）',
  `buynum` int(11) NOT NULL COMMENT '购买的商品数量',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_order_goods
-- ----------------------------
INSERT INTO `shop_order_goods` VALUES (3, 3, 47, 3);
INSERT INTO `shop_order_goods` VALUES (4, 4, 31, 1);
INSERT INTO `shop_order_goods` VALUES (5, 5, 21, 1);
INSERT INTO `shop_order_goods` VALUES (6, 6, 1, 1);
INSERT INTO `shop_order_goods` VALUES (7, 7, 4, 1);
INSERT INTO `shop_order_goods` VALUES (10, 10, 4, 1);
INSERT INTO `shop_order_goods` VALUES (11, 11, 4, 1);
INSERT INTO `shop_order_goods` VALUES (12, 12, 25, 1);
INSERT INTO `shop_order_goods` VALUES (13, 13, 3, 1);
INSERT INTO `shop_order_goods` VALUES (14, 14, 25, 1);
INSERT INTO `shop_order_goods` VALUES (17, 17, 52, 1);
INSERT INTO `shop_order_goods` VALUES (18, 18, 26, 1);
INSERT INTO `shop_order_goods` VALUES (21, 21, 47, 1);
INSERT INTO `shop_order_goods` VALUES (22, 22, 21, 1);
INSERT INTO `shop_order_goods` VALUES (24, 24, 25, 1);
INSERT INTO `shop_order_goods` VALUES (25, 25, 2, 1);
INSERT INTO `shop_order_goods` VALUES (26, 26, 32, 1);
INSERT INTO `shop_order_goods` VALUES (27, 27, 32, 1);
INSERT INTO `shop_order_goods` VALUES (28, 28, 52, 1);
INSERT INTO `shop_order_goods` VALUES (29, 29, 52, 1);
INSERT INTO `shop_order_goods` VALUES (30, 30, 52, 1);
INSERT INTO `shop_order_goods` VALUES (31, 31, 32, 1);
INSERT INTO `shop_order_goods` VALUES (32, 32, 54, 1);
INSERT INTO `shop_order_goods` VALUES (33, 33, 35, 1);
INSERT INTO `shop_order_goods` VALUES (34, 34, 4, 1);
INSERT INTO `shop_order_goods` VALUES (35, 35, 1, 1);
INSERT INTO `shop_order_goods` VALUES (36, 36, 1, 1);
INSERT INTO `shop_order_goods` VALUES (37, 37, 4, 1);
INSERT INTO `shop_order_goods` VALUES (38, 38, 4, 1);
INSERT INTO `shop_order_goods` VALUES (39, 39, 4, 1);
INSERT INTO `shop_order_goods` VALUES (42, 42, 60, 1);
INSERT INTO `shop_order_goods` VALUES (43, 43, 4, 5);
INSERT INTO `shop_order_goods` VALUES (44, 44, 39, 1);
INSERT INTO `shop_order_goods` VALUES (45, 45, 4, 1);
INSERT INTO `shop_order_goods` VALUES (46, 46, 21, 1);
INSERT INTO `shop_order_goods` VALUES (47, 47, 49, 1);
INSERT INTO `shop_order_goods` VALUES (48, 48, 7, 1);
INSERT INTO `shop_order_goods` VALUES (49, 49, 54, 1);
INSERT INTO `shop_order_goods` VALUES (50, 50, 6, 1);
INSERT INTO `shop_order_goods` VALUES (51, 51, 21, 1);
INSERT INTO `shop_order_goods` VALUES (52, 52, 27, 1);
INSERT INTO `shop_order_goods` VALUES (53, 53, 36, 1);
INSERT INTO `shop_order_goods` VALUES (54, 54, 60, 1);
INSERT INTO `shop_order_goods` VALUES (55, 55, 47, 1);
INSERT INTO `shop_order_goods` VALUES (56, 56, 57, 1);
INSERT INTO `shop_order_goods` VALUES (57, 57, 4, 2);
INSERT INTO `shop_order_goods` VALUES (58, 58, 49, 1);

-- ----------------------------
-- Table structure for shop_order_status
-- ----------------------------
DROP TABLE IF EXISTS `shop_order_status`;
CREATE TABLE `shop_order_status`  (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '状态表ID(被订单表的order_status字段关联)',
  `status_name` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '状态名',
  `member_opt` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '会员操作',
  `admin_opt` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员操作',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_order_status
-- ----------------------------
INSERT INTO `shop_order_status` VALUES (1, '已下单，未付款', '去付款', '待付款');
INSERT INTO `shop_order_status` VALUES (2, '已付款，未发货', '待发货', '发货');
INSERT INTO `shop_order_status` VALUES (3, '已发货，未签收', '签收', '待确认');
INSERT INTO `shop_order_status` VALUES (4, '已签收，未评价', '去评价', '待评价');
INSERT INTO `shop_order_status` VALUES (5, '已评价，订单完成', '订单完成', '订单完成');

-- ----------------------------
-- Table structure for shop_vote
-- ----------------------------
DROP TABLE IF EXISTS `shop_vote`;
CREATE TABLE `shop_vote`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '投票表主键ID',
  `aid` int(11) NOT NULL COMMENT '活动表主键ID',
  `ip` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '投票人电脑IP',
  `votetime` int(10) NOT NULL COMMENT '投票时间',
  `votenum` tinyint(1) NOT NULL DEFAULT 0 COMMENT '投票次数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_vote
-- ----------------------------
INSERT INTO `shop_vote` VALUES (1, 21, '172.16.17.184', 1480572702, 1);
INSERT INTO `shop_vote` VALUES (2, 13, '172.16.17.184', 1480595669, 2);
INSERT INTO `shop_vote` VALUES (3, 25, '172.16.17.184', 1480640339, 1);
INSERT INTO `shop_vote` VALUES (4, 13, '192.168.4.55', 1480666554, 3);

-- ----------------------------
-- Table structure for shop_vote_filter
-- ----------------------------
DROP TABLE IF EXISTS `shop_vote_filter`;
CREATE TABLE `shop_vote_filter`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '投票过滤表主键ID',
  `ip` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '投票人主机IP',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop_vote_filter
-- ----------------------------
INSERT INTO `shop_vote_filter` VALUES (4, '172.16.17.184');

SET FOREIGN_KEY_CHECKS = 1;
