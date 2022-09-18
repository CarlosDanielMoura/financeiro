<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'clientes';
require_once($pagina . "/campos.php");

$data_atual = date('Y-m-d');
$hora_atual = date('H:i:s');

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual . "-" . $mes_atual . "-01";
$data_ano = $ano_atual . "-01-01";

if ($mes_atual == '01' || $mes_atual == '03' || $mes_atual == '05' || $mes_atual == '07' || $mes_atual == '08' || $mes_atual == '10' || $mes_atual == '12') {
    $data_mes_fin = $ano_atual . "-" . $mes_atual . "-31";
} else if ($mes_atual == '02') {
    $data_mes_fin = $ano_atual . "-" . $mes_atual . "-28";
} else {
    $data_mes_fin = $ano_atual . "-" . $mes_atual . "-30";
}


$data_ano_fin = $ano_atual . "-12-31";
?>

<!--LINK DE CSS-->
<link rel="stylesheet" href="../css/icones.css">
<link rel="stylesheet" href="../css/home.css">

<div class="row align-items-center">
    <div class="col-md-2 my-4">
        <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Novo Cliente</a>
    </div>

    <div class="col-md-6 my-4">
        <small class="mx-4">
            <a title="Todos" class="text-primary" href="#" onclick="listar()"><span>Todos</span></a> /
            <a title="Débitos" class="text-danger" href="#" onclick="listarDebitos()"><span>Débitos</span></a>
        </small>
    </div>
</div>





<small>
    <div class="tableDados" id="listar">
    </div>
</small>


