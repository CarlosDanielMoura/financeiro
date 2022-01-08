<?php
require_once("conexao.php");


// CRIAR O USUÁRIO ADMINITRADOR CASO NÃO EXISTA
$consulta = $pdo->query("SELECT * from usuarios where nivel = 'Administrador' ");
$res = $consulta->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg = @count($res);
// CRIANDO CONTA !
if ($total_reg == 0) {
    $pdo->query("INSERT INTO usuarios SET nome = '$nome_adm', email = '$email_adm', 
    senha = '123', nivel = 'Administrador' ");
}


// CRIAR O NIVEL ADMINISTRADOR
$consulta2 = $pdo->query("SELECT * from niveis where nivel = 'Administrador' ");
$res2 = $consulta2->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg2 = @count($res2);
//CRIANDO NIVEL
if ($total_reg2 == 0) {
    $pdo->query("INSERT INTO niveis SET nivel = 'Administrador' ");
}


// CRIAR UM CLIENTE DIVERSOS
$consulta3 = $pdo->query("SELECT * from clientes where id = 1 ");
$res3 = $consulta3->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg3 = @count($res3);

//CRIANDO CLIENTE
if ($total_reg3 == 0) {
    $pdo->query(" INSERT INTO clientes SET nome = 'Diversos', pessoa = 'Física', doc = '000.000.000-00', 
    telefone = '(00) 00000-0000', endereco = '' , ativo = 'Sim',
    obs = 'Esse cliente é exclusivo da loja para que não precisa sempre cadastrar clientes!',
    data = curDate(), banco = '', agencia = '', conta = '',email = 'cliente@cliente.com' ");
}


// CRIAR UM FORNECEDOR DIVERSOS
$consulta4 = $pdo->query("SELECT * from fornecedores where id = 1 ");
$res4 = $consulta4->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg4 = @count($res4);

//CRIANDO FORNECEDOR
if ($total_reg4 == 0) {
    $pdo->query(" INSERT INTO fornecedores SET nome = 'Diversos', pessoa = 'Jurídica', doc = '000.000.000-00', 
    telefone = '(00) 00000-0000', endereco = '' , ativo = 'Sim',
    obs = 'Esse Fornecedor é exclusivo da loja para que não precisa sempre cadastrar um Forncedor!',
    data = curDate(), banco = '', agencia = '', conta = '',email = 'fornecedor@forn.com' ");
}





?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Carlos Daniel">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/estilo_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d9fe1d4535.js" crossorigin="anonymous"></script>


    <title> <?php echo $nome_sistema ?> </title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="account-wall">

                    <img class="profile-img" src="img/logo-150.png" alt="">
                    <form class="form-signin" method="post" action="autenticar.php">
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required autofocus>
                        <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        <div class="d-grid gap2 mt-2">
                            <button class="btn-style " type="submit">Acessar</button>
                        </div>
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>