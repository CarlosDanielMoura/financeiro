<?php
require_once("conexao.php");


// Criar o usuário adminitrador caso não exista
$consulta = $pdo->query("SELECT * from usuarios where nivel = 'Administrador' ");
$res = $consulta->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg = @count($res);



// Criar o nivel administrador
$consulta2 = $pdo->query("SELECT * from niveis where nivel = 'Administrador' ");
$res2 = $consulta2->fetchAll(PDO::FETCH_ASSOC); // verificando se tem usuario adm
$total_reg2 = @count($res2);

// Criando conta !
if ($total_reg == 0) {
    $pdo->query("INSERT INTO usuarios SET nome = '$nome_adm', email = '$email_adm', senha = '123', nivel = 'Administrador' ");
}

//Criando nivel
if ($total_reg2 == 0) {
    $pdo->query("INSERT INTO niveis SET nivel = 'Administrador' ");
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