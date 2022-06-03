-- MySQL dump 10.13  Distrib 8.0.17, for Linux (x86_64)
--
-- Host: localhost    Database: app
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Database structure
--
DROP DATABASE IF EXISTS `app`;
CREATE DATABASE `app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;

GRANT ALL ON *.* TO `sample`@`%`; 

USE app;

--
-- Table structure
--
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL comment 'ID',
	name VARCHAR(255) comment 'ユーザ名',
	CONSTRAINT uses_PKC PRIMARY KEY (id)
) comment 'users';

DROP TABLE IF EXISTS user_data;
CREATE TABLE user_data (
	id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL comment 'ID',
	user_id BIGINT UNSIGNED NOT NULL comment 'ユーザID',
	address text comment '住所',
	CONSTRAINT uses_PKC PRIMARY KEY (id),
	INDEX user_id_index (user_id)
) comment 'user_data';
