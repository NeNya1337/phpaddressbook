CREATE DATABASE phpab COLLATE utf8mb4_general_ci;

CREATE TABLE `phpab`.`addresses` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(30) NOT NULL ,
    `city` VARCHAR(30) NOT NULL ,
    PRIMARY KEY (`id`)
    )
    ENGINE = InnoDB;

INSERT INTO `phpab`.`addresses`( `name`, `city`) VALUES ("mark","rüthen")