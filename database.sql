-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2021 年 06 月 09 日 20:31
-- 伺服器版本： 10.3.24-MariaDB
-- PHP 版本： 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `y3_project`
--
CREATE DATABASE IF NOT EXISTS `y3_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `y3_project`;

-- --------------------------------------------------------

--
-- 資料表結構 `announce_demo`
--

CREATE TABLE `announce_demo` (
  `id` int(5) NOT NULL,
  `title` varchar(256) NOT NULL,
  `detail` text NOT NULL,
  `image` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `announce_demo`
--

INSERT INTO `announce_demo` (`id`, `title`, `detail`, `image`) VALUES
(1, '到訪處所出現疑似個案', '你好 $name 先生或女士！ 你於 $time_start 至 $time_end 曾到訪的 $shop_name 處所出現疑似個案 $cnumber .因此本司正式向閣下作出通知. ', 1),
(2, 'Vaccine info', 'info', 1),
(3, 'Vaccine info', 'qwertyuiop', 2),
(4, 'Test', 'test ', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `announce_icon_path`
--

CREATE TABLE `announce_icon_path` (
  `icon_id` int(26) NOT NULL,
  `department_id` int(26) NOT NULL,
  `agency_name` text NOT NULL,
  `path` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `announce_image_path`
--

CREATE TABLE `announce_image_path` (
  `img_id` int(8) NOT NULL,
  `description` text DEFAULT NULL,
  `path` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `announce_image_path`
--

INSERT INTO `announce_image_path` (`img_id`, `description`, `path`, `create_time`) VALUES
(1, NULL, 'https://wen0750.club/y3_project/html/announce_img/2021-06-08_8666fd6af06118b96b39121f9f184551.png', '2021-06-08 14:21:04'),
(2, NULL, 'https://wen0750.club/y3_project/html/announce_img/2021-06-08_fce8029875ca72f682c913c968eedc9b.jpeg', '2021-06-08 14:22:10'),
(3, NULL, 'https://wen0750.club/y3_project/html/announce_img/2021-06-08_be38f411490c2ca2e7d147a657b68d6d.jpg', '2021-06-08 16:45:09');

-- --------------------------------------------------------

--
-- 資料表結構 `announce_post`
--

CREATE TABLE `announce_post` (
  `id` int(8) NOT NULL,
  `uid` int(12) NOT NULL,
  `post_department_id` int(5) NOT NULL,
  `post_title` varchar(512) NOT NULL,
  `post_img` int(6) NOT NULL,
  `post_details` text NOT NULL,
  `check_time_id` int(64) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT current_timestamp(),
  `author_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `announce_post`
--

