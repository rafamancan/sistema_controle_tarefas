<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->sistema->bloqueiaAcessoSeNaoAutenticado();

        $this->load->model('usuario_model', 'usuario');
    }

    function index() {
        $this->load->model('area_model', 'area');
        $this->load->model('cargo_model', 'cargo');

        $dados['lista_usuarios'] = $this->usuario->listaUsuarios();
        $dados['areas'] = $this->area->listaAreas();
        $dados['cargos'] = $this->cargo->listaCargos();

        $this->load->view('cabecalho');
        $this->load->view('usuarios/cadastro', $dados);
        $this->load->view('rodape');
    }

    function navegacao() {
        $modulo = $this->input->post('modulo');
        $submodulo = $this->input->post('submodulo');

        $this->session->set_userdata('modulo', $modulo);
        $this->session->set_userdata('submodulo', $submodulo);
    }

    function salvarCadastro() {
        $usuario['chapa'] = $this->input->post('chapa');
        $usuario['nomeUsuario'] = $this->input->post('nome');
        $usuario['emailUsuario'] = $this->input->post('email');
        $usuario['FKArea'] = $this->usuario->buscaIDarea($this->input->post('area'));
        $usuario['FKCargo'] = $this->usuario->buscaIDcargo($this->input->post('cargo'));
        $usuario['senhaUsuario'] = md5($this->input->post('senha'));

        $sucesso = $this->usuario->insereUsuario($usuario);

        if
        ($sucesso) {
            echo "Sucesso";
        } else {
            echo "Erro";
        }
    }

    function atualizaStatus() {


        $id = $this->input->post('id');

        $status = $this->input->post('status');

        $this->usuario->atualizaStatus($id, $status);
    }

    function editaCadastro() {

        $usuario['PKUsuario'] = $this->input->post('id');
        $usuario['chapa'] = $this->input->post('chapa');
        $usuario['nomeUsuario'] = $this->input->post('nome');
        $senha = $this->input->post('senha');
        if ($senha != "") {
            $usuario['senhaUsuario'] = md5($this->input->post('senha'));
        }

        $this->usuario->editaUsuario($usuario);
    }

    function excluirCadastro() {

        $id = $this->input->post('id');

        $this->usuario->excluiUsuario($id);
    }

    function buscaUsuario() {

        $textoBusca = $this->input->post('textoBusca');
        $achou = $dados ['lista_usuarios'] = $this->usuario->listaUsuariosLike($textoBusca);
        if ($achou && $textoBusca != '') {
            $this->load->view('usuarios/lista_usuario', $dados);
        } else {
            echo

            '<h3 class="text-center">Nenhuma informação foi encontrada...</h2>';
        }
    }

    /* PERFIL */

    function perfil() {
        $this->load->model('area_model', 'area');
        $this->load->model('cargo_model', 'cargo');
        $this->load->model('sistema_model', 'sistema');

        $dados['areas'] = $this->area->listaAreas();
        $dados['cargos'] = $this->cargo->listaCargos();
        $dados['usuario'] = $this->sistema->bloqueiaAcessoSeNaoAutenticado();

        $this->load->view('cabecalho');
        $this->load->view('usuarios/perfil', $dados);
        $this->load->view('rodape');
    }

    function editaPerfil() {
        //atualiza dados inciais
        $this->input->post('chapa');
        $this->input->post('nome');
        $this->input->post('email');

        //prepara um array para atualizar os dados iniciais do usuário
        $perfil = array(
            'chapa' => $this->input->post('chapa'),
            'nomeUsuario' => $this->input->post('nome'),
            'emailUsuario' => $this->input->post('email')
        );
        //atualiza os dados do usuário
        $this->usuario->atualizaPerfil($perfil);
        //atualiza a área se necessário
        if ($this->input->post('idArea') != '') {
            $perfil = array(
                'FKArea' => $this->input->post('idArea'),
                'chapa' => $this->input->post('chapa')
            );
            //atualiza area
            $this->usuario->atualizaPerfil($perfil);
        }
        if ($this->input->post('idCargo') != '') {
            $perfil = array(
                'FKCargo' => $this->input->post('idCargo'),
                'chapa' => $this->input->post('chapa')
            );
            //atualiza area
            $this->usuario->atualizaPerfil($perfil);
        }

        //atualiza senha se necessário
        if ($this->input->post('senha') != '') {
            $perfil = array(
                'senhaUsuario' => md5($this->input->post('senha')),
                'chapa' => $this->input->post('chapa')
            );
            $this->usuario->atualizaSenha($perfil);
        }

        //seta novos dados ao usuário
        $usuario = $this->usuario->atualizaDados($this->input->post('chapa'));
        if ($usuario) {
            $this->sistema->setAutenticado($usuario);
        }

        $this->session->set_flashdata('sucesso', 'Seu perfil foi atualizado com sucesso!');
    }

    /* foto do perfil */

    function carregaConfiguracaoUploadImagem() {
        $config['upload_path'] = APPPATH . 'public\perfil'; //caminho que vai salvar
        $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG'; //extensões permitidas
        $config['max_size'] = 0; //limite do tamanho do arquivo
        $config['overwrite'] = TRUE; //sobrescrever
        //remover os acentos do nome do arquivo
        $this->load->helper('funcoes');
        $this->load->library('session'); //starta sessao
        $chapa = $this->session->flashdata('chapa'); //busca chapa
        $ext = end((explode(".", $_FILES['userfile']['name'])));
        $config['file_name'] = $chapa . '.' . $ext;
        return $config;
    }

    function uploadFotoPerfil() {
        $config = $this->carregaConfiguracaoUploadImagem(); //carrega configuracao do upload
        $this->load->library('upload', $config); //carrega biblioteca para upload
        if (!$this->upload->do_upload()) {//se houver erro
            $this->session->set_flashdata('erro', $this->upload->display_errors());
            redirect('usuario/perfil');
        } else {//se não houver erro
            $this->session->set_flashdata('sucesso', 'Sua foto do perfil foi adicionada com sucesso!');

            //atualiza registro no banco de dados com o nome da foto
            $perfil = array(
                'fotoUsuario' => $config['file_name'],
                'chapa' => $this->session->flashdata('chapa')
            );
            $this->usuario->atualizaFotoPerfil($perfil);

            //atualiza dados do usuário
            $usuario = $this->usuario->atualizaDados($this->session->flashdata('chapa'));
            if ($usuario) {
                $this->sistema->setAutenticado($usuario);
            }
            redirect('usuario/perfil');
        }
    }

    function excluiFotoPerfil() {
        $default = 'usuario_padrao.png';
        $perfil = array(
            'fotoUsuario' => $default,
            'chapa' => $this->input->post('chapa')
        );
        $this->usuario->atualizaFotoPerfil($perfil);

        //atualiza dados do usuário
        $usuario = $this->usuario->atualizaDados($this->input->post('chapa'));
        if ($usuario) {
            $this->sistema->setAutenticado($usuario);
        }
        redirect('usuario/perfil');
    }

    /* PERFIL DE ACESSO DO SISTEMA */

    function perfilAcesso($idUsuario) {
        // DEVE FILTRAR QUEM PODE ACESSAR ISTO AQ!!!
        $this->load->model('area_model', 'area');

        $dados['areas'] = $this->area->listaAreas();
        $dados['perfilAcesso'] = $this->usuario->listaPerfilAcesso($idUsuario);
        $dados['usuario'] = $this->usuario->buscaUsuarioPor($idUsuario);

        $this->load->view('cabecalho');
        $this->load->view('usuarios/perfil_acesso', $dados);
        $this->load->view('rodape');
    }

    function cadastraPerfilAcesso() {
        $idUsuario = $this->input->post('idUsuario');
        $idsAreas = $this->input->post('idsAreas');
        $dataCriacao = date('Y-m-d h:i:s');
        $usuario = $this->sistema->getAutenticado();
        $criadoPor = '(' . $usuario['chapa'] . ') ' . $usuario['nomeUsuario'];

        $sucesso = false;

        foreach ($idsAreas as $idArea) {
            $perfilAcesso['FKArea'] = $idArea;
            $perfilAcesso['FKUsuario'] = $idUsuario;
            $perfilAcesso['criadoPor'] = $criadoPor;
            $perfilAcesso['dataCriacao'] = $dataCriacao;

            $sucesso = $this->usuario->insereAreaPerfilAcesso($perfilAcesso);

            if (!$sucesso) {
                break;
            }
        }

        echo $sucesso;
    }

}
