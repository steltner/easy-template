
CREATE SCHEMA IF NOT EXISTS `name`;
USE `name`;

CREATE TABLE IF NOT EXISTS `name`.`Migration`
(
    `migrationId`   INT          NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(120) NOT NULL,
    `executionTime` INT          NOT NULL,
    PRIMARY KEY (`migrationId`)
)
    ENGINE = InnoDB;
