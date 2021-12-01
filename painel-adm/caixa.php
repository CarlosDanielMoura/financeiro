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

<div class="modal fade" id="modalFechar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


<!-- MODAL TIPOS DE MOVIMENTAÇÕES -->
<div class="modal fade" id="modalMovimentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal"><small>Movimentação do Caixa</span> - <span id="titulo-movimento"></span> - Valor Abertura R$ <span id="valor-abertura"></span></small></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row my-1">
                    <div class="col-md-9">
                        <div style="float:left; margin-right:10px">
                            <a href="#" onclick="pesquisar('', '')" class="text-dark">
                                <span><small><i title="Filtrar Movimentações" class="bi bi-search"></i></small></span>
                            </a>
                        </div>

                        <small class="mx-4">
                            <a title="Movimentações de Entradas" class="text-success" href="#" onclick="pesquisar('Entrada', '')"><span>Entradas</span></a> /
                            <a title="Movimentações de Saídas" class="text-danger" href="#" onclick="pesquisar('Saída', '')"><span>Saídas</span></a>

                        </small>


                        <small class="mx-4">
                            <a title="Contas à Pagar" class="text-muted" href="#" onclick="pesquisar('', 'Conta à Pagar')"><span>Contas Pagas</span></a> /
                            <a title="Contas à Pagar Hoje" class="text-muted" href="#" onclick="pesquisar('','Conta à Receber')"><span>Contas Recebidas</span></a> /
                            <a title="Despesas" class="text-muted" href="#" onclick="pesquisar('','Despesa')"><span>Despesas</span></a>

                        </small>


                    </div>

                    <div align="right" class="col-md-2">
                        <small><span id="icone_total"><i class="bi bi-cash"></i></span> <span class="text-dark">Total: <span id="total_itens"></span></span></small>
                    </div>
                </div>

                <input type="hidden" class="form-control" name="id-caixa" id="id-caixa">

                <small>
                    <div id="listar-movimentos" class="my-4"></div>
                </small>

            </div>

        </div>
    </div>
</div>


<!-- MODAL DADOS MOVIMENTAÇÕES -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Movimentação: <span id="campo3" class="text-success"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <small>

                    <div class="row">
                        <!--CAMPO TIPO-->
                        <div class="col-4">
                            <span><b>Tipo:</b> <span id="campo1"></span></span>
                        </div>
                        <!--CAMPO MOVIMENTAÇÃO-->
                        <div class="col-8">
                            <span class=""><b>Movimento</b> <span id="campo2"></span></span>
                        </div>
                        <hr>
                    </div>

                    <div class="row">
                        <!--CAMPO VALOR-->
                        <div class="col-4">
                            <span><b>Valor:</b> R$ <span id="campo4"></span></span>
                        </div>
                        <!--CAMPO PLANO CONTA-->
                        <div class="col-8">
                            <span><b>Plano de Conta</b> <span id="campo8"></span></span>
                        </div>
                        <hr>
                    </div>

                    <div class="row">
                        <!--CAMPO USUÁRIO-->
                        <div class="col-4">
                            <span class=""><b>Usuário</b> <span id="campo5"></span></span>
                        </div>
                        <!--CAMPO DATA PAGAMENTO-->
                        <div class="col-8">
                            <span><b>Data:</b> <span id="campo6"></span></span>
                        </div>
                        <hr>
                    </div>


                    <div class="row ">
                        <!--CAMPO LAÇAMENTO-->
                        <div class="col-4">
                            <span class=""><b>Lançamento:</b> <span id="campo7"></span></span>
                        </div>
                        <!--CAMPO DOCUMENTO-->
                        <div class="col-8 ">
                            <span><b>Documento</b> <span id="campo9"></span></span>
                        </div>
                        <hr>
                    </div>









                </small>


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


                //PESQUISAR MOVIMENTOS
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
            </script>