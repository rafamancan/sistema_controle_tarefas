<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {

    function index() {
        $data['autenticado'] = "";
        $data['autenticado'] = $this->sistema->getAutenticado();
        $this->load->view('sistemas/login', $data);
    }

    function autenticacao() {
        $login = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        $usuario = $this->sistema->validaDados($login, $senha);

        if ($usuario) {
            $this->sistema->setAutenticado($usuario);

            echo $usuario['statusUsuario'];
        } else {
            echo 'erro';
        }
    }

    function logout() {
        $this->sistema->setAutenticado(NULL);
        redirect();
    }

    function painel() {
        $dados['usuario'] = $this->sistema->bloqueiaAcessoSeNaoAutenticado();

        $this->load->view('cabecalho', $dados);
        $this->load->view('sistemas/painel', $dados);
        $this->load->view('rodape');
    }

    function tipos(){
        $dados['usuario'] = $this->sistema->bloqueiaAcessoSeNaoAutenticado();
        $dados['tipos'] = $this->sistema->buscaTodosTipos();
        $this->load->view('cabecalho', $dados);
        $this->load->view('sistemas/tipos_tarefa_view', $dados);
        $this->load->view('rodape');
    }

    function insereTipo(){
       $tipos['tipoNome'] = $this->input->post('nome');
       $tipos['tipoCor'] = $this->input->post('cor');
       return $this->sistema->insereTipoTarefa($tipos);
    }

    function excluiTipo(){
       $tipos['PKTipo'] = $this->input->post('id');
       return $this->sistema->excluiTipoTarefa($tipos);
    }

    

    function nova(){
        $dados['usuario'] = $this->sistema->bloqueiaAcessoSeNaoAutenticado();
        $dados['tipos'] = $this->sistema->buscaTodosTipos();
        $this->load->view('cabecalho', $dados);
        $this->load->view('sistemas/nova_tarefa_view', $dados);
        $this->load->view('rodape');
    }

    function insereTarefa(){
       $tarefas['tarefaNome'] = $this->input->post('nome');
       $tarefas['tarefaFKTipo'] = $this->input->post('tipo');
       return $this->sistema->insereTarefa($tarefas);
    }

    function lista(){
        $dados['usuario'] = $this->sistema->bloqueiaAcessoSeNaoAutenticado();
        $dados['tarefas'] = $this->sistema->buscaTodasTarefas();
        $this->load->view('cabecalho', $dados);
        $this->load->view('sistemas/lista_tarefa_view', $dados);
        $this->load->view('rodape');
    }

    function concluiTarefa(){
       $tarefas['PKTarefas'] = $this->input->post('id');
       return $this->sistema->concluiTarefa($tarefas);
   }

}
