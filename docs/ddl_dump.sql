SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `mark` varchar(10) NOT NULL,
  `number` varchar(10) NOT NULL,
  `state` int(1) DEFAULT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `addr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `took` datetime NOT NULL,
  `gave` datetime DEFAULT NULL,
  `department_from` int(11) NOT NULL,
  `department_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_from`),
  ADD KEY `avto_id` (`auto_id`),
  ADD KEY `department_to_id` (`department_to`);

ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`department_from`) REFERENCES `department` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_4` FOREIGN KEY (`department_to`) REFERENCES `department` (`id`) ON UPDATE CASCADE;
COMMIT;
