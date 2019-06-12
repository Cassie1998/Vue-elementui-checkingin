-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-12-10 13:18:45
-- 服务器版本： 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuethink`
--

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_access`
--

DROP TABLE IF EXISTS `oa_admin_access`;
CREATE TABLE IF NOT EXISTS `oa_admin_access` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_access`
--

INSERT INTO `oa_admin_access` (`user_id`, `group_id`) VALUES
(2, 15),
(4, 15),
(5, 15),
(6, 15),
(7, 15),
(8, 15),
(9, 15),
(10, 15),
(11, 15),
(12, 15),
(13, 15),
(14, 15),
(15, 15),
(16, 15),
(17, 15),
(18, 15),
(19, 15),
(20, 15),
(21, 15),
(22, 15),
(23, 15),
(24, 15),
(25, 15),
(26, 15),
(27, 15),
(28, 15),
(29, 15),
(30, 15),
(31, 15),
(32, 15),
(33, 15),
(34, 15);
-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_eqpindividual`
--

DROP TABLE IF EXISTS `oa_admin_eqpindividual`;
CREATE TABLE IF NOT EXISTS `oa_admin_eqpindividual` (
  `id` int(11) NOT NULL COMMENT '装备个体id',
  `menuid` int(11) NOT NULL DEFAULT '0' COMMENT '对应的装备类别id',
  `name` varchar(200) DEFAULT NULL COMMENT '会议名称',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0未开始1已开始2进行中3已结束',
  `brand` varchar(200) DEFAULT NULL COMMENT '参与部门',
  `model` varchar(25) not null COMMENT '会议时间',
  `manufacture` varchar(500) DEFAULT NULL COMMENT '参与职位',
  `retailer` varchar(20) DEFAULT NULL COMMENT '参与部门id',
  `pictrue` varchar(255) DEFAULT NULL COMMENT '设备图片',
  `detail`  varchar(20) NOT NULL COMMENT '会议地点',
  `target` varchar(255) DEFAULT NULL COMMENT '参与岗位id',
  `price` date NOT NULL DEFAULT '0' COMMENT '会议日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_eqpindividual`
--

INSERT INTO `oa_admin_eqpindividual` (`id`, `menuid`, `name`, `model`,`detail`,`status`, `brand`, `manufacture`, `retailer`, `pictrue`,  `target`, `price`) VALUES
(6, 70, '人力资源部小组会', '10:00','办公楼1N-125',0 , '人力资源部', '所有员工', '', 'src/assets/logo.png', '多波束一 主要指标', '2019-03-01');
-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_eqpindividual`
--

DROP TABLE IF EXISTS `oa_admin_qiandao`;
CREATE TABLE IF NOT EXISTS `oa_admin_qiandao` (
  `id` int(11) NOT NULL COMMENT '会议id',
  `user_id` int(11) NOT NULL COMMENT '员工id',
  `realname` varchar(200) DEFAULT NULL COMMENT '员工姓名',
  `structure_id` int(11) DEFAULT NULL COMMENT '部门',
  `post_id` int(11) DEFAULT NULL COMMENT '岗位',
  `status` tinyint(3) DEFAULT NULL COMMENT '状态,1启用0禁用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_eqpindividual`
--



--
-- 表的结构 `oa_admin_group`
--

DROP TABLE IF EXISTS `oa_admin_group`;
CREATE TABLE IF NOT EXISTS `oa_admin_group`  (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `rules` varchar(4000) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_group`
--

INSERT INTO `oa_admin_group` (`id`, `title`, `rules`, `pid`, `remark`, `status`) VALUES
(15, '普通会员', '1,2,3,4,5,6,7,8,9,10,63,62,61,59,45,44,43,42,41,40,39,38,37,36,35,34,33,32,31,30,64', 0, '最厉害的组别', 1);

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_menu`
--

DROP TABLE IF EXISTS `oa_admin_menu`;
CREATE TABLE IF NOT EXISTS `oa_admin_menu`(
  `id` int(11) UNSIGNED NOT NULL COMMENT '菜单ID',
  `pid` int(11) UNSIGNED DEFAULT '0' COMMENT '上级菜单ID',
  `title` varchar(32) DEFAULT '' COMMENT '菜单名称',
  `url` varchar(127) DEFAULT '' COMMENT '链接地址',
  `icon` varchar(64) DEFAULT '' COMMENT '图标',
  `menu_type` tinyint(4) DEFAULT NULL COMMENT '菜单类型',
  `sort` tinyint(4) UNSIGNED DEFAULT '0' COMMENT '排序（同级有效）',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态',
  `rule_id` int(11) DEFAULT NULL COMMENT '权限id',
  `module` varchar(50) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL COMMENT '三级菜单吗'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='【配置】后台菜单表';

--
-- 转存表中的数据 `oa_admin_menu`
--

INSERT INTO `oa_admin_menu` (`id`, `pid`, `title`, `url`, `icon`, `menu_type`, `sort`, `status`, `rule_id`, `module`, `menu`) VALUES
(52, 0, '管理', '', '', 1, 0, 1, 59, 'Administrative', ''),
(53, 52, '系统配置', '', '', 1, 0, 1, 61, 'Administrative', ''),
(54, 53, '菜单管理', '/home/menu/list', '', 1, 0, 1, 21, 'Administrative', 'menu'),
(55, 53, '系统参数', '/home/config/add', '', 1, 0, 1, 29, 'Administrative', 'systemConfig'),
(56, 53, '权限规则', '/home/rule/list', '', 1, 0, 1, 13, 'Administrative', 'rule'),
(57, 52, '组织架构', '', '', 1, 0, 1, 63, 'Administrative', ''),
(58, 57, '岗位管理', '/home/position/list', '', 1, 0, 1, 31, 'Administrative', 'position'),
(59, 57, '部门管理', '/home/structures/list', '', 1, 0, 1, 39, 'Administrative', 'structures'),
(60, 57, '用户组管理', '/home/groups/list', '', 1, 0, 1, 47, 'Administrative', 'groups'),
(61, 52, '账户管理', '', '', 1, 0, 1, 62, 'Administrative', ''),
(62, 61, '账户列表', '/home/users/list', '', 1, 0, 1, 55, 'Administrative', 'users'),
(65, 0, '领导登录', '', '', 1, 0, 1, 64, 'Search', ''),
(66, 65, '发起会议', '', '', 1, 0, 1, 65, 'Search', ''),
(67, 65, '查看会议', '', '', 1, 0, 1, 66, 'Search', ''),
(68, 65, '请假批准', '', '', 1, 0, 1, 67, 'Search', ''),
(69, 65, '会议签到', '', '', 1, 0, 1, 68, 'Search', ''),
(70, 66, '创建', '/home/search/device/', '', 1, 0, 1, 69, 'Search', 'duoboshu'),
  (73, 68, '请假名单', '/home/search/qingjia', '', 1, 0, 1, 74, 'Qing', 'jiarelu'),
(77, 68, '请假情况', '/home/search/qingjia/situation', '', 1, 0, 1, 74, 'Qingsit', 'qingkuang'),
(74, 69, '签到', '/home/search/device/', '', 1, 0, 1, 73, 'Search', 'suishiji'),
(75, 67, '应参加', '/home/search/table/', '', 1, 0, 1, 72, 'Table', 'yingcanjia'),
(71, 67, '已发起', '/home/search/table/', '', 1, 0, 1, 71, 'Table', 'yifaqi'),
(76, 53, '测试', '/home/demo/demo', '', 1, 0, 1, 75, 'Administrative', 'demo');

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_post`
--

DROP TABLE IF EXISTS `oa_admin_post`;
CREATE TABLE IF NOT EXISTS `oa_admin_post` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '岗位名称',
  `remark` varchar(200) DEFAULT NULL COMMENT '岗位备注',
  `create_time` int(11) DEFAULT NULL COMMENT '数据创建时间',
  `status` tinyint(5) DEFAULT 0 COMMENT '状态1已到，状态0缺席，状态2请假',
  `pid` int(11) DEFAULT NULL,
  `stucture_id` int(11) DEFAULT NULL COMMENT '对应部门id'
) ENGINE=InnoDB AUTO_INCREMENT=105002 DEFAULT CHARSET=utf8 COMMENT='岗位表';

--
-- 转存表中的数据 `oa_admin_post`
--

INSERT INTO `oa_admin_post` (`id`, `name`, `remark`, `create_time`, `status`, `pid`, `stucture_id`) VALUES
(101001, '总经理', '', 1484706862, 1, 0, 1),
(102001, '设计部部长', '', 1484706863, 1, 101001, 2),
(102002, '设计部副部长', '', 1484706863, 1, 102001, 2),
(102003, '设计小组1组长', '', 1484706863, 1, 102002, 2),
(102004, '设计小组2组长', '', 1484706863, 1, 102002, 2),
(102005, '设计组普通员工1', '', 1484706863, 1, 102003, 2),
(102006, '设计组普通员工2', '', 1544247676, 1, 102004, 2),
(103001, '职能部部长', '', 1484706863, 1, 101001, 3),
(104001, '总经办经理', '', 1484706863, 1, 101001, 4),
(105001, '项目部部长', '', 1484706863, 1, 101001, 5);

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_rentback`
--

DROP TABLE IF EXISTS `oa_admin_rentback`;
CREATE TABLE IF NOT EXISTS `oa_admin_rentback` (
  `id` int(11) NOT NULL COMMENT '主键',
  `eqp_id` int(11) NOT NULL COMMENT '设备id',
  `user_id` int(11) NOT NULL COMMENT '客户id',
  `remack` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL COMMENT '创建时间，租借时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间，归还时间',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0未归还，1已归还'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_rule`
--

DROP TABLE IF EXISTS `oa_admin_rule`;
CREATE TABLE IF NOT EXISTS `oa_admin_rule` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT '' COMMENT '名称',
  `name` varchar(100) DEFAULT '' COMMENT '定义',
  `level` tinyint(5) DEFAULT NULL COMMENT '级别。1模块,2控制器,3操作',
  `pid` int(11) DEFAULT '0' COMMENT '父id，默认0',
  `status` tinyint(3) DEFAULT '1' COMMENT '状态，1到场，0缺席，2请假'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_rule`
--

INSERT INTO `oa_admin_rule` (`id`, `title`, `name`, `level`, `pid`, `status`) VALUES
(10, '系统基础功能', 'admin', 1, 0, 1),
(11, '权限规则', 'rules', 2, 10, 1),
(13, '规则列表', 'index', 3, 11, 1),
(14, '权限详情', 'read', 3, 11, 1),
(15, '编辑权限', 'update', 3, 11, 1),
(16, '删除权限', 'delete', 3, 11, 1),
(17, '添加权限', 'save', 3, 11, 1),
(18, '批量删除权限', 'deletes', 3, 11, 1),
(19, '批量启用/禁用权限', 'enables', 3, 11, 1),
(20, '菜单管理', 'menus', 2, 10, 1),
(21, '菜单列表', 'index', 3, 20, 1),
(22, '添加菜单', 'save', 3, 20, 1),
(23, '菜单详情', 'read', 3, 20, 1),
(24, '编辑菜单', 'update', 3, 20, 1),
(25, '删除菜单', 'delete', 3, 20, 1),
(26, '批量删除菜单', 'deletes', 3, 20, 1),
(27, '批量启用/禁用菜单', 'enables', 3, 20, 1),
(28, '系统管理', 'systemConfigs', 2, 10, 1),
(29, '修改系统配置', 'save', 3, 28, 1),
(30, '岗位管理', 'posts', 2, 10, 1),
(31, '岗位列表', 'index', 3, 30, 1),
(32, '岗位详情', 'read', 3, 30, 1),
(33, '编辑岗位', 'update', 3, 30, 1),
(34, '删除岗位', 'delete', 3, 30, 1),
(35, '添加岗位', 'save', 3, 30, 1),
(36, '批量删除岗位', 'deletes', 3, 30, 1),
(37, '批量启用/禁用岗位', 'enables', 3, 30, 1),
(38, '部门管理', 'structures', 2, 10, 1),
(39, '部门列表', 'index', 3, 38, 1),
(40, '部门详情', 'read', 3, 38, 1),
(41, '编辑部门', 'update', 3, 38, 1),
(42, '删除部门', 'delete', 3, 38, 1),
(43, '添加部门', 'save', 3, 38, 1),
(44, '批量删除部门', 'deletes', 3, 38, 1),
(45, '批量启用/禁用部门', 'enables', 3, 38, 1),
(46, '用户组管理', 'groups', 2, 10, 1),
(47, '用户组列表', 'index', 3, 46, 1),
(48, '用户组详情', 'read', 3, 46, 1),
(49, '编辑用户组', 'update', 3, 46, 1),
(50, '删除用户组', 'delete', 3, 46, 1),
(51, '添加用户组', 'save', 3, 46, 1),
(52, '批量删除用户组', 'deletes', 3, 46, 1),
(53, '批量启用/禁用用户组', 'enables', 3, 46, 1),
(54, '成员管理', 'users', 2, 10, 1),
(55, '成员列表', 'index', 3, 54, 1),
(56, '成员详情', 'read', 3, 54, 1),
(57, '删除成员', 'delete', 3, 54, 1),
(59, '管理菜单', 'Adminstrative', 2, 10, 1),
(61, '系统管理二级菜单', 'systemConfig', 1, 59, 1),
(62, '账户管理二级菜单', 'personnel', 3, 59, 1),
(63, '组织架构二级菜单', 'structures', 3, 59, 1),
(64, '大洋设备', 'search', 2, 10, 1),
(65, '地球物理二级菜单', 'diqiuwuli', 3, 64, 1),
(66, '物理海洋二级菜单', 'wulihaiyang', 3, 64, 1),
(67, '海洋化学二级菜单', 'haiyanghuaxue', 3, 64, 1),
(68, '地质勘探二级菜单', 'dizhikantan', 3, 64, 1),
(69, '多波束', 'duoboshu', 3, 10, 1),
(72, '应参加', 'yingcanjia', 3, 10, 1),
(71, '已发起', 'yifaqi', 3, 10, 1),
(73, '碎石机', 'suishiji', 3, 10, 1),
(74, '加热炉', 'jiarelu', 3, 10, 1),
(75, '测试', 'demo', 3, 20, 1),
(82, '设备测试分类', 'demoss', 3, 64, 1),
(83, '设备测试', 'demo', 3, 10, 1);

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_structure`
--

DROP TABLE IF EXISTS `oa_admin_structure`;
CREATE TABLE IF NOT EXISTS `oa_admin_structure` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT '',
  `pid` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_structure`
--

INSERT INTO `oa_admin_structure` (`id`, `name`, `pid`, `status`) VALUES
(1, '广东洪睿信息科技有限公司', 0, 1),
(2, '设计部', 1, 1),
(3, '职能部', 1, 1),
(4, '总经办', 1, 1),
(5, '项目部', 1, 1),
(6, '测试部', 1, 1),
(7, '开发部', 1, 1),
(8, '市场部', 1, 1),
(9, '研发部', 1, 1),
(10, '人力资源部', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_user`
--

DROP TABLE IF EXISTS `oa_admin_user`;
CREATE TABLE IF NOT EXISTS `oa_admin_user` (
  `id` int(11) NOT NULL COMMENT '主键',
  `username` varchar(100) DEFAULT NULL COMMENT '管理后台账号',
  `password` varchar(100) DEFAULT NULL COMMENT '管理后台密码',
  `remark` varchar(100) DEFAULT NULL COMMENT '用户备注',
  `create_time` int(11) DEFAULT NULL,
  `realname` varchar(100) DEFAULT NULL COMMENT '真实姓名',
  `structure_id` int(11) DEFAULT NULL COMMENT '部门',
  `post_id` int(11) DEFAULT NULL COMMENT '岗位',
  `status` tinyint(3) DEFAULT NULL COMMENT '状态,1到场0缺席2请假'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oa_admin_user`
--

INSERT INTO `oa_admin_user` (`id`, `username`, `password`, `remark`, `create_time`, `realname`, `structure_id`, `post_id`, `status`) VALUES
(1, 'admin', 'd93a5def7511da3d0f2d171d9c344e91', '', NULL, '超级管理员', 1, 5, 1),
(20, '101001001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547818682, '张三', 1, 101001, 0),
(21, '102001001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547818919, '李四', 2, 102001, 0),
(23, '102002001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819046, '赵五', 2, 102002, 0),
(24, '102003001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819074, '王三', 2, 102003, 0),
(25, '102004001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819126, '武五', 2, 102004, 0),
(26, '102005001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819160, '酱酱', 2, 102005, 0),
(27, '102005002', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819187, '花花', 2, 102005, 0),
(28, '102005003', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819232, '凉凉', 2, 102005, 0),
(29, '102006001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819261, '方方', 2, 102006, 0),
(30, '102006002', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819299, '小红', 2, 102006, 0),
(31, '102006003', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819327, '小明', 2, 102006, 0),
(32, '103001001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819358, '小刚', 3, 103001, 0),
(33, '104001001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819395, '小东', 4, 104001, 0),
(34, '105001001', 'd93a5def7511da3d0f2d171d9c344e91', '', 1547819451, '小丽', 5, 105001, 0);


-- --------------------------------------------------------

--
-- 表的结构 `oa_system_config`
--

DROP TABLE IF EXISTS `oa_system_config`;
CREATE TABLE IF NOT EXISTS `oa_system_config` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(50) DEFAULT '',
  `value` varchar(100) DEFAULT '' COMMENT '配置值',
  `group` tinyint(4) UNSIGNED DEFAULT '0' COMMENT '配置分组',
  `need_auth` tinyint(4) DEFAULT '1' COMMENT '1需要登录后才能获取，0不需要登录即可获取'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='【配置】系统配置表';

--
-- 转存表中的数据 `oa_system_config`
--

INSERT INTO `oa_system_config` (`id`, `name`, `value`, `group`, `need_auth`) VALUES
(1, 'SYSTEM_NAME', '会议签到系统', 0, 1),
(2, 'SYSTEM_LOGO', 'uploads\\20181205\\ac6c1900734242c72ded8e84fbca0ca1.jpg', 0, 1),
(3, 'LOGIN_SESSION_VALID', '1644', 0, 1),
(4, 'IDENTIFYING_CODE', '0', 0, 1);
COMMIT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oa_admin_eqpindividual`
--
ALTER TABLE `oa_admin_eqpindividual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_group`
--
ALTER TABLE `oa_admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_menu`
--
ALTER TABLE `oa_admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_post`
--
ALTER TABLE `oa_admin_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_rentback`
--
ALTER TABLE `oa_admin_rentback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_rule`
--
ALTER TABLE `oa_admin_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_structure`
--
ALTER TABLE `oa_admin_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_admin_user`
--
ALTER TABLE `oa_admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oa_system_config`
--
ALTER TABLE `oa_system_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `参数名` (`name`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `oa_admin_eqpindividual`
--
ALTER TABLE `oa_admin_eqpindividual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '装备个体id', AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `oa_admin_group`
--
ALTER TABLE `oa_admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `oa_admin_menu`
--
ALTER TABLE `oa_admin_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单ID', AUTO_INCREMENT=84;

--
-- 使用表AUTO_INCREMENT `oa_admin_post`
--
ALTER TABLE `oa_admin_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用表AUTO_INCREMENT `oa_admin_rentback`
--
ALTER TABLE `oa_admin_rentback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=30;

--
-- 使用表AUTO_INCREMENT `oa_admin_rule`
--
ALTER TABLE `oa_admin_rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- 使用表AUTO_INCREMENT `oa_admin_structure`
--
ALTER TABLE `oa_admin_structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用表AUTO_INCREMENT `oa_admin_user`
--
ALTER TABLE `oa_admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `oa_system_config`
--
ALTER TABLE `oa_system_config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
