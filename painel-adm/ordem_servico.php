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

<script src="https://kit.fontawesome.com/d9fe1d4535.js" crossorigin="anonymous"></script>


<div class="container-fluid">
    <form id="os" action="">
        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Nova O.S - Dados Principais</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-6 Input-details-func">
                    <label>Funcionário:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu funcionário"></i>
                    <select class="form-select" aria-label="Default select example" name="func-dados-princ" id="func-dados-princ">
                        <?php
                        $query = $pdo->query("SELECT * FROM usuarios order by nome asc");
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

            <div class="row">
                <div class="col-6 Input-details-func">
                    <label>Cliente:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu cliente"></i>
                    <select class="classeCliente form-select " aria-label="Default select example" name="cli-os-dados-princ" id="cli-os-dados-princ">
                        <?php
                        $query = $pdo->query("SELECT * FROM clientes where nome != 'Venda Rápida' order by nome asc");
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
                <div class="col-3 Input-details-1">
                    <label>Data de Entrega:</label>
                    <input type="date" class="form-control" name="data_entrega">
                </div>
                <div class="col-3 Input-details-1">
                    <label>Hora de entrega:</label>
                    <input type="time" class="form-control" name="hora_entrega">

                </div>
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
                    <label>Escolha os produtos:</label>
                    <i class="bi bi-question-circle-fill" title="Digite sua opção de produto pelo codigo , nome ou valor."></i>
                    <select class="form-select sel2" aria-label="Default select example" name="user-os" id="user-os">
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
                    <a class="" onclick="adicionaProdutoTab()" title="Adicionar Produto">
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
                            aLixeira.parentElement.parentElement.remove();
                            //___TODO___ ATUALIZAR PRODUTO QUANDO REMOVER.
                        }

                        function atualizaValorTotal(valTotal) {
                            let soma = 0;
                            for (let i = 2; i < valTotal.childNodes.length; i++) {
                                soma += Number.parseFloat(valTotal.childNodes[i].childNodes[11].innerText.replace(",", "."));
                            }
                            console.log(soma);
                            let resumo = document.getElementById("tabela_resumo").childNodes[3];
                            let totais = resumo.childNodes[1].childNodes[1];
                            let liquido = resumo.childNodes[5];
                            let valor_total = totais.childNodes[0].childNodes[5];
                            valor_total.innerText = soma.toFixed(2);
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
                                        <td><input placeholder="1" min="1" max="${produto.estoque}" class="form-control" type="number" onkeyup="calcTotalProdInd(this)" onchange="calcTotalProdInd(this)"></td>
                                        <td>${produto.valor_venda.replace(".", ",")}</td>
                                        <td>0.00</td>
                                        <td><input onkeyup="calcTotalProdInd2(this)" onchange="calcTotalProdInd2(this)" class="form-control" type="text" value="${produto.valor_venda.replace(".", ",")}"></td>
                                        <td>${produto.valor_venda.replace(".", ",")}</td>
                                        <td><a onclick="removeLinhaTabelaProd(this)"><i class="bi bi-trash text-danger"></i></a></td>
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
                        </tr>

                    </table>
                </div>
            </div>
            <hr>
            <div id="tabela_resumo" class="detalhes-pagamento row">
                <div class="col-8"></div>
                <div class="col-4" style="font-weight: bolder">
                    <table>
                        <tr>
                            <td style="width: 30%;">Valor total:</td>
                            <td style="width: 30%;"></td>
                            <td style="width: 30%;">0.00</td>
                            <td style="width: 10%;" class="text-primary">( + )</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Desconto:</td>
                            <td style="width: 30%;"><input class="form-control" type="text"></td>
                            <td style="width: 30%;"><input class="form-control" type="text"></td>
                            <td style="width: 10%;" class="text-danger">( - )</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Acréscimo:</td>
                            <td style="width: 30%;"><input class="form-control" type="text"></td>
                            <td style="width: 30%;"><input class="form-control" type="text"></td>
                            <td style="width: 10%;" class="text-primary">( + )</td>
                        </tr>
                    </table>
                    <hr>
                    <table style="font-size: 18px;">
                        <tr>
                            <td style="width: 40%;">Valor Líquido:</td>
                            <td style="width: 2%;"></td>
                            <td style="width: 48%; text-align: end;" class="text-primary">270,00</td>
                            <td style="width: 10%;" class="text-primary">( = )</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>



        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Dados da Receita</h3>

            </div>
            <hr>
            <div class="row">
                <div class="col-5 Input-details-func">
                    <label>Profissional Responsável:</label>
                    <select class="form-select " aria-label="Default select example" name="func-resp" id="func-resp">
                        <?php
                        $query = $pdo->query("SELECT * FROM usuarios order by nome asc");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_item = $res[$i]['id'];
                            $nome_item = $res[$i]['nome'];
                        ?>
                            <option value="<?php echo $nome_item ?>">
                                <?php echo $nome_item ?>
                            </option>

                        <?php } ?>
                    </select>
                </div>

                <div class="col-3 Input-details-func">
                    <label>Receita valida até:</label>
                    <input type="date" class="form-control" name="">
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
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="valor-esferico_od_longe" name="vlr_esferico_longe_od" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="valor-cilindrico-od-longe" name="vlr_cilindrico_longe_od" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="valor_eixo_od_longe" autocomplete="off" maxlength="12" name="valor_eixo_od_longe" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" name="vlr_altura_od_longe" id="vlr_altura_od_longe" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" autocomplete="off" name="vlr_dnp_od_longe" id="vlr_dnp_od_longe" type="text">
                                    </td>
                                </tr>
                                <tr class="text-success">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_esferico_oe_longe" autocomplete="off" name="vlr_esferico_oe_longe" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_oe_longe" autocomplete="off" name="vlr_cilindrico_oe_longe" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="vlr_eixo_oe_longe" name="vlr_eixo_oe_longe" autocomplete="off" maxlength="12" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" name="vlr_altura_oe_longe" id="vlr_altura_oe_longe" autocomplete="off" maxlength="7" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input maxlength="7" class="input-sm form-control numeric-field text-right" name="vlr_dnp_oe_longe" id="vlr_dnp_oe_longe" autocomplete="off" type="text">
                                    </td>
                                </tr>
                                <tr class="text-danger">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" name="valor-esferico_od_perto" id="valor-esferico_od_perto" autocomplete="off" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_od_perto" name="vlr_cilindrico_od_perto" autocomplete="off" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="vlr_eixo_od_perto" name="vlr_eixo_od_perto" autocomplete="off" maxlength="12" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" name="vlr_altura_od_perto" id="vlr_altura_od_perto" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input maxlength="7" class="input-sm form-control numeric-field text-right" id="vlr_dnp_od_perto" name="vlr_dnp_od_perto" autocomplete="off" type="text">
                                    </td>


                                </tr>
                                <tr class="text-danger">
                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="valor-esferico_oe_perto" autocomplete="off" name="valor-esferico_oe_perto" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm text-right input-mask-receita-field form-control" id="vlr_cilindrico_oe_perto" autocomplete="off" name="vlr_cilindrico_oe_perto" type="text" maxlength="6">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" id="vlr_eixo_oe_perto" autocomplete="off" maxlength="12" name="vlr_eixo_oe_perto" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input class="input-sm form-control numeric-field text-right" maxlength="7" autocomplete="off" id="vlr_altura_oe_perto" name="vlr_altura_oe_perto" type="text">
                                    </td>

                                    <td class="border-black">
                                        <input maxlength="7" class="input-sm form-control numeric-field text-right" autocomplete="off" name="vlr_dnp_oe_perto" id="vlr_dnp_oe_perto" type="text">
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="input-add">
                        <strong><label class="label-in-add" for="in-add">Adição:</label></strong>
                        <input onkeyup="addInPerto(this)" id="in-add" name="in-add" class="input-sm form-control numeric-field in-adicao" type="text">
                        <script>
                            function addInPerto(inAdd) {
                                let nt = inAdd.value > 0 ? "+" + inAdd.value : inAdd.value;
                                ['valor-esferico_oe_perto', 'valor-esferico_od_perto'].forEach((c) => {
                                    document.getElementById(c).value = nt;
                                })
                            }
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
                <textarea class="form-control" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Observações</label>
            </div>
        </div>

        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Informações Adicionais</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="check-receita-montagem ">

                        <div class="title-type">
                            <label>Local da Montagem:</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Loja">
                            <label class="form-check-label" for="check-montagem-loja">
                                Loja
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedLocalMontagem" id="check-montagem-loja" value="Laboratorio">
                            <label class="form-check-label" for="check-montagem-laboratorio">
                                Laboratório
                            </label>
                        </div>

                    </div>
                </div>

                <div class="col-6">
                    <div class="check-receita-montagem ">

                        <div class="title-type">
                            <label>Possui Receita:</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-sim" value="Sim">
                            <label class="form-check-label" for="check-receita-sim">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkedReceita-possui" id="check-receita-nao" value="Nao">
                            <label class="form-check-label" for="check-receita-nao">
                                Não
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
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
                        <div class="inputs-arm">
                            <label>Aro:</label>
                            <input onkeyup="somaAroePonte()" type="number" name="in-aro-arm" id="in-aro-arm">
                        </div>

                        <div class="inputs-arm">
                            <label>Ponte:</label>
                            <input onkeyup="somaAroePonte()" type="number" name="in-ponte-arm" id="in-ponte-arm">
                        </div>

                        <div class="inputs-arm">


                            <label>Aro + Ponte:</label>
                            <input type="number" disabled name="in-aro-ponto-arm" id="in-aro-ponto-arm">
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


                    <!--Inputs Diagonal / Vertical / Pupilar--->

                    <div class="inputs-armacao mt-4">
                        <div class="inputs-arm">
                            <label>Maior Diagonal:</label>
                            <input type="number" name="maior_diagonal" id="maior_diagonal">
                        </div>

                        <div class="inputs-arm">
                            <label>Altura Vertical:</label>
                            <input type="number" name="altura_vertical" id="altura_vertical">
                        </div>

                        <div class="inputs-arm">
                            <label>Distância Pupilar:</label>
                            <input type="number" name="distancia_pupilar" id="distancia_pupilar">
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
                    <button class="btn-voltar_os" type="">Voltar</button>
                </div>
                <div class="btns">

                    <button class="btn-cad_os" type="submit">Cadastrar OS</button>
                </div>
            </div>


        </div>

    </form>
