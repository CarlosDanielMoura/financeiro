<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'contas_receber';

require_once($pagina . "/campos.php");

if ($frequencia_automatica != 'Não') {
   //ROTINA PARA VERIFICAR COBRANÇAS RECORRENTES
   $data_atual = date('Y-m-d');
   $dia = date('d');
   $mes = date('m');
   $ano = date('Y');

   $query = $pdo->query("SELECT * from $pagina order by id desc ");
   $res = $query->fetchAll(PDO::FETCH_ASSOC);
   for ($i = 0; $i < @count($res); $i++) {
      foreach ($res[$i] as $key => $value) {
      }

      $id = $res[$i]['id'];
      $cp1 = $res[$i]['descricao'];
      $cp2 = $res[$i]['cliente'];
      $cp3 = $res[$i]['entrada'];
      $cp4 = $res[$i]['documento'];
      $cp5 = $res[$i]['plano_conta'];
      $cp6 = $res[$i]['data_emissao'];
      $cp7 = $res[$i]['vencimento'];
      $cp8 = $res[$i]['frequencia'];
      $cp9 = $res[$i]['valor'];
      $cp10 = $res[$i]['usuario_lanc'];
      $cp11 = $res[$i]['usuario_baixa'];

      $cp13 = $res[$i]['status'];
      $cp14 = $res[$i]['data_recor'];

      $recor_str = explode("-", $cp14);

      $dia_recor = @$recor_str[2];


      $frequencia = $res[$i]['frequencia'];
      $query1 = $pdo->query("SELECT * from frequencias where nome = '$frequencia' ");
      $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
      $dias_frequencia = $res1[0]['dias'];

      if ($dias_frequencia == 30 || $dias_frequencia == 31) {

         $data_recor = date('Y/m/d', strtotime("+1 month", strtotime($data_atual)));
         $nova_data_vencimento = date('Y/m/d', strtotime("+1 month", strtotime($cp7)));
      } else if ($dias_frequencia == 90) {

         $data_recor = date('Y/m/d', strtotime("+3 month", strtotime($data_atual)));
         $nova_data_vencimento = date('Y/m/d', strtotime("+3 month", strtotime($cp7)));
      } else if ($dias_frequencia == 180) {

         $data_recor = date('Y/m/d', strtotime("+6 month", strtotime($data_atual)));
         $nova_data_vencimento = date('Y/m/d', strtotime("+6 month", strtotime($cp7)));
      } else if ($dias_frequencia == 360) {

         $data_recor = date('Y/m/d', strtotime("+1 year", strtotime($data_atual)));
         $nova_data_vencimento = date('Y/m/d', strtotime("+1 year", strtotime($cp7)));
      } else {
         $data_recor = date('Y/m/d', strtotime("+$dias_frequencia days", strtotime($data_atual)));
         $nova_data_vencimento = date('Y/m/d', strtotime("+$dias_frequencia days", strtotime($cp7)));
      }


      if ($dias_frequencia > 0) {
         if ($dia_recor == $dia) {


            $pdo->query("INSERT INTO $pagina set descricao = '$cp1', cliente = '$cp2', entrada = '$cp3', documento = '$cp4', plano_conta = '$cp5', data_emissao = curDate(), vencimento = '$nova_data_vencimento', frequencia = '$cp8', valor = '$cp9', usuario_lanc = '$cp10', status = 'Pendente', data_recor = '$data_recor'");
            $id_ult_registro = $pdo->lastInsertId();

            $pdo->query("UPDATE $pagina set data_recor = '' where id= '$id'");



            if ($data_atual == $cp6) {
               $pdo->query("DELETE FROM $pagina where id='$id_ult_registro'");
               $pdo->query("UPDATE $pagina SET data_recor = '$data_recor' where id='$id'");
            }
         }
      }
   }
}

?>






