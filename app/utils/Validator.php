<?php

namespace App\Utils;

class Validator
{
    protected array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate(array $validations)
    {
        $violations = [];

        foreach($validations as $field => $rules) {
            
            $formattedField = ucfirst($field);

            foreach($rules as $rule) {
                if ($rule === 'required') {
                    if (!isset($this->request[$field]) || empty($this->request[$field]) || $this->request[$field] === "") {
                        $violations[$field][] = "$formattedField é obrigatório";
                    }
                }

                if ($rule === 'email') {
                    if(!filter_var($this->request[$field], FILTER_VALIDATE_EMAIL)) {
                        $violations[$field][] = "Endereço de e-mail inválido";
                   }
                }

                if (str_contains($rule, 'min')) {
                    $minValue = explode(":", $rule)[1];
                    if (strlen($this->request[$field]) < $minValue) {
                        $violations[$field][] = "$formattedField precisa ser de no mínimo $minValue caracteres";
                    }
                }

                if (str_contains($rule, 'max')) {
                    $maxValue = explode(":", $rule)[1];
                    if (strlen($this->request[$field]) > $maxValue) {
                        $violations[$field][] = "$formattedField precisa ser de no máximo $maxValue caracteres";
                    }
                }
            }
        }

        return $violations;
    }
}
