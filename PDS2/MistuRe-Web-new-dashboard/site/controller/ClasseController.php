<?php

//Imports necessários

//Model
require_once(__DIR__."/../model/Classe.php");

//DAO
require_once(__DIR__."/../dao/ClasseDAO.php");

//Outros
require_once(__DIR__."/../assets/php/Status.php");
require_once(__DIR__."/../assets/php/Utils.php");

(new Utils())->getLoggedUser();

if( $_SERVER["REQUEST_METHOD"]  === 'GET') {
    if(array_key_exists("fetchAll", $_GET)) {
        $classes = ClasseDAO::read(array("fetchAll"));

        if($classes) {
            $classes_json = Classe::jsonSerializeList($classes);

            if($classes_json) {
                echo json_encode($classes_json, JSON_UNESCAPED_UNICODE);
            }
            else {
                echo "Erro";
            }
        }
    }
}
else if( $_SERVER["REQUEST_METHOD"]  === 'POST') {

    //Imports necessários

    //Model
    require_once(__DIR__."/../model/Classe.php");

    //DAO
    require_once(__DIR__."/../dao/ClasseDAO.php");

    try {
        
        //Pegando parametros do post
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
        $cor = filter_input(INPUT_POST, "cor", FILTER_SANITIZE_STRING);

        //verificando se os mesmos estão ok
        if($descricao && $cor) {
            //criando objeto classe
            $classe = new Classe();
            $classe->setDescricao($descricao);
            $classe->setCor($cor);

            //Chamando método que salva a nova classe e retorna o id da mesma caso tudo ocorra como o esperado
            $id_nova_classe = ClasseDAO::create(array($classe));

            if($id_nova_classe) {
                $res["retorno"] = Status::Cadastro_Sucesso;
                $res["novo_id"] = $id_nova_classe;
            }
            else {
                $res["retorno"] = -1;
            }
        }
        else {
            //Parametros errados
            $res["retorno"] = Status::Wrong_Parameters;
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    finally {
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

}