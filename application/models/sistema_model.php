<?php

class sistema_model extends CI_Model {

    function validaDados($usuario, $senha) {

        $this->db->select('usuarioLogin, usuarioSenha');
        $this->db->from('usuarios');
        $this->db->where('usuarioLogin', $usuario);
        $this->db->where('usuarioSenha', $senha);
        $usuario = $this->db->get()->row_array();
        $this->setAutenticado($usuario);
        return $usuario;
    }

    function bloqueiaAcessoSeNaoAutenticado() {
        $usuario = $this->getAutenticado();

        if ($usuario) {
            return $usuario;
        } else {
            redirect();
        }
    }

    function getAutenticado() {
        return $this->session->userdata('usuarioAutenticado');
    }

    function setAutenticado($usuario) {
        //limpa a sessao de autenticacao
        $this->session->unset_userdata('usuarioAutenticado');
        //seta novamente
        $this->session->set_userdata('usuarioAutenticado', $usuario);
    }

    function buscaTodosTipos(){
        return  $this->db->get('tipos')->result_array();
    }

    function insereTipoTarefa($tipos){
        $this->db->insert('tipos', $tipos);
        echo 'ok';
    }

    function excluiTipoTarefa($tipos){
        $this->db->delete('tipos',$tipos);
        echo 'ok';
    }

    function insereTarefa($tarefas){
        $this->db->insert('tarefas', $tarefas);
        echo 'ok';
    }

    function buscaTodasTarefas(){
        $this->db->from('tarefas');
        $this->db->join('tipos', 'tipos.PKTipo = tarefas.tarefaFKTipo');
        $this->db->order_by('tipos.tipoNome');
        return $this->db->get()->result_array();
    }

    function concluiTarefa($tarefa){
        $this->db->delete('tarefas',$tarefa);
        echo 'ok';
    }

    

}
