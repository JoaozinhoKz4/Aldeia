-- MySQL Script generated by MySQL Workbench
-- sex 14 fev 2020 10:09:43 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema u483503649_imob
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema u483503649_imob
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `u483503649_imob` DEFAULT CHARACTER SET utf8 ;
USE `u483503649_imob` ;

-- -----------------------------------------------------
-- Table `u483503649_imob`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u483503649_imob`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `ativo` INT NOT NULL DEFAULT 1,
  `nivel` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u483503649_imob`.`docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u483503649_imob`.`docs` (
  `id_doc` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` MEDIUMTEXT NOT NULL,
  `envio` DATETIME NOT NULL,
  `code` INT(45) NOT NULL,
  PRIMARY KEY (`id_doc`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `u483503649_imob`.`imoveis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u483503649_imob`.`imoveis` (
  `id_imovel` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `detalhes` MEDIUMTEXT NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `imagem` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`id_imovel`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;