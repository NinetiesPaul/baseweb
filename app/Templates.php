<?php

namespace App;

class Templates
{
    public function __construct($path, $args = null)
    {
        $template 	= $this->getTemplate($path);

        if ($args) {
            $template = $this->parseTemplate($template, $args);
        }

        echo $template;
    }

    private function getTemplate($template, $folder = "templates/")
    {
        $arqTemp = $folder.$template; // criando var com caminho do arquivo
        $content = '';

        if (is_file($arqTemp)) { // verificando se o arq existe
            $content = file_get_contents($arqTemp);
        } // retornando conteúdo do arquivo

        return $content;
    }
    
    private function parseTemplate($template, $array)
    {
        foreach ($array as $a => $b) {
            if (strpos($a, 'list')) {
                $template = str_replace('{'.$a.'}', json_encode($b), $template);
            } else {
                $template = str_replace('{'.$a.'}', $b, $template);
            }
        }

        return $template;
    }
}
