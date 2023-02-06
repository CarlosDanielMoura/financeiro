<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'lista_compras';

require_once($pagina . "/campos.php");

?>

<link rel="stylesheet" href="../css/lista_venda_compras.css">

<div class="col-md-12 my-3">

</div>

<!--LINK DE CSS-->
<link rel="stylesheet" href="../css/home.css">

<div class="col-md-12 my-4">
    <a href="index.php?pag=<?php echo $menu21 ?>" class="buttonNivel btn sm" type="button">Nova Compra</a>
</div>

<small>
    <div class="tableDados bg-light" id="listar">

    </div>
</small>



<!-- Modal -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Cancelar Compra</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir" method="post">
                <div class="modal-body">

                    Deseja Realmente cancelar esta Compra? <span id="nome-excluido"></span>?

                    <?php require_once("verificar_adm.php"); ?>

                    <small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir" id="id-excluir">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Compra - SubTotal: R$ <span id="campo1"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!--LINHA 1-->
                <div class="row ">
                    <div class="dados-detalhados">
                        <div class="col-8 dados-detalhados-itens">
                            <b>Usuário:</b> <span id="campo2"></span>

                        </div>
                        <div class="col-4 dados-detalhados-itens">
                            <b>Vencimento:</b> <span id="campo6"></span>
                        </div>
                    </div>
                </div>
                <hr class="mb-3">

                <!--LINHA 2-->
                <div class="row">
                    <div class="dados-detalhados">
                        <div class="col-8 dados-detalhados-itens">
                            <b>Lançamento:</b> <span id="campo4"></span>
                        </div>
                        <div class="col-4 dados-detalhados-item">
                            <b>Pagamento:</b> <span id="campo3"></span>
                        </div>

                    </div>
                </div>

                <hr class="mb-3">
                <!--LINHA 3-->
                <div class="row mt-4 mb-3">
                    <div class="col-md-12">
                        <h5>
                            <h5>PRODUTOS COMPRADOS:</h5>
                        </h5>
                    </div>
                </div>

                <!--LINHA 4-->
                <small>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div id="listar-produto-compra"></div>
                        </div>
                    </div>
                </small>


                <!--LINHA 5-->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5>
                            <h5>INFORMAÇÕES FINANCEIRAS:</h5>
                        </h5>
                    </div>
                </div>
                <!--LINHA 6-->
                <small>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="listar-parc"></div>
                        </div>
                    </div>
                </small>


                <hr class="mb-3">
                <!--LINHA 3-->
                <div class="row">
                    <div class="dados-detalhados ">
                        <div class="col-8 dados-detalhados-itens">
                            <b>SubTotal:</b> R$ <span id="subtot"></span>
                        </div>
                        <div class="col-4 dados-detalhados-itens">
                            <b>Parcelas:</b> <span id="campo10"></span>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>