<!--Modal Usuário-->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" method="post">
                <div class="modal-body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Dados Pessoais</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Dados
                                Bancários</a>
                        </li>

                    </ul>

                    <hr>
                    <!-- Tabs Dados Pessoais -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">
                            <!-- CAMPO NOME -->
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo1 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="<?php echo $campo1 ?>" id="<?php echo $campo1 ?>" required>
                                    </div>
                                </div>
                                <!-- CAMPO PESSOA-->
                                <div class="col-md-2 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo2 ?></label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>">
                                            <option value="Física">Física</option>
                                            <option value="Jurídica">Jurídica</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- CAMPO DOCUMENTO-->
                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">CPF / CNPJ</label>
                                        <input type="text" class="form-control" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>" required>
                                    </div>
                                </div>
                                <!-- CAMPO EMAIL-->
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo11 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo11 ?>" id="<?php echo $campo11 ?>" placeholder="<?php echo $campo11 ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- CAMPO TELEFONE-->
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo4 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo4 ?>" placeholder="<?php echo $campo4 ?>" id="<?php echo $campo4 ?>" required>
                                    </div>
                                </div>

                                <!-- CAMPO ENDEREÇO-->
                                <div class="col-md-7 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo5 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo5 ?>" placeholder="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>">
                                    </div>
                                </div>

                                <!-- CAMPO ATIVO-->
                                <div class="col-md-2 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo6 ?></label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>">
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- CAMPOS OBSERVAÇÃO-->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Observações</label>
                                <textarea maxlength="150" class="form-control" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>"></textarea>
                            </div>


                        </div>
                        <!-- TABS  BANCO-->
                        <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- CAMPO BANCO-->
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo8 ?>
                                        </label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo8 ?>" id="<?php echo $campo8 ?>">
                                            <?php
                                            $query = $pdo->query("SELECT * FROM bancos order by nome asc");
                                            $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                            for ($i = 0; $i < @count($res); $i++) {
                                                foreach ($res[$i] as $key => $value) {
                                                }
                                                $id_item = $res[$i]['id'];
                                                $nome_item = $res[$i]['nome'];
                                            ?>
                                                <option value="<?php echo $nome_item ?>"><?php echo $nome_item ?></option>

                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>
                                <!-- CAMPO AGENCIA-->
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo9 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo9 ?>" placeholder="<?php echo $campo9 ?> Traço e Dígito" id="<?php echo $campo9 ?>">
                                    </div>
                                </div>

                                <!-- CAMPO CONTA-->
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo10 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo10 ?>" id="<?php echo $campo10 ?>" placeholder="<?php echo $campo10 ?> Corrente 012356-1">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- CAMPO MENSAGEM USUARIOS-->
                    <small>
                        <div id="mensagem" align="center"></div>
                    </small>


                    <input type="hidden" class="form-control" name="id" id="id">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Modal Excluir-->

<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir" method="post">
                <div class="modal-body">

                    Deseja Realmente excluir este Registro: <span id="nome-excluido"></span>?

                    <hr><small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir" id="id-excluir">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--Modal Ver Dados Clientes-->

<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Dados do Cliente</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small>

                    <!--LINHA 1-->
                    <div class="row">
                        <!--CAMPO NOME-->
                        <div class="col-6">
                            <span><b><?php echo $campo1 ?>:</b> <span id="campo1"></span></span>
                        </div>
                        <!--CAMPO ATIVO-->
                        <div class="col-6">
                            <span><b><?php echo $campo6 ?>:</b> <span id="campo6"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <!--LINHA 2-->
                    <div class="row">
                        <div class="col-6">
                            <!--CAMPO PESSOA-->
                            <span><b><?php echo $campo2 ?>:</b> <span id="campo2"></span></span>
                        </div>
                        <div class="col-6">
                            <!--CAMPO CPF/CNPJ-->
                            <span><b>CPF / CNPJ:</b> <span id="campo3"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 3-->
                    <div class="row">
                        <div class="col-6">
                            <!--CAMPO TELEFONE-->
                            <span><b><?php echo $campo4 ?>:</b> <span id="campo4"></span></span>
                        </div>

                        <div class="col-6">
                            <!--CAMPO EMAIL-->
                            <span><b><?php echo $campo11 ?>:</b> <span id="campo11"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 4-->
                    <div class="row">
                        <div class="col-12">
                            <!--CAMPO ENDEREÇO-->
                            <span><b><?php echo $campo5 ?>:</b> <span id="campo5"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 5-->
                    <div class="row">
                        <div class="col-12">
                            <!--CAMPO OBSERVAÇÃO-->
                            <span><b>Observação: </b><span id="campo7"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 6-->
                    <div class="row">
                        <div class="col-4">
                            <!--CAMPO BANCO-->
                            <span><b><?php echo $campo8 ?>:</b> <span id="campo8"></span></span>
                        </div>

                        <div class="col-4">
                            <!--CAMPO AGENCIA-->
                            <span><b><?php echo $campo9 ?>:</b> <span id="campo9"></span></span>
                        </div>

                        <div class="col-4">
                            <!--CAMPO CONTA-->
                            <span><b><?php echo $campo10 ?>:</b> <span id="campo10"></span></span>
                        </div>
                    </div>
                </small>

            </div>
        </div>
    </div>
</div>

<!--MODAL DE RELÁTORIO DE CLIENTES-->
<div class="modal fade" id="modalRel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relatório de Contas <small><small>(
                            <a href="#" class="text-primary" onclick="datas('1980-01-01', '2030-01-01', 'tudo-fin', 'fin')">
                                <span id="tudo-fin">Tudo</span>
                            </a> /
                            <a href="#" class="text-dark" onclick="datas('<?php echo $data_atual ?>', '<?php echo $data_atual ?>', 'hoje-fin', 'fin')">
                                <span id="hoje-fin">Hoje</span>
                            </a> /
                            <a href="#" class="text-dark" onclick="datas('<?php echo $data_mes ?>', '<?php echo $data_mes_fin ?>', 'mes-fin', 'fin')">
                                <span id="mes-fin">Mês</span>
                            </a> /
                            <a href="#" class="text-dark" onclick="datas('<?php echo $data_ano ?>', '<?php echo $data_ano_fin ?>', 'ano-fin', 'fin')">
                                <span id="ano-fin">Ano</span>
                            </a>
                            )</small></small></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="../relatorios/contasCliente_class.php" target="_blank">
                <div class="modal-body">
                    <div class="row">


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Status Contas</label>
                                <select class="form-select form-select-sm" aria-label="Default select example" name="status" id="status">
                                    <option value="">Todas</option>
                                    <option value="Debitos">Débitos</option>
                                    <option value="Pendente">Pendentes</option>
                                    <option value="Paga">Pagas</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Data Inicial
                                    (Vencimento)</label>
                                <input type="date" class="form-control form-control-sm" name="dataInicial" id="dtInicial" value="1980-01-01">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Data Final (Vencimento)</label>
                                <input type="date" class="form-control form-control-sm" name="dataFinal" id="dtFinal" value="2030-01-01">
                            </div>
                        </div>

                        <input type="hidden" name="id-cli" id="id-cli">
                    </div>


                </div>

                <small>
                    <div align="center" id="msg-config"></div>
                </small>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-config">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="modalDadosPagamentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Pagamentos referentes ao usuário</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" method="post">
                <div class="modal-body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#os_cliente" type="button" role="tab" aria-controls="home" aria-selected="true">Venda</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#crediario_cliente" type="button" role="tab" aria-controls="profile" aria-selected="false">Crediário</a>
                        </li>

                    </ul>


                    <!-- Tabs Dados Pessoais -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="os_cliente" role="tabpanel" aria-labelledby="home-tab">
                            <!-- CAMPO NOME -->

                            <div class="row mt-3">
                                <div id="vendas_clientes">

                                </div>
                            </div>


                        </div>
                        <!-- TABS  CREDIÁRIO-->
                        <div class="tab-pane fade" id="crediario_cliente" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- CAMPO BANCO-->
                            <div class="row mt-3">
                                <div class="col-md-12 d-flex" style="justify-content:center; gap: 10px;">
                                    <div class="col-md-4">
                                        <div class="dados_cliente d-flex" style="border: 1px solid gray;padding: 10px; align-items:center;justify-content:space-between; border-radius:5px;box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;">
                                            <div class="icons_card">
                                                <i class="bi bi-currency-dollar text-success" style="font-size: 30px;"></i>
                                            </div>
                                            <div class="conteudo_card d-flex" style="flex-direction: column;">
                                                <label style="font-size: 13px;">Total em Aberto</label>
                                                <strong><span style="font-size: 17px;">R$ 98,00</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="dados_cliente d-flex" style="border: 1px solid gray;padding: 10px; align-items:center;justify-content:space-between; border-radius:5px;box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;">
                                            <div class="icons_card">
                                                <i class="bi bi-currency-dollar text-danger" style="font-size: 30px;"></i>
                                            </div>
                                            <div class="conteudo_card d-flex" style="flex-direction: column;">
                                                <label style="font-size: 13px;">Total em Atraso</label>
                                                <strong><span style="font-size: 17px;">R$ 98,00</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="listar_parcelas_cliente" class="mt-5">
                            </div>

                        </div>
                    </div>



                    <input type="hidden" class="form-control" name="id_cliente_pag" id="id_cliente_pag">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL BAIXAR -->
