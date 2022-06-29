<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'editar';

//require_once($pagina . "/campos.php");

$id = @$_GET['id'];

$query = $pdo->query("SELECT * from ordem_servico where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$json = json_decode($res[0]['obj']);

if($json->produtos->qtde_parcelas == ""){
    $json->produtos->qtde_parcelas = 0;
}

//print_r ($json->info_add);


if($json->info_add->laboratorio == ""){
    $json->info_add->laboratorio = 'Sem laboratório';
}

//print_r ($json->receita->adicao);
?>

<link rel="stylesheet" href="../css/os.css">

<link rel="stylesheet" href="../css/util.css">

<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/jquery/jquery.inputmask.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="../vendor/select2/select2.min.css">

<script src="https://kit.fontawesome.com/d9fe1d4535.js" crossorigin="anonymous"></script>


<div class="container-fluid">
    <form id="editar-os" action="" >
        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Editar O.S - Dados Principais</h3>
                <hr>
            </div>
            <div class="row" style="display:flex; align-items: center;">
                <div class="col-6 Input-details-func">
                    <label>Funcionário:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu funcionário"></i> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <select readonly="readonly" style="width: 100%;" class="form-select" aria-label="Default select example" name="func-dados-princ" id="func-dados-princ">
                        <option value="" selected><?php  ?></option>

                        <?php

                        $query = $pdo->query("SELECT * FROM usuarios order by nome asc");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }

                            $id_item = $res[$i]['id'];
                            $nome_item = $res[$i]['nome'];
                        ?>
                            <option value="<?php echo $id_item ?>" <?php if ($id_item == $json->dadosPrincipal->func_dados_princ) echo 'selected' ?>><?php echo $nome_item ?></option>

                        <?php } ?>
                    </select>

                </div>
                <div class="col-2"></div>
                <div class="col-2">
                    <div class="row">
                        <a class="button-88" onclick="inserir()" data-toggle="modal" data-target="#exampleModal">
                            Guia de Ajuda
                        </a>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-6 Input-details-func">
                    <label>Cliente:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu cliente"></i> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <select readonly="readonly" class="form-select sel2" aria-label="Default select example" name="cli-os-dados-princ" id="cli-os-dados-princ" style="width:100%;" required>
                        <option value=""></option>
                        <?php
                        $query = $pdo->query("SELECT * FROM clientes where ativo = 'Sim' order by nome asc");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_item = $res[$i]['id'];
                            $nome_item = $res[$i]['nome'];
                        ?>
                            <option value="<?php echo $id_item ?>" <?php if ($id_item == $json->dadosPrincipal->cli_dados_princ) echo 'selected' ?>><?php echo $nome_item ?></option>

                        <?php } ?>


                    </select>
                </div>
                <div class="col-3 Input-details-1">
                    <label>Data de Entrega:</label> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega" value="<?php echo $json->dadosPrincipal->data_entrega ?>" readonly>
                </div>
                <div class="col-3 Input-details-1">
                    <label>Hora de entrega:</label> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <input type="time" class="form-control" id="hora_entrega" name="hora_entrega" value="<?php echo $json->dadosPrincipal->hora_entrega  ?>" readonly>

                </div>
            </div>

            <div class="row">
                <div class="col-9 Input-details-obs">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" id="observacao" rows="3" name="obs-dados-princ" readonly><?php echo $json->dadosPrincipal->observacao_princ ?></textarea>

                </div>
            </div>

        </div>

        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Produtos e Serviços</h3>
                <hr>
            </div>
            <div class="row d-none">
                <div class="col-5 Input-details-func">
                    <label>Escolha os produtos:</label> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <i class="bi bi-question-circle-fill" title="Digite sua opção de produto pelo codigo , nome ou valor."></i>
                    <select  style="width: 100%;" class="form-select sel2" aria-label="Default select example" name="user-os" id="user-os">
                        <option value=""></option>
                        <?php
                        $query = $pdo->query("SELECT * FROM produtos where nome != 'Venda Rápida' order by nome asc");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_item = $res[$i]['id'];
                            $codigo = $res[$i]['codigo'];
                            $nome_item = $res[$i]['nome'];
                            $valor_venda = $res[$i]['valor_venda'];


                        ?>
                            <option value="<?php echo $id_item ?>">
                                <?php echo $codigo ?>
                                <?php echo ' - ' ?>
                                <?php echo $nome_item ?>

                            </option>

                        <?php } ?>
                    </select>
                </div>

                <div class="col-7 Input-details-add">
                    <a class="d-none" onclick="adicionaProdutoTab()" title="Adicionar Produto">
                        <i class="bi bi-plus-square-fill text-black "></i>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <style>

                        select[readonly] {
                        background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
                        pointer-events: none;
                        touch-action: none;
                        }
                        #tabela-produtos>tbody,
                        div>table.table-bordered>tbody>tr>td {
                            border-color: #dee2e6
                        }

                        #tabela-produtos tr,
                        #tabela-produtos td,
                        #tabela_resumo tr,
                        #tabela_resumo td {
                            text-align: center;
                            vertical-align: middle;
                        }

                        #tabela-produtos tr:nth-child(1),
                        #tabela-produtos td:nth-child(1) {
                            text-align: start;
                            vertical-align: middle;
                        }

                        #tabela_resumo tr:nth-child(1),
                        #tabela_resumo td:nth-child(1) {
                            text-align: end;
                            vertical-align: middle;
                        }

                        #tabela-produtos input,
                        #tabela_resumo input {
                            margin-bottom: 0;
                        }

                        .input-group-addon {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            width: 27px;
                            border: 1px solid #ced4da;
                        }
                    </style>
                    <script>
                        function calcTotalProdInd2(campoValUnLiq) {
                            const linha = campoValUnLiq.parentElement.parentElement;
                            calcTotalProdInd(linha.childNodes[3].firstChild);
                        }

                        function calcTotalProdInd(campoQtde) {
                            let qtde = campoQtde.value;
                            const linha = campoQtde.parentElement.parentElement;
                            let total = linha.childNodes[11];
                            let valor = linha.childNodes[9].childNodes[0].value.replace(",", ".");
                            if (qtde.length < 1) {
                                qtde = 1;
                            }
                            total.innerText = (Number.parseFloat(valor) * Number.parseInt(qtde)).toFixed(2);
                            //__TODO__ colorir campo de vermelho em desconto, ou verde em acrecimo
                            linha.childNodes[7].innerText = (Number.parseFloat(valor) - Number.parseFloat(linha.childNodes[5].innerText.replace(",", "."))).toFixed(2);
                            atualizaValorTotal(linha.parentElement);
                        }

                        function removeLinhaTabelaProd(aLixeira) {
                            let tbody = aLixeira.parentElement.parentElement.parentElement;
                            aLixeira.parentElement.parentElement.remove();
                            atualizaValorTotal(tbody);

                        }

                        function atualizaValorTotal(valTotal) {

                            let soma = 0;

                            const collection = document.getElementsByClassName('valor_venda');
                            for (let i = 0; i < collection.length; i++) {
                                soma += Number.parseFloat(collection[i].innerText)
                                //soma += Number.parseFloat(valTotal.childNodes[i].childNodes[11].innerText)
                            }
                            console.log(soma);
                            let resumo = document.getElementById("tabela_resumo").childNodes[3];
                            let totais = resumo.childNodes[1].childNodes[1];
                            let liquido = resumo.childNodes[5];
                            let valor_total = totais.childNodes[0].childNodes[5];
                            valor_total.innerText = soma.toFixed(2);

                            calLiquido();
                        }

                        function adicionaProdutoTab() {
                            const idProd = document.getElementById("user-os").value;
                            $.ajax({
                                url: `<?php echo $pagina; ?>/../ordem_servico/ajaxBuscaProduto.php?idProd=${idProd}`,
                                method: "GET",
                                dataType: "json",
                                success: function(produto) {
                                    //console.log(produto);
                                    let html = `
                                        <td class="b-clara">${produto.codigo} - ${produto.nome}</td>
                                        <td><input placeholder="1" min="1" max="${produto.estoque}" class="form-control" type="number" onkeyup="calcTotalProdInd(this)" onchange="calcTotalProdInd(this)"></td>
                                        <td>${produto.valor_venda.replace(".", ",")}</td>
                                        <td>0.00</td>
                                        <td><input onkeyup="calcTotalProdInd2(this)" onchange="calcTotalProdInd2(this)" class="form-control" type="text" value="${produto.valor_venda.replace(".", ",")}"></td>
                                        <td class="valor_venda">${produto.valor_venda.replace(".", ",")}</td>
                                        <td><a onclick="removeLinhaTabelaProd(this)"><i class="bi bi-trash text-danger"></i></a></td>
                                        <td class="d-none">${produto.id}</td>
                                    `;
                                    const tabela = document.getElementById("tabela-produtos");
                                    tabela.insertRow(-1);
                                    tabela.rows[tabela.rows.length - 1].innerHTML = html;
                                    atualizaValorTotal(tabela.childNodes[1]);
                                }
                            });
                        }
                    </script>

                    <table class="table table-striped table-bordered" id="tabela-produtos">
                        <tr>
                            <td style="width: 40%;">Código Prod - Nome produto</td>
                            <td style="width: 8%;">Qtde</td>
                            <td style="width: 12%;">Val. Unit</td>
                            <td style="width: 8%;">Acre/Desc</td>
                            <td style="width: 8%;">Val. Un.Liq.</td>
                            <td style="width: 8%;">Val. Total</td>
                            <td style="width: 8%;">Ações</td>
                            <td class="d-none">id</td>
                        </tr>
                        <?php
                        require_once("../conexao.php");
                        foreach ($json->produtos->produtos_selecionados as $key => $prod) {
                            $query = $pdo->prepare("SELECT * from produtos where ativo = 'Sim' and estoque > 0 and id = :idProd ");
                            $query->bindValue(":idProd", $prod->id);
                            $query->execute();
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);
                            $produto = $res[0];

                        ?>
                            <tr clas="prods">
                                <td class="b-clara"><?php echo $produto["codigo"] ?> - <?php echo $produto["nome"] ?></td>
                                <td><input placeholder="1" min="1" max="<?php echo $produto["estoque"] ?>" class="form-control" type="number" onkeyup="calcTotalProdInd(this)" onchange="calcTotalProdInd(this)" readonly></td>
                                <td><?php echo str_replace(',', '.', $produto["valor_venda"]) ?></td>
                                <td>0.00</td>
                                <td><input onkeyup="calcTotalProdInd2(this)" onchange="calcTotalProdInd2(this)" class="form-control" type="text" value="<?php echo str_replace(',', '.', $produto["valor_venda"]) ?>" readonly></td>
                                <td class="valor_venda"><?php echo str_replace(',', '.', $produto["valor_venda"]) ?></td>
                                <td><a class="d-none" onclick="removeLinhaTabelaProd(this)"><i class="bi bi-trash text-danger"></i></a></td>
                                <td class="d-none"><?php echo $produto["id"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <hr>
            <div id="tabela_resumo" class="detalhes-pagamento row">
                <div class="col-8 mt-3">
                    <div class="row d-flex">
                        <div class="col-4">
                            <label for=""> <b> Entrada do Cliente: R$</b></label>
                            <input type="number" onchange="calcSubtotal(this)" onkeyup="calcSubtotal(this)" style="text-align: end;" name="vlr_entrada_cliente" id="vlr_entrada_cliente" class="form-control" value="<?php echo $json->produtos->valor_entrada_cliente ?>" readonly>
                        </div>
                        <div class="col-4">
                            <label for=""><b> Tipo de Pagamento: </b></label>
                            <select class="form-select" aria-label="Default select example" name="tipo_pagamento_cli" id="tipo_pagamento_cli">
                                <option value="<?php echo $json->produtos->valor_entrada_cliente ?>"><?php echo $json->produtos->tipo_pagamento ?></option>
                                <option value="Cartão Crédito">Cartão de Crédito</option>
                                <option value="Cartão Débito">Cartão de Débito</option>
                                <option value="Dinheiro">Dinheiro</option>
                                <option value="Boleto">Boleto</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Conta Corrente">Conta Corrente</option>
                                <option value="Conta Poupança">Conta Poupança</option>
                                <option value="Carnê">Carnê</option>
                                <option value="Depósito">Depósito</option>
                                <option value="Transferência">Transferência</option>
                                <option value="Pix">Pix</option>
                            </select>

                        </div>
                        <div class="col-4">
                            <label title="Quantidade de parcelas que o cliente deseja." for=""> </label>
                            <b> Parcelas:</b> <input style="text-align: end; width: 6rem;" type="number" placeholder="0" maxlength="12" minlength="1" class="form-control" name="vlr_qtde_parc" id="vlr_qtde_parc" value="<?php  echo $json->produtos->qtde_parcelas ?>" readonly> </h5>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4">
                            <label title="Valor restante que o cliente ainda tem a pagar." for=""> </label>
                            <h5><b> SubTotal: <b>R$</b></b> <input style="text-align: end;" type="number" class="form-control" name="vlr_subtotal_cli" id="vlr_subtotal_cli" value="<?php echo $json->produtos->subTotal_Cliente ?>" readonly> </h5>
                        </div>

                    </div>

                </div>
                <div class="col-4" style="font-weight: bolder">
                    <table>
                        <tr>
                            <td style="width: 30%;">Valor total:</td>
                            <td style="width: 30%;"></td>
                            <td id="vlr_total" style="width: 30%;"><?php echo $json->produtos->valor_Total_produtos ?></td>
                            <td style="width: 10%;" class="text-primary">( + )</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Desconto:</td>
                            <td style="width: 30%;">
                                <!--Salvar desconto em % no banco-->
                                <div class="input-group"> <input step="0.01" onkeyup="attPorcentagemDesconto()" onchange="attPorcentagemDesconto(); arredondaPra2(this)" name="porcentagem_desconto" id="porcentagem_desconto" class="form-control" type="number" placeholder="porcentagem" autocomplete="off" value="<?php echo $json->produtos->porcen_desconto ?>" readonly><span class="input-group-addon">
                                        <span class="fa fa-percent" style="background:transparent;border:none"></span>
                                    </span></div>
                            </td>
                            <td style="width: 30%;">

                                <div class="input-group"><input step="0.01" onkeyup="attDinheiroDesconto()" onchange="attDinheiroDesconto(); arredondaPra2(this)" name="dinheiro_desconto" id="dinheiro_desconto" class="form-control" type="number" placeholder="dinheiro" autocomplete="off" value="<?php echo $json->produtos->desconto ?>" readonly><span class="input-group-addon">
                                        <span class="fa fa-dollar" style="background:transparent;border:none"></span>
                                    </span></div>
                            </td>
                            <td style="width: 10%;" class="text-danger">( - )</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Acréscimo:</td>
                            <td style="width: 30%;">
                                <!--Salvar acrescimo em % no banco-->
                                <div class="input-group"><input step="0.01" onkeyup="attPorcentagemAcrescimo()" onchange="attPorcentagemAcrescimo(); arredondaPra2(this)" name="porcentagem_acrescimo" id="porcentagem_acrescimo" class="form-control" type="number" placeholder="porcentagem" autocomplete="off" value="<?php echo $json->produtos->porcen_acrescimno ?>" readonly><span class="input-group-addon">
                                        <span class="fa fa-percent" style="background:transparent;border:none"></span>
                                    </span></div>
                            </td>
                            <td style="width: 30%;">
                                <div class="input-group"> <input step="0.01" onkeyup="attDinheiroAcrescimo()" onchange="attDinheiroAcrescimo(); arredondaPra2(this)" name="dinheiro_acrescimo" id="dinheiro_acrescimo" class="form-control" type="number" placeholder="dinheiro" autocomplete="off" value="<?php echo $json->produtos->acrescimo ?>" readonly><span class="input-group-addon">
                                        <span class="fa fa-dollar" style="background:transparent;border:none"></span>
                                    </span>
                            </td>
                            <td style="width: 10%;" class="text-primary">( + )</td>
                        </tr>
                    </table>
                    <hr>
                    <table style="font-size: 18px;">
                        <tr>
                            <td style="width: 40%;">Valor Líquido:</td>
                            <td style="width: 2%;"></td>
                            <td id="vlr_liquido" style="width: 48%; text-align: end;" class="text-primary"><?php echo $json->produtos->valor_liquido ?></td>
                            <td style="width: 10%;" class="text-primary">( = )</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function arredondaPra2(self) {
                self.value = Number.parseFloat(self.value).toFixed(2);
            }

            function attDinheiroDesconto() {
                let dinheiro_desconto = document.getElementById("dinheiro_desconto");
                let valor_final = 0
                let valor_total = document.getElementById("vlr_total").innerText
                valor_total = Number.parseFloat(valor_total)

                if (valor_total > 0) {
                    valor_final = (dinheiro_desconto / valor_total) * 100;
                }
                let porcentagem_desconto = document.getElementsByName("porcentagem_desconto")[0];
                porcentagem_desconto.value = valor_final.toFixed(2);
                calLiquido()
            }

            function attPorcentagemDesconto() {
                let porcentagem_desconto = document.getElementById("porcentagem_desconto").value;
                let valor_final = 0
                let valor_total = document.getElementById("vlr_total").innerText
                valor_total = Number.parseFloat(valor_total)
                if (valor_total > 0) {
                    valor_final = (porcentagem_desconto * valor_total) / 100;
                }

                let dinheiro_desconto = document.getElementsByName("dinheiro_desconto")[0];

                dinheiro_desconto.value = valor_final.toFixed(2)
                calLiquido()
            }

            function attPorcentagemAcrescimo() {
                var valor_porcentagem = document.getElementById("porcentagem_acrescimo").value;

                let valor_final = 0
                let valor_total = document.getElementById("vlr_total").innerText
                valor_total = Number.parseFloat(valor_total)
                if (valor_total > 0) {
                    valor_final = (valor_porcentagem * valor_total) / 100;
                }

                let dinheiro_desconto = document.getElementById("dinheiro_acrescimo");

                dinheiro_desconto.value = valor_final.toFixed(2)
                calLiquido()

            }

            function attDinheiroAcrescimo() {
                let dinheiro_acrescimo = document.getElementById("dinheiro_acrescimo").value
                let valor_final = 0
                let valor_total = document.getElementById("vlr_total").innerText
                valor_total = Number.parseFloat(valor_total)

                if (valor_total > 0) {
                    valor_final = (dinheiro_acrescimo / valor_total) * 100;
                }
                let porcentagem_desconto = document.getElementById("porcentagem_acrescimo");
                porcentagem_desconto.value = valor_final.toFixed(2);
                calLiquido()
            }

            function calLiquido() {

                //Pegando o valor total
                let valor_total = document.getElementById("vlr_total").innerText
                valor_total = Number.parseFloat(valor_total)


                //Pegando o Campo dinheiro da parte desconto
                let campo_dinheiro_desconto = document.getElementById("dinheiro_desconto").value
                //Pegando o Campo dinheiro da parte de acrescimo
                let campo_dinheiro_acrescimo = document.getElementById("dinheiro_acrescimo").value

                if (valor_total > 0) {
                    if (campo_dinheiro_desconto > 0) {
                        valor_total = valor_total - campo_dinheiro_desconto;

                    }

                    if (campo_dinheiro_acrescimo > 0) {
                        valor_total = parseFloat(valor_total) + parseFloat(campo_dinheiro_acrescimo);
                    }
                }

                //Pegar o campo liquido e jogando o valor final em liquido
                let campo_liquido = document.getElementById("vlr_liquido");
                campo_liquido.innerText = valor_total.toFixed(2)

                //Pegando o valor liquido e jogando no sub total;
                let campo_subTotal = document.getElementById("vlr_subtotal_cli");
                campo_subTotal.value = valor_total.toFixed(2);

                calcSubtotal(document.getElementById("vlr_entrada_cliente"))
            }

            function calcSubtotal(self) {

                let valor_EntradaCli = self.value
                let valor_Final = 0;

                //Pegando o campo subTotal
                let valor_liquido = document.getElementById("vlr_liquido")

                //Campo subtotal
                let campo_subtotal = document.getElementById("vlr_subtotal_cli");
                valor_Final = Number.parseFloat(valor_liquido.innerText) - valor_EntradaCli;
                campo_subtotal.value = valor_Final.toFixed(2)
            }
        </script>



        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Dados da Receita</h3>

            </div>
            <hr>
            <div class="row">
                <div class="col-5 Input-details-func">
                    <label>Profissional Responsável:</label>
                    <select readonly="readonly" class="form-select " aria-label="Default select example" name="func-resp" id="func-resp">
                           <option value="Maicon Lucas Fraga">Maicon Lucas Fraga</option>
                    </select>
                </div>


                <div class="col-3 Input-details-func">
                    <label>Receita valida até:</label>
                    <input type="date" class="form-control" name="data_receita_valida" value="<?php echo $json->receita->receita_valida ?>" readonly>
                </div>
            </div>
            <hr>

            <div class="col-12">
                <div class="table-responsive">
                    <div style="min-width: 626px; display: flex">
                        <table style="width: 25%; margin-top: 35px;" class="table table-bordered table responsive table-condensed pull-left receita-label">
                            <tbody>
                                <tr class="text-success">
                                    <td rowspan="2" class="border-green" style="width: 3px; padding: 0px;">LONGE</td>
                                    <td class="border-green" style="text-align: center"><i class="fa fa-fw fa-eye fa-lg"></i>OD</td>
                                </tr>
                                <tr class="text-success">
                                    <td class="border-green"><i class="fa fa-fw fa-eye fa-lg"></i>OE</td>
                                </tr>
                                <tr class="text-danger">
                                    <td rowspan="2" class=" border-red">PERTO</td>
                                    <td class="border-red"><i class="fa fa-fw fa-eye fa-lg"></i>OD</td>
                                </tr>
                                <tr class="text-danger">
                                    <td class="border-red"><i class="fa fa-fw fa-eye fa-lg"></i>OE</td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width: 75%;" class="table table-bordered table-responsive table-condensed receita">
                            <thead>
                                <th>Esférico</th>
                                <th>Cilíndrico</th>
                                <th>Eixo</th>
                                <th>Altura</th>
                                <th>DNP</th>
                            </thead>
                            <tbody>
                                <tr class="text-success">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="valor-esferico_od_longe" name="vlr_esferico_longe_od" type="text" maxlength="6" autocomplete="off" value="<?php echo $json->receita->esferico_od_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="valor-cilindrico-od-longe" name="vlr_cilindrico_longe_od" type="text" maxlength="6" autocomplete="of" value="<?php echo $json->receita->cilindrico_od_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="valor_eixo_od_longe" autocomplete="off" maxlength="12" name="valor_eixo_od_longe" type="text" value="<?php echo $json->receita->eixo_od_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" name="vlr_altura_od_longe" id="vlr_altura_od_longe" type="text" value="<?php echo $json->receita->altura_od_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" autocomplete="off" name="vlr_dnp_od_longe" id="vlr_dnp_od_longe" type="text" value="<?php echo $json->receita->dnp_od_longe ?>" readonly>
                                    </td>
                                </tr>
                                <tr class="text-success">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_esferico_oe_longe" autocomplete="off" name="vlr_esferico_oe_longe" type="text" maxlength="6" value="<?php echo $json->receita->esferico_oe_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_oe_longe" autocomplete="off" name="vlr_cilindrico_oe_longe" type="text" maxlength="6" value="<?php echo $json->receita->cilindrico_oe_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="vlr_eixo_oe_longe" name="vlr_eixo_oe_longe" autocomplete="off" maxlength="12" type="text" value="<?php echo $json->receita->eixo_oe_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" name="vlr_altura_oe_longe" id="vlr_altura_oe_longe" autocomplete="off" maxlength="7" type="text" value="<?php echo $json->receita->altura_oe_longe ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input maxlength="7" class="input-sm form-control numeric-field text-right" name="vlr_dnp_oe_longe" id="vlr_dnp_oe_longe" autocomplete="off" type="text" value="<?php echo $json->receita->dnp_oe_longe ?>" readonly>
                                    </td>
                                </tr>
                                <tr class="text-danger">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" name="valor-esferico_od_perto" id="valor-esferico_od_perto" autocomplete="off" type="text" maxlength="6" value="<?php echo $json->receita->esferico_od_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_od_perto" name="vlr_cilindrico_od_perto" autocomplete="off" type="text" maxlength="6" value="<?php echo $json->receita->cilindrico_od_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="vlr_eixo_od_perto" name="vlr_eixo_od_perto" autocomplete="off" maxlength="12" type="text" value="<?php echo $json->receita->eixo_od_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" name="vlr_altura_od_perto" id="vlr_altura_od_perto" type="text" value="<?php echo $json->receita->altura_od_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input maxlength="7" class="input-sm form-control numeric-field text-right" id="vlr_dnp_od_perto" name="vlr_dnp_od_perto" autocomplete="off" type="text" value="<?php echo $json->receita->dnp_od_perto ?>" readonly>
                                    </td>


                                </tr>
                                <tr class="text-danger">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="valor-esferico_oe_perto" autocomplete="off" name="valor-esferico_oe_perto" type="text" maxlength="6" value="<?php echo $json->receita->esferico_oe_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_oe_perto" autocomplete="off" name="vlr_cilindrico_oe_perto" type="text" maxlength="6" value="<?php echo $json->receita->cilindrico_oe_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="vlr_eixo_oe_perto" autocomplete="off" maxlength="12" name="vlr_eixo_oe_perto" type="text" value="<?php echo $json->receita->eixo_oe_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" id="vlr_altura_oe_perto" name="vlr_altura_oe_perto" type="text" value="<?php echo $json->receita->altura_oe_perto ?>" readonly>
                                    </td>

                                    <td class="border-black">
                                        <input maxlength="7" class="input-sm form-control numeric-field text-right" autocomplete="off" name="vlr_dnp_oe_perto" id="vlr_dnp_oe_perto" type="text" value="<?php echo $json->receita->dnp_oe_perto ?>" readonly>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="input-add">
                        <strong><label class="label-in-add" for="in-add" readonly>Adição:</label></strong>
                        <input readonly onkeyup="addInPerto(this)" id="in-add" name="in-add" autocomplete="off" class="input-sm form-control numeric-field in-adicao" type="text" value=" <?php echo $json->receita->adicao ?>">
                        <script>
                            
                            $("#in-add").inputmask({
                                substitutes: {
                                    ".": ","
                                }
                            });
                        </script>
                    </div>

                </div>
            </div>
            <div class="form-floating mt-5">
                <textarea class="form-control" id="obs_receita" name="obs_receita" style="height: 100px" readonly><?php echo $json->receita->observacao ?></textarea>
                <label for="obs_receita">Observações:</label>
            </div>
        </div>

        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Informações Adicionais</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="check-receita-montagem " style="display: flex; flex-direction: column;">

                        <div class="title-type">
                            <label>Local da Montagem: <strong class="text-danger">(*)</strong></label>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Loja" <?php if (@$json->info_add->local_montagem == 'Loja') echo 'checked' ?>>
                                    <label class="form-check-label" for="check-montagem-loja">
                                        Loja
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Laboratorio" <?php if (@$json->info_add->local_montagem == 'Laboratorio') echo 'checked' ?>>
                                    <label class="form-check-label" for="check-montagem-laboratorio">
                                        Laboratório
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check d-none">
                                    <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Nenhum" <?php if (@$json->info_add->local_montagem == 'Nenhum') echo 'checked' ?>>
                                    <label class="form-check-label" for="check-montagem-laboratorio">
                                        Nenhuma
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 Input-details-func">
                    <label>Laboratório:</label>

                    <select readonly="readonly" class="form-select" aria-label="Default select example" name="laboratorio" id="laboratorio">
                        <option value="<?php echo $json->info_add->laboratorio?>"><?php echo $json->info_add->laboratorio ?></option>
                        <option value="Bausch Lomb">Bausch Lomb</option>
                        <option value="Bausch Lomb">Haytek</option>
                        <option value="Ottilab">Ottilab</option>
                        <option value="Uberlentes">Uberlentes</option>
                    </select>
                </div>

                <div class="col-4 ">
                    <div class="check-receita-montagem " style="display: flex; flex-direction: column; margin-left: 25px;">

                        <div class="title-type">
                            <label>Possui Receita: <strong class="text-danger">(*)</strong></label>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-sim" value="Sim" <?php if (@$json->info_add->possui_receita == 'Sim') echo 'checked' ?>>
                                    <label class="form-check-label" for="check-receita-sim">
                                        Sim
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-nao" value="Nao" <?php if (@$json->info_add->possui_receita == 'Nao') echo 'checked' ?>>
                                    <label class="form-check-label" for="check-receita-nao">
                                        Não
                                    </label>
                                </div>
                            </div>

                            <div class="col-3 d-none">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-nao" value="Nenhum" <?php if (@$json->info_add->possui_receita == 'Nenhum') echo 'checked' ?>>
                                    <label class="form-check-label" for="check-receita-nao">
                                        Nenhuma
                                    </label>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <hr class="mt-5">
            </div>


            <div class="container-box">
                <div class="box-lente">
                    <div class="title-lente">
                        <h5 class="title-box">Lente</h5>
                    </div>
                    <!--CheckBox Tipo-->
                    <div class="title-type">
                        <span>Tipo:</span>
                    </div>
                    <div class="check-tipo ">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTipo" id="check-sim" value="Pronta" <?php if (@$json->info_add->info_add_lente->tipo_lente == "Pronta") echo 'checked' ?>>
                            <label class="form-check-label" for="check-sim">
                                Pronta
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTipo" id="check-nao" value="Surfacada" <?php if (@$json->info_add->info_add_lente->tipo_lente == "Surfacada") echo 'checked' ?>>
                            <label class="form-check-label" for="check-nao">
                                Surfaçada
                            </label>
                        </div>
                        
                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" name="checkedTipo" id="check-nao" value="Nenhum" <?php if (@$json->info_add->info_add_lente->tipo_lente == "Nenhum") echo 'checked' ?>>
                            <label class="form-check-label" for="check-nao">
                                Nenhum
                            </label>
                        </div>

                    </div>
                    <div class="title-type">
                        <span>Material:</span>
                    </div>
                    <div class="check-tipo">
                        <!---CheckBox Material-->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Poli" value="Policarbonato" <?php if (@$json->info_add->info_add_lente->tipo_material == "Policarbonato") echo 'checked' ?>>
                            <label class="form-check-label" for="check-Poli">
                                Policarbonato
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Resina" value="Resina" <?php if (@$json->info_add->info_add_lente->tipo_material == "Resina") echo 'checked' ?>>
                            <label class="form-check-label" for="check-Resina">
                                Resina
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Trivex" value="Trivex" <?php if (@$json->info_add->info_add_lente->tipo_material == "Trivex") echo 'checked' ?>>
                            <label class="form-check-label" for="check-Trivex">
                                Trivex
                            </label>
                        </div>

                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Trivex" value="Nenhum" <?php if (@$json->info_add->info_add_lente->tipo_material == "Nenhum") echo 'checked' ?>>
                            <label class="form-check-label" for="check-Trivex">
                                Nenhuma
                            </label>
                        </div>
                    </div>
                    <!--Inputs DESCRIÇÃO/COLORAÇÃO-->
                    <div class="inputs-variacao">
                        <div class="inputs">
                            <label>Descrição:</label>
                            <input type="text" name="desc_lente" id="in-descri-lentes" value="<?php echo $json->info_add->info_add_lente->descricao ?>" readonly>
                        </div>

                        <div class="inputs">
                            <label>Coloração:</label>
                            <input type="text" name="coloracao_lente" id="in-descri-lentes" value="<?php echo $json->info_add->info_add_lente->coloracao ?>" readonly>
                        </div>
                    </div>


                    <div class="title-type">
                        <span>Tratamentos:</span>
                    </div>
                    <div class="select-lente">
                        <!---CheckBox tratamentos-->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Easy-Clean" value="Easy-Clean" <?php if (@$json->info_add->info_add_lente->tratamentos == 'Easy-Clean') echo 'checked' ?>>
                            <label class="form-check-label" for="check-Easy-Clean">
                                Easy Clean
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-No-Risk" value="No-Risk" <?php if (@$json->info_add->info_add_lente->tratamentos == 'No-Risk') echo 'checked' ?>>
                            <label class="form-check-label" for="check-No-Risk">
                                No-Risk
                            </label>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Optkot" value="Optkot" <?php if (@$json->info_add->info_add_lente->tratamentos == 'Optkot') echo 'checked' ?>>
                            <label class="form-check-label" for="check-Optkot">
                                Optkot
                            </label>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Outros" value="Outros" <?php if (@$json->info_add->info_add_lente->tratamentos == 'Outros') echo 'checked' ?>>
                            <label class="form-check-label" for="check-Outros">
                                Outros
                            </label>
                        </div>

                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Outros" value="Nenhum" <?php if (@$json->info_add->info_add_lente->tratamentos == 'Nenhum') echo 'checked' ?>>
                            <label class="form-check-label" for="check-Outros">
                                Nenhuma
                            </label>
                        </div>
                    </div>
                </div>

                <!--Armação-->
                <div class="box-armacao">
                    <div class="title-armacao">
                        <h5 class="title-box">Armação</h5>
                    </div>

                    <div class="title-type-2">
                        <span>Armação própria:</span>
                        <span>Segue Armação:</span>
                    </div>
                    <div class="arm">
                        <!--CheckedBox Armação-->
                        <div class="check-tipo ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedArmProp" id="check-sim" value="sim" <?php if (@$json->info_add->info_add_armacao->arm_possui_prop == 'sim') echo 'checked' ?>>
                                <label class="form-check-label" for="check-sim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedArmProp" id="check-nao" value="nao" <?php if (@$json->info_add->info_add_armacao->arm_possui_prop == 'nao') echo 'checked' ?>>
                                <label class="form-check-label" for="check-nao">
                                    Não
                                </label>
                            </div>

                            <div class="form-check d-none">
                                <input class="form-check-input" type="radio" name="checkedArmProp" id="check-nao" value="Nenhum" <?php if (@$json->info_add->info_add_armacao->arm_possui_prop == 'Nenhum') echo 'checked' ?>>
                                <label class="form-check-label" for="check-nao">
                                    Nenhuma
                                </label>
                            </div>
                        </div>
                        <div class="check-tipo ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedSegArm" id="check-sim" value="sim" <?php if (@$json->info_add->info_add_armacao->arm_segue == 'sim') echo 'checked' ?>>
                                <label class="form-check-label" for="check-sim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedSegArm" id="check-nao"  value="nao" <?php if (@$json->info_add->info_add_armacao->arm_segue == 'nao') echo 'checked' ?>>
                                <label class="form-check-label" for="check-nao">
                                    Não
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedSegArm" id="check-nao"  value="Nenhum" <?php if (@$json->info_add->info_add_armacao->arm_segue == 'Nenhum') echo 'checked' ?>>
                                <label class="form-check-label" for="check-nao">
                                    Nenhum
                                </label>
                            </div>
                        </div>
                    </div>

                    <!--Select armação-->
                    <div class="title-type mt-3">
                        <span>Tipo:</span>
                    </div>
                    <div class="select-arm mt-2">
                        <select readonly="readonly" class="form-select" aria-label="Default select example" name="tipo_armacao">
                            <option value="<?php echo $json->info_add->info_add_armacao->arm_tipo ?>"><?php echo $json->info_add->info_add_armacao->arm_tipo ?></option>
                            <option value="Friso/Fio de Nylon">Friso/Fio de Nylon</option>
                            <option value="Furo/Parafuso">Furo/Parafuso</option>
                            <option value="Metal">Metal</option>
                            <option value="Zilo/Acetato">Zilo/Acetato</option>
                        </select>
                    </div>
                    <!--Inputs Armação-->

                    <div class="inputs-armacao mt-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Aro:</label>
                                    <input onkeyup="somaAroePonte()" class="form-control" type="number" name="in-aro-arm" id="in-aro-arm" value="<?php echo @$json->info_add->info_add_armacao->arm_aro ?>" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Ponte:</label>
                                    <input onkeyup="somaAroePonte()" class="form-control" type="number" name="in-ponte-arm" id="in-ponte-arm" value="<?php echo @$json->info_add->info_add_armacao->arm_ponte ?>" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Aro + Ponte:</label>
                                    <input type="number" class="form-control" name="in-aro-ponto-arm" id="in-aro-ponto-arm" readonly value="<?php echo @$json->info_add->info_add_armacao->arm_aro_ponte ?>" >
                                    <script>
                                        function somaAroePonte() {
                                            const r = document.getElementById("in-aro-ponto-arm");
                                            let aro = document.getElementById("in-aro-arm").value;
                                            let ponte = document.getElementById("in-ponte-arm").value;
                                            if (aro.length < 1) aro = 0;
                                            if (ponte.length < 1) ponte = 0;
                                            r.value = Number.parseFloat(aro) + Number.parseFloat(ponte);
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Inputs Diagonal / Vertical / Pupilar--->
                    <div class="inputs-armacao mt-4">

                        <div class="row">

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Maior Diagonal:</label>
                                    <input type="number" class="form-control" name="maior_diagonal" id="maior_diagonal" value="<?php echo $json->info_add->info_add_armacao->arm_maior_diagonal ?>" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Altura Vertical:</label>
                                    <input type="number" class="form-control" name="altura_vertical" id="altura_vertical" value="<?php echo $json->info_add->info_add_armacao->arm_altura_vertical ?>" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Distância Pupilar:</label>
                                    <input type="number" class="form-control" name="distancia_pupilar" id="distancia_pupilar" value="<?php echo $json->info_add->info_add_armacao->arm_distancia_pupilar ?>" readonly>
                                </div>
                            </div>



                        </div>
                    </div>

                    <!---Inputs Altura do Centro Otico (CO)-->
                    <div class="title-type mt-4">
                        <span>Altura do centro Otico (CO):</span>
                    </div>
                    <div class="inputs-armacao-olhos mt-2">
                        <div class="inputs-arm">
                            <label>Longe OD</label>
                            <input type="number" name="longe-od" id="longe-od" value="<?php echo $json->info_add->info_add_armacao->altura_longe_OD ?>" readonly>
                        </div>
                        <div class="inputs-arm">
                            <label>Longe OE</label>
                            <input type="number" name="longe-oe" id="longe-oe" value="<?php echo $json->info_add->info_add_armacao->altura_longe_OE ?>" readonly>
                        </div>
                    </div>
                    <div class="inputs-armacao-olhos">
                        <div class="inputs-arm">
                            <label>Perto OD</label>
                            <input type="number" name="perto_od" id="perto_od" value="<?php echo $json->info_add->info_add_armacao->altura_perto_OD ?>" readonly>
                        </div>
                        <div class="inputs-arm">
                            <label>Perto OE</label>
                            <input type="number" name="perto-oe" id="perto-oe" value="<?php echo $json->info_add->info_add_armacao->altura_perto_OE ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="form-control" name="id" id="id" value="<?php  echo $id ?>" >
        </div>
        <div class="row mt-3 mb-4">
            <div class="box-btns">
                <div class="btns">
                    <button class="btn-voltar_os">Voltar</button>
                </div>
            </div>
        </div>

    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Guia de ajuda!</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir" method="post">
                <div class="modal-body">
                    <div class="texto-guia">
                        <p>Essa página é somente para visualizar os dados</p>
                    </div>
                </div>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn-fechar-excluir">Sair</button>

                </div>
            </form>
        </div>
    </div>
</div>


<script src="../vendor/select2/select2.min.js"></script>


<script>
    function inserir() {

        $("#tituloModalEditar").text("Guia de ajuda!");
        var myModal = new bootstrap.Modal(document.getElementById("modalExcluir"), {
            backdrop: "static",
        });
        myModal.show();

    }
</script>