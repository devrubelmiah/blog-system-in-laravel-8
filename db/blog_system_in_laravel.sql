-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2021 at 12:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_system_in_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Laravel Framewark', 'laravel-framewark', 'laravel-framewark-2021-01-18.6004ecc483f4a.jpg', '2021-01-17 20:04:52', '2021-01-17 20:04:52'),
(3, 'PHP', 'php', 'php-2021-01-18.6004ecf077f1a.jpg', '2021-01-17 20:05:36', '2021-01-17 20:05:36'),
(4, 'Loving Vue && React JS', 'loving-vue-react-js', 'loving-vue-react-js-2021-01-18.6004f234afb48.jpg', '2021-01-17 20:06:47', '2021-01-17 20:28:04'),
(5, 'jQuery', 'jquery', 'jquery-2021-01-18.6004f55460d57.jpg', '2021-01-17 20:41:24', '2021-01-17 20:41:24'),
(6, 'WordPress CMS', 'wordpress-cms', 'wordpress-cms-2021-01-18.6004f572948ed.jpg', '2021-01-17 20:41:54', '2021-01-17 20:41:54'),
(7, 'HTML & CSS', 'html-css', 'html-css-2021-01-18.6004f5a850d80.jpg', '2021-01-17 20:42:48', '2021-01-17 20:42:48'),
(8, 'test', 'test', 'test-2021-01-18.60050122dfb6f.jpg', '2021-01-17 21:31:46', '2021-01-17 21:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(10, 4, 2, '2021-01-18 04:08:01', '2021-01-18 04:08:01'),
(11, 4, 3, '2021-01-18 04:08:01', '2021-01-18 04:08:01'),
(12, 4, 6, '2021-01-18 04:08:01', '2021-01-18 04:08:01'),
(13, 5, 3, '2021-01-18 04:09:12', '2021-01-18 04:09:12'),
(14, 5, 8, '2021-01-18 04:09:12', '2021-01-18 04:09:12'),
(15, 6, 2, '2021-01-18 04:10:35', '2021-01-18 04:10:35'),
(16, 6, 7, '2021-01-18 04:10:35', '2021-01-18 04:10:35'),
(17, 7, 3, '2021-01-18 04:11:30', '2021-01-18 04:11:30'),
(18, 7, 7, '2021-01-18 04:11:30', '2021-01-18 04:11:30'),
(30, 12, 3, '2021-01-18 21:32:45', '2021-01-18 21:32:45'),
(31, 12, 4, '2021-01-18 21:32:45', '2021-01-18 21:32:45'),
(32, 12, 5, '2021-01-18 21:32:45', '2021-01-18 21:32:45'),
(36, 14, 3, '2021-01-25 10:36:27', '2021-01-25 10:36:27'),
(37, 14, 5, '2021-01-25 10:36:27', '2021-01-25 10:36:27'),
(38, 15, 3, '2021-01-25 10:37:10', '2021-01-25 10:37:10'),
(39, 15, 5, '2021-01-25 10:37:10', '2021-01-25 10:37:10'),
(40, 16, 2, '2021-01-25 10:38:24', '2021-01-25 10:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_16_032401_create_roles_table', 1),
(5, '2021_01_17_061342_create_tags_table', 2),
(6, '2021_01_17_061601_create_categories_table', 2),
(7, '2021_01_18_044152_create_posts_table', 3),
(8, '2021_01_18_051347_create_category_post', 4),
(9, '2021_01_18_051812_create_post_tag', 4),
(10, '2021_01_22_145932_create_comments_table', 5),
(11, '2021_01_22_150654_create_subscribes_table', 5),
(12, '2021_01_22_150907_create_post_user', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@blog.com', '$2y$10$GFuoxRXvXUmwXeIcRPRvWekoDZKgLh7gfdoX6HqqyhmU1OgVuzlS.', '2021-01-15 21:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `image`, `body`, `view_count`, `status`, `is_approved`, `created_at`, `updated_at`) VALUES
(4, 1, 'Lorem Ipsum', 'lorem-ipsum-1610964480', '2021-01-18.60055e00e5d34.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id metus mi. Mauris eros elit, pulvinar id risus id, fermentum molestie nibh. Sed sit amet faucibus nisl, quis condimentum ante. Morbi vitae tincidunt lorem. In hac habitasse platea dictumst. Etiam at lobortis augue. Nulla nec dui ac nisi volutpat rutrum quis eu ligula. Donec aliquet dui neque, vitae porta nulla interdum eget. Duis turpis erat, faucibus at laoreet a, dapibus sed quam. Pellentesque tortor ex, consectetur non lacus et, fringilla laoreet purus.</p>\r\n<p>Etiam non erat tincidunt, vestibulum ante sed, lacinia ipsum. Donec sed ultrices urna. Sed convallis, mauris at tincidunt tincidunt, metus odio varius ex, vitae pretium nunc risus sed odio. Phasellus vulputate lectus eget consectetur viverra. Etiam condimentum blandit mollis. Suspendisse nec erat quis sapien tristique rutrum quis quis purus. Nunc aliquet, sapien a malesuada hendrerit, enim urna porttitor quam, vel tristique erat leo nec nunc. Aliquam faucibus augue id sodales rhoncus.</p>\r\n<p>Aenean elementum dignissim velit ut convallis. Nulla rutrum egestas mollis. Donec interdum pulvinar finibus. Suspendisse quis augue orci. Sed consequat commodo finibus. Proin quam sapien, condimentum quis est id, egestas pretium augue. Cras id scelerisque leo. Pellentesque euismod velit purus, et iaculis orci suscipit placerat.</p>\r\n<p>Nam imperdiet velit sit amet scelerisque convallis. Suspendisse sit amet est a mi maximus eleifend. Vivamus venenatis dui eget vestibulum ultricies. Nullam quis tellus vel mi placerat fringilla. Sed sit amet laoreet mauris. Ut ut mollis risus, eget venenatis metus. Mauris non accumsan eros.</p>\r\n<p>Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum euismod justo eu lacus dignissim consequat. Integer sit amet lacus vel tellus suscipit malesuada. Nunc ac porttitor quam, ac feugiat elit. Vivamus et arcu vitae odio tincidunt iaculis vitae ut arcu. Curabitur in mauris convallis, consectetur lacus nec, dapibus tortor. Phasellus non elit eget nisi dignissim aliquet. Nulla felis nisl, egestas et sagittis vel, luctus ac orci. Proin non dui et odio viverra tempus id vel leo. Mauris tincidunt vehicula lorem, non mattis leo commodo non.</p>', 0, 1, 1, '2021-01-18 04:08:00', '2021-01-18 04:08:00'),
(5, 1, 'What is Lorem Ipsum?', 'what-is-lorem-ipsum-1610964552', '2021-01-18.60055e48b7422.jpg', '<div>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>', 3, 1, 1, '2021-01-18 04:09:12', '2021-01-25 11:25:12'),
(6, 1, 'Where does it come from?', 'where-does-it-come-from-1610964635', '2021-01-18.60055e9b86c5d.jpg', '<div>\r\n<h2>&nbsp;</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>&nbsp;</div>', 0, 1, 1, '2021-01-18 04:10:35', '2021-01-18 04:10:35'),
(7, 1, 'Why do we use it?', 'why-do-we-use-it-1610964689', '2021-01-18.60055ed1d9df6.jpg', '<div>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>&nbsp;</div>', 1, 1, 1, '2021-01-18 04:11:29', '2021-01-25 11:24:55'),
(12, 2, 'Why do we use it?', 'why-do-we-use-it-1611033368', '2021-01-19.600652dcec2a1.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 1, 1, 1, '2021-01-18 21:32:44', '2021-01-25 10:57:13'),
(14, 1, 'Test Loving', 'test-loving-1611592587', '2021-01-25.600ef38bd1c75.jpg', '<p>Test Project ................</p>', 0, 1, 0, '2021-01-25 10:36:27', '2021-01-25 10:36:27'),
(15, 1, 'Test Loving', 'test-loving-1611592630', '2021-01-25.600ef3b67836b.jpg', '<p>Test Project ................</p>', 0, 1, 0, '2021-01-25 10:37:10', '2021-01-25 10:37:10'),
(16, 1, 's', 's-1611592704', '2021-01-25.600ef400b1a4b.jpg', '<p>sdfgsadfa</p>', 0, 1, 0, '2021-01-25 10:38:24', '2021-01-25 10:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(11, 4, 3, '2021-01-18 04:08:01', '2021-01-18 04:08:01'),
(12, 4, 6, '2021-01-18 04:08:01', '2021-01-18 04:08:01'),
(13, 5, 3, '2021-01-18 04:09:12', '2021-01-18 04:09:12'),
(14, 5, 6, '2021-01-18 04:09:12', '2021-01-18 04:09:12'),
(15, 6, 1, '2021-01-18 04:10:36', '2021-01-18 04:10:36'),
(16, 6, 4, '2021-01-18 04:10:36', '2021-01-18 04:10:36'),
(17, 7, 1, '2021-01-18 04:11:30', '2021-01-18 04:11:30'),
(18, 7, 7, '2021-01-18 04:11:30', '2021-01-18 04:11:30'),
(31, 12, 1, '2021-01-18 21:32:45', '2021-01-18 21:32:45'),
(32, 12, 3, '2021-01-18 21:32:45', '2021-01-18 21:32:45'),
(33, 12, 5, '2021-01-18 21:32:45', '2021-01-18 21:32:45'),
(37, 14, 1, '2021-01-25 10:36:28', '2021-01-25 10:36:28'),
(38, 14, 3, '2021-01-25 10:36:28', '2021-01-25 10:36:28'),
(39, 15, 1, '2021-01-25 10:37:10', '2021-01-25 10:37:10'),
(40, 15, 3, '2021-01-25 10:37:10', '2021-01-25 10:37:10'),
(41, 16, 3, '2021-01-25 10:38:24', '2021-01-25 10:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `post_user`
--

CREATE TABLE `post_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_user`
--

INSERT INTO `post_user` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(13, 12, 2, '2021-01-25 11:17:40', '2021-01-25 11:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Author', 'author', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `email`, `created_at`, `updated_at`) VALUES
(2, 'laravel@gmail.com', '2021-01-23 09:29:25', '2021-01-23 09:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'blog', 'blog', '2021-01-17 02:09:05', '2021-01-17 02:09:05'),
(3, 'CSS', 'css', '2021-01-17 03:25:21', '2021-01-17 03:25:21'),
(4, 'Bootrap', 'bootrap', '2021-01-17 03:26:21', '2021-01-17 03:26:21'),
(5, 'jQuery', 'jquery', '2021-01-17 03:27:08', '2021-01-17 03:27:08'),
(6, 'Laravel', 'laravel', '2021-01-17 03:27:43', '2021-01-17 03:27:43'),
(7, 'Ract Js', 'ract-js', '2021-01-17 03:28:49', '2021-01-17 05:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `password`, `image`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'MD.Admin', 'admin', 'admin@blog.com', '$2y$10$WIlh75hleGN/wK6PUxVGou4STNueIr33lVEkbpMCUlLhnRzrh6fxq', '2021-01-19.6006b8714c870.jpg', 'It is a about section', NULL, '2021-01-05 17:50:19', '2021-01-25 01:36:11'),
(2, 2, 'MD.Author', 'author', 'author@blog.com', '$2y$10$3m16/yZIbwJGsKVSIuqHtuG7nswxUHWKSm0dYLpOgJBhbL11qr0za', '2021-01-20.6007a320209ca.jpg', 'I am a web developer', NULL, '2021-01-04 07:42:34', '2021-01-24 09:58:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_user`
--
ALTER TABLE `post_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `post_user`
--
ALTER TABLE `post_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_user`
--
ALTER TABLE `post_user`
  ADD CONSTRAINT `post_user_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