<div class="modal fade" id="modalBaixarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Baixar Conta</span> - <span id="descricao-baixar"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-baixar" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Valor <small class="text-muted">(Total ou Parcial)</small></label>
                                <input onkeyup="totalizar()" type="text" class="form-control" name="valor-baixar" id="valor-baixar" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tipo de Entrada</label>
                                <select class="form-select" aria-label="Default select example" name="saida-baixar" id="saida-baixar">
                                    <option value="Caixa">Caixa (Movimento)</option>
                                    <option value="Cartão de Débito">Cartão de Débito</option>
                                    <option value="Cartão de Crédito">Cartão de Crédito</option>

                                    <?php
                                    $query = $pdo->query("SELECT * FROM bancos order by nome asc");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < @count($res); $i++) {
                                        foreach ($res[$i] as $key => $value) {
                                        }
                                        $id_item = $res[$i]['id'];
                                        $nome_item = $res[$i]['nome'];
                                    ?>
                                        <option value="<?php echo $nome_item ?>"><?php echo $nome_item ?></option>

                                    <?php } ?>


                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Desconto em R$</label>
                                <input onkeyup="totalizar()" type="text" class="form-control" name="valor-desconto" id="valor-desconto" placeholder="Ex 15.00" value="0">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Multa em R$</label>
                                <input onkeyup="totalizar()" type="text" class="form-control" name="valor-multa" id="valor-multa" placeholder="Ex 15.00" value="0">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Juros em R$</label>
                                <input onkeyup="totalizar()" type="text" class="form-control" name="valor-juros" id="valor-juros" placeholder="Ex 0.15" value="0">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">SubTotal</label>
                                <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
                            </div>
                        </div>
                    </div>




                    <small>
                        <div id="mensagem-baixar" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-baixar" id="id-baixar">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-baixar">Fechar</button>
                    <button type="submit" class="btn btn-success">Baixar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL RESÍDUOS-->
