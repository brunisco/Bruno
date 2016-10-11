-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09-Out-2016 às 22:18
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ff_bruno`
--
CREATE DATABASE IF NOT EXISTS `ff_bruno` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ff_bruno`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `availabletickets`
--

CREATE TABLE `availabletickets` (
  `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Será gerado um ID que corresponde para cada ingresso disponível.',
  `dates_id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'ID da data em que o ingresso disponível estará vinculado.',
  `normal_quantity` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Quantidade de ingressos normais que serão disponibilizados para a reserva.',
  `normal_value` decimal(5,2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Preço de cada ingresso normal disponível para a reserva.',
  `vip_quantity` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Quantidade de ingressos VIP`s que serão disponibilizados para a reserva.',
  `vip_value` decimal(6,2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Preço de cada ingresso VIP disponível para a reserva.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Onde ficará  o registro de todos os ingressos disponíveis para a reserva.';

--
-- Extraindo dados da tabela `availabletickets`
--

INSERT INTO `availabletickets` (`id`, `dates_id`, `normal_quantity`, `normal_value`, `vip_quantity`, `vip_value`) VALUES
(1, 8, 000010, '010.00', 000010, '0010.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bookings`
--

CREATE TABLE `bookings` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Será gerado um ID para cada ingresso reservado.',
  `availabletickets_id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Registro de id gerado através da tabela "availabletickets", cada vez que uma pessoa reservar um ingresso o registro vem para essa tabela.',
  `clients_id` int(6) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'ID do cliente que reservou o ingresso.',
  `normal_quantity` tinyint(1) UNSIGNED NOT NULL COMMENT 'Quantidade de ingressos normais reservados.',
  `vip_quantity` tinyint(1) UNSIGNED NOT NULL COMMENT 'Quantidade de ingressos vips reservados.',
  `status` tinyint(1) NOT NULL COMMENT 'Poderá ser armazenado 4 tipos diferentes de status para os ingressos reservados: Pendente, confirmados, canceladas e declinadas (respectivamente 0, 1, 2 ,3).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de todas as reservas feitas pelo  usuário cliente.';

--
-- Extraindo dados da tabela `bookings`
--

INSERT INTO `bookings` (`id`, `availabletickets_id`, `clients_id`, `normal_quantity`, `vip_quantity`, `status`) VALUES
(000001, 1, 000005, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Será gerado um ID para cada cliente que se registrar através do formulário de cadastro.',
  `users_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Registro de ID gerado na tabela "users".',
  `name` varchar(45) NOT NULL COMMENT 'Nome completo do cliente.',
  `birthdate` date NOT NULL COMMENT 'Dia, mês e ano em que o cliente nasceu.',
  `email` varchar(70) NOT NULL COMMENT 'E-mail do cliente para que se caso seja necessário o contato ser feito.',
  `phone` bigint(15) UNSIGNED NOT NULL COMMENT 'Número do telefone do cliente, para que caso seja necessário o contato possa ser feito.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Essa tabela ficará armazenado todos  os clientes que se registrarem no formulário de cadastro.';

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`id`, `users_id`, `name`, `birthdate`, `email`, `phone`) VALUES
(000004, 000008, 'Eu sou o cliente 1', '2014-10-12', 'cliente1@cliente1', 47974151425),
(000005, 000009, 'Eu sou o cliente', '2014-10-12', 'cliente@cliente', 4710121545),
(000006, 000010, 'Eu sou o cliente 2', '2014-10-14', 'cliente@2', 4775845444);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dates`
--

CREATE TABLE `dates` (
  `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Um id será gerado para registrar os dias em que acontecerão o evento.',
  `date` date NOT NULL COMMENT 'Data correspondente aos dias em que o evento ocorrerá.',
  `description` text COMMENT 'Descrição de cada dia em que uma data foi registrada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela onde será armazenado todos os registros de datas do festival. ';

--
-- Extraindo dados da tabela `dates`
--

INSERT INTO `dates` (`id`, `date`, `description`) VALUES
(5, '2017-01-06', 'Primeiro dia do festival.'),
(6, '2017-01-07', 'Segundo dia do festival.'),
(7, '2017-01-08', 'Terceiro dia do festival.'),
(8, '2016-10-07', 'Teste.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `features`
--

CREATE TABLE `features` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Cada atração registrada receberá um id único, também se auto incrementando.',
  `name` varchar(45) NOT NULL COMMENT 'Nome completo do artista/banda que vai se apresentar.',
  `description` text NOT NULL COMMENT 'Aqui será armazenada uma descrição da atração, contando um pouco sobre sua história.',
  `image_url` varchar(255) NOT NULL COMMENT 'Onde será armazenada a URL para que a imagem da atração possa ser exibida no site.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Onde será armazenado todas as atrações do festival.';

--
-- Extraindo dados da tabela `features`
--

INSERT INTO `features` (`id`, `name`, `description`, `image_url`) VALUES
(01, 'Charli XCX', 'Charlotte Emma Aitchison, mais conhecida como Charli XCX. É uma cantora e compositora nascida na Inglaterra. Seu primeiro álbum foi aos 14 anos de idade.', 'http://mixfm.com.br/wp-content/uploads/2015/01/charli-xcx.jpg'),
(02, 'Lorde', 'Ella Marija Lani Yelich-O’ Connor, mais conhecida como Lorde. É uma cantora e compositora neozelandesa. Tornou-se conhecida a partir do seu single “Royals” que lhe rendeu o título de a mais jovem artista a conquistar o primeiro lugar na Billboard Hot 100, e venceu o grammy awards de “ Canção do ano”, em 2014.', 'http://www.fashiongonerogue.com/wp-content/uploads/2014/04/lorde-chris-nicholls-photos2.jpg'),
(03, 'Rihanna', 'Rihanna é uma cantora , atriz, modelo e compositora de Barbados. Seu primeiro álbum de estúdio chamado “Music of The Sun”. Seu último álbum lançado chamado de “ANTI” foi em janeiro deste ano.', 'http://dioguinho.pt/wp-content/uploads/2015/07/o-RIHANNA-DIOR-facebook.jpg'),
(04, 'Anitta', 'Larissa de Macedo Machado, mais conhecida pelo nome artístico Anitta é uma cantora, dançarina e compositora brasileira de musica pop e funk. Seu primeiro álbum de estúdio foi “Anitta”', 'http://registropop.com/wp-content/uploads/2015/08/2984035-anitta-31.jpg'),
(05, 'Flora Matos', 'Flora Matos é uma cantora de rap brasileira . Ela lançou em 2009 seu primeiro álbum chamado Flora Matos vs Stereodubs. Entre suas influencias estão Racionais MC`s, Dina Di, Sabotage, Kamau,MC Marechal, entre outras.', 'http://entretodasascoisas.com.br/wp-content/uploads/2015/03/FLORAMATOS_PAULOPEIXOTO.jpg'),
(06, 'Karol Conka', 'É uma rapper, cantor e compositora brasileira nascida em Curitiba, Paraná. Seu primeiro álbum “Batuk Freak” foi lançado em 2013.  Já fez parcerias musicais Boss In Drama e Tropkillaz.', 'http://imirante.com/oestadoma/imagens/2016/01/08/1452249154-1025256501.jpg'),
(07, 'Maroon 5', 'Marron 5 é uma banda Americana de pop rock que se originou na california. Os integrantes das bandas são Adam Levine,  Jesse Carmichael , Mickey Madden, Matt Flynn, PJ Morton. Em agosto de 2011 a banda participou do Rock In Rio.', 'http://www.midiorama.com/wp-content/uploads/2015/09/Maroon-5-Destaque-3.jpg'),
(08, 'Foo Fighters', 'Foo Fighters é uma banda de rock dos estados unidos. Os integrantes da banda são Dave Grohl e Pat Smear em 1995.', 'https://upload.wikimedia.org/wikipedia/commons/a/aa/Foo_Fighters_Live_29.jpg'),
(09, 'Nickelback', 'É uma banda de rock do Canadá formada em 1995 por Chad Kroeger. Mike Kroeger, Ryan Peake e Brandon Kroeger. Nickelback é um dos mais bem sucedidos grupos canadenses e já venderam mais de 50 milhões de albuns ao redor do mundo.', 'http://dammit.com.br/wp-content/uploads/2014/08/NickelbackNEW_LR.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `schedules`
--

CREATE TABLE `schedules` (
  `dates_id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Data correspondente para as atrações que acontecerão.',
  `features_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'ID da atração que se apresentará no dia registrado.',
  `start_time` time NOT NULL COMMENT 'Horário de inicio que cada atração vai se apresentar.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Onde será armazenada toda a programação do fesival.';

--
-- Extraindo dados da tabela `schedules`
--

INSERT INTO `schedules` (`dates_id`, `features_id`, `start_time`) VALUES
(5, 01, '15:00:00'),
(5, 02, '16:30:00'),
(5, 03, '17:30:00'),
(6, 04, '15:00:00'),
(6, 05, '16:30:00'),
(6, 06, '17:30:00'),
(7, 07, '15:00:00'),
(7, 08, '16:30:00'),
(7, 09, '17:30:00'),
(8, 01, '00:12:00'),
(8, 02, '13:00:00'),
(8, 03, '15:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `suspendedbookings`
--

CREATE TABLE `suspendedbookings` (
  `bookings_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'ID do ingresso reservado ou declinado da tabela "bookings".',
  `reason` char(2) NOT NULL COMMENT 'Aqui ficará o motivo pelo qual o ingresso foi suspenso. O motivo será composto por duas letras.',
  `comment` text COMMENT 'Comentário que o administrador ou o cliente poderá fazer sobre a reserva que foi declinada ou cancelada. Esse campo é opcional e tanto o administrador quanto o cliente poderá suspender a reserva.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='O registro de ingressos reservados que forem declinados ou cancelados serão exibidos nessa tabela.';

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Cada usuário que se cadastrar, tanto o usuário administrador quanto o usuário que vai reservar o ingresso, vai possuir um id que vai ser gerado automaticamento pelo banco de dados.',
  `username` varchar(20) NOT NULL COMMENT 'Onde será armazenado o nome do usuário, que deverá ser único para cada pessoa registrada. ',
  `password` char(32) NOT NULL COMMENT 'Senha escolhida pelo usuário.',
  `permission` tinyint(1) UNSIGNED NOT NULL COMMENT 'Permissão que diferenciará se é um usuário cliente que vai reservar o(s) ingressos ou um usuário administrador. Usuário administrador receberá a permissão "0" e o usuário cliente a permissão "1".'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela onde será armazenado todos os usuários do sistema, tanto usuário que irá se registrar apenas para reservar seu ingresso, mas como também usuário administrador. Essa diferenciação de usuário será feita com a permissão.';

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permission`) VALUES
(000004, 'adm', 'adm', 0),
(000005, 'adm2', '123', 0),
(000006, 'adm3', '123', 0),
(000007, 'adm4', '123', 0),
(000008, 'cliente1', 'cliente1', 1),
(000009, 'cliente', 'cliente', 1),
(000010, 'cliente2', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availabletickets`
--
ALTER TABLE `availabletickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_availabletickets_dates1_idx` (`dates_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bookings_clients1_idx` (`clients_id`),
  ADD KEY `fk_bookings_availabletickets1_idx` (`availabletickets_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clients_users_idx` (`users_id`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`dates_id`,`features_id`),
  ADD KEY `fk_schedules_dates1_idx` (`dates_id`),
  ADD KEY `fk_schedules_features1_idx` (`features_id`);

--
-- Indexes for table `suspendedbookings`
--
ALTER TABLE `suspendedbookings`
  ADD PRIMARY KEY (`bookings_id`),
  ADD KEY `fk_suspendedbookings_bookings1_idx` (`bookings_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availabletickets`
--
ALTER TABLE `availabletickets`
  MODIFY `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Será gerado um ID que corresponde para cada ingresso disponível.', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Será gerado um ID para cada ingresso reservado.', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Será gerado um ID para cada cliente que se registrar através do formulário de cadastro.', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Um id será gerado para registrar os dias em que acontecerão o evento.', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Cada atração registrada receberá um id único, também se auto incrementando.', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Cada usuário que se cadastrar, tanto o usuário administrador quanto o usuário que vai reservar o ingresso, vai possuir um id que vai ser gerado automaticamento pelo banco de dados.', AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `availabletickets`
--
ALTER TABLE `availabletickets`
  ADD CONSTRAINT `fk_availabletickets_dates1` FOREIGN KEY (`dates_id`) REFERENCES `dates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_availabletickets1` FOREIGN KEY (`availabletickets_id`) REFERENCES `availabletickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bookings_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clients_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_schedules_dates1` FOREIGN KEY (`dates_id`) REFERENCES `dates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_schedules_features1` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `suspendedbookings`
--
ALTER TABLE `suspendedbookings`
  ADD CONSTRAINT `fk_suspendedbookings_bookings1` FOREIGN KEY (`bookings_id`) REFERENCES `bookings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
