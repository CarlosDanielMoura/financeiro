function listarClientes() {
    var dados = $(this).serialize();
    $.ajax({
        url: `listar_os/ajaxBuscaCliente.php`,
        method: "POST",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            $.each(response, function (key, value) {
                //console.log(response);
                let objAtt = JSON.parse(value.obj)

                // Data de criação da os
                let dataCriacao = value.data_criacao
                let dataNova = dataCriacao.split('-').reverse().join('/')
                // Valor parcelas
                let parcelas = objAtt.produtos.qtde_parcelas;

                if (parcelas == "" || parcelas == 0) {


                    parcelas = 0;
                }


                // console.log(objAtt.dadosPrincipal);

                let html = `  <div class="cards-clientes orange">
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
                                        <div title="Status da OS"  class="label label-warning ${value.status == 'Cancelada' ? 'bg-danger' : ''} ">${value.status}</div>
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
                                        <div title="Previsão de entrega"> <i class="fa fa-clock-o"></i> ${objAtt.dadosPrincipal.data_entrega}  ${objAtt.dadosPrincipal.hora_entrega} </div>
                                    </div>
                                    
                                    <div class="col-3" style="display: flex; gap: 49px">
                                       
                                    </div>
                                    
                                </div>

                                <div class="row-3 mt-5">
                                    <!--Btns inicial-->
                                    <div class="col-6">
                                        <div class="">
                                            <!--Tirar comprovante OS-->
                                            <a  title="Gerar comprovante" href="" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="bi bi-receipt text-dark"></i>
                                                Comprovante
                                            </a>
                                            <!--Editar OS-->
                                            <a title="Editar ordem de serviço" href="../painel-adm/index.php?pag=editar_os&id=${value.id}" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="fa fa fa-edit"></i>
                                                Editar
                                            </a>
                                            <!--Converter em venda  OS-->
                                            <a title="Editar ordem de serviço" href="" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="fa fa fa-shopping-cart"></i>
                                                Vender
                                            </a>
                                            <!--Confirmar Entrega-->
                                            <a title="Confirma entrega da os" href="" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="bi bi-patch-check"></i>
                                                Confrmar OS
                                            </a>
                                        </div>
                                    </div>
                                    <!---Btns de CANCELAR PERDA / CANCELAR -->
                                    <div class="col-4">
                                        <div>
                                            <!--Tirar comprovante OS-->
                                            <a   title="Confirmar a perca da OS" href="#" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="bi bi-x-octagon"></i>
                                                Confimar Perda
                                            </a>
                                            <!--Editar OS-->
                                            <a onclick="excluir(${value.id})" data-toggle="modal" data-target="#exampleModal"  title="Cancelar OS" href="#" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                                <i class="bi bi-x-octagon"></i>
                                                Cancelar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                $('#view_clientes').append(html)

            })

        }
    });

}

$("#form-excluir-os").submit(function (event) {

    var formData = new FormData(this);
    $.ajax({
        url: "listar_os/excluir.php",
        type: "POST",
        data: formData,

        success: function (mensagem) {
            $("#mensagem-excluir").text("");
            $("#mensagem-excluir").removeClass();
            if (mensagem.trim() == "Excluído com Sucesso!") {
                $("#btn-fechar-excluir").click();
                listarClientes();

            } else {
                $("#mensagem-excluir").addClass("text-danger");
                $("#mensagem-excluir").text(mensagem);
            }
        },

        cache: false,
        contentType: false,
        processData: false,
    });
});