<div class="row  center-line  my-3">

   <div class="col-md-9">


      <!--BOTÃO DE ADICIONAR-->
      <div class="filter">
         <a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Nova Conta</a>
      </div>
      <small>


         <!--FILTRO POR DATAS-->
         <div class="filter">
            <span class="checkIcon"><i class="bi bi-calendar-date" title="Data de Vencimento Inicial"></i> </span>
            <input type="date" class="form-control form-control-sm" name="data-inicial" id="data-inicial" value="<?php echo date('Y-m-d') ?>" required>
         </div>

         <div class="filter">
            <span class="checkIcon"><i class="bi bi-calendar-date" title="Data de Vencimento Final"></i></span>
            <input type="date" class="form-control form-control-sm" name="data-final" id="data-final" value="<?php echo date('Y-m-d') ?>" required>
         </div>

         <div class="filter">
            <span class="checkIcon"><small><i class="bi bi-search"></i></small></span>
            <div class="">
               <select class="form-select form-select-sm" aria-label="Default select example" name="status-busca" id="status-busca">
                  <option value="">Pendentes / Pagas</option>
                  <option value="Pendente">Pendente</option>
                  <option value="Paga">Pagas</option>
               </select>
            </div>
         </div>

         <div class="filter " style=" height: 30px; margin-top: 8px; margin-left: 15px;">
            <a href="#" onclick="listarContasVencidas('Vencidas')" class="text-dark mr-2 " style="text-decoration: none;" title="Contas à Pagar Vencidas"> <span>Vencidas</span></a> &nbsp/&nbsp
            <a href="#" onclick="listarContasVencidas('Hoje')" class="text-dark" style="text-decoration: none;" title="Contas à Pagar Vence Hoje"> <span>Hoje</span> </a>&nbsp/&nbsp
            <a href="#" onclick="listarContasVencidas('Amanha')" class=" text-dark " style="text-decoration: none;" title="Contas à Pagar Vence Amanhã"><span>Amanhã</span></a>
         </div>

      </small>


   </div>

   <!---CAMPO DE TOTAL CONTAS-->
   <div class=" col-md-2 my-2" align="right">
      <i class="bi bi-coin text-danger"></i>
      <span class="text-dark ml-5">Total: <span id="total_itens" class="text-danger"></span></span>

   </div>



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
                     <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Clientes</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Conta</a>
                  </li>

               </ul>

               <hr>

               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">
                     <!--TAB CLIENTES-->
                     <div class="row mb-4 justify-content-center">
                        <div class="col-md-2">
                           <input type="text" style="text-align: center;" class="form-control " name="<?php echo $campo2 ?>" id="id-cliente" placeholder="id" readonly>
                        </div>

                        <div class="col-md-3">
                           <input type="text" style="text-align: center;" class="form-control" name="nome-cliente" id="nome-cliente" placeholder="Nome do Cliente" readonly>
                        </div>
                     </div>

                     <small>
                        <div class="tableDados bg-light" id="listar-clientes">

                        </div>
                     </small>

                  </div>

                  <div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">

                     <!-- <div class="col-md-4 col-sm-12">
                        <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Clientes</label>
                           <select class="form-select" aria-label="Default select example" name="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>">
                              <?php
                              $query = $pdo->query("SELECT * FROM clientes order by nome asc");
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
                     </div>-->
                     <div class="row">
                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                              <input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="Descrição" id="<?php echo $campo1 ?>">
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Tipo Entrada</label>
                              <select class="form-select" aria-label="Default select example" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>">
                                 <option value="Caixa">Caixa (Movimento)</option>
                                 <option value="Cartão de Débito">Cartão de Débito</option>
                                 <option value="Cartão de Crédito">Cartão de Crédito</option>

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

                        <div class="col-md-3 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Data Emissão</label>
                              <input type="date" class="form-control" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>" value="<?php echo date('Y-m-d') ?>" required>
                           </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label"><?php echo $campo7 ?></label>
                              <input type="date" class="form-control" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>" value="<?php echo date('Y-m-d') ?>" required>
                           </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
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


                        <div class="col-md-3 col-sm-12">
                           <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Valor da Conta</label>
                              <input type="text" class="form-control" name="<?php echo $campo9 ?>" id="<?php echo $campo9 ?>" placeholder="Valor da Conta">

                           </div>
                        </div>




                     </div>



                  </div>

               </div>


               <br>
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


<!--Modal Ver Dados COMPRA A PAGAR-->

