<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'listar_os';

//require_once($pagina . "/campos.php");

//$query = $pdo->query("SELECT * from ordem_servico where status = 'Aberto' order by id desc ");
$query = $pdo->query("SELECT COUNT(*), SUM(`valor_total`), SUM(`entrada_cliente`) from ordem_servico where status = 'Aberto';
");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
//print_r($res[0]);
$listaOrdemServico = $res[0]["COUNT(*)"];
$finalTotal = $res[0]["SUM(`valor_total`)"];
$finalEntrada = $res[0]["SUM(`entrada_cliente`)"];

$data_atual = date('Y-m-d');

$data30 = date('Y-m-d', strtotime("+1 month", strtotime($data_atual)));

$data60 = date('Y-m-d', strtotime("+2 month", strtotime($data_atual)));

$data90 = date('Y-m-d', strtotime("+3 month", strtotime($data_atual)));

?>


<script src="https://kit.fontawesome.com/6f6d0ee986.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/os.css">

<div class="row">
    <div class="col-md-3 my-4">
        <a href="index.php?pag=<?php echo $menu25 ?>" class="buttonNivel sm" type="button">Nova O.S</a>
    </div>

    <div class="col-md-4">
        <small class="mx-4">
            <a title="Débitos" class="text-success" id="aberto" href="#" onclick="listarClientes()"><span>Aberto</span></a> /
            <a title="Todos" class="text-warning" id="todas" href="#" onclick="listarTodas()"><span>Todas</span></a> /
            <a title="Ordens de serviços canceladas" id="cancelado" class="text-danger" href="#" onclick="listarCanceladas()"><span>Canceladas</span></a> /
            <a title="Confirmadas" class="text-primary" id="confirmadas" href="#" onclick="listarConfirmadas()"><span>Confirmadas</span></a>
        </small>
    </div>
</div>


<div class="secao-cards">
    <div class="row-cards">
        <div class="card green">
            <h3>Ordem de serviços</h3>
            <p>Total de ordem de serviços</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-green"><?php echo $listaOrdemServico ?></h5>
                <img class="image" src="../img/os/iconeOS.png" alt="Ordens de serviços" />
            </div>

        </div>

        <div class="card blue">
            <h3>Valor total</h3>
            <p>Valor total em ordem de serviços</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-blue"> R$ <?php echo number_format($finalTotal, 2) ?></h5>
                <img class="image" src="../img/os/money.png" alt="Ordens de serviços" />
            </div>

        </div>

        <div class="card red">
            <h2>Adiantamentos</h2>
            <p>Valor total de adiantamentos</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-red">R$ <?php echo number_format($finalEntrada, 2) ?></h5>
                <img class="image" src="../img/os/Adiantamento.png" alt="Ordens de serviços" />
            </div>

        </div>

    </div>
</div>


<div class="box-search container-fluid pe-4 mt-5">
    <div class="col-8">
    </div>
    <div class="col-4 d-flex " style="gap: 3px;">
        <input type="search" class="form-control m-0" placeholder="Pesquisar pelo Nome e Nº OS" id="search" name="search">
        <button class="btn btn-primary" onclick="listarPesquisa()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>
    </div>

</div>



<div class="secao-lista-dados mt-5" id="view_clientes">

</div>

<!--Modal Cancelar OS-->

<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Cancelar Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir-os" method="post">
                <div class="modal-body">

                    Deseja realmente excluir esta Ordem de Serviço <span id="nome-excluido"></span>?

                    <hr><small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir" id="id-excluir">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-warning">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Modal Excluir OS-->

<div class="modal fade" id="modalExcluirDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir-ordem" method="post">
                <div class="modal-body">

                    Deseja realmente cancelar esta Ordem de Serviço: <span id="nome-excluido-ordem"></span>?

                    <hr><small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir-ordem" id="id-excluir-ordem">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Confirmar  OS-->

<div class="modal fade" id="modalConfirmarOS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Confirmar Ordem de Serviço</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-confirmar-os" method="post">
                <div class="modal-body">

                    <!-- Deseja realmente confirmar esta Ordem de Serviço: <span id="nome-excluido-ordem"></span>? -->

                    <small>
                        <div id="mensagem_OS" align="center" style="border: 1px solid black;padding: 15px;border-radius: 6px;">

                            <div class="data-client d-flex " style="flex-direction: row;gap:16px;" id="data-client">



                            </div>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Código Prod - Nome produto</th>
                                        <th style="text-align:center" scope="col">Qtde</th>
                                        <th style="text-align:center" scope="col">Val. Unit</th>
                                        <th style="text-align:center" scope="col">Acre/Desc</th>
                                        <th style="text-align:center" scope="col">Val.Un.Liq</th>
                                        <th style="text-align:center" scope="col">Val. Total</th>
                                    </tr>
                                </thead>
                                <tbody id="produtos">
                                </tbody>
                            </table>

                            <div class="form-payment" id="form-payment">


                            </div>

                            <div class="listar_parcelas" id="listar_parcelas">

                            </div>
                        </div>
                    </small>
                    <input type="hidden" class="form-control" name="id-confirma-os" id="id-confirma-os">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-primary">Confirma Os</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/ajax_os.js"></script>

<script>
    function excluir(id) {
        $("#id-excluir").val(id);
        var myModal = new bootstrap.Modal(document.getElementById("modalCancelar"), {
            backdrop: "static",
        });
        myModal.show();


    }

    function excluirOrdemServiço(id) {
        $("#id-excluir-ordem").val(id);
        var myModal = new bootstrap.Modal(document.getElementById("modalExcluirDados"), {
            backdrop: "static",
        });
        myModal.show();
    }


    function changeTypeParc(self){
        let typePayment = self.value;
        if(typePayment == 'Cartão de Crédito'){
            //Removendo o Input de criar Parcelas // 
            $('#label_cart_normal').addClass('d-none');
            $('#parc_payment').addClass('d-none');

            //Colocando Input de parcelas Cartão
            $('#payment_cart_os_label').addClass('active');
            $('#payment_cart_os').addClass('active');
            $('#payment_cart_os_label').removeClass('d-none');
            $('#payment_cart_os').removeClass('d-none');
           
        }else{
            //Colocando o Input de criar Parcelas // 
            $('#label_cart_normal').removeClass('d-none');
            $('#parc_payment').removeClass('d-none');

            //Colocando Input criar parcelas //
            $('#payment_cart_os_label').addClass('d-none');
            $('#payment_cart_os').addClass('d-none');

        }
    }

    function confirmarOs(id) {
        $("#listar_parcelas").empty();
        $("#id-confirma-os").val(id);
        let numero_ordem = id;
        $('#produtos').empty();
        $('#form-payment').empty();
        $('#data-client').empty();
        $.ajax({
            url: `listar_os/buscaOs.php`,
            method: "POST",
            data: {
                ordem: numero_ordem
            },
            dataType: "json",
            success: function(data) {


                $.each(data, function(key, val) {

                    let objAtt = JSON.parse(val.obj)

                    buscaClient(objAtt.dadosPrincipal.cli_dados_princ);
                    
                    let valor_desconto = 0;
                    if(objAtt.produtos.desconto == ''){
                        valor_desconto = 0.00;
                    }else{
                        valor_desconto = Number.parseFloat(objAtt.produtos.desconto) 
                    }

                    let valorEntrada = Number.parseFloat(objAtt.produtos.valor_entrada_cliente).toFixed(2);
                    let valor_atualizado = Number.parseFloat(objAtt.produtos.valor_Total_produtos - valorEntrada -  valor_desconto)
                    let htmlFormPayment = `
                    <input type="hidden" value="${objAtt.dadosPrincipal.cli_dados_princ}"  id="id_cliente_os" name="id_cliente_os" readonly>
                    <div class="row mt-4">
                        <div class="details-prod d-flex" style="flex-direction: row; gap: 16px;justify-content: end;">
                            <div class="details-label d-flex" style="flex-direction: column; align-items:end;">
                                <label class="form-label ">Valor Total:</label> 
                                <label class="form-label ">Valor Líquido:</label> 
                                <label class="form-label">Desconto Ordem de Serviço:</label> 
                                <label class="form-label">Adiantamentos: </label> 
                                <label class="form-label">À Receber: </label > 
                            </div>
                            <div class="details-span d-flex" style="flex-direction: column; gap: 8px; align-items: start;">
                                <span class="text-primary">R$${objAtt.produtos.valor_Total_produtos} (=)</span>
                                <input type="hidden" value="${objAtt.produtos.valor_Total_produtos}"  id="vlr_total_prods" name="vlr_total_prods" readonly>
                                <span class="text-primary">R$${objAtt.produtos.valor_Total_produtos} (=)</span>
                                <span class="text-danger">R$${valor_desconto.toFixed(2)} (-)</span>
                                <input type="hidden" value="${valor_desconto}" id="desconto_os" name="desconto_os" readonly>
                                <span class="text-danger">R$${valorEntrada} (-)</span>
                                <span class="text-primary" id="vlr_liquido" name="vlr_liquido">R$${valor_atualizado.toFixed(2)} (=)</span>
                            </div>
                         
                        </div>
                                    <h4 class="mt-3">Dados de Pagamento </h4>
                                    <hr>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Forma de Pagamento:</label>
                                        <select style="text-align:center;" class="form-select" aria-label="Default select example" name="form_payment" id="form_payment" placeholder="Forma de Pagamento" onclick="changeTypeParc(this)" onchange="verificarFormaPagamento(this);">
                                        
                                           <?php
                                            $query = $pdo->query("SELECT * FROM formas_pgtos order by nome asc");
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

                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Entrada Movimentação:</label>
                                        <select style="text-align:center;" class="form-select" aria-label="Default select example" name="entry_pagamenty" id="entry_pagamenty" placeholder="Forma de Pagamento" onchange="verificarFormaPagamento(this);">
                                            <option value="Caixa">Caixa (Movimento)</option>
                                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                                            <option value="Cartão de Débito">Cartão de Débito</option>
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

                                    <div class="col-md-3">
                                        <label class="form-label">Valor: </label>
                                        <input style="width:130px;text-align: center;" type="text" class="form-control" value="${valor_atualizado.toFixed(2)}" id="valor_payment" name="valor_payment" readonly>
                                        <input style="width:130px;text-align: center;" type="hidden" class="form-control" value="${valor_atualizado.toFixed(2)}" id="valor_payment_liquido" name="valor_payment_liquido" readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label" id="label_cart_normal">Qtde Parcelas: </label>
                                        <input class="form-control" style="width:80px;text-align: center;" type="number" id="parc_payment" name="parc_payment" onclick="criarParcelas()" onchange="criarParcelas()"readonly value="1">
                                        <label for="exampleFormControlInput1" class="form-label d-none" id="payment_cart_os_label">Parcelas Via. Cartão:</label>
                                        <input type="number" class="form-control  d-none" style="width:80px;text-align: center;"   name="payment_cart_os" id="payment_cart_os" value="1">
                                    </div>
                                    <hr>
                                    
                                    <div class="col-md-4">
                                    <label for="exampleFormControlInput1" class="form-label">Data (<a title="Lançar Venda para 30 Dias" href="#" onclick="mudarData('<?php echo $data30 ?>')" class="text-dark">30 Dias</a> /
                                        <a title="Lançar Venda para 60 Dias" href="#" onclick="mudarData('<?php echo $data60 ?>')" class="text-dark">60 Dias</a> /
                                        <a title="Lançar Venda para 90 Dias" href="#" onclick="mudarData('<?php echo $data90 ?>')" class="text-dark">90 Dias</a>)
                                    </label>
                                        <input  class="form-control" style="width:219px;text-align: center;" type="date" id="data_payment" name="data_payment" value="<?php echo date('Y-m-d') ?>" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Entrada Cliente: </label>
                                        <input  class="form-control"  onchange="calcValorEntry()" style="width:150px;text-align: center;" type="text" id="entrada_payment" name="entrada_payment" >
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Tipo Entrada: </label>
                                        <select style="width:200px;text-align:center;" class="form-select" aria-label="Default select example" name="type_entry_client" id="type_entry_client">
                                        <option value="Sem Entrada" selected></option>
                                            <?php
                                            $query = $pdo->query("SELECT * FROM formas_pgtos order by nome asc");
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

                                <div class="col-md-2">
                                        <label class="form-label">Desconto Cliente: </label>
                                        <input  class="form-control" onchange="calcValorEntry()" style="width:130px;text-align: center;" type="text" id="desconto_cliente" name="desconto_cliente" >
                                    </div>

                                <hr>
                                <div class="row">
                                        <div class="col-12" id="mensagem">
                                            
                                        </div>
                                </div>

                    `;

                    $('#form-payment').append(htmlFormPayment);

                    $.each(objAtt.produtos.produtos_selecionados, function(key, value) {
                        let htmlTbody = `
                            <tr>
                                <th scope="row">${value.codENome}</th>
                                <td  style="text-align:center">${value.qtde}</td>
                                <td  style="text-align:center">${value.valUnit}</td>
                                <td  style="text-align:center">${value.acresOuDesc}</td>
                                <td  style="text-align:center">${value.valUnLiq}</td>
                                <td  style="text-align:center">${value.valTotal}</td>
                            </tr>
                        `
                        $('#produtos').append(htmlTbody);
                    });

                   
                    buscaIdProd(objAtt.produtos.produtos_selecionados)
                })

            }

        });
        var myModal = new bootstrap.Modal(document.getElementById("modalConfirmarOS"), {
            backdrop: "static",
        });
        myModal.show();
    }


    function buscaClient(id) {
        let id_cli = id;
        $.ajax({
            url: `listar_os/buscaCliente.php`,
            method: "POST",
            data: {
                id_cliente: id_cli
            },
            dataType: "json",
            success: function(data) {


                $.each(data, function(key, val) {
                    let dataCriacao = val.data
                    let dataNova = dataCriacao.split('-').reverse().join('/')

                    let htmlDataClient = `
                            <div class="data-label d-flex" style="flex-direction: column; align-items:end;gap:2px;">
                                <strong><label for="" class="form-label">Cliente: </label></strong>
                                <strong><label for="" class="form-label">Cadastrado em: </label></strong>
                                <strong><label for="" class="form-label">Data de Registro:</label></strong>
                                <strong><label for="" class="form-label">Telefone Principal:</label></strong>
                                <strong><label for="" class="form-label">Endereço:</label></strong>
                                <strong><label for="" class="form-label">CPF/CNPJ: </label></strong>
                            </div>
                            <div class="data-span d-flex" style="flex-direction: column; align-items:start;gap:10px;">
                                <span><i class="bi bi-person-circle"></i> ${val.nome}</span>
                                <span><i class="bi bi-house-door"> Núcleo da Visão</i></span>
                                <span><i class="bi bi-clock"></i> ${dataNova}</span>
                                <span><i class="bi bi-phone"></i> ${val.telefone}</span>
                                <span><i class="bi bi-geo-alt-fill"></i> ${val.endereco}</span>
                                <span><i class="bi bi-card-list"></i> ${val.doc}</span>
                            </div>

                            `

                    $('#data-client').append(htmlDataClient);
                })

            }

        })
    }

    function buscaIdProd(produtos) {
        $.ajax({
            type: "POST",
            url: `ordem_servico/addProdUni.php`,
            data: JSON.stringify(produtos),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {  
            },
        });
    }


    function listarPesquisa() {
        $('#view_clientes').empty();
        let p = $('#search').val();
        $.ajax({
            url: `listar_os/search.php?search=${p}`,
            method: "GET",
            dataType: "json",
            success: function(response) {
                //console.log(response);
                $.each(response, function(key, value) {
                    //console.log(response);
                    let objAtt = JSON.parse(value.obj)

                    // Data de criação da os
                    let dataCriacao = value.data_criacao
                    let dataNova = dataCriacao.split('-').reverse().join('/')
                    let dataEntrega = objAtt.dadosPrincipal.data_entrega.split('-').reverse().join('/')
                    // Valor parcelas
                    let parcelas = objAtt.produtos.qtde_parcelas;

                    if (parcelas == "" || parcelas == 0) {


                        parcelas = 0;
                    }

                    value.valor_total = Number.parseFloat(value.valor_total);

                    // console.log(objAtt.dadosPrincipal);

                    let html = `  <div class="cards-clientes orange"  id="abertos" >
                                <div class="row-1">
                                    <!--Nome-->
                                    <div  class="col-3">
                                        <div  title="Nome do Cliente "> ${value.nome_cliente}</div>
                                    </div>
                                    <!--Numero da ordem de serviço-->
                                    <div class="col-3 ">
                                        <div title="Numero da OS"><i class="fa fa-flag"></i>  ${value.id}</div>
                                    </div>
                                    <!--Valor total da OS-->
                                    <div class="col-3" style="display: flex; gap: 40px">
                                        <div title="Valor total da OS">R$ ${value.valor_total.toFixed(2)} </div>
                                        <div title="SubTotal do Cliente"><i class="fa fa-money text-danger"></i> R$ ${objAtt.produtos.subTotal_Cliente}</div>
                                    </div>
                                    <!--Status da Os-->
                                    <div class="col-3">
                                        <div title="Status da OS"  class="label label-warning ${value.status == 'Cancelada' ? 'bg-danger' : ''} ${value.status == 'Confirmada' ? 'bg-primary' : ''} ">${value.status}</div>
                                    </div>
                                </div>
                                <div class="row-2 mt-4">
                                    <!--Nome Funcionario e Loja-->
                                    <div class="col-3">
                                        <div title="Nome do funcionario e loja"> <i class="fa fa-user fa-fw"></i> ${value.nome_func} - <i class="fa fa-building-o fa-fw"></i> Núcleo Visão</div>
                                    </div>
                                    <!-- Data de emissão -->
                                    <div class="col-3">
                                        <div title="Data de  resgistro da OS"><i class="fa fa-calendar-plus-o"></i> ${dataNova}</div>
                                    </div>
                                    <!--Sub total do cliente-->
                                    <div class="col-3" style="display: flex; gap: 49px">
                                        <div title="Sinal Cliente"><i class="fa fa-money text-success"></i> R$ ${objAtt.produtos.valor_entrada_cliente}</div> 
                                        <div   class=" ${parcelas == 0 ? "d-none" : ""}" title="Total de parcelas"><i class="bi bi-hourglass-split"></i></i> ${parcelas}</div>
                                    </div>
                                    <div class="col-3">
                                       
                                    </div>
                                    
                                </div>
                                

                                <div class="row-4 mt-4 ">
                                    <!--Laboratório-->
                                    <div class="col-3">
                                        <div title="Nome do funcionario e loja"> <i class="fa fa-steam fa-fw"></i>${objAtt.info_add.laboratorio}</div>
                                    </div>
                                    <!-- Data de Entrega -->
                                    <div class="col-3">
                                        <div title="Previsão de entrega"> <i class="fa fa-clock-o"></i> ${dataEntrega} - ${objAtt.dadosPrincipal.hora_entrega} </div>
                                    </div>
                                    
                                    <div class="col-3" style="display: flex; gap: 49px">
                                       
                                    </div>
                                    
                                </div>

                                <div class="row-3 mt-5">
                                    <!--Btns inicial-->
                                    <div class="col-6">
                                        <div class="">
                                            <!--Tirar comprovante OS-->
                                            <a  title="Gerar comprovante" href="../relatorios/ordemServicos_class.php?id=${value.id}" target="_blank" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="bi bi-receipt text-info"></i>
                                                Comprovante
                                            </a>
                                            <!--Visualizar OS-->
                                            <a title="Visualizar ordem de serviço" href="../painel-adm/index.php?pag=editar_os&id=${value.id}" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="fa fa fa-edit text-success"></i>
                                                Visualizar OS
                                            </a>
                                            <!--Converter em venda  OS-->
                                            <a title="Confirmação de OS" href="#" onclick="confirmarOs(${value.id})" class="btn-comprovante btn ${value.status == 'Cancelada' || value.status == 'Confirmada' ? 'd-none' : ''}">
                                            <i class="bi bi-check-square text-primary"></i>
                                                Confirmar OS
                                            </a>
                                        </div>
                                    </div>
                                    <!---Btns de CANCELAR PERDA / CANCELAR -->
                                    <div class="col-4">
                                        <div>
                                            <!--Confirmar a perca da OS-->
                                            <a onclick="excluirOrdemServiço(${value.id})"  data-toggle="modal" data-target="#exampleModal"  title="Cancelar OS" href="#" class="btn-comprovante btn ${value.status == 'Cancelada' || value.status == 'Confirmada' ? 'd-none' : ''}">
                                            <i class="bi bi-trash text-danger"></i>
                                                Excluir
                                            </a>
                                            <!--Cancelar OS-->
                                            <a   title="Excluir OS" href="#" onclick="excluir(${value.id})" class="btn-comprovante btn ${value.status == 'Cancelada' || value.status == 'Confirmada' ? 'd-none' : ''}">
                                                <i class="bi bi-x-octagon text-warning"></i>
                                                Cancelar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                    $('#view_clientes').append(html)
                })

            },
        });

    }


    function calcValorEntry() {
        let vlr_entrada = document.getElementById('entrada_payment').value.replace(',', '.'); // Pegando o valor da entrada do cliente           
        let valor_Final = 0;
        let vlr_total_cliente = document.getElementById('valor_payment');
        let vlr_desconto = document.getElementById('desconto_cliente').value.replace(',', '.')
        let campo_total = document.getElementById('valor_payment');

        vlr_total_cliente = document.getElementById('valor_payment_liquido');
        if (vlr_entrada >= 0 && vlr_entrada < vlr_total_cliente) {
            valor_Final = vlr_total_cliente.value - vlr_entrada;
        }
        if (vlr_desconto >= 0 && vlr_desconto < vlr_total_cliente) {
            valor_Final = valor_Final - vlr_desconto;
        }
        if(vlr_entrada == ''){
            campo_total.value = vlr_total_cliente.value;
        }

        if(vlr_desconto == ''){
            campo_total.value = vlr_total_cliente.value;
            vlr_total_cliente.value = vlr_total_cliente.value;
        }
        
        campo_total.value = valor_Final.toFixed(2);
    }

    // function calcValorDesconto(self){
    //     let vlr_desconto = self.value.replace(',', '.'); // Pegando o valor da entrada do cliente
    //     let valor_final = 0
    //     let vlr_total_cliente = document.getElementById('valor_payment_liquido');
    //     if (vlr_desconto >= 0 && vlr_desconto < vlr_total_cliente) {
    //         valor_Final = vlr_total_cliente.value - vlr_desconto;

    //     }
    //     let campo_total = document.getElementById('valor_payment');
    //     campo_total.value = valor_Final.toFixed(2);

        
    // }


    function verificarFormaPagamento(self) {
        if (self.value != 'Cartão de Crédito') {
            document.getElementById('parc_payment').removeAttribute('readonly')
            $('#btn_simul').removeClass('d-none');
        } else {
            document.getElementById('parc_payment').setAttribute('readonly', true)
            $('#btn_simul').addClass('d-none');
            $('#teste').empty();
        }
    }

    function formatarData(data) {
        let newDate = new Date(data);
        return `${newDate.getDate()}/${newDate.getMonth()}/${newDate.getFullYear()}`
    }


    $("#form-confirmar-os").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "listar_os/confirmaOs.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $("#btn-fechar-excluir").click();
                    window.location.replace('index.php?pag=listar_os');
                } else {
                    $("#mensagem").addClass("text-danger");
                    $("#mensagem").text(mensagem);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        });

    });

    function LimpaCracha() {
        document.getElementById('mensagem').innerText = '';
    }

    function criarParcelas() {

        valor = $('#valor_payment').val();
        console.log(valor);
        parcelas = $('#parc_payment').val();
        entrada = $('#entrada_payment').val();
        data = $('#data_payment').val();
        tipoPagamento = $('#form_payment').val();

        $.ajax({
            url:`vendas/parcelas.php`,
            method: 'POST',
            data: {
                valor,
                parcelas,
                data,
                entrada,
                tipoPagamento
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Inserido com Sucesso!") {
                    listarParcelas();

                }
            },

        });
    }

    function listarParcelas() {
        $('#mensagem').text('');
        $.ajax({
            url: `vendas/listar-parcelas.php`,
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar_parcelas").html(result);
            }
        });
    }

    
    function mudarData(data) {
        $("#data_payment").val(data);
        criarParcelas();
    }


    setInterval(function() {
        LimpaCracha();
    }, 5000);
</script>