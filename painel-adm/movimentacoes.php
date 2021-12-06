<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'movimentacoes';
$data_atual = date('Y-m-d');
?>




<ul class="nav nav-tabs my-2" id="myTab" role="tablist">
    <!-- CAIXA-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Caixa')" class="nav-link active" id="caixa-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="home" aria-selected="true">Caixa</a>
    </li>
    <!-- CARTÃO DE DÉBITO-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Cartão de Débito')" class="nav-link" id="debito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Cartão de Débito</a>
    </li>
    <!--CARTÃO DE CRÉDITO-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Cartão de Crédito')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Cartão de Crédito</a>
    </li>

    <!--BANCO DO BRASIL-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Banco do Brasil')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Banco do Brasil</a>
    </li>
    <!--BANCO DO BRADESCO-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Bradesco')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Bradesco</a>
    </li>
    <!--BANCO CAIXA ECONÔMICA-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Caixa Econômica')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Caixa Econômica</a>
    </li>

    <!--BANCO ITAU-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Itaú')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Itaú</a>
    </li>

    <!--BANCO SANTANDER-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Santander')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Santander</a>
    </li>
    <!--BANCO SICOOB-->
    <li class="nav-item" role="presentation">
        <a onclick="pesquisarCaixa('','','Sicoob')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Sicoob</a>
    </li>
</ul>


<div class="tab-content" id="myTabContent">

    <input type="hidden" id="nome-busca">

    <div class="tab-pane fade show active" id="caixa" role="tabpanel" aria-labelledby="home-tab">

        <div class="row my-3">
            <div class="col-md-9">
                <div style="float:left; margin-right:10px">
                    <a href="#" onclick="pesquisarCaixa('', '',$('#nome-busca').val())" class="text-dark">
                        <span><small><i title="Filtrar Todas Movimentações" class="bi bi-search"></i></small></span>
                    </a>
                </div>

                <div style="float:left; margin-right:10px"><span><small><i title="Data Inicial" class="bi bi-calendar-date"></i></small></span></div>
                <div style="float:left; margin-right:20px">
                    <input style="width: 141px;" type="date" class="form-control form-control-sm" name="data-inicial" id="data-inicial-caixa" value="<?php echo date('Y-m-d') ?>" required>
                </div>

                <div style="float:left; margin-right:10px"><span><small><i title="Data Final" class="bi bi-calendar-date"></i></small></span></div>
                <div style="float:left; margin-right:30px">
                    <input style="width: 141px;" type="date" class="form-control form-control-sm" name="data-final" id="data-final-caixa" value="<?php echo date('Y-m-d') ?>" required>
                </div>

                <!--TIRANDO AS DIVS-->

                <div id="outras-consultas">

                    <small class="mx-2">
                        <a title="Movimentações de Entradas" class="text-success" href="#" onclick="pesquisarCaixa('Entrada', '')"><span>Entradas</span></a> /
                        <a title="Movimentações de Saídas" class="text-danger" href="#" onclick="pesquisarCaixa('Saída', '')"><span>Saídas</span></a>

                    </small>

                    <!--TIPO DE DOCUMENTO-->
                    <div style="float:left; margin-right:10px">
                        <select class="form-select form-select-sm" aria-label="Default select example" name="doc" id="doc-caixa">
                            <option value="">Documentos</option>
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Boleto">Boleto</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Conta Corrente">Conta Corrente</option>
                            <option value="Conta Poupança">Conta Poupança</option>
                            <option value="Carnê">Carnê</option>
                            <option value="DARF">DARF</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Transferência">Transferência</option>
                            <option value="Pix">Pix</option>

                        </select>
                    </div>

                    <!---LANÇAR DESPESAS DIRETO--->
                    <small class="mx-2">
                        <a title="Lançar Despesas" class="text-success" href="#" onclick="lancarDespesa()"> <i class="bi bi-plus"></i> <span>Despesa</span></a>
                        /
                        <a title="Transferir Valores" class="text-dark" href="#" onclick="transferencias()"><span>Tranferências</span></a>
                    </small>

                </div>


            </div>

            <div align="right" class="col-md-2">
                <i class="bi bi-coin"></i> <span class="text-dark ml-5">Total: <span id="total_itens" class="text-danger"></span></span>
            </div>
        </div>

        <small>
            <div class="tableDados bg-light" id="listar-caixa">

            </div>
        </small>
    </div>

