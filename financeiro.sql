-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jan-2022 às 17:59
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `financeiro`
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
(8, 'Periféricos');

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
(1, 'Venda Rápida', 'Física', '000.000.000-00', '(00) 00000-0000', '', 'Sim', 'Esse cliente é exclusivo da loja para que não precisa sempre cadastrar clientes!', '2022-01-18', '', '', '', 'cliente@cliente.com'),
(2, 'Jezila', 'Física', '189.654.785-21', '(34) 99228-6149', 'Av. Israel Pinheiros 784 , centro', 'Sim', '', '2022-01-17', '', '', '', 'jezila@hotmail.com'),
(3, 'Carlos', 'Física', '874.569.543-23', '(34) 88888-8888', 'Rua Governador Valadares , 456', 'Sim', 'Desenvolvedor do Sistema Núcleo Visão', '2022-01-04', '', '', '', 'contato@carlos.com.br'),
(4, 'Maicon Lucas Fraga ', 'Física', '818.303.945-68', '(34) 99298-3445', 'av municipal 512 ao 202', 'Sim', 'meu gostoso', '2022-01-17', '', '', '', 'maicon.fraga@hotmail.com'),
(5, 'Karla', 'Física', '545.454.548-48', '(34) 99912-1347', '', 'Sim', '', '2022-01-18', '', '', '', '');

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

--
-- Extraindo dados da tabela `contas_despesa`
--

INSERT INTO `contas_despesa` (`id`, `descricao`, `valor`, `data`, `usuario`, `lancamento`, `documento`, `plano_conta`, `fornecedor`) VALUES
(1, 'Agua', '50.00', '2022-01-07', 7, 'Caixa', 'Boleto Bancário', 'Luz - Empresa', '6'),
(2, 'Luz', '50.00', '2022-01-06', 7, 'Caixa', 'Boleto Bancário', 'Luz - Empresa', '5'),
(3, 'Talão de Energia', '50.00', '2022-01-10', 7, 'Bradesco', 'Boleto Bancário', 'Luz - Residência', '');

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
  `arquivo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contas_pagar`
--

INSERT INTO `contas_pagar` (`id`, `descricao`, `cliente`, `saida`, `documento`, `plano_conta`, `data_emissao`, `vencimento`, `frequencia`, `valor`, `usuario_lanc`, `usuario_baixa`, `status`, `data_recor`, `juros`, `multa`, `desconto`, `subtotal`, `data_baixa`, `id_compra`, `arquivo`) VALUES
(1, 'Talão de Agua', 4, 'Caixa', 'Dinheiro', 'Agua - Empresa', '2022-01-17', '2022-01-17', 'Uma Vez', '50.00', 7, NULL, 'Pendente', '2022-01-17', NULL, NULL, NULL, NULL, NULL, 0, '17-01-2022-13-09-24-produtos.pdf');

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
(10, 'Parcela 1', 5, 'Caixa', 'Dinheiro', 'Venda', '2022-01-18', '2022-01-18', 'Uma Vez', '150.00', 7, NULL, 'Pendente', '2022-01-18', NULL, NULL, NULL, NULL, NULL, 5, 'sem-foto.jpg'),
(11, 'Parcela 2', 5, 'Caixa', 'Dinheiro', 'Venda', '2022-01-18', '2022-02-18', 'Uma Vez', '150.00', 7, NULL, 'Pendente', '2022-01-18', NULL, NULL, NULL, NULL, NULL, 5, 'sem-foto.jpg');

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
(2, 1, 32, '300.00', 1, '300.00', 7, '150.00'),
(3, 1, 32, '300.00', 1, '300.00', 7, '150.00'),
(4, 2, 32, '300.00', 1, '300.00', 7, '150.00'),
(5, 3, 32, '300.00', 1, '300.00', 7, '150.00'),
(6, 4, 33, '187.55', 1, '187.55', 7, '150.00'),
(7, 5, 32, '300.00', 1, '300.00', 7, '150.00');

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
(1, 'Entrada', 'Venda', 'Venda - Venda Rápida', '0.00', 7, '2022-01-18', 'Caixa', 'Venda', 'Dinheiro', 4, 2);

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
  `lucro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `descricao`, `estoque`, `valor_compra`, `valor_venda`, `fornecedores`, `categoria`, `foto`, `ativo`, `lucro`) VALUES
(30, '22', 'Oculos', 'Testes', 11, '0.00', '150.00', '', 6, '09-11-2021-18-44-39-rayban.jpg', 'Sim', 50),
(31, '9898', 'Convite de niver', 'Muito bom', 21, '66.00', '92.99', '', 7, '10-11-2021-18-39-24-1.png', 'Sim', 40),
(32, '2', 'Teste', '', 27, '150.00', '300.00', '1', 7, '05-01-2022-15-58-17-Untitled.jpg', 'Sim', 100),
(33, '0505', 'Fone Gamer Logitech', 'Qualidade 7.1 e RGB ', 17, '150.00', '187.55', '', 8, '07-01-2022-23-02-55-FoneGamer.jpg', 'Sim', 0);

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
(7, 'Carlos Daniel', 'contato@carlos.com.br', '123', 'Administrador'),
(30, 'Karla', 'contato@teste.com', '123', 'Comum');

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
(1, 18, 'Pagar', '120.00', '2022-01-08', 7),
(2, 115, 'Pagar', '150.00', '2022-01-10', 7),
(3, 81, 'Pagar', '150.00', '2022-01-11', 7);

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
  `recebido` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `valor`, `usuario`, `pagamento`, `lancamento`, `data_lanc`, `data_pgto`, `desconto`, `acrescimo`, `subtotal`, `parcelas`, `status`, `cliente`, `valor_custo`, `recebido`) VALUES
(1, '300.00', 7, 'Dinheiro', 'Caixa', '2022-01-18', '2022-02-18', '0.00', '0.00', '300.00', 2, 'Cancelada', 2, '150.00', '0.00'),
(3, '300.00', 7, 'Dinheiro', 'Caixa', '2022-01-18', '2022-01-18', '0.00', '0.00', '300.00', 1, 'Cancelada', 0, '150.00', '300.00'),
(4, '187.55', 7, 'Dinheiro', 'Caixa', '2022-01-18', '2022-01-18', '0.00', '0.00', '187.55', 1, 'Cancelada', 0, '150.00', '187.55'),
(5, '300.00', 7, 'Dinheiro', 'Caixa', '2022-01-18', '2022-02-18', '0.00', '0.00', '300.00', 2, 'Pendente', 3, '150.00', '500.00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_despesa`
--
ALTER TABLE `contas_despesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `niveis`
--
ALTER TABLE `niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `valor_parcial`
--
ALTER TABLE `valor_parcial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