<div class="modal fade" id="modalResiduosClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Resíduos da Conta</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <small>
                    <div id="listar-residuos-clientes"></div>
                </small>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDadosCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Venda - SubTotal: R$ <span id="campo9"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!--LINHA 1-->
                <div class="row">
                    <!--Cliente-->
                    <div class="col-md-4">
                        <span class="mx-4"><b>Cliente:</b> <span id="campo12-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Vencimento-->
                        <span class="mx-4"><b>Vencimento:</b> <span id="campo6-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Venda-->
                        <span class="mx-5"><b>Venda:</b> <span id="id-cliente"></span></span>
                    </div>

                </div>
                <hr class="mb-3">



                <!--LINHA 2-->
                <div class="row">
                    <div class="col-md-4">
                        <!--Usuário-->
                        <span class="mx-4"><b>Usuário:</b> <span id="campo2-cliente"></span></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Status-->
                        <span class="mx-4"><b>Status:</b> <span id="campo11-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Data-->
                        <span class="mx-5"><b>Data:</b> <span id="campo5-cliente"></span></span>
                    </div>
                </div>

                <hr class="mb-3">
                <!--LINHA 3-->
                <div class="row mt-4 mb-3">
                    <div class="col-md-12">
                        <h5>
                            <h5>PRODUTOS VENDIDOS:</h5>
                        </h5>
                    </div>
                </div>

                <!--LINHA 4-->
                <small>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div id="listar-produtos-cliente"></div>
                        </div>
                    </div>
                </small>



                <!--LINHA 5-->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5>
                            <h5>INFORMAÇÕES FINANCEIRAS:</h5>
                        </h5>
                    </div>
                </div>
                <!--LINHA 6-->
                <small>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="listar-parcelas-cliente"></div>
                        </div>
                    </div>
                </small>



                <!--LINHA 7-->
                <div class="row">
                    <!--Lançamento-->
                    <div class="col-md-4">
                        <span class="mx-5"><b>Lançamento:</b> <span id="campo4-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Pagamento-->
                        <span class="mx-4"><b>Pagamento:</b> <span id="campo3-cliente"></span>
                    </div>

                    <div class="col-md-4">
                        <!--Parcelas-->
                        <span class="mx-4"><b>Parcelas:</b> <span id="campo10-cliente"></span></span>
                    </div>

                </div>



                <hr style="margin:10px;">
                <!--LINHA 8-->
                <div class="row">
                    <div class="col-md-4">
                        <!--Valor-->
                        <span class="mx-5"><b>Valor:</b> R$ <span id="campo1-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Desconto-->
                        <span class="mx-4"><b>Desconto:</b> R$ <span id="campo7-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Acréscimo-->
                        <span class="mx-4"><b>Acréscimo:</b> R$ <span id="campo8-cliente"></span></span>
                    </div>
                </div>
                <hr style="margin: 10px;">
                <div class="row">
                    <!--Lançamento-->
                    <div class="col-md-4">
                        <span class="mx-5"><b>Entrada do cliente:</b> <span id="campo14-cliente"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Pagamento-->
                        <span class="mx-4"><b>Tipo de entrada:</b> <span id="campo13-cliente"></span>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>





