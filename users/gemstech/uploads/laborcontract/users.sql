-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 10, 2022 lúc 11:27 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `goffice_gemstech`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usernameMd5` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `staffId` int(11) NOT NULL,
  `groupId` tinyint(1) NOT NULL COMMENT '0-nhanvien, 1-admin, 2-kythuat,3-ketoan,4-nhansu',
  `ipLogin` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `extNum` int(6) NOT NULL,
  `sipPass` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `activeCode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `classify` int(11) NOT NULL,
  `accesspoints` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `usernameMd5`, `password`, `staffId`, `groupId`, `ipLogin`, `extNum`, `sipPass`, `activeCode`, `classify`, `accesspoints`, `status`, `token`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1736c5de1e48039579a490d1f1c1f95b', 1, 5, '171.251.238.144', 0, '', '', 1, '', 1, ''),
(2, 'Huy Gô', '13bba19444c2566cfe7da6c35ff6dcc2', 'd9b1d7db4cd6e70935368a1efb10e377', 2, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(3, 'phong', '9f48495bb4b98ac37a1a72c7e6490c7a', 'd9b1d7db4cd6e70935368a1efb10e377', 3, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(4, 'ha', '925cc8d2953eba624b2bfedf91a91613', '38972020f1234d29540a7767c72448ed', 4, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(5, 'long', '0f5264038205edfb1ac05fbb0e8c5e94', '38972020f1234d29540a7767c72448ed', 5, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(6, 'thiep', '56579955f368ba8865365dc02912eabc', 'd5db70bafe1555514a755306de80f0e0', 6, 5, '171.251.238.144', 0, '', '', 2, '', 1, '0a80e1cbb224ab35bb817f5d290dc393'),
(7, 'tranhai', 'fc843afffe522277cbdd0cc533495d0c', '1457d10b7c8515852a527bd55bccefa8', 7, 5, '171.251.238.144', 901, '65938045', '', 2, '', 1, '5f611de116036ccfd51a7d1129716a5d'),
(8, 'nu', '0288bde0c2d593f2b5766f61b826a650', '1736c5de1e48039579a490d1f1c1f95b', 8, 5, '171.251.238.144', 0, '', '', 2, '', 1, '3d792a0e7bdc3c51d4e9a3bcdd26011e'),
(9, 'huymkt', 'a9c200b52b6a387a271c4ac27f719455', 'd181c1a540978a4eeb96e069ae920bc6', 9, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(10, 'maianh', '61ffa7ab9e660ed7c3323f669c224c8c', '1736c5de1e48039579a490d1f1c1f95b', 10, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(11, 'quynh90st', '745a143b52e7242e699b3688ca823ffd', 'e1162cf62281ae720d49493078fd43d2', 11, 5, '171.251.238.144', 901, '', '831706', 2, '', 1, '8c58ef0ac3004aa6b2dde6c6bc3f65a1'),
(12, 'thuthuy', '2bf98a4b0da6dc9250a32996357667f1', '14e1b600b1fd579f47433b88e8d85291', 16, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(13, 'tuyet', 'a6921275a48631bafb772d35637b82a0', 'ea942d6ba692b507d2164b638ef1c8a5', 13, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(14, 'Ngoc Lê', '999351e685862e175a3e9da79cc9b6fb', '38972020f1234d29540a7767c72448ed', 14, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(15, 'nguyenvana', '20ca70c7c8f494c7bd1d54ad23d40cde', '14e1b600b1fd579f47433b88e8d85291', 15, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(16, 'ninh', 'efea4dbc0e33d945ea37f95a5f3d3a7e', '00c38e36ea5c88dcc90c41db174bb587', 17, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(17, 'nguyendat', 'dca0e315e04d328c8ada9495b1a59bf6', 'd9b1d7db4cd6e70935368a1efb10e377', 18, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(18, 'khanhngoc', 'b02f8b058df45fa2afb1959052c18a07', '1736c5de1e48039579a490d1f1c1f95b', 19, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(19, 'locnguyen', 'e48b5e252a1adc97492f5155aa43ca30', 'fd7dcc4165cadd2f19c22dcfc0808b5a', 20, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(20, 'hien', '380a767a3eb890d7f177538fabd023d6', '1f32aa4c9a1d2ea010adcf2348166a04', 21, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(21, 'nguyentho', '8ecfd285320855bf4f20f9df22e2e1a7', '0058799b0e244392c3bddf98ca76a1e9', 22, 5, '171.251.238.144', 0, '', '', 2, '', 1, 'be57e9c8f273cb856bafa7da53b3435b'),
(22, 'nguyenthang', '04516ec5baac878a706cb0781d7f1c52', '0369d98a00ba1ca13f51239278d7c2ce', 37, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(23, 'thutrang', 'ebfc36c37a5cf683edbaa85975879d18', '1736c5de1e48039579a490d1f1c1f95b', 24, 5, '171.251.238.144', 0, '', '', 2, '', 1, 'ed65b28a7f6b192861f5f3399d4b5f52'),
(24, 'huonggiang', '820ab25f3f337354effe95226a21ce84', '1736c5de1e48039579a490d1f1c1f95b', 0, 5, '171.251.238.144', 0, '', '762495', 2, '', 1, 'e92e26f6345af84c858d77e028513271'),
(25, 'tungson', 'e31f28f4133559bf6d4a4e8ce90e38fc', '1736c5de1e48039579a490d1f1c1f95b', 26, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(26, 'ngocquynh', 'fa9626d7385d51e3c920c4cf8a339567', '1736c5de1e48039579a490d1f1c1f95b', 27, 5, '171.251.238.144', 902, '96737342', '', 2, '', 1, 'a9a4bd8f7f4a3d68e167d9eb7537db85'),
(27, 'ducthanh', 'c140039a831b2ece433866d07f61ffe0', '1736c5de1e48039579a490d1f1c1f95b', 28, 5, '171.251.238.144', 0, '', '', 2, '', 1, '2ff63f7b42a6bf78b6b4f403526b923f'),
(28, 'xuan', 'ebbb855092f574cef61b6f3ce7640d87', '1736c5de1e48039579a490d1f1c1f95b', 29, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(29, 'hoan', '892e2583ccbd69cb1081fec008ce4735', '1736c5de1e48039579a490d1f1c1f95b', 30, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(30, 'cuong', 'cf4d87e50be6390ee9bd8ad6e7498cae', '1736c5de1e48039579a490d1f1c1f95b', 31, 5, '171.251.238.144', 0, '', '', 2, '', 1, '78c5b4080edfaf246bf50decbc39bb74'),
(31, 'truc', '45723a2af3788c4ff17f8d1114760e62', '1736c5de1e48039579a490d1f1c1f95b', 32, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(32, 'duongpha', '2fae4ce068067181d6468befaaed800f', 'ff01aa1786ca588b1052036d867c7bfd', 33, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(33, 'thanhnhan', '6796496f00a2dad1482c947d49e9bf65', '7022c8815907a2f812c98459cac2a7b2', 34, 5, '171.251.238.144', 902, '96737342', '', 2, '', 1, '42694be7863978843101e657f18a34ef'),
(34, 'nguyenhung', '17d3e6c4c1c223aedd1dfa7a7aa5f4a2', '1736c5de1e48039579a490d1f1c1f95b', 35, 5, '171.251.238.144', 0, '', '', 2, '', 1, 'f746fc48e8e9501c1eb0615290aca431'),
(35, 'thanhchau', '13ca19c09bd874e64ce85a53885885d7', '1736c5de1e48039579a490d1f1c1f95b', 36, 5, '171.251.238.144', 0, '', '', 2, '', 0, ''),
(36, 'thanhtrung', '63cb90a51c66efe3bc6a402a6543d5b3', '0de70a5d6b84dfd7ce63041e2eb84d7e', 23, 5, '171.251.238.144', 0, '', '', 2, '', 1, '74b9e438f2815ac325642e2ac956c5c9'),
(37, 'huudat', '6463fd57421c8a0339cc383d7e3ea122', '1736c5de1e48039579a490d1f1c1f95b', 38, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(38, 'anhvu', '4dffd06e6b413cee4b14dde75629cb66', '1736c5de1e48039579a490d1f1c1f95b', 39, 5, '171.251.238.144', 1, '', '', 2, '', 1, 'd6df2099c6ea46fb1cb2311dc4d98c6d'),
(39, 'nguyenngoc', '4ea2685bdfd5d84a96a1f5902b56d5ba', '1736c5de1e48039579a490d1f1c1f95b', 40, 5, '171.251.238.144', 0, '', '', 2, '', 1, '4b0faebcc82fab47fd7ee3064669220f'),
(40, 'hoanglong', '7c5884bc1eff2d89aca0db9885164dda', '1736c5de1e48039579a490d1f1c1f95b', 41, 5, '171.251.238.144', 0, '', '', 2, '', 1, 'a4740ef3bfd68742f812b81cd6da9b3b'),
(41, 'vukhuong', '4e83e3948937f2af2c42154351943fb5', '1736c5de1e48039579a490d1f1c1f95b', 42, 5, '171.251.238.144', 0, '', '', 2, '', 1, '8d2bd7a1c0dddd404e807b266ca9a548'),
(42, 'ngocminh', '858c7c80e75299230467bbb05690c7ca', '1736c5de1e48039579a490d1f1c1f95b', 43, 5, '171.251.238.144', 0, '', '', 2, '', 1, 'c726525da0cb7e9d504da054c8dc8211'),
(43, 'hoaiphuong', 'a9f6416c88bf87a156de84404068e460', '1736c5de1e48039579a490d1f1c1f95b', 44, 5, '171.251.238.144', 0, '', '', 2, '', 1, '49b8382d2fa058d8b2f36fcf5d608083'),
(44, 'phamdai', '972ff95a2c8ed0aa4bcf703ed52b04b5', '1736c5de1e48039579a490d1f1c1f95b', 45, 5, '171.251.238.144', 0, '', '', 2, '', 1, '28735353b56150dea6120704e837e5e1'),
(45, 'hongnhung', '7cc09f53106552496c697e78e089cbe9', '1736c5de1e48039579a490d1f1c1f95b', 47, 5, '171.251.238.144', 0, '', '', 2, '', 1, '3bb08bd9748fb76cc2793c4f8b0e3e57'),
(46, 'bamanh', 'e546f7927489ed3d203e9baee32c2aee', '1736c5de1e48039579a490d1f1c1f95b', 48, 5, '171.251.238.144', 0, '', '', 2, '', 1, '74c18a6f4719da80598f4cb6fee233a8'),
(47, 'truongan', 'c517ea29c798f27fcb9a1f92e34c3326', '1736c5de1e48039579a490d1f1c1f95b', 50, 5, '171.251.238.144', 0, '', '', 2, '', 1, '515ad2a88d8005db57c17a2a4708d669'),
(48, 'tranhop', 'ff979283ff2f675f31c472a968a1b01a', '1736c5de1e48039579a490d1f1c1f95b', 51, 5, '171.251.238.144', 0, '', '', 2, '', 1, '07a52a746340560e3e9fa48b6dc5e69b'),
(49, 'vuvantung', 'c47d3fda295432f8ed189fa4c3830bab', '1736c5de1e48039579a490d1f1c1f95b', 52, 5, '171.251.238.144', 0, '', '', 2, '', 1, '338cf8772101b83b3a1e97cc42dd16c1'),
(50, 'dovanthang', '9b3cbd0627192b741992b1efbe0f640f', '1736c5de1e48039579a490d1f1c1f95b', 53, 5, '171.251.238.144', 0, '', '', 2, '', 1, '954b90b483952f6841a6c156617f0f94'),
(51, 'daiduong', '5d772610c89aa1ff670fc83dd423b6d0', '1736c5de1e48039579a490d1f1c1f95b', 54, 5, '171.251.238.144', 0, '', '', 2, '', 1, '9ea087d1d1ae1880de25e8f906a6e429'),
(52, 'binhnguyen', '3bbb594f910fcb5afd5e9982f1f78994', '1736c5de1e48039579a490d1f1c1f95b', 56, 5, '171.251.238.144', 0, '', '', 2, '', 1, 'd2390499225b3b2909088d87a0a7360d'),
(53, 'daoduong', 'f875499cd9ae92dd9e6cfd22b80bf279', '1736c5de1e48039579a490d1f1c1f95b', 57, 5, '171.251.238.144', 0, '', '', 2, '', 0, '2cfacad37393903985bd282c1b9a6bf5'),
(54, 'dogiang', '06c893f359bb69f561ce5f46228efbc1', '1736c5de1e48039579a490d1f1c1f95b', 58, 3, '171.251.238.144', 0, '', '', 2, '', 1, '9abdbe31b91cfcd2ca24384bce9f3f97'),
(55, 'dongdo', '5ae71dc634e30cb3bb41eebe69cb5958', '1736c5de1e48039579a490d1f1c1f95b', 59, 5, '171.251.238.144', 0, '', '', 2, '', 1, '1b22699379a6d53e6f0fcb4f440d3366'),
(56, 'minhnghia', '3890aad4d2d12f1cb79bf1d92e7f93b5', '1736c5de1e48039579a490d1f1c1f95b', 60, 3, '171.251.238.144', 0, '', '', 2, '', 1, 'a2b15b37de36d5d529b4cecb1f7a6b52'),
(57, 'xuanson', '667166f9a2ef87722089fa6911b890f8', '6cb4e66aa8630ee6a97f82621381a501', 61, 3, '171.251.238.144', 0, '', '', 2, '', 1, '8502dfe6fe18f72af7ed1a07dafd29f3'),
(58, 'quangdat', 'b65528b1d7039b524ac2329e5dd2d7ac', '126068f637cd620b2b69b4067ba07f0b', 62, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(59, 'duylong', 'b84d5e1257fe165047333491de71ccad', '1736c5de1e48039579a490d1f1c1f95b', 63, 3, '171.251.238.144', 0, '', '810962', 2, '', 1, '5354cef0bda05bcc45f0dd3f019b528d'),
(60, 'thuha', 'bc1b5f3efee04ef530606c3b3835fb69', '1736c5de1e48039579a490d1f1c1f95b', 64, 1, '171.251.238.144', 902, '96737342', '', 2, '', 1, ''),
(61, 'nguyentrang', '63da400b88d9f18908c2de4c0c8d1d31', '1736c5de1e48039579a490d1f1c1f95b', 65, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(62, 'daiphat', '6e79facf18d867f94d06c0a7c32bf9d3', '1736c5de1e48039579a490d1f1c1f95b', 66, 3, '171.251.238.144', 0, '', '', 2, '', 1, '9dca9f721021e0b86aa29e8e87626109'),
(63, 'thanhgiang', 'bd2aa84d5e7db2539985cdf05cda6425', '1736c5de1e48039579a490d1f1c1f95b', 67, 5, '171.251.238.144', 902, '96737342', '', 2, '', 1, '286c92a258498df12fdf9a4d7e884f2d'),
(64, 'hoanganh', '4b11235e97a55847ff21be46218b0161', '1736c5de1e48039579a490d1f1c1f95b', 68, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(65, 'thuyduong', '554b7864f4fa234b137a5fa0b8e8542e', '1736c5de1e48039579a490d1f1c1f95b', 69, 3, '171.251.238.144', 0, '', '', 2, '', 1, '12212b99976bed5ef42e9364cb72860c'),
(66, 'tienanh', '4e326829de65f76fa384900622781d7d', '1736c5de1e48039579a490d1f1c1f95b', 70, 5, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(67, 'trangnt', 'c4ef16b3b22a378848155af1451792a1', '1736c5de1e48039579a490d1f1c1f95b', 71, 3, '171.251.238.144', 0, '', '', 2, '', 1, '3a4076a7e2e22c98950b21fab5d3d682'),
(68, 'dangtrang', '71b41fb3fa74fb4eb6aa3c86834a2768', '1736c5de1e48039579a490d1f1c1f95b', 72, 3, '171.251.238.144', 0, '', '', 2, '', 1, 'db3b228af8a85f98362240917914ac6f'),
(69, 'gianght', 'e9a9200d9b4bc15079a49462dc996f49', '1736c5de1e48039579a490d1f1c1f95b', 0, 3, '171.251.238.144', 0, '', '', 2, '', 1, ''),
(70, 'thanhmai', '7e886a3bf12b98f6c8e5d0ab2f948a0f', '1736c5de1e48039579a490d1f1c1f95b', 77, 5, '', 0, '', '', 2, '', 1, '69acbbd399b18dc1b21cc1f86cff47f1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
