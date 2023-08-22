-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th8 22, 2023 lúc 08:41 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `product_id` bigint(10) NOT NULL,
  `content` text DEFAULT NULL,
  `user_id` bigint(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 60, 'cũng được', 2, '2023-08-22 04:45:14', '2023-08-22 04:45:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(10) NOT NULL,
  `coupon_name` varchar(50) DEFAULT NULL,
  `time` int(50) UNSIGNED DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_name`, `time`, `number`, `code`, `is_active`, `created_at`, `updated_at`) VALUES
(371769514, 'tinh', 8, 5, 'abc', 1, '2023-08-17 07:25:21', '2023-08-18 06:02:35'),
(371769515, 'fake', 0, 0, '17082302293829code', 0, '2023-08-17 07:29:38', '2023-08-17 07:29:38'),
(371769516, 'fake', 0, 0, '17082302295679code', 0, '2023-08-17 07:29:56', '2023-08-17 07:29:56'),
(371769517, 'fake', 0, 0, '17082302364879code', 0, '2023-08-17 07:36:48', '2023-08-17 07:36:48'),
(371769518, 'fake', 0, 0, '17082302372613code', 0, '2023-08-17 07:37:26', '2023-08-17 07:37:26'),
(371769519, 'fake', 0, 0, '17082303371542code', 0, '2023-08-17 08:37:15', '2023-08-17 08:37:15'),
(371769520, 'fake', 0, 0, '17082303420458code', 0, '2023-08-17 08:42:04', '2023-08-17 08:42:04'),
(371769521, 'fake', 0, 0, '17082304411742code', 0, '2023-08-17 09:41:17', '2023-08-17 09:41:17'),
(371769522, 'fake', 0, 0, '18082310091297code', 0, '2023-08-18 03:09:12', '2023-08-18 03:09:12'),
(371769523, 'fake', 0, 0, '18082310220127code', 0, '2023-08-18 03:22:01', '2023-08-18 03:22:01'),
(371769524, 'fake', 0, 0, '18082310231177code', 0, '2023-08-18 03:23:11', '2023-08-18 03:23:11'),
(371769525, 'fake', 0, 0, '18082310261138code', 0, '2023-08-18 03:26:11', '2023-08-18 03:26:11'),
(371769526, 'fake', 0, 0, '18082310265315code', 0, '2023-08-18 03:26:53', '2023-08-18 03:26:53'),
(371769527, 'fake', 0, 0, '18082310424660code', 0, '2023-08-18 03:42:46', '2023-08-18 03:42:46'),
(371769528, 'fake', 0, 0, '18082310432197code', 0, '2023-08-18 03:43:21', '2023-08-18 03:43:21'),
(371769529, 'fake', 0, 0, '18082310454697code', 0, '2023-08-18 03:45:46', '2023-08-18 03:45:46'),
(371769530, 'fake', 0, 0, '18082311190064code', 0, '2023-08-18 04:19:00', '2023-08-18 04:19:00'),
(371769531, 'fake', 0, 0, '18082311470944code', 0, '2023-08-18 04:47:09', '2023-08-18 04:47:09'),
(371769532, 'fake', 0, 0, '18082311474915code', 0, '2023-08-18 04:47:49', '2023-08-18 04:47:49'),
(371769533, 'fake', 0, 0, '18082302062072code', 0, '2023-08-18 07:06:20', '2023-08-18 07:06:20'),
(371769534, 'fake', 0, 0, '18082302065144code', 0, '2023-08-18 07:06:51', '2023-08-18 07:06:51'),
(371769535, 'fake', 0, 0, '18082302194312code', 0, '2023-08-18 07:19:43', '2023-08-18 07:19:43'),
(371769536, 'fake', 0, 0, '18082303174129code', 0, '2023-08-18 08:17:41', '2023-08-18 08:17:41'),
(371769537, 'fake', 0, 0, '18082303215531code', 0, '2023-08-18 08:21:55', '2023-08-18 08:21:55'),
(371769538, 'fake', 0, 0, '18082303230991code', 0, '2023-08-18 08:23:09', '2023-08-18 08:23:09'),
(371769539, 'fake', 0, 0, '18082303402346code', 0, '2023-08-18 08:40:23', '2023-08-18 08:40:23'),
(371769540, 'fake', 0, 0, '18082303415677code', 0, '2023-08-18 08:41:56', '2023-08-18 08:41:56'),
(371769541, 'fake', 0, 0, '22082301284185code', 0, '2023-08-22 06:28:41', '2023-08-22 06:28:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infors`
--

CREATE TABLE `infors` (
  `id` int(10) NOT NULL,
  `info_contact` varchar(255) DEFAULT NULL,
  `info_map` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `infors`
--

INSERT INTO `infors` (`id`, `info_contact`, `info_map`) VALUES
(3, '<p><strong>Địa chỉ</strong></p><p><strong>58 Tràng An,</strong><br><strong>Phường Tân Thành,</strong><br><strong>tp Ninh Bình</strong></p>', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.877309586611!2d105.9608833749844!3d20.263922481200847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313679fb83423f2d%3A0xf67444388df75de0!2zNTggVHLDoG5nIEFuLCBUw6JuIFRow6BuaCwgTmluaCBCw6xuaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1690541026409!5m2!1svi!2s');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(162, 'default', '{\"uuid\":\"9e6adb00-c93a-45fb-9d5e-6848ccbe6e99\",\"displayName\":\"App\\\\Jobs\\\\SendEmailConfirm\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailConfirm\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendEmailConfirm\\\":6:{s:32:\\\"\\u0000App\\\\Jobs\\\\SendEmailConfirm\\u0000email\\\";s:20:\\\"tinhnn.jvb@gmail.com\\\";s:29:\\\"\\u0000App\\\\Jobs\\\\SendEmailConfirm\\u0000id\\\";i:1;s:34:\\\"\\u0000App\\\\Jobs\\\\SendEmailConfirm\\u0000request\\\";a:6:{s:4:\\\"name\\\";s:11:\\\"Tinh Nguyen\\\";s:7:\\\"address\\\";s:6:\\\"Ha Noi\\\";s:5:\\\"email\\\";s:20:\\\"tinhnn.jvb@gmail.com\\\";s:5:\\\"phone\\\";s:10:\\\"0981240297\\\";s:4:\\\"note\\\";s:3:\\\"dđ\\\";s:9:\\\"coupon_id\\\";i:371769541;}s:32:\\\"\\u0000App\\\\Jobs\\\\SendEmailConfirm\\u0000items\\\";a:2:{i:1;a:3:{s:3:\\\"qty\\\";i:1;s:5:\\\"price\\\";i:120000;s:4:\\\"item\\\";O:19:\\\"App\\\\Models\\\\Products\\\":30:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:8:\\\"products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:12:{s:2:\\\"id\\\";i:1;s:4:\\\"name\\\";s:24:\\\"Bánh Crepe Sầu riêng\\\";s:7:\\\"type_id\\\";i:5;s:11:\\\"description\\\";s:12:\\\"mô tả 234\\\";s:16:\\\"product_quantity\\\";i:50;s:13:\\\"quantity_sold\\\";i:0;s:10:\\\"unit_price\\\";i:150000;s:15:\\\"promotion_price\\\";i:120000;s:5:\\\"image\\\";s:34:\\\"1430967449-pancake-sau-rieng-6.jpg\\\";s:9:\\\"is_active\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2016-10-26 03:00:16\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-08-18 08:22:13\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:12:{s:2:\\\"id\\\";i:1;s:4:\\\"name\\\";s:24:\\\"Bánh Crepe Sầu riêng\\\";s:7:\\\"type_id\\\";i:5;s:11:\\\"description\\\";s:12:\\\"mô tả 234\\\";s:16:\\\"product_quantity\\\";i:50;s:13:\\\"quantity_sold\\\";i:0;s:10:\\\"unit_price\\\";i:150000;s:15:\\\"promotion_price\\\";i:120000;s:5:\\\"image\\\";s:34:\\\"1430967449-pancake-sau-rieng-6.jpg\\\";s:9:\\\"is_active\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2016-10-26 03:00:16\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-08-18 08:22:13\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:7:\\\"type_id\\\";i:2;s:11:\\\"description\\\";i:3;s:10:\\\"unit_price\\\";i:4;s:15:\\\"promotion_price\\\";i:5;s:16:\\\"product_quantity\\\";i:6;s:13:\\\"quantity_sold\\\";i:7;s:5:\\\"image\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}i:2;a:3:{s:3:\\\"qty\\\";i:1;s:5:\\\"price\\\";i:160000;s:4:\\\"item\\\";O:19:\\\"App\\\\Models\\\\Products\\\":30:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:8:\\\"products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:12:{s:2:\\\"id\\\";i:2;s:4:\\\"name\\\";s:21:\\\"Bánh Crepe Chocolate\\\";s:7:\\\"type_id\\\";i:6;s:11:\\\"description\\\";s:0:\\\"\\\";s:16:\\\"product_quantity\\\";i:58;s:13:\\\"quantity_sold\\\";i:0;s:10:\\\"unit_price\\\";i:180000;s:15:\\\"promotion_price\\\";i:160000;s:5:\\\"image\\\";s:19:\\\"crepe-chocolate.jpg\\\";s:9:\\\"is_active\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2016-10-26 03:00:16\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-08-18 04:38:29\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:12:{s:2:\\\"id\\\";i:2;s:4:\\\"name\\\";s:21:\\\"Bánh Crepe Chocolate\\\";s:7:\\\"type_id\\\";i:6;s:11:\\\"description\\\";s:0:\\\"\\\";s:16:\\\"product_quantity\\\";i:58;s:13:\\\"quantity_sold\\\";i:0;s:10:\\\"unit_price\\\";i:180000;s:15:\\\"promotion_price\\\";i:160000;s:5:\\\"image\\\";s:19:\\\"crepe-chocolate.jpg\\\";s:9:\\\"is_active\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2016-10-26 03:00:16\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-08-18 04:38:29\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:7:\\\"type_id\\\";i:2;s:11:\\\"description\\\";i:3;s:10:\\\"unit_price\\\";i:4;s:15:\\\"promotion_price\\\";i:5;s:16:\\\"product_quantity\\\";i:6;s:13:\\\"quantity_sold\\\";i:7;s:5:\\\"image\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}}s:37:\\\"\\u0000App\\\\Jobs\\\\SendEmailConfirm\\u0000totalPrice\\\";i:280000;s:35:\\\"\\u0000App\\\\Jobs\\\\SendEmailConfirm\\u0000totalQty\\\";i:2;}\"}}', 0, NULL, 1692685721, 1692685721),
(163, 'default', '{\"uuid\":\"9e00f2cb-b964-4f2b-85f4-ec57f4966df4\",\"displayName\":\"App\\\\Jobs\\\\SendEmailDelivering\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailDelivering\",\"command\":\"O:28:\\\"App\\\\Jobs\\\\SendEmailDelivering\\\":1:{s:35:\\\"\\u0000App\\\\Jobs\\\\SendEmailDelivering\\u0000email\\\";s:20:\\\"tinhnn.jvb@gmail.com\\\";}\"}}', 0, NULL, 1692685732, 1692685732);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2023_08_04_154924_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2023-08-22 13:28:41', '2023-08-22 06:28:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `order_status_id` bigint(10) NOT NULL DEFAULT 1,
  `phone` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `coupon_id` bigint(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) DEFAULT NULL,
  `product_id` bigint(10) DEFAULT NULL,
  `order_id` bigint(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `status`) VALUES
(1, 'Đơn hàng mới'),
(2, 'Đã giao'),
(3, 'Đã hủy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type_id` bigint(10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `product_quantity` bigint(11) NOT NULL DEFAULT 0,
  `quantity_sold` bigint(11) NOT NULL DEFAULT 0,
  `unit_price` bigint(20) DEFAULT NULL,
  `promotion_price` bigint(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `type_id`, `description`, `product_quantity`, `quantity_sold`, `unit_price`, `promotion_price`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Bánh Crepe Sầu riêng', 5, 'mô tả 234', 49, 1, 150000, 120000, '1430967449-pancake-sau-rieng-6.jpg', 1, '2016-10-25 20:00:16', '2023-08-22 06:28:52'),
(2, 'Bánh Crepe Chocolate', 6, '', 57, 1, 180000, 160000, 'crepe-chocolate.jpg', 1, '2016-10-25 20:00:16', '2023-08-22 06:28:52'),
(3, 'Bánh Crepe Sầu riêng - Chuối', 5, 'mô tả 2', 55, 0, 150000, 120000, 'crepe-chuoi.jpg', 1, '2016-10-25 20:00:16', '2023-08-17 01:42:52'),
(4, 'Bánh Crepe Đào', 5, 'mô tả 234', 8, 0, 160000, 160000, 'crepe-dao.jpg', 1, '2016-10-25 20:00:16', '2023-07-20 02:22:21'),
(5, 'Bánh Crepe Dâu', 5, 'Bánh ngon', 20, 0, 160000, 160000, 'crepedau.jpg', 1, '2016-10-25 20:00:16', '2023-07-20 02:22:31'),
(6, 'Bánh Crepe Pháp', 5, 'bánh tuyệt vời', 0, 0, 200000, 180000, 'crepe-phap.jpg', 1, '2016-10-25 20:00:16', '2023-07-20 02:22:40'),
(7, 'Bánh Crepe Táo', 5, 'bánh táo', 100, 0, 160000, 160000, 'crepe-tao.jpg', 1, '2016-10-25 20:00:16', '2023-07-20 02:22:53'),
(8, 'Bánh Crepe Trà xanh', 5, 'Bánh trà xanh ngon', 80, 0, 160000, 150000, 'crepe-traxanh.jpg', 1, '2016-10-25 20:00:16', '2023-07-20 02:23:05'),
(9, 'Bánh Crepe Sầu riêng và Dứa', 5, '', 70, 0, 160000, 150000, 'saurieng-dua.jpg', 1, '2016-10-25 20:00:16', '2016-10-24 15:11:00'),
(11, 'Bánh Gato Trái cây Việt Quất', 3, '', 88, 0, 250000, 250000, '544bc48782741.png', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(12, 'Bánh sinh nhật rau câu trái cây', 3, '', 22, 0, 200000, 180000, '210215-banh-sinh-nhat-rau-cau-body- (6).jpg', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(13, 'Bánh kem Chocolate Dâu', 3, '', 14, 0, 300000, 280000, 'banh kem sinh nhat.jpg', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(14, 'Bánh kem Dâu III', 3, '', 53, 0, 300000, 280000, 'Banh-kem (6).jpg', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(15, 'Bánh kem Dâu I', 3, '', 55, 0, 350000, 320000, 'banhkem-dau.jpg', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(16, 'Bánh trái cây II', 3, '', 75, 0, 150000, 120000, 'banhtraicay.jpg', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(17, 'Apple Cake', 3, '', 80, 0, 250000, 240000, 'Fruit-Cake_7979.jpg', 1, '2016-10-11 19:00:00', '2016-10-26 19:24:00'),
(18, 'Bánh ngọt nhân cream táo', 2, '', 23, 0, 180000, 180000, '20131108144733.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(19, 'Bánh Chocolate Trái cây', 2, '', 44, 0, 150000, 150000, 'Fruit-Cake_7976.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(20, 'Bánh Chocolate Trái cây II', 2, '', 66, 0, 150000, 150000, 'Fruit-Cake_7981.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(21, 'Peach Cake', 2, '', 74, 0, 160000, 150000, 'Peach-Cake_3294.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(22, 'Bánh bông lan trứng muối I', 1, 'bánh ngọt lắm', 200, 0, 160000, 150000, '1689845081-product.png', 1, '2016-10-12 19:20:00', '2023-07-20 02:24:49'),
(24, 'Bánh French', 1, '', 88, 0, 180000, 180000, 'banh-man-thu-vi-nhat-1.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(25, 'Bánh mì Australia', 1, '', 47, 0, 80000, 70000, 'dung-khoai-tay-lam-banh-gato-man-cuc-ngon.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(26, 'Bánh mặn thập cẩm', 1, '', 74, 0, 50000, 50000, 'Fruit-Cake.png', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(27, 'Bánh Muffins trứng', 1, '', 20, 0, 100000, 80000, 'maxresdefault.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(28, 'Bánh Scone Peach Cake', 1, '', 12, 0, 120000, 120000, 'Peach-Cake_3300.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(29, 'Bánh mì Loaf I', 1, '', 0, 0, 100000, 100000, 'sli12.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(30, 'Bánh kem Chocolate Dâu I', 4, '', 77, 0, 380000, 350000, 'sli12.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(31, 'Bánh kem Trái cây I', 4, '', 99, 0, 380000, 350000, 'Fruit-Cake.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(32, 'Bánh kem Trái cây II', 4, '', 41, 0, 380000, 350000, 'Fruit-Cake_7971.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(33, 'Bánh kem Doraemon', 4, '', 71, 0, 280000, 250000, 'p1392962167_banh74.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(34, 'Bánh kem Caramen Pudding', 4, '', 17, 0, 280000, 280000, 'Caramen-pudding636099031482099583.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(35, 'Bánh kem Chocolate Fruit', 4, '', 32, 0, 320000, 300000, 'chocolate-fruit636098975917921990.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(36, 'Bánh kem Coffee Chocolate GH6', 4, '', 23, 0, 320000, 300000, 'COFFE-CHOCOLATE636098977566220885.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(37, 'Bánh kem Mango Mouse', 4, '', 100, 0, 320000, 300000, 'mango-mousse-cake.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(38, 'Bánh kem Matcha Mouse', 4, '', 120, 0, 350000, 330000, 'MATCHA-MOUSSE.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(39, 'Bánh kem Flower Fruit', 4, '', 130, 0, 350000, 330000, 'flower-fruits636102461981788938.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(40, 'Bánh kem Strawberry Delight', 4, '', 160, 0, 350000, 330000, 'strawberry-delight636102445035635173.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(41, 'Bánh kem Raspberry Delight', 4, '', 74, 0, 350000, 330000, 'raspberry.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(42, 'Beefy Pizza', 6, 'Thịt bò xay, ngô, sốt BBQ, phô mai mozzarella', 0, 0, 150000, 130000, '40819_food_pizza.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(43, 'Hawaii Pizza', 6, 'Sốt cà chua, ham , dứa, pho mai mozzarella', 58, 0, 120000, 120000, 'hawaiian paradise_large-900x900.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(44, 'Smoke Chicken Pizza', 6, 'Gà hun khói,nấm, sốt cà chua, pho mai mozzarella.', 34, 0, 120000, 120000, 'chicken black pepper_large-900x900.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(45, 'Sausage Pizza', 6, 'Xúc xích klobasa, Nấm, Ngô, sốtcà chua, pho mai Mozzarella.', 68, 0, 120000, 120000, 'pizza-miami.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(46, 'Ocean Pizza', 6, 'Tôm , mực, xào cay,ớt xanh, hành tây, cà chua, phomai mozzarella.', 86, 0, 120000, 120000, 'seafood curry_large-900x900.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(47, 'All Meaty Pizza', 6, 'Ham, bacon, chorizo, pho mai mozzarella.', 7, 0, 140000, 140000, 'all1).jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(48, 'Tuna Pizza', 6, 'Cá Ngừ, sốt Mayonnaise,sốt càchua, hành tây, pho mai Mozzarella', 70, 0, 140000, 140000, '54eaf93713081_-_07-germany-tuna.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(49, 'Bánh su kem nhân dừa', 7, '', 54, 0, 120000, 100000, 'maxresdefault.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(50, 'Bánh su kem sữa tươi', 7, '', 55, 0, 120000, 100000, 'sukem.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(51, 'Bánh su kem sữa tươi chiên giòn', 7, '', 78, 0, 150000, 150000, '1434429117-banh-su-kem-chien-20.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(52, 'Bánh su kem dâu sữa tươi', 7, '', 47, 0, 150000, 150000, 'sukemdau.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(53, 'Bánh su kem bơ sữa tươi', 7, '', 3, 0, 150000, 150000, 'He-Thong-Banh-Su-Singapore-Chewy-Junior.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(54, 'Bánh su kem nhân trái cây sữa tươi', 7, '', 43, 0, 150000, 150000, 'foody-banh-su-que-635930347896369908.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(55, 'Bánh su kem cà phê', 7, '', 45, 0, 150000, 150000, 'banh-su-kem-ca-phe-1.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(56, 'Bánh su kem phô mai', 7, '', 25, 0, 150000, 150000, '50020041-combo-20-banh-su-que-pho-mai-9.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(57, 'Bánh su kem sữa tươi chocolate', 7, '', 17, 0, 150000, 150000, 'combo-20-banh-su-que-kem-sua-tuoi-phu-socola.jpg', 1, '2016-10-12 19:20:00', '2016-10-18 20:20:00'),
(60, 'Bánh Táo - Mỹ1', 2, 'thơm ngon', 11, 8, 200000, 200000, '1234.jpg', 1, '2016-10-26 10:00:00', '2023-08-21 19:05:48'),
(61, 'Bánh Cupcake - Anh Quốc', 6, 'Những chiếc cupcake có cấu tạo gồm phần vỏ bánh xốp mịn và phần kem trang trí bên trên rất bắt mắt với nhiều hình dạng và màu sắc khác nhau. Cupcake còn được cho là chiếc bánh mang lại niềm vui và tiếng cười như chính hình dáng đáng yêu của chúng.', 71, 0, 150000, 120000, 'cupcake.jpg', 1, NULL, NULL),
(62, 'Bánh Sachertorte', 6, 'Sachertorte là một loại bánh xốp được tạo ra bởi loại&nbsp;chocholate&nbsp;tuyệt hảo nhất của nước Áo. Sachertorte có vị ngọt nhẹ, gồm nhiều lớp bánh được làm từ ruột bánh mì và bánh sữa chocholate, xen lẫn giữa các lớp bánh là mứt mơ. Món bánh chocholate này nổi tiếng tới mức thành phố Vienna của Áo đã ấn định&nbsp;tổ chức một ngày Sachertorte quốc gia, vào 5/12 hằng năm', 70, 0, 250000, 220000, '111.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `id` bigint(10) NOT NULL,
  `link` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`id`, `link`, `image`) VALUES
(1, '', 'banner1.jpg'),
(2, '', 'banner2.jpg'),
(3, '', 'banner3.jpg'),
(4, '', 'banner4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statisticals`
--

CREATE TABLE `statisticals` (
  `id` bigint(10) NOT NULL,
  `month_year` varchar(20) NOT NULL,
  `count_product` bigint(20) NOT NULL DEFAULT 0,
  `count_revenue` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_products`
--

CREATE TABLE `type_products` (
  `id` bigint(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_products`
--

INSERT INTO `type_products` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Bánh mặn', 'Nếu từng bị mê hoặc bởi các loại tarlet ngọt thì chắn chắn bạn không thể bỏ qua những loại tarlet mặn. Ngoài hình dáng bắt mắt, lớp vở bánh giòn giòn cùng với nhân mặn như thịt gà, nấm, thị heo ,… của bánh sẽ chinh phục bất cứ ai dùng thử.', 'banh-man-thu-vi-nhat-1.jpg', '2016-10-12 02:16:15', '2023-08-02 02:23:29'),
(2, 'Bánh ngọt', 'Bánh ngọt là một loại thức ăn thường dưới hình thức món bánh dạng bánh mì từ bột nhào, được nướng lên dùng để tráng miệng. Bánh ngọt có nhiều loại, có thể phân loại dựa theo nguyên liệu và kỹ thuật chế biến như bánh ngọt làm từ lúa mì, bơ, bánh ngọt dạng bọt biển. Bánh ngọt có thể phục vụ những mục đính đặc biệt như bánh cưới, bánh sinh nhật, bánh Giáng sinh, bánh Halloween..', '20131108144733.jpg', '2016-10-12 02:16:15', '2016-10-13 01:38:35'),
(3, 'Bánh trái cây', 'Bánh trái cây, hay còn gọi là bánh hoa quả, là một món ăn chơi, không riêng gì của Huế nhưng khi \"lạc\" vào mảnh đất Cố đô, món bánh này dường như cũng mang chút tinh tế, cầu kỳ và đặc biệt. Lấy cảm hứng từ những loại trái cây trong vườn, qua bàn tay khéo léo của người phụ nữ Huế, món bánh trái cây ra đời - ngọt thơm, dịu nhẹ làm đẹp lòng biết bao người thưởng thức.', 'banhtraicay.jpg', '2016-10-18 00:33:33', '2016-10-15 07:25:27'),
(4, 'Bánh kem', 'Với người Việt Nam thì bánh ngọt nói chung đều hay được quy về bánh bông lan – một loại tráng miệng bông xốp, ăn không hoặc được phủ kem lên thành bánh kem. Tuy nhiên, cốt bánh kem thực ra có rất nhiều loại với hương vị, kết cấu và phương thức làm khác nhau chứ không chỉ đơn giản là “bánh bông lan” chung chung đâu nhé!', 'banhkem.jpg', '2016-10-26 03:29:19', '2016-10-26 02:22:22'),
(5, 'Bánh crepe', 'Crepe là một món bánh nổi tiếng của Pháp, nhưng từ khi du nhập vào Việt Nam món bánh đẹp mắt, ngon miệng này đã làm cho biết bao bạn trẻ phải “xiêu lòng”', 'sukemdau.jpg', '2016-10-28 04:00:00', '2016-10-27 04:00:23'),
(6, 'Bánh Pizza', 'Pizza đã không chỉ còn là một món ăn được ưa chuộng khắp thế giới mà còn được những nhà cầm quyền EU chứng nhận là một phần di sản văn hóa ẩm thực châu Âu. Và để được chứng nhận là một nhà sản xuất pizza không hề đơn giản. Người ta phải qua đủ mọi các bước xét duyệt của chính phủ Ý và liên minh châu Âu nữa… tất cả là để đảm bảo danh tiếng cho món ăn này.', 'pizza.jpg', '2016-10-25 17:19:00', NULL),
(7, 'Bánh su kem', 'Bánh su kem là món bánh ngọt ở dạng kem được làm từ các nguyên liệu như bột mì, trứng, sữa, bơ.... đánh đều tạo thành một hỗn hợp và sau đó bằng thao tác ép và phun qua một cái túi để định hình thành những bánh nhỏ và cuối cùng được nướng chín. Bánh su kem có thể thêm thành phần Sô cô la để tăng vị hấp dẫn. Bánh có xuất xứ từ nước Pháp.', 'sukemdau.jpg', '2016-10-25 17:19:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(10) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `email_verified_at`, `password`, `address`, `phone`, `is_active`, `is_admin`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tinh Nguyen9x', 'princetinkie97@gmail.com', NULL, '$2y$10$ohgWPS.dPgu5eRL0TBJ.kO7KJGebA3/wDk7dvNx.VRj5/x/kdy46O', 'Ha Noi', '0981240297', 1, 1, '1719784275', 'NV6gOA9VTXJqYlAK1r8Rj39uvDMm1nZDY3fxv5CTQZ2tLYX26rlQlPPPekY7', '2023-07-20 09:20:33', '2023-08-21 01:18:39'),
(2, 'Tinh Nguyen', 'tinhnn.jvb@gmail.com', NULL, '$2y$10$Ok0Jj9VhZzCeMQmuSsOoieeepIU/otjpT/oZzQDmQ1SvtJ2LZAViO', 'Ha Noi', '0981240297', 1, 1, NULL, '6jPMc6WYZVApnawiLe3oWY3mYuSwis8vJaOXhzmCCUEs3XiJAqrItrs6Isfa', '2023-07-28 01:49:19', '2023-08-21 01:55:48'),
(4, 'Peter', 'princetinkie96@gmail.com', NULL, '$2y$10$Aq9y5IwM5lu.Dq5MJR5VkeeSwZQcys8LKPc/o44D86jpmpCSA6D9a', 'Ha Noi', '0981240297', 1, 1, NULL, NULL, '2023-07-28 03:06:16', '2023-07-28 03:06:16'),
(6, 'Lương Sơn', 'toidaidot@gmail.com', NULL, '$2y$10$b1ZBb5RVMUqWczsQBL9rneGaEZfx/6wYKqEqsrvZLBoSgcl2/KPcy', 'Hồ Chí Minh', '0805161666', 1, 0, NULL, NULL, '2023-08-01 09:04:33', '2023-08-01 09:04:33'),
(7, 'Thánh Gióng', 'toidaidot2@gmail.com', NULL, '$2y$10$TlYCHWO7R1L.2tmb6CMZOO2e4oTg3ux9khYeAB5sn1aJNm.TQSxre', 'Đà Nẵng', '0702125595', 1, 0, NULL, NULL, '2023-08-01 09:05:19', '2023-08-01 09:05:19');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `infors`
--
ALTER TABLE `infors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Chỉ mục cho bảng `statisticals`
--
ALTER TABLE `statisticals`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371769542;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `infors`
--
ALTER TABLE `infors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `statisticals`
--
ALTER TABLE `statisticals`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `type_products`
--
ALTER TABLE `type_products`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
