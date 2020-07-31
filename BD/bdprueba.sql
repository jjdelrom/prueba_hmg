-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-07-2020 a las 17:14:31
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdprueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `commentary` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `commentary`) VALUES
(1, 'jdelgado', 'jdelgado', 'jdelgado@takeaway.es', 'jdelgado@takeaway.es', 1, 'KwwTJ/TdGm59NI11wbpuh8ucFn8ZenbJIVNIrfXaf2A', '$2y$13$Gao.QFEA8QTXQ8MXyU/dcupS4BJJlXCta3xrY6c0iFyfEaYSb5ff.', '2020-07-31 17:14:15', NULL, NULL, 'a:0:{}', NULL),
(4, 'pedro', 'pedro', 'pedro@gmail.com', 'pedro@gmail.com', 1, 'UPutZqwgQF1mQbhEVBfLNC1Ox1B.tHFlJBy4UYVNLOk', '$2y$13$9qbb7EMePbz8mce01AJnGuwo7aHUp4lykDfzXmBh4h7eNVYJa86si', '2020-07-29 18:02:52', NULL, NULL, 'a:0:{}', 'DDDD'),
(5, 'rocio', 'rocio', 'rocio@gmail.com', 'rocio@gmail.com', 1, '4kF9.GlTCg1baXMV5td9lqN250S3OhUldea5zqyDKyQ', '$2y$13$TJMgA/tFw07YQe7lEJv8UeQqLT7UVP8CdJeYnwntT69WepNkz01Yq', '2020-07-31 16:55:40', NULL, NULL, 'a:0:{}', NULL),
(6, 'laura', 'laura', 'laura@gmail.com', 'laura@gmail.com', 0, 'Ol0XqGWMogqJW7xauhKNbfr0NbMIsxUZx4WLeteiqAM', '$2y$13$u6aM6n0jJNv/KhxGzpShp.gqTkf2XgzxJqtIy44M.NAQ6nvVX3hpG', '2020-07-31 16:56:09', NULL, NULL, 'a:0:{}', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200726143934', '2020-07-26 14:40:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth2_access_tokens`
--

DROP TABLE IF EXISTS `oauth2_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth2_access_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D247A21B19EB6921` (`client_id`),
  KEY `IDX_D247A21BA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth2_auth_codes`
--

DROP TABLE IF EXISTS `oauth2_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth2_auth_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `redirect_uri` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A018A10D19EB6921` (`client_id`),
  KEY `IDX_A018A10DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth2_auth_codes`
--

INSERT INTO `oauth2_auth_codes` (`id`, `client_id`, `user_id`, `redirect_uri`, `expires_at`, `scope`, `token`) VALUES
(1, 1, 1, 'http://localhost:8000/redirect-uri-example', 1595779811, NULL, 'NWMzNGY2MTk0ZmVjNzNhZjcyNGJhNThhODFjNzYzMDNhOGUzMWQzNTEwNjBhYTQ4YjRhYWMxMDk4ZTRkYzAyNA'),
(2, 1, 1, 'http://localhost:8000/redirect-uri-example', 1595780501, NULL, 'YzNmZjk2Nzk3NWNlNTRlZDA1ODRhY2MwNjg0MjQxYmY3OTEyOTA3ZTZlOTcwY2I5YmNhZmU5ZGQwYTk4MGVlZQ'),
(3, 1, 1, 'http://localhost:8000/redirect-uri-example', 1596206892, NULL, 'ZmRlY2M3ZWI3NGYzM2UwOGIyODkyY2VjZDExN2Y3MzgwMDk3MTQ4MGE4YjMwYWQ4NGVkYTZlYzI3YjUzOTM4OQ'),
(4, 1, 1, 'http://localhost:8000/redirect-uri-example', 1596206903, NULL, 'MDdkNmQ5YjNiZTY1NjExZDU0MDE1YzAxMTE0MDdhYjNiNjE3OWMwYzg3OWYyMDY1YThjOTcwOTUyMzk0MTY3Ng'),
(5, 1, 1, 'http://localhost:8000/redirect-uri-example', 1596207326, NULL, 'Yzc0YWVjOTY5MTY3YWQxNDZjMTM5ZmE2YTk4ZTFkM2M3MjYwY2Q4NWIxNTJkZTk0YTFhYTQ2OTZkMDljMTU0Yg'),
(6, 1, 1, 'http://localhost:8000/redirect-uri-example', 1596207547, NULL, 'NTBlNGUzMTVhN2NmYjNkYzdhNzhjMjg3MTg0MTAwMjljMTY5NGFmZDgwYjExNzQwODBhY2ZiN2E4NjZiOTM5NQ'),
(7, 2, 1, 'http://localhost:8000/redirect-uri-example', 1596207934, NULL, 'MTc0ODFjMTcwZjEzZTBhMGRhOGEwYmVmMDc5NWRjZGYyMTk4MmQyNjJiMGI3YjdlMzlmNTczZWI2MmMxZTRkMQ'),
(8, 2, 1, 'http://localhost:8000/redirect-uri-example', 1596208034, NULL, 'NzMzODAxZTNlYTFmNGI1YTI4NzJhMTg3NmQwZWQyM2ViOGMxMGUxOTlmNjFkZmRmMDI1M2ZmZDRmN2E3MjI3YQ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth2_clients`
--

DROP TABLE IF EXISTS `oauth2_clients`;
CREATE TABLE IF NOT EXISTS `oauth2_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `random_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect_uris` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowed_grant_types` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth2_clients`
--

INSERT INTO `oauth2_clients` (`id`, `random_id`, `redirect_uris`, `secret`, `allowed_grant_types`) VALUES
(1, '2i5duwms2eo0o04w4o4o04ogcsgg4gs48gk40kwss4k40kc48c', 'a:1:{i:0;s:42:\"http://localhost:8000/redirect-uri-example\";}', '4y9624wrr1k488gkkgwwkok8ggoo0kgkgs8kkkw8404k0s8gc0', 'a:1:{i:0;s:18:\"authorization_code\";}'),
(2, '5lmbgtgxigco0cwss0ws88gscgso0o0gcws4cc0kckww84skco', 'a:1:{i:0;s:42:\"http://localhost:8000/redirect-uri-example\";}', '240cdeirdp7o4g880k4ogsc08owwc4cs880400ogs4ogc880ww', 'a:2:{i:0;s:18:\"authorization_code\";i:1;s:13:\"refresh_token\";}'),
(3, '16cawykbuibkwccck8wgscocwogc00kscw8wwc480kwcswogs8', 'a:1:{i:0;s:42:\"http://localhost:8000/redirect-uri-example\";}', '4vhspqjm9eyows8w4cw040g4o04s848cggw84wc8888gko408o', 'a:2:{i:0;s:18:\"authorization_code\";i:1;s:13:\"refresh_token\";}'),
(4, 'e7oj9nqj3dsksc0wo8o8wosc844sw4wcwgssg4c8osw448ww', 'a:1:{i:0;s:42:\"http://localhost:8000/redirect-uri-example\";}', '2o7yvtkjd20wsgg0osw04kw8s0os4k4o8gksccwocoosw44ksg', 'a:1:{i:0;s:8:\"implicit\";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth2_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth2_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth2_refresh_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D394478C19EB6921` (`client_id`),
  KEY `IDX_D394478CA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `oauth2_access_tokens`
--
ALTER TABLE `oauth2_access_tokens`
  ADD CONSTRAINT `FK_D247A21B19EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`),
  ADD CONSTRAINT `FK_D247A21BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `oauth2_auth_codes`
--
ALTER TABLE `oauth2_auth_codes`
  ADD CONSTRAINT `FK_A018A10D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`),
  ADD CONSTRAINT `FK_A018A10DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `oauth2_refresh_tokens`
--
ALTER TABLE `oauth2_refresh_tokens`
  ADD CONSTRAINT `FK_D394478C19EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`),
  ADD CONSTRAINT `FK_D394478CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
