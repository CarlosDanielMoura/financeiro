<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'listar_os';

//require_once($pagina . "/campos.php");

//$query = $pdo->query("SELECT * from ordem_servico where status = 'Aberto' order by id desc ");
$query = $pdo->query("SELECT COUNT(*), SUM(`valor_total`), SUM(`entrada_cliente`) from ordem_servico where status = 'Aberto';
");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
//print_r($res[0]);
$listaOrdemServico = $res[0]["COUNT(*)"];
$finalTotal = $res[0]["SUM(`valor_total`)"];
$finalEntrada = $res[0]["SUM(`entrada_cliente`)"];



?>


<script src="https://kit.fontawesome.com/6f6d0ee986.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/os.css">

<div class="row">
    <div class="col-md-3 my-4">
        <a href="index.php?pag=<?php echo $menu25 ?>" class="buttonNivel sm" type="button">Nova O.S</a>
    </div>

    <div class="col-md-4">
        <small class="mx-4">
            <a title="Débitos" class="text-success" id="aberto" href="#" onclick="listarClientes()"><span>Aberto</span></a> /
            <a title="Todos" class="text-warning" id="todas" href="#" onclick="listarTodas()"><span>Todas</span></a> /
            <a title="Ordens de serviços canceladas" id="cancelado" class="text-danger" href="#" onclick="listarCanceladas()"><span>Canceladas</span></a> /
            <a title="Confirmadas" class="text-primary" id="confirmadas" href="#" onclick="listarConfirmadas()"><span>Confirmadas</span></a>
        </small>
    </div>
</div>


<div class="secao-cards">
    <div class="row-cards">
        <div class="card green">
            <h3>Ordem de serviços</h3>
            <p>Total de ordem de serviços</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-green"><?php echo $listaOrdemServico ?></h5>
                <img class="image" src="../img/os/iconeOS.png" alt="Ordens de serviços" />
            </div>

        </div>

        <div class="card blue">
            <h3>Valor total</h3>
            <p>Valor total em ordem de serviços</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-blue"> R$ <?php echo number_format($finalTotal, 2) ?></h5>
                <img class="image" src="../img/os/money.png" alt="Ordens de serviços" />
            </div>

        </div>

        <div class="card red">
            <h2>Adiantamentos</h2>
            <p>Valor total de adiantamentos</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-red">R$ <?php echo number_format($finalEntrada, 2) ?></h5>
                <img class="image" src="../img/os/Adiantamento.png" alt="Ordens de serviços" />
            </div>

        </div>

    </div>
</div>


<div class="box-search container-fluid pe-4 mt-5">
    <div class="col-8">
    </div>
    <div class="col-4 d-flex " style="gap: 3px;">
        <input type="search" class="form-control m-0" placeholder="Pesquisar pelo Nome e Nº OS" id="search" name="search">
        <button class="btn btn-primary" onclick="listarPesquisa()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>
    </div>

</div>



<div class="secao-lista-dados mt-5" id="view_clientes">

</div>

<!--Modal Cancelar OS-->

<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Cancelar Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir-os" method="post">
                <div class="modal-body">

                    Deseja realmente excluir esta Ordem de Serviço <span id="nome-excluido"></span>?

                    <hr><small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir" id="id-excluir">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-warning">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Modal Excluir OS-->

<div class="modal fade" id="modalExcluirDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir-ordem" method="post">
                <div class="modal-body">

                    Deseja realmente cancelar esta Ordem de Serviço: <span id="nome-excluido-ordem"></span>?

                    <hr><small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir-ordem" id="id-excluir-ordem">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Confirmar  OS-->

<div class="modal fade" id="modalConfirmarOS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Confirmar Ordem de Serviço</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-confirmar-os" method="post">
                <div class="modal-body">

                    Deseja realmente confirmar esta Ordem de Serviço: <span id="nome-excluido-ordem"></span>?

                    <hr><small>
                        <div id="mensagem-excluir" align="center"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-confirma-os" id="id-confirma-os">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-primary">Confirma Os</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/ajax_os.js"></script>

<script>
    function excluir(id) {
        $("#id-excluir").val(id);
        var myModal = new bootstrap.Modal(document.getElementById("modalCancelar"), {
            backdrop: "static",
        });
        myModal.show();


    }

    function excluirOrdemServiço(id) {
        $("#id-excluir-ordem").val(id);
        var myModal = new bootstrap.Modal(document.getElementById("modalExcluirDados"), {
            backdrop: "static",
        });
        myModal.show();
    }

    function confirmarOs(id) {
        $("#id-confirma-os").val(id);
        var myModal = new bootstrap.Modal(document.getElementById("modalConfirmarOS"), {
            backdrop: "static",
        });
        myModal.show();
    }


    function listarPesquisa() {
        $('#view_clientes').empty();
        let p = $('#search').val();
        $.ajax({
            url: `listar_os/search.php?search=${p}`,
            method: "GET",
            dataType: "json",
            success: function(response) {
                //console.log(response);
                $.each(response, function(key, value) {
                    //console.log(response);
                    let objAtt = JSON.parse(value.obj)

                    // Data de criação da os
                    let dataCriacao = value.data_criacao
                    let dataNova = dataCriacao.split('-').reverse().join('/')
                    let dataEntrega = objAtt.dadosPrincipal.data_entrega.split('-').reverse().join('/')
                    // Valor parcelas
                    let parcelas = objAtt.produtos.qtde_parcelas;

                    if (parcelas == "" || parcelas == 0) {


                        parcelas = 0;
                    }

value.valor_total = Number.parseFloat(value.valor_total);

                    // console.log(objAtt.dadosPrincipal);

                    let html = `  <div class="cards-clientes orange"  id="abertos" >
                                <div class="row-1">
                                    <!--Nome-->
                                    <div  class="col-3">
                                        <div  title="Nome do Cliente "> ${value.nome_cliente}</div>
                                    </div>
                                    <!--Numero da ordem de serviço-->
                                    <div class="col-3 ">
                                        <div title="Numero da OS"><i class="fa fa-flag"></i>  ${value.id}</div>
                                    </div>
                                    <!--Valor total da OS-->
                                    <div class="col-3" style="display: flex; gap: 40px">
                                        <div title="Valor total da OS">R$ ${value.valor_total.toFixed(2)} </div>
                                        <div title="SubTotal do Cliente"><i class="fa fa-money text-danger"></i> R$ ${objAtt.produtos.subTotal_Cliente}</div>
                                    </div>
                                    <!--Status da Os-->
                                    <div class="col-3">
                                        <div title="Status da OS"  class="label label-warning ${value.status == 'Cancelada' ? 'bg-danger' : ''} ${value.status == 'Confirmada' ? 'bg-primary' : ''} ">${value.status}</div>
                                    </div>
                                </div>
                                <div class="row-2 mt-4">
                                    <!--Nome Funcionario e Loja-->
                                    <div class="col-3">
                                        <div title="Nome do funcionario e loja"> <i class="fa fa-user fa-fw"></i> ${value.nome_func} - <i class="fa fa-building-o fa-fw"></i> Núcleo Visão</div>
                                    </div>
                                    <!-- Data de emissão -->
                                    <div class="col-3">
                                        <div title="Data de  resgistro da OS"><i class="fa fa-calendar-plus-o"></i> ${dataNova}</div>
                                    </div>
                                    <!--Sub total do cliente-->
                                    <div class="col-3" style="display: flex; gap: 49px">
                                        <div title="Sinal Cliente"><i class="fa fa-money text-success"></i> R$ ${objAtt.produtos.valor_entrada_cliente}</div> 
                                        <div   class=" ${parcelas == 0 ? "d-none" : ""}" title="Total de parcelas"><i class="bi bi-hourglass-split"></i></i> ${parcelas}</div>
                                    </div>
                                    <div class="col-3">
                                       
                                    </div>
                                    
                                </div>
                                

                                <div class="row-4 mt-4 ">
                                    <!--Laboratório-->
                                    <div class="col-3">
                                        <div title="Nome do funcionario e loja"> <i class="fa fa-steam fa-fw"></i>${objAtt.info_add.laboratorio}</div>
                                    </div>
                                    <!-- Data de Entrega -->
                                    <div class="col-3">
                                        <div title="Previsão de entrega"> <i class="fa fa-clock-o"></i> ${dataEntrega} - ${objAtt.dadosPrincipal.hora_entrega} </div>
                                    </div>
                                    
                                    <div class="col-3" style="display: flex; gap: 49px">
                                       
                                    </div>
                                    
                                </div>

                                <div class="row-3 mt-5">
                                    <!--Btns inicial-->
                                    <div class="col-6">
                                        <div class="">
                                            <!--Tirar comprovante OS-->
                                            <a  title="Gerar comprovante" href="../relatorios/ordemServicos_class.php?id=${value.id}" target="_blank" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="bi bi-receipt text-info"></i>
                                                Comprovante
                                            </a>
                                            <!--Visualizar OS-->
                                            <a title="Visualizar ordem de serviço" href="../painel-adm/index.php?pag=editar_os&id=${value.id}" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="fa fa fa-edit text-success"></i>
                                                Visualizar OS
                                            </a>
                                            <!--Converter em venda  OS-->
                                            <a title="Confirmação de OS" href="#" onclick="confirmarOs(${value.id})" class="btn-comprovante btn ${value.status == 'Cancelada' || value.status == 'Confirmada' ? 'd-none' : ''}">
                                            <i class="bi bi-check-square text-primary"></i>
                                                Confirmar OS
                                            </a>
                                        </div>
                                    </div>
                                    <!---Btns de CANCELAR PERDA / CANCELAR -->
                                    <div class="col-4">
                                        <div>
                                            <!--Confirmar a perca da OS-->
                                            <a onclick="excluirOrdemServiço(${value.id})"  data-toggle="modal" data-target="#exampleModal"  title="Cancelar OS" href="#" class="btn-comprovante btn ${value.status == 'Cancelada' || value.status == 'Confirmada' ? 'd-none' : ''}">
                                            <i class="bi bi-trash text-danger"></i>
                                                Excluir
                                            </a>
                                            <!--Cancelar OS-->
                                            <a   title="Excluir OS" href="#" onclick="excluir(${value.id})" class="btn-comprovante btn ${value.status == 'Cancelada' || value.status == 'Confirmada' ? 'd-none' : ''}">
                                                <i class="bi bi-x-octagon text-warning"></i>
                                                Cancelar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                    $('#view_clientes').append(html)
                })

            },
        });

    }
</script>