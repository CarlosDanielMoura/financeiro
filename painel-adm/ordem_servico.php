<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'ordem_servico';

//require_once($pagina . "/campos.php");
?>

<link rel="stylesheet" href="../css/os.css">

<link rel="stylesheet" href="../css/util.css">


<div class="container-fluid">
    <form action="">
        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Nova O.S - Dados Principais</h3>
                <hr>
            </div>

            <div class="row">
                <div class="col-3 Input-details-1">
                    <label>Nome Loja:</label>
                    <input type="text" class="form-control" name="" placeholder="Nucleo Visão">
                    <i class="bi bi-house-fill" aria-hidden="true"></i>
                </div>

                <div class="col-3 Input-details-func">
                    <label>Tipo de O.S:</label>
                    <input type="text" class="form-control" name="" placeholder="Optica">
                </div>

                <div class="col-3 Input-details-func">
                    <label>Data de Registro:</label>
                    <input type="date" class="form-control" name="">
                </div>

                <div class="col-3 Input-details-func">
                    <label>Hora de Registo:</label>
                    <input type="time" class="form-control" name="">
                </div>
            </div>
            <div class="row">
                <div class="col-6 Input-details-func">
                    <label>Funcionário:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu funcionário"></i>
                    <select class="form-select" aria-label="Default select example" name="user-os" id="user-os">
                        <?php
                        $query = $pdo->query("SELECT * FROM usuarios order by nome asc");
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

                <div class="col-2 Input-details-1">
                    <label>Número da O.S:</label>
                    <input type="number" class="form-control" name="" readonly>
                    <i class="bi bi-flag-fill" title="Será gerado um número automático para ordem de serviço"></i>
                </div>
            </div>

            <div class="row">
                <div class="col-6 Input-details-func">
                    <label>Cliente:</label>
                    <i class="bi bi-question-circle-fill" title="Selecione seu cliente"></i>
                    <select class="form-select sel2" aria-label="Default select example" name="user-os" id="user-os">
                        <?php
                        $query = $pdo->query("SELECT * FROM clientes where nome != 'Venda Rápida' order by nome asc");
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
                <div class="col-3 Input-details-1">
                    <label>Data de Entrega:</label>
                    <input type="date" class="form-control" name="">
                </div>
                <div class="col-3 Input-details-1">
                    <label>Hora de entrega:</label>
                    <input type="time" class="form-control" name="">

                </div>
            </div>

            <div class="row">
                <div class="col-9 Input-details-obs">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" id="observacao" rows="3"></textarea>

                </div>
            </div>

        </div>

        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Produtos e Serviços</h3>
                <hr>
            </div>
            <div class="row ">
                <div class="col-5 Input-details-func">
                    <label>Escolha os produtos:</label>
                    <i class="bi bi-question-circle-fill" title="Digite sua opção de produto pelo codigo , nome ou valor."></i>
                    <select class="form-select sel2" aria-label="Default select example" name="user-os" id="user-os">
                        <?php
                        $query = $pdo->query("SELECT * FROM produtos where nome != 'Venda Rápida' order by nome asc");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_item = $res[$i]['id'];
                            $codigo = $res[$i]['codigo'];
                            $nome_item = $res[$i]['nome'];
                            $valor_venda = $res[$i]['valor_venda'];

                        ?>
                            <option value="<?php echo $nome_item ?>">
                                <?php echo $codigo ?>
                                <?php echo ' - ' ?>
                                <?php echo $nome_item ?>
                                <?php echo ' - ' ?>
                                <?php echo ' R$ ' ?>
                                <?php echo $valor_venda ?>
                            </option>

                        <?php } ?>
                    </select>
                </div>

                <div class="col-7 Input-details-add">
                    <a href="#" class="" onclick="" title="Adicionar Produto">
                        <i class="bi bi-plus-square-fill text-black "></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="dados-principais">
            <div class="row">
                <h3 class="titulo-os">Dados da Receita</h3>
                <hr>
            </div>
        </div>
    </form>
</div>

<script>
    $('.sel2').select2({
        placeholder: 'Selecione um Cliente',
        //dropdownParent: $('#modalForm')
    });
</script>

<style type="text/css">
    .select2-selection__rendered {
        line-height: 36px !important;
        font-size: 16px !important;
        color: #666666 !important;

    }

    .select2-selection {
        height: 40px !important;
        font-size: 16px !important;
        color: #666666 !important;

    }
</style>