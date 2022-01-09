<?php

require_once("../conexao.php");
require_once("verificar_adm_acesso.php");

//Variveis do inputs

$pagina = 'bancarias';
require_once($pagina . "/campos.php");
?>



<div class="col-md-12 my-4">
    <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Nova Conta Bancária</a>
</div>

<small>
    <div class="tableDados" id="listar">
    </div>
</small>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"><?php echo $campo1 ?> </label>
                                <select class="form-select" aria-label="Default select example" name="<?php echo $campo1 ?>" id="<?php echo $campo1 ?>">
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

                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"><?php echo $campo2 ?></label>
                                <input type="text" class="form-control" name="<?php echo $campo2 ?>" placeholder="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"><?php echo $campo3 ?></label>
                                <input type="text" class="form-control" name="<?php echo $campo3 ?>" placeholder="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"><?php echo $campo4 ?></label>
                                <select class="form-select" aria-label="Default select example" name="<?php echo $campo4 ?>" id="<?php echo $campo4 ?>">
                                    <option value="Corrente">Corrente</option>
                                    <option value="Poupança">Poupança</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Física / Juíridica</label>
                                <select class="form-select" aria-label="Default select example" name="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>">
                                    <option value="Física">Física</option>
                                    <option value="Jurídica">Jurídica</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">CPF / CNPJ</label>
                                <input type="text" class="form-control" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>" required>
                            </div>
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



<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>


<script>
    $(document).ready(function() {
        //Funcão do CPF/CNPJ
        $('#<?= $campo6 ?>').mask('000.000.000-00');
        $('#<?= $campo6 ?>').attr('placeholder', 'CPF');

        $('#<?= $campo5 ?>').change(function() {
            if ($(this).val() == 'Física') {
                $('#<?= $campo6 ?>').mask('000.000.000-00');
                $('#<?= $campo6 ?>').attr('placeholder', 'CPF');
            } else {
                $('#<?= $campo6 ?>').mask('00.000.000/0000-00');
                $('#<?= $campo6 ?>').attr('placeholder', 'CNPJ');
            }
        });
    });
</script>