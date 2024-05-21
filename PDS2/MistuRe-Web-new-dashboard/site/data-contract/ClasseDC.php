<?php

require_once(__DIR__."/../model/Classe.php");

class ClasseDC {
    public $descricao;
    public $cor;

    public function __construct(Classe $classe) {
        $this->descricao = $classe->getDescricao();
        $this->cor = $classe->getCor();
    }
}