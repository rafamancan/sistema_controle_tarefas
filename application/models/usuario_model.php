<?php

class usuario_model extends CI_Model {

    function atualizaDados($usuario) {
        $this->db->select('nomeUsuario, chapa, PKUsuario, emailUsuario, statusUsuario, ramificacaoDescricao, cargo,fotoUsuario');
        $this->db->from('usuarios');
        $this->db->join('cargos', 'usuarios.FKCargo = cargos.PKCargo', 'left');
        $this->db->join('areas', 'usuarios.FKArea = areas.PKArea', 'left');
        $this->db->where('chapa', $usuario);
        $usuario = $this->db->get()->row_array();

        if ($usuario) {
            $usuario['descricaoCargo'] = $usuario['ramificacaoDescricao'] . ' - ' . $usuario['cargo'];
        }

        return $usuario;
    }

    /* PERFIL */

    function atualizaPerfil($dados) {
        $this->db->where('chapa', $dados['chapa']);
        $this->db->update('usuarios', $dados);
    }

    function atualizaSenha($dados) {
        $this->db->where('chapa', $dados['chapa']);
        $this->db->update('usuarios', $dados);
    }

    function atualizaFotoPerfil($dados) {
        $this->db->where('chapa', $dados['chapa']);
        $this->db->update('usuarios', $dados);
    }

    function listaAreas() {
        return $this->db->get('areas')->result_array();
    }

    function buscaIDarea($areanome) {
        $area = explode(" - ", $areanome);

        $this->db->select('PKArea');
        $this->db->from('areas');
        $this->db->where('ramificacaoDescricao', $area[0]);
        $this->db->where('descricaoArea', $area[1]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->PKArea;
            }
        }
    }

    function buscaIDcargo($cargonome) {
        $this->db->select('PKCargo');
        $this->db->from('cargos');
        $this->db->where('cargo', $cargonome);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->PKCargo;
            }
        }
    }

    function listaUsuarios() {
        $this->db->select('PKUsuario, chapa, nomeUsuario, statusUsuario, cargo');
        $this->db->from('usuarios');
        $this->db->join('cargos', 'PKCargo = FKCargo');
        $this->db->order_by('nomeUsuario ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function listaUsuariosLike($textoBusca) {
        $this->db->select('PKUsuario, chapa, nomeUsuario, statusUsuario');
        $this->db->from('usuarios');
        $this->db->like('chapa', $textoBusca);
        $this->db->or_like('nomeUsuario', $textoBusca);
        $this->db->order_by('nomeUsuario ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function insereUsuario($usuario) {
        return $this->db->insert('usuarios', $usuario);
    }

    function atualizaStatus($id, $status) {
        $usuario['statusUsuario'] = $status;

        $this->db->where('PKUsuario', $id);
        $sucesso = $this->db->update('usuarios', $usuario);

        return $sucesso;
    }

    function editaUsuario($usuario) {
        $this->db->where('PKUsuario', $usuario['PKUsuario']);
        $this->db->update('usuarios', $usuario);
    }

    function excluiUsuario($id) {
        $this->db->where('PKUsuario', $id);
        $this->db->delete('usuarios');
    }

    function buscaUsuarioPor($PKUsuario) {
        $this->db->where('PKUsuario', $PKUsuario);
        return $this->db->get('Usuarios')->row_array();
    }

    /* PERFIL ACESSO */

    function listaPerfilAcesso($FKUsuario) {
        $this->db->where('FKUsuario', $FKUsuario);
        return $this->db->get('PerfilAcesso')->result_array();
    }

    function insereAreaPerfilAcesso($perfilAcesso) {
        return $this->db->insert('PerfilAcesso', $perfilAcesso);
    }

}
