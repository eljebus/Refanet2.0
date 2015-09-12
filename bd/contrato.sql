-- MySQL Script generated by MySQL Workbench
-- 08/11/15 17:14:24
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema contrato
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema contrato
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `contrato` DEFAULT CHARACTER SET utf8 ;
USE `contrato` ;

-- -----------------------------------------------------
-- Table `contrato`.`Cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contrato`.`Cliente` ;

CREATE TABLE IF NOT EXISTS `contrato`.`Cliente` (
  `idClientes` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Fecha` DATE NOT NULL COMMENT '',
  `Usuario` INT NOT NULL COMMENT '',
  `Activo` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`idClientes`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contrato`.`Contrato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contrato`.`Contrato` ;

CREATE TABLE IF NOT EXISTS `contrato`.`Contrato` (
  `idContrato` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Inicio` DATE NOT NULL COMMENT '',
  `Fin` DATE NOT NULL COMMENT '',
  `Fecha` DATE NOT NULL COMMENT '',
  `Activo` TINYINT(1) NOT NULL COMMENT '',
  `Clientes` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idContrato`)  COMMENT '',
  INDEX `fk_Contrato_Clientes1_idx` (`Clientes` ASC)  COMMENT '',
  CONSTRAINT `fk_Contrato_Clientes1`
    FOREIGN KEY (`Clientes`)
    REFERENCES `contrato`.`Cliente` (`idClientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contrato`.`Privilegios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contrato`.`Privilegios` ;

CREATE TABLE IF NOT EXISTS `contrato`.`Privilegios` (
  `idPrivilegios` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Nivel` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `Descripcion` TEXT NULL DEFAULT NULL COMMENT '',
  `Activo` TINYINT(1) NOT NULL COMMENT '',
  `Contrato` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idPrivilegios`)  COMMENT '',
  INDEX `fk_Privilegios_Contrato1_idx` (`Contrato` ASC)  COMMENT '',
  CONSTRAINT `fk_Privilegios_Contrato1`
    FOREIGN KEY (`Contrato`)
    REFERENCES `contrato`.`Contrato` (`idContrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contrato`.`Pagos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contrato`.`Pagos` ;

CREATE TABLE IF NOT EXISTS `contrato`.`Pagos` (
  `idPagos` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Forma` VARCHAR(150) NOT NULL COMMENT '',
  `Monto` DECIMAL(6,2) NOT NULL COMMENT '',
  `Fecha` DATE NOT NULL COMMENT '',
  `Activo` TINYINT(1) NOT NULL COMMENT '',
  `Periodos` VARCHAR(45) NOT NULL COMMENT '',
  `Contrato` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idPagos`)  COMMENT '',
  INDEX `fk_Pagos_Contrato1_idx` (`Contrato` ASC)  COMMENT '',
  CONSTRAINT `fk_Pagos_Contrato1`
    FOREIGN KEY (`Contrato`)
    REFERENCES `contrato`.`Contrato` (`idContrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contrato`.`Comentario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contrato`.`Comentario` ;

CREATE TABLE IF NOT EXISTS `contrato`.`Comentario` (
  `idComentario` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Fecha` DATE NOT NULL COMMENT '',
  `Comentario` TEXT NOT NULL COMMENT '',
  `Asunto` VARCHAR(45) NOT NULL COMMENT '',
  `Cliente` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idComentario`)  COMMENT '',
  INDEX `fk_Comentario_Cliente1_idx` (`Cliente` ASC)  COMMENT '',
  CONSTRAINT `fk_Comentario_Cliente1`
    FOREIGN KEY (`Cliente`)
    REFERENCES `contrato`.`Cliente` (`idClientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
