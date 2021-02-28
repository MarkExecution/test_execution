-- MySQL Script generated by MySQL Workbench
-- Sun Feb 28 17:10:26 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tasks` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Порядковый номер задания',
  `user` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT 'Имя пользователя',
  `mail` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `status` VARCHAR(16) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `task` TEXT(1000) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  PRIMARY KEY (`id`),
  INDEX `index3` (`user` ASC) INVISIBLE,
  INDEX `index4` (`mail` ASC) INVISIBLE,
  INDEX `index5` (`status` ASC) INVISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tokens` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Порядковый номер',
  `login` VARCHAR(30) NULL COMMENT 'Логин',
  `passw` VARCHAR(30) NULL COMMENT 'Пароль',
  `token` VARCHAR(36) NULL COMMENT 'Текущий ключ администратора',
  PRIMARY KEY (`id`),
  INDEX `kl1` (`token` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Таблица авторизации';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;