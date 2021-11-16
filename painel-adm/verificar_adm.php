<?php

@session_start();

if (@$_SESSION['nivel_usuario'] != 'Administrador') { ?>

    <div class="row d-flex centralizar">
        <div class="col-md-9 col-sm-12">
            <div class="mb-3 ">
                <input type="text" class="form-control" name="usuario_adm" id="usuario_adm" placeholder="Usuário Administrador" required>
            </div>
        </div>
    </div>


    <div class="row d-flex centralizar">
        <!--CAMPO SENHA-->
        <div class="col-md-9 col-sm-12">
            <div class="mb-3">
                <input type="password" class="form-control" name="senha_adm" id="senha_adm" placeholder="Senha Administrador" required>
            </div>
        </div>
    </div>



<?php } ?>

<style>
    .centralizar {
        justify-content: center;
    }

    #usuario_adm {
        text-align: center;
    }

    #usuario_adm:hover {
        box-shadow: inset 0 0 0.3em #00DDEB;
    }

    #senha_adm {
        text-align: center;
    }

    #senha_adm:hover {
        box-shadow: inset 0 0 0.3em #00DDEB;
    }
</style>