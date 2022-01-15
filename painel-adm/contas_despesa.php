<?php
require_once("../conexao.php");
require_once("verificar_adm_acesso.php");
$pagina = 'contas_despesa';

require_once($pagina . "/campos.php");

?>
<!--LINK DE CSS-->
<link rel="stylesheet" href="../css/home.css">

<div class="row my-3 align-items-center">
    <div class="col-md-9">

        <div style="float:left; margin-right:35px">
            <a href="#" onclick="inserir()" type="button" class="btn btn-dark  buttonNivel">Nova Despesa</a>
        </div>

        <div class="filter">
            <span class="checkIcon"><i class="bi bi-calendar-date" title="Data de Vencimento Inicial"></i> </span>
            <input type="date" class="form-control form-control-sm" name="data-inicial" id="data-inicial" value="<?php echo date('Y-m-d') ?>" required>
        </div>

        <div class="filter">
            <span class="checkIcon"><i class="bi bi-calendar-date" title="Data de Vencimento Final"></i></span>
            <input type="date" class="form-control form-control-sm" name="data-final" id="data-final" value="<?php echo date('Y-m-d') ?>" required>
        </div>

    </div>
    <div align="right" class="col-md-2">
        <small><i class="bi bi-cash text-danger"></i> <span class="text-dark">Total: <span class="text-danger" id="total_itens"></span></span></small>
    </div>


</div>

<small>
    <div class="tableDados bg-light" id="listar">

    </div>
</small>



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
                                <div class="tabela bg-light" id="listar-clientes">

                                </div>
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



<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>

<script>
    $(document).ready(function() {
        var cat = $('#cat_despesas').val();
        listarDespesas(cat);
        listarClientes();
        $('#cat_despesas').change(function() {
            var cat = $(this).val();
            listarDespesas(cat);
        });

        $('#data-inicial').change(function() {
            var dataInicial = $('#data-inicial').val();
            var dataFinal = $('#data-final').val();
            var status = $('#status-busca').val();
            var alterou_data = 'Sim';
            listarBusca(dataInicial, dataFinal, status, alterou_data);
        });

        $('#data-final').change(function() {
            var dataInicial = $('#data-inicial').val();
            var dataFinal = $('#data-final').val();
            var status = $('#status-busca').val();
            var alterou_data = 'Sim';
            listarBusca(dataInicial, dataFinal, status, alterou_data);
        });



    });



    function listarBusca(dataInicial, dataFinal, status, alterou_data) {
        $.ajax({
            url: pag + "/listar.php",
            method: 'POST',
            data: {
                dataInicial,
                dataFinal,
                status,
                alterou_data
            },
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }



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



    function listarDespesas(cat, despesa) {
        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/listar-despesas.php",
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
</script>