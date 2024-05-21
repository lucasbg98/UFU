<?php

require_once(__DIR__ . "/../model/AppUser.php");
require_once(__DIR__ . "/../dao/AppUserDAO.php");

class AppUserService
{
  public static function handleCreateNewUser($args): ?AppUser
  {
    $userAlreadyExists = AppUserDAO::read(array("getByEmail", $args["email"]));

    if ($userAlreadyExists) {
      return null;
    }

    $appUser = new AppUser();
    $appUser->setUf($args["uf"]);
    $appUser->setNome($args["nome"]);
    $appUser->setEmail($args["email"]);
    $appUser->setCidade($args["cidade"]);
    $appUser->setPerfilId((int) $args["perfilId"]); 

    if (isset($args["otherProfile"])) {
      // to do -> write info in csv file, like "id, sugestion"
    }

    return AppUserDAO::create($appUser);
  }



  public static function updateUser($args)
  {
    $appUser = new AppUser();
    $appUser->setId($args["id"]);
    $appUser->setUf($args["uf"]);
    $appUser->setNome($args["nome"]);
    $appUser->setCidade($args["cidade"]);
    $appUser->setPerfilId((int) $args["perfilId"]);

    return AppUserDAO::update($appUser);
  }

  public static function getUfsAndCities()
  {
    $filePath = __DIR__ . '/../assets/js/json/estados.json';
    if (file_exists($filePath)) {
      $data = file_get_contents($filePath); //data read from json file

      return json_decode($data, JSON_UNESCAPED_UNICODE);
    }

    return [];
  }

  public static function getByEmail(?string $email): ?AppUser
  {
    return isset($email) ? AppUserDAO::read(array("getByEmail", $email)) : null;
  }

  public static function getById(string $id): ?AppUser
  {
    return isset($id) ? AppUserDAO::read(array("getById", $id)) : null;
  }
}