</div>






<!-- MODAL  EXCLUIR-->
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

                    <?php require_once("verificar_adm.php"); ?>

                    <small>
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

<!-- MODAL DESPESA -->
<div class="modal fade" id="modalDespesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Despesa</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-desp" method="post">
                <div class="modal-body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="forn-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Fornecedores</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Despesa</a>
                        </li>

                    </ul>

                    <div class="tab-content my-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row my-2 justify-content-center">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" style="text-align: center;" name="Fornecedor" id="id-cliente" placeholder="id" readonly>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" style="text-align: center;" name="nome-cliente" id="nome-cliente" placeholder="Nome do Fornecedor" readonly>
                                </div>
                            </div>

                            <small>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tableDados bg-light" id="listar-clientes">
                                        </div>
                                    </div>


                                </div>
                            </small>

                        </div>

                        <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" name="descricao" placeholder="Descrição" id="descricao">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Valor</label>
                                        <input type="text" class="form-control" name="Valor" placeholder="Valor" id="Valor">
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Data</label>
                                        <input type="date" class="form-control" name="Data" id="Data" value="<?php echo date('Y-m-d') ?>" required>
                                    </div>
                                </div>


                            </div>


                            <div class="row">


                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tipo Entrada</label>
                                        <select class="form-select" aria-label="Default select example" name="lancamento" id="lancamento">
                                            <option value="Caixa">Caixa (Movimento)</option>


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


                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tipo Documento</label>
                                        <select class="form-select" aria-label="Default select example" name="documento" id="documento">

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

                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Plano de Conta</label>
                                        <select class="form-select" aria-label="Default select example" name="cat_despesas" id="cat_despesas">

                                            <?php
                                            $query = $pdo->query("SELECT * FROM cat_despesas order by nome asc");
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


                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Despesa</label>
                                        <div id="listar-despesas">

                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <br>

                    <small>
                        <div id="mensagem-desp" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id" id="id-desp">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-desp">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>


<script>
    $(document).ready(function() {
        listarCaixa();
        $('#nome-busca').val('Caixa');

    });

    //FILTRANDO POR DATAS

    $('#data-inicial-caixa').change(function() {
        var dataInicial = $('#data-inicial-caixa').val();
        var dataFinal = $('#data-final-caixa').val();
        var status = $('#doc-caixa').val();
        var alterou_data = 'Sim';
        listarBuscaCaixa(dataInicial, dataFinal, status, alterou_data);
    });

    $('#data-final-caixa').change(function() {
        var dataInicial = $('#data-inicial-caixa').val();
        var dataFinal = $('#data-final-caixa').val();
        var status = $('#doc-caixa').val();
        var alterou_data = 'Sim';
        listarBuscaCaixa(dataInicial, dataFinal, status, alterou_data);
    });

    $('#doc-caixa').change(function() {
        var dataInicial = $('#data-inicial-caixa').val();
        var dataFinal = $('#data-final-caixa').val();
        var status = $('#doc-caixa').val();
        listarBuscaCaixa(dataInicial, dataFinal, status);
    });


    function pesquisar(tipo, movimento) {
        var id = $('#id-caixa').val();
        $.ajax({

            url: pag + "/listar-movimentos.php",
            method: 'POST',
            data: {
                id,
                tipo,
                movimento
            },
            dataType: "html",

            success: function(result) {
                $("#listar-movimentos").html(result);
            }
        });
    }




    function listarCaixa() {
        $.ajax({
            url: pag + "/listar-caixa.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-caixa").html(result);
            }
        });
    }


    function listarBuscaCaixa(dataInicial, dataFinal, status, alterou_data) {
        var busca = $('#nome-busca').val();


        $.ajax({
            url: pag + "/listar-caixa.php",
            method: 'POST',
            data: {
                dataInicial,
                dataFinal,
                status,
                alterou_data,
                busca
            },
            dataType: "html",

            success: function(result) {
                $("#listar-caixa").html(result);
            }
        });
    }


    function pesquisarCaixa(tipo, movimento, busca) {
        $('#nome-busca').val(busca);


        if (busca != 'Caixa') {
            $('#outras-consultas').addClass('d-none');
        } else {
            $('#outras-consultas').removeClass('d-none');
        }

        if (tipo != "" || movimento != "") {
            var dataInicial = $('#data-inicial-caixa').val();
            var dataFinal = $('#data-final-caixa').val();
            var status = $('#doc-caixa').val();
        }

        if (tipo == "" || movimento == "") {
            $('#data-inicial-caixa').val('<?= $data_atual ?>');
            $('#data-final-caixa').val('<?= $data_atual ?>');
        }


        $.ajax({

            url: pag + "/listar-caixa.php",
            method: 'POST',
            data: {
                tipo,
                movimento,
                dataInicial,
                dataFinal,
                status,
                busca
            },
            dataType: "html",

            success: function(result) {
                $("#listar-caixa").html(result);
            }
        });
    }

    function lancarDespesa() {

        var myModal = new bootstrap.Modal(document.getElementById('modalDespesa'), {});
        myModal.show();
        var busca = $('#nome-busca').val();
        $('#lancamento').val(busca);
        $('#Valor').val('');
        $('#id-cliente').val('');
        $('#nome-cliente').val('');
        $('#descricao').val('');

        //DEFINIR ABA A SER ABERTA
        var someTabTriggerEl = document.querySelector('#forn-tab')
        var tab = new bootstrap.Tab(someTabTriggerEl);
        tab.show();

    }
</script>


<script>
    $(document).ready(function() {
        var cat = $('#cat_despesas').val();
        listarDespesas(cat);
        listarClientes();
        $('#cat_despesas').change(function() {
            var cat = $(this).val();
            listarDespesas(cat);
        });

    });



    function listarClientes() {

        $.ajax({
            url: "contas_despesa/listar-clientes.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-clientes").html(result);
            }
        });
    }



    function listarDespesas(cat, despesa) {

        $.ajax({
            url: "contas_despesa/listar-despesas.php",
            method: 'POST',
            data: {
                cat,
                despesa
            },
            dataType: "text",

            success: function(result) {
                $("#listar-despesas").html(result);
            }

        });
    }





    $("#form-desp").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "contas_despesa/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-desp').text('');
                $('#mensagem-desp').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-desp').click();
                    var busca = $('#nome-busca').val();
                    pesquisarCaixa('', '', busca);
                } else {

                    $('#mensagem-desp').addClass('text-danger')
                    $('#mensagem-desp').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });





    $("#form-excluir-mov").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-excluir').text('');
                $('#mensagem-excluir').removeClass()
                if (mensagem.trim() == "Excluído com Sucesso") {
                    $('#btn-fechar-excluir').click();
                    var busca = $('#nome-busca').val();
                    pesquisarCaixa('', '', busca);
                    limparCampos();
                } else {

                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });


    function limparCampos() {
        $('#usuario_adm').val('');
        $('#senha_adm').val('');
    }





    $("#form").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem').text('');
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    var busca = $('#nome-busca').val();
                    pesquisarCaixa('', '', busca);

                } else {

                    $('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });




    $("#form-transf").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        console.log('fsdsfasdfasfa')
        $.ajax({
            url: pag + "/transferir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-transf').text('');
                $('#mensagem-transf').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {
                    $('#valor-transf').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-transf').click();
                    var busca = $('#nome-busca').val();
                    pesquisarCaixa('', '', busca);

                } else {

                    $('#mensagem-transf').addClass('text-danger')
                    $('#mensagem-transf').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>