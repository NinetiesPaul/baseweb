<?php

namespace App\Controllers;

use App\Templates;
use PDO;

use App\DB\Storage\DataStorage;

class DataController
{
    protected $template;
    
    protected $dataStorage;

    public function __construct()
    {
        $this->template = new Templates();
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
        
        $template 	= $this->template->getTemplate('dados.html');
        $templateFinal = $this->template->parseTemplate($template, $args);
        echo $templateFinal;
    }
    
    public function verDado(int $idDado)
    {
        $dado = $this->dataStorage->verDado($idDado);
        
        $args = [
            'ID' => $dado->id,
            'DADO' => $dado->dado
        ];
        
        $template 	= $this->template->getTemplate('dado.html');
        $templateFinal = $this->template->parseTemplate($template, $args);
        echo $templateFinal;
    }
    
    public function inserirDado()
    {
        $data = json_decode(json_encode($_POST), true);
        
        $dado = $data['dado'];
        
        $this->dataStorage->inserirDado($dado);
        header('Location: /baseweb/dados');
    }
    
    public function alterarDado()
    {
        $data = json_decode(json_encode($_POST), true);
        
        $id = $data['id'];
        $dado = $data['dado'];
        
        $this->dataStorage->atualizarDado($id, $dado);
        header('Location: /baseweb/dados');
    }
    
    public function removerDado($idDado)
    {   
        $this->dataStorage->removerDado($idDado);
    }
}
