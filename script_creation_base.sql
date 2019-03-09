-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tp2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tp2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tp2` ;
USE `tp2` ;

-- -----------------------------------------------------
-- Table `tp2`.`Comptes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tp2`.`Comptes` ;

CREATE TABLE IF NOT EXISTS `tp2`.`Comptes` (
  `idComptes` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idComptes`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tp2`.`Transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tp2`.`Transactions` ;

CREATE TABLE IF NOT EXISTS `tp2`.`Transactions` (
  `idTransactions` INT NOT NULL AUTO_INCREMENT,
  `solde` INT NOT NULL DEFAULT 0,
  `date` DATETIME NOT NULL,
  `idCompte` INT NOT NULL,
  PRIMARY KEY (`idTransactions`),
  INDEX `fk_Transactions_1_idx` (`idCompte` ASC),
  CONSTRAINT `fk_Transactions_1`
    FOREIGN KEY (`idCompte`)
    REFERENCES `tp2`.`Comptes` (`idComptes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
