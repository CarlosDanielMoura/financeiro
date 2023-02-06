<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'vendas';

$data_atual = date('Y-m-d');

$data30 = date('Y-m-d', strtotime("+1 month", strtotime($data_atual)));

$data60 = date('Y-m-d', strtotime("+2 month", strtotime($data_atual)));

$data90 = date('Y-m-d', strtotime("+3 month", strtotime($data_atual)));

?>

<!--LINK DE CSS-->
<link rel="stylesheet" href="../css/tela-venda.css">
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../vendor/select2/select2.min.css">


<div class="container-fluid">
    <div class="row my-2">

        <div class='checkout'>
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 col-sm-12">
                    <div class='order py-2'>
                        <p class="background">LISTA DE ITENS : <span id="nome-cliente-label"></span></p>
                        <span id="listar-itens">
                        </span>
                    </div>
                </div>
                <div id='payment' class='payment col-md-7 py-2 mx-4'>

                    <div class="row mt-3 d-flex justify-content-center">
                        <div class="col-md-5 col-sm-12">
                            <div class="mb-3">
                                <select class="form-select sel2" aria-label="Default select example" name="id-cliente" id="id-cliente" style="width:100%;" onchange="selecionarCliente()">

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
                        </div>
                    </div>

                    <small>
                        <div id="listar-produtos" class="mt-3"></div>
                    </small>
                </div>
                <small>
                    <div id="listar-produtos" class="mt-3"></div>
                </small>
            </div>
            <br>
            <small>
                <div id="mensagem-itens"></div>
            </small>
        </div>
    </div>
</div>

<!-- MODAL FECHAMENTO DE VENDA -->
<div class="modal fade" id="modalVenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal"> Fechar Venda - Total: R$
                        <strong><span id="total-da-venda"> </span></strong></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-venda" method="post">
                <div class="modal-body">

                    <div class="row d-flex justify-content-evenly">
                        <div class="col-md-3">
                            <label for="exampleFormControlInput1" class="form-label">Acréscimo:</label>
                            <input type="text" onkeyup="totalizarVenda()" class="form-control" name="acrescimo" id="acrescimo" placeholder="Acréscimo">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleFormControlInput1" class="form-label">Desconto em R$:</label>
                            <input type="text" onkeyup="totalizarVenda()" class="form-control" name="desconto" id="desconto" placeholder="Desconto">
                        </div>


                        <div class="col-md-3">
                            <label for="exampleFormControlInput1" class="form-label">Desconto equivale %:</label>
                            <input type="text" class="form-control" name="desc_porcen" id="desc_porcen" placeholder="Desconto em %" readonly>
                        </div>


                    </div>

                    <div class="row d-flex justify-content-evenly mt-3">
                        <div class="col-md-3">
                            <label for="exampleFormControlInput1" class="form-label">SubTotal:</label>
                            <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="SubTotal" readonly>
                        </div>

                        <div class="col-md-3">
                        <label for="exampleFormControlInput1" class="form-label " id="paymentLabelNormal">Parcelas:</label>
                            <input type="number" class="form-control" onkeyup="criarParcelas()" onchange="criarParcelas()" name="parcelas" id="parcelas" value="1">
                            <label for="exampleFormControlInput1" class="form-label d-none" id="paymentLabel">Parcelas Cartão:</label>
                            <input type="number" class="form-control  d-none"  name="paymentCart" id="paymentCart" value="1">
                        </div>

                        <div class="col-md-3">
                            <label for="exampleFormControlInput1" class="form-label">Entrada Cliente:</label>
                            <input type="text" onkeyup="totalizarVenda()" class="form-control" name="recebido" id="recebido" placeholder="Entrada Cliente">
                        </div>

                        <div class="col-md-3 d-none entryType">
                            <label for="exampleFormControlInput1" class="form-label">Tipo de Entrada:</label>
                            <select class="form-select" aria-label="Default select example" name="tipo_entrada" id="tipo_entrada" placeholder="Tipo de entrada cliente">
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

                    <div class="row mt-4">
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
                                <select class="form-select" aria-label="Default select example" name="lancamento" id="lancamento" > 
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
                                <select class="form-select" aria-label="Default select example" name="pagamento" id="pagamento" onclick="changeTypeParc(this);">
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

                    </div>

                    <small>
                        <div align="center" id="mensagem-prod"></div>
                    </small>

                    <small>
                        <div id="listar-parc">
                        </div>
                    </small>

                    <input type="hidden" name="id-cli" id="id-cli">


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
<script src="../vendor/select2/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.sel2').select2({
            placeholder: 'Selecione um Cliente',
            theme: 'classic'
            //dropdownParent: $('#modalForm')
        });
        var cat = $('#cat_despesas').val();
        listarProdutos();
        listarItens();
        limparCampos();


    });

    function changeTypeParc(self){
        let typePayment = self.value;
        if(typePayment == 'Cartão de Crédito'){
            //Removendo o Input de criar Parcelas // 
            $('#paymentLabelNormal').addClass('d-none');
            $('#parcelas').addClass('d-none');

            //Colocando Input de parcelas Cartão
            $('#paymentLabel').addClass('active');
            $('#paymentCart').addClass('active');
            $('#paymentLabel').removeClass('d-none');
            $('#paymentCart').removeClass('d-none');
            $('#listar-parc').empty();
        }else{
            //Colocando o Input de criar Parcelas // 
            $('#paymentLabelNormal').removeClass('d-none');
            $('#parcelas').removeClass('d-none');

            //Colocando Input criar parcelas //
            $('#paymentLabel').addClass('d-none');
            $('#paymentCart').addClass('d-none');

        }
    }

    //Selecionar o cliente para jogar o ID no input para verificar
    function selecionarCliente() {
        $('#id-cli').val($('#id-cliente').val());
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
        $('#mensagem-fec').removeClass();
        var myModal = new bootstrap.Modal(document.getElementById('modalVenda'), {});
        myModal.show();

    }

    //FUNÇÃO DE CRIAR PARCELAS
    function criarParcelas() {
        valor = $('#subtotal').val();
        porcen = $('#desc_porcen').val();
        parcelas = $('#parcelas').val();
        entrada = $('#recebido').val();
        data = $('#data').val();
        tipoPagamento = $('#pagamento').val();

        $.ajax({
            url: pag + "/parcelas.php",
            method: 'POST',
            data: {
                valor,
                parcelas,
                data,
                porcen,
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

    function alterarParcela(id, cont) {
        valor = $('#valor-da-parc' + cont).val();
        data = $('#data-da-parc' + cont).val();
        $.ajax({
            url: pag + "/alterar-parcela.php",
            method: 'POST',
            data: {
                id,
                valor,
                data
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Inserido com Sucesso!") {

                }
            },
        });
    }


    function mudarData(data) {
        $("#data").val(data);
        criarParcelas();
    }

    function limparCampos() {
        listarItens();
        $('#id-cliente').val('').change();
        $('#nome-cliente-label').text('');
        $('#mensagem').text('');
    }

    function listarParcelas() {
        $('#mensagem-prod').text('');
        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/listar-parcelas.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-parc").html(result);
            }
        });
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
                    limparCampos();
                    window.location.replace('index.php?pag=lista_vendas');
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


    $(document).keyup(function(e) {
        if (e.which == 115) {
            ModalFecharVenda();
        }
    });
</script>