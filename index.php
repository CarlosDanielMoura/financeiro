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
    $pdo->query(" INSERT INTO clientes SET nome = 'Sistema', pessoa = 'Física', doc = '000.000.000-00', 
    telefone = '(00) 00000-0000', endereco = '' , ativo = 'Sim',
    obs = 'Esse cliente é exclusivo da loja para que não precisa sempre cadastrar clientes!',
    data = curDate(), banco = '', agencia = '', conta = '',email = 'cliente@cliente.com' ");
}


// CRIAR UM FORNECEDOR PARA O SISTEMA
$consulta4 = $pdo->query("SELECT * from fornecedores where id = 1 ");
$res4 = $consulta4->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg4 = @count($res4);


//ROTINA PARA GERAR AS COBRANÇAS POR EMAIL
$query_cob = $pdo->query("SELECT * from cobrancas where data = curDate()");
$res_cob = $query_cob->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_cob) == 0){
    $query = $pdo->query("SELECT * from contas_receber where vencimento = curDate() 
    and status = 'Pendente' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $linhas_cob = @count($res);
    if($linhas_cob > 0){
        for($i=0; $i < @count($res); $i++){
            foreach ($res[$i] as $key => $value){} 
                $cliente = $res[$i]['cliente'];
                $descricao = $res[$i]['descricao'];
                $valor = $res[$i]['valor'];
                $valor = number_format($valor, 2, ',', '.');

            $query1 = $pdo->query("SELECT * from clientes where id = '$cliente' ");
            $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
            if(@count($res1) > 0){
                $nome_cliente = $res1[0]['nome'];
                $email_cliente = $res1[0]['email'];
                
                $destinatario = $email_cliente;
                $assunto = $nome_sistema . ' - Sua conta vence Hoje';
                $mensagem = utf8_decode('Olá '.$nome_cliente. "\r\n"."\r\n" . 'Sua conta '.$descricao. ' no valor de R$'.$valor. ' está vencendo hoje, se já pagou ignore nosso email! ');
                $cabecalhos = "From: ".$email_adm;
                @mail($destinatario, $assunto, $mensagem, $cabecalhos);                             
            }
        }
    }
    $pdo->query("INSERT INTO cobrancas set data = curDate(), quantidade = '$linhas_cob' ");
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
    <link rel="shortcut icon" href="img/logo-150.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/estilo_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/d9fe1d4535.js" crossorigin="anonymous"></script>





    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <!--===============================================================================================-->
    <title> <?php echo $nome_sistema ?> </title>
</head>






<body class="">

    <div class=" container-login100" style="background-image: url('img/testeImagem.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-30 p-b-30">
            <form class="login100-form validate-form" method="post" action="autenticar.php">
                <img src="./img/logo-150.png" alt="Logo">
                <div class="wrap-input100 validate-input m-b-20" data-validate="Entrar com seu Email">
                    <input type="email" name="email" class="form-control input100 mb-2" placeholder="Email" required
                        autofocus>
                </div>

                <div class="wrap-input100 validate-input m-b-25" data-validate="Entrar com a Senha">
                    <input type="password" name="senha" class="form-control input100" placeholder="Senha" required>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Acessar
                    </button>
                </div>
            </form>


        </div>
    </div>

    <!--
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
-->
    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>