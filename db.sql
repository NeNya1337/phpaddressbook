

CREATE TABLE `addresses` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(30) NOT NULL ,
    `city` VARCHAR(30) NOT NULL ,
    PRIMARY KEY (`id`)
    )
    ENGINE = InnoDB;

INSERT INTO `addresses`( `name`, `city`) VALUES ("mark","rüthen")