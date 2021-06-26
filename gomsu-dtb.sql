-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 26, 2021 lúc 01:52 PM
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
(91, 'Pizza Hut', '19006066', 'supercat172@gmail.com', 'Gardiner Lane 1441'),
(92, 'Pizza Hut', '19006066', 'sam@gmail.com', 'Gardiner Lane 1441'),
(93, 'Pizza Hut', '19006066', 'supercat172@gmail.com', 'Gardiner Lane 1441'),
(94, 'Pizza Hut', '19006066', 'supercat172@gmail.com', 'Gardiner Lane 1441'),
(95, 'Trần Quang Huy', '19006066', 'sam@gmail.com', '17');

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
(68, 88, '31700000.0000', 1, '2021-06-21'),
(69, 89, '2690000.0000', 1, '2021-06-21'),
(70, 90, '5380000.0000', 1, '2021-06-21'),
(71, 91, '40790000.0000', 1, '2021-06-21'),
(72, 92, '3100000.0000', 1, '2021-06-23'),
(73, 93, '2490000.0000', 1, '2021-06-23'),
(74, 94, '6200000.0000', 0, '2021-06-23'),
(75, 95, '24900000.0000', 0, '2021-06-24');

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
(71, 'SP08', 1, '3100000.0000'),
(72, 'SP05', 1, '3100000.0000'),
(73, 'SP01', 1, '2490000.0000'),
(74, 'SP08', 2, '3100000.0000'),
(75, 'SP11', 1, '8000000.0000'),
(75, 'SP24', 1, '15000000.0000'),
(75, 'SP26', 1, '1900000.0000');

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
('SP01', 55, 'Bình Hoa Gốm Nghệ Thuật Valarie', 45, '2490000.0000', '3100000.0000', 'binh hoa, lo hoa', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP02', 82, 'Ấm chén đẹp A', 946, '200000.0000', '250000.0000', 'test', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP03', 55, 'Lọ hoa đẹp A', 0, '200000.0000', '250000.0000', 'test', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP04', 54, 'Bộ đồ thờ men xanh lục đắp nổi vẽ vàng - dành cho ban thờ 1 bát hương', 69, '3100000.0000', '3500000.0000', 'testt', 1, '<p>test</p>'),
('SP05', 54, 'Bộ đồ thờ men xanh lục đắp nổi vẽ vàng - dành cho ban thờ 3 bát hương', 48, '3100000.0000', '3500000.0000', 'testt', 1, '<p>z</p>'),
('SP06', 54, 'Bộ tam sự men rong vẽ vàng cao cấp Bát Tràng', 0, '25500000.0000', '27500000.0000', 'testt', 1, ''),
('SP07', 54, 'Bộ đồ thờ đắp nổi vẽ vàng cao cấp - dành cho ban thờ phật', 77, '3100000.0000', '3600000.0000', 'test', 1, ''),
('SP08', 54, 'Bộ đồ thờ men rạn vẽ vàng - dành cho ban thờ 3 bát hương', 89, '3100000.0000', '3500000.0000', 'test', 1, ''),
('SP09', 86, 'Tranh sứ', 100, '8000000.0000', '8500000.0000', 'zxc', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP10', 86, 'Tranh sứ', 100, '8000000.0000', '8500000.0000', 'zxc', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP11', 86, 'Tranh sứ', 99, '8000000.0000', '8500000.0000', 'zxc', 1, '<p><strong>Mua đồ thờ Bát Tràng ở đâu ?</strong></p><p>&nbsp;</p><p>Hãy đến với gốm sứ Bát Tràng Battrang.info !</p><p><i>Sản phẩm được làm từ loại đất tốt nhất</i></p><p><i>Cam kết 100% hàng bát tràng</i></p><p><i>bảo hành men trọn đời đổi trả miễn phí khi có lỗi do nhà sản xuất.</i></p><p><i>Sản phẩm được làm thủ công 100% bằng tay bởi các nghệ nhân gốm sứ bát tràng</i></p><p><i>Cam kết Giá rẻ nhất thị trường hiện nay</i></p><p>&nbsp;</p><p>Sản phẩm được phân phối bởi thương hiệu \'\' Battrang.info \'\' chuyên cung cấp sản phẩm gốm sứ BÁT TRÀNG chính hãng chất lượng cao .</p><p>&nbsp;</p><p><a href=\"http://battrang.info/\">http://battrang.info/</a></p><p>&nbsp;</p><p><i><strong>☎️&nbsp; 097.6724.222</strong></i></p>'),
('SP12', 81, 'Bát hương rạn khắc rồng nổi Bát Tràng đk 35cm - Bát hương đẹp Bát Tràng', 100, '12500000.0000', '14000000.0000', 'zxc', 1, '<p>Rồng tượng trưng cho sự phồn vinh và sức mạnh của dân tộc, nhanh chóng trở thành hình tượng biểu hiện uy quyền của nhà nước phong kiến, chỉ dùng nơi trang trọng nhất của cung vua, hay những công trình lớn của quốc gia. Đã có thời triều đình phong kiến chạm khắc hình rồng trên nhà cửa hay đồ dùng gia đình. Nhưng sức sống của con rồng còn dẻo dai hơn khi nó vượt ra khỏi kinh thành, đến với làng quê dân dã. Nó leo lên đình làng, ẩn mình trên các bình gốm, cột đình, cuộn tròn trong lòng bát đĩa hay trở thành người gác cổng chùa. Rồng còn có mặt trong những bức tranh hiện đại phương Đông, biểu hiện một mối giao hòa giữa nền văn hóa xa xưa bằng những ý tưởng mới mẻ kỳ lạ. Bát hương không chỉ có ý nghĩa về mặt vật chất, mà hơn hết, nó mang giá trị rất lớn về mặt tinh thần. Thậm chí bát hương còn quan trọng tới mức, thời ký phong kiến, tư tưởng Nho giáo còn đè nặng lên xã hội, tâm lý đẻ con trai để nối dõi tông đường rất phổ biến, các cụ ta thường nói rằng: đẻ con trai để có người “hương hỏa”, 2 chữ hương hỏa còn có ảnh hưởng vô cùng lớn ở thời đại ngày nay. Có thể nói ý nghĩa của bát hương lúc này không chỉ dừng lại ở giá trị vật chất hay tinh thần, mà nó còn mang giá trị truyền thống trao truyền, cha truyền con nối, con cháu nhớ về tổ tiên và bày tỏ lòng thành kính với tổ tiên. Trong khi mọi thứ có thể thay đổi, nhà cửa thay đổi, dụng cụ thay đổi, cuộc sống thay đổi, nhưng bát hương thì không, điều đó là “bất di bất dịch”.</p>'),
('SP13', 81, 'Bát hương men rạn đắp nổi rồng đẹp nhất Bát Tràng p16 - Bát hương giả cổ', 100, '650000.0000', '1100000.0000', 'zxc', 1, '<p>Rồng tượng trưng cho sự phồn vinh và sức mạnh của dân tộc, nhanh chóng trở thành hình tượng biểu hiện uy quyền của nhà nước phong kiến, chỉ dùng nơi trang trọng nhất của cung vua, hay những công trình lớn của quốc gia. Đã có thời triều đình phong kiến chạm khắc hình rồng trên nhà cửa hay đồ dùng gia đình. Nhưng sức sống của con rồng còn dẻo dai hơn khi nó vượt ra khỏi kinh thành, đến với làng quê dân dã. Nó leo lên đình làng, ẩn mình trên các bình gốm, cột đình, cuộn tròn trong lòng bát đĩa hay trở thành người gác cổng chùa. Rồng còn có mặt trong những bức tranh hiện đại phương Đông, biểu hiện một mối giao hòa giữa nền văn hóa xa xưa bằng những ý tưởng mới mẻ kỳ lạ. Bát hương không chỉ có ý nghĩa về mặt vật chất, mà hơn hết, nó mang giá trị rất lớn về mặt tinh thần. Thậm chí bát hương còn quan trọng tới mức, thời ký phong kiến, tư tưởng Nho giáo còn đè nặng lên xã hội, tâm lý đẻ con trai để nối dõi tông đường rất phổ biến, các cụ ta thường nói rằng: đẻ con trai để có người “hương hỏa”, 2 chữ hương hỏa còn có ảnh hưởng vô cùng lớn ở thời đại ngày nay. Có thể nói ý nghĩa của bát hương lúc này không chỉ dừng lại ở giá trị vật chất hay tinh thần, mà nó còn mang giá trị truyền thống trao truyền, cha truyền con nối, con cháu nhớ về tổ tiên và bày tỏ lòng thành kính với tổ tiên. Trong khi mọi thứ có thể thay đổi, nhà cửa thay đổi, dụng cụ thay đổi, cuộc sống thay đổi, nhưng bát hương thì không, điều đó là “bất di bất dịch”.</p><p>&nbsp;</p><p>Nếu muốn biết một gia đình có ấm êm, hạnh phúc hay không, hãy quan sát bàn thờ tổ tiên của gia chủ. Nếu bát hương sạch sẽ, sáng bóng thì chứng tỏ đó là một gia đình hiếu thảo, biết lo toan và tưởng nhớ về các thế hệ trước.&nbsp;</p><p>Trong gia đình tùy theo trách nhiệm là con trưởng, con thứ v.v... mà thờ phụng. Thông thường có 3 cấp bậc</p><p>- Thờ Phật:cầu mong sự bình an thanh thản đến với gia đình, giải thoát tai ương.</p><p>- Thờ Thần:thờ thổ công, long mạch, thần tài, tiền chủ những vị cai quản mảnh đất mình cư ngụ, cầu giúp gia đình ăn ở yên ổn.</p><p>- Thờ gia tiên:họ nhà mình và các bậc phụ thờ theo tiên tổ. Nếu thờ tổ tiên họ tộc bên ngoại (trường hợp bên đó không có người thừa tự) thì phải lập bát hương và ban thờ khác.</p><p>Trong lòng bát hương là tro thinh khiết không có lẫn đất cát bẩn thỉu, vì quan niệm xưa luôn luôn coi bát hương là nơi để linh hồn tổ tiên trú ngụ, từ nơi này họ sẽ dõi theo và phù hộ cho mọi sự trong cuộc sống và công việc của gia đình. Ngoài ra, ý nghĩa nguyên sơ nhất của bát hương&nbsp; trong thờ cúng chính là biểu tuọng cho sự kết nối, giao thoa giữa cõi âm và cõi dương, giữa tinh hoa của đất trời đang hiện hữu với những giá trị tâm linh&nbsp; vĩnh hằng. Lư hương cũng là vật phẩm thờ cúng nơi con cháu có thể bày tỏ lòng thành kính và biết ơn của mình đối với những tổ tiên.&nbsp;</p><p>Sản phẩm bát hương <a href=\"http://battrang.info/\">gốm sứ Bát Tràng</a> được làm theo dòng men rạn giả cổ thời xưa. Các chi tiết rồng, hoa sen, đào được đắp bằng tay rồi tỉa tót từng chút một sao cho mềm mại nhất.</p><p>Trải qua quá trình làm phơ, đắp khắc tạo hình tạo khối cho sản phẩm thì tới quá trình nung, khác với gốm sứ Trung Quốc hay những sản phẩm rẻ tiền nung qua 1 lần lửa.</p><p>Đồ thờ rạn giả cổ tại <a href=\"http://battrang.info/\">gốm sứ Bát Tràng</a><strong> Battranginfo</strong> được nung qua hai lần lửa nên màu nhìn rất có chiều sâu, sản phẩm cầm chắc tay, màu men đẹp.</p><p>Với công nghệ mới nên dòng men rạn gỉa cổ của chúng tôi được tráng 1 lớp men bóng giúp cho quá trình lau dọn trở nên thật đơn giản, và màu sắc bền đẹp mãi với thời gian qua nhiều đời, nhiều thế hệ của gia đình.</p><p>Bộ sản phẩm được làm với nhiều kích cỡ phù hợp với các loại ban thờ từ 89cm, 1m27, 1m53, 1m75, 1m97, 2m17... và các loại sập thờ cỡ lớn</p>'),
('SP14', 97, 'Bát thờ rát vàng 18k - bát thờ sứ', 100, '400000.0000', '600000.0000', 'zxc', 1, '<p><strong>Bát Thờ được nghệ nhân đắp nổi trúc đào được nghệ nhân sử dụng công nghệ men rạn cổ tạo không gian cổ kính cho ban thờ nhà bạn.Sau đó nghệ nhân lại khéo léo rát lên 1 lớp vàng 18k thật mỏng tạo nên sự long lanh và sang trọng cho sản phẩm.</strong></p><p>&nbsp;</p><p><strong>Gốm sứ men rạn suy là một loại gốm nhưng việc tạo nên loại men rạn phải đòi hỏi tay nghề cao của các nghệ nhân, rất công phu và phức tạp hơn các loại men khác. Các nghệ nhân phải có kinh nghiệm cũng như kĩ năng để kết hợp lại các đặc tính, bản chất của xương gốm sao cho đúng tỉ lệ, phù hợp trong từng yếu tố.&nbsp;</strong></p>'),
('SP15', 83, 'Cốc sứ uống cafe Espresso Màu Vân Đá Cabe', 100, '90000.0000', '150000.0000', 'zcx', 0, ''),
('SP16', 83, 'Cốc sứ uống cafe Cappuccino Màu Vân Đá Đen', 100, '90000.0000', '150000.0000', 'zxc', 0, ''),
('SP17', 84, 'Đèn Ngủ Men Hỏa Biến Bọc Đồng Cao Cấp', 10, '690000.0000', '850000.0000', 'zxc', 0, '<p>CHÚNG TÔI CAM KẾT:&nbsp;</p><p>????Hàng Bát Tràng&nbsp;</p><p>????hàng được làm bởi Nghệ Nhân</p><p>????&nbsp;nung ở nhiệt độ cao khử hoàn toàn chì, an toàn cho người sử dụng</p><p>????&nbsp;bảo hành 1 đổi 1 nếu lỗi do nhà sản xuất</p><p>????????mẫu mã đang dạng và luôn được cập nhật</p><p>????????giá cực tốt</p><p>????????miễn phí ship nội thành Hà Nội với đơn hàng trên 2 triệu&nbsp;</p><p>????????&nbsp;hàng luôn có sẵn</p><p>☎️0942211992 - 0987846706</p><p>&nbsp;</p>'),
('SP18', 84, 'Quách Họa Tiết Rồng Men Lam Cao Cấp', 10, '4000000.0000', '5000000.0000', 'zxc', 0, '<p>CHÚNG TÔI CAM KẾT:&nbsp;</p><p>????Hàng Bát Tràng&nbsp;</p><p>????hàng được làm bởi Nghệ Nhân</p><p>????&nbsp;nung ở nhiệt độ cao khử hoàn toàn chì, an toàn cho người sử dụng</p><p>????&nbsp;bảo hành 1 đổi 1 nếu lỗi do nhà sản xuất</p><p>????????mẫu mã đang dạng và luôn được cập nhật</p><p>????????giá cực tốt</p><p>????????miễn phí ship nội thành Hà Nội với đơn hàng trên 2 triệu&nbsp;</p><p>????????&nbsp;hàng luôn có sẵn</p><p>☎️0942211992 - 0987846706</p>'),
('SP19', 82, 'Ấm Chén Bát Tràng Vẽ Vàng', 1000, '290000.0000', '490000.0000', 'amchen', 1, '<p>Ấm Chén Bát Tràng Vẽ Vàng</p><p>Thưởng trà không chỉ nhằm mục đích thưởng thức những chén trà có hương vị thơm ngon mà nó còn đem lại sự thích thú, tinh thần thoải mái, thư giãn sau thời gian làm việc mệt mỏi, căng thẳng. Thú chơi trà rất tỉ mỉ, cầu kì từ quá trình lựa chọn loại trà ngon để thưởng thức cho tới việc chuẩn bị đầy đủ bộ dụng cụ chơi trà và đặc biệt là ấm pha trà gốm sứ Bát Tràng.</p><p>Bộ ấm chén gốm sứ Bát Tràng&nbsp; được làm 100% từ đất tử sa cao cấp. Đất được gốm sứ Battrang.info lựa chọn kỹ lưỡng, không bị pha tạp và đặc biệt không có hại cho sức khỏe con người.</p><p>Thân ấm được nung ở nhiệt độ cao đến 1300 độ C tạo nên ưu điểm bền chắc, hạn chế trầy xước, bể mẻ do va chạm trong khi sử dụng, vận chuyển. Bình trà với tay cầm vừa vặn, chắc chắn, miệng bình được thiết kế vô cùng chuẩn xác, không bị rỉ nước, ngắt dòng tuyệt đối khi rót giúp thao tác được gọn gàng, không làm vấy bẩn bàn hay khăn trải.</p>'),
('SP20', 85, 'Bình Phong Thủy Vẽ Vàng &quot; Cá Chép Hoa Sen: Cao 30cm', 100, '4300000.0000', '4590000.0000', 'nghethuat', 0, '<p>Bình Phong Thủy Vẽ Vàng “ Cá Chép Hoa Sen” Cao 30cm</p><p>Bình hút tài lộc cá chép hoa sen vẽ vàng là hình ảnh nổi bật cùng nền trắng sang trọng, được thiết kế công phu, tỉ mỉ. Thân bình hút tài lộc với bông hoa sen truyền thống đẹp mắt và đầy tinh tế. theo quan niệm dân gian, hình ảnh cá chép là biểu tượng của cuộc sống ấm no, hạnh phúc</p><p>Bình hút tài lộc cá chép hoa senvẽ vàng không chỉ cầu mong tiền tài, danh vọng của gia chủ, mà luôn cầu ước cho con cái, các thành viên trong gia đình luôn gặp may mắn, cố gắng, kiên trì vượt qua những khó khăn để mang đến những thành công trong tương lai không xa.</p>'),
('SP21', 88, 'Bộ Đồ Ăn Đào Đỏ Men Kem', 100, '2500000.0000', '3000000.0000', 'zxc', 0, '<p>BỘ ĐỒ ĂN GỐM SỨ BÁT TRÀNG ĐÀO ĐỎ MEN KEM</p><p>Với một mâm cơm thịnh soạn, đầy đủ các món ăn giờ đây không cần bày quá nhiều bát đĩa nữa, mà tất cả được thu nhỏ trong bộ đồ ăn gốm sứ Bát Tầng. Đây luôn là sự lựa chọn hoàn hảo của những người phụ nữ trong gia đình.</p><p>Bộ đồ ăn gốm sứ Bát Tràng giúp cho mâm cỗ, mâm cơm thêm sang trọng, lịch sự, người thưởng thức luôn cảm thấy ngon miệng, ấm áp và hạnh phúc.</p>'),
('SP22', 89, 'Khay Mứt Tổ Ong Sứ Bát Tràng Cao Cấp Màu Trắng', 100, '599000.0000', '750000.0000', 'xzc', 0, '<p><strong>Khay Mứt Tổ Ong&nbsp; Sứ Bát Tràng Màu Trắng</strong></p><p>Khay mứt sứ Bát Tràng là một trong những sản phẩm độc đáo, được làm hoàn toàn thủ công. Khay mứt sứ dùng đựng bánh kẹo, mứt hoặc hoa quả vào ngày tết là vật phẩm mang tính thiết thực, được nhiều người tiêu dùng ưa thích và lựa chọn.</p><p>Khay mứt sứ Bát Tràng có nhiều màu sắc đa dạng. Mỗi màu sắc của men tạo ra một kiểu độc đáo khác lạ. Tuy nhiên đây là khay mứt được nhiều khách hàng lựa chọn nhất.</p><p>Bên cạnh đó, Khay mứt Bát Tràng không chỉ là món quà sang trọng, đẹp đẽ mà còn rất hữu ích, là món quà tặng của doanh nghiệp đối với khách hàng, nhân viên vào dịp cuối năm tết đến xuân về.</p><p>Bộ khay mứt sứ Bát Tràng in logo theo yêu cầu là sản phẩm ý nghĩa, là món quà tặng cho các chương trình khuyến mãi mà các đại hội, hội nghị, hội thảo cũng có thể sử dụng khay mứt để làm quà tặng cho khách hàng, đối tác của mình.</p><p>Gốm sứ Battrang.info tự hào là đơn vị phân phối gốm sứ và cung cấp các sản phẩm gốm sứ quà tặng. Hiện đang là đơn vị cung cấp các mẫu quà tặng uy tín, chất lượng số 1 hiện nay với tất cả các sự kiện trong năm.</p><p>Tại đây quý khách hàng có thể mua lẻ hoặc là đặt hàng với số lượng lớn để làm quà tặng cho doanh nghiệp. Chúng tôi luôn có những chính sách, ưu đãi tốt nhất với đơn hàng lớn.</p><p>BATTRANG.INFO CAM KẾT</p><p>????Hàng Bát Tràng</p><p>????Hàng được vẽ bởi Nghệ Nhân</p><p>???? Nung ở nhiệt độ cao khử hoàn toàn chì, an toàn cho người sử dụng. Màu sắc là màu men bền vĩnh cửu với thời gian!</p><p>???? Bảo hành 1 đổi 1 nếu lỗi do nhà sản xuất</p><p>????????Mẫu mã đang dạng và luôn được cập nhật</p><p>????????Giá cực tốt</p><p>????????Miễn phí ship nội thành Hà Nội</p><p>???????? Hàng luôn có sẵn</p><p>????http://battrang.info</p>'),
('SP23', 54, 'Bộ Đồ Thờ Men Lam Vẽ Vàng Dành Cho Ban Thần Tài', 100, '25500000.0000', '30000000.0000', 'zxc', 0, '<p>Đồ Thờ Cúng Cho Ban Thờ Thần Tài Mang Tài Lộc Cho Gia Chủ</p><p>Bàn thờ thần tài thường thấy ở các cơ quan, cửa hàng kinh doanh, quán café,… được bày trí trên đó là những vật phẩm thờ cúng, với mong muốn công việc làm ăn, cuộc sống luôn được thuận lợi, hanh thông. Nhưng một bàn thờ chỉ đẹp thôi chưa đủ mà bạn cần phải có một bàn thờ với những sản phẩm thờ cúng đầy đủ hợp mệnh với mình. Có như vậy tâm an thì làm việc gì cũng thành.</p><p>Bàn thờ thần tài là một nơi để gia chủ và doanh nghiệp hướng về để mưu cầu tiền tài và sự nghiệp thuận buồm xuôi gió. Để sử dụng bàn thờ thần tài một cách chuẩn xác theo phong thủy thì bạn cần lưu ý đến nhất chính là vị trí đặt và hướng hợp mệnh với bản thân và hướng đón lộc trong căn nhà. Sau đây&nbsp; gốm sứ Bát Tràng – Battrang.info sẽ gợi ý cho các bạn vị trí đặt bàn thờ thần tài tốt nhất cho việc kinh doanh nhé.</p><p>Vị trí đặt bàn thờ thần tài</p><p>Đặt bàn thờ thần tài cũng cần tuân thủ chặt chẽ các quy tắc trong phong thủy để tránh phạm phải tai ách không đáng có. Nơi đặt bàn thờ cần phải thoáng đãng, sạch sẽ vì đây là ở thích của hai vị thần được thờ là Thần Tài và Ông Địa. Phía trước bàn thờ không được nhìn vào nơi tối tăm nhiều hung khí, phía sau phải dựa vào bức vách vững chãi không được có lỗ hổng hoặc cửa sổ. Vị trí này cũng nên là nơi thuận tiện qua lại nhưng đồng thời cũng phải gọn gàng để không bị vướng víu, xô lệch.</p><p>Trong cửa hàng kinh doanh nên đặt ở vị trí có thể quan sát được khách hàng đi vào và tuyệt nhiên dù là bàn thờ trong cửa hàng hay chốn ở của gia đình thì cũng không được đặt bàn thờ thần tài ở trên cao cách quá xa mặt đất.</p><p>Theo dân gian, Thần Tài- Ông Địa là người mang đến may mắn, sự giàu sang trong kinh doanh, buôn bán. Nên hiện nay tục thờ Thần Tài- Ông Địa cũng đã trở thành một tín ngưỡng không thể thiếu trong các gia đình Việt đặc biệt là những gia đình, công ty làm ăn buôn bán, kinh doanh.</p>'),
('SP24', 54, 'Bộ Đồ Thờ Men Rạn Nổi Dành Cho Ban Thần Tài', 19, '15000000.0000', '16000000.0000', 'zxc', 0, '<p>Đồ Thờ Cúng Cho Ban Thờ Thần Tài Mang Tài Lộc Cho Gia Chủ</p><p>Bàn thờ thần tài thường thấy ở các cơ quan, cửa hàng kinh doanh, quán café,… được bày trí trên đó là những vật phẩm thờ cúng, với mong muốn công việc làm ăn, cuộc sống luôn được thuận lợi, hanh thông. Nhưng một bàn thờ chỉ đẹp thôi chưa đủ mà bạn cần phải có một bàn thờ với những sản phẩm thờ cúng đầy đủ hợp mệnh với mình. Có như vậy tâm an thì làm việc gì cũng thành.</p><p>Bàn thờ thần tài là một nơi để gia chủ và doanh nghiệp hướng về để mưu cầu tiền tài và sự nghiệp thuận buồm xuôi gió. Để sử dụng bàn thờ thần tài một cách chuẩn xác theo phong thủy thì bạn cần lưu ý đến nhất chính là vị trí đặt và hướng hợp mệnh với bản thân và hướng đón lộc trong căn nhà. Sau đây&nbsp; gốm sứ Bát Tràng – Battrang.info sẽ gợi ý cho các bạn vị trí đặt bàn thờ thần tài tốt nhất cho việc kinh doanh nhé.</p><p>Vị trí đặt bàn thờ thần tài</p><p>Đặt bàn thờ thần tài cũng cần tuân thủ chặt chẽ các quy tắc trong phong thủy để tránh phạm phải tai ách không đáng có. Nơi đặt bàn thờ cần phải thoáng đãng, sạch sẽ vì đây là ở thích của hai vị thần được thờ là Thần Tài và Ông Địa. Phía trước bàn thờ không được nhìn vào nơi tối tăm nhiều hung khí, phía sau phải dựa vào bức vách vững chãi không được có lỗ hổng hoặc cửa sổ. Vị trí này cũng nên là nơi thuận tiện qua lại nhưng đồng thời cũng phải gọn gàng để không bị vướng víu, xô lệch.</p><p>Trong cửa hàng kinh doanh nên đặt ở vị trí có thể quan sát được khách hàng đi vào và tuyệt nhiên dù là bàn thờ trong cửa hàng hay chốn ở của gia đình thì cũng không được đặt bàn thờ thần tài ở trên cao cách quá xa mặt đất.</p>'),
('SP25', 54, 'Bộ Đồ Thờ Men Rạn vẽ Dành Cho Ban Thần Tài', 100, '18000000.0000', '20000000.0000', 'zxc', 0, '<p>Đồ Thờ Cúng Cho Ban Thờ Thần Tài Mang Tài Lộc Cho Gia Chủ</p><p>Bàn thờ thần tài thường thấy ở các cơ quan, cửa hàng kinh doanh, quán café,… được bày trí trên đó là những vật phẩm thờ cúng, với mong muốn công việc làm ăn, cuộc sống luôn được thuận lợi, hanh thông. Nhưng một bàn thờ chỉ đẹp thôi chưa đủ mà bạn cần phải có một bàn thờ với những sản phẩm thờ cúng đầy đủ hợp mệnh với mình. Có như vậy tâm an thì làm việc gì cũng thành.</p><p>Bàn thờ thần tài là một nơi để gia chủ và doanh nghiệp hướng về để mưu cầu tiền tài và sự nghiệp thuận buồm xuôi gió. Để sử dụng bàn thờ thần tài một cách chuẩn xác theo phong thủy thì bạn cần lưu ý đến nhất chính là vị trí đặt và hướng hợp mệnh với bản thân và hướng đón lộc trong căn nhà. Sau đây&nbsp; gốm sứ Battrang.info sẽ gợi ý cho các bạn vị trí đặt bàn thờ thần tài tốt nhất cho việc kinh doanh nhé.</p><p>Vị trí đặt bàn thờ thần tài</p><p>Đặt bàn thờ thần tài cũng cần tuân thủ chặt chẽ các quy tắc trong phong thủy để tránh phạm phải tai ách không đáng có. Nơi đặt bàn thờ cần phải thoáng đãng, sạch sẽ vì đây là ở thích của hai vị thần được thờ là Thần Tài và Ông Địa. Phía trước bàn thờ không được nhìn vào nơi tối tăm nhiều hung khí, phía sau phải dựa vào bức vách vững chãi không được có lỗ hổng hoặc cửa sổ. Vị trí này cũng nên là nơi thuận tiện qua lại nhưng đồng thời cũng phải gọn gàng để không bị vướng víu, xô lệch.</p><p>Trong cửa hàng kinh doanh nên đặt ở vị trí có thể quan sát được khách hàng đi vào và tuyệt nhiên dù là bàn thờ trong cửa hàng hay chốn ở của gia đình thì cũng không được đặt bàn thờ thần tài ở trên cao cách quá xa mặt đất.</p><p>Theo dân gian, Thần Tài- Ông Địa là người mang đến may mắn, sự giàu sang trong kinh doanh, buôn bán. Nên hiện nay tục thờ Thần Tài- Ông Địa cũng đã trở thành một tín ngưỡng không thể thiếu trong các gia đình Việt đặc biệt là những gia đình, công ty làm ăn buôn bán, kinh doanh.</p>'),
('SP26', 82, 'Bộ Ấm Chén Gốm Nghệ Thuật Victoria', 4, '1900000.0000', '2100000.0000', 'zxc', 1, '');

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
(89, 'Quà tặng', 0),
(97, 'Bát thờ', 54);

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
(92, 'tn_480x320_0278e86e354c5c915537a28d4220f011_z2170054773220_90227cabd4d23c6fe00e60f732b3dd37.jpg', 'SP08'),
(93, 'tranhsu.jpg', 'SP09'),
(94, 'tranhsu2.jpg', 'SP10'),
(95, 'tranhsu3.jpg', 'SP11'),
(96, 'bathuongrong35.jpg', 'SP12'),
(97, '1e1220660b6fed31b47e.jpg', 'SP12'),
(98, '1e1220660b6fed31b47e.jpg', 'SP13'),
(99, 'bát thờ rát vàng.jpg', 'SP14'),
(100, 'fb99870f81847fda2695.jpg', 'SP15'),
(101, 'eb82e364e5ef1bb142fe.jpg', 'SP16'),
(102, 'đèn ngủ bọc đồng.jpg', 'SP17'),
(103, 'Quách Màu Xanh men ngọc.jpg', 'SP18'),
(104, 'ấm chén vv02.jpg', 'SP15'),
(105, 'ấm chén vv02.jpg', 'SP19'),
(106, 'bình phong thủy vẽ vàng cá chep hoa sen.jpg', 'SP20'),
(107, 'afc256518c70782e2161.jpg', 'SP21'),
(108, '5cc38482841e7a40230f.jpg', 'SP22'),
(109, '6eecce82aef35aad03e2.jpg', 'SP23'),
(110, '63eeb389d3f827a67ee9.jpg', 'SP24'),
(111, 'Bo-am-Chen-Gom-Nghe-Thuat-Victoria-2.jpg', 'SP26'),
(112, 'Bo-am-Chen-Gom-Nghe-Thuat-Victoria-1.jpg', 'SP26'),
(113, 'Bo-Am-Chen-Gom-Su-Victoria.jpg', 'SP26');

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
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
