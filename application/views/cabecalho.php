<!DOCTYPE html>
<html>
    <head>
        <title>Controle de Tarefas</title>

        <!-- CSS do Sistema -->
        <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- dataTables -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <!-- Ionicons -->
        <link href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme style AdminLTE-->
        <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

        <!-- SKIN AdminLTE-->
        <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />



        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery.js"></script>

        <!-- autocomplete -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-ui.css">
        <script src="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-ui.js"></script>
        <!-- fim autocomplete -->

        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- dataTables -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>

        <!-- SKIN AdminLTE-->
        <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
        
        <link href="<?php echo base_url(); ?>assets/css/colorpicker.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>assets/js/colorpicker.js"></script>


    </head>

    <body class="skin-blue">
   

        <div class="wrapper">
            <header class="main-header">
                <a href="<?php echo base_url(); ?>sistema/painel" class="inicio logo"><b>Controle</b> de Tarefas</a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                    <span class="hidden-xs">
                                        <?php echo $usuario['usuarioLogin']; ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <p>
                                            <?php echo $usuario['usuarioLogin'] ?>
                                            <small>Perfil do usuário</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                       
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>sistema/logout" class="btn btn-default btn-flat" >Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--PAINEL ESQUERDA-->
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                           
                        </div>
                        <div class="pull-left info">
                            <p>
                                <?php echo $usuario['usuarioLogin']; ?>
                            </p>
                            <a href="#" id="status"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <ul class="sidebar-menu">
                        <li class="header">Painel de Navegação</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-tasks"></i>
                                <span>Administrativo</span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url(); ?>sistema/tipos/"><i class="fa fa-object-group"></i> Tipos de Tarefa</a></li>
                                <li><a href="<?php echo base_url(); ?>sistema/nova/"><i class="fa fa-plus"></i> Nova Tarefa</a></li>
                                <li><a href="<?php echo base_url(); ?>sistema/lista/"><i class="fa fa-list-ul"></i> Lista de Tarefas</a></li>
                            </ul>
                        </li>

                    </ul>
                </section>
            </aside>
            <div class="content-wrapper" style="min-height: 1000px;">