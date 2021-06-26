-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 21, 2021 lúc 03:15 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gomsu-dtb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(3) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `name`, `email`, `avatar_img`) VALUES
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'abc', 'abc@gmail.com', 'u6.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`c_id`, `fullname`, `phone`, `email`, `address`) VALUES
(88, 'Pizza Hut', '19006066', 'supercat172@gmail.com', 'Gardiner Lane 1441'),
(89, 'Pizza Hut', '19006066', 'supercat172@gmail.com', 'Gardiner Lane 1441'),
(90, 'Pizza Hut', '19006066', 'sam@gmail.com', 'Gardiner Lane 1441'),
(91, 'Pizza Hut', '19006066', 'supercat172@gmail.com', 'Gardiner Lane 1441');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `total_price` decimal(15,4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `c_id`, `total_price`, `status`, `date_order`) VALUES
(68, 88, '31700000.0000', 0, '2021-06-21'),
(69, 89, '2690000.0000', 0, '2021-06-21'),
(70, 90, '5380000.0000', 0, '2021-06-21'),
(71, 91, '40790000.0000', 0, '2021-06-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_order` int(11) NOT NULL,
  `price_order` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_code`, `quantity_order`, `price_order`) VALUES
(68, 'SP04', 1, '3100000.0000'),
(68, 'SP05', 1, '3100000.0000'),
(68, 'SP06', 1, '25500000.0000'),
(69, 'SP01', 1, '2490000.0000'),
(69, 'SP02', 1, '200000.0000'),
(70, 'SP01', 2, '2490000.0000'),
(70, 'SP02', 2, '200000.0000'),
(71, 'SP01', 1, '2490000.0000'),
(71, 'SP02', 2, '200000.0000'),
(71, 'SP04', 1, '3100000.0000'),
(71, 'SP05', 1, '3100000.0000'),
(71, 'SP06', 1, '25500000.0000'),
(71, 'SP07', 1, '3100000.0000'),
(71, 'SP08', 1, '3100000.0000');

--
-- Bẫy `order_details`
--
DELIMITER $$
CREATE TRIGGER `DatHangWeb` AFTER INSERT ON `order_details` FOR EACH ROW UPDATE product
SET product.quantity = product.quantity - NEW.quantity_order
where NEW.product_code = product.product_code
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(3) NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `price_old` decimal(15,4) NOT NULL,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured_product` tinyint(1) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_code`, `cat_id`, `product_name`, `quantity`, `price`, `price_old`, `tag_name`, `featured_product`, `description`) VALUES
('SP01', 55, 'Bình Hoa Gốm Nghệ Thuật Valarie', 46, '2490000.0000', '3100000.0000', 'binh hoa, lo hoa', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP02', 82, 'Ấm chén đẹp A', 946, '200000.0000', '250000.0000', 'test', 1, '<p>test</p>'),
('SP03', 55, 'Lọ hoa đẹp A', 0, '200000.0000', '250000.0000', 'test', 1, '<p>test</p>'),
('SP04', 54, 'Bộ đồ thờ men xanh lục đắp nổi vẽ vàng - dành cho ban thờ 1 bát hương', 69, '3100000.0000', '3500000.0000', 'testt', 1, '<p>test</p>'),
('SP05', 54, 'Bộ đồ thờ men xanh lục đắp nổi vẽ vàng - dành cho ban thờ 3 bát hương', 49, '3100000.0000', '3500000.0000', 'testt', 1, '<p>z</p>'),
('SP06', 54, 'Bộ tam sự men rong vẽ vàng cao cấp Bát Tràng', 0, '25500000.0000', '27500000.0000', 'testt', 1, ''),
('SP07', 54, 'Bộ đồ thờ đắp nổi vẽ vàng cao cấp - dành cho ban thờ phật', 77, '3100000.0000', '3600000.0000', 'test', 1, ''),
('SP08', 54, 'Bộ đồ thờ men rạn vẽ vàng - dành cho ban thờ 3 bát hương', 91, '3100000.0000', '3500000.0000', 'test', 1, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_category`
--

INSERT INTO `product_category` (`cat_id`, `cat_name`, `parent_id`) VALUES
(54, 'Đồ thờ cúng gốm sứ', 0),
(55, 'Lọ hoa đẹp', 0),
(81, 'Bát hương bát tràng', 54),
(82, 'Ấm chén đẹp', 0),
(83, 'Ly cốc sứ', 0),
(84, 'Gốm sứ siêu cấp', 0),
(85, 'Gốm sứ trang trí', 0),
(86, 'Tranh gốm', 0),
(88, 'Bộ đồ ăn', 0),
(89, 'Quà tặng', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_relation` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`image_id`, `file_name`, `product_relation`) VALUES
(63, 'amchen.jpg', 'SP02'),
(64, 'amchen1.jpg', 'SP02'),
(65, 'anh_gomsu.jpg', 'SP02'),
(84, 'lo_hoa_site.webp', 'SP03'),
(87, 'Binh-Hoa-Gom-Nghe-Thuat-Valarie.jpg', 'SP01'),
(88, 'bodothomenxanh.jpg', 'SP04'),
(89, 'bobanthoxanhluc3bathuong.jpg', 'SP05'),
(90, 'tn_480x320_f17909a4ce9b572dd359d44234960483_KHA02361.jpg', 'SP06'),
(91, 'tn_480x320_6d2dffd46c7c0f6a59c30a6d13de4d1a_z2170054687801_bed98670977686411d546ba167bd0ba8.jpg', 'SP07'),
(92, 'tn_480x320_0278e86e354c5c915537a28d4220f011_z2170054773220_90227cabd4d23c6fe00e60f732b3dd37.jpg', 'SP08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Chỉ mục cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_code`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `order_id` (`order_id`,`product_code`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_relation` (`product_relation`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `customer_order` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `product_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_relation`) REFERENCES `product` (`product_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
