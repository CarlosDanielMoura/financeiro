<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'movimentacoes';
$data_atual = date('Y-m-d');
?>



<small>
    <ul class="nav nav-tabs my-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a onclick="pesquisarCaixa('','','Caixa')" class="nav-link active" id="caixa-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="home" aria-selected="true">Caixa</a>
        </li>
        <li class="nav-item" role="presentation">
            <a onclick="pesquisarCaixa('','','Cartão de Débito')" class="nav-link" id="debito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Cartão de Débito</a>
        </li>
        <li class="nav-item" role="presentation">
            <a onclick="pesquisarCaixa('','','Cartão de Crédito')" class="nav-link" id="credito-tab" data-bs-toggle="tab" data-bs-target="#caixa" type="button" role="tab" aria-controls="profile" aria-selected="false">Cartão de Crédito</a>
        </li>

    </ul>
</small>

<div class="tab-content" id="myTabContent">

    <input type="text" id="nome-busca">

    <div class="tab-pane fade show active" id="caixa" role="tabpanel" aria-labelledby="home-tab">

        <div class="row my-3">
            <div class="col-md-9">
                <div style="float:left; margin-right:10px">
                    <a href="#" onclick="pesquisarCaixa('', '')" class="text-dark">
                        <span><small><i title="Filtrar Todas Movimentações" class="bi bi-search"></i></small></span>
                    </a>
                </div>

                <small class="mx-2">
                    <a title="Movimentações de Entradas" class="text-success" href="#" onclick="pesquisarCaixa('Entrada', '')"><span>Entradas</span></a> /
                    <a title="Movimentações de Saídas" class="text-danger" href="#" onclick="pesquisarCaixa('Saída', '')"><span>Saídas</span></a>

                </small>


                <small class="mx-2">
                    <a title="Contas à Pagar" class="text-muted" href="#" onclick="pesquisarCaixa('', 'Conta à Pagar')"><span>Contas Pagas</span></a> /
                    <a title="Contas à Pagar Hoje" class="text-muted" href="#" onclick="pesquisarCaixa('','Conta à Receber')"><span>Contas Recebidas</span></a> /
                    <a title="Despesas" class="text-muted" href="#" onclick="pesquisarCaixa('','Despesa')"><span>Despesas</span></a>

                </small>


                <div style="float:left; margin-right:10px"><span><small><i title="Data Inicial" class="bi bi-calendar-date"></i></small></span></div>
                <div style="float:left; margin-right:20px">
                    <input type="date" class="form-control form-control-sm" name="data-inicial" id="data-inicial-caixa" value="<?php echo date('Y-m-d') ?>" required>
                </div>

                <div style="float:left; margin-right:10px"><span><small><i title="Data Final" class="bi bi-calendar-date"></i></small></span></div>
                <div style="float:left; margin-right:30px">
                    <input type="date" class="form-control form-control-sm" name="data-final" id="data-final-caixa" value="<?php echo date('Y-m-d') ?>" required>
                </div>



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

    <div class="tab-pane fade" id="debito" role="tabpanel" aria-labelledby="home-tab">
        deb
    </div>

    <div class="tab-pane fade" id="credito" role="tabpanel" aria-labelledby="home-tab">
        cre
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

        $.ajax({
            url: pag + "/listar-caixa.php",
            method: 'POST',
            data: {
                dataInicial,
                dataFinal,
                status,
                alterou_data
            },
            dataType: "html",

            success: function(result) {
                $("#listar-caixa").html(result);
            }
        });
    }


    function pesquisarCaixa(tipo, movimento, busca) {
        $('#nome-busca').val(busca);

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
</script>