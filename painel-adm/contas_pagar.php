<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'contas_pagar';
require_once($pagina . "/campos.php");
?>



<div class="col-md-12 my-4">
    <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Nova Conta</a>
</div>

<small>
    <div class="tableDados" id="listar">
    </div>
</small>

<!-- Modal -->
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
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Conta</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Cliente</a>
                        </li>

                    </ul>

                    <hr>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="Descrição" id="<?php echo $campo1 ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tipo Saída</label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>">
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

                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo4 ?></label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo4 ?>" id="<?php echo $campo4 ?>">
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


                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
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


                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Despesa</label>
                                        <div id="listar-despesas">

                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Data Emissão</label>
                                        <input type="date" class="form-control" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>" value="<?php echo date('Y-m-d') ?>" required>
                                    </div>
                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo7 ?></label>
                                        <input type="date" class="form-control" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>" value="<?php echo date('Y-m-d') ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Frequência</label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo8 ?>" id="<?php echo $campo8 ?>">

                                            <?php
                                            $query = $pdo->query("SELECT * FROM frequencias order by id asc");
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
                                        <label for="exampleFormControlInput1" class="form-label">Valor da Conta</label>
                                        <input type="text" class="form-control" name="<?php echo $campo9 ?>" id="<?php echo $campo9 ?>" placeholder="Valor da Conta" required>

                                    </div>
                                </div>




                            </div>


                        </div>

                        <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="<?php echo $campo2 ?>" id="id-cliente" placeholder="Id do Cliente" readonly>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nome-cliente" id="nome-cliente" placeholder="Nome do Cliente" readonly>
                                </div>
                            </div>

                            <small>
                                <div class="tabela bg-light" id="listar-clientes">

                                </div>
                            </small>

                        </div>

                    </div>



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


<!--Modal Fechar Caixa-->

<div class="modal fade" id="modalFecharCaixa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Fechar Caixa</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-fechar" method="post">
                <div class="modal-body">

                    Deseja realmente fechar este caixa aberto dia : <strong> <span id="data_abert"></span></strong> ?

                    <hr><small>
                        <div id="mensagem-fechar" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-fechar" id="id-fechar">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-fechar">Cancelar</button>
                    <button type="submit" class="btn btn-success">Fechar Caixa</button>
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
        //listarClientes();
        $('#cat_despesas').change(function() {
            var cat = $(this).val();
            listarDespesas(cat);
        });
    });



    function listarDespesas(cat) {
        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/listar-despesas.php",
            method: 'POST',
            data: {
                cat
            },
            dataType: "text",

            success: function(result) {
                $("#listar-despesas").html(result);
            }

        });
    }
</script>