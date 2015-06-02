
****Advance PHP Final Project Proposal****
------------------------------------------


Members: Cameron Prince, Brad Segel

Project Idea: A firearm manager that will store
    a gun name, caliber, serial number, manufacturer, sale price per record

Tasks:
    -(1)Add firearm
    -(2)Relay a list of firearms
    -(3)Update firearm information
    -(4)Delete firearm from list

Assigned tasks
    -Cameron Prince tasks: 2, 4
    -Brad Segel tasks: 1, 3

Estimated Time
    - One day per task

Run this
DROP database IF EXISTS firearmsdb;
CREATE DATABASE IF NOT EXISTS FirearmsDB ;
USE `FirearmsDB` ;

CREATE TABLE IF NOT EXISTS Firearms (
  `idFirearms` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(45) NULL,
  `caliber` VARCHAR(45) NULL,
  `sernum` VARCHAR(45) NULL,
  `manuf` VARCHAR(45) NULL,
  `price` DECIMAL NULL,
  `owner_id` INT NULL)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `FirearmsDB`.`Person` (
`userid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(45) NULL,
  `level` VARCHAR(128) NULL)
ENGINE = InnoDB;

INSERT INTO Firearms (name, caliber, sernum, manuf, price, owner_id)
VALUES ('1911','45ACP','97F2A96','Springfield',1200.00,0);

