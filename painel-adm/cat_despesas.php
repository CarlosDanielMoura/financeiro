<?php

require_once("../conexao.php");
require_once("verificar_adm_acesso.php");

//Variveis do inputs

$pagina = 'cat_despesas';
require_once($pagina . "/campos.php");
?>



<div class="col-md-12 my-4">
    <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Nova Categoria </a>
</div>

<small>
    <div class="tableDados" id="listar">
    </div>
</small>


<!--Modal Usuário-->
<div class=" modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span id="tituloModal"> Inserir Banco</span> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="form">
                <div class="modal-body">


                    <!--Campo Usuário-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"><?php echo $campo1 ?>:</label>
                        <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="Digite nome de usuário" id="<?php echo $campo1 ?>" required>
                    </div>

                    <!--Mensagem de sucesso ou erro-->
                    <small>
                        <div id="mensagem" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id" id="id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">fechar</button>
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