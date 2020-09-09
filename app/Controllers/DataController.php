<?php

namespace App\Controllers;

use App\Templates;

use App\DB\Storage\DataStorage;

class DataController
{
    protected $dataStorage;

    public function __construct()
    {
        $this->dataStorage = new DataStorage();
    }
    
    public function verDados()
    {
        $dados = $this->dataStorage->verDados();
        
        $view = '';
        foreach ($dados as $dado) {
            $view .=
            "<tr id='row-$dado->id'><td>$dado->dado </td>
            <td><a href='dado/$dado->id' class='btn btn-info btn-sm btn-sm'><span class='glyphicon glyphicon-edit'></span> Editar</a> </td>
            <td><button class='btn btn-danger btn-sm' id='deletar' value='$dado->id'><span class='glyphicon glyphicon-remove'></span> Deletar</button></td></tr>";
        }
        
        $args = [
            'DADOS' => $view
        ];

        new Templates('dados.html', $args);
    }
    
    public function verDado($idDado)
    {
        $dado = $this->dataStorage->verDado($idDado);
        
        $args = [
            'ID' => $dado->id,
            'DADO' => $dado->dado
        ];


        new Templates('dados.html', $args);
    }
    
    public function inserirDado()
    {
        $data = json_decode(json_encode($_POST), true);
        
        $dado = $data['dado'];
        
        $this->dataStorage->inserirDado($dado);
        header('Location: /dados');
    }
    
    public function alterarDado()
    {
        $data = json_decode(json_encode($_POST), true);
        
        $id = $data['id'];
        $dado = $data['dado'];
        
        $this->dataStorage->atualizarDado($id, $dado);
        header('Location: /dados');
    }
    
    public function removerDado($idDado)
    {   
        $this->dataStorage->removerDado($idDado);
    }
}
