<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs

$pagina = 'contas_pagar';
require_once($pagina . "/campos.php");
?>



<div class="col-md-12 my-4">
   <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Nova Conta</a>
</div>

<small>
   <div class="tableDados" id="listar">
   </div>
</small>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Registro</span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="form" method="post">
            <div class="modal-body">



               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Conta</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Cliente</a>
                  </li>

               </ul>

               <hr>

               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

                     <div class="row">
                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                              <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="Descrição" id="<?php echo $campo1 ?>" required>
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Tipo Saída</label>
                              <select class="form-select" aria-label="Default select example" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>">
                                 <option value="Caixa">Caixa (Movimento)</option>

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

                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label"><?php echo $campo4 ?></label>
                              <select class="form-select" aria-label="Default select example" name="<?php echo $campo4 ?>" id="<?php echo $campo4 ?>">
                                 <option value="Dinheiro">Dinheiro</option>
                                 <option value="Boleto">Boleto</option>
                                 <option value="Cheque">Cheque</option>
                                 <option value="Conta Corrente">Conta Corrente</option>
                                 <option value="Conta Poupança">Conta Poupança</option>
                                 <option value="Carnê">Carnê</option>
                                 <option value="DARF">DARF</option>
                                 <option value="Depósito">Depósito</option>
                                 <option value="Transferência">Transferência</option>
                                 <option value="Pix">Pix</option>
                              </select>
                           </div>
                        </div>


                     </div>

                     <div class="row">
                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Plano de Conta</label>
                              <select class="form-select" aria-label="Default select example" name="cat_despesas" id="cat_despesas">

                                 <?php
                                 $query = $pdo->query("SELECT * FROM cat_despesas order by nome asc");
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


                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Despesa</label>
                              <div id="listar-despesas">

                              </div>

                           </div>
                        </div>


                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Data Emissão</label>
                              <input type="date" class="form-control" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>" value="<?php echo date('Y-m-d') ?>" required>
                           </div>
                        </div>

                     </div>



                     <div class="row">

                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label"><?php echo $campo7 ?></label>
                              <input type="date" class="form-control" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>" value="<?php echo date('Y-m-d') ?>" required>
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Frequência</label>
                              <select class="form-select" aria-label="Default select example" name="<?php echo $campo8 ?>" id="<?php echo $campo8 ?>">

                                 <?php
                                 $query = $pdo->query("SELECT * FROM frequencias order by id asc");
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


                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Valor da Conta</label>
                              <input type="text" class="form-control" name="<?php echo $campo9 ?>" id="<?php echo $campo9 ?>" placeholder="Valor da Conta" required>

                           </div>
                        </div>




                     </div>


                  </div>

                  <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">

                     <div class="row mb-4" style="justify-content: center;">
                        <div class="col-md-1">
                           <input type="text" class="form-control" name="<?php echo $campo2 ?>" id="id-cliente" placeholder="Id" readonly>
                        </div>

                        <div class="col-md-3">
                           <input type="text" class="form-control" name="nome-cliente" id="nome-cliente" placeholder="Nome do Cliente" readonly>
                        </div>
                     </div>

                     <small>
                        <div class="tableDados bg-light" id="listar-clientes">

                        </div>
                     </small>

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

               Deseja Realmente excluir este Registro: <strong><span id="nome-excluido"></span></strong>?
               <hr>
               <?php require_once("verificar_adm.php"); ?>

               <small>
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

<div class="modal fade" id="modalDadosContaPagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Dados da Conta</span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <small>

               <!--lINHA 1-->
               <div class="row">

                  <!--CAMPO DESCRIÇÃO -->
                  <div class="col-4">
                     <span><b>Descrição:</b> <span id="campo1"></span></span>
                  </div>

                  <!--CAMPO CLIENTE -->
                  <div class="col-4">
                     <span><b>Cliente:</b> <span id="campo2"></span></span>
                  </div>

                  <!--CAMPO VALOR -->
                  <div class="col-4">
                     <span><b>Valor:</b> R$ <span id="campo9"></span></span>
                  </div>

               </div>
               <hr>
               <!--lINHA 2-->
               <div class="row">

                  <!--CAMPO DATA EMISSÃO -->
                  <div class="col-4">
                     <span><b>Emissão:</b> <span id="campo6"></span></span>
                  </div>

                  <!--CAMPO DATA VENCIMENTO -->
                  <div class="col-5">
                     <span><b>Vencimento:</b> <span id="campo7"></span></span>
                  </div>

                  <!--CAMPO STATUS -->
                  <div class="col-3">
                     <span><b>Status:</b> <span id="campo13"></span></span>
                  </div>

               </div>
               <hr>
               <!--lINHA 3-->
               <div class="row">

                  <!--CAMPO SAÍDA-->
                  <div class="col-3">
                     <span><b>Saída:</b> <span id="campo3"></span></span>
                  </div>

                  <!--CAMPO FORMA DE PAGAMENTO / DOCUMENTO-->
                  <div class="col-4">
                     <span><b>Forma PGTO:</b> <span id="campo4"></span></span>
                  </div>
                  <!-- CAMPO  PLANO CONTA-->
                  <div class="col-4">
                     <span><b>Plano Conta:</b> <span id="campo5"></span></span>
                  </div>
               </div>
               <hr>
               <!--lINHA 4-->
               <div class="row">

                  <!--CAMPO USUÁRIO LANÇAMENTO-->
                  <div class="col-5">
                     <span><b>Usuário lanc:</b> <span id="campo10"></span></span>
                  </div>

                  <!--CAMPO USUÁRIO BAIXA-->
                  <div class="col-4">
                     <span><b>Usuário Baixa:</b> <span id="campo11"></span></span>
                  </div>
                  <!-- CAMPO FREQUÊNCIA-->
                  <div class="col-3">
                     <span><b>Frequência:</b> <span id="campo8"></span></span>
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


<script>
   $(document).ready(function() {
      var cat = $('#cat_despesas').val();
      listarDespesas(cat);
      listarClientes();
      $('#cat_despesas').change(function() {
         var cat = $(this).val();
         listarDespesas(cat);
      });
   });



   function listarDespesas(cat, despesa) {
      var pag = "<?= $pagina ?>";
      $.ajax({
         url: pag + "/listar-despesas.php",
         method: 'POST',
         data: {
            cat,
            despesa
         },
         dataType: "text",

         success: function(result) {
            $("#listar-despesas").html(result);
         }

      });
   }

   function listarClientes() {
      var pag = "<?= $pagina ?>";
      $.ajax({
         url: pag + "/listar-clientes.php",
         method: 'POST',
         data: $('#form').serialize(),
         dataType: "html",

         success: function(result) {
            $("#listar-clientes").html(result);
         }

      });
   }
</script>