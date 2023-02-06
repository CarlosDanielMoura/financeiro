<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'ordem_servico';

//require_once($pagina . "/campos.php");
?>

<link rel="stylesheet" href="../css/os.css">

<link rel="stylesheet" href="../css/util.css">

<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/jquery/jquery.inputmask.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="../vendor/select2/select2.min.css">

<script src="https://kit.fontawesome.com/d9fe1d4535.js" crossorigin="anonymous"></script>


<div class="container-fluid">
    <form id="os" action="">
        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Nova O.S - Dados Principais</h3>
                <hr>
            </div>
            <div class="row" style="display:flex; align-items: center;">
                <div class="col-6 Input-details-func">
                    <label>Funcionário:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu funcionário"></i> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <select style="width: 100%;" class="form-select" aria-label="Default select example" name="func-dados-princ" id="func-dados-princ">
                        <option value=""></option>

                        <?php

                        $query = $pdo->query("SELECT * FROM usuarios where nivel != 'Administrador' order by nome asc");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_item = $res[$i]['id'];
                            $nome_item = $res[$i]['nome'];
                        ?>
                            <option value="<?php echo $id_item ?>"><?php echo $nome_item ?></option>

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
                    <select class="form-select sel2" aria-label="Default select example" name="cli-os-dados-princ" id="cli-os-dados-princ" style="width:100%;" required>
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
                            <option value="<?php echo $id_item ?>"><?php echo $nome_item ?></option>

                        <?php } ?>


                    </select>
                </div>
                <div class="col-3 Input-details-1">
                    <label>Data de Entrega:</label> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega">
                </div>
                <!--<div class="col-3 Input-details-1">-->
                <!--    <label>Hora de entrega:</label> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>-->
                <!--    <input type="time" class="form-control" id="hora_entrega" name="hora_entrega">-->

                <!--</div>-->
            </div>

            <div class="row">
                <div class="col-9 Input-details-obs">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" id="observacao" rows="3" name="obs-dados-princ"></textarea>

                </div>
            </div>

        </div>

        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Produtos e Serviços</h3>
                <hr>
            </div>
            <div class="row ">
                <div class="col-5 Input-details-func">
                    <label>Escolha os produtos:</label> <span title="Preenchimento obrigatório " class="text-danger">(*)</span>
                    <i class="bi bi-question-circle-fill" title="Digite sua opção de produto pelo codigo , nome ou valor."></i>
                    <select style="width: 100%;" class="form-select sel2" aria-label="Default select example" name="user-os" id="user-os">
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
                    <a class="" id="btn_add_prod" onclick="adicionaProdutoTab()" title="Adicionar Produto">
                        <i class="bi bi-plus-square-fill text-black "></i>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <style>
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
                            for (let i = 2; i < valTotal.childNodes.length; i++) {
                                soma += Number.parseFloat(valTotal.childNodes[i].childNodes[11].innerText.replace(",", "."));
                            }

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
                                url: `<?php echo $pagina; ?>/ajaxBuscaProduto.php?idProd=${idProd}`,
                                method: "GET",
                                dataType: "json",
                                success: function(produto) {

                                    //console.log(produto);
                                    let html = `
                                        <td class="b-clara">${produto.codigo} - ${produto.nome}</td>
                                        <td><input placeholder="1" min="1"  class="form-control" type="number" onkeyup="calcTotalProdInd(this);" onchange="calcTotalProdInd(this);" id="qtd_prod"></td>
                                        <td>${produto.valor_venda.replace(".", ",")}</td>
                                        <td>0.00</td>
                                        <td><input onkeyup="calcTotalProdInd2(this)" onchange="calcTotalProdInd2(this)" class="form-control" type="text" value="${produto.valor_venda.replace(".", ",")}"></td>
                                        <td>${produto.valor_venda.replace(".", ",")}</td>
                                        <td><a onclick="removeLinhaTabelaProd(this)"><i class="bi bi-trash text-danger"></i></a></td>
                                        <td class="d-none">${produto.id}</td>
                                    `
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

                    </table>
                </div>
            </div>
            <hr>
            <div id="tabela_resumo" class="detalhes-pagamento row">
                <div class="col-8 mt-3">
                    <div class="row d-flex">
                        <div class="col-4">
                            <label for=""> <b> Entrada do Cliente: R$</b></label>
                            <input type="text" onchange="calcSubtotal(this);" style="text-align: end;" name="vlr_entrada_cliente" id="vlr_entrada_cliente" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for=""><b> Tipo de Pagamento: </b></label>
                            <select class="form-select" aria-label="Default select example" name="tipo_pagamento_cli" id="tipo_pagamento_cli">
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
                            <b> Parcelas:</b> <input style="text-align: end; width: 6rem;" type="number" placeholder="1" maxlength="12" minlength="1" class="form-control" name="vlr_qtde_parc" id="vlr_qtde_parc"> </h5>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4">
                            <label title="Valor restante que o cliente ainda tem a pagar." for=""> </label>
                            <h5><b> SubTotal: <b>R$</b></b> <input style="text-align: end;" type="text" class="form-control" name="vlr_subtotal_cli" id="vlr_subtotal_cli" readonly> </h5>
                        </div>

                    </div>

                </div>
                <div class="col-4" style="font-weight: bolder">
                    <table>
                        <tr>
                            <td style="width: 30%;">Valor total:</td>
                            <td style="width: 30%;"></td>
                            <td id="vlr_total" style="width: 30%;">0.00</td>
                            <td style="width: 10%;" class="text-primary">( + )</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Desconto:</td>
                            <td style="width: 30%;">
                                <div class="input-group"> <input step="0.01" onkeyup="attPorcentagemDesconto()" onchange="attPorcentagemDesconto(); arredondaPra2(this)" name="porcentagem_desconto" id="porcentagem_desconto" class="form-control" type="number" placeholder="porcentagem" autocomplete="off"><span class="input-group-addon">
                                        <span class="fa fa-percent" style="background:transparent;border:none"></span>
                                    </span></div>
                            </td>
                            <td style="width: 30%;">
                                <div class="input-group"><input step="0.01" onkeyup="attDinheiroDesconto()" onchange="attDinheiroDesconto(); arredondaPra2(this)" name="dinheiro_desconto" id="dinheiro_desconto" class="form-control" type="number" placeholder="dinheiro" autocomplete="off"><span class="input-group-addon">
                                        <span class="fa fa-dollar" style="background:transparent;border:none"></span>
                                    </span></div>
                            </td>
                            <td style="width: 10%;" class="text-danger">( - )</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Acréscimo:</td>
                            <td style="width: 30%;">
                                <div class="input-group"><input step="0.01" onkeyup="attPorcentagemAcrescimo()" onchange="attPorcentagemAcrescimo(); arredondaPra2(this)" name="porcentagem_acrescimo" id="porcentagem_acrescimo" class="form-control" type="number" placeholder="porcentagem" autocomplete="off"><span class="input-group-addon">
                                        <span class="fa fa-percent" style="background:transparent;border:none"></span>
                                    </span></div>
                            </td>
                            <td style="width: 30%;">
                                <div class="input-group"> <input step="0.01" onkeyup="attDinheiroAcrescimo()" onchange="attDinheiroAcrescimo(); arredondaPra2(this)" name="dinheiro_acrescimo" id="dinheiro_acrescimo" class="form-control" type="number" placeholder="dinheiro" autocomplete="off"><span class="input-group-addon">
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
                            <td id="vlr_liquido" style="width: 48%; text-align: end;" class="text-primary">00.00</td>
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
                let dinheiro_desconto = document.getElementById("dinheiro_desconto").value;
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

                let valor_EntradaCli = self.value.replace(',', '.');
                let valor_Final = 0;
                self.value = valor_EntradaCli;


                //Pegando o campo subTotal
                let valor_liquido = document.getElementById("vlr_liquido")

                //Campo subtotal
                let campo_subtotal = document.getElementById("vlr_subtotal_cli");


                valor_Final = Number.parseFloat(valor_liquido.innerText) - valor_EntradaCli;
                //console.log(valor_Final)
                campo_subtotal.value = valor_Final.toFixed(2);
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
                    <input type="date" class="form-control" name="data_receita_valida">
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
                                        <input onchange="trataNumero(this)" onkeyup="addInPerto()" class="input-sm text-right input-mask-receita-field form-control" id="valor-esferico_od_longe" name="vlr_esferico_longe_od" type="text" autocomplete="off" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" onkeyup="addInPerto()" class="input-sm text-right input-mask-receita-field form-control" id="valor-cilindrico-od-longe" name="vlr_cilindrico_longe_od" autocomplete="off" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataEixo(this)" onkeyup="addInPerto()" class="input-sm form-control numeric-field text-right" id="valor_eixo_od_longe" autocomplete="off" maxlength="12" name="valor_eixo_od_longe" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" name="vlr_altura_od_longe" id="vlr_altura_od_longe" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" class="input-sm form-control numeric-field text-right" autocomplete="off" name="vlr_dnp_od_longe" id="vlr_dnp_od_longe" type="text">
                                    </td>
                                </tr>
                                <tr class="text-success">
                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" onkeyup="addInPerto()" class="input-sm text-right input-mask-receita-field form-control" id="vlr_esferico_oe_longe" autocomplete="off" name="vlr_esferico_oe_longe" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" onkeyup="addInPerto()" class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_oe_longe" autocomplete="off" name="vlr_cilindrico_oe_longe" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataEixo(this)" onkeyup="addInPerto()" class="input-sm form-control numeric-field text-right" id="vlr_eixo_oe_longe" name="vlr_eixo_oe_longe" autocomplete="off" maxlength="12" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" class="input-sm form-control numeric-field text-right" name="vlr_altura_oe_longe" id="vlr_altura_oe_longe" autocomplete="off" maxlength="7" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" maxlength="7" class="input-sm form-control numeric-field text-right" name="vlr_dnp_oe_longe" id="vlr_dnp_oe_longe" autocomplete="off" type="text">
                                    </td>
                                </tr>
                                <tr class="text-danger">
                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" class="input-sm text-right input-mask-receita-field form-control" name="valor-esferico_od_perto" id="valor-esferico_od_perto" autocomplete="off" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_od_perto" name="vlr_cilindrico_od_perto" autocomplete="off" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataEixo(this)" class="input-sm form-control numeric-field text-right" id="vlr_eixo_od_perto" name="vlr_eixo_od_perto" autocomplete="off" maxlength="12" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" name="vlr_altura_od_perto" id="vlr_altura_od_perto" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" maxlength="7" class="input-sm form-control numeric-field text-right" id="vlr_dnp_od_perto" name="vlr_dnp_od_perto" autocomplete="off" type="text">
                                    </td>


                                </tr>
                                <tr class="text-danger">
                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" class="input-sm text-right input-mask-receita-field form-control" id="valor-esferico_oe_perto" autocomplete="off" name="valor-esferico_oe_perto" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataNumero(this)" class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_oe_perto" autocomplete="off" name="vlr_cilindrico_oe_perto" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataEixo(this)" class="input-sm form-control numeric-field text-right" id="vlr_eixo_oe_perto" autocomplete="off" maxlength="12" name="vlr_eixo_oe_perto" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" id="vlr_altura_oe_perto" name="vlr_altura_oe_perto" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input onchange="trataAlturaDnp(this)" maxlength="7" class="input-sm form-control numeric-field text-right" autocomplete="off" name="vlr_dnp_oe_perto" id="vlr_dnp_oe_perto" type="text">
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="input-add">
                        <strong><label class="label-in-add" for="in-add">Adição:</label></strong>
                        <input onkeyup="addInPerto()" id="in-add" name="in-add" autocomplete="off" class="input-sm form-control numeric-field in-adicao" type="text">
                        <script>
                            function addInPerto() {

                                // Valor adição
                                let adicao = document.getElementById("in-add").value;
                                valor_adicao = parseFloat(adicao)

                                if (adicao != '') {
                                    //Valor dos campos esfericos
                                    let esf_od = document.getElementById("valor-esferico_od_longe").value;
                                    valor_esf_od = Number.parseFloat(esf_od);



                                    let esf_oe = document.getElementById("vlr_esferico_oe_longe").value;
                                    valor_esf_oe = Number.parseFloat(esf_oe)


                                    //Veerificando campos vazios

                                    if (esf_od == '' || esf_oe == '') {

                                        valor_esf_oe = 0;
                                        valor_esf_od = 0
                                    }



                                    // Pegando os valores que vão receber
                                    let esferico_perto_od = document.getElementById('valor-esferico_od_perto');
                                    let esferico_perto_oe = document.getElementById('valor-esferico_oe_perto');

                                    // Jogando os valores no campo
                                    let valor_final_perto_od = (valor_esf_od + valor_adicao);
                                    if (valor_final_perto_od > 0) {
                                        esferico_perto_od.value = '+' + valor_final_perto_od.toFixed(2).replace(',', '.');;

                                    } else {
                                        esferico_perto_od.value = valor_final_perto_od.toFixed(2).replace(',', '.');;
                                    }

                                    let valor_final_perto_oe = (valor_esf_oe + valor_adicao);
                                    if (valor_final_perto_oe > 0) {
                                        esferico_perto_oe.value = '+' + valor_final_perto_oe.toFixed(2).replace(',', '.');;
                                    } else {
                                        esferico_perto_oe.value = valor_final_perto_oe.toFixed(2).replace(',', '.');;
                                    }
                                    // Pegandos os campos Cilindrico 
                                    let cilindrico_od_longe = document.getElementById("valor-cilindrico-od-longe").value;
                                    let cilindrico_oe_longe = document.getElementById("vlr_cilindrico_oe_longe").value;

                                    let valor_final_od_longe = Number.parseFloat(cilindrico_od_longe);
                                    let valor_final_oe_longe = Number.parseFloat(cilindrico_oe_longe);
                                    //Jogando os valores 
                                    let cilindrico_od_perto = document.getElementById("vlr_cilindrico_od_perto");
                                    let cilindrinco_oe_perto = document.getElementById("vlr_cilindrico_oe_perto");




                                    if (cilindrico_od_longe != '' || cilindrico_od_longe > 0) {
                                        if (cilindrico_od_longe > 0) {
                                            cilindrico_od_perto.value = '+' + valor_final_od_longe.toFixed(2).replace(',', '.');
                                        } else {
                                            cilindrico_od_perto.value = valor_final_od_longe.toFixed(2).replace(',', '.');
                                        }


                                    } else {
                                        cilindrico_od_perto.value = ''
                                    }




                                    if (cilindrico_oe_longe != '' || cilindrico_oe_longe > 0) {
                                        if (cilindrico_oe_longe > 0) {
                                            cilindrinco_oe_perto.value = '+' + valor_final_oe_longe.toFixed(2).replace(',', '.');
                                        } else {
                                            cilindrinco_oe_perto.value = valor_final_oe_longe.toFixed(2).replace(',', '.');
                                        }
                                    }


                                    //Pegando os valores do Eixo

                                    let eixo_od_longe = document.getElementById("valor_eixo_od_longe").value
                                    let eixo_oe_longe = document.getElementById("vlr_eixo_oe_longe").value

                                    //Transformando os valores em Float
                                    let valor_final_od_longe_eixo = Number.parseFloat(eixo_od_longe);
                                    let valor_final_oe_longe_eixo = Number.parseFloat(eixo_oe_longe);

                                    //Jogando os valores nos campos certos
                                    let eixo_od_perto = document.getElementById("vlr_eixo_od_perto");
                                    let eixo_oe_perto = document.getElementById("vlr_eixo_oe_perto");


                                    if (eixo_od_longe != '' || eixo_od_longe > 0) {
                                        eixo_od_perto.value = valor_final_od_longe_eixo + '°';

                                    } else {
                                        eixo_od_perto.value = ''
                                    }

                                    if (eixo_oe_longe != '' || eixo_oe_longe > 0) {
                                        eixo_oe_perto.value = valor_final_oe_longe_eixo + '°';

                                    } else {
                                        eixo_oe_perto.value = '';

                                    }
                                    // let nt = inAdd.value > 0 ? "+" + inAdd.value : inAdd.value;
                                    // ['valor-esferico_oe_perto', 'valor-esferico_od_perto'].forEach((c) => {
                                    //     document.getElementById(c).value = nt; 
                                    // })

                                }




                            }
                            $("#in-add").inputmask({
                                substitutes: {
                                    ",": "."
                                }
                            });

                            

                            function trataNumero(self) {
                                let valor_novo = self.value.replace(',', '.')
                                if (valor_novo > 0) {
                                    valor_novo = '+' + valor_novo
                                } else {
                                    valor_novo = valor_novo
                                }

                                self.value = valor_novo;
                                console.log(valor_novo)
                            }

                            function trataNumeroEntrada(self) {
                                let valor_novo = Number.parseFloat(self.value);
                                valor_novo = valor_novo.replace(',', '.');
                                self.value = valor_novo;
                            }


                            function trataEixo(self) {
                                let valor_novo = self.value.replace(',', '.')
                                if (valor_novo > 0) {
                                    valor_novo = valor_novo + '°';
                                }

                                self.value = valor_novo;
                            }

                            function trataAlturaDnp(self) {
                                let valor_novo = self.value.replace(',', '.')
                                if (valor_novo > 0) {
                                    valor_novo = valor_novo + 'mm';
                                }

                                self.value = valor_novo;
                            }
                        </script>
                    </div>

                </div>
            </div>
            <div class="form-floating mt-5">
                <textarea class="form-control" name="obs_receita" id="obs_receita" style="height: 100px"></textarea>
                <label for="obs_receita">Observações</label>
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
                                    <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Loja">
                                    <label class="form-check-label" for="check-montagem-loja">
                                        Loja
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Laboratorio">
                                    <label class="form-check-label" for="check-montagem-laboratorio">
                                        Laboratório
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 Input-details-func">
                    <label>Laboratório:</label>

                    <select class="form-select" aria-label="Default select example" name="laboratorio" id="laboratorio">
                        <option value="Sem laboratório" selected>Escolha uma opção</option>
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
                                    <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-sim" value="Sim">
                                    <label class="form-check-label" for="check-receita-sim">
                                        Sim
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-nao" value="Nao">
                                    <label class="form-check-label" for="check-receita-nao">
                                        Não
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
                            <input class="form-check-input" type="radio" name="checkedTipo" id="check-sim" value="Pronta">
                            <label class="form-check-label" for="check-sim">
                                Pronta
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTipo" id="check-nao" value="Surfacada">
                            <label class="form-check-label" for="check-nao">
                                Surfaçada
                            </label>
                        </div>

                    </div>
                    <div class="title-type">
                        <span>Material:</span>
                    </div>
                    <div class="check-tipo">
                        <!---CheckBox Material-->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Poli" value="Policarbonato">
                            <label class="form-check-label" for="check-Poli">
                                Policarbonato
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Resina" value="Resina">
                            <label class="form-check-label" for="check-Resina">
                                Resina
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedMaterial" id="check-Trivex" value="Trivex">
                            <label class="form-check-label" for="check-Trivex">
                                Trivex
                            </label>
                        </div>
                    </div>
                    <!--Inputs DESCRIÇÃO/COLORAÇÃO-->
                    <div class="inputs-variacao">
                        <div class="inputs">
                            <label>Descrição:</label>
                            <input type="text" name="desc_lente" id="in-descri-lentes">
                        </div>

                        <div class="inputs">
                            <label>Coloração:</label>
                            <input type="text" name="coloracao_lente" id="in-descri-lentes">
                        </div>
                    </div>


                    <div class="title-type">
                        <span>Tratamentos:</span>
                    </div>
                    <div class="select-lente">
                        <!---CheckBox tratamentos-->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Easy-Clean" value="Easy-Clean">
                            <label class="form-check-label" for="check-Easy-Clean">
                                Easy Clean
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-No-Risk" value="No-Risk">
                            <label class="form-check-label" for="check-No-Risk">
                                No-Risk
                            </label>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Optkot" value="Optkot">
                            <label class="form-check-label" for="check-Optkot">
                                Optkot
                            </label>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedTratamentos" id="check-Outros" value="Outros">
                            <label class="form-check-label" for="check-Outros">
                                Outros
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
                                <input class="form-check-input" type="radio" name="checkedArmProp" id="check-sim" value="sim">
                                <label class="form-check-label" for="check-sim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedArmProp" id="check-nao" value="nao">
                                <label class="form-check-label" for="check-nao">
                                    Não
                                </label>
                            </div>
                        </div>
                        <div class="check-tipo ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedSegArm" id="check-sim" value="sim">
                                <label class="form-check-label" for="check-sim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedSegArm" id="check-nao" value="nao">
                                <label class="form-check-label" for="check-nao">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>

                    <!--Select armação-->
                    <div class="title-type mt-3">
                        <span>Tipo:</span>
                    </div>
                    <div class="select-arm mt-2">
                        <select class="form-select" aria-label="Default select example" name="tipo_armacao">
                            <option selected>Selecione uma opção</option>
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
                                    <input onkeyup="somaAroePonte()" class="form-control" type="number" name="in-aro-arm" id="in-aro-arm">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Ponte:</label>
                                    <input onkeyup="somaAroePonte()" class="form-control" type="number" name="in-ponte-arm" id="in-ponte-arm">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Aro + Ponte:</label>
                                    <input type="number" class="form-control" name="in-aro-ponto-arm" id="in-aro-ponto-arm" readonly>
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
                                    <input type="number" class="form-control" name="maior_diagonal" id="maior_diagonal">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Altura Vertical:</label>
                                    <input type="number" class="form-control" name="altura_vertical" id="altura_vertical">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="inputs-arm">
                                    <label>Distância Pupilar:</label>
                                    <input type="number" class="form-control" name="distancia_pupilar" id="distancia_pupilar">
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
                            <input type="number" name="longe-od" id="longe-od">
                        </div>
                        <div class="inputs-arm">
                            <label>Longe OE</label>
                            <input type="number" name="longe-oe" id="longe-oe">
                        </div>
                    </div>
                    <div class="inputs-armacao-olhos">
                        <div class="inputs-arm">
                            <label>Perto OD</label>
                            <input type="number" name="perto_od" id="perto_od">
                        </div>
                        <div class="inputs-arm">
                            <label>Perto OE</label>
                            <input type="number" name="perto-oe" id="perto-oe">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-4">
            <div class="box-btns">
                <div class="btns">
                    <button class="btn-voltar_os">Voltar</button>
                </div>
                <div class="btns">
                    <button class="btn-cad_os" type="submit">Cadastrar OS</button>
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
                        <p>Itens:</p>
                        <ul>
                            <li> Funcioanário</li>
                            <li>Cliente</li>
                            <li>Data de entrega</li>
                            <li>Produtos</li>
                            <li>Possui receita</li>
                            <li>Local Montagem</li>
                        </ul>
                        <p>Esse símbolo <span class="text-danger"> (*) </span> significa que esses itens são obrigatório a se preencher!</p>
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
    $(document).ready(function() {
        $('#cli-os-dados-princ').select2({
            placeholder: 'Selecione um Cliente',

        });

        $('#user-os').select2({
            placeholder: 'Selecione um Produto',

        });

        $('#func-dados-princ').select2({
            placeholder: 'Selecione um Funcionario',

        });
    })

    function buscaIdProd(id) {
        $.ajax({
            url: `ordem_servico/addProdUni.php?idProd=${id}`,
            type: "GET",
            dataType: "json",
            success: function(mensagem) {
                console.log(mensagem);
            },
        });
    }

    function inserir() {

        $("#tituloModal").text("Guia de ajuda!");
        var myModal = new bootstrap.Modal(document.getElementById("modalExcluir"), {
            backdrop: "static",
        });
        myModal.show();

    }


    $("#os").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var json = Object.fromEntries(formData);

        var x;
        x = document.getElementById("func-dados-princ").value;
        if ((x == "") || (x == null)) {
            return false;
        };

        var a;
        a = document.getElementById("func-dados-princ").value;
        if ((a == "") || (a == null)) {
            return false;
        };

        var p;
        p = document.getElementById("user-os").value;
        if ((p == "") || (p == null)) {
            return false;
        };

        var dataEntregue;
        dataEntregue = document.getElementById("data_entrega").value;
        if ((dataEntregue == "") || (dataEntregue == null)) {
            return false;
        };




        const produtos = document.getElementById("tabela-produtos").childNodes[1];
        let Lprodutos = [];
        for (let i = 2; i < produtos.childNodes.length; i++) {
            let qtde = produtos.childNodes[i].childNodes[3].childNodes[0].value.length < 1 ? 1 : produtos.childNodes[i].childNodes[3].childNodes[0].value;

            let produto = geraProduto(
                produtos.childNodes[i].childNodes[15].innerText,
                produtos.childNodes[i].childNodes[1].innerText,
                qtde,
                produtos.childNodes[i].childNodes[5].innerText.replace(",", "."),
                produtos.childNodes[i].childNodes[7].innerText.replace(",", "."),
                produtos.childNodes[i].childNodes[9].childNodes[0].value.replace(",", "."),
                produtos.childNodes[i].childNodes[11].innerText.replace(",", ".")
            );
            Lprodutos.push(produto);
        }

        function geraProduto(id, codENome, qtde, valUnit, acresOuDesc, valUnLiq, valTotal) {
            return {
                id,
                codENome,
                qtde,
                valUnit,
                acresOuDesc,
                valUnLiq,
                valTotal
            };
        }

        //console.log(produtos);
        var obj_formatado = {

            "dadosPrincipal": {
                "data_entrega": json["data_entrega"],
                "timeZone": Intl.DateTimeFormat().resolvedOptions().timeZone,
                "observacao_princ": json["obs-dados-princ"],
                "cli_dados_princ": json["cli-os-dados-princ"],
                "func_dados_princ": json["func-dados-princ"]
            },

            "produtos": {
                "produtos_selecionados": Lprodutos,
                "valor_entrada_cliente": json["vlr_entrada_cliente"],
                "tipo_pagamento": json["tipo_pagamento_cli"],
                "qtde_parcelas": json["vlr_qtde_parc"],
                "subTotal_Cliente": json["vlr_subtotal_cli"],
                "valor_Total_produtos": Number.parseFloat(document.getElementById("vlr_total").innerText).toFixed(2),
                "valor_liquido": Number.parseFloat(document.getElementById("vlr_liquido").innerText).toFixed(2),
                "desconto": json["dinheiro_desconto"],
                "acrescimo": json["dinheiro_acrescimo"],
                "porcen_desconto": json["porcentagem_desconto"],
                "porcen_acrescimno": json["porcentagem_acrescimo"]
            },
            "receita": {
                //Dados principais
                "profissional_resp": json["func-resp"],
                "receita_valida": json["data_receita_valida"],
                "observacao": json["obs_receita"],
                "adicao": json['in-add'],
                //Linha 1
                "esferico_od_longe": json["vlr_esferico_longe_od"],
                "cilindrico_od_longe": json["vlr_cilindrico_longe_od"],
                "eixo_od_longe": json["valor_eixo_od_longe"],
                "altura_od_longe": json["vlr_altura_od_longe"],
                "dnp_od_longe": json["vlr_dnp_od_longe"],
                //Linha 2   
                "esferico_oe_longe": json["vlr_esferico_oe_longe"],
                "cilindrico_oe_longe": json["vlr_cilindrico_oe_longe"],
                "eixo_oe_longe": json["vlr_eixo_oe_longe"],
                "altura_oe_longe": json["vlr_altura_oe_longe"],
                "dnp_oe_longe": json["vlr_dnp_oe_longe"],
                //linha 3
                "esferico_od_perto": json["valor-esferico_od_perto"],
                "cilindrico_od_perto": json["vlr_cilindrico_od_perto"],
                "eixo_od_perto": json["vlr_eixo_od_perto"],
                "altura_od_perto": json["vlr_altura_od_perto"],
                "dnp_od_perto": json["vlr_dnp_od_perto"],
                //linha 4
                "esferico_oe_perto": json["valor-esferico_oe_perto"],
                "cilindrico_oe_perto": json["vlr_cilindrico_oe_perto"],
                "eixo_oe_perto": json["vlr_eixo_oe_perto"],
                "altura_oe_perto": json["vlr_altura_oe_perto"],
                "dnp_oe_perto": json["vlr_dnp_oe_perto"],
            },
            "info_add": {
                "local_montagem": json["checkedLocalMontagem"],
                "possui_receita": json["checkedReceita-possui"],
                "laboratorio": json["laboratorio"],

                "info_add_lente": {
                    "tipo_lente": json["checkedTipo"],
                    "tipo_material": json["checkedMaterial"],
                    "descricao": json["desc_lente"],
                    "coloracao": json["coloracao_lente"],
                    "tratamentos": json["checkedTratamentos"]
                },
                "info_add_armacao": {
                    "arm_possui_prop": json["checkedArmProp"],
                    "arm_segue": json["checkedSegArm"],
                    "arm_tipo": json["tipo_armacao"],
                    "arm_aro": json["in-aro-arm"],
                    "arm_ponte": json["in-ponte-arm"],
                    "arm_aro_ponte": json["in-aro-ponto-arm"],
                    "arm_maior_diagonal": json["maior_diagonal"],
                    "arm_altura_vertical": json["altura_vertical"],
                    "arm_distancia_pupilar": json["distancia_pupilar"],
                    "altura_longe_OD": json["longe-od"],
                    "altura_longe_OE": json["longe-oe"],
                    "altura_perto_OD": json["perto_od"],
                    "altura_perto_OE": json["perto-oe"]
                }
            }
        }

        // https://jsonformatter.org/json-viewer Visualizar json
        //console.log(obj_formatado.dadosPrincipal);

        $.ajax({
            type: "POST",
            url: `<?php echo $pagina; ?>/inserir.php`,
            data: JSON.stringify(obj_formatado),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data, textStatus) {
                window.location.replace('index.php?pag=listar_os');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseJSON);
            }
        });

    });
</script>