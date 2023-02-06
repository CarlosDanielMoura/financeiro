-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Jan-2023 às 19:54
-- Versão do servidor: 10.5.13-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u738001615_vazante`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancarias`
--

CREATE TABLE `bancarias` (
  `id` int(11) NOT NULL,
  `banco` varchar(25) NOT NULL,
  `agencia` varchar(20) NOT NULL,
  `conta` varchar(20) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `pessoa` varchar(15) NOT NULL,
  `doc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bancarias`
--

INSERT INTO `bancarias` (`id`, `banco`, `agencia`, `conta`, `tipo`, `pessoa`, `doc`) VALUES
(3, 'Banco do Brasil', '4545-7', '48789-10', 'Corrente', 'Física', '33.333.333/3333-33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bancos`
--

INSERT INTO `bancos` (`id`, `nome`) VALUES
(2, 'Bradesco'),
(3, 'Santander'),
(4, 'Caixa Econômica'),
(5, 'Sicoob'),
(6, 'Itaú'),
(7, 'Banco do Brasil'),
(12, 'Pix');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `id` int(11) NOT NULL,
  `data_ab` date NOT NULL,
  `valor_ab` decimal(8,2) DEFAULT NULL,
  `usuario_ab` int(11) NOT NULL,
  `data_fec` date DEFAULT NULL,
  `valor_fec` decimal(8,2) DEFAULT NULL,
  `saldo` decimal(8,2) DEFAULT NULL,
  `usuario_fec` int(11) DEFAULT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`id`, `data_ab`, `valor_ab`, `usuario_ab`, `data_fec`, `valor_fec`, `saldo`, `usuario_fec`, `status`) VALUES
(4, '2021-12-01', '1000.00', 7, NULL, NULL, NULL, NULL, 'Aberto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cat_despesas`
--

CREATE TABLE `cat_despesas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cat_despesas`
--

INSERT INTO `cat_despesas` (`id`, `nome`) VALUES
(11, 'Empresa'),
(14, 'Residência');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cat_produtos`
--

CREATE TABLE `cat_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cat_produtos`
--

INSERT INTO `cat_produtos` (`id`, `nome`) VALUES
(6, 'Chilli beans'),
(7, 'RAY BAN'),
(8, 'Periféricos'),
(9, 'LOVE MOSCHINO'),
(10, 'JULIAN FAIET'),
(11, 'DACCS '),
(12, 'MORENA ROSA '),
(13, 'MARIA VALENTINA '),
(14, 'GUESS'),
(15, 'PROMOÇAO'),
(16, 'LAB.'),
(17, 'VIZZANO'),
(18, 'MARRY MARRY'),
(19, 'GRAZI '),
(20, 'VOGUE'),
(21, 'TECNOL'),
(22, 'EVOKE'),
(23, 'TOMMY HILFIGER'),
(24, 'ANA HICKMANN'),
(25, 'MARESIA'),
(26, 'SMART '),
(27, 'JEAN MONNIER'),
(28, 'VERSATTE'),
(29, 'SCUDO'),
(30, 'PRADO'),
(31, 'VIP'),
(32, 'PARAFUSADO'),
(33, 'KIPLING'),
(34, 'SILMO KIDS'),
(35, 'OCULOS INFANTIL'),
(36, 'CARRERA'),
(37, 'HAVAIANAS'),
(38, 'LENTE ESFERICA -2,50'),
(39, 'SOLUÇAO'),
(40, 'ARNETTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pessoa` varchar(15) NOT NULL,
  `doc` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `obs` varchar(150) DEFAULT NULL,
  `data` date NOT NULL,
  `banco` varchar(40) DEFAULT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `conta` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `pessoa`, `doc`, `telefone`, `endereco`, `ativo`, `obs`, `data`, `banco`, `agencia`, `conta`, `email`) VALUES
(1, 'Sistema', 'Física', '000.000.000-00', '(00) 00000-0000', '', 'Sim', 'Esse cliente é exclusivo da loja para que não precisa sempre cadastrar clientes!', '2022-08-09', '', '', '', 'cliente@cliente.com'),
(22, 'FRANCISCA ', 'Física', '018.137.232-06', '(34) 99228-6149', 'AV MUNICIPAL 51 AP 2020', 'Sim', '', '2022-08-02', '', '', '', ''),
(28, 'CARLOS DANIEL', 'Física', '129.330.726-29', '(34) 99981-9351', 'RUA ABILIO CALIXTO 184, SANTA MARIA ', 'Sim', 'VIADO', '2022-09-01', '', '', '', ''),
(31, 'JOSÉ SARAIVA DOS SANTOS', 'Física', '', '(34) 99672-6836', '', 'Sim', '', '2022-10-07', '', '', '', ''),
(32, 'VITORYA RAPHAELA CAETANO', 'Física', '', '(34) 99864-0076', '', 'Sim', '', '2022-10-07', '', '', '', ''),
(33, 'MARIA GABRIELA', 'Física', '', '(34) 99861-9893', '', 'Sim', '', '2022-10-07', '', '', '', ''),
(34, 'GEANNE VITÓRIA DOS SANTOS', 'Física', '', '(34) 99912-5473', '', 'Sim', '', '2022-10-07', '', '', '', ''),
(35, 'CLAYTON SANTOS SILVA', 'Física', '', '(34) 99632-1346', '', 'Sim', '', '2022-10-07', '', '', '', ''),
(36, 'ARTHUR CORREIA DE OLIVEIRA', 'Física', '', '(34) 99919-3621', '', 'Sim', '', '2022-10-07', '', '', '', ''),
(37, 'NATÁLIA', 'Física', '', '(', '', 'Sim', '', '2022-10-13', '', '', '', ''),
(38, 'VALMIR GOMES DE MOURA', 'Física', '', '(79) 98803-8488', '', 'Sim', '', '2022-10-14', '', '', '', ''),
(39, 'MANOEL ANTÔNIO ARAÚJO', 'Física', '', '(34) 99898-2175', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(40, 'REBECA SARAY DOS SANTOS', 'Física', '', '(34) 99122-2070', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(41, 'JOÃO HENRIQUE COSTA', 'Física', '', '(34) 99641-7029', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(42, 'ALCI RIBEIRO JUNIOR', 'Física', '', '(34) 99122-2070', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(43, 'DIVINA FERNANDES DA SILVA', 'Física', '', '(34) 99661-9850', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(44, 'SINTIKE FERNANDES SANTOS', 'Física', '', '(34) 99336-8176', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(45, 'JÚLIA R. TAVARES', 'Física', '', '(34) 99231-6515', '', 'Sim', '', '2022-10-21', '', '', '', ''),
(46, 'JOANA D\'ARC TABOSA MENDES', 'Física', '', '(34) 99122-2070', '', 'Sim', '', '2022-10-28', '', '', '', ''),
(47, 'HELI RODRIGUES FRAGAS', 'Física', '', '(34) 99943-7002', 'VAZANTE ', 'Sim', '', '2022-11-04', '', '', '', ''),
(48, 'ISAURA SILVA DA CONCEICAO ', 'Física', '', '(34) 99815-9887', 'VAZANTE ', 'Sim', '', '2022-11-04', '', '', '', ''),
(49, 'ALEX RODRIGUES RIBEIRO', 'Física', '', '(62) 99941-9155', '', 'Sim', '', '2022-11-04', '', '', '', ''),
(50, 'HEITOR LORENZO BORGES', 'Física', '', '(34) 99241-8200', '', 'Sim', '', '2022-11-04', '', '', '', ''),
(51, 'PEDRO EMANUEL P SANTOS', 'Física', '', '(34) 99852-1405', '', 'Sim', '', '2022-11-11', '', '', '', ''),
(52, 'ALEXANDRE  R  VENANCIO', 'Física', '', '(62) 96117-458', '', 'Sim', '', '2022-11-11', '', '', '', ''),
(53, 'MARCILENE DA SILVA', 'Física', '', '(34) 99795-3673', '', 'Sim', '', '2022-11-11', '', '', '', ''),
(54, 'MARIA DAS GRAÇAS BATISTA', 'Física', '', '(34) 99948-0869', '', 'Sim', '', '2022-11-11', '', '', '', ''),
(55, 'MARIA APARECIDA SILVA', 'Física', '', '(34) 99113-3901', '', 'Sim', '', '2022-11-11', '', '', '', ''),
(56, 'JALILE MARIA DE LIMA', 'Física', '', '(34) 99914-1012', '', 'Sim', '', '2022-11-14', '', '', '', ''),
(57, 'NICOLLAS GABRIEL MEDEIROS', 'Física', '', '(34) 99889-0821', 'FAZENDA TABOAS', 'Sim', '', '2022-11-18', '', '', '', ''),
(58, 'GLEIBE DOS SANTOS MACIEL', 'Física', '', '(34) 99123-5888', '', 'Sim', '', '2022-11-18', '', '', '', ''),
(59, 'MARIA APARECIDA DA SILVA', 'Física', '', '(34) 99992-4016', '', 'Sim', '', '2022-11-18', '', '', '', ''),
(60, 'MARIA GLAUCIENE BATISTA DOS  SANTOS', 'Física', '', '(34) 99916-6443', '', 'Sim', '', '2022-11-18', '', '', '', ''),
(61, 'JESSICA ALMEIDA SANTOS', 'Física', '', '(34) 99779-3084', '', 'Sim', '', '2022-11-18', '', '', '', ''),
(62, 'OLIVEIRA  NUNES DA SILVA', 'Física', '', '(34) 99723-6341', '', 'Sim', '', '2022-11-25', '', '', '', ''),
(63, 'MARIA DOS R. CARLOS', 'Física', '', '(34) 99945-7208', '', 'Sim', '', '2022-11-25', '', '', '', ''),
(64, 'LILIA A DE ALMEIDA', 'Física', '', '(34) 99825-5110', '', 'Sim', '', '2022-11-25', '', '', '', ''),
(65, 'YURI CAIXETA SOARES', 'Física', '', '(34) 99685-7627', '', 'Sim', '', '2022-11-25', '', '', '', ''),
(66, 'MARIA DE LOURDES DOS SANTOS', 'Física', '', '(34) 99162-6812', '', 'Sim', '', '2022-11-25', '', '', '', ''),
(67, 'EUNICE P DE ANDRADE ', 'Física', '', '(34) 99919-0973', '', 'Sim', '', '2022-11-25', '', '', '', ''),
(68, 'NATHALIA CAROLINE', 'Física', '', '(34) 99952-6257', '', 'Sim', '', '2022-11-30', '', '', '', ''),
(69, 'SONIA ALVES CAIXETA DINIZ ', 'Física', '', '(34) 99661-3808', '', 'Sim', '', '2022-12-01', '', '', '', ''),
(70, 'FRANCIELE SANTUSI ', 'Física', '', '(34) 99195-8482', '', 'Sim', '', '2022-12-02', '', '', '', ''),
(71, 'KARINE DE OLIVEIRA COSTA', 'Física', '', '(34) 99765-1570', '', 'Sim', '', '2022-12-02', '', '', '', ''),
(72, 'POLLYANA DAMAS DOS REIS', 'Física', '', '(34) 99414-379', '', 'Sim', '', '2022-12-02', '', '', '', ''),
(73, 'NATALIA DAMAS DE  JESUS', 'Física', '', '(34) 99893-7717', '', 'Sim', '', '2022-12-02', '', '', '', ''),
(74, 'MAURICIO MENDES DA FONSECA', 'Física', '', '(34) 99551-312', '', 'Sim', '', '2022-12-02', '', '', '', ''),
(75, 'JULIA FRAGA BELEZE', 'Física', '', '(38) 00973-2209', '', 'Sim', '', '2022-12-05', '', '', '', ''),
(76, 'RODRIGO ALEX PEREIRA ', 'Física', '', '(34) 99679-9668', '', 'Sim', '', '2022-12-05', '', '', '', ''),
(77, 'THAIS MONIELLE ALVES', 'Física', '', '(34) 99834-8026', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(78, 'GILNEI ALVES DE MELO', 'Física', '', '(34) 99999-1649', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(79, 'MARA DOS PASSOS LANDIM', 'Física', '', '(34) 99666-4432', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(80, 'JANNIFFER M DE SOUZA', 'Física', '', '(34) 99639-7897', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(81, 'PAULIANA MACHADO', 'Física', '', '(34) 99665-4266', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(82, 'GERALDA CRUZEIRO DOS SANTOS', 'Física', '', '(34) 99672-3568', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(83, 'EDNA MARIA FERREIRA', 'Física', '', '(34) 99970-9933', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(84, 'ALESSANDRA DE F. CORREA', 'Física', '', '(34) 99921-1981', '', 'Sim', '', '2022-12-08', '', '', '', ''),
(85, 'MARIA CECILIA', 'Física', '', '(38) 99832-9565', '', 'Sim', '', '2022-12-09', '', '', '', ''),
(86, 'SANDRA GONÇALVES', 'Física', '', '(34) 99790-4789', '', 'Sim', '', '2022-12-13', '', '', '', ''),
(87, 'SCARLET  ALVES FROIS', 'Física', '', '(34) 98801-3012', '', 'Sim', '', '2022-12-13', '', '', '', ''),
(88, 'LUDENIA P LOPES', 'Física', '', '(34) 99818-8263', '', 'Sim', '', '2022-12-15', '', '', '', ''),
(89, 'ANTONIO LUIZ DOS SANTOS', 'Física', '', '(34) 99257-1947', '', 'Sim', '', '2022-12-15', '', '', '', ''),
(90, 'DIVINA R. PIMENTEL ', 'Física', '', '(34) 99663-6754', '', 'Sim', '', '2022-12-15', '', '', '', ''),
(91, 'IAGO JUNIOR VIDA', 'Física', '', '(34) 99243-5511', '', 'Sim', '', '2022-12-15', '', '', '', ''),
(92, 'ANGELITA APARECIDA DOS SANTOS', 'Física', '', '(34) 99969-7877', '', 'Sim', '', '2022-12-17', '', '', '', ''),
(93, 'VALDIVINO DE ARAUJO', 'Física', '', '(34) 99978-0192', '', 'Sim', '', '2022-12-19', '', '', '', ''),
(94, 'APARECIDA DE FATIMA ASSUNÇAO', 'Física', '', '(34) 99911-0206', '', 'Sim', '', '2022-12-19', '', '', '', ''),
(95, 'BRUNA', 'Física', '', '(34) 99325-3327', '', 'Sim', '', '2022-12-22', '', '', '', ''),
(96, 'CRISTINA VAZ  DE OLIVEIRA ', 'Física', '', '(34) 99802-7929', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(97, 'APARECIDA DE FATIMA ASSUNÇAO', 'Física', '', '(34) 99110-206', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(98, 'MICHELE DOS SANTOS ARAUJO', 'Física', '', '(34) 99886-9510', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(99, 'WILLIAN FERNANDES  DE SOUZA ', 'Física', '', '(34) 99928-4740', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(100, 'YASMIN APARECIDA G DE JESUS ', 'Física', '', '(34) 99962-0524', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(101, 'MARTA TEREZINHA RIBEIRO', 'Física', '', '(34) 99670-9898', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(102, 'EDGARD DOS REIS DA FONSECA', 'Física', '', '(34) 99963-0170', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(103, 'ANA DA CONSOLACAO FONSECA', 'Física', '', '(34) 99650-3690', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(104, 'MONIELLE SILVA FREITAS', 'Física', '', '(34) 99873-5303', '', 'Sim', '', '2022-12-23', '', '', '', ''),
(105, 'MARIA GABRIELLE PEREIRA ', 'Física', '', '(34) 99646-1451', '', 'Sim', '', '2022-12-29', '', '', '', ''),
(106, 'APARICIO DONATO ROSA', 'Física', '', '(34) 99662-0708', '', 'Sim', '', '2022-12-29', '', '', '', ''),
(107, 'GIOVANNA EDUARDA DE JESUS ', 'Física', '', '(34) 99988-5664', '', 'Sim', '', '2022-12-29', '', '', '', ''),
(108, 'GABRIEL P SOUZA', 'Física', '', '(34) 99685-6341', '', 'Sim', '', '2022-12-29', '', '', '', ''),
(109, 'ELENIR A PACHECO', 'Física', '', '(34) 99665-3495', '', 'Sim', '', '2022-12-29', '', '', '', ''),
(110, 'FRANCINE ', 'Física', '', '(34) 99898-0180', '', 'Sim', '', '2023-01-02', '', '', '', ''),
(111, 'EDUARDO ALVES MARTINS ', 'Física', '', '(34) 99937-5459', '', 'Sim', '', '2023-01-05', '', '', '', ''),
(112, 'ADAIR FERREIRA DA SILVA', 'Física', '', '(34) 99666-5027', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(113, 'MARIA ELOA OLIVEIRA ', 'Física', '', '(34) 99795-1059', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(114, 'JOSE DO CARMO ', 'Física', '', '(34) 99661-8743', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(115, 'CASSIA MARIA DE JESUS ', 'Física', '', '(34) 99691-7686', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(116, 'JOSE PIRES DE OLIVEIRA', 'Física', '', '(34) 99695-4439', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(117, 'JOSE FRANCISCO DE MORAIS', 'Física', '', '(34) 99967-1210', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(118, 'ERASMO C DA ROCHA ', 'Física', '', '(34) 99721-1012', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(119, 'LAIS MAGELA FERREIRA ', 'Física', '', '(34) 99660-2430', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(120, 'LUCIANO ALVES CORREA ', 'Física', '', '(34) 99660-2430', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(121, 'LAZARA  LUIZA DA SILVA', 'Física', '', '(34) 38130-396', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(122, 'FICTICIO', 'Física', '', '(34) 99149-3124', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(123, 'MAURA B OLIVEIRA', 'Física', '', '(34) 99678-5598', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(124, 'LETICIA CAMARGOS ', 'Física', '', '(94) 98107-5579', '', 'Sim', '', '2023-01-06', '', '', '', ''),
(125, 'EDUARDO ALVES MARTINS ', 'Física', '', '(34) 99937-5459', '', 'Sim', '', '2023-01-06', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cobrancas`
--

CREATE TABLE `cobrancas` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cobrancas`
--

INSERT INTO `cobrancas` (`id`, `data`, `quantidade`) VALUES
(1, '2022-09-09', 1),
(2, '2022-09-12', 0),
(3, '2022-09-14', 0),
(4, '2022-09-15', 0),
(5, '2022-09-16', 0),
(6, '2022-09-17', 0),
(7, '2022-09-18', 0),
(8, '2022-09-19', 0),
(9, '2022-09-20', 0),
(10, '2022-09-21', 0),
(11, '2022-09-22', 0),
(12, '2022-09-23', 0),
(13, '2022-09-24', 0),
(14, '2022-09-25', 0),
(15, '2022-09-26', 0),
(16, '2022-09-27', 0),
(17, '2022-09-28', 0),
(18, '2022-09-29', 0),
(19, '2022-09-30', 0),
(20, '2022-10-01', 0),
(21, '2022-10-02', 0),
(22, '2022-10-03', 0),
(23, '2022-10-04', 0),
(24, '2022-10-05', 0),
(25, '2022-10-06', 0),
(26, '2022-10-07', 0),
(27, '2022-10-08', 0),
(28, '2022-10-09', 0),
(29, '2022-10-10', 0),
(30, '2022-10-11', 0),
(31, '2022-10-12', 0),
(32, '2022-10-13', 0),
(33, '2022-10-14', 0),
(34, '2022-10-15', 0),
(35, '2022-10-16', 0),
(36, '2022-10-17', 0),
(37, '2022-10-18', 0),
(38, '2022-10-19', 0),
(39, '2022-10-20', 0),
(40, '2022-10-21', 0),
(41, '2022-10-22', 0),
(42, '2022-10-23', 0),
(43, '2022-10-24', 0),
(44, '2022-10-25', 0),
(45, '2022-10-26', 0),
(46, '2022-10-27', 0),
(47, '2022-10-28', 0),
(48, '2022-10-29', 0),
(49, '2022-10-30', 0),
(50, '2022-10-31', 0),
(51, '2022-11-01', 0),
(52, '2022-11-02', 0),
(53, '2022-11-03', 0),
(54, '2022-11-04', 0),
(55, '2022-11-05', 0),
(56, '2022-11-06', 0),
(57, '2022-11-07', 0),
(58, '2022-11-08', 0),
(59, '2022-11-09', 0),
(60, '2022-11-10', 0),
(61, '2022-11-11', 0),
(62, '2022-11-12', 0),
(63, '2022-11-13', 0),
(64, '2022-11-14', 0),
(65, '2022-11-15', 0),
(66, '2022-11-16', 0),
(67, '2022-11-17', 0),
(68, '2022-11-18', 0),
(69, '2022-11-19', 0),
(70, '2022-11-20', 0),
(71, '2022-11-21', 0),
(72, '2022-11-22', 0),
(73, '2022-11-23', 0),
(74, '2022-11-24', 0),
(75, '2022-11-25', 0),
(76, '2022-11-26', 0),
(77, '2022-11-27', 0),
(78, '2022-11-28', 0),
(79, '2022-11-29', 0),
(80, '2022-11-30', 0),
(81, '2022-12-01', 0),
(82, '2022-12-02', 1),
(83, '2022-12-03', 0),
(84, '2022-12-04', 0),
(85, '2022-12-05', 0),
(86, '2022-12-06', 0),
(87, '2022-12-07', 0),
(88, '2022-12-08', 0),
(89, '2022-12-09', 0),
(90, '2022-12-10', 0),
(91, '2022-12-11', 0),
(92, '2022-12-12', 0),
(93, '2022-12-13', 0),
(94, '2022-12-14', 0),
(95, '2022-12-15', 0),
(96, '2022-12-16', 0),
(97, '2022-12-17', 0),
(98, '2022-12-18', 0),
(99, '2022-12-19', 0),
(100, '2022-12-20', 0),
(101, '2022-12-21', 0),
(102, '2022-12-22', 0),
(103, '2022-12-23', 0),
(104, '2022-12-24', 0),
(105, '2022-12-25', 0),
(106, '2022-12-26', 0),
(107, '2022-12-27', 0),
(108, '2022-12-28', 0),
(109, '2022-12-29', 0),
(110, '2022-12-30', 0),
(111, '2022-12-31', 0),
(112, '2023-01-01', 0),
(113, '2023-01-02', 2),
(114, '2023-01-03', 0),
(115, '2023-01-04', 0),
(116, '2023-01-05', 0),
(117, '2023-01-06', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pagamento` varchar(50) NOT NULL,
  `lancamento` varchar(50) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_pgto` date NOT NULL,
  `parcelas` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_despesa`
--

CREATE TABLE `contas_despesa` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `lancamento` varchar(50) NOT NULL,
  `documento` varchar(35) DEFAULT NULL,
  `plano_conta` varchar(50) NOT NULL,
  `fornecedor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_pagar`
--

CREATE TABLE `contas_pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `cliente` int(11) NOT NULL,
  `saida` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `plano_conta` varchar(50) NOT NULL,
  `data_emissao` date NOT NULL,
  `vencimento` date NOT NULL,
  `frequencia` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_baixa` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `data_recor` date DEFAULT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `data_baixa` date DEFAULT NULL,
  `id_compra` int(11) NOT NULL,
  `arquivo` varchar(250) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_receber`
--

CREATE TABLE `contas_receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `cliente` int(11) NOT NULL,
  `entrada` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `plano_conta` varchar(50) NOT NULL,
  `data_emissao` date NOT NULL,
  `vencimento` date NOT NULL,
  `frequencia` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_baixa` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `data_recor` date DEFAULT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `data_baixa` date DEFAULT NULL,
  `id_venda` int(11) NOT NULL,
  `arquivo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contas_receber`
--

INSERT INTO `contas_receber` (`id`, `descricao`, `cliente`, `entrada`, `documento`, `plano_conta`, `data_emissao`, `vencimento`, `frequencia`, `valor`, `usuario_lanc`, `usuario_baixa`, `status`, `data_recor`, `juros`, `multa`, `desconto`, `subtotal`, `data_baixa`, `id_venda`, `arquivo`) VALUES
(1, 'Venda Via OS - ARTHUR CORREIA DE OLIVEIRA', 36, 'Caixa', 'Dinheiro', 'Venda', '2022-10-24', '2022-10-10', 'Uma Vez', '500.00', 30, NULL, 'Pendente', '2022-10-24', NULL, NULL, NULL, NULL, NULL, 8, NULL),
(2, 'Venda Via OS - REBECA SARAY DOS SANTOS', 40, 'Sicoob', 'Cheque', 'Venda', '2022-11-04', '2022-11-04', 'Uma Vez', '929.00', 30, 30, 'Paga', '2022-11-04', '0.00', '0.00', '0.00', '929.00', '2022-11-04', 12, ''),
(10, 'Parcela 1', 54, 'Caixa', 'Carnê', 'Venda', '2022-11-18', '2022-12-10', 'Uma Vez', '192.33', 30, 30, 'Paga', '2022-11-18', '0.00', '0.00', '0.00', '192.33', '2022-12-08', 19, 'sem-foto.jpg'),
(11, 'Parcela 2', 54, 'Caixa', 'Carnê', 'Venda', '2022-11-18', '2023-01-10', 'Uma Vez', '184.66', 30, 30, 'Pendente', '2022-11-18', '0.00', '0.00', '0.00', '7.67', '2022-12-08', 19, 'sem-foto.jpg'),
(12, 'Parcela 3', 54, 'Caixa', 'Carnê', 'Venda', '2022-11-18', '2023-02-10', 'Uma Vez', '192.33', 30, NULL, 'Pendente', '2022-11-18', NULL, NULL, NULL, NULL, NULL, 19, 'sem-foto.jpg'),
(13, 'Venda Via OS - ALEXANDRE  R  VENANCIO', 52, 'Caixa', 'Boleto', 'Venda', '2022-11-18', '2022-12-02', 'Uma Vez', '470.00', 30, NULL, 'Pendente', '2022-11-18', NULL, NULL, NULL, NULL, NULL, 20, NULL),
(21, 'Parcela 1', 63, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2022-12-02', 'Uma Vez', '220.00', 30, 30, 'Paga', '2022-12-02', '0.00', '0.00', '0.00', '220.00', '2023-01-03', 29, 'sem-foto.jpg'),
(22, 'Parcela 2', 63, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2023-01-02', 'Uma Vez', '220.00', 30, NULL, 'Pendente', '2022-12-02', NULL, NULL, NULL, NULL, NULL, 29, 'sem-foto.jpg'),
(23, 'Parcela 3', 63, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2023-02-02', 'Uma Vez', '220.00', 30, NULL, 'Pendente', '2022-12-02', NULL, NULL, NULL, NULL, NULL, 29, 'sem-foto.jpg'),
(38, 'Parcela 1', 64, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2023-01-02', 'Uma Vez', '169.75', 30, NULL, 'Pendente', '2022-12-02', NULL, NULL, NULL, NULL, NULL, 33, 'sem-foto.jpg'),
(39, 'Parcela 2', 64, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2023-02-02', 'Uma Vez', '169.75', 30, NULL, 'Pendente', '2022-12-02', NULL, NULL, NULL, NULL, NULL, 33, 'sem-foto.jpg'),
(40, 'Parcela 3', 64, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2023-03-02', 'Uma Vez', '169.75', 30, NULL, 'Pendente', '2022-12-02', NULL, NULL, NULL, NULL, NULL, 33, 'sem-foto.jpg'),
(41, 'Parcela 4', 64, 'Caixa', 'Carnê', 'Venda', '2022-12-02', '2023-04-02', 'Uma Vez', '169.75', 30, NULL, 'Pendente', '2022-12-02', NULL, NULL, NULL, NULL, NULL, 33, 'sem-foto.jpg'),
(78, 'Parcela 1', 62, 'Caixa', 'Carnê', 'Venda', '2022-12-08', '2023-01-08', 'Uma Vez', '100.00', 30, 30, 'Paga', '2022-12-08', '0.00', '0.00', '0.00', '100.00', '2023-01-06', 43, 'sem-foto.jpg'),
(79, 'Parcela 2', 62, 'Caixa', 'Carnê', 'Venda', '2022-12-08', '2023-02-08', 'Uma Vez', '100.00', 30, 30, 'Paga', '2022-12-08', '0.00', '0.00', '0.00', '100.00', '2023-01-06', 43, 'sem-foto.jpg'),
(80, 'Parcela 3', 62, 'Caixa', 'Carnê', 'Venda', '2022-12-08', '2023-03-08', 'Uma Vez', '100.00', 30, NULL, 'Pendente', '2022-12-08', NULL, NULL, NULL, NULL, NULL, 43, 'sem-foto.jpg'),
(81, 'Parcela 4', 62, 'Caixa', 'Carnê', 'Venda', '2022-12-08', '2023-04-08', 'Uma Vez', '100.00', 30, NULL, 'Pendente', '2022-12-08', NULL, NULL, NULL, NULL, NULL, 43, 'sem-foto.jpg'),
(82, 'Parcela 5', 62, 'Caixa', 'Carnê', 'Venda', '2022-12-08', '2023-05-08', 'Uma Vez', '100.00', 30, NULL, 'Pendente', '2022-12-08', NULL, NULL, NULL, NULL, NULL, 43, 'sem-foto.jpg'),
(87, 'Parcela 1', 66, 'Caixa', 'Carnê', 'Venda', '2022-12-09', '2023-01-09', 'Uma Vez', '250.00', 30, NULL, 'Pendente', '2022-12-09', NULL, NULL, NULL, NULL, NULL, 48, 'sem-foto.jpg'),
(88, 'Parcela 2', 66, 'Caixa', 'Carnê', 'Venda', '2022-12-09', '2023-02-09', 'Uma Vez', '250.00', 30, NULL, 'Pendente', '2022-12-09', NULL, NULL, NULL, NULL, NULL, 48, 'sem-foto.jpg'),
(103, 'Parcela 1', 83, 'Caixa', 'Carnê', 'Venda', '2022-12-16', '2023-01-16', 'Uma Vez', '236.00', 30, NULL, 'Pendente', '2022-12-16', NULL, NULL, NULL, NULL, NULL, 60, 'sem-foto.jpg'),
(104, 'Parcela 2', 83, 'Caixa', 'Carnê', 'Venda', '2022-12-16', '2023-01-16', 'Uma Vez', '236.00', 30, NULL, 'Pendente', '2022-12-16', NULL, NULL, NULL, NULL, NULL, 60, 'sem-foto.jpg'),
(105, 'Parcela 3', 83, 'Caixa', 'Carnê', 'Venda', '2022-12-16', '2023-02-16', 'Uma Vez', '236.00', 30, NULL, 'Pendente', '2022-12-16', NULL, NULL, NULL, NULL, NULL, 60, 'sem-foto.jpg'),
(106, 'Parcela 4', 83, 'Caixa', 'Carnê', 'Venda', '2022-12-16', '2023-03-16', 'Uma Vez', '236.00', 30, NULL, 'Pendente', '2022-12-16', NULL, NULL, NULL, NULL, NULL, 60, 'sem-foto.jpg'),
(125, 'Parcela 1', 92, 'Caixa', 'Carnê', 'Venda', '2023-01-06', '2023-02-06', 'Uma Vez', '247.50', 30, NULL, 'Pendente', '2023-01-06', NULL, NULL, NULL, NULL, NULL, 82, 'sem-foto.jpg'),
(126, 'Parcela 2', 92, 'Caixa', 'Carnê', 'Venda', '2023-01-06', '2023-03-06', 'Uma Vez', '247.50', 30, NULL, 'Pendente', '2023-01-06', NULL, NULL, NULL, NULL, NULL, 82, 'sem-foto.jpg'),
(127, 'Parcela 3', 92, 'Caixa', 'Carnê', 'Venda', '2023-01-06', '2023-04-06', 'Uma Vez', '247.50', 30, NULL, 'Pendente', '2023-01-06', NULL, NULL, NULL, NULL, NULL, 82, 'sem-foto.jpg'),
(128, 'Parcela 4', 92, 'Caixa', 'Carnê', 'Venda', '2023-01-06', '2023-05-06', 'Uma Vez', '247.50', 30, NULL, 'Pendente', '2023-01-06', NULL, NULL, NULL, NULL, NULL, 82, 'sem-foto.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cat_despesas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `nome`, `cat_despesas`) VALUES
(24, 'Folha de Pagamento', 11),
(26, 'Compras de Produtos', 11),
(27, 'Luz', 14),
(28, 'Agua', 14),
(29, 'Agua', 11),
(30, 'Luz', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pgtos`
--

CREATE TABLE `formas_pgtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `formas_pgtos`
--

INSERT INTO `formas_pgtos` (`id`, `nome`) VALUES
(2, 'Pix'),
(3, 'Cartão de Crédito'),
(4, 'Cartão de Debito'),
(5, 'Boleto'),
(6, 'Transferência'),
(7, 'Cheque'),
(8, 'Carnê'),
(10, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pessoa` varchar(15) NOT NULL,
  `doc` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `obs` varchar(150) DEFAULT NULL,
  `data` date NOT NULL,
  `banco` varchar(40) DEFAULT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `conta` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `pessoa`, `doc`, `telefone`, `endereco`, `ativo`, `obs`, `data`, `banco`, `agencia`, `conta`, `email`) VALUES
(1, 'Diversos', 'Jurídica', '000.000.000-00', '(00) 00000-0000', '', 'Sim', 'Esse Fornecedor é exclusivo da loja para que não precisa sempre cadastrar um Forncedor!', '2022-01-07', '', '', '', 'fornecedor@forn.com'),
(2, 'Farmácia', 'Jurídica', '99.999.999/9999-99', '', '', 'Sim', '', '2022-01-07', '', '', '', ''),
(3, 'Supermercado', 'Jurídica', '66.666.666/6666-66', '', '', 'Sim', '', '2022-01-07', '', '', '', ''),
(4, 'Copasa', 'Jurídica', '15.151.215/4545-45', '', '', 'Sim', '', '2022-01-07', '', '', '', ''),
(5, 'Cemig', 'Jurídica', '78.954.632/1458-58', '', '', 'Sim', '', '2022-01-07', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `frequencias`
--

INSERT INTO `frequencias` (`id`, `nome`, `dias`) VALUES
(2, 'Uma Vez', 0),
(3, 'Diária', 1),
(4, 'Semanal', 7),
(5, 'Mensal', 30),
(6, 'Trimestral', 90),
(7, 'Semestral', 180),
(8, 'Anual', 365);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_compra`
--

CREATE TABLE `itens_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `valor_custo` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `itens_venda`
--

INSERT INTO `itens_venda` (`id`, `id_venda`, `produto`, `valor`, `quantidade`, `total`, `usuario`, `valor_custo`) VALUES
(1, 1, 6, '190.00', 1, '190.00', 30, '0.00'),
(2, 1, 7, '90.00', 1, '90.00', 30, '0.00'),
(7, 2, 3, '289.00', 1, '289.00', 30, '0.00'),
(8, 2, 4, '290.00', 1, '290.00', 30, '0.00'),
(9, 3, 1, '379.00', 1, '379.00', 30, '0.00'),
(10, 3, 2, '190.00', 1, '190.00', 30, '0.00'),
(11, 4, 5, '595.00', 1, '595.00', 30, '0.00'),
(12, 5, 10, '390.00', 1, '390.00', 30, '0.00'),
(15, 6, 6, '190.00', 1, '190.00', 30, '0.00'),
(16, 7, 46, '379.00', 1, '379.00', 30, '0.00'),
(17, 7, 4, '290.00', 1, '290.00', 30, '0.00'),
(22, 8, 4, '290.00', 1, '290.00', 30, '0.00'),
(23, 8, 9, '289.00', 1, '289.00', 30, '0.00'),
(24, 9, 42, '90.00', 1, '90.00', 30, '0.00'),
(25, 9, 43, '968.00', 1, '968.00', 30, '0.00'),
(36, 10, 40, '289.00', 1, '289.00', 30, '0.00'),
(37, 10, 4, '290.00', 1, '290.00', 30, '0.00'),
(38, 11, 36, '379.00', 1, '379.00', 30, '0.00'),
(39, 11, 2, '190.00', 1, '190.00', 30, '0.00'),
(40, 12, 37, '379.00', 1, '379.00', 30, '0.00'),
(41, 12, 38, '550.00', 1, '550.00', 30, '0.00'),
(42, 13, 41, '379.00', 1, '379.00', 30, '0.00'),
(43, 13, 4, '290.00', 1, '290.00', 30, '0.00'),
(44, 14, 51, '399.00', 1, '399.00', 30, '0.00'),
(45, 14, 50, '325.00', 1, '325.00', 30, '0.00'),
(47, 15, 43, '968.00', 1, '968.00', 30, '0.00'),
(48, 16, 43, '968.00', 1, '968.00', 30, '0.00'),
(49, 16, 49, '289.00', 1, '289.00', 30, '0.00'),
(52, 17, 59, '90.00', 1, '90.00', 30, '0.00'),
(53, 17, 60, '640.00', 1, '640.00', 30, '0.00'),
(54, 18, 65, '500.00', 1, '500.00', 30, '0.00'),
(55, 19, 13, '379.00', 1, '379.00', 30, '0.00'),
(56, 19, 58, '390.00', 1, '390.00', 30, '0.00'),
(57, 20, 55, '180.00', 1, '180.00', 30, '0.00'),
(58, 20, 4, '290.00', 1, '290.00', 30, '0.00'),
(59, 21, 4, '290.00', 1, '290.00', 30, '0.00'),
(62, 22, 56, '379.00', 1, '379.00', 30, '0.00'),
(63, 22, 43, '968.00', 1, '968.00', 30, '0.00'),
(66, 23, 8, '299.00', 1, '299.00', 30, '0.00'),
(67, 23, 53, '199.00', 1, '199.00', 30, '0.00'),
(70, 24, 64, '289.00', 1, '289.00', 30, '0.00'),
(71, 24, 43, '968.00', 1, '968.00', 30, '0.00'),
(72, 25, 43, '968.00', 1, '968.00', 30, '0.00'),
(73, 25, 27, '289.00', 1, '289.00', 30, '0.00'),
(74, 26, 61, '289.00', 1, '289.00', 30, '0.00'),
(75, 26, 4, '290.00', 1, '290.00', 30, '0.00'),
(78, 27, 54, '180.00', 1, '180.00', 30, '0.00'),
(79, 27, 4, '290.00', 1, '290.00', 30, '0.00'),
(80, 28, 72, '150.00', 1, '150.00', 30, '0.00'),
(85, 29, 67, '395.00', 1, '395.00', 30, '0.00'),
(86, 29, 68, '490.00', 1, '490.00', 30, '0.00'),
(87, 30, 71, '280.00', 1, '280.00', 30, '0.00'),
(88, 30, 58, '390.00', 1, '390.00', 30, '0.00'),
(89, 31, 82, '350.00', 2, '700.00', 30, '0.00'),
(90, 32, 81, '200.00', 1, '200.00', 30, '0.00'),
(91, 32, 80, '200.00', 1, '200.00', 30, '0.00'),
(92, 32, 6, '190.00', 1, '190.00', 30, '0.00'),
(93, 33, 69, '289.00', 1, '289.00', 30, '0.00'),
(94, 33, 4, '290.00', 1, '290.00', 30, '0.00'),
(96, 34, 51, '399.00', 1, '399.00', 30, '0.00'),
(97, 35, 172, '370.00', 1, '370.00', 30, '0.00'),
(98, 35, 173, '420.00', 1, '420.00', 30, '0.00'),
(99, 35, 73, '189.00', 1, '189.00', 30, '0.00'),
(110, 36, 70, '395.00', 1, '395.00', 30, '0.00'),
(111, 36, 43, '968.00', 1, '968.00', 30, '0.00'),
(112, 37, 13, '379.00', 1, '379.00', 30, '0.00'),
(113, 37, 58, '390.00', 1, '390.00', 30, '0.00'),
(116, 38, 13, '379.00', 1, '379.00', 30, '0.00'),
(117, 38, 58, '390.00', 1, '390.00', 30, '0.00'),
(118, 39, 13, '379.00', 1, '379.00', 30, '0.00'),
(119, 39, 58, '390.00', 1, '390.00', 30, '0.00'),
(120, 40, 13, '379.00', 1, '379.00', 30, '0.00'),
(121, 40, 58, '390.00', 1, '390.00', 30, '0.00'),
(122, 41, 191, '379.00', 1, '379.00', 30, '0.00'),
(123, 41, 60, '640.00', 1, '640.00', 30, '0.00'),
(124, 42, 2, '190.00', 1, '190.00', 30, '0.00'),
(125, 43, 66, '300.00', 1, '300.00', 30, '0.00'),
(126, 43, 43, '968.00', 1, '968.00', 30, '0.00'),
(129, 44, 83, '379.00', 1, '379.00', 30, '0.00'),
(130, 44, 60, '640.00', 1, '640.00', 30, '0.00'),
(133, 45, 73, '189.00', 1, '189.00', 30, '0.00'),
(134, 45, 74, '289.00', 1, '289.00', 30, '0.00'),
(135, 46, 55, '180.00', 1, '180.00', 30, '0.00'),
(136, 46, 4, '290.00', 1, '290.00', 30, '0.00'),
(137, 47, 446, '190.00', 1, '190.00', 30, '0.00'),
(138, 48, 70, '395.00', 1, '395.00', 30, '0.00'),
(139, 48, 43, '968.00', 1, '968.00', 30, '0.00'),
(140, 49, 68, '490.00', 1, '490.00', 30, '0.00'),
(141, 49, 79, '200.00', 1, '200.00', 30, '0.00'),
(143, 50, 58, '390.00', 1, '390.00', 30, '0.00'),
(144, 51, 77, '900.00', 1, '900.00', 30, '0.00'),
(145, 51, 75, '289.00', 1, '289.00', 30, '0.00'),
(146, 51, 76, '390.00', 1, '390.00', 30, '0.00'),
(147, 51, 73, '189.00', 1, '189.00', 30, '0.00'),
(154, 52, 38, '550.00', 1, '550.00', 30, '0.00'),
(155, 52, 82, '350.00', 1, '350.00', 30, '0.00'),
(156, 52, 82, '350.00', 1, '350.00', 30, '0.00'),
(158, 53, 222, '379.00', 1, '379.00', 30, '0.00'),
(159, 53, 4, '290.00', 1, '290.00', 30, '0.00'),
(160, 54, 2, '190.00', 1, '190.00', 30, '0.00'),
(161, 55, 335, '289.00', 1, '289.00', 30, '0.00'),
(162, 55, 60, '640.00', 1, '640.00', 30, '0.00'),
(163, 56, 243, '379.00', 1, '379.00', 30, '0.00'),
(164, 56, 4, '290.00', 1, '290.00', 30, '0.00'),
(165, 57, 186, '379.00', 1, '379.00', 30, '0.00'),
(166, 57, 8, '299.00', 1, '299.00', 30, '0.00'),
(167, 58, 226, '289.00', 1, '289.00', 30, '0.00'),
(168, 58, 43, '968.00', 1, '968.00', 30, '0.00'),
(171, 59, 127, '379.00', 1, '379.00', 30, '0.00'),
(172, 59, 43, '968.00', 1, '968.00', 30, '0.00'),
(173, 60, 185, '395.00', 1, '395.00', 30, '0.00'),
(174, 60, 43, '968.00', 1, '968.00', 30, '0.00'),
(175, 61, 4, '290.00', 1, '290.00', 30, '0.00'),
(178, 62, 451, '379.00', 1, '379.00', 30, '0.00'),
(179, 62, 51, '399.00', 1, '399.00', 30, '0.00'),
(180, 63, 362, '389.00', 1, '389.00', 30, '0.00'),
(181, 63, 60, '640.00', 1, '640.00', 30, '0.00'),
(191, 64, 446, '190.00', 1, '190.00', 30, '0.00'),
(192, 64, 446, '190.00', 1, '190.00', 30, '0.00'),
(193, 64, 466, '18.00', 1, '18.00', 30, '0.00'),
(194, 65, 399, '395.00', 1, '395.00', 30, '0.00'),
(195, 65, 4, '290.00', 1, '290.00', 30, '0.00'),
(196, 66, 459, '379.00', 1, '379.00', 30, '0.00'),
(197, 66, 43, '968.00', 1, '968.00', 30, '0.00'),
(198, 67, 43, '968.00', 1, '968.00', 30, '0.00'),
(199, 68, 43, '968.00', 1, '968.00', 30, '0.00'),
(200, 69, 463, '379.00', 1, '379.00', 30, '0.00'),
(201, 69, 173, '420.00', 1, '420.00', 30, '0.00'),
(202, 69, 82, '350.00', 1, '350.00', 30, '0.00'),
(203, 70, 16, '998.00', 1, '998.00', 30, '0.00'),
(204, 70, 447, '1140.00', 1, '1140.00', 30, '0.00'),
(205, 71, 88, '315.00', 1, '315.00', 30, '0.00'),
(208, 72, 66, '300.00', 1, '300.00', 30, '0.00'),
(209, 72, 4, '290.00', 1, '290.00', 30, '0.00'),
(211, 73, 268, '289.00', 1, '289.00', 30, '0.00'),
(212, 74, 264, '260.00', 1, '260.00', 30, '0.00'),
(213, 74, 58, '390.00', 1, '390.00', 30, '0.00'),
(214, 75, 60, '640.00', 1, '640.00', 30, '0.00'),
(215, 76, 223, '379.00', 1, '379.00', 30, '0.00'),
(220, 77, 14, '379.00', 1, '379.00', 30, '0.00'),
(221, 77, 58, '390.00', 1, '390.00', 30, '0.00'),
(222, 78, 430, '780.00', 1, '780.00', 30, '0.00'),
(223, 79, 258, '289.00', 1, '289.00', 30, '0.00'),
(224, 80, 2, '190.00', 1, '190.00', 30, '0.00'),
(225, 81, 138, '379.00', 1, '379.00', 30, '0.00'),
(226, 81, 60, '640.00', 1, '640.00', 30, '0.00'),
(227, 82, 373, '90.00', 1, '90.00', 30, '0.00'),
(228, 82, 77, '900.00', 1, '900.00', 30, '0.00'),
(229, 83, 6, '190.00', 1, '190.00', 30, '0.00'),
(230, 84, 278, '289.00', 1, '289.00', 30, '0.00'),
(231, 84, 481, '455.00', 1, '455.00', 30, '0.00'),
(232, 85, 184, '395.00', 1, '395.00', 30, '0.00'),
(233, 85, 8, '299.00', 1, '299.00', 30, '0.00'),
(234, 86, 128, '379.00', 1, '379.00', 30, '0.00'),
(235, 86, 43, '968.00', 1, '968.00', 30, '0.00'),
(236, 87, 482, '640.00', 1, '640.00', 30, '0.00'),
(237, 88, 95, '379.00', 1, '379.00', 30, '0.00'),
(238, 88, 52, '290.00', 1, '290.00', 30, '0.00'),
(239, 89, 483, '30.00', 1, '30.00', 30, '0.00'),
(240, 90, 4, '290.00', 1, '290.00', 30, '0.00'),
(241, 90, 82, '350.00', 1, '350.00', 30, '0.00'),
(242, 91, 130, '289.00', 1, '289.00', 30, '0.00'),
(243, 91, 5, '595.00', 1, '595.00', 30, '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(35) NOT NULL,
  `movimento` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `lancamento` varchar(35) DEFAULT NULL,
  `plano_conta` varchar(35) DEFAULT NULL,
  `documento` varchar(35) DEFAULT NULL,
  `caixa_periodo` int(11) DEFAULT NULL,
  `id_mov` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `tipo`, `movimento`, `descricao`, `valor`, `usuario`, `data`, `lancamento`, `plano_conta`, `documento`, `caixa_periodo`, `id_mov`) VALUES
(1, 'Entrada', 'Venda', 'Venda Via OS - GEANNE VITÓRIA DOS SANTOS', '280.00', 30, '2022-10-14', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 1),
(2, 'Entrada', 'Venda', 'Venda Via OS - VITORYA RAPHAELA CAETANO', '579.00', 30, '2022-10-14', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 2),
(3, 'Entrada', 'Venda', 'Venda Via OS - JOSÉ SARAIVA DOS SANTOS', '509.00', 30, '2022-10-14', 'Caixa', 'Venda', 'Dinheiro', NULL, 3),
(4, 'Entrada', 'Venda', 'Venda Via OS - MARIA GABRIELA', '595.00', 30, '2022-10-18', 'Caixa', 'Venda', 'Dinheiro', NULL, 4),
(5, 'Entrada', 'Venda', 'Venda Via OS - CLAYTON SANTOS SILVA', '390.00', 30, '2022-10-20', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 5),
(6, 'Entrada', 'Venda', 'Venda Via OS - VALMIR GOMES DE MOURA', '190.00', 30, '2022-10-21', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 6),
(7, 'Entrada', 'Venda', 'Venda Via OS - JÚLIA R. TAVARES', '669.00', 30, '2022-10-21', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 7),
(8, 'Entrada', 'Venda', 'Venda Via OS - DIVINA FERNANDES DA SILVA', '1058.00', 30, '2022-10-28', 'Caixa', 'Venda', 'Boleto', NULL, 9),
(9, 'Entrada', 'Venda', 'Venda Via OS - JOÃO HENRIQUE COSTA', '579.00', 30, '2022-11-03', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 10),
(10, 'Entrada', 'Venda', 'Venda Via OS - MANOEL ANTÔNIO ARAÚJO', '569.00', 30, '2022-11-03', 'Caixa', 'Venda', 'Dinheiro', NULL, 11),
(11, 'Entrada', 'Conta à Receber', 'Venda Via OS - REBECA SARAY DOS SANTOS - REBECA SARAY DOS SANTOS', '929.00', 30, '2022-11-04', 'Sicoob', 'Venda', 'Cheque', 4, 12),
(12, 'Entrada', 'Venda', 'Venda Via OS - ALEX RODRIGUES RIBEIRO', '650.00', 30, '2022-11-04', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 14),
(13, 'Entrada', 'Venda', 'Venda Via OS - ISAURA SILVA DA CONCEICAO ', '800.00', 30, '2022-11-11', 'Caixa', 'Venda', 'Boleto', NULL, 15),
(14, 'Entrada', 'Venda', 'Venda Via OS - HELI RODRIGUES FRAGAS', '1257.00', 30, '2022-11-11', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 16),
(15, 'Entrada', 'Venda', 'Venda Via OS - MARIA APARECIDA SILVA', '610.00', 30, '2022-11-17', 'Caixa', 'Venda', 'Dinheiro', NULL, 17),
(16, 'Entrada', 'Venda', 'Venda Via OS - MARIA GLAUCIENE BATISTA DOS  SANTOS', '500.00', 30, '2022-11-18', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 18),
(17, 'Entrada', 'Venda', 'Entrada via Os MARIA DAS GRAÇAS BATISTA', '192.00', 30, '2022-11-18', 'Caixa', 'Venda', 'Dinheiro', 4, 19),
(18, 'Entrada', 'Venda', 'Venda Via OS - JESSICA ALMEIDA SANTOS', '290.00', 30, '2022-11-18', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 21),
(19, 'Entrada', 'Venda', 'Venda Via OS - MARCILENE DA SILVA', '1200.00', 30, '2022-11-19', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 22),
(20, 'Entrada', 'Venda', 'Venda Via OS - HEITOR LORENZO BORGES', '440.00', 30, '2022-11-22', 'Pix', 'Venda', 'Pix', NULL, 23),
(21, 'Entrada', 'Venda', 'Venda Via OS - MARIA APARECIDA DA SILVA', '1100.00', 30, '2022-11-25', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 24),
(22, 'Entrada', 'Venda', 'Venda Via OS - GLEIBE DOS SANTOS MACIEL', '1129.00', 30, '2022-11-25', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 25),
(23, 'Entrada', 'Venda', 'Venda Via OS - JALILE MARIA DE LIMA', '500.00', 30, '2022-11-25', 'Caixa', 'Venda', 'Dinheiro', NULL, 26),
(24, 'Entrada', 'Venda', 'Venda Via OS - PEDRO EMANUEL P SANTOS', '390.00', 30, '2022-11-28', 'Caixa', 'Venda', 'Dinheiro', NULL, 27),
(25, 'Entrada', 'Venda', 'Venda Via OS - NATHALIA CAROLINE', '150.00', 30, '2022-11-30', 'Pix', 'Venda', 'Pix', NULL, 28),
(26, 'Entrada', 'Venda', 'Entrada MARIA DOS R. CARLOS', '200.00', 30, '2022-12-02', 'Caixa', 'Venda', 'Dinheiro', 4, 0),
(27, 'Entrada', 'Venda', 'Venda Via OS - EUNICE P DE ANDRADE ', '600.00', 30, '2022-12-02', 'Caixa', 'Venda', 'Dinheiro', NULL, 30),
(28, 'Entrada', 'Venda', 'Venda Via OS - POLLYANA DAMAS DOS REIS', '700.00', 30, '2022-12-02', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 31),
(29, 'Entrada', 'Venda', 'Venda Via OS - NATALIA DAMAS DE  JESUS', '660.00', 30, '2022-12-02', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 32),
(30, 'Entrada', 'Venda', 'Venda Via OS - YURI CAIXETA SOARES', '350.00', 30, '2022-12-02', 'Caixa', 'Venda', 'Dinheiro', NULL, 34),
(31, 'Entrada', 'Venda', 'Venda Via OS - JULIA FRAGA BELEZE', '880.00', 30, '2022-12-05', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 35),
(32, 'Entrada', 'Venda', 'Entrada via Os MARIA DE LOURDES DOS SANTOS', '600.00', 30, '2022-12-06', 'Caixa', 'Venda', 'Pix', 4, 36),
(33, 'Entrada', 'Venda', 'Entrada MARIA DE LOURDES DOS SANTOS', '6000.00', 30, '2022-12-07', 'Caixa', 'Venda', 'Boleto', 4, 0),
(34, 'Entrada', 'Venda', 'Entrada MARIA DE LOURDES DOS SANTOS', '6000.00', 30, '2022-12-07', 'Caixa', 'Venda', '6000', 4, 0),
(35, 'Entrada', 'Venda', 'Entrada MARIA DE LOURDES DOS SANTOS', '600.00', 30, '2022-12-07', 'Caixa', 'Venda', 'Boleto', 4, 0),
(36, 'Entrada', 'Venda', 'Entrada MARIA DAS GRAÇAS BATISTA', '192.00', 30, '2022-12-07', 'Caixa', 'Venda', '0', 4, 0),
(37, 'Entrada', 'Venda', 'Entrada MARIA DAS GRAÇAS BATISTA', '192.00', 30, '2022-12-07', 'Caixa', 'Venda', 'Boleto', 4, 0),
(38, 'Entrada', 'Venda', 'Entrada via Os MARIA DAS GRAÇAS BATISTA', '200.00', 30, '2022-12-07', 'Caixa', 'Venda', 'Dinheiro', 4, 39),
(39, 'Entrada', 'Venda', 'Venda Via OS - MARIA DAS GRAÇAS BATISTA', '377.00', 30, '2022-12-07', 'Caixa', 'Venda', 'Boleto', NULL, 39),
(40, 'Entrada', 'Venda', 'Entrada MARIA DAS GRAÇAS BATISTA', '192.00', 30, '2022-12-07', 'Caixa', 'Venda', '192.0', 4, 0),
(41, 'Entrada', 'Venda', 'Entrada via Os MARIA DAS GRAÇAS BATISTA', '200.00', 30, '2022-12-07', 'Caixa', 'Venda', 'Dinheiro', 4, 40),
(42, 'Entrada', 'Venda', 'Venda Via OS - MARA DOS PASSOS LANDIM', '965.00', 30, '2022-12-08', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 41),
(43, 'Entrada', 'Venda', 'Venda Via OS - MAURICIO MENDES DA FONSECA', '190.00', 30, '2022-12-08', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 42),
(44, 'Entrada', 'Venda', 'Entrada via Os OLIVEIRA  NUNES DA SILVA', '329.00', 30, '2022-12-08', 'Caixa', 'Venda', 'Dinheiro', 4, 43),
(45, 'Entrada', 'Conta à Receber', 'Parcela 1 - MARIA DAS GRAÇAS BATISTA', '192.33', 30, '2022-12-08', 'Caixa', 'Venda', 'Carnê', 4, 19),
(46, 'Entrada', 'Conta à Receber', '(Resíduo) Parcela 2 - MARIA DAS GRAÇAS BATISTA', '7.67', 30, '2022-12-08', 'Caixa', 'Venda', 'Carnê', 4, 19),
(47, 'Entrada', 'Venda', 'Venda Via OS - PAULIANA MACHADO', '965.00', 30, '2022-12-08', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 44),
(48, 'Entrada', 'Venda', 'Venda Via OS - GLEIBE DOS SANTOS MACIEL', '430.00', 30, '2022-12-08', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 45),
(49, 'Entrada', 'Venda', 'Venda Via OS - ALEXANDRE  R  VENANCIO', '420.00', 30, '2022-12-08', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 46),
(50, 'Entrada', 'Venda', 'Venda Via OS - MARIA CECILIA', '190.00', 30, '2022-12-09', 'Pix', 'Venda', 'Pix', NULL, 47),
(51, 'Entrada', 'Venda', 'Entrada via Os KARINE DE OLIVEIRA COSTA', '350.00', 30, '2022-12-09', 'Caixa', 'Venda', 'Dinheiro', 4, 49),
(52, 'Entrada', 'Venda', 'Venda Via OS - KARINE DE OLIVEIRA COSTA', '230.00', 30, '2022-12-09', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 49),
(53, 'Entrada', 'Venda', 'Venda Via OS - SANDRA GONÇALVES', '350.00', 30, '2022-12-13', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 50),
(54, 'Entrada', 'Venda', 'Venda Via OS - SONIA ALVES CAIXETA DINIZ ', '1590.00', 30, '2022-12-13', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 51),
(55, 'Entrada', 'Venda', 'Venda Via OS - SCARLET  ALVES FROIS', '1400.00', 30, '2022-12-13', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 52),
(56, 'Entrada', 'Venda', 'Venda Via OS - LUDENIA P LOPES', '624.00', 30, '2022-12-15', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 53),
(57, 'Entrada', 'Venda', 'Venda Via OS - JANNIFFER M DE SOUZA', '290.00', 30, '2022-12-15', 'Caixa', 'Venda', 'Pix', NULL, 54),
(58, 'Entrada', 'Venda', 'Venda Via OS - GILNEI ALVES DE MELO', '800.00', 30, '2022-12-15', 'Caixa', 'Venda', 'Dinheiro', NULL, 55),
(59, 'Entrada', 'Venda', 'Venda Via OS - ALESSANDRA DE F. CORREA', '600.00', 30, '2022-12-15', 'Santander', 'Venda', 'Pix', NULL, 56),
(60, 'Entrada', 'Venda', 'Venda Via OS - THAIS MONIELLE ALVES', '615.00', 30, '2022-12-15', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 57),
(61, 'Entrada', 'Venda', 'Venda Via OS - GERALDA CRUZEIRO DOS SANTOS', '1168.00', 30, '2022-12-15', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 58),
(62, 'Entrada', 'Venda', 'Venda Via OS - RODRIGO ALEX PEREIRA ', '1200.00', 30, '2022-12-16', 'Pix', 'Venda', 'Pix', NULL, 59),
(63, 'Entrada', 'Venda', 'Entrada via Os EDNA MARIA FERREIRA', '400.00', 30, '2022-12-16', 'Caixa', 'Venda', 'Dinheiro', 4, 60),
(64, 'Entrada', 'Venda', 'Venda Via OS - IAGO JUNIOR VIDA', '250.00', 30, '2022-12-23', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 61),
(65, 'Entrada', 'Venda', 'Venda Via OS - MICHELE DOS SANTOS ARAUJO', '690.00', 30, '2022-12-23', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 62),
(66, 'Entrada', 'Venda', 'Venda Via OS - WILLIAN FERNANDES  DE SOUZA ', '1019.00', 30, '2022-12-23', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 63),
(67, 'Entrada', 'Venda', 'Venda Via OS - BRUNA', '398.00', 30, '2022-12-23', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 64),
(68, 'Entrada', 'Venda', 'Venda Via OS - YASMIN APARECIDA G DE JESUS ', '600.00', 30, '2022-12-23', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 65),
(69, 'Entrada', 'Venda', 'Venda Via OS - EDGARD DOS REIS DA FONSECA', '1000.00', 30, '2022-12-23', 'Caixa', 'Venda', 'Dinheiro', NULL, 66),
(70, 'Entrada', 'Venda', 'Venda Via OS - DIVINA R. PIMENTEL ', '968.00', 30, '2022-12-23', 'Caixa', 'Venda', 'Dinheiro', NULL, 67),
(71, 'Entrada', 'Venda', 'Venda Via OS - DIVINA R. PIMENTEL ', '800.00', 30, '2022-12-23', 'Caixa', 'Venda', 'Dinheiro', NULL, 68),
(72, 'Entrada', 'Venda', 'Venda Via OS - MONIELLE SILVA FREITAS', '620.00', 30, '2022-12-23', 'Caixa', 'Venda', 'Dinheiro', NULL, 69),
(73, 'Entrada', 'Venda', 'Venda Via OS - ANTONIO LUIZ DOS SANTOS', '1400.00', 30, '2022-12-24', 'Caixa', 'Venda', 'Dinheiro', NULL, 70),
(74, 'Entrada', 'Venda', 'Venda Via OS - APARECIDA DE FATIMA ASSUNÇAO', '280.00', 30, '2022-12-29', 'Pix', 'Venda', 'Pix', NULL, 71),
(75, 'Entrada', 'Venda', 'Venda Via OS - GABRIEL P SOUZA', '488.00', 30, '2022-12-29', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 72),
(76, 'Entrada', 'Venda', 'Venda Via OS - APARECIDA DE FATIMA ASSUNÇAO', '280.00', 30, '2022-12-29', 'Pix', 'Venda', 'Pix', NULL, 73),
(77, 'Entrada', 'Venda', 'Entrada via Os CRISTINA VAZ  DE OLIVEIRA ', '216.00', 30, '2022-12-29', 'Caixa', 'Venda', 'Cartão de Debito', 4, 74),
(78, 'Entrada', 'Venda', 'Entrada via Os MARTA TEREZINHA RIBEIRO', '100.00', 30, '2022-12-31', 'Caixa', 'Venda', 'Dinheiro', 4, 75),
(79, 'Entrada', 'Venda', 'Venda Via OS - MARTA TEREZINHA RIBEIRO', '640.00', 30, '2022-12-31', 'Caixa', 'Venda', 'Boleto', NULL, 75),
(80, 'Entrada', 'Venda', 'Entrada via Os MARTA TEREZINHA RIBEIRO', '50.00', 30, '2022-12-31', 'Caixa', 'Venda', 'Dinheiro', 4, 76),
(81, 'Entrada', 'Venda', 'Venda Via OS - MARTA TEREZINHA RIBEIRO', '249.00', 30, '2022-12-31', 'Caixa', 'Venda', 'Boleto', NULL, 76),
(82, 'Entrada', 'Venda', 'Venda Via OS - ANA DA CONSOLACAO FONSECA', '700.00', 30, '2023-01-03', 'Caixa', 'Venda', 'Dinheiro', NULL, 77),
(83, 'Entrada', 'Conta à Receber', 'Parcela 1 - MARIA DOS R. CARLOS', '220.00', 30, '2023-01-03', 'Caixa', 'Venda', 'Carnê', 4, 29),
(84, 'Entrada', 'Venda', 'Entrada via Os FRANCINE ', '300.00', 30, '2023-01-05', 'Caixa', 'Venda', 'Dinheiro', 4, 78),
(85, 'Entrada', 'Venda', 'Venda Via OS - FRANCINE ', '300.00', 30, '2023-01-05', 'Caixa', 'Venda', 'Boleto', NULL, 78),
(86, 'Entrada', 'Venda', 'Venda Via OS - EDUARDO ALVES MARTINS ', '260.00', 30, '2023-01-05', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 79),
(87, 'Entrada', 'Venda', 'Venda Via OS - ADAIR FERREIRA DA SILVA', '190.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Dinheiro', NULL, 80),
(88, 'Entrada', 'Venda', 'Venda Via OS - JOSE DO CARMO ', '990.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Dinheiro', NULL, 81),
(89, 'Entrada', 'Conta à Receber', 'Parcela 1 - OLIVEIRA  NUNES DA SILVA', '100.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Carnê', 4, 43),
(90, 'Entrada', 'Conta à Receber', 'Parcela 2 - OLIVEIRA  NUNES DA SILVA', '100.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Carnê', 4, 43),
(91, 'Entrada', 'Venda', 'Venda Via OS - MARIA ELOA OLIVEIRA ', '220.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Pix', NULL, 83),
(92, 'Entrada', 'Venda', 'Venda Via OS - CASSIA MARIA DE JESUS ', '744.00', 30, '2023-01-06', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 84),
(93, 'Entrada', 'Venda', 'Venda Via OS - MARIA GABRIELLE PEREIRA ', '678.00', 30, '2023-01-06', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 85),
(94, 'Entrada', 'Venda', 'Venda Via OS - APARICIO DONATO ROSA', '1200.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Dinheiro', NULL, 86),
(95, 'Entrada', 'Venda', 'Venda Via OS - JOSE PIRES DE OLIVEIRA', '640.00', 30, '2023-01-06', 'Cartão de Crédito', 'Venda', 'Cartão de Crédito', NULL, 87),
(96, 'Entrada', 'Venda', 'Venda Via OS - LAIS MAGELA FERREIRA ', '600.00', 30, '2023-01-06', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 88),
(97, 'Entrada', 'Venda', 'Venda Via OS - FICTICIO', '30.00', 30, '2023-01-06', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 89),
(98, 'Entrada', 'Venda', 'Venda Via OS - LETICIA CAMARGOS ', '345.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Pix', NULL, 90),
(99, 'Entrada', 'Venda', 'Entrada via Os EDUARDO ALVES MARTINS ', '400.00', 30, '2023-01-06', 'Caixa', 'Venda', 'Cartão de Debito', 4, 91),
(100, 'Entrada', 'Venda', 'Venda Via OS - EDUARDO ALVES MARTINS ', '280.00', 30, '2023-01-06', 'Cartão de Débito', 'Venda', 'Cartão de Debito', NULL, 91);

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis`
--

CREATE TABLE `niveis` (
  `id` int(11) NOT NULL,
  `nivel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `niveis`
--

INSERT INTO `niveis` (`id`, `nivel`) VALUES
(48, 'Administrador'),
(51, 'Colaborador'),
(53, 'Comum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico`
--

CREATE TABLE `ordem_servico` (
  `id` int(11) NOT NULL,
  `obj` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`obj`)),
  `data_criacao` date NOT NULL,
  `valor_total` double NOT NULL,
  `entrada_cliente` double NOT NULL,
  `nome_cliente` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `nome_func` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordem_servico`
--

INSERT INTO `ordem_servico` (`id`, `obj`, `data_criacao`, `valor_total`, `entrada_cliente`, `nome_cliente`, `status`, `nome_func`) VALUES
(2, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-14\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"31\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"1\",\"codENome\":\"Y8007 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"2\",\"codENome\":\"LENTE - MONOFOCAL INCOLOR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"509.00\",\"valor_Total_produtos\":\"569.00\",\"valor_liquido\":\"509.00\",\"desconto\":\"60.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"10.54\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"2023-10-14\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"+2.75\",\"cilindrico_od_perto\":\"-0.50\",\"eixo_od_perto\":\"100\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"31.5mm\",\"esferico_oe_perto\":\"++3.00\",\"cilindrico_oe_perto\":\"-0.50\",\"eixo_oe_perto\":\"100\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"31.5mm\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-07', 569, 0, 'JOSÉ SARAIVA DOS SANTOS', 'Confirmada', 'Rosana'),
(3, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-10-14\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"32\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"3\",\"codENome\":\"FX3757VZT - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"588.00\",\"valor_Total_produtos\":\"579.00\",\"valor_liquido\":\"588.00\",\"desconto\":\"\",\"acrescimo\":\"9.00\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"1.55\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"2023-10-14\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"++0.25\",\"cilindrico_od_longe\":\"-1.25\",\"eixo_od_longe\":\"175\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"++0.25\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"20\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-07', 579, 0, 'VITORYA RAPHAELA CAETANO', 'Confirmada', 'Rosana'),
(4, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-14\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"33\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"5\",\"codENome\":\"01 - MONOFOCAL + FOTO + BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"595.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"595.00\",\"valTotal\":\"595.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"595.00\",\"valor_Total_produtos\":\"595.00\",\"valor_liquido\":\"595.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"2023-10-07\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"0.00\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"30.5mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-07', 595, 0, 'MARIA GABRIELA', 'Confirmada', 'Rosana'),
(5, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-14\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"34\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"6\",\"codENome\":\"02 - MONOFOCAL + AR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"},{\"id\":\"7\",\"codENome\":\"03 - PRADO BR0760VZT\",\"qtde\":1,\"valUnit\":\"90.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"90.00\",\"valTotal\":\"90.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"280.00\",\"valor_Total_produtos\":\"280.00\",\"valor_liquido\":\"280.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"2023-10-07\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"8\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"29.5mm\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"169\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-07', 280, 0, 'GEANNE VITÓRIA DOS SANTOS', 'Confirmada', 'Rosana'),
(7, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-14\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"36\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"7\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"},{\"id\":\"9\",\"codENome\":\"4005 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"500.00\",\"valor_Total_produtos\":\"579.00\",\"valor_liquido\":\"500.00\",\"desconto\":\"79.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"++0.50\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"26mm\",\"esferico_oe_longe\":\"++0.50\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"27mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-24', 579, 0, 'ARTHUR CORREIA DE OLIVEIRA', 'Confirmada', 'Rosana'),
(8, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-14\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"35\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"10\",\"codENome\":\"05 - MULTIFOCAL AR EXTERNO\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"390.00\",\"valor_Total_produtos\":\"390.00\",\"valor_liquido\":\"390.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.25\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"28mm\",\"dnp_od_longe\":\"31.5mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"80\\u00b0\",\"altura_oe_longe\":\"28mm\",\"dnp_oe_longe\":\"32.5mm\",\"esferico_od_perto\":\"+1,00\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+1,00\",\"cilindrico_oe_perto\":\"-0,25\",\"eixo_oe_perto\":\"80\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-07', 390, 0, 'CLAYTON SANTOS SILVA', 'Confirmada', 'Rosana'),
(9, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-21\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"38\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"6\",\"codENome\":\"02 - MONOFOCAL + AR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"190.00\",\"valor_Total_produtos\":\"190.00\",\"valor_liquido\":\"190.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"+2.25\",\"cilindrico_od_perto\":\"-0.50\",\"eixo_od_perto\":\"100\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"32mm\",\"esferico_oe_perto\":\"+2.25\",\"cilindrico_oe_perto\":\"-0.50\",\"eixo_oe_perto\":\"100\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"33mm\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_possui_prop\":\"sim\",\"arm_tipo\":\"Friso\\/Fio de Nylon\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-14', 190, 0, 'VALMIR GOMES DE MOURA', 'Confirmada', 'Rosana'),
(10, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"39\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"36\",\"codENome\":\"JULIAN FAIET 5813VZT CLIPPON - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"2\",\"codENome\":\"LENTE - MONOFOCAL INCOLOR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"569.00\",\"valor_Total_produtos\":\"569.00\",\"valor_liquido\":\"569.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"-2.50\",\"eixo_od_longe\":\"5\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"34.5mm\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"-2.75\",\"eixo_oe_longe\":\"160\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"35mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 569, 0, 'MANOEL ANTÔNIO ARAÚJO', 'Confirmada', 'Rosana'),
(11, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"40\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"37\",\"codENome\":\"DACCS S11705VZT - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"38\",\"codENome\":\"MONOFOCAL + FILTRO AZUL 1.61 - LENTE\",\"qtde\":1,\"valUnit\":\"550.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"550.00\",\"valTotal\":\"550.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"929.00\",\"valor_Total_produtos\":\"929.00\",\"valor_liquido\":\"929.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-2.00\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"35\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"27.5mm\",\"esferico_oe_longe\":\"-3.25\",\"cilindrico_oe_longe\":\"-3.00\",\"eixo_oe_longe\":\"175\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"29mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 929, 0, 'REBECA SARAY DOS SANTOS', 'Confirmada', 'Rosana'),
(12, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"41\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"40\",\"codENome\":\"JULIAN FAIET BA925VZT - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"579.00\",\"valor_Total_produtos\":\"579.00\",\"valor_liquido\":\"579.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"26.5mm\",\"esferico_oe_longe\":\"-0.50\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"40\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"26mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 579, 0, 'JOÃO HENRIQUE COSTA', 'Confirmada', 'Rosana'),
(13, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"42\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"41\",\"codENome\":\"DACCS 7505VZT - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"669.00\",\"valor_Total_produtos\":\"669.00\",\"valor_liquido\":\"669.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32.5mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 669, 0, 'ALCI RIBEIRO JUNIOR', 'Confirmada', 'Rosana'),
(14, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"43\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"42\",\"codENome\":\"JULIAN FAIET PROMO\\u00c7\\u00c3O - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"90.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"90.00\",\"valTotal\":\"90.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1058.00\",\"valor_Total_produtos\":\"1058.00\",\"valor_liquido\":\"1058.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"3.00\",\"esferico_od_longe\":\"++2.75\",\"cilindrico_od_longe\":\"-1.00\",\"eixo_od_longe\":\"105\\u00b0\",\"altura_od_longe\":\"20mm\",\"dnp_od_longe\":\"30.5mm\",\"esferico_oe_longe\":\"++1.75\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"95\\u00b0\",\"altura_oe_longe\":\"20mm\",\"dnp_oe_longe\":\"30.5mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-1,00\",\"eixo_od_perto\":\"105\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-0,75\",\"eixo_oe_perto\":\"95\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 1058, 0, 'DIVINA FERNANDES DA SILVA', 'Confirmada', 'Rosana'),
(15, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"44\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"44\",\"codENome\":\"DACCS S11650VZT - DACCS\",\"qtde\":1,\"valUnit\":\"299.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"299.00\",\"valTotal\":\"299.00\"},{\"id\":\"45\",\"codENome\":\"MONOFOCAL BLOCK BLUE 1.61 - LENTE\",\"qtde\":1,\"valUnit\":\"630.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"630.00\",\"valTotal\":\"630.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"929.00\",\"valor_Total_produtos\":\"929.00\",\"valor_liquido\":\"929.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.75\",\"cilindrico_od_longe\":\"-4.50\",\"eixo_od_longe\":\"25\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32mm\",\"esferico_oe_longe\":\"-0.50\",\"cilindrico_oe_longe\":\"-2.50\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 929, 0, 'SINTIKE FERNANDES SANTOS', 'Aberto', 'Rosana'),
(16, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-10-28\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"45\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"46\",\"codENome\":\"VIZZANO OURO 159VZT - VIZZANO\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"669.00\",\"valor_Total_produtos\":\"669.00\",\"valor_liquido\":\"669.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"++0.75\",\"cilindrico_od_longe\":\"-1.75\",\"eixo_od_longe\":\"25\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"29.5mm\",\"esferico_oe_longe\":\"++1.25\",\"cilindrico_oe_longe\":\"-1.50\",\"eixo_oe_longe\":\"170\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-10-21', 669, 0, 'JÚLIA R. TAVARES', 'Confirmada', 'Rosana'),
(17, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-11\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"47\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"},{\"id\":\"49\",\"codENome\":\"5714 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1257.00\",\"valor_Total_produtos\":\"1257.00\",\"valor_liquido\":\"1257.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.75\",\"esferico_od_longe\":\"+2.25\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"28mm\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"+2.50\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"100\\u00b0\",\"altura_oe_longe\":\"28mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"+5,00\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+5,25\",\"cilindrico_oe_perto\":\"-0,25\",\"eixo_oe_perto\":\"100\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-04', 1257, 0, 'HELI RODRIGUES FRAGAS', 'Confirmada', 'Rosana'),
(18, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-11\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"48\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"18\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"800.00\",\"valor_Total_produtos\":\"968.00\",\"valor_liquido\":\"800.00\",\"desconto\":\"168.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 3.00\",\"esferico_od_longe\":\"+0.25\",\"cilindrico_od_longe\":\"-1.25\",\"eixo_od_longe\":\"95\\u00b0\",\"altura_od_longe\":\"24mm\",\"dnp_od_longe\":\"32.5mm\",\"esferico_oe_longe\":\"-1.50\",\"cilindrico_oe_longe\":\"-1.50\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"24mm\",\"dnp_oe_longe\":\"32.50mm\",\"esferico_od_perto\":\"+3,25\",\"cilindrico_od_perto\":\"-1,25\",\"eixo_od_perto\":\"95\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+1,50\",\"cilindrico_oe_perto\":\"-1,50\",\"eixo_oe_perto\":\"90\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-11', 968, 0, 'ISAURA SILVA DA CONCEICAO ', 'Confirmada', 'KENIA'),
(19, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-11\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"49\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"51\",\"codENome\":\"LENTE MONOFOCAl COM FOTO - MONOFOCAL COM FOTO\",\"qtde\":1,\"valUnit\":\"399.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"399.00\",\"valTotal\":\"399.00\"},{\"id\":\"50\",\"codENome\":\"2225 - DACCS\",\"qtde\":1,\"valUnit\":\"325.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"325.00\",\"valTotal\":\"325.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"650.00\",\"valor_Total_produtos\":\"724.00\",\"valor_liquido\":\"650.00\",\"desconto\":\"74.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"10.22\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-0.25 \",\"eixo_od_longe\":\"60\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"36mm\",\"esferico_oe_longe\":\"+0.25\",\"cilindrico_oe_longe\":\"-2.50\",\"eixo_oe_longe\":\"140\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"36mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-04', 724, 0, 'ALEX RODRIGUES RIBEIRO', 'Confirmada', 'KENIA'),
(20, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-11\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"50\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"20\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"8\",\"codENome\":\"04 - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"299.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"299.00\",\"valTotal\":\"299.00\"},{\"id\":\"53\",\"codENome\":\"1301 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"199.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"199.00\",\"valTotal\":\"199.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"440.00\",\"valor_Total_produtos\":\"498.00\",\"valor_liquido\":\"440.00\",\"desconto\":\"58.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"+0.25\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"26mm\",\"esferico_oe_longe\":\"+0.25\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"26mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-22', 498, 0, 'HEITOR LORENZO BORGES', 'Confirmada', 'KENIA'),
(21, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-18\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"51\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"54\",\"codENome\":\"1813 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"180.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"180.00\",\"valTotal\":\"180.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"390.00\",\"valor_Total_produtos\":\"470.00\",\"valor_liquido\":\"390.00\",\"desconto\":\"80.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"17.02\",\"porcen_acrescimno\":\"0.00\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"+025\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"5\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"27.7mm\",\"esferico_oe_longe\":\"+0.25\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"60\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"29.5mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-11', 470, 0, 'PEDRO EMANUEL P SANTOS', 'Confirmada', 'KENIA'),
(22, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-18\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"52\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"22\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"55\",\"codENome\":\"6629 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"180.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"180.00\",\"valTotal\":\"180.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"420.00\",\"valor_Total_produtos\":\"470.00\",\"valor_liquido\":\"420.00\",\"desconto\":\"50.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"+025\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"175\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"27.50mm\",\"esferico_oe_longe\":\"+025\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"10\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"27.50mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 470, 0, 'ALEXANDRE  R  VENANCIO', 'Confirmada', 'KENIA'),
(23, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-18\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"53\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"23\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"56\",\"codENome\":\"2733 - GUESS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1200.00\",\"valor_Total_produtos\":\"1347.00\",\"valor_liquido\":\"1200.00\",\"desconto\":\"147.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 2.25\",\"esferico_od_longe\":\"+0.50\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"25mm\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"+025\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"150\\u00b0\",\"altura_oe_longe\":\"25mm\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"+2,75\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+27,25\",\"cilindrico_oe_perto\":\"-0,25\",\"eixo_oe_perto\":\"150\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-19', 1347, 0, 'MARCILENE DA SILVA', 'Confirmada', 'KENIA'),
(24, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-18\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"54\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"24\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"13\",\"codENome\":\"VIZZANO OURO AV234VZT - VIZZANO\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"58\",\"codENome\":\"MULTIFOCAL PLUS INCOLOR - LENTE\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":\"192.0\",\"tipo_pagamento\":\"192.0\",\"qtde_parcelas\":\"3\",\"subTotal_Cliente\":\"577.00\",\"valor_Total_produtos\":\"769.00\",\"valor_liquido\":\"769.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"    3.00\",\"esferico_od_longe\":\"+075\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"95\\u00b0\",\"altura_od_longe\":\"22mm\",\"dnp_od_longe\":\"30.5mm\",\"esferico_oe_longe\":\"+100\",\"cilindrico_oe_longe\":\"-1.50\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"22mm\",\"dnp_oe_longe\":\"30.5mm\",\"esferico_od_perto\":\"+78,00\",\"cilindrico_od_perto\":\"-1,50\",\"eixo_od_perto\":\"95\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+103,00\",\"cilindrico_oe_perto\":\"-1,50\",\"eixo_oe_perto\":\"90\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-07', 769, 192, 'MARIA DAS GRAÇAS BATISTA', 'Confirmada', 'KENIA'),
(25, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-18\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"55\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"25\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"59\",\"codENome\":\"11050 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"90.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"90.00\",\"valTotal\":\"90.00\"},{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"610.00\",\"valor_Total_produtos\":\"730.00\",\"valor_liquido\":\"610.00\",\"desconto\":\"120.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 2.25\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"-1.25\",\"eixo_od_longe\":\"5\\u00b0\",\"altura_od_longe\":\"31mm\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"-025\",\"cilindrico_oe_longe\":\"-1.25\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"31mm\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"+2,00\",\"cilindrico_od_perto\":\"-1,25\",\"eixo_od_perto\":\"5\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"-22,75\",\"cilindrico_oe_perto\":\"-1,25\",\"eixo_oe_perto\":\"180\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-17', 730, 0, 'MARIA APARECIDA SILVA', 'Confirmada', 'KENIA'),
(26, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"56\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"26\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"61\",\"codENome\":\"3031 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"500.00\",\"valor_Total_produtos\":\"579.00\",\"valor_liquido\":\"500.00\",\"desconto\":\"79.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"DR HAILTON\",\"adicao\":\" \",\"esferico_od_longe\":\"-2.00\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"90\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-2.50\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"31mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-25', 579, 0, 'JALILE MARIA DE LIMA', 'Confirmada', 'KENIA');
INSERT INTO `ordem_servico` (`id`, `obj`, `data_criacao`, `valor_total`, `entrada_cliente`, `nome_cliente`, `status`, `nome_func`) VALUES
(27, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"57\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"62\",\"codENome\":\"MONOFOCAL FILTRO AZUL + FOTO - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"550.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"550.00\",\"valTotal\":\"550.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"550.00\",\"valor_Total_produtos\":\"550.00\",\"valor_liquido\":\"550.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"++0.25\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"26mm\",\"esferico_oe_longe\":\"+0.25\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"26mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-18', 550, 0, 'NICOLLAS GABRIEL MEDEIROS', 'Aberto', 'KENIA'),
(28, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"58\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"-128.00\",\"valUnLiq\":\"840.00\",\"valTotal\":\"840.00\"},{\"id\":\"27\",\"codENome\":\"MARRY MARRY MY6325VZT - MARRY MARRY\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1129.00\",\"valor_Total_produtos\":\"1129.00\",\"valor_liquido\":\"1129.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.75\",\"esferico_od_longe\":\"-2.50\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"105\\u00b0\",\"altura_od_longe\":\"29mm\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-2.25\",\"cilindrico_oe_longe\":\"+0.75\",\"eixo_oe_longe\":\"55\\u00b0\",\"altura_oe_longe\":\"29mm\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"-0,75\",\"cilindrico_od_perto\":\"-0,25\",\"eixo_od_perto\":\"105\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"-0,50\",\"cilindrico_oe_perto\":\"+0,75\",\"eixo_oe_perto\":\"55\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-18', 1129, 0, 'GLEIBE DOS SANTOS MACIEL', 'Confirmada', 'KENIA'),
(29, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"59\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"29\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"64\",\"codENome\":\"2716 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o D\\u00e9bito\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1100.00\",\"valor_Total_produtos\":\"1257.00\",\"valor_liquido\":\"1100.00\",\"desconto\":\"157.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 3.00\",\"esferico_od_longe\":\"+1.50\",\"cilindrico_od_longe\":\"-1.25\",\"eixo_od_longe\":\"90\\u00b0\",\"altura_od_longe\":\"31mm\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"+1.50\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"120\\u00b0\",\"altura_oe_longe\":\"31mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"+4,50\",\"cilindrico_od_perto\":\"-1,25\",\"eixo_od_perto\":\"90\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+4,50\",\"cilindrico_oe_perto\":\"-1,00\",\"eixo_oe_perto\":\"120\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-25', 1257, 0, 'MARIA APARECIDA DA SILVA', 'Confirmada', 'KENIA'),
(30, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"60\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"65\",\"codENome\":\"MR100 - MORENA ROSA\",\"qtde\":1,\"valUnit\":\"500.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"500.00\",\"valTotal\":\"500.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"500.00\",\"valor_Total_produtos\":\"500.00\",\"valor_liquido\":\"500.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"125\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-18', 500, 0, 'MARIA GLAUCIENE BATISTA DOS  SANTOS', 'Confirmada', 'KENIA'),
(31, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"61\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"290.00\",\"valor_Total_produtos\":\"290.00\",\"valor_liquido\":\"290.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-1.25\",\"cilindrico_od_longe\":\"-0.75\",\"eixo_od_longe\":\"120\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31.5mm\",\"esferico_oe_longe\":\"-2.25\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"31.5mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-18', 290, 0, 'JESSICA ALMEIDA SANTOS', 'Confirmada', 'KENIA'),
(32, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-02\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"62\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"66\",\"codENome\":\"VS3148 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"300.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"300.00\",\"valTotal\":\"300.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Boleto\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"829.00\",\"valor_Total_produtos\":\"1268.00\",\"valor_liquido\":\"829.00\",\"desconto\":\"439.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"34.62\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"3.00\",\"esferico_od_longe\":\"++2.00\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"85\\u00b0\",\"altura_od_longe\":\"25mm\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"++1.50\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"25mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,50\",\"eixo_od_perto\":\"85\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-0,50\",\"eixo_oe_perto\":\"90\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-25', 1268, 0, 'OLIVEIRA  NUNES DA SILVA', 'Confirmada', 'KENIA'),
(33, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-02\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"63\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"33\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"67\",\"codENome\":\"AV345 - VIZZANO\",\"qtde\":1,\"valUnit\":\"395.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"395.00\",\"valTotal\":\"395.00\"},{\"id\":\"68\",\"codENome\":\"MONOFOCAL FOTO - MONOFOCAL FOTO\",\"qtde\":1,\"valUnit\":\"490.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"490.00\",\"valTotal\":\"490.00\"}],\"valor_entrada_cliente\":\"200.000\",\"tipo_pagamento\":\"Dinheiro\",\"qtde_parcelas\":\"3\",\"subTotal_Cliente\":\"660.00\",\"valor_Total_produtos\":\"885.00\",\"valor_liquido\":\"860.00\",\"desconto\":\"25.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"2.82\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"-2.50\",\"cilindrico_od_longe\":\"-2.50\",\"eixo_od_longe\":\"170\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"-3.50\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"30\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-02', 885, 200, 'MARIA DOS R. CARLOS', 'Confirmada', 'KENIA'),
(34, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-02\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"64\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"69\",\"codENome\":\"SL8018 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"100.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"679.00\",\"valor_Total_produtos\":\"679.00\",\"valor_liquido\":\"679.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-3.75\",\"cilindrico_od_longe\":\"-1.75\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"34mm\",\"esferico_oe_longe\":\"-3.50\",\"cilindrico_oe_longe\":\"-2.00\",\"eixo_oe_longe\":\"165\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-25', 679, 0, 'LILIA A DE ALMEIDA', 'Confirmada', 'KENIA'),
(35, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-25\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"65\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"35\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"51\",\"codENome\":\"LENTE MONOFOCAl COM FOTO - MONOFOCAL COM FOTO\",\"qtde\":1,\"valUnit\":\"399.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"399.00\",\"valTotal\":\"399.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"350.00\",\"valor_Total_produtos\":\"390.00\",\"valor_liquido\":\"350.00\",\"desconto\":\"40.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"+0.25\",\"cilindrico_od_longe\":\"-1.25\",\"eixo_od_longe\":\"95\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"29mm\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"105\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"31mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-02', 390, 0, 'YURI CAIXETA SOARES', 'Confirmada', 'KENIA'),
(36, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-02\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"66\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"36\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"70\",\"codENome\":\"AV123 - VIZZANO\",\"qtde\":1,\"valUnit\":\"395.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"395.00\",\"valTotal\":\"395.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":\"600\",\"tipo_pagamento\":\"Boleto\",\"qtde_parcelas\":\"2\",\"subTotal_Cliente\":\"500.00\",\"valor_Total_produtos\":\"1363.00\",\"valor_liquido\":\"1100.00\",\"desconto\":\"263.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"    2.75\",\"esferico_od_longe\":\"+0.50\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"60\\u00b0\",\"altura_od_longe\":\"28mm\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"+0.50\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"165\\u00b0\",\"altura_oe_longe\":\"28mm\",\"dnp_oe_longe\":\"31mm\",\"esferico_od_perto\":\"+3,25\",\"cilindrico_od_perto\":\"-0,25\",\"eixo_od_perto\":\"60\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+3,25\",\"cilindrico_oe_perto\":\"-1,00\",\"eixo_oe_perto\":\"165\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-07', 1363, 600, 'MARIA DE LOURDES DOS SANTOS', 'Confirmada', 'KENIA'),
(37, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-02\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"67\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"71\",\"codENome\":\"GZ3056 - GRAZI\",\"qtde\":1,\"valUnit\":\"280.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"280.00\",\"valTotal\":\"280.00\"},{\"id\":\"58\",\"codENome\":\"MULTIFOCAL PLUS INCOLOR - LENTE\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"600.00\",\"valor_Total_produtos\":\"670.00\",\"valor_liquido\":\"600.00\",\"desconto\":\"70.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"10.45\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.75\",\"esferico_od_longe\":\"+100\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"90\\u00b0\",\"altura_od_longe\":\"23mm\",\"dnp_od_longe\":\"29mm\",\"esferico_oe_longe\":\"+0.75\",\"cilindrico_oe_longe\":\"+0.75\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"23mm\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"+101,75\",\"cilindrico_od_perto\":\"-0,50\",\"eixo_od_perto\":\"90\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,50\",\"cilindrico_oe_perto\":\"+0,75\",\"eixo_oe_perto\":\"90\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-25', 670, 0, 'EUNICE P DE ANDRADE ', 'Confirmada', 'KENIA'),
(38, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-11-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"68\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"72\",\"codENome\":\"VICTORIA SECRETS - VICTORIA SECRETS\",\"qtde\":1,\"valUnit\":\"150.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"150.00\",\"valTotal\":\"150.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"150.00\",\"valor_Total_produtos\":\"150.00\",\"valor_liquido\":\"150.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-11-30', 150, 0, 'NATHALIA CAROLINE', 'Confirmada', 'KENIA'),
(39, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-09\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"58\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"39\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"73\",\"codENome\":\"MONOFOCAL G15 - MONOFOCAL G15\",\"qtde\":1,\"valUnit\":\"189.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"189.00\",\"valTotal\":\"189.00\"},{\"id\":\"74\",\"codENome\":\"3041 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"430.00\",\"valor_Total_produtos\":\"478.00\",\"valor_liquido\":\"430.00\",\"desconto\":\"48.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"-2.00\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"105\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-2.25\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"55\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 478, 0, 'GLEIBE DOS SANTOS MACIEL', 'Confirmada', 'KENIA'),
(40, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-09\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"69\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"40\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"77\",\"codENome\":\"MULTIFOCAL HD BLOCK BLUE - MULTIFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"900.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"900.00\",\"valTotal\":\"900.00\"},{\"id\":\"75\",\"codENome\":\"SL8011 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"76\",\"codENome\":\"RB2195 - \\u00d3CULOS SOLAR\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"},{\"id\":\"73\",\"codENome\":\"MONOFOCAL G15 - MONOFOCAL G15\",\"qtde\":1,\"valUnit\":\"189.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"189.00\",\"valTotal\":\"189.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1590.00\",\"valor_Total_produtos\":\"1768.00\",\"valor_liquido\":\"1590.00\",\"desconto\":\"178.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 1.75\",\"esferico_od_longe\":\"-0.75\",\"cilindrico_od_longe\":\"-2.50\",\"eixo_od_longe\":\"115\\u00b0\",\"altura_od_longe\":\"29mm\",\"dnp_od_longe\":\"30.5mm\",\"esferico_oe_longe\":\"-0.50\",\"cilindrico_oe_longe\":\"-3.00\",\"eixo_oe_longe\":\"75\\u00b0\",\"altura_oe_longe\":\"20mm\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"+1,00\",\"cilindrico_od_perto\":\"-2,50\",\"eixo_od_perto\":\"115\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+1,25\",\"cilindrico_oe_perto\":\"-3,00\",\"eixo_oe_perto\":\"75\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-13', 1768, 0, 'SONIA ALVES CAIXETA DINIZ ', 'Confirmada', 'KENIA'),
(42, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-09\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"71\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"42\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"68\",\"codENome\":\"MONOFOCAL FOTO - MONOFOCAL FOTO\",\"qtde\":1,\"valUnit\":\"490.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"490.00\",\"valTotal\":\"490.00\"},{\"id\":\"79\",\"codENome\":\"SH2756 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"200.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"200.00\",\"valTotal\":\"200.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"580.00\",\"valor_Total_produtos\":\"590.00\",\"valor_liquido\":\"580.00\",\"desconto\":\"10.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-0.75\",\"eixo_od_longe\":\"120\\u00b0\",\"altura_od_longe\":\"29mm\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"60\\u00b0\",\"altura_oe_longe\":\"30mm\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-09', 590, 0, 'KARINE DE OLIVEIRA COSTA', 'Confirmada', 'KENIA'),
(43, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-09\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"73\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"81\",\"codENome\":\"SH2663 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"200.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"200.00\",\"valTotal\":\"200.00\"},{\"id\":\"80\",\"codENome\":\"M2072 - DACCS\",\"qtde\":1,\"valUnit\":\"200.00\",\"acresOuDesc\":\"70.00\",\"valUnLiq\":\"270.00\",\"valTotal\":\"270.00\"},{\"id\":\"6\",\"codENome\":\"02 - MONOFOCAL + AR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"660.00\",\"valor_Total_produtos\":\"660.00\",\"valor_liquido\":\"660.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-2.50\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"10\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"-0.75\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"5\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-02', 660, 0, 'NATALIA DAMAS DE  JESUS', 'Confirmada', 'KENIA'),
(44, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-02\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"72\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"82\",\"codENome\":\"LENTE LC - L.C\",\"qtde\":\"2\",\"valUnit\":\"350.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"350.00\",\"valTotal\":\"700.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"700.00\",\"valor_Total_produtos\":\"700.00\",\"valor_liquido\":\"700.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-4.50\",\"cilindrico_od_longe\":\"-3.00\",\"eixo_od_longe\":\"5\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"-1.50\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"5\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-02', 700, 0, 'POLLYANA DAMAS DOS REIS', 'Confirmada', 'KENIA'),
(45, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-09\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"74\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"2\",\"codENome\":\"LENTE - MONOFOCAL INCOLOR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"190.00\",\"valor_Total_produtos\":\"190.00\",\"valor_liquido\":\"190.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"+3.25\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+3.25\",\"cilindrico_oe_perto\":\"+1.00\",\"eixo_oe_perto\":\"105\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-02', 190, 0, 'MAURICIO MENDES DA FONSECA', 'Confirmada', 'KENIA'),
(46, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"75\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"172\",\"codENome\":\"VO5222 - VOGUE\",\"qtde\":1,\"valUnit\":\"370.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"370.00\",\"valTotal\":\"370.00\"},{\"id\":\"173\",\"codENome\":\"MONOFOCal AR BLOCK BLUE - MONOFOCAL AR BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"420.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"420.00\",\"valTotal\":\"420.00\"},{\"id\":\"73\",\"codENome\":\"MONOFOCAL G15 - MONOFOCAL G15\",\"qtde\":1,\"valUnit\":\"189.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"189.00\",\"valTotal\":\"189.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"880.00\",\"valor_Total_produtos\":\"979.00\",\"valor_liquido\":\"880.00\",\"desconto\":\"99.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"10.11\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-3.00\",\"cilindrico_od_longe\":\"-0.75\",\"eixo_od_longe\":\"175\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"29mm\",\"esferico_oe_longe\":\"-3.00\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"172\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"29mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-05', 979, 0, 'JULIA FRAGA BELEZE', 'Confirmada', 'KENIA'),
(47, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"76\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"47\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"127\",\"codENome\":\"HC0204 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1200.00\",\"valor_Total_produtos\":\"1347.00\",\"valor_liquido\":\"1200.00\",\"desconto\":\"147.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"  1.50\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"24\",\"dnp_od_longe\":\"34\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"24\",\"dnp_oe_longe\":\"34\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-16', 1347, 0, 'RODRIGO ALEX PEREIRA ', 'Confirmada', 'KENIA'),
(48, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"77\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"186\",\"codENome\":\"MG3735 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"8\",\"codENome\":\"04 - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"299.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"299.00\",\"valTotal\":\"299.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"615.00\",\"valor_Total_produtos\":\"678.00\",\"valor_liquido\":\"615.00\",\"desconto\":\"63.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"9.29\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"+0.50\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"+0.25\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"31mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 678, 0, 'THAIS MONIELLE ALVES', 'Confirmada', 'KENIA'),
(49, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"78\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"335\",\"codENome\":\"SH2829 - VERSATTE\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"800.00\",\"valor_Total_produtos\":\"929.00\",\"valor_liquido\":\"800.00\",\"desconto\":\"129.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"13.89\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.75\",\"esferico_od_longe\":\"+0.75\",\"cilindrico_od_longe\":\"-0.75\",\"eixo_od_longe\":\"30\\u00b0\",\"altura_od_longe\":\"23mm\",\"dnp_od_longe\":\"35mm\",\"esferico_oe_longe\":\"+0.50\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"23mm\",\"dnp_oe_longe\":\"35mm\",\"esferico_od_perto\":\"+2,50\",\"cilindrico_od_perto\":\"-0,75\",\"eixo_od_perto\":\"30\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,25\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 929, 0, 'GILNEI ALVES DE MELO', 'Confirmada', 'KENIA'),
(50, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"79\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"191\",\"codENome\":\"MG6191 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"965.00\",\"valor_Total_produtos\":\"1019.00\",\"valor_liquido\":\"965.00\",\"desconto\":\"54.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"5.30\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.50\",\"esferico_od_longe\":\"-2.25\",\"cilindrico_od_longe\":\"+0.50\",\"eixo_od_longe\":\"95\\u00b0\",\"altura_od_longe\":\"30mm\",\"dnp_od_longe\":\"29.5mm\",\"esferico_oe_longe\":\"-2.25\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"77\\u00b0\",\"altura_oe_longe\":\"30mm\",\"dnp_oe_longe\":\"29.50mm\",\"esferico_od_perto\":\"-0,75\",\"cilindrico_od_perto\":\"+0,50\",\"eixo_od_perto\":\"95\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"-0,75\",\"cilindrico_oe_perto\":\"-0,50\",\"eixo_oe_perto\":\"77\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 1019, 0, 'MARA DOS PASSOS LANDIM', 'Confirmada', 'KENIA'),
(51, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"80\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"2\",\"codENome\":\"LENTE - MONOFOCAL INCOLOR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"100.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"290.00\",\"valor_Total_produtos\":\"290.00\",\"valor_liquido\":\"290.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.25\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"160\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"50\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"31mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 290, 0, 'JANNIFFER M DE SOUZA', 'Confirmada', 'KENIA');
INSERT INTO `ordem_servico` (`id`, `obj`, `data_criacao`, `valor_total`, `entrada_cliente`, `nome_cliente`, `status`, `nome_func`) VALUES
(52, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"81\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"83\",\"codENome\":\"KBT98196 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"965.00\",\"valor_Total_produtos\":\"1019.00\",\"valor_liquido\":\"965.00\",\"desconto\":\"54.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"5.30\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.75\",\"esferico_od_longe\":\"+100\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"15\\u00b0\",\"altura_od_longe\":\"28mm\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"+0.75\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"30\\u00b0\",\"altura_oe_longe\":\"28mm\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"+101,75\",\"cilindrico_od_perto\":\"-0,25\",\"eixo_od_perto\":\"15\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,50\",\"cilindrico_oe_perto\":\"-0,50\",\"eixo_oe_perto\":\"30\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 1019, 0, 'PAULIANA MACHADO', 'Confirmada', 'KENIA'),
(53, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"82\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"226\",\"codENome\":\"3035 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1168.00\",\"valor_Total_produtos\":\"1257.00\",\"valor_liquido\":\"1168.00\",\"desconto\":\"89.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"7.08\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.25\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-2.75\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"28mm\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"10\\u00b0\",\"altura_oe_longe\":\"28mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-2,75\",\"eixo_od_perto\":\"180\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,00\",\"cilindrico_oe_perto\":\"-1,00\",\"eixo_oe_perto\":\"10\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 1257, 0, 'GERALDA CRUZEIRO DOS SANTOS', 'Confirmada', 'KENIA'),
(54, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"83\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"185\",\"codENome\":\"OURO 169 - VIZZANO\",\"qtde\":1,\"valUnit\":\"395.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"395.00\",\"valTotal\":\"395.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1344.00\",\"valor_Total_produtos\":\"1363.00\",\"valor_liquido\":\"1344.00\",\"desconto\":\"19.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"1.39\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.25\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-2.00\",\"eixo_od_longe\":\"90\\u00b0\",\"altura_od_longe\":\"26mm\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"85\\u00b0\",\"altura_oe_longe\":\"26mm\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-2,00\",\"eixo_od_perto\":\"90\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-1,00\",\"eixo_oe_perto\":\"85\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-08', 1363, 0, 'EDNA MARIA FERREIRA', 'Confirmada', 'KENIA'),
(55, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-16\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"84\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"55\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"243\",\"codENome\":\"H5539 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"600.00\",\"valor_Total_produtos\":\"669.00\",\"valor_liquido\":\"600.00\",\"desconto\":\"69.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"+025\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"115\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"+0.25\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"10\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-15', 669, 0, 'ALESSANDRA DE F. CORREA', 'Confirmada', 'KENIA'),
(56, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-09\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"85\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"446\",\"codENome\":\"LENTE ESFERIC - LENTE ESFERICA -2,50\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Pix\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"190.00\",\"valor_Total_produtos\":\"190.00\",\"valor_liquido\":\"190.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-09', 190, 0, 'MARIA CECILIA', 'Confirmada', 'KENIA'),
(57, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-23\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"86\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"57\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"58\",\"codENome\":\"MULTIFOCAL PLUS INCOLOR - LENTE\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"350.00\",\"valor_Total_produtos\":\"390.00\",\"valor_liquido\":\"350.00\",\"desconto\":\"40.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 1.75\",\"esferico_od_longe\":\"+1.00\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"115\\u00b0\",\"altura_od_longe\":\"29mm\",\"dnp_od_longe\":\"32mm\",\"esferico_oe_longe\":\"+1.00\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"29mm\",\"dnp_oe_longe\":\"34mm\",\"esferico_od_perto\":\"+2,75\",\"cilindrico_od_perto\":\"-1,50\",\"eixo_od_perto\":\"115\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,75\",\"cilindrico_oe_perto\":\"-0,25\",\"eixo_oe_perto\":\"90\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-13', 390, 0, 'SANDRA GONÇALVES', 'Confirmada', 'KENIA'),
(58, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"87\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"58\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"38\",\"codENome\":\"MONOFOCAL + FILTRO AZUL 1.61 - LENTE\",\"qtde\":1,\"valUnit\":\"550.00\",\"acresOuDesc\":\"150.00\",\"valUnLiq\":\"700.000\",\"valTotal\":\"700.00\"},{\"id\":\"82\",\"codENome\":\"LENTE LC - L.C\",\"qtde\":1,\"valUnit\":\"350.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"350.00\",\"valTotal\":\"350.00\"},{\"id\":\"82\",\"codENome\":\"LENTE LC - L.C\",\"qtde\":1,\"valUnit\":\"350.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"350.00\",\"valTotal\":\"350.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1400.00\",\"valor_Total_produtos\":\"1400.00\",\"valor_liquido\":\"1400.00\",\"desconto\":\"\",\"acrescimo\":\"0.00\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"0.00\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"  \",\"esferico_od_longe\":\"-2.00\",\"cilindrico_od_longe\":\"-3.00\",\"eixo_od_longe\":\"5\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32mm\",\"esferico_oe_longe\":\"-1.50\",\"cilindrico_oe_longe\":\"-4.00\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-13', 1400, 0, 'SCARLET  ALVES FROIS', 'Confirmada', 'KENIA'),
(59, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-23\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"88\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"222\",\"codENome\":\"MG6190 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"624.00\",\"valor_Total_produtos\":\"669.00\",\"valor_liquido\":\"624.00\",\"desconto\":\"45.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"6.73\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-1.00\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-1.00\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-15', 669, 0, 'LUDENIA P LOPES', 'Confirmada', 'KENIA'),
(60, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-23\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"89\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"60\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"16\",\"codENome\":\"TOMMY HILFIGER TH1282VZT - TOMMY HILFIGER\",\"qtde\":1,\"valUnit\":\"998.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"998.00\",\"valTotal\":\"998.00\"},{\"id\":\"447\",\"codENome\":\"LENTE POLY - POLY COM FOTO SEM AR\",\"qtde\":1,\"valUnit\":\"1140.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"1140.00\",\"valTotal\":\"1140.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1400.00\",\"valor_Total_produtos\":\"1640.00\",\"valor_liquido\":\"1400.00\",\"desconto\":\"240.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"-9.00\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-10.00\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-24', 1640, 0, 'ANTONIO LUIZ DOS SANTOS', 'Confirmada', 'KENIA'),
(61, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-23\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"90\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"61\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"800.00\",\"valor_Total_produtos\":\"968.00\",\"valor_liquido\":\"800.00\",\"desconto\":\"168.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 3.00\",\"esferico_od_longe\":\"++1.00\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"105\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"28mm\",\"esferico_oe_longe\":\"++0.50\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"120\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"28mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,25\",\"eixo_od_perto\":\"105\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-0,50\",\"eixo_oe_perto\":\"120\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 968, 0, 'DIVINA R. PIMENTEL ', 'Confirmada', 'KENIA'),
(62, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-23\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"91\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"62\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"250.00\",\"valor_Total_produtos\":\"290.00\",\"valor_liquido\":\"250.00\",\"desconto\":\"40.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"+0.75\",\"cilindrico_od_longe\":\"-1.25\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"+0.75\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"5\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 290, 0, 'IAGO JUNIOR VIDA', 'Confirmada', 'KENIA'),
(63, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"92\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"373\",\"codENome\":\"TR87006 - DACCS\",\"qtde\":1,\"valUnit\":\"90.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"90.00\",\"valTotal\":\"90.00\"},{\"id\":\"77\",\"codENome\":\"MULTIFOCAL HD BLOCK BLUE - MULTIFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"900.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"900.00\",\"valTotal\":\"900.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"990.00\",\"valor_Total_produtos\":\"990.00\",\"valor_liquido\":\"990.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.25\",\"esferico_od_longe\":\"++1.50\",\"cilindrico_od_longe\":\"-0.75\",\"eixo_od_longe\":\"180\\u00b0\",\"altura_od_longe\":\"28mm\",\"dnp_od_longe\":\"29.5mm\",\"esferico_oe_longe\":\"++2.00\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"10\\u00b0\",\"altura_oe_longe\":\"28mm\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,75\",\"eixo_od_perto\":\"180\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-1,00\",\"eixo_oe_perto\":\"10\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-17', 990, 0, 'ANGELITA APARECIDA DOS SANTOS', 'Confirmada', 'KENIA'),
(64, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"93\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"365\",\"codENome\":\"CA25888 - SCUDO\",\"qtde\":1,\"valUnit\":\"179.90\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"179.90\",\"valTotal\":\"179.90\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"469.90\",\"valor_Total_produtos\":\"469.90\",\"valor_liquido\":\"469.90\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"++2.25\",\"cilindrico_od_perto\":\"-0.25\",\"eixo_od_perto\":\"125\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"33mm\",\"esferico_oe_perto\":\"++2.25\",\"cilindrico_oe_perto\":\"-0.25\",\"eixo_oe_perto\":\"130\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"33mm\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-19', 469.9, 0, 'VALDIVINO DE ARAUJO', 'Aberto', 'KENIA'),
(65, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"94\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"65\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"268\",\"codENome\":\"SL80534 53 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"280.00\",\"valor_Total_produtos\":\"289.00\",\"valor_liquido\":\"280.00\",\"desconto\":\"9.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 3.00\",\"esferico_od_longe\":\"++0.50\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"145\\u00b0\",\"altura_od_longe\":\"31mm\",\"dnp_od_longe\":\"32.5mm\",\"esferico_oe_longe\":\"++0.75\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"31mm\",\"dnp_oe_longe\":\"31.5mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,50\",\"eixo_od_perto\":\"145\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-29', 289, 0, 'APARECIDA DE FATIMA ASSUNÇAO', 'Confirmada', 'KENIA'),
(66, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-23\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"95\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"66\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"446\",\"codENome\":\"LENTE ESFERIC - LENTE ESFERICA -2,50\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"},{\"id\":\"446\",\"codENome\":\"LENTE ESFERIC - LENTE ESFERICA -2,50\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"},{\"id\":\"466\",\"codENome\":\"SOLU\\u00c7AO - RENU\",\"qtde\":1,\"valUnit\":\"18.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"18.00\",\"valTotal\":\"18.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"398.00\",\"valor_Total_produtos\":\"398.00\",\"valor_liquido\":\"398.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"0.00\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"   \",\"esferico_od_longe\":\"-2.75\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"-2.00\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 398, 0, 'BRUNA', 'Confirmada', 'KENIA'),
(67, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"96\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"264\",\"codENome\":\"JB3210 - JEAN MONNIER\",\"qtde\":1,\"valUnit\":\"260.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"260.00\",\"valTotal\":\"260.00\"},{\"id\":\"58\",\"codENome\":\"MULTIFOCAL PLUS INCOLOR - LENTE\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"650.00\",\"valor_Total_produtos\":\"650.00\",\"valor_liquido\":\"650.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.75\",\"esferico_od_longe\":\"++0.25\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"90\\u00b0\",\"altura_od_longe\":\"22mm\",\"dnp_od_longe\":\"31.5mm\",\"esferico_oe_longe\":\"++0.25\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"22mm\",\"dnp_oe_longe\":\"33.5mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,50\",\"eixo_od_perto\":\"90\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 650, 0, 'CRISTINA VAZ  DE OLIVEIRA ', 'Confirmada', 'KENIA'),
(68, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"98\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"68\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"451\",\"codENome\":\"M3277 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"51\",\"codENome\":\"LENTE MONOFOCAl COM FOTO - MONOFOCAL COM FOTO\",\"qtde\":1,\"valUnit\":\"399.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"399.00\",\"valTotal\":\"399.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"690.00\",\"valor_Total_produtos\":\"778.00\",\"valor_liquido\":\"690.00\",\"desconto\":\"88.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" \",\"esferico_od_longe\":\"-0.50\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32.5mm\",\"esferico_oe_longe\":\"-0.50\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 778, 0, 'MICHELE DOS SANTOS ARAUJO', 'Confirmada', 'KENIA'),
(69, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"99\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"362\",\"codENome\":\"CLIP ON 5817 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"389.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"389.00\",\"valTotal\":\"389.00\"},{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1019.00\",\"valor_Total_produtos\":\"1029.00\",\"valor_liquido\":\"1019.00\",\"desconto\":\"10.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"0.97\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"1.25\",\"esferico_od_longe\":\"-0.50\",\"cilindrico_od_longe\":\"-O.75\",\"eixo_od_longe\":\"10\\u00b0\",\"altura_od_longe\":\"23mm\",\"dnp_od_longe\":\"32.5mm\",\"esferico_oe_longe\":\"-1.50\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"40\\u00b0\",\"altura_oe_longe\":\"23mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"+0,75\",\"cilindrico_od_perto\":\"NaN\",\"eixo_od_perto\":\"10\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"-0,25\",\"cilindrico_oe_perto\":\"-0,25\",\"eixo_oe_perto\":\"40\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 1029, 0, 'WILLIAN FERNANDES  DE SOUZA ', 'Confirmada', 'KENIA'),
(70, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"100\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"399\",\"codENome\":\"OURO 145 - VIZZANO\",\"qtde\":1,\"valUnit\":\"395.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"395.00\",\"valTotal\":\"395.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"600.00\",\"valor_Total_produtos\":\"685.00\",\"valor_liquido\":\"600.00\",\"desconto\":\"85.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"12.41\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"10\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"29.5mm\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"5\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"30.5mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 685, 0, 'YASMIN APARECIDA G DE JESUS ', 'Confirmada', 'KENIA'),
(71, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"94\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"71\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"88\",\"codENome\":\"VO5188 - VOGUE\",\"qtde\":1,\"valUnit\":\"315.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"315.00\",\"valTotal\":\"315.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"280.00\",\"valor_Total_produtos\":\"315.00\",\"valor_liquido\":\"280.00\",\"desconto\":\"35.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 3.00\",\"esferico_od_longe\":\"++0.50\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"145\\u00b0\",\"altura_od_longe\":\"31mm\",\"dnp_od_longe\":\"32.5mm\",\"esferico_oe_longe\":\"++0.75\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"31mm\",\"dnp_oe_longe\":\"31.5mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,50\",\"eixo_od_perto\":\"145\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-29', 315, 0, 'APARECIDA DE FATIMA ASSUNÇAO', 'Confirmada', 'KENIA'),
(72, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"102\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"459\",\"codENome\":\"P8513 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1000.00\",\"valor_Total_produtos\":\"1347.00\",\"valor_liquido\":\"1000.00\",\"desconto\":\"347.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"25.76\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.75\",\"esferico_od_longe\":\"+2.00\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"80\\u00b0\",\"altura_od_longe\":\"27mm\",\"dnp_od_longe\":\"31.5mm\",\"esferico_oe_longe\":\"+2.00\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"105\\u00b0\",\"altura_oe_longe\":\"27mm\",\"dnp_oe_longe\":\"32.5mm\",\"esferico_od_perto\":\"+4,75\",\"cilindrico_od_perto\":\"-0,25\",\"eixo_od_perto\":\"80\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+4,75\",\"cilindrico_oe_perto\":\"-0,50\",\"eixo_oe_perto\":\"105\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 1347, 0, 'EDGARD DOS REIS DA FONSECA', 'Confirmada', 'KENIA'),
(73, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"103\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"73\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"14\",\"codENome\":\"VIZZANO OURO AV345VZT - VIZZANO\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"58\",\"codENome\":\"MULTIFOCAL PLUS INCOLOR - LENTE\",\"qtde\":1,\"valUnit\":\"390.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"390.00\",\"valTotal\":\"390.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"700.00\",\"valor_Total_produtos\":\"769.00\",\"valor_liquido\":\"700.00\",\"desconto\":\"69.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"0.00\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"  3.00\",\"esferico_od_longe\":\"-1.75\",\"cilindrico_od_longe\":\"-1.75\",\"eixo_od_longe\":\"160\\u00b0\",\"altura_od_longe\":\"25mm\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"++1.00\",\"cilindrico_oe_longe\":\"-2.75\",\"eixo_oe_longe\":\"170\\u00b0\",\"altura_oe_longe\":\"25mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"+1,25\",\"cilindrico_od_perto\":\"-1,75\",\"eixo_od_perto\":\"160\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-2,75\",\"eixo_oe_perto\":\"170\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-03', 769, 0, 'ANA DA CONSOLACAO FONSECA', 'Confirmada', 'KENIA'),
(74, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"104\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"463\",\"codENome\":\"F76252 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"-54.00\",\"valUnLiq\":\"325.00\",\"valTotal\":\"325.00\"},{\"id\":\"173\",\"codENome\":\"MONOFOCal AR BLOCK BLUE - MONOFOCAL AR BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"420.00\",\"acresOuDesc\":\"-130.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"},{\"id\":\"82\",\"codENome\":\"LENTE LC - L.C\",\"qtde\":1,\"valUnit\":\"350.00\",\"acresOuDesc\":\"-280.00\",\"valUnLiq\":\"70.00\",\"valTotal\":\"70.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"620.00\",\"valor_Total_produtos\":\"685.00\",\"valor_liquido\":\"620.00\",\"desconto\":\"65.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"9.49\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-0.50\",\"cilindrico_od_longe\":\"-2.00\",\"eixo_od_longe\":\"92\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-1.25\",\"eixo_oe_longe\":\"70\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 685, 0, 'MONIELLE SILVA FREITAS', 'Confirmada', 'KENIA'),
(75, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-30\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"101\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"100.00\",\"valUnLiq\":\"740.00\",\"valTotal\":\"740.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"740.00\",\"valor_Total_produtos\":\"740.00\",\"valor_liquido\":\"740.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.25\",\"esferico_od_longe\":\"-1.00\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"27mm\",\"dnp_od_longe\":\"34.5mm\",\"esferico_oe_longe\":\"-2.00\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"140\\u00b0\",\"altura_oe_longe\":\"27mm\",\"dnp_oe_longe\":\"33.5mm\",\"esferico_od_perto\":\"+1,25\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+0,25\",\"cilindrico_oe_perto\":\"-0,75\",\"eixo_oe_perto\":\"140\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-23', 740, 0, 'MARTA TEREZINHA RIBEIRO', 'Confirmada', 'KENIA');
INSERT INTO `ordem_servico` (`id`, `obj`, `data_criacao`, `valor_total`, `entrada_cliente`, `nome_cliente`, `status`, `nome_func`) VALUES
(76, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-06\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"105\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"184\",\"codENome\":\"OURO 166 - VIZZANO\",\"qtde\":1,\"valUnit\":\"395.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"395.00\",\"valTotal\":\"395.00\"},{\"id\":\"8\",\"codENome\":\"04 - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"299.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"299.00\",\"valTotal\":\"299.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"678.00\",\"valor_Total_produtos\":\"694.00\",\"valor_liquido\":\"678.00\",\"desconto\":\"16.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"2.31\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-3.00\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"33mm\",\"esferico_oe_longe\":\"-2.00\",\"cilindrico_oe_longe\":\"-0.25\",\"eixo_oe_longe\":\"80\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"34mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-29', 694, 0, 'MARIA GABRIELLE PEREIRA ', 'Confirmada', 'KENIA'),
(77, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-06\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"106\",\"func_dados_princ\":\"30\",\"id_ordem_servico\":\"77\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"128\",\"codENome\":\"HC0101 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"0\",\"qtde_parcelas\":\"0\",\"subTotal_Cliente\":\"1200.00\",\"valor_Total_produtos\":\"1347.00\",\"valor_liquido\":\"1200.00\",\"desconto\":\"147.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\" 3.00\",\"esferico_od_longe\":\"++1.50\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"105\\u00b0\",\"altura_od_longe\":\"26mm\",\"dnp_od_longe\":\"32mm\",\"esferico_oe_longe\":\"++2.25\",\"cilindrico_oe_longe\":\"-1.50\",\"eixo_oe_longe\":\"40\\u00b0\",\"altura_oe_longe\":\"26mm\",\"dnp_oe_longe\":\"33m\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-1,50\",\"eixo_od_perto\":\"105\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+5,25\",\"cilindrico_oe_perto\":\"-1,50\",\"eixo_oe_perto\":\"40\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 1347, 0, 'APARICIO DONATO ROSA', 'Confirmada', 'KENIA'),
(78, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-06\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"107\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"204\",\"codENome\":\"3018 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"579.00\",\"valor_Total_produtos\":\"579.00\",\"valor_liquido\":\"579.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"165\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"30.5mm\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"-1.50\",\"eixo_oe_longe\":\"165\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"31mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-29', 579, 0, 'GIOVANNA EDUARDA DE JESUS ', 'Aberto', 'KENIA'),
(79, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-06\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"108\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"66\",\"codENome\":\"VS3148 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"300.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"300.00\",\"valTotal\":\"300.00\"},{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"488.00\",\"valor_Total_produtos\":\"590.00\",\"valor_liquido\":\"488.00\",\"desconto\":\"102.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"17.29\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-1.00\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32mm\",\"esferico_oe_longe\":\"-1.25\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-29', 590, 0, 'GABRIEL P SOUZA', 'Confirmada', 'KENIA'),
(80, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-06\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"109\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"236\",\"codENome\":\"OURO 67 - VIZZANO\",\"qtde\":1,\"valUnit\":\"395.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"395.00\",\"valTotal\":\"395.00\"},{\"id\":\"77\",\"codENome\":\"MULTIFOCAL HD BLOCK BLUE - MULTIFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"900.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"900.00\",\"valTotal\":\"900.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1215.00\",\"valor_Total_produtos\":\"1295.00\",\"valor_liquido\":\"1215.00\",\"desconto\":\"80.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"6.18\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"3.00\",\"esferico_od_longe\":\"++1.50\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"85\\u00b0\",\"altura_od_longe\":\"29mm\",\"dnp_od_longe\":\"29.5mm\",\"esferico_oe_longe\":\"++0.75\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"70\\u00b0\",\"altura_oe_longe\":\"29mm\",\"dnp_oe_longe\":\"30mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,50\",\"eixo_od_perto\":\"85\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"NaN\",\"cilindrico_oe_perto\":\"-0,50\",\"eixo_oe_perto\":\"70\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-29', 1295, 0, 'ELENIR A PACHECO', 'Aberto', 'KENIA'),
(81, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-12-31\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"101\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"223\",\"codENome\":\"TR87012 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"-80.00\",\"valUnLiq\":\"299.00\",\"valTotal\":\"299.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"299.00\",\"valor_Total_produtos\":\"299.00\",\"valor_liquido\":\"299.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2022-12-31', 299, 0, 'MARTA TEREZINHA RIBEIRO', 'Confirmada', 'KENIA'),
(82, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-10\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"110\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"430\",\"codENome\":\"RB4362 - RAY\",\"qtde\":1,\"valUnit\":\"780.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"780.00\",\"valTotal\":\"780.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"600.00\",\"valor_Total_produtos\":\"780.00\",\"valor_liquido\":\"600.00\",\"desconto\":\"180.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"23.08\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-02', 780, 0, 'FRANCINE ', 'Confirmada', 'KENIA'),
(83, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-10\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"110\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"421\",\"codENome\":\"RB3016 - RAY BAN\",\"qtde\":1,\"valUnit\":\"780.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"780.00\",\"valTotal\":\"780.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"560.00\",\"valor_Total_produtos\":\"780.00\",\"valor_liquido\":\"560.00\",\"desconto\":\"220.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"28.21\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-04', 780, 0, 'FRANCINE ', 'Aberto', 'KENIA'),
(84, '{\"dadosPrincipal\":{\"data_entrega\":\"2022-01-05\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"111\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"258\",\"codENome\":\"T579 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"260.00\",\"valor_Total_produtos\":\"289.00\",\"valor_liquido\":\"260.00\",\"desconto\":\"29.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"0.00\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-05', 289, 0, 'EDUARDO ALVES MARTINS ', 'Confirmada', 'KENIA'),
(85, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"112\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"2\",\"codENome\":\"LENTE - MONOFOCAL INCOLOR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"190.00\",\"valor_Total_produtos\":\"190.00\",\"valor_liquido\":\"190.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"++2.25\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"34mm\",\"esferico_oe_perto\":\"++2.25\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"36mm\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 190, 0, 'ADAIR FERREIRA DA SILVA', 'Confirmada', 'KENIA'),
(86, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"114\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"138\",\"codENome\":\"2228 54 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"990.00\",\"valor_Total_produtos\":\"1019.00\",\"valor_liquido\":\"990.00\",\"desconto\":\"29.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"2.85\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"3.00\",\"esferico_od_longe\":\"+4.00\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"+4.50\",\"cilindrico_oe_longe\":\"-1.25\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"+7,00\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+7,50\",\"cilindrico_oe_perto\":\"-1,25\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 1019, 0, 'JOSE DO CARMO ', 'Confirmada', 'KENIA'),
(87, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"113\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"6\",\"codENome\":\"02 - MONOFOCAL + AR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"30.00\",\"valUnLiq\":\"220.00\",\"valTotal\":\"220.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"220.00\",\"valor_Total_produtos\":\"220.00\",\"valor_liquido\":\"220.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"+4.00\",\"cilindrico_od_longe\":\"-0.75\",\"eixo_od_longe\":\"175\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"26mm\",\"esferico_oe_longe\":\"+5.00\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"30\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"27mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 220, 0, 'MARIA ELOA OLIVEIRA ', 'Confirmada', 'KENIA'),
(88, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"115\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"278\",\"codENome\":\"MY6334 - MARRY MARRY\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"481\",\"codENome\":\"MONOFOCAL 1.56 BLOCK SEM AR - MONOFOCAL 1.56 BLOCK SEM AR\",\"qtde\":1,\"valUnit\":\"455.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"455.00\",\"valTotal\":\"455.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"744.00\",\"valor_Total_produtos\":\"744.00\",\"valor_liquido\":\"744.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-4.00\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"5\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32.00mm\",\"esferico_oe_longe\":\"-3.75\",\"cilindrico_oe_longe\":\"-0.75\",\"eixo_oe_longe\":\"170\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"32mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 744, 0, 'CASSIA MARIA DE JESUS ', 'Confirmada', 'KENIA'),
(89, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"116\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"482\",\"codENome\":\"MULTIFOCAL FOTO FLEX - MULTIFOCAL FOTO FLEX\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"640.00\",\"valor_Total_produtos\":\"640.00\",\"valor_liquido\":\"640.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"2.25\",\"esferico_od_longe\":\"+0.25\",\"cilindrico_od_longe\":\"-2.50\",\"eixo_od_longe\":\"55\\u00b0\",\"altura_od_longe\":\"25mm\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"+0.50\",\"cilindrico_oe_longe\":\"-2.00\",\"eixo_oe_longe\":\"170\\u00b0\",\"altura_oe_longe\":\"25mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"+2,50\",\"cilindrico_od_perto\":\"-2,50\",\"eixo_od_perto\":\"55\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,75\",\"cilindrico_oe_perto\":\"-2,00\",\"eixo_oe_perto\":\"170\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 640, 0, 'JOSE PIRES DE OLIVEIRA', 'Confirmada', 'KENIA'),
(90, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"117\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"60\",\"codENome\":\"MULTIFOCAL PLUS - LENTE\",\"qtde\":1,\"valUnit\":\"640.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"640.00\",\"valTotal\":\"640.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"640.00\",\"valor_Total_produtos\":\"640.00\",\"valor_liquido\":\"640.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"3.00\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-0.25\",\"eixo_od_longe\":\"15\\u00b0\",\"altura_od_longe\":\"25mm\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"-0.25\",\"cilindrico_oe_longe\":\"-1.25\",\"eixo_oe_longe\":\"110\\u00b0\",\"altura_oe_longe\":\"25mm\",\"dnp_oe_longe\":\"30.5mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-0,25\",\"eixo_od_perto\":\"15\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+2,75\",\"cilindrico_oe_perto\":\"-1,25\",\"eixo_oe_perto\":\"110\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 640, 0, 'JOSE FRANCISCO DE MORAIS', 'Aberto', 'KENIA'),
(91, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"118\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"345\",\"codENome\":\"HC0510 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"-54.00\",\"valUnLiq\":\"325.00\",\"valTotal\":\"325.00\"},{\"id\":\"43\",\"codENome\":\"MULTIFOCAL PROLIFE HD + FOTO - LENTE\",\"qtde\":1,\"valUnit\":\"968.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"968.00\",\"valTotal\":\"968.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"1293.00\",\"valor_Total_produtos\":\"1293.00\",\"valor_liquido\":\"1293.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"3.00\",\"esferico_od_longe\":\"PL\",\"cilindrico_od_longe\":\"-1.50\",\"eixo_od_longe\":\"100\\u00b0\",\"altura_od_longe\":\"30mm\",\"dnp_od_longe\":\"31mm\",\"esferico_oe_longe\":\"+1.50\",\"cilindrico_oe_longe\":\"-1.00\",\"eixo_oe_longe\":\"50\\u00b0\",\"altura_oe_longe\":\"30mm\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"NaN\",\"cilindrico_od_perto\":\"-1,50\",\"eixo_od_perto\":\"100\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"+4,50\",\"cilindrico_oe_perto\":\"-1,00\",\"eixo_oe_perto\":\"50\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 1293, 0, 'ERASMO C DA ROCHA ', 'Aberto', 'KENIA'),
(92, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"119\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"95\",\"codENome\":\"S11670 C6 - DACCS\",\"qtde\":1,\"valUnit\":\"379.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"379.00\",\"valTotal\":\"379.00\"},{\"id\":\"52\",\"codENome\":\"LENTE MONOFOCAL COM FILTRO AZUL - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"290.00\",\"valTotal\":\"290.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"600.00\",\"valor_Total_produtos\":\"669.00\",\"valor_liquido\":\"600.00\",\"desconto\":\"69.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"10.31\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"+0.75\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"10\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"29mm\",\"esferico_oe_longe\":\"+0.75\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"175\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"29mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 669, 0, 'LAIS MAGELA FERREIRA ', 'Confirmada', 'KENIA'),
(93, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"122\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"483\",\"codENome\":\"LIMPA LENTES - LIMPA LENTES\",\"qtde\":1,\"valUnit\":\"30.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"30.00\",\"valTotal\":\"30.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"30.00\",\"valor_Total_produtos\":\"30.00\",\"valor_liquido\":\"30.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 30, 0, 'FICTICIO', 'Confirmada', 'KENIA'),
(94, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"121\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"402\",\"codENome\":\"VS3044 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"6\",\"codENome\":\"02 - MONOFOCAL + AR\",\"qtde\":1,\"valUnit\":\"190.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"190.00\",\"valTotal\":\"190.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"400.00\",\"valor_Total_produtos\":\"479.00\",\"valor_liquido\":\"400.00\",\"desconto\":\"79.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"16.49\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"\",\"cilindrico_od_longe\":\"\",\"eixo_od_longe\":\"\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"\",\"esferico_oe_longe\":\"\",\"cilindrico_oe_longe\":\"\",\"eixo_oe_longe\":\"\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"\",\"esferico_od_perto\":\"+3.00\",\"cilindrico_od_perto\":\"-1.00\",\"eixo_od_perto\":\"90\\u00b0\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"29mm\",\"esferico_oe_perto\":\"+3.00\",\"cilindrico_oe_perto\":\"+1.50\",\"eixo_oe_perto\":\"100\\u00b0\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"29mm\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 479, 0, 'LAZARA  LUIZA DA SILVA', 'Aberto', 'KENIA'),
(95, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"124\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"4\",\"codENome\":\"PAR - MONOFOCAL BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"290.00\",\"acresOuDesc\":\"-15.00\",\"valUnLiq\":\"275.00\",\"valTotal\":\"275.00\"},{\"id\":\"82\",\"codENome\":\"LENTE LC - L.C\",\"qtde\":1,\"valUnit\":\"350.00\",\"acresOuDesc\":\"-280.00\",\"valUnLiq\":\"70.00\",\"valTotal\":\"70.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"345.00\",\"valor_Total_produtos\":\"345.00\",\"valor_liquido\":\"345.00\",\"desconto\":\"\",\"acrescimo\":\"\",\"porcen_desconto\":\"\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"-2.00\",\"cilindrico_od_longe\":\"-0.50\",\"eixo_od_longe\":\"105\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"32mm\",\"esferico_oe_longe\":\"-2.75\",\"cilindrico_oe_longe\":\"-0.50\",\"eixo_oe_longe\":\"90\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"33.0mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 345, 0, 'LETICIA CAMARGOS ', 'Confirmada', 'KENIA'),
(96, '{\"dadosPrincipal\":{\"data_entrega\":\"2023-01-13\",\"timeZone\":\"America\\/Sao_Paulo\",\"observacao_princ\":\"\",\"cli_dados_princ\":\"111\",\"func_dados_princ\":\"30\"},\"produtos\":{\"produtos_selecionados\":[{\"id\":\"130\",\"codENome\":\"VS3176 - JULIAN FAIET\",\"qtde\":1,\"valUnit\":\"289.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"289.00\",\"valTotal\":\"289.00\"},{\"id\":\"5\",\"codENome\":\"01 - MONOFOCAL + FOTO + BLOCK BLUE\",\"qtde\":1,\"valUnit\":\"595.00\",\"acresOuDesc\":\"0.00\",\"valUnLiq\":\"595.00\",\"valTotal\":\"595.00\"}],\"valor_entrada_cliente\":0,\"tipo_pagamento\":\"Cart\\u00e3o Cr\\u00e9dito\",\"qtde_parcelas\":\"\",\"subTotal_Cliente\":\"680.00\",\"valor_Total_produtos\":\"884.00\",\"valor_liquido\":\"680.00\",\"desconto\":\"204.00\",\"acrescimo\":\"\",\"porcen_desconto\":\"23.08\",\"porcen_acrescimno\":\"\"},\"receita\":{\"profissional_resp\":\"Maicon Lucas Fraga\",\"receita_valida\":\"\",\"observacao\":\"\",\"adicao\":\"\",\"esferico_od_longe\":\"+0.25\",\"cilindrico_od_longe\":\"-2.25\",\"eixo_od_longe\":\"15\\u00b0\",\"altura_od_longe\":\"\",\"dnp_od_longe\":\"30mm\",\"esferico_oe_longe\":\"PL\",\"cilindrico_oe_longe\":\"-2.00\",\"eixo_oe_longe\":\"180\\u00b0\",\"altura_oe_longe\":\"\",\"dnp_oe_longe\":\"33mm\",\"esferico_od_perto\":\"\",\"cilindrico_od_perto\":\"\",\"eixo_od_perto\":\"\",\"altura_od_perto\":\"\",\"dnp_od_perto\":\"\",\"esferico_oe_perto\":\"\",\"cilindrico_oe_perto\":\"\",\"eixo_oe_perto\":\"\",\"altura_oe_perto\":\"\",\"dnp_oe_perto\":\"\"},\"info_add\":{\"laboratorio\":\"Sem laborat\\u00f3rio\",\"info_add_lente\":{\"descricao\":\"\",\"coloracao\":\"\"},\"info_add_armacao\":{\"arm_tipo\":\"Selecione uma op\\u00e7\\u00e3o\",\"arm_aro\":\"\",\"arm_ponte\":\"\",\"arm_aro_ponte\":\"\",\"arm_maior_diagonal\":\"\",\"arm_altura_vertical\":\"\",\"arm_distancia_pupilar\":\"\",\"altura_longe_OD\":\"\",\"altura_longe_OE\":\"\",\"altura_perto_OD\":\"\",\"altura_perto_OE\":\"\"}}}', '2023-01-06', 884, 0, 'EDUARDO ALVES MARTINS ', 'Confirmada', 'KENIA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `estoque` int(11) NOT NULL,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `valor_venda` decimal(10,2) NOT NULL,
  `fornecedores` varchar(25) NOT NULL,
  `categoria` int(11) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `lucro` int(11) DEFAULT NULL,
  `tipoProduto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `descricao`, `estoque`, `valor_compra`, `valor_venda`, `fornecedores`, `categoria`, `foto`, `ativo`, `lucro`, `tipoProduto`) VALUES
(1, 'Y8007', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(2, 'LENTE', 'MONOFOCAL INCOLOR', 'LENTE OFTALMICA', 0, '0.00', '190.00', '', 6, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(3, 'FX3757VZT', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(4, 'PAR', 'MONOFOCAL BLOCK BLUE', 'LENTE OF', 0, '0.00', '290.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(5, '01', 'MONOFOCAL + FOTO + BLOCK BLUE', '', 0, '0.00', '595.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(6, '02', 'MONOFOCAL + AR', '', 0, '0.00', '190.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(7, '03', 'PRADO BR0760VZT', '', 0, '0.00', '90.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(8, '04', 'MONOFOCAL BLOCK BLUE', '', 0, '0.00', '299.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(9, '4005', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(10, '05', 'MULTIFOCAL AR EXTERNO', '', 0, '0.00', '390.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(11, 'L.C.', 'ULTRA', '', 0, '0.00', '70.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(12, 'VIZZANO OURO AV123VZT', 'VIZZANO', 'ARMAÇÃO', 0, '0.00', '379.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(13, 'VIZZANO OURO AV234VZT', 'VIZZANO', 'ARMAÇÃO', 0, '0.00', '379.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(14, 'VIZZANO OURO AV345VZT', 'VIZZANO', 'ARMAÇÃO', 0, '0.00', '379.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(15, 'TOMMY HILFIGER TH1840VZT', 'TOMMY HILFIGER', 'ARMAÇÃO', 0, '0.00', '998.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(16, 'TOMMY HILFIGER TH1282VZT', 'TOMMY HILFIGER', 'ARMAÇÃO', 0, '0.00', '998.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(17, 'TOMMY HILFIGER TH1475VZT', 'TOMMY HILFIGER', 'ARMAÇÃO', 0, '0.00', '998.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(18, 'VERSATTE SH2829VZT', 'VERSATTE', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(19, 'VERSATTE SH2833VZT', 'VERSATTE', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(20, 'VERSATTE SH2831VZT', 'VERSATTE', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(21, 'MARRY MARRY R7841VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(22, 'MARRY MARRY BC003VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(23, 'MARRY MARRY AG98029VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(24, 'MARRY MARRY MY3329VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(25, 'MARRY MARRY MY6327VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(26, 'MARRY MARRY MY8210VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(27, 'MARRY MARRY MY6325VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(28, 'MARRY MARRY MY6334VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(29, 'MARRY MARRY SH2757VZT', 'MARRY MARRY', 'ARMAÇÃO', 0, '0.00', '289.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(30, 'TOMMY JEANS TJ0036VZT', 'TOMMY JEANS', 'ARMAÇÃO', 0, '0.00', '998.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(31, 'CORRENTINHA PARA ÓCULOS', 'CORRENTINHA', 'CORRENTINHA', 0, '0.00', '20.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(32, 'ÓCULOS SOLAR JULIAN FAIET VZT', 'ÓCULOS SOLAR', 'ÓCULOS SOLAR', 0, '0.00', '379.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(33, 'ÓCULOS SOLAR CARRERA 2028VZT', 'ÓCULOS SOLAR', 'ÓCULOS SOLAR', 0, '0.00', '993.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(34, 'ÓCULOS SOLAR CARRERA 260VZT', 'ÓCULOS SOLAR', 'ÓCULOS SOLAR', 0, '0.00', '1026.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(35, 'ÓCULOS SOLAR 277VZT', 'ÓCULOS SOLAR', 'ÓCULOS SOLAR', 0, '0.00', '1044.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(36, 'JULIAN FAIET 5813VZT CLIPPON', 'JULIAN FAIET', 'ARMAÇÃO', 0, '0.00', '379.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(37, 'DACCS S11705VZT', 'DACCS', 'ARMAÇÃO', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(38, 'MONOFOCAL + FILTRO AZUL 1.61', 'LENTE', '', 0, '0.00', '550.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(39, 'MONOFOCAL FILTRO AZUL', 'MONOFOCAL BLOCK BLUE', 'LENTE', 0, '0.00', '290.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(40, 'JULIAN FAIET BA925VZT', 'JULIAN FAIET', 'ARMAÇÃO', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(41, 'DACCS 7505VZT', 'DACCS', 'ARMAÇÃO', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(42, 'JULIAN FAIET PROMOÇÃO', 'JULIAN FAIET', 'ARMAÇÃO', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(43, 'MULTIFOCAL PROLIFE HD + FOTO', 'LENTE', 'LENTE', 0, '0.00', '968.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(44, 'DACCS S11650VZT', 'DACCS', 'ARMAÇÃO', 0, '0.00', '299.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(45, 'MONOFOCAL BLOCK BLUE 1.61', 'LENTE', 'LENTE', 0, '0.00', '630.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(46, 'VIZZANO OURO 159VZT', 'VIZZANO', 'ARMAÇÃO', 0, '0.00', '379.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(47, 'MORENA ROSA MR113VZT', 'MORENA ROSA', 'ARMAÇÃO', 0, '0.00', '603.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(48, 'B2528', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(49, '5714', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(50, '2225', 'DACCS', '', 0, '0.00', '325.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(51, 'LENTE MONOFOCAl  COM FOTO', 'MONOFOCAL COM FOTO ', '', 0, '0.00', '399.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(52, 'LENTE MONOFOCAL COM FILTRO AZUL', 'MONOFOCAL BLOCK BLUE', '', 0, '0.00', '290.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(53, '1301', 'JULIAN FAIET', '', 0, '0.00', '199.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(54, '1813', 'JULIAN FAIET', '', 0, '0.00', '180.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(55, '6629', 'JULIAN FAIET', '', 0, '0.00', '180.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(56, '2733', 'GUESS', '', 0, '0.00', '379.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(57, '234', 'VIZZANO', '', 0, '0.00', '379.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(58, 'MULTIFOCAL PLUS INCOLOR', 'LENTE', '', 0, '0.00', '390.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(59, '11050', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(60, 'MULTIFOCAL PLUS', 'LENTE', '', 0, '0.00', '640.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(61, '3031', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(62, 'MONOFOCAL FILTRO AZUL + FOTO', 'MONOFOCAL BLOCK BLUE', '', 0, '0.00', '550.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(63, 'MULTIFOCAL BLOCK BLUE', 'MULTIFOCAL BLOCK BLUE', '', 0, '0.00', '640.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(64, '2716', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(65, 'MR100', 'MORENA ROSA', '', 0, '0.00', '500.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(66, 'VS3148', 'JULIAN FAIET', '', 0, '0.00', '300.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(67, 'AV345', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(68, 'MONOFOCAL FOTO', 'MONOFOCAL FOTO', '', 0, '0.00', '490.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(69, 'SL8018', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(70, 'AV123', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(71, 'GZ3056', 'GRAZI ', '', 0, '0.00', '280.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(72, 'VICTORIA SECRETS', 'VICTORIA SECRETS', '', 0, '0.00', '150.00', '', 15, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(73, 'MONOFOCAL G15', 'MONOFOCAL G15', '', 0, '0.00', '189.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(74, '3041', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(75, 'SL8011', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(76, 'RB2195', 'ÓCULOS SOLAR', '', 0, '0.00', '390.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(77, 'MULTIFOCAL HD BLOCK BLUE', 'MULTIFOCAL BLOCK BLUE', 'MULTIFOCAL HD  BLOCK BLUE ', 0, '0.00', '900.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(78, 'GRAZI', 'ÓCULOS SOLAR', '', 0, '0.00', '299.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(79, 'SH2756', 'JULIAN FAIET', '', 0, '0.00', '200.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(80, 'M2072', 'DACCS', '', 0, '0.00', '200.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(81, 'SH2663', 'JULIAN FAIET', '', 0, '0.00', '200.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(82, 'LENTE LC', 'L.C', '', 0, '0.00', '350.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(83, 'KBT98196', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(84, 'TR87001', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(85, 'MG5190', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(86, 'OR506', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(87, 'SL80557', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(88, 'VO5188', 'VOGUE', '', 0, '0.00', '315.00', '', 20, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(89, 'MG6144', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(90, 'MG6212', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(91, 'GU2825', 'GUESS', '', 0, '0.00', '389.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(92, 'MG6139', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(93, 'H16148', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(94, 'S11670', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(95, 'S11670 C6', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(96, 'S11705', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(97, 'OURO174', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(98, 'GU2812', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(99, 'TR2104', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(100, 'VS3128', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(101, 'FX3744', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(102, 'B2528 C5', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(103, 'OURO160 RX', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(104, 'ANA7006', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(105, 'SL1175', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(106, 'OURO 76', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(107, 'SL1269', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(108, 'OURO 159', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(109, 'SL1173', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(110, 'OURO 73 RX', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(111, 'S11572', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(112, 'SH2854', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(113, 'SL1007', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(114, 'JM8136', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(115, '5709', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(116, 'SL1157', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(117, 'SL202108', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(118, 'Y8007 55', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(119, 'S10046', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(120, 'SH2831', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(121, 'VS1162', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(122, 'VS1163 58', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(123, 'SL1157 57', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(124, 'SL0688', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(125, 'HC01', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(126, 'SL1242', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(127, 'HC0204', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(128, 'HC0101', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(129, 'T450', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(130, 'VS3176', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(131, '2225 56', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(132, 'VS3174', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(133, 'JC2047', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(134, 'SL2050', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(135, '2228', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(136, 'VS3176 59', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(137, 'VS2227', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(138, '2228 54', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(139, 'TN3071', 'TECNOL', '', 0, '0.00', '199.90', '', 21, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(140, 'TN3071 H', 'TECNOL', '', 0, '0.00', '199.90', '', 21, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(141, '521940', 'EVOKE', '', 0, '0.00', '400.00', '', 22, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(142, '5120140', 'EVOKE', '', 0, '0.00', '400.00', '', 22, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(143, '5122145', 'EVOKE', '', 0, '0.00', '400.00', '', 22, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(144, '50517140', 'EVOKE', '', 0, '0.00', '400.00', '', 22, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(145, 'TJ0036', 'TOMMY HILFIGER', '', 0, '0.00', '600.00', '', 23, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(146, 'TH1840', 'TOMMY HILFIGER', '', 0, '0.00', '600.00', '', 23, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(147, 'TH1475', 'TOMMY HILFIGER', '', 0, '0.00', '600.00', '', 23, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(148, 'MV3007', 'MARIA VALENTINA', '', 0, '0.00', '590.00', '', 13, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(149, 'MV3004', 'MARIA VALENTINA', '', 0, '0.00', '590.00', '', 13, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(150, 'MV3006', 'MARIA VALENTINA', '', 0, '0.00', '590.00', '', 13, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(151, 'MV3001', 'MARIA VALENTINA', '', 0, '0.00', '590.00', '', 13, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(152, 'MR108', 'MORENA ROSA', '', 0, '0.00', '628.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(153, 'MR130', 'MORENA ROSA', '', 0, '0.00', '625.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(154, 'MR132', 'MORENA ROSA', '', 0, '0.00', '625.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(155, 'M5199', 'MORENA ROSA', '', 0, '0.00', '628.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(156, 'AH648N', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(157, 'AH6445', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(158, 'AH1428', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(159, 'AH10008', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(160, 'AHROSE', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(161, 'AH10016', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(162, 'AH6442', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(163, 'AV123 53', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(164, 'AV789', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(165, 'AV234', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(166, 'C10052', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(167, 'AV23455', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(168, '34554', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(169, 'TH1283', 'TOMMY HILFIGER', '', 0, '0.00', '600.00', '', 23, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(170, '2229', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(171, 'OURO77 RX', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(172, 'VO5222', 'VOGUE', '', 0, '0.00', '370.00', '', 20, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(173, 'MONOFOCal  AR BLOCK BLUE', 'MONOFOCAL AR BLOCK BLUE', '', 0, '0.00', '420.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(174, 'JM8110', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(175, '0801', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(176, '0670', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(177, '0442', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(178, '0669', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(179, '0442C4', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(180, '0669 C1', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(181, '5817', 'JULIAN FAIET', '', 0, '0.00', '389.99', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(182, '0445', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(183, 'OURO166', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(184, 'OURO 166', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(185, 'OURO 169', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(186, 'MG3735', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(187, 'M3168', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(188, 'F603', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(189, 'TR87001 C1', 'DACCS', '', 0, '0.00', '299.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(190, 'S32065', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(191, 'MG6191', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(192, 'F792', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(193, 'JM8109', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(194, 'VS3135', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(195, 'CH9154', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(196, 'SL80562', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(197, 'SL5128', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(198, 'SL80558', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(199, 'FX3727', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(200, 'FX3723', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(201, 'CXS2015', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(202, 'FX3730', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(203, 'FX373053', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(204, '3018', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(205, 'FX3741', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(206, 'SL80550', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(207, 'FX3742', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(208, 'SH2653', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(209, 'SL3227', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(210, '2083', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(211, 'DS19147', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(212, 'SL5163', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(213, 'FX3745', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(214, 'SH2757', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(215, 'T552', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(216, 'FX3757', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(217, 'FX3751', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(218, 'S11736', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(219, '303656', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(220, 'JM8111', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(221, '21003', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(222, 'MG6190', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(223, 'TR87012', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(224, 'M3062', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(225, 'T871', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(226, '3035', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(227, 'OURO171', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(228, 'METAL345', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(229, 'OURO169', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(230, 'OURO162', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(231, 'AV567', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(232, 'OURO 159 RX', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(233, '567', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(234, 'OURO 161', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(235, 'OURO 91', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(236, 'OURO 67', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(237, 'GOLD 123', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(238, 'ROSE 123', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(239, 'XJ0009', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(240, '1870', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(241, '12068', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(242, 'OM88052', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(243, 'H5539', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(244, '12068 52', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(245, 'F759', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(246, '95637', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(247, 'F722', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(248, 'CLIP ON 940 ', 'SMART ', '', 0, '0.00', '389.00', '', 26, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(249, 'CLIP ON CP006 ', 'DACCS', '', 0, '0.00', '389.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(250, 'CLIP ON 1022', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(251, 'CLIP ON  5829', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(252, 'CLIP ON 5833', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(253, 'CLIP ON 5827', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(254, 'CLIP ON YC8014', 'DACCS', '', 0, '0.00', '389.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(255, 'CLIP ON 5829', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(256, 'CLIP ON 5812', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(257, 'CLIP ON 80002', 'DACCS', '', 0, '0.00', '389.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(258, 'T579', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(259, 'AG98029', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(260, 'BC003', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(261, 'SL80534', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(262, 'BA924', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(263, 'VS3135 53', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(264, 'JB3210', 'JEAN MONNIER', '', 0, '0.00', '260.00', '', 27, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(265, 'LO93335', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(266, 'BA867', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(267, 'SL80530', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(268, 'SL80534 53', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(269, 'AV456', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(270, 'M3062C5', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(271, 'YY2210', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(272, 'SL5336', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(273, 'GU2848', 'GUESS', '', 0, '0.00', '389.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(274, 'TR87013', 'DACCS', '', 0, '0.00', '379.99', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(275, 'BA696', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(276, 'SL8016', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(277, 'T587', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(278, 'MY6334', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(279, 'BC003 52', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(280, 'R7841', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(281, 'BA698', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(282, 'SL5129', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(283, 'T57954', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(284, 'BA960', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(285, 'BA946', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(286, 'SL2021009', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(287, 'T579 54', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(288, '5117145', 'EVOKE', '', 0, '0.00', '400.00', '', 22, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(289, 'JB32101176', 'JEAN MONNIER', '', 0, '0.00', '289.00', '', 27, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(290, 'OURO76', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(291, 'MY6327', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(292, 'TR87008', 'DACCS', '', 0, '0.00', '299.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(293, 'GZ3066', 'GRAZI', '', 0, '0.00', '410.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(294, 'R7841 52', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(295, '9004', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(296, 'SL2021010', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(297, 'JB32101174', 'JEAN MONNIER', '', 0, '0.00', '199.90', '', 27, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(298, 'JB32101173', 'JEAN MONNIER', '', 0, '0.00', '260.00', '', 27, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(299, 'MY3329', 'MARRY MARRY', '', 0, '0.00', '289.00', '', 18, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(300, 'OURO 82', 'VIZZANO', '', 0, '0.00', '325.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(301, 'SL80538', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(302, 'MS8233B', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(303, 'T574', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(304, 'FX3744 56', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(305, 'SL1007 54', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(306, 'BA891', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(307, 'MR116', 'MORENA ROSA', '', 0, '0.00', '603.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(308, 'MR124', 'MORENA ROSA', '', 0, '0.00', '656.00', '', 12, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(309, 'AH60018', 'ANA HICKMANN', '', 0, '0.00', '389.00', '', 24, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(310, 'FX3741 55', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(311, 'FX37305320', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(312, 'FX374155', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(313, 'F75953', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(314, '21015', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(315, 'BA94651', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(316, 'FX3741,', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(317, 'CXS201555', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(318, 'SL117356', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(319, 'F79253', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(320, 'JM8130', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(321, 'SL80517', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(322, 'ROSE12355', 'VIZZANO', '', 0, '0.00', '395.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(323, 'T337', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(324, 'TN3068', 'TECNOL', '', 0, '0.00', '260.00', '', 21, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(325, 'JC204756', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(326, 'TN3071H493', 'TECNOL', '', 0, '0.00', '179.00', '', 21, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(327, 'SL202108 003', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(328, 'VS3149 55', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(329, '5014', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(330, 'TN3071 H493', 'TECNOL', '', 0, '0.00', '260.00', '', 21, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(331, 'AV345 55', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(332, 'S10046.', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(333, 'VS3154', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(334, 'SH2834', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(335, 'SH2829', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(336, 'SH28295516145', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(337, 'SH282955', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(338, 'SH9282', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(339, 'SH2833', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(340, 'VS3148 56', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(341, 'TN3072', 'TECNOL', '', 0, '0.00', '260.00', '', 21, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(342, 'P8295', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(343, 'VS3152', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(344, 'VS3149551', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(345, 'HC0510', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(346, 'SL1029', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(347, 'VS315254', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(348, 'SH28295516145C2', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(349, 'SH282955C2', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(350, 'SH282955C1', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(351, 'SH2831C2', 'VERSATTE', '', 0, '0.00', '289.00', '', 28, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(352, 'VS314856', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(353, '501454', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(354, 'VS315956', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(355, 'W2387', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(356, 'SL20210800', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(357, 'AV12356', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(358, 'SL20210806', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(359, 'AV5675517', 'MARESIA', '', 0, '0.00', '389.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(360, 'MG3732', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(361, 'SL112157', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(362, 'CLIP ON 5817', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(363, 'CLIP ON 5829 C3', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(364, 'CLI0P ON 102', 'JULIAN FAIET', '', 0, '0.00', '389.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(365, 'CA25888', 'SCUDO', '', 0, '0.00', '179.90', '', 29, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(366, 'CA25888.', 'SCUDO', '', 0, '0.00', '179.90', '', 29, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(367, 'FX3754', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(368, 'OM3040', 'PRADO', '', 0, '0.00', '90.00', '', 30, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(369, 'GZ3056G', 'GRAZI', '', 0, '0.00', '90.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(370, 'FX375154', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(371, 'S11050', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(372, 'SH2457', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(373, 'TR87006', 'DACCS', '', 0, '0.00', '90.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(374, 'FD8512', 'PRADO', '', 0, '0.00', '90.00', '', 30, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(375, 'VS3178', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(376, 'SL1133', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(377, '900253', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(378, '95554', 'JULIAN FAIET', '', 0, '0.00', '90.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(379, 'FD8475', 'PRADO', '', 0, '0.00', '90.00', '', 30, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(380, '205621', 'VIP', '', 0, '0.00', '90.00', '', 31, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(381, 'BA2053', 'PARAFUSADO', '', 0, '0.00', '90.00', '', 32, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(382, '95600', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(383, '21016', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(384, 'KP1112', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(385, 'CLIP ON FG1003', 'DACCS', '', 0, '0.00', '389.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(386, 'KP3132', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(387, 'SK18122', 'SILMO KIDS', '', 0, '0.00', '299.00', '', 34, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(388, 'S8142', 'OCULOS INFANTIL', '', 0, '0.00', '229.00', '', 35, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(389, 'SK18105', 'SILMO KIDS', '', 0, '0.00', '299.00', '', 34, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(390, 'KP1113', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(391, '5065', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(392, 'BA69848', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(393, 'KP3139', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(394, 'KP3131', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(395, 'KP3141', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(396, 'KP3140', 'KIPLING', '', 0, '0.00', '399.99', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(397, 'KP1116', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(398, 'KP3133', 'KIPLING', '', 0, '0.00', '399.00', '', 33, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(399, 'OURO 145', 'VIZZANO', '', 0, '0.00', '395.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(400, 'T830', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(401, '6629 48', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(402, 'VS3044', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(403, 'T305', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(404, '5022', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(405, 'T897', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(406, 'VS3120', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(407, 'VS3048', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(408, 'KBT981965', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(409, 'JM8120', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(410, '21010', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(411, '80010', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(412, 'SL8003', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(413, 'TR1806', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(414, 'RB1603', 'RAY BAN', '', 0, '0.00', '379.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(415, '6629,', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(416, '80017', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(417, 'VS3120.', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(418, '1829', 'OCULOS INFANTIL', '', 0, '0.00', '229.00', '', 35, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(419, '3016', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(420, 'RB3647', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(421, 'RB3016', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(422, 'RB', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(423, 'RB3025', 'RAY BAN', '', 0, '0.00', '620.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(424, 'RB3548', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(425, 'RB197', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(426, '277', 'CARRERA', '', 0, '0.00', '1044.00', '', 36, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(427, '2028', 'CARRERA', '', 0, '0.00', '993.00', '', 36, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(428, '260', 'CARRERA', '', 0, '0.00', '1026.00', '', 36, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(429, 'RB3503', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(430, 'RB4362', 'RAY', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(431, 'RB2186', 'RAY BAN', '', 0, '0.00', '780.00', '', 7, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(432, 'OURO148', 'VIZZANO', '', 0, '0.00', '299.00', '', 17, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(433, 'C300', 'MARESIA', '', 0, '0.00', '499.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(434, 'C400', 'MARESIA', '', 0, '0.00', '499.00', '', 25, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(435, '9R60J', 'HAVAIANAS', '', 0, '0.00', '298.00', '', 37, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(436, '5CB13', 'HAVAIANAS', '', 0, '0.00', '298.00', '', 37, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(437, 'PJPZ9', 'HAVAIANAS', '', 0, '0.00', '298.00', '', 37, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(438, '3025', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(439, '302556', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(440, '302558', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(441, '302562', 'JULIAN FAIET', '', 0, '0.00', '289.00', '', 10, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(442, '1067', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(443, '8244', 'DACCS', '', 0, '0.00', '289.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(444, 'P12C5', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(445, '3245', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(446, 'LENTE ESFERIC', 'LENTE ESFERICA -2,50', '', 0, '0.00', '190.00', '', 38, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(447, 'LENTE POLY', 'POLY COM FOTO SEM AR', '', 0, '0.00', '1140.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(448, 'H5547', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(449, '120252', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(450, 'F73055', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(451, 'M3277', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(452, 'TR8917', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(453, 'F60352', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(454, 'M2027', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(455, 'MG6276', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(456, '2225 56 19', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(457, 'MF7748', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(458, '22275716', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(459, 'P8513', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(460, 'MG6165', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(461, '12025217', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(462, '22295122', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(463, 'F76252', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(464, '22295122140', 'DACCS', '', 0, '0.00', '379.00', '', 11, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(465, 'LENTE ESFERICA ', 'LENTE', '', 0, '0.00', '190.00', '', 38, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(466, 'SOLUÇAO', 'RENU', '', 0, '0.00', '18.00', '', 39, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(467, 'GF3080', 'GRAZI', '', 0, '0.00', '410.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(468, 'GZ3104', 'GRAZI', '', 0, '0.00', '410.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(469, 'GZ3103', 'GRAZI', '', 0, '0.00', '410.00', '', 19, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(470, 'AN7217', 'ARNETTE', '', 0, '0.00', '400.00', '', 40, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(471, 'AN7219', 'ARNETTE', '', 0, '0.00', '410.00', '', 40, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(472, 'AN7195', 'ARNETTE', '', 0, '0.00', '400.00', '', 40, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(473, 'AN7201', 'ARNETTE', '', 0, '0.00', '400.00', '', 40, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(474, 'AN7195 L', 'ARNETTE', '', 0, '0.00', '400.00', '', 40, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(475, 'GU2757', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(476, 'GU2815', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(477, 'GU2849', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(478, 'GU2704', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(479, 'GU2824', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(480, 'GU2701', 'GUESS', '', 0, '0.00', '599.00', '', 14, 'sem-foto.jpg', 'Sim', NULL, 'Normal'),
(481, 'MONOFOCAL 1.56 BLOCK SEM AR', 'MONOFOCAL  1.56 BLOCK SEM AR ', '', 0, '0.00', '455.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(482, 'MULTIFOCAL FOTO FLEX', 'MULTIFOCAL FOTO FLEX', '', 0, '0.00', '640.00', '', 16, 'sem-foto.jpg', 'Sim', NULL, 'Laboratorio'),
(483, 'LIMPA LENTES', 'LIMPA LENTES', '', 0, '0.00', '30.00', '', 39, 'sem-foto.jpg', 'Sim', NULL, 'Normal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel`) VALUES
(7, 'Jezila', 'jezila@gmail.com', '123', 'Administrador'),
(30, 'KENIA', 'kenia@gmail.com', '123', 'Comum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `valor_parcial`
--

CREATE TABLE `valor_parcial` (
  `id` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL,
  `tipo` varchar(330) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `valor_parcial`
--

INSERT INTO `valor_parcial` (`id`, `id_conta`, `tipo`, `valor`, `data`, `usuario`) VALUES
(1, 11, 'Pagar', '7.67', '2022-12-08', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pagamento` varchar(50) NOT NULL,
  `lancamento` varchar(50) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_pgto` date NOT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `acrescimo` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `cliente` int(11) NOT NULL,
  `valor_custo` decimal(8,2) NOT NULL,
  `recebido` decimal(8,2) NOT NULL,
  `porcentagem` decimal(8,2) DEFAULT NULL,
  `tipoEntrada` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `valor`, `usuario`, `pagamento`, `lancamento`, `data_lanc`, `data_pgto`, `desconto`, `acrescimo`, `subtotal`, `parcelas`, `status`, `cliente`, `valor_custo`, `recebido`, `porcentagem`, `tipoEntrada`) VALUES
(1, '280.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-10-14', '2022-10-14', '0.00', NULL, '280.00', 1, 'Concluída', 34, '0.00', '0.00', NULL, 'Cartão de Debito'),
(2, '579.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-10-14', '2022-10-14', '0.00', NULL, '579.00', 10, 'Concluída', 32, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(3, '569.00', 30, 'Dinheiro', 'Caixa', '2022-10-14', '2022-10-14', '0.00', NULL, '509.00', 1, 'Concluída', 31, '0.00', '0.00', NULL, 'Dinheiro'),
(4, '595.00', 30, 'Dinheiro', 'Caixa', '2022-10-18', '2022-10-18', '60.00', NULL, '595.00', 1, 'Concluída', 33, '0.00', '0.00', NULL, 'Sem Entrada'),
(5, '390.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-10-20', '2022-10-20', '0.00', NULL, '390.00', 6, 'Concluída', 35, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(6, '190.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-10-21', '2022-10-21', '0.00', NULL, '190.00', 1, 'Concluída', 38, '0.00', '0.00', NULL, 'Sem Entrada'),
(7, '669.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-10-21', '2022-10-21', '0.00', NULL, '669.00', 12, 'Concluída', 45, '0.00', '0.00', NULL, 'Sem Entrada'),
(8, '579.00', 30, 'Dinheiro', 'Caixa', '2022-10-24', '2022-10-10', '0.00', NULL, '500.00', 1, 'Pendente', 36, '0.00', '0.00', NULL, 'Sem Entrada'),
(9, '1058.00', 30, 'Boleto', 'Caixa', '2022-10-28', '2022-10-28', '0.00', NULL, '1058.00', 1, 'Concluída', 43, '0.00', '0.00', NULL, 'Sem Entrada'),
(10, '579.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-11-03', '2022-11-03', '0.00', NULL, '579.00', 2, 'Concluída', 41, '0.00', '0.00', NULL, 'Sem Entrada'),
(11, '569.00', 30, 'Dinheiro', 'Caixa', '2022-11-03', '2022-11-03', '59.00', NULL, '569.00', 1, 'Concluída', 39, '0.00', '0.00', NULL, 'Sem Entrada'),
(12, '929.00', 30, 'Cheque', 'Sicoob', '2022-11-04', '2022-11-04', '0.00', NULL, '929.00', -6, 'Concluída', 40, '0.00', '0.00', NULL, 'Sem Entrada'),
(13, '669.00', 30, 'Cheque', 'Sicoob', '2022-11-04', '2022-11-04', '0.00', NULL, '669.00', 6, 'Pendente', 42, '0.00', '0.00', NULL, 'Sem Entrada'),
(14, '724.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-11-04', '2022-11-04', '0.00', NULL, '650.00', 1, 'Concluída', 49, '0.00', '0.00', NULL, 'Sem Entrada'),
(15, '968.00', 30, 'Boleto', 'Caixa', '2022-11-11', '2022-11-11', '0.00', NULL, '800.00', 1, 'Concluída', 48, '0.00', '0.00', NULL, 'Sem Entrada'),
(16, '1257.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-11-11', '2022-11-11', '0.00', NULL, '1257.00', 6, 'Concluída', 47, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(17, '730.00', 30, 'Dinheiro', 'Caixa', '2022-11-17', '2022-11-17', '0.00', NULL, '610.00', 1, 'Concluída', 55, '0.00', '0.00', NULL, 'Sem Entrada'),
(18, '500.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-11-18', '2022-11-18', '0.00', NULL, '500.00', 1, 'Concluída', 60, '0.00', '0.00', NULL, 'Cartão de Debito'),
(19, '769.00', 30, 'Carnê', 'Caixa', '2022-11-18', '2022-12-10', '0.00', NULL, '577.00', 3, 'Pendente', 54, '0.00', '192.00', NULL, 'Dinheiro'),
(20, '470.00', 30, 'Boleto', 'Caixa', '2022-11-18', '2022-12-02', '0.00', NULL, '470.00', 1, 'Pendente', 52, '0.00', '0.00', NULL, 'Sem Entrada'),
(21, '290.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-11-18', '2022-11-18', '0.00', NULL, '290.00', 3, 'Concluída', 61, '0.00', '0.00', NULL, 'Sem Entrada'),
(22, '1347.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-11-19', '2022-11-19', '0.00', NULL, '1200.00', 1, 'Concluída', 53, '0.00', '0.00', NULL, 'Sem Entrada'),
(23, '498.00', 30, 'Pix', 'Pix', '2022-11-22', '2022-11-22', '0.00', NULL, '440.00', 1, 'Concluída', 50, '0.00', '0.00', NULL, 'Sem Entrada'),
(24, '1257.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-11-25', '2022-11-25', '0.00', NULL, '1100.00', 1, 'Concluída', 59, '0.00', '0.00', NULL, 'Cartão de Debito'),
(25, '1257.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-11-25', '2022-11-25', '0.00', NULL, '1129.00', 10, 'Concluída', 58, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(26, '579.00', 30, 'Dinheiro', 'Caixa', '2022-11-25', '2022-11-25', '0.00', NULL, '500.00', 1, 'Concluída', 56, '0.00', '0.00', NULL, 'Dinheiro'),
(27, '470.00', 30, 'Dinheiro', 'Caixa', '2022-11-28', '2022-11-28', '0.00', NULL, '390.00', 1, 'Concluída', 51, '0.00', '0.00', NULL, 'Dinheiro'),
(28, '150.00', 30, 'Pix', 'Pix', '2022-11-30', '2022-11-30', '0.00', NULL, '150.00', 1, 'Concluída', 68, '0.00', '0.00', NULL, 'Sem Entrada'),
(29, '885.00', 30, 'Carnê', 'Caixa', '2022-12-02', '2022-12-02', '0.00', NULL, '660.00', 3, 'Pendente', 63, '0.00', '0.00', NULL, 'Sem Entrada'),
(30, '670.00', 30, 'Dinheiro', 'Caixa', '2022-12-02', '2022-12-02', '0.00', NULL, '600.00', 1, 'Concluída', 67, '0.00', '0.00', NULL, 'Dinheiro'),
(31, '700.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-02', '2022-12-02', '0.00', NULL, '700.00', 8, 'Concluída', 72, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(32, '590.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-02', '2022-12-02', '0.00', NULL, '660.00', 8, 'Concluída', 73, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(33, '579.00', 30, 'Carnê', 'Caixa', '2022-12-02', '2022-12-02', '0.00', NULL, '679.00', 4, 'Pendente', 64, '0.00', '0.00', NULL, 'Sem Entrada'),
(34, '399.00', 30, 'Dinheiro', 'Caixa', '2022-12-02', '2022-12-02', '0.00', NULL, '350.00', 1, 'Concluída', 65, '0.00', '0.00', NULL, 'Sem Entrada'),
(35, '979.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-05', '2022-12-05', '0.00', NULL, '880.00', 1, 'Concluída', 75, '0.00', '0.00', NULL, 'Sem Entrada'),
(36, '1363.00', 30, 'Pix', 'Pix', '2022-12-06', '2022-12-06', '0.00', NULL, '500.00', 2, 'Pendente', 66, '0.00', '600.00', NULL, 'Pix'),
(37, '769.00', 30, 'Boleto', 'Caixa', '2022-12-07', '2022-12-07', '0.00', NULL, '769.00', 3, 'Pendente', 54, '0.00', '0.00', NULL, 'Sem Entrada'),
(38, '769.00', 30, 'Boleto', 'Caixa', '2022-12-07', '2022-12-07', '0.00', NULL, '577.00', 3, 'Pendente', 54, '0.00', '0.00', NULL, 'Sem Entrada'),
(39, '769.00', 30, 'Boleto', 'Caixa', '2022-12-07', '2022-12-07', '0.00', NULL, '377.00', 1, 'Concluída', 54, '0.00', '200.00', NULL, 'Dinheiro'),
(40, '769.00', 30, 'Boleto', 'Caixa', '2022-12-07', '2022-12-07', '0.00', NULL, '377.00', 2, 'Pendente', 54, '0.00', '200.00', NULL, 'Dinheiro'),
(41, '1019.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-08', '2022-12-08', '0.00', NULL, '965.00', 6, 'Concluída', 79, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(42, '190.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-08', '2022-12-08', '0.00', NULL, '190.00', 1, 'Concluída', 74, '0.00', '0.00', NULL, 'Cartão de Debito'),
(43, '1268.00', 30, 'Carnê', 'Caixa', '2022-12-08', '2023-01-08', '0.00', NULL, '500.00', 5, 'Pendente', 62, '0.00', '329.00', NULL, 'Dinheiro'),
(44, '1019.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-08', '2022-12-08', '0.00', NULL, '965.00', 12, 'Concluída', 81, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(45, '478.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-08', '2022-12-08', '0.00', NULL, '430.00', 1, 'Concluída', 58, '0.00', '0.00', NULL, 'Cartão de Debito'),
(46, '470.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-08', '2022-12-08', '0.00', NULL, '420.00', 1, 'Concluída', 52, '0.00', '0.00', NULL, 'Cartão de Debito'),
(47, '190.00', 30, 'Pix', 'Pix', '2022-12-09', '2022-12-09', '0.00', NULL, '190.00', 1, 'Concluída', 85, '0.00', '0.00', NULL, 'Pix'),
(48, '1363.00', 30, 'Carnê', 'Caixa', '2022-12-09', '2023-01-09', '0.00', NULL, '500.00', 2, 'Pendente', 66, '0.00', '0.00', NULL, 'Sem Entrada'),
(49, '690.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-09', '2022-12-09', '0.00', NULL, '230.00', 2, 'Concluída', 71, '0.00', '350.00', NULL, 'Dinheiro'),
(50, '390.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-13', '2022-12-13', '0.00', NULL, '350.00', 1, 'Concluída', 86, '0.00', '0.00', NULL, 'Cartão de Debito'),
(51, '1768.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-13', '2022-12-13', '0.00', NULL, '1590.00', 1, 'Concluída', 69, '0.00', '0.00', NULL, 'Cartão de Debito'),
(52, '1250.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-13', '2022-12-13', '0.00', NULL, '1400.00', 8, 'Concluída', 87, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(53, '669.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-15', '2022-12-15', '0.00', NULL, '624.00', 12, 'Concluída', 88, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(54, '190.00', 30, 'Pix', 'Caixa', '2022-12-15', '2022-12-15', '0.00', NULL, '290.00', 1, 'Concluída', 80, '0.00', '0.00', NULL, 'Pix'),
(55, '929.00', 30, 'Dinheiro', 'Caixa', '2022-12-15', '2022-12-15', '0.00', NULL, '800.00', 1, 'Concluída', 78, '0.00', '0.00', NULL, 'Dinheiro'),
(56, '669.00', 30, 'Pix', 'Santander', '2022-12-15', '2022-12-15', '0.00', NULL, '600.00', 1, 'Concluída', 84, '0.00', '0.00', NULL, 'Pix'),
(57, '678.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-15', '2022-12-15', '0.00', NULL, '615.00', -3, 'Concluída', 77, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(58, '1257.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-15', '2022-12-15', '0.00', NULL, '1168.00', 6, 'Concluída', 82, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(59, '1347.00', 30, 'Pix', 'Pix', '2022-12-16', '2022-12-16', '0.00', NULL, '1200.00', 1, 'Concluída', 76, '0.00', '0.00', NULL, 'Pix'),
(60, '1363.00', 30, 'Carnê', 'Caixa', '2022-12-16', '2023-01-16', '0.00', NULL, '944.00', 4, 'Pendente', 83, '0.00', '400.00', NULL, 'Dinheiro'),
(61, '290.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-23', '2022-12-23', '0.00', NULL, '250.00', 1, 'Concluída', 91, '0.00', '0.00', NULL, 'Cartão de Debito'),
(62, '778.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-23', '2022-12-23', '0.00', NULL, '690.00', 1, 'Concluída', 98, '0.00', '0.00', NULL, 'Cartão de Debito'),
(63, '1029.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-23', '2022-12-23', '0.00', NULL, '1019.00', 5, 'Concluída', 99, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(64, '398.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2022-12-23', '2022-12-23', '0.00', NULL, '398.00', 1, 'Concluída', 95, '0.00', '0.00', NULL, 'Cartão de Debito'),
(65, '685.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-23', '2022-12-23', '0.00', NULL, '600.00', 2, 'Concluída', 100, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(66, '1347.00', 30, 'Dinheiro', 'Caixa', '2022-12-23', '2022-12-23', '0.00', NULL, '1000.00', 1, 'Concluída', 102, '0.00', '0.00', NULL, 'Dinheiro'),
(67, '968.00', 30, 'Dinheiro', 'Caixa', '2022-12-23', '2022-12-23', '168.00', NULL, '968.00', 1, 'Concluída', 90, '0.00', '0.00', NULL, 'Sem Entrada'),
(68, '968.00', 30, 'Dinheiro', 'Caixa', '2022-12-23', '2022-12-23', '0.00', NULL, '800.00', 1, 'Concluída', 90, '0.00', '0.00', NULL, 'Dinheiro'),
(69, '1149.00', 30, 'Dinheiro', 'Caixa', '2022-12-23', '2022-12-23', '0.00', NULL, '620.00', 1, 'Concluída', 104, '0.00', '0.00', NULL, 'Dinheiro'),
(70, '2138.00', 30, 'Dinheiro', 'Caixa', '2022-12-24', '2022-12-24', '0.00', NULL, '1400.00', 1, 'Concluída', 89, '0.00', '0.00', NULL, 'Dinheiro'),
(71, '315.00', 30, 'Pix', 'Pix', '2022-12-29', '2022-12-29', '0.00', NULL, '280.00', 1, 'Concluída', 94, '0.00', '0.00', NULL, 'Pix'),
(72, '590.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2022-12-29', '2022-12-29', '0.00', NULL, '488.00', 10, 'Concluída', 108, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(73, '289.00', 30, 'Pix', 'Pix', '2022-12-29', '2022-12-29', '0.00', NULL, '280.00', 1, 'Concluída', 94, '0.00', '0.00', NULL, 'Pix'),
(74, '650.00', 30, 'Boleto', 'Cartão de Débito', '2022-12-29', '2022-12-29', '0.00', NULL, '434.00', 2, 'Pendente', 96, '0.00', '216.00', NULL, 'Cartão de Debito'),
(75, '640.00', 30, 'Boleto', 'Caixa', '2022-12-31', '2022-12-31', '0.00', NULL, '640.00', 1, 'Concluída', 101, '0.00', '100.00', NULL, 'Dinheiro'),
(76, '379.00', 30, 'Boleto', 'Caixa', '2022-12-31', '2022-12-31', '0.00', NULL, '249.00', 1, 'Concluída', 101, '0.00', '50.00', NULL, 'Dinheiro'),
(77, '769.00', 30, 'Dinheiro', 'Caixa', '2023-01-03', '2023-01-03', '0.00', NULL, '700.00', 1, 'Concluída', 103, '0.00', '0.00', NULL, 'Dinheiro'),
(78, '780.00', 30, 'Boleto', 'Caixa', '2023-01-05', '2023-01-05', '0.00', NULL, '300.00', 1, 'Concluída', 110, '0.00', '300.00', NULL, 'Dinheiro'),
(79, '289.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2023-01-05', '2023-01-05', '0.00', NULL, '260.00', 1, 'Concluída', 111, '0.00', '0.00', NULL, 'Cartão de Debito'),
(80, '190.00', 30, 'Dinheiro', 'Caixa', '2023-01-06', '2023-01-06', '0.00', NULL, '190.00', 1, 'Concluída', 112, '0.00', '0.00', NULL, 'Dinheiro'),
(81, '1019.00', 30, 'Dinheiro', 'Caixa', '2023-01-06', '2023-01-06', '0.00', NULL, '990.00', 1, 'Concluída', 114, '0.00', '0.00', NULL, 'Dinheiro'),
(82, '990.00', 30, 'Carnê', 'Caixa', '2023-01-06', '2023-02-28', '0.00', NULL, '990.00', 4, 'Pendente', 92, '0.00', '0.00', NULL, 'Sem Entrada'),
(83, '190.00', 30, 'Pix', 'Caixa', '2023-01-06', '2023-01-06', '0.00', NULL, '220.00', 1, 'Concluída', 113, '0.00', '0.00', NULL, 'Pix'),
(84, '744.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2023-01-06', '2023-01-06', '0.00', NULL, '744.00', 7, 'Concluída', 115, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(85, '694.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2023-01-06', '2023-01-06', '0.00', NULL, '678.00', 8, 'Concluída', 105, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(86, '1347.00', 30, 'Dinheiro', 'Caixa', '2023-01-06', '2023-01-06', '0.00', NULL, '1200.00', 1, 'Concluída', 106, '0.00', '0.00', NULL, 'Dinheiro'),
(87, '640.00', 30, 'Cartão de Crédito', 'Cartão de Crédito', '2023-01-06', '2023-01-06', '0.00', NULL, '640.00', 4, 'Concluída', 116, '0.00', '0.00', NULL, 'Cartão de Crédito'),
(88, '669.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2023-01-06', '2023-01-06', '0.00', NULL, '600.00', 1, 'Concluída', 119, '0.00', '0.00', NULL, 'Cartão de Debito'),
(89, '30.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2023-01-06', '2023-01-06', '0.00', NULL, '30.00', 1, 'Concluída', 122, '0.00', '0.00', NULL, 'Cartão de Debito'),
(90, '640.00', 30, 'Pix', 'Caixa', '2023-01-06', '2023-01-06', '0.00', NULL, '345.00', 1, 'Concluída', 124, '0.00', '0.00', NULL, 'Pix'),
(91, '884.00', 30, 'Cartão de Debito', 'Cartão de Débito', '2023-01-06', '2023-01-06', '0.00', NULL, '280.00', 1, 'Concluída', 111, '0.00', '400.00', NULL, 'Cartão de Debito');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bancarias`
--
ALTER TABLE `bancarias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cat_despesas`
--
ALTER TABLE `cat_despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cat_produtos`
--
ALTER TABLE `cat_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contas_despesa`
--
ALTER TABLE `contas_despesa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `formas_pgtos`
--
ALTER TABLE `formas_pgtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itens_compra`
--
ALTER TABLE `itens_compra`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `niveis`
--
ALTER TABLE `niveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `valor_parcial`
--
ALTER TABLE `valor_parcial`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bancarias`
--
ALTER TABLE `bancarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cat_despesas`
--
ALTER TABLE `cat_despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `cat_produtos`
--
ALTER TABLE `cat_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_despesa`
--
ALTER TABLE `contas_despesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `formas_pgtos`
--
ALTER TABLE `formas_pgtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `itens_compra`
--
ALTER TABLE `itens_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `niveis`
--
ALTER TABLE `niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `valor_parcial`
--
ALTER TABLE `valor_parcial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
