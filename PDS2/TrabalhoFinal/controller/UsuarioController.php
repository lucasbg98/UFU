<?php

require_once("../service/UsuarioService.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (array_key_exists("getByEmail", $_GET)) {
        $user = UsuarioService::getByEmail(($_GET["getByEmail"]));

        if (!isset($user)) {
            return http_response_code(404);
        }

        echo json_encode($user->toDataContract(), JSON_UNESCAPED_UNICODE);
        return;
    }

    if (array_key_exists("destroySession", $_GET)) {
        session_start();
        session_destroy();
    }

    if (array_key_exists("getUserId", $_GET)) {
        session_start();

        echo $_SESSION["user_id"] ?? False;
    }

    if (array_key_exists("getUserName", $_GET)) {
        session_start();

        echo $_SESSION["username"] ?? False;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (array_key_exists("login", $_POST)) {
        $email = filter_input(INPUT_POST, "user_email", FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, "user_password", FILTER_SANITIZE_STRING);

        if ($email && $senha) {
            $user = UsuarioService::loginUser(array("login", $email, $senha));

            if ($user == NULL) {
                //usuário não encontrado
                $res["res"] = FALSE;
                $res["msg"] = "Usuário não encontrado!";
                echo json_encode($res);
            } else {
                //usuário encontrado
                session_start();

                $_SESSION["user_id"] = $user->getId();
                $_SESSION["user_nome"] = $user->getNome();

                $res["res"] = "loginOk";
                $res["msg"] = "Usuário encontrado!";
                echo json_encode($res);
            }
        } else {
            $res["res"] = FALSE;
            $res["msg"] = "Campos com valores incorretos!";
            echo json_encode($res);
        }
    }
}
