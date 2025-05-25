<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';    
    protected $allowedFields    = ['nome','email','cpf','telefone','is_admin','ativo','password_hash','ativacao_hash','reset_hash','reset_expira_em','criado_em','atualizado_em','deletado_em'];
    protected $useSoftDeletes   = true;
    protected $useTimestamps = true; 
    protected $createdField = 'criado_em';
    protected $updateField = 'atualizado_em';
    protected $deletedField = 'deletado_em';
    
    protected $validationRules = [
        'nome'     => 'required|min_length[4]|max_length[120]|',
        'email'        => 'required|valid_email|is_unique[usuarios.email]',
        'cpf'        => 'required|exact_length[14]|is_unique[usuarios.cpf]',
        'password'     => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'Esse campo é obrigatório.',
        ],
        'email' => [
            'required' => 'Esse campo é obrigatório.',
            'is_unique' => 'Desculpe. o e-mail já existe.',
        ],
        'cpf' => [
            'required' => 'Esse campo é obrigatório.',
            'is_unique' => 'Desculpe. o CPF já existe.',
        ],
    ];


    public function procurar($term){
        if($term === null){
            return [];
        }

        return $this->select('id, nome')
                        ->like('nome', $term)
                        ->get()
                        ->getResult();
    }

    public function desabilitaValidacaoSenha(){

        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);  

    }

}
