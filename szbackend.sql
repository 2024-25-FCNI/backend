-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 29. 13:53
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szbackend`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('user@gmailcom|127.0.0.1', 'i:1;', 1745921353),
('user@gmailcom|127.0.0.1:timer', 'i:1745921352;', 1745921353);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cimkes`
--

CREATE TABLE `cimkes` (
  `cimke_id` bigint(20) UNSIGNED NOT NULL,
  `elnevezes` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `cimkes`
--

INSERT INTO `cimkes` (`cimke_id`, `elnevezes`, `created_at`, `updated_at`) VALUES
(1, 'Új', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(2, 'Akciós', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(3, 'Kedvezményes', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(4, 'Top termék', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(5, 'Limitált kiadás', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(6, 'Ajánlott', '2025-04-28 14:46:12', '2025-04-28 14:46:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csomagbans`
--

CREATE TABLE `csomagbans` (
  `csomag_id` bigint(20) UNSIGNED NOT NULL,
  `termek_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
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
-- Tábla szerkezet ehhez a táblához `jobs`
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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kapcsolos`
--

CREATE TABLE `kapcsolos` (
  `termek_id` bigint(20) UNSIGNED NOT NULL,
  `cimke_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `kapcsolos`
--

INSERT INTO `kapcsolos` (`termek_id`, `cimke_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(1, 3, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(2, 2, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(2, 5, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(3, 1, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(3, 3, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(4, 2, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(4, 4, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(5, 5, '2025-04-28 14:46:14', '2025-04-28 14:46:14'),
(6, 6, '2025-04-28 14:46:14', '2025-04-28 14:46:14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_24_193824_create_personal_access_tokens_table', 1),
(5, '2025_01_25_101528_create_vasarlas_fejs_table', 1),
(6, '2025_01_25_101623_create_cimkes_table', 1),
(7, '2025_01_25_101645_create_termeks_table', 1),
(8, '2025_01_25_101713_create_vasarlas_tetels_table', 1),
(9, '2025_01_25_101723_create_csomagbans_table', 1),
(10, '2025_01_25_101800_create_kapcsolos_table', 1),
(11, '2025_02_04_091320_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
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
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termeks`
--

CREATE TABLE `termeks` (
  `termek_id` bigint(20) UNSIGNED NOT NULL,
  `cim` varchar(255) NOT NULL,
  `bemutatas` varchar(255) NOT NULL,
  `leiras` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `hozzaferesi_ido` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `jelzes` varchar(255) NOT NULL,
  `kep` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `termeks`
--

INSERT INTO `termeks` (`termek_id`, `cim`, `bemutatas`, `leiras`, `url`, `hozzaferesi_ido`, `ar`, `jelzes`, `kep`, `created_at`, `updated_at`) VALUES
(1, 'Termék 1', 'Ez az első termék.', 'Ez az első termék.', 'https://drive.google.com/file/d/1LMqjnFgRrVg2-l3CtrejDaefkw9G7PVI/view?usp=drive_link', 30, 5000, 'új', '', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(2, 'Termék 2', 'Ez az első termék.', 'Ez a második termék.', '/termek2', 60, 8000, 'akciós', '/images/termek2.jpg', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(3, 'Termék 3', 'Ez az első termék.', 'Ez a harmadik termék.', '/termek3', 90, 10000, 'top', '/images/termek3.jpg', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(4, 'Termék 4', 'Ez az első termék.', 'Ez a negyedik termék.', '/termek4', 120, 15000, 'új', '/images/termek4.jpg', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(5, 'Termék 5', 'Ez az első termék.', 'Ez az ötödik termék.', '/termek5', 180, 20000, 'akciós', '/images/termek5.jpg', '2025-04-28 14:46:12', '2025-04-28 14:46:12'),
(6, 'Termék 6', 'Ez az első termék.', 'Ez a hatodik termék.', '/termek6', 240, 25000, 'top', '/images/termek6.jpg', '2025-04-28 14:46:12', '2025-04-28 14:46:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profilkep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `profilkep`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$vjMFzxRpny6mRzshhBB0Qeir.1C9L9X54NDJnv1QffsVJ.gpCIixC', 0, NULL, '2025-04-28 14:46:09', '2025-04-28 14:46:09', '/images/termek3.jpg'),
(2, 'Normal User', 'user@gmail.com', NULL, '$2y$12$mYD5Pa5wpQ0xO/AAHdrDC.XXLAESKau4KAXLxCYGusr7GVjoy/QKi', 1, NULL, '2025-04-28 14:46:11', '2025-04-28 14:46:11', '/images/termek3.jpg'),
(3, 'nn', 'neda.irisz@phwi.hu', NULL, '$2y$12$L3W1tJPGM8FNDWDl7yPBfO3rKPvOBd/XaqZI70KR.KOez8SjHFx7u', 1, NULL, '2025-04-28 14:47:40', '2025-04-28 14:47:40', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vasarlas_fejs`
--

CREATE TABLE `vasarlas_fejs` (
  `vasarlas_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `osszeg` int(11) NOT NULL,
  `datum` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vasarlas_tetels`
--

CREATE TABLE `vasarlas_tetels` (
  `vasarlas_id` bigint(20) UNSIGNED NOT NULL,
  `termek_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eseményindítók `vasarlas_tetels`
--
DELIMITER $$
CREATE TRIGGER `update_total_after_insert` AFTER INSERT ON `vasarlas_tetels` FOR EACH ROW BEGIN
            UPDATE vasarlas_fejs SET osszeg = (
                SELECT SUM(termeks.ar) FROM vasarlas_tetels 
                JOIN termeks ON vasarlas_tetels.termek_id = termeks.termek_id
                WHERE vasarlas_tetels.vasarlas_id = NEW.vasarlas_id
            ) WHERE vasarlas_fejs.vasarlas_id = NEW.vasarlas_id;
        END
$$
DELIMITER ;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cimkes`
--
ALTER TABLE `cimkes`
  ADD PRIMARY KEY (`cimke_id`);

--
-- A tábla indexei `csomagbans`
--
ALTER TABLE `csomagbans`
  ADD PRIMARY KEY (`csomag_id`,`termek_id`),
  ADD KEY `csomagbans_termek_id_foreign` (`termek_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kapcsolos`
--
ALTER TABLE `kapcsolos`
  ADD PRIMARY KEY (`termek_id`,`cimke_id`),
  ADD KEY `kapcsolos_cimke_id_foreign` (`cimke_id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `termeks`
--
ALTER TABLE `termeks`
  ADD PRIMARY KEY (`termek_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A tábla indexei `vasarlas_fejs`
--
ALTER TABLE `vasarlas_fejs`
  ADD PRIMARY KEY (`vasarlas_id`),
  ADD KEY `vasarlas_fejs_user_id_foreign` (`user_id`);

--
-- A tábla indexei `vasarlas_tetels`
--
ALTER TABLE `vasarlas_tetels`
  ADD PRIMARY KEY (`vasarlas_id`,`termek_id`),
  ADD KEY `vasarlas_tetels_termek_id_foreign` (`termek_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cimkes`
--
ALTER TABLE `cimkes`
  MODIFY `cimke_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `termeks`
--
ALTER TABLE `termeks`
  MODIFY `termek_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `vasarlas_fejs`
--
ALTER TABLE `vasarlas_fejs`
  MODIFY `vasarlas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `csomagbans`
--
ALTER TABLE `csomagbans`
  ADD CONSTRAINT `csomagbans_csomag_id_foreign` FOREIGN KEY (`csomag_id`) REFERENCES `termeks` (`termek_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `csomagbans_termek_id_foreign` FOREIGN KEY (`termek_id`) REFERENCES `termeks` (`termek_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `kapcsolos`
--
ALTER TABLE `kapcsolos`
  ADD CONSTRAINT `kapcsolos_cimke_id_foreign` FOREIGN KEY (`cimke_id`) REFERENCES `cimkes` (`cimke_id`),
  ADD CONSTRAINT `kapcsolos_termek_id_foreign` FOREIGN KEY (`termek_id`) REFERENCES `termeks` (`termek_id`);

--
-- Megkötések a táblához `vasarlas_fejs`
--
ALTER TABLE `vasarlas_fejs`
  ADD CONSTRAINT `vasarlas_fejs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `vasarlas_tetels`
--
ALTER TABLE `vasarlas_tetels`
  ADD CONSTRAINT `vasarlas_tetels_termek_id_foreign` FOREIGN KEY (`termek_id`) REFERENCES `termeks` (`termek_id`),
  ADD CONSTRAINT `vasarlas_tetels_vasarlas_id_foreign` FOREIGN KEY (`vasarlas_id`) REFERENCES `vasarlas_fejs` (`vasarlas_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
