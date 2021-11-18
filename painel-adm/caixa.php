<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'caixa';
require_once($pagina . "/campos.php");
?>



<div class="col-md-12 my-4">
    <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Nova Abertura</a>
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
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Nova Abertura</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 col-sm-12 d-flex " style="justify-content: center;">
                            <div>
                                <strong> <label for="exampleFormControlInput1" class="form-label">Valor Abertura:</label></strong>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-2">
                                <input type="number" class="form-control" value="0" name="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>" placeholder="Valor da Abertura">
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

                    Deseja Realmente excluir este Registro: <span id="nome-excluido"></span>?<br><br>
                    <?php require_once("verificar_adm.php") ?>

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
    // Ajax de excluir
    $("#form-fechar").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var pag = "<?= $pagina ?>";
        $.ajax({
            url: pag + "/fechar-caixa.php",
            type: "POST",
            data: formData,

            success: function(mensagem) {
                $("#mensagem-fechar").text("");
                $("#mensagem-fechar").removeClass();
                if (mensagem.trim() == "Fechado com Sucesso!") {
                    $("#btn-fechar-fechar").click();
                    listar();
                } else {
                    $("#mensagem-fechar").addClass("text-danger");
                    $("#mensagem-fechar").text(mensagem);
                }
            },

            cache: false,
            contentType: false,
            processData: false,
        });
    });
</script>