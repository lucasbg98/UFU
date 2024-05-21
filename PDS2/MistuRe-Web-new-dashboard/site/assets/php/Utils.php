<?php

class Utils {

    public function __construct()
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            // we are only interested in 'undefined index/offset' errors
            if (strpos($errstr, 'Undefined index') !== false) {
                throw new OutOfRangeException($errstr, 0);
            }
            return true; // error bublling to PHP's default handler
        });
    }

    public function __destruct()
    {
      // very important, restore the default error handler whe finish
      restore_error_handler();
    }

    // public function getReferenciaFromPost (Usuario $usuario_logado, array $post) {
    //     try {
    //         //Imports necessários
    //         require_once(__DIR__."/Status.php");
    //         require_once(__DIR__."/Permissoes.php");
    //         require_once(__DIR__."/../../model/Referencia.php");
            
    //         //Pegando valores do form para cadastrar o objeto "referencia"
    //         $titulo = $post["titulo"];
    //         $link = $post["link"];
    //         $pais = $post["pais"];
    //         $resultado = $post["resultado"];
    //         $comentario = isset($post["comentario"]) && $post["comentario"] != "" ? $post["comentario"] : NULL ; //tratamento caso o usuário não informe comentário
    //         $doi = $post["doi"];
    //         $data_cadastro = date("Y-m-d H:i:s");
    //         $data_avaliacao = NULL;
    //         $status = Status::Referencia_Status_Pendente;
    //         $cultura_id = (int)$post["cultura_id"];
    //         $avaliador_id = NULL;
    //         $pesquisador_id = (int)$usuario_logado->getId();
            
    //         //Verificando se usuário tem permissão de avaliar misturas para ja cadastrar a nova mistura com status de "avaliada"
    //         if($usuario_logado->verificarPermissao(Permissoes::Avaliar_Referencias)) {
    //             $status = Status::Referencia_Status_Aprovada;
    //             $data_avaliacao = $data_cadastro;
    //             $avaliador_id = $pesquisador_id;
    //         }

    //         return Referencia::criarSaveObject( array($titulo, $link, $pais, $resultado, $comentario, $doi, $data_cadastro, $data_avaliacao, $status, $cultura_id, $pesquisador_id, $avaliador_id));

    //     } catch (OutOfRangeException  $e) {
    //         return Status::Wrong_Parameters;
    //     }
    // }

    // public function getReferenciaSubstanciaFromPost ( array $post ) {
    //     try {
    //         $dosagem = isset($post["sub_dos"]) && $post["sub_dos"] != "" ? $post["sub_dos"] : null ; 
    //         $unidade_dosagem = isset($post["sub_und"]) && $post["sub_und"] != "" ? $post["sub_und"] : null ; 
    //         $referencia_id = $post["referencia_id"];
    //         $substancia_id = $post["sub_id"];
    //         $nome_comercial_id = isset($post["nc_id"]) && $post["nc_id"] != "" ? $post["nc_id"] : null ; 

    //         return (new ReferenciaSubstancia())->criarSaveObject(array($dosagem, $unidade_dosagem, $referencia_id, $substancia_id, $nome_comercial_id));

    //     } catch (Exception $e) {
    //         return Status::Wrong_Parameters;
    //     }
    // }

    public function getLoggedUser() {
        require_once (__DIR__ ."../../../dao/UsuarioDAO.php");

        session_start();
        if(!isset($_SESSION["user_id"])) {
            echo '<script>
                window.location.href="../view/login.html?noUser=1";
            </script>';
            return false;
        }
        return UsuarioDAO::read(array("user_id", $_SESSION["user_id"]));
    }
}