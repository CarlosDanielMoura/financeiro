<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'clientes';
require_once($pagina . "/campos.php");
?>

<link rel="stylesheet" href="../css/icones.css">


<div class="col-md-12 my-4">
    <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Novo Cliente</a>
</div>

<div class="row iconesSquare " style="letter-spacing: 2px;">
    <div class="col-md-3 mb-3">
        <i class="bi bi-square-fill text-success"> <strong> <small> Clientes ativos</small> </strong> </i>
    </div>

    <div class="col-md-3">
        <i class="bi bi-square-fill text-danger"> <strong> <small> Clientes não ativos</small></strong></i>
    </div>
</div>


<small>
    <div class="tableDados" id="listar">
    </div>
</small>


<!--Modal Usuário-->
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
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Dados Pessoais</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Dados Bancários</a>
                        </li>

                    </ul>

                    <hr>
                    <!-- Tabs Dados Pessoais -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">
                            <!-- CAMPO NOME -->
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo1 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="<?php echo $campo1 ?>" id="<?php echo $campo1 ?>" required>
                                    </div>
                                </div>
                                <!-- CAMPO PESSOA-->
                                <div class="col-md-2 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo2 ?></label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>">
                                            <option value="Física">Física</option>
                                            <option value="Jurídica">Jurídica</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- CAMPO DOCUMENTO-->
                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">CPF / CNPJ</label>
                                        <input type="text" class="form-control" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>" required>
                                    </div>
                                </div>
                                <!-- CAMPO EMAIL-->
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo11 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo11 ?>" id="<?php echo $campo11 ?>" placeholder="<?php echo $campo11 ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- CAMPO TELEFONE-->
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo4 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo4 ?>" placeholder="<?php echo $campo4 ?>" id="<?php echo $campo4 ?>" required>
                                    </div>
                                </div>

                                <!-- CAMPO ENDEREÇO-->
                                <div class="col-md-7 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo5 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo5 ?>" placeholder="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>">
                                    </div>
                                </div>

                                <!-- CAMPO ATIVO-->
                                <div class="col-md-2 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo6 ?></label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>">
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- CAMPOS OBSERVAÇÃO-->
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Observações</label>
                                <textarea maxlength="150" class="form-control" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>"></textarea>
                            </div>


                        </div>
                        <!-- TABS  BANCO-->
                        <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- CAMPO BANCO-->
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo8 ?> </label>
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $campo8 ?>" id="<?php echo $campo8 ?>">
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
                                <!-- CAMPO AGENCIA-->
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo9 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo9 ?>" placeholder="<?php echo $campo9 ?> Traço e Dígito" id="<?php echo $campo9 ?>">
                                    </div>
                                </div>

                                <!-- CAMPO CONTA-->
                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo10 ?></label>
                                        <input type="text" class="form-control" name="<?php echo $campo10 ?>" id="<?php echo $campo10 ?>" placeholder="<?php echo $campo10 ?> Corrente 012356-1">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- CAMPO MENSAGEM USUARIOS-->
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



<!--Modal Ver Dados Clientes-->

<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Dados do Cliente</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small>

                    <!--LINHA 1-->
                    <div class="row">
                        <!--CAMPO NOME-->
                        <div class="col-6">
                            <span><b><?php echo $campo1 ?>:</b> <span id="campo1"></span></span>
                        </div>
                        <!--CAMPO ATIVO-->
                        <div class="col-6">
                            <span><b><?php echo $campo6 ?>:</b> <span id="campo6"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <!--LINHA 2-->
                    <div class="row">
                        <div class="col-6">
                            <!--CAMPO PESSOA-->
                            <span><b><?php echo $campo2 ?>:</b> <span id="campo2"></span></span>
                        </div>
                        <div class="col-6">
                            <!--CAMPO CPF/CNPJ-->
                            <span><b>CPF / CNPJ:</b> <span id="campo3"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 3-->
                    <div class="row">
                        <div class="col-6">
                            <!--CAMPO TELEFONE-->
                            <span><b><?php echo $campo4 ?>:</b> <span id="campo4"></span></span>
                        </div>

                        <div class="col-6">
                            <!--CAMPO EMAIL-->
                            <span><b><?php echo $campo11 ?>:</b> <span id="campo11"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 4-->
                    <div class="row">
                        <div class="col-12">
                            <!--CAMPO ENDEREÇO-->
                            <span><b><?php echo $campo5 ?>:</b> <span id="campo5"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 5-->
                    <div class="row">
                        <div class="col-12">
                            <!--CAMPO OBSERVAÇÃO-->
                            <span><b>Observação: </b><span id="campo7"></span></span>
                        </div>
                        <hr class="mt-2">
                    </div>

                    <!--LINHA 6-->
                    <div class="row">
                        <div class="col-4">
                            <!--CAMPO BANCO-->
                            <span><b><?php echo $campo8 ?>:</b> <span id="campo8"></span></span>
                        </div>

                        <div class="col-4">
                            <!--CAMPO AGENCIA-->
                            <span><b><?php echo $campo9 ?>:</b> <span id="campo9"></span></span>
                        </div>

                        <div class="col-4">
                            <!--CAMPO CONTA-->
                            <span><b><?php echo $campo10 ?>:</b> <span id="campo10"></span></span>
                        </div>
                    </div>
                </small>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>


<script>
    $(document).ready(function() {
        //Funcão do CPF/CNPJ
        $('#<?= $campo3 ?>').mask('000.000.000-00');
        $('#<?= $campo3 ?>').attr('placeholder', 'CPF');

        $('#<?= $campo2 ?>').change(function() {
            if ($(this).val() == 'Física') {
                $('#<?= $campo3 ?>').mask('000.000.000-00');
                $('#<?= $campo3 ?>').attr('placeholder', 'CPF');
            } else {
                $('#<?= $campo3 ?>').mask('00.000.000/0000-00');
                $('#<?= $campo3 ?>').attr('placeholder', 'CNPJ');
            }
        });
    });
</script>