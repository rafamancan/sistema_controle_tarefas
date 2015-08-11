<?php
if (isset($autenticado['chapa']) && $autenticado['chapa'] != "" && $autenticado['statusUsuario'] == 'Ativo') {
    redirect('sistema/painel');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal Controle de Tarefas</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="login-page">
        <div class="container-fluid">
            <div class="login-box">
                <div class="login-logo">
                    <a href="index.php"><b>Gerenciador de Tarefas</b><br/><h5>por Rafael Mançan</h5></a>
                </div>
                <div class="login-box-body" style="border: 1px solid #999999">
                    <p class="login-box-msg"><label>Identifique-se</label></p>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" id="usuario" placeholder="Login"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" id="senha" placeholder="Senha"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            &nbsp;
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-primary btn-block btn-flat acessar"><strong>Acessar</strong></button>
                            <br>
                        </div>
                    </div>
                    <a href="#" style="display: none !important;">Esqueci a senha</a><br>
                </div>
                <br/>
                <div class="alert alert-danger" role="alert" id="box_mensagem" style="display: none;"></div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#usuario').focus();

                $(".acessar").click(function () { // click
                    var usuario = $("#usuario").val();
                    var senha = $("#senha").val();

                    if (usuario === "" || senha === "") {
                        $("#box_mensagem").removeClass('alert-danger');//remove a classe danger
                        $("#box_mensagem").addClass('alert-warning');//add a classe warning
                        $("#box_mensagem").html("Preencha os campos acima.");//atribui valor a caixa
                        $("#box_mensagem").show("slow");//exibe lentamente a caixa
                        setTimeout(function () {
                            $("#box_mensagem").hide("slow");
                        }, 4000);

                    } else {
                        $.ajax({// inicio autenticacao
                            url: 'sistema/autenticacao',
                            type: 'POST',
                            async: false,
                            data: {
                                usuario: usuario,
                                senha: senha
                            },
                            success: function (data) {
                                if (data === "erro") {
                                    $("#box_mensagem").removeClass('alert-warning');
                                    $("#box_mensagem").addClass('alert-danger');
                                    $("#box_mensagem").show("slow");
                                    $("#box_mensagem").html("Usuário ou Senha incorretos.");
                                    setTimeout(function () {
                                        $("#box_mensagem").hide("slow");
                                    }, 4000);
                                } else {
                                    var novaURL = "sistema/painel";
                                    $(window.document.location).attr('href', novaURL);
                                }
                            }
                        }); // fim da autenticacao
                    }
                });// fim do click

                $(document).keypress(function (e) {
                    if (e.which === 13) {
                        $(".acessar").trigger("click");
                    }
                });
            });
        </script>
    </body>
</html>