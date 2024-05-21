<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if(array_key_exists("findByLink", $_GET)) {
        require_once (__DIR__ . "../../dao/ReferenciaDAO.php");
        require_once (__DIR__ . "../../data-contract/ReferenciaDC.php");

        $link = $_GET["findByLink"];
        $referencia = ReferenciaDAO::read(array("findByLink", $link));
        
        if($referencia)
            echo json_encode(new ReferenciaDC($referencia));
        else 
            echo json_encode(array("error" => true));
    }

    // if(array_key_exists("firstOnes", $_GET)) {
    //     require_once (__DIR__ ."/../dao/ReferenciaDAO.php");
    //     require_once (__DIR__ ."/../data-contract/ReferenciaDC.php");

    //     $quantidade_pendentes = $_GET["firstOnes"];
    //     $referencias_pendentes = ReferenciaDAO::read(
    //         array("status", Referencia::converterStringParaStatus("pendente"), "referencia.data_cadastro ASC", $quantidade_pendentes)
    //     );

    //     $quantidade_aprovadas = isset($referencias_pendentes) ? $quantidade_pendentes - sizeof($referencias_pendentes) : $quantidade_pendentes;
    //     $referencias_aprovadas = ReferenciaDAO::read(
    //         array("status", Referencia::converterStringParaStatus("aprovada"), "referencia.data_avaliacao DESC", $quantidade_aprovadas)
    //     );

    //     if(empty($referencias_pendentes) && empty($referencias_aprovadas))
    //         echo "{}";
    //     else {
    //         $referencias_pendentes = !isset($referencias_pendentes) ? array() : $referencias_pendentes;
    //         $referencias_aprovadas = !isset($referencias_aprovadas) ? array() : $referencias_aprovadas;

    //         $referencias = array_merge($referencias_pendentes, $referencias_aprovadas);

    //         $referencias_dc = array();

    //         foreach ($referencias as $key => $ref) {
    //             $nova_ref_dc = new ReferenciaDC($ref);
    //             array_push($referencias_dc, $nova_ref_dc);
    //         }

    //         echo json_encode($referencias_dc);
    //     }
    // }

    if(array_key_exists("findById", $_GET)) {
        require_once (__DIR__ ."/../dao/ReferenciaDAO.php");
        require_once (__DIR__ ."/../data-contract/ReferenciaCompletaDC.php");

        $ref_id = $_GET["findById"];

        $referencia = ReferenciaDAO::read(array("findById",$ref_id));
        echo json_encode( new ReferenciaCompletaDC($referencia) );
    }
}
// else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         //resposta
//         $res = array();

//         //- Model
//         require_once(__DIR__."/../model/Referencia.php");
//         require_once(__DIR__."/../model/Usuario.php");
//         require_once(__DIR__."/../model/ReferenciaSubstancia.php");
        
//         //- DAO
//         require_once(__DIR__."/../dao/UsuarioDAO.php");
//         require_once(__DIR__."/../dao/ReferenciaDAO.php");
//         require_once(__DIR__."/../dao/ReferenciaSubstanciaDAO.php");
        
//         //- Assets
//         require_once(__DIR__."/../assets/php/Utils.php");

//         //Pegando usuário logado
//         $usuario_logado = UsuarioDAO::read( array("user_id", $_SESSION["user_id"]) );

//         //Criando objeto utils para pegar parametros vindos do post
//         $utils = new Utils();

//         //Criando objeto Referência para salvá-lo no banco
//         $referencia = $utils->getReferenciaFromPost($usuario_logado, $_POST);
//         //Tratamento em caso de falha ao criar objeto referencia
//         if($referencia == Status::Wrong_Parameters) {
//             $res ["error"] = "Formulário preenchido incorretamente!";
//             return $res;
//         }

//         $id_nova_referencia = (new ReferenciaDAO())->create(array($referencia));
//         if($id_nova_referencia == Status::Cadastro_Erro_No_Banco_De_Dados) {
//             //Erro ao cadastrar no banco
//             $res["error"] = "Aconteceu algum erro inesperado ao salvar a nova referência";
//             return $res;
//         }

//         $substancias = json_decode(json_encode($_POST["substancias_selecionadas"]), True); //Pegando array
//         foreach ($substancias as $key => $sub) {
//             $sub["referencia_id"] = $id_nova_referencia; //atribuindo o id da referencia que foi salva
//             $rs_aux = $utils->getReferenciaSubstanciaFromPost ( $sub );
//             (new ReferenciaSubstanciaDAO())->create(array($rs_aux));
//         }

//         $res["retorno"] = true;
        
//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
//     finally {
//         echo json_encode($res);
//     }
// }