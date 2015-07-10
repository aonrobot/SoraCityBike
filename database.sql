-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sora_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sora_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sora_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sora_db` ;

-- -----------------------------------------------------
-- Table `sora_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`users` (
  `id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `password_salt` VARCHAR(20) NOT NULL,
  `name` VARCHAR(120) NOT NULL,
  `role` VARCHAR(45) NULL,
  `created` DATETIME NOT NULL,
  `attempt` VARCHAR(45) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `sora_db`.`content`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`content` (
  `id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT(120) NULL,
  `slide_id` BIGINT(120) NULL,
  `cont_lang_id` BIGINT(120) NULL,
  `cont_name` VARCHAR(120) NULL,
  `cont_author` VARCHAR(120) NULL,
  `cont_slug` VARCHAR(200) NOT NULL,
  `cont_status` VARCHAR(20) NOT NULL,
  `cont_modified` DATETIME NULL,
  `cont_type` VARCHAR(20) NULL,
  `cont_mine_type` VARCHAR(100) NULL,
  `cont_thumbnail` VARCHAR(255) NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `user_id_fk_idx` (`user_id` ASC),
  CONSTRAINT `user_id_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `sora_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`language`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`language` (
  `lang_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `lang_code` VARCHAR(8) NOT NULL,
  `lang_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lang_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`content_translation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`content_translation` (
  `trans_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `cont_id` BIGINT(120) NULL,
  `lang_id` BIGINT(120) NULL,
  `cont_title` TEXT NOT NULL,
  `cont_content` LONGTEXT NOT NULL,
  `cont_description` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`trans_id`),
  INDEX `cont_id_idx` (`cont_id` ASC),
  INDEX `lang_code_idx` (`lang_id` ASC),
  CONSTRAINT `content_id_fk`
    FOREIGN KEY (`cont_id`)
    REFERENCES `sora_db`.`content` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lang_code_fk`
    FOREIGN KEY (`lang_id`)
    REFERENCES `sora_db`.`language` (`lang_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`content_meta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`content_meta` (
  `meta_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `cont_id` BIGINT(120) NULL,
  `meta_key` VARCHAR(255) NOT NULL,
  `meta_value` LONGTEXT NULL,
  PRIMARY KEY (`meta_id`),
  INDEX `cont_id_fk_idx` (`cont_id` ASC),
  CONSTRAINT `cont_id_fk`
    FOREIGN KEY (`cont_id`)
    REFERENCES `sora_db`.`content` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`category` (
  `cat_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `slide_id` BIGINT(120) NULL,
  `cat_name` VARCHAR(255) NOT NULL,
  `cat_slug` VARCHAR(200) NULL,
  `cat_type` VARCHAR(45) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`));


-- -----------------------------------------------------
-- Table `sora_db`.`category_relationships`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`category_relationships` (
  `category_relationship_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `cont_id` BIGINT(120) NOT NULL,
  `cat_id` BIGINT(120) NOT NULL,
  `cont_order` INT(11) NULL,
  PRIMARY KEY (`category_relationship_id`),
  INDEX `cat_id_idx` (`cat_id` ASC),
  CONSTRAINT `cont_id`
    FOREIGN KEY (`cont_id`)
    REFERENCES `sora_db`.`content` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `cat_id`
    FOREIGN KEY (`cat_id`)
    REFERENCES `sora_db`.`category` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`slide`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`slide` (
  `slide_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `slide_name` VARCHAR(120) NOT NULL,
  `slide_type` VARCHAR(45) NOT NULL,
  `slide_structure` TEXT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`slide_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`object`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`object` (
  `obj_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `obj_name` VARCHAR(120) NULL,
  `obj_url` VARCHAR(255) NULL,
  `obj_type` VARCHAR(45) NULL,
  PRIMARY KEY (`obj_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`menu` (
  `menu_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `obj_id` BIGINT(120) NULL,
  `parent_id` BIGINT(120) NULL,
  `menu_order` VARCHAR(45) NULL,
  PRIMARY KEY (`menu_id`),
  INDEX `obj_id_fk_idx` (`obj_id` ASC),
  CONSTRAINT `obj_id_fk`
    FOREIGN KEY (`obj_id`)
    REFERENCES `sora_db`.`object` (`obj_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`slide_data`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`slide_data` (
  `slide_data_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `slide_id` BIGINT(120) NOT NULL,
  `slide_data_name` VARCHAR(120) NULL,
  `slide_data_img_url` VARCHAR(255) NOT NULL,
  `slide_data_content` VARCHAR(200) NULL,
  `slide_data_img_link` VARCHAR(255) NULL,
  `slide_data_content_link` VARCHAR(255) NULL,
  `slide_data_order` VARCHAR(45) NULL,
  PRIMARY KEY (`slide_data_id`),
  INDEX `slide_ID_fok_idx` (`slide_id` ASC),
  CONSTRAINT `slide_ID_fok`
    FOREIGN KEY (`slide_id`)
    REFERENCES `sora_db`.`slide` (`slide_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`resetTokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`resetTokens` (
  `token` VARCHAR(40) NOT NULL,
  `uid` BIGINT(120) NOT NULL,
  `requested` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`token`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sora_db`.`site_meta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sora_db`.`site_meta` (
  `site_meta_id` BIGINT(120) NOT NULL AUTO_INCREMENT,
  `meta_key` VARCHAR(255) NOT NULL,
  `meta_value` LONGTEXT NULL,
  PRIMARY KEY (`site_meta_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
