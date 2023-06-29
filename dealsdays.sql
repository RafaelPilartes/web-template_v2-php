-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jun-2023 às 00:13
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dealsdays`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_user`
--

CREATE TABLE `adm_user` (
  `id` int(11) NOT NULL,
  `image_adm` varchar(500) NOT NULL,
  `full_name_adm` varchar(255) NOT NULL,
  `email_address_adm` varchar(255) NOT NULL,
  `number_phone_adm` varchar(355) NOT NULL,
  `permissions_adm` varchar(255) NOT NULL,
  `login_password_adm` varchar(255) NOT NULL,
  `date_create_adm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adm_user`
--

INSERT INTO `adm_user` (`id`, `image_adm`, `full_name_adm`, `email_address_adm`, `number_phone_adm`, `permissions_adm`, `login_password_adm`, `date_create_adm`) VALUES
(15, '[\"http:\\/\\/localhost:8000\\/_imagesDb\\/members\\/img_members-15-06-2023-23h-648b813853f59.png\"]', 'Rafael Pilartes', 'rafael@gmail.com', '923414621', 'all_permissions', '202cb962ac59075b964b07152d234b70', 'Quinta-Feira, 15 de Junho de 2023');

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `visibility_category` varchar(355) NOT NULL,
  `date_create` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `name_category`, `visibility_category`, `date_create`) VALUES
(1, 'Polícia ', 'Visible', 'Terca-Feira, 13 de Junho de 2023'),
(3, 'Reportagem', 'Visible', 'Terca-Feira, 13 de Junho de 2023');

-- --------------------------------------------------------

--
-- Estrutura da tabela `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int(11) NOT NULL,
  `id_product` varchar(220) NOT NULL,
  `name_characteristic` varchar(355) NOT NULL,
  `value_characteristic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `characteristics`
--

INSERT INTO `characteristics` (`id`, `id_product`, `name_characteristic`, `value_characteristic`) VALUES
(27, '9', 'Size', 'XS / S / M / L / X'),
(36, '9', 'Value', '1-43-209'),
(37, '9', 'Size 2', 'XS / S'),
(39, '11', 'Size 2', 'XS / S '),
(40, '12', 'Value', '2-44-202'),
(41, '13', 'Size', 'XS / S / M / L / X'),
(42, '13', 'Size 2', '1-43-209'),
(43, '14', 'Value', '2-44-202'),
(44, '15', 'Processamento ', '3mh'),
(45, '15', 'Core', '7ª');

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `image_customer` varchar(255) NOT NULL,
  `name_customer` varchar(355) NOT NULL,
  `email_customer` varchar(355) NOT NULL,
  `phone_customer` varchar(220) NOT NULL,
  `login_password_customer` varchar(500) NOT NULL,
  `date_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customer`
--

INSERT INTO `customer` (`id`, `image_customer`, `name_customer`, `email_customer`, `phone_customer`, `login_password_customer`, `date_create`) VALUES
(5, '', 'Rafael', 'rafaelpilartes.rpls@gmail.com', 'rafaelpilartes.rpls@gmail.com', '202cb962ac59075b964b07152d234b70', 'Segunda-Feira, 26 de Junho de 2023');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `id_customer` varchar(255) NOT NULL,
  `date_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `favorites`
--

INSERT INTO `favorites` (`id`, `id_product`, `id_customer`, `date_create`) VALUES
(1, '9', 'rafaelpilartes.rpls@gmail.com', 'Segunda-Feira, 26 de Junho de 2023'),
(2, '14', 'rafaelpilartes.rpls@gmail.com', 'Segunda-Feira, 26 de Junho de 2023'),
(3, '14', 'rafaelpilartes.rpls@gmail.com', 'Segunda-Feira, 26 de Junho de 2023'),
(4, '14', 'rafaelpilartes.rpls@gmail.com', 'Segunda-Feira, 26 de Junho de 2023');

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `phone_user` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `number_order` varchar(255) NOT NULL,
  `customer_order` varchar(255) NOT NULL,
  `items_order` varchar(12460) NOT NULL,
  `total_order` varchar(255) NOT NULL,
  `paid_order` varchar(255) NOT NULL,
  `state_order` varchar(255) NOT NULL,
  `date_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `images_product` varchar(500) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `description_product` varchar(355) NOT NULL,
  `category_product` varchar(500) NOT NULL,
  `old_price_product` varchar(255) NOT NULL,
  `new_price_product` varchar(255) NOT NULL,
  `stock_product` varchar(200) NOT NULL,
  `product_store` varchar(14) NOT NULL,
  `link_product` varchar(200) NOT NULL,
  `is_best_sellers` varchar(200) NOT NULL,
  `is_new_arrivals` varchar(200) NOT NULL,
  `is_top_rated` varchar(200) NOT NULL,
  `views_product` int(255) NOT NULL,
  `date_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`id`, `images_product`, `name_product`, `description_product`, `category_product`, `old_price_product`, `new_price_product`, `stock_product`, `product_store`, `link_product`, `is_best_sellers`, `is_new_arrivals`, `is_top_rated`, `views_product`, `date_create`) VALUES
(15, '[\"http:\\/\\/localhost:8000\\/_imagesDb\\/products\\/img_products-26-06-2023-17h-6499aeef68493.jpg\",\"http:\\/\\/localhost:8000\\/_imagesDb\\/products\\/img_products-26-06-2023-17h-6499aeef68e30.jpg\",\"http:\\/\\/localhost:8000\\/_imagesDb\\/products\\/img_products-26-06-2023-17h-6499aeef6953d.jpg\"]', 'Pc gamer v1', 'ertgyuhijtger\r\ngtrgtrshtrhtrh\r\nhrth', 'Polícia ', '2000', '1500', 'In Stock', 'no', 'https://www.youtube.com/', 'yes', 'yes', 'yes', 2, 'Segunda-Feira, 26 de Junho de 2023');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm_user`
--
ALTER TABLE `adm_user`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm_user`
--
ALTER TABLE `adm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `characteristics`
--
ALTER TABLE `characteristics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
