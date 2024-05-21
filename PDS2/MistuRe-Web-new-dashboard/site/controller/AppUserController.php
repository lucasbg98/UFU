<?php

require_once(__DIR__ . "/../service/AppUserService.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] === "GET") {

  if (array_key_exists("getByEmail", $_GET)) {
    $user = AppUserService::getByEmail(($_GET["getByEmail"]));

    if (!isset($user)) {
      return http_response_code(404);
    }

    echo json_encode($user->toDataContract(), JSON_UNESCAPED_UNICODE);
    return;
  }

  if (array_key_exists("getLocations", $_GET)) {
    $ufsAndCities = AppUserService::getUfsAndCities();

    echo json_encode($ufsAndCities, JSON_UNESCAPED_UNICODE);
    return;
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!isset($_POST["email"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'email'"));
    return;
  }

  if (!isset($_POST["uf"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'uf'"));
    return;
  }

  if (!isset($_POST["nome"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'nome'"));
    return;
  }

  if (!isset($_POST["cidade"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'cidade'"));
    return;
  }

  if (!isset($_POST["perfilId"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'perfilId'"));
    return;
  }

  $userAlreadyExists = AppUserService::getByEmail($_POST["email"]);

  if (isset($userAlreadyExists)) {
    http_response_code(400);

    echo json_encode(array("message" => "E-mail utilizado por outro user"));
    return;
  }

  $newUser = AppUserService::handleCreateNewUser($_POST);

  if (isset($newUser)) {
    echo json_encode($newUser->toDataContract(), JSON_UNESCAPED_UNICODE);
    return;
  } else {
    http_response_code(500);
    echo json_encode(array("message" => "Erro ao criar novo user"), JSON_UNESCAPED_UNICODE);
    return;
  }
}

if ($_SERVER["REQUEST_METHOD"] === "PUT") {
  parse_str(file_get_contents('php://input'), $_PUT);

  if (!isset($_PUT["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'id'"));
    return;
  }

  if (!isset($_PUT["uf"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'uf'"));
    return;
  }

  if (!isset($_PUT["nome"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'nome'"));
    return;
  }

  if (!isset($_PUT["cidade"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'cidade'"));
    return;
  }

  if (!isset($_PUT["perfilId"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Campo faltoso: 'perfilId'"));
    return;
  }

  $user = AppUserService::getById($_PUT["id"]);

  if (isset($user)) {
    if ($user->getId() !== $_PUT["id"]) {
      http_response_code(401);

      echo json_encode(array("message" => "Proibido atualizar um user terceiro"));
      return;
    }

    $updatedUser = AppUserService::updateUser($_PUT);

    if (isset($updatedUser)) {
      echo json_encode($updatedUser->toDataContract(), JSON_UNESCAPED_UNICODE);
      return;
    } else {
      http_response_code(500);
      echo json_encode(array("message" => "Erro ao atualizar o user"), JSON_UNESCAPED_UNICODE);
      return;
    }
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "User inexistente"));
    return;
  }
}
