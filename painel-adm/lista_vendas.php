<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'lista_vendas';

require_once($pagina . "/campos.php");

?>

<link rel="stylesheet" href="../css/lista_venda_compras.css">
<!--LINK DE CSS-->
<link rel="stylesheet" href="../css/home.css">


<div class="col-md-12 my-4">
    <a href="index.php?pag=<?php echo $menu20 ?>" class="buttonNivel btn sm" type="button">Nova Venda</a>
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
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Cancelar Venda</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir" method="post">
                <div class="modal-body">

                    Deseja Realmente cancelar esta Venda? <span id="nome-excluido"></span>?

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
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Venda - SubTotal: R$ <span id="campo9"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!--LINHA 1-->
                <div class="row">
                    <!--Cliente-->
                    <div class="col-md-4">
                        <span class="mx-4"><b>Cliente:</b> <span id="campo12"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Vencimento-->
                        <span class="mx-4"><b>Vencimento:</b> <span id="campo6"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Venda-->
                        <span class="mx-5"><b>Venda:</b> <span id="id"></span></span>
                    </div>

                </div>
                <hr class="mb-3">



                <!--LINHA 2-->
                <div class="row">
                    <div class="col-md-4">
                        <!--Usuário-->
                        <span class="mx-4"><b>Usuário:</b> <span id="campo2"></span></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Status-->
                        <span class="mx-4"><b>Status:</b> <span id="campo11"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Data-->
                        <span class="mx-5"><b>Data:</b> <span id="campo5"></span></span>
                    </div>
                </div>

                <hr class="mb-3">
                <!--LINHA 3-->
                <div class="row mt-4 mb-3">
                    <div class="col-md-12">
                        <h5>
                            <h5>PRODUTOS VENDIDOS:</h5>
                        </h5>
                    </div>
                </div>

                <!--LINHA 4-->
                <small>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div id="listar-produtos"></div>
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
                            <div id="listar-parcelas"></div>
                        </div>
                    </div>
                </small>



                <!--LINHA 7-->
                <div class="row">
                    <!--Lançamento-->
                    <div class="col-md-4">
                        <span class="mx-5"><b>Lançamento:</b> <span id="campo4"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Pagamento-->
                        <span class="mx-4"><b>Pagamento:</b> <span id="campo3"></span>
                    </div>

                    <div class="col-md-4">
                        <!--Parcelas-->
                        <span class="mx-4"><b>SubTotal Cliente:</b> <span id="valor_subTotal"></span></span>
                    </div>

                </div>

                <hr style="margin:10px;">
                <!--LINHA 8-->
                <div class="row">
                    <div class="col-md-4">
                        <!--Valor-->
                        <span class="mx-5"><b>Valor Total:</b> R$ <span id="campo1"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Desconto-->
                        <span class="mx-4"><b>Desconto:</b> R$ <span id="campo7"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Acréscimo-->
                        <span class="mx-4"><b>Acréscimo:</b> R$ <span id="campo8"></span></span>
                    </div>
                </div>
                <hr style="margin: 10px;">
                <div class="row">
                    <!--Lançamento-->
                    <div class="col-md-4">
                        <span class="mx-5"><b>Entrada do cliente:</b> <span id="campo14"></span></span>
                    </div>

                    <div class="col-md-4">
                        <!--Pagamento-->
                        <span class="mx-4"><b>Tipo de entrada:</b> <span id="campo13"></span>
                    </div>
                    <div class="col-md-4">
                        <!--Parcelas-->
                        <span class="mx-4"><b>Parcelas:</b> <span id="campo10"></span></span>
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