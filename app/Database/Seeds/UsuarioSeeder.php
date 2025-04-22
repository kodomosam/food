<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        
        $usuarioModel = new \App\Models\UsuarioModel;

        $usuario = [
            'nome' => 'Rodrigo Sampaio',
            'email' => 'admin@admin.com',
            'cpf' => '22331059829',
            'telefone' => '11-951491707',
        ];
        
        $usuarioModel->protect(false)->insert($usuario);

        $usuario = [
            'nome' => 'Renan Sampaio',
            'email' => 'renan@admin.com',
            'cpf' => '38223076888',
            'telefone' => '11-951499090',
        ];

        $usuarioModel->protect(false)->insert($usuario);

        dd($usuarioModel->errors());
    }
}
 