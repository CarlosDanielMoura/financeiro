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


// if (!empty($_GET['search'])) {
//     $data = $_GET['search'];
//     $query = $pdo->query("SELECT * from ordem_servico where id LIKE '%$data%' or nome_cliente  LIKE '%$data%' 
//     or status LIKE '%$data%' order by id desc");
// } else {
//     $query = $pdo->query("SELECT * from ordem_servico where status = 'Aberto' order by id desc ");
// }
?>


<script src="https://kit.fontawesome.com/6f6d0ee986.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/os.css">

<div class="col-md-12 my-4">
    <a href="index.php?pag=<?php echo $menu25 ?>" class="buttonNivel sm" type="button">Nova O.S</a>
</div>

<div class="mt-5 box-search">
    <input type="search" class="form-control w-25" id="pesquisa">

    <button onclick="searchData();" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg>
    </button>
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
                <h5 class="titulo-conteudo-blue"> R$ <?php echo $finalTotal ?></h5>
                <img class="image" src="../img/os/money.png" alt="Ordens de serviços" />
            </div>

        </div>

        <div class="card red">
            <h2>Adiantamentos</h2>
            <p>Valor total de adiantamentos</p>
            <div class="conteudo">
                <h5 class="titulo-conteudo-red">R$ <?php echo $finalEntrada ?></h5>
                <img class="image" src="../img/os/Adiantamento.png" alt="Ordens de serviços" />
            </div>

        </div>

    </div>
</div>



<div class="secao-lista-dados mt-5" id="view_clientes">

</div>

<!--Modal Excluir-->

<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-excluir-os" method="post">
                <div class="modal-body">

                    Deseja Realmente cancelar esta Ordem de Serviço: <span id="nome-excluido"></span>?

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

<script src="../js/ajax_os.js"></script>

<script>
    $(document).ready(function() {
        listarClientes()
    });

    // function searchData() {

    //     var search = document.getElementById('pesquisa');

    //     window.location = 'index.php?pag=listar_os?search=' + search.value;
    // }




    function excluir(id, nome) {
        $("#id-excluir").val(id);
        $("#nome-excluido").text(nome);
        var myModal = new bootstrap.Modal(document.getElementById("modalCancelar"), {
            backdrop: "static",
        });
        myModal.show();


    }
</script>