<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>


<script>
    $(document).ready(function() {
        //Funcão do CPF/CNPJ
        $('#<?= $campo3 ?>').mask('000.000.000-00');
        $('#<?= $campo3 ?>').attr('placeholder', 'CPF');

        $('#<?= $campo2 ?>').change(function() {
            if ($(this).val() == 'Física') {
                $('#<?= $campo3 ?>').mask('000.000.000-00');
                $('#<?= $campo3 ?>').attr('placeholder', 'CPF');
            } else {
                $('#<?= $campo3 ?>').mask('00.000.000/0000-00');
                $('#<?= $campo3 ?>').attr('placeholder', 'CNPJ');
            }
        });
    });



    function listar() {
        $.ajax({
            url: pag + "/listar.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }

    function listarDebitos() {

        $.ajax({
            url: pag + "/listar-debitos.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }

    function clientePagamento(id) {
        listarVendaCliente(id);
        $.ajax({
            url: `clientes/listarDebitosClientes.php`,
            method: 'POST',
            data: {
                id
            },
            dataType: "html",
            success: function(data) {
                $("#listar_parcelas_cliente").html(data);
                
            }
        });

        var myModal = new bootstrap.Modal(document.getElementById('modalDadosPagamentos'), {});
        myModal.show();

    }

    function listarVendaCliente(id){
        $.ajax({
            url: `clientes/listarVendasCliente.php`,
            method: 'POST',
            data: {
                id
            },
            dataType: "html",
            success: function(data) {
                $("#vendas_clientes").html(data);
                
            }
        });
    }

    function baixar(id, descricao, valor, saida) {
        $('#id-baixar').val(id);
        $('#descricao-baixar').text(descricao);
        $('#valor-baixar').val(valor);
        $('#saida-baixar').val(saida);
        $('#subtotal').val(valor);

        $('#juros-baixar').val('');
        $('#desconto-baixar').val('');
        $('#multa-baixar').val('');

        var myModal = new bootstrap.Modal(document.getElementById('modalBaixarCliente'), {});
        myModal.show();
        $('#mensagem-baixar').text('');
    }


    function relatorio(id) {
        $('#id-cli').val(id);
        var myModal = new bootstrap.Modal(document.getElementById('modalRel'), {});
        myModal.show();

    }

    function formatarData(data) {
        let newDate = new Date(data);
        return `${newDate.getDate()}/${newDate.getMonth()}/${newDate.getFullYear()}`
    }



    function totalizar() {
        valor = $('#valor-baixar').val();
        desconto = $('#valor-desconto').val();
        juros = $('#valor-juros').val();
        multa = $('#valor-multa').val();
        valor = valor.replace(",", ".");
        desconto = desconto.replace(",", ".");
        juros = juros.replace(",", ".");
        multa = multa.replace(",", ".");
        subtotal = parseFloat(valor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);
        $('#subtotal').val(subtotal);

    }

    function datas(data, datafin, id, campo) {
        var data_atual = "<?= $data_atual ?>";
        $('#dtInicial').val(data);
        $('#dtFinal').val(datafin);

        document.getElementById('hoje-' + campo).style.color = "#000";
        document.getElementById('tudo-' + campo).style.color = "#000";
        document.getElementById('mes-' + campo).style.color = "#000";
        document.getElementById('ano-' + campo).style.color = "#000";
        document.getElementById(id).style.color = "blue";
    }
</script>