INSERT INTO `announce_post` (`id`, `uid`, `post_department_id`, `post_title`, `post_img`, `post_details`, `check_time_id`, `post_time`, `author_id`) VALUES
(2, 1, 2, '到訪處所出現疑似個案', 1, '你好 $name 先生或女士！ 你於 $time_start 至 $time_end 曾到訪的 $shop_name 處所出現疑似個案 $cnumber .因此本司正式向閣下作出通知. ', 1, '2021-06-07 22:36:58', 1),
(7, 1, 2, 'Vaccine info', 1, 'info', 1, '2021-06-08 15:29:07', 1),
(8, 1, 2, 'Test', 3, 'test ', 1, '2021-06-08 16:45:51', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `panel_account`
--

CREATE TABLE `panel_account` (
  `id` int(12) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` int(6) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `first_name` varchar(24) NOT NULL,
  `last_name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `panel_department`
--

CREATE TABLE `panel_department` (
  `meta_id` int(15) NOT NULL,
  `forward_id` int(10) NOT NULL,
  `meta_key` varchar(256) NOT NULL,
  `meta_value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `panel_roles`
--

CREATE TABLE `panel_roles` (
  `id` int(11) NOT NULL,
  `role_name` int(11) NOT NULL,
  `description` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `shop_data`
--

CREATE TABLE `shop_data` (
  `id` int(12) NOT NULL,
  `company_name` varchar(129) NOT NULL,
  `register_id` varchar(24) NOT NULL,
  `telephone` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `shop_data`
--

INSERT INTO `shop_data` (`id`, `company_name`, `register_id`, `telephone`) VALUES
(1, '新視野書業集團', '750', 750),
(2, '英國廣播公司', '1668', 22558833),
(3, 'Height In Months', '123', 123),
(4, 'Golden Help Services', '166822', 98599889),
(5, 'Golden Sell Services', '166822555', 98599889),
(6, 'Golden Network Services', '166815', 988995889),
(7, 'Golden Bus Services', '166888', 98899889),
(8, '歡穎有限公司 VAST HAPPY CORPORATION LIMITED', 'G4117', 26915144),
(9, '財盟有限公司 MORAL STEP CORPORATION LIMITED', 'G4789', 27387773),
(10, '揚懋有限公司 CHARM VAST LIMITED', 'G5082', 20318465),
(11, '震峰有限公司 HILL RAY LIMITED', 'G5107', 23911780),
(12, '拓鵬有限公司 WIDE DEVELOP LIMITED', 'G5117', 21321036),
(13, '展榮有限公司 WIDER FAME CORPORATION LIMITED', 'G5118', 22808325),
(14, '啟麗有限公司 WAY NICE LIMITED', 'G5134', 25206464),
(15, '顯冠有限公司 CROWN HUGE CORPORATION LIMITED', 'G5149', 28849695),
(16, '智拓有限公司 GENIUS DEVELOP LIMITED', 'G5153', 21906825),
(17, '喜藝有限公司 CHAMP ART CORPORATION LIMITED', 'G5229', 23876207),
(18, '歡龍有限公司 JOYFUL DRAGON CORPORATION LIMITED', 'G5234', 24120426),
(19, '盟主有限公司 LEAD FAME LIMITED', 'G5235', 24472003),
(20, '億勇有限公司 BILLION BRAVE LIMITED', 'G5325', 28386120),
(21, '誼得有限公司 EARN FRIENDSHIP LIMITED', 'G5326', 28262952),
(22, '皇鴻有限公司', 'G5327', 26966346),
(23, '貿來有限公司 TRADE LOYAL LIMITED', 'G5381', 26767315),
(24, '貫陞有限公司 UP POINT CORPORATION LIMITED', 'G5382', 28179318),
(25, '億策有限公司 WELL PLAN CORPORATION LIMITED', 'G5383', 22696283),
(26, '朝星有限公司 DYNASTY STAR CORPORATION LIMITED', 'G5410', 27954723),
(27, '帝標有限公司 EMPIRE MARK CORPORATION LIMITED', 'G5411', 21735144),
(28, '良朋有限公司 FRIEND CORPORATION LIMITED', 'G5412', 27852600),
(29, '滿昌有限公司 FULL BLOOM CORPORATION LIMITED', 'G5413', 24768666),
(30, '鵬歡有限公司 JOLLY FAME LIMITED', 'G5414', 23025350),
(31, '優廣有限公司 JUMBO EXCEL LIMITED', 'G5416', 27224290),
(32, '泰喜有限公司 MIGHTY HAPPY LIMITED', 'G5419', 25611516),
(33, '百來有限公司 MILLION LOYAL CORPORATION LIMITED', 'G5421', 25622992),
(34, '忠駿有限公司 MORAL SMART LIMITED', 'G5422', 29882628),
(35, '俊銳有限公司 SMART KEEN CORPORATION LIMITED', 'G5424', 28716417),
(36, '堅耀有限公司 STRONG CHARM CORPORATION LIMITED', 'G5425', 23174923),
(37, '裕廣有限公司 WIDER FORTUNE LIMITED', 'G5428', 27929310),
(38, '寰銘有限公司 WORLD-WIDE FAME LIMITED', 'G5429', 28364817),
(39, '銘誠有限公司 HONEST DELIGHT LIMITED', 'G5516', 24342690),
(40, '廣才有限公司 TALENT LINE LIMITED', 'G5521', 23018634),
(41, '世向有限公司 WORLD FOCUS CORPORATION LIMITED', 'G5522', 24681984),
(42, '亮榮有限公司 FINE FAME CORPORATION LIMITED', 'G5535', 25830350),
(43, '裕益有限公司 FORTUNE VANTAGE CORPORATION LIMITED', 'G5536', 24064201),
(44, '偉茂有限公司 WIDE GREAT CORPORATION LIMITED', 'G5537', 28536665),
(45, '宏標國際有限公司 NICE TARGET INTERNATIONAL LIMITED', 'G4717', 25680203),
(46, '巨運國際有限公司 HUGE CHANCE INTERNATIONAL LIMITED', 'G5122', 23333859),
(47, '銀懋國際有限公司 CHARM SILVER INTERNATIONAL LIMITED', 'G5185', 29362487),
(48, '浩京國際有限公司 FULLY CAPITAL INTERNATIONAL LIMITED', 'G5186', 24623006),
(49, '添峰國際有限公司 HILL TREND INTERNATIONAL LIMITED', 'G5187', 28486351),
(50, '佳益國際有限公司 ABLE NICE INTERNATIONAL LIMITED', 'G5302', 25970728),
(51, '領鴻國際有限公司 HONOUR LEADER INTERNATIONAL LIMITED', 'G5306', 27044079),
(52, '潤展國際有限公司 WIDE PROFIT INTERNATIONAL LIMITED', 'G5309', 21589059),
(53, '駿麗(香港)有限公司 NICE SMART (HONG KONG) LIMITED', 'G4721', 26655517),
(54, '寶勝(香港)有限公司 TREASURE WINNER (HONG KONG) LIMITED', 'G4879', 27369970),
(55, '展福(香港)有限公司 LUCK TREND (HONG KONG) LIMITED', 'G5016', 20878131),
(56, '滙冠(香港)有限公司 ALLIED CROWN (HONG KONG) LIMITED', 'G5059', 26349591),
(57, '盛鴻(香港)有限公司 HONOUR MAX (HONG KONG) LIMITED', 'G5060', 29964625);

-- --------------------------------------------------------

--
-- 資料表結構 `shop_qr`
--

CREATE TABLE `shop_qr` (
  `shop_id` int(12) NOT NULL,
  `qr_code` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `shop_qr`
--

INSERT INTO `shop_qr` (`shop_id`, `qr_code`) VALUES
(24, '06zKxA23e4v1sThZQmg5niJLPu'),
(44, '4CUspVla9O7HxGLXRSFo0cKYJW'),
(12, '5AGFNpxV7ubUPvyjLsI1OcrERC'),
(26, '69rU3ysAkJTqKhZbQVtueS5vF0'),
(34, '7qQgx3dIMwVAZGf0nh1RL5UYJ6'),
(28, '93BTHaK7chLXFeE28zsVJxkqyR'),
(35, 'aDzJQFNHml4MPpw79OERWodgKV'),
(46, 'AhNtdYI0H7JeLRExzSMlycwDoG'),
(7, 'BAMgl36mupnNI2TRbOYU7oqhtd'),
(40, 'BS4CyMFLE1efTm3DUnKulr0X9q'),
(6, 'C7d3KV9FbNx8McmOgXo5IEY4ve'),
(32, 'cEt2OLhzbwiFJaNk6KV9YSC0Gu'),
(45, 'dmHzsFpReT1J5oI68hYZuigB9M'),
(16, 'dPurEZDzJpCHK1vI7MiwUQBYSx'),
(27, 'flD25bNG8mRXUkdaSFcMV4PnBh'),
(25, 'Fnz72BCpuPod3SYUbEZJTeflim'),
(47, 'Gm79nOHrozdtKFQ0bA2XhTfguD'),
(4, 'GQzoEZNuYOTUfmJFgXa1yS0Kb9'),
(48, 'hXRknepT05ZEbmswW2Cg6OfYJS'),
(42, 'ITuFUS4to5z6PhxXeNi8cEg2A3'),
(14, 'IYgoj6GrkXRzT3KFHntVA2WN7c'),
(51, 'jbUJGpNVf0YsC8ik5gPolcXa2y'),
(15, 'JYNAvWB6uTRe0Mp1Cmn5OjktPs'),
(1, 'laVU0TEqKSrDpZ5e2CXIifLd1B'),
(23, 'LJPCciTvzVkMx0H5rRNe6GwfWp'),
(11, 'MfbvnP9rVsXjKkyp3RN0QSgweE'),
(43, 'N6EXywQGcOUJRzsWglSB8mTvth'),
(8, 'NJXPqpdwrVMtBuy6LFia7z39j2'),
(39, 'NOe25YsvBFJrn84SjydQUDuZRk'),
(31, 'O2k6nGZlFvVEujJ5eKaQDsmt1W'),
(3, 'PAcaFLHCQjKf5tMOwIk1shu7b2'),
(38, 'pB01VFwiQsjxIbMOyEavcNDKRH'),
(10, 'pniwOtjlmNzuH0KEDJL1fo4x6U'),
(50, 'r2LTfe4YXvqjW80DbCsndV1N3U'),
(13, 'RJaMekrYfjwKCx7zs9hT0PW5ZQ'),
(22, 'rmD2i6OP79uEeLqasMnRkKFCbW'),
(21, 'spWCFl84uDobgL5X37kMNVvcRE'),
(5, 'sqB2PVT9b7Qckh14odYSLA0Z3C'),
(49, 'SYF8IECLJl0eM341XTcK6vg2H7'),
(33, 'tZi75BTKAXrvDL4h8ewC3fzY1o'),
(30, 'vWIKfk7XlN9pjVQMZnHTGcELuR'),
(9, 'wpF4W362dMqYoabTQu1hJGcP0i'),
(37, 'WyUPa8K56xgJhCXtVLlomHw32j'),
(36, 'xpGieXgL2KqICftOAwuZd5M0mz'),
(18, 'YEwaFJrHf1pbCzl8cIPn7O02uW'),
(20, 'yfndg40LWcGYHPRbwi5h2NvIJe'),
(2, 'Ykf5AuyKnD1WrxUjFwlRXgJT3i'),
(29, 'yU2CWwnjH1TcmiQotdzBLVpN75'),
(19, 'Yv2Z4E1FPBXdM0gyJ6hmftceCs'),
(41, 'yYNBWjC0PU5l9SkomzXAI8cKRL'),
(17, 'zIf3So9ADkt4eHvuC56ObEGVNy');

-- --------------------------------------------------------

--
-- 資料表結構 `user_account`
--

CREATE TABLE `user_account` (
  `uuid` int(12) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(64) NOT NULL,
  `ac_key` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user_account`
--

INSERT INTO `user_account` (`uuid`, `email`, `password`, `ac_key`) VALUES
(1, 'wenfaceyou@gmail.com', '$2y$10$GHCC2a.KY.cxJEtvm1cRn.LBL2GRvdb7q5LD/Bzx/bfjP2q/YaJkC', '$2y$10$d0pvtmA.hFAFPOOcBcwLGuKpwd6aPaj6jYbmi/fRSnTdElk4XsnUe'),
(2, 'syncnine@aol.com', '$2y$10$IGXsGCe.BHu5mXTjoJy3y.I7QlccSBmjsYVYFbRA.8ft0eei.94YK', '$2y$10$IGXsGCe.BHu5mXTjoJy3y.I7QlccSBmjsYVYFbRA.8ft0eei.94YK'),
(3, 'aschmitz@mac.com', '$2y$10$iVFwPn7hWM5rQDlACd218u0p6iR3R5yWKlKaRt86D2ovrAEWaaU8G', '$2y$10$iVFwPn7hWM5rQDlACd218u0p6iR3R5yWKlKaRt86D2ovrAEWaaU8G'),
(4, 'dwsauder@msn.com', '$2y$10$.dviNSWIrI7CUZiQ4oc9sOUch3VZwDR2uhaxdjEicdyRSEyo7TBEG', '$2y$10$.dviNSWIrI7CUZiQ4oc9sOUch3VZwDR2uhaxdjEicdyRSEyo7TBEG'),
(5, 'sjmuir@sbcglobal.net', '$2y$10$Pa05qN76BqKpjceCLrdaf..iAVrf/o5K366zwK1T6fKi131VxhAoK', '$2y$10$Pa05qN76BqKpjceCLrdaf..iAVrf/o5K366zwK1T6fKi131VxhAoK'),
(6, 'fbriere@hotmail.com', '$2y$10$Fgu.JSje1mhggaN/0D78H.57B/F9GVE1UQtTSknVgjXemw1mnWe22', '$2y$10$Fgu.JSje1mhggaN/0D78H.57B/F9GVE1UQtTSknVgjXemw1mnWe22'),
(7, 'larry@icloud.com', '$2y$10$60gmb6F736apzPZnFlGUDOs2qEwhWgeAFo2Xe3CizrUvbzoq5kYXe', '$2y$10$60gmb6F736apzPZnFlGUDOs2qEwhWgeAFo2Xe3CizrUvbzoq5kYXe'),
(8, 'jshirley@msn.com', '$2y$10$5gvf1Aa123lBNJ30tlOqFuLEZHkfFQPmuwU82.wKDDequf5BDEuye', '$2y$10$5gvf1Aa123lBNJ30tlOqFuLEZHkfFQPmuwU82.wKDDequf5BDEuye'),
(9, 'frosal@msn.com', '$2y$10$6yw72wlCcHB9W4FjW/LZsOA8FbmSc5.6cexCWHAhe/qQldWfZ3616', '$2y$10$6yw72wlCcHB9W4FjW/LZsOA8FbmSc5.6cexCWHAhe/qQldWfZ3616'),
(10, 'boser@optonline.net', '$2y$10$UrR2egv0dH93IXN/KYIDqeYamH.Tok6LecOZ7W8xFnW4Owv9fMEBu', '$2y$10$UrR2egv0dH93IXN/KYIDqeYamH.Tok6LecOZ7W8xFnW4Owv9fMEBu'),
(11, 'kidehen@sbcglobal.net', '$2y$10$TVyPd1SDgjAdHvMj/S24f.LWV823FG6ShimGA4dLw2KLWbDejKQkq', '$2y$10$TVyPd1SDgjAdHvMj/S24f.LWV823FG6ShimGA4dLw2KLWbDejKQkq'),
(12, 'esasaki@hotmail.com', '$2y$10$ZW1SpZFZ0pS/dtt8759t7OXfJZooCWyZP64CLyBIag/yum3RMnroS', '$2y$10$ZW1SpZFZ0pS/dtt8759t7OXfJZooCWyZP64CLyBIag/yum3RMnroS'),
(13, 'syrinx@live.com', '$2y$10$WSbuP1u8EAl9xjSO/1IakuCjr3TZKKssmVMSnAEo/dhuKnp/bxYwO', '$2y$10$WSbuP1u8EAl9xjSO/1IakuCjr3TZKKssmVMSnAEo/dhuKnp/bxYwO'),
(14, 'unreal@outlook.com', '$2y$10$qKWwM0X7uaTf9kc48qiIn.2hupr4sYaNTOOfgA.AVaIllU/iH3Gju', '$2y$10$qKWwM0X7uaTf9kc48qiIn.2hupr4sYaNTOOfgA.AVaIllU/iH3Gju'),
(15, 'lamprecht@icloud.com', '$2y$10$mXABgVClZjxD7SPOK3DFcuRVDZeJOsJM13K8Na64bYL/afElWwxjG', '$2y$10$mXABgVClZjxD7SPOK3DFcuRVDZeJOsJM13K8Na64bYL/afElWwxjG'),
(16, 'draper@gmail.com', '$2y$10$/bbFj8KBv2olMdylRS6hr.tzP9VaD5UUolG/xL6Kc.cKG9DO5.N52', '$2y$10$/bbFj8KBv2olMdylRS6hr.tzP9VaD5UUolG/xL6Kc.cKG9DO5.N52'),
(17, 'csilvers@sbcglobal.net', '$2y$10$pxHyHGm/9FKdCfIgKZkDuOfMGHFL/f9uLK/CFWjqAZMWyC41XAuua', '$2y$10$pxHyHGm/9FKdCfIgKZkDuOfMGHFL/f9uLK/CFWjqAZMWyC41XAuua'),
(18, 'parksh@att.net', '$2y$10$YsqprX0.mxSA8I0D1qg7n.yUV6IEbTIhkst0wK9.I8Mw4yoVROJWK', '$2y$10$YsqprX0.mxSA8I0D1qg7n.yUV6IEbTIhkst0wK9.I8Mw4yoVROJWK'),
(19, 'hedwig@comcast.net', '$2y$10$NUQGfc5we7b1w6FoAL/PReb03FUZHShvmlvTpuQJo6PFVUvSAFLA6', '$2y$10$NUQGfc5we7b1w6FoAL/PReb03FUZHShvmlvTpuQJo6PFVUvSAFLA6'),
(20, 'aaribaud@me.com', '$2y$10$w5.ZbLef/SFdQcVxNrMjtOLIXIXWN8KDBUQ4rkq803NbcVLTfMIPG', '$2y$10$w5.ZbLef/SFdQcVxNrMjtOLIXIXWN8KDBUQ4rkq803NbcVLTfMIPG'),
(21, 'oracle@att.net', '$2y$10$NSSeAvhhSC1TiFh/EEqh1.j.uLnSXyErYKkSVHxz6ufw74CpQ8rYS', '$2y$10$NSSeAvhhSC1TiFh/EEqh1.j.uLnSXyErYKkSVHxz6ufw74CpQ8rYS'),
(22, 'formis@aol.com', '$2y$10$M1P0v0WLs3uQXAnzMsXpWe/tM/LphdCNfuxVvi.xIM6X9WVMAKL2K', '$2y$10$M1P0v0WLs3uQXAnzMsXpWe/tM/LphdCNfuxVvi.xIM6X9WVMAKL2K'),
(23, 'pkilab@aol.com', '$2y$10$EDj6cgvL48aMvSu1lSpYa.ESk.HE.5oMwoymETxuT8ODg/kdo1zL2', '$2y$10$EDj6cgvL48aMvSu1lSpYa.ESk.HE.5oMwoymETxuT8ODg/kdo1zL2'),
(24, 'zavadsky@outlook.com', '$2y$10$yEca3iIsw3j.AwblptJdAu9wRdg4itEoSLhpaaqA3sn.Prr6sU0FG', '$2y$10$yEca3iIsw3j.AwblptJdAu9wRdg4itEoSLhpaaqA3sn.Prr6sU0FG'),
(25, 'nacho@icloud.com', '$2y$10$8BALkLp0NHLZtxk0B8inF.VNejSDuHZSwOQoJ9PG3w83MAxBFqdSq', '$2y$10$8BALkLp0NHLZtxk0B8inF.VNejSDuHZSwOQoJ9PG3w83MAxBFqdSq'),
(26, 'errxn@optonline.net', '$2y$10$sSnNP9UBmHY2kq/q2PTSIuNXiJItzfZRJXA94hb55DDLg8Xk05dmi', '$2y$10$sSnNP9UBmHY2kq/q2PTSIuNXiJItzfZRJXA94hb55DDLg8Xk05dmi'),
(27, 'skajan@me.com', '$2y$10$7QfjKs/0vOro1FR0S4/VGOqHQXpknpEXnSj9jjVBtxujOWYgBcGSG', '$2y$10$7QfjKs/0vOro1FR0S4/VGOqHQXpknpEXnSj9jjVBtxujOWYgBcGSG'),
(28, 'terjesa@gmail.com', '$2y$10$wb805AbblYj8YJ4aZFzjBe/9zi0YVc2CPXkfVa7G5DNfgYl6DC5r2', '$2y$10$wb805AbblYj8YJ4aZFzjBe/9zi0YVc2CPXkfVa7G5DNfgYl6DC5r2'),
(29, 'suresh@att.net', '$2y$10$ozxt5GSw8Iz1NzymglUfZ.dO4jxWpBP2Z9IFY1mbGruXNCh3Rkb2m', '$2y$10$ozxt5GSw8Iz1NzymglUfZ.dO4jxWpBP2Z9IFY1mbGruXNCh3Rkb2m'),
(30, 'cliffordj@outlook.com', '$2y$10$ecpQOgCwAvcX3NGOl3./.OlKD05Dj4gDSZjKi7AUawOex2rAYweW6', '$2y$10$ecpQOgCwAvcX3NGOl3./.OlKD05Dj4gDSZjKi7AUawOex2rAYweW6'),
(31, 'arebenti@att.net', '$2y$10$2lPQv3hAd38un5qoJLYyGuW.7mmNAQtaCKqb7N8Z16yQBFrYdAw/2', '$2y$10$2lPQv3hAd38un5qoJLYyGuW.7mmNAQtaCKqb7N8Z16yQBFrYdAw/2'),
(32, 'stewwy@yahoo.com', '$2y$10$9IfUvP7uws0uYHPw.mPwaei/0EYZ29qYfg.G77353kE4Q5WnwN3Ra', '$2y$10$9IfUvP7uws0uYHPw.mPwaei/0EYZ29qYfg.G77353kE4Q5WnwN3Ra'),
(33, 'tubajon@optonline.net', '$2y$10$udomIdJn.zJpYTsbQCHhjurzZ/i0m/OOM8ws6d8l9eamKSGZ7DHR.', '$2y$10$udomIdJn.zJpYTsbQCHhjurzZ/i0m/OOM8ws6d8l9eamKSGZ7DHR.'),
(34, 'hauma@optonline.net', '$2y$10$yj1klKC42OkA34wUeiu4z.HOe7lCx5M.c6h68IdBrD2Jduiu5jWB6', '$2y$10$yj1klKC42OkA34wUeiu4z.HOe7lCx5M.c6h68IdBrD2Jduiu5jWB6'),
(35, 'ilikered@icloud.com', '$2y$10$el/YSNlfVAfh7aDjiTpgEeVgH/6WXU9KVVHp7qIMXCoqvS40JSAH6', '$2y$10$el/YSNlfVAfh7aDjiTpgEeVgH/6WXU9KVVHp7qIMXCoqvS40JSAH6'),
(36, 'muzzy@verizon.net', '$2y$10$lIS2tzmn4PRQa7IMej1ZXOOYRq0x7xlaBmVYAaB6ygjPF5P0PxQJy', '$2y$10$lIS2tzmn4PRQa7IMej1ZXOOYRq0x7xlaBmVYAaB6ygjPF5P0PxQJy'),
(37, 'claypool@optonline.net', '$2y$10$9.6NBhzi88QJFilvU98rjOodXEX1.FIUsk.nI95gn5vNehPRRUAZK', '$2y$10$9.6NBhzi88QJFilvU98rjOodXEX1.FIUsk.nI95gn5vNehPRRUAZK'),
(38, 'matloff@yahoo.ca', '$2y$10$UOcOxPVh0Cwo9FdOHpXFoe2aNZft3Zm0e3j3gwpD8dk5gnH4DpNQ6', '$2y$10$UOcOxPVh0Cwo9FdOHpXFoe2aNZft3Zm0e3j3gwpD8dk5gnH4DpNQ6'),
(39, 'portscan@att.net', '$2y$10$Jw.8S2DguRvAbRQEP2.HSOKbTBZ3clYuD2lSLpmTALS7BzVCC0abC', '$2y$10$Jw.8S2DguRvAbRQEP2.HSOKbTBZ3clYuD2lSLpmTALS7BzVCC0abC'),
(40, 'wildfire@sbcglobal.net', '$2y$10$HEjZ/Bk8dEyl0DY6CZ2sL.Q4pkTrEvXrvnoFjheexA83q1sK47zOG', '$2y$10$HEjZ/Bk8dEyl0DY6CZ2sL.Q4pkTrEvXrvnoFjheexA83q1sK47zOG'),
(41, 'mcraigw@outlook.com', '$2y$10$b5lEA2wLDyS5HXrjw7k8luRYYnBQlOeryS8uZX1cT/HcLZlpHklM6', '$2y$10$b5lEA2wLDyS5HXrjw7k8luRYYnBQlOeryS8uZX1cT/HcLZlpHklM6'),
(42, 'agapow@aol.com', '$2y$10$VhR7867dfYoi7prg279Le.tvRBVhPt1VYRhp9undVi9Ax05ezxcQ6', '$2y$10$VhR7867dfYoi7prg279Le.tvRBVhPt1VYRhp9undVi9Ax05ezxcQ6'),
(43, 'mschwartz@yahoo.ca', '$2y$10$gMiewNQVdB/SgLgE53ETFufV89HhMvWPQlKtEqJR04MniRj4.ItcW', '$2y$10$gMiewNQVdB/SgLgE53ETFufV89HhMvWPQlKtEqJR04MniRj4.ItcW'),
(44, 'melnik@sbcglobal.net', '$2y$10$w.gEXuzg5GBbENl/wPcVpO1jAvwCuXDc3pClcHdU/jQxwGJb83Akq', '$2y$10$w.gEXuzg5GBbENl/wPcVpO1jAvwCuXDc3pClcHdU/jQxwGJb83Akq'),
(45, 'mschwartz@sbcglobal.net', '$2y$10$Kc1qz8V6IGLFdvfWQrJzUO4uJxrafwMCvYYXU/I19XV7uo0iH44ha', '$2y$10$Kc1qz8V6IGLFdvfWQrJzUO4uJxrafwMCvYYXU/I19XV7uo0iH44ha'),
(46, 'mwitte@icloud.com', '$2y$10$hcHcqbTNZtqYML7gr.oA7.PMGxH6f1Pa/4EEerho2PiXXE/cxT1OW', '$2y$10$hcHcqbTNZtqYML7gr.oA7.PMGxH6f1Pa/4EEerho2PiXXE/cxT1OW'),
(47, 'adamk@icloud.com', '$2y$10$pm/q8yVu0OmtXp82vxK7teew9rj3BS0iz1rF5nhAghFB2Wg9S2VNq', '$2y$10$pm/q8yVu0OmtXp82vxK7teew9rj3BS0iz1rF5nhAghFB2Wg9S2VNq'),
(48, 'nweaver@comcast.net', '$2y$10$laZ/igKxJDU56IsuAIAWQesFDOo4Ewx91La.6YKv7vwXrGUgfeKx6', '$2y$10$laZ/igKxJDU56IsuAIAWQesFDOo4Ewx91La.6YKv7vwXrGUgfeKx6'),
(49, 'saridder@sbcglobal.net', '$2y$10$8qkl5i6Sb7VSkByEoRNbMemoUTMMB40hRvKaozoseU67cjLccGy4q', '$2y$10$8qkl5i6Sb7VSkByEoRNbMemoUTMMB40hRvKaozoseU67cjLccGy4q'),
(50, 'rddesign@optonline.net', '$2y$10$UJCQAb2ho6YkGTaBrm4zW.djBBccdFiiyQ.01os/ucLUqoAKmIZ4W', '$2y$10$UJCQAb2ho6YkGTaBrm4zW.djBBccdFiiyQ.01os/ucLUqoAKmIZ4W'),
(51, 'burns@hotmail.com', '$2y$10$nO22dZfHDk15GD7bnWEyKeVn/0b/1QS7pE6Ai7sKEZPUZ/VUyvrKq', '$2y$10$nO22dZfHDk15GD7bnWEyKeVn/0b/1QS7pE6Ai7sKEZPUZ/VUyvrKq'),
(52, 'heroine@gmail.com', '$2y$10$wtZEo1OIpe4RJ3I.AzqeuOjZgtkZXx96MsykNJcMlLCDG95r2oqb6', '$2y$10$wtZEo1OIpe4RJ3I.AzqeuOjZgtkZXx96MsykNJcMlLCDG95r2oqb6'),
(53, 'irving@comcast.net', '$2y$10$DKdO1yqly.SR2wj1D1SE2ORN2cJZt7UCDSZVSMBRXIBtw0Vt5z3c.', '$2y$10$DKdO1yqly.SR2wj1D1SE2ORN2cJZt7UCDSZVSMBRXIBtw0Vt5z3c.'),
(54, 'sopwith@att.net', '$2y$10$foEADdgi4I/kWdpbkkJA1.63LAHwWn10Icfwn5U/e5/b9J/CcUt1K', '$2y$10$foEADdgi4I/kWdpbkkJA1.63LAHwWn10Icfwn5U/e5/b9J/CcUt1K'),
(55, 'rhialto@sbcglobal.net', '$2y$10$zltVivhwl4D0KIS1SN/9Kuk7bBwYGjAW2jA58tMxfwAya3ElFbwlW', '$2y$10$zltVivhwl4D0KIS1SN/9Kuk7bBwYGjAW2jA58tMxfwAya3ElFbwlW'),
(56, 'him0211', '$2y$10$iX49v/3/D4ILrAi7T9D5/es2xoYP3hbplXH2rYSQbFzTTRhPtBPMm', '$2y$10$d7ZgF7tLurqfsbhrvsRLaO1DcJqbgGrrsXrAZBco6f9p.9weXW5t.'),
(57, 'him123', '$2y$10$HZEq5j70McGRe5NVDK8FleT1l./maC6QCTPsygOpaUkD7t5v/1eLS', '$2y$10$YzIe0R2/4UuPgH3waN0m3utFH5u0Mr1VeNPly/mTRbfsE214HyJiC'),
(58, 'wenjia2630213722@gmail.com', '$2y$10$fNkKrYiFmwvUog7u7r4VNOVIb1zMGbka3DsCl45Kww/icwBGCNI6O', '$2y$10$CqTOdDsw/tpl2c0vdiaiUuoielNYW0AdwQra8eBpxBazO85YtF9hu');

-- --------------------------------------------------------

--
-- 資料表結構 `user_check_time`
--

CREATE TABLE `user_check_time` (
  `id` int(64) NOT NULL,
  `uuid` int(12) NOT NULL,
  `shop_id` int(16) NOT NULL,
  `check_in` timestamp NULL DEFAULT current_timestamp(),
  `check_out` timestamp NULL DEFAULT NULL,
  `health` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user_check_time`
--

INSERT INTO `user_check_time` (`id`, `uuid`, `shop_id`, `check_in`, `check_out`, `health`) VALUES
(1, 1, 1, '2021-06-06 07:19:26', '2021-06-06 07:19:56', 0),
(2, 58, 22, '2021-06-06 11:55:03', '2021-06-06 11:54:05', 0),
(3, 58, 3, '2021-06-06 12:29:08', '2021-06-06 12:28:15', 0),
(4, 1, 3, '2021-06-06 12:30:10', '2021-06-06 12:29:15', 0),
(5, 1, 19, '2021-06-06 12:30:29', '2021-06-06 12:29:45', 1),
(6, 1, 21, '2021-06-06 12:30:48', '2021-06-06 12:29:53', 0),
(7, 1, 23, '2021-06-06 12:31:00', '2021-06-06 12:30:04', 0),
(8, 1, 1, '2021-06-08 06:05:53', NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user_data`
--

CREATE TABLE `user_data` (
  `id` int(12) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `idcid` varchar(10) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telephone` int(8) NOT NULL,
  `address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user_data`
--

INSERT INTO `user_data` (`id`, `fullname`, `idcid`, `email`, `telephone`, `address`) VALUES
(1, '陳大文', 'M123456(7)', 'wenfaceyou@gmail.com', 54630669, '666'),
(2, '婷', 'J8888888', 'syncnine@aol.com', 68924686, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(3, '杜婷婷', 'Z1263456', 'aschmitz@mac.com', 58769259, 'Rm 602 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(4, '洪靜芳', 'H9582586', 'dwsauder@msn.com', 51609227, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(5, '陳秀諭', 'Z2103096', 'sjmuir@sbcglobal.net', 95128656, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(6, '林志瑋', 'Y4675973', 'fbriere@hotmail.com', 69833725, 'Rm 602 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(7, '邱旺緯', 'K3067882', 'larry@icloud.com', 29400207, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(8, '劉慧君', 'D3253520', 'jshirley@msn.com', 28112305, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(9, '林聖秀', 'M9341116', 'frosal@msn.com', 87007874, 'Rm 602 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(10, '鄭詩婷', 'S8195147', 'boser@optonline.net', 27782050, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(11, '陳家財', 'C8456117', 'kidehen@sbcglobal.net', 80072202, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(12, '柯淑芬', 'W0667563', 'esasaki@hotmail.com', 95577082, 'Rm 602 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(13, '陳盈珍', 'C6391484', 'syrinx@live.com', 31057912, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(14, '劉雅惠', 'L2596213', 'unreal@outlook.com', 88279546, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(15, '許宏穎', 'O0378500', 'lamprecht@icloud.com', 63298302, 'Rm 602 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(16, '蔡琳堅', 'U1356841', 'draper@gmail.com', 76458825, 'Rm 601 Hollywood Plaza 610 Nathan Road Mongkok, Yau Tsim Mong District, Hong Kong'),
(17, '陳奕堯', 'P033915A', 'csilvers@sbcglobal.net', 31921991, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(18, '王秀琬', 'F1878219', 'parksh@att.net', 93642034, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(19, '陳俊諺', 'R4266004', 'hedwig@comcast.net', 80624905, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(20, '蘇書季', 'Z2630533', 'aaribaud@me.com', 28002094, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(21, '卓慧婷', 'G3315400', 'oracle@att.net', 21273511, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(22, '袁宜映', 'C2443293', 'formis@aol.com', 57889758, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(23, '郭惠玲', 'B8177309', 'pkilab@aol.com', 49113115, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(24, '林慧全', 'R608034A', 'zavadsky@outlook.com', 80914696, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(25, '王淑惠', 'D2797586', 'nacho@icloud.com', 46528359, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(26, '陳柏成', 'G4837710', 'errxn@optonline.net', 69824063, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(27, '鄧詩婷', 'S986655A', 'skajan@me.com', 89196265, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(28, '林智凱', 'F5485785', 'terjesa@gmail.com', 33371329, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(29, '周瑋琦', 'N0317037', 'suresh@att.net', 57147412, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(30, '蔡家宏', 'Z294107A', 'cliffordj@outlook.com', 30611543, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(31, '徐信宏', 'S4619805', 'arebenti@att.net', 70955621, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(32, '李冠凌', 'V5701945', 'stewwy@yahoo.com', 23873044, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(33, '陳映茹', 'F2320467', 'tubajon@optonline.net', 61008599, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(34, '蔡淑書', 'C4185232', 'hauma@optonline.net', 94013057, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(35, '穆冠桂', 'A6506529', 'ilikered@icloud.com', 30858858, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(36, '楊惠雯', 'D8276500', 'muzzy@verizon.net', 42676179, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(37, '葉怡玫', 'J0006154', 'claypool@optonline.net', 76143808, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(38, '林育綸', 'D0037462', 'matloff@yahoo.ca', 82168434, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(39, '林慧龍', 'C1041892', 'portscan@att.net', 34430477, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(40, '林瑋婷', 'L689863A', 'wildfire@sbcglobal.net', 97939984, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(41, '吳妍瑞', 'N0770246', 'mcraigw@outlook.com', 42813095, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(42, '王馥柔', 'M5693042', 'agapow@aol.com', 50671986, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(43, '陳弘人', 'C7485814', 'mschwartz@yahoo.ca', 68047826, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(44, '林雅君', 'U6880735', 'melnik@sbcglobal.net', 63432482, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(45, '宋家弘', 'B6524821', 'mschwartz@sbcglobal.net', 28737476, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(46, '連英傑', 'K406447A', 'mwitte@icloud.com', 84711244, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(47, '王翰怡', 'P2981851', 'adamk@icloud.com', 41603555, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(48, '林承意', 'U7748040', 'nweaver@comcast.net', 91067506, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(49, '李子枝', 'Q0128194', 'saridder@sbcglobal.net', 35899570, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(50, '楊姿伶', 'E6545908', 'rddesign@optonline.net', 57556637, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(51, '黃美玲', 'I5507442', 'burns@hotmail.com', 90725039, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(52, '陳思民', 'T0850033', 'heroine@gmail.com', 96175658, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(53, '李佳意', 'X865840A', 'irving@comcast.net', 51160714, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(54, '宋仰傑', 'S9622278', 'sopwith@att.net', 88122425, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(55, '鄭亮東', 'T6469048', 'rhialto@sbcglobal.net', 23159324, 'Street167, Shing Mun Road Locality Hong Kong, Tsuen Wan District, Sam Tung Uk Resite Village, Kwan Mun Hau Tsuen Country Hong Kong'),
(56, 'him', 'hk', 'him0211', 12345678, 'hk'),
(57, 'him', 'y123', 'him123', 12345678, 'hk'),
(58, 'Wen', 'M987654(3)', 'wenjia2630213722@gmail.com', 98765432, 'guo');

-- --------------------------------------------------------

--
-- 資料表結構 `user_relation`
--

CREATE TABLE `user_relation` (
  `meta_id` int(24) NOT NULL,
  `fid` int(12) NOT NULL,
  `meta_key` varchar(256) NOT NULL,
  `meta_value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user_relation`
--

INSERT INTO `user_relation` (`meta_id`, `fid`, `meta_key`, `meta_value`) VALUES
(1, 1, '_close_contacts', '12'),
(2, 1, '_close_contacts', '11'),
(3, 1, '_close_contacts', '30'),
(4, 3, '_close_contacts', '1'),
(5, 3, '_close_contacts', '2');

-- --------------------------------------------------------

--
-- 資料表結構 `user_relation_pending_approval`
--

CREATE TABLE `user_relation_pending_approval` (
  `id` int(12) NOT NULL,
  `from_user` int(12) NOT NULL,
  `to_user` int(12) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `announce_demo`
--
ALTER TABLE `announce_demo`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `announce_icon_path`
--
ALTER TABLE `announce_icon_path`
  ADD PRIMARY KEY (`icon_id`);

--
-- 資料表索引 `announce_image_path`
--
ALTER TABLE `announce_image_path`
  ADD PRIMARY KEY (`img_id`);

--
-- 資料表索引 `announce_post`
--
ALTER TABLE `announce_post`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `panel_account`
--
ALTER TABLE `panel_account`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `panel_department`
--
ALTER TABLE `panel_department`
  ADD PRIMARY KEY (`meta_id`);

--
-- 資料表索引 `shop_data`
--
ALTER TABLE `shop_data`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `shop_qr`
--
ALTER TABLE `shop_qr`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `qr_code` (`qr_code`);

--
-- 資料表索引 `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`uuid`);

--
-- 資料表索引 `user_check_time`
--
ALTER TABLE `user_check_time`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idcid` (`idcid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `user_relation`
--
ALTER TABLE `user_relation`
  ADD PRIMARY KEY (`meta_id`);

--
-- 資料表索引 `user_relation_pending_approval`
--
ALTER TABLE `user_relation_pending_approval`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `announce_demo`
--
ALTER TABLE `announce_demo`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `announce_icon_path`
--
ALTER TABLE `announce_icon_path`
  MODIFY `icon_id` int(26) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `announce_image_path`
--
ALTER TABLE `announce_image_path`
  MODIFY `img_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `announce_post`
--
ALTER TABLE `announce_post`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `panel_account`
--
ALTER TABLE `panel_account`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `panel_department`
--
ALTER TABLE `panel_department`
  MODIFY `meta_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop_data`
--
ALTER TABLE `shop_data`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_account`
--
ALTER TABLE `user_account`
  MODIFY `uuid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_check_time`
--
ALTER TABLE `user_check_time`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_relation`
--
ALTER TABLE `user_relation`
  MODIFY `meta_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_relation_pending_approval`
--
ALTER TABLE `user_relation_pending_approval`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
