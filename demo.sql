-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th9 28, 2018 lúc 04:00 AM
-- Phiên bản máy phục vụ: 5.7.21
-- Phiên bản PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufactures`
--

DROP TABLE IF EXISTS `manufactures`;
CREATE TABLE IF NOT EXISTS `manufactures` (
  `manu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `manu_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manu_img` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`manu_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `manufactures`
--

INSERT INTO `manufactures` (`manu_ID`, `manu_name`, `manu_img`) VALUES
(1, 'Apple', 'apple.png'),
(2, 'Samsung', 'samsung.png'),
(3, 'Sony', 'sony.png'),
(4, 'Xiaomi', 'xiaomi.png'),
(5, 'Oppo', 'oppo.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `manu_ID` int(11) NOT NULL,
  `type_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ID`, `name`, `price`, `image`, `description`, `manu_ID`, `type_ID`) VALUES
(1, 'Apple Watch s1', 7990000, 'applewatchs1.png', 'Màn hình	AMOLED, 1.65 inch, 390 x 312 pixels\r\nKính cường lực	Ion-X strengthened glass\r\nChất liệu	Cao su\r\nChống nước	Có\r\nThiết bị kết nối	Chưa xác định\r\nThời gian sử dụng	Chờ: 22h. Sử dụng: 3h40p', 1, 4),
(2, 'OPPO Find X', 20990000, 'oppofindx.png', 'Màn hình:	AMOLED, 6.42\", Full HD+\r\nHệ điều hành:	Android 8.1 (Oreo)\r\nCamera sau:	20 MP và 16 MP (2 camera)\r\nCamera trước:	25 MP\r\nCPU:	Snapdragon 845 8 nhân\r\nRAM:	8 GB\r\nBộ nhớ trong:	256 GB\r\nThẻ SIM:\r\n2 Nano SIM, Hỗ trợ 4G', 5, 1),
(3, 'Samsung Gear Fit2 Pro', 4190000, 'samsunggearfit2pro.png', 'Màn hình	AMOLED, 1.5 inch, 216 x 432 pixels\r\nKính cường lực	Có\r\nChất liệu	Dây cao su\r\nChống nước	Có\r\nThiết bị kết nối	Android và iOS\r\nThời gian sử dụng	Khoảng 3 - 4 ngày', 2, 4),
(4, 'Samsung Note 9 512GB', 28490000, 'samsungnote9_512gb.png', 'Màn hình:	Super AMOLED, 6.4\", Quad HD+ (2K+)\r\nHệ điều hành:	Android 8.1 (Oreo)\r\nCamera sau:	2 camera 12 MP\r\nCamera trước:	8 MP\r\nCPU:	Exynos 9810 8 nhân 64 bit\r\nRAM:	8 GB\r\nBộ nhớ trong:	512 GB', 2, 1),
(5, 'iPhone X 256GB', 34790000, 'iphonex_256gb.png', 'Màn hình:	OLED, 5.8\", Super Retina\r\nHệ điều hành:	iOS 11\r\nCamera sau:	2 camera 12 MP\r\nCamera trước:	7 MP\r\nCPU:	Apple A11 Bionic 6 nhân\r\nRAM:	3 GB\r\nBộ nhớ trong:	256 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2716 mAh, có sạc nhanh', 1, 1),
(6, 'iPhone 6 32gb', 6690000, 'iphone6_32gb.png', 'Màn hình:	LED-backlit IPS LCD, 4.7\", Retina HD\r\nHệ điều hành:	iOS 11\r\nCamera sau:	8 MP\r\nCamera trước:	1.2 MP\r\nCPU:	Apple A8 2 nhân 64-bit\r\nRAM:	1 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ SIM:\r\n1 Nano SIM, Hỗ trợ 4G', 1, 1),
(7, 'iPhone Xs 256gb', 36990000, 'iphonexs_256gb.png', 'Hãng sản xuất:	Apple\r\n3G:	HSPA 42.2/5.76 Mbps\r\n4G:	LTE-A (6CA) Cat18 1200/200 Mbps\r\nKích thước:	157.5 - 77.4 - 7.7 mm\r\nTrọng lượng:	208 g\r\nLoại SIM:	Nano-SIM\r\nLoại màn hình:	Super Retina OLED\r\nKích thước màn hình:	6.5 inches\r\nĐộ phân giải màn hình:	1242 x 2688 pixel\r\nHệ điều hành:	iOS', 1, 1),
(8, 'iPhone 8 Plus', 28790000, 'iphone8plus.png', 'Màn hình:	LED-backlit IPS LCD, 5.5\", Retina HD\r\nHệ điều hành:	iOS 11\r\nCamera sau:	2 camera 12 MP\r\nCamera trước:	7 MP\r\nCPU:	Apple A11 Bionic 6 nhân\r\nRAM:	3 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2691 mAh, có sạc nhanh', 1, 1),
(9, 'Headphone Samsung eg920b', 280000, 'samsungeg280b.png', 'Jack cắm:	\r\n3.5 mm\r\nĐộ dài dây:	\r\n1.2 m\r\nPhím điều khiển:	\r\nMic thoại\r\nNghe/nhận cuộc gọi\r\nPhát/dừng chơi nhạc\r\nTăng/giảm âm lượng\r\n', 2, 3),
(10, 'Headphone Samsung ig935b', 300000, 'samsungig395b.png', 'Jack cắm:	\r\n3.5 mm\r\nĐộ dài dây:	\r\n1.2 m\r\nPhím điều khiển:	\r\nPhát/dừng chơi nhạc\r\nTăng/giảm âm lượng\r\n', 2, 3),
(11, 'Headphong Sony MDR-EX155AP', 490000, 'sonymdr-ex155ap.png', 'Jack cắm:	\r\n3.5 mm\r\nĐộ dài dây:	\r\n1.2 m\r\nPhím điều khiển:	\r\nMic thoại\r\nNghe/nhận cuộc gọi', 3, 3),
(12, 'Headphone Sony MDR-zx110AP', 590000, 'sonymdr-ez110ap.png', 'Jack cắm:	\r\n3.5 mm\r\nĐộ dài dây:	\r\n1.2 m\r\nPhím điều khiển:	\r\nMic thoại\r\nNghe/nhận cuộc gọi\r\nPhát/dừng chơi nhạc\r\nChuyển bài hát', 3, 3),
(13, 'Loa Sony SRS-xb20', 1790000, 'sonysrs-xb20.png', 'Nhà sản xuất:	\r\nSony\r\nModel:	\r\nSRS-XB20\r\nKích thước:	\r\nCao 6.9 cm - ngang 19.8 cm - dày 6.8 cm\r\nTrọng lượng:	\r\n590 g\r\nCông suất:	\r\n9W\r\nCách kết nối:	\r\nNFC\r\nBluetooth\r\nJack cắm 3.5 mm\r\nPhím điều khiển:	\r\nTăng/giảm âm lượng\r\nChỉnh Bass\r\nChuyển bài hát\r\nPhát/dừng chơi nhạc\r\nChuyển chế độ\r\nNghe/nhận cuộc gọi', 3, 2),
(14, 'Sạc dự phòng Sony cp-e6-bc', 590000, 'sony-cp-e6-bc.png', 'Hiệu suất sạc:	\r\n64%\r\nĐèn LED báo hiệu:	\r\nCó\r\nThời gian sạc:	\r\n5 - 6 giờ (dùng Adapter 1A)\r\nNguồn vào:	\r\n5V - 1.5A Max\r\nLõi pin:	\r\nPin Polymer\r\nCổng ra USB 1:	\r\n5V - 1.5A\r\nKích thước	\r\nDài 11 cm - ngang 6.46 cm - dày 1.52 cm\r\nTrọng lượng:	\r\n141 g\r\nXuất xứ	\r\nTrung Quốc', 3, 5),
(18, 'Loa Sony SRS-xb3', 32990000, 'sonysrs-xb3.png', 'Nhà sản xuất:	\r\nSony\r\nModel:	\r\nSRS-XB3\r\nKích thước:	\r\nCao 8.3 cm - ngang 21.1 cm - dày 8 cm\r\nTrọng lượng:	\r\n930 g\r\nCông suất:	\r\n30W\r\nCách kết nối:	\r\nJack cắm 3.5 mm\r\nBluetooth\r\nNFC\r\nPhím điều khiển:	\r\nTăng/giảm âm lượng\r\nChỉnh Bass\r\nChuyển bài hát\r\nPhát/dừng chơi nhạc\r\nNghe/nhận cuộc gọi', 3, 2),
(19, 'Sạc dự phòng Xiaomi gen 2', 500000, 'xiaomigen2.png', 'Hiệu suất sạc:	\r\n65%\r\nĐèn LED báo hiệu:	\r\nCó\r\nThời gian sạc:	\r\n5 - 6 giờ (dùng Adapter 2A)\r\nNguồn vào:	\r\n5V - 2A\r\nLõi pin:	\r\nPin Polymer\r\nCổng ra USB 1:	\r\n5V – 2.4A\r\nKích thước	\r\nDài 13 cm - ngang 7.1 cm - dày 1.4 cm\r\nTrọng lượng:	\r\n290 g', 4, 5),
(17, 'OPPO A3s', 3690000, 'oppoa3s.png', 'Màn hình:	IPS LCD, 6.2\", HD+\r\nHệ điều hành:	Android 8.1 (Oreo)\r\nCamera sau:	13 MP và 2 MP (2 camera)\r\nCamera trước:	8 MP\r\nCPU:	Qualcomm Snapdragon 450 8 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	16 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:\r\n2 Nano SIM, Hỗ trợ 4G', 5, 1),
(20, 'Xiaomi RedMi 5 16GB', 2760000, 'xiaomiredmi5_16gb.png', 'Hãng sản xuất:	Xiaomi\r\n3G:	HSPA 42.2/5.76 Mbps\r\n4G:	LTE-A (2CA) Cat7 300/100 Mbps\r\nKích thước:	151.8 x 72.8 x 7.7 mm (5.98 x 2.87 x 0.30 in)\r\nTrọng lượng:	157 g (5.54 oz)\r\nLoại SIM:	2 SIM (Nano-SIM)\r\nLoại màn hình:	Cảm ứng điện dung IPS LCD, 16 triệu màu\r\nKích thước màn hình:	5.7 inches\r\nĐộ phân giải màn hình:	720 x 1440 pixels\r\nHệ điều hành:	Android', 4, 1),
(21, 'Xiaomi Redmi Note 5A Prime', 3390000, 'xiaomi-redmi-note-5a-prime-2-400x460.png', 'Màn hình:	IPS LCD, 5.5\", HD\r\nHệ điều hành:	Android 7.0 (Nougat)\r\nCamera sau:	13 MP\r\nCamera trước:	16 MP\r\nCPU:	Snapdragon 435 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:\r\n2 Nano SIM, Hỗ trợ 4G', 4, 1),
(22, 'Xiaomi Mi A2 Lite', 4390000, 'xiaomi-mi-a2-lite-2-400x460.png', 'Màn hình:	IPS LCD, 5.84\", Full HD+\r\nHệ điều hành:	Android One\r\nCamera sau:	12 MP và 5 MP (2 camera)\r\nCamera trước:	5 MP\r\nCPU:	Snapdragon 625 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:\r\n2 Nano SIM, Hỗ trợ 4G', 4, 1),
(23, 'OPPO A83 2018 16GB (không tai nghe)', 3690000, 'oppo-a83-16gb-400x460.png', 'Màn hình:	IPS LCD, 5.7\", HD+\r\nHệ điều hành:	Android 7.1 (Nougat)\r\nCamera sau:	13 MP\r\nCamera trước:	8 MP\r\nCPU:	Mediatek Helio P23 8 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	16 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	3180 mAh', 5, 1),
(24, 'OPPO F9 6GB', 8490000, 'oppo-f9-6gb-red-docquyen-400x460.png', 'Màn hình:	LTPS LCD, 6.3\", Full HD+\r\nHệ điều hành:	ColorOS 5.2 (Android 8.1)\r\nCamera sau:	16 MP và 2 MP (2 camera)\r\nCamera trước:	25 MP\r\nCPU:	MediaTek Helio P60 8 nhân 64-bit\r\nRAM:	6 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:\r\n2 Nano SIM, Hỗ trợ 4G', 5, 1),
(25, 'OPPO A71k (2018)', 2990000, 'oppo-a71-mau-xanh-2018-1-1-400x460.png', 'Màn hình:	IPS TFT, 5.2\", HD\r\nHệ điều hành:	ColorOS 3.2 (Android 7.1)\r\nCamera sau:	13 MP\r\nCamera trước:	5 MP\r\nCPU:	Qualcomm Snapdragon 450 8 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	16 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:\r\n2 Nano SIM, Hỗ trợ 4G', 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `protypes`
--

DROP TABLE IF EXISTS `protypes`;
CREATE TABLE IF NOT EXISTS `protypes` (
  `type_ID` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_img` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`type_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `protypes`
--

INSERT INTO `protypes` (`type_ID`, `type_name`, `type_img`) VALUES
(1, 'Smartphone', 'smartphone.png'),
(2, 'Speaker', 'speaker.png'),
(3, 'Headphone', 'headphone.png'),
(4, 'Smartwatch', 'smartwatch.png'),
(5, 'Sạc dự phòng', 'battery.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
