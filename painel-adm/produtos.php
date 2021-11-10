<?php

require_once("../conexao.php");
require_once("verificar.php");

//Variveis do inputs
$pagina = 'produtos';

@session_start();

@$_SESSION['estoque'] = @$_GET['estoque'];
require_once($pagina . "/campos.php");


?>





<!--Css-->
<link rel="stylesheet" href="../css/icones.css">



<div class="col-md-12 my-4">
	<a href="#" onclick="inserir()" class="buttonNivel btn sm" type="button">Novo Produto</a>
</div>

<div class="row iconesSquare">
	<div class="col-md-3 mb-3">
		<i class="bi bi-square-fill text-success"> <strong> <small> Produto com estoque em dia.</small> </strong> </i>
	</div>

	<div class="col-md-3">
		<i class="bi bi-square-fill text-danger"> <strong> <small> Produto com estoque baixo.</small></strong></i>
	</div>
</div>



<small>
	<div class="tableDados" id="listar">
	</div>
</small>


<!--Modal Produto-->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form" method="post">
				<div class="modal-body">

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Dados Produto</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contas" type="button" role="tab" aria-controls="profile" aria-selected="false">Foto do Produto</a>
						</li>

					</ul>

					<hr>

					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

							<div class="row">
								<div class="col-md-4 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo1 ?></label>
										<input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="<?php echo $campo1 ?>" id="<?php echo $campo1 ?>" required>
									</div>
								</div>

								<div class="col-md-4 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo2 ?></label>
										<input type="text" class="form-control" name="<?php echo $campo2 ?>" placeholder="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>" required>
									</div>
								</div>

								<div class="col-md-4 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label">Valor Venda</label>
										<input type="text" class="form-control" name="<?php echo $campo6 ?>" id="<?php echo $campo6 ?>" placeholder="Valor Venda" required>
									</div>
								</div>


							</div>



							<div class="row">

								<div class="col-md-7 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
										<textarea class="form-control" rows="3" name="<?php echo $campo3 ?>" id="<?php echo $campo3 ?>" placeholder="Descrição do seu produto"></textarea>
									</div>
								</div>


								<div class="col-md-3 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo8 ?></label>
										<select class="form-select" aria-label="Default select example" name="<?php echo $campo8 ?>" id="<?php echo $campo8 ?>">
											<?php
											$query = $pdo->query("SELECT * FROM cat_produtos order by nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for ($i = 0; $i < @count($res); $i++) {
												foreach ($res[$i] as $key => $value) {
												}
												$id_item = $res[$i]['id'];
												$nome_item = $res[$i]['nome'];
											?>
												<option value="<?php echo $id_item ?>"><?php echo $nome_item ?></option>

											<?php } ?>


										</select>
									</div>
								</div>


								<div class="col-md-2 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo10 ?></label>
										<select class="form-select" aria-label="Default select example" name="<?php echo $campo10 ?>" id="<?php echo $campo10 ?>">
											<option value="Sim">Sim</option>
											<option value="Não">Não</option>

										</select>
									</div>
								</div>

							</div>


						</div>

						<div class="tab-pane fade" id="contas" role="tabpanel" aria-labelledby="profile-tab">

							<!--CAMPO DA FOTO-->
							<div class="mb-3">
								<strong><label>Escolha uma <?php echo $campo9 ?>:</label></strong>
							</div>
							<div class="mb-3">

								<input class="form-control-file" type="file" id="<?php echo $campo9 ?>" name="imagem" id="<?php echo $campo9 ?>" onChange="carregarImg();">
							</div>

							<div id="divImg" class="mt-4">
								<img src="../img/sem-foto.jpg" width="250px" id="target">
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

					Deseja Realmente excluir este Produto: <span id="nome-excluido"></span>?

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





<!--Modal Ver Dados Pordutos-->

<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Dados do Cliente</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="justify-content: center;">
				<small>
					<div class="row " style="justify-content: space-around;">
						<div class="col-md-12 col-sm-12">
							<span><b><?php echo $campo1 ?>:</b> <span id="campo1"></span></span>
							<span class="mx-4"><b><?php echo $campo2 ?>:</b> <span id="campo2"></span></span>
							<span><b><?php echo $campo4 ?>:</b> <span id="campo4"></span>
						</div>

					</div>



					<hr style="margin:6px;">


					<span class=""><b>Valor do Produto: R$</b> <span id="campo6"></span></span>
					<span class="mx-2">
						<b><?php echo $campo7 ?>:
						</b>
						<span id="campo7">

						</span>
					</span>
					<hr style="margin:6px;">
					<div align="center">
						<strong>
							<p>Imagem do produto:</p>
						</strong>
						<img src="" id="imagem_dados" alt="Sem foto" width="70%">
					</div>
					<hr>
					<span class="mx-3"><b><?php echo $campo3 ?>: </b><span id="campo3"></span></span>

				</small>

			</div>
		</div>
	</div>
</div>


<!--Modal Comprar PRODUTO-->


<div class="modal fade" id="modalComp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Comprar Produto: <span id="nome-comprar"></span> </span></h5>
				<button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-comprar" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Quantidade</label>
								<input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Quantidade à comprar" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Compra</label>
								<input type="text" class="form-control" name="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>" placeholder="Valor da Compra" required>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">% de Lucro (Opcional)</label>
								<input type="number" class="form-control" name="<?php echo $campo11 ?>" id="<?php echo $campo11 ?>" placeholder="Ex 50 em caso de 50%">
							</div>
						</div>

						<div class="col-md-6">

							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label"><?php echo $campo7 ?></label>
								<select class="form-select" aria-label="Default select example" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>">
									<?php
									$query = $pdo->query("SELECT * FROM fornecedores order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for ($i = 0; $i < @count($res); $i++) {
										foreach ($res[$i] as $key => $value) {
										}
										$id_item = $res[$i]['id'];
										$nome_item = $res[$i]['nome'];
									?>
										<option value="<?php echo $id_item ?>"><?php echo $nome_item ?></option>

									<?php } ?>


								</select>
							</div>
						</div>
					</div>

					<small>
						<div id="mensagem-comprar" align="center"></div>
					</small>

					<input type="hidden" class="form-control" name="id-comprar" id="id-comprar">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-comprar">Fechar</button>
					<button type="submit" class="btn btn-success">Comprar</button>
				</div>
			</form>
		</div>
	</div>
</div>





<script type="text/javascript">
	var pag = "<?= $pagina ?>"
</script>
<script src="../js/ajax.js"></script>

<script type="text/javascript">
	// Ajax de excluir
	$("#form-comprar").submit(function(event) {
		event.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: pag + "/comprar.php",
			type: "POST",
			data: formData,

			success: function(mensagem) {
				$("#mensagem-comprar").text("");
				$("#mensagem-comprar").removeClass();
				if (mensagem.trim() == "Comprado com Sucesso!") {
					$("#btn-fechar-comprar").click();
					listar();
				} else {
					$("#mensagem-comprar").addClass("text-danger");
					$("#mensagem-comprar").text(mensagem);
				}
			},

			cache: false,
			contentType: false,
			processData: false,
		});
	});
</script>