<div class="modal fade" id="modalDadosContaPagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Dados da Conta </span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <small>

               <!--LINHA 1-->
               <div class="row">

                  <!--CAMPO CLIENTE -->
                  <div class="col-6">
                     <span><b>Cliente:</b> <span id="campo2"></span></span>
                  </div>

                  <!--CAMPO VALOR -->
                  <div class="col-6">
                     <span><b>Valor:</b> R$ <span id="campo9"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>


               <!--lINHA 2-->
               <div class="row">

                  <!--CAMPO DESCRIÇÃO -->
                  <div class="col-12">
                     <span><b>Descrição:</b> <span id="campo1"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>



               <!--lINHA 3-->
               <div class="row">

                  <!--CAMPO DATA EMISSÃO -->
                  <div class="col-6">
                     <span><b>Emissão:</b> <span id="campo6"></span></span>
                  </div>

                  <!--CAMPO DATA VENCIMENTO -->
                  <div class="col-6">
                     <span><b>Vencimento:</b> <span id="campo7"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>

               <!--LINHA 4-->
               <div class="row">
                  <!--CAMPO STATUS -->
                  <div class="col-6">
                     <span><b>Status:</b> <span id="campo13"></span></span>
                  </div>

                  <!--CAMPO SAÍDA-->
                  <div class="col-6">
                     <span><b>Saída:</b> <span id="campo3"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>


               <!--lINHA 5-->
               <div class="row">
                  <!--CAMPO FORMA DE PAGAMENTO / DOCUMENTO-->
                  <div class="col-6">
                     <span><b>Forma PGTO:</b> <span id="campo4"></span></span>
                  </div>

                  <!-- CAMPO FREQUÊNCIA-->
                  <div class="col-6">
                     <span><b>Frequência:</b> <span id="campo8"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>

               <!--lINHA 7-->
               <div class="row">
                  <!--CAMPO USUÁRIO LANÇAMENTO-->
                  <div class="col-6">
                     <span><b>Usuário lanc:</b> <span id="campo10"></span></span>
                  </div>

                  <!--CAMPO USUÁRIO BAIXA-->
                  <div class="col-6">
                     <span><b>Usuário Baixa:</b> <span id="campo11"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>

               <div class="row">
                  <div class="col-6">
                     <span><b>Data Baixa:</b> <span id="campo19"></span></span>
                  </div>
                  <hr class="mt-2">
               </div>


         </div>
      </div>
   </div>
</div>


<!-- MODAL DE PARCELAMENTO-->
<div class="modal fade" id="modalParcelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Parcelar Conta</span> - <span id="descricao-parcelar"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="form-parcelar" method="post">
            <div class="modal-body">

               <div class="row">
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor-parcelar" id="valor-parcelar" readonly>
                     </div>
                  </div>

                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Parcelas</label>
                        <input type="number" class="form-control" name="qtd-parcelar" id="qtd-parcelar" required>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Frequência das Parcelas</label>
                        <select class="form-select" aria-label="Default select example" name="frequencia-parcelar" id="frequencia-parcelar">

                           <?php
                           $query = $pdo->query("SELECT * FROM frequencias order by id asc");
                           $res = $query->fetchAll(PDO::FETCH_ASSOC);
                           for ($i = 0; $i < @count($res); $i++) {
                              foreach ($res[$i] as $key => $value) {
                              }
                              $id_item = $res[$i]['id'];
                              $nome_item = $res[$i]['nome'];
                              //Elinando a opção de Uma Vez ou Única
                              if ($nome_item != 'Uma Vez' and $nome_item != 'Única') {

                           ?>
                                 <option <?php if ($nome_item == 'Mensal') { ?> selected <?php } ?> value="<?php echo $nome_item ?>"><?php echo $nome_item ?></option>

                           <?php }
                           } ?>


                        </select>
                     </div>
                  </div>
               </div>


               <small>
                  <div id="mensagem-parcelar" align="center"></div>
               </small>

               <input type="hidden" class="form-control" name="id-parcelar" id="id-parcelar">


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-parcelar">Fechar</button>
               <button type="submit" class="btn btn-primary">Parcelar</button>
            </div>
         </form>
      </div>
   </div>
</div>



<!-- MODAL BAIXAR -->
<div class="modal fade" id="modalBaixar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Baixar Conta</span> - <span id="descricao-baixar"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="form-baixar" method="post">
            <div class="modal-body">

               <div class="row">
                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Valor <small class="text-muted">(Total ou Parcial)</small></label>
                        <input onkeyup="totalizar()" type="text" class="form-control" name="valor-baixar" id="valor-baixar" required>
                     </div>
                  </div>


                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Local Saída</label>
                        <select class="form-select" aria-label="Default select example" name="saida-baixar" id="saida-baixar">
                           <option value="Caixa">Caixa (Movimento)</option>
                           <option value="Cartão de Débito">Cartão de Débito</option>
                           <option value="Cartão de Crédito">Cartão de Crédito</option>

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

               </div>


               <div class="row">
                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Desconto em R$</label>
                        <input onkeyup="totalizar()" type="text" class="form-control" name="valor-desconto" id="valor-desconto" placeholder="Ex 15.00" value="0">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Multa em R$</label>
                        <input onkeyup="totalizar()" type="text" class="form-control" name="valor-multa" id="valor-multa" placeholder="Ex 15.00" value="0">
                     </div>
                  </div>

               </div>


               <div class="row">
                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Juros em R$</label>
                        <input onkeyup="totalizar()" type="text" class="form-control" name="valor-juros" id="valor-juros" placeholder="Ex 0.15" value="0">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">SubTotal</label>
                        <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
                     </div>
                  </div>
               </div>




               <small>
                  <div id="mensagem-baixar" align="center"></div>
               </small>

               <input type="hidden" class="form-control" name="id-baixar" id="id-baixar">


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-baixar">Fechar</button>
               <button type="submit" class="btn btn-success">Baixar</button>
            </div>
         </form>
      </div>
   </div>
</div>


<!-- MODAL RESÍDUOS-->
<div class="modal fade" id="modalResiduos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Resíduos da Conta</span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <div class="modal-body">

            <small>
               <div id="listar-residuos"></div>
            </small>

         </div>

      </div>
   </div>
</div>





<script type="text/javascript">
   var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>


<script>
   //FUNÇÃO AOS DOCUMENTOS A SEREM CARREGADOS
   $(document).ready(function() {
      listarClientes();

      $('#data-inicial').change(function() {
         var dataInicial = $('#data-inicial').val();
         var dataFinal = $('#data-final').val();
         var status = $('#status-busca').val();
         var alterou_data = 'Sim';
         listarBusca(dataInicial, dataFinal, status, alterou_data);
      });

      $('#data-final').change(function() {
         var dataInicial = $('#data-inicial').val();
         var dataFinal = $('#data-final').val();
         var status = $('#status-busca').val();
         var alterou_data = 'Sim';
         listarBusca(dataInicial, dataFinal, status, alterou_data);
      });

      $('#status-busca').change(function() {
         var dataInicial = $('#data-inicial').val();
         var dataFinal = $('#data-final').val();
         var status = $('#status-busca').val();
         listarBusca(dataInicial, dataFinal, status);
      });
   });


   //LISTAR CLIENTES
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


   //LISTA DADOS DA DATA INICIAL
   function listarBusca(dataInicial, dataFinal, status, alterou_data) {
      $.ajax({
         url: pag + "/listar.php",
         method: "POST",
         data: {
            dataInicial,
            dataFinal,
            status,
            alterou_data
         },
         dataType: "html",

         success: function(result) {
            $("#listar").html(result);
         },
      });
   }


   function totalizar() {


      valor = $('#valor-baixar').val();
      desconto = $('#valor-desconto').val();
      juros = $('#valor-juros').val();
      multa = $('#valor-multa').val();



      valor = valor.replace(",", ".");
      desconto = desconto.replace(",", ".");
      juros = juros.replace(",", ".");
      multa = multa.replace(",", ".");

      subtotal = parseFloat(valor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);


      $('#subtotal').val(subtotal);

   }

   //LISTAR CONTAS VENCIDAS / HOJE / AMANHÃ


   function listarContasVencidas(vencidas) {
      $.ajax({
         url: pag + "/listar.php",
         method: 'POST',
         data: {
            vencidas
         },
         dataType: "html",

         success: function(result) {
            $("#listar").html(result);
         }
      });
   }


   function listarContasHoje(hoje) {
      $.ajax({
         url: pag + "/listar.php",
         method: 'POST',
         data: {
            hoje
         },
         dataType: "html",

         success: function(result) {
            $("#listar").html(result);
         }
      });
   }


   function listarContasAmanha(amanha) {
      $.ajax({
         url: pag + "/listar.php",
         method: 'POST',
         data: {
            amanha
         },
         dataType: "html",

         success: function(result) {
            $("#listar").html(result);
         }
      });
   }
</script>