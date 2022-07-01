$(document).ready(function () {
    listarClientes();
});
  

function listarClientes() {
    $('#view_clientes').empty();
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
                let dataEntrega = objAtt.dadosPrincipal.data_entrega.split('-').reverse().join('/')
                // Valor parcelas
                let parcelas = objAtt.produtos.qtde_parcelas;

                if (parcelas == "" || parcelas == 0) {


                    parcelas = 0;
                }



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

function listarConfirmadas() {
    $('#view_clientes').empty();
    $.ajax({
        url: `listar_os/listarConfirmada.php`,
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
                let dataEntrega = objAtt.dadosPrincipal.data_entrega.split('-').reverse().join('/')
                // Valor parcelas
                let parcelas = objAtt.produtos.qtde_parcelas;

                if (parcelas == "" || parcelas == 0) {


                    parcelas = 0;
                }



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

function listarTodas() {
    $('#view_clientes').empty();
    $.ajax({
        url: `listar_os/listarTodas.php`,
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
                let dataEntrega = objAtt.dadosPrincipal.data_entrega.split('-').reverse().join('/')
                // Valor parcelas
                let parcelas = objAtt.produtos.qtde_parcelas;

                if (parcelas == "" || parcelas == 0) {


                    parcelas = 0;
                }



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


function listarCanceladas(event) {
    $('#view_clientes').empty();
    $.ajax({
        url: `listar_os/listarCanceladas.php`,
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
                let dataEntrega = objAtt.dadosPrincipal.data_entrega.split('-').reverse().join('/')
                // Valor parcelas
                let parcelas = objAtt.produtos.qtde_parcelas;

                if (parcelas == "" || parcelas == 0) {


                    parcelas = 0;
                }



                // console.log(objAtt.dadosPrincipal);

                let html = `  <div class="cards-clientes orange " id="canceladas">
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
                                            <a title="Confirmação de OS" href="" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                            <i class="bi bi-check-square text-primary"></i>
                                                Confirmar OS
                                            </a>
                                        </div>
                                    </div>
                                    <!---Btns de CANCELAR PERDA / CANCELAR -->
                                    <div class="col-4">
                                        <div>
                                            <!--Confirmar a perca da OS-->
                                            <a onclick="excluirOrdemServiço(${value.id})"  data-toggle="modal" data-target="#exampleModal"  title="Cancelar OS" href="#" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
                                            <i class="bi bi-trash text-danger"></i>
                                                Excluir
                                            </a>
                                            <!--Cancelar OS-->
                                            <a   title="Excluir OS" href="#" onclick="excluir(${value.id})" class="btn-comprovante btn ${value.status == 'Cancelada' ? 'd-none' : ''}">
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


$("#form-excluir-ordem").submit(function (event) {

    var formData = new FormData(this);
    $.ajax({
        url: "listar_os/excluir-ordem.php",
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

$("#form-confirmar-os").submit(function (event) {

    var formData = new FormData(this);
    $.ajax({
        url: "listar_os/confirmaOs.php",
        type: "POST",
        data: formData,

        success: function (mensagem) {
            $("#mensagem-excluir").text("");
            $("#mensagem-excluir").removeClass();
            if (mensagem.trim() == "Confirmado com Sucesso!") {
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