</div>






<script>
    // $('.classeCliente').select2({
    //     placeholder: 'Selecione um Cliente',
    //     //dropdownParent: $('#modalForm')
    // });


    $("#os").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var json = Object.fromEntries(formData);


        const produtos = document.getElementById("tabela-produtos").childNodes[1];

        console.log(produtos);
        var obj_formatado = {

            "dadosPrincipal": {
                "data-entrega": json["data_entrega"],
                "hora-entrega": json['hora_entrega'],
                "timeZone": Intl.DateTimeFormat().resolvedOptions().timeZone,
                "observacao-princ": json["obs-dados-princ"],
                "cli-dados-princ": json["cli-os-dados-princ"],
                "func-dados-princ": json["func-dados-princ"]
            },

            "produtos": {


            },
            "receita": {
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
                    "arm_aro_ponte": json["in-aro-ponto-arm"], // Não está pegando o valor....
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

        //
        console.log(obj_formatado.info_add);

        // $.ajax({

        //     url: pag + "",
        //     type: 'POST',
        //     data: formData,

        //     success: function(mensagem) {
        //         if (mensagem.trim() == "Parcelado com Sucesso!") {
        //             $('#btn-fechar-parcelar').click();
        //             listar();
        //             limparCampos();
        //         } else {

        //             $('#mensagem-parcelar').addClass('text-danger')
        //             $('#mensagem-parcelar').text(mensagem)
        //         }


        //     },

        //     cache: false,
        //     contentType: false,
        //     processData: false,

        // });

    });
</script>