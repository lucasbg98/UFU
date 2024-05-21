<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (array_key_exists("getAll", $_GET)) {
    require_once(__DIR__ . "/../model/Perfil.php");
    require_once(__DIR__ . "/../service/PerfilService.php");

    $profiles = PerfilService::getProfiles($_GET["origin"] ?? "app");
    $parsedProfiles = Perfil::convertListToDataContract($profiles);

    echo json_encode($parsedProfiles, JSON_UNESCAPED_UNICODE);
  }
}