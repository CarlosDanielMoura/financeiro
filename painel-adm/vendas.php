<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'vendas';

$data_atual = date('Y-m-d');

$data30 = date('Y-m-d', strtotime("+1 month", strtotime($data_atual)));

$data60 = date('Y-m-d', strtotime("+2 month", strtotime($data_atual)));

$data90 = date('Y-m-d', strtotime("+3 month", strtotime($data_atual)));

?>


<link rel="stylesheet" href="../css/tela-venda.css">
<div class="container-fluid ">
    <div class="row py-3">
        <div class='checkout'>
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12">
                    <div class='order py-2'>
                        <div class="row justify-content-center">
                            <div class="col-md-11 barra-lista-itens">
                                <p class="background">LISTA DE ITENS: CLIENTE <strong><span id="nome-cliente"></span></strong>
                            </div>
                        </div>



                        </p>

                        <span id="listar-itens">

                        </span>
                    </div>
                    <br>

                </div>


                <div id='payment' class='payment col-md-7'>


                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Clientes</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Produtos</a>
                        </li>

                    </ul>



                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row mb-4 d-flex justify-content-center">
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="<?php echo $campo2 ?>" id="id-cliente" placeholder="Id" readonly>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="nome-cliente-in" id="nome-cliente-in" placeholder="Nome Cliente" readonly>
                                </div>
                            </div>

                            <small>
                                <div id="listar-clientes"></div>
                            </small>
                        </div>

                        <div class="tab-pane fade " id="contas" role="tabpanel" aria-labelledby="profile-tab">


                            <small class="mt-3">
                                <div id="listar-produtos">

                                </div>
                            </small>
                        </div> <br>

                        <small>
                            <div id="mensagem-itens"></div>
                        </small>
                    </div>


                </div>


            </div>
        </div>

    </div>
</div>



<!-- Modal  INSERIR DADOS-->
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
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Fornecedores</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Despesa</a>
                        </li>

                    </ul>

                    <div class="tab-content my-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row my-2">
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="<?php echo $campo8 ?>" id="id-cliente" placeholder="Id do Fornecedor" readonly>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nome-cliente" id="nome-cliente" placeholder="Nome do Fornecedor" readonly>
                                </div>
                            </div>

                            <small>
                                <small>
                                    <div class="tabela bg-light" id="listar-clientes">

                                    </div>
                                </small>
                            </small>

                        </div>

                        <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="Descrição" id="<?php echo $campo1 ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo2 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo2 ?>" placeholder="Valor" id="<?php echo $campo2 ?>">
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Data</label>
                                        <input type="date" class="form-control" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>" value="<?php echo date('Y-m-d') ?>" required>
                                    </div>
                                </div>


                            </div>



                            <div class="row">


                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tipo Entrada</label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>">
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
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>">

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




<!-- Modal -->
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


<!-- Modal fechamento de venda -->
<div class="modal fade" id="modalVenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Fechar Venda</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-venda" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3"><small>
                                    <label for="exampleFormControlInput1" class="form-label">Data (<a title="Lançar Venda para 30 Dias" href="#" onclick="mudarData('<?php echo $data30 ?>')" class="text-dark">30 Dias</a> /
                                        <a title="Lançar Venda para 60 Dias" href="#" onclick="mudarData('<?php echo $data60 ?>')" class="text-dark">60 Dias</a> /
                                        <a title="Lançar Venda para 90 Dias" href="#" onclick="mudarData('<?php echo $data90 ?>')" class="text-dark">90 Dias</a>)
                                    </label>
                                    <input type="date" class="form-control" name="data" id="data" value="<?php echo date('Y-m-d') ?>" required>
                                </small>
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tipo Entrada:</label>
                                <select class="form-select" aria-label="Default select example" name="lancamento" id="lancamento">
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

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pagamento:</label>
                                <select class="form-select" aria-label="Default select example" name="pagamento" id="pagamento">
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
                        </div>

                    </div>

                    <small>
                        <div id="mensagem-prod" align="center">

                        </div>
                    </small>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-venda">Fechar</button>
                    <button type="submit" class="btn btn-primary">Finalizar</button>
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
        var cat = $('#cat_despesas').val();
        listarClientes();
        listarProdutos();
        listarItens();
    });




    function listarClientes() {
        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/listar-clientes.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-clientes").html(result);
            }
        });
    }

    function listarProdutos() {

        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/listar-produtos.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-produtos").html(result);
            }
        });
    }

    function listarItens() {
        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/listar-itens.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-itens").html(result);
            }
        });
    }

    function excluirItem(id) {

        event.preventDefault();
        $.ajax({
            url: "vendas/excluir-item.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "text",

            success: function(mensagem) {
                $('#mensagem-itens').text('');
                $('#mensagem-itens').removeClass()
                if (mensagem.trim() == "Excluído com Sucesso!") {

                    listarItens();
                    listarProdutos();

                } else {
                    $('#mensagem-itens').addClass('text-danger')
                    $('#mensagem-itens').text(mensagem)
                }
            },

        });
    }


    function ModalFecharVenda() {
        $('#mensagem-fec').text('');
        $('#mensagem-fec').removeClass()

        if ($('#nome-cliente-in').val() == "") {
            $('#mensagem-fec').addClass('text-danger')
            $('#mensagem-fec').text('Selecione um Cliente!');

            //DEFINIR ABA A SER ABERTA
            var someTabTriggerEl = document.querySelector('#home-tab')
            var tab = new bootstrap.Tab(someTabTriggerEl);
            tab.show();

        } else {
            var myModal = new bootstrap.Modal(document.getElementById('modalVenda'), {});
            myModal.show();
        }
    }


    function mudarData(data) {
        console.log(data);
        $("#data").val(data);
    }




    $("#form-venda").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-prod').text('');
                $('#mensagem-prod').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-venda').click();
                    listarItens();
                    limparCampos();
                } else {
                    $('#mensagem-prod').addClass('text-danger')
                    $('#mensagem-prod').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });


    function limparCampos() {
        listarItens();
        $('#id-cliente').val('');
        $('#nome-cliente').text('');
        $('#nome-cliente-in').val('');

        //DEFINIR ABA A SER ABERTA
        var someTabTriggerEl = document.querySelector('#home-tab')
        var tab = new bootstrap.Tab(someTabTriggerEl);
        tab.show();
    }
</script>