-- MySQL Script generated by MySQL Workbench
-- 09/16/16 11:49:37
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ff_bruno
-- -----------------------------------------------------
-- Banco de dados do software para o festival. Terá foco nas áreas de negócios de reserva de ingresso e programação do festival.

-- -----------------------------------------------------
-- Schema ff_bruno
--
-- Banco de dados do software para o festival. Terá foco nas áreas de negócios de reserva de ingresso e programação do festival.
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ff_bruno` DEFAULT CHARACTER SET utf8 ;
USE `ff_bruno` ;

-- -----------------------------------------------------
-- Table `ff_bruno`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`users` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`users` (
  `id` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Cada usuário que se cadastrar, tanto o usuário administrador quanto o usuário que vai reservar o ingresso, vai possuir um id que vai ser gerado automaticamento pelo banco de dados.',
  `username` VARCHAR(20) NOT NULL COMMENT 'Onde será armazenado o nome do usuário, que deverá ser único para cada pessoa registrada. ',
  `password` CHAR(32) NOT NULL COMMENT 'Senha escolhida pelo usuário.',
  `permission` TINYINT(1) UNSIGNED NOT NULL COMMENT 'Permissão que diferenciará se é um usuário cliente que vai reservar o(s) ingressos ou um usuário administrador. Usuário administrador receberá a permissão \"0\" e o usuário cliente a permissão \"1\".',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Tabela onde será armazenado todos os usuários do sistema, tanto usuário que irá se registrar apenas para reservar seu ingresso, mas como também usuário administrador. Essa diferenciação de usuário será feita com a permissão.';


-- -----------------------------------------------------
-- Table `ff_bruno`.`clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`clients` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`clients` (
  `id` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Será gerado um ID para cada cliente que se registrar através do formulário de cadastro.',
  `users_id` INT(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Registro de ID gerado na tabela \"users\".',
  `name` VARCHAR(45) NOT NULL COMMENT 'Nome completo do cliente.',
  `birthdate` DATE NOT NULL COMMENT 'Dia, mês e ano em que o cliente nasceu.',
  `email` VARCHAR(70) NOT NULL COMMENT 'E-mail do cliente para que se caso seja necessário o contato ser feito.',
  `phone` BIGINT(15) UNSIGNED NOT NULL COMMENT 'Número do telefone do cliente, para que caso seja necessário o contato possa ser feito.',
  PRIMARY KEY (`id`),
  INDEX `fk_clients_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_clients_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `ff_bruno`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Essa tabela ficará armazenado todos  os clientes que se registrarem no formulário de cadastro.';


-- -----------------------------------------------------
-- Table `ff_bruno`.`features`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`features` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`features` (
  `id` TINYINT(2) ZEROFILL UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Cada atração registrada receberá um id único, também se auto incrementando.',
  `name` VARCHAR(45) NOT NULL COMMENT 'Nome completo do artista/banda que vai se apresentar.',
  `description` TEXT NOT NULL COMMENT 'Aqui será armazenada uma descrição da atração, contando um pouco sobre sua história.',
  `image_url` VARCHAR(255) NOT NULL COMMENT 'Onde será armazenada a URL para que a imagem da atração possa ser exibida no site.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Onde será armazenado todas as atrações do festival.';


-- -----------------------------------------------------
-- Table `ff_bruno`.`dates`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`dates` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`dates` (
  `id` TINYINT(1) ZEROFILL UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Um id será gerado para registrar os dias em que acontecerão o evento.',
  `date` DATE NOT NULL COMMENT 'Data correspondente aos dias em que o evento ocorrerá.',
  `description` TEXT NULL COMMENT 'Descrição de cada dia em que uma data foi registrada.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Tabela onde será armazenado todos os registros de datas do festival. ';


-- -----------------------------------------------------
-- Table `ff_bruno`.`schedules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`schedules` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`schedules` (
  `dates_id` TINYINT(1) ZEROFILL UNSIGNED NOT NULL COMMENT 'Data correspondente para as atrações que acontecerão.',
  `features_id` TINYINT(2) ZEROFILL UNSIGNED NOT NULL COMMENT 'ID da atração que se apresentará no dia registrado.',
  `start_time` TIME NOT NULL COMMENT 'Horário de inicio que cada atração vai se apresentar.',
  INDEX `fk_schedules_dates1_idx` (`dates_id` ASC),
  PRIMARY KEY (`dates_id`, `features_id`),
  INDEX `fk_schedules_features1_idx` (`features_id` ASC),
  CONSTRAINT `fk_schedules_dates1`
    FOREIGN KEY (`dates_id`)
    REFERENCES `ff_bruno`.`dates` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_schedules_features1`
    FOREIGN KEY (`features_id`)
    REFERENCES `ff_bruno`.`features` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Onde será armazenada toda a programação do fesival.';


-- -----------------------------------------------------
-- Table `ff_bruno`.`availabletickets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`availabletickets` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`availabletickets` (
  `id` TINYINT(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Será gerado um ID que corresponde para cada ingresso disponível.',
  `dates_id` TINYINT(1) UNSIGNED NOT NULL COMMENT 'ID da data em que o ingresso disponível estará vinculado.',
  `normal_quantity` INT(6) UNSIGNED NOT NULL COMMENT 'Quantidade de ingressos normais que serão disponibilizados para a reserva.',
  `normal_value` DECIMAL(5,2) UNSIGNED NOT NULL COMMENT 'Preço de cada ingresso normal disponível para a reserva.',
  `vip_quantity` INT(6) NOT NULL COMMENT 'Quantidade de ingressos VIP`s que serão disponibilizados para a reserva.',
  `vip_value` DECIMAL(6,2) NOT NULL COMMENT 'Preço de cada ingresso VIP disponível para a reserva.',
  PRIMARY KEY (`id`, `dates_id`),
  INDEX `fk_availabletickets_dates1_idx` (`dates_id` ASC),
  CONSTRAINT `fk_availabletickets_dates1`
    FOREIGN KEY (`dates_id`)
    REFERENCES `ff_bruno`.`dates` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Onde ficará  o registro de todos os ingressos disponíveis para a reserva.';


-- -----------------------------------------------------
-- Table `ff_bruno`.`bookings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`bookings` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`bookings` (
  `id` INT(6) ZEROFILL UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Será gerado um ID para cada ingresso reservado.',
  `availabletickets_id` TINYINT(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Registro de id gerado através da tabela \"availabletickets\", cada vez que uma pessoa reservar um ingresso o registro vem para essa tabela.',
  `clients_id` INT(6) UNSIGNED ZEROFILL NULL COMMENT 'ID do cliente que reservou o ingresso.',
  `normal_quantity` TINYINT(1) UNSIGNED NOT NULL COMMENT 'Quantidade de ingressos normais reservados.',
  `vip_quantity` TINYINT(1) UNSIGNED NOT NULL COMMENT 'Quantidade de ingressos vips reservados.',
  `status` TINYINT(1) NOT NULL COMMENT 'Poderá ser armazenado 4 tipos diferentes de status para os ingressos reservados: Pendente, confirmados, canceladas e declinadas (respectivamente 0, 1, 2 ,3).',
  PRIMARY KEY (`id`),
  INDEX `fk_bookings_clients1_idx` (`clients_id` ASC),
  INDEX `fk_bookings_availabletickets1_idx` (`availabletickets_id` ASC),
  CONSTRAINT `fk_bookings_clients1`
    FOREIGN KEY (`clients_id`)
    REFERENCES `ff_bruno`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bookings_availabletickets1`
    FOREIGN KEY (`availabletickets_id`)
    REFERENCES `ff_bruno`.`availabletickets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Registro de todas as reservas feitas pelo  usuário cliente.';


-- -----------------------------------------------------
-- Table `ff_bruno`.`suspendedbookings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ff_bruno`.`suspendedbookings` ;

CREATE TABLE IF NOT EXISTS `ff_bruno`.`suspendedbookings` (
  `bookings_id` INT(6) ZEROFILL UNSIGNED NOT NULL COMMENT 'ID do ingresso reservado ou declinado da tabela \"bookings\".',
  `reason` CHAR(2) NOT NULL COMMENT 'Aqui ficará o motivo pelo qual o ingresso foi suspenso. O motivo será composto por duas letras.',
  `comment` TEXT NULL COMMENT 'Comentário que o administrador ou o cliente poderá fazer sobre a reserva que foi declinada ou cancelada. Esse campo é opcional e tanto o administrador quanto o cliente poderá suspender a reserva.',
  INDEX `fk_suspendedbookings_bookings1_idx` (`bookings_id` ASC),
  PRIMARY KEY (`bookings_id`),
  CONSTRAINT `fk_suspendedbookings_bookings1`
    FOREIGN KEY (`bookings_id`)
    REFERENCES `ff_bruno`.`bookings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'O registro de ingressos reservados que forem declinados ou cancelados serão exibidos nessa